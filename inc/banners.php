<?php
error_reporting(0);
include('db.inc');
include('variables.inc');
$spojeni = mysql_connect($sqlserver, $user, $pwd) or die ('Nelze se spojit s SQL serverem.');
$database = mysql_select_db($dbname, $spojeni) or die ('Chyba pri vyberu databaze.');
mysql_query("set names 'utf8'");

    $today = date('Y-m-d');
    $today_time = strtotime($today);    
    
    $banners = '';
    $x = mysql_query("SELECT * FROM banners WHERE active = 1 AND UNIX_TIMESTAMP(start) <= '".$today_time."' AND UNIX_TIMESTAMP(end) >= '".$today_time."' ORDER BY sortable ASC");
    while ($y = mysql_fetch_array($x)){
      //$banners = $banners.'{ "file1": "'.$y['file1'].'", "file2": "'.$y['file2'].'", "url": "http://'.$y['url'].'", "duration": '.$y['duration'].'},';  
      $banners = $banners.'{ "file1": "'.$y['file1'].'", "file2": "'.$y['file2'].'", "file3": "'.$y['file3'].'", "file4": "'.$y['file4'].'", "url": "http://www.denikpacienta.cz/redirect.php?banner='.$y['id'].'", "duration": '.$y['duration'].'},';  
    }
    $banners = substr($banners, 0, -1);
    echo '[ '.$banners.' ]';

?>