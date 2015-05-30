<!DOCTYPE html>

<html>
	<head>	
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="css/personalizado.css">
	</head>

	<body>
		<div class="container">
			<header class="row">
				<?php
					include_once("header.php");
				?>
			</header>

			<div class="row">	
				<?php
					include_once("ranking.php");
					include_once("conteudo.php");
					include_once("noticias.php");
				?>
			</div>
		</div>
	</body>
</html>