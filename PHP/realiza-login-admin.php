<?php

error_reporting(0);
    include "conecta.php";
    if(session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }
    $senha = $_POST['senhaInstituicao'];
    $email = $_POST['emailInstituicao'];
    $sql = "select senha_admin from public.admins where email_admin = '$email'";
    
    $res = pg_query($conecta, $sql);
    $linhaa = pg_fetch_array($res);
    $hash = $linhaa['senha_admin'];
    
    $res = pg_query($conecta, $sql);
    if(password_verify($senha, $hash)){
        $sql = "select * from public.admins where email_admin = '$email'";
    
        $res = pg_query($conecta, $sql);
        if (pg_num_rows($res) > 0)
        {
            session_start();
            date_default_timezone_set("Brazil/East");
            $tempolimite = 1200;
            $_SESSION['registro'] = time(); // armazena o momento em que autenticado //
            $_SESSION['limite'] = $tempolimite; // armazena o tempo limite sem atividade //
            echo "<script type='text/javascript'>alert('Login realizado.')</script>";
            $linha = pg_fetch_array($res);
            $_SESSION["admin-on"] = "s";
            $_SESSION["admin_nome"] = $linha['nome'];
            $_SESSION["id_admin"] = $linha['id_admin'];
            echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../pag_admin.php'>";
        }
        else
        {
            echo "<script type='text/javascript'>alert('Há algo de errado! Verifique os campos')</script>";
            echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../login-admin.php'>";
        }
    }
    else{
        echo "<script type='text/javascript'>alert('Há algo de errado! Verifique os campos')</script>";
            echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../login-admin.php'>";
    }
    
?>