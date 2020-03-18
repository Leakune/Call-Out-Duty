
let onglet = document.getElementById('ongletAbonnement');

onglet.style.color = "#afcdea";

onglet.style.textShadow = '8px 8px 12px rgb(0,0,0)';

function add() {

  let name = document.getElementById('name').value;
  let price = document.getElementById('price').value;
  let hour = document.getElementById('hour').value;
  let openTime = document.getElementById('openTime').value;

  const request = new XMLHttpRequest();
  request.onreadystatechange =
  function()
  {
    if(request.readyState === 4)
    {
      if(request.status === 200)
      {

		display();

      }
    }
  }
  request.open('POST', 'add-subscription.php');
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  request.send(`name=${name}&price=${price}&hour=${hour}&openTime=${openTime}`);
  // eq
  // request.send('name=' + name + '&min_height=' + minHeight + '&duration=' + duration);

}

  function display()
  {
    const request = new XMLHttpRequest();
    request.onreadystatechange =
    function()
    {
      if(request.readyState === 4)
      {
      	// let tr = document.getElementById("data");
      	// let td = document.createElement("td");

      	// tr.appendChild(td);

      	// td.innerHTML = request.responseText;

      	let tab = document.getElementById("tableau");

      	tab.innerHTML = request.responseText;

      	console.log(request.responseText)
      }
    };

    request.open('GET', 'display-subscription.php');
    request.send();
  }


function confirm_del()
{

	let confirmation = document.getElementById('confirmation');

	let button = document.createElement('button');
	let button2 = document.createElement('button');

	confirmation.appendChild(button);
	confirmation.appendChild(button2);

}


function del(id)
{
  const request = new XMLHttpRequest();
  request.onreadystatechange = function() {
    if(request.readyState === 4) {
      if(request.status === 204 || request.status === 200) {

          display();


      }
    }
  };
  request.open('DELETE', 'delete-sub.php?id=' + id);
  request.send();
}
