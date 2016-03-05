<?php
namespace Framework\DI;

class Service {
	protected static $instance;
	protected $containerConfig = array();
	protected static $services = array();
	
	protected function __construct() //AbstractConfig $config)
    {
        //$this->config = $config;
        //$this->init();
        $this->containerConfig['Request']['name'] = 'Request';
        $this->containerConfig['Request']['path'] = '/home/site/prj/mindk-test.local/www/framework/Request/Request.php';
        $this->containerConfig['Request']['namespace'] = 'Framework\Request';
        $this->containerConfig['Response'] = 'Response';
	}
	
	
	
	public static function getInstance() //AbstractConfig $config)
    {
        if(!self::$instance) {
            self::$instance = new self(); //$config);
        }

        return self::$instance;
    }

    /**
     * @param string $serviceName
     *
     * @return object
     */
    public function get($serviceName)
    {
        //var_dump(self::$services[$serviceName]);
		
        if(isset(self::$services[$serviceName])) {
           return self::$services[$serviceName];
        }
        
        if(isset($this->containerConfig[$serviceName])){
			self::$services[$serviceName] = new \Framework\Request\Request();
			return self::$services[$serviceName];
		}
        
        return Null;
    }
	
}
