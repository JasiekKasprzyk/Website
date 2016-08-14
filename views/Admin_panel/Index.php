<!DOCTYPE HTML>
<html lang="pl">

<head>
	<meta charset="utf-8" />
	<title>Onlykom - panel administratora</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chroma=1" />
	<link rel="stylesheet" href="/Website/views/Admin_panel/style.css" type="text/css" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link href='https://fonts.googleapis.com/css?family=Lato:400,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
</head>


<body>
	<div class="container-login">
		<div class="login-interface">
			<form method="post">
				Zaloguj się do panelu admina:<br/>
				<input type="text" name="login" class="login" placeholder="login"/><br />
				<input type="password" name="password" class="login" placeholder="hasło"/><br />
				<input type="submit" value="Zaloguj się!" class="login" />
			</form>
<?php
	if(isset($this->error)) echo $this->error;
?>
		</div>
	</div>
</body>

</html>