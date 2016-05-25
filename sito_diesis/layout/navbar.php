<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand">Diesis#</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <?php 
					
					  $link=array("about.php","home.php","contact.php","visualizza.php","biblioteca.php","elencoUtenti.php","manageCr.php","logout.php");
					  $link2=array("About","Home","Contatti","Miei XML","Biblioteca XML","Elenco/Ricerca utenti","Area utente","Logout");
					  
					  $pagina=$_POST["pagina"];
					
					  for($i=0;$i<sizeof($link);$i++)
					  {
						if($pagina==$link[$i])
							$i=$i;//Non fare nulla
						else
						   echo "<li>
									<a href=$link[$i]>$link2[$i]</a>
								</li>";
					  }
					?>
					 
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
 </nav>