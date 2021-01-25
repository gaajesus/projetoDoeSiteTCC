<?php
include "PHP/conecta.php";
include "PHP/session-expira.php";

if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}

$filtro = 3;

if($_SESSION['logou'] != "s"){
    echo '<script>alert("faça login ou cadastre-se para continuar!");
              window.location.href="login.php";
              </script>';
}
else{
    $nome = $_SESSION['nome'];
    $id = $_SESSION['id'];
    $foto = $_SESSION['imagem'];
}

$sql = "SELECT COUNT(*) FROM notificacoes WHERE id_ong = '$id'";
$resp = pg_query($conecta, $sql);

if(pg_num_rows($resp) > 0){
    $linha = pg_fetch_array($resp);
    $conta = $linha['count'];
}

$sql = "SELECT COUNT(*) FROM notificacoes WHERE ativo_notificacao = TRUE AND atingido_notificacao = FALSE AND id_ong = '$id'";
$resp = pg_query($conecta, $sql);

if(pg_num_rows($resp) > 0){
    $linha = pg_fetch_array($resp);
    $contaAtv = $linha['count'];
}

$sql = "SELECT COUNT(*) FROM notificacoes WHERE ativo_notificacao = FALSE AND atingido_notificacao = FALSE AND id_ong = '$id'";
$resp = pg_query($conecta, $sql);

if(pg_num_rows($resp) > 0){
    $linha = pg_fetch_array($resp);
    $contaAtv1 = $linha['count'];
}

// $sql = "SELECT * FROM notificacoes INNER JOIN doacoes ON meta_notificacao = quantidade_doacao WHERE id_ong = '$id'";
// $resp = pg_query($conecta, $sql);

// if(pg_num_rows($resp) > 0){
//     $linha = pg_fetch_array($resp);
//     $meta = $linha['meta_notificacao'];
//     $doado = $linha['quantidade_notificacao'];
//     $percent = ($doado/$meta) * 100;
// }
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Adminstração - <?php echo $nome;?></title>
   
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
    <link rel="stylesheet" href="assets/css/style4.css">   

</head>
<body class="">
    <?php
    if(isset($_GET['id']) && isset($_GET['ativado'])){
        $id_pedido = $_GET['id'];
        $ativado = $_GET['ativado'];
        if($ativado == "f"){
            $sql = "UPDATE notificacoes SET ativo_notificacao = TRUE WHERE id_notificacao = '$id_pedido'";
            $resp = pg_query($conecta, $sql);
            if(pg_affected_rows($resp) > 0){
                echo "<script type='text/javascript'>alert('Pedido ativado com sucesso!')</script>";
                echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../pag_instituicao.php'>";
            }
            else{
                echo "<script type='text/javascript'>alert('Ocorreu um erro!')</script>";
                echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../pag_instituicao.php'>";
            }
        }
        else if($ativado == "t"){
            $sql = "UPDATE notificacoes SET ativo_notificacao = FALSE WHERE id_notificacao = '$id_pedido'";
            $resp = pg_query($conecta, $sql);
            if(pg_affected_rows($resp) > 0){
                echo "<script type='text/javascript'>alert('Pedido desativado com sucesso!')</script>";
                echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../pag_instituicao.php'>";
            }
            else{
                echo "<script type='text/javascript'>alert('Ocorreu um erro!')</script>";
                echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../pag_instituicao.php'>";
            }
        }
    }
    ?>
    <script>
            var id;
            function pegaId(element) {
                id = element.i
            }
            
            function pegaAtivacao(valor, element){
                if(valor === "f"){
                    var r = confirm("Deseja ativar o pedido?");
                    if (r == true) {
                        window.location.href = window.location.pathname + "?id=" + element.id + "&ativado=" + valor;
                    } else {
                        element.checked = false
                    }
                    
                }  else {
                    var r = confirm("Deseja desativar o pedido?");
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
                    <?php 
                        $sql = "SELECT * FROM ongs WHERE id_ong = '$id'";
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
                        <span><?php echo $nome;?></span>
                        <a href="/PHP/logout.php" class="dud-logout" title="Sair">
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
                                <li class="breadcrumb-item"><a href="pag_instituicao.php"><?php echo $nome;?>- DOE</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-lg-10 col-md-12">
                    <div class="row">
                        <div class="col-sm-4">
                            <form action="pag_instituicao.php" method="POST">
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
                                                <h6 class="text-muted m-b-0">Pedidos fechados</h6>
                                            </div>
                                            <div class="col-4 text-right">
                                            <h1><i class="far fa-check-circle"></i></h1>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <?php 
                            if(isset($_POST['filtro1'])) {$filtro = $_POST['filtro1'];}
                        ?>
                        <div class="col-sm-4">
                            <form action="pag_instituicao.php" method="POST">
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
                                                <h6 class="text-muted m-b-0">Pedidos em aberto</h6>
                                            </div>
                                            <div class="col-4 text-right">
                                                <h1><i class="fas fa-box-open"></i></h1>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <?php 
                            if(isset($_POST['filtro2'])) {$filtro = $_POST['filtro2'];}
                        ?>
                        <div class="col-sm-4">
                            <form action="pag_instituicao.php" method="POST">
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
                                                <h6 class="text-muted m-b-0">Total de pedidos</h6>
                                            </div>
                                            <div class="col-4 text-right">
                                                <h1><i class="fas fa-globe" ></i></h1>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </form>
                        </div>                    
                    </div>
                </div>
                
                <?php 
                            $sql = "SELECT descricao_ong from ongs WHERE id_ong = $id";
                            $resultado = pg_query($conecta, $sql);
                            $row = pg_fetch_array($resultado);
                            $descricao_ong = $row['descricao_ong'];
                ?>
                 <div class="container">    
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="row">
                                <div class="col-sm-6">
                                    <form action="pag_instituicao.php" method="POST"> 
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col-8">
                                                        <div class="form-group">
                                                            <label for="exampleFormControlTextarea1">Adicionar texto expositivo no aplicativo:*</label>
                                                            <textarea class="form-control" required name="textoExp" placeholder="
<?php if($descricao_ong != null) {echo $descricao_ong;}?>"id="campoTexto" rows="7"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-4 text-right">
                                                        <h1 class="new-position"><i class="fas fa-edit"></i></h1>
                                                        <button type="submit" class="btn btn-outline-dark">Adicionar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <?php
                                    if(isset($_POST['textoExp'])){
                                        $texto = $_POST['textoExp'];
                                        $sql = "UPDATE ongs SET descricao_ong = '$texto' WHERE id_ong = $id";
                                        $resp = pg_query($conecta, $sql);
                                        $linhas = pg_affected_rows($resp);
                                        if($linhas > 0){
                                            echo "<script type='text/javascript'>alert('Texto expositivo adicionado com sucesso!')</script>";
                                            echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../pag_instituicao.php'>";
                                        }
                                        else{
                                            echo "<script type='text/javascript'>alert('Falha ao adicionar Texto expositivo!')</script>";
                                            echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../pag_instituicao.php'>";
                                        }
                                    }
                                    ?>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
                <?php 
                    if(isset($_POST['filtro3'])) {$filtro = $_POST['filtro3'];}
                ?>
                <!-- prject ,team member start -->
                <div class="col-lg-10 col-md-12">
                    <div class="card table-card">
                        <div class="card-header">
                            <h5>Pedidos da <?php echo $nome;?></h5>
                            <div class="card-header-right">
                                <div class="btn-group card-option">
                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="feather icon-more-horizontal"></i>
                                    </button>
                                    <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                        <li class="dropdown-item full-card"><a href="#!"><span><i class="feather icon-maximize"></i> Tela Cheia</span><span style="display:none"><i class="feather icon-minimize"></i> Tela Normal</span></a></li>
                                        <li class="dropdown-item minimize-card"><a href="#!"><span><i class="feather icon-minus"></i> Minimizar</span><span style="display:none"><i class="feather icon-plus"></i> Expandir</span></a></li>
                                        <li class="dropdown-item reload-card"><a href="pag_instituicao.php"><i class="feather icon-refresh-cw"></i> Recarregar</a></li>
                                        <li class="dropdown-item close-card"><a href="#!"><i class="feather icon-trash"></i> Remover</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <form action="PHP/ativacao.php" id="formm">
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th><b>DESCRIÇÃO</b></th>
                                                <th><b>CATEGORIA</b></th>
                                                <th><b>META</b></th>
                                                <th><b>ANDAMENTO</b></th>
                                                <th><b>ATIVADO</b></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                            <?php   
                                            
                                                if($filtro == 1){
                                                    $sql = "SELECT * FROM notificacoes INNER JOIN categorias ON id_categoria_notificacao = id_categoria WHERE atingido_notificacao = TRUE OR ativo_notificacao = FALSE AND id_ong = $id ORDER BY id_notificacao";
                                                }
                                                else if($filtro == 2){
                                                    $sql = "SELECT * FROM notificacoes INNER JOIN categorias ON id_categoria_notificacao = id_categoria WHERE ativo_notificacao = TRUE AND atingido_notificacao = FALSE AND id_ong = $id ORDER BY id_notificacao";
                                                }
                                                else if($filtro == 3){
                                                    $sql = "SELECT * FROM notificacoes INNER JOIN categorias ON id_categoria_notificacao = id_categoria WHERE id_ong = $id ORDER BY id_notificacao";
                                                }
                                                $resultado = pg_query($conecta, $sql);
                                                while($row = pg_fetch_array($resultado))
                                                {
                                                    $id_not = $row['id_notificacao'];
                                                    $sql = "SELECT SUM(quantidade_doacao) FROM doacoes WHERE notificacao_doacao = '$id_not'";
                                                    $resp = pg_query($conecta, $sql);
                                                    $array = pg_fetch_array($resp);
                                                    $soma = $array['sum'];

                                                    $percent = ($soma/$row['meta_notificacao']) * 100;
                                                    $id2 = $row['id_notificacao'];
                                            ?>
                                            <td><h6 class="posicao"><?php echo $row['descricao_notificacao'];?></h6></td>
                                                <td class="text-left"><label class="badge badge-light-danger posicao"><?php echo $row['nome_categoria'];?></label></td>
                                                <td><h6 class="posicao"><?php echo $row['meta_notificacao']; echo " ";echo $row['unidade_notificacao']; ?></h6></td>

                                                <style type="text/CSS">
                                                    .outliner{
                                                        height: 29px;
                                                        width: 200px;
                                                        border: solid #cc406a;
                                                        border-radius: 15px;
                                                    }
                                                    .inner{
                                                        height: 23px;
                                                        border-right:solid 1px #e4648c;
                                                        background-color: #e4648c;
                                                        border-radius:10px;
                                                    }
                                                </style>
                                               
                                                <td><div class="outliner posicao-bar">
                                                
                                                    <div class="inner" id="<?php echo 'inner'.$id2; ?>"><h6><?php echo $percent;?>%</h6></div>
                                                    </div></td>
                                                    <?php 
                                                    echo "<script> document.getElementById('inner$id2').style.width = '$percent%' </script>"
                                                    ?>
                                                 <?php 
                                                    
                                                    if($row['ativo_notificacao'] == "t") 
                                                    {  
                                                        ?>
                                                            <td>
                                                                <div class='interruptor'><input type='checkbox' id='<?php echo $row['id_notificacao'];?>' checked  onclick='pegaId(this);  pegaAtivacao("<?php echo $row["ativo_notificacao"]; ?>", this)'>
                                                                </div>
                                                            </td>
                                                        <?php
                                                    } 
                                                    else 
                                                    {
                                                        ?>
                                                            <td>
                                                                <div class='interruptor'><input type='checkbox' id='<?php echo $row['id_notificacao'];?>' onclick='pegaId(this);  pegaAtivacao("<?php echo $row["ativo_notificacao"]; ?>", this)'>
                                                                </div>
                                                            </td>
                                                        <?php
                                                    }
                                                    ?>
                                            </tr>
                                            <?php }?>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/js/all.min.js"></script>
</body>
    
</html>
