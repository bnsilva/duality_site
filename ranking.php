<?php
//tabela ranking
include_once("class/ranking.class.php");

$conn = new mysqli('localhost','aluno','senha','aluno_sitedojogo');
$sql = 'SELECT apelido, pontuacao FROM jogadores ORDER BY pontuacao ASC limit 10';
$rs = conn->query($sql);
$ranking = new ranking();

echo '<div class=\"col-md-4\">';

$i = 1;
while($linhadados = $rs->fetch_assoc()){
	$ranking->addJog($i, $linhadados['apelido'], $linhadados['pontuacao']);
	$i++;
}
$ranking->impTabela();

echo '</div>';
?>