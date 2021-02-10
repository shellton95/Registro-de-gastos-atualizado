<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

<?php
  session_start();
  require_once '../Model/modelo_usuario.php';
?>


<!doctype html>
<html lang="en">
  <head>
    <link rel="stylesheet" type="text/css" href="../teste.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.79.0">
    <title>Signin Template · Bootstrap v5.0</title>
    
  </head>

<body class="text-center">
    
<main class="form-signin">
  <form method="POST" >
    <h1 class="h3 mb-3 fw-normal">Faça seu login</h1>
    <label for="inputEmail" class="visually-hidden">Email address</label>
    <input name="campoEmail" type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
    <label for="inputPassword" class="visually-hidden">Password</label>
    <input name="campoSenha" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
    <div class="checkbox mb-3">
    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
    <br>

    <?php
    if(isset($_POST['campoEmail'])){
      $email = $_POST['campoEmail'];
      $senha = $_POST['campoSenha'];
     

      $resul = consultaLogin($email, $senha);
      print_r($resul);
      
        if($resul['email'] == $email && $resul['senha'] == $senha ){
          $_SESSION['usuario'] =$resul['nome'] ;
          header("location: tela_Principal.php");
         } else {
           echo "<h2>Usuario ou senha Invalidos</h2>";
         }
      
    }
  ?> 
  </form>
</main>
  </body>
</html>

