<!DOCTYPE HTML>
<html lang="pl">

<head>
	<meta charset="utf-8" />
	<title>Onlykom</title>
	<meta name="description" content="(Opis od 155 do 160 znaków)." />
	<meta name="keywords" content="Tagi, tagi, tagi" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chroma=1" />
	<link rel="stylesheet" href="/Website/views/Index/style.css" type="text/css" />
	<link rel="stylesheet" href="/Website/views/Index/css/fontello.css" type="text/css" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link href='https://fonts.googleapis.com/css?family=Lato:400,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
	<script src="/Website/views/Index/small-device-nav-button-script.js" language="javascript" type="text/javascript"></script>
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
				
				<li class="show2"><a href="/Website/sprzet/plyta-glowna">Płyta główna</a></li>
				<li class="show2"><a href="/Website/sprzet/procesor">Procesor</a></li>
				<li class="show2"><a href="/Website/sprzet/karta-graficzna">Karta graficzna</a></li>
				<li class="show2"><a href="/Website/sprzet/pamiec-masowa">Pamięć masowa</a></li>
				<li class="show2"><a href="/Website/sprzet/karta-dzwiekowa">Karta dźwiękowa</a></li>
				<li class="show2"><a href="/Website/sprzet/pamiec-ram">Pamięc RAM</a></li>
				<li class="show2"><a href="/Website/sprzet/napedy-optyczne">Napędy optyczne</a></li>
				<li class="show2"><a href="/Website/sprzet/chlodzenie">Chłodzenie</a></li>
				<li class="show2"><a href="/Website/sprzet/zasilacz">Zasilacz</a></li>
				
				<li><a onclick="release(3)">Oprogramowanie</a></li>
				
				<li class="show3"><a href="/Website/oprogramowanie/systemy-operacyjne">Systemy operacyjne</a></li>
				<li class="show3"><a href="/Website/oprogramowanie/programowanie">Programowanie</a></li>
				
				<li><a href="/Website/o-nas/o-nas">O nas</a></li>
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
						<li><a href="/Website/sprzet/plyta-glowna">Płyta główna</a></li>
						<li><a href="/Website/sprzet/procesor">Procesor</a></li>
						<li><a href="/Website/sprzet/karta-graficzna">Karta graficzna</a></li>
						<li><a href="/Website/sprzet/pamiec-masowa">Pamięć masowa</a></li>
						<li><a href="/Website/sprzet/karta-dzwiekowa">Karta dźwiękowa</a></li>
						<li><a href="/Website/sprzet/pamiec-ram">Pamięc RAM</a></li>
						<li><a href="/Website/sprzet/napedy-optyczne">Napędy optyczne</a></li>
						<li><a href="/Website/sprzet/chlodzenie">Chłodzenie</a></li>
						<li><a href="/Website/sprzet/zasilacz">Zasilacz</a></li>
					</ul>
				</li>
				<li>
					<a href="#">Oprogramowanie</a>
					<ul>
						<li><a href="/Website/oprogramowanie/systemy-operacyjne">Systemy operacyjne</a></li>
						<li><a href="/Website/oprogramowanie/programowanie">Programowanie</a></li>
					</ul>
				</li>
				<li><a href="/Website/o-nas/o-nas">O nas</a></li>
			</ol>
		</div>
		<div class="container">
			<div class="newsfeed">
<?php echo $this-> content ?>
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