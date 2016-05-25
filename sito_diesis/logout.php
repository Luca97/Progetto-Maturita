<?php
	include "dbClass.php";
	$db= new dbClass;
	$db->checkSession();
		
	session_unset();
	//session_destroy();
    //session_write_close();
	Header("Location: index.php");
?>