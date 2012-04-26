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
		$this->load->model('produits_model','produit');
		$this->produit->init();	
	}
	
	function insert() {
		if($this->session->userdata('type') > 0)	{
			
			$id_produit = $this->input->post('id_produit');
			$id_etab 	= $this->input->post('id_etab');
			$qte 		= $this->input->post('qte');
			
			if(!$this->session->userdata("cmd_$id_etab")){
				
				$id_cmd = $this->cmd->insert(array( 	'user_id' 			=> $this->session->userdata('id_user'),
														'etablissement_id' 	=> $id_etab ));
														
				$this->session->set_userdata("cmd_$id_etab",intval($id_cmd));
												
				if(!$id_cmd) {
						$this->json->setError(-1);
						$this->json->setMessage('Impossible de créer une commande');
						$this->json->call('error',array($this->json->getMessage()));
						echo json_encode($this->json->get());	
						return false;	
					
				}
			
			
			}
			else $id_cmd = $this->session->userdata("cmd_$id_etab");
			
			if($this->cmd->add_product($id_produit,$id_cmd,$qte)) {
				$this->json->setMessage('Le produit à été ajouté au panier');
				$selected_product = $this->produit->get($id_produit);
				$this->json->call('add_product',array($this->cmd->count_product()));
				$this->json->call('notification',array('produit ajouté',$selected_product['nom']."<br /> Quantité : $qte"));
				echo json_encode($this->json->get());	
			}
			else {
				$this->json->setError(-1);
				$this->json->setMessage('Impossible d\'ajouter un produit à la commande');
				$this->json->call('error',array($this->json->getMessage()));
				echo json_encode($this->json->get());		
			}
			
		}
	}
}