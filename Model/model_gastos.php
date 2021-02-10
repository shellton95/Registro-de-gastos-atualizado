<?php
require_once 'banco_de_dados.php';
    
    


     function cadastraGasto($nome_usuario, $nome_categoria, $data_gasto, $valor){
        $conexao = novaConexao();
        //--------------------------pega datas categoria--------------------
        
        $sql1 = "SELECT data_inicial, data_final, valor_maximo from categoria where nome = '$nome_categoria'";
        $res1 = $conexao->query($sql1);
        $resultado1 = $res1->fetch(PDO::FETCH_ASSOC);
        $data_inicial = $resultado1['data_inicial'];
        $data_final = $resultado1['data_final'];
        $valor_maximo = $resultado1['valor_maximo'];
       
       
        //----------Pegando soma de todos os valores da tabela + o atual a ser inserido-------------------------------------
    
       $sql2 = "SELECT  sum(valor_gasto) as valor from gastos a
       inner join categoria b on a.nome_categoria=b.nome
       where a.data_gasto between '$data_inicial' and '$data_final'
       and a.nome_categoria = '$nome_categoria'";
        $res2 = $conexao->query($sql2);
        $resultado2 = $res2->fetch(PDO::FETCH_ASSOC);
        $valor_soma = $resultado2['valor'];
        $valor_soma += $valor;
        echo $valor_soma, "<br>", $valor_maximo;
       

       //--------------------------------CADASTRO------------------------------------------------------

        if($data_gasto < $data_inicial || $data_gasto > $data_final){
            
            echo "<div class='alert alert-danger' role='alert'>
                    data diferente do configurado</div>";
        } else if($valor_soma > $valor_maximo){
            echo "<div class='alert alert-danger' role='alert'>
            Valor Maximo da Categoria Atingido</div>";

        } else if($nome_categoria != '' && $data_gasto != '' && $valor != ''){
            $sql = "INSERT INTO gastos (nome_usuario, nome_categoria, data_gasto, valor_gasto)
            VALUES('$nome_usuario', '$nome_categoria', '$data_gasto', '$valor')";
    
             $res = $conexao->prepare($sql);        
             $res->execute();
           
             echo "<div class='alert alert-success' role='alert'>cadastro realizado com Sucesso</div>";
        } else {
            echo "insira valores validos";
        }
      
   }

    function consultaGastos(){
        $conexao = novaConexao();
        $sql = "SELECT nome_usuario, nome_categoria, data_gasto, valor_gasto FROM gastos";
        $res = $conexao->query($sql);
        $resultado = $res->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }


    

