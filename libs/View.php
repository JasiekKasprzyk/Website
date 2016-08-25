<?php
class View
{
	function __construct()
	{
	}
	
	public function Render($name)
	{	
		if (isset($this->controller))
		{
			$file = 'views/'.$this->controller.'/'.$name.".php";
		}
		if(isset($file) && file_exists($file)) require_once $file;
		else
		{
			header('Location: /Website/errorcontroller');
		}
	}
}
?>