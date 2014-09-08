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

if (isset($_GET['ok'])){ $message = '<p>Registrace uložena</p>'; }
if (isset($_GET['newPassword'])){ $message = '<p>Nové heslo odesláno na zadanou e-mailovou adresu.</p>'; }

if ($_POST['submit']!=''){    
    if (($_POST['pass']=='')&&($_POST['user']=='')){
        $message = '<p>Vyplňte všechny položky</p>';
    }else{
        $pass = md5($_POST['pass']);     
        $count = mysql_result(mysql_query("SELECT COUNT(*) FROM users WHERE email = '".$_POST['user']."' AND pass = '".$pass."' AND active = 1"), 0);
        if ($count!=0){
            $q = "SELECT * FROM users WHERE email = '".$_POST['user']."' AND pass = '".$pass."'";
            $res = mysql_query($q);    
            while ($y = mysql_fetch_array($res)){
                $userId = $y['id'];
                $user = $y['email'];
            }         
            $_SESSION['userId'] = $userId;
            $_SESSION['userEmail'] = $user;
            $message = '<p>Uživatel '.$user.' přihlášen</p>';  
            header('location:sprava-archivu.php');
        }else{
            $message = '<p>Uživatel nenalezen. Neplatný e-mail nebo heslo.</p>';
        }   
    }
}
if (isset($_GET['logoff'])){
    session_destroy();
}

?>  
    <body class="bodyLogin">
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
            <div class="hero-unit type01">
               <div class="hero-unit-inner">
                    <div class="login">
                         <h1>Přihlášení</h1>
                         <div class="loginForm"><form action="login.php" method="post">
                              <label for="user">E-mail:</label>
                              <input type="text" id="user" name="user" class="text">
                              <div class="clr"></div>
                              <label for="pass">Heslo:</label>
                              <input type="password" id="pass" name="pass" class="text">
                              <div class="clr"></div>
                              <input type="submit" name="submit" value="OK" class="submit">
                              <div class="clr"></div>
                              <?php echo $message; ?>
                              <p>Pro přihlášení do vašeho účtu zadejte vaše uživatelské jméno a heslo.<br>Pokud se potřebujete zaregistrovat, klikněte na Registrace.</p>
                              <a href="registration.php" class="btn">Registrace</a>
                              <a href="zapomenute-heslo.php" class="btn">Zapomenuté heslo</a>
                         </form></div>
                         <a href="index.html" class="btnHome btnHomeBlack"></a>     
                    </div>                    
                    <div class="clr"></div>
                    
                    <div class="info">
<p><b>Dodržte prosím postup u zálohování/obnovy dat. Za poškození zálohy v důsledku nesprávného 
dodržení postupu neneseme odpovědnost.</b></p>

<p><b>Postup zálohování dat:</b></p>

<p>1) Soubory záloh jsou <b>přenositelné jen mezi stejným typem operačního systému.</b></p>

<p>2) Vždy se <b>před zálohováním ujistěte</b>, že máte na svém zařízení <b>aktuální verzi aplikace Deníku</b> 

pacienta. Kontrolu provede na AppStore nebo Google Play. V případě, že vyšla nová verze, 

updatujte aplikaci. Hned po updatu proveďte zálohu! Zálohy mezi různými verzemi aplikace 

nejsou podporovány a způsobí poškození konzistence archivu a pád aplikace.</p>

<p>3) Proveďte zálohu svých dat.</p>

<p><b>Postup obnovy dat:</b></p>

<p>1) Soubory záloh jsou <b>přenositelné jen mezi stejným typem operačního systému.</b></p>

<p>2) Před <b>obnovou dat se ujistěte</b>, že máte na svém zařízení <b>stejnou verzi aplikace, ze které jste 

provedli poslední zálohu</b>. V případě, že se liší, aktualizujte ji. <b>Verze aplikace</b> na zařízeních 

<b>musí být stejné</b>. Obnova dat mezi různými verzemi aplikace není podporována a způsobí 

poškození konzistence archivu a pád aplikace. Obnova dat z plné verze aplikace do verze Lite 

také není podporována.</p>

<p>3) Proveďte obnovu svých dat.</p>

<p><b>Aplikace umožňuje přenos dat z jednoho zařízení do druhého pomocí funkce zálohování/

obnova (pouze u stejného operačního sytému). Do vybraného zařízení se pak obnovou přenese 

vždy pouze celá poslední vytvořená záloha. Prosím pamatujte, že pro udržení stejného obsahu 

dat na zařízeních není vhodné provádět současně změnu obsahu na každém zařízení. On-line 

synchronizace obsahu mezi zařízeními není možná.</b></p>
                    </div>
                  

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
