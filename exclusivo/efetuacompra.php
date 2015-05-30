<?php
include '../configsite.php';
if (!isset($_COOKIE['id'])) {
    header('Location: ../login.php');
    exit('Erro inesperado. <a href="../login.php">Clique aqui</a> para tentar novamente.');
}

//var_dump($_POST); exit();

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Caixas Coloridas :: Área Exclusiva :: Compre DLCs</title>
        <script src="../site.js"></script>
    </head>
    <body>
        <h1>Caixas Coloridas :: Área Exclusiva :: Compre DLCs</h1>
        <p><a href="sair.php">[x] sair</a></p>
        <p>Olá
            <?php echo $_COOKIE['nome'];
            if (isset($_COOKIE['apelido'])) {
                echo ' - ' . $_COOKIE['apelido'] . ' (' . $_COOKIE['pontuacao'] . ') pontos';
            }
?></p>
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
for ($i=0; $i<count($dadosform); $i+=3) {
    $qtde = intval($dadosform[$i+2]);
    if ($qtde > 0) {
        $id_dlc = intval($dadosform[$i]);
        $valorunitario = floatval($dadosform[$i+1]);
        $totalcompra += ($valorunitario * $qtde);
        $sql = $conn->prepare('INSERT INTO detalhescompra VALUES (null,?,?,?,?)');
        $sql->bind_param('iiid', $id_compra, $id_dlc, $qtde, $valorunitario);
        $sql->execute();
// atualização do estoque do jogador para o DLC comprado
// verificar se existe estoque do DLC para o jogador
        $sql = $conn->prepare('SELECT id FROM estoquedlc WHERE id_jogador=? AND id_dlc=?') or exit('Erro na atualização 0x0123');
        $sql->bind_param('ii', $id_jogador, $id_dlc) or exit('Erro na atualização 0x0124');
        $sql->execute() or die ('Erro na atualização 0,0125');
        $sql->store_result();
        if ($sql->num_rows == 0) {
// não encontrou estoque; cria
            $sql = $conn->prepare('INSERT INTO estoquedlc VALUES(null,?,?,?)') or exit('Erro na autalização 0x0126');
            $sql->bind_param('iii', $id_jogador, $id_dlc, $qtde) or exit('Erro na atualização 0x0126');
            $sql->execute() or exit('Erro na atualização 0x0127');
        }
        else {
// tem estoque; atualiza
            $sql = $conn->prepare('UPDATE estoquedlc SET qtde=qtde+? WHERE id_jogador=? AND id_dlc=?') or exit('Erro na atualização 0x0128');
            $sql->bind_param('iii', $qtde, $id_jogador, $id_dlc) or exit('Erro na atualização 0x0129');
            $sql->execute() or exit('Erro na atualização 0x0130');
        }
    }
}

// se algo foi comprado atualiza o total da compra e o estoque de DLCs do jogador
// se nada foi comprado remove a compra
if ($totalcompra > 0) {
    $sql = "UPDATE compras SET valortotal=$totalcompra WHERE id=$id_compra";
    $conn->query($sql) or exit('Erro 0x0533');
}
else {
    $sql = "DELETE FROM compras WHERE id=$id_compra";
    $conn->query($sql) or exit('Erro 0x0534');
}
?>
        <p>Compra efetuada com sucesso.</p>
        <p><a href="compredlc.php">Clique aqui</a> para retornar à página de compra de DLCs.</p>
        <p><a href="index.php">Clique aqui</a> para retornar à página principal da área exclusiva.</p>
        <p><a href="../faleconosco.php">Fale conosco</a></p>
    </body>
</html>
