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
		require_once "../connect.php";
		
		unset($_SESSION['error']);
		$connection = @new mysqli($host, $db_user, $db_password, $db_name);
		if($connection->connect_errno!=0)
		{
			echo "Error: ".$connection->connect_errno;
		}
		else
		{
			$name=$_POST['name'];
			$authorId=$_SESSION['id'];
			$createDate=$date = date('Y-m-d');
			$category=$_POST['category'];
			$content=$_POST['content'];
			$friendlyAddress=str_replace(" ","-", $_POST['name']);
			
			if(!isset($_GET['article']))
			{
				//NEW ARTICLE
				if($connection->query("INSERT articles VALUES (NULL, '$name', '$authorId', '$createDate', '$category', '$content', '$friendlyAddress')"))
				{
						header('Location: session.php?article='.$friendlyAddress.'');
				}
				else
				{
					echo "Error: ".$connection->error;
				}
				
			}
			else
			{
				//OLD ARTICLE
				$id=$_SESSION['articleid'];
				if($connection->query("UPDATE articles SET name='$name', authorId='$authorId', createDate='$createDate', category='$category', content='$content', friendlyAddress='$friendlyAddress' WHERE id='$id'"))
				{
					header('Location: session.php?article='.$friendlyAddress.'');
				}
				else
				{
					echo "Error: ".$connection->error;
				}
			}
			$connection->close();
		}
	}
?>