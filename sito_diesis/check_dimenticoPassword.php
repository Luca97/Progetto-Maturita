<?php
	
	include "dbClass.php";
	$db= new dbClass;	
	$UsernameRequest=$_POST["Username"];
	$email=$_POST["email"];	
	$db->check_dimenticoPassword($UsernameRequest,$email);	
	
?>