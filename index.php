<?php
include_once('configsite.php');
?>
<!DOCTYPE html>
<html>
    <head>  
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="css/personalizado.css">
        <title>Duality :: Home</title>
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

                <div class="col-md-6">
                    <h2>Duality home</h2>
                    <p>Bem vindo a nossa home. Cadastre-se <a href="criarconta.php">aqui</a> para ter acesso a conteúdo exclusivo.</p>
                    <p>Você poderá fazer o download do jogo <a href="https://github.com/bnsilva/duality.git">aqui</a>, você será redirecionado
                        para nosso repositório no github.</p>

                </div>
                    
                <?php
                    include_once("noticias.php");
                ?>
            </div>
        </div>
    </body>
</html>