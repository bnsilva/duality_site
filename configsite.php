<?php
date_default_timezone_set('America/Sao_Paulo');

header('Cache-Control: no-cache, must-revalidate');
header('Expires: Sun, 11 Apr 2010 05:00:00 GMT');
header('Content-Type: text/html; charset=UTF-8');

$conn = new mysqli('localhost','aluno','senha','aluno_sitedojogo');

define('AVATARPATH', '/wamp/www/site/exclusivo/avatares/');

$errosupload = array(
    0 => 'Não houve erro. O upload foi feito com sucesso',
    1 => 'O tamanho do arquivo excedeu o permitido pela diretiva upload_max_filesize do arquivo php.ini',
    2 => 'O tamanho do arquivo excedeu o valor definido em MAX_FILE_SIZE no formulário de envio',
    3 => 'O arquivo foi enviado parcialmente',
    4 => 'Nenhum arquivo foi enviado',
    6 => 'Não há diretório temporário no servidor',
    7 => 'Falha na gravação do arquivo',
    8 => 'Erro inexplicável',
    10000 => 'O formato do arquivo enviado é inválido',
    10001 => 'Erro no envio do arquivo'
);
?>
