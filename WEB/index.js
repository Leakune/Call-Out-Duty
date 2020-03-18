function display_premium()
{
  const request = new XMLHttpRequest();
  request.onreadystatechange =
  function()
  {
    if(request.readyState === 4)
    {
        let para_contain = document.getElementById("premium");
        para_contain.innerHTML = request.responseText ;

    }
  };

  request.open('GET', 'home-data-premium.php');
  request.send();
}
