

let onglet = document.getElementById('status');

onglet.style.color = "#fff";
onglet.style.fontWeight ="bold";
onglet.style.fontSize ="100%";
onglet.style.textShadow = '8px 8px 12px rgb(0,0,0)';


onglet.setAttribute("data-toggle", "collapse");


function available()
{
const request = new XMLHttpRequest();
request.onreadystatechange = function() {
  if(request.readyState === 4) {
    if(request.status === 200)
    {

    	alert("Vous êtes maintenant disponible");

    }
  }
};
request.open('GET', 'available.php');
request.send();

}

function unavailable() 
{

	const request = new XMLHttpRequest();
	request.onreadystatechange = function() 
	{
	  if(request.readyState === 4) 
	  {
	    if(request.status === 200)
	    {
	    	alert("Vous êtes maintenant indisponible");

	    }
	  }
	};
	request.open('GET', 'unavailable.php');
	request.send();

}