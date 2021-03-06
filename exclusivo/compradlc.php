<?php
include '../configsite.php';
if (!isset($_COOKIE['id'])) {
    header('Location: ../login.php');
    exit('Erro inesperado. <a href="../login.php">Clique aqui</a> para tentar novamente.');
}
?>
<!DOCTYPE html>
<!DOCTYPE html>
<html>
    <head>  
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="../css/personalizado.css">
        <title>Duality :: Área exclusiva</title>
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
                    <h2>Compra dlc</h2>
                    <p>Olá
                    <?php echo $_COOKIE['nome'];
                    if (isset($_COOKIE['apelido'])) {
                        echo ' - ' . $_COOKIE['apelido'] . ' (' . $_COOKIE['pontuacao'] . ') pontos';
                    }
                    ?></p>
                <p>Use o formulário a seguir para comprar os DLCs.</p>
                <p><form action="efetuacompra.php" method="post">
                <table>
                    <tr>
                        <th>Ítem</th>
                        <th>Preço<br>unitário</th>
                        <th>Quantos<br>você tem</th>
                        <th>Quantidade</th>
                    </tr>
                <?php
                $sql = 'SELECT * FROM dlc ORDER BY nome';
                $rs = $conn->query($sql) or exit('Erro 0x0234');
                while ($linhadados = $rs->fetch_assoc()) {
                $sql = 'SELECT qtde FROM estoquedlc WHERE id_jogador=' . $_COOKIE['id'] . ' AND id_dlc=' . $linhadados['id'];
                $rs2 = $conn->query($sql) or exit('Erro 0x0235');
                if ($rs2->num_rows > 0) {
                    $linhadados2 = $rs->fetch_assoc();
                    $estoquedlc = $linhadados2['qtde'];
                }
                else {
                    $estoquedlc = 0;
                }
                ?>
                <tr>
                    <td><input type="hidden" name="id<?php echo $linhadados['id']; ?>" value="<?php echo $linhadados['id']; ?>"><?php echo utf8_encode($linhadados['nome']); ?></td>
                    <td style="text-align:right"><input type="hidden" name="preco<?php echo $linhadados['id']; ?>" value="<?php echo $linhadados['preco']; ?>"><?php echo $linhadados['preco']; ?></td>
                    <td style="text-align:center"><?php echo $estoquedlc; ?></td>
                    <td><input type="text" name="qtde<?php echo $linhadados['id']; ?>" id="qtde<?php echo $linhadados['id']; ?>" size="3" maxlength="2" value="0"></td>
                </tr>
                <?php
                }
                ?>
                </table>
            <input type="submit" value="Confirma a compra"></form>
           </div>
                    
                <?php
                    include_once("noticias.php");
                ?>
            </div>
        </div>
    </body>
</html>