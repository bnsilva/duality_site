<?php
class ranking{
	var $posicao;
	var $apelido;
	var $pontuacao;

	function __construct(){
		$posicao = array();
		$apelido = array();
		$pontuacao = array();
	}

	function addJog($posicao, $apelido, $pontuacao){
		$this->posicao[] = $posicao;
		$this->apelido[] = $apelido;
		$this->pontuacao[] = $pontuacao;
	}

	function impTabela(){
		echo '<table class="table">';
		echo '<tr> <th class="col-md-4">Posição</th>';
		echo '<th class="col-md-4">Apelido</th>';
		echo '<th class="col-md-4">Pontos</th> </tr>';
		
		for ($i = 0; $i < count($this->posicao); $i++) {
			echo '<tr>';
			echo '<td>'. $this->posicao[$i] .'</td>';
			echo '<td>'. $this->apelido[$i] .'</td>';
			echo '<td>'. $this->pontuacao[$i] .'</td>';
			echo '</tr>';	
		}
		echo '</table>';
	}
}