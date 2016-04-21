<?php
	$db = "diesis";
	$connessione = mysqli_connect("localhost","root","",$db);
	
	if(!$connessione)
	{
		print("<h1 Connessione al server MYSQL fallita</h1>");
		exit;
	}
	
	if(!$db)
	{
		print("<h1>Connessione al database fallita</h1>");
	}
	
	$UsernameRequest=$_POST["Username"];
	$mail=$_POST["email"];
	
	$sql="select Email
			from users
			WHERE Username = '$UsernameRequest'
			";
			
	$Result=mysqli_query($connessione,$sql);
	$Dati= mysqli_fetch_object($Result);
		
		if($Dati->Email!=$mail)
		{
			header("Location:index.php");
			//con il ritorno dell'errore nel form, ancora non so come si fa :|
			break;
		}
	
	if(isset($_POST['Submit']))
	{		
		$newPassword = "newPassword";
		$md5Password = md5($newPassword);
		$oggettoMail = "Password Diesis";
		$testoMail = "La sua password è stata modificata, la sua nuova password è $newPassword";
				
		$sql="UPDATE users
			SET Password = '$md5Password'
			WHERE Username = '$UsernameRequest'
			";
					
		mysqli_query($connessione, $sql);
			
		if ($connessione->query($sql) === TRUE) 
		{
			echo "Record updated successfully";
		} 
		else 
		{
			echo "Error updating record: " . $connessione->error;
		}
		
		mail($mail,$oggettoMail, $testoMail);
		
		header("Location:dimenticoPassword.php");
	}
?>