<?php  

// file scrivifile.php 

// file scrivifile.php 

$username = $_REQUEST["nome"];
$password = $_REQUEST["pass"];
$email = $_REQUEST["email"];
$psw = md5($password); //in $psw c'è ora la password criptata.

$servername = "localhost";
$user = "root";
$password = "";
$dbname = "diesis";

// Create connection
$conn = new mysqli($servername, $user, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "INSERT INTO users (Username, Password, Email)
VALUES ( '$username', '$psw', '$email' )";

if ($conn->query($sql) === TRUE) {
    echo header("location: login.php"); 
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();


/* $nomefile ="utentiRegistrati.csv";
$idfile=fopen($nomefile,"a");
if(file_get_contents( $nomefile )=="")
{
	$stringaAppend =  $username . ";". $psw;
	fwrite($idfile, $stringaAppend);
	header('Location: Login.php');	
}	
else
{
$stringaAppend =  "\n". $username . ";". $psw ;
$file = explode( "\n", file_get_contents( $nomefile ));
$presente=false;

foreach( $file as $line )
{
//echo $line;
    list($usernameFile, $passwordFile) = explode(";", $line);
	if($usernameFile==$username)
	{
		//echo "sei gia reg" . $usernameFile;
		$presente=true;
		//header('Location: Registrazione.php');
		//break;	
	}	
		
}

if($presente)
	//echo "torna a reg";
	header('Location: Registrazione.php');
else
{
	//echo "vai a login";
	fwrite($idfile, $stringaAppend);
	header('Location: Login.php');
}
}
fclose($idfile); */


?>