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
		
		function getUserName()
		{
			return $_SESSION['username'];
		}
		
		function getTopMenu($version)
		{
			if($version=="standart")
			{
				return '<div class="topbar-button"><a href="/Website/www/admin_panel/session/logout/">Wyloguj się!</a></div>
				<div class="topbar-button"><a href="/Website/www/admin_panel/session/new/">Nowy artykuł</a></div>
				<div class="topbar-button"><a href="/Website/www/admin_panel/session/upload/">Dodaj plik</a></div>';
			}
			else if($version="upload")
			{
				return '<div class="topbar-button"><a href="/Website/www/admin_panel/session/logout/">Wyloguj się!</a></div>
				<div class="topbar-button"><a href="..">Artykuły</a></div>';
			}
		}
		
		function getUploadedPhotos()
		{
					$text="";
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
							<div class="text2"><div class="button-look"><a href="'.$line['path'].'">Obejrzyj</a></div><div class="button-delete"><a href="/Website/www/admin_panel/session/delete-photo/'.$line['name'].'">Usuń</a></div></div>
							</div>';
						}
						$result->close();
					}
					return $text;
		}
		
		function getArticleList()
		{
			try
			{
				$query="SELECT id, name, category, friendlyAddress FROM articles";
				$result=$this ->connection->query($query);
				if(!$result)
				{
					throw new Exception($this ->connection->error);
				}
				else
				{
					$text="";
					while($line=$result->fetch_assoc())
					{
						$text = $text.'<div class="article-label"><a href="/Website/www/admin_panel/session/view/'.$line['friendlyAddress'].'">'.$line['name']."(".$line['category'].")"."</a></div>";
					}
					$result->close();
					return $text;
				}
			}
			catch(Exception $e)
			{
				$this ->getErrorMessage($e);
				echo $this ->errorMessage;
			}
		}
		
		
		function writeViewArticleContent($params)
		{
			$line = $this->getArticleContentFromDatabase($params);
			if(!isset($line['null']))
			{
				$text ="<h1>".$line['name']."</h1>
				<h6>".$line['category']." | Autor: ".$line['username']." | Data utworzenia: ".$line['createDate']."</h6>
				<p>".$line['content'].'</p>
				<div class="edit-content-menu">
				<a href="/Website/www/admin_panel/session/edit/'.$line['friendlyAddress'].'">Edytuj</a>
				</div>
				<div class="edit-content-menu">
				<a href="/Website/www/admin_panel//delete/'.$line['id'].'">Usuń</a>
				</div>
				<div style="clear: both"></div>';
				return $text;
			}
			else return "Error 404";
		}
		
		function writeEditArticleContent($params)
		{
			$line = $this->getArticleContentFromDatabase($params);
			if(!isset($line['null']))
			{
				$_SESSION['articleid']=$line['id'];
				$text ='<form action="/Website/www/admin_panel/session/update/'.$line['friendlyAddress'].'" method="post">
				Tytuł:<br />
				<input type="text" value="'.$line['name'].'" name="name"/><br />
				Kategoria:<br />
				<input type="text" value="'.$line['category'].'" name="friendlyAddress"/><br />
				Zawartość: <br />
				<textarea name="content">'.$line['content']."</textarea><br />";
				if(isset($_SESSION['error'])) $text=$text.$_SESSION['error'];
				$text=$text.'<input type="submit" value="Opublikuj"><br /><br />
				</form>';
				return $text;
			}
			else return "Error 404";
		}
		
		function uploadFile()
		{
			try
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
			}
			catch(Exception $e)
			{
				$this ->getErrorMessage($e);
				echo $this ->errorMessage;
			}
		}
		
		function deleteArticle($params)
		{
			try 
			{
				$query = "DELETE FROM articles WHERE id='$params'";
				if(!$this->connection->query($query))
				{
					throw new Exception($this->connection->error);
				}
				else
				{
					header('Location: /Website/www/admin_panel/session/');
				}
			} 
			catch (Exception $e) 
			{
				$this ->getErrorMessage($e);
				echo $this ->errorMessage;
			}
		}
		
		function deletePhoto($params)
		{
			try 
			{
				if(!$this->connection->query("DELETE FROM pictures WHERE name='$params'"))
				{
					throw new Exception($this->connection->error);
				}
				else
				{
					if(!unlink(realpath('files/'.$params)))
					{
						throw new Exception("File hasn't been deleted or doesn't exist.");
					}
					else
					{
						header('Location: /Website/www/admin_panel/session/upload/');
					}
				}
			}
			catch(Exception $e)
			{
				$this ->getErrorMessage($e);
				echo $this->errorMessage;
			}
		}
		
		function logout()
		{
			session_unset();
			
			header('Location: /Website/www/admin_panel/');
		}
		
		function update($params)
		{
			if(!isset($_POST['name']))
			{
				header('Location: /Website/www/admin_panel/session/');
				exit();
			}
			if((empty($_POST['name'])) || (empty($_POST['friendlyAddress'])) || (empty($_POST['content'])))
			{
				$_SESSION['error']='<span style="color: red;">Nie wszystkie pola zostały uzupełnione!</span><br />';
				if((!isset($params[3])) || (!isset($params[4])) || (!isset($params[5])))
				{
					header('Location: /Website/www/admin_panel/session/new/');
					exit();
				}
				else
				{
					header('Location: /Website/www/admin_panel/session/edit/'.$params[3]."/".$params[4]."/".$params[5]."/");
					exit();
				}
			}
			else
			{
				unset($_SESSION['error']);
				$name=$_POST['name'];
				$authorId=$_SESSION['id'];
				$createDate=$date = date('Y-m-d');
				
				$friendlyAddress = $_POST['friendlyAddress'];
				$addressArray = explode("/", $friendlyAddress);
				$category=$addressArray[1];
				$content=$_POST['content'];
				$friendlyAddress=strtr($friendlyAddress, 'ĘÓĄŚŁŻŹĆŃęóąśłżźćń', 'EOASLZZCNeoaslzzcn')."/".strtr($name, 'ĘÓĄŚŁŻŹĆŃęóąśłżźćń', 'EOASLZZCNeoaslzzcn');
				$friendlyAddress=str_replace(" ","-", $friendlyAddress);
				$friendlyAddress=strtolower($friendlyAddress);
				try 
				{
					if((!isset($params[3])) || (!isset($params[4])) || (!isset($params[5])))
					{
						//NEW ARTICLE
						$query = "INSERT articles VALUES (NULL, '$name', '$authorId', '$createDate', '$category', '$content', '$friendlyAddress')";
						if(!$this->connection->query($query))
						{
							throw new Exception($this ->connection->error);
						}
						else
						{
							header('Location: /Website/www/admin_panel/session/view/'.$friendlyAddress.'/');
						}
					
					}
					else
					{
						//OLD ARTICLE
						$id=$_SESSION['articleid'];
						$query="UPDATE articles SET name='$name', authorId='$authorId', createDate='$createDate', category='$category', content='$content', friendlyAddress='$friendlyAddress' WHERE id='$id'";
						if(!$this->connection->query($query))
						{
							throw new Exception($this ->connection->error);
						}
						else
						{
							header('Location: /Website/www/admin_panel/session/view/'.$friendlyAddress.'');
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
		
		private function getArticleContentFromDatabase($params)
		{
			try
			{
				if((isset($params[3]))&&(isset($params[4]))&&(isset($params[5])))
				{
					$friendlyAddress = $params[3]."/".$params[4]."/".$params[5];
				}
				else $friendlyAddress = "empty/empty/empty";
				$query="SELECT articles.id, articles.name, administrators.username, articles.createDate, articles.category, articles.content, articles.friendlyAddress FROM articles, administrators WHERE articles.authorID = administrators.id AND articles.friendlyAddress LIKE '$friendlyAddress%'";
				$result=$this ->connection->query($query);
				if(!$result)
				{
					throw new Exception($this ->connection->error);
				}
				else
				{
					if($result->num_rows<1)
					{
						$line['null'] = "null";
					}
					else
					{
						$line=$result->fetch_assoc();
						$result->close();
					} 
				}
				return $line;
			}
			catch(Exception $e)
			{
				$this ->getErrorMessage($e);
				echo $this ->errorMessage;
			}
		}
	}
?>