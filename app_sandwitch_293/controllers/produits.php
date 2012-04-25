<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Produits extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('produits_model');
		$this->load->model('commentaires');
		$this->load->model('categorie_model');
		$this->load->model('etablissement_model');
		$this->produits_model->init();
		$this->commentaires->init();
		$this->categorie_model->init();
		$this->etablissement_model->init();
	}
	/*
		Ajoute un nouveau produit à la base de donnée pour l'établissement associé à $this->session->userdata('user_id')
		Ajoute une nouvelle catégorie, si la catégorie envoyer n'existe pas.
	*/
	public function add(){
		if($this->session->userdata('type') > 1){
			$nom = $this->input->post('nom');
			$prix = $this->input->post('prix');
			$description = $this->input->post('description');
			$categorie = $this->input->post('categorie');
			if(!$categorie)
				$categorie = $this->input->post('categorie_new');
			if($nom && $prix && $description && $categorie){
				$result = $this->categorie_model->get_by_name($categorie);
				if(!$result){ // si la catégorie n'existe pas, on la crée
					$this->categorie_model->insert(array('nom'=>$categorie));
					$result = $this->categorie_model->get_by_name($categorie);
				}
				$etablissement = $this->etablissement_model->get_by_user_id($this->session->userdata('user_id'));
				if($this->produits_model->insert( array ( 'nom' => $nom,
													   'description' => $description,
													   'prix' => $prix,
													   'categorie_id' => $result['id'],
													   'etablissement_id' => $etablissement['id'] )))
					redirect('/index.php/pages/ajouter_produit','location');
				else{
					$data['message'] = $this->mysql->error;
					$this->load->view('error',$data);
				}
			}
			else{
				$data['message'] = 'Veuillez remplir tous les formulaires';
				$this->load->view('error',$data);
			}
		}
		else{
			$data['message'] = 'Vous n\'avez pas les droits pour ajouter un produit';
			$this->load->view('error',$data);
		}
	}
	
	public function voir_commentaires($id_product){
	
		$id_product = intval($id_product);
		$produit = $this->produits_model->get($id_product);
		$com_array = $this->commentaires->get_commentaires($id_product);
		$data['title'] = 'Commentaires du produit '.$produit['nom'];
		$data['id_produit'] = $id_product;
		$data['commentaires'] = $com_array;
		$data['description_produit'] = $produit['description'];
		
		$this->load->view('produit/commentaires_view',$data);
	}
	
	public function ajouter_commentaire(){
		$id_product = $this->input->post('id_product'); // dans un input hidden
		$texte = $this->input->post('texte');
		if($id_product && $texte){
			if($session->userdata('type') >= 1){
				$this->commentaire->add($id_product, $texte);
				$this->voir_commentaires($id_product); // chargement de la vue
			}
			else{
				$data['message'] = "Vous n'avez pas les droits requis";
				$this->load->view('error',$data); // erreur de droit
			}
		}
		else{
			$data['message'] = "Veuillez remplir tous les formulaires";
			$this->load->view('error',$data); // Erreur forumulaire incomplet
		}
	}
	public function view($etab_id,$filtre = NULL){
		if($this->session->userdata('type') > 0){
		
			
			$etablissements = $this->etablissement_model->search(NULL,NULL ,NULL, NULL, NULL);
		
			$this->load->view('modules/header',array('title' => "iSandwich :: Nos établissements");
			
			$this->load->view('produits/header_produit',$etablissement);
			
			$view_id 				= intval($etab_id);
			$selected_etab 			= $this->etablissement_model->get($view_id);
			$news_etab 				= $this->news->search("etablissement_id = $view_id",NULL, NULL, 'date_creation DESC',NULL);
			$data['etablissement'] 	= $selected_etab;
			$data['news'] 			= $news_etab;
			$data['image'] 			= "../../assets/imgs/$etab.jpg";
			$this->load->view('produits/info_etablissement',$data);
			
			$produits = $this->prduits_model->get_products_from($view_id);
			$dataProduit['produis'] = $produits;
			$this->load->view('produits/tableau',$dataProduit);
		}
		else
			redirect('/index.php','location');
	}
}