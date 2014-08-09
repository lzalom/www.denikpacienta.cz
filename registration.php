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

error_reporting(0);
include('inc/db.inc');
include('inc/functions.inc');
$spojeni = mysql_connect($sqlserver, $user, $pwd) or die ('Nelze se spojit s SQL serverem.');
$database = mysql_select_db($dbname, $spojeni) or die ('Chyba pri vyberu databaze.');
mysql_query("set names 'utf8'");

$message = '';

if ($_POST['submit']!=''){
    $error = 0;
    $now = date('Y-m-d G:i:s');
    if (($_POST['phone']=='')||($_POST['user']=='')){
        $message = '<p>Vyplňte všechny položky</p>';
        $error = 1;
    }
    if ($_POST['agree']==''){
        $message = '<p>Musíte souhlasit s podmínkami</p>';
        $error = 1;
    }
    if ($error == 0){
        $phone = unifyPhone($_POST['phone']); 
        $pass = Random_Password(8);
        $passDb = md5($pass);        
        $count = mysql_result(mysql_query("SELECT COUNT(*) FROM users WHERE email = '".$_POST['user']."'"), 0);
        if ($count==0){
            $q = "INSERT INTO users (email, phone, pass, active, date) VALUES ('".$_POST['user']."', '".$phone."', '".$passDb."', 1, '".$now."')";    
            $res = mysql_query($q)OR die(mysql_error()); 
            
            /**/
            define('LOGIN','kapczsms');
            define('PASSWORD','smszkapcz');            
            require_once("./inc/apipost30.php");            
            $apipost = new ApiPost30(LOGIN, PASSWORD);
            $apipost->set_recipient($phone);
            $apipost->set_text("Vase heslo je: ".$pass);
            $apipost->send();

           
            
            $message = '<p>Registrace uložena</p>';  
            header('location:login.php?ok');
        }else{
            $message = '<p>Uživatel s tímto emailem už existuje</p>';
        }
    }
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
            
                    <div class="login agree">
                         <div class="loginForm">
                         <h1>Souhlas se zpracováním osobních údajů.</h1>
<p>Souhlasím se shromažďováním, uchováním a zpracováním osobních údajů obsažených v tomto formuláři správcem KAP CZ, s.r.o. se sídlem Brno, Dolnice 712/10, PSČ 621 00, IČ 25584065, společnost zapsaná v obchodním rejstříku vedeném Krajským soudem v Brně oddíl C, vložka 35670 (příp. jeho zaměstnanci) pro účel stanovený níže. Tento souhlas uděluji pro všechny údaje obsažené v tomto formuláři. Zároveň jsem si vědom/a svých práv podle § 12 a § 21 zákona č. 101/2000 Sb., o&nbsp;ochraně osobních údajů ve znění pozdějších předpisů. Se všemi vyplněnými částmi tohoto formuláře jsem byl/a seznámen/a, všechny údaje jsou přesné a pravdivé a jsou poskytovány dobrovolně.</p>

<p>Dále souhlasím s využíváním shora uvedeného elektronického kontaktu za účelem šíření obchodních sdělení, která budou zahrnovat jak obchodní sdělení týkající se výrobků a služeb společnosti KAP CZ, s.r.o. tak výrobků a služeb třetích stran podle zákona č. 480/2004 Sb., o&nbsp;některých službách informační společnosti ve znění pozdějších předpisů.</p>

<p><strong>Účel zpracování osobních údajů</strong><br>
V souladu s § 5 zákona č. 101/2000 Sb. o ochraně osobních údajů ve znění pozdějších předpisů jsou všechny údaje uvedené v tomto formuláři shromažďovány a zpracovávány výhradně pro účely archivace jeho dat a zasílání obchodních sdělení subjektu údajů prostřednictvím elektronických prostředků podle zákona č. č. 480/2004 Sb., o&nbsp;některých službách informační společnosti ve znění pozdějších předpisů, a to do doby, kdy subjekt údajů přímo a účinně zašle správci na kontaktní adresu denikpacienta@kapcz.cz informaci o tom, že si nepřeje, aby mu byly obchodní informace správcem nadále zasílány. Sumarizované anonymní údaje z tohoto formuláře mohou být použity správcem pro statistické účely a pro vnitřní potřebu správce. Uživatel má kdykoliv možnost na webové stránce aplikace www.denikpacienta.cz svoji registraci zrušit. Tímto bere uživatel na vědomí, že budou nenávratně smazány i jeho zálohy dat.</p>

<p><strong>Prohlášení správce</strong><br>
Správce prohlašuje, že bude shromažďovat osobní údaje v rozsahu nezbytném pro naplnění stanoveného účelu a zpracovávat je pouze v souladu s účelem, k němuž byly shromážděny. Komunikace a archivy osobních dat jsou šifrovány pomocí uživatelova zadaného hesla. Správce v&nbsp;žádném případě nezodpovídá za problémy s daty při komunikaci mezi portálem a aplikací, které mohou vzniknout z důvodu vyšší moci či výpadku připojení poskytovatelů. Zaměstnanci správce nebo jiné fyzické osoby, které zpracovávají osobní údaje na základě smlouvy se správcem a další osoby jsou povinni zachovávat mlčenlivost o&nbsp;osobních údajích, a to i po skončení pracovního poměru nebo prací.</p><span class="text-right"><a href="registration.php">Zpět na registraci</a></span>

                         </div>     
                    </div> 
            
            
               <div class="hero-unit-inner">
                    <div class="login">
                         <h1>Registrace</h1>
                         <div class="loginForm"><form action="registration.php" method="post">
                              <label for="user">Email:</label>
                              <input type="text" id="user" name="user" class="text">
                              <div class="clr"></div>
                              <label for="phone">Telefon: </label>
                              <input type="text" id="phone" name="phone" class="text">
                              <div class="clr"></div>
                              <div>
                                  <input type="checkbox" name="agree" id="agree" checked="checked" style="position:absolute; left:9999px;"> <p style="text-align:right;">Vytvořením registrace souhlasím se <a href="" class="agree">zpracováním osobních údajů</a>.</p>
                                  <div class="clr"></div>
                              </div>
                              <div class="clr"></div>
                              <input type="submit" name="submit" value="OK" class="submit">
                              <div class="clr"></div>
                              <p>Na telefon Vám bude zasláno prvotní přístupové heslo.<br> Můžete si ho po přihlášení změnit.</p>
                              <?php echo $message; ?>
                         </form></div> 
                         <a href="index.html" class="btnHome btnHomeBlack"></a>    
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
  $(document).ready(function(){
    $('a.agree').click(function(){
        $('.login.agree').show();
        return false;
    });
    $('.login.agree a').click(function(){
        $(this).closest('.login.agree').hide();
        return false;
    });
  });
  </script>
        <script>
            var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>
    </body>
</html>
