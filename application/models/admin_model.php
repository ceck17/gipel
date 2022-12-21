<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model {
	
	public function get_user_by_id($id) {
		$query = $this->db->get_where('user', array('user_id' => $id));
		return $query->row_array();
	}
	
	public function get_user_by_name($name) {
		$this->db->where('user_username', $name);
		return $this->db->get('user')->result();
	}
	
	public function get_users_liste() {
		$query = $this->db->query("SELECT * FROM `user` ORDER BY `user_username` ASC");
		return $query->result_array();
	}
	
	public function get_sessions_liste() {
		$query = $this->db->query("SELECT * FROM `session` ORDER BY `last_activity` DESC");
		return $query->result_array();
	}
	
	public function oneness_control($user_username='') {
		$query = $this->db->get_where('user', array('user_username' => $user_username));
		$row = $query->row_array();
		if ($row) return FALSE;
		else return TRUE;
	}
	
	
}





/* End of file admin_model.php */
/* Location: ./application/models/admin_model.php */