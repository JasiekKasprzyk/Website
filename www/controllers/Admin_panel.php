<?php
	class Admin_panel extends Controller
	{
		function __construct($params)
		{
			parent::__construct();
			$this -> view -> controller = "Admin_panel";
			$this -> view -> page= "Index";
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
			$this -> view -> page= "Index";
			$this -> model -> isLogged();
			$this -> model -> loginProcess();
			$this ->view->error = $this -> model -> error();
			$this->view->Render();
		}
			
		private function Session($params)
		{
			$this -> model -> isNotLogged();
			if(!isset($params[2]))
			{
				$this->view->page="Session";
				$this->view->username= $this -> model -> getUserName();
				$this->view->topmenu =  $this -> model -> getTopMenu("standart");
				$this->view->articleList =  $this -> model ->getArticleList();
				$this->view->Render();
			}
			else
			{
				switch($params[2])
				{
					case "view":
					{
						$this->view->page="View";
						$this->view->username= $this -> model -> getUserName();
						$this->view->topmenu= $this -> model -> getTopMenu("standart");
						$this->view->articleList= $this -> model -> getArticleList();
						$this->view->content= $this->model->writeViewArticleContent($params);
						$this->view->Render();
					}
					break;
					case "upload":
					{
						$this->view->page="Upload";
						$this->view->username = $this -> model -> getUserName();
						$this->view->topmenu = $this -> model -> getTopMenu("upload");
						$this ->model->uploadFile();
						$this->view->uploadedPhotos = $this ->model->getUploadedPhotos();
						$this->view->Render();
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
						$this->model->logout();
					}
					break;
					case "update":
					{
						$this -> model -> update($params);
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