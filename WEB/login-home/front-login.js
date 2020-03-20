let CheminComplet = document.location.href;
let CheminRepertoire  = CheminComplet.substring( 0 ,CheminComplet.lastIndexOf( "/" ) );
let NomDuFichier = CheminComplet.substring(CheminComplet.lastIndexOf( "/" )+1 );
//alert('NomDuFichier : \n'+NomDuFichier+ ' \n\n CheminRepertoire : \n' +CheminRepertoire+ ' \n\n Chemin complet:' + CheminComplet);

if(NomDuFichier == 'buy-subscriptions.php')
{

let onglet = document.getElementById('abonnements');

onglet.style.color = "#fff";
onglet.style.fontWeight ="bold";
onglet.style.fontSize ="120%";
onglet.style.textShadow = '8px 8px 12px rgb(0,0,0)';

//<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">

onglet.setAttribute("data-toggle", "collapse");

}
