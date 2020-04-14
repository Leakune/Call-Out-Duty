



let onglet = document.getElementById('planning');

onglet.style.color = "#fff";
onglet.style.fontWeight ="bold";
onglet.style.fontSize ="100%";
onglet.style.textShadow = '8px 8px 12px rgb(0,0,0)';

//<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">

onglet.setAttribute("data-toggle", "collapse");




//planning

let today = new Date();

let currentYear = today.getFullYear();
let currentDay = today.getDate();
let currentMonth = today.getMonth();
let currentMonthIndex = today.getMonth() + 1;



if(currentMonthIndex < 10)
{
  currentMonthIndex = '0' + currentMonthIndex;
}

if(currentDay < 10)
{
  currentDay = '0' + currentDay;
}



let currentDate = currentYear +'-' + currentMonthIndex +'-' + currentDay;



let selectYear = document.getElementById("year");
let selectMonth = document.getElementById("month");
let months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre',
'Octobre','Novembre','Décembre'];

// console.log(selectYear);
// console.log(selectYear.value);
// console.log(parseInt(selectYear.value));

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

    tbl.innerHTML = "";

    monthAndYear.innerHTML = months[month] + " " + year;
    selectYear.value = year;
    selectMonth.value = month;

    let date = 1;
    for (let i = 0; i < 6; i++)
    {
        let row = document.createElement("tr");

        for (let j = 0; j < 7; j++)
        {
            if (i === 0 && j < firstDay)
            {
                let cell = document.createElement("td");

                row.appendChild(cell);

            } else if (date > daysInMonth) {
                break;
            
            }else{

                let cell = document.createElement("td");

                 if (date < 10) 
                 {

                  cell.innerHTML = '0' + date;

                 }else{

                  cell.innerHTML = date;

                 }



              

                //Création d'un bouton pour chaque cellule non vide

                let button = document.createElement('a');

                button.innerHTML = "Réserver un service";

                button.setAttribute('class', 'badge badge-primary');
                button.setAttribute('href', '../login-home/reservation/reservation.php');


                //Si la date d'aujourd'hui correspond à une cellule alors
                if (date === today.getDate() && year === today.getFullYear() && month === today.getMonth())
                {
                  //La cellule sera en bleu
                    cell.classList.add("bg-info");

                }


                row.appendChild(cell);
                cell.appendChild(button);

                

                date++;
            }

        }

        tbl.appendChild(row); 
    }

    display_date_meeting();


}

// <div class="col-sm-6 mb-3 mb-sm-0">
//   <input type="text" name="name" class="form-control-user form-control" id="name" placeholder="Subscription's name">
// </div>


function ask_event()
{
  let form = document.getElementById('form-event');

  let div_msg = document.createElement('div');

  div_msg.id = "div_msg";


  let titre = form.getElementsByTagName('h1');

  console.log(titre);

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
  div.id = "div_form";

  //Creation des inputs

  let input_date_meeting = document.createElement('input');

  input_date_meeting.type = 'date';
  input_date_meeting.id = 'dateMeeting';
  input_date_meeting.value = currentDate;

  // console.log(input_date_meeting);
  input_date_meeting.setAttribute('class', 'form-control-user form-control mb-sm-3');


  //Pour l'envoi du formulaire
  let send_data = document.createElement('input');

  send_data.type = "submit";
  send_data.value = "Envoyer";

  send_data.setAttribute('class', 'btn btn-primary');
  send_data.setAttribute('onclick', 'add_event()');


//On ajoute les éléments
  form.appendChild(div_msg);
  form.appendChild(div);
  div.appendChild(input_date_meeting);
  div.appendChild(send_data);
}


}

function display_date_meeting()
{

  const request = new XMLHttpRequest();
  request.onreadystatechange =
  function()
  {
    if(request.readyState === 4)
    {
      if(request.status === 200)
      {
        let div = document.getElementsByName("test_div");
        let cell = document.getElementsByTagName("td");


        let months = ['', 'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre',
                      'Octobre','Novembre','Décembre'];



        //On récupère le mois et l'année

        let monthAndYear = document.getElementById("monthAndYear").innerHTML;

        //Le mois

        let split_monthAndYear = monthAndYear.split(" ");

        // console.log(split_monthAndYear);

        let month = split_monthAndYear[0];
        let year = split_monthAndYear[1];


          for (var i = 0; i < div.length; i++) 
          {
          
            let cell = document.getElementsByTagName("td");
            let date = div[i].innerHTML;


            let split_date =  date.split("-");

            let get_date = split_date[2].split(" ");

            let get_month = split_date[1];

            if(get_month < 10)
            {
              get_month = get_month.split("0");
            }


            // console.log(get_month);

            // console.log(months[get_month[1]]);

            let get_year = split_date[0];

            // console.log(get_date[0]);

            // console.log(date[0]);

            // console.log(c[0]);

            for(var j = 0; j<33; j++)
            {

              let cellText = document.createTextNode("Réserver");

              if(get_date[0] == parseInt(cell[j].innerHTML) && month === months[get_month[1]] && year === get_year) 
              {

                  console.log(get_date[0]);
                  cell[j].style.backgroundColor = "yellow";

              }
            }

          }
      }
    }
  }


  request.open('GET', 'display-dateMeeting-status-0.php');
  request.send();
}

