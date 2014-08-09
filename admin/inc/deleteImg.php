<?php
    //error_reporting(0);
    include('db.inc');
    include('variables.inc');
    $spojeni = mysql_connect($sqlserver, $user, $pwd) or die ('Nelze se spojit s SQL serverem.');
    $database = mysql_select_db($dbname, $spojeni) or die ('Chyba pri vyberu databaze.');
    mysql_query("set names 'utf8'");     
    
    if (isset($_POST['deleteImg'])){
        $x = mysql_query("SELECT * FROM images WHERE id = ".$_POST['imgId']);
        while ($y = mysql_fetch_array($x)){
            $image = substr($y['name'], 1, -1);
            unlink($rootPath.'/admin/server/php/files/'.$image);
            unlink($rootPath.'/admin/server/php/files/thumbnail/'.$image);
            mysql_query("DELETE FROM images WHERE id = ".$_POST['imgId']);  
            //echo $rootPath;
            //echo $image;
        }  
    }



?>