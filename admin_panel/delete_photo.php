<?php
	session_start();
	if(!isset($_SESSION['islogged']))
	{
		header('Location: index.php');
		exit();
	}
	if(!isset($_GET['name']))
	{
		header('Location: upload.php');
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
		$name=$_GET['name'];
		if($connection->query("DELETE FROM pictures WHERE name='$name'"))
			{
				if(unlink(realpath('../files/'.$_GET['name'])))
				{
					header('Location: upload.php');
				}
				else
				{
					echo "Nie udało się usunąć pliku!";
				}
			}
			else
			{
				echo "Error: ".$connection->error;
			}
		$connection->close();
	}
?>