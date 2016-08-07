<!DOCTYPE HTML>
<html lang="pl">

<head>
	<meta charset="utf-8" />
	<title>Panel administratora</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chroma=1" />
	<link rel="stylesheet" href="/Website/views/Admin_panel/style.css" type="text/css" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link href='https://fonts.googleapis.com/css?family=Lato:400,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
</head>


<body>
	<div class="container-session">
		<div class="topbar">
<div class="hello">Witaj, <?php echo $this->username; ?>!</div>
			<div class="topbar-menu">
<?php
	echo $this->topmenu;
?>
				<div style="clear: both"></div>
			</div>
			<div style="clear: both"></div>
		</div>
		<div id="main-bar">
			<div class="table">
<?php
	echo $this->articleList;
?>
			</div>
			<div class="content">
			</div>
			<div style="clear: both"></div>
		</div>
	</div>

</body>

</html>