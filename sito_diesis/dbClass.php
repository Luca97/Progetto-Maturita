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
	
	function check_cambiaPassword($newPassword,$UsernameRequest,$oldPassword,$secondNewPassword) //funzione che modifica la password
	{
	
		session_start();
		$sql="select Password
			  from users
			  where Username='$UsernameRequest'";
		
		$Result=mysqli_query($this->con,$sql);
		$Dati= mysqli_fetch_object($Result);
		
		if($Dati->Password!=$oldPassword)
		{
			$_SESSION['errore']="Errore nell'inserimento password";
			header("Location:cambiaPassword.php");
			//con il ritorno dell'errore nel form
			break;
		}
		
		if($newPassword!=$secondNewPassword)
		{
			$_SESSION['errore']="Le due password non coincidono";
			header("Location:cambiaPassword.php");
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
			header("Location:index.php");
		}
	}
	function checkSession()
	{
		session_start();
		
		if(!isset($_SESSION["username"]))//Se non sei autenticato, non puoi accedere a questa pagine e vieni reindirizzato alla pagina di login
			echo header("location: login.php");
		
	}
	function dataGrid()
	{
		$query="";
		
		
		if(isset($_POST["genere"]) && isset($_POST["nome"]))
		{
			//echo "sono dentro ".$_POST['genere'].$_POST['nome'].$username.$pubblico;
		if($_POST["genere"]!="" && $_POST["nome"]=="")
		{
			$genere=$_POST["genere"]; //echo "sono qui 1 solo gen";
			
			if(strtolower($genere)=="*" || strtolower($genere)=="tutti" || strtolower($genere)=="all")			
				$query="SELECT Titolo,Genere,DataCreazione,Link FROM Files WHERE Pubblico=1 ORDER BY Titolo";
			else
				$query="SELECT Titolo,Genere,DataCreazione,Link FROM Files WHERE Pubblico=1 AND Genere='$genere'ORDER BY Titolo";
		}
		else
		
		if($_POST["genere"]=="" && $_POST["nome"]!="")
		{
			$nome=$_POST["nome"];// echo "sono qui 2 solo nome $nome";
			$query="SELECT Titolo,Genere,DataCreazione,Link FROM Files WHERE Pubblico=1 AND Titolo='$nome'";
		}
		else		
			
		if($_POST["genere"]!="" && $_POST["nome"]!="")
		{
			$genere=$_POST["genere"];
			$nome=$_POST["nome"]; //echo "sono qui 3 entrambi $genere $nome";
			
			if(strtolower($genere)=="*" || strtolower($genere)=="tutti" || strtolower($genere)=="all")			
				$query="SELECT Titolo,Genere,DataCreazione,Link FROM Files WHERE Pubblico=1 AND Titolo='$nome' ORDER BY Titolo";
			else
				$query="SELECT Titolo,Genere,DataCreazione,Link FROM Files WHERE Pubblico=1 AND Titolo='$nome' AND Genere='$genere'";
		}
		}
		else{//echo "sono fuori".$username.$pubblico;
			$query="SELECT Titolo,Genere,DataCreazione,Link FROM Files WHERE Pubblico=1 ORDER BY Titolo";
		}
		return $query;
	}
	function check_dimenticoPassword($UsernameRequest,$email) //funzione che recupera password dimenticata tramite invio email
	{	
		session_start();
		$sql="select Email
			from users
			WHERE Username = '$UsernameRequest'
			";
		$connessione=$this->con;	
		$Result=mysqli_query($connessione,$sql);
		$Dati= mysqli_fetch_object($Result);
	
		if(!$Result)
		{
			$_SESSION['errore']="Lo username è inesistente";
			header("Location:dimenticoPassword.php");
			break;
		}
		
		if(!$email || !$UsernameRequest)
		{
			$_SESSION['errore']="I campi non possono essere vuoti";
			header("Location:dimenticoPassword.php");
			//con il ritorno dell'errore nel form
			break;
		}
		
		if($Dati->Email!=$email)
		{
			$_SESSION['errore']="Email errata";
			header("Location:dimenticoPassword.php");
			//con il ritorno dell'errore nel form
			break;
		}
	//invio dell'email per cambiare la password
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
		
		/*$url = ""; 
		$client = new SoapClient($url, array("trace" => 1, "exception" => 0));
		$client->__soapCall("emailPHP",array($Dati->Email,$oggettoMail,$testoMail));*/
		
		header("Location:dimenticoPassword.php");
		}
	}
}
?>