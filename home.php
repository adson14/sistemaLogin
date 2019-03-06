<?php
  require_once 'db_connect.php';

  session_start();

  if(!isset($_SESSION['logado'])){
    header('Location: index.php');
  }

//Para exibir o nome do usuario
  $id = $_SESSION['id_usuario'];
  $sql = "SELECT * FROM usuario WHERE id='$id'";
  $resultado = mysqli_query($conn,$sql);
  $dados = mysqli_fetch_array($resultado);

  mysqli_close($conn);
   ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8"/>
<title>Restrita</title>
</head>


<body>

<h5>Olá <?php echo $dados['login']; ?></h5>

</body>


</html>
