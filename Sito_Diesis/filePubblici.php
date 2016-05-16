<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	<script type="text/javascript" src="chkLogin.js"></script>
    <title>Login</title>
	<!--<link href="style.css" rel="stylesheet">-->
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	
	<script type="text/javascript" src="chkLogin.js"></script>
	<!--<link href="style.css" rel="stylesheet">-->
	<title>File Xml</title>
    
	<!-- Custom CSS -->
    <style>
    body {
        padding-top: 70px;
        /* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
    }
    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<?php
	//Mettere un if per il controllo della login 
	session_start();
	include "dbClass.php";
	$db= new dbClass;
	$select=array("Username","Email","Password");
	
	
	
		
	if(isset($_POST["genere"]))
	{
		$genere=$_POST["genere"];
		
		if(strtolower($genere)=="*" || strtolower($genere)=="tutti" || strtolower($genere)=="all")			
			$query="SELECT Username,Titolo,Genere,DataCreazione,Link FROM Files WHERE Pubblico=TRUE ORDER BY Titolo";
		else
			$query="SELECT Username,Titolo,Genere,DataCreazione,Link FROM Files WHERE Pubblico=TRUE AND '".$genere."'ORDER BY Titolo";
	}
	else
		$query="SELECT Username,Titolo,Genere,DataCreazione,Link FROM Files WHERE Pubblico=TRUE ORDER BY Titolo";

	
	$ar=array();
	$ar=$db->interroga($query);
	$db->closeConnection();
	?>
<body>

    <!-- Navigation -->
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
                <a class="navbar-brand" href="#">Diesis#</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#">About</a>
                    </li>
                    <li>
                        <a href="#">Home</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>
					<li>
						<a href="cambiaPassword.php">Cambia password</a>
					</li>
					<li>
						<a href="cambiaEmail.php">Cambia email</a>
					</li>
					<li>
						<a href="visualizza.php">Miei XML</a>
					</li>
					<li>
						<a href="logout.php">Logout</a>
					</li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">
	
	<div id="immagine">
			<!--<img src="logo.png" style="width:200;">-->
		</div>
		<form class="form" action="filePubblici.php" method="POST">
			<h2>File Xml</h2>
			Genere <input type="text" name="genere" id="genere" required /><br/></br>
			<input class="button" type="submit" value="Filtra"/>
			<table border="1" style="width:100%">
			<tr>
				<th colspan="5">Files</th>
			</tr>
			<tr><!-- riga -->
				<th>Username</th>
				<th>Titolo</th><!-- colonna -->
				<th>Genere</th><!-- colonna -->
				<th>Data creazione</th><!-- colonna -->	
				<th>Link</th><!-- colonna -->	
			 </tr><!-- fine riga -->
			<?php 
			for($i=0;$i<sizeof($ar);$i++)//Eseguo un cicloo fro in cui stampo ogni file nella tabella
			{
				$riga=explode(";",$ar[$i]);//ogni elemento di ar è un file convertito in stringa, ad ogni ";"
				//corrisponde un attributo del file
				echo "<tr><!-- riga -->";
						for($j=0;$j<sizeof($riga);$j++)//Stampo tutti gli elementi del file
						{
							if($j==3)
								echo "<th><a href=".$riga[$j].">".$riga[$j]."</a></th>";//se i==3 è il link
							else
								echo "<th>".$riga[$j]."</th>";
						}	
				echo " </tr><!-- fine riga -->";
			
			}
			
			?>
			</table>
		</form>
	
       <!-- <div class="row">
            <div class="col-lg-12 text-center">
                <h1>A Bootstrap Starter Template</h1>
                <p class="lead">Complete with pre-defined file paths that you won't have to change!</p>
                <ul class="list-unstyled">
                    <li>Bootstrap v3.3.6</li>
                    <li>jQuery v1.11.1</li>
                </ul>
            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- jQuery Version 1.11.1 -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
	
</body>

</html>
