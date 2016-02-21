<?php
namespace Framework\Response;

class Response {

	public function sendHeaders()
	{
		header("HTTP/1.0 404 Not Found");
	
		return $this;
	}
	
	public function outputBody()
    {
        $body = "Hi, I'm Body";
        echo $body;
    }

 
	public function sendResponse()
    {
        $this->sendHeaders();
		
        $this->outputBody();
    }
}
