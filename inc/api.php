<?php
error_reporting(0);
include('db.inc');
include('variables.inc');
$spojeni = mysql_connect($sqlserver, $user, $pwd) or die ('Nelze se spojit s SQL serverem.');
$database = mysql_select_db($dbname, $spojeni) or die ('Chyba pri vyberu databaze.');
mysql_query("set names 'utf8'");

if ($_GET['action']=='binUpload'){
    /*
    echo '<pre>';
    var_dump($_GET);
    var_dump($_POST);
    var_dump($_FILES);
    echo '</pre>';
    */
    $now = date('Y-m-d H:i:s'); 
    $x = mysql_query("SELECT * FROM users WHERE email = '".$_GET['username']."'");
    while($y=mysql_fetch_array($x)){
        $userId = $y['id'];
        if ($y['pass']==$_GET['password']){
            if (isset($_FILES['bin'])){   
                $filename = $userId."-".$_GET['datetime'].".bin";
                move_uploaded_file($_FILES["bin"]["tmp_name"],
                $rootPath."/bin/".$filename);
                mysql_query("INSERT INTO bins (file, date, user, os)
                            VALUES ('".$filename."', '".$now."', ".$userId.", '".$_GET['os']."') ");
                echo 'OK';
            }else{                
                echo 'API: Nebyl nahrán soubor';
            }
        }else{
            echo 'API: Chybné heslo';
        }
    }
}

if ($_GET['action']=='binDownload'){
    $now = date('Y-m-d H:i:s'); 
    $x = mysql_query("SELECT * FROM users WHERE email = '".$_GET['username']."'");
    while($y=mysql_fetch_array($x)){
        $userId = $y['id'];
        if ($y['pass']==$_GET['password']){
            if ($_GET['os']=='Android'){
                $bin = mysql_query("SELECT * FROM bins WHERE user = ".$userId." AND os = 'Android' ORDER BY id DESC LIMIT 0,1");
            }
            if ($_GET['os']=='Ios'){
                $bin = mysql_query("SELECT * FROM bins WHERE user = ".$userId." AND os = 'Ios' ORDER BY id DESC LIMIT 0,1");
            }
            if ($_GET['os']==''){
                $bin = mysql_query("SELECT * FROM bins WHERE user = ".$userId." AND os = 'Ios' ORDER BY id DESC LIMIT 0,1");
            }
            while($binArr = mysql_fetch_array($bin)){
                echo "http://denikpacienta.cz/bin/".$binArr['file'];
            }
        }else{
            echo 'API: Chybné heslo';
        }
    }
}

?>