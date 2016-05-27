<?php 
session_start();
if(isset($_SESSION["username"]))
		echo header("location: manageCr.php");
?>
		

<?php $_POST["pagina"]="login.php"; $_POST["titolo"]="Login"; $_POST["src"]="js/chkLogin.js"; include "layout/headEsterni.php";?>


<body>
    <!-- Navigation -->
	 <?php $_POST["pagina"]="login.php"; include "layout/navbarEsterni.php"; ?>

    <!-- Page Content -->
    <div class="container">
	
	<div id="immagine">
			<img src="logo.png" style="width: 350px;height: 200px;">
	</div>
	<form class="form" action="chkLogin.php" method="POST">
			<input type="text" name="username" id="username" placeholder="username"/><br/></br>
			<input type="password" name="password" id="password" placeholder="password"/><br/><br/>
			<input id="login" type="submit" value="Login" onclick="return chkLogin();">
			<br/>Non sei ancora iscritto? <a href="verifica.php">Registrati!</a>
			<br/>Hai dimenticato la password? <a href="dimenticoPassword.php">Recuperala!</a>
	</form>
    </div>
    <!-- /.container -->

    <!-- jQuery Version 1.11.1 -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
	
</body>
</html><!--Chiude il tag aperto dall'head-->
