<?php
namespace Framework;

use Framework\Router\Router;
use Framework\Exception\HttpNotFoundException;
use Framework\Response\Response;
use Framework\DI\Service;
/**    
 * Application.php
 * 
 * PHP version 5
 *
 * @category   Category Name
 * @package    Package Name
 * @subpackage Subpackage name
 * @author     dimmask <ddavidov@mindk.com>
 * @copyright  2011-2013 mindk (http://mindk.com). All rights reserved.
 * @license    http://mindk.com Commercial
 * @link       http://mindk.com
 */

class Application {
	private $response;
	
	public function __construct($config=null){ //Переделать с учетом DI
		if(is_string($config) && file_exists($config))
			$config=require($config);
			
		$this->configure($config);	
	}
	
	public function __get($name){ // Удалить
		if(isset($this->$name)){
			return $this->$name;
		}
		
		$this->$name=NULL;
	}
	
	public function run(){
		service::set('db', 'Framework\Connection');
		service::set('configuration', '\Framework\Configuration');
		service::set('Router', '\Framework\Router\Router');
		service::set('request', '\Framework\Request\Request');
		
		$routes = service::get('configuration')->get('routes');
		
		$router = new Router($routes);
		//var_dump($_SERVER['REQUEST_URI']);
		$route =  $router->parseRoute($_SERVER['REQUEST_URI']);
		//require_once('../src/Blog/Controller/PostController.php');
		
		//var_dump($route);
        try{
	        if(!empty($route)){
				//var_dump($route);
		        $controllerReflection = new \ReflectionClass($route['controller']);
		        //var_dump($controllerReflection);
		        $action = $route['action'] . 'Action';
		        if($controllerReflection->hasMethod($action)){
					//var_dump($controllerReflection);
			        $controller = $controllerReflection->newInstance();
			        $actionReflection = $controllerReflection->getMethod($action);
			        //var_dump($route['params']);
			        //var_dump($action);
			        $this->response = $actionReflection->invokeArgs($controller, $route['params']);
			        //var_dump($this->response);
			        if($this->response instanceof Response){
				    	// ...
				    	//var_dump($this->response);
			        } else {
				        throw new BadResponseTypeException('Ooops');
			        }
		        }
			} else {
		        throw new HttpNotFoundException('Route not found');
			}
        }catch(HttpNotFoundException $e){
	         // Render 404 or just show msg
        }
        catch(AuthRequredException $e){
	    	// Reroute to login page
	        //$response = new RedirectResponse(...);
        }
        catch(\Exception $e){
	        // Do 500 layout...
	        echo $e->getMessage();
        }
        
        if($this->response instanceof Response){
			$this->response->send();
        } else {
	        die('Ooops');
        }
		
	}
	
	public function configure($config){ // Удалить
		if(is_array($config)) {
			foreach($config as $key=>$value)
				$this->$key=$value;
		}
	}
} 
