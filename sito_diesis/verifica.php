<?php 
session_start();
if(isset($_SESSION["username"]))
		echo header("location: manageCr.php");
?>
<?php $_POST["pagina"]="verifica.php"; $_POST["titolo"]="Verifica credenziali"; $_POST["src"]="js/chkVerifica.js"; include "layout/headEsterni.php";?>

<body>
    <!-- Navigation -->
	 <?php $_POST["pagina"]="verifica.php"; include "layout/navbarEsterni.php";?>

    <!-- Page Content -->
    <div class="container">
	
	<div id="immagine">
			<img src="logo.png" style="width: 350px;height: 200px;">
	</div>
	<form class="form" action="chkVerifica.php" method="POST">
			<?php if(isset($_GET["errore"])){ // Eseguo il controllo degli errori, ad ognuno di essi corrisponde un messaggio per l'utente
					if($_GET["errore"]==1)
						echo "<font>Username non disponibile.</font>";
					else if($_GET["errore"]==2)
						echo "<font>Email già registrata!</font></br></br>
							 <font>Se sei già registrato, <a href='recuperoCredenziali.php'>recupera le tue credenziali!</a></font>";
					else if($_GET["errore"]==3)
						echo "<font>Username ed email non disponibili.</font>";
					
					}
			?>
			<h3>Verifica disponibilità</h3>
			<input type="text" name="username" id="username" placeholder="username"/><br/></br>
			<input type="text" name="email" id="email" placeholder="example@example.com"/><br/><br/>
			<input id="registrati" type="submit" value="registrati" onclick="return chkVerifica()">
			<br/>Sei già iscritto? <a href="login.php">Effettua il login!</a>
	</form>
    </div>
    <!-- /.container -->

    <!-- jQuery Version 1.11.1 -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
	
</body>
</html><!--Chiude il tag aperto dall'head-->
