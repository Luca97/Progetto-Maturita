<?php 

	$_POST["pagina"]="dimenticoPassweord.php"; $_POST["titolo"]="Password dimenticata"; 
	$_POST["src"]="js/chkLogin.js"; include "layout/headEsterni.php";
		
	session_start();	
?>
<body>

    <!-- Navigation -->
    <?php $_POST["pagina"]="dimenticoPassword.php"; include "layout/navbarEsterni.php";?>
    <!-- Page Content -->
    <div class="container">
	
	<div id="immagine">
			<img src="logo.png" style="width: 350px;height: 200px;">
	</div>
	<form class="form" method="post" action="check_dimenticoPassword.php">
			<?php if(isset($_SESSION['errore'])) echo $_SESSION['errore'];
			  if(isset($_SESSION['errore'])) unset($_SESSION['errore']);?>
			<input name="Username" type="text" id="Username" placeholder="Username"/>			
			<input name="email" type="mail" id="email" placeholder="Email"/>
			<input type="submit" name="Submit" value="RECUPERA"/>
			<br/>Torna alla pagina di <a href="login.php">Login</a>
	</form>

    </div>
    <!-- /.container -->

    <!-- jQuery Version 1.11.1 -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
	
</body>
</html><!--Chiude il tag aperto dall'head-->

