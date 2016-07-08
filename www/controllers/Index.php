<?php
	class Index extends Controller
	{
		function __construct($params)
		{
			parent::__construct();
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
			echo $this-> model -> getArticles();
		}
		
		private function FullAddress($params)
		{
			if(isset($params[3]))
			{
				$this -> errorAddress();
			}
			else if(isset($params[2]))
			{
				echo $this -> model -> getArticle($params);
			}
			else
			{
				echo $this -> model -> getArticlesInSpecificCategory($params);
			}
		}
		
		private function errorAddress()
		{
			echo "Error 404";
		}
			
	}
?>