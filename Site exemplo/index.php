<?php session_start()?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <title>cadastro </title>
    <meta charset="utf-8">
  </head>
  <body>
    <?php
    if(isset($_SESSION['login'])){
        include "login.php";
    } else {
        include "home.php";
    }
    ?>
  </body>
</html>