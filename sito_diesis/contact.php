<?php $_POST["pagina"]="contact.php"; $_POST["titolo"]="Contatti"; $_POST["src"]=""; include "layout/headEsterni.php";?>


<body>
    <!-- Navigation -->
	<?php $_POST["pagina"]="contact.php"; include "layout/navbarEsterni.php";?>
    <!-- Page Content -->
    <div class="container">
	
	<div id="immagine">
			<img src="logo.png" style="width: 350px;height: 200px;">
	</div>
	<form class="contact" action="chkLogin.php" method="POST">
			<h1><font color="#5ED6FD">Contatti: noreply.diesis@gmail.com</font></h1>
	</form>
    </div>
    <!-- /.container -->

    <!-- jQuery Version 1.11.1 -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
	
</body>

</html>