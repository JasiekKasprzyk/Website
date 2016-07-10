<!DOCTYPE HTML>
<html lang="pl">

<head>
	<meta charset="utf-8" />
	<title>Onlykom</title>
	<meta name="description" content="(Opis od 155 do 160 znaków)." />
	<meta name="keywords" content="Tagi, tagi, tagi" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chroma=1" />
	<link rel="stylesheet" href="style.css" type="text/css" />
	<link rel="stylesheet" href="css/fontello.css" type="text/css" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link href='https://fonts.googleapis.com/css?family=Lato:400,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
	<script src="small-device-nav-button-script.js" language="javascript" type="text/javascript"></script>
</head>


<body onload="hide()">
	<div class="container-fluid">
		<div class="row header">
			<div class="title">
				<img src="files/logo.png" id="logo" />
				<br />
				Onlykom
			</div>
		</div>
		<!-- LESS THAN 806PX -->
		<div class="small-menu-button" onclick="show()">
			<i class="icon-menu"></i>
		</div>
		<div id="small-menu">
			<ol id="small">
				<li><a href="/Website/">Start</a></li>
				
				<li><a onclick="release(2)">Sprzęt</a></li>
				
				<li class="show2"><a href="/Website/category=sprzet/plyta-glowna">Płyta główna</a></li>
				<li class="show2"><a href="/Website/category=sprzet/procesor">Procesor</a></li>
				<li class="show2"><a href="/Website/category=sprzet/karta-graficzna">Karta graficzna</a></li>
				<li class="show2"><a href="/Website/category=sprzet/pamiec-masowa">Pamięć masowa</a></li>
				<li class="show2"><a href="/Website/category=sprzet/karta-dzwiekowa">Karta dźwiękowa</a></li>
				<li class="show2"><a href="/Website/category=sprzet/pamiec-ram">Pamięc RAM</a></li>
				<li class="show2"><a href="/Website/category=sprzet/napedy-optyczne">Napędy optyczne</a></li>
				<li class="show2"><a href="/Website/category=sprzet/chlodzenie">Chłodzenie</a></li>
				<li class="show2"><a href="/Website/category=sprzet/zasilacz">Zasilacz</a></li>
				
				<li><a onclick="release(3)">Oprogramowanie</a></li>
				
				<li class="show3"><a href="/Website/?category=oprogramowanie/systemy-operacyjne">Systemy operacyjne</a></li>
				<li class="show3"><a href="/Website/?category=oprogramowanie/programowanie">Programowanie</a></li>
				
				<li><a href="/Website/?category=o-nas">O nas</a></li>
			</ol>
		</div>
		<!-- MORE THAN 806PX -->
		<div id="menu">
			<ol id="big">
				<li>
					<a href="/Website/">Start</a>
				</li>
				<li>
					<a href="#">Sprzęt</a>
					<ul>
						<li><a href="/Website/?category=sprzet/plyta-glowna">Płyta główna</a></li>
						<li><a href="/Website/?category=sprzet/procesor">Procesor</a></li>
						<li><a href="/Website/?category=sprzet/karta-graficzna">Karta graficzna</a></li>
						<li><a href="/Website/?category=sprzet/pamiec-masowa">Pamięć masowa</a></li>
						<li><a href="/Website/?category=sprzet/karta-dzwiekowa">Karta dźwiękowa</a></li>
						<li><a href="/Website/?category=sprzet/pamiec-ram">Pamięc RAM</a></li>
						<li><a href="/Website/?category=sprzet/napedy-optyczne">Napędy optyczne</a></li>
						<li><a href="/Website/?category=sprzet/chlodzenie">Chłodzenie</a></li>
						<li><a href="/Website/?category=sprzet/zasilacz">Zasilacz</a></li>
					</ul>
				</li>
				<li>
					<a href="#">Oprogramowanie</a>
					<ul>
						<li><a href="/Website/?category=oprogramowanie/systemy-operacyjne">Systemy operacyjne</a></li>
						<li><a href="/Website/?category=oprogramowanie/programowanie">Programowanie</a></li>
					</ul>
				</li>
				<li><a href="/Website/?category=o-nas">O nas</a></li>
			</ol>
		</div>
		<div class="container">
			<div class="newsfeed">
<?php
	require_once "connect.php";
	mysqli_report(MYSQLI_REPORT_STRICT);
	try
	{
		$connection = @new mysqli($host, $db_user, $db_password, $db_name);
		if($connection->connect_errno!=0)
		{
			throw new Exception(mysqli_connect_errno());
		}
		else
		{
			if(isset($_GET['friendlyAddress']))
			{
				$friendlyAddress = $_GET['friendlyAddress'];
				$query="SELECT articles.name, articles.createDate, articles.category, articles.content, administrators.username FROM articles, administrators WHERE articles.authorId=administrators.id AND articles.friendlyAddress='$friendlyAddress'";
				$result = $connection->query($query);
				if(!$result)
				{
					throw new Exception($connection->error);
				}
				else
				{
					if($result->num_rows==1)
					{
						$row = $result->fetch_assoc();
						$name = $row['name'];
						$createDate = $row['createDate'];
						$category = $row['category'];
						$content = $row['content'];
						$username = $row['username'];
						echo $name;
						echo '<div class="news">';
						echo '<h1>'.$name.'</h1>';
						echo '<h6>Data utworzenia: '.$createDate.' | Kategoria: '.$category.' | Autor: '.$username.'</h6>';
						echo $content;
						echo '</div>';
						$result->free();
					}
					else echo "Error 404!";
				}
			}
			else
			{
				if(isset($_GET['category']))
				{
					$category = $_GET['category'];
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
						case "o-nas": $category="O nas";
						break;
						default: $category="Nieprawidłowy link";
						break;
					}
					
					$query="SELECT articles.name, articles.createDate, articles.category, articles.content, articles.friendlyAddress, administrators.username FROM articles, administrators WHERE articles.authorId=administrators.id AND articles.category='$category' ORDER BY articles.createDate DESC";
				}
				else
				{
					$query="SELECT articles.name, articles.createDate, articles.category, articles.content, articles.friendlyAddress, administrators.username FROM articles, administrators WHERE articles.authorId=administrators.id ORDER BY articles.createDate DESC LIMIT 10";
				}
				$result = $connection->query($query);
				if(!$result)
				{
					throw new Exception($connection->error);
				}
				else
				{
					if(isset($category))
					{
						echo '<div class="category-header">'.$category.'</div>';
					}
					while($row = $result->fetch_assoc())
					{
						$name = $row['name'];
						$createDate = $row['createDate'];
						$category = $row['category'];
						$content = $row['content'];
						$friendlyAddress = $row['friendlyAddress'];
						$username = $row['username'];
						
						echo '<div class="news">';
						echo '<h1>'.$name.'</h1>';
						echo '<h6>Data utworzenia: '.$createDate.' | Kategoria: '.$category.' | Autor: '.$username.'</h6>';
						echo substr($content, 0, 750).'... <a href="index?friendlyAddress='.$friendlyAddress.'">Czytaj dalej</a>';
						echo '</div>';
					}
					$result->free();
				}
			}
			$connection->close();
		}
	}
	catch(Exception $e)
	{
		echo '<div class="news"><h1>Błąd serwera! Przepraszamy za niedogodności i prosimy o odwiedzenie naszej strony w innym terminie!</h1></div>';
		echo 'Informacja deweloperska:'.$e;
	}
?>
			</div>
			<div class="advert-bar">
				aaa
			</div>
			<div style="clear: both">
			</div>
		</div>
		<div id="footer">
			Wszelkie prawa zastrzeżone &copy; Onlykom 2016
		</div>
	</div>
</body>

</html>