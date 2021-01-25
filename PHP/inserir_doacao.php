<?php
   session_start();
   include "conecta.php";
   $descricao = $_POST['descricaoPedido'];
   $meta = $_POST['metaPedido'];
   $idInstituicao = $_SESSION["id"];
   $idCategoria = $_POST['categoria'];
   $unidadeMedida = $_POST['unidadeMedida'];
   $data = date("Y/m/d");

   $data = str_replace("/","-", $data);

   $sql="INSERT INTO notificacoes VALUES(DEFAULT, $idInstituicao, '$data', $idCategoria,'$descricao', $meta, '$unidadeMedida', DEFAULT, DEFAULT, DEFAULT)";  

   $resultado=pg_query($conecta,$sql);
   $linhas=pg_affected_rows($resultado);
   if($linhas > 0)
   {
      echo "<script type='text/javascript'>alert('Pedido realizado com sucesso!')</script>";
      echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../pag_instituicao.php'>";

   }
   else{
      echo "<script type='text/javascript'>alert('deu merda ha $data')</script>";
      echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../inserir_pedido.php'>";
   }	
   ?>