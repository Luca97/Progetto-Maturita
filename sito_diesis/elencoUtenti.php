<!-- Head -->
<?php $_POST["pagina"]="elencoUtenti.php"; $_POST["titolo"]="Elenco utenti"; $_POST["src"]=""; include "layout/head.php";

	include "dbClass.php";	
	$db= new dbClass;
	$db->checkSession();
	$query="";
	if(isset($_POST["utente"]) && isset($_POST["nomcog"]))
	{
		$utente=$_POST["utente"];
		$nomcog=$_POST["nomcog"];
		$nomcog=str_replace(" ","",$nomcog);
		
		if(strtolower($utente)=="*" || strtolower($utente)=="tutti" || strtolower($utente)=="all" && $nomcog=="" && $utente!="")			
			$query="SELECT Username FROM Users";		
		else
			$query="SELECT Username FROM Users WHERE Username='$utente'";
		if($utente=="" && $nomcog!="")
			$query="SELECT Username FROM Users WHERE concat(nome, cognome) = '$nomcog' OR concat(cognome, nome)= '$nomcog'";
		if($utente!="" && $nomcog!="")
			$query="SELECT Username FROM Users WHERE concat(nome, cognome) = '$nomcog' OR concat(cognome, nome)= '$nomcog' AND Username='$utente'";
	}
	else 	
		$query="SELECT Username FROM Users";
		
	$ar=array();
	$ar=$db->interroga($query);
	$db->closeConnection();
	$vInfo=array("Username","Profilo");
	
	/*select concat(nome, cognome)
		from users 
		where concat(nome, cognome) = "gabrielemorisco" OR concat(nome," ", cognome)= "moriscogabriele"*/

?>
<body>

    <!-- Navigation -->
    <?php include "layout/navbar.php";?>

    <!-- Page Content -->
    <div class="container">
	
	<div id="immagine">
			<!--<img src="logo.png" style="width:200;">-->
		</div>
		<form class="form" action="elencoUtenti.php" method="POST">
			
			<h1>Elenco utenti</h1>
			
			<input type="text" name="utente" id="utente" placeholder="Cerca per username"/><br/></br>
			<input type="text" name="nomcog" id="nomcog" placeholder="Cerca per nome e cognome"/><br/></br>
			<input class="button" type="submit" value="Cerca"/>
			<?php 
				include "layout/elementClass.php";
				$el= new elementClass;
				$el->tableElencoUt($vInfo,$ar);
			?>
		</form>
    </div>
    <!-- /.container -->

    <!-- jQuery Version 1.11.1 -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
	
</body>
</html><!--Chiude il tag aperto dall'head-->

