<?php

require_once '../functions.php';


$connect = connectDb();

$data_users = $connect->query("SELECT * FROM users;");
$data_address = $connect->query("SELECT * FROM address;");

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
<th>Adresse postale</th>
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

//Attribution des adresses respectives à chaque user

foreach ($data_address->fetchAll() as $key => $address)
{
    foreach ($data_users->fetchAll() as $key => $users)
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
        echo "<td>".$address["noStreet"]." ".$address["nameStreet"]."</td>";
        echo "<td>".$users["status"]."</td>";
        echo "<td>".$users["Subscription_id"]."</td>";
        echo "<td>".'<a class="btn btn-warning" href="disable-users.php?id='.$users['id'].'">X</a>'."</td>";
        echo "<td>".'<a class="btn btn-secondary" href="no-mail-users.php?id='.$users['id'].'">No confirmed mail</a>'."</td>";
        echo "<td>".'<a class="btn btn-success" href="enable-users.php?id='.$users['id'].'">V</a>'."</td>";
        echo "<td>".'<a class="btn btn-primary" href="update-users.php?id='.$users['id'].'">Update</a>'."</td>";
        echo "<td>".'<a class="btn btn-danger" href="delete-users.php?id='.$users['id'].'">X</a>'."</td>";
        echo "</tr>";
    }
}

?>
