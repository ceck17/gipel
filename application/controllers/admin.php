<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	
	// constructeur
	public function __construct() {
		parent::__construct();
		// chargement divers
		$this->load->model('all_model');
		$this->lang->load('gipel');
		
		// contrÃ´le d'accÃ¨s
		if (!$this->control->ask_access()) {
			// utilisateur NON authentifiÃ©
			$curr_uri_string = uri_string();
			if ($curr_uri_string != 'admin/index') {
				redirect('home/login');
			}
		}
		
	}
	
	/* ##################################################################
	----------				PAGE :: ./admin/index					  ----------
	################################################################## */
	public function index() {
		// restriction d'accÃ¨s au script
		if ($this->session->userdata('user_rights') != "SuperAdmin") {
			$data['bandeau'] = 'forbidden access';
			$this->load->view('templates/forbidden', $data);
		} else {
			$data['bandeau'] = lang('nav_section_admin');
			$data['titre'] = $this->all_model->add_nav_to_title($data['bandeau']);
			// affichage de la vue
			$this->load->view('admin/index', $data);
		}
	}
	
	/* ##################################################################
	----------			PAGE :: ./admin/create_account			  ----------
	################################################################## */
	public function create_account() {
		// restriction d'accÃ¨s au script
		if ($this->session->userdata('user_rights') != "SuperAdmin") {
			$data['bandeau'] = 'forbidden access';
			$this->load->view('templates/forbidden', $data);
		} else {
			$data['bandeau'] = lang('nav_create_account');
			$data['titre'] = $this->all_model->add_nav_to_title($data['bandeau']);
			// mode de fonctionnement du formulaire
			$data['mode'] = 'creation';
			// affichage de la vue
			$this->load->view('admin/user_form', $data);
		}
	}
	
	/* ##################################################################
	----------			PAGE :: ./admin/save_account				  ----------
	################################################################## */
	public function save_account() {
		// restriction d'accÃ¨s au script
		if ($this->session->userdata('user_rights') != "SuperAdmin") {
			$data['bandeau'] = 'forbidden access';
			$this->load->view('templates/forbidden', $data);
		} else {
			// rÃ©cupÃ©ration des donnÃ©es passÃ©es en post
			$mode								= $this->input->post('mode');
			$data['user_rights']			= $this->input->post('user_rights');
			if ($mode == 'creation') {
				$data['user_username']		= $this->input->post('user_username');
				// contrÃ´le d'unicitÃ© avant crÃ©ation
				if ($this->admin_model->oneness_control($data['user_username']) == TRUE) {
					// champs remplis automatiquement
					$data['user_password_md5']		= md5($this->config->item('appli_provisory_password'));
					$data['user_make_date']			= now() + 7200;
					$data['user_history']			= "--o-- " . lang('info_maked_on') . unix_to_human(now() + 7200, TRUE, 'eu') . " --o--\r\n" ;
					// requÃªte d'insertion
					$new_id = $this->all_model->add_ligne('user', $data) ;
					if (is_numeric($new_id)) {
						$data = $this->all_model->get_fullrow('user', 'user_id', $new_id);
						// message de confirmation
						$flash_feedback = lang('info_the_account') . $data['user_username'] . lang('info_has_been_added') ;
						$this->session->set_flashdata('good', $flash_feedback);
					} else {
						// message d'erreur
						
					}
					// redirection vers la page manage_accounts
					redirect('/admin/manage_accounts/');
				} else {
					// message d'erreur
					$flash_feedback = lang('error_user_existing');
					$this->session->set_flashdata('error', $flash_feedback);
				}
				// redirection vers la page index
				redirect('/admin/index/');
			} else {
				$user_id = $this->input->post('user_id');
				// premiÃ¨re requÃªte de modification
				$affected_rows = $this->all_model->update_ligne('user', $data, 'user_id', $user_id);
				if ($affected_rows == 1) {
					// champs remplis automatiquement
					$data['user_revised_date'] = now() + 7200;
					// mise Ã  jour de l'historique
					$user_history = $this->input->post('user_history');
					$historic = "Rights -ooo- " . lang('info_revised_on') . unix_to_human(now() + 7200, TRUE, 'eu') . " -ooo-\r\n" ;
					$data['user_history'] = $historic . "\r\n" . $user_history ;
					// deuxiÃ¨me requÃªte de modification
					if (($this->all_model->update_ligne('user', $data, 'user_id', $user_id)) == 1) {
						// message de confirmation
						$flash_feedback = lang('info_the_account') . $this->input->post('user_username') . lang('info_has_been_updated') ;
						$this->session->set_flashdata('good', $flash_feedback);
					} else {
						// message d'erreur
						
					}
				} else {
					// message de warning
					$flash_feedback = lang('info_no_update');
					$this->session->set_flashdata('warning', $flash_feedback);
				}
				// redirection vers la page manage_accounts
				redirect('/admin/manage_accounts/');
			}
		}
	}
	
	/* ##################################################################
	----------			PAGE :: ./admin/manage_accounts			  ----------
	################################################################## */
	public function manage_accounts() {
		// restriction d'accÃ¨s au script
		if ($this->session->userdata('user_rights') != "SuperAdmin") {
			$data['bandeau'] = 'forbidden access';
			$this->load->view('templates/forbidden', $data);
		} else {
			$data['bandeau'] = lang('nav_manage_accounts');
			$data['titre'] = $this->all_model->add_nav_to_title($data['bandeau']);
			// acquisition de la liste des utilisateurs
			$data['users'] = $this->admin_model->get_users_liste();
			// affichage du rÃ©sultat
			$this->load->view('admin/user_list', $data);
		}
	}
	
	/* ##################################################################
	----------			PAGE :: ./admin/set_rights					  ----------
	################################################################## */
	public function set_rights($user_id) {
		// restriction d'accÃ¨s au script
		if ($this->session->userdata('user_rights') != "SuperAdmin") {
			$data['bandeau'] = 'forbidden access';
			$this->load->view('templates/forbidden', $data);
		} else {
			// acquisition de la ligne concernÃ©e
			$data['user'] = $this->all_model->get_fullrow('user', 'user_id', $user_id);
			$data['bandeau'] = lang('title_set_rights') . $data['user']['user_username'];
			$data['titre'] = $this->all_model->add_nav_to_title($data['bandeau']);
			// mode de fonctionnement du formulaire
			$data['mode'] = 'edit';
			// affichage de la vue
			$this->load->view('admin/user_form', $data);
		}
	}
	
	/* ##################################################################
	----------			PAGE :: ./admin/user_detail				  ----------
	################################################################## */
	public function user_detail($user_id) {
		// restriction d'accÃ¨s au script
		if ($this->session->userdata('user_rights') != "SuperAdmin") {
			$data['bandeau'] = 'forbidden access';
			$this->load->view('templates/forbidden', $data);
		} else {
			// acquisition de la ligne concernÃ©e
			$user = $this->all_model->get_fullrow('user', 'user_id', $user_id);
			$data['bandeau'] = $user['user_username'];
			$data['titre'] = $this->all_model->add_nav_to_title(lang('title_detail_of') . $user['user_username']);
			// collecte des infos Ã  afficher
			$country = $this->all_model->get_field_by_id('country', 'country_fr', 'country_id', $user['user_country_id']);
			$data['corps']  = "\t\t\t<p style=\"margin-left:250px;\">" . $user['user_first_name'] . " " . $user['user_last_name'] . "<br />\r\n" ;
			$data['corps'] .= "\t\t\t" . $user['user_address'] . "<br />\r\n" ;
			$data['corps'] .= "\t\t\t" . $user['user_postcode'] . " " . $user['user_city'] . " (" . $country . ")</p>\r\n" ;
			
			$data['corps'] .= "\t\t\t<p>email = " . $user['user_email'] . " | rights = " . $user['user_rights'] . " | ip = " . $user['user_ip'] . " | logs = " . $user['user_logs'] . "</p>\r\n" ;
			
			$data['corps'] .= "\t\t\t<textarea style=\"font-size:12px;margin-left:90px;\" name=\"historic\" rows=\"5\" cols=\"60\" readonly=\"readonly\">" . $user['user_history'] . "</textarea>\r\n" ;
			// affichage de la vue
			$this->load->view('admin/detail', $data);
		}
	}
	
	/* ##################################################################
	----------		POPUP :: ./admin/user_delete_request		  ----------
	################################################################## */
	public function user_delete_request($user_id) {
		// restriction d'accÃ¨s au script
		if ($this->session->userdata('user_rights') != "SuperAdmin") {
			$this->load->view('templates/popup_forbidden');
		} else {
			// acquisition de la ligne concernÃ©e
			$user = $this->all_model->get_fullrow('user', 'user_id', $user_id);
			if (empty($user)) {
				show_404();
			}
			$data['bandeau'] = lang('action_delete') . " : " . $user['user_username'];
			$data['body_tag'] = "<body onload=\"setTimeout('self.close();',10*1000)\">\r\n";
			$data['titre'] = "<div class=\"entete\"><span class=\"gris\">" . lang('action_delete') . " : </span>" . $user['user_username'] . "</div>\r\n";
			if ($user['user_rights'] == 'SuperAdmin') {
				$data['corps']  = "<p class=\"fbox error\">" . lang('error_admin_undeletable') . "</p>\r\n";
			} else {
				$data['corps']  = "<p class=\"fbox warning\">" . lang('wording_caution_delete_request') . "</p>\r\n";
				$data['corps'] .= "<p class=\"prose\">" . lang('wording_please_click') . anchor('/admin/user_delete/'.$user_id, lang('wording_here'), array('title' => lang('action_delete'))) . lang('wording_to_confirm') . "</p>\r\n";
			}
			// affichage de la vue
			$this->load->view('templates/popup_vue', $data);
		}
	}
	
	/* ##################################################################
	----------			POPUP :: ./admin/user_delete				  ----------
	################################################################## */
	public function user_delete($user_id) {
		// restriction d'accÃ¨s au script
		if ($this->session->userdata('user_rights') != "SuperAdmin") {
			$this->load->view('templates/popup_forbidden');
		} else {
			// acquisition de la ligne concernÃ©e
			$user = $this->all_model->get_fullrow('user', 'user_id', $user_id);
			if (empty($user)) {
				show_404();
			}
			$data['bandeau'] = lang('action_delete') . " : " . $user['user_username'];
			$data['body_tag'] = "<body onload=\"setTimeout('self.close();',20*1000)\" onunload=\"self.opener.location.reload();\">\r\n";
			$data['titre'] = "<div class=\"entete\"><span class=\"gris\">" . lang('action_delete') . " : </span>" . $user['user_username'] . "</div>\r\n";
			// effacement de la ligne
			if (($user['user_rights'] != 'SuperAdmin') and $this->all_model->delete_ligne('user', 'user_id', $user_id)) {
				$data['corps'] = "<p class=\"fbox good\">" . lang('wording_line_deleted') . "<br />&nbsp;</p>\r\n";
			} else {
				$data['corps'] = "<p class=\"fbox warning\">" . lang('error_occurred') . "<br />&nbsp;</p>\r\n";
			}
			// affichage de la vue
			$this->load->view('templates/popup_vue', $data);
		}
	}
	
	/* ##################################################################
	----------			PAGE :: ./admin/who_is_online				  ----------
	################################################################## */
	public function who_is_online() {
		// restriction d'accÃ¨s au script
		if ($this->session->userdata('user_rights') != "SuperAdmin") {
			$data['bandeau'] = 'forbidden access';
			$this->load->view('templates/forbidden', $data);
		} else {
			$data['bandeau'] = lang('nav_who_is_online');
			$data['titre'] = $this->all_model->add_nav_to_title($data['bandeau']);
			// acquisition de la liste des sessions en cours
			$data['sessions'] = $this->admin_model->get_sessions_liste();
			// affichage du rÃ©sultat
			$this->load->view('admin/user_on_line', $data);
		}
	}
	
	/* ##################################################################
	----------			PAGE :: ./admin/session_detail			  ----------
	################################################################## */
	public function session_detail($session_id) {
		// restriction d'accÃ¨s au script
		if ($this->session->userdata('user_rights') != "SuperAdmin") {
			$data['bandeau'] = 'forbidden access';
			$this->load->view('templates/forbidden', $data);
		} else {
			// acquisition de la session concernÃ©e
			$session = $this->all_model->get_fullrow('session', 'session_id', $session_id);
			if (!empty($session)) {
				$data['bandeau'] = $session['session_id'];
				$data['titre'] = $this->all_model->add_nav_to_title(lang('title_detail_of') . $session['session_id']);
				// collecte des infos Ã  afficher
				$data['corps']  = "\t\t\t<p style=\"margin-left:200px;\">" . lang('info_ip_address') . " : " . $session['ip_address'] . "</p>\r\n" ;
				$data['corps'] .= "\t\t\t<p style=\"margin-left:50px;\">user_agent :<br />" . $session['user_agent'] . "</p>\r\n" ;
				$last_activity = unix_to_human($session['last_activity'] + 7200, TRUE, 'eu');
				$data['corps'] .= "\t\t\t<p style=\"margin-left:150px;\">" . lang('info_last_activity') . " : " . $last_activity . "</p>\r\n" ;
				$data['corps'] .= "\t\t\t<textarea style=\"font-size:12px;margin-left:90px;\" name=\"historic\" rows=\"5\" cols=\"60\" readonly=\"readonly\">" . $session['user_data'] . "</textarea>\r\n" ;
			} else {
				$data['bandeau'] = "warning";
				$data['titre'] =  $this->all_model->add_nav_to_title('Warning : ' . $session_id);
				$data['corps']  = "\t\t\t<p class=\"fbox warning\">" . lang('wording_session_id_has_changed') . "</p>\r\n" ;
			}
			// affichage de la vue
			$this->load->view('admin/detail', $data);
		}
	}
	
	
	
	
	/* ##################################################################
	----------				PAGE :: ./admin/xxxx					  ----------
	################################################################## */
	public function xxxx() {
		
	}
	
	
}































/* End of file admin.php */
/* Location: ./application/controllers/admin.php */