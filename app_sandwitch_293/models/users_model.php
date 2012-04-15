<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends MY_Model
{
	
	public function __construct() {
		parent::__construct();
		$this->table_name = 'user';	
	}
	
	
	public function get_by_login($login){
		$query = "SELECT *, COUNT(*) AS 'is_present' FROM ".$this->table_name." WHERE login = ?";
		$result = $this->mysql->qexec($this->table_name.'_get_login',$query,array($login));
		$result = $result->fetch();
		if(intval($result['is_present']) > 0){
			return $result;
		}
		return false;
	}
}
/* End of file news_model.php */
/* Location: ./application/models/Users_model.php */