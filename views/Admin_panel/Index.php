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