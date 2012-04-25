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
}