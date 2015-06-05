<?php
	include_once('class/noticia.class.php');

	$noticias = new noticia();
	$noticias->getAll();
	echo '<div class="col-xs-3">';
	echo '<h2 class="text-capitalize text-right">notícias recentes</h2>';
	$noticias->printTop10();
	echo '</div>';
?>