<?php
	class Admin_panel extends Controller
	{
		function __construct($params)
		{
			parent::__construct();
			require_once 'models/Admin_panel_model.php';
			$this -> model = new Admin_panel_model();
			session_start();
			if(!isset($params[1]))
			{
				$action = "Index";
				$this->$action();
			}
			else if($params[1]=="session")
			{
				$action = "Session";
				$this->$action($params);
			}
			else
			{
				$action = "Error";
				$this->$action();
			}
		}
		
		private function Index()
		{
			$this -> model -> isLogged();
			$this -> model -> loginProcess();
			echo $this -> model -> error();
		}
			
		private function Session($params)
		{
			$this -> model -> isNotLogged();
			echo $this -> model -> getGreeting();
			if(!isset($params[2]))
			{
				$version="standart";
			}
			else if($params[2]=="upload")
			{
				$version="upload";
			}
			else
			{
				$version="standart";
			}
			echo $this -> model -> getTopMenu($version);
			echo $this -> model -> getContent($version, $params);
		}
		
		private function Error()
		{
			echo "B³¹d!";
		}
	}
?>