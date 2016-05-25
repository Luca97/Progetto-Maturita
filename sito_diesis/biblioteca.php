<!-- Head -->
<?php $_POST["pagina"]="biblioteca.php"; $_POST["titolo"]="Biblioteca"; $_POST["src"]=""; include "layout/head.php"; include "layout/elementClass.php";
	include "dbClass.php";
	
	$db= new dbClass;
	$db->checkSession();
	$query=$db->dataGrid();
	
	$ar=array();
	$ar=$db->interroga($query);
	$db->closeConnection();
?>
<body>
    <!-- Navigation -->
    <?php include "layout/navbar.php";?>

    <!-- Page Content -->
    <?php 
		$_POST["h1"]="Biblioteca XML"; $_POST["h2"]="Genere"; 
		$_POST["h3"]="Nome"; include "layout/datagrid.php";
	?>

</body>

</html><!--Chiude il tag aperto dall'head-->
