<?php
require_once 'banco_de_dados.php';
    
  

   function cadastraCategoria($nome, $di, $df, $vm){
        $conexao = novaConexao();
        $sql = "INSERT INTO categoria (nome, data_inicial, data_final, valor_maximo)
                VALUES('$nome', '$di', '$df', '$vm')";
        $res = $conexao->prepare($sql);        
        $res->execute();
        
   }

   function consultaCategoria(){
           $conexao = novaConexao();
           $sql = "SELECT * FROM categoria";
           $res = $conexao->query($sql);
           $resultado = $res->fetchAll(PDO::FETCH_ASSOC);
           return $resultado;
   }

   function consultaID($id){
        $conexao = novaConexao();
        $sql = "SELECT * FROM categoria WHERE nome = '$id'";
        $res = $conexao->query($sql);
        $resultado = $res->fetch(PDO::FETCH_ASSOC);
        return $resultado;
   }

   function updateCategoria($nome, $di, $df, $vm ){
        $conexao = novaConexao();
        $sql = "UPDATE categoria SET  data_inicial = '$di', data_final = '$df', valor_maximo = $vm
                WHERE nome = '$nome'";
        $res = $conexao->prepare($sql);
        $res->execute();
    
        
   }
   
