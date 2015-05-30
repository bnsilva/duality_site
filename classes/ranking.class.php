<?php
class ranking{
	$posicao;
	$apelido;
	$pontuacao;

	function __construct(){
		$posicao = array();
		$apelido = array();
		$pontuacao = array();
	}

	function addJog($posicao, $apelido, $pontuacao){
		$this->posicao[] = $posicao;
		$this->apelido[] = $apelido;
		$this->pontuacao = $pontuacao;
	}

	function impTabela(){
		echo '<th><td>Posição<td><td>Apelido<td><td>Pontuação<td></th>';
		for ($i = 0; $i < count($posicao); $i++) {
			echo '<tr>';
			echo "<td>&posicao</td>";
			echo "<td>&apelido</td>";
			echo "<td>&pontuacao</td>";
			echo '</tr>';	
		}
	}
}