<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		
		$this->load->model('news_model');
		$this->news_model->init();
		$this->load->model('etablissement_model');
		$this->etablissement_model->init();
		$this->load->helper('url');
		$this->load->library('input');

	}
	/*
	Ajoute un élément News à la base de données, les variables sont passée par POST
	*/
	public function add(){
		$titre = $this->input->post('titre');
		$description = $this->input->post('description');
		$user_id = $this->session->userdata('user_id');
		// ajouter la date de creation.
		if($titre && $description && $user_id){
			$etablissement = $this->etablissement_model->get_by_user_id($user_id);
			if($etablissement){ // si l'etablissement associé a ce user_id existe
					if($this->news_model->insert(array(
								'titre'=> $titre,
								'description' => nl2br($description),
								'etablissement_id' => $etablissement['id']))){
 						redirect('/index.php/pages/ajouter_news', 'location');	
					}			
					else{
						$data['message'] = $this->mysql->error;
						$this->load->view('error',$data);
					}
				}
			else{
					// Renvoyer qu'il manque les droits.
				$data['message'] = "Vous n'avez pas les droits pour cette action";
				$this->load->view('error',$data);
			}
		}
		else{
			$data['message'] = "Veuillez rempir tous les formulaires";
			$this->load->view('error',$data);
		}
	}
	public function del($id_news){
	
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