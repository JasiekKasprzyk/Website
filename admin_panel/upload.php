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
		$target_directory ="../files/";
		$target_file = $target_directory.basename($_FILES['fileToUpload']['name']);
		$name = basename($_FILES['fileToUpload']['name']);
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
			$size = $_FILES['fileToUpload']['size'];
			if ($size > 1024*1024*1024) 
			{
				$error = "Przepraszam, ale plik jest za duży. Możesz wysłać pliki do 100KB";
				$uploadOk = 0;
			}
			$size = round($size/1024, 2);
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) 
			{
				echo "Przepraszam, ale możesz tylko wysłać pliki: JPG, PNG, JPEG lub GIF";
				$uploadOk = 0;
			}
			
			if ($uploadOk == 1) 
			{
				if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
				{
					$connection = @new mysqli($host, $db_user, $db_password, $db_name);
					if($connection->connect_errno!=0)
					{
						$error = "Error: ".$connection->connect_errno;
					}
					else
					{
						$authorId = $_SESSION['id'];
						if($connection->query("INSERT pictures VALUES (NULL, '$name', '$target_file', '$size', '$authorId')"))
						{
							$error = "Plik ". basename( $_FILES["fileToUpload"]["name"]). " został pomyślnie wysłany i zapisany.";				
						}
						else
						{
							$error = "Error: ".$connection->error;
						}
						$connection->close();
					}
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
		<link rel="stylesheet" href="style.css" type="text/css" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<link href='https://fonts.googleapis.com/css?family=Lato:400,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
	</head>
	<body>
		<div class="container-session">
			<div class="topbar">
<?php
	echo '<div class="hello">Witaj, '.$_SESSION['username'].'!</div>';
?>
				<div class="topbar-menu">
					<div class="topbar-button"><a href="logout.php">Wyloguj się!</a></div>
					<div class="topbar-button"><a href="session.php">Artykuły</a></div>
					<div style="clear: both"></div>
				</div>
				<div style="clear: both"></div>
			</div>
			<div class="add-photo-menu">
				<h1>Dodaj zdjęcie!</h1>
				<form action="upload.php" method="POST" ENCTYPE="multipart/form-data">
					<input type="file" name="fileToUpload" id="fileToUpload" /><br />
					<input type="submit" value="Wyślij!" name="submit" class="upload"/><br />
				</form>
<?php
	if(isset($error))
	{
		echo '<span style="color: red">'.$error."</span>";
	}
?>
			</div>
			<div class="photo-explorer">
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
		$row_number = 0;
		while($line=$result->fetch_assoc())
		{
			echo '<div class="photo-tile">';
			echo '<img src="'.$line['path'].'" class="image" />';
			echo '<div class="text1">'.$line['name']."(".$line['size']."KB)</div>";
			echo '<div class="text2"><div class="button-look"><a href="'.$line['path'].'">Obejrzyj</a></div><div class="button-delete"><a href="delete_photo.php?name='.$line['name'].'">Usuń</a></div></div>';
			echo '</div>';
		}
		$result->close();
		$connection->close();
	}
?>
			</div>
		</div>
	</body>
</html>