<?
$con = mysql_connect("mysql01.service.rug.nl","s2732947","vishe4phoo");
//$con = mysql_connect("mysql01.service.rug.nl","s2548798","egoh7aengu");
if (!$con) {
die('Could not connect: ' . mysql_error());}
 
mysql_select_db("s2732947", $con);


?>