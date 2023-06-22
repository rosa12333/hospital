<?php 
session_start();
//o ob_start serve para limpar o bafet de saida e eviatr errps, qundo se esta usando um servidor compartilhado ouum servidor menor ele pode dar erro de direcionamento
ob_start(); //limpar o buffer de sIDA
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;




date_default_timezone_set("Africa/Luanda");



include_once "./conexao.php";
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="Widht=device-width, initial-scale=1">
 <!--Fonte do google-->
 <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">

   <!--Fonte do bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
   
</head>
<body>


</body>
</html>





    <?php 
    //ex criptogrfa semha
   //echo password_hash(123,PASSWORD_DEFAULT);
    
    ?>


<nav>
        <object id="obMenu" data="menu.html"></object>
    </nav>
    <div id="corpo-form"> 
    <h1>Login</h1>


    <?php
    //para receber os dados do formulario 
    $dados=filter_input_array(INPUT_POST, FILTER_DEFAULT);
   
if(!empty($dados['SendLogin'])){
    //var_dump($dados);
    $query_usuario="SELECT id,nome,usuario, senha_usuario 
    FROM usuarios 
   WHERE usuario=:usuario 
    LIMIT 1";

  // preparar a query para conexao com a base de dados
   $result_usuario= $conn->prepare($query_usuario);

   //substituir o link da query pelo valor do formulario
   $result_usuario->bindParam(':usuario',$dados['usuario']/*, PDO::PARAM_STR*/);
   $result_usuario->execute();

   //acessar o if qua ndo encontrar o usuario no BD, rowcount:qntd de linhas
  if(($result_usuario) and ($result_usuario->rowCount() !=0)){
    
    //lendo os registos que vieram do banco de dados
    $row_usuario=$result_usuario->fetch(PDO::FETCH_ASSOC);
    //var_dump($row_usuario);
  if(password_verify($dados['senha_usuario'], $row_usuario['senha_usuario'])){

    //salvar os dados do usuario
    $_SESSION['id']=$row_usuario['id'];
    $_SESSION['usuario']=$row_usuario['usuario'];
    //$_SESSION['nome']=$row_usuario['nome'];
    //header("location:dashboard.php");
    
    //recuperar data actual
    $data=date('Y-m-d H:i:s');

    //gerando o codg randomico entre 100000 e 999999
    $codigo_autenticacao=mt_rand(10000,999999);
    //var_dump($codigo_autenticacao);
   
    //quey para salvar no bd o codigo e a data gerada
   $query_up_usuario= "UPDATE usuarios  SET 
    codigo_autenticacao =:codigo_autenticacao, 
    data_codigo_autenticacao=:data_codigo_autenticacao 
    WHERE id=:id 
    LIMIT 1";

    //preparando a query
   $result_up_usuario= $conn->prepare($query_up_usuario);
   $result_up_usuario->bindParam(':codigo_autenticacao', $codigo_autenticacao);
   $result_up_usuario->bindParam(':data_codigo_autenticacao', $data);
   $result_up_usuario->bindParam('id',$row_usuario ['id']);
   $result_up_usuario->execute();

   require './lib/vendor/autoload.php';
   $mail = new PHPMailer(true);
   
   try {

    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->CharSet = 'UTF-8';
                 $mail->isSMTP();
                 $mail->Host       = 'sandbox.smtp.mailtrap.io';
                 $mail->SMTPAuth   = true;
                 $mail->Username   = '63f38e72f59596';
                 $mail->Password   = '71ea72d7471f4d';
                 $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                 $mail->Port       = 2525;
                 $mail->setFrom('atendimento@celke.com', 'Atendimento');
                 $mail->addAddress($row_usuario['usuario'], $row_usuario['nome']);

                 $mail->isHTML(true);                                  //Set email format to HTML
                 $mail->Subject = 'Aqui esta o codigo de verificacao de 6 digitos que voce solicitou';
                 $mail->Body    = 'Ola ' . $row_usuario['nome'] .".<br><br>Autentificação multifator.<br><br>Seu codigo de verificacao de 6 digitos è $codigo_autenticacao.<br> Este codigo foi enviado para verificar o seu login.<br>";
                 $mail->AltBody = 'Ola' . $row_usuario['nome'] ."\n\nAutentificação multifator.\n\nSeu codigo de verificacao de 6 digitos è $codigo_autenticacao.\n\n esse codigo foi enviado paraverificar o seu login\n\n";

                 $mail->send();
                 header("location:validar_codigo.php");
                 
                }  catch (Exception $e) {
                  echo "Erro: E-mail não enviado . Mailer Error: {$mail->ErrorInfo}";
                  }




    //echo "usuario logado";
  
}else{
    $_SESSION['msg']="<p style='color:#ff0000'>erro: usuario ou senha errada</p>";
  }



  }else{
$_SESSION['msg']="<p style='color:#ff0000'>erro: usuario ou senha errada</p>";

  }

  


}
       if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);

       }
    ?>
    

    <form method="POST" action="">
    
      
        <label>Usuario</label>
        <input type="text" name="usuario" placeholder="Digite o usuario" ><br><br>

        <label>Senha</label>
        <input type="password" name="senha_usuario" placeholder="Digite a senha"><br><br>

        <br>
        <br>
        <input type="submit" value="Acessar" name="SendLogin">
    </form>
    <br>
    <br>
    <a href="cadastrar.php"> Cadastrar</a><br>
    <br>
    
    <a href="recuperar_senha.php">Esqueceu a senha?</a>
    <br><br>
    usuario:rosaduarte@gmail.com<br>
    senha:123


    
</body>
</html>