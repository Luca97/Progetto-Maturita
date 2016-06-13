<?php $_POST["pagina"]="contactOut.php"; $_POST["titolo"]="Contatti"; $_POST["src"]=""; include "layout/headEsterni.php";?>


<body>
    <!-- Navigation -->
	<?php include "layout/navbarEsterni.php";?>
    <!-- Page Content -->
    <div class="container">
	
	<div id="immagine">
			<img src="logo.png" style="width: 350px;height: 200px;">
	</div>
	
	<form class="form" action="chkLogin.php" method="POST">
			<h3>Potete contattarci per qualsiasi problema alla mail 
			<a href="mailto:diesis.maturita@gmail.com" style="color:#99FFFF;">diesis.maturita@gmail.com</a></h3> 
	</form>
    </div>
    <!-- /.container -->

    <!-- jQuery Version 1.11.1 -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
	
</body>

</html>