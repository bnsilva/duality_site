<?php
include_once('configsite.php');

$email = '';
$email2 = '';
$senha = '';
$senha2 = '';
$nome = '';
$sexo = '';
$novidade = '';
$jogador = '';
$apelido = '';
$data = '';
$msg = '';

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $email = $_POST['email'];
    $email2 =  $_POST['email2'];
    $senha = $_POST['senha'];
    $senha2 = $_POST['senha2'];
    $nome = $_POST['nome'];
    $sexo = $_POST['sexo'];
    $novidade = $_POST['novidade'];
    $jogador = $_POST['jogador'];
    $apelido = $_POST['apelido'];
    $data = $_POST['data'];
    $cadastro = date('Y-m-d H:i:s');

    $msg = '';

    if ($email == null || trim($email) == '') {
        $msg .= 'Email não informado.<br>';
    
    }else if($email !== $email2){
        $msg .= 'Emails não coincidem.<br>';
    }

    if ($senha == null || trim($senha) == '') {
        $msg .= 'Senha não preenchida.<br>';
    
    }else if($senha !== $senha2){
        $msg .= 'Senhas não coincidem.<br>';
    }

    if ($nome == null || trim($nome) == '') {
        $msg .= 'Nome não informado.<br>';
    }

    if($jogador == 'sim'){
        if ($apelido == null || trim($apelido) == '') {
            $msg .= 'Para ser um jogador deve informar um apelido.<br>';
        }
    }

    if($msg == ''){
        $senha = crypt($senha);

        if (!$sql = $conn->prepare("SELECT email FROM usuarios WHERE email=?")) {
            exit('Deu pau jogador');
        }
        if (!$sql->bind_param('s', $email)) {
            exit('Deu pau jogador 2');
        }
        if (!$sql->execute()) {
            exit('Deu pau jogador 3');
        }
        $sql->store_result();
        if (!($sql->num_rows == 0)){
            $msg = 'Usuário já cadastrado.<br>';

        }else{
            // Se não houver usuário cadastrado... insere dados na tabela
            if (!$sql = $conn->prepare("INSERT INTO usuarios VALUES (null, ?, ?, ?, ?, ?, ?, ?, 'A')")){
                exit('Deu pau 4');
            }
            if (!$sql->bind_param('sssssss', $nome, $email, $senha, $sexo, $data, $cadastro, $novidade)){
                exit('Deu pau 5');
            }
            if (!$sql->execute()){
                exit('Deu pau 6');
            }

            if (!$sql = $conn->prepare("INSERT INTO jogadores VALUES (null, ?, 0)")){
                exit('Deu pau 7');
            }
            if (!$sql->bind_param('s', $apelido)){
                exit('Deu pau 8');
            }
            if (!$sql->execute()){
                exit('Deu pau 9');
            }

            if($_POST['novidade'] == 'S'){
                //se usuario deseja receber mailling
                if (!$sql = $conn->prepare("SELECT email FROM mailing WHERE email=?")) {
                    exit('Deu pau jogador 10');
                }
                if (!$sql->bind_param('s', $email)) {
                    exit('Deu pau jogador 11');
                }
                if (!$sql->execute()) {
                    exit('Deu pau jogador 12');
                }
                $sql->store_result();
                if ($sql->num_rows == 0){
                    // se ainda não estiver na lista de mailing
                    if (!$sql = $conn->prepare("INSERT INTO mailing VALUES (?,?)")) {
                        exit('Deu pau jogador 13');
                    }
                    if (!$sql->bind_param('ss', $email, $nome)) {
                        exit('Deu pau jogador 14');
                    }
                    if (!$sql->execute()) {
                        exit('Deu pau jogador 15');
                    }
                }
            }
            
            echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=index.php'>";

        }
    }

}

?>

<!DOCTYPE html>
<html>
    <head>  
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="css/personalizado.css">
        <title>Duality :: Criar conta</title>
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
                    <h2>Criar conta</h2>
                    <p>Preencha o formulário abaixo para criar sua conta e ter acesso ao conteúdo exclusivo.</p>
                    <p> <?php echo "$msg"; ?> </p>

                    <form action="criarconta.php" method="post">
                        <div class="form-group">
                            <p><label for='email'>Email</label> (será seu login):</p>
                            <input type="email" class="form-control" name="email" maxlength="80" size="80" 
                                    value= "<?php echo trim($email); ?>" required autofocus palceholder="example@email.com">
                        </div>

                        <div class="form-group">
                            <label for='confirmeemail'>Confirme seu email:</label>
                            <input type="email" class="form-control" name="email2" maxlenght="80" size="80" 
                                    value= "<?php echo trim($email2); ?>" required palceholder="example@email.com">
                        </div>

                        <div class="form-group">
                            <label for='senha'>Senha:</label>
                            <input type="password" class="form-control" name="senha" maxlenght="15" size="15" required>
                        </div>

                        <div class="form-group">
                            <label for='confirmesenha'>Confirme a senha:</label>
                            <input type="password" class="form-control" name="senha2" maxlenght="15" size="15" required>
                        </div>

                        <div class="form-group">
                            <label for='nome'>Nome:</label>
                            <input type="text" class="form-control" name="nome" maxlength="80" size="80"
                                    value= "<?php echo trim($nome); ?>" required placeholder="João Pedro">
                        </div>

                        <div class="form-group">
                            <label for='data'>Data de Nascimento:</label>
                            <input type="date" class="form-control" name="data" required>
                        </div>

                        <label for="sexo">Sexo: <br></label>
                        <label class="radio-inline">
                            <input type="radio" name="sexo" id="f" value="f" checked> Feminino
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="sexo" id="m" value="m"> Masculino
                        </label><br>

                        <label for="noticias">Deseja receber novidades do jogo? <br></label>
                        <label class="radio-inline">
                            <input type="radio" name="novidade" value="S" checked> Sim
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="novidade" value="N"> Não
                        </label><br>

                        <label for="noticias">Deseja tornar-se um jogador? <br></label>
                        <label class="checkbox-inline">
                            <input type="checkbox" id="jogador" value="sim" checked> Sim
                        </label><br>

                        <div class="form-group">
                            <label for='apelido'>Se deseja se tornar jogador, qual será seu apelido? </label>
                            <input type="text" class="form-control" name="apelido" maxlength="50" size="80"
                                    value= "<?php echo trim($apelido); ?>" required placeholder="JP">
                        </div>

                        <button type="submit" class="btn bnt-default">Criar conta</button><br>
                    </form>
                </div>
                    
                <?php
                    include_once("noticias.php");
                ?>
            </div>
        </div>
    </body>
</html>