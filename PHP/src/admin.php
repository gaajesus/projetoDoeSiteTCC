<?php 
   include "conecta.php";
   $nome = 'SmartDev';
   $email = 'smartdevcti@gmail.com';
   $senha = 'smartdev321';
   $senhaCrip = password_hash ($senha , PASSWORD_BCRYPT);

    $sql = "SELECT * FROM instituicao.adm WHERE email = '$email' and excluido = FALSE";
    $resultado=pg_query($conecta,$sql);
    $linhas=pg_affected_rows($resultado);
    if($linhas > 0)
    {
        echo "<script type='text/javascript'>alert('Email já existe !!!')</script>";
        echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../cadastrar.php'>";
        }
        else
        {   
        $sql="INSERT INTO instituicao.adm
                values(DEFAULT,
                '$nome', 
                '$email',
                '$senhaCrip');";  
                
        $resultado=pg_query($conecta,$sql);
        $linhas=pg_affected_rows($resultado);
        if($linhas < 0)
        {
            echo "Falha ao cadastrar!";
        }
        else{
            echo "foooi!";
        }	
    }                                      
?>
