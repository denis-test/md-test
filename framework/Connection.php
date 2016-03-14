<?php
namespace Framework;

use Framework\DI\Service;

class Connection {
	private $db;
	
	/**
	 * Class constructor
	 */
	public function __construct(){
		$pdo = service::get('configuration')->get('pdo');
		$pdo['dns'] = 'mysql:dbname=education;host=localhost;charset=utf8';
		
		$this->db =  new \PDO($pdo['dns'], $pdo['user'], $pdo['password']); 
	}
	
	
	public function getDBCon(){
		return $this->db;
	}
	
}
