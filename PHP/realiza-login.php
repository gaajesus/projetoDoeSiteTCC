<?php

error_reporting(0);
    include "conecta.php";
    if(session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }
    $senha = $_POST['senhaInstituicao'];
    $email = $_POST['emailInstituicao'];
    $sql = "select senha_ong from public.ongs where email_ong = '$email'";
    
    $res = pg_query($conecta, $sql);
    $linhaa = pg_fetch_array($res);
    $hash = $linhaa['senha_ong'];
    
    $res = pg_query($conecta, $sql);
    if(password_verify($senha, $hash)){
        $sql = "select * from public.ongs where email_ong = '$email' and ativo_ong = TRUE and excluido_ong = FALSE";
    
        $res = pg_query($conecta, $sql);
        if (pg_num_rows($res) > 0)
        {
            echo "<script type='text/javascript'>alert('Login realizado.')</script>";
            $linha = pg_fetch_array($res);
            $tempolimite = 1200;
            $_SESSION['registro'] = time();
            $_SESSION['limite'] = $tempolimite; 
            $_SESSION["logou"] = "s";
            $_SESSION["nome"] = $linha['nome_ong'];
            $_SESSION["imagem"] = $linha['imagem_ong'];
            $_SESSION["id"] = $linha['id_ong'];
            $_SESSION['senha'] = $linha['senha_ong'];
            echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../pag_instituicao.php'>";
        }
        else
        {
            echo "<script type='text/javascript'>alert('Há algo de errado! Verifique os campos')</script>";
            echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../login.php'>";
        }
    }
    else{
        echo "<script type='text/javascript'>alert('Há algo de errado! Verifique os campos')</script>";
        echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../login.php'>";
    }
    
?>