<?php

require_once '../functions.php';

  $connect = connectDb();

  $search = htmlspecialchars($_GET['search']);

  $data = $connect->query("SELECT * from users
    WHERE
    name LIKE '%".$search."%' OR
    firstname LIKE '%".$search."%' OR
    pseudo LIKE '%".$search."%' OR
    email LIKE '%".$search."%' OR
    phone LIKE '%".$search."%'
     ");

?>
  <thead class="thead-dark">
  <tr>
  <th>ID</th>
  <th>Nom</th>
  <th>Prénom</th>
  <th>Pseudo</th>
  <th>Email</th>
  <th>Date de naissance</th>
  <th>Civilité</th>
  <th>No Téléphone</th>
  <th>Status</th>
  <th>Abonné(e) à</th>
  <th>Désactiver compte</th>
  <th>Doit confirmer son mail</th>
  <th>Activer compte</th>
  <th>Mettre à jour</th>
  <th>Supprimer définitivement</th>
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
        echo "<td>".$users["id"]."</td>";
        echo "<td>".$users["name"]."</td>";
        echo "<td>".$users["firstname"]."</td>";
        echo "<td>".$users["pseudo"]."</td>";
        echo "<td>".$users["email"]."</td>";
        echo "<td>".$users["birthday"]."</td>";
        echo "<td>".$users["gender"]."</td>";
        echo "<td>".$users["phone"]."</td>";
        echo "<td>".$users["status"]."</td>";
        echo "<td>".$users["Subscription_id"]."</td>";
        echo "<td>".'<a class="btn btn-warning" href="disable-users.php?id='.$users['id'].'">X</a>'."</td>";
        echo "<td>".'<a class="btn btn-secondary" href="no-mail-users.php?id='.$users['id'].'">No confirmed mail</a>'."</td>";
        echo "<td>".'<a class="btn btn-success" href="enable-users.php?id='.$users['id'].'">V</a>'."</td>";
        echo "<td>".'<a class="btn btn-primary" href="update-users.php?id='.$users['id'].'">Update</a>'."</td>";
        echo "<td>".'<a class="btn btn-danger" href="delete-users.php?id='.$users['id'].'">X</a>'."</td>";
        echo "</tr>";
      }


    }else{

      echo "<th>Vous ne recherchez rien ...</th>";

    }
}else{

   echo "<th>Aucun résultat pour cette recherche</th>";
}







?>
