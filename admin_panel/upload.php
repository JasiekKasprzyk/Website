<?php
	session_start();
	if(!isset($_SESSION['islogged']))
	{
		header('Location: index.php');
		exit();
	}
	require_once "../connect.php";
?>
<!DOCTYPE HTML>
<html lang="pl">
	<head>
		<meta charset="utf-8" />
		<title>Panel administratora - Upload</title>
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
	echo "Witaj, ".$_SESSION['username'].'! [<a href="logout.php">Wyloguj się!</a>] [<a href="session.php">Powróć do spisu artykułów</a>]';
?>
				</div>
			</div>
			<div class="row row-hierarchy">
				<div class="col-xs-12 col-sm-3 col-md-3 col-lg-2 hierarchy">
<?php
	$connection = @new mysqli($host, $db_user, $db_password, $db_name);
	if($connection->connect_errno!=0)
	{
		echo "Error: ".$connection->connect_errno;
	}
	else
	{
		$query="SELECT name, path, size FROM pictures";
		$result=$connection->query($query);
		while($line=$result->fetch_assoc())
		{
			echo '<div class="photo-tile"></div>';
		}
		$result->close();
		$connection->close();
	}
?>
				</div>
				<div class="col-xs-12 col-sm-9 col-md-9 col-lg-10 hierarchy">
<?php
?>
				</div>
			</div>
		</div>
	</body>
</html>