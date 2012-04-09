<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends CI_Controller{
	

	
	function __construc(){
		parent::__construc();
		$this->load->model('news');
		$this->load->library('input');
	}
	/*
	Ajoute un élément News à la base de données, les variables sont passée par POST
	*/
	function add(){
		$titre = $this->input->post('titre');
		$description = $this->input->post('description');
		$etablissement = $this->input->post('etablissement_id');
		
	
		// ajouter la date de creation.
		if($titre && $description && $etablissement){
			$result = $this->news->add(array(
						'titre'=> $titre,
						'description' => $description,
						'etablissement_id' => $etablissement));
			if($result){
				// Recharger la page
			}
			else{
				// Recharger la page en indiquant qu'il y eut une erreur lors de l'ajout.
			}
		}
		else{
			// Renvoyer qu'il manque des éléments. => Recharger la page avec message d'erreur ?? 
		}
	}
	function del($id){
		
		$news = $this->get($id);
		$news = $news->fetch();
		if($news['etablissement_id'] == $id){
			$this->delete($id);
		}
		else{
		 	$this->load->views(''); // load la vue erreur, vous n'avez pas les droits.
		}
	}
}