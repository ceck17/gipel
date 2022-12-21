<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Install extends CI_Controller {
	
	// constructeur
	public function __construct() {
		parent::__construct();
		// chargement divers
		$this->load->model('all_model');
		$this->lang->load('install');
		$this->lang->load('gipel');
	}
	
	/* ##################################################################
	----------				PAGE :: ./install/index					  ----------
	################################################################## */
	public function index() {
		$data['bandeau'] = lang('install_phase1') ;
		$data['titre'] = lang('install_ph1_title') ;
		$data['form_validated'] = '';
		// lecture des paramÃªtres de connexion Ã  la bdd
		include ('application/config/database.php');
		$data['step1']['db']['hostname'] = $db['default']['hostname'];
		$data['step1']['db']['username'] = $db['default']['username'];
		$data['step1']['db']['password'] = $db['default']['password'];
		$data['step1']['db']['database'] = $db['default']['database'];
		// affichage de la vue
		$this->load->view('install/install_screen', $data);
	}
	
	/* ##################################################################
	----------				PAGE :: ./install/proceed				  ----------
	################################################################## */
	public function proceed($phase) {
	//			$phase = $this->uri->segment(3);
		switch ($phase) {
			case '2':
				$data['bandeau'] = lang('install_phase2') ;
				$data['titre'] = lang('install_ph2_title') ;
				$data['step2']['error'] = $data['step2']['good'] = $data['form_validated'] = '';
				// crÃ©ation des tables de la base de donnÃ©es
				$this->load->database();
				if ( ! $this->db->table_exists('user')) {
					$this->load->helper('file');
					$tables = $this->create_tables();
					if($tables == FALSE){
						// message d'erreur
						$data['step2']['error'] .= lang('error_tables_creation');
					} else {
						// message de confirmation
						$data['step2']['good'] .= lang('info_tables_creation');
					}
				}
				$data['step2']['user_id'] = 'init';
				// affichage de la vue
				$this->load->view('install/install_screen', $data);
			break;
			case '3':
				$user_id = $this->input->post('user_id');
				// initialisation du validateur du formulaire
				$this->load->library('form_validation');
				$this->form_validation->set_error_delimiters('<br /><div class="errorMessage"><span style="font-size: 150%;">&uarr;&nbsp;</span>', '</div>');
				// dÃ©finition des rÃ¨gles de validation
				$this->form_validation->set_rules('user_username', 'Â« '.lang('label_username').' Â»', 'required|min_length[8]|max_length[24]|alpha_dash');
				$this->form_validation->set_rules('sa_password', 'Â« '.lang('label_password').' Â»', 'required|min_length[8]|max_length[16]|alpha_dash');
				$this->form_validation->set_rules('confirm_password', 'Â« '.lang('label_confirm_it').' Â»', 'required|matches[sa_password]');
				// test de validation du formulaire
				if ($this->form_validation->run() == FALSE){
					// Ã©chec : rÃ©-affichage du formulaire
					$data['bandeau'] = lang('install_phase3') ;
					$data['titre'] = lang('install_ph3_title') ;
					$data['form_validated'] = 'no';
					$data['user_id'] = 'try_again';
					$data['step2']['error'] = $data['step2']['good'] = '';
					// affichage de la vue
					$this->load->view('install/install_screen', $data);
				} else {
					// succÃ¨s
					$data['bandeau'] = lang('install_phase3') ;
					$data['titre'] = lang('install_ph3_title') ;
					$data['form_validated'] = 'yes';
					$data['step3']['error'] = $data['step3']['good'] = '';
					$this->load->database();
					// rÃ©cupÃ©ration des donnÃ©es passÃ©es en _POST
					$user_data['user_username']			= $this->input->post('user_username');
					$user_data['user_password_md5']		= md5($this->input->post('sa_password'));
					$user_data['user_rights']				= 'SuperAdmin';
					$user_data['user_make_date']			= now();
					$user_data['user_history']			= "--o-- " . lang('info_maked_on') . unix_to_human(now(), TRUE, 'eu') . " --o--\r\n" ;
					// requÃªte d'insertion
					$new_id = $this->all_model->add_ligne('user', $user_data) ;
					if (is_numeric($new_id)) {
						$user_data = $this->all_model->get_fullrow('user', 'user_id', $new_id);
						// message de confirmation
						$data['step3']['good'] .= lang('info_the_superadmin_account') . $user_data['user_username'] . lang('info_has_been_added') ;
						
					} else {
						// message d'erreur
						
					}
					
					
					// affichage de la vue
					$this->load->view('install/install_screen', $data);
				}
			break;
		}
		
		
		
	}
	
	/* ##################################################################
	----------				FUNCTION :: create_tables()			  ----------
	----------		Thanks to Classroombookings project			  ----------
	Classroombookings is an open source project.					  ----------
	Â© Craig A Rodway 2006 â 2013.										  ----------
	http://classroombookings.com/										  ----------
	################################################################## */
	
	function create_tables(){
		$errcount = 0;
		$file = read_file('gipel1311.sql');
		$array = explode(';', $file);
		foreach($array as $query){
			if($query != NULL){
				// Read file successfully - return the result of the query (TRUE/FALSE)
				$query = $this->db->query($query);
				if( $query == FALSE ){ $errcount++; }
			}
		}
		if($errcount > 0){
			return FALSE;
		} else {
			return TRUE;
		}
	}
}

/* End of file install.php */
/* Location: ./application/controllers/install.php */