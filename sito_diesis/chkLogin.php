<?php
session_start(); 
$username = $_REQUEST["username"];
$password = $_REQUEST["password"];
$psw = md5($password); //in $psw c'è ora la password criptata.
$_SESSION["username"] = $username;

if (strpos($password, '*') == true | strpos($password, '=') == true) 
{
	header("Location:Login.php");
}
	
	
include "dbClass.php";
$db= new dbClass;
$db->chkLogin($username,$psw);
// Check connection


?>