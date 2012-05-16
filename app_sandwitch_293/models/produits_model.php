<?php
class Produits_model extends MY_Model{

	function __construct(){
		parent::__construct();
		$this->table_name = 'produits';
	}
	
	
	public function isOwner($id_product){
		$user_id = $this->session->userdata('user_id');
		$query = "SELECT *,COUNT(*) AS 'is_present' FROM ".$this->table_name." WHERE id = ? AND etablissement_id IN (SELECT id FROM etablissement WHERE user_id = $user_id)";
		$result = $this->mysql->qexec($this->table_name.'_isOwner',$query,array($id_product));
		$result = $result->fetch();
		if(intval($result['is_present']) > 0){
			return true;
		}
		return false;  
	}

	public function get($id) {
		$query = 'SELECT 
							*,
							promo,
							produits.id AS id,
							prix AS old_prix,
							IF(promo IS NULL,prix,(promo * prix)) AS prix
				FROM produits
							LEFT JOIN promo ON promo.produits_id = produits.id AND (NOW() BETWEEN promo.debut AND promo.fin)
							
							WHERE produits.id = ?';
							
		$result = $this->mysql->qexec($this->table_name.'_get_spec',$query,array($id));
		
		$result = $result->fetchAll();
	
		
		return $result[0];
	}
	
	public function get_product_list($etab_id, $categorie, $search) {
			
			$i=0;
			$query = "	SELECT 
						*,
						produits.id AS id,
						IF(promo IS NULL,prix,(promo * prix)) AS prix
						FROM produits
							LEFT JOIN promo ON promo.produits_id = produits.id AND (NOW() BETWEEN promo.debut AND promo.fin)
						WHERE deleted = 0 AND etablissement_id = ? ";
			$array[$i++] = $etab_id;
			
			if($categorie != NULL){ 
				$query .= " AND categorie_id = ? ";
				$array[$i++] = $categorie;
			}
			
			if($search != NULL) {
				$search = explode(' ',$search);
				$quote = "";
				foreach($search as $mot) $quote.= "%$mot%";
				$array[$i++] = $quote;
				$array[$i++] = $quote;
				$array[$i++] = $quote;
				$query .= "AND (description LIKE ? OR nom LIKE ? OR prix LIKE ?)";
			}
			log_message('error',$query);
			$result = $this->mysql->qexec($this->table_name.'_get_by_flitre_'.$i,$query,$array);
		
		$result = $result->fetchAll();
		return $result;
	}
}