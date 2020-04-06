function displayCustomerData()
{
  const request = new XMLHttpRequest();
  request.onreadystatechange =
  function()
  {
    if(request.readyState === 4)
    {

      console.log(request.responseText);
      
      let tab = document.getElementById("tableCustomer");

      tab.innerHTML = request.responseText;

      // console.log(request.responseText)
    }
  };

  request.open('GET', 'display-profile.php');
  request.send();
}
