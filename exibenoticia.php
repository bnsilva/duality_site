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
			<br><br>

			<div class="row">
				<?php
					include_once("ranking.php");
					
					// Pega o id da pagina se for 'NULL', imprime todas as noticias
					// se não pega o id e imprime a noticia correspondente
					echo '<div class="col-xs-6">';
					// echo '<h2 class="text-uppercase text-center"> conteúdo </h2>';
					
					$id = $_GET['id'];
					include_once("class/noticia.class.php");
					$noticia = new noticia();

					If($id == null){
						$noticia->getAll();
						$noticia->printAll();

					} else{
						$noticia->getNoticia($id);
						$noticia->printNoticia();
					}
					echo '</div>';

					include_once("noticias.php");
				?>
			</div>
		</div>
	</body>
</html>