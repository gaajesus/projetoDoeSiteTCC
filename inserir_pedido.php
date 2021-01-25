<?php 
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
        $nome = $_SESSION["nome"];
        $id = $_SESSION["id"];
    }   

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Fazer pedido - <?php echo $nome;?></title>
   
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="keywords" content="">
    <meta name="author" content="Phoenixcoded" />
    <!-- Favicon icon -->
    <link rel="icon" href="img/icon.png"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"/>

    <!-- vendor css -->
    <link rel="stylesheet" href="assets/css/style2.css">   

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
                            echo '<img src="'; echo $row['imagem_ong']; echo '" alt="user image" class="img-radius wid-70 align-top m-r-15">';
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
                                <li class="list-group-item"><a href="PHP/logout.php"><i class="fas fa-donate"></i> Dados Bancários</a></li>
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
        
      <form class="cadastro" action="PHP/inserir_doacao.php" method="POST">
        <div class="textoCad">
          <h2 class="a">Fazer pedido</h2>
        </div>
          
        <br><br><br><br>
         
        <div class="cad-step-one">
        <select name="categoria" class="anime-left-to-center" style= "height: 38px; width: 219px; border-radius: 5px;">
        <?php 
          include_once "PHP/conecta.php";
          $sql = "SELECT id_categoria, nome_categoria FROM public.categorias;";
          $resultado = pg_query($conecta, $sql);
          while($row = pg_fetch_array($resultado)){
              //1 - nome | 3- cnpj | 4- endereço | 5- cep | 6- cidade | 7- celular | 9- senha | 10- ativcao          
              echo '<option value="'.$row['id_categoria'].'">'.$row['nome_categoria'].'</option>';
          }                             
        ?>                      
        </select><br><br>
          <input class="input-one anime-left-to-center" type="text" name="descricaoPedido" id="descricaoPedido" placeholder="Produto:*" required><br><br>           
          <input class="input-one anime-left-to-center" type="number" name="metaPedido" minlength="1" maxlength="3" id="metaPedido" placeholder="Meta de Arrecadação:*" required>
            <select name="unidadeMedida" class="anime-right-to-center" style="width: 100px; height: 30px; border-radius: 5px; margin-left: 3%;">
            <option value="KG">KG</option>
            <option value="litros">L</option>
            <option value="unidades">Unidades</option>
          </select>
            <input class="button3" type="submit" value="Enviar">
          
          </div>
          <div id="imagem" style="margin-left: 92%;margin-top:-15%;"><img src="img/logo_doe.png" width="45px" height="45px"></div>
      </form>
       
        </div>
          
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
</html>
