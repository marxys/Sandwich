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
		$this->load->library('input');
		$this->users_model->init();
		$this->load->library('json');
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
	public function login() { // doit renvoyer du json
		$login = $this->input->post('login');
		$mdp = $this->input->post('password');
		if( $login && $mdp ){ // pas besoin de gerer une erreur de formulaire sur la vue, le js s'en occupe.
			// attribution de la session
			$user = $this->user_model->get_by_login($login); // récupere l'utilsateur
			if($user){ // Si c'est bien un utilisateur normal
				$password = md5('sand_key'.$mdp.$user['nom'].$user['prenom'].$login.$user['email']);
				if($password == $user['password']){
					// modification de la session.
					// renvoyer du json
					$array = array(
								'user_id' => $user['user_id'],
								'type' => 1
							 );
					$this->session->set_userdata($array);
					$this->json->setMessage('Connexion réussie');
					$this->json->call('login_success',0);
					//...
					echo json_encode($this->json->get());
				}
				else{
					// Renvoyer du json
					$this->json->setError(-1);
					$this->json->setMessage('Mot de passe erroné');
					$this->json->call('login_failed',0);
					echo json_encode($this->json->get());					
				}
			}else{ // Si c'est une sandwicherie
				// a faire plus tard.
			}
		}
	}
	public function logout() {
		if(isset($this->session))
		$this->session->sess_destroy();
		// + redirigé acceuil;
	}
	public function edit_profil() {
		
	}
	public function view_profil() {
		
	}
	

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */