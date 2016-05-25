<?php $_POST["pagina"]="home.php"; $_POST["titolo"]="Home"; $_POST["src"]=""; include "layout/headEsterni.php";?>

<body background="https://images.alphacoders.com/453/45373.jpg" ><!--align="center" background-repeat="no-repeat" attachment="fixed"--> 
    <!-- Navigation -->
	<?php $_POST["pagina"]="home.php"; include "layout/navbarEsterni.php";?>

    <!-- Page Content -->
    <div class="container">
	
	<div id="immagine">
			<img src="logo.png" style="width: 350px;height: 200px;">
	</div>
	<form class="form" action="chkLogin.php" method="POST">
			<input type="text" name="username" id="username" placeholder="username"/><br/></br>
			<input type="password" name="password" id="password" placeholder="password"/><br/><br/>
			<button>Login</button>
			<br/>Non sei ancora iscritto? <a href="Registrazione.php">Registrati!</a>
	</form>
    <!-- /.container -->

    <!-- jQuery Version 1.11.1 -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
	
</body>

</html>