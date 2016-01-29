<?
//Establish connection with database
$con = mysql_connect("mysql01.service.rug.nl","s2732947","vishe4phoo");
if (!$con) {
die('Could not connect: ' . mysql_error());}
 
mysql_select_db("s2732947", $con);


?>