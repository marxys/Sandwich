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
		
		$prenom = $this->input->post('prenom');
		$nom = $this->input->post('nom');
		$login = $this->input->post('login');
		$mdp = $this->input->post('password');
		$email = $this->input->post('email');					
		$type = $this->input->post('type');
		
		if($prenom && $nom && $login && $mdp && $email && $type){
			if($type == "client")
				$type = 1;
			elseif($type == "etablissement")
				$type = 2;
			if($this->users_model->isUnique('login',$login)){
				if($this->users_model->isUnique('email',$email)){
					if($this->users_model->insert(
						array(		 'nom' => $nom,
								  'prenom' => $prenom,
								   'login' => $login,
								'password' => md5('sand_key'.$mdp.$nom.$prenom.$login.$email),
								   'email' => $email,
								   'type'  => $type	))) {
						
						if($type == 2){
							$this->load->model('etablissement_model');
							$this->etablissement_model->init();
							$user = $this->users_model->get_by_login($login);
							if($this->etablissement_model->insert(
								array(    'date_ajout' => date('y-m-d'),
								          'user_id' => $user['id'] ))){
								// renvoi json => inscription réussite
								
								$this->json->setError(0);
								$this->json->setMessage('Inscription réussie ! Vous pouvez maintenenant vous connecter :-)');
								$this->json->call('inscription',array($this->json->getError(),$this->json->getMessage()));
								echo json_encode($this->json->get());	

							}
							else{
								//  Creation de l'établissement lie a l'utilisateur a échoue. Veuillez contacter l'agence pour signaler le probleme. L'inscription ne s'est pas deroulee comme prevu.
								$this->json->setError(-1);
								$this->json->setMessage("Création de l'établissement a échoué. Veuillez contacter l'agence pour signaler le problème.");
								$this->json->call('inscription',array($this->json->getError(),$this->json->getMessage()));
								echo json_encode($this->json->get());	

							}
						}
						else if($type == 1){
							$this->json->setError(0);
							$this->json->setMessage('Inscription réussie ! Vous pouvez maintenenant vous connecter :-)');
							$this->json->call('inscription',array($this->json->getError(),$this->json->getMessage()));
							echo json_encode($this->json->get());	
						}
					}
					else {
						// echec de l'inscription
						$this->json->setError(-1);
						$this->json->setMessage("Erreur : Echec de la création d'un nouvel utilisateur. Veuillez réessayer.");
						$this->json->call('inscription',array($this->json->getError(),$this->json->getMessage()));
						echo json_encode($this->json->get());	
		
					}
				}
				else{
					// email deja utilise
					$this->json->setError(-1);
					$this->json->setMessage("Erreur : Cet email est déjà utilisé par un de nos utilisateur");
					$this->json->call('inscription',array($this->json->getError(),$this->json->getMessage()));
					echo json_encode($this->json->get());					
				}
			}
			else{
				 //  login deja utilise.
				 $this->json->setError(-1);
				 $this->json->setMessage("Erreur : Ce login est déjà utilisé par un de nos utilisateur");
				 $this->json->call('inscription',array($this->json->getError(),$this->json->getMessage()));
				 echo json_encode($this->json->get());	
			}
			
		}
	}
	
	public function desinscription() {
		
	}
	public function login() { // doit renvoyer du json
		$login = $this->input->post('login');
		$mdp = $this->input->post('password');
		if( $login && $mdp ){ // pas besoin de gerer une erreur de formulaire sur la vue, le js s'en occupe.
			// attribution de la session
			$user = $this->users_model->get_by_login($login); // récupere l'utilsateur
			if($user){ 
				$password = md5('sand_key'.$mdp.$user['nom'].$user['prenom'].$login.$user['email']);
				if($password == $user['password']){
					// modification de la session.
					// renvoyer du json
					$array = array(
								'user_id' => $user['id'],
								'type' => $user['type']
							 );
					$this->session->set_userdata($array);
					$this->json->setError(0);
					$this->json->call('login_success',array());
					echo json_encode($this->json->get());
				}
				else{ // si mot de passe incorrect
					// Renvoyer du json
					$this->json->setError(-1);
					$this->json->setMessage('Login ou mot de passe incorrect');
					$this->json->call('login_failed',array($this->json->getMessage()));
					echo json_encode($this->json->get());					
				}
			}else{  // Si l'utilisateur n'existe pas
				$this->json->setError(-1);
				$this->json->setMessage('Il n\'existe pas d\'utilisateur avec ce login');
				$this->json->call('login_failed',array($this->json->getMessage()));
				echo json_encode($this->json->get());	
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