<?php

$serverName = "localhost";
$user="root";
$senha="";
$db_name="blog";


try {

  $conn = mysqli_connect($serverName,$user,$senha,$db_name);

  




} catch (mysqli_sql_exception $e) {
  echo "Erro na conexao".$e;
}








 ?>
