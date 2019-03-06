<?php

require_once 'db_connect.php';//Conexao com o banco

session_start();//iniciando a sessão

if(isset($_POST['btnEntrar'])){//verifica se o botão foi clicado
  $erros=array();
  $login=mysqli_escape_string($conn,  $_POST['login']);
  $senha=mysqli_escape_string($conn,$_POST['password']);

  if(empty($login) or empty($senha)){//verifica se as variáveis estão vazias
    $erros[]="<li>Os campos login e senha estão vazios</li>";//guarda os erros em uma li

  }else {
    //verifica se o login digitado é o mesmo do banco de dados
    $sql= "SELECT login FROM usuario WHERE login = '$login'";
    $resultado=mysqli_query($conn,$sql);

    if(mysqli_num_rows($resultado)>0){//Se encontrar algum registro
      $senha = md5($senha);//chriptografa a senha para verificar
      $sql="SELECT * FROM usuario WHERE login='$login' AND senha='$senha'";//verifica se usuario e senha são iguais
      $resultado = mysqli_query($conn,$sql);//realiza a consulta

      if(mysqli_num_rows($resultado)==1){//se existir uma linha que atenda a consulta
        $dados = mysqli_fetch_array($resultado);//converte o resultado em um array e atribui a variável $dados
        $_SESSION['logado']=true;//cria a sessão logado
        $_SESSION['id_usuario']=$dados['id'];//pega o id do usuario da sessão
        header('Location: home.php');//Direciona o usuário para a págna restrita
      }
      else{
        $erros[]= "<li>Usuario e senha não conferem</li>";
      }

    }else {
      $erros[]="<li>Usuário inexistente</li>";//Caso não encontre o erro é armazenado no vetor
    }
  }
mysqli_close($conn);

}


 ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8"/>
<title>Login</title>
</head>

<body>

<?php
//aqui é feita a verificação se o array de erros está vazio se não estiver será exibido na tela
  if(!empty($erros)){
    foreach ($erros as $erro ) {
      echo $erro;
    }
  }
 ?>

<hr>
<h3>LOGIN</h3>
  <form action="" method="POST">
    Login: <input type="text" name="login">
    Senha: <input type="password" name="password">
    <input type="submit" name="btnEntrar">
  </form>
</body>

</html>
