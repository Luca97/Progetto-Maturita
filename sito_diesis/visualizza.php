<?php $_POST["pagina"]="visualizza.php"; $_POST["titolo"]="Miei XML"; $_POST["src"]=""; include "layout/head.php"; include "layout/elementClass.php";

	include "dbClass.php";
	$db= new dbClass;
	$db->checkSession();
	
	$query=$db->dataGrid();
	$username=$_SESSION["username"];
	$query=str_replace("Pubblico=1","Username='$username'",$query);
	//Siccome so che la query varia solo per il valore "Pubblico", lo sostituisco con "Username=..." riciclando il metodo!!
	$ar=array();
	$ar=$db->interroga($query);
	$db->closeConnection();
?>

<body>
    <!-- Navigation -->
    <?php include "layout/navbar.php";?>

    <!-- Page Content -->
    <?php $_POST["h1"]="Miei XML"; $_POST["h2"]="Genere"; $_POST["h3"]="Nome";include "layout/datagrid.php";?>

</body>
</html><!--Chiude il tag aperto dall'head-->
