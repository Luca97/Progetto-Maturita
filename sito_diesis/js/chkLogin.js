function chkLogin()
{
	if(document.getElementById("username").value=="" 
		| document.getElementById("password").value=="")
	{
		alert("Campi vuoti");
		return false;
	}
}