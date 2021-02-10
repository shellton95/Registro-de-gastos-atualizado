<?php



    function novaConexao($banco = 'cdg'){
        $servidor = '127.0.0.1:3306';
        $usuario = 'root';
        $senha = '12345678';
    
        try {
            $conexao = new PDO("mysql:host=$servidor;dbname=$banco",$usuario,$senha);
            return $conexao;
        }catch(PDOException $e){
            die('erro: '. $e->getMessage());
        }
    }
       
        
   
        


