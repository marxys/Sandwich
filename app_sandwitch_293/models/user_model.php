<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends MY_Model
{
	
	public function __construct() {
		$this->table_name = 'user';	
		parent::__construct();
	}
	
}
/* End of file news_model.php */
/* Location: ./application/models/news_model.php */