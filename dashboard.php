<?php 
session_start();
//o ob_start serve para limpar o bafet de saida e eviatr errps, qundo se esta usando um servidor compartilhado ouum servidor menor ele pode dar erro de direcionamento

ob_start();
date_default_timezone_set("Africa/Luanda");

if((!isset($_SESSION['id'])) AND (!isset($_SESSION['usuario']))AND (!isset($_SESSION['codigo_autenticacao'])) ) {


    $_SESSION['msg']="<p style='color:red'>erro:Necessario realizar o Login para acessar a pagina!</p>";
    header("location: index.php");
    exit();

}


?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>
</head>
<body>
    <?php 
    //ex criptogrfa semha
   //echo password_hash(123,PASSWORD_DEFAULT);
    
    ?>



    <h1>bem vindo , <?php echo $_SESSION['nome']; ?></h1>

    <a href="sair.php">sair</a>
</body>
</html>