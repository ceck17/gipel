<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Records_model extends CI_Model {
	// dÃ©claration de variables
	
	public function la_fonction() {
		return '';
	}
	
	
	public function get_most_records($per_page, $start, $most='recent', $itemid=0) {
		// fabrication de la requÃªte
		if ($itemid != 0) $item_clause = " AND `itemid` = $itemid";
		else $item_clause = "";
		if ($most == 'recent') $order_by_clause = "ORDER BY `maked_on` DESC";
		else $order_by_clause = "ORDER BY `clicks` DESC";
		$user_filter = $this->session->userdata('user_filter');
		$user_owner  = $this->session->userdata('user_owner');
		$request =	"SELECT *
						 FROM `input`
						 WHERE `uid` > 5
						 $item_clause
						 AND ((`visibility` LIKE '%$user_filter%') OR (`visibility` LIKE '%personal%' AND `maked_by` LIKE '%$user_owner%'))
						 $order_by_clause
						 LIMIT $start, $per_page" ;
		$query = $this->db->query($request);
		return $query->result_array();
		
	}
	
	public function count_most_records($itemid=0) {
		// fabrication de la requÃªte 
		if ($itemid != 0) $item_clause = " AND `itemid` = $itemid";
		else $item_clause = "";
		$user_filter = $this->session->userdata('user_filter');
		$user_owner  = $this->session->userdata('user_owner');
		$request =	"SELECT *
						 FROM `input`
						 WHERE `uid` > 5
						 $item_clause
						 AND ((`visibility` LIKE '%$user_filter%') OR (`visibility` LIKE '%personal%' AND `maked_by` LIKE '%$user_owner%'))" ;
		$query = $this->db->query($request);
		return $query->num_rows();
		
	}
	
	
	public function count_from_header_search($string='xxxxxx') {
		$user_filter = $this->session->userdata('user_filter');
		$user_owner  = $this->session->userdata('user_owner');
		$request =	"SELECT *
						 FROM `input`
						 WHERE `uid` > 5
						 AND `keywords` LIKE '%$string%'
						 AND ((`visibility` LIKE '%$user_filter%') OR (`visibility` LIKE '%personal%' AND `maked_by` LIKE '%$user_owner%'))" ;
		$query = $this->db->query($request);
		return $query->num_rows();
		
	}
	
	public function get_from_header_search($per_page, $start, $string='xxxxxx') {
		$user_filter = $this->session->userdata('user_filter');
		$user_owner  = $this->session->userdata('user_owner');
		$request =	"SELECT *
						 FROM `input`
						 WHERE `uid` > 5
						 AND `keywords` LIKE '%$string%'
						 AND ((`visibility` LIKE '%$user_filter%') OR (`visibility` LIKE '%personal%' AND `maked_by` LIKE '%$user_owner%'))
						 ORDER BY `clicks` DESC
						 LIMIT $start, $per_page" ;
		$query = $this->db->query($request);
		return $query->result_array();
	}
	
	public function get_from_deep_search($itemid) {
		// rÃ©cupÃ©ration des critÃ¨res de recherche
		if ($this->input->post('groupid') == 10) $group_criteria = "";
		else $group_criteria = "AND `groupid` = " . $this->input->post('groupid');
		$first_name = $this->db->escape_like_str($this->input->post('first_name'));
		if ($first_name == '') $first_name_criteria = "";
		else $first_name_criteria = "AND `first_name` LIKE " . "'%$first_name%'";
		$last_name = $this->db->escape_like_str($this->input->post('last_name'));
		if ($last_name == '') $last_name_criteria = "";
		else $last_name_criteria = "AND `last_name` LIKE " . "'%$last_name%'";
		$adress1 = $this->db->escape_like_str($this->input->post('adress1'));
		if ($adress1 == '') $adress1_criteria = "";
		else $adress1_criteria = "AND `adress1` LIKE " . "'%$adress1%'";
		$postcode = $this->db->escape_like_str($this->input->post('postcode'));
		if ($postcode == '') $postcode_criteria = "";
		else $postcode_criteria = "AND `postcode` LIKE " . "'%$postcode%'";
		$city = $this->db->escape_like_str($this->input->post('city'));
		if ($city == '') $city_criteria = "";
		else $city_criteria = "AND `city` LIKE " . "'%$city%'";
		$email = $this->db->escape_like_str($this->input->post('email'));
		if ($itemid == 1) {
			if ($this->input->post('country_id') == 10) $country_criteria = "";
			else $country_criteria = "AND `country_id` = " . $this->input->post('country_id');
		} else $country_criteria = "";
		if ($email == '') $email_criteria = "";
		else $email_criteria = "AND `email` LIKE " . "'%$email%'";
		$username = $this->db->escape_like_str($this->input->post('username'));
		if ($username == '') $username_criteria = "";
		else $username_criteria = "AND `username` LIKE " . "'%$username%'";
		$password = $this->db->escape_like_str($this->input->post('password'));
		if ($password == '') $password_criteria = "";
		else $password_criteria = "AND `password` LIKE " . "'%$password%'";
		$url = $this->db->escape_like_str($this->input->post('url'));
		if ($url == '') $url_criteria = "";
		else $url_criteria = "AND `url` LIKE " . "'%$url%'";
		$memo = $this->db->escape_like_str($this->input->post('memo'));
		if ($memo == '') $memo_criteria = "";
		else $memo_criteria = "AND `memo` LIKE " . "'%$memo%'";
		// qui demande ?
		$user_filter = $this->session->userdata('user_filter');
		$user_owner  = $this->session->userdata('user_owner');
		// ORDER BY
		$direction = $this->input->post('direction');
	//	$sorted_by = 'clicks';
		$sorted_by = $this->input->post('sorted_by');
		// Elaboration de la requÃªte
		$request =	"SELECT *
						 FROM `input`
						 WHERE `uid` > 5
						 AND `itemid` = $itemid
						 $group_criteria
						 $first_name_criteria
						 $last_name_criteria
						 $adress1_criteria
						 $postcode_criteria
						 $city_criteria
						 $country_criteria
						 $email_criteria
						 $username_criteria
						 $password_criteria
						 $url_criteria
						 $memo_criteria
						 AND ((`visibility` LIKE '%$user_filter%') OR (`visibility` LIKE '%personal%' AND `maked_by` LIKE '%$user_owner%'))
						 ORDER BY `$sorted_by` $direction
						 LIMIT 30" ;
		$query = $this->db->query($request);
		return $query->result_array();
	}
	
	
	public function name_category($itemid) {
		if ($itemid == 1) return lang('item_addressbook');
		if ($itemid == 2) return lang('item_notebook');
		if ($itemid == 3) return lang('item_document');
		if ($itemid == 4) return lang('item_site-login');
	}
	
	public function get_group_by_id($groupid) {
		$query = $this->db->get_where('group', array('gid' => $groupid));
		$row = $query->row_array();
		return $row['wording'];
	}
	
	public function get_category_of_group($groupid) {
		$query = $this->db->get_where('group', array('gid' => $groupid));
		$row = $query->row_array();
		return $row['group_itemid'];
	}
	
	public function get_linked_records($groupid) {
		$request =	"SELECT *
						 FROM `input`
						 WHERE `uid` > 5
						 AND `groupid` = $groupid
						 ORDER BY `first_name` ASC
						 LIMIT 16 ";
		$query = $this->db->query($request);
		return $query->result_array();
	}
	
	public function get_groupes($itemid) {
		$query = $this->db->query("SELECT * FROM `group` WHERE `group_itemid` = $itemid ORDER BY `wording` ASC");
		foreach ($query->result() as $row) {
			$groupes[$row->gid] = $row->wording;
		}
		return $groupes;
	}
	
	public function get_groups_liste($itemid) {
		$query = $this->db->query("SELECT * FROM `group` WHERE `group_itemid` = $itemid ORDER BY `wording` ASC");
		return $query->result_array();
	}
	
	
	public function backup_it($uid) {
		// mÃ©morisation dans les lignes dÃ©diÃ©es (uid = 1 Ã  4)
		$data = $this->all_model->get_fullrow('input', 'uid', $uid);
		$data['uid'] = $data['itemid'];
		$this->db->where('uid', $data['itemid']);
		$this->db->update('input', $data);
	}
	
	public function make_history($data) {
		$maked_on = unix_to_human($data['maked_on'] + 7200, TRUE, 'eu');
		$historic = "##### " . lang('info_maked_on') . $maked_on . lang('wording_by') . $data['maked_by'] . " #####\r\n" ;
		$the_group = $this->records_model->get_group_by_id($data['groupid']);
		$historic .= lang('label_group')." : ".$the_group."\r\n" ;
		switch ($data['itemid']) {
			case 1:
				$historic .= lang('label_first_name')." : ".$data['first_name']."\r\n" ;
				$historic .= lang('label_last_name')." : ".$data['last_name']."\r\n" ;
				if ($data['birthday'] != "") $historic .= lang('label_birthday')." : ".$data['birthday']."\r\n" ;
				if ($data['adress1'] != "") $historic .= lang('label_adress1')." : ".$data['adress1']."\r\n" ;
				if ($data['adress2'] != "") $historic .= lang('label_adress2')." : ".$data['adress2']."\r\n" ;
				if ($data['postcode'] != "") $historic .= lang('label_postcode')." : ".$data['postcode']."\r\n" ;
				if ($data['city'] != "") $historic .= lang('label_city')." : ".$data['city']."\r\n" ;
				$historic .= lang('label_country') . " : " . $this->all_model->get_field_by_id('country', 'country_fr', 'country_id', $data['country_id']) . "\r\n" ;
				if ($data['phone_home'] != "") $historic .= lang('label_phone_home')." : ".$data['phone_home']."\r\n" ;
				if ($data['phone_work'] != "") $historic .= lang('label_phone_work')." : ".$data['phone_work']."\r\n" ;
				if ($data['phone_cell'] != "") $historic .= lang('label_phone_cell')." : ".$data['phone_cell']."\r\n" ;
				if ($data['fax'] != "") $historic .= lang('label_fax')." : ".$data['fax']."\r\n" ;
				if ($data['email'] != "") $historic .= lang('label_email')." : ".$data['email']."\r\n" ;
			break;
			case 2:
				$historic .= lang('label_note_title')." : ".$data['first_name']."\r\n" ;
			break;
			case 3:
				$historic .= lang('label_doc_name')." : ".$data['first_name']."\r\n" ;
				if ($data['last_name'] != "") $historic .= lang('label_doc_version')." : ".$data['last_name']."\r\n" ;
				if ($data['birthday'] != "") $historic .= lang('label_doc_date')." : ".$data['birthday']."\r\n" ;
				$historic .= lang('label_doc_url')." : ".$data['url']."\r\n" ;
			break;
			case 4:
				$historic .= lang('label_site_name')." : ".$data['first_name']."\r\n" ;
				if ($data['username'] != "") $historic .= lang('label_username')." : ".$data['username']."\r\n" ;
				if ($data['email'] != "") $historic .= lang('label_user_email')." : ".$data['email']."\r\n" ;
				if ($data['password'] != "") $historic .= lang('label_password')." : ".$data['password']."\r\n" ;
				$historic .= lang('label_site_url')." : ".$data['url']."\r\n" ;
				
			break;
			case 9:
				$historic .= "field : ".$data['field']."\r\n" ;
				$historic .= lang('label_field')." : ".$data['field']."\r\n" ;
				if ($data['field'] != "") $historic .= "field : ".$data['field']."\r\n" ;
				if ($data['field'] != "") $historic .= lang('label_field')." : ".$data['field']."\r\n" ;
			break;
		}
		$historic .= lang('label_visibility')." : ".$data['visibility']."\r\n" ;
		return $historic ;
	}
	
	public function update_history($data) {
		$revised_on = unix_to_human($data['revised_on'] + 7200, TRUE, 'eu');
		// acquisition des donnÃ©es avant modif
		$data_before = $this->all_model->get_fullrow('input', 'uid', $data['itemid']);
		$historic = "##### " . lang('info_revised_on') . $revised_on . lang('wording_by') . $data['revised_by'] . " #####\r\n" ;
		if ($data['groupid'] != $data_before['groupid']) {
			$old_group = $this->records_model->get_group_by_id($data_before['groupid']);
			$new_group = $this->records_model->get_group_by_id($data['groupid']);
		   $historic .= lang('label_group')." : ".$old_group." >>> ".$new_group."\r\n" ;
		}
		switch ($data['itemid']) {
			case 1:
				if ($data['first_name'] != $data_before['first_name']) $historic .= lang('label_first_name')." : ".$data_before['first_name']." >>> ".$data['first_name']."\r\n" ;
				if ($data['last_name'] != $data_before['last_name']) $historic .= lang('label_last_name')." : ".$data_before['last_name']." >>> ".$data['last_name']."\r\n" ;
				if ($data['birthday'] != $data_before['birthday']) $historic .= lang('label_birthday')." : ".$data_before['birthday']." >>> ".$data['birthday']."\r\n" ;
				if ($data['adress1'] != $data_before['adress1']) $historic .= lang('label_adress1')." : ".$data_before['adress1']." >>> ".$data['adress1']."\r\n" ;
				if ($data['adress2'] != $data_before['adress2']) $historic .= lang('label_adress2')." : ".$data_before['adress2']." >>> ".$data['adress2']."\r\n" ;
				if ($data['postcode'] != $data_before['postcode']) $historic .= lang('label_postcode')." : ".$data_before['postcode']." >>> ".$data['postcode']."\r\n" ;
				if ($data['city'] != $data_before['city']) $historic .= lang('label_city')." : ".$data_before['city']." >>> ".$data['city']."\r\n" ;
				if ($data['country_id'] != $data_before['country_id']) {
					$old_country = $this->all_model->get_field_by_id('country', 'country_fr', 'country_id', $data_before['country_id']);
					$new_country = $this->all_model->get_field_by_id('country', 'country_fr', 'country_id', $data['country_id']);
					$historic .= lang('label_country')." : ".$old_country." >>> ".$new_country."\r\n" ;
				}
				if ($data['phone_home'] != $data_before['phone_home']) $historic .= lang('label_phone_home')." : ".$data_before['phone_home']." >>> ".$data['phone_home']."\r\n" ;
				if ($data['phone_work'] != $data_before['phone_work']) $historic .= lang('label_phone_work')." : ".$data_before['phone_work']." >>> ".$data['phone_work']."\r\n" ;
				if ($data['phone_cell'] != $data_before['phone_cell']) $historic .= lang('label_phone_cell')." : ".$data_before['phone_cell']." >>> ".$data['phone_cell']."\r\n" ;
				if ($data['fax'] != $data_before['fax']) $historic .= lang('label_fax')." : ".$data_before['fax']." >>> ".$data['fax']."\r\n" ;
				if ($data['email'] != $data_before['email']) $historic .= lang('label_email')." : ".$data_before['email']." >>> ".$data['email']."\r\n" ;
			break;
			case 2:
				if ($data['first_name'] != $data_before['first_name']) $historic .= lang('label_note_title')." : ".$data_before['first_name']." >>> ".$data['first_name']."\r\n" ;
			break;
			case 3:
				if ($data['first_name'] != $data_before['first_name']) $historic .= lang('label_doc_name')." : ".$data_before['first_name']." >>> ".$data['first_name']."\r\n" ;
				if ($data['last_name'] != $data_before['last_name']) $historic .= lang('label_doc_version')." : ".$data_before['last_name']." >>> ".$data['last_name']."\r\n" ;
				if ($data['birthday'] != $data_before['birthday']) $historic .= lang('label_doc_date')." : ".$data_before['birthday']." >>> ".$data['birthday']."\r\n" ;
				if ($data['url'] != $data_before['url']) $historic .= lang('label_doc_url')." : ".$data_before['url']." >>> ".$data['url']."\r\n" ;
			break;
			case 4:
				if ($data['first_name'] != $data_before['first_name']) $historic .= lang('label_site_name')." : ".$data_before['first_name']." >>> ".$data['first_name']."\r\n" ;
				if ($data['username'] != $data_before['username']) $historic .= lang('label_username')." : ".$data_before['username']." >>> ".$data['username']."\r\n" ;
				if ($data['email'] != $data_before['email']) $historic .= lang('label_user_email')." : ".$data_before['email']." >>> ".$data['email']."\r\n" ;
				if ($data['password'] != $data_before['password']) $historic .= lang('label_password')." : ".$data_before['password']." >>> ".$data['password']."\r\n" ;
				if ($data['url'] != $data_before['url']) $historic .= lang('label_site_url')." : ".$data_before['url']." >>> ".$data['url']."\r\n" ;
			break;
			case 9:
				if ($data['field'] != $data_before['field']) $historic .= lang('label_field')." : ".$data_before['field']." >>> ".$data['field']."\r\n" ;
			break;
		}
		if ($data['visibility'] != $data_before['visibility']) $historic .= lang('label_visibility')." : ".$data_before['visibility']." >>> ".$data['visibility']."\r\n" ;
		return $historic . "\r\n" . $data_before['history'] ;
	}
	
	public function oneness_control($first_name, $last_name='') {
		if ($last_name == '') {
			$query = $this->db->get_where('input', array('first_name' => $first_name));
		} else {
			$query = $this->db->get_where('input', array('first_name' => $first_name, 'last_name' => $last_name));
		}
		if ($query->row_array()) return FALSE;
		else return TRUE;
	}
	
	public function get_associated_image($itemid, $uid, $contexte='detail') {
		if ($this->session->userdata('user_rights') != "ReadOnly") $can_upload = TRUE;
		else $can_upload = FALSE;
		$associated_image = $directory = $associated_photo = "";
		if ($contexte == 'liste') $size = ' height="32" ';
		else $size = ' width="135" ';
		if ($itemid == 1) $directory = './upload/pics/adrbook/' ;
		if ($itemid == 3) $directory = './upload/pics/document/' ;
		if ($itemid == 4) $directory = './upload/pics/weblog/' ;
		if ($itemid != 2) {
			$photo = $directory . "pic-" . $itemid . "-" . $uid ;
			$exchange_link = "";
			if ($can_upload == TRUE) $exchange_link = " title=\"".lang('action_change_photo')."\" onclick=\"popup_upload('" . base_url('index.php/records/photo/exchange/'.$uid) . "')\"";
			if (file_exists($photo.'.jpg')) {
				if ($contexte == 'liste') {
					$associated_photo = "<img src=\"".base_url($photo.'.jpg')."\"" . $size . "alt=\"pic".$uid."\" />" ;
				} else {
					$associated_photo = "<img src=\"".base_url($photo.'.jpg')."\"" . $size . "alt=\"pic".$uid."\"" . $exchange_link . " />" ;
				}
			} elseif (file_exists($photo.'.png')) {
				if ($contexte == 'liste') {
					$associated_photo = "<img src=\"".base_url($photo.'.png')."\"" . $size . "alt=\"pic".$uid."\" />" ;
				} else {
					$associated_photo = "<img src=\"".base_url($photo.'.png')."\"" . $size . "alt=\"pic".$uid."\"" . $exchange_link . " />" ;
				}
			} elseif (file_exists($photo.'.gif')) {
				if ($contexte == 'liste') {
					$associated_photo = "<img src=\"".base_url($photo.'.gif')."\"" . $size . "alt=\"pic".$uid."\" />" ;
				} else {
					$associated_photo = "<img src=\"".base_url($photo.'.gif')."\"" . $size . "alt=\"pic".$uid."\"" . $exchange_link . " />" ;
				}
			}
		}
		$upload_link = "";
		if ($can_upload == TRUE) $upload_link = " title=\"".lang('action_upload_photo')."\" onclick=\"popup_upload('" . base_url('index.php/records/photo/upload/'.$uid) . "')\"";
		if ($associated_photo != "") {
			$associated_image = $associated_photo;
		} elseif ($contexte == 'liste') {
			if ($itemid == 1) $associated_image = "<img src=\"".base_url('resource/img/item/addressbook.png')."\" height=\"24\" width=\"44\" alt=\"image\" />";
			if ($itemid == 2) $associated_image = "<img src=\"".base_url('resource/img/item/notebook.png')."\" height=\"24\" width=\"44\" alt=\"image\" />";
			if ($itemid == 3) $associated_image = "<img src=\"".base_url('resource/img/item/document.png')."\" height=\"24\" width=\"44\" alt=\"image\" />";
			if ($itemid == 4) $associated_image = "<img src=\"".base_url('resource/img/item/site-login.png')."\" height=\"24\" width=\"44\" alt=\"image\" />";
		} elseif ($contexte == 'detail') {
			if ($itemid == 1) $associated_image = "<img src=\"".base_url('resource/img/item/default_addressbook.png')."\" height=\"135\" width=\"135\" alt=\"image\"" . $upload_link . " />";
			if ($itemid == 3) $associated_image = "<img src=\"".base_url('resource/img/item/default_document.png')."\" height=\"135\" width=\"135\" alt=\"image\"" . $upload_link . " />";
			if ($itemid == 4) $associated_image = "<img src=\"".base_url('resource/img/item/default_site-login.png')."\" height=\"135\" width=\"135\" alt=\"image\"" . $upload_link . " />";
		}
		return $associated_image;
	}
	
	public function photo_file_delete($itemid, $uid) {
		$directory = 'xyzyx';
		if ($itemid == 1) $directory = './upload/pics/adrbook/' ;
		if ($itemid == 3) $directory = './upload/pics/document/' ;
		if ($itemid == 4) $directory = './upload/pics/weblog/' ;
		$file = $directory . 'pic-' . $itemid . '-' . $uid ;
		if (is_file($file.'.jpg')) {
			unlink($file.'.jpg');
			return TRUE;
		} elseif (is_file($file.'.png')) {
			unlink($file.'.png');
			return TRUE;
		} elseif (is_file($file.'.gif')) {
			unlink($file.'.gif');
			return TRUE;
		}
		return FALSE;
	}
	
	
}






/* End of file records_model.php */
/* Location: ./application/models/records_model.php */