<!DOCTYPE HTML>
<html lang="pl">
	<head>
		<meta charset="utf-8" />
		<title>Panel administratora - Upload</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chroma=1" />
		<link rel="stylesheet" href="/Website/www/views/Admin_panel/style.css" type="text/css" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<link href='https://fonts.googleapis.com/css?family=Lato:400,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
	</head>
	<body>
		<div class="container-session">
			<div class="topbar">
			<div class="hello">Witaj, <?php echo $this->username; ?> !</div>
				<div class="topbar-menu">
					<?php echo $this->topmenu; ?>
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
	if(isset($_SESSION['error']))
	{
		echo '<span style="color: red">'.$_SESSION['error']."</span>";
	}
?>
			</div>
			<div class="photo-explorer">
<?php
	echo $this->uploadedPhotos;
?>
			</div>
		</div>
	</body>
</html>