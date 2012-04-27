<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pages extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('users_model');
		$this->users_model->init();
		$this->load->model('etablissement_model');
		$this->etablissement_model->init();
		$this->load->model('categorie_model');
		$this->categorie_model->init();
		
	}
	// Chargé par défaut.
	public function index(){
		if(sizeof($this->session->all_userdata()) < 6)
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
		if($this->session->userdata('type') > 0){
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
		else
			redirect('/index.php','location');		
	}
	
	public function ajouter_produit(){
		if($this->session->userdata('type') == 2){
			$data['title'] = "Ajout d'un nouveau produit";
			$data['categorie'] = $this->categorie_model->search(NULL,NULL,NULL,NULL,NULL); // Récupere toutes les catégorie
			$this->load->view('modules/header',$data);
			$this->load->view('produits/ajout');
			$this->load->view('modules/footer');
		}
		else{
			$data['message'] = 'Vous n\'avez pas les droits';
			$this->load->view('error',$data);
		}
	}
	public function ajouter_news(){
		if($this->session->userdata('type') == 2){
			$data['title'] = "Ajout d'une nouvelle news";
			$this->load->view('modules/header',$data);
			$this->load->view('etablissement/ajout_news');
			$this->load->view('modules/footer');
		}
		else{
			$data['message'] = 'Vous n\'avez pas les droits';
			$this->load->view('error', $data);
			
		}
	}
	/*
	Charge la fiche du produit $id
	$link permettra de charger la page précedante avec un bouton retour sur /index.php/produits/view/$link
	*/
	
	public function voir_produit($id,$link){
		if($this->session->userdata('type') > 0){
			$this->load->model('produits_model');
			$this->load->model('commentaires');
			$this->load->model('promo');
			$this->promo->init();
			$this->commentaires->init();
			$this->produits_model->init();
			$produit = $this->produits_model->get($id);
			$data['commentaires'] = $this->commentaires->get_by_id_product($id);
			$data['promos'] = $this->promo->get_by_id_product($id);
			$data['produit'] = $produit;
			$data['type'] = $this->session->userdata('type');
			$data['access'] = $this->produit_model->isOwner($id); // Vérifie que l'utilisateur connecté est le propriétaire du produit
			$dataHeader['title'] = "Fiche du produit ".$produit['nom'];
			$this->load->view('modules/header',$dataHeader);
			$this->load->view('produit/fiche',$data);
			$this->load->view('modules/footer');
		}
		else
			redirect('/index.php','location');
	}
}