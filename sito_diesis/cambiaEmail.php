<!-- Head -->
<?php $_POST["pagina"]="cambiaEmail.php"; $_POST["titolo"]="Cambia email"; $_POST["src"]=""; include "layout/head.php";

	include "dbClass.php";
	$db= new dbClass;
	$db->checkSession();
		
?>
<body>

    <!-- Navigation -->
    <?php include "layout/navbar.php";?>

    <!-- Page Content -->
    <div class="container">
	
	<div id="immagine">
			<img src="logo.png" style="width: 350px;height: 200px;">
	</div>
	<form class="form" method="post" action="check_cambiaEmail.php">
		<?php if(isset($_SESSION['errore'])) echo $_SESSION['errore'];
			  if(isset($_SESSION['errore'])) unset($_SESSION['errore']);?>
			<input name="Username" type="text" id="Username" placeholder="Username"/>
			<input name="Password" type="password" id="Password" placeholder="Password corrente"/>
			<input name="newEmail" type="mail" id="newEmail" placeholder="Nuova email"/>
			<input type="submit" name="Submit" value="Submit" onclick="return chkNewMail()"/>
	</form>

    </div>
    <!-- /.container -->

    <!-- jQuery Version 1.11.1 -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
	
</body>
</html><!--Chiude il tag aperto dall'head-->

