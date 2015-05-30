<?php
include 'configsite.php';
$flag = FALSE;
$erro['login'] = '';
$erro['senha'] = '';
$login = '';
define('ERRLOGIN', 'Login não encontrado ou senha incorreta.');
define('ERRSTATUS', 'Sua conta está inativa. Entre em <a href="contato.php">contato</a> conosco.');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['login'])) {
        $login = trim($_POST['login']);
    }
    else {
        $login = '';
    }
    
    $senha = (isset($_POST['senha'])) ? trim($_POST['senha']) : '';

    if ($login == '') {
        $erro['login'] = 'login não preenchido';
        $flag = TRUE;
    }
    if ($senha == '') {
        $erro['senha'] = 'senha não preenchida';
        $flag = TRUE;
    }
    
    if (!$flag) {
        if (!$sql = $conn->prepare('SELECT id,email,nome,senha,status FROM usuarios WHERE email=?')) {
            exit('Erro inesperado 001.');
        }
        if (!$sql->bind_param('s', $login)) {
            exit('Erro inesperado 002.');
        }
        if (!$sql->execute()) {
            exit('Erro inesperado 003.');
        }
        $sql->store_result();
        if ($sql->num_rows == 0) {
            $erro['login'] = ERRLOGIN;
        }
        else {
            $sql->bind_result($id, $email, $nome, $senhabanco, $status);
            $sql->fetch();
            if ($status != 'A') {
                $erro['login'] = ERRSTATUS;
            }
            else if ($senhabanco == crypt($senha, $senhabanco)) {
                $expiracao = (isset($_POST['lembrar'])) ? (time() + 24 * 60 * 60 * 15) : 0;
                if (!$sql = $conn->prepare('SELECT apelido,pontuacao FROM jogadores WHERE id=?')) {
                    exit('Erro inesperado 004.');
                }
                if (!$sql->bind_param('i', $id)) {
                    exit('Erro inesperado 005.');
                }
                if (!$sql->execute()) {
                    exit('Erro inesperado 006.');
                }
                $sql->store_result();
                if ($sql->num_rows > 0) {
                    $sql->bind_result($apelido, $pontuacao);
                    $sql->fetch();
                    setcookie('apelido', $apelido, $expiracao);
                    setcookie('pontuacao', $pontuacao, $expiracao);
                }
                setcookie('id', $id, $expiracao);
                setcookie('nome', $nome, $expiracao);
                header('Location: exclusivo/');
            }
            else {
                $erro['login'] = ERRLOGIN;
            }
        }
    }
    
}
?>
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
            <h1>Acesse sua conta</h1>
<?php
if ((isset($_GET['ok'])) && ($_GET['ok'] == 'ok')) {
?>
            <p><strong>Sua conta foi criada com sucesso.</strong></p>
<?php
}
?>
            <p>Preencha o formulário a seguir para acessar sua conta e visualizar todo o conteúdo exclusivo que preparamos para você.</p>
            <form action="login.php" method="post">
                login: <input type="text" name="login" autofocus="autofocus" required="required" size="80" maxlength="80" value="<?php echo $login; ?>"> <?php echo $erro['login']; ?><br>
                senha: <input type="password" name="senha" size="15" maxlength="15" required="required"> <?php echo $erro['senha']; ?><br>
                lembrar a senha? (até 15 dias) <input type="checkbox" name="lembrar" value="S"><br>
                <input type="submit" value="Ok"><br><br>
                <a href="esquecisenha.php">esqueci a senha</a><br>
                <a href="criarconta.php">criar conta</a>
            </form>
        </div>
    </body>
</html>
