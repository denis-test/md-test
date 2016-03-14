<?php
namespace Framework;
/**    
 * Configuration.php
 * 
 */

class Configuration {
	protected $configs = array();
	
	public function __construct($configFilePath = null){
		$configFilePath = __DIR__.'/../app/config/config.php';
		$this->configs = include($configFilePath);
		
		//var_dump($this->configs);
	} 
	
	public function set($name, $value){
		$this->configs[$name] = $value;
	}
	
	public function get($name){
		return $this->configs[$name];
	}
} 
