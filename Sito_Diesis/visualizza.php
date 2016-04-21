<html>
	<head>
		<script type="text/javascript" src="chkLogin.js"></script>
		<link href="style.css" rel="stylesheet">
		<title>Visualizza</title>
	</head>
	<?php
	session_start();
	include "dbClass.php";
	$db= new dbClass;
	$select=array("Username","Email","Password");
	$query="SELECT Titolo,Genere,DataCreazione,Link FROM Files WHERE Username='".$_SESSION["username"]."' ORDER BY Titolo";
	$ar=array();
	$ar=$db->interroga($query);
	$db->closeConnection();
	//$ar=explode(";",$ar);
	?>
	<body>
		<div id="immagine">
			<img src="logo.png" style="width:200;">
		</div>
		<form class="form" action="sezioni.html" method="POST">
			<h2>Area utente</h2>
			<table border="1" style="width:100%">
			<tr><!-- riga -->
				<th>Username:</th><!-- colonna -->
				<td><?php echo $ar[0]; ?></td><!-- colonna -->					
			 </tr><!-- fine riga -->			  
			<tr><!-- riga -->
				<th>Email:</th><!-- colonna -->
				<td><?php echo $ar[1]; ?></td><!-- colonna -->					
			 </tr><!-- fine riga -->
			</table>
			<input class="button" type="submit" value="Login" onclick="return chkLogin();"/>
			<br/><a href="cambiaPassword.php">Cambia password</a>
			<br/><a href="cambiaEmail.php">Cambia email</a>
		</form>
	</body>
<html>