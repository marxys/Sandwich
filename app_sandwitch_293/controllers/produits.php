<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Produits extends CI_Controller{

	function __construc(){
		parent::__construc();
		$this->load->model('produits_model');
		$this->load->model('commentaires');
		$this->produits_model->init();
		$this->commentaires->init();
	}
	
	public function voir_commentaires($id_product){
		$id_product = intval($id_product);
		$produit = $this->produits_model->get($id_product); $produit = $produit->fetch();
		$com_array = $this->commentaires->get_commentaires($id_product);
		$data['title'] = 'Commentaires du produit '.$produit['nom'];
		$data['id_produit'] = $id_product;
		$data['commentaires'] = $com_array;
		$data['description_produit'] = $produit['description'];
		
		$this->load->view('produit/commentaires_view',$data);
	}
	
	public function ajouter_commentaire(){
		
	}
}