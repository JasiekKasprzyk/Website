<?php
	class Index extends Controller
	{
		function __construct($params)
		{
			parent::__construct();
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
			echo "Ni ma nic!";
		}
		
		private function FullAddress($params)
		{
			print_r($params);
		}
			
	}
?>