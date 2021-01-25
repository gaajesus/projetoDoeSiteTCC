<?php
    if(session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }
    include "conecta.php";

    $id = $_SESSION["id"];

    $senhaAntiga = $_POST['senhaInstituicao'];
    $senhaNova = $_POST['senhaConfInstituicao'];

    $sql = "SELECT senha_ong FROM public.ongs WHERE id_ong=$id";
    
    $res = pg_query($conecta, $sql);
    $linhaa = pg_fetch_array($res);
    $hash = $linhaa['senha_ong'];

    $senhaCript = password_hash ($senhaNova , PASSWORD_BCRYPT);
    
    $res = pg_query($conecta, $sql);
    if(password_verify($senhaAntiga, $hash)){
        $sql = "UPDATE public.ongs SET senha_ong='$senhaCript' WHERE id_ong = $id;";
        $res = pg_query($conecta, $sql);
        if (pg_num_rows($res) < 0){
            echo "<script type='text/javascript'>alert('Falha ao alterar a senha!')</script>";
            echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../alterar_senha.php'>";
        }
        else{
            echo "<script type='text/javascript'>alert('Sua senha foi alterada com sucesso!')</script>";
            echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../pag_instituicao.php'>";
        }
    }
    else{
        echo "<script type='text/javascript'>alert('Sua senha antiga está errada!')</script>";
        echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../alterar_senha.php'>";


    }