<?php
class noticia{
	var $id;
	var $titulo;
	var $texto;
	var $data;

	function __construct(){
		$id = array();
		$titulo = array();
		$texto = array();
		$data = array();
	}

	function getNoticia($id){
		$conn = new mysqli('localhost','aluno','senha','aluno_sitedojogo');
		$sql = 'SELECT titulo, textonoticia, datanoticia FROM noticias WHERE id = '.$id;
		$rs = $conn->query($sql);
		$dados = $rs->fetch_assoc();

		$this->titulo[] = utf8_encode($dados['titulo']);
		$this->texto[] = utf8_encode($dados['textonoticia']);
		$this->data[] = $dados['datanoticia'];
		
	}

	function getAll(){
		$conn = new mysqli('localhost','aluno','senha','aluno_sitedojogo');
		$sql = 'SELECT id, titulo, datanoticia, textonoticia FROM noticias ORDER BY datanoticia DESC';
		$rs = $conn->query($sql);

		while($linhadados = $rs->fetch_assoc()){
			$this->id[] = $linhadados['id'];
			$this->titulo[] = utf8_encode($linhadados['titulo']);
			$this->texto[] = utf8_encode($linhadados['textonoticia']);
			$this->data[] = $linhadados['datanoticia'];
		}
	}

	function printNoticia(){
		echo '<h3><strong>'.$this->titulo[0].'</strong></h3>';
		echo '<p>'.$this->texto[0].'</p>';
		echo '<p>'.$this->data[0].'</p>';
	}

	function printTop10(){
		for($i = 0; $i < 10 AND $i < count($this->id); $i++){
			echo '<h3><strong>'.$this->titulo[$i].'</strong></h3>';
			echo '<p class="text-justify">'.substr($this->texto[$i], 0, 240).'... ';
			echo '<a href="exibenoticia.php?id='.$this->id[$i].'">Leia mais</a><p>';
			echo '<p>'.$this->data[$i].'</p>';
		}

		echo 'Leia todas <a href="exibenoticia.php">aqui<a>';

	}

	function printAll(){
		for($i = 0; $i < count($this->id); $i++){
			echo '<h3><strong>'.$this->titulo[$i].'</strong></h3>';
			echo '<p class="text-justify">'.$this->texto[$i].'</p>';
			echo '<p>'.$this->data[$i].'</p><br>';
		}
	}

	function setNoticia($titulo, $texto){

	}
}