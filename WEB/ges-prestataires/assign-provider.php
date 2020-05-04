<?php

session_start();

include '../functions.php';

$connect=connectDb();


    function get_address_id($id)
    {
      $answer=$GLOBALS['connect']->query("SELECT Address_id FROM user_has_address WHERE User_id='$id'");
      $data=$answer->fetch();
      return $data["Address_id"];
    }

    $Address_id = get_address_id($_SESSION['id']);

    function get_city_id($id)
    {
      $answer=$GLOBALS['connect']->query("SELECT City_id FROM address_has_city WHERE Address_id=$id;");
      $data=$answer->fetch();
      return $data["City_id"];
    }

    $City_id = get_city_id($Address_id);

    function get_city_postalCode($id)
    {
      $answer=$GLOBALS['connect']->query("SELECT postalCode FROM CITY WHERE id=$id;");
      $data=$answer->fetch();
      return $data["postalCode"];
    }

    $id_provider = $_GET["id"];

    $get_postalCode_provider = $GLOBALS["connect"]->prepare("
      SELECT *
      FROM CITY, address_has_city, address, user_has_address, users 
      WHERE users.status >= 3
      AND users.id = user_has_address.User_id
      AND user_has_address.Address_id = address_has_city.Address_id
      AND address.id = user_has_address.Address_id
      AND address_has_city.City_id = city.id
      AND users.id = ?;
      ");

    $get_postalCode_provider->execute([$id_provider]);

    $data = $get_postalCode_provider->fetch();

    $postalCodeProvider =  $data["postalCode"];


?>

<!DOCTYPE html>
<html>
<head>
  <title>Gestion des prestataires</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link href="../css/freelancer.css" rel="stylesheet">
    <link href="../css/sb-admin-2.css" rel="stylesheet">

    <link rel="shortcut icon" href="../image/logo.png">
    <link rel="stylesheet" href="../themes/blue/pace-theme-corner-indicator.css">


</head>
<body class="bg-gradient-primary">



        <div class="container">


                <table id="tableau" border="1px" class="table table table-striped" style="margin-top: 15%;">

                 <thead class="thead-dark">
                  <th>Liste des utilisateurs les plus proches de ce prestataire</th>                  

                   <tr>
                       <th>ID - client</th>
                       <th>Nom client</th>
                       <th>Prénom client</th>
                       <th>Téléphone</th>                       
                       <th>Adresse</th>
                       <th>Ville</th>
                       <th>Service demandé</th>
                       <th>Affecter</th>


                       <?php

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
                          AND USERS.status = 1

                          ;");

                          $provider_id = $_GET["id"];  
    

                          foreach ($data_reservation->fetchAll() as $reservation)
                          {

                            if ($postalCodeProvider == $reservation["postalCode"]) 
                            {
                              echo"<tr>";
                              echo "<td>".$reservation["id"]."</td>";
                              echo "<td>".$reservation["nameUser"]."</td>";
                              echo "<td>".$reservation["firstname"]."</td>";
                              echo "<td>".$reservation["phone"]."</td>";
                              echo "<td>".$reservation["noStreet"]." ".$reservation["nameStreet"]."</td>";
                              echo "<td>".$reservation["nameCity"]." ".$reservation["postalCode"]."</td>";
                              echo "<td>".$reservation["nameService"]."</td>";
                              echo "<td><a href='assign-provider-to.php?id=".$reservation["idReservation"]."&id_prestataires=".$provider_id."'>Affecter le prestataire à ce client</a></td>";


                              echo "</tr>";
                            }
                          }



                       ?>

                   </tr>

                 </thead>

                </table>

        </div>



    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="../barre.js"></script>
    <script src="prestataires.js"></script>

</body>
</html>