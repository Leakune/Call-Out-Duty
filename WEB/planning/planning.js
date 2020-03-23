
let onglet = document.getElementById('planning');

onglet.style.color = "#fff";
onglet.style.fontWeight ="bold";
onglet.style.fontSize ="120%";
onglet.style.textShadow = '8px 8px 12px rgb(0,0,0)';

//<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">

onglet.setAttribute("data-toggle", "collapse");

//planning

let today = new Date();
let currentMonth = today.getMonth();
let currentYear = today.getFullYear();
let selectYear = document.getElementById("year");
let selectMonth = document.getElementById("month");

let months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre',
'Octobre','Novembre','Décembre'];

let monthAndYear = document.getElementById("monthAndYear");

//affichage du planning
planning(currentMonth, currentYear);




function next()
{
    currentYear = (currentMonth === 11) ? currentYear + 1 : currentYear;
    currentMonth = (currentMonth + 1) % 12;
    planning(currentMonth, currentYear);
}

function previous()
{
    currentYear = (currentMonth === 0) ? currentYear - 1 : currentYear;
    currentMonth = (currentMonth === 0) ? 11 : currentMonth - 1;
    planning(currentMonth, currentYear);
}

function gotodate()
{
    currentYear = parseInt(selectYear.value);
    currentMonth = parseInt(selectMonth.value);
    planning(currentMonth, currentYear);
}

function planning(month, year)
{

    let firstDay = (new Date(year, month)).getDay();
    let daysInMonth = 32 - new Date(year, month, 32).getDate();

    let tbl = document.getElementById("planning-body");

    // clearing all previous cells
    tbl.innerHTML = "";

    // filing data about month and in the page via DOM.
    monthAndYear.innerHTML = months[month] + " " + year;
    selectYear.value = year;
    selectMonth.value = month;

    // creating all cells
    let date = 1;
    for (let i = 0; i < 6; i++)
    {
        // creates a table row
        let row = document.createElement("tr");

        //creating individual cells, filing them up with data.
        for (let j = 0; j < 7; j++)
        {
            if (i === 0 && j < firstDay)
            {
                let cell = document.createElement("td");
                let cellText = document.createTextNode("");

                cell.appendChild(cellText);
                row.appendChild(cell);

            } else if (date > daysInMonth) {
                break;
            }

            else {
                let cell = document.createElement("td");
                let cellText = document.createTextNode(date);
                cellText.value = year + '-'+ month + '-' + date;

                //Création d'un bouton pour chaque cellule non vide

                let button = document.createElement('button');

                button.innerHTML = "Demander un service";

                button.setAttribute('class', 'badge badge-primary');
                button.setAttribute('type', 'submit');
                button.setAttribute('onclick', 'ask_event()');


                //Si la date d'aujourd'hui correspond à une cellule alors
                if (date === today.getDate() && year === today.getFullYear() && month === today.getMonth())
                {
                  //La cellule sera en bleu
                    cell.classList.add("bg-info");
                }

                cell.appendChild(cellText);
                row.appendChild(cell);
                cell.appendChild(button);

                date++;
            }

        }

        tbl.appendChild(row); // appending each row into calendar body.
    }


}

// <div class="col-sm-6 mb-3 mb-sm-0">
//   <input type="text" name="name" class="form-control-user form-control" id="name" placeholder="Subscription's name">
// </div>


function ask_event()
{
  let form = document.getElementById('form-event');

  let titre = form.getElementsByTagName('h1');

  if(titre.length < 1)
  {

  //le titre
  let h = document.createElement('h1');
  h.setAttribute('class', 'h4 text-gray-900 mb-4');

  h.innerHTML = "Demande de réservation d'un service";

  form.appendChild(h);



  //On crée la div dans le formulaire :

  let div = document.createElement('div');

  div.classList.add('col-sm-6');
  div.classList.add('mb-3');
  div.classList.add('mb-sm-2');

  //Creation des inputs

  let input_date_meeting = document.createElement('input');

  input_date_meeting.type = 'date';
  input_date_meeting.id = 'dateMeeting';
  input_date_meeting.setAttribute('class', 'form-control-user form-control');

  //Pour l'envoi du formulaire
  let send_data = document.createElement('input');

  send_data.type = "submit";
  send_data.value = "Envoyer";

  send_data.setAttribute('class', 'btn btn-primary');
  send_data.setAttribute('onclick', 'add_event()');


//On ajoute les éléments
  form.appendChild(div);
  div.appendChild(input_date_meeting);
  div.appendChild(send_data);
}


}

// <a class="dropdown-item d-flex align-items-center" onclick="counter_decremente()">
//     <div class="font-weight-bold">
//       <div class="text-truncate" id="content-message">
//       </div>
//     </div>
// </a>

let counter_notification = 0;

function counter_decrement()
{
  counter_notification--;
  let notification = document.getElementById('counter_notification');

  notification.innerHTML = counter_notification;

}

function counter_increment()
{
  counter_notification++;
  let notification = document.getElementById('counter_notification');

  notification.innerHTML = counter_notification;

}

function add_event()
{

  let dateMeeting = document.getElementById('dateMeeting').value;

  const request = new XMLHttpRequest();
  request.onreadystatechange =
  function()
  {
    if(request.readyState === 4)
    {
      if(request.status === 200)
      {

      }
    }
  }
  request.open('POST', 'add-event.php');
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  request.send(`dateMeeting=${dateMeeting}`);
}
