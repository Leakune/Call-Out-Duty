<?php

require_once '../functions.php';

$connect = connectDb();

$data_reservation = $connect->query("SELECT *, SERVICES.name nameService, USERS.name nameUser, RESERVATION.id idReservation
         FROM USERS, address, user_has_address, address_has_city, city, RESERVATION, SERVICES
          WHERE
          users.id = user_has_address.user_id
          AND 
          address.id = user_has_address.Address_id
          AND address_has_city.Address_id = address.id
          AND address_has_city.City_id = city.id
          AND RESERVATION.Service_id = SERVICES.id
          AND RESERVATION.User_id = users.id
          AND RESERVATION.status = 0

          ;");

?>

<thead class="thead-dark">
<tr>
  <th>ID</th>
  <th>Nom</th>
  <th>Prénom</th>
  <th>Email</th>
  <th>Téléphone</th>
  <th>Adresse postale</th>
  <th>Ville</th>
  <th>Service demandé</th>
</tr>


 </thead>





<?php

    $provider_id = $_GET["id"];  
    

    foreach ($data_reservation->fetchAll() as $reservation)
    {

      echo"<tr>";
      echo "<td>".$reservation["id"]."</td>";
      echo "<td>".$reservation["nameUser"]."</td>";
      echo "<td>".$reservation["firstname"]."</td>";
      echo "<td>".$reservation["email"]."</td>";
      echo "<td>".$reservation["phone"]."</td>";
      echo "<td>".$reservation["noStreet"]." ".$reservation["nameStreet"]."</td>";
      echo "<td>".$reservation["nameCity"]."</td>";
      echo "<td>".$reservation["nameService"]."</td>";
      echo "<td><a href='assign-provider-to.php?id=".$reservation["idReservation"]."&id_prestataires='>Affecter le prestataire à ce client</a></td>";
      echo "</tr>";
    }


?>
