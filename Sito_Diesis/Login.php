<html>
	<head>
		<script type="text/javascript" src="chkLogin.js"></script>
		<link href="style.css" rel="stylesheet">
		<title>login</title>
	</head>
	
	<body>
		<div id="immagine">
			<img src="logo.png" style="width:200;">
		</div>
		<form class="form" action="chkLogin.php" method="POST">
			<h2>LOGIN</h2>
			Nome <input type="text" name="nome" id="nome"/><br/></br>
			Password <input type="password" name="pass" id="pass"/><br/><br/>
			<input class="button" type="submit" value="Login" onclick="return chkLogin();"/>
			<br/>Non sei ancora iscritto? <a href="Registrazione.php">Registrati!</a>
		</form>
	</body>
<html>