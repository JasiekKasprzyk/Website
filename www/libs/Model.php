<?php
	class Model
	{
		private $HOST = "localhost";
		private $DB_USER = "oot";
		private $DB_PASSWORD = "";
		private $DB_NAME = "website";
		private $isConnected = false;
		
		function __construct()
		{
			$this -> connectToDatabase();
		}
		
		function __destruct()
		{
			$this -> disconnectFromDatabase();
		}
		
		private function connectToDatabase()
		{
			mysqli_report(MYSQLI_REPORT_STRICT);
			try
			{
				$this -> connection = new mysqli($this -> HOST, $this -> DB_USER, $this -> DB_PASSWORD, $this -> DB_NAME);
				if($this -> connection -> connect_errno!=0)
				{
					throw new Exception(mysqli_connect_errno());
				}
				else
				{
					$this ->isConnected = true;
				}
			}
			catch(Exception $e)
			{
				$this -> getErrorMessage($e);
				echo $this -> errorMessage;
			}
		}
		
		private function disconnectFromDatabase()
		{
			if($this -> isConnected)
			{
				$this -> connection -> close();
			}
		}
		
		public function getErrorMessage($e)
		{
			$this ->errorMessage = '<div class="news"><h1>Błąd serwera! Przepraszamy za niedogodności i prosimy o odwiedzenie naszej strony w innym terminie!</h1></div>';//.'Informacja deweloperska:'.$e;
		}
	}
?>