<?php
	$db = "diesisdb";
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
		$newPassword=md5($_POST["newPassword"]);
		$UsernameRequest=$_POST["Username"];
		$oldPassword=md5($_POST["oldPassword"]);
		
		$sql="select Password
			  from users
			  where Username='$UsernameRequest'";
		
		$Result=mysqli_query($connessione,$sql);
		$Dati= mysqli_fetch_object($Result);
		
		if($Dati->Password!=$oldPassword)
		{
			header("Location:index.php");
			//con il ritorno dell'errore nel form, ancora non so come si fa :|
			break;
		}
		else if(!$oldPassword)
		{
			header("Location:index.php");
			//stessa cosa di sopra
			break;
		}
		
		else if($Dati->Password==$oldPassword)
		{		
			$sql="UPDATE users
				SET Password = '$newPassword'
					WHERE Username = '$UsernameRequest'
				";
					
			mysqli_query($connessione, $sql);
			
				if ($connessione->query($sql) === TRUE) {
					echo "Record updated successfully";
				} else {
					echo "Error updating record: " . $connessione->error;
		}
	}
	header("Location:index.php");
}
?>