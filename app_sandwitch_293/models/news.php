<?php
class News extends MY_Model{

	function __construct(){
		parent::__construct();
		$this->table_name = 'news';
	}
	
	
}