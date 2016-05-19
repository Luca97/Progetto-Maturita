<?php

session_start(); 
$username = $_REQUEST["username"];
$email = $_REQUEST["email"];

include "dbClass.php";
$db= new dbClass;
$db->chkVerifica($username,$email);
// Check connection


?>