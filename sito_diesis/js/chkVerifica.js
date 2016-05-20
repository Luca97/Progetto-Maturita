function chkVerifica()
{
	var user = document.getElementById("username").value;
	var mail = document.getElementById("email").value;
	var filter =/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
	var sentinella = true;
	
	if(user == "" || mail=="")
	{	
		alert("Campi vuoti");
		sentinella= false; //controllo campi vuoti
	}
	
	if (mail.search(filter) == -1)
	{	
		alert("Email non valida");
		mail.focus;
		sentinella= false; //controllo se l'email è valida
	}
	
	return sentinella;
}

function chkNewMail()
{
	var newMail = document.getElementById("newEmail").value;
	var filter =/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
	var sentinella = true;
	
	if (newMail.search(filter) == -1)
	{	
		alert("Email non valida");
		newMail.focus;
		sentinella= false; //controllo se l'email è valida
	}
	
	return sentinella;
}