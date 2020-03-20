
let onglet = document.getElementById('planning');

onglet.style.color = "#fff";
onglet.style.fontWeight ="bold";
onglet.style.fontSize ="120%";
onglet.style.textShadow = '8px 8px 12px rgb(0,0,0)';

//<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">

onglet.setAttribute("data-toggle", "collapse");

//retourne un tableau
let cell = document.getElementsByClassName('cell-planning');

//On parcourt ce tableau

for (let i = 0; i < cell.length; i++)
{

  let button = document.createElement('button');
  button.innerHTML = "Ajouter un évènement";

  button.setAttribute('class', 'badge badge-primary');
  button.setAttribute('type', 'submit');

  //A chaque case du tableau, on insère un bouton "ajouter un évènement"
  cell[i].appendChild(button);

  cell[i].value = "salut";

}

let titre_date = document.getElementById('titre_date');
let date = new Date();
let month = date.getMonth();
let year = date.getFullYear();
let months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre',
'Octobre','Novembre','Décembre']


titre_date.innerHTML = months[month] +' '+ year;
