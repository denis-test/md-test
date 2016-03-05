<?php
namespace Framework\Controller;

use Framework\Response\Response;
use Framework\Renderer\Renderer;
/**
 * Class Controller
 * Controller prototype
 *
 * @package Framework\Controller
 */
abstract class Controller {
	/**
	 * Rendering method
	 *
	 * @param   string  Layout file name
	 * @param   mixed   Data
	 *
	 * @return  Response
	 */
	
	protected $path = '/home/site/prj/mindk-test.local/www/src/Blog/';
	protected $ViewCatalog = 'views';
	protected $PathToView;
	protected $ViewExtension = '.php';
	protected $ControllerName;
	protected $main_layout;
	
	public function __construct(){
		$this->main_layout = __DIR__.'/../../src/Blog/views/layout.html.php';
		$path = dirname($this->main_layout);
		$this->ControllerName = get_class($this);
		$str_pos = strrpos ($this->ControllerName, '\\');
		$this->ControllerName = substr($this->ControllerName, $str_pos +1);
		$this->ControllerName = str_replace('Controller','',$this->ControllerName);
		$this->PathToView = realpath($path.DIRECTORY_SEPARATOR.$this->ControllerName.DIRECTORY_SEPARATOR);
		$this->PathToView = $this->PathToView.DIRECTORY_SEPARATOR;
		
	}
	 
	public function render($layout, $data = array()){
		// @TODO: Find a way to build full path to layout file
		//$pathToView = '/home/site/prj/mindk-test.local/www/src/Blog/views/Post/';
		$layout = $this->PathToView.$layout.$this->ViewExtension;
		//var_dump($layout);
		
		//$fullpath = realpath($pathToView . $layout.'.php');
		//var_dump($fullpath);
		//$fullpath = realpath('...' . $layout);
		$renderer = new Renderer($this->main_layout); // Try to define renderer like a service. e.g.: Service::get('renderer');
		$content = $renderer->render($layout, $data);
		return new Response($content);
	}
} 
