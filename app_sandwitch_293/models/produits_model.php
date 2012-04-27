<?php
class Produits_model extends MY_Model{

	function __construct(){
		parent::__construct();
		$this->table_name = 'produits';
	}
	
	public function get_products_from($etab_id){
		$query = "SELECT * FROM ".$this->table_name." WHERE etablissement_id = ?";
		$result = $this->mysql->qexec($this->table_name.'_get_poducts',$query,array($etab_id));
		$result = $result->fetchAll();
		
		return $result;
	}
	
	public function isOwner($id_product){
		$user_id = $this->session->userdata('user_id');
		$query = "SELECT *,COUNT(*) AS 'is_present' FROM ".$this->table_name.",etablissement WHERE id = ? AND etablissement_id IN (SELECT id FROM etablissement WHERE user_id = $user_id)";
		$result = $this->mysql->qexec($this->table_name.'_isOwner',$query,array($id_product));
		$result = $result->fetch();
		if(intval($result['is_present']) > 0){
			return true
		}
		return false;  
	}
}