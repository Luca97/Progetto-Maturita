<?php
	session_start();
	
	if(!isset($_SESSION["username"]))//Se non sei autenticato, non puoi accedere a questa pagine e vieni reindirizzato alla pagina di login
		echo header("location: login.php");
		
	session_unset();
	//session_destroy();
    //session_write_close();
	Header("Location: index.php");
?>