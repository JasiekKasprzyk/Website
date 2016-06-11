<?php
	session_start();
	if(!isset($_SESSION['islogged']))
	{
		header('Location: index.php');
		exit();
	}
	if((!isset($_POST['name'])) || (!isset($_POST['category'])) || (!isset($_POST['content'])))
	{
		header('Location: session.php');
		exit();
	}
	if((empty($_POST['name'])) || (empty($_POST['category'])) || (empty($_POST['content'])))
	{
		$_SESSION['error']='<span style="color: red;">Nie wszystkie pola zostały uzupełnione!</span><br />';
		if(!isset($_GET['article']))
		{
			header('Location: session.php?get=new');
			exit();
		}
		else
		{
			header('Location: session.php?article='.$_GET['article'].'&get=edit');
			exit();
		}
	}
	else
	{
		if(!isset($_GET['article']))
		{
			
		}
		else
		{
			//OLD ARTICLE
		}
	}
?>