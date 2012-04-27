<?php
class Promo extends MY_Model{

	function __construct(){
		parent::__construct();
		$this->table_name = "promo";
	}
	
	public function get_by_id_product($id_product){
		$query = "SELECT * FROM ".$this->table_name." WHERE Produits_id = ?";
		$result = $this->mysql->qexec($this->table_name.'_get',$query,array($id_product));
		$result = $result->fetchAll();
		return $result;
	}
}