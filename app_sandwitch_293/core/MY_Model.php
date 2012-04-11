<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// -----------------------------------------------------------------------------
/* Protocol json
['error'] = (int)
['message'] = (string)
['functions'] = array((string),..)
['functions'] ['name'] = (string)
['functions'] ['args'] = array((strings),...)
['fonctions'][X(int)]['name']
['fonctions'][X(int)]['args'][X(int)]
*/

/*
 Gestion des session : 
 
- user_id (int)
- type  (int) 0 : non_identifie, 1 : client, 2 : sandwicherie, 3 : admin
*/

class MY_Model extends CI_Model
{
	protected $table_name;
	protected $table_titles;
	
	public function __construct() {
		
		
		$this->load->library('mysql');	
		if(!$this->mysql->connect()) log_message('error',$this->mysql->error);
		
		
		parent::__construct();	
		
	
	}
	
	public function init() {
		$query = "SELECT * FROM ".$this->table_name." LIMIT 1";	
		$result = $this->mysql->query($query);
			for ($i=0; $i<$result->columnCount(); $i++){
				$col = $result->getColumnMeta($i);
				$this->table_titles[$i] = $col['name'];
			}
			
	}
	/**
	 *	Insère une nouvelle ligne dans la base de données.
	 */
	 
	 public function isUnique($field,$value) {
			
		$rep = $this->mysql->qexec('user_'.$field.'_isFree','SELECT COUNT(*) FROM user WHERE '.$field.' = ? ',array($value));
		$nbr = $rep->fetch();
		
		if($nbr[0] > 0) return false;
		else return true;
	}
	
	function insert($row) {

		
		$title = "";
		$mark = "";
		$i=0;
		foreach($this->table_titles as $entree) {
			if(isset($row[$entree])){
				
				if($i != 0) {
					$title.= ",";
					$mark.= ",";
				}
				$i++;
				
				$title .= " $entree ";
				$mark .= " :$entree ";
				
				$value[$entree] = $row[$entree];
				
			}
		}
		
		$query = "INSERT INTO ".$this->table_name."( $title ) VALUES( $mark )";
		
		//$this->logs->add_logs($query);
		if($this->mysql->insert($this->table_name."_insert", $query,$value)) return true;
		
		else {
			log_message('error',"Erreur dans la requête SQL :  impossible d'insérer une entrée<br />");
			log_message('error',$this->mysql->error);
			return false;
		}
	}

	/**
	 *	Récupère des données dans la base de données.
	 */
	public function get($id){
		$query = "SELECT * FROM ".$this->table_name." WHERE id = ?";
		return $this->mysql->qexec($this->table_name.'_get',$query,array(intval($id)));
	}
	
	/**
	 *	Modifie une ou plusieurs lignes dans la base de données.
	 */
	public function update()
	{		
		
	}
	
	/**
	 *	Supprime une ou plusieurs lignes de la base de données.
	 */
	public function delete()
	{
		
	}

	/**
	 *	Retourne le nombre de résultats.
	 */
	public function count()
	{
		
	}
	
	function search($keylocks,$columns, $keywords,$sort, $limit) {	
		/*"Write search conditions */
		$this->logs->add_error("keylocks : $keylocks");
		($keylocks != NULL) ? $keylocks = explode(' ',$keylocks): $keylocks = NULL;
		($columns != NULL) ? $columns = explode(' ',$columns): $columns = NULL;
		($keywords != NULL) ? $keywords = explode(' ',$keywords): $keywords = NULL;
		
		if($sort != NULL) $sort = "ORDER BY $sort";
		else $sort = "";
		
		if($limit != NULL) $limit = "LIMIT $limit";
		else $limit = "";
		
		$where ="";
		
	
		$a=0;
		
		
		if(($keylocks != NULL) && (sizeof($keylocks)%3 == 0 )) 
			foreach($keylocks as $entree) {
				if($a%3==0) foreach ($this->table_titles as $title) if($entree == $title) {
					if($a != 0) $where.= " AND ";
					$where.=" $entree ";
				}
				if($a%3==1) $where.= " $entree ";
					
				
				if($a%3==2) {
					$quote = $this->mysql->quote($entree);
					$where.= " $quote ";
					
				}
				$a++;
			
			}
			
		
		$j=0;
		if(($columns != NULL) && ($keywords!= NULL)) 
			foreach($keywords as $keyword) {
				
				$i=0;
				foreach($columns as $column) {
				
					foreach($this->table_titles as $title) if($column == $title) {
						if($a && !$j && !$i) $where .= " AND "; 
						if($j && !$i) $where .= " AND ";
						if(!$i) $where .= " ( ";
						else  $where .= " OR ";
						
						$quote = $this->mysql->quote("%$keyword%");
						$where .= " $title LIKE $quote ";
						$i++;
					}
					
				}
				
				if($i) $where.= " ) ";
				$j++;
			}
		
		$query = "SELECT * FROM ".$this->table_name;
		if($where != "") $query .=" WHERE $where ";
		
		$query.= " $sort $limit";
		
		$reponse = $this->mysql->query($query);
		
		log_message('debug',$query);
		
		if ($reponse) {
			
			return $reponse->fetchAll();
			
		}
		else {
			log_message('error',"Erreur de requête SQL pour la récupération du tableau de données.<br /> $query <br />");
			log_message('error',$this->mysql->error);
			return false;
		}
		
	}
}

/* End of file MY_Model.php */
/* Location: ./system/application/core/MY_Model.php */


