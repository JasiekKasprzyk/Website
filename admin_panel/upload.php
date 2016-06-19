<?php
	session_start();
	if(!isset($_SESSION['islogged']))
	{
		header('Location: index.php');
		exit();
	}
	require_once "../connect.php";
	if((isset($_FILES['fileToUpload']))&&(!empty($_FILES['fileToUpload']['tmp_name'])))
	{
		$target_directory ="files/";
		$target_file = $target_directory.basename($_FILES['fileToUpload']['name']);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		if(isset($_POST['submit']))
		{
			$check = getimagesize($_FILES['fileToUpload']['tmp_name']);
			if($check !== false)
			{
				$uploadOk = 1;
			}
			else
			{
				$error = "Plik nie jest obrazkiem.";
				$uploadOk = 0; 
			}
			if(file_exists($target_file)) 
			{
				$error = "Przepraszam, ale plik już istnieje!";
				$uploadOk = 0;
			}
			if ($_FILES["fileToUpload"]["size"] > 512000) 
			{
				$error = "Przepraszam, ale plik jest za duży. Możesz wysłać pliki do 100KB";
				$uploadOk = 0;
			}
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) 
			{
				echo "Przepraszam, ale możesz tylko wysłać pliki: JPG, PNG, JPEG lub GIF";
				$uploadOk = 0;
			}
			
			if ($uploadOk == 1) 
			{
				if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
				{
					$error = "Plik ". basename( $_FILES["fileToUpload"]["name"]). " został wysłany.";
				} 
				else 
				{
					$error = "Przepraszam, ale pojawił się błąd przy przesyłaniu pliku.";
				}
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
						<input type="file" name="fileToUpload" id="fileToUpload" /><br />
						<input type="submit" value="Wyślij!" name="submit"/><br />
					</form>
<?php
	if(isset($error))
	{
		echo '<span style="color: red">'.$error."</span>";
	}
?>
				</div>
			</div>
		</div>
	</body>
</html>