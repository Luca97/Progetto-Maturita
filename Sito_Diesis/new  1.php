<html>
	<head>
		<script type="text/javascript" src="chkLogin.js"></script>
		<link href="style.css" rel="stylesheet"/>
		<title>Visualizza</title>
	</head>
	<?php
	session_start();
	include "dbClass.php";
	$db= new dbClass;
	$select=array("Username","Email","Password");

	if(isset($_POST["genere"]))
		$query="SELECT Titolo,Genere,DataCreazione,Link FROM Files WHERE Username='".$_SESSION["username"]."' AND Genere='".$_POST["genere"]."' ORDER BY Titolo";
	else
		$query="SELECT Titolo,Genere,DataCreazione,Link FROM Files WHERE Username='".$_SESSION["username"]."' ORDER BY Titolo";

	
	$ar=array();
	$ar=$db->interroga($query);
	$db->closeConnection();
	?>
	<body>
		<div id="immagine">
			<img src="logo.png" style="width:200;">
		</div>
		<form class="form" action="visualizza.php" method="POST">
			<h2>File Xml</h2>
			Genere <input type="text" name="genere" id="genere" required /><br/></br>
			<input class="button" type="submit" value="Filtra"/>
			<table border="1" style="width:100%">
			<tr>
				<th colspan="4">Files</th>
			</tr>
			<tr><!-- riga -->
				<th>Titolo</th><!-- colonna -->
				<th>Genere</th><!-- colonna -->
				<th>Data creazione</th><!-- colonna -->	
				<th>Link</th><!-- colonna -->	
			 </tr><!-- fine riga -->
			<?php 
			for($i=0;$i<sizeof($ar);$i++)//Eseguo un cicloo fro in cui stampo ogni file nella tabella
			{
				$riga=explode(";",$ar[$i]);//ogni elemento di ar è un file convertito in stringa, ad ogni ";"
				//corrisponde un attributo del file
				echo "<tr><!-- riga -->";
						for($j=0;$j<sizeof($riga);$j++)//Stampo tutti gli elementi del file
						{
							if($j==3)
								echo "<th><a href=".$riga[$j].">".$riga[$j]."</a></th>";//se i==3 è il link
							else
								echo "<th>".$riga[$j]."</th>";
						}	
				echo " </tr><!-- fine riga -->";
			
			}
			
			?>
			</table>
			<br/><a href="cambiaPassword.php">Cambia password</a>
			<br/><a href="cambiaEmail.php">Cambia email</a>
			<br/><a href="manageCr.php">Area utente</a>
			<br/><a href="login.php">Logout</a>
		</form>
	</body>
<html>