<?php

$username = $_REQUEST["nome"];
$password = $_REQUEST["pass"];
$psw = md5($password); //in $psw c'è ora la password criptata.
session_start();
$_SESSION["username"] = $username;

define('DB_HOST', 'localhost'); 
define('DB_NAME', 'diesis'); 
define('DB_USER','root'); 
define('DB_PASSWORD',''); 

// Create connection
$conn = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
// Check connection
if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
} 

session_start(); 

 // username and password received from loginform 
	$username=mysqli_real_escape_string($conn,$username); 
	$password=mysqli_real_escape_string($conn,$psw); 
	$sql_query="SELECT * FROM users WHERE username='$username' and password='$psw'"; 
	$result=mysqli_query($conn,$sql_query); 
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


$conn->close();
?>