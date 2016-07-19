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
				echo $this -> model ->getArticleList();
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
						echo $this->model->writeViewArticleContent($params);
					}
					break;
					case "upload":
					{
						echo $this -> model -> getUserName();
						echo $this -> model -> getTopMenu("upload");
						echo $this ->model->uploadFile();
						echo $this ->model->getUploadedPhotos();
					}
					break;
					case "edit":
					{
						echo $this -> model -> getUserName();
						echo $this -> model -> getTopMenu("standart");
						echo $this -> model -> getArticleList();
						echo $this->model->writeEditArticleContent($params);
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
						if(!isset($params[3]))
						{
							header('Location: /Website/www/admin_panel/session/');
							Exit();
						}
						else 
						{
							$this->model->deleteArticle($params[3]);
						}
					}
					break;
					case "delete-photo":
					{
						if(!isset($params[3]))
						{
							header('Location: /Website/www/admin_panel/session/upload');
							exit();
						}
						else
						{
							$this->model->deletePhoto($params[3]);
						}
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
		}
		
		private function Error()
		{
			echo "Błąd!";
		}
	}
?>