<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Etablissement extends CI_Controller{

	function __construc(){
		parent::__construc();
		$this->titre_defaut = 'iSandwich :: Nos établissements';
		$this->load->library('input');
		$this->load->model('etablissement_model','etab');
		$this->etab->init();
		$this->load->model('news_model','news');
		$this->news->init();
	}
	
	function view($view_id = NULL) {
		
		foreach ($this->etab->search(NULL,NULL ,NULL, NULL, NULL) as $etab) {
			$data['title'] = $etab['nom'];
			$data['image'] = "../../assets/imgs/$etab.jpg";
			$data['infos'] = array (
								'slogan' 			=> $etab['slogan'],
								'adresse' 			=> $etab['adresse'],
								'coordonnées'		=> $etab['gps']
								);
			$this->load->view('modules/vignette.php',$data);
		}
		if(!empty($view_id)) {
			$view_id 				= intval($view_id);
			$selected_etab 			= $this->etab->get($view_id);
			$news_etab 				= $this->news->search("etablissement_id = $view_id",NULL, NULL, 'date_creation DESC',NULL);
			$data['etablissement'] 	= $selected_etab;
			$data['news'] 			= $news_etab;
			$data['image'] 			= "../../assets/imgs/$etab.jpg";
			
		}
			
	}
}
