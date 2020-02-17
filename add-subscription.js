function add() {

  let name = document.getElementById('name').value;
  let price = document.getElementById('price').value;
  let hourPerTime = document.getElementById('hour').value;
  let openTime = document.getElementById('openTime').value;

  name = name.trim();

  const request = new XMLHttpRequest();
  request.onreadystatechange =
  function()
  {
    if(request.readyState === 4)
    {
      if(request.status === 201)
      {
        display();
      }
    }
  }
  request.open('POST', 'ges-subscription.php');
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  request.send(`name=${name}&price=${price}&openTime=${openTime}&hour=${hourPerTime}`);
  // eq
  // request.send('name=' + name + '&min_height=' + minHeight + '&duration=' + duration);
}

function display() {
  const request = new XMLHttpRequest();
  request.onreadystatechange =
  function()
  {
    if(request.readyState === 4)
    {
      const tableau = document.getElementById('tableau');
      tableau.innerHTML = request.responseText;
    }
  };
  request.open('GET', 'ges-subscription.php');
  request.send();
}