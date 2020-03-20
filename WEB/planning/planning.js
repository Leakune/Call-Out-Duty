
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

    let tbl = document.getElementById("planning-body"); // body of the calendar

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

                //Création d'un bouton pour chaque cellule non vide

                let button = document.createElement('button');

                button.innerHTML = "Demander un évènement";

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

function ask_event()
{


}
