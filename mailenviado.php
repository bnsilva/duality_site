<?php
include_once('configsite.php');
?>
<!DOCTYPE html>
<html>
    <head>  
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="css/personalizado.css">
        <title>Duality :: Email enviado</title>
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
                    <p>Email enviando com sucesso! Sua mensagem será lida e repondida por nossa equipe. Agradecemos o contato. </p>
                    <p>Clique <a href="index.php">aqui</a> para voltar a nossa home.</p>

                </div>
                    
                <?php
                    include_once("noticias.php");
                ?>
            </div>
        </div>
    </body>
</html>