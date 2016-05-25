<?php 
session_start();
if(isset($_SESSION["username"]))
		echo header("location: manageCr.php");
?>

<?php $_POST["pagina"]="login.php"; $_POST["titolo"]="Login"; $_POST["src"]="js/chkRegistra.js"; include "layout/headEsterni.php";?>

<body>

	
	<!-- Navigation -->
    <?php $_POST["pagina"]="registrazione.php"; include "layout/navbarEsterni.php";?>

    <!-- Page Content -->
    <div class="container">
	
	<div id="immagine">
			<img src="logo.png" style="width: 350px;height: 200px;">
		</div>
		<form class="form" action="chkRegistra.php" method="POST">
			<h3>Username ed email accettati</h3>
			<!--<input type="text" name="username" id="username" placeholder="username" <?php if(isset($_GET["username"])) {
																$username=$_GET['username'];																
																echo "value=$username";}?>><br/></br>
			<input type="text" name="email" id="email" placeholder="email" <?php if(isset($_GET["email"])){
																$email=$_GET['email'];
																echo "value=$email";}?>><br/><br/>-->
			<!--<h4>Inserire password:</h4>--><input type="password" name="password" id="password" placeholder="Scegli una password"/><br/><br/>
			<!--<h4>Conferma password:</h4>--><input type="password" name="confPass" id="confPass" placeholder="Conferma password"/><br/><br/>
			<input id="registrati" type="submit" value="registrati" onclick="return chkRegistra()">
			<br/>Sei gia' iscritto? <a href="login.php">Login!</a>
		</form>
    </div>
    <!-- /.container -->

    <!-- jQuery Version 1.11.1 -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
	
</body>
</html><!--Chiude il tag aperto dall'head-->

