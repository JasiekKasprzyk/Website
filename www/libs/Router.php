<?php
class Router
{
	function __construct()
	{
		$this -> request = $_GET['url'];
		$this -> params = explode("/", $this -> request);
		
		$this -> controller = $this -> params[0];
		if($this -> controller == "index.php") $this -> controller = "Index"; 
		$this -> controller = ucfirst($this -> controller);
		echo $this -> controller;
		
		require_once 'controllers/'.$this->controller.".php";
		
		$this -> control = new $this -> controller($this->params);
	}	
}
?>