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
      }
    }
  }
  request.open('POST', 'ges-subscription.php');
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  request.send();
  // eq
  // request.send('name=' + name + '&min_height=' + minHeight + '&duration=' + duration);
}

