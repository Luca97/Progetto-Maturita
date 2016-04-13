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
	
	if(isset($_POST['Submit']))
	{
		$Password=md5($_POST["Password"]);
		$UsernameRequest=$_POST["Username"];
		$newEmail=$_POST["newEmail"];
		
		$sql="select email, Password
			  from users
			  where Username='$UsernameRequest'";
		
		$Result=mysqli_query($connessione,$sql);
		$Dati= mysqli_fetch_object($Result);
		
		if($Dati->Password!=$Password)
		{
			header("Location:cambiaEmail.php");
			//con il ritorno dell'errore nel form, ancora non so come si fa :|
			break;
		}
		else if(!$Password || !$newEmail)
		{
			header("Location:cambiaEmail.php");
			//stessa cosa di sopra
			break;
		}
		
		else if($Dati->Password==$Password)
		{		
			$sql="UPDATE users
				SET Email = '$newEmail'
					WHERE Username = '$UsernameRequest'
				";
					
			mysqli_query($connessione, $sql);
			
				if ($connessione->query($sql) === TRUE) {
					echo "Record updated successfully";
				} else {
					echo "Error updating record: " . $connessione->error;
		}
	}
	header("Location:cambiaEmail.php");
}
?>