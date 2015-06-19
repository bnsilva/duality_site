<?php
include '../configsite.php';
if (!isset($_COOKIE['id'])) {
    header('Location: ../login.php');
    exit('Erro inesperado. <a href="../login.php">Clique aqui</a> para tentar novamente.');
}
?>
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
                    <h2>Área compra</h2>
<?php
$id_jogador = $_COOKIE['id'];
$datacompra = date('Y-m-d H:i:s', time());
// registra uma compra
$sql = 'INSERT INTO compras VALUES (null,?,?,0)';
$rs = $conn->prepare($sql);
$rs->bind_param('is', $id_jogador, $datacompra);
$rs->execute();
$id_compra = $rs->insert_id;

// registra os detalhes da compra
$dadosform = array_values($_POST);
$totalcompra = 0;
for ($i=0; $i<count($dadosform); $i++) {
    $qtde = intval($dadosform[$i+2]);
    if ($qtde > 0) {
        $id_dlc = intval($dadosform[$i]);
        $valorunitario = floatval($dadosform[$i]);
        $totalcompra += ($valorunitario * $qtde);
        $sql = $conn->prepare('INSERT INTO detalhescompra VALUES (null,?,?,?,?)');
        $sql->bind_param('iiid', $id_compra, $id_dlc, $qtde, $valorunitario);
        $sql->execute();
    }
    $i += 2;
}

// se algo foi comprado atualiza o total da compra e o estoque de DLCs do jogador
// se nada foi comprado remove a compra
if ($totalcompra > 0) {
    $sql = "UPDATE compras SET valortotal=$totalcompra WHERE id=$id_compra";
    $conn->query($sql) or exit('Erro 0x0533');
// Como fazer para atualizar o estoque de DLCs do jogador?
}
else {
    $sql = "DELETE FROM compras WHERE id=$id_compra";
    $conn->query($sql) or exit('Erro 0x0534');
}
?>
        <p>Compra efetuada com sucesso.</p>
        </div>
                    
                <?php
                    include_once("noticias.php");
                ?>
            </div>
        </div>
    </body>
</html>