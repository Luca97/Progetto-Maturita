function checkGenere()
{
	var stringa = document.getElementById("genere").value;
	var sentinella = true;
	
	if(stringa.indexOf("=")>=0 || stringa.indexOF("*")>=0)
	{
		sentinella = false;
		alert("campo non valido");
	}
	
	return sentinella;
}

function checkNome()
{
	var stringa = document.getElementById("nome").value;
	var sentinella = true;
	
	if(stringa.indexOf("="))>=0 || stringa.indexOF("*">=0)
	{	
		sentinella = false;
		alert("campo non valido");
	}
	
	return sentinella;
}