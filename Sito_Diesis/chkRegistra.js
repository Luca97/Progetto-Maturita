function chkRegistra()
{
	if(document.getElementById("nome").value=="" | document.getElementById("pass").value=="" | document.getElementById("confPass").value=="")
	{
		alert("Campi vuoti");
		return false;
	}
	
	if(document.getElementById("pass").value != document.getElementById("confPass").value)
	{
		alert("Le password devono essere uguali");
		return false;
	}
	
	//manca il controllo per vedere se una persona è già registrata
}