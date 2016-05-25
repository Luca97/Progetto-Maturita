<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	<script type="text/javascript" src="chkLogin.js"></script>
    <title>Login</title>
	<!--<link href="style.css" rel="stylesheet">-->
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/styleSocial.css" rel="stylesheet">
	
	<script type="text/javascript" src="chkLogin.js"></script>
	<!--<link href="style.css" rel="stylesheet">-->
	<title>Area utente</title>
    
	<!-- Custom CSS -->
    <style>
    body {
        padding-top: 70px;
        /* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
    }
    </style>
	
	<?php
	session_start();
	include "dbClass.php";
	$db= new dbClass;
	$select=array("Username","Email","Password");
	$query="SELECT Username,Email FROM Users WHERE Username='".$_SESSION["username"]."' ORDER BY Username";
	$ar=array();
	$ar=$db->interroga($query);
	$db->closeConnection();
	$ar=$ar[0];
	$ar=explode(";",$ar);
	?>
<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Diesis#</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#">About</a>
                    </li>
                    <li>
                        <a href="#">Home</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>
					<li>
						<a href="cambiaPassword.php">Cambia password</a>
					</li>
					<li>
						<a href="cambiaEmail.php">Cambia email</a>
					</li>
					<li>
						<a href="visualizza.php">Files XML</a>
					</li>
					<li>
						<a href="#">Social</a>
					</li>
					<li>
						<a href="login.php">Logout</a>
					</li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
	
	<div class="container">
		<form id="search" action="chkSocial.php" method="post">
				<fieldset>
					<legend>Cerca nel sito</legend>
					<input type="text" id="search-in" value="cerca nel sito"> 
					<button><img id="imgSearch" src="search1.png" alt="Cerca" title="Avvia la ricerca"></button>
				</fieldset>
		</form>
	</div>