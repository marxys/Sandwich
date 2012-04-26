<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Commandes extends CI_Controller{

	protected $titre_defaut;
	function __construct(){
		parent::__construct();
		$this->titre_defaut = 'iSandwich :: Nos établissements';
		$this->load->library('input');
		$this->load->model('commandes_model','cmd');
		$this->news->init();
		$this->load->model('etablissement_model','etab');
		$this->etab->init();	
	}
	
	function insert() {
		if($this->session->userdata('type') > 0)	{
			
			$id_produit = $this->input->post('id_produit');
			$id_etab = $this->input->post('id_etab');
			
			if(!$this->session->userdata("cmd_$id_etab")){
				$this->session->set_userdata("cmd_$id_etab",true);
				$this->cmd->insert(array( 	'user_id' 			=> $this->session->userdata('id_user'),
											'etablissement_id' 	=> $id_etab ));
			
			$this->
			
			
		}
	}
}