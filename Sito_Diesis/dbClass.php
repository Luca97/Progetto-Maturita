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
				//$_SESSION['login_user']=$username; 
				header("location: manageCr.php"); 
			} 
			else 
			{ 
				//$error="Username or Password is invalid"; 
				header("location: index.php");
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
	
}
?>