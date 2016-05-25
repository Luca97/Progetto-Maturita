<!-- Head -->
<?php $_POST["pagina"]="cambiaPassword.php"; $_POST["titolo"]="Camia password"; $_POST["src"]=""; include "layout/head.php";

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
	<form class="form" method="post" action="check_cambiaPassword.php">
		<?php if(isset($_SESSION['errore'])) echo $_SESSION['errore'];
			  if(isset($_SESSION['errore'])) unset($_SESSION['errore']);?>
			<h2>Username:</h2>
			<input name="Username" type="text" id="Username"/>
			<h2>Password corrente:</h2>
			<input name="oldPassword" type="password" id="oldPassword"/>
			<h2>Nuova password:</h2>
			<input name="newPassword" type="password" id="newPassword"/>
			<h2>Inserire nuovamente la nuova password:</h2>
			<input name="newPasswordRepeat" type="password" id="newPasswordRepeat"/>
			<input type="submit" name="Submit" value="Submit"/>
	</form>

    </div>
    <!-- /.container -->

    <!-- jQuery Version 1.11.1 -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
	
</body>
</html><!--Chiude il tag aperto dall'head-->

