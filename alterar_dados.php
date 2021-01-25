<?php 
    
error_reporting(0);
    include_once "PHP/conecta.php";
    if(session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }
    if($_SESSION["logou"]==false){
        echo '<script>alert("faça login ou cadastre-se para continuar!");
              window.location.href="login.php";
              </script>';
    }

?>
<?php 
    include_once "PHP/conecta.php";
    if(session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }
    if($_SESSION["logou"]=="s")
     { 
      $id =  $_SESSION["id"];
      $sql = "select * from public.ongs where id_ong = $id;";
      echo '<script>alert('.$sql.') </script>';
      $res = pg_query($conecta, $sql);
      if (pg_num_rows($res) > 0)
      {
        $linha = pg_fetch_array($res);
        $nome = $linha['nome_ong'];
        $endereco = $linha['endereco_ong'];
        $cep = $linha['cep_ong'];
        $cidade = $linha['cidade_ong'];
        $celular = $linha['numero_ong'];
        $email = $linha['email_ong'];
        $senha = $linha['senha_ong'];
        $responsavel = $linha['responsavel_ong'];
        $_SESSION["validaCelular"] = $celular;
        $_SESSION["validaEmail"] = $email;
      }
    }
    else
    {
      echo '<script>
      alert("Erro ao realizar login. Tente novamente"); 
      window.location.href="login.php";
      </script>';
    }    
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Alterar dados - <?php echo $nome;?></title>
    <link rel="icon" href="img/icon.png"> 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="keywords" content="">
    <meta name="author" content="Phoenixcoded" />
    <!-- Favicon icon -->
    <link rel="icon" href="assets/images/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"/>

    <!-- vendor css -->
    <link rel="stylesheet" href="assets/css/style3.css">   

</head>
<body class="">
	<!-- [ Pre-loader ] start -->
	<div class="loader-bg">
		<div class="loader-track">
			<div class="loader-fill"></div>
		</div>
	</div>
	<!-- [ Pre-loader ] End -->
	<!-- [ navigation menu ] start -->
	<nav class="pcoded-navbar menu-light ">
		<div class="navbar-wrapper  ">
			<div class="navbar-content scroll-div " >
				<div class="">
					<div class="main-menu-header">
                    <?php 
                            $sql = "SELECT imagem_ong from public.ongs WHERE id_ong = $id";
                            $resultado = pg_query($conecta, $sql);
                            $row = pg_fetch_array($resultado);
                            if($row['imagem_ong'] != null){
                                echo '<img src="'; echo $row['imagem_ong']; echo '" alt="user image" class="img-radius wid-100 align-top m-r-15">';
                            } 
                        ?>
						<div class="user-details">
							<div id="more-details">
                                <h5>
                                    <i class="fas fa-angle-down"></i>&nbsp;&nbsp;<?php echo $nome;?>
                                </h5>
                            </div>
						</div>
					</div>
					<div class="collapse" id="nav-user-link">
						<ul class="list-unstyled">
							<h5>
                                <li class="list-group-item"><a href="inserir_pedido.php"><i class="fas fa-hand-holding-heart"></i> Fazer pedido</a>
                            </h5>
                            <h5>
                                <li class="list-group-item"><a href="alterar_dados.php"><i class="fas fa-cog"></i> Alterar dados</a>
                            </h5>
                            <h5>
                                <li class="list-group-item"><a href="alterar_senha.php"><i class="fas fa-key"></i> Alterar senha</a>
                            </h5>
                            <h5>
                                <li class="list-group-item"><a href="inserir_dados_bancarios.php"><i class="fas fa-donate"></i> Dados Bancários</a></li>
                            </h5>
                            <h5>
                                <li class="list-group-item"><a href="inserir_imagem.php"><i class="far fa-image"></i></i> Adicionar foto</a>
                            </h5>
                            <h5>
                                <li class="list-group-item"><a href="PHP/logout.php"><i class="fas fa-sign-out-alt"></i> Sair</a></li>
                            </h5>
						</ul>
					</div>
				</div>
				<ul class="nav pcoded-inner-navbar ">
					<li class="nav-item">
					    <a href="pag_instituicao.php" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext"><?php echo $nome;?> - DOE</span></a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<!-- [ navigation menu ] end -->
	<!-- [ Header ] start -->
	<header class="navbar pcoded-header navbar-expand-lg navbar-light header-blue">
        <div class="m-header">
            <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
            <a href="#!" class="b-brand">
                <!-- ========   change your logo hear   ============ -->
                <img src="assets/images/logo.png" alt="" class="logo">
                <img src="assets/images/logo-icon.png" alt="" class="logo-thumb">
            </a>
            <a href="#!" class="mob-toggler">
                <i class="feather icon-more-vertical"></i>
            </a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                   
                </li>
            </ul>  
        </div>
        <li>
            <div class="dropdown drp-user">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="feather icon-user"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-notification">
                    <div class="pro-head">
                        <img src="assets/images/icon.png" class="img-radius" alt="User-Profile-Image">
                        <span>f</span>
                        <a href="index.html" class="dud-logout" title="Sair">
                            <i class="feather icon-log-out"></i>
                        </a>
                    </div>
                    
                </div>
            </div>
        </li>
	</header>
	<!-- [ Header ] end -->
    <!-- [ Main Content ] start -->
    <div class="pcoded-main-container">
        <div class="pcoded-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10">Página Adminstrativa</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="pag_instituicao.php"><?php echo $nome;?> - DOE</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
            <div class="row">
       <div class="formzera">
      <form name="formulario" class="cadastro" action="PHP/alterar-dados.php" method="POST">
        <div class="textoCad">
          <h2 class="a">
          Alterar Dados
          </h2>
        </div>
        <div class="texto"> <div class="oie">Alterar somente o que desejar.</div></div>
          <div class="bloco">
            <div class="cad-step-one">
              <input class="input-one anime-left-to-center" type="text" value="<?php echo $nome;?>" name="nomeInstituicao" id="nomeInstituicao" placeholder="Novo nome da instituição:*" required><br><br>       
              <input class="input-one anime-left-to-center" type="email" value="<?php echo $email;?>" name="emailInstituicao" id="emailInstituicao" placeholder="Novo e-mail da instituição:*" required><br><br>
                 <input class="input-one anime-left-to-center" type="text" value="<?php echo $responsavel;?>" name="responsavelInstituicao" id="respInstituicao" placeholder="Novo Responsável:*" required>
            </div>
            <div class="cad-step-two">
              <input class="input-one anime-right-to-center" type="text" value="<?php echo $endereco;?>" name="enderecoInstituicao" id="emailInstituicao" placeholder="Novo endereço da instituição:*" required><br><br>
              <input class="input-one anime-right-to-center" type="text" value="<?php echo $cidade;?>" name="cidadeInstituicao" id="cidadeInstituicao" placeholder="Nova cidade da instituição:*" required><br><br>   
              <input class="input-one anime-right-to-center"type="text" value="<?php echo $celular;?>" name="celularInstituicao" id="celularInstituicao" placeholder="Novo celular da instituição:*" required><br><br>         
              <input class="input-one anime-right-to-center" type="text" value="<?php echo $cep;?>" name="cepInstituicao" id="cepInstituicao" placeholder="Novo CEP:*" required><br><br>
                
            </div>
            <div class="cad-step-three">
                 <button class="button3" type="button" onclick="ConfirmarExclusao();"><div class="estiliza">Excluir Conta</div></button>
              <input class="button3" type="submit" value="Enviar" id="enviar">
             
            </div>
            <div id="imagem">
              <img src="img/logo_doe.png" width="45px" height="45px" style="margin-top:-2%;margin-left: 93%;">
            </div>
              </div>
      </form>
    </div>
    <script>
     function ConfirmarExclusao() 
      {  
        var r = confirm("Deseja excluir sua conta?");
        if (r == true) {
          window.location.href = "/PHP/alterar-dados.php?&faz=ex";
        }
      }
    </script>
          
    <!-- Required Js -->
    <script src="assets/js/vendor-all.min.js"></script>
    <script src="assets/js/plugins/bootstrap.min.js"></script>
    <script src="assets/js/ripple.js"></script>
    <script src="assets/js/pcoded.min.js"></script>

    <!-- Apex Chart -->
    <script src="assets/js/plugins/apexcharts.min.js"></script>

    <!-- custom-chart js -->
    <script src="assets/js/pages/dashboard-main.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/js/all.min.js"></script>
</body>
<?php

include_once "PHP/conecta.php";
$msg = false;
if(isset($_FILES['arquivo'])){

    $extensao = strtolower(substr($_FILES['arquivo']['name'], -4));
    $novo_nome = md5(time()).$extensao;
    $diretorio = "uploads/";

    move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio.$novo_nome);
    $sql = "UPDATE public.ongs SET imagem_ong = '$novo_nome' WHERE id_ong= $id;";
          
   $resultado=pg_query($conecta,$sql);
   $linhas=pg_affected_rows($resultado);
   if($linhas > 0)
   {
      echo "DEU";
   }
   else
   {
       echo "NUM DEU";
   }
}
?>
<?php if($msg != false) echo "<p> $msg </p>"; ?>

    
</html>
