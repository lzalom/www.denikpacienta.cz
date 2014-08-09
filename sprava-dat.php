<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="format-detection" content="telephone=no">

        <style>
            body {
                padding-top: 60px;
                padding-bottom: 40px;
            }
        </style>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/main.css?v=4">

        <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    </head>
    
<?php
session_start();

error_reporting(0);
include('inc/db.inc');
include('inc/functions.inc');
$spojeni = mysql_connect($sqlserver, $user, $pwd) or die ('Nelze se spojit s SQL serverem.');
$database = mysql_select_db($dbname, $spojeni) or die ('Chyba pri vyberu databaze.');
mysql_query("set names 'utf8'");

$message = '';

if (!isset($_SESSION['userId'])){
    header('location:login.php');
}
if ($_POST['submitEmail']!=''){
    if ($_POST['user']!=''){
        $editMail = "UPDATE users SET email = '".$_POST['user']."' WHERE id = ".$_SESSION['userId'];
        mysql_query($editMail);
        $message = '<p>Údaje změněny</p>'; 
    }else{
        $message = '<p>Vyplňte nový e-mail.</p>'; 
    }
}
if ($_POST['submitPhone']!=''){
    if ($_POST['phone']!=''){
        $phone = unifyPhone($_POST['phone']); 
        $editPhone = "UPDATE users SET phone = '".$phone."' WHERE id = ".$_SESSION['userId'];
        mysql_query($editPhone);
        $message = '<p>Údaje změněny</p>'; 
    }else{
        $message = '<p>Vyplňte nové telefonní číslo.</p>'; 
    }
}
if ($_POST['submitPass']!=''){
    if ($_POST['newpass']!=''){
        if (strlen($_POST['newpass'])<8){
            $message = '<p>Heslo  musí být alespon 8 znaků</p>';
        }else{
            if ($_POST['newpass']!=$_POST['newpass2']){
                $message = '<p>Hesla se neshodují</p>';
            }else{
                $newPass = md5($_POST['newpass']);
                $editPass = "UPDATE users SET pass = '".$newPass."' WHERE id = ".$_SESSION['userId']; 
                mysql_query($editPass);  
                $message = '<p>Údaje změněny</p>'; 
            }            
        }    
    }else{
        $message = '<p>Vyplňte nové heslo.</p>'; 
    }

}

//print_r($_SESSION);

?>  
    <body class="bodyBlue">
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <!-- This code is taken from http://twitter.github.com/bootstrap/examples/hero.html -->

        <div class="main">
        

        <div class="navbar navbar-inverse"><!--  navbar-fixed-top -->
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <!--<a class="brand" href="#">Project name</a>-->
                    <div class="nav-collapse collapse">
                        <a href="index.html" class="btnHome btnHomeBlack"></a>
                        <ul class="nav">
                            <li class="active"><a href="sprava-dat.php">Správa osobních dat</a></li>
                            <li><a href="sprava-archivu.php">Správa archivu</a></li>
                        </ul>
                        <div class="logged">
                            Přihlášen: <?php echo $_SESSION['userEmail'] ?>
                            <br>
                            <a href="login.php?logoff">Odhlásit</a>
                        </div>
                    </div><!--/.nav-collapse -->
                </div>
            </div>
        </div>

            <!-- Main hero unit for a primary marketing message or call to action -->
            <div class="hero-unit">
               <div class="hero-unit-inner">
                    <div class="dataManagement">
                         <form action="sprava-dat.php" method="post">
                              <!--<h2>Úprava osobních údajů</h2>-->
                              <label for="user">E-mail:</label>
                              <input type="text" id="user" name="user" class="text">
                              <input type="submit" name="submitEmail" value="Upravit" class="submit">
                              <div class="clr"></div>
                         </form> 
                         <form action="sprava-dat.php" method="post">
                              <label for="email">Telefon:</label>
                              <input type="text" id="phone" name="phone" class="text">
                              <input type="submit" name="submitPhone" value="Upravit" class="submit">
                              <div class="clr"></div>
                         </form>
                         <form action="sprava-dat.php" method="post">
                              <label for="newpass">Nové heslo:</label>
                              <input type="password" id="newpass" name="newpass" class="text">
                              <div class="clr"></div>
                              <label for="newpass2">Potvrdit heslo:</label>
                              <input type="password" id="newpass2" name="newpass2" class="text">
                              <input type="submit" name="submitPass" value="Upravit" class="submit submitType2">
                              <div class="clr"></div>
                              <?php echo $message; ?>
                         
                         </form>  
                         <br>   
                         <div class="clr"></div>    
                         <a href="delete.php" class="btnBlack">Smazat účet</a>           
                    </div>
                    <div class="clr"></div>
               
               </div>                
                
            </div>
            <div class="hero-unit typeBlack">
               <div class="hero-unit-inner">
                    <div class="blackTxt">
                         <h2>Správa osobních dat</h2> 
                         <ul>
                              <li>Editace přihlašovacích údajů</li>
                              <li>Změna hesla a uživatelského jména</li>
                              <li>Ochrana změn validací přes e-mail</li>
                         </ul>            
                    </div>
                    <div class="clr"></div>
               
               </div>                
                
            </div>
          </div>
            <footer>
               <div class="left">
                    <p>© 2013 <strong>KAP CZ</strong>, s.r.o., Cupákova 6, 621 00 Brno, Czech Republic, tel: +420 539 015 900, fax: +420 539 015 902</p>
               </div>
               <div class="right">
       <p>
        <a href="mailto:denikpacienta@kapcz.cz" class="mail"><img src="gfx/btnMailBlue.png" class="size1" alt=""><img src="gfx/btnMailBlue@2x.png" class="size2" alt="" width="26" height="24"></a>
        <a href="http://www.facebook.com/denikpacienta" class="fb"><img src="gfx/btnFacebookBlue.png" class="size1" alt=""><img src="gfx/btnFacebookBlue@2x.png" class="size2" alt="" width="26" height="24"></a>
        <a href="https://twitter.com/DenikPacientacz" class="tw"><img src="gfx/btnTwitterBlue.png" class="size1" alt=""><img src="gfx/btnTwitterBlue@2x.png" class="size2" alt="" width="26" height="24"></a>
        <a href="https://plus.google.com/u/0/100526477383814347891/posts" class="gp"><img src="gfx/btnGooglePlusBlue.png" class="size1" alt=""><img src="gfx/btnGooglePlusBlue@2x.png" class="size2" alt="" width="26" height="24"></a>
        <a href="http://www.youtube.com/user/denikpacienta" class="yt"><img src="gfx/btnYoutubeBlue.png" class="size1" alt=""><img src="gfx/btnYoutubeBlue@2x.png" class="size2" alt="" width="26" height="24"></a>
    </p>
               </div>
            </footer>
            
            

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.9.1.min.js"><\/script>')</script>

        <script src="js/vendor/bootstrap.min.js"></script>

        <script src="js/main.js"></script>

        <script>
            var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>
    </body>
</html>
