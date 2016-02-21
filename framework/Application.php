<?php
namespace Framework;
use Framework\Router\Router;
use Framework\Response\Response;

/*
 * Class Application
 */

class Application {
	public function run(){
		$router = new Router(include('../app/config/routes.php'));
		//var_dump($_SERVER['REQUEST_URI']); // /login
		//$route =  $router->parseRoute($_SERVER['REQUEST_URI']);
		$routes = array( '/','/test_redirect','/test_json','/signin',
			'/login','/logout','/profile','/profile','/posts/8','/posts/add',
			'/posts/10/edit',);
		foreach ($routes as $key){
			var_dump('----------------------------START---------------------------');
			$route =  $router->parseRoute($key);

		    if(!empty($route)){
		
		    } else {
		
		    }
	
		    echo '<pre>';
			//print_r($route);
			
			
			
		}
		//$route =  $router->buildRoute('edit_post', array('id' => 8));
		$route =  $router->buildRoute('add_post');
		
		$response = new Response();
		$response->sendResponse();
	}
	
}
