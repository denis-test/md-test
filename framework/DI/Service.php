<?php
namespace Framework\DI;
/**    
 * Service.php
 * 
 */

class Service {
	protected static $services = array();
	protected static $configs = array();
	
	
	
	public static function set($service_name, $service_namespace){
		//self::$services[$service_name] = $obj;
		self::$configs[$service_name] = $service_namespace;
	}
	
	public static function get($service_name){
		if(!isset(self::$services[$service_name])){
			self::$services[$service_name] = new self::$configs[$service_name];
		}
		
		return self::$services[$service_name];
	}
} 
