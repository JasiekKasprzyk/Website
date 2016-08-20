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