<?php
	session_start();
	if(!isset($_SESSION['islogged']))
	{
		header('Location: index.php');
		exit();
	}
	if(!isset($_SESSION['articleid']))
	{
		header('Location: session.php');
		exit();
	}
	
	require_once "../connect.php";
	
	$connection = @new mysqli($host, $db_user, $db_password, $db_name);
	if($connection->connect_errno!=0)
	{
		echo "Error: ".$connection->connect_errno;
	}
	else
	{
		$id=$_SESSION['articleid'];
		echo $id;
		if($connection->query("DELETE FROM articles WHERE id='$id'"))
			{
				header('Location: session.php');
			}
			else
			{
				echo "Error: ".$connection->error;
			}
		$connection->close();
	}
?>