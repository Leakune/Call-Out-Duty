



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


                //Si la date d'aujourd'hui correspond à une cellule alors
                if (date === today.getDate() && year === today.getFullYear() && month === today.getMonth())
                {
                  //La cellule sera en bleu
                    cell.classList.add("bg-info");

                }


                row.appendChild(cell);
                



                date++;
            }

        }

        tbl.appendChild(row);
    }

    display_date_meeting();


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
