<?php 
session_start();
//o ob_start serve para limpar o bafet de saida e eviatr errps, qundo se esta usando um servidor compartilhado ouum servidor menor ele pode dar erro de direcionamento

ob_start();
date_default_timezone_set("Africa/Luanda");
include_once "./conexao.php";



?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="Widht=device-width, initial-scale=1.0">
   
    
    <title>Validar codigo</title>
</head>
<body>
    <?php
$dados=filter_input_array(INPUT_POST, FILTER_DEFAULT);
   
   if(!empty($dados['ValCodigo'])){
    //var_dump($dados);

    $query_usuario="SELECT id,nome,usuario, senha_usuario 
    FROM usuarios 
    WHERE id=:id 
    AND usuario=:usuario 
    AND codigo_autenticacao=:codigo_autenticacao
    LIMIT 1";

$result_usuario= $conn->prepare($query_usuario);

//substituir o link da query pelo valor do formulario
$result_usuario->bindParam(':id', $_SESSION['id']);
$result_usuario->bindParam(':usuario',$_SESSION['usuario']);
$result_usuario->bindParam(':codigo_autenticacao',$dados['codigo_autenticacao']);

$result_usuario->execute();

if(($result_usuario) and ($result_usuario->rowCount() !=0)){
    
    //lendo os registos que vieram do banco de dados
    $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);

    $query_up_usuario= "UPDATE usuarios  SET 
    codigo_autenticacao =NULL, 
    data_codigo_autenticacao=NULL
    WHERE id=:id 
    LIMIT 1";

    //preparando a query
   $result_up_usuario= $conn->prepare($query_up_usuario);
   $result_up_usuario->bindParam(':id',$_SESSION['id']);
   $result_up_usuario->execute();

   $_SESSION['nome']=$row_usuario['nome'];
   $_SESSION['codigo_autenticacao']= true;
       header("location:dashboard.php");

}else{
    $_SESSION['msg']="<p style='color:#ff0000'>erro: usuario nao encontrado</p>";
    header("lacation:index.php");
    exit();
}

   }

    ?>
<form method="POST" action="">
    <h2>Digite o codigo no e-mail enviado</h2>
      
      <label>Codigo</label>
      <input type="text" name="codigo_autenticacao" placeholder="Digite o codigo">
      <br>
      <br>
      <input type="submit"  name="ValCodigo" value="Validar">
  </form>
</body>
</html>