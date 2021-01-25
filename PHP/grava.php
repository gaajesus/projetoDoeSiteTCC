<?php 
   include "conecta.php";
   $nome = $_POST['nomeInstituicao'];
   $cidade = $_POST['cidadeInstituicao'];
   $email = $_POST['emailInstituicao'];
   $endereco = $_POST['enderecoInstituicao'];
   $cnpj = $_POST['cnpjInstituicao'];
   $celular = $_POST['celularInstituicao'];
   $senha = $_POST['senhaInstituicao'];
   $confirmaSenha = $_POST['senhaConfInstituicao'];
   $cep = $_POST['cepInstituicao'];
   $responsavel = $_POST['responsavelInstituicao'];

   if($senha != $confirmaSenha){
      echo "<script type='text/javascript'>alert('As senhas são diferentes!')</script>";
      echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../cadastrar.php'>";
      exit;
    }
   
    function validaSenha($pass){
        return preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z$*&@#]{8,}$/', $pass);
    }

    $senhaCrip = password_hash ($senha , PASSWORD_BCRYPT);

    function soNumero($str) {
        return preg_replace("/[^0-9]/", "", $str); // retira a mascara ao salvar
    }

    $cnpjFiltrado = soNumero($cnpj);
    $celularFiltrado = soNumero($celular);
    $cepFiltrado = soNumero($cep);
    $sql = "SELECT * FROM public.ongs WHERE email_ong = '$email' and excluido_ong = FALSE";
    $resultado=pg_query($conecta,$sql);
    $linhas=pg_affected_rows($resultado);
    $validaSenha = validaSenha($senha);

    if($validaSenha == 0){
        echo "<script type='text/javascript'>alert('A senha precisa de pelo menos 8 digitos, com uma letra maiúscula, uma minúscula e um número!')</script>";
        echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../cadastrar.php'>";
        exit;
    }

    if($linhas > 0){
        echo "<script type='text/javascript'>alert('Email já existe !!!')</script>";
        echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../cadastrar.php'>";
    }
    else{   
        $sql="INSERT INTO ongs values(DEFAULT, '$nome', '$responsavel',
        $cnpjFiltrado, '$endereco', $cepFiltrado,
        '$cidade', $celularFiltrado, '$email',
        '$senhaCrip', DEFAULT, DEFAULT, DEFAULT,
        DEFAULT, DEFAULT, DEFAULT, DEFAULT);";  

        $resultado=pg_query($conecta,$sql);
        $linhas=pg_affected_rows($resultado);

        if($linhas < 0){
            echo "Falha ao cadastrar!";
        }
        else{
            include_once "email.php";
            include_once "recebe-dados.php";
        }	
    }                               
?>