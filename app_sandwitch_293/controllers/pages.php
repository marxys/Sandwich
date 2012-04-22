<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pages extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('users_model');
		$this->users_model->init();
		$this->load->model('etablissement_model');
		$this->etablissement_model->init();
	}
	// Chargé par défaut.
	public function index(){
		if(sizeof($this->session->all_userdata()) != 7)
			$this->session->set_userdata(array(  'user_id' => 0, 'type'=>0));
		$data['title'] = 'iSandwich';
		$this->load->view('modules/header',$data); 
		$this->load->view('acceuil');
		$this->load->view('modules/footer'); 
	}
	
	public function contact(){
		$this->load->view('contact');
		
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
	
	public function ajouter_produit(){
		if($this->session->useritem('type') == 2){
			$data['title'] = "Ajout d'un nouveau produit";
			$this->load->view('modules/header',$data);
			$this->load->view('produits/ajout');
			$this->load->vieuw('modules/footer');
		}
		else{
			$data['message'] = 'Vous n\'avez pas les droits';
			$this->load->view('error',$data);
		}
	}
}