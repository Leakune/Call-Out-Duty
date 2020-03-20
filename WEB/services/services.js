


let CheminComplet = document.location.href;
let CheminRepertoire  = CheminComplet.substring( 0 ,CheminComplet.lastIndexOf( "/" ) );
let NomDuFichier = CheminComplet.substring(CheminComplet.lastIndexOf( "/" )+1 );
 //alert('NomDuFichier : \n'+NomDuFichier+ ' \n\n CheminRepertoire : \n' +CheminRepertoire+ ' \n\n Chemin complet:' + CheminComplet);

if(NomDuFichier == 'ges-services.php')
{

let onglet = document.getElementById('ongletService');

onglet.style.color = "#afcdea";

onglet.style.textShadow = '8px 8px 12px rgb(0,0,0)';
}



function addServices()
{

  let name = document.getElementById('name-service').value;
  const price = document.getElementById('price').value;
  const description = document.getElementById('description').value;
  let weight = document.getElementById("weight");


  const request = new XMLHttpRequest();
  request.onreadystatechange =
  function()
  {
    if(request.readyState === 4)
    {
      if(request.status === 200)
      {
        // alert('Service ajoutée avec succès !');
        display();
        console.log(request.responseText);

      }
    }
  }
  request.open('POST', 'add-services.php');
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  request.send(`name=${name}&price=${price}&description=${description}&weight=${weight}`);



  // let ok = document.getElementById('ok');

  // const input = document.createElement('button');


  // ok.appendChild(input);

  // input.innerHTML= "ta mere";

  // input.style.marginTop = "100px";

  // input.onclick = function() {
    //   input.parentNode.removeChild(input);
    // }


  }

  function rmService(id)
  {
    const request = new XMLHttpRequest();
    request.onreadystatechange = function() {
      if(request.readyState === 4) {
        if(request.status === 200)
        {
          display();
        }
      }
    };
    request.open('DELETE', 'delete-services.php?id=' + id);
    request.send();

  }

  //Bouton pour l'affichage

  let form = document.getElementById("formulaire");

  let display_div = document.createElement("div");

  form.appendChild(display_div);

  display_div.setAttribute("class", "col-sm-6 mb-3 mb-sm-");

  let display_button = document.createElement("input");

  display_div.appendChild(display_button);

  display_button.value = "Afficher les services";
  display_button.setAttribute("type", "submit");
  display_button.setAttribute("onclick", "display()");
  display_button.setAttribute("class","btn btn-success btn-user btn-block");

//

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

    request.open('GET', 'display-services.php');
    request.send();
  }


  function addWeightInput()
  {

    let weight = document.getElementById("weight");

    if( weight === null)
    {
      let div = document.getElementById("inputs");

      let weightInput = document.createElement("input");

      div.appendChild(weightInput);

      weightInput.setAttribute("Type", "number");
      weightInput.setAttribute("step", "0.01");
      weightInput.setAttribute("class", "form-control-user form-control");
      weightInput.setAttribute("placeholder", "Poids du produit");
      weightInput.setAttribute("id", "weight");

    }

  }

function addDateInput()
{
  let date = document.getElementById("date");

  if (date === null)
  {
    let div = document.getElementById("inputs");

    let dateInput = document.createElement("input");

    div.appendChild(dateInput);

    dateInput.setAttribute("type", "date");
    dateInput.setAttribute("id", "date");
    dateInput.setAttribute("class", "form-control-user form-control");

  }




}
