<?php
    session_start();
    if(!$_SESSION['usuario']){
      header("location: login.php");
    }
    require_once '../Model/modelo_usuario.php';
    if(count($_POST) > 0){
        if(!filter_input(INPUT_POST,'nomeusuario')){
            $erros['nomeusuario'] =  "nome invalido";
        }
        if(!filter_var(INPUT_POST['email'], FILTER_VALIDATE_EMAIL)){
            $erros['email'] = "email obrigatorio";
        }
        if(!filter_input(INPUT_POST, 'senha')){
          $erros['senha'] = "Senha obrigatorio";
        }

        
    }
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<!doctype html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.79.0">
    <title>Fixed top navbar example · Bootstrap v5.0</title>

    <link rel="stylesheet" type="text/css" href="../cadastro_categoria.css">

  </head>
  <body>
    
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="tela_Principal.php">Tela Principal</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav me-auto mb-2 mb-md-0">
        <li class="nav-item active">
          <a class="nav-link" aria-current="page" href="usuario.php"><u>Usuarios</u></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Categorias</a>
        </li>
      </ul>
      <form class="d-flex">
        <span class="usuario"> Usuario: <?php echo $_SESSION['usuario'];?> </span><br>
         <!--<a  class="btn btn-outline-danger" href="login.php">Sair</a>-->
         <button name="sair"  class="btn btn-outline-danger">Sair</button>
        <?php
            if(isset($_GET['sair'])){
              header('location: login.php');
              session_destroy();
            }
        ?>
      </form>
    </div>
  </div>
</nav>
<br>
<br>
<br>
<main class="container p-5">

<form method="POST" class="form-cadas-cat">
    <div class="col-md-5">
        <label for="validationServer01" class="form-label">Nome</label>
        <input name="nomeusuario" type="text" class="form-control <?=$erros['nomeusuario'] ? 'is-invalid' : ''?>">
        <div class="invalid-feedback"> <!--A div e essa-->
                     <?=$erros['nomeusuario']?>
        </div>
    </div>

    <div class="col-md-5">
        <label for="validationServer01" class="form-label">email</label>
        <input name="email" type="text" class="form-control <?=$erros['email'] ? 'is-invalid' : ''?>">
        <div class="invalid-feedback"> <!--A div e essa-->
                     <?=$erros['email']?>
        </div>
    </div>

    <div class="col-md-5">
        <label for="validationServer01" class="form-label">Senha</label>
        <input name="senha" type="password" class="form-control <?=$erros['senha'] ? 'is-invalid' : ''?>">
        <div class="invalid-feedback"> <!--A div e essa-->
                     <?=$erros['senha']?>
        </div>
    </div>
    <br>


     <button class="btn btn-primary">Cadastrar</button>
 
     <a class="btn btn-secondary" href="usuario.php" >Voltar</a>
     
</form>
<?php
  if(isset($_POST['nomeusuario']) && isset($_POST['email']) &&  isset($_POST['senha'])){
    $nome = $_POST['nomeusuario'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    cadastraUsuario($nome, $email, $senha);
    header('location: usuario.php');
  }
  
?>


</main> 
  </body>
</html>
