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