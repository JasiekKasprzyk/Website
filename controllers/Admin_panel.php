<?php
	class Admin_panel extends Controller
	{
		function __construct($params)
		{
			parent::__construct();
			$this -> view -> controller = "Admin_panel";
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
				$this->errorAddress();
			}
		}
		
		private function Index()
		{
			$this -> model -> isLogged();
			$this -> model -> loginProcess();
			$this ->view->error = $this -> model -> error();
			$this->view->Render("Head");
			$this->view->Render("Index");
		}
			
		private function Session($params)
		{
			$this -> model -> isNotLogged();
			if(!isset($params[2]))
			{
				$this->view->username= $this -> model -> getUserName();
				$this->view->topmenu =  $this -> model -> getTopMenu("standart");
				$this->view->articleList =  $this -> model ->getArticleList();
				$this->view->Render("Head");
				$this->view->Render("Topmenu");
				$this->view->Render("Mainbar");
				$this->view->Render("Session");
			}
			else
			{
				switch($params[2])
				{
					case "view":
					{
						$this->view->username= $this -> model -> getUserName();
						$this->view->topmenu= $this -> model -> getTopMenu("standart");
						$this->view->articleList= $this -> model -> getArticleList();
						$this->view->content= $this->model->writeViewArticleContent($params);
						if($this->view->content=="ERROR")
						{
							$this->errorAddress();
						}
						else
						{
							$this->view->Render("Head");
							$this->view->Render("Topmenu");
							$this->view->Render("Mainbar");
							$this->view->Render("View");
						}
					}
					break;
					case "upload":
					{
						$this->view->username = $this -> model -> getUserName();
						$this->view->topmenu = $this -> model -> getTopMenu("upload");
						$this ->model->uploadFile();
						$this->view->uploadedPhotos = $this ->model->getUploadedPhotos();
						$this->view->Render("Head");
						$this->view->Render("Topmenu");
						$this->view->Render("Upload");
					}
					break;
					case "edit":
					{
						$this->view->username = $this -> model -> getUserName();
						$this->view->topmenu=$this -> model -> getTopMenu("standart");
						$this->view->articleList= $this -> model -> getArticleList();
						$this->view->content =  $this->model->writeEditArticleContent($params);
						if($this->view->content=="ERROR")
						{
							$this->errorAddress();
						}
						else 
						{
							$this->view->Render("Head");
							$this->view->Render("Topmenu");
							$this->view->Render("Mainbar");
							$this->view->Render("View");
						}
					}
					break;
					case "new":
					{
						$this->view->username = $this -> model -> getUserName();
						$this->view->topmenu = $this -> model -> getTopMenu("standart");
						$this->view->articleList = $this -> model -> getArticleList();
						$this->view->Render("Head");
						$this->view->Render("Topmenu");
						$this->view->Render("Mainbar");
						$this->view->Render("New");
					}
					break;
					case "delete":
					{
						if(!isset($params[3]))
						{
							header('Location: /Website/admin_panel/session/');
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
							header('Location: /Website/admin_panel/session/upload');
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
						$this-> errorAddress();
					}
				}
			}
		}
		
		public function errorAddress()
		{
			header('Location: /Website/errorcontroller');
			exit();
		}
	}
?>