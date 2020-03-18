

let onglet = document.getElementById('factures');

onglet.style.color = "#fff";
onglet.style.fontWeight ="bold";
onglet.style.fontSize ="120%";
onglet.style.textShadow = '8px 8px 12px rgb(0,0,0)';

//<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">

onglet.setAttribute("data-toggle", "collapse");

function display_bill()
{
  const request = new XMLHttpRequest();
  request.onreadystatechange =
  function()
  {
    if(request.readyState === 4)
    {

      let button = document.getElementById('button');

      button.style.marginBottom = "20px";

      let tableau = document.getElementById('generate_bill');
      tableau.innerHTML = request.responseText;


    }
  };

  request.open('GET', 'display-bill.php');
  request.send();
}
