<?php
	class Admin_panel extends Controller
	{
		function __construct($params)
		{
			parent::__construct();
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
			else if($params[1]=="upload")
			{
				$action = "Upload";
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
			echo "Index!";
		}
			
		private function Session($params)
		{
			echo "Sesja!";
		}
			
		private function Upload($params)
		{
			echo "Wysy³anie!";
		}
			
		private function Error()
		{
			echo "B³¹d!";
		}
	}
?>