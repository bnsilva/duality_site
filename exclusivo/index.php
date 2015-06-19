<?php
include_once('configsite.php');
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Sun, 11 Apr 2010 05:00:00 GMT');

if (!(isset($_COOKIE['id']))){
    echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=../login.php'>";
    exit('Erro inesperado. <a href="../login.php">Clique aqui</a> para tentar novamente.');
}
?>
<!DOCTYPE html>
<html>
    <head>  
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="../css/personalizado.css">
        <title>Duality :: Área exclusiva</title>
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
                    <h2>Área exclusiva</h2>
                    <p>Bem vindo a sua home <strong> <?php echo $_COOKIE['nome']; ?> </strong>.</p>
                    <?php
                    if(isset($_COOKIE['apelido'])){
                        echo '<p>Bem vindo de volta '.$_COOKIE['apelido'].'. Atualmente possui '.$_COOKIE['pontuacao'].' pontos.</p>';
                    }
                    ?>
                    <p>Você poderá fazer o download do jogo <a href="https://github.com/bnsilva/duality.git">aqui</a>, você será redirecionado
                        para nosso repositório no github.</p>

                    <?php
                    if($_COOKIE['id'] == 1){
                        echo 'Você pode inserir novas noticias <a href="inserenoticia.php">aqui</a>.';
                    }
                    ?>

                </div>
                    
                <?php
                    include_once("noticias.php");
                ?>
            </div>
        </div>
    </body>
</html>