<?php
class dbClass {
	
	private  $con;//Connessione al db
	
	public function __construct() 
	{
	   $this->openConnection();
	}
	
	public function openConnection()
	{
		
		$this->con=mysqli_connect("localhost","root","","diesis");//Setto la connessione col db in modo tale che lavori sul db diesis
	   // Check connection
		if (mysqli_connect_errno())
		  {
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		  }
	
	}
	
	public function closeConnection()
	{
		
		mysqli_close($this->con);
	
	}
	
	public function interroga($query)
	{
		
	$query="SELECT Username,Email,Password FROM Users ORDER BY Username";

	if ($result=mysqli_query($this->con,$query))
	{
	  // Fetch one and one row
		while ($row=mysqli_fetch_row($result))//Mentre esiste una riga, quindi la fetch contiene una risposta all'interrogazione
		//Il ciclo stampa il suo contenuto
		{
			printf ("%s (%s)\n",$row[0],$row[1]);
		}
	  // Free result set
	  mysqli_free_result($result);//Libera la var result
	}
	
	}
	

	
}

$db= new dbClass;
$query="";
$db->interroga($query);
$db->closeConnection();
?>