<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	
	// constructeur
	public function __construct() {
		parent::__construct();
		// chargement divers
		$this->lang->load('gipel');
		
		// contrÃ´le d'accÃ¨s
		if (!$this->control->ask_access()) {
			// utilisateur NON authentifiÃ©
			$curr_uri_string = uri_string();
			if ($curr_uri_string != 'home/login') {
				redirect('home/login');
			}
		}
		
	}
	
	/* ##################################################################
	----------				PAGE RACINE :: ./home					  ----------
	################################################################## */
	
	public function index() {
		$data['bandeau'] = lang('title_home_page');
		// affichage de la vue
		$this->load->view('home/index', $data);
		
	}
	
	/* ##################################################################
	----------				PAGE :: ./home/login						  ----------
	################################################################## */
	
	public function login() {
		$data['bandeau'] = '';
		if (!$this->control->check_login()) {
			$this->load->view('home/login', $data);
		}
	}
	
	/* ##################################################################
	----------				PAGE :: ./home/logout					  ----------
	################################################################## */
	
	public function logout() {
		$this->control->logout();
		redirect(site_url());
	}
	
	/* ##################################################################
	----------			PAGE :: ./home/edit_my_account			  ----------
	################################################################## */
	
	public function edit_my_account($user_name) {
		$data['bandeau'] = lang('action_edit_my_account');
		$data['titre'] = $this->all_model->add_nav_to_title($data['bandeau']);
		$data['username'] = $user_name;
		// affichage de la vue
		$this->load->view('home/form', $data);
	}
	
	/* ##################################################################
	----------			PAGE :: ./home/save_my_account			  ----------
	################################################################## */
	
	public function save_my_account() {
		// rÃ©cupÃ©ration des donnÃ©es passÃ©es en _POST
		$user_id								= $this->input->post('user_id');
		$user_username						= $this->input->post('user_username');
		$data['user_first_name']		= $this->input->post('user_first_name');
		$data['user_last_name']			= $this->input->post('user_last_name');
		$data['user_address']			= $this->input->post('user_address');
		$data['user_postcode']			= $this->input->post('user_postcode');
		$data['user_city']				= $this->input->post('user_city');
		$data['user_country_id']		= $this->input->post('user_country_id');
		$data['user_email']				= $this->input->post('user_email');
		$user_history						= $this->input->post('user_history');
		// premiÃ¨re requÃªte de modification
		$affected_rows = $this->all_model->update_ligne('user', $data, 'user_id', $user_id);
		if ($affected_rows == 1) {
			// champs remplis automatiquement
			$data['user_revised_date'] = now();
			// mise Ã  jour de l'historique
			$historic = "----- " . lang('info_revised_on') . unix_to_human(now() + 7200, TRUE, 'eu') . " -----\r\n" ;
			$data['user_history'] = $historic . "\r\n" . $user_history ;
			// deuxiÃ¨me requÃªte de modification
			if (($this->all_model->update_ligne('user', $data, 'user_id', $user_id)) == 1) {
				// message de confirmation
				$flash_feedback = lang('info_your_account') . $user_username . lang('info_has_been_updated') ;
				$this->session->set_flashdata('good', $flash_feedback);
			} else {
				// message d'erreur
				
			}
		} else {
			// message de warning
			$flash_feedback = lang('info_no_update');
			$this->session->set_flashdata('warning', $flash_feedback);
		}
		// redirection vers la page d'accueil
		redirect('home/');
	}
	
	/* ##################################################################
	----------				PAGE :: ./home/password					  ----------
	################################################################## */
	
	public function password($user_id) {
		$data['bandeau'] = lang('action_change_password');
		$data['titre'] = $this->all_model->add_nav_to_title($data['bandeau']);
		$data['user_id'] = $user_id;
		// affichage de la vue
		$this->load->view('home/password_form', $data);
	}
	
	/* ##################################################################
	----------			PAGE :: ./home/save_password			  ----------
	################################################################## */
	
	public function save_password() {
		$user_id = $this->input->post('user_id');
		// initialisation du validateur du formulaire
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<br /><div class="errorMessage"><span style="font-size: 150%;">&uarr;&nbsp;</span>', '</div>');
		// dÃ©finition des rÃ¨gles de validation
		$this->form_validation->set_rules('current_password', 'Â« '.lang('label_current_password').' Â»', 'required');
		$this->form_validation->set_rules('new_password', 'Â« '.lang('label_new_password').' Â»', 'required|min_length[8]|max_length[16]|alpha_dash');
		$this->form_validation->set_rules('confirm_password', 'Â« '.lang('label_confirm_it').' Â»', 'required|min_length[8]|max_length[16]|alpha_dash');
		// test de validation du formulaire
		if ($this->form_validation->run() == FALSE){
			// Ã©chec : retour au formulaire
			$this->password($user_id);
		} else {
			// succÃ¨s : rÃ©cupÃ©ration des donnÃ©es passÃ©es en _POST
			$current_password			= $this->input->post('current_password');
			$new_password				= $this->input->post('new_password');
			$confirm_password			= $this->input->post('confirm_password');
			$user = $this->admin_model->get_user_by_id($user_id);
			if (md5($current_password) != $user['user_password_md5']) {
				// message de warning et redirection
				$flash_feedback = lang('wording_current_password_false');
				$this->session->set_flashdata('warning', $flash_feedback);
				redirect('home/password/'.$user_id);
			} elseif ($new_password != $confirm_password) {
				// message de warning
				$flash_feedback = lang('wording_fail_confirm_password');
				$this->session->set_flashdata('warning', $flash_feedback);
				redirect('home/password/'.$user_id);
			} else {
				// cryptage du nouveau mot de passe
				$data['user_password_md5']		= md5($new_password);
				// champs remplis automatiquement
				$data['user_revised_date'] = now();
				// mise Ã  jour de l'historique
				$user_history = $this->input->post('user_history');
				$historic = lang('info_password_changed_on') . unix_to_human(now() + 7200, TRUE, 'eu') . " #####\r\n" ;
				$data['user_history'] = $historic . "\r\n" . $user_history ;
				// requÃªte de modification
				$this->all_model->update_ligne('user', $data, 'user_id', $user_id);
				// message de confirmation
				$flash_feedback = lang('info_password_updated_good');
				$this->session->set_flashdata('good', $flash_feedback);
			}
			// redirection vers la page d'accueil
			redirect('home/');
		}
	}
	
	/* ##################################################################
	----------					PAGE :: ./home/about					  ----------
	################################################################## */
	
	public function about() {
		$data['bandeau'] = lang('nav_about_gipel');
		$data['titre'] = $this->all_model->add_nav_to_title($data['bandeau']);
		// affichage de la vue
		$this->load->view('home/about', $data);
	}
	
	
}











/* End of file home.php */
/* Location: ./application/controllers/home.php */