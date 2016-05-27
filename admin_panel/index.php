<?php
	session_start();
	
	if(isset($_SESSION['islogged']) && $_SESSION['islogged']==true)
	{
		header('Location: session.php');
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
		<div class="row space"></div>
		<div class="row">
			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 space"></div>
			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 login-space login-background">
				<div class="login">
					<form action="login.php" method="post">
					Zaloguj się do panelu administratora:<br/>
					Login:<br/>
					<input type="text" name="login"/><br />
					Hasło: <br/>
					<input type="password" name="password"/><br /><br/>
					<input type="submit" value="Zaloguj się!" />
					</form>
<?php
	if(isset($_SESSION['error'])) echo $_SESSION['error'];
?>
				</div>
			</div>
			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 space"></div>
		</div>
		<div class="row space"></div>
	</div>
</body>

</html>