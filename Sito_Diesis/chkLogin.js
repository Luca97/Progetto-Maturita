function chkLogin()
{
	if(document.getElementById("nome").value=="" | document.getElementById("pass").value=="")
	{
		alert("Campi vuoti");
		return false;
	}
}