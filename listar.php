<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">

   <!--Fonte do bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>Listar taelas</title>
</head>
  

<body>
<div class="container">
  <div class="row mt-4 mb-2">
    <div class="col-lg-12 d-flex justify-content-between align-items-center">
      <h4>listar usuarios</h4>
      <div>
      <button type="button" class="btn btn-outline-success btn-sm">cadastrar</button>
       
      </div>

    </div>

  </div>

</div>
    <div class="container">
  
  <!--<span id="msgAlerta"></span>-->
   

    <div class="row">
        <div class="col-lg-12">
    <!--<span id="msgAlerta"></span> -->
    </div>
    </div>
    </div>
 
 

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
   
 <!--<script src="js/custom.js">
 </script> -->

 
  

</body>
</html>




<?php 
include_once "conexao.php";

//WHERE usr.id=100
//$dados=filter_input_array(INPUT_POST, FILTER_DEFAULT);
//criar a query para recuperar os registros do  BD
$query_usuarios="SELECT usr.id,usr.nome,usr.genero, usr.grupo_sanguineo , rece.nome, rece.motivo_transfusao
    FROM usuarios AS usr
    LEFT JOIN receptor AS rece on rece.usuario_id=usr.id
    
    ORDER BY usr.id DESC";



$result_usuarios= $conn->prepare($query_usuarios);

   $result_usuarios->execute();

   if(($result_usuarios) and($result_usuarios->rowCount() != 0)){
$dados= "<table class='table table-striped table-bordered table-responsive table-hover'>";
$dados .="<thead>";
$dados .="<tr> ";
$dados .="<th>Id</th>";
$dados .=" <th>Nome</th>";
$dados .=" <th>Genero</th>";
$dados .=" <th>grupo_sanguineo</th>";
$dados .=" <th>Nome Receptor</th>";
$dados .=" <th>motivo_transfusao</th>";
$dados .=" <th>Acoes</th>";
$dados .="</tr>";
$dados .="</thead>";
$dados .="<tbody>";

    while($row_usuario = $result_usuarios->fetch(PDO::FETCH_ASSOC)){
       
        extract($row_usuario);

        $dados .=" <tr> ";
        $dados .=" <td>$id</th>";
        $dados .=" <td>$nome</td>";
        $dados .=" <td>$genero</td>";
        $dados .=" <td> $grupo_sanguineo</td>";
        $dados .=" <td> $nome</td>";
        $dados .=" <td>$motivo_transfusao</td>";
        $dados .=" <td>Visualizar Editar Excluir</td>";
        $dados .=" </tr>";
         
   
    }
    $dados .="</tbody>";
    $dados .="</table>";
  
   
    $retorna=['status' => true, 'dados' => $dados ];

} else{
    $retorna = ['status' => false, 'msg' => "<p style='color: #f00;'>Erro:nenhum usuario encontrado!</p>"];
}

echo json_encode($retorna);

?>


