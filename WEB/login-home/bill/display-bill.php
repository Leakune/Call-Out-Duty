<?php

   require_once '../../functions.php';

   	$connect = connectDb();

    $data = $connect->query("SELECT * FROM bill");

 ?>
 <thead class="thead-dark">

 <th>N° de facture</th>
 <th>Date d'emission</th>
 <th>Fichier</th>
</thead>

<?php
    foreach ($data->fetchAll() as $bill) {
    echo"<tr>";
    echo "<td>".$bill["id"]."</td>";
    echo "<td>".$bill["emissionDate"]."</td>";
    echo "<td>".$bill["pathBill"]."</td>";

    echo "</tr>";
}
