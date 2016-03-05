<?php
namespace Framework\Renderer;
/**
 * Class Renderer
 * @package Framework\Renderer
 */
class Renderer {
	/**
	 * @var string  Main wrapper template file location
	 */
	protected $main_template = '';
	/**
	 * Class instance constructor
	 *
	 * @param $main_template_file
	 */
	public function __construct($main_template_file){
		$this->main_template = $main_template_file;
		//var_dump($this->main_template);
	}
	/**
	 * Render main template with specified content
	 *
	 * @param $content
	 *
	 * @return html/text
	 */
	public function renderMain($content){
		//@TODO: set all required vars and closures..
		//var_dump($content);
		return $this->render($this->main_template, compact('content'), false);
	}
	/**
	 * Render specified template file with data provided
	 *
	 * @param   string  Template file path (full)
	 * @param   mixed   Data array
	 * @param   bool    To be wrapped with main template if true
	 *
	 * @return  text/html
	 */
	public function render($template_path, $data = array(), $wrap = true){
		//var_dump($data);
		extract($data);
		
		//var_dump($template_path);
		// @TODO: provide all required vars or closures...
		
		$include = function($p1, $p2, $p3){
				
			};
		$getRoute = function($pr1){
				echo 'Hi I\'m getRoute('.$pr1.')';
			};
		$user = NULL;
		$flush = array(); 
		ob_start();
		include( $template_path );
		//$content = ob_end_clean();
		$content = ob_get_clean();
		//$content = ob_get_contents();
		//ob_end_clean(); 
		
		//var_dump($content);
		if($wrap){
			$content = $this->renderMain($content);
			//var_dump($content);
		}
		return $content;
	}
} 
