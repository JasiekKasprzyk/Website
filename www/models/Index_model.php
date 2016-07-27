<?php
	class Index_model extends Model
	{
		function __construct()
		{
			parent::__construct();
		}
		
		public function getArticles()
		{
			mysqli_report(MYSQLI_REPORT_STRICT);
			try
			{
				$query="SELECT articles.name, articles.createDate, articles.category, articles.content, articles.friendlyAddress, administrators.username FROM articles, administrators WHERE articles.authorId=administrators.id ORDER BY articles.createDate DESC LIMIT 10";
				$result = $this -> connection ->query($query);
				if(!$result)
				{
					throw new Exception($this -> connection->error);
				}
				else
				{
					$text = "";
					while($row = $result->fetch_assoc())
					{
						$name = $row['name'];
						$createDate = $row['createDate'];
						$category = $row['category'];
						$content = $row['content'];
						$friendlyAddress = $row['friendlyAddress'];
						$username = $row['username'];
						$text = $text.'<div class="news"><h1>'.$name.'</h1><h6>Data utworzenia: '.$createDate.' | Kategoria: '.$category.' | Autor: '.$username.'</h6>'.substr($content, 0, 750).'... <a href="/Website/www/'.$friendlyAddress.'">Czytaj dalej</a></div>';
					}
					return $text;
					$result->free();
				}
			} 
			catch(Exception $e)
			{
				$this -> getErrorMessage($e);
				echo $this -> errorMessage;
			}
		}
		
		public function getArticlesInSpecificCategory($params)
		{
			try
			{
				$category = $params[0]."/".$params[1];
				switch($category)
				{
					case "sprzet/plyta-glowna": $category="Płyta główna";
					break;
					case "sprzet/procesor": $category="Procesor";
					break;
					case "sprzet/karta-graficzna": $category="Karta graficzna";
					break;
					case "sprzet/pamiec-masowa": $category="Pamięć masowa";
					break;
					case "sprzet/karta-dzwiekowa": $category="Karta dźwiękowa";
					break;
					case "sprzet/pamiec-ram": $category="Pamięć RAM";
					break;
					case "sprzet/napedy-optyczne": $category="Napędy optyczne";
					break;
					case "sprzet/chlodzenie": $category="Chłodzenie";
					break;
					case "sprzet/zasilacz": $category="Zasilacz";
					break;
					case "oprogramowanie/systemy-operacyjne": $category="Systemy operacyjne";
					break;
					case "oprogramowanie/programowanie": $category="Programowanie";
					break;
					case "o-nas/o-nas": $category="O nas";
					break;
					default: $category="Nieprawidłowy link";
					break;
				}
						
				$query="SELECT articles.name, articles.createDate, articles.category, articles.content, articles.friendlyAddress, administrators.username FROM articles, administrators WHERE articles.authorId=administrators.id AND articles.category='$category' ORDER BY articles.createDate DESC";
				$result = $this -> connection->query($query);
				if(!$result)
				{
					throw new Exception($this -> connection->error);
				}
				else
				{
					$text = '<div class="category-header">'.$category.'</div>';
					while($row = $result->fetch_assoc())
					{
						$name = $row['name'];
						$createDate = $row['createDate'];
						$category = $row['category'];
						$content = $row['content'];
						$friendlyAddress = $row['friendlyAddress'];
						$username = $row['username'];
						
						$text = $text.'<div class="news"><h1>'.$name.'</h1><h6>Data utworzenia: '.$createDate.' | Kategoria: '.$category.' | Autor: '.$username.'</h6>'.substr($content, 0, 750).'... <a href="/Website/www/'.$friendlyAddress.'">Czytaj dalej</a></div>';
					}
					$result->free();
					return $text;
				}
			}
			catch(Exception $e)
			{
				$this -> getErrorMessage($e);
				echo $this -> errorMessage;
			}
		}
		
		public function getArticle($params)
		{
			try
			{
				$friendlyAddress = $params[0]."/".$params[1]."/".$params[2];
				$query="SELECT articles.name, articles.createDate, articles.category, articles.content, administrators.username FROM articles, administrators WHERE articles.authorId=administrators.id AND articles.friendlyAddress LIKE '$friendlyAddress%'";
				$result = $this -> connection->query($query);
				if(!$result)
				{
					throw new Exception($this ->connection->error);
				}
				else
				{
					if($result->num_rows>0)
					{
						$row = $result->fetch_assoc();
						$name = $row['name'];
						$createDate = $row['createDate'];
						$category = $row['category'];
						$content = $row['content'];
						$username = $row['username'];
						
						$text = '<div class="news"><h1>'.$name.'</h1><h6>Data utworzenia: '.$createDate.' | Kategoria: '.$category.' | Autor: '.$username.'</h6>'.$content.'</div>';
						$result->free();
					}
					else
					{
						$text = "Error 404!";
					}
					return $text;
				}
			}
			catch(Exception $e)
			{
				$this ->getErrorMessage($e);
				echo $this ->errorMessage;
			}
		}
	}
?>