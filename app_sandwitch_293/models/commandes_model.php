<?php
class Commandes_model extends MY_Model{

	function __construct(){
		parent::__construct();
		$this->table_name = 'commandes';
		$this->load->model('produits_has_commandes_model','produits');
		$this->produits->init();	
	}
	
	function count_product($id_cmd) {
		$id_cmd = intval($id_cmd);
		$rep = $this->produits->search("commandes_id = $id_cmd",NULL,NULL,NULL,NULL);
		if($rep){
			$nbr = 0;
			foreach($rep as $value) {
				$nbr = $nbr + $value['quantite'];
			}
			return $nbr;			
		}
		else {
			log_message('error',$this->mysql->error);
			return false;
		}
	}
	
	function add_product($id_produit,$id_cmd,$qte) {
		
		$this->produits->insert(array(			'produits_id' 	=> intval($id_produit),
												'commandes_id' 	=> intval($id_cmd),
												'quantite'		=> intval($qte)	));
		
		return true;
	}

	
}