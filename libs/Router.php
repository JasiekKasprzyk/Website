<?php
class Router
{
	function __construct()
	{
		$this -> request = $_GET['url'];
		$this -> request = rtrim($this -> request, "/");
		$this -> params = explode("/", $this -> request);
		
		$this -> controller = $this -> params[0];
		if($this -> controller == "index.php") $this -> controller = "Index"; 
		$this -> controller = ucfirst($this -> controller);
		$file = 'controllers/'.$this->controller.".php";
		if(!file_exists($file))
		{
			$this -> controller ="Index";
			$file = 'controllers/'.$this->controller.".php";
		}
		require_once $file;
		$this -> control = new $this -> controller($this->params);
	}	
}
?>