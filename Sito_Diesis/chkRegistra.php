<?php  
// file scrivifile.php 

$username = $_REQUEST["username"];
$password = $_REQUEST["password"];
$email = $_REQUEST["email"];
$psw = md5($password); //in $psw c'è ora la password criptata.

include "dbClass.php";
$db= new dbClass;
$db->chkRegistra($username,$psw,$email);


?>