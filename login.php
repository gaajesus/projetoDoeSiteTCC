<!DOCTYPE html>
<?php 
    error_reporting(0);
?>
<html lang="pt-br">
<head>
      <title>Login - DOE</title>
      <link rel="sortcut icon" href="favicon.ico" type="image/x-icon" />
    <meta charset="utf-8">
    <link rel="icon" href="img/icon.png">   
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">  
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css" integrity="sha384-VCmXjywReHh4PwowAiWNagnWcLhlEJLA5buUprzK8rxFgeH0kww/aWY76TfkUoSX" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"/>
    <!-- Style CSS -->
    <link rel="stylesheet" href="css/style-login.css">            
  </head>
  <body>
     <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top"> 
      <div class="container-fluid"> <a href="index.html">
        <img class="logo" src="img/logo.png" alt="" width="50px" ></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSite">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSite">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                <a class="nav-link" href="login.php" id="#topo"><p>Login</p></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="index.html#sobre" > <p>Sobre</p></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="index.html#download" ><p>Download</p></a>
              </li>
            </ul> 
        </div>
      </div>   
    </nav>
     <!-- FIM DA NAV -->
     <br><br><br><br><br><br><br><br><br><br>
    <div class="form">
      <form class="cadastro" action="PHP/realiza-login.php" method="POST">
        <div class="textoCad">
          <h2 class="a">
            Login
          </h2>
        </div>
        <br><br><br><br>
        <div class="cad-step-one">
          
          <div class="input-group-prepend">
            <span class="input-group-text anime-left-to-center"><i class="fas fa-user"></i></span>
            <input class="input-one anime-left-to-center" type="email" name="emailInstituicao" id="emailInstituicao" placeholder="E-mail da instituição:*" required><br><br>
          </div>
        </div>
          <div class="cad-step-two">
            <div class="input-group-prepend">
              <span class="input-group-text anime-right-to-center"><i class="fas fa-key"></i></span>
              <input class="input-one anime-right-to-center"type="password" name="senhaInstituicao" id="senhaInstituicao" placeholder="Senha:*" required><br><br>
            </div>           
          </div>   
          <input class="button" type="submit" value="Enviar">        
            <div class="card-footer">
                <div class="d-flex justify-content-center links" style="color: white">
                  Não possui cadastro? 
                  <a href="cadastrar.php" class="esqueci" style="margin-left: 0.5%;">   Cadastre-se</a>
                </div>
				        <div class="d-flex justify-content-center">
					        <a href="esquecisenha.php" class="esqueci">Esqueceu sua senha?</a>
				        </div>
			        </div>
          
                 <div id="imagem" style="margin-left: 94%; margin-top:9%; position: relative;"><img src="img/logo_doe.png" width="45px" height="45px"></div>
          
      </form>
    </div>
    <!-- FOOTER -->
    <div class="footer"> 
      <li class="a text-center">Instagram&nbsp;&nbsp;&nbsp;GitHub&nbsp;&nbsp;&nbsp;YouTube</li><br>
      <div class="footer-copyright text-center py-3 a">© 2020 Copyright SmartDev</div>
    </div>
    <!-- FIM FOOTER  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/js/all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/js/bootstrap.min.js"></script>

    <script src="js/animation1.js"></script>
    <script src="js/animation2.js"></script>
    <script src="js/animation3.js"></script>
    <script src="js/navbar.js"></script>
    <script src="js/botao-submit.js"></script>
    <script src="js/consistencia.js"></script>
    <script src="js/mascara.js"></script>
    <script src="js/jquery-1.2.6.pack.js"></script>
    <script src="js/jquery.maskedinput-1.1.4.pack.js"></script>
  </body>
</html>