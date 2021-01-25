<?php
error_reporting(0);
    function soNumero($str) {
        return preg_replace("/[^0-9]/", "", $str); // retira a mascara ao salvar
    }   
    if(session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }
    include_once "conecta.php";
    $nomeNovo = $_POST['nomeInstituicao'];
    $enderecoNovo = $_POST['enderecoInstituicao'];
    $cepNovo = $_POST['cepInstituicao'];
    $cidadeNovo = $_POST['cidadeInstituicao'];
    $celularNovo =$_POST['celularInstituicao'];
    $emailNovo = $_POST['emailInstituicao'];
    $responsavelNovo = $_POST['responsavelInstituicao'];
    $cepNovoFiltrado = soNumero($cepNovo);
    $celularNovoFiltrado = soNumero($celularNovo);
    $id = $_SESSION["id"];
    $exc = $_GET['faz'];
    $validaCelular = $_SESSION["validaCelular"];
    $validaEmail = $_SESSION["validaEmail"];
    $comparaEmail = strcmp($emailNovo, $validaEmail);
    $comparaCelular = strcmp($celularNovoFiltrado, $validaCelular);

    if($exc == 'ex'){
        $sql = "UPDATE public.ongs set excluido_ong = false where id_ong = $id;";
        $resultado=pg_query($conecta,$sql);
        $linhas=pg_affected_rows($resultado);
        if ($linhas > 0){ 
         
            echo "<script type='text/javascript'>alert('Conta excluída com sucesso')</script>";
            echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../index.html'>";
            pg_close($conecta);
        }
        else
        {
            echo "<script type='text/javascript'>alert('Falha ao excluir sua conta!')</script>";
            echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../alterar_dados.php'>";
            pg_close($conecta);
        }
    }
    else{
        if($comparaCelular==0 && $comparaEmail == 0){
            $sqlAux = "UPDATE public.ongs SET nome_ong='$nomeNovo',  responsavel_ong='$responsavelNovo', endereco_ong='$enderecoNovo', cep_ong=$cepNovoFiltrado, cidade_ong='$cidadeNovo'
            WHERE id_ong = $id;";
        }
        else if($comparaCelular == 0){
            $sqlAux = "UPDATE public.ongs SET nome_ong='$nomeNovo',  responsavel_ong='$responsavelNovo', endereco_ong='$enderecoNovo', cep_ong=$cepNovoFiltrado, cidade_ong='$cidadeNovo', email_ong='$emailNovo'
            WHERE id_ong = $id;";
        }
        else if($comparaEmail == 0){
            $sqlAux = "UPDATE public.ongs SET nome_ong='$nomeNovo',  responsavel_ong='$responsavelNovo', endereco_ong='$enderecoNovo', cep_ong=$cepNovoFiltrado, cidade_ong='$cidadeNovo', numero_ong=$celularNovoFiltrado
            WHERE id_ong = $id;";
        }
        else if($comparaCelular !=0 && $comparaEmail != 0){
            $sqlAux = "UPDATE public.ongs SET nome_ong='$nomeNovo', responsavel_ong='$responsavelNovo', endereco_ong='$enderecoNovo', cep_ong=$cepNovoFiltrado, cidade_ong='$cidadeNovo',  numero_ong=$celularNovoFiltrado, email_ong='$emailNovo'
            WHERE id_ong = $id;";
        }
    }
    $sql = "SELECT * FROM public.ongs WHERE email_ong = '$emailNovo' and id_ong <> $id and excluido_ong = FALSE";
    $resultado=pg_query($conecta,$sql);
    $linhas=pg_affected_rows($resultado);
    if($linhas > 0)
    {
        echo "<script type='text/javascript'>alert('Email já existe !!!')</script>";
        echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../alterar_dados.php'>";
        exit;
    }

    $sql = "SELECT * FROM public.ongs WHERE numero_ong = $celularNovoFiltrado and id_ong <> $id and excluido_ong = FALSE";
    $resultado=pg_query($conecta,$sql);
    $linhas=pg_affected_rows($resultado);
    if($linhas > 0)
    {
        echo "<script type='text/javascript'>alert('Celular já existe !!!')</script>";
        echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../alterar_dados.php'>";
        exit;
    }
    //UPDATE COM OS NOVOS DADOS
    $resultado=pg_query($conecta,$sqlAux);
    $linhas=pg_affected_rows($resultado);
    if ($linhas > 0){ 
        echo "<script type='text/javascript'>alert('Alteração feita com sucesso! Suas mudanças entrarão em vigor no próximo login!')</script>";
        echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../pag_instituicao.php'>";
        exit;
    }   
?>