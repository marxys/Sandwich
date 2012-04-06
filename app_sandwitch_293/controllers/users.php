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
		$this->load->model('user_model');
	}
	public function inscription($nom,$prenom,$login,$password,$email) {
		if($this->user_model->isUnique('login',$login) && $this->user_model->isUnique('email',$email)) {
				$this->user_model->insert(
						array(		 'nom' => $nom,
								  'prenom' => $prenom,
								   'login' => $login,
								'password' => md5('sand_key'.$password.$nom.$prenom.$login.$email),
								   'email' => $email		));
								   
				echo 'user inséré';
		}
		else 'impossible insérer';
		
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