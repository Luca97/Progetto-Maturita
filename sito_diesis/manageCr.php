<!-- Head -->
<?php $_POST["pagina"]="manageCr.php"; $_POST["titolo"]="Area utente"; $_POST["src"]=""; include "layout/head.php";

	include "dbClass.php";
	$db= new dbClass;
	$db->checkSession();
	
	$username=$_SESSION["username"];
	$db= new dbClass;
	
	$query="SELECT Username,Email FROM Users WHERE Username='".$username."' ORDER BY Username";
	$ar=array();
	$ar=$db->interroga($query);
	$db->closeConnection();
	$ar=$ar[0];
	$ar=explode(";",$ar);
	$vInfo=array("Username","Email");
?>

<body>

    <!-- Navigation -->
    <?php include "layout/navbar.php";?>
    <!-- Page Content -->
    <div class="container">
	
	<div id="immagine">
			<!--<img src="logo.png" style="width:200;">-->
		</div>
		<form class="form" method="POST">
			<h2>Area utente</h2>
			<?php 
				include "layout/elementClass.php";
				$el= new elementClass;
				$el->table($vInfo,$ar);
			?>
			
		</form>
		
		<form class="form" action="cambiaPassword.php" method="POST">
			<h2>Password</h2>
			<h3>Desideri aggiornarla?</h3>
			<button>Clicca qui!</button>
		</form>
		
		<form class="form" action="cambiaEmail.php" method="POST">
			<h2>Email</h2>
			<h3>Desideri cambiarla?</h3>
			<button>Clicca qui!</button>
		</form>
    </div>
    <!-- /.container -->

    <!-- jQuery Version 1.11.1 -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
	
</body>
</html><!--Chiude il tag aperto dall'head-->

