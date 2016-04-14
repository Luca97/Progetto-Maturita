<html>
	<head>
		<link href="style.css" rel="stylesheet">
		<script type="text/javascript" src="chkRegistra.js"></script>
		<title>Registrazione</title>
	</head>
	
	<body>
		<form class="form" action="chkRegistra.php" method="POST">
			<h2>REGISTRAZIONE</h2>
			Username <input type="text" name="nome" id="nome"/><br/></br>
			Email <input type="text" name="email" id="email"/><br/><br/>
			Password <input type="password" name="pass" id="pass"/><br/><br/>
			Conferma Password <input type="password" name="confPass" id="confPass"/><br/><br/>
			<input class="button" type="submit" value="Registrati" onclick="return chkRegistra();"/>
			<br/>Sei gia' iscritto? <a href="login.php">Login!</a>
		</form>
	</body>
<html>