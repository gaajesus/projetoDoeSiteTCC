<?php
    if(session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }
    if($_SESSION['registro']){
        $segundos = time() - $_SESSION['registro'];
    }
    if($segundos > $_SESSION['limite']){
        unset($_SESSION['registro']);
            unset($_SESSION['limite']);
            unset($_SESSION['logou']);
            session_destroy();
            echo "<script type='text/javascript'>alert('Você foi desconectado por inatividade..')</script>";
            echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../login.php'>";
    }
    else{
        $_SESSION['registro']= time();
    }
?>