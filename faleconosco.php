<?php
include 'configsite.php';
$msg = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $mensagem = filter_input(INPUT_POST, 'mensagem', FILTER_SANITIZE_STRING);
    if ($nome == null) {
        $nome = 'Nome não informado';
    }
    if ($email == null) {
        $email = 'naoresponda@caixascoloridas.com';
    }
    if (($mensagem == null) || (trim($mensagem) == '')) {
        $msg = 'É necessário ao menos digitar a mensagem.';
    }
    else {
        $cabecalho = "From: $nome <$email>\r\nCc: meuchefe@cc.com";
        if (mail('contato@caixascoloridas.com', 'Mensagem do Fale Conosco', $mensagem, $cabecalho)) {
            $msg = 'Mensagem enviada com sucesso.';
        }
        else {
            $msg = 'Erro no envio da mensagem. Tente novamente.';
        }
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Caixas Coloridas :: Fale Conosco</title>
    </head>
    <body>
        <h1>Caixas Coloridas :: Fale Conosco</h1>
        <p><a href="index.php">home</a></p>
        <p><strong><?php echo $msg; ?></strong></p>
        <p>Use o formulário a seguir para entrar em contato com nossa equipe. Envie suas dúvidas, sugestões e críticas. Se quiser ter uma resposta não se esqueça de informar seu endereço de e-mail.</p>
        <form action="faleconosco.php" method="post">
            <p>Seu nome:
                <input type="text" name="nome" maxlength="80" size="80"></p>
            <p>Seu endereço de e-mail:
                <input type="email" name="email" maxlength="80" size="80"></p>
            <p>Sua mensagem:<br>
                <textarea name="mensagem" cols="80" rows="10" maxlength="3000"></textarea></p>
            <p><input type="submit" value="Enviar mensagem"></p>
        </form>
    </body>
</html>
