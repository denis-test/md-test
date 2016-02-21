<?php
namespace Framework\Router;
/**
 * Router.php
 */
class Router{
	/**
	 * @var array
	 */
	protected static $map = array();
	/**
	 * Class construct
	 */
	public function __construct($routing_map = array()){
		self::$map = $routing_map;
	}
	/**
	 * Parse URL
	 *
	 * @param $url
	 */
	public function parseRoute($url){
    
		$route_found = null;
		//var_dump(self::$map);
		echo "<pre>";
		foreach(self::$map as $route){
			
			$pattern = $this->prepare($route);
			//echo $pattern.'<br />';
			if(preg_match($pattern, $url, $params)){
				//var_dump($route['pattern']);
				//var_dump($params);
				
				// Get assoc array of params:
				preg_match($pattern, str_replace(array('{','}'), '', $route['pattern']), $param_names);
				//var_dump($param_names);
				$params = array_map('urldecode', $params);
				//var_dump($params);
				$params = array_combine($param_names, $params);
				//var_dump($params);
				array_shift($params); // Get rid of 0 element
				$route_found = $route;
				$route_found['params'] = $params;
				//break;
			}
		}
		return $route_found;
	}
	
	public function buildRoute($route_name, $params = array()){
		$route_found = '';
		
		if(isset(self::$map[$route_name])){
			$route = self::$map[$route_name];
			
			//Find all placeholders
			preg_match('~\{[\w\d_]+\}~Ui', $route['pattern'], $placeholders);
				
			foreach ($placeholders as $key => $placeholder) {
				$placeholder = str_replace(array('{','}'), '', $placeholder);
				
				if (isset($route['_requirements'][$placeholder])){
					$pattern = '~^'. $route['_requirements'][$placeholder].'$~';
				}else{
					$pattern = '~^[\w\d_]+$~';
				}
				
				if(isset($params[$placeholder]) && preg_match($pattern, $params[$placeholder], $result)){
					$route_found = str_replace('{'.$placeholder.'}', $params[$placeholder], $route['pattern']);
				}else{
					$route_found = '';
					break;
				}
			}
		}
		
		return $route_found;
	}
	
	private function prepare($route){
		$pattern = preg_replace('~\{[\w\d_]+\}~Ui','([\w\d_]+)', $route['pattern']);
		$pattern = '~^'. $pattern.'$~';
		return $pattern;
	}
}
//if(!empty($placeholders)){
				/*
				foreach ($placeholders as $placeholder) {
					$placeholder = str_replace(array('{','}'), '', $placeholder);
					
					if (isset($route['_requirements'][$placeholder])){
						$pattern = '~^'. $route['_requirements'][$placeholder].'$~';
					}else{
						$pattern = '~^[\w\d_]+$~';
					}
					
					if(isset($params[$placeholder])){
						preg_match($pattern, $params[$placeholder], $result);
					}else{
						$error_found = true;
						break;
					}	
					
					if ($result){
						$tmp_route_found = str_replace('{'.$placeholder.'}', $params[$placeholder], $route['pattern']);
					}else{
						$error_found = true;
						break;
					}
				}*/
				
					//$error_found? : $route_found = $tmp_route_found;
			//}
