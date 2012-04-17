<?php
class Commentaires extends MY_Model{

	function __construct(){
		parent::__construct();
		$this->table_name = 'commentaires';
	}
	
	public function get_commentaires($id_product){
		$query = "SELECT * FROM ".$this->table_name." WHERE Produits_id = ?";
		$result = $this->mysql->qexec($this->table_name.'_get_commentaires',$query,array($id_product));
		$result = $result->fetch();
		return $result;
	}
}