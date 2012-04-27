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
	
	function get_cmd_list($user_id) {
		
		$query = "	SELECT 
							etab.nom AS etablissement, 
							date_commande AS date, 
							SUM(quantite) AS quantite, 
							SUM(quantite*prix) AS prix 
					FROM commandes cmd 
						
						LEFT JOIN produits_has_commandes phc 	ON cmd.id = phc.commandes_id 
						LEFT JOIN produits 						ON produits.id = phc.produits_id 
						LEFT JOIN etablissement etab 			ON cmd.etablissement_id = etab.id  
					
					GROUP BY commandes_id
					WHERE cmd.user_id= ? ";	
					
		$retour = $this->mysql->qexec('get_cmd_list',$query,array(intval($user_id)));
		if($retour) return $retour->fetchAll();
		else {
			log_message('error',$this->mysql->error);
			return false;
		}
	}
	
	

	
}