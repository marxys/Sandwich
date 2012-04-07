<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	 
	public function __construct() {
		parent::__construct();
		$this->titre_defaut = 'iSandwich';
		$this->load->model('users_model');
		$this->users_model->init();
	}
	public function inscription() {
		
		$this->load->helper(array('form', 'url'));
		
		$this->load->library('form_validation');
				
		if ($this->form_validation->run() == FALSE)
		{	
			$this->load->view('inscription/error');
			$this->load->view('inscription/form');
		}
		else
		{
			if($this->users_model->isUnique('login',$login) && $this->users_model->isUnique('email',$email)) {
					if($this->users_model->insert(
						array(		 'nom' => $nom,
								  'prenom' => $prenom,
								   'login' => $login,
								'password' => md5('sand_key'.$password.$nom.$prenom.$login.$email),
								   'email' => $email		))) {
						
							$this->load->view('inscription/success');
					}
					else 	$this->load->view('inscription/form');
				
			}
			else $this->load->view('inscription/form');
			
		}
	}
	
	public function desinscription() {
		
	}
	public function login() {
		
	}
	public function logout() {
		
	}
	public function edit_profil() {
		
	}
	public function view_profil() {
		
	}
	

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */