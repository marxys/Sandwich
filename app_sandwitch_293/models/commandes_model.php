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
		
		$query = '	SELECT 
							cmd.id,
							etab.nom AS etablissement, 
							date_commande AS date, 
							SUM(quantite) AS quantite, 
							SUM(quantite*prix) AS prix,
							date_livraison
					FROM commandes cmd 
						
						LEFT JOIN produits_has_commandes phc 	ON cmd.id = phc.commandes_id 
						LEFT JOIN produits 						ON produits.id = phc.produits_id 
						LEFT JOIN etablissement etab 			ON cmd.etablissement_id = etab.id  
					
					WHERE cmd.user_id = ? 
					GROUP BY commandes_id
					';	
					
		$retour = $this->mysql->qexec('get_cmd_list',$query,array(intval($user_id)));
		if($retour) return $retour->fetchAll();
		else {
			log_message('error',$this->mysql->error);
			return false;
		}
	}
	
	function get_cmd($cmd_id) {
		$query_cmd ='SELECT 
						etab.nom AS etablissement_nom,
						date_commande,
						date_livraison,
						adresse_livraison
					FROM commandes cmd 
						LEFT JOIN produits_has_commandes phc 	ON cmd.id = phc.commandes_id
						LEFT JOIN etablissement etab 			ON cmd.etablissement_id = etab.id  
					WHERE cmd.id = ? ';
					
		$product_query = ' 	SELECT  
								nom,
								description,
								prix,
								quantite,
								(prix*quantite) AS prix_total
							FROM produits p
								LEFT JOIN produits_has_commandes phc 	ON p.id = phc.produits_id
							WHERE phc.commandes_id = ? ';
					
		$retour_cmd = $this->mysql->qexec('get_cmd',$query_cmd,array(intval($cmd_id)));
		$product_retour = $this->mysql->qexec('get_cmd_produits',$product_query,array(intval($cmd_id)));
		if($retour_cmd && $product_retour) {
			$retour =  $retour_cmd->fetchAll();
			$retour[0]['produits'] = $product_retour->fetchAll();
			return $retour[0];
		}
		else {
			log_message('error',$this->mysql->error);
			return false;
		}
		
	}
	
	

	
}