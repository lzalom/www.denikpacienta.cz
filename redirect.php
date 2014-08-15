<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Deník, bannery - redirect</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="js/jquery-1.7.1.min.js"></script>
  </head>
  <body>

<?php
error_reporting(0);
include('inc/db.inc');
include('inc/variables.inc');
$spojeni = mysql_connect($sqlserver, $user, $pwd) or die ('Nelze se spojit s SQL serverem.');
$database = mysql_select_db($dbname, $spojeni) or die ('Chyba pri vyberu databaze.');
mysql_query("set names 'utf8'");

$x = mysql_query("SELECT * FROM banners WHERE id = ".$_GET['banner']);
while ($y = mysql_fetch_array($x)){
	//header('location:http://'.$y['url']);
	echo '<script>var targetUrl = "http://'.$y['url'].'"; </script>';
}
?>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
 
  ga('create', 'UA-41377096-1', 'auto');
  ga('send', 'pageview'); 

	window.setTimeout(function(){
	    window.location=targetUrl;
	},1500);

</script>

  	<p>Redirecting...</p>



  </body>
</html>