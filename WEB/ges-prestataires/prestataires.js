// let onglet = document.getElementById('ongletUsers');

// onglet.style.color = "#afcdea";

// onglet.style.textShadow = '8px 8px 12px rgb(0,0,0)';


function search_prestataires()
{

  let find = document.getElementById("search-prestataires").value;
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
  request.open('GET', 'search-prestataires.php?search='+find);
  request.send();

}

function display()
{
  const request = new XMLHttpRequest();
  request.onreadystatechange =
  function()
  {
    if(request.readyState === 4)
    {
      let table = document.getElementById("tableau");
      table.innerHTML = request.responseText;
    }
  };

  request.open('GET', 'display-client.php');
  request.send();
}
