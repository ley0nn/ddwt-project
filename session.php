<?php
include('config.ini.php');
session_start();
$user_check=$_SESSION['username'];

$ses_sql = mysqli_query($con,"SELECT username FROM account WHERE username='$user_check' ");

$row=mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);

$login_user=$row['username'];

if(!isset($user_check))
{
header("Location: login.php");
}
?>