<?php
setcookie('id', '0', time() - 1000);
setcookie('nome', '0', time() - 1000);
setcookie('apelido', '0', time() - 1000);
setcookie('pontuacao', '0', time() - 1000);
header('Location: ../index.php');
?>
