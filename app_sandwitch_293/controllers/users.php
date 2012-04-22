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
		$this->load->model('etablissement_model');
		$this->etablissement_model->init();
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
							$user = $this->users_model->get_by_login($login);
							if($this->etablissement_model->insert(
								array(  'user_id' => $user['id'] ))){
								// renvoi json => inscription réussite
								
								$this->json->setError(0);
								$this->json->setMessage('Inscription réussie ! Vous pouvez maintenenant vous connecter :-)');
								$this->json->call('inscription',array($this->json->getError(),$this->json->getMessage()));
								echo json_encode($this->json->get());	

							}
							else{
								//  Creation de l'établissement lie a l'utilisateur a échoue. Veuillez contacter l'agence pour signaler le probleme. L'inscription ne s'est pas deroulee comme prevu.
								$this->json->setError(-1);
								$this->json->setMessage("Création de l'établissement a échoué. Veuillez contacter l'agence pour signaler le problème. ".$this->mysql->error);
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
					$this->json->call('login_success',array($user['type']));
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
		//$this->session->sess_destroy();
		// + redirigé acceuil;
		$this->session->set_userdata('type',0);
		$this->load->view('modules/header'); 
		$this->load->view('acceuil');
		$this->load->view('modules/footer'); 
	}
	public function edit_profil() {
		$prenom = $this->input->post('prenom');
		$nom = $this->input->post('nom');
		$email = $this->input->post('email');
		$username = $this->input->post('login');
		$user_id = $this->session->userdata('user_id');
		
		if($this->session->userdata('type') == 1){ // Client
			if($prenom && $nom && $email && $username){
				if($this->users_model->isThisMine('email',$email,$user_id)){
					if($this->users_model->isThisMine('login',$username,$user_id)){
						$this->users_model->update(array( 'prenom' => $prenom,
													  'nom' => $nom,
													  'email' => $email,
													  'login' => $username),$this->session->userdata('user_id'));
					}
					else{ // erreur login déjà utilisé par un autre membre
						$data['message'] = "Ce login est déjà utilisé par un autre utilisateur";
						$this->load->view('error',$data);
					}
				}	
				else{// erreur email déjà utilisé par un autre membre.
					$data['message'] = "Cet email est déjà utilisé par un autre utilisateur";
					$this->load->view('error',$data);
				}
			}
			else{
				$data['message'] = "Vous n'avez pas remplis tous les formulaires";
				$this->load->view('error',$data); // erreur, il manque des éléments
			}
		}
		else if($this->session->userdata('type') == 2){ // sandwicherie
			$etablissement_nom = $this->input->post('etablissement_nom');
			$slogan = $this->input->post('slogan');
			$adresse = $this->input->post('adresse');
			$gps = $this->input->post('gps');
			if( $prenom && $nom && $email && $username && $etablissement_nom && $slogan && $adresse && $gps ){
				if($this->users_model->isThisMine('email',$email,$user_id)){
					if($this->users_model->isThisMine('login',$username,$user_id)){
						$etablissement = $this->etablissement_model->get_by_user_id($user_id);
						if($this->etablissement_model->isThisMine('nom',$etablissement_nom,$etablissement['id'])){
							$this->users_model->update(array( 'prenom' => $prenom,
													  'nom' => $nom,
													  'email' => $email,
													  'login' => $username),$user_id);
							$this->etablissement_model->update(array( 'nom' => $etablissement_nom,
																	  'slogan' => $slogan,
																	  'adresse' => $adresse,
																	  'gps' => $gps),$etablissement['id']);
						}
						else{ // nom de l'etablissement déjà utilisé
							$data['message'] = "Ce nom d'établissement est déjà utilisé par un autre client";
							$this->load->view('error',$data);
						}
					}
					else{ // login déjà utilisé
						$data['message'] = "Ce login est déjà utilisé par un autre utilisateur";
						$this->load->view('error',$data);
					}
				}
				else{ // email déjà utilisé
					$data['message'] = "cet email est déjà utilisé par un autre utilisateur";
					$this->load->view('error',$data);
				}
			}
			else{ // il manque des données
				$data['message'] = "Vous devez remplir tous les formulaires";
				$this->load->view('error',$data);
			}
		}
		
		$this->view_profil();

	}
	public function edit_password(){
		if($this->session->userdata('type') > 0){
			$ancien_mdp = $this->input->post('ancien_mdp');
			$nv_mdp = $this->input->post('nouveau_mdp');
			$confirmer_mdp = $this->input->post('confirmer_mdp');
			$user_id = $this->session->userdata('user_id');
			if($nv_mdp == $confirmer_mdp){ //on peut modifier le mot de passe
				$user = $this->users_model->get($user_id);
				$password = md5('sand_key'.$ancien_mdp.$user['nom'].$user['prenom'].$user['login'].$user['email']); // mot de passe entré
				if($password == $user['password']){
					$this->users_model->update(array('password' => $nv_mdp),$user_id);
					$this->view_profil(); // renvoie la page de profil
				}
				else{
					$data['message'] = "Votre mot de passe est incorrect";
					$this->load->view('error',$data); // erreur mauvais mot de passe
				}
			}
			else{
				$data['message'] = "la confirmation du nouveau mot de passe est incorrecte";
				$this->load->view('error',$data); //confirmation incorrecte
			}
		}
		else{
			$data['message'] = "Vous n'etes pas connecté";
			$this->load->view('error',$data); // utilisateur pas connecté.
		}
	}
	public function view_profil() {
		$user_id = $this->session->userdata('user_id');
		$user = $this->users_model->get($user_id);
		$data['title'] = 'Profile de l\'utilisateur '.$user['prenom'].' '.$user['nom'];
		$data['user'] = $user;
		$data['type'] = $this->session->userdata('type');
		if($data['type'] == 2){
			$etablissement = $this->etablissement_model->get_by_user_id($user_id);
			$data['etablissement'] = $etablissement;
		}
		$this->load->view('modules/header',$data);
		$this->load->view('users/profil',$data);
		$this->load->view('modules/footer');			
	}
	

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */