function chkRegistra()
{

	var pass = document.getElementById("password").value;
	var filter =/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
	var sentinella = true;
	
	if(pass=="")
	{	
		alert("Campi vuoti");
		sentinella= false; //controllo campi vuoti
	}
	
	if(pass!=document.getElementById("confPass").value)
	{	
		alert("Le due password sono diverse!");
		sentinella= false; //se le due password sono diverse
	}
	
	return sentinella;
}