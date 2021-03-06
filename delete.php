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
include('inc/variables.inc');
$spojeni = mysql_connect($sqlserver, $user, $pwd) or die ('Nelze se spojit s SQL serverem.');
$database = mysql_select_db($dbname, $spojeni) or die ('Chyba pri vyberu databaze.');
mysql_query("set names 'utf8'");

$message = '';

if ($_POST['delete']!=''){
    $now = date('Y-m-d G:i:s');
    $x = mysql_query("SELECT * FROM bins WHERE user = ".$_POST['user']);
    while ($y = mysql_fetch_array($x)){
        unlink($rootPath.'/bin/'.$y['file']);
    }
    mysql_query("DELETE FROM bins WHERE user = ".$_POST['user']);
    mysql_query("DELETE FROM users WHERE id = ".$_POST['user']);
    session_destroy(); 
    $message = '<p>Uživatel vymazán</p>';

}

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

                </div>
            </div>
        </div>

            <!-- Main hero unit for a primary marketing message or call to action -->
            <div class="hero-unit">
               <div class="hero-unit-inner">
                    <div class="login delete">
                         <!--<h1>Smazání účtu</h1>-->
                         <div class="loginForm"><form action="delete.php" method="post">
                              <p>Opravdu chcete zrušit registraci na www.denikpacienta.cz?<br>
                               Tímto krokem přijdete také o všechny dříve vytvořené zálohy.</p>
                              <input type="hidden" name="user" value="<?php echo $_SESSION['userId']; ?>">
                              <a href="sprava-dat.php">Ne</a>
                              <input type="submit" name="delete" value="Ano" class="submit">
                              <div class="clr"></div>
                              <?php echo $message; ?>
                         </form></div>     
                    </div>                    
                    <div class="clr"></div>
               
               </div>                
                
            </div>
            
            
            <div class="hero-unit typeBlack">
               <div class="hero-unit-inner">
                    <div class="blackTxt">
                         <h2>Správa archivu</h2> 
                         <ul>
                              <li>Přehledné zobrazení posledních dokončených záloh</li>
                              <li>Přímé uložení archivu na vlastní USB/HDD</li>
                              <li>Přístup do archivů pouze po předchozím přihlášení</li>
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
