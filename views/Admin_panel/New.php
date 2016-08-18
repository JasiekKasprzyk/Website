<!DOCTYPE HTML>
<html lang="pl">

<head>
	<meta charset="utf-8" />
	<title>Panel administratora</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chroma=1" />
	<link rel="stylesheet" href="/Website/views/Admin_panel/style.css" type="text/css" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link href='https://fonts.googleapis.com/css?family=Lato:400,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
	<script src="/Website/views/Admin_panel/CKEditor/ckeditor.js"></script>
</head>


<body>
	<div class="container-session">
		<div class="topbar">
			<div class="hello">Witaj, <?php echo $this->username ?>!</div>
			<div class="topbar-menu">
				<?php echo $this->topmenu ?>
				<div style="clear: both"></div>
			</div>
			<div style="clear: both"></div>
		</div>
		<div id="main-bar">
			<div class="table">
<?php
	echo $this->articleList
?>
			</div>
			<div class="content">
			<form action="/Website/admin_panel/session/update" method="post">
				<br />
				Tytuł:<br />
				<input type="text" name="name" class="article"/><br />
				Kategoria:<br />
				<select name="category" id="category" class="article">
					<option>Sprzęt</option>
					<option>Oprogramowanie</option>
					<option>O nas</option>
				</select>
				<select name="subcategory" id="subcategory" class="article">
					<option>Płyta główna</option>
					<option>Procesor</option>
					<option>Karta graficzna</option>
					<option>Pamięć masowa</option>
					<option>Karta dźwiękowa</option>
					<option>Pamięć RAM</option>
					<option>Napędy optyczne</option>
					<option>Chłodzenie</option>
					<option>Zasilacz</option>
				</select>
				<br />
				<script src="/Website/views/Admin_panel/option-script.js" language="javascript" type="text/javascript"></script>
				Zawartość: <br />
				<textarea name="content" class="article"></textarea><br />
				<script type="text/javascript">
				CKEDITOR.replace('content');
				</script>
				<?php if(isset($_SESSION['errorA'])) echo $_SESSION['errorA']; ?>
				<input type="submit" value="Opublikuj" class="article"><br /><br />
			</form>
			</div>
			<div style="clear: both"></div>
		</div>
	</div>

</body>

</html>