<?php
    session_start();
    if(!$_SESSION['usuario']){
      header("location: login.php");
    }
    require_once '../Model/model_gastos.php';
    if(count($_POST) > 0){
        if(!filter_input(INPUT_POST,'nomeCategoria')){
            $erros['nomeCategoria'] = "categoria Obrigatorio";
        } 

        if(!filter_input(INPUT_POST, 'campoData')){
            $erros['campoData'] = "Data Obrigatorio";
        }

        if(!filter_input(INPUT_POST, 'campoValor')){
            $erros['campoValor'] = "Valor Obrigatorio";
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

    
    <link rel="stylesheet" type="text/css" href="../cadastro_gastos.css">
    <link rel="stylesheet" type="text/css" href="../tela_principal.css">

  </head>
  <body>
    
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="tela_Principal.php"><u>Tela Principal</u></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav me-auto mb-2 mb-md-0">
        <li class="nav-item active">
          <a class="nav-link" aria-current="page" href="usuario.php">Usuarios</a>
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

<main class="container p-5">
    
    <form action="" method="POST" class="cad-gastos">
    <?php
            if(isset($_POST['nomeCategoria']) && isset($_POST['campoValor'])) {
                $categoria = $_POST['nomeCategoria'];
                $data = $_POST['campoData'];
                $valor =(float) $_POST['campoValor'];
                cadastraGasto($_SESSION['usuario'], $categoria, $data, $valor);
            }
        ?>
        <label for="validationServer01" class="form-label">Categoria</label>
        <input name="nomeCategoria" type="text" class="form-control <?= $erros['nomeCategoria'] ? 'is-invalid' : ''; ?>">
            <div class="invalid-feedback">
                <?php echo $erros['nomeCategoria'] ?>
            </div>
        <label for="validationServer01" class="form-label">Data</label>
        <input name="campoData" type="date" class="form-control <?php $erros['campoData'] ? 'is-invalid' : ''; ?>">
            <div class="invalid-feedback">
                <?php echo $erros['campoData']  ?>
            </div>
        <label for="validationServer01" class="form-label">Valor</label>
        <input name="campoValor" type="text" class="form-control <?php $erros['campoValor'] ? 'is-invalid' : ''; ?>">
            <div class="invalid-feedback">
                <?php echo $erros['campoValor'] ?>
            </div>
        <br>
        <button class="btn btn-primary">Cadastrar</button>
        <a class="btn btn-secondary" href="tela_Principal.php">Voltar</a>
      
        
    </form>
</main> 
  </body>
</html>