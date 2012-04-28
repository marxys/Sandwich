<?php
class News_model extends MY_Model{

	function __construct(){
	
		parent::__construct();
		$this->table_name = 'news';
	}
	
	/*
	 Jointure qui récupère les données de la news $id_news
	*/
	public function get_news_and_etablissement($id_news){
		$query = "SELECT *, COUNT(*) AS 'is_present' FROM ".$this->table_name.",etablissement WHERE ".$this->table_name.".id = ? AND ".$this->table_name.".etablissement_id = etablissement.id ORDER BY ".$this->table_name.".id DESC";
		$result = $this->mysql->qexec($this->table_name.'_get_n_e',$query,array($id_news));
		$result = $result->fetch();
		if(intval($result['is_present']) > 0){
			return $result;
		}
		return false;
	} 
}