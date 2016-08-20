<?php
	class Index extends Controller
	{
		function __construct($params)
		{
			parent::__construct();
			$this ->view ->controller = "Index";
			require_once 'models/Index_model.php';
			$this -> model = new Index_model();
			if(isset($params[1]))
			{
				$action = "FullAddress";
				$this -> $action($params);
			}
			else
			{
				$action = "EmptyAddress";
				$this -> $action();
			}
		}
		
		private function EmptyAddress()
		{
			$this ->view -> content = $this-> model -> getArticles();
			$this->view->Render("Index");
		}
		
		private function FullAddress($params)
		{
			if(isset($params[3]))
			{
				$this -> errorAddress();
			}
			else if(isset($params[2]))
			{
				$this->view->content = $this -> model -> getArticle($params);
				if ($this->view->content=="ERROR")
				{
					$this->errorAddress();
				}
				else 
				{
					$this->view->Render("Index");
				}
			}
			else
			{
				$this->view->content = $this -> model -> getArticlesInSpecificCategory($params);
				if ($this->view->content=="ERROR")
				{
					$this->errorAddress();
				}
				else 
				{
					$this->view->Render("Index");
				}
			}
		}
		
		public function errorAddress()
		{
			$this->view->controller="Error";
			$this->view->Render("Error");
		}
			
	}
?>