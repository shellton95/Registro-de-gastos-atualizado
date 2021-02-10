<?php
require_once 'banco_de_dados.php';
     $conexao = novaConexao();


     function cadastraUsuario($nome, $email, $senha){
        $conexao = novaConexao();
        $sql = "INSERT INTO usuario (nome, email, senha)
                VALUES('$nome', '$email', '$senha')";
        $res = $conexao->prepare($sql);        
        $res->execute();
   }

   function consultaLogin($email, $senha){
        $conexao = novaConexao();
        $sql = "SELECT nome ,email, senha FROM usuario WHERE email = '$email' and senha = '$senha'";
        $res = $conexao->query($sql);
        $resultado= $res->fetch(PDO::FETCH_ASSOC);
        return $resultado;
   }

   function consulaUsuario(){
     $conexao = novaConexao();
     $sql = "SELECT nome ,email FROM usuario";
     $res = $conexao->query($sql);
     $resultado= $res->fetchAll(PDO::FETCH_ASSOC);
     return $resultado;
   }
  

