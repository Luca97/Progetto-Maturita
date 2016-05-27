<?php  
// file scrivifile.php 
include "dbClass.php";
session_start();
$username = $_SESSION["newUser"];
$password = $_REQUEST["password"];
$nome = $_REQUEST["nome"];
$cognome = $_REQUEST["cognome"];
$email = $_SESSION["newMail"];
$psw = md5($password); //in $psw c'è ora la password criptata.
$db= new dbClass;
$db->chkRegistra($username,$psw,$email,$nome,$cognome);


?>