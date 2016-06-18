<?php
	session_start();
	if(!isset($_SESSION['islogged']))
	{
		header('Location: index.php');
		exit();
	}
	require_once "../connect.php";
	if(is_uploaded_file($_FILES['file']['tmp_name']))
	{
		if($_FILES['file']['size']>102400)
		{
			$error = '<span style="color: red">Plik jest za duży!</span>';
		}
		else
		{
			$connection = @new mysqli($host, $db_user, $db_password, $db_name);
			if($connection->connect_errno!=0)
			{
				echo "Error: ".$connection->connect_errno;
			}
			else
			{
				$name=$_FILES['file']['name'];
				
				$query="";
				$result=$connection->query($query);
				
				$result->close();
				$connection->close();
			}
		}
	}
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
			echo '<div class="photo-tile">';
			echo '<img src="../'.$line['path'].'" class="image" />';
			echo '<div class="text1">'.$line['name']."(".$line['size']."KB)</div>";
			echo '<div class="text2">[<a href="../'.$line['path'].'">Obejrzyj</a>] [<a href="#">Usuń</a>]</div>';
			echo '</div>';
		}
		$result->close();
		$connection->close();
	}
?>
				</div>
				<div class="col-xs-12 col-sm-9 col-md-9 col-lg-10 hierarchy">
					<h1>Dodaj zdjęcie!</h1>
					<form action="upload.php" method="POST" ENCTYPE="multipart/form-data">
						<input type="file" name="file" /><br />
						<input type="submit" value="Wyślij!" /><br />
					</form>
<?php
	if(isset($error))
	{
		echo $error;
	}
?>
				</div>
			</div>
		</div>
	</body>
</html>