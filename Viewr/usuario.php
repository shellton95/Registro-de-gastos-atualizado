<?php
    session_start();
    if(!$_SESSION['usuario']){
      header("location: login.php");
    }
    require_once '../Model/modelo_usuario.php';
     
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

    <link rel="stylesheet" type="text/css" href="../tela_principal.css">

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
          <a class="nav-link" aria-current="page" href="#"><u>Usuarios</u></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="categoria.php">Categorias</a>
        </li>
      </ul>
      <form class="d-flex">
        <span class="usuario"> Usuario: <?php echo $_SESSION['usuario'];?> </span><br>
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
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Nome</th>
      <th scope="col">Email</th>
    </tr>
  </thead>
  <tbody>
    <?php
        $consulta = consulaUsuario();
        for($i = 0;$i < count($consulta); $i++){
          echo "<tr>";
          foreach($consulta[$i] as $v){
              echo "<td>$v</td>";
          }
          echo "</tr>";
        }
    ?>
    
    
  </tbody>
</table>

 <a  class="btn btn-primary" href="cadastro_usuario.php">Cadastrar Novo Usuario</a>
</main> 
  </body>
</html>
