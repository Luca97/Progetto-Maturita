<?php

	include "dbClass.php";
	$db= new dbClass;
	
	if(isset($_POST['Submit']))
	{
		$newPassword=md5($_POST["newPassword"]);
		$UsernameRequest=$_POST["Username"];
		$oldPassword=md5($_POST["oldPassword"]);
		$secondNewPassword=md5($_POST["newPasswordRepeat"]);
		$db->check_cambiaPassword($newPassword,$UsernameRequest,$oldPassword,$secondNewPassword);
	}	
		
?>