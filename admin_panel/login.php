<?php

	require_once "../connect.php";
	$connection = @new mysqli($host, $db_user, $db_password, $db_name);
	if($connection->connect_errno!=0)
	{
		echo "Error: ".$connection->connect_errno;
	}
	else
	{
		$login= $_POST['login'];
		$password=$_POST['password'];
		
		$sql = "SELECT * FROM administrators WHERE login='$login' AND password='$password'";
		
		if($result = $connection->query($sql))
		{
			$how_many_users = $result->num_rows;
			if($how_many_users>0)
			{
				$line=$result->fetch_assoc();
				
				$_login = $line['login'];
				
				$result->close();
				header('Location: session.php');
			}
			else
			{
				
			}
		}
		
		$connection->close();
	}
?>