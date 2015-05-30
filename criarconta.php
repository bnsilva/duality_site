<?php
include 'configsite.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (mysqli_connect_errno()) {
        echo 'Erro inesperado H253.';
        exit();
    }
    $email = $_POST['email'];
    $email2 = $_POST['email2'];
    $senha = $_POST['senha'];
    $senha2 = $_POST['senha2'];
    $nome = $_POST['nome'];
    $sexo = $_POST['sexo'];
    $mailing = $_POST['mailing'];
    $jogador = $_POST['jogador'];
    $apelido = $_POST['apelido'];
    $nascimento = $_POST['nascimento'];
    $datacadastro = date('Y-m-d H:i:s',time());
    
    // fazer as validações aqui
    
    $senha = crypt($senha);
    
    if (!$sql = $conn->prepare("INSERT INTO usuarios VALUES (null,?,?,?,?,?,?,?,'A')")) {
        exit('Deu pau');
    }
    if (!$sql->bind_param('sssssss', $nome, $email, $senha, $sexo, $nascimento, $datacadastro, $mailing)) {
        exit('Deu pau 2');
    }
    if (!$sql->execute()) {
        exit('Deu pau 3');
    }
    
    if ($jogador == 'S') {
        $idjogador = $sql->insert_id;
        if (!$sql = $conn->prepare("INSERT INTO jogadores VALUES (?,?,0)")) {
            exit('Deu pau jogador');
        }
        if (!$sql->bind_param('is', $idjogador, $apelido)) {
            exit('Deu pau jogador 2');
        }
        if (!$sql->execute()) {
            exit('Deu pau jogador 3');
        }
    }
    header('Location: login.php?ok=ok');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Caixas Coloridas :: Criar sua conta</title>
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
            <h1>Crie sua conta</h1>
            <p>Preencha o formulário a seguir para criar sua conta e poder visualizar todo o conteúdo exclusivo que preparamos para você.</p>
            <form action="criarconta.php" method="post">
                seu e-mail (será o login): <input type="email" name="email" autofocus="autofocus" required="required" size="80" maxlength="80"><br>
                confirme o e-mail (será o login): <input type="email" name="email2" required="required" size="80" maxlength="80"><br>
                senha: <input type="password" name="senha" size="15" maxlength="15" required="required"><br>
                confirme a senha: <input type="password" name="senha2" size="15" maxlength="15" required="required"><br>
                seu nome completo: <input type="text" name="nome" size="80" maxlength="80" required="required"><br>
                sexo: <input type="radio" name="sexo" value="F">Feminino <input type="radio" name="sexo" value="M">Masculino <input type="radio" name="sexo" value="X">Prefiro não informar<br>
                data de nascimento: <input type="date" name="nascimento" required="required"><br>
                deseja receber novidades sobre nossos jogos? <select name="mailing"><option value="S">Sim</option><option value="N">Não</option></select><br>
                deseja tornar-se um jogador de Caixas Coloridas? <input type="checkbox" name="jogador" value="S" checked="checked">Sim<br>
                se deseja tornar-se um jogador, qual será seu apelido? <input type="text" name="apelido" size="50" maxlength="50"><br>
                <input type="submit" value="Criar sua conta"><br><br>
                <a href="login.php">já tenho uma conta e desejo acessar a área exclusiva</a><br>
                <a href="index.php">home</a>
            </form>
        </div>
    </body>
</html>
