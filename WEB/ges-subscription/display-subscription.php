<?php

   require_once '../functions.php';

   	$connect = connectDb();

    $data = $connect->query("SELECT * FROM subscription_offer");

 ?>
                <thead class="thead-dark">

                <tr>

                  <th><?= SUBSCRIPTION_OFFER_ID ?></th>
                  <th><?= SUBSCRIPTION_OFFER_NAME ?></th>
                  <th><?= SUBSCRIPTION_OFFER_PRICE ?></th>
                  <th><?= SUBSCRIPTION_OFFER_HOUR_PER_MONTH ?></th>
                  <th><?= SUBSCRIPTION_OFFER_OPEN_TIME ?></th>
                  <th><?= SUBSCRIPTION_OFFER_STATUS ?></th>
                  <th><?= SUBSCRIPTION_OFFER_DISABLED ?></th>
                  <th><?= SUBSCRIPTION_OFFER_ACTIVATED ?></th>
                  <th><?= SUBSCRIPTION_OFFER_UPDATED ?></th>
                  <th><?= SUBSCRIPTION_OFFER_DROP ?></th>

                </tr>

                </thead>

<?php
    foreach ($data->fetchAll() as $key => $subscription_offer) {
    echo"<tr>";
    echo "<td>".$subscription_offer["id"]."</td>";
    echo "<td>".$subscription_offer["name"]."</td>";
    echo "<td>".$subscription_offer["price"]."</td>";
    echo "<td>".$subscription_offer["openTime"]."</td>";
    echo "<td>".$subscription_offer["hourPerMonth"]."</td>";
    echo "<td>".$subscription_offer["status"]."</td>";
    echo "<td>".'<a class="btn btn-warning" href="disabled-sub.php?id='.$subscription_offer['id'].'">X</a>'."</td>";
    echo "<td>".'<a class="btn btn-success" href="enabled-sub.php?id='.$subscription_offer['id'].'">V</a>'."</td>";
    echo "<td>".'<a class="btn btn-primary" href="update-sub.php?id='.$subscription_offer['id'].'">Update</a>'."</td>";
    echo "<td>".'<button type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-danger" onclick="del('.$subscription_offer['id'].')" >X</button>'."</td>";
    echo "</tr>";
}
