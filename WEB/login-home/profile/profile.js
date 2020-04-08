// var CheminComplet = document.location.href;
// var CheminRepertoire  = CheminComplet.substring( 0 ,CheminComplet.lastIndexOf( "/" ) );
// var NomDuFichier     = CheminComplet.substring(CheminComplet.lastIndexOf( "/" )+1 );
// alert ('NomDuFichier : \n'+NomDuFichier+ ' \n\n CheminRepertoire : \n' +CheminRepertoire+ ');

function redirectIntoLoginPageAfterUpdate(){
  setTimeout(function(){ window.location = "../../log-out.php"; },5000);
}




function displayCustomerData()
{
  const request = new XMLHttpRequest();
  request.onreadystatechange =
  function()
  {
    if(request.readyState === 4)
    {

        //console.log(request.responseText);

        let tab = document.getElementById("tableCustomer");

        tab.innerHTML = request.responseText;

        //console.log(NomDuFichier);
    }
  };

  //request.open('GET', 'display-profile.php?file=' + NomDuFichier);
  request.open('GET', 'display-profile.php?');
  request.send();
}
