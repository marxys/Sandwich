<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends CI_Controller{
	

	
	function __construc(){
		parent::__construc();
		$this->load->model('news_model');
		$this->news_model->init();
		$this->load->library('input');
		$this->load->model('etablissement_model');
		$this->etablissement_model->init();
	}
	/*
	Ajoute un élément News à la base de données, les variables sont passée par POST
	*/
	function add(){
		$titre = $this->input->post('titre');
		$description = $this->input->post('description');
		$user_id = $this->input->post('user_id');
		// ajouter la date de creation.
		if($titre && $description && $user_id){
			$etablissement = $this->etablissement_model->get_by_user_id($user_id);
			$etablissement = $etablissement->fetch();
			if($etblissement){ // si l'etablissement associé a ce user_id existe
				if($this->session->userdata('user_id') == $user_id){ // Verifier si la personne connectée est la bonne
					if($this->news_model->insert(array(
								'titre'=> $titre,
								'description' => $description,
								'etablissement_id' => $etablissement))){
						
					}			
					else{
						// Recharger la page en indiquant qu'il y eut une erreur lors de l'ajout.
					}
				}
				else{
					// Renvoyer qu'il manque les droits.
				}
			}
		}
		else{
			// Renvoyer qu'il manque des éléments. => Recharger la page avec message d'erreur ?? 
		}
	}
	function del($id_news){
	
		$join_news_etab = $this->news_model->get_news_and_etablissement($id_news);
		if($join_news_etab['is_present'] > 0){
			if($join_news_etab['user_id'] == $this->session->userdata['user_id']){
				$this->news_model->delete($id);
			}
			else{
				$this->load->views(''); // load la vue erreur, vous n'avez pas les droits.
			}
		}
		else{
			$this->load->views('');
		}
	}
}