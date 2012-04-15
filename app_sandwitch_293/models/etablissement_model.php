<?php
class Etablissement_model extends MY_Model{

	function __construct(){
		parent::__construct();
		$this->table_name = 'etablissement';
	}
	
	public function get_by_user_id($user_id){
		$query = "SELECT *, COUNT(*) AS 'is_present' FROM ".$this->table_name." WHERE user_id = ?";
		$result = $this->mysql->qexec($this->table_name.'_get_user_id',$query,array($user_id));
		$result = $result->fetch();
		if(intval($result['is_present']) > 0){
			return $result;
		}
		return false;
	}
}