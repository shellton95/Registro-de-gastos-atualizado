<?php
    session_start();
    ob_start(); // solução do erro "Cannot modify header information - headers already sent by "
    if(!$_SESSION['usuario']){
      header("location: login.php");
    }
    require_once '../Model/modelo_categoria.php';
    if(count($_POST) > 0){
        if(!filter_input(INPUT_POST,'nomeCategoria')){
            $erros['nomeCategoria'] =  "nome invalido";
        }
        if(!filter_input(INPUT_POST,'validadeinicial')){
            $erros['validadeinicial'] = "Validade Obrigatoria";
        }
        if(!filter_input(INPUT_POST, 'validadefinal')){
          $erros['validadefinal'] = "Validade Final obrigatorio";
        }
        if(!filter_input(INPUT_POST,'valorcategoria')){
          $erros['valorcategoria'] = "Valor Obrigatorio";
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
          <a class="nav-link" aria-current="page" href="usuario.php">Usuarios</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"><u>Categorias</u></a>
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
        <label for="validationServer01" class="form-label">Nome categoria</label>
        <input name="nomeCategoria" type="text" class="form-control <?=$erros['nomeCategoria'] ? 'is-invalid' : ''?>"
        value="<?php
            if(isset($_GET['nome'])){
              $nome = $_GET['nome'];
              $res = consultaID($nome);
              echo $res['nome'];
            }
              ?>">
        <div class="invalid-feedback"> <!--A div e essa-->
                     <?=$erros['nomeCategoria']?>
        </div>
    </div>

    <div class="col-md-5">
        <label for="validationServer01" class="form-label">Validade Inicial</label>
        <input name="validadeinicial" type="date" class="form-control <?=$erros['validadeinicial'] ? 'is-invalid' : ''?>"
        value="<?php
          if(isset($_GET['nome'])){
              $nome = $_GET['nome'];
              $res = consultaID($nome);
              echo $res['data_inicial'];
          }
        ?>">
        <div class="invalid-feedback"> <!--A div e essa-->
                     <?=$erros['validadeinicial']?>
        </div>
    </div>

    <div class="col-md-5">
        <label for="validationServer01" class="form-label">Validade Final</label>
        <input name="validadefinal" type="date" class="form-control <?=$erros['validadefinal'] ? 'is-invalid' : ''?>" 
        value="<?php 
        if(isset($_GET['nome'])){
            $nome = $_GET['nome'];
            $res = consultaID($nome);
            echo $res['data_final'];
        }
        ?>">
        <div class="invalid-feedback"> <!--A div e essa-->
                     <?=$erros['validadefinal']?>
        </div>
    </div>

    <div class="col-md-5">
        <label for="validationServer01" class="form-label">Validade Final</label>
        <input name="valorcategoria" type="text" class="form-control <?=$erros['valorcategoria'] ? 'is-invalid' : ''?>"
        value="<?php
          if(isset($_GET['nome'])){
            $nome = $_GET['nome'];
            $res = consultaID($nome);
            echo $res['valor_maximo'];
        }
        ?>">
        <div class="invalid-feedback"> <!--A div e essa-->
                     <?=$erros['valorcategoria']?>
        </div>
    </div>
    <br>

     <button class="btn btn-primary"><?php if(isset($_GET['nome'])) {echo "Atualizar";}else{echo"Cadastrar"; }   ?></button>
     <a class="btn btn-secondary" href="categoria.php" >Voltar</a>

     <?php
if(isset($_POST['nomeCategoria']) && isset($_POST['validadeinicial']) && isset($_POST['validadefinal']) && isset($_POST['valorcategoria']) ){
    if(isset($_GET['nome'])){
      $nome = $_GET['nome'];
      $di = $_POST['validadeinicial'];
      $df = $_POST['validadefinal'];
      $valor = (float) $_POST['valorcategoria'];
      updateCategoria($nome,$di, $df,$valor);
      header('location: categoria.php');
    }else {
        $nome = $_POST['nomeCategoria'];
        $di = $_POST['validadeinicial'];
        $df = $_POST['validadefinal'];
        $valor = (float) $_POST['valorcategoria'];
        cadastraCategoria($nome, $di, $df,$valor);
      }
    }
?>
</form>
</main> 
  </body>
</html>
