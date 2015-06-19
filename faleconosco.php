<?php include_once("configsite.php"); ?>

<!DOCTYPE html>

<?php
$msg = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $assunto = filter_input(INPUT_POST, 'assunto', FILTER_SANITIZE_EMAIL);
    $mensagem = filter_input(INPUT_POST, 'mensagem', FILTER_SANITIZE_STRING);
    
    if ($nome == null || trim($nome) == '') {
        $msg .= 'Nome não informado.<br>';
    }

    if ($email == null || trim($email) == '') {
        $msg .= 'Email não informado.<br>';
    }

    if ($assunto == null || trim($assunto) == ''){
        $msg .= 'Assunto não informado.<br>';
    }

    if(($mensagem == null) || (trim($mensagem) == '')) {
        $msg .= 'Mensagem não digitada.<br>';
    
    }
    if ($msg == '') {
        //Se nao há mensagem de erro envia o email
        $cabecalho = "From: $nome <$email>\r\n";
        if (mail('contato@nossosite.com', "$assunto", $mensagem, $cabecalho)) {
            if($_POST['novidade'] == 'sim'){
                //se o email foi enviado e o usuario deseja receber mailling
                if (!$sql = $conn->prepare("SELECT email FROM mailing WHERE email=?")) {
                    exit('Deu pau jogador');
                }
                if (!$sql->bind_param('s', $email)) {
                    exit('Deu pau jogador 2');
                }
                if (!$sql->execute()) {
                    exit('Deu pau jogador 3');
                }
                $sql->store_result();
                if ($sql->num_rows == 0){
                    if (!$sql = $conn->prepare("INSERT INTO mailing VALUES (?,?)")) {
                        exit('Deu pau jogador 4');
                    }
                    if (!$sql->bind_param('ss', $email, $nome)) {
                        exit('Deu pau jogador 5');
                    }
                    if (!$sql->execute()) {
                        exit('Deu pau jogador 6');
                    }
                }
            }
            
            echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=mailenviado.php'>";

        }
            
        else {
            //Caso falhe o envio do email
            $msg .= 'Erro no envio da mensagem. Tente novamente.';
        }
    }
}
?>

<html>
    <head>  
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="css/personalizado.css">
        <title>Duality :: Fale Conosco</title>
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
                    <h2>Fale Conosco</h2>
                    <p>Entre em contato conosco, através do formulário. Envie dúvidas, sugestões e críticas.<br>
                        Prencha todos os campos!</p>

                    <p class="erro-msg"> <?php echo $msg; ?> </P>
                    <form action="faleconosco.php" method="post">
                        <div class="form-group">
                            <label for='nome'>Nome:</label>
                            <input type="text" class="form-control" name="nome" maxlength="80" size="80" 
                                    value= "<?php echo trim($nome); ?>" required>
                        </div>

                        <div class="form-group">
                            <label for='email'>Email:</label>
                            <input type="email" class="form-control" name="email" maxlenght="80" size="80" 
                                    value= "<?php echo trim($email); ?>" required>
                        </div>

                        <div class="form-group">
                            <label for='assunto'>Assunto:</label>
                            <input type="text" class="form-control" name="assunto" maxlength="80" size="80"
                                    value= "<?php echo trim($assunto); ?>" required>
                        </div>

                        <div class="form-group">
                        <label for="mensagem">Sua mensagem:<br></label>
                            <textarea class="form-control" name="mensagem" cols="80" rows="10" maxlenght="3000" required>
                                <?php echo trim($mensagem); ?> </textarea>
                        </div>

                        <label for="noticias">Deseja receber novidades do jogo?<br></label>
                        <label class="radio-inline">
                            <input type="radio" name="novidade" id="sim" value="sim" checked> Sim
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="novidade" id="nao" value="nao"> Não
                        </label><br>

                        <button type="submit" class="btn bnt-default">Enviar mensagem</button>
                    </form>

                </div>
                    
                <?php
                    include_once("noticias.php");
                ?>
            </div>
        </div>
    </body>
</html>