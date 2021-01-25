<?php
    include "PHP/conecta.php";
    if(session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }
    $filtro =3;
    if($_SESSION["admin-on"]==false){
        echo '<script>
                alert("Necessário login administrador!");
                window.location.href="login-admin.php";
              </script>';
    }
?>
<?php 
    $sql ="SELECT COUNT(*) FROM public.ongs;";
    $res = pg_query($conecta, $sql);
    if (pg_num_rows($res) > 0)
    {
        $linha = pg_fetch_array($res);
        $conta = $linha['count'];
    }
    $sql ="SELECT COUNT(*) FROM public.ongs WHERE ativo_ong= FALSE;";
    $res = pg_query($conecta, $sql);
    if (pg_num_rows($res) > 0)
    {
        $linha = pg_fetch_array($res);
        $contaAtv = $linha['count'];
    }
    $sql ="SELECT COUNT(*) FROM public.ongs WHERE ativo_ong = TRUE;";
    $res = pg_query($conecta, $sql);
    if (pg_num_rows($res) > 0)
    {  
        $linha = pg_fetch_array($res);
        $contaAtv1 = $linha['count'];
    }
    
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Adminstração - SmartDev</title>
   
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="keywords" content="">
    
    <!-- Favicon icon -->
    <link rel="icon" href="img/icon.png"> 
    <!-- vendor css -->
    <link rel="stylesheet" href="assets/css/style.css">   
    

</head>
<body class="">
    <?php
    if(isset($_GET['id']) && isset($_GET['ativado'])){
        $id = $_GET['id'];
        $ativado = $_GET['ativado'];
        $_SESSION['id_ativa'] = $id;
        if($ativado == "f"){
            $sql = 'UPDATE public.ongs SET ativo_ong = TRUE WHERE id_ong = ' . $id;
            $resultado=pg_query($conecta, $sql);
            $linhas=pg_affected_rows($resultado);
            if ($linhas > 0){ 
               
                echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../pag_admin.php'>";
                include_once("PHP/confirma-ativacao.php");
            }
            else{
                echo "<script type='text/javascript'>alert('Ocorreu um erro!')</script>";
                echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../pag_admin.php'>";
            }
        }
        else if($ativado == "t"){
            $sql = 'UPDATE public.ongs SET ativo_ong = FALSE WHERE id_ong= ' . $id;
            $resultado=pg_query($conecta, $sql);
            $linhas=pg_affected_rows($resultado);
            if ($linhas > 0){ 
                echo "<script type='text/javascript'>alert('Conta desativada desativada com sucesso!')</script>";
                echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../pag_admin.php'>";
            }
            else{
                echo "<script type='text/javascript'>alert('Ocorreu um erro!')</script>";
                echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../pag_admin.php'>";
            }
        }
    }
        
    ?>
    <script>
        var id;
        function pegaId(element) {
            id = element.id
        }
        
        function pegaAtivacao(valor, element){
            if(valor === "f"){
                var r = confirm("Deseja ativar a instituição?");
                if (r == true) {
                    window.location.href = window.location.pathname + "?id=" + element.id + "&ativado=" + valor;
                } else {
                    element.checked = false
                }
                
            }  else {
                var r = confirm("Deseja desativar a instituição?");
                if (r == true) {
                    window.location.href = window.location.pathname + "?id=" + element.id + "&ativado=" + valor;
                } else {
                    element.checked = true
                }
            }       
        }
    </script>
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
						<img class="img-radius" src="assets/images/icon.png" alt="User-Profile-Image">
						<div class="user-details">
							<div id="more-details">SMARTDEV <i class="fa fa-caret-down"></i></div>
						</div>
					</div>
					<div class="collapse" id="nav-user-link">
						<ul class="list-unstyled">
							<li class="list-group-item"><a href="index.html"><i class="feather icon-log-out m-r-5"></i>Sair</a></li>
						</ul>
					</div>
				</div>
				<ul class="nav pcoded-inner-navbar ">
					<li class="nav-item">
					    <a href="pag_admin.php" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">DOE</span></a>
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
                                <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="pag_admin.php">SmartDev - DOE</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="container">
                    <div class="col-lg-12 col-md-12">
                        <div class="row">
                            <div class="col-sm-4">
                                <form action="pag_admin.php" method="POST">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-8">
                                                    <h4 class="text-c-yellow">
                                                        <?php 
                                                            echo $contaAtv1;    
                                                        ?>
                                                        <input class="campo2" type="text" value='1' name="filtro1">
                                                        <button type="submit" class="btn btn-outline-dark">Filtrar</button>
                                                                                                               
                                                    </h4>
                                                    <h6 class="text-muted m-b-0">Instituições Verificadas</h6>
                                                </div>
                                                <div class="col-4 text-right">
                                                    <h1><i class="fas fa-user-check"></i></h1>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <?php 
                                 if(isset($_POST['filtro1'])) {
                                    $filtro = $_POST['filtro1'];
                                 }
                            ?>
                           
                            <div class="col-sm-4">
                                <form action="pag_admin.php" method="POST">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-8">
                                                    <h4 class="text-c-yellow">
                                                        <?php 
                                                            echo $contaAtv;    
                                                        ?>
                                                        <input class="campo2" type="text" value='2' name="filtro2">
                                                        <button type="submit" class="btn btn-outline-dark">Filtrar</button>
                                                    </h4>
                                                    <h6 class="text-muted m-b-0">Instituições em Análise</h6>
                                                </div>
                                                <div class="col-4 text-right">
                                                    <h1><i class="fas fa-user-times"></i></h1>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div> 
                            <?php 
                                 if(isset($_POST['filtro2'])) {
                                    $filtro = $_POST['filtro2'];
                                 }
                            ?>
                            <div class="col-sm-4">
                                <form action="pag_admin.php" method="POST">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-8">
                                                    <h4 class="text-c-yellow">
                                                        <?php 
                                                            echo $conta;    
                                                        ?>
                                                        <input class="campo2" type="text" value='3' name="filtro3">
                                                        <button type="submit" class="btn btn-outline-dark">Filtrar</button>
                                                    </h4>
                                                    <h6 class="text-muted m-b-0">Instituições cadastradas</h6>
                                                </div>
                                                <div class="col-4 text-right">
                                                    <h1><i class="fas fa-globe"></i></h1>
                                                </div>
                                                 </div>
                                            </div>
                                        </div>
                                    </div>                   
                                </div>
                            </div>
                        </form>
                    </div>
                    <?php 
                        if(isset($_POST['filtro3'])) {
                            $filtro = $_POST['filtro3'];
                        }
                    ?>
                <div class="container">    
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="row">
                                <div class="col-sm-6">
                                    <form action="pag_admin.php" method="GET">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col-8">
                                                        <div class="form-group">
                                                            <label for="formGroupExampleInput">Cadastrar nova categoria</label>
                                                            <input type="text" class="form-control" id="formGroupExampleInput" required name="cat" placeholder="Categoria *">
                                                        </div>
                                                        <button type="submit" class="btn btn-outline-dark">Cadastrar</button>
                                                    </div>
                                                    <div class="col-4 text-right">
                                                    <h1><i class="far fa-clipboard"></i></h1>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <?php 
                                    if(isset($_GET['cat'])) {
                                        $cat = $_GET['cat'];
                                        $sql = "INSERT INTO public.categorias VALUES(DEFAULT, '$cat')";
                                        $resultado=pg_query($conecta,$sql);
                                        $linhas=pg_affected_rows($resultado);
                                        if ($linhas > 0){ 
                                            echo "<script type='text/javascript'>alert('Categoria cadastrada com sucesso!')</script>";
                                            echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../pag_admin.php'>";
                                            pg_close($conecta);
                                        }
                                        else{
                                            echo "<script type='text/javascript'>alert('Falha ao cadastrar categoria!')</script>";
                                            echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../pag_admin.php'>";
                                            pg_close($conecta);
                                        }
                                    }
                                ?>
                                <div class="col-sm-6">
                                    <form action="pag_admin.php" method="POST">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col-8">
                                                        <div class="form-group">
                                                            <label for="exampleFormControlTextarea1">Envie e-mail para instituições:</label>
                                                            <textarea class="form-control" required name="bodyEmail" id="campoEmail" rows="3"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-4 text-right">
                                                        <h1 class="new-position"><i class="far fa-envelope"></i></h1>
                                                        <button type="submit" class="btn btn-outline-dark">Enviar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
                <?php 
                    if(session_status() !== PHP_SESSION_ACTIVE){
                        session_start();
                    }
                    if(isset($_POST['bodyEmail'])) {
                        $_SESSION['bodyEmail'] = $_POST['bodyEmail'];
                        $bodyEmail = $_SESSION['bodyEmail'];
                        include "PHP/envia-email-todos.php";
                    }                
                ?>    
                <!-- prject ,team member start -->
                <div class="col-lg-12 col-md-10">
                    <div class="card table-card">
                        <div class="card-header">
                            <h5>Instituições - DOE</h5>
                            <div class="card-header-right">
                                <div class="btn-group card-option">
                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="feather icon-more-horizontal"></i>
                                    </button>
                                    <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                        <li class="dropdown-item full-card"><a href="#!"><span><i class="feather icon-maximize"></i> Tela Cheia</span><span style="display:none"><i class="feather icon-minimize"></i> Tela Normal</span></a></li>
                                        <li class="dropdown-item minimize-card"><a href="#!"><span><i class="feather icon-minus"></i> Minimizar</span><span style="display:none"><i class="feather icon-plus"></i> Expandir</span></a></li>
                                        <li class="dropdown-item reload-card"><a href="#!"><i class="feather icon-refresh-cw"></i> Recarregar</a></li>
                                        <li class="dropdown-item close-card"><a href="#!"><i class="feather icon-trash"></i> Remover</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <form action="PHP/ativacao.php" id="formm" method="post">
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <div class="chk-option">
                                                        <label class="check-task custom-control custom-checkbox d-flex justify-content-center done-task">
                                                            <input type="checkbox" class="custom-control-input">
                                                        </label>
                                                    </div>
                                                    <b>INSTITUIÇÃO</b> 
                                                </th>
                                                <th><b>ID</b></th>
                                                <th><b>RESPONSÁVEL</b></th>
                                                <th><b>CNPJ</b></th>
                                                <th><b>ENDEREÇO </b></th>
                                                <th><b>CEP </b></th>
                                                <th><b>CIDADE </b></th>
                                                <th><b>CELULAR </b></th>
                                                <th><b>VERIFICADA</b></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                if($filtro == 1){$sql = "SELECT * FROM public.ongs WHERE ativo_ong = TRUE ORDER BY id_ong";}
                                                else if($filtro == 2){$sql= "SELECT * FROM public.ongs WHERE ativo_ong = FALSE ORDER BY id_ong";}
                                                else if($filtro == 3){$sql = "SELECT * FROM public.ongs ORDER BY id_ong";}  
                                                $resultado = pg_query($conecta, $sql);
                                                while($row = pg_fetch_array($resultado)){
                                            ?>
                                                <tr>
                                                    <td>
                                                        <div class="d-inline-block align-middle">
                                                        <?php echo '<img src="'; echo $row['imagem_ong']; echo '" alt="user image" class="img-radius wid-40 align-top m-r-15">';?>
                                                            <div class="d-inline-block">
                                                                <h6><?php echo $row['nome_ong'];
                                                                    if($row['ativo_ong']== "t")
                                                                    {
                                                                        echo " <img class='img_verify' src='https://img.icons8.com/material-two-tone/24/000000/verified-account.png'/>";
                                                                    }    ?></h6>
                                                                <p class="text-muted m-b-0"><?php echo $row['email_ong'];?></p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td><input class="campo"type="text" value="<?php echo $row['id_ong'];?>" name="id_ong" disabled></td>
                                                    <td><h6 class="posicao"><?php echo $row['responsavel_ong'];?></h6></td>
                                                    <td class="text-left"><label class="badge badge-light-danger posicao"><?php echo $row['cnpj_ong'];?></label></td>
                                                    <td><h6 class="posicao"><?php echo $row['endereco_ong'];?></h6></td>
                                                    <td><h6 class="posicao"><?php echo $row['cep_ong'];?></h6></td>
                                                    <td><h6 class="posicao"><?php echo $row['cidade_ong'];?></h6></td>
                                                    <td><h6 class="posicao"><?php echo $row['numero_ong'];?></h6></td>
                                                    
                                                    <?php 
                                                    
                                                    if($row['ativo_ong'] == "t") 
                                                    {  
                                                        ?>
                                                            <td>
                                                                <div class='interruptor'><input type='checkbox' id='<?php echo $row['id_ong'];?>' checked  onclick='pegaId(this);  pegaAtivacao("<?php echo $row["ativo_ong"]; ?>", this)'>
                                                                </div>
                                                            </td>
                                                        <?php
                                                    } 
                                                    else 
                                                    {
                                                        ?>
                                                            <td>
                                                                <div class='interruptor'><input type='checkbox' id='<?php echo $row['id_ong'];?>' onclick='pegaId(this);  pegaAtivacao("<?php echo $row["ativo_ong"]; ?>", this)'>
                                                                </div>
                                                            </td>
                                                        <?php
                                                    }
                                                    ?>
                                                    
                                                    
                                            </tr>
                                            
                                            <?php
                                        }
                                        ?>           
                                        </tbody>
                                        
                                    </table>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Latest Customers end -->
            </div>
            <!-- [ Main Content ] end -->
        </div>
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

    <script>
        var form = document.getElementById("formm");

        document.getElementById("ativacao").addEventListener("click", function () {
        form.submit();
        });

    </script>
</body>
    
</html>
