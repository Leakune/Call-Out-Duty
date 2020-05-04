<?php

require_once '../functions.php';

  $connect = connectDb();

  $search = htmlspecialchars($_GET['search']);

  $data = $connect->query("SELECT *, users.name nameUser, users.id userId FROM users, address, user_has_address, address_has_city, city
    WHERE
    users.id = user_has_address.user_id
          AND 
          address.id = user_has_address.Address_id
          AND address_has_city.Address_id = address.id
          AND address_has_city.City_id = city.id AND status >=3 AND 
    nameUsers LIKE '%".$search."%' OR
    firstname LIKE '%".$search."%' OR
    pseudo LIKE '%".$search."%' OR
    email LIKE '%".$search."%' OR
    phone LIKE '%".$search."%'
    AND status >= 3
     ");

?>
  <thead class="thead-dark">
  <tr>
    <th>ID</th>
    <th>Nom</th>
    <th>Prénom</th>
    <th>Email</th>
    <th>Civilité</th>
    <th>Téléphone</th>
    <th>Ville</th>
    <th>Adresse postale</th>
    <th>Status</th>
    <th>Disponibilité</th>
    <th>Affecter ce prestataire à un client</th>
  </tr>


   </thead>

<?php

if($data -> rowCount() > 0)
{

    if (!empty($_GET['search']))
    {
      foreach ($data->fetchAll() as $users)
            {


              echo"<tr>";
              echo "<td>".$users["userId"]."</td>";
              echo "<td>".$users["nameUser"]."</td>";
              echo "<td>".$users["firstname"]."</td>";
              echo "<td>".$users["email"]."</td>";
              echo "<td>".$users["gender"]."</td>";
              echo "<td>".$users["phone"]."</td>";
              echo "<td>".$users["nameCity"]." ".$users["postalCode"]."</td>";
              echo "<td>".$users["noStreet"]." ".$users["nameStreet"]."</td>";

              if ($users["status"] >= 3){

                echo "<td>Compte activé</td>";

              }else if ($users["status"] == -3){

                echo "<td>Compte désactivé</td>";

              }

              if ($users["status"] == 3){

                echo "<td class='alert alert-success'>Employé disponible</td>";

              }else if ($users["status"] == 4){

                echo "<td class='alert alert-danger'>Employé indisponible</td>";
              }



              echo "<td>".'<a class="btn btn-secondary" href="assign-provider.php">Affecter ce prestataires à un client</a>'."</td>";
              echo "</tr>";
            }


    }else{

      echo "<th>Vous ne recherchez rien ...</th>";

    }
}else{

   echo "<th>Aucun résultat pour cette recherche</th>";
}







?>
