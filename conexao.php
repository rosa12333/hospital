<?php 

$host="localhost";
$user="root";
$pass="";
$dbname="celk";
$port=3306;


try{
   $conn= new PDO("mysql:host=$host;port=$port;dbname=". $dbname,$user, $pass );
   //echo"conexao feita com sucesso";
}catch(PDOException $err){
    //echo"erro:conexao nao feita ".$err->getMessage();

   }

?>