<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Records extends CI_Controller {
	
	// constructeur
	public function __construct() {
		parent::__construct();
		// chargements divers
		$this->load->model('all_model');
		$this->load->model('records_model');
		$this->lang->load('gipel');
		
		// contrÃ´le d'accÃ¨s
		if (!$this->control->ask_access()) {
			// utilisateur NON authentifiÃ©
			$curr_uri_string = uri_string();
			if ($curr_uri_string != 'records/index') {
				redirect('home/login');
			}
		}
	}
	
	/* ##################################################################
	----------				PAGE :: ./records/index					  ----------
	################################################################## */
	public function index() {
		// intitulÃ© de la page
		$data['bandeau'] = $data['titre'] = lang('title_synthesis');
		// inclusion du javascript dans le <head>
		$data['js'] = "	<link rel=\"stylesheet\" type=\"text/css\" href=\"".base_url('resource/css/interactive.css')."\" />
	<script src=\"http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js\" type=\"text/javascript\"></script>
	<script type=\"text/javascript\">
		$(document).ready(function(){
			$(\"#toggleTrigger1\").click(function(){
			$(\"#togglePanel1\").slideToggle();
			});
		});
		$(document).ready(function(){
			$(\"#toggleTrigger3\").click(function(){
			$(\"#togglePanel3\").slideToggle();
			});
		});
		$(document).ready(function(){
			$(\"#toggleTrigger2\").click(function(){
			$(\"#togglePanel2\").slideToggle();
			});
		});
	</script>\r\n" ;
		// comptage des enregistrments par catÃ©gories
		$data['adr']	= $this->records_model->count_most_records(1);
		$data['note']	= $this->records_model->count_most_records(2);
		$data['doc']	= $this->records_model->count_most_records(3);
		$data['wsl']	= $this->records_model->count_most_records(4);
		$data['total'] = $data['adr'] + $data['note'] + $data['doc'] + $data['wsl'];
		// affichage de la vue
		$this->load->view('records/index', $data);
	}
	
	/* ##################################################################
	----------				PAGE :: ./records/find					  ----------
	################################################################## */
	public function find($start = 0) {
		$data['bandeau'] = lang('search_result');
		$data['titre'] = $this->all_model->add_nav_to_title($data['bandeau']);
		$data['current_user_rights'] = $this->session->userdata('user_rights');
		// rÃ©cupÃ©ration de la chaÃ®ne de texte saisie dans le header
		$header_string = $this->input->post('search_string');
		// la chaÃ®ne saisie dans le header doit contenir au moins 2 caractÃ¨res
		if (strlen($header_string) < 2 and $this->uri->segment(3) == "") $header_string = "xxxxx";
		// initialisation, passage et rÃ©cupÃ©ration de la chaÃ®ne dans l'url
		if ($this->uri->segment(3) == "") {
			// Ã©chappement de la chaÃ®ne saisie dans le header
			$string = $this->db->escape_like_str($header_string);
			$url_string = urlencode($header_string);
		} else {
			$url_string = $this->uri->segment(3);
			// Ã©chappement de la chaÃ®ne rÃ©cupÃ©rÃ©e dans l'url
			$string = $this->db->escape_like_str(urldecode($this->uri->segment(3)));
		}
		/* Thus, only alphanumerics, the special characters "$-_.+!*'(),", and
		reserved characters used for their reserved purposes may be used
		unencoded within a URL.
		http://www.faqs.org/rfcs/rfc1738.html
		*/
		// mise en place de la pagination
		$start = $this->uri->segment(4, 0);
		$data['qty_per_page'] = $this->config->item('appli_qty_per_page');
		$this->load->library('pagination');
		// configuration de la pagination
		$pagination_settings['base_url'] = base_url('index.php/records/find/' . $url_string . '/') ;
		$pagination_settings['total_rows'] = $data['total_rows'] = $this->records_model->count_from_header_search($string);
		$pagination_settings['per_page'] = $data['qty_per_page'];
		$pagination_settings['uri_segment'] = 4;
		$pagination_settings['full_tag_open'] = "\t\t\t<h2 style=\"text-align:center\">";
		$pagination_settings['full_tag_close'] = "</h2>\r\n";
		$pagination_settings['first_link'] = "<img src=\"".base_url('resource/img/actions/first.png')."\" width=\"44\" height=\"24\" alt=\"first\" title=\"".lang('action_first')."\" />";
		$pagination_settings['prev_link'] = "<img src=\"".base_url('resource/img/actions/previous.png')."\" width=\"44\" height=\"24\" alt=\"previous\" title=\"".lang('action_previous')."\" />";
		$pagination_settings['next_link'] = "<img src=\"".base_url('resource/img/actions/next.png')."\" width=\"44\" height=\"24\" alt=\"next\" title=\"".lang('action_next')."\" />";
		$pagination_settings['last_link'] = "<img src=\"".base_url('resource/img/actions/last.png')."\" width=\"44\" height=\"24\" alt=\"last\" title=\"".lang('action_last')."\" />";
		// acquisition d'un paquet de [$qty_per_page] enregistrements en commenÃ§ant Ã  [$start]
		$data['records'] = $this->records_model->get_from_header_search($pagination_settings['per_page'], $start, $string);
		// sortie de la pagination en html
		$this->pagination->initialize($pagination_settings);
		$data['pagination'] = $this->pagination->create_links();
		// affichage du rÃ©sultat
		$this->load->view('records/liste', $data);
	}
	
	public function find_old($start = 0) {
		$data['bandeau'] = lang('search_result');
		$data['titre'] = $this->all_model->add_nav_to_title($data['bandeau']);
		$data['current_user_rights'] = $this->session->userdata('user_rights');
		// rÃ©cupÃ©ration de la chaÃ®ne de texte (saisie dans le header OU passÃ©e en url)
		$header_string = $this->input->post('search_string');
		
		// contrÃ´le de la chaÃ®ne avec restriction
		// 																					Ã  complÃ©ter !!!
		$unwanted = array(' ', '\\', '\'');
		$header_string = str_replace($unwanted, '', $header_string);
		
		if ((strlen($header_string) > 1)) {
			// la chaÃ®ne $header_string doit Ãªtre Ã©chappÃ©e
			$string = $this->db->escape_like_str($header_string);
		} else {
			// rÃ©cupÃ©ration de la chaÃ®ne dans l'url
			$string = $this->uri->segment(3);
		}
		
		
		// mise en place de la pagination
		$start = $this->uri->segment(4, 0);
		$data['qty_per_page'] = $this->config->item('appli_qty_per_page');
		$this->load->library('pagination');
		// configuration de la pagination
		$pagination_settings['base_url'] = base_url('index.php/records/find/' . $string . '/') ;
		$pagination_settings['total_rows'] = $data['total_rows'] = $this->records_model->count_from_header_search($string);
		$pagination_settings['per_page'] = $data['qty_per_page'];
		$pagination_settings['uri_segment'] = 4;
		$pagination_settings['full_tag_open'] = "\t\t\t<h2 style=\"text-align:center\">";
		$pagination_settings['full_tag_close'] = "</h2>\r\n";
		$pagination_settings['first_link'] = "<img src=\"".base_url('resource/img/actions/first.png')."\" width=\"44\" height=\"24\" alt=\"first\" title=\"".lang('action_first')."\" />";
		$pagination_settings['prev_link'] = "<img src=\"".base_url('resource/img/actions/previous.png')."\" width=\"44\" height=\"24\" alt=\"previous\" title=\"".lang('action_previous')."\" />";
		$pagination_settings['next_link'] = "<img src=\"".base_url('resource/img/actions/next.png')."\" width=\"44\" height=\"24\" alt=\"next\" title=\"".lang('action_next')."\" />";
		$pagination_settings['last_link'] = "<img src=\"".base_url('resource/img/actions/last.png')."\" width=\"44\" height=\"24\" alt=\"last\" title=\"".lang('action_last')."\" />";
		// acquisition d'un paquet de [$qty_per_page] enregistrements en commenÃ§ant Ã  [$start]
		$data['records'] = $this->records_model->get_from_header_search($pagination_settings['per_page'], $start, $string);
		// sortie de la pagination en html
		$this->pagination->initialize($pagination_settings);
		$data['pagination'] = $this->pagination->create_links();
		// affichage du rÃ©sultat
		$this->load->view('records/liste', $data);
	}
	
	/* ##################################################################
	----------				PAGE :: ./records/detail				  ----------
	################################################################## */
	public function detail($uid) {
		// acquisition des infos de l'enregistrment
		$data['record'] = $this->all_model->get_fullrow('input', 'uid', $uid);
		if (empty($data['record'])) {
			show_404();
		}
		// incrÃ©mentation du champ clicks
		$this->all_model->increment_field('input', 'clicks', 'uid', $uid, 3);
		$data['bandeau'] = $data['record']['first_name'] . " " . $data['record']['last_name'];
		$data['current_user_rights'] = $this->session->userdata('user_rights');
		// inclusion du javascript dans le <head>
		$data['js'] = "	<link rel=\"stylesheet\" type=\"text/css\" href=\"".base_url('resource/css/interactive.css')."\" />
	<script src=\"http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js\" type=\"text/javascript\"></script>
	<script type=\"text/javascript\">
		$(document).ready(function(){
			$(\"#toggleTriggerDetail\").click(function(){
			$(\"#togglePanelDetail\").slideToggle();
			});
		});
	</script>\r\n" ;
		$data['titre'] = $this->all_model->add_nav_to_title(lang('title_detail_of') . $data['bandeau']);
		$itemid = $data['record']['itemid'];
		// acquisition des infos liÃ©es : groupe, pays
		$data['record']['groupe'] = $this->records_model->get_group_by_id($data['record']['groupid']);
		if ($itemid == 1) $data['record']['country'] = $this->all_model->get_field_by_id('country', 'country_fr', 'country_id', $data['record']['country_id']);
		// recherche de la photo liÃ©e Ã  l'enregistrement ou Ã  dÃ©faut du logo de la catÃ©gorie - Un lien permet de tÃ©lÃ©charger une photo ou d'en changer
		$data['record']['associated_image'] = $this->records_model->get_associated_image($itemid, $uid, 'detail');
		// construction des blocs qui seront affichÃ©s
		switch ($itemid) {
			case "1":
				// bloc action :: "Imprimer une Ã©tiquette d'expÃ©dition"
				$data['record']['bloc_actions'] = "<img src=\"".base_url('resource/img/actions/print.png')."\" alt=\"popup\" width=\"44\" height=\"24\" title=\"".lang('action_print_etic')."\" onclick=\"popup_print_etic('" . base_url('index.php/records/print_etic_exp/'.$uid) . "')\" />";
				// bloc action :: "Afficher le plan Google Map"
				if (strlen($data['record']['gmap']) > 10) $data['record']['bloc_actions'] .= $this->all_model->fill_it(38) . "<img src=\"".base_url('resource/img/actions/gmap.png')."\" alt=\"popup\" width=\"44\" height=\"24\" title=\"".lang('action_show_gmap')."\" onclick=\"popup_gmap('" . $data['record']['gmap'] . "')\" />";
				// bloc identitÃ©
				$data['record']['bloc_identite'] = "<strong>" . $data['record']['title'] . " " . $data['record']['first_name'] . " " . $data['record']['last_name'] . "</strong>" ;
				$data['record']['bloc_identite'] .= "<br />" . $data['record']['adress1'];
				if (strlen($data['record']['adress2']) > 3) $data['record']['bloc_identite'] .= "<br />" . $data['record']['adress2'];
				$data['record']['bloc_identite'] .= "<br />" . $data['record']['postcode'] . " " . $data['record']['city'] ;
				$data['record']['bloc_identite'] .= "<br />" . $data['record']['country'];
				if ($data['record']['birthday'] != '1900-01-01') $data['record']['bloc_identite'] .= "<br /><br />" . "<em>" . lang('label_birthday') . " :</em><br />" . $data['record']['birthday'];
				// bloc contact
				$data['record']['bloc_contact'] = "<em>" . lang('label_phone') . " :</em>";
				$unwanted = array(' ', '.', '-');
				if (strlen($data['record']['phone_home']) > 6) $data['record']['bloc_contact'] .= "<br />" . str_replace($unwanted, '', $data['record']['phone_home']) . lang('info_home');
				if (strlen($data['record']['phone_work']) > 6) $data['record']['bloc_contact'] .= "<br />" . str_replace($unwanted, '', $data['record']['phone_work']) . lang('info_office');
				if (strlen($data['record']['phone_cell']) > 6) $data['record']['bloc_contact'] .= "<br />" . str_replace($unwanted, '', $data['record']['phone_cell']) . lang('info_mobile');
				if (strlen($data['record']['fax']) > 6) $data['record']['bloc_contact'] .= "<br />" . $data['record']['fax'] . lang('info_fax');
				if (strlen($data['record']['bloc_contact']) < 15) $data['record']['bloc_contact'] .= "<br />" . lang('info_not_filled');
				$data['record']['bloc_contact'] .= "<br /><br />" . "<em>" . lang('label_email') . " :</em>";
				if (strlen($data['record']['email']) > 6) {
					$data['record']['bloc_contact'] .= "<br />" . word_wrap($data['record']['email'], 25);
				}
				else $data['record']['bloc_contact'] .= "<br />" . lang('info_not_filled');
			break;
			case "2":
				// bloc action :: "Imprimer la note"
				$data['record']['bloc_actions'] = "<img src=\"".base_url('resource/img/actions/print.png')."\" alt=\"popup\" width=\"44\" height=\"24\" title=\"".lang('action_print_note')."\" onclick=\"popup_print_note('" . base_url('index.php/records/print_note/'.$uid) . "')\" />";
			break;
			case "3":
				// bloc action :: "Ouvrir la page en popup"
				$data['record']['bloc_actions'] = "<img src=\"".base_url('resource/img/actions/popup.png')."\" alt=\"popup\" width=\"44\" height=\"24\" title=\"".lang('action_open_popup')."\" onclick=\"popup_site('" . $data['record']['url'] . "', '".$data['record']['width']."', '".$data['record']['height']."')\" />";
				// bloc action :: "Ouvrir la page dans un nouvel onglet"
				$data['record']['bloc_actions'] .= $this->all_model->fill_it(38) . "<a href=\"" . $data['record']['url'] . "\" target=\"_blank\" title=\"".lang('action_open_newtab')."\"><img src=\"".base_url('resource/img/actions/newtab.png')."\" height=\"24\" width=\"44\" alt=\"newtab\" /></a>";
				// bloc dÃ©nomination
				$data['record']['bloc_denomination'] = "<em>" . lang('info_doc_name') . "</em>" . $data['record']['first_name'] . "<br /><br />";
				$data['record']['bloc_denomination'] .= "<em>" . lang('info_popup_setting') . "</em>" . $data['record']['width'] . " / " . $data['record']['height'] . " pixels";
				// bloc complement
				$data['record']['titre_bloc_complement'] = lang('wording_info_document');
				$data['record']['bloc_complement'] = "<em>" . lang('info_doc_version') . "</em>" . $data['record']['last_name'] . "<br /><br />";
				$data['record']['bloc_complement'] .=  "<em>" . lang('info_doc_date') . "</em>" . $data['record']['birthday'];
			break;
			case "4":
				// bloc action :: "Ouvrir la page en popup"
				$data['record']['bloc_actions'] = "<img src=\"".base_url('resource/img/actions/popup.png')."\" alt=\"popup\" width=\"44\" height=\"24\" title=\"".lang('action_open_popup')."\" onclick=\"popup_site('" . $data['record']['url'] . "', '".$data['record']['width']."', '".$data['record']['height']."')\" />";
				// bloc action :: "Ouvrir la page dans un nouvel onglet"
				$data['record']['bloc_actions'] .= $this->all_model->fill_it(38) . "<a href=\"" . $data['record']['url'] . "\" target=\"_blank\" title=\"".lang('action_open_newtab')."\"><img src=\"".base_url('resource/img/actions/newtab.png')."\" height=\"24\" width=\"44\" alt=\"newtab\" /></a>";
				// bloc dÃ©nomination
				$data['record']['bloc_denomination'] = "<em>" . lang('info_site_name') . "</em>" . $data['record']['first_name'] . "<br /><br />";
				$data['record']['bloc_denomination'] .= "<em>" . lang('info_popup_setting') . "</em>" . $data['record']['width'] . " / " . $data['record']['height'] . " pixels";
				// bloc complement
				$data['record']['titre_bloc_complement'] = lang('wording_info_login');
				if (strlen($data['record']['password']) > 3) {
					$data['record']['bloc_complement'] =  "<em>" . lang('label_username') . " :</em><br />" . word_wrap($data['record']['username'], 25) . "<br /><br />";
					if (strlen($data['record']['email']) > 6) $data['record']['bloc_complement'] .=  "<em>" . lang('label_email') . " :</em><br />" . word_wrap($data['record']['email'], 25) . "<br /><br />";
					$data['record']['bloc_complement'] .=  "<em>" . lang('label_password') . " :</em><br />" . $data['record']['password'];
				} else $data['record']['bloc_complement'] =  lang('info_not_filled');
			break;
		}
		// affichage des infos collectÃ©es dans la vue appropriÃ©e
		$this->load->view('records/detail', $data);
	}
	
	/* ##################################################################
	----------				PAGE :: ./records/deep_search			  ----------
	################################################################## */
	public function deep_search($itemid) {
		// intitulÃ© de la page
		$data['bandeau'] = $this->records_model->name_category($itemid) . " : " . lang('title_deep_search') ;
		$data['titre'] = $this->all_model->add_nav_to_title("<span class=\"gris_moyen\">" . $this->records_model->name_category($itemid) . "</span> : " . lang('title_deep_search'));
		$data['itemid'] = $itemid;
		// affichage du formulaire de recherche avancÃ©e
		$this->load->view('records/search_form', $data);
	}
	
	/* ##################################################################
	----------				PAGE :: ./records/deep_find			  ----------
	################################################################## */
	public function deep_find() {
						//							print_r($_POST);
		$itemid = $this->input->post('itemid');
		// intitulÃ© de la page
		$data['bandeau'] = $this->records_model->name_category($itemid) . " : " . lang('title_deep_find') ;
		$data['titre'] = $this->all_model->add_nav_to_title("<span class=\"gris_moyen\">" . $this->records_model->name_category($itemid) . "</span> : " . lang('title_deep_find'));
		// acquisition des lignes qui rÃ©pondent aux critÃ©res de recherche passÃ©s en _POST
		$data['records'] = $this->records_model->get_from_deep_search($itemid);
		// affichage du rÃ©sultat de la recherche
		$data['current_user_rights'] = $this->session->userdata('user_rights');
		$this->load->view('records/liste', $data);
	}
	
	/* ##################################################################
	----------				PAGE :: ./records/add					  ----------
	################################################################## */
	public function add() {
		// rÃ©cupÃ©ration de la catÃ©gorie dans l'url
		$itemid = $this->uri->segment(3);
		// intitulÃ© de la page
		$data['bandeau'] = lang('title_add_record_in') . $this->records_model->name_category($itemid) ;
		$data['titre'] = $this->all_model->add_nav_to_title($data['bandeau']);
		// mode de fonctionnement du formulaire
		$data['mode'] = 'creation';
		// affichage de la vue
		$this->load->view('records/form', $data);
	}
	
	/* ##################################################################
	----------				PAGE :: ./records/edit					  ----------
	################################################################## */
	public function edit($uid) {
		// acquisition de la ligne concernÃ©e
		$data['record'] = $this->all_model->get_fullrow('input', 'uid', $uid);
		if (empty($data['record'])) {
			show_404();
		}
		// intitulÃ© de la page
		$data['bandeau'] = lang('title_edit') . $data['record']['first_name'] . " " . $data['record']['last_name'];
		$data['titre'] = $this->all_model->add_nav_to_title("<span class=\"gris_moyen\">" . lang('title_edit') . "</span>" . $data['record']['first_name'] . " " . $data['record']['last_name']);
		// mode de fonctionnement du formulaire
		$data['mode'] = 'edition';
		// affichage de la vue
		$this->load->view('records/form', $data);
	}
	
	/* ##################################################################
	----------			POPUP :: ./records/delete_request		  ----------
	################################################################## */
	public function delete_request($uid) {
		// acquisition de la ligne concernÃ©e
		$data['record'] = $this->all_model->get_fullrow('input', 'uid', $uid);
		if (empty($data['record'])) {
			show_404();
		}
		// restriction d'accÃ¨s au script
		if ($this->session->userdata('user_rights') == "ReadOnly") {
			$this->load->view('templates/popup_forbidden');
		} elseif (($this->session->userdata('user_rights') == 'ReadWrite') and ($data['record']['visibility'] == 'personal') and ($this->session->userdata('user_name') != $data['record']['maked_by'])) {
			$data['bandeau'] = "access denied";
			$data['body_tag'] = "<body onload=\"setTimeout('self.close();',10*1000)\">\r\n";
			$data['titre'] = "<div class=\"entete\">access denied</div>\r\n";
			$data['corps'] = "<p class=\"fbox error\">" . lang('error_forbidden_delete') . "</p>\r\n";
			// affichage de la vue
			$this->load->view('templates/popup_vue', $data);
		} else {
			$data['bandeau'] = lang('action_delete') . " : " . $data['record']['first_name'] . " " . $data['record']['last_name'];
			$data['body_tag'] = "<body onload=\"setTimeout('self.close();',10*1000)\">\r\n";
			$itemid = $data['record']['itemid'];
			$data['record']['groupe'] = $this->records_model->get_group_by_id($data['record']['groupid']);
			$data['titre'] = "<div class=\"entete\"><span class=\"gris\">" . lang('action_delete') . " : </span><br />" . $data['record']['first_name'] . " " . $data['record']['last_name'] . "<br /><em>( " .  $data['record']['groupe'] . " )</em></div>\r\n";
			$data['corps']  = "<p class=\"fbox warning\">" . lang('wording_caution_delete_request') . "</p>\r\n";
			$data['corps'] .= "<p class=\"prose\">" . lang('wording_please_click') . anchor('/records/delete/'.$uid, lang('wording_here'), array('title' => lang('action_delete'))) . lang('wording_to_confirm') . "</p>\r\n";
			// affichage de la vue
			$this->load->view('templates/popup_vue', $data);
		}
	}
	
	/* ##################################################################
	----------				POPUP :: ./records/delete				  ----------
	################################################################## */
	public function delete($uid) {
		// acquisition de la ligne concernÃ©e
		$data['record'] = $this->all_model->get_fullrow('input', 'uid', $uid);
		if (empty($data['record'])) {
			show_404();
		}
		// restriction d'accÃ¨s au script
		if ($this->session->userdata('user_rights') == "ReadOnly") {
			$this->load->view('templates/popup_forbidden');
		} elseif (($this->session->userdata('user_rights') == 'ReadWrite') and ($data['record']['visibility'] == 'personal') and ($this->session->userdata('user_name') != $data['record']['maked_by'])) {
			$data['bandeau'] = "access denied";
			$data['body_tag'] = "<body onload=\"setTimeout('self.close();',10*1000)\">\r\n";
			$data['titre'] = "<div class=\"entete\">access denied</div>\r\n";
			$data['corps'] = "<p class=\"fbox error\">" . lang('error_forbidden_delete') . "</p>\r\n";
			// affichage de la vue
			$this->load->view('templates/popup_vue', $data);
		} else {
			$data['bandeau'] = lang('action_delete') . " : " . $data['record']['first_name'] . " " . $data['record']['last_name'];
			$data['body_tag'] = "<body onload=\"setTimeout('self.close();',20*1000)\" onunload=\"self.opener.location.reload();\">\r\n";
			$itemid = $data['record']['itemid'];
			$data['record']['groupe'] = $this->records_model->get_group_by_id($data['record']['groupid']);
			$data['titre'] = "<div class=\"entete\"><span class=\"gris\">" . lang('action_delete') . " : </span><br />" . $data['record']['first_name'] . " " . $data['record']['last_name'] . "<br /><em>( " .  $data['record']['groupe'] . " )</em></div>\r\n";
			$data['corps'] = "" ;
			// effacement de l'enregistrement
			if ($this->all_model->delete_ligne('input', 'uid', $uid)) {
				$data['corps'] .= "<p class=\"fbox good\"><strong>" . $data['record']['first_name'] . " " . $data['record']['last_name'] . "<br />" . lang('info_has_been_deleted') . "</p>\r\n";
			}
			// effacement du fichier photo associÃ©
			if ($this->records_model->photo_file_delete($itemid, $uid)) {
				$data['corps'] .= "<p class=\"fbox info\">" . lang('info_photo_also_deleted') . "<br />&nbsp;</p>\r\n";
			}
			// affichage de la vue
			$this->load->view('templates/popup_vue', $data);
		}
	}
	
	/* ##################################################################
	----------				PAGE :: ./records/save					  ----------
	################################################################## */
	public function save() {
					//							print_r($_POST);
		// rÃ©cupÃ©ration de la catÃ©gorie et de l'identifiant
		$itemid = $this->input->post('itemid');
		$uid = $this->input->post('uid');
		// incrÃ©mentation du champ clicks
		if ($uid != 'not_set') $this->all_model->increment_field('input', 'clicks', 'uid', $uid, 2);
		// initialisation du validateur du formulaire
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<br /><div class="errorMessage"><span style="font-size: 150%;">&uarr;&nbsp;</span>', '</div>');
		// aiguillage en fonction de la catÃ©gorie
		switch ($itemid) {
			case "1":
				// dÃ©finition des rÃ¨gles de validation
				$this->form_validation->set_rules('title', 'Â« title Â»', 'max_length[64]');								// non mandatory
				$this->form_validation->set_rules('first_name', 'Â« '.lang('label_first_name').' Â»', 'required');
				$this->form_validation->set_rules('last_name', 'Â« '.lang('label_last_name').' Â»', 'required');
				$this->form_validation->set_rules('birthday', 'Â« '.lang('label_birthday').' Â»', 'max_length[64]');		// date
				$this->form_validation->set_rules('groupid', 'Â« groupid Â»', 'max_length[64]');						// select
				$this->form_validation->set_rules('adress1', 'Â« adress1 Â»', 'max_length[64]');						// non mandatory
				$this->form_validation->set_rules('adress2', 'Â« adress2 Â»', 'max_length[64]');						// non mandatory
				$this->form_validation->set_rules('postcode', 'Â« postcode Â»', 'max_length[64]');						// non mandatory
				$this->form_validation->set_rules('city', 'Â« city Â»', 'max_length[64]');								// non mandatory
				$this->form_validation->set_rules('country_id', 'Â« country_id Â»', 'max_length[64]');				// select
				$this->form_validation->set_rules('phone_home', 'Â« phone_home Â»', 'max_length[64]');				// non mandatory
				$this->form_validation->set_rules('phone_work', 'Â« phone_work Â»', 'max_length[64]');				// non mandatory
				$this->form_validation->set_rules('phone_cell', 'Â« phone_cell Â»', 'max_length[64]');				// non mandatory
				$this->form_validation->set_rules('fax', 'Â« fax Â»', 'max_length[64]');									// non mandatory
				$this->form_validation->set_rules('email', 'Â« email Â»', 'valid_email');									// non mandatory
				$this->form_validation->set_rules('gmap', 'Â« gmap Â»', 'max_length[2048]');								// non mandatory
				$this->form_validation->set_rules('memo', 'memo', 'min_length[8]');										// non mandatory
				$this->form_validation->set_rules('visibility', 'Â« visibility Â»', 'required');						// radio
				// test de validation du formulaire
				if ($this->form_validation->run() == FALSE){
					// Ã©chec : retour au formulaire
					if($uid != "not_set") {
						$this->edit($uid);
					} else {
						$this->add();
					}
				} else {
					// succÃ¨s : rÃ©cupÃ©ration (et traitement) des donnÃ©es passÃ©es en post
					if     ($this->input->post('title') == 'miss') $the_title = lang('label_radio_miss');
					elseif ($this->input->post('title') == 'mr')   $the_title = lang('label_radio_mr'); 
					elseif ($this->input->post('title') == 'mrs')  $the_title = lang('label_radio_mrs');
					else $the_title = '';
					$data['itemid']			= $this->input->post('itemid');
					$data['groupid']			= $this->input->post('groupid');
					$data['title']				= $the_title;
					$data['first_name']		= $this->input->post('first_name');
					$data['last_name']		= $this->input->post('last_name');
					$data['adress1']			= $this->input->post('adress1');
					$data['adress2']			= $this->input->post('adress2');
					$data['postcode']			= $this->input->post('postcode');
					$data['city']				= $this->input->post('city');
					$data['country_id']		= $this->input->post('country_id');
					$data['phone_home']		= $this->input->post('phone_home');
					$data['phone_work']		= $this->input->post('phone_work');
					$data['phone_cell']		= $this->input->post('phone_cell');
					$data['fax']				= $this->input->post('fax');
					$data['email']				= $this->input->post('email');
					$data['gmap']				= $this->input->post('gmap');
					$data['birthday']			= $this->input->post('birthday');
					$data['memo']				= $this->input->post('memo');
					$data['visibility']		= $this->input->post('visibility');
					
					// test de l'action Ã  effectuer : modification ou crÃ©ation
					if($uid == "not_set") {
						// contrÃ´le d'unicitÃ© avant crÃ©ation
						if ($this->records_model->oneness_control($data['first_name'], $data['last_name']) == TRUE) {
							// champs remplis automatiquement
							$data['keywords'] = $data['first_name'] . " " . $data['last_name'];
							$data['maked_on'] = now();
							$data['maked_by'] = $this->session->userdata('user_name');
							// construction de l'historique
							$data['history']		= $this->records_model->make_history($data);
							// requÃªte d'insertion
							$new_id = $this->all_model->add_ligne('input', $data) ;
							if (is_numeric($new_id)) {
								$data = $this->all_model->get_fullrow('input', 'uid', $new_id);
								// message de confirmation
								$flash_feedback = lang('info_the_people') . $data['first_name'] . " " . $data['last_name'] . lang('info_has_been_added') ;
								$this->session->set_flashdata('good', $flash_feedback);
							} else {
								// message d'erreur
								
							}
							// redirection vers la page detail
							redirect('/records/detail/'.$new_id);
						} else {
							// message d'erreur
							$flash_feedback = lang('error_already_existing');
							$this->session->set_flashdata('error', $flash_feedback);
						}
						// redirection vers la page records
						redirect('/records/');
					} else {
						// sauvegarde de l'enregistrement avant modification
						$this->records_model->backup_it($uid);
						// premiÃ¨re requÃªte de modification
						$affected_rows = $this->all_model->update_ligne('input', $data, 'uid', $uid);
						if ($affected_rows == 1) {
							// champs remplis automatiquement
							$data['revised_on']		= now();
							$data['revised_by']		= $this->session->userdata('user_name');
							// mise Ã  jour de l'historique
							$data['history']			= $this->records_model->update_history($data);
							// deuxiÃ¨me requÃªte de modification
							if (($this->all_model->update_ligne('input', $data, 'uid', $uid)) == 1) {
								// message de confirmation
								$flash_feedback = lang('info_the_people') . $data['first_name'] . " " . $data['last_name'] . lang('info_has_been_updated') ;
								$this->session->set_flashdata('good', $flash_feedback);
							} else {
								// message d'erreur
								
							}
						} else {
							// message de warning
							$flash_feedback = lang('info_no_update');
							$this->session->set_flashdata('warning', $flash_feedback);
						}
						// redirection vers la page detail
						redirect('/records/detail/'.$uid);
					}
				}
			break;
			case "2":
				// dÃ©finition des rÃ¨gles de validation
				$this->form_validation->set_rules('first_name', 'Â« '.lang('label_note_title').' Â»', 'required');
				$this->form_validation->set_rules('groupid', 'groupid', 'max_length[64]');
				$this->form_validation->set_rules('memo', 'Â« Note Â»', 'required|min_length[8]');
				$this->form_validation->set_rules('visibility', 'Â« visibility Â»', 'required');				// radio
				// test de validation du formulaire
				if ($this->form_validation->run() == FALSE){
					// Ã©chec : retour au formulaire
					if($uid != "not_set") {
						$this->edit($uid);
					} else {
						$this->add();
					}
				} else {
					// succÃ¨s : rÃ©cupÃ©ration des donnÃ©es passÃ©es en post
					$data['first_name']		= $this->input->post('first_name');
					$data['itemid']			= $this->input->post('itemid');
					$data['groupid']			= $this->input->post('groupid');
					$data['memo']				= $this->input->post('memo');
					$data['visibility']		= $this->input->post('visibility');
					// test de l'action Ã  effectuer : modification ou crÃ©ation
					if($uid == "not_set") {
						// contrÃ´le d'unicitÃ© avant crÃ©ation
						if ($this->records_model->oneness_control($data['first_name']) == TRUE) {
							// champs remplis automatiquement
							$data['keywords'] = $data['first_name'];
							$data['maked_on'] = now();
							$data['maked_by'] = $this->session->userdata('user_name');
							// construction de l'historique
							$data['history']		= $this->records_model->make_history($data);
							// requÃªte d'insertion
							$new_id = $this->all_model->add_ligne('input', $data) ;
							if (is_numeric($new_id)) {
								$data = $this->all_model->get_fullrow('input', 'uid', $new_id);
								// message de confirmation
								$flash_feedback = lang('info_the_note') . $data['first_name'] . lang('info_has_been_added');
								$this->session->set_flashdata('good', $flash_feedback);
							} else {
								// message d'erreur
								
							}
							// redirection vers la page detail
							redirect('/records/detail/'.$new_id);
						} else {
							// message d'erreur
							$flash_feedback = lang('error_already_existing') ;
							$this->session->set_flashdata('error', $flash_feedback);
						}
						// redirection vers la page records
						redirect('/records/');
					} else {
						// sauvegarde de l'enregistrement avant modification
						$this->records_model->backup_it($uid);
						// premiÃ¨re requÃªte de modification
						$affected_rows = $this->all_model->update_ligne('input', $data, 'uid', $uid);
						if ($affected_rows == 1) {
							// champs remplis automatiquement
							$data['revised_on']		= now();
							$data['revised_by']		= $this->session->userdata('user_name');
							// mise Ã  jour de l'historique
							$data['history']			= $this->records_model->update_history($data);
							// deuxiÃ¨me requÃªte de modification
							if (($this->all_model->update_ligne('input', $data, 'uid', $uid)) == 1) {
								// message de confirmation
								$flash_feedback = lang('info_the_note') . $data['first_name'] . lang('info_has_been_updated');
								$this->session->set_flashdata('good', $flash_feedback);
							} else {
								// message d'erreur
								
							}
						} else {
							// message de warning
							$flash_feedback = lang('info_no_update') ;
							$this->session->set_flashdata('warning', $flash_feedback);
						}
						// redirection vers la page detail
						redirect('/records/detail/'.$uid);
					}
				}
			break;
			case "3":
				// dÃ©finition des rÃ¨gles de validation
				$this->form_validation->set_rules('first_name', 'Â« '.lang('label_doc_name').' Â»', 'required');
				$this->form_validation->set_rules('last_name', 'Â« last_name Â»', 'max_length[64]');
				$this->form_validation->set_rules('birthday', 'Â« birthday Â»', 'max_length[64]');
				$this->form_validation->set_rules('groupid', 'groupid', 'max_length[64]');
				$this->form_validation->set_rules('url', 'Â« '.lang('label_doc_url').' Â»', 'required');
				$this->form_validation->set_rules('width', 'Â« width Â»', 'max_length[64]');
				$this->form_validation->set_rules('height', 'Â« height Â»', 'max_length[64]');
				$this->form_validation->set_rules('memo', 'memo', 'min_length[8]');
				$this->form_validation->set_rules('visibility', 'Â« visibility Â»', 'required');				// radio
				// test de validation du formulaire
				if ($this->form_validation->run() == FALSE){
					// Ã©chec : retour au formulaire
					if($uid != "not_set") {
						$this->edit($uid);
					} else {
						$this->add();
					}
				} else {
					// succÃ¨s : rÃ©cupÃ©ration des donnÃ©es passÃ©es en post
					$data['first_name']		= $this->input->post('first_name');
					$data['last_name']		= $this->input->post('last_name');
					$data['birthday']			= $this->input->post('birthday');
					$data['itemid']			= $this->input->post('itemid');
					$data['groupid']			= $this->input->post('groupid');
					$data['url']				= $this->input->post('url');
					$data['width']				= $this->input->post('width');
					$data['height']			= $this->input->post('height');
					$data['memo']				= $this->input->post('memo');
					$data['visibility']		= $this->input->post('visibility');
					// test de l'action Ã  effectuer : modification ou crÃ©ation
					if($uid == "not_set") {
						// contrÃ´le d'unicitÃ© avant crÃ©ation
						if ($this->records_model->oneness_control($data['first_name']) == TRUE) {
							// champs remplis automatiquement
							$data['keywords'] = $data['first_name'];
							$data['maked_on'] = now();
							$data['maked_by'] = $this->session->userdata('user_name');
							// construction de l'historique
							$data['history']		= $this->records_model->make_history($data);
							// requÃªte d'insertion
							$new_id = $this->all_model->add_ligne('input', $data) ;
							if (is_numeric($new_id)) {
								$data = $this->all_model->get_fullrow('input', 'uid', $new_id);
								// message de confirmation
								$flash_feedback = lang('info_the_document') . $data['first_name'] . lang('info_has_been_added');
								$this->session->set_flashdata('good', $flash_feedback);
							} else {
								// message d'erreur
								
							}
							// redirection vers la page detail
							redirect('/records/detail/'.$new_id);
						} else {
							// message d'erreur
							$flash_feedback = lang('error_already_existing') ;
							$this->session->set_flashdata('error', $flash_feedback);
						}
						// redirection vers la page records
						redirect('/records/');
					} else {
						// sauvegarde de l'enregistrement avant modification
						$this->records_model->backup_it($uid);
						// premiÃ¨re requÃªte de modification
						$affected_rows = $this->all_model->update_ligne('input', $data, 'uid', $uid);
						if ($affected_rows == 1) {
							// champs remplis automatiquement
							$data['revised_on']		= now();
							$data['revised_by']		= $this->session->userdata('user_name');
							// mise Ã  jour de l'historique
							$data['history']			= $this->records_model->update_history($data);
							// deuxiÃ¨me requÃªte de modification
							if (($this->all_model->update_ligne('input', $data, 'uid', $uid)) == 1) {
								// message de confirmation
								$flash_feedback = lang('info_the_document') . $data['first_name'] . lang('info_has_been_updated');
								$this->session->set_flashdata('good', $flash_feedback);
							} else {
								// message d'erreur
								
							}
						} else {
							// message de warning
							$flash_feedback = lang('info_no_update') ;
							$this->session->set_flashdata('warning', $flash_feedback);
						}
						// redirection vers la page detail
						redirect('/records/detail/'.$uid);
					}
				}
			break;
			case "4":
				// dÃ©finition des rÃ¨gles de validation
				$this->form_validation->set_rules('first_name', 'Â« '.lang('label_site_name').' Â»', 'required');
				$this->form_validation->set_rules('groupid', 'groupid', 'max_length[64]');
				$this->form_validation->set_rules('username', 'Â« username Â»', 'max_length[64]');
				$this->form_validation->set_rules('email', 'Â« email Â»', 'max_length[64]');
				$this->form_validation->set_rules('password', 'Â« password Â»', 'max_length[64]');
				$this->form_validation->set_rules('url', 'Â« '.lang('label_site_url').' Â»', 'required');
				$this->form_validation->set_rules('width', 'Â« width Â»', 'max_length[64]');
				$this->form_validation->set_rules('height', 'Â« height Â»', 'max_length[64]');
				$this->form_validation->set_rules('memo', 'memo', 'min_length[8]');
				$this->form_validation->set_rules('visibility', 'Â« visibility Â»', 'required');				// radio
				// test de validation du formulaire
				if ($this->form_validation->run() == FALSE){
					// Ã©chec : retour au formulaire
					if($uid != "not_set") {
						$this->edit($uid);
					} else {
						$this->add();
					}
				} else {
					// succÃ¨s : rÃ©cupÃ©ration des donnÃ©es passÃ©es en post
					$data['first_name']		= $this->input->post('first_name');
					$data['itemid']			= $this->input->post('itemid');
					$data['groupid']			= $this->input->post('groupid');
					$data['username']			= $this->input->post('username');
					$data['email']				= $this->input->post('email');
					$data['password']			= $this->input->post('password');
					$data['url']				= $this->input->post('url');
					$data['width']				= $this->input->post('width');
					$data['height']			= $this->input->post('height');
					$data['memo']				= $this->input->post('memo');
					$data['visibility']		= $this->input->post('visibility');
					// test de l'action Ã  effectuer : modification ou crÃ©ation
					if($uid == "not_set") {
						// contrÃ´le d'unicitÃ© avant crÃ©ation
						if ($this->records_model->oneness_control($data['first_name']) == TRUE) {
							// champs remplis automatiquement
							$data['keywords'] = $data['first_name'];
							$data['maked_on'] = now();
							$data['maked_by'] = $this->session->userdata('user_name');
							// construction de l'historique
							$data['history']		= $this->records_model->make_history($data);
							// requÃªte d'insertion
							$new_id = $this->all_model->add_ligne('input', $data) ;
							if (is_numeric($new_id)) {
								$data = $this->all_model->get_fullrow('input', 'uid', $new_id);
								// message de confirmation
								$flash_feedback = lang('info_the_site') . $data['first_name'] . lang('info_has_been_added');
								$this->session->set_flashdata('good', $flash_feedback);
							} else {
								// message d'erreur
								
							}
							// redirection vers la page detail
							redirect('/records/detail/'.$new_id);
						} else {
							// message d'erreur
							$flash_feedback = lang('error_already_existing') ;
							$this->session->set_flashdata('error', $flash_feedback);
						}
						// redirection vers la page records
						redirect('/records/');
					} else {
						// sauvegarde de l'enregistrement avant modification
						$this->records_model->backup_it($uid);
						// premiÃ¨re requÃªte de modification
						$affected_rows = $this->all_model->update_ligne('input', $data, 'uid', $uid);
						if ($affected_rows == 1) {
							// champs remplis automatiquement
							$data['revised_on']		= now();
							$data['revised_by']		= $this->session->userdata('user_name');
							// mise Ã  jour de l'historique
							$data['history']			= $this->records_model->update_history($data);
							// deuxiÃ¨me requÃªte de modification
							if (($this->all_model->update_ligne('input', $data, 'uid', $uid)) == 1) {
								// message de confirmation
								$flash_feedback = lang('info_the_site') . $data['first_name'] . lang('info_has_been_updated');
								$this->session->set_flashdata('good', $flash_feedback);
							} else {
								// message d'erreur
								
							}
						} else {
							// message de warning
							$flash_feedback = lang('info_no_update') ;
							$this->session->set_flashdata('warning', $flash_feedback);
						}
						// redirection vers la page detail
						redirect('/records/detail/'.$uid);
					}
				}
			break;
		}
	}
	
	/* ##################################################################
	----------			POPUP :: ./records/keywords_edit			  ----------
	################################################################## */
	public function keywords_edit($uid) {
		// acquisition de la ligne concernÃ©e
		$data['record'] = $this->all_model->get_fullrow('input', 'uid', $uid);
		if (empty($data['record'])) {
			show_404();
		}
		$data['bandeau'] = lang('wording_keywords_for') . $data['record']['first_name'] . " " . $data['record']['last_name'];
		$data['body_tag'] = "<body onload=\"setTimeout('self.close();',30*1000)\">\r\n";
		$itemid = $data['record']['itemid'];
		$data['record']['groupe'] = $this->records_model->get_group_by_id($data['record']['groupid']);
		$data['titre'] = "<div class=\"entete\"><span class=\"gris\">" . lang('wording_keywords_for') . "</span><br />" . $data['record']['first_name'] . " " . $data['record']['last_name'] . " <em>( " .  $data['record']['groupe'] . " )</em></div>\r\n";
		$data['corps']  = "<p class=\"fbox info\">" . lang('wording_current_keywords_are') . "<br />&nbsp;<br /><strong>" . $data['record']['keywords'] . "</strong></p>\r\n";
		$data['corps'] .= "<p class=\"prose\">" . lang('wording_use_this_form_to_update') . "</p>\r\n";
		$data['corps'] .= "<form  method=\"post\" action=\"" . base_url('index.php/records/keywords_save/'.$data['record']['uid']) . "\" name=\"keywords\">\r\n";
		$data['corps'] .= "<input type=\"text\" name=\"keywords\" value=\"" . $data['record']['keywords'] . "\" size=\"48\" style=\"font-family:Courier New;font-size:12px;height:16px;margin-left:20px;\" maxlength=\"128\"/><br />\r\n";
		$data['corps'] .= "<input type=\"submit\" value=\"" . lang('label_save') . "\"  style=\"margin-left:20px;\" />\r\n";
		$data['corps'] .= "</form>\r\n";
		$data['corps'] .= "<p class=\"prose\">" . lang('wording_keywords_informations') . "</p>\r\n";
		$data['corps'] .= "";
		// affichage de la vue
		$this->load->view('templates/popup_vue', $data);
	}
	
	/* ##################################################################
	----------			POPUP :: ./records/keywords_save			  ----------
	################################################################## */
	public function keywords_save($uid) {
		// acquisition de la ligne concernÃ©e
		$data['record'] = $this->all_model->get_fullrow('input', 'uid', $uid);
		if (empty($data['record'])) {
			show_404();
		}
		$old_keywords = $data['record']['keywords'];
		$old_history  = $data['record']['history'];
		$data['bandeau'] = lang('wording_keywords_for') . $data['record']['first_name'] . " " . $data['record']['last_name'];
		$data['body_tag'] = "<body onload=\"setTimeout('self.close();',10*1000)\" onunload=\"self.opener.location.reload();\">\r\n";
		$itemid = $data['record']['itemid'];
		$data['record']['groupe'] = $this->records_model->get_group_by_id($data['record']['groupid']);
		$data['titre'] = "<div class=\"entete\"><span class=\"gris\">" . lang('wording_keywords_for') . "</span><br />" . $data['record']['first_name'] . " " . $data['record']['last_name'] . " <em>( " .  $data['record']['groupe'] . " )</em></div>\r\n";
		$data['corps'] = "";
		$new_keywords = $new_data['keywords'] = $this->input->post('keywords');
		// premiÃ¨re requÃªte de modification
		$affected_rows = $this->all_model->update_ligne('input', $new_data, 'uid', $uid);
		if ($affected_rows == 1) {
			$new_data['revised_on']		= now();
			$revised_on = unix_to_human($new_data['revised_on'] + 7200, TRUE, 'eu');
			$new_data['revised_by']		= $this->session->userdata('user_name');
			// mise Ã  jour de l'historique
			$historic  = "##### " . lang('info_revised_on') . $revised_on . lang('wording_by') . $new_data['revised_by'] . " #####\r\n" ;
			$historic .= lang('wording_keywords') . $old_keywords . " >>> " . $new_keywords . "\r\n" ;
			$new_data['history'] = $historic . "\r\n" . $old_history ; 
			// deuxiÃ¨me requÃªte de modification
			if (($this->all_model->update_ligne('input', $new_data, 'uid', $uid)) == 1) {
				// message de confirmation
				$data['corps'] .= "<br /><p class=\"fbox good\">" . lang('info_new_keywords_saved') . "</p>\r\n";
			} else {
				// message d'erreur
				
			}
		} else {
			// message de warning
			$data['corps'] .= "<br /><p class=\"fbox warning\">" . lang('info_no_update') . "<br />&nbsp;</p>\r\n";
		}
		$data['corps'] .= "<p class=\"prose\">" . lang('wording_here_is_summary') . "</p>\r\n";
		$data['corps'] .= "<p class=\"fbox info\">" . lang('wording_before') . $old_keywords . "<br />" . lang('wording_after') . $new_keywords . "</p>\r\n";
		// affichage de la vue
		$this->load->view('templates/popup_vue', $data);
	}
	
	/* ##################################################################
	----------			PAGE :: ./records/group_list				  ----------
	################################################################## */
	public function group_liste($itemid) {
		// restriction d'accÃ¨s au script
		if ($this->session->userdata('user_rights') != "SuperAdmin") {
			$data['bandeau'] = 'forbidden access';
			$this->load->view('templates/forbidden', $data);
		} else {
			$category = $this->records_model->name_category($itemid);
			$data['bandeau'] = $category . " : " . lang('title_manage_groups');
			$data['titre'] = $this->all_model->add_nav_to_title($data['bandeau'] . " &nbsp; &nbsp; <img src=\"".base_url('resource/img/actions/add.png')."\" alt=\"add_group\" width=\"44\" height=\"24\" title=\"".lang('action_add_group')."\" onclick=\"popup_add('" . base_url('index.php/records/group_add/'.$itemid) . "')\" />");
			// acquisition des groupes de la catÃ©gorie concernÃ©e
			$data['groupes'] = $this->records_model->get_groups_liste($itemid);
			// affichage du rÃ©sultat
			$this->load->view('records/group_liste', $data);
		}
	}
	
	/* ##################################################################
	----------			POPUP :: ./records/group_add				  ----------
	################################################################## */
	public function group_add() {
		// rÃ©cupÃ©ration de la catÃ©gorie dans l'url
		$itemid = $this->uri->segment(3);
		$category = $this->records_model->name_category($itemid);
		// collecte des infos Ã  envoyer Ã  la vue
		$data['bandeau'] = lang('title_add_group_in') . $category;
		$data['body_tag'] = "<body onload=\"setTimeout('self.close();',30*1000)\">\r\n";
		$data['titre'] = "<div class=\"entete\">" . lang('title_add_group_in') . "<br /><em>" . $category . "</em></div>\r\n";
		$data['corps'] = "<p class=\"prose\">&nbsp;<br />" . lang('label_new_group') . "</p>\r\n";
		// fabrication du formulaire
		$data['corps'] .= "<form  method=\"post\" action=\"" . base_url('index.php/records/group_save/not_set/') . "\" name=\"group_add\">\r\n";
		$data['corps'] .= "<input type=\"hidden\" name=\"itemid\" value=\"" . $itemid . "\" />\r\n";
		$data['corps'] .= "<input type=\"text\" name=\"wording\" value=\"\" size=\"30\" style=\"font-family:Courier New;font-size:12px;height:16px;margin-left:20px;\" maxlength=\"24\"/><br />\r\n";
		$data['corps'] .= "<input type=\"submit\" value=\"" . lang('label_save') . "\" style=\"margin-left:50px;\" />\r\n";
		$data['corps'] .= "</form>\r\n";
		// affichage de la vue
		$this->load->view('templates/popup_vue', $data);
	}
	
	/* ##################################################################
	----------			POPUP :: ./records/group_edit				  ----------
	################################################################## */
	public function group_edit($gid) {
		// recherche du groupe concernÃ©
		$group = $this->records_model->get_group_by_id($gid);
		$itemid = $this->records_model->get_category_of_group($gid);
		$category = $this->records_model->name_category($itemid);
		// collecte des infos Ã  envoyer Ã  la vue
		$data['bandeau'] = lang('title_group_wording_update');
		$data['body_tag'] = "<body onload=\"setTimeout('self.close();',30*1000)\">\r\n";
		$data['titre'] = "<div class=\"entete\"><span class=\"gris\">" . $category . " :</span><br />" . lang('title_group_wording_update') . "</div>\r\n";
		$data['corps']  = "<p class=\"fbox info\">" . lang('wording_current') . "<br /><strong>" . $group . "</strong></p>\r\n";
		$data['corps'] .= "<p class=\"prose\">&nbsp;<br />" . lang('wording_new') . "</p>\r\n";
		// fabrication du formulaire
		$data['corps'] .= "<form  method=\"post\" action=\"" . base_url('index.php/records/group_save/'.$gid) . "\" name=\"group_edit\">\r\n";
		$data['corps'] .= "<input type=\"text\" name=\"wording\" value=\"" . $group . "\" size=\"30\" style=\"font-family:Courier New;font-size:12px;height:16px;margin-left:20px;\" maxlength=\"24\"/><br />\r\n";
		$data['corps'] .= "<input type=\"submit\" value=\"" . lang('label_save') . "\" style=\"margin-left:50px;\" />\r\n";
		$data['corps'] .= "</form>\r\n";
		
		// affichage de la vue
		$this->load->view('templates/popup_vue', $data);
	}
	
	/* ##################################################################
	----------			POPUP :: ./records/group_save				  ----------
	################################################################## */
	public function group_save($gid) {
		// sÃ©lection du mode (crÃ©ation ou modification)
		if ($gid != 'not_set') {
			// modification : recherche du groupe concernÃ©
			$group = $this->records_model->get_group_by_id($gid);
			$itemid = $this->records_model->get_category_of_group($gid);
			$category = $this->records_model->name_category($itemid);
			// collecte des infos Ã  envoyer Ã  la vue
			$data['bandeau'] = lang('title_group_wording_update') ;
			$data['body_tag'] = "<body onload=\"setTimeout('self.close();',30*1000)\" onunload=\"self.opener.location.reload();\">\r\n";
			$data['titre'] = "<div class=\"entete\"><span class=\"gris\">" . $category . " :</span><br />" . lang('title_group_wording_update') . "</div>\r\n";
			$new_group = $new_data['wording'] = $this->input->post('wording');
			$data['corps'] = "";
			// requÃªte de modification
			if (($this->all_model->update_ligne('group', $new_data, 'gid', $gid)) == 1) {
				// message de confirmation
				$data['corps'] .= "<br /><p class=\"fbox good\">" . lang('info_new_wording_saved') . "<br />&nbsp;</p>\r\n";
			} else {
				// message de warning
				$data['corps'] .= "<br /><p class=\"fbox warning\">" . lang('info_no_update') . "<br />&nbsp;</p>\r\n";
			}
			// message rÃ©capitulatif
			$data['corps'] .= "<p class=\"prose\">" . lang('wording_here_is_summary') . "</p>\r\n";
			$data['corps'] .= "<p class=\"fbox info\">" . lang('wording_before') . $group . "<br />" . lang('wording_after') . $new_group . "</p>\r\n";
			// affichage de la vue
			$this->load->view('templates/popup_vue', $data);
		} else {
			// crÃ©ation : rÃ©cupÃ©ration des infos passÃ©es en _POST
			$itemid  = $data['group_itemid'] = $this->input->post('itemid');
			$wording = $data['wording']      = $this->input->post('wording');
			// insertion du nouveau groupe
			$this->all_model->add_ligne('group', $data) ;
			// message de confirmation dans la fenÃªtre popup
			$data['bandeau'] = lang('action_add_group');
			$data['body_tag'] = "<body onload=\"setTimeout('self.close();',10*1000)\" onunload=\"self.opener.location.reload();\">\r\n";
			$category = $this->records_model->name_category($itemid);
			$data['titre'] = "<div class=\"entete\">" . lang('title_add_group_in') . "<br /><em>" . $category . "</em></div>\r\n";
			$data['corps'] = "<br /><p class=\"fbox good\">" . lang('info_the_group') . $wording . lang('info_has_been_added') . "<br />&nbsp;</p>\r\n";
			// affichage de la vue
			$this->load->view('templates/popup_vue', $data);
		}
	}
	
	/* ##################################################################
	----------		PAGE :: ./records/group_delete_request			  ----------
	################################################################## */
	public function group_delete_request($gid) {
		// recherche du groupe concernÃ©
		$group = $this->records_model->get_group_by_id($gid);
		$itemid = $this->records_model->get_category_of_group($gid);
		$category = $this->records_model->name_category($itemid);
		// collecte des infos Ã  envoyer Ã  la vue
		$data['bandeau'] = lang('action_delete_group') . " : " . $group ;
		$data['titre'] = $this->all_model->add_nav_to_title("<span class=\"gris_moyen\">" . $category . " : </span>" . lang('action_delete_group') . " : <br />" . $group);
		// recherche des enregistrements Ã©ventuels liÃ©s Ã  ce groupe
		$data['linked_records'] = $this->records_model->get_linked_records($gid);
		$data['linked_records_qty'] = count($data['linked_records']);
		if ($data['linked_records_qty'] > 0) {
			// message d'erreur + affichage des enregistrements liÃ©s
			$data['feedback'] = "<p class=\"fbox error\">" . lang('error_delete_group') . $data['linked_records_qty'] . lang('error_group_linked_to') . "</p>\r\n";
		} else {
			// message informatif + lien pour concrÃ©tiser la suppression
			$data['feedback']  = "<p class=\"fbox info\">" . lang('info_group_is_deletable') . "</p>\r\n";
			$data['feedback'] .= "<h4>&nbsp;</h4><h4 style=\"text-align: center;\">" . lang('wording_please_click') . anchor('/records/group_delete/'.$gid, lang('wording_here'), array('title' => lang('action_delete'))) . lang('wording_to_confirm') . "</h4>\r\n";
		}
		// affichage de la vue
		$this->load->view('records/group_linked', $data);
	}
	
	/* ##################################################################
	----------			PAGE :: ./records/group_delete			  ----------
	################################################################## */
	public function group_delete($gid) {
		// recherche du groupe concernÃ©
		$group = $this->records_model->get_group_by_id($gid);
		$itemid = $this->records_model->get_category_of_group($gid);
		$category = $this->records_model->name_category($itemid);
		// collecte des infos Ã  envoyer Ã  la vue
		$data['bandeau'] = lang('action_delete_group') . " : " . $group ;
		$data['titre'] = $this->all_model->add_nav_to_title("<span class=\"gris_moyen\">" . $category . " : </span>" . lang('action_delete_group') . " : <br />" . $group);
		// Suppression du groupe et redirection vers la page qui liste les groupes de cette catÃ©gorie
		if ($this->all_model->delete_ligne('group', 'gid', $gid)) {
			// message de confirmation
			$flash_feedback = lang('info_the_group') . $group . lang('info_has_been_deleted');
			$this->session->set_flashdata('good', $flash_feedback);
		}
		redirect('/records/group_liste/'.$itemid);
	}
	
	/* ##################################################################
	----------				PAGE :: ./records/most					  ----------
	################################################################## */
	public function most($start = 0) {
		$data['bandeau'] = lang('search_result');
		$data['titre'] = $this->all_model->add_nav_to_title($data['bandeau']);
		$data['current_user_rights'] = $this->session->userdata('user_rights');
		// rÃ©cupÃ©ration des paramÃ¨tres dans l'url
		$most = $this->uri->segment(3, 'recent');
		$itemid = $this->uri->segment(4, 0);
		// prÃ©vention contre une fausse url
		if (($most != 'recent') and ($most != 'visited')) {								// Ã  complÃ©ter !!!
			show_404();
		}
		// mise en place de la pagination
		$start = $this->uri->segment(5, 0);
		$data['qty_per_page'] = $this->config->item('appli_qty_per_page');
		$this->load->library('pagination');
		// configuration de la pagination
		$pagination_settings['base_url'] = base_url('index.php/records/most/' . $most . '/' . $itemid . '/') ;
		$pagination_settings['total_rows'] = $data['total_rows'] = $this->records_model->count_most_records($itemid);
		$pagination_settings['per_page'] = $data['qty_per_page'];
		$pagination_settings['uri_segment'] = 5;
		$pagination_settings['full_tag_open'] = "\t\t\t<h2 style=\"text-align:center\">";
		$pagination_settings['full_tag_close'] = "</h2>\r\n";
		$pagination_settings['first_link'] = "<img src=\"".base_url('resource/img/actions/first.png')."\" width=\"44\" height=\"24\" alt=\"first\" title=\"".lang('action_first')."\" />";
		$pagination_settings['prev_link'] = "<img src=\"".base_url('resource/img/actions/previous.png')."\" width=\"44\" height=\"24\" alt=\"previous\" title=\"".lang('action_previous')."\" />";
		$pagination_settings['next_link'] = "<img src=\"".base_url('resource/img/actions/next.png')."\" width=\"44\" height=\"24\" alt=\"next\" title=\"".lang('action_next')."\" />";
		$pagination_settings['last_link'] = "<img src=\"".base_url('resource/img/actions/last.png')."\" width=\"44\" height=\"24\" alt=\"last\" title=\"".lang('action_last')."\" />";
		// acquisition d'un paquet de [$qty_per_page] enregistrements en commenÃ§ant Ã  [$start]
		$data['records'] = $this->records_model->get_most_records($pagination_settings['per_page'], $start, $most, $itemid);
		// sortie de la pagination en html
		$this->pagination->initialize($pagination_settings);
		$data['pagination'] = $this->pagination->create_links();
		// affichage du rÃ©sultat
		$this->load->view('records/liste', $data);
	}
	
	/* ##################################################################
	----------				POPUP :: ./records/history				  ----------
	################################################################## */
	public function history($uid) {
		// acquisition des infos de l'enregistrment
		$data['record'] = $this->all_model->get_fullrow('input', 'uid', $uid);
		if (empty($data['record'])) {
			show_404();
		}
		$data['bandeau'] = $data['record']['first_name'] . " " . $data['record']['last_name'];
		$data['body_tag'] = "<body onload=\"setTimeout('self.close();',60*1000)\">\r\n";
		$itemid = $data['record']['itemid'];
		$data['record']['groupe'] = $this->records_model->get_group_by_id($data['record']['groupid']);
		$data['titre'] = "<div class=\"entete\"><span class=\"gris\">[ " . $this->records_model->name_category($data['record']['itemid']) . " ] &gt; " . lang('title_history_for') . "</span><br />" . $data['record']['first_name'] . " " . $data['record']['last_name'] . " <em>( " .  $data['record']['groupe'] . " )</em></div><br />\r\n";
		$data['corps'] = "<p class=\"prose\">" . nl2br($data['record']['history']) . "</p><br />\r\n";
		// affichage de la vue
		$this->load->view('templates/popup_vue', $data);
	}
	
	/* ##################################################################
	----------			POPUP :: ./records/print_etic_exp		  ----------
	################################################################## */
	public function print_etic_exp($uid) {
		// acquisition des infos expÃ©diteur
		$sender    = $this->all_model->get_fullrow('user', 'user_id', $this->session->userdata('user_id'));
		// acquisition des infos destinataire
		$recipient = $this->all_model->get_fullrow('input', 'uid', $uid);
		$recipient['country'] = $this->all_model->get_field_by_id('country', 'country_fr', 'country_id', $recipient['country_id']);
		if (empty($recipient)) {
			show_404();
		}
		// incrÃ©mentation du champ clicks du destinataire
		$this->all_model->increment_field('input', 'clicks', 'uid', $uid, 1);
		$data['bandeau'] = lang('label_sticker') . $recipient['first_name'] . " " . $recipient['last_name'];
		$data['css'] = "		#contour, #sender, #receiver {
			border-width: 1px;
			border-radius:10px 10px 10px 10px;
			-moz-border-radius:10px 10px 10px 10px;
			-webkit-border-radius:10px 10px 10px 10px;
		}
		#contour {
			position: relative;
			padding: 10px;
			width: 600px;
			height: 290px;
			margin-top: 2px;
			border-width: 6px;
			border-style: double;
			border-color: black;
		}
		#sender_title {
			position: relative;
			width: 180px;
			height: 15px;
			font-style: italic;
			padding-left: 10px;
		}
		#sender {
			position: relative;
			width: 200px;
			height: 50px;
			padding: 8px 0 0 6px;
			border-style: groove;
			border-color: #888888;
		}
		#sender_title, #sender {
			font-family: Arial, Helvetica, sans-serif;
			font-size: 12px;
			line-height: 14px;
			color: #888888;
		}
		#receiver_title {
			position: relative;
			margin-top: 50px;
			margin-left: 180px;
			width: 380px;
			height: 20px;
			text-align: right;
			font-style: italic;
			padding-right: 15px;
		}
		#receiver {
			position: relative;
			margin-left: 180px;
			width: 380px;
			padding: 10px;
			border-style: solid;
			border-color: black;
		}
		#receiver_title, #receiver {
			font-family:Verdana, Arial, Helvetica, sans-serif;
			font-size: 16px;
			line-height: 22px;
			color: #000000;
		}\r\n";
		$data['body_tag'] = "<body onload=\"setTimeout('self.close();',90*1000)\">\r\n";
		$data['titre'] = $data['corps'] = "";
		$data['corps'] .= "\t<div id=\"contour\">\r\n\t\t<div id=\"sender_title\">" . lang('wording_sender') . "</div>\r\n";
		$data['corps'] .= "\t\t<div id=\"sender\">" . $sender['user_first_name'] . " " . $sender['user_last_name'] . "<br />" . $sender['user_address'] . "<br />" . $sender['user_postcode'] . " " . $sender['user_city'] . "</div>\r\n";
		$data['corps'] .= "\t\t<div id=\"receiver_title\">" . lang('wording_recipient') . "</div>\r\n";
		if ($recipient['title'] == "") $data['corps'] .= "\t\t<div id=\"receiver\"><strong>" . $recipient['first_name'] . " " . $recipient['last_name'] . "</strong><br />";
		else $data['corps'] .= "\t\t<div id=\"receiver\"><strong>" . $recipient['title'] . " " . $recipient['first_name'] . " " . $recipient['last_name'] . "</strong><br />";
		$data['corps'] .= $recipient['adress1'] . "<br />" . $recipient['adress2'] . "<br />" . $recipient['postcode'] . " <strong>" . $recipient['city'] . "<br />" . $recipient['country'] . "</strong></div>\r\n\t</div>\r\n";
		// affichage de la vue
		$this->load->view('templates/popup_vue', $data);
	}
	
	/* ##################################################################
	----------			POPUP :: ./records/print_note				  ----------
	################################################################## */
	public function print_note($uid) {
		// acquisition des infos de l'enregistrment
		$record = $this->all_model->get_fullrow('input', 'uid', $uid);
		if (empty($record)) {
			show_404();
		}
		// incrÃ©mentation du champ clicks
		$this->all_model->increment_field('input', 'clicks', 'uid', $uid, 1);
		$data['bandeau'] = lang('action_print_note') . " : " . $record['first_name'] ;
		$data['body_tag'] = "<body onload=\"setTimeout('self.close();',60*1000)\">\r\n";
		$itemid = 2;
		$record['groupe'] = $this->records_model->get_group_by_id($record['groupid']);
		$data['titre'] = "<div class=\"entete\">" . $record['first_name'] . " <em>( " .  $record['groupe'] . " )</em></div><br />\r\n";
		$note_content = str_replace('<', '&lt;', $record['memo']);
		$note_content = str_replace('>', '&gt;', $note_content);
		$data['corps'] = "<p class=\"prose\">" . nl2br($note_content) . "</p><br />\r\n";
		// affichage de la vue
		$this->load->view('templates/popup_vue', $data);
	}
	
	/* ##################################################################
	----------				POPUP :: ./records/photo				  ----------
	################################################################## */
	public function photo($mode, $uid) {
		// restriction d'accÃ¨s au script
		if ($this->session->userdata('user_rights') == "ReadOnly") {
			$this->load->view('templates/popup_forbidden');
		} else {
			$data['body_tag'] = "<body onload=\"setTimeout('self.close();',3*60*1000)\">\r\n";
			$data['corps'] = '';
			if ($mode == 'upload') {
				$data['bandeau']  = lang('action_upload_photo') ;
				$data['titre'] = "<div class=\"entete\">" . lang('action_upload_photo') . "</div>\r\n";
			} elseif ($mode == 'exchange') {
				$data['bandeau']  = lang('action_change_photo') ;
				$data['titre'] = "<div class=\"entete\">" . lang('action_change_photo') . "</div>\r\n";
				// avertissement Ã  propos de l'effacement de la photo prÃ©cÃ©dente
				$data['corps'] .= "<p class=\"fbox warning\">" . lang('wording_caution_photo_delete') . "</p>\r\n";
			}
			$data['corps'] .= "<p class=\"prose\">" . lang('label_select_file') . "</p>\r\n";
			$data['corps'] .= form_open_multipart('records/upload_photo/'.$uid) . "\r\n";
			$data['corps'] .= "<input type=\"hidden\" name=\"mode\" value=\"" . $mode . "\" />\r\n";
			$data['corps'] .= "<input type=\"file\" name=\"userfile\" size=\"32\" style=\"background-color:#cccccc;font-family:Courier New;font-size:12px;height:24px;margin-left:20px;\" maxlength=\"128\"/><br />\r\n";
			$data['corps'] .= "<input type=\"submit\" value=\"" . lang('label_send') . "\" style=\"margin-left:20px;\" />\r\n";
			$data['corps'] .= "</form>\r\n";
			$data['corps'] .= "<p class=\"prose\">" . lang('wording_image_informations') . "</p>\r\n";
			// affichage de la vue
			$this->load->view('templates/popup_vue', $data);
		}
	}
	
	/* ##################################################################
	----------			POPUP :: ./records/upload_photo			  ----------
	################################################################## */
	public function upload_photo($uid) {
		$mode = $this->input->post('mode');
		// acquisition de l'itemid de l'enregistrment
		$ligne = $this->all_model->get_fullrow('input', 'uid', $uid);
		if (empty($ligne)) {
			show_404();
		}
		$itemid = $ligne['itemid'];
		$data['corps'] = "";
		if ($mode == 'upload') {
			$data['bandeau']  = lang('action_upload_photo') ;
			$data['titre'] = "<div class=\"entete\">" . lang('action_upload_photo') . "</div>\r\n";
		} elseif ($mode == 'exchange') {
			$data['bandeau']  = lang('action_change_photo') ;
			$data['titre'] = "<div class=\"entete\">" . lang('action_change_photo') . "</div>\r\n";
			// effacement de la photo prÃ©cÃ©dente avec message informatif
			if ($this->records_model->photo_file_delete($itemid, $uid)) {
				$data['corps'] .= "<br /><p class=\"fbox info\">" . lang('info_previous_photo_deleted') . "<br />&nbsp;</p>\r\n";
			}
		}
		// configuration et chargement de la librairie upload
		if ($itemid == 1) $config['upload_path'] = './upload/pics/adrbook/' ;
		if ($itemid == 3) $config['upload_path'] = './upload/pics/document/' ;
		if ($itemid == 4) $config['upload_path'] = './upload/pics/weblog/' ;
		$config['file_name']				= 'pic-' . $itemid . '-' . $uid ;
		$config['allowed_types']		= 'gif|jpg|png';
		$config['max_size']				= '50';
		$config['max_width']				= '270';
		$config['max_height']			= '360';
		$this->load->library('upload', $config);
		// transfert du fichier proposÃ©
		if ( ! $this->upload->do_upload()) {
			$error = array('error' => $this->upload->display_errors('', ''));
			$data['body_tag'] = "<body onload=\"setTimeout('self.close();',30*1000)\">\r\n";
			// message de warning
			$error_message = "";
			foreach ($error as $item => $value) {
				$error_message .= $item . " : " . $value . "<br />\r\n";
			}
			$data['corps'] .= "<br /><p class=\"fbox warning\">" . $error_message . "</p>\r\n";
		} else {
			$data['body_tag'] = "<body onload=\"setTimeout('self.close();',10*1000)\" onunload=\"self.opener.location.reload();\">\r\n";
			// message de confirmation
			$data['corps'] .= "<br /><p class=\"fbox good\">" . lang('info_photo_uploaded_good') . "<br />&nbsp;</p>\r\n";
		}
		// affichage de la vue
		$this->load->view('templates/popup_vue', $data);
	}
	
	
	
	
	
}

/* End of file records.php */
/* Location: ./application/controllers/records.php */