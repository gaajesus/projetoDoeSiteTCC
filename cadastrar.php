<!doctype html>
<html lang="pt-br">
<head>
  <title>Cadastro - DOE</title>
  <meta charset="utf-8">
  <!-- Frameworks -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css" integrity="sha384-VCmXjywReHh4PwowAiWNagnWcLhlEJLA5buUprzK8rxFgeH0kww/aWY76TfkUoSX" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"/>
    <!-- Style CSS -->
  <link rel="stylesheet" href="css/style-cadastro.css">
  <link rel="icon" href="img/icon.png">          
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
                <a class="nav-link" href="index.html#download" ><p>Donwload</p></a>
              </li>
            </ul> 
        </div>
      </div>   
    </nav>
     <!-- FIM DA NAV -->

    <br><br><br><br><br><br><br>
    <div class="form">
      <form name="formulario" class="cadastro" action="../PHP/grava.php" method="POST">
        <div class="textoCad">
          <h2 class="a">
            Cadastrar
          </h2>
        </div>
            <div class="essencial">
        <div class="cad-step-one">
          <input class="input-one anime-left-to-center" type="text" name="nomeInstituicao" id="nomeInstituicao" placeholder="Nome da instituição:*" required><br><br>
          <input class="input-one anime-left-to-center" type="text" name="cnpjInstituicao" id="cnpjInstituicao" placeholder="CNPJ da instituição:*" required><br><br>        
          <input class="input-one anime-left-to-center" type="email" name="emailInstituicao" id="emailInstituicao" placeholder="E-mail da instituição:*" required><br><br>
          <input class="input-one anime-left-to-center"type="password" onclick="avisoSenha();" name="senhaInstituicao" id="senhaInstituicao" placeholder="Senha:*" required><br><br>
          <input class="input-one anime-left-to-center"type="password" name="senhaConfInstituicao" id="senhaConfInstituicao" placeholder="Confirmar Senha:*" required><br><br> 
        </div>
        <div class="cad-step-two">
          <input class="input-one anime-right-to-center" type="text" name="enderecoInstituicao" id="emailInstituicao" placeholder="Endereço da instituição:*" required><br><br>
          <input class="input-one anime-right-to-center" type="text" name="cidadeInstituicao" id="cidadeInstituicao" placeholder="Cidade da instituição:*" required><br><br>   
          <input class="input-one anime-right-to-center"type="text" name="celularInstituicao" id="celularInstituicao" placeholder="Celular da instituição:*" required><br><br>         
          <input class="input-one anime-right-to-center" type="text" name="cepInstituicao" id="cepInstituicao" placeholder="CEP:*" required><br><br>
          <input class="input-one anime-right-to-center" type="text" name="responsavelInstituicao" id="responsavelInstituicao" placeholder="Responsável:*" required><br><br>
        </div>
        <div class="cad-step-three">
          <input class="button" type="submit" value="Enviar" id="enviar" onclick="Confirmar(); validaSenha();">
        </div>
        <div id="imagem">
          <img src="img/logo_doe.png" width="98%" height="98%">
        </div>
                </div>
      </form>
    </div>

    <!-- FOOTER -->
    <div class="footer"> 
      <li class="a text-center">Instagram&nbsp;&nbsp;&nbsp;Gmail&nbsp;&nbsp;&nbsp;YouTube</li><br>
      <div class="footer-copyright text-center py-3 a">© 2020 Copyright SmartDev</div>
    </div>
    <!-- FIM FOOTER -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/js/all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/js/bootstrap.min.js"></script>
    
    <!-- SCRIPTS NECESSÁRIOS PARA O FUNCIONAMENTO -->
    <script src="js/animation1.js"></script>
    <script src="js/animation2.js"></script>
    <script src="js/animation3.js"></script>
    <script src="js/navbar.js"></script>
    <script src="js/botao-submit.js"></script>
    <script src="js/consistencia.js"></script>
    <script src="js/mascara.js"></script>
    <script src="js/jquery-1.2.6.pack.js"></script>
    <script src="js/jquery.maskedinput-1.1.4.pack.js"></script>
    <script>
      function avisoSenha(){
        alert('A senha precisa de pelo menos 8 digitos, com uma letra maiúscula, uma minúscula e um número!');
      }
    </script> 
  </body>
</html>