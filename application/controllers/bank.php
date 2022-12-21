<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bank extends CI_Controller {
	
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
			if ($curr_uri_string != 'bank/index') {
				redirect('home/login');
			}
		}
		
	}
	
	/* ##################################################################
	----------				PAGE :: ./bank/index					  ----------
	################################################################## */
	public function index() {
		$data['bandeau'] = lang('nav_section_bank');
		$data['titre'] = $this->all_model->add_nav_to_title($data['bandeau']);
		// affichage de la vue
		$this->load->view('bank/index', $data);
	}
	
	
	
	
	
}

/* End of file bank.php */
/* Location: ./application/controllers/bank.php */