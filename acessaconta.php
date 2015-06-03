<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Caixas Coloridas :: Acesse sua conta</title>
        <link rel="stylesheet" type="text/css" href="meusite.css">
    </head>
    <body>
        <div id="cabecalho">
            <img src="img/logojogo.gif" alt="Caixas Coloridas">
        </div>
        <div id="barranav">
            <ul>
                <li>home</li>
                <li>o jogo</li>
                <li>download</li>
                <li>compre</li>
                <li>forum</li>
                <li>contato</li>
            </ul>
        </div>
        <div id="conteudo">
<?php
//var_dump($_POST);
$login = trim($_POST['login']);
$senha = trim($_POST['senha']);
if ($login == '') {
    echo 'Faltou preencher o login<br>';
}
if ($senha == '') {
    echo 'Faltou preencher a senha';
}
?>
        </div>
    </body>
</html>