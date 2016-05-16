<?php
	include "dbClass.php";
	$db= new dbClass;
	
	if(isset($_POST['Submit']))
		{
			$Password=md5($_POST["Password"]);
			$UsernameRequest=$_POST["Username"];
			$newEmail=$_POST["newEmail"];
			$db->check_cambiaEmail($UsernameRequest,$Password,$newEmail);
		}	
?>