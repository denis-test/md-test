<?php
namespace Framework\Model;

use Framework\DI\Service;

abstract class ActiveRecord {
	public $name; // Удалить после реализации User
	
	public static function getTable(){
		
	}
	
	
	public static function find($mode = 'all'){
		$table = static::getTable();
		$params = array();
		
		$sql = "SELECT * FROM " . $table;
		if(is_numeric($mode)){
			$sql .= " WHERE id= :mode";
			$params = array('mode' => (int)$mode);
		}
			
		$pdo = service::get('db')->getDBCon();
		
		$stmt = $pdo->prepare($sql);
		$stmt->execute($params);
		
		$result = $stmt->fetchAll(\PDO::FETCH_CLASS, "Blog\Model\Post");
		
		return $result;
	}
	protected function getFields(){ // Возможно потребуется для save, нет удалить
		//return get_object_vars($this);
		//mysql_list_fields ( string $database_name , string $table_name [, resource $link_identifier = NULL ] )
	}

	public function save(){
		$fields = $this->getFields();
		// @TODO: build SQL expression, execute
	}
}
