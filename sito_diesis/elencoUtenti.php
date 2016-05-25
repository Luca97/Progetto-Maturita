<!-- Head -->
<?php $_POST["pagina"]="elencoUtenti.php"; $_POST["titolo"]="Elenco utenti"; $_POST["src"]=""; include "layout/head.php";

	include "dbClass.php";	
	$db= new dbClass;
	$db->checkSession();
	
	if(isset($_POST["utente"]))
	{
		$utente=$_POST["utente"];
		
		if(strtolower($utente)=="*" || strtolower($utente)=="tutti" || strtolower($utente)=="all")			
			$query="SELECT Username FROM Users";		
		else
			$query="SELECT Username FROM Users WHERE Username='$utente'";
	}
	else 	
		$query="SELECT Username FROM Users";
		
	$ar=array();
	$ar=$db->interroga($query);
	$db->closeConnection();
	$vInfo=array("Username","Profilo");
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
			<h2>Nome utente:</h2> 
			
			<input type="text" name="utente" id="utente" required /><br/></br>
			<input class="button" type="submit" value="Filtra"/>
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

