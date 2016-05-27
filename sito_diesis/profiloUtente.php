<!-- Head -->
<?php $_POST["utente"]=$_GET["utente"]; $utente=$_GET["utente"]; $_POST["pagina"]="profiloUtente.php?utente=$utente"; 
$_POST["titolo"]="Profilo: ".$_POST['utente']; 
$_POST["src"]=""; 
include "layout/head.php";
		
	include "dbClass.php";
	$db= new dbClass;
	$db->checkSession();
	
	
	$queryUt="SELECT Username, Email,Nome,Cognome FROM users WHERE Username='$utente'";
	$arUt=array();
	$arUt=$db->interroga($queryUt);
	//$db->closeConnection();
	$arUt=$arUt[0];
	$arUt=explode(";",$arUt);
	
	$query=$db->dataGrid();	
	$query=str_replace("Pubblico=1","Pubblico=1 AND Username='$utente'",$query);
	
	$ar=array();
	$ar=$db->interroga($query);
	$db->closeConnection();
	$vInfo=array("Username","Email","Nome","Cognome");
	?>
<body>

    <!-- Navigation -->
    <?php include "layout/navbar.php";?>
	
    <!-- Page Content -->
	<form class="form" action="profiloUtente.php?utente=<?php echo $_POST["utente"];?>" method="POST">
		<h1>Info utente:</h1>
		<?php 
				include "layout/elementClass.php";
				$el= new elementClass;
				$el->table($vInfo,$arUt);
		?>
	</form>
		
	<?php $_POST["h1"]="Biblioteca XML"; $_POST["h2"]="Genere"; $_POST["h3"]="Cerca";include "layout/datagrid.php";?>		
			
	
</body>
</html><!--Chiude il tag aperto dall'head-->

