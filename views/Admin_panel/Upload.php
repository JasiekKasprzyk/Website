<!DOCTYPE HTML>
<html lang="pl">
	<head>
		<meta charset="utf-8" />
		<title>Panel administratora - Upload</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chroma=1" />
		<link rel="stylesheet" href="/Website/views/Admin_panel/style.css" type="text/css" />
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
				<form method="POST" ENCTYPE="multipart/form-data">
					<div class="whole-input">
						<input id="uploadFile" placeholder="Wybierz plik" disabled="disabled" />
						<div class="fileUpload">
							<span>Wybierz plik</span>
							<input type="file" name="fileToUpload" id="fileToUpload" class="upload"/><br />
						</div>
						<div style="clear: both"></div>
					</div>
					<input type="submit" value="Wyślij!" name="submit" class="upload"/><br />
				</form>
				<script type="text/javascript">
					document.getElementById("fileToUpload").onchange = function () {
					    document.getElementById("uploadFile").value = this.value;
					};
				</script>
<?php
	if(isset($_SESSION['errorF']))
	{
		echo '<span style="color: red">'.$_SESSION['errorF']."</span>";
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
<?php 
	unset($_SESSION['errorF']);
?>