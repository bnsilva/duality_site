<?php
if(isset($_COOKIE['id'])){
	unset($_COOKIE);
	setcookie("id", "", time() - 3600);
	header('Cache-Control: no-cache, must-revalidate');
	header('Expires: Sun, 11 Apr 2010 05:00:00 GMT');
	header('location: ../index.php');
}
?>