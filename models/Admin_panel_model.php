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
								header('Location: /Website/admin_panel/session');
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
				return '<div class="topbar-button"><a href="/Website/admin_panel/session/logout/">Wyloguj się!</a></div>
				<div class="topbar-button"><a href="/Website/admin_panel/session/new/">Nowy artykuł</a></div>
				<div class="topbar-button"><a href="/Website/admin_panel/session/upload/">Dodaj plik</a></div>';
			}
			else if($version="upload")
			{
				return '<div class="topbar-button"><a href="/Website/admin_panel/session/logout/">Wyloguj się!</a></div>
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
							<div class="text2"><div class="button-look"><a href="'.$line['path'].'">Obejrzyj</a></div><div class="button-delete"><a href="/Website/admin_panel/session/delete-photo/'.$line['name'].'">Usuń</a></div></div>
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
						$text = $text.'<div class="article-label"><a href="/Website/admin_panel/session/view/'.$line['friendlyAddress'].'">'.$line['name']."(".$line['category'].")"."</a></div>";
					}
					$result->close();
					return $text;
				}
			}
			catch(Exception $e)
			{
				$this ->getErrorMessage($e);
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
				<a href="/Website/admin_panel/session/edit/'.$line['friendlyAddress'].'">Edytuj</a>
				</div>
				<div class="edit-content-menu">
				<a href="/Website/admin_panel/session/delete/'.$line['id'].'">Usuń</a>
				</div>
				<div style="clear: both"></div>';
				return $text;
			}
			else return "ERROR";
		}
		
		function writeEditArticleContent($params)
		{
			$line = $this->getArticleContentFromDatabase($params);
			if(!isset($line['null']))
			{
				$_SESSION['articleid']=$line['id'];
				$text ='<form action="/Website/admin_panel/session/update/'.$line['friendlyAddress'].'" method="post">
				Tytuł:<br />
				<input type="text" value="'.$line['name'].'" name="name" class="article"/><br />
				Kategoria:<br />
				<select name="category" id="category" class="article">
					<option '; if($params[3]=='sprzet') $text = $text."selected"; $text = $text.'>Sprzęt</option>
					<option '; if($params[3]=='oprogramowanie') $text=$text.'selected'; $text=$text.'>Oprogramowanie</option>
					<option '; if($params[3]=='o-nas') $text=$text.'selected'; $text=$text.'>O nas</option>
				</select>
				<select name="subcategory" id="subcategory" class="article">';
					if($params[3]=='sprzet')
					{
						$text=$text.
						'<option '; if($params[4]=='plyta-glowna') $text=$text.'selected'; $text=$text.'>Płyta główna</option>
						<option '; if($params[4]=='procesor') $text=$text.'selected'; $text=$text.'>Procesor</option>
						<option '; if($params[4]=='karta-graficzna') $text=$text.'selected'; $text=$text.'>Karta graficzna</option>
						<option '; if($params[4]=='pamiec-masowa') $text=$text.'selected'; $text=$text.'>Pamięć masowa</option>
						<option '; if($params[4]=='karta-dzwiekowa') $text=$text.'selected'; $text=$text.'>Karta dźwiękowa</option>
						<option '; if($params[4]=='pamiec-ram') $text=$text.'selected'; $text=$text.'>Pamięć RAM</option>
						<option '; if($params[4]=='napedy-optyczne') $text=$text.'selected'; $text=$text.'>Napędy optyczne</option>
						<option '; if($params[4]=='chlodzenie') $text=$text.'selected'; $text=$text.'>Chłodzenie</option>
						<option '; if($params[4]=='zasilacz') $text=$text.'selected'; $text=$text.'>Zasilacz</option>';
					}
					if ($params[3]=='oprogramowanie')
					{
						$text=$text.
						'<option '; if($params[4]=='systemy-operacyjne') $text=$text.'selected'; $text=$text.'>Systemy operacyjne</option>
						<option '; if($params[4]=='programowanie') $text=$text.'selected'; $text=$text.'>Programowanie</option>';
					}
					if ($params[3]=='o-nas')
					{
						$text=$text.'<option selected>O nas</option>';
					}
				$text=$text.'</select><br />
				<script src="/Website/views/Admin_panel/option-script.js" language="javascript" type="text/javascript"></script>
				Zawartość: <br />
				<textarea name="content" class="article">'.$line['content']."</textarea><br />";
				if(isset($_SESSION['errorA'])) $text=$text.$_SESSION['errorA'];
				$text=$text.'<input type="submit" value="Opublikuj" class="article"><br /><br />
				</form>';
				return $text;
			}
			else return "ERROR";
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
							$error = "Przepraszam, ale możesz tylko wysłać pliki: JPG, PNG, JPEG lub GIF";
							$uploadOk = 0;
						}
				
						if ($uploadOk == 1)
						{
							if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file))
							{
								$target_file = "/Website/files/".basename($_FILES['fileToUpload']['name']);
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
						
						$_SESSION['errorF'] = $error;
					}
				}
			}
			catch(Exception $e)
			{
				$this ->getErrorMessage($e);
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
					header('Location: /Website/admin_panel/session/');
				}
			} 
			catch (Exception $e) 
			{
				$this ->getErrorMessage($e);
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
						header('Location: /Website/admin_panel/session/upload/');
					}
				}
			}
			catch(Exception $e)
			{
				$this ->getErrorMessage($e);
			}
		}
		
		function logout()
		{
			session_unset();
			
			header('Location: /Website/admin_panel/');
		}
		
		function update($params)
		{
			if(!isset($_POST['name']))
			{
				header('Location: /Website/admin_panel/session/');
				exit();
			}
			if((empty($_POST['name'])) || (empty($_POST['subcategory'])) || (empty($_POST['category'])) || (empty($_POST['content'])))
			{
				$_SESSION['errorA']='<span style="color: red;">Nie wszystkie pola zostały uzupełnione!</span><br />';
				if((!isset($params[3])) || (!isset($params[4])) || (!isset($params[5])))
				{
					header('Location: /Website/admin_panel/session/new/');
					exit();
				}
				else
				{
					header('Location: /Website/admin_panel/session/edit/'.$params[3]."/".$params[4]."/".$params[5]."/");
					exit();
				}
			}
			else
			{
				unset($_SESSION['errorA']);
				$name=$_POST['name'];
				$authorId=$_SESSION['id'];
				$createDate=$date = date('Y-m-d');
				$friendlyAddress = $_POST['category']."/".$_POST['subcategory'];
				$category=$_POST['subcategory'];
				$content=$_POST['content'];
				$transformation = array(
						"Ę" => "E",
						"Ó" => "O",
						"Ą" => "A",
						"Ś" => "S",
						"Ł" => "L",
						"Ż" => "Z",
						"Ź" => "Z",
						"Ć" => "C",
						"Ń" => "N",
						"ę" => "e",
						"ó" => "o",
						"ą" => "a",
						"ś" => "s",
						"ł" => "l",
						"ż" => "z",
						"ź" => "z",
						"ć" => "c",
						"ń" => "n");
				$friendlyAddress=strtr($friendlyAddress, $transformation)."/".strtr($name, $transformation);
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
							header('Location: /Website/admin_panel/session/view/'.$friendlyAddress.'/');
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
							header('Location: /Website/admin_panel/session/view/'.$friendlyAddress.'');
						}
					}
				}
				catch(Exception $e)
				{
					$this ->getErrorMessage($e);
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
			}
		}
	}
?>