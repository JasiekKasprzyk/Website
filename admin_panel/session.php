<?php
	session_start();
	if(!isset($_SESSION['islogged']))
	{
		header('Location: index.php');
		exit();
	}
?>

<!DOCTYPE HTML>
<html lang="pl">

<head>
	<meta charset="utf-8" />
	<title>Panel administratora</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chroma=1" />
	<link rel="stylesheet" href="../style.css" type="text/css" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
</head>


<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 admin-panel-header">
<?php

	echo "Witaj, ".$_SESSION['username'].'! [<a href="logout.php">Wyloguj się!</a>]';
	
?>
			</div>
		</div>
		<div class="row row-hierarchy">
			<div class="col-xs-12 col-sm-3 col-md-3 col-lg-2 hierarchy">
				<table>
<?php
	require_once "../connect.php";
	$connection = @new mysqli($host, $db_user, $db_password, $db_name);
	if($connection->connect_errno!=0)
	{
		echo "Error: ".$connection->connect_errno;
	}
	else
	{
		$query="SELECT id, name, category, friendlyAddress FROM articles";
		$result=$connection->query($query);
		$how_many_articles=$result->num_rows;
		while($line=$result->fetch_assoc())
		{
			echo '<li><a href="session.php?article='.$line['friendlyAddress'].'">'.$line['name']."(".$line['category'].")"."</a></li>";
		}
		$result->close();
		$connection->close();
	}
?>
				</table>
			</div>
			<div class="col-xs-12 col-sm-9 col-md-9 col-lg-10 hierarchy">
<?php
	$connection = @new mysqli($host, $db_user, $db_password, $db_name);
	if($connection->connect_errno!=0)
	{
		echo "Error: ".$connection->connect_errno;
	}
	else
	{
		$query="SELECT articles.name, administrators.username, articles.createDate, articles.category, articles.content FROM articles, administrators WHERE articles.authorID = administrators.id AND articles.";
		if(!isset($_GET['article']))
		{
			$query=$query."id=1";
		}
		else
		{
			$_GET['article']=htmlentities($_GET['article'], ENT_QUOTES, "UTF-8");
			$query=$query.'friendlyAddress="'.$_GET['article'].'"';
		}
		$result=$connection->query($query);
		$line=$result->fetch_assoc();
		echo "<h1>".$line['name']."</h1>";
		echo "<h6>".$line['category']." | Autor: ".$line['username']." | Data utworzenia: ".$line['createDate']."</h6>";
		echo "<p>".$line['content']."</p>";
		$result->close();
		$connection->close();
	}
?>
			</div>
		</div>
	</div>

</body>

</html>