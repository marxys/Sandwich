<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Commandes extends CI_Controller{

	protected $titre_defaut;
	function __construct(){
		parent::__construct();
		$this->titre_defaut = 'iSandwich :: Vos commandes';
		$this->load->library('input');
		$this->load->model('commandes_model','cmd');
		$this->cmd->init();
		$this->load->model('etablissement_model','etab');
		$this->etab->init();	
		$this->load->model('produits_model','produit');
		$this->produit->init();	
		$this->load->library('json');
	}
	
	function insert() {
		if($this->session->userdata('type') > 0)	{
			
			$id_produit = $this->input->post('id_produit');
			$id_etab 	= $this->input->post('id_etab');
			$qte 		= $this->input->post('qte');
			
			if(!$this->session->userdata("cmd_$id_etab")){
				
				$id_cmd = $this->cmd->insert(array( 	'user_id' 			=> $this->session->userdata('user_id'),
														'etablissement_id' 	=> $id_etab ));
				$this->session->set_userdata("cmd_$id_etab",intval($id_cmd));
												
				if(!$id_cmd) {
						$this->json->setError(-1);
						$this->json->setMessage('Impossible de créer une commande');
						$this->json->call('error',array($this->json->getMessage()));
						echo json_encode($this->json->get());	
						return false;	
					
				}else {
				
					$this->json->call('notification',array('Commande',"une liste de commande à été créée"));	
					
				}
			
			
			}
			else $id_cmd = $this->session->userdata("cmd_$id_etab");
			
			if($this->cmd->add_product($id_produit,$id_cmd,$qte)) {
				$this->json->setMessage('Le produit à été ajouté au panier');
				$selected_product = $this->produit->get($id_produit);
				$this->json->call('add_product',array($this->cmd->count_product($id_cmd)));
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
	
	
	function view($id_cmd = NULL) {
		
		$this->load->view('modules/header',array(	'title' => $this->titre_defaut ));
		
		if(!empty($id_cmd)) {
			$commandes['list'] = $this->cmd->get_cmd(intval($id_cmd));
			$this->load->view('commandes/cmd_view',$commandes);
		}
		else {
			$commandes['list'] = $this->cmd->get_cmd_list($this->session->userdata('user_id'));
			$this->load->view('commandes/cmd_list',$commandes);
		}
		
		
		$this->load->view('modules/footer'); 	
		
	}
}