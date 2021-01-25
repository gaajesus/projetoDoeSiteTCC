<?php
    $conecta = pg_connect("host=localhost port=5432 dbname=jozi_modas user=postgres password=postgres");
    if (!$conecta)
    {
      echo "Erro!";
      exit;
    }
   ?>