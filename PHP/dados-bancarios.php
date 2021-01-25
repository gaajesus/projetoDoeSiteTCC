<?php 
    include "conecta.php";

    if(session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }

    $id = $_SESSION['id'];
    $nome_banco = $_POST['nome_banco'];
    $num_conta = $_POST['num_conta'];
    $num_agencia = $_POST['num_agencia'];
    $tipo_deconta = $_POST['tipo_conta'];

    $sql = "SELECT * FROM ongs WHERE id_ong = $id and excluido_ong = FALSE";
    $resultado=pg_query($conecta,$sql);
    $linhas=pg_affected_rows($resultado);

    if($linhas == 0)
    {
    echo "<script type='text/javascript'>alert('Falha ao cadastrar dados!')</script>";
    echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../inserir_dados_bancarios.php'>";
    }
    else
    {   
        $sql="UPDATE public.ongs SET banco_ong='$nome_banco', num_conta_ong=$num_conta, agencia_ong=$num_agencia, tipo_conta_ong='$tipo_deconta' WHERE id_ong = $id;"; 
        $resultado=pg_query($conecta,$sql);
        $linhas=pg_affected_rows($resultado);
        if($linhas < 0)
        {
            echo "Falha ao cadastrar!";
        }
        else{
            echo "<script type='text/javascript'>alert('Dados bancarios cadastrados com sucesso!')</script>";
            echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../inserir_dados_bancarios.php'>";
        }	
    }                                      
?>

