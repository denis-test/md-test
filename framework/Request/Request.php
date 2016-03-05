<?php
namespace Framework\Request;
/**
 * Class Request
 *
 */
class Request
{
    protected $request;
    protected $query;
    protected $uri;
    protected $method;
    
    /**
     * Initialize request params
     */
    public function __construct()
    {
        $this->request = $_POST;
        $this->query = $_GET;
        $this->uri = isset($this->server['REQUEST_URI']) ? $this->server['REQUEST_URI'] : '';
        $this->method = isset($this->server['REQUEST_METHOD']) ? strtoupper($this->server['REQUEST_METHOD']) : '';
        
    }
}
