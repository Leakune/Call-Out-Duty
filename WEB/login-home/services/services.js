
let onglet = document.getElementById('services');

onglet.style.color = "#fff";
onglet.style.fontWeight ="bold";
onglet.style.fontSize ="100%";
onglet.style.textShadow = '8px 8px 12px rgb(0,0,0)';

//<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">

onglet.setAttribute("data-toggle", "collapse");

//Pour récupérer l'id

let CheminComplet = document.location.href;
let CheminRepertoire  = CheminComplet.substring( 0 ,CheminComplet.lastIndexOf( "/" ) );
let id = CheminComplet.substring(CheminComplet.lastIndexOf( "=" )+1 );

id = parseInt(id, 10);

//

function search_services() 
{

  let find = document.getElementById("search-services").value;
  let table = document.getElementById('tableau');

  const request = new XMLHttpRequest();
  request.onreadystatechange =
  function()
  {
    if(request.readyState === 4)
    {
      if(request.status === 200)
      {

        table.innerHTML = request.responseText;

      }
    }
  }

  if(isNaN(id)) 
  {

  	request.open('GET', 'search-services.php?search='+ find);

  }else{

  	request.open('GET', 'search-services.php?search='+ find + '&id=' + id);

  }

  request.send();

}

