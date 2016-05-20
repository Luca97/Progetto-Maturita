<?php
class dbClass {
	
	private  $con;//Connessione al db
	
	public function __construct() 
	{
	   $this->openConnection();
	}
	
	public function openConnection()
	{
		
		$this->con=mysqli_connect("localhost","root","","diesis");//Setto la connessione col db in modo tale che lavori sul db 5a_Morisco_DBcinema
	   // Check connection
		if (mysqli_connect_errno())
		  {
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		  }
	
	}
	
	public function getCon()
	{
		return $this->con;
	}
	public function closeConnection()
	{
		
		mysqli_close($this->con);
	
	}
	
	public function interroga($query)
	{
	$righe=array();
	$i=0;
	//$query="SELECT Username,Email,Password FROM Users WHERE Username='whmori' ORDER BY Username";

	if ($result=mysqli_query($this->con,$query))
	{	
		
	  // Fetch one and one row
		while ($row=mysqli_fetch_row($result))//Mentre esiste una riga, quindi la fetch contiene una risposta all'interrogazione
		//Il ciclo stampa il suo contenuto, $row è un vettore di righe
		{
			//printf ("%s (%s)\n",$row[0],$row[1]);
			$righe[$i]=implode(";",$row);
			$i++;
		}
	  // Free result set
	  mysqli_free_result($result);//Libera la var result
	  $i=0;
	  return $righe;
	}
	
	else
		return
			$errore= "Failed to connect to MySQL: ";
	}
	
	public function chkLogin($username,$psw)
	{
		if ($this->con->connect_error) 
		{
			die("Connection failed: " . $this->con->connect_error);
		} 



		 // username and password received from loginform 
			$username=mysqli_real_escape_string($this->con,$username); 
			$password=mysqli_real_escape_string($this->con,$psw); 
			$sql_query="SELECT * FROM users WHERE username='$username' and password='$psw'"; 
			$result=mysqli_query($this->con,$sql_query); 
			$row=mysqli_fetch_array($result,MYSQLI_ASSOC); 
			$count=mysqli_num_rows($result);// If result matched $username and $password, table row must be 1 row 
			
			if($count==1) 
			{ 
				// session_start();
				// $_SESSION['username']=$username; 
				header("location: manageCr.php"); 
			} 
			else 
			{ 
				//$error="Username or Password is invalid"; 
				header("location: index.php");
			} 
		//And now in body part of this page we have to include the html login form...


		
	
	}
	
	public function chkVerifica($username,$email)
	{
		if ($this->con->connect_error) 
		{
			die("Connection failed: " . $this->con->connect_error);
		} 



		 // username and email received from loginform 
			$username=mysqli_real_escape_string($this->con,$username); 
			$email=mysqli_real_escape_string($this->con,$email); 
			$sql_query="SELECT * FROM users WHERE username='$username' or email='$email'"; 
			$result=mysqli_query($this->con,$sql_query); 
			$obj=mysqli_fetch_object($result); 
			$count=mysqli_num_rows($result);// If result matched $username and $email, table row must be 1 row 
			
			if($count>0) 
			{ 
				//$_SESSION['login_user']=$username; 
				if($obj->Username==$username && $obj->Email==$email)
					header("location: verifica.php?errore=3"); 
				else if($obj->Username==$username && $obj->Email!=$email)
					header("location: verifica.php?errore=1"); 
				else if($obj->Username!=$username && $obj->Email==$email)
					header("location: verifica.php?errore=2"); 
			} 
			else 
			{ 
				//$error="Username or Password is invalid"; 
				session_start();
				$_SESSION["newUser"]=$username;
				$_SESSION["newMail"]=$email;
				header("location: registrazione.php");
			} 
		//And now in body part of this page we have to include the html login form...


		
	
	}
	
	function chkRegistra($username,$psw,$email)
	{
		if ($this->con->connect_error) {
			die("Connection failed: " . $this->con->connect_error);
		} 

		$sql = "INSERT INTO users (Username, Password, Email)
		VALUES ( '$username', '$psw', '$email' )";

		if ($this->con->query($sql) === TRUE) {
			echo header("location: login.php"); 
		} else {
			echo "Error: " . $sql . "<br>" . $this->con->error;
		}

		$this->con->close();
	}
	
	function check_cambiaEmail($UsernameRequest,$Password,$newEmail)
	{
			session_start();
			
			$sql="select email, Password
				  from users
				  where Username='$UsernameRequest'";
			
			$Result=mysqli_query($this->con,$sql);
			$Dati= mysqli_fetch_object($Result);
			
			if(!$Password || !$newEmail)
			{
				$_SESSION['errore']="I campi non possono restare vuoti";
				header("Location:cambiaEmail.php");
				//stessa cosa di sopra
				break;
			}
			
			if($Dati->Password!=$Password)
			{
				$_SESSION['errore']="Hai inserito una password sbagliata";
				header("Location:cambiaEmail.php");
				break;
			}
			
			else if($Dati->Password==$Password)
			{		
				$sql="UPDATE users
					SET Email = '$newEmail'
						WHERE Username = '$UsernameRequest'
					";
						
				mysqli_query($this->con, $sql);
				
					if ($this->con->query($sql) === TRUE) {
						echo "Record updated successfully";
					} else {
						echo "Error updating record: " . $this->con->error;
			
		}
	header("Location:index.php");
	}
	
	}
	
	function check_cambiaPassword($newPassword,$UsernameRequest,$oldPassword,$secondNewPassword)
	{
	
		session_start();
		$sql="select Password
			  from users
			  where Username='$UsernameRequest'";
		
		$Result=mysqli_query($this->con,$sql);
		$Dati= mysqli_fetch_object($Result);
		
		if($Dati->Password!=$oldPassword)
		{
			$errore="Hai inserito una password sbagliata";
			header("Location:index.php");
			//con il ritorno dell'errore nel form, ancora non so come si fa :|
			break;
		}
		
		if($newPassword!=$secondNewPassword)
		{
			header("Location:index.php");
			//stessa cosa di sopra
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
					
			mysqli_query($this->con, $sql);
			
				if ($this->con->query($sql) === TRUE) 
				{
					echo "Record updated successfully";
				} 
				else 
				{
					echo "Error updating record: " . $this->con->error;
				}
			$this->con->close();
	}
	header("Location:index.php");
	}
	
	function check_dimenticoPassword($UsernameRequest,$email)
	{
		$sql="select Email
			from users
			WHERE Username = '$UsernameRequest'
			";
		$connessione=$this->con;	
	$Result=mysqli_query($connessione,$sql);
	$Dati= mysqli_fetch_object($Result);
		
		if($Dati->Email!=$email)
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
		
		$url = ""; 
		$client = new SoapClient($url, array("trace" => 1, "exception" => 0));
		$client->__soapCall("emailPHP",array($Dati->Email,$oggettoMail,$testoMail));
		
		header("Location:dimenticoPassword.php");
		}
	}
}
?>