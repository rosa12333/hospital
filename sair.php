<?php 

session_start();
ob_start();
unset($_SESSION['id'], $_session['nome']);
$_SESSION['msg']="<p style='color:green'>deslogado com sucesso</p>";

header("location:index.php");
?>