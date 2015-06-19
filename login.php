<?php
include_once('configsite.php');
$msg = '';
$login = '';

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $login = trim($_POST['login']);
    $senha = trim($_POST['senha']);

    if($login == ''){
    	$msg .= 'Login não preenchido.<br>';
    
    }else if($senha == ''){
    	$msg .= 'Senha não preenchida.<br>';
    }
    if($msg == ''){
    	if(!($sql = $conn->prepare("SELECT id, email, nome, senha, status FROM usuarios WHERE email=?"))){
    		exit('Deu pau 1');
    	}
    	
    	if(!($sql->bind_param('s', $login))){
    		exit('Deu pau 2');	
    	}
    	
    	if(!($sql->execute())){
    		exit('Deu pau 3');
    	}
    	
    	$sql->store_result();
    	if($sql->num_rows == 0){
    		$msg .= 'Login não encontrado.<br>';
    		$login = '';
    	
    	}else{
    		$sql->bind_result($id, $email, $nome, $senhabanco, $status);
    		$sql->fetch();
    		echo "SELECT id, email, nome, senha, status FROM usuarios WHERE id=$id";
    		if($status != 'A'){
    			$msg .= 'Sua conta não está ativa, entre em contato conosco <a href="faleconosco.php">aqui</a>.';
    		
    		}else if(!($senhabanco == crypt($senha, $senhabanco))){
    			$msg .= 'Senha incorreta.';

    		}else{
    			$expiracao = ($_POST['lembrar'] == 'S') ? (time() + 24 * 60 * 60 * 15) : 0;
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
                // header('Location: exclusivo/');
                echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=exclusivo/index.php'>";
            }
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
        <title>Duality :: Login</title>
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
                    <h2>Acesse sua conta</h2>
                    <p>Preencha seus dados cadastrados para acessar sua área exclusiva.</p>
                    <p class="erro-msg"> <?php echo "$msg"; ?> </p>

                    <form action="login.php" method="post">
                        <div class="form-group">
                            <p><label for='login'>Login</label> (será seu login):</p>
                            <input type="email" class="form-control" name="login" maxlength="80" size="80" 
                                    value= "<?php echo trim($login); ?>" required autofocus palceholder="example@email.com">
                        </div>

                        <div class="form-group">
                            <label for='senha'>Senha:</label>
                            <input type="password" class="form-control" name="senha" maxlenght="15" size="15" required>
                        </div>

                        <label for="lembrar">Deseja armazenar a senha? <br></label>
                        <label class="checkbox-inline">
                            <input type="checkbox" id="lembrar" value="S"> Sim
                        </label><br>

                        <button type="submit" class="btn bnt-default">Login</button><br>
                    </form>
                </div>
                    
                <?php
                    include_once("noticias.php");
                ?>
            </div>
        </div>
    </body>
</html>