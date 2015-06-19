<?php include_once('configsite.php'); ?>
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
				?>

				<div class="col-xs-6">
					<h2>Notícias</h2>
				<?php
					// Pega o id da pagina se for 'NULL', imprime todas as noticias
					// se não pega o id e imprime a noticia correspondente	
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