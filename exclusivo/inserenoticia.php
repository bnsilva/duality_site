<?php
include_once('configsite.php');
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Sun, 11 Apr 2010 05:00:00 GMT');

if (!(isset($_COOKIE['id'])) || $_COOKIE['id'] != 1){
    echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=index.php'>";
    exit('Erro inesperado. <a href="../login.php">Clique aqui</a> para tentar novamente.');
}

$msg = '';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $titulo = trim($_POST['titulo']);
    $texto = trim($_POST['texto']);
    $data = date('Y-m-d H:i:s');

    $sql = "INSERT INTO noticias VALUES (null, $titulo, $texto, $data)";
    if (!$sql = $conn->prepare("INSERT INTO noticias VALUES (null, ?, ?, ?)")){
        exit('Deu pau 7');
    }
    if (!$sql->bind_param('sss', $titulo, $data, $texto)){
        exit('Deu pau 8');
    }
    if (!$sql->execute()){
        var_dump($sql->error);
        exit('Deu pau 9');
    }

    $msg = 'Notícia inserida!';
}

?>

<!DOCTYPE html>
<html>
    <head>  
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="../css/personalizado.css">
        <title>Duality :: inserir noticias</title>
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
                    <h2>Inserir notícia</h2>
                    <p class="erro-msg"> <?php echo $msg; ?> </P>
                    <p>Preencha o formulário para inserir a notícia <strong> <?php echo $_COOKIE['nome']; ?> </strong>.</p>
                    <form action="inserenoticia.php" method="post">
                        <div class="form-group">
                            <label for='titulo'>Título:</label>
                            <input type="text" class="form-control" name="titulo" maxlength="80" size="80" required>
                        </div>

                        <div class="form-group">
                        <label for="texto">Texto:<br></label>
                            <textarea class="form-control" name="texto" cols="80" rows="10" maxlenght="5000" required></textarea>
                        </div>

                        <button type="submit" class="btn bnt-default">Cadastrar notícia</button>
                    </form>

                </div>
                    
                <?php
                    include_once("noticias.php");
                ?>
            </div>
        </div>
    </body>
</html>