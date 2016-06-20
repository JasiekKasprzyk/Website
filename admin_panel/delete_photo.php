<?php
	session_start();
	if(!isset($_SESSION['islogged']))
	{
		header('Location: index.php');
		exit();
	}
	if(!isset($_GET['id']))
	{
		header('Location: upload.php');
		exit();
	}
?>