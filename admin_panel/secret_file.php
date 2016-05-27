<?php
	if(isset($_POST['password'])) 
	{
		$password = $_POST['password'];
		$hash_password=password_hash($password, PASSWORD_DEFAULT);
		echo $hash_password;
	}

?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>Cows are really handsome</title>
	</head>
	<body>
		<form method="post">
		<input type="password" name="password"/>
		<input type="submit" />
		</form>
	</body>
</html>