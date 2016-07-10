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
			if(!isset($params[2]))
			{
				echo $this -> model -> getUserName();
				echo $this -> model -> getTopMenu("standart");
			}
			else
			{
				switch($params[2])
				{
					case "view":
					{
						echo $this -> model -> getUserName();
						echo $this -> model -> getTopMenu("standart");
						echo $this -> model -> getArticleList();
					}
					break;
					case "upload":
					{
						echo $this -> model -> getUserName();
						echo $this -> model -> getTopMenu("upload");
					}
					break;
					case "edit":
					{
						echo $this -> model -> getUserName();
						echo $this -> model -> getTopMenu("standart");
						echo $this -> model -> getArticleList();
					}
					break;
					case "new":
					{
						echo $this -> model -> getUserName();
						echo $this -> model -> getTopMenu("standart");
						echo $this -> model -> getArticleList();
					}
					break;
					case "delete":
					{
					}
					break;
					case "delete-photo":
					{
					}
					break;
					case "logout":
					{
					}
					break;
					case "update":
					{
					}
					default:
					{
						
					}
				}
			}
			echo $this -> model -> getContent($version, $params);
		}
		
		private function Error()
		{
			echo "B³¹d!";
		}
	}
?>