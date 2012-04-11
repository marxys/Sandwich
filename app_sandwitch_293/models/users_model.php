<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends MY_Model
{
	
	public function __construct() {
		$this->table_name = 'user';	
		parent::__construct();
	}
	
	
	public get_by_login($login){
		$query = "SELECT *, COUNT(*) as 'is_present' FROM ".$this->table_name." WHERE login = $login";
		$result = $this->mysql->query($query);
		if($result['is_present'] > 0){
			return $result;
		}
		return false;
	}
}
/* End of file news_model.php */
/* Location: ./application/models/Users_model.php */