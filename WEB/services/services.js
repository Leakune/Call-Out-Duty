


let CheminComplet = document.location.href;
let CheminRepertoire  = CheminComplet.substring( 0 ,CheminComplet.lastIndexOf( "/" ) );
let NomDuFichier = CheminComplet.substring(CheminComplet.lastIndexOf( "/" )+1 );
 //alert('NomDuFichier : \n'+NomDuFichier+ ' \n\n CheminRepertoire : \n' +CheminRepertoire+ ' \n\n Chemin complet:' + CheminComplet);

if(NomDuFichier == 'ges-services.php')
{

let onglet = document.getElementById('ongletService');

onglet.style.color = "rgb(0,200,200)";

onglet.style.textShadow = '8px 8px 12px rgb(0,0,0)';
}



function addServices()
{

  let name = document.getElementById('name-service').value;
  const price = document.getElementById('price').value;
  const description = document.getElementById('description').value;
  let weight = document.getElementById("weight");
  let categories = document.getElementById("categories");
  const index = categories.selectedIndex;
  const option_categories = categories.options[index].value;

  let intervalle = document.getElementById("select_time");
  const index2 = intervalle.selectedIndex;
  const option_time = intervalle.options[index2].value;

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

      if(option_time != "")
      {

        request.open('POST', 'add-services-with-interval.php');
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        request.send(`name=${name}&price=${price}&description=${description}&option_categories=${option_categories}&option_time=${option_time}`);            

      }else{
        request.open('POST', 'add-services.php');
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        request.send(`name=${name}&price=${price}&description=${description}&option_categories=${option_categories}`);
      }
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


  function disableService(id)
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
    request.open('GET', 'disable-services.php?id=' + id);
    request.send();

  }

  function enableService(id)
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
    request.open('GET', 'enable-services.php?id=' + id);
    request.send();

  }


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


  function add_text()
  {



    let div_form = document.getElementById("div_form");

      let div = document.getElementById("inputs");

      let text = document.createElement("input");

      text.setAttribute("type", "text");
      text.setAttribute("class", "form-control-user form-control");

      // div.appendChild(text);

    if (document.getElementById("div_form") != null) 
    {
            div_form.appendChild(text);
    }else{
            div.appendChild(text);
    }


  }

function add_date()
{
  let date = document.getElementById("date");

  let div = document.getElementById("inputs");

  let dateInput = document.createElement("input");

  div.appendChild(dateInput);

  dateInput.setAttribute("type", "date");
  dateInput.setAttribute("class", "form-control-user form-control");


}

function add_file()
{

    let get_file = document.getElementById("file");

    if (get_file == null) 
    {

      //On crée une div pour mettre les éléments du formulaire dedans
      let div_form = document.createElement("div");
      div_form.id = "div_form";


      //On récupère la div des inputs
      let div = document.getElementById("inputs");

      let form = document.createElement('form');


      form.action = "upload.php";
      form.method = "POST";
      form.enctype = "multipart/form-data";
      form.id = "form_uploading_img";

      div.appendChild(form);

      form.appendChild(div_form);

      let file = document.createElement("input");


      file.setAttribute("type", "file");
      file.setAttribute("class", "form-control-user form-control");
      file.id = "file";
      file.name = "file";

      let submit = document.createElement("input");

      submit.value = "Ajouter ce service"
      submit.type = "submit";
      submit.setAttribute("class", "btn btn-primary btn-user btn-block");  

      let name = document.getElementById('name-service');
      const price = document.getElementById('price');
      const description = document.getElementById('description');
      let categories = document.getElementById("categories");
      const index = categories.selectedIndex;
      const option_categories = categories.options[index].value;

      let label_inputs = document.getElementById("label_inputs");
      let label_categories = document.getElementById("label_categories");

      div_form.appendChild(name);
      div_form.appendChild(price);
      div_form.appendChild(description);
      div_form.appendChild(label_categories);
      div_form.appendChild(categories);
      div_form.appendChild(file);

      //creation d'une div pour le submit

      var div_submit = document.createElement("div");
      div_submit.setAttribute("class", "col-sm-6 mb-3 mb-sm-2");
      div_submit.id = "div_submit";

      //On met la div du submit dans le form

      form.appendChild(div_submit);
      div_submit.appendChild(submit);

    //On récupère le bouton du submit de base pour le supprimer de la page

      let submit_ajax = document.getElementById("submit_ajax");
      submit_ajax.parentNode.removeChild(submit_ajax);

    //

    }



}




