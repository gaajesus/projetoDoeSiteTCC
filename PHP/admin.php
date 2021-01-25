<?php 
   include "conecta.php";
   $nome = 'SmartDev';
   $email = 'smartdevcti@gmail.com';
   $senha = 'smartdev321';
   $senhaCrip = password_hash ($senha , PASSWORD_BCRYPT);

    $sql = "SELECT * FROM public.admins WHERE email_admin = '$email' and excluido_admin = FALSE";
    $resultado=pg_query($conecta,$sql);
    $linhas=pg_affected_rows($resultado);
    if($linhas > 0)
    {
        echo "<script type='text/javascript'>alert('Admin já existe!')</script>";
        }
        else
        {   
        $sql="INSERT INTO public.admins
                values(DEFAULT,
                '$nome', 
                '$email',
                '$senhaCrip');";  
                
        $resultado=pg_query($conecta,$sql);
        $linhas=pg_affected_rows($resultado);
        if($linhas > 0)
        {
            echo "Sucesso ao cadastrar admin!";
        }
        else{
            echo "Falha ao cadastrar admin!";
        }	
    }                                      
?>
