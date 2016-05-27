<div class="container">

<div id="immagine">
	<!--<img src="logo.png" style="width:200;">-->
</div>
<form class="form" action=<?php echo $_POST['pagina']; ?> method="POST">
	<h1><?php echo $_POST["h1"];//Titolo pagina ?></h1>
	<h2><?php echo $_POST["h2"];//Genere ?></h2> 
	
	<!--Non serve includere la classe elementClass poiché ci pensa già la pagina chiamante, si avrebbe un override-->
	<?php $db1 = new dbClass; $el= new elementClass; $el->printSelect($db1); ?>
	<input class="button" type="submit" value="Filtra"/>
	
	<h2><?php echo $_POST["h3"];//Titolo ?></h2> 
	<input type="text" name="nome" id="nome" /><br/></br>
	<input class="button" type="submit" value="Cerca"/>
	
	<?php 
		//Il nome del file datagrid, deriva dal fatto che il div delle tabelle si chiama datagrid
		//Non serve includere la classe elementClass poiché ci pensa già la pagina chiamante, si avrebbe un override
		$vInfo2=array("Titolo","Genere","Data creazione","Link","Autore");
		
		if(isset($_POST["utente"]) || $_POST['pagina']=="visualizza.php")//Vuol dire che la pagina chiamante è profiloUtente.php quindi non stampo l'autore
			$vInfo2=array("Titolo","Genere","Data creazione","Link");
		else
			$vInfo2=$vInfo2;
		
		$el->printDatagrid($vInfo2,$ar);
	
	?>

</div>
<!-- /.container -->

<!-- jQuery Version 1.11.1 -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>