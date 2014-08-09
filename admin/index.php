<?php 
session_start();
error_reporting(0);
include('inc/db.inc');
include('inc/variables.inc');
$spojeni = mysql_connect($sqlserver, $user, $pwd) or die ('Nelze se spojit s SQL serverem.');
$database = mysql_select_db($dbname, $spojeni) or die ('Chyba pri vyberu databaze.');
mysql_query("set names 'utf8'");
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Deník, bannery - administrace</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="css/jquery.cleditor.css">
    <link rel="stylesheet" type="text/css" href="css/ui-lightness/jquery-ui-1.10.2.custom.css">
    <link rel="stylesheet" href="css/jquery.fileupload-ui.css">
    <link href="css/default.css" rel="stylesheet" media="screen">
  </head>
  <body>

    <?php
        include('./templates/menu.tpl');
        include('inc/functions.inc');
    ?>
    
    <div class="container">
    
    <?php
    if (!isset($_SESSION['denikUserId'])){
        include('./templates/login.tpl');
    }else{
        if (empty($_GET)){
            include('./templates/banners.tpl');
        }
        if (isset($_GET['banners'])){
            include('./templates/banners.tpl');
        }
        if (isset($_GET['logout'])){
            include('./templates/login.tpl');
        }
        if (isset($_GET['login'])){
            include('./templates/login.tpl');
        }
    }
    

    
    ?>
    
    </div>    
    
    <script src="js/jquery-1.7.1.min.js"></script>
    <script src="js/jquery-ui-1.10.2.custom.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.cleditor.min.js"></script>
    <script src="js/parsley.js"></script>
    
    <script src="js/init.js"></script>
    
  </body>
</html>