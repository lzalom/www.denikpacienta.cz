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

if ($_POST['submit']!=''){    
    if ($_POST['user']==''){
        $message = '<p>Vyplňte všechny položky</p>';
    }else{    
        $pass = Random_Password(8);
        //echo $pass;
        $passDb = md5($pass);  
        $count = mysql_result(mysql_query("SELECT COUNT(*) FROM users WHERE email = '".$_POST['user']."' AND active = 1"), 0);
        if ($count!=0){
            $q = "UPDATE users SET pass = '".$passDb."' WHERE email = '".$_POST['user']."'";
            $res = mysql_query($q);                        
            $to      = $_POST['user'];
            $subject = 'Zapomenuté heslo z www.denikpacienta.cz';
            $message = 'Vase nove heslo je: '.$pass;
            
                require "inc/class.phpmailer.php";
                $mail             = new PHPMailer();
                                
                $mail->SetLanguage("cz");
                //$body             = file_get_contents('contents.html');
                //$body             = eregi_replace("[\]",'',$body);
                
                $mail->IsSMTP(); // telling the class to use SMTP
                $mail->Host       = "192.168.2.253"; // SMTP server
                $mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
                                                           // 1 = errors and messages
                                                           // 2 = messages only
                
                $mail->SetFrom('webmaster@denikpacienta.cz', 'denikpacienta.cz');
                
                $mail->AddReplyTo("webmaster@denikpacienta.cz","denikpacienta.cz");
                
                $mail->Subject    = "Zapomenute heslo z www.denikpacienta.cz";
                
                $mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
                
                $mail->MsgHTML($message);
                
                $address = $_POST['user'];
                $mail->AddAddress($address, $address);
                
                if(!$mail->Send()) {
                  echo "Mailer Error: " . $mail->ErrorInfo;
                } else {
                  echo "Message sent!";
                }
            
            /* 
            $headers = 'From: webmaster@denikpacienta.cz' . "\r\n" .
                'Reply-To: webmaster@denikpacienta.cz' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();
            mail($to, $subject, $message, $headers);
            */
            $message = '<p>Heslo odesláno na adresu '.$_POST['user'].'</p>';  
            header('location:login.php?newPassword');
            
        }else{
            $message = '<p>Uživatel nenalezen.</p>';
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
               <div class="hero-unit-inner">
                    <div class="login">
                         <h1> Zaslání zapomenutého hesla</h1>
                         <div class="loginForm"><form action="zapomenute-heslo.php" method="post">
                              <label for="user">E-mail:</label>
                              <input type="text" id="user" name="user" class="text">
                              <div class="clr"></div>
                              <input type="submit" name="submit" value="OK" class="submit">
                              <div class="clr"></div>
                              <?php echo $message; ?>
                              <p> Zadejte e-mail, pod kterým jste na www.denikpacienta.cz provedli registraci. <br>
                              Na tento bude vygenerováno nové přístupové heslo.<br>
Doporučujeme jej následně v sekci Správa osobních dat změnit. <br>
V případě problémů nás neváhejte kontaktovat.</p>
                              
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
            var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>
    </body>
</html>
