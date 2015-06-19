<?php
	echo '<div class="col-md-3">';
	echo '<a href="index.php"><img src="../img/duality_logo.jpg" class="img-responsive img-thumbnail" alt="Logo duality"></a>';
	echo '</div>';

	echo '<div class="col-md-9">';
	echo '<h1 class="text-uppercase text-right titulo"> Duality </h1>';
	echo <<<Menu
	<div>
		<nav class='menu'>
    		<ul>
    			<li> <a href="exibenoticia.php">Noticias</a> </li>
        		<li> <a href="faleconosco.php">Fale conosco</a></li>
        		<li> <a href="https://github.com/bnsilva/duality.git">Download jogo</a> </li>
        		<li> <a href="compradlc.php">Comprar dlc</a> </li>
        		<li> <a href="logout.php">Logout</a> </li>
			</ul>
	 	</nav>
	 </div>
Menu;
	echo '</div>';

?>