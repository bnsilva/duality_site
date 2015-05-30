<?php
include '../configsite.php';
$fname = $_FILES['avatar']['name'];
$ftype = $_FILES['avatar']['type'];
$ftmp = $_FILES['avatar']['tmp_name'];
$ferror = $_FILES['avatar']['error'];
$fsize = $_FILES['avatar']['size'];

//var_dump($_FILES); exit();

if (($ftype != 'image/jpg') && ($ftype != 'image/jpeg')) {
    $ferror = 10000;
}

if ($ferror == 0) {
    $nomedoarquivoparaupload = AVATARPATH . $fname;
    $nomedoarquivonodisco = AVATARPATH . $_COOKIE['id'] . '.jpg';
    if (move_uploaded_file($ftmp, $nomedoarquivoparaupload)) {
        if (file_exists($nomedoarquivonodisco)) {
            unlink($nomedoarquivonodisco);
        }
        rename($nomedoarquivoparaupload, $nomedoarquivonodisco);
    }
    else {
        $ferror = 10001;
    }
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
        <p><strong><?php echo $errosupload[$ferror]; ?></strong></p>
        <p><a href="index.php">Clique aqui</a> para continuar a navegação pelo site. Caso tenha havido algum erro no envio do seu avatar volte e tente novamente.</p>
    </body>
</html>
