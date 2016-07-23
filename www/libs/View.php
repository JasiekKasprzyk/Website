<?php
class View
{
	function __construct()
	{
	}
	
	public function Render()
	{
		require_once 'views/Header.php';
		if (isset($this->controller)&& isset($this->page))
		{
			$file = 'views/'.$this->controller.'/'.$this->page.".php";
		}
		if(isset($file) && file_exists($file)) require_once $file;
		else
		{
			require_once 'views/Error.php';
		}
	}
}
?>