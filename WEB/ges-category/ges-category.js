function add() {

  let name = document.getElementById('name').value;

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
  request.open('POST', 'add-category.php');
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  request.send(`name=${name}`);
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

        let tab = document.getElementById("dataTable");

        tab.innerHTML = request.responseText;

        console.log(request.responseText)
      }
    };

    request.open('GET', 'display-category.php');
    request.send();
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
  request.open('DELETE', 'del-category.php?id=' + id);
  request.send();
}
