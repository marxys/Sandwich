<?php
class Produits_model extends MY_Model{

	function __construct(){
		parent::__construct();
		$this->table_name = 'produits';
	}
	
	public function get_products_from($etab_id){
		$query = "SELECT * FROM ".$this->table_name." WHERE etablissement_id = ? AND deleted = 0";
		$result = $this->mysql->qexec($this->table_name.'_get_poducts',$query,array($etab_id));
		$result = $result->fetchAll();
		
		return $result;
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
	public function get_from_categorie($etab_id,$name){
		$query = "SELECT * FROM ".$this->table_name." WHERE etablissement_id = ? AND deleted = 0 AND categorie_id = (SELECT id FROM categorie WHERE nom = ?)";
		$result = $this->mysql->qexec($this->table_name.'_get_by_categ',$query,array($etab_id,$name));
		$result = $result->fetchAll();
		
		return $result;
	}
	
	public function filtrage($etab_id,$search,$search_categorie){
		($search != NULL) ? $search = explode(' ',$search): $search = NULL;
		$quote = "";
		foreach($search as $mot){
			$quote.= "_%$mot%";
		}
		if($search_categorie == "Toutes"){
			$query = "SELECT * FROM ".$this->table_name." WHERE etablissement_id = ? AND deleted = 0 AND (description LIKE ? OR nom LIKE ? OR prix LIKE ?)";
			$result = $this->mysql->qexec($this->table_name.'_get_by_flitre_1',$query,array($etab_id,$quote,$quote,$quote));
		}
		else{
				$query = "SELECT * FROM ".$this->table_name." WHERE etablissement_id = ? AND deleted = 0 AND (description LIKE ? OR nom LIKE ? OR prix LIKE ?) AND categorie_id = (SELECT id FROM categorie WHERE nom = ?)";
			
			$result = $this->mysql->qexec($this->table_name.'_get_by_flitre_2',$query,array($etab_id,$quote,$quote,$quote,$search_categorie));
		}
		$result = $result->fetchAll();
		return $result;
	
	}
}