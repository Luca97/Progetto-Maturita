<?php  
// file scrivifile.php 
include "dbClass.php";

$username = $_REQUEST["username"];
$password = $_REQUEST["password"];
$email = $_REQUEST["email"];
$psw = md5($password); //in $psw c'� ora la password criptata.
$db= new dbClass;
$db->chkRegistra($username,$psw,$email);


?>