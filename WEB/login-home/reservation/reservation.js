

let date = new Date();

let month = date.getMonth()+1;

if(month < 10)
{

  month = '0' + month;

}

let hours = date.getHours();


console.log(hours);

if (hours < 10) 
{

  hours = '0' + hours;

}

console.log(hours);

let minutes = date.getMinutes();

if(minutes < 10)
{
  minutes = '0' + minutes;
}



let currentDate =  date.getFullYear() + '-' + month + '-' + date.getDate() + 'T' + hours + ':' + minutes;



let input_date_at = document.getElementById("at-date");

input_date_at.value = currentDate;


function add_event()
{

  let atDate = document.getElementById('at-date').value;
  let toDate = document.getElementById('to-date').value;

  let services = document.getElementById("services_select");
  const index = services.selectedIndex;
  const option_services = services.options[index].value;


  const request = new XMLHttpRequest();
  request.onreadystatechange =
  function()
  {
    if(request.readyState === 4)
    {
      if(request.status === 200)
      {

          let date_Meeting = document.getElementById('at-date');

          let divMsg = document.getElementById('div_msg');

        //Si tout s'est bien passé on a un paragraphe
          let para_success = document.createElement('p');
          para_success.setAttribute('class', 'alert alert-success');
          para_success.innerHTML = "Service réservé";
        //

        //Si tout s'est mal passé on a un paragraphe
          let para_error = document.createElement('p');
          para_error.setAttribute('class', 'alert alert-warning');
          para_error.innerHTML = "Erreur dans la date ...";
        //

          para_error.onclick = function() {
           para_error.parentNode.removeChild(para_error);

         };

         para_success.onclick = function() {
          para_success.parentNode.removeChild(para_success);
        };

          //vérification de la date de demande de réservation


          if(atDate < currentDate || atDate > toDate)
          {

            return divMsg.appendChild(para_error);


          }else{

            divMsg.appendChild(para_success);

          }


      }
    }
  }


  request.open('POST', 'add-reservation.php');
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  request.send(`at-date=${atDate}&to-date=${toDate}&option_services=${option_services}`);
}



//Fonction pour afficher les services en fonction de la catégorie choisie

let CheminComplet = document.location.href;
let CheminRepertoire  = CheminComplet.substring( 0 ,CheminComplet.lastIndexOf( "/" ) );
let id = CheminComplet.substring(CheminComplet.lastIndexOf( "=" )+1 );

id = parseInt(id, 10);

if( isNaN(id) )
{
    let services = document.getElementById("services_select");

    services.style.visibility = "hidden";
}


