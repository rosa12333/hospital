
<?php 
session_start();
//o ob_start serve para limpar o bafet de saida e eviatr errps, qundo se esta usando um servidor compartilhado ouum servidor menor ele pode dar erro de direcionamento
ob_start(); //limpar o buffer de sIDA



date_default_timezone_set("Africa/Luanda");

include_once "./conexao.php";
?>




<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    
    <title>Login</title>
   
   
</head>
<body>

            
<div id="corpo-form-Cad"> 
    <h2> <center>Cadastra-se para ser um doador(a)</center> </h2>

    <?php 
   $dados= filter_input_array(INPUT_POST,FILTER_DEFAULT);
 
   if(!empty($dados['SendCaduser'])){
    var_dump($dados);
   $senha_cripto= password_hash($dados['senha_usuario'], PASSWORD_DEFAULT);

   $query_usuario= "INSERT INTO usuarios(nome, usuario,	senha_usuario,telefone,genero, data_nascimento,	cidade, grupo_sanguineo) 
   Values (:nome, :usuario, :senha_usuario, :telefone,:genero, :data_nascimento, :cidade, :grupo_sanguineo  )";
   $cad_usuario=$conn->prepare($query_usuario);
   $cad_usuario->bindParam(':nome',$dados ['nome']);
   $cad_usuario->bindParam(':usuario',$dados ['usuario']);
   $cad_usuario->bindParam(':senha_usuario',$senha_cripto);
   $cad_usuario->bindParam(':telefone',$dados ['telefone']);
   $cad_usuario->bindParam(':genero',$dados ['genero']);
   $cad_usuario->bindParam(':data_nascimento',$dados ['data_nascimento']);
   $cad_usuario->bindParam(':cidade',$dados ['cidade']);
   $cad_usuario->bindParam(':grupo_sanguineo',$dados ['grupo_sanguineo']);
   $cad_usuario-> execute();



   if($cad_usuario->rowCount()){
    $_SESSION['msg']="<p style='color:green'> Usuario cadastrado co sucesso</p>";
    header("location:index.php");
    exit();
   }else{
       
    $_SESSION['msg']="<p style='color:red'> Erro: Usuario nao cadastrado co sucesso</p>";
    
   }

   }
   if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);

   }
    
    
    
    ?>
    <div class="content">
    <form method="POST" action="">
        
        <form id="form">

        <label > Nome</label>
        <input type="text" name="nome" placeholder="Nome e Sobrenome"  required>
        
        <br><br>
       

        <label > Email</label>
        <input type="text" name="usuario" placeholder="email"  required>
        
        <br><br>
       

        <label > Senha</label>
        <input type="password" name="senha_usuario" placeholder="senha" required><br><br>

        <label > telefone</label>
        <input type="tel" name="telefone" placeholder="telefone" maxlength="9" required><br><br>

        <p>Sexo:</p>
        <input type="radio" id ="feminino" name="genero" value="feminino" required>
        <label for="feminino" > Feminino</label>
        <br>
    
        <input type="radio" id="masculino"name="genero" value="masculino" required>
        <label for="masculino" > Masculino</label>
        <br>

        <input type="radio" id="outro"name="genero" value="outro" required>
        <label for="outro" >Outro</label>
        <br><br>

        
        <label for="data_nascimento" >Data de Nascimento:</label>
        <input type="data" name="data_nascimento" id="data_nascimento" placeholder="Ano-mes-dia" required><br><br><br>

        <div class="inputBox">
            
            <label for="cidade" class="labelInput">Cidade</label>
            <input type="text" name="cidade" id="cidade" class="inputUser" required>
            <br>
            <br>Tipo Sanguíneo:</br>
            <select name="grupo_sanguineo" size="9" multiple>
            <option value=""selected></option>
            <option value="A+">A+</option>
            <option value="B+">B+</option>
            <option value="B-">B-</option>
            <option value="AB+">AB+</option>
            <option value="AB-">AB-</option>
            <option value="O+">O+</option>
            <option value="O-">O-</option>
            <option value="nao sei">Nao_sei</option>
            </select><br>
            <br>

            

        </div>

        



        <input type="submit" name="SendCaduser" value="Cadastrar"><br><br>

    </div>
    </form>
    </form>
    <a href="index.php">Login</a>
</body>


</html>