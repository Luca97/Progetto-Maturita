<?php

class elementClass {

	function tableElencoUT($vInfo,$vDati)//Elenco utenti
	{
		echo "<div class='datagrid'>
				<table border='1' style='width:100%'>			
				<thead>
					<tr><!-- riga -->";
					
			for($i=0;$i<sizeof($vInfo);$i++)
				echo "<th>$vInfo[$i]</th><!-- colonna -->";	
				
				echo"	</tr><!-- fine riga -->
				</thead>
				<tbody>";
				
				$z=0;//Contatore degli elementi
				for($j=0;$j<sizeof($vDati);$j++)
				{
					
					if($j%2==0)
						echo "<tr><!-- riga -->";
					else
						echo "<tr class='alt'><!-- riga -->";
							for($i=0;$i<sizeof($vInfo);$i++)
							{	if($i==0)
									echo "<td>$vDati[$z]</td><!-- colonna -->";	
								else
									echo "<td><a href='profiloUtente.php?utente=$vDati[$z]'>Profilo di $vDati[$z]</a></td><!-- colonna -->";	
							}
						echo "</tr><!-- fine riga -->";
						$z++;
				}
		echo "	</tbody>
				</table>
			</div>";
	}
	
	function table($vInfo,$vDati)//Credenziali
	{
		echo "<div class='datagrid'>
				<table border='1' style='width:100%'>			
				<thead>
					<tr><!-- riga -->";
					
			for($i=0;$i<sizeof($vInfo);$i++)
				echo "<th>$vInfo[$i]</th><!-- colonna -->";	
				
				echo"	</tr><!-- fine riga -->
				</thead>
				<tbody> 
				<tr><!-- riga -->";
					
			for($i=0;$i<sizeof($vInfo);$i++)
				echo "<td>$vDati[$i]</td><!-- colonna -->";
		   echo "</tr><!-- fine riga -->
				</tbody>
				</table>
			</div>";
	}
	
	function printDatagrid($ar)//5 colonne
	{
	
	for($i=0;$i<sizeof($ar);$i++)//Eseguo un cicloo fro in cui stampo ogni file nella tabella
	{
		$riga=explode(";",$ar[$i]);//ogni elemento di ar è un file convertito in stringa, ad ogni ";"
		//corrisponde un attributo del file
		if($i%2==0)//Se la colonna è dispari la riga sara bianca altrimenti azzurrina
			echo "<tr><!-- riga -->";
		else
			echo "<tr class='alt'><!-- riga -->";
				for($j=0;$j<sizeof($riga);$j++)//Stampo tutti gli elementi del file
				{
					if($j==3)
						echo "<td><a href=".$riga[$j].">".$riga[$j]."</a></td>";//se i==3 è il link
					else
						echo "<td>".$riga[$j]."</td>";
				}	
		echo " </tr><!-- fine riga -->";
	}
	
	}

}

?>