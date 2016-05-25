<div class="container">

<div id="immagine">
	<!--<img src="logo.png" style="width:200;">-->
</div>
<form class="form" action=<?php echo $_POST['pagina']; ?> method="POST">
	<h1><?php echo $_POST["h1"];//Titolo pagina ?></h1>
	<h2><?php echo $_POST["h2"];//Genere ?></h2> 
	
	<input type="text" name="genere" id="genere" /><br/></br>
	<input class="button" type="submit" value="Filtra"/>
	
	<h2><?php echo $_POST["h3"];//Genere ?></h2> 
	<input type="text" name="nome" id="nome" /><br/></br>
	<input class="button" type="submit" value="Cerca"/>
	
	<div class="datagrid">
	<table border="1" style="width:100%">
	<thead>
	<tr><!-- riga -->
		<th scope="col">Titolo</th><!-- colonna -->
		<th scope="col">Genere</th><!-- colonna -->
		<th scope="col">Data creazione</th><!-- colonna -->	
		<th scope="col">Link</th><!-- colonna -->	
	 </tr><!-- fine riga -->
	</thead>
	<tbody>
	<?php 
		//Il nome del file datagrid, deriva dal fatto che il div delle tabelle si chiama datagrid
		//Non serve includere la classe dbClass poiché ci pensa già la pagina chiamante, si avrebbe un override
		$el= new elementClass;
		$el->printDatagrid($ar);
	
	?>
	</tbody>
	</table>
	</div>
</form>

</div>
<!-- /.container -->

<!-- jQuery Version 1.11.1 -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>