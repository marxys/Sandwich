<?php
class Categorie_model extends MY_Model{

	function __construct(){
		parent::__construct();
		$this->table_name = 'categorie';
		
	}
	
	public function get_by_name($name){
		$query = "SELECT *, COUNT(*) AS 'is_present' FROM ".$this->table_name." WHERE nom = ?";
		$result = $this->mysql->qexec($this->table_name.'_get_categorie',$query,array($name));
		$result = $result->fetch();
		if(intval($result['is_present']) > 0){
			return $result;
		}
		return false;
	}
}