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
	
	public function dateUsed($id, $date1, $date2) {
		$rep = $this->mysql->qexec(	'pormo_isFrees',
									"SELECT COUNT(*) FROM promo WHERE (( debut BETWEEN '$date1' AND '$date2' ) OR ( fin BETWEEN '$date1' AND '$date2' )) AND produits_id = ? ",
									array($id));
		$nbr = $rep->fetch();
		
		if($nbr[0] > 0) return true;
		else return false;	
	}
}