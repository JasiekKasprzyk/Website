<?php 
 	class ErrorController extends Controller 
	{
		function __construct($params)
		{
			parent::__construct();
			$this ->view ->controller = "Error";
			$this->view->Render("Error");
		}
	}




?>