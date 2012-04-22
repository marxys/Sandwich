<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Etablissement extends CI_Controller{
	protected $titre_defaut;
	function __construc(){
		parent::__construc();
		$this->titre_defaut = 'iSandwich :: Nos établissements';
		$this->load->library('input');
	
	}
	
	function view($view_id = NULL) {
		$this->load->model('etablissement_model','etab');
		$this->etab->init();
		$this->load->model('news_model','news');
		$this->news->init();
		
		$etablissements = $this->etab->search(NULL,NULL ,NULL, NULL, NULL);
		echo '<pre>';
			print_r($etablissements );
			echo '</pre>';
		$finalview = $this->load->view('modules/header',array('title' => $this->titre_defaut),true);
		$i=0;
		foreach ($etablissements as $etab) {
			$name_array['etablissement'][$i]['name'] = $etab['nom'];
			$name_array['etablissement'][$i]['id'] = $etab['id'];
			$data['title'] = $etab['nom'];
			$data['image'] = "../../assets/imgs/$etab.jpg";
			$data['infos'] = array (
								'slogan' 			=> $etab['slogan'],
								'adresse' 			=> $etab['adresse'],
								'coordonnées'		=> $etab['gps']
								);
			$finalview .= $this->load->view('modules/vignette',$data,true);
			$i++;
			
		}
		$finalview = $this->load->view('produits/header_produit',$name_array, true).$finalview;
		
		if(!empty($view_id)) {
			$view_id 				= intval($view_id);
			$selected_etab 			= $this->etab->get($view_id);
			$news_etab 				= $this->news->search("etablissement_id = $view_id",NULL, NULL, 'date_creation DESC',NULL);
			$data['etablissement'] 	= $selected_etab;
			$data['news'] 			= $news_etab;
			$data['image'] 			= "../../assets/imgs/$etab.jpg";
			$finalview .= $this->load->view('produits/info_etablissement',$data,true);
			
		}
		$finalview .= $this->load->view('modules/footer','',true);
		$data['view'] = $finalview;
		$this->load->view('modules/view',$data);
			
	}
}
