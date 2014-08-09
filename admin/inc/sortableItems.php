<?php
    error_reporting(0);
    include('db.inc');
    $spojeni = mysql_connect($sqlserver, $user, $pwd) or die ('Nelze se spojit s SQL serverem.');
    $database = mysql_select_db($dbname, $spojeni) or die ('Chyba pri vyberu databaze.');
    mysql_query("set names 'utf8'");     
    

     echo $_GET['data'];
     echo '<br><br><br><br><br>';
    
     parse_str($_GET['data'], $itemsOrder);
    
     echo '<pre>';
     print_r($itemsOrder);
     echo '</pre>';     

    foreach($itemsOrder['item'] as $key => $value){
        mysql_query("UPDATE banners SET sortable = ".$key." WHERE id = ".$value) or die(mysql_error());
    
    }


?>