<?php 
session_start();
ob_start();
include_once 'conexao.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require './lib/vendor/autoload.php';
$mail = new PHPMailer(true);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Senha</title>
</head>
<body>
    <h1>Recuperar Senha</h1>
    

    <?php
    $dados=filter_input_array(INPUT_POST, FILTER_DEFAULT);
    
    if(!empty($dados['SendRecupSenha'])){
        //var_dump($dados);
        
    $query_usuario="SELECT id,nome,usuario 
    from usuarios 
    WHERE usuario=:usuario 
    LIMIT 1";
    $result_usuario= $conn->prepare($query_usuario);
    $result_usuario->bindParam(':usuario',$dados['usuario'], PDO::PARAM_STR);
    $result_usuario->execute();

   
    if(($result_usuario)AND ($result_usuario->rowCount() !=0)){
        $row_usuario=$result_usuario->fetch(PDO::FETCH_ASSOC);
       $chave_recuperar_senha= password_hash($row_usuario['id'],PASSWORD_DEFAULT);

   // echo"chave $chave_recuperar_senha <br>";

      $query_up_usuario= "UPDATE usuarios 
      SET recuperar_senha=:recuperar_senha 
      WHERE id=:id 
      LIMIT 1";
      $result_up_usuario= $conn->prepare($query_up_usuario);
      $result_up_usuario->bindParam(':recuperar_senha', $chave_recuperar_senha, PDO::PARAM_STR);
      $result_up_usuario->bindParam(':id', $row_usuario['id'], PDO::PARAM_INT);
      


      if($result_up_usuario->execute()){
        $link ="http://localhost/celk/atualizar_senha.php? chave=$chave_recuperar_senha";

        try {

       $mail->SMTPDebug = SMTP::DEBUG_SERVER;
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
                    $mail->Subject = 'Recuperar senha';
                    $mail->Body    = 'Prezado(a) ' . $row_usuario['nome'] .".<br><br>Você solicitou alteração de senha.<br><br>Para continuar o processo de recuperação de sua senha, clique no link abaixo ou cole o endereço no seu navegador: <br><br><a href='" . $link . "'>" . $link . "</a><br><br>Se você não solicitou essa alteração, nenhuma ação é necessária. Sua senha permanecerá a mesma até que você ative este código.<br><br>";
                    $mail->AltBody = 'Prezado(a) ' . $row_usuario['nome'] ."\n\nVocê solicitou alteração de senha.\n\nPara continuar o processo de recuperação de sua senha, clique no link abaixo ou cole o endereço no seu navegador: \n\n" . $link . "\n\nSe você não solicitou essa alteração, nenhuma ação é necessária. Sua senha permanecerá a mesma até que você ative este código.\n\n";

                    $mail->send();

         $_SESSION['msg'] = "<p style='color: green'>Enviado e-mail com instruções para recuperar a senha. Acesse a sua caixa de e-mail para recuperar a senha!</p>";
        header("Location: index.php");


    } catch (Exception $e) {
        echo "Erro: E-mail não enviado sucesso. Mailer Error: {$mail->ErrorInfo}";
        }


      } else{
         $_SESSION['msg']="<p style='color:#ff0000'>erro:tente novamente</p>";
      }

    } else{
        $_SESSION['msg']="<p style='color:#ff0000'>erro: usuario nao encontrado</p>";
    }

    }
    if(isset($_SESSION['msg_rec'])){
        echo $_SESSION['msg_rec'];
        unset($_SESSION['msg_rec']);

       }

    
        
    ?>
    <form method="POST" action="">
    <?php
    $usuario=""; 
    if (isset($dados['usuario'])) {
        $usuario= $dados['usuario'];}
        ?>
        <label>Email</label>
        <input type="text" name="usuario" placeholder="Digite o usuario" value="<?php echo $usuario;?>"><br><br>

        
        <input type="submit" value="Recuperar" name="SendRecupSenha">

    </form>
    <br>
    Lembrou? <a href="index.php">click aqui </a> para logar
        
    </body>
</html>