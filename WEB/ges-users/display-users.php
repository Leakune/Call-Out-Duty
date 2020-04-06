<?php

require_once '../functions.php';


$connect = connectDb();

$data_users = $connect->query("SELECT *
         FROM users, address, user_has_address
          WHERE
          users.id = user_has_address.user_id
          AND 
          address.id = user_has_address.Address_id 
          ;");

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


    foreach ($data_users->fetchAll() as $users)
    {


      echo"<tr>";
      echo "<td>".$users["User_id"]."</td>";
      echo "<td>".$users["name"]."</td>";
      echo "<td>".$users["firstname"]."</td>";
      echo "<td>".$users["pseudo"]."</td>";
      echo "<td>".$users["email"]."</td>";
      echo "<td>".$users["birthday"]."</td>";
      echo "<td>".$users["gender"]."</td>";
      echo "<td>".$users["phone"]."</td>";
      echo "<td>".$users["noStreet"]." ".$users["nameStreet"]."</td>";
      if ($users["status"] == 0) 
      {
        echo "<td>N'a pas confirmé son mail</td>";

      }else if ($users["status"] == 1){

        echo "<td>Compte activé</td>";

      }else if ($users["status"] == 2){

        echo "<td>Compte administrateur</td>";

      }else{

        echo "<td>Compte désactivé</td>";

      }
      echo "<td>".$users["Subscription_id"]."</td>";
      echo "<td>".'<a class="btn btn-warning" href="disable-users.php?id='.$users['User_id'].'">X</a>'."</td>";
      echo "<td>".'<a class="btn btn-secondary" href="no-mail-users.php?id='.$users['User_id'].'">No confirmed mail</a>'."</td>";
      echo "<td>".'<a class="btn btn-success" href="enable-users.php?id='.$users['User_id'].'">V</a>'."</td>";
      echo "<td>".'<a class="btn btn-primary" href="update-users.php?id='.$users['User_id'].'">Update</a>'."</td>";
      echo "<td>".'<a class="btn btn-danger" href="delete-users.php?id='.$users['User_id'].'">X</a>'."</td>";
      echo "</tr>";
    }

?>
