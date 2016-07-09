<?php
	class Admin_panel_model extends Model
	{
		function __construct()
		{
			parent::__construct();
		}
		
		function isLogged()
		{
			if(isset($_SESSION['islogged']))
			{
				header('Location: session');
				exit();
			}
		}
		
		function error()
		{
			if(isset($_SESSION['error'])) return $_SESSION['error'];
		}
		
		function loginProcess()
		{
			if((isset($_POST['login'])) || (isset($_POST['password'])))
			{
				$login= $_POST['login'];
				$password=$_POST['password'];
				
				$login=htmlentities($login, ENT_QUOTES, "UTF-8");
				
				try
				{
					$result = $this->connection->query(
					sprintf("SELECT * FROM administrators WHERE login='%s'", 
					mysqli_real_escape_string($this ->connection, $login)));
					if(!$result)
					{
						throw new Exception($this ->connection->error);
					}
					else
					{
						$how_many_users = $result->num_rows;
						if($how_many_users>0)
						{
							$line=$result->fetch_assoc();
								
							if(password_verify($password, $line['password']))
							{
								$_SESSION['islogged']=true;
								$_SESSION['id']=$line['id'];
								$_SESSION['username']=$line['username'];
									
								unset($_SESSION['error']);
								$result->close();
								header('Location: session');
							}
							else
							{
								$_SESSION['error']='<span style="color:red">Nieprawidłowe hasło</span>';
							}
						}
						else
						{
							$_SESSION['error']='<span style="color:red">Nieprawidłowy login lub hasło</span>';
						}
					}
				}
				catch(Exception $e)
				{
					$this ->getErrorMessage($e);
					echo $this ->errorMessage;
				}
			}
		}
		
		function isNotLogged()
		{
			if(!isset($_SESSION['islogged']))
			{
				header('Location: ..');
				exit();
			}
		}
		
		function getGreeting()
		{
			return '<div class="hello">Witaj, '.$_SESSION['username'].'!</div>';
		}
		
		function getTopMenu($version)
		{
			if($version=="standart")
			{
				return '<div class="topbar-button"><a href="logout.php">Wyloguj się!</a></div>
				<div class="topbar-button"><a href="/Website/www/admin_panel/session/new/">Nowy artykuł</a></div>
				<div class="topbar-button"><a href="/Website/www/admin_panel/session/upload/">Dodaj plik</a></div>';
			}
			else if($version="upload")
			{
				return '<div class="topbar-button"><a href="logout.php">Wyloguj się!</a></div>
				<div class="topbar-button"><a href="..">Artykuły</a></div>';
			}
		}
		
		function getContent($version, $params)
		{
			try
			{
				$text = '';
				if($version=="standart")
				{
					$text = $text.'<div id="main-bar"><div class="table">';
					
					$query="SELECT id, name, category, friendlyAddress FROM articles";
					$result=$this ->connection->query($query);
					if(!$result)
					{
						throw new Exception($this ->connection->error);
					}
					else
					{
						while($line=$result->fetch_assoc())
						{
							$text = $text.'<div class="article-label"><a href="/Website/www/admin_panel/session/view/'.$line['friendlyAddress'].'">'.$line['name']."(".$line['category'].")"."</a></div>";
						}
						$result->close();
					}
					
					$text = $text.'</div><div class="content">';
					
					if(!isset($params[2]))
					{
						$text = $text." ";
					}
					else if(($params[2]=="view") || ($params[2]=="edit"))
					{
						if((isset($params[3]))||(isset($params[3]))||(isset($params[3])))
						{
							$friendlyAddress = $params[3]."/".$params[4]."/".$params[5];
						}
						else $friendlyAddress = "empty/empty/empty";
						$query="SELECT articles.id, articles.name, administrators.username, articles.createDate, articles.category, articles.content, articles.friendlyAddress FROM articles, administrators WHERE articles.authorID = administrators.id AND articles.friendlyAddress='$friendlyAddress'";
						$result=$this ->connection->query($query);
						if(!$result)
						{
							throw new Exception($this ->connection->error);
						}
						else
						{
							if($result->num_rows<1)
							{
								$text=$text."Error 404";
							}
							else
							{
								$line=$result->fetch_assoc();
								$_SESSION['articleid']=$line['id'];
								if($params[2]=="view")
								{
									$text = $text."<h1>".$line['name']."</h1>
									<h6>".$line['category']." | Autor: ".$line['username']." | Data utworzenia: ".$line['createDate']."</h6>
									<p>".$line['content'].'</p>
									<div class="edit-content-menu">
										<a href="/Website/www/admin_panel/session/edit/'.$line['friendlyAddress'].'">Edytuj</a>
									</div>
									<div class="edit-content-menu">
										<a href="delete.php">Usuń</a>
									</div>
									<div style="clear: both"></div>';
								}
								else
								{
									$text = $text.'<form action="update.php?article='.$line['friendlyAddress'].'" method="post">
									Tytuł:<br />
									<input type="text" value="'.$line['name'].'" name="name"/><br />
									Kategoria:<br />
									<input type="text" value="'.$line['category'].'" name="category"/><br />
									Zawartość: <br />
									<textarea name="content">'.$line['content']."</textarea><br />";
									if(isset($_SESSION['error'])) $text=$text.$_SESSION['error'];
									$text=$text.'<input type="submit" value="Opublikuj"><br /><br />
									</form>';
								}
								$result->close();
							}
						}
					}
					else
					{
						$text = $text.'<form action="update.php" method="post">
						Tytuł:<br />
						<input type="text" name="name"/><br />
						Kategoria:<br />
						<input type="text" name="category" /><br />
						Zawartość: <br />
						<textarea name="content"></textarea><br />';
						if(isset($_SESSION['error'])) $text=$text.$_SESSION['error'];
						$text = $text.'<input type="submit" value="Opublikuj"><br /><br />
						</form>';
					}
					$text = $text.'</div><div style="clear: both"></div></div>';
				}
				else if($version=="upload")
				{
					if((isset($_FILES['fileToUpload']))&&(!empty($_FILES['fileToUpload']['tmp_name'])))
					{
						$target_directory ="files/";
						$target_file = $target_directory.basename($_FILES['fileToUpload']['name']);
						$name = basename($_FILES['fileToUpload']['name']);
						$uploadOk = 1;
						$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
						if(isset($_POST['submit']))
						{
							$check = getimagesize($_FILES['fileToUpload']['tmp_name']);
							if($check !== false)
							{
								$uploadOk = 1;
							}
							else
							{
								$error = "Plik nie jest obrazkiem.";
								$uploadOk = 0; 
							}
							$size = $_FILES['fileToUpload']['size'];
							if ($size > 1024*1024*1024) 
							{
								$error = "Przepraszam, ale plik jest za duży. Możesz wysłać pliki do 100KB";
								$uploadOk = 0;
							}
							$size = round($size/1024, 2);
							if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) 
							{
								echo "Przepraszam, ale możesz tylko wysłać pliki: JPG, PNG, JPEG lub GIF";
								$uploadOk = 0;
							}
							
							if ($uploadOk == 1) 
							{
								if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
								{
									$target_file = "/Website/www/files/".basename($_FILES['fileToUpload']['name']);
									$authorId = $_SESSION['id'];
									if(!$this ->connection->query("INSERT pictures VALUES (NULL, '$name', '$target_file', '$size', '$authorId')"))
									{
										throw new Exception($this ->connection->error);
									}
									else
									{
										$error = "Plik ". basename( $_FILES["fileToUpload"]["name"]). " został pomyślnie wysłany i zapisany.";	
									}
								} 
								else 
								{
									$error = "Przepraszam, ale pojawił się błąd przy przesyłaniu pliku.";
								}
							}
						}
					}
					$text = $text.'<div class="add-photo-menu">
					<h1>Dodaj zdjęcie!</h1>
					<form method="POST" ENCTYPE="multipart/form-data">
						<input type="file" name="fileToUpload" id="fileToUpload" /><br />
						<input type="submit" value="Wyślij!" name="submit" class="upload"/><br />
					</form>';
					if(isset($error))
					{
						$text = $text.'<span style="color: red">'.$error."</span>";
					}
					$text = $text.'</div>
					<div class="photo-explorer">';

					$query="SELECT name, path, size FROM pictures";
					$result=$this ->connection->query($query);
					if(!$result)
					{
						throw new Exception($this ->connection->error);
					}
					else
					{
						while($line=$result->fetch_assoc())
						{
							$text=$text.'<div class="photo-tile">
							<img src="'.$line['path'].'" class="image" />
							<div class="text1">'.$line['name']."(".$line['size'].'KB)</div>
							<div class="text2"><div class="button-look"><a href="'.$line['path'].'">Obejrzyj</a></div><div class="button-delete"><a href="delete_photo.php?name='.$line['name'].'">Usuń</a></div></div>
							</div>';
						}
						$result->close();
					}
					$text = $text.'</div>';
				}
				return $text;
			}
			catch(Exception $e)
			{
				$this ->getErrorMessage($e);
				echo $this ->errorMessage;
			}
		}
	}
?>