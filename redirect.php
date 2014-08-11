<?php
error_reporting(0);
include('inc/db.inc');
include('inc/variables.inc');
$spojeni = mysql_connect($sqlserver, $user, $pwd) or die ('Nelze se spojit s SQL serverem.');
$database = mysql_select_db($dbname, $spojeni) or die ('Chyba pri vyberu databaze.');
mysql_query("set names 'utf8'");

$x = mysql_query("SELECT * FROM banners WHERE id = ".$_GET['banner']);
while ($y = mysql_fetch_array($x)){
	header('location:http://'.$y['url']);
}



?>