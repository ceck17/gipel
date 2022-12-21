<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Control extends CI_Controller {
	// dÃ©claration de la variable CI
	var $CI;
	// constructeur
	public function __construct() {
		// instanciation de la variable CI
		$this->CI =& get_instance();
		// chargement des librairies, modÃ¨les, fichiers_lang
		$this->CI->load->model('admin_model');
		$this->CI->load->model('all_model');
	}
	
	public function ask_access() {
		if ($this->CI->session->userdata('user_id')) {
			// utilisateur authentifiÃ©
			// vÃ©rification de la validitÃ© des sa session
			if ($this->CI->control->is_valid_session()) {
				// acquisition et stockage des attributs de l'utilisateur
				$logged_user = $this->CI->admin_model->get_user_by_id($this->CI->session->userdata('user_id'));
				switch ($logged_user['user_rights']) {
					case "ReadOnly":
						$user_filter = 'communal' ;
						$user_owner = 'Ik33POBlzpn1s1oxBxJJpanY' ;
					break;
					case "ReadWrite":
						$user_filter = 'communal' ;
						$user_owner = $logged_user['user_username'] ;
					break;
					case "SuperAdmin":
						$user_filter = '' ;
						$user_owner = '' ;
					break;
				}
				$newdata = array(
					'user_rights'				=> $logged_user['user_rights'],
					'user_filter'				=> $user_filter,
					'user_owner'				=> $user_owner,
				);
				$this->CI->session->set_userdata($newdata);
				return TRUE;
			} else {
				// dÃ©sactivation de la session et message de warning
				$this->CI->session->unset_userdata('user_id');
				$flash_feedback = lang('info_session_expired');
				$this->CI->session->set_flashdata('warning', $flash_feedback);
						//		$array_items = array('username' => '', 'email' => '');
						//		$this->CI->session->unset_userdata($array_items);
				
				return FALSE ;
			}
		} else {
			// utilisateur NON authentifiÃ©
			return FALSE;
		}
		
	}
	
	
	public function logout() {
		$this->CI->session->unset_userdata('user_id');
		$this->CI->session->unset_userdata('user_name');
	}
	
	public function check_login() {
		if (!$this->CI->input->post()) return FALSE;
		$username = $this->CI->input->post('user_username');
		$password = $this->CI->input->post('user_password');
		$user_array = $this->CI->admin_model->get_user_by_name($username);
		if (count($user_array)==1 and $user_array[0]->user_password_md5 == md5($password)) {
			// Ã©criture des infos user dans sa ligne de la table session
			$this->CI->session->set_userdata('user_id', $user_array[0]->user_id);
			$this->CI->session->set_userdata('user_name', $user_array[0]->user_username);
			// incrÃ©mentation du champ user_logs de la table user
			$this->CI->all_model->increment_field('user', 'user_logs', 'user_id', $user_array[0]->user_id, 1);
			// limite de temps
			$just_now = date ("U");
			$time_limit = $just_now + $this->CI->config->item('sess_expiration') ;
			$this->CI->session->set_userdata('time_limit', $time_limit);
			
			redirect(site_url()) ;
			
		} else {
			if (count($user_array)==1) {
				$flash_feedback = lang('error_password_mismatch');
				$this->CI->session->set_flashdata('error', $flash_feedback);
			} elseif (count($user_array)==0) {
				$flash_feedback = lang('error_invalid_user');
				$this->CI->session->set_flashdata('error', $flash_feedback);
			}
			redirect('home/login');
			return FALSE ;
		}
	}
	
	public function is_valid_session() {
		// vÃ©rification du temps limite
		$just_now = date ("U");
		if ($this->CI->session->userdata('time_limit') > $just_now) return TRUE;
		else return FALSE;
	}
	
	
	
	
}













/* End of file control.php */
/* Location: ./application/libraries/control.php */