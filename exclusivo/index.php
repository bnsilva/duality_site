<?php
include '../configsite.php';
if (!isset($_COOKIE['id'])) {
    header('Location: ../login.php');
    exit('Erro inesperado. <a href="../login.php">Clique aqui</a> para tentar novamente.');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Caixas Coloridas :: Área Exclusiva</title>
    </head>
    <body>
        <h1>Caixas Coloridas :: Área Exclusiva</h1>
        <p><a href="sair.php">[x] sair</a></p>
        <p>Olá
            <?php echo $_COOKIE['nome'];
            if (isset($_COOKIE['apelido'])) {
                echo ' - ' . $_COOKIE['apelido'] . ' (' . $_COOKIE['pontuacao'] . ') pontos';
            }
?></p>
<?php
        if (file_exists(AVATARPATH . $_COOKIE['id'] . '.jpg')) {
?>
        <p><img src="avatares/<?php echo $_COOKIE['id'] . '.jpg'; ?>" alt="<?php echo $_COOKIE['apelido']; ?>"></p>
<?php
        }
?>
        <p><form action="upavatar.php" method="post" enctype="multipart/form-data">Envie ou altere seu avatar<br><input type="hidden" name="MAX_FILE_SIZE" value="200000"><input type="file" name="avatar"> (JPG, até 200 kB) <input type="submit" value="Envia avatar"></form></p>
        <p><a href="compredlc.php">Compre DLCs</a></p>
        <p><a href="../faleconosco.php">Fale conosco</a></p>
    </body>
</html>
