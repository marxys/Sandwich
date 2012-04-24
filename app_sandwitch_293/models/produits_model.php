<?php
class Produits_model extends MY_Model{

	function __construct(){
		parent::__construct();
		$this->table_name = 'produits';
	}
	
}