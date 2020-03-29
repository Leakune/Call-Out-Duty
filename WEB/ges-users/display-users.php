<?php

require_once '../functions.php';


$connect = connectDb();

$data_users = $connect->query("SELECT * FROM users;");
$data_address = $connect->query("SELECT * FROM address;");

?>

<thead class="thead-dark">
<tr>
  <th><?= USER_ID ?></th>
  <th><?= USER_NAME ?></th>
  <th><?= USER_FIRST_NAME ?></th>
  <th><?= USER_PSEUDO ?></th>
  <th><?= USER_EMAIL ?></th>
  <th><?= USER_BIRTHDAY ?></th>
  <th><?= USER_GENDER ?></th>
  <th><?= USER_PHONE ?></th>
  <th><?= USER_ADDRESS ?></th>
  <th><?= USER_STATUS ?></th>
  <th><?= USER_SUBSCRIBED_TO ?></th>
  <th><?= USER_DISABLE_ACCOUNT ?></th>
  <th><?= USER_MUST_CONFIRM_EMAIL ?></th>
  <th><?= USER_ACTIVATE_ACCOUNT ?></th>
  <th><?= USER_UPDATE ?></th>
  <th><?= USER_DROP ?></th>
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
