<?php

require_once '../functions.php';


$connect = connectDb();

     $data = $connect->query("SELECT Category_id, services.name servicesName, category.name categoryName, category.id, services.id servicesId, price, description, status 
      FROM CATEGORY, SERVICES 
      WHERE category.id = Category_id
      ORDER BY servicesId ASC");

?>

     <thead class="thead-dark">

         <tr>
             <th>ID</th>
             <th>Nom du service</th>
             <th>Prix du service</th>
             <th>Description du service</th>
             <th>Appartient à la catégorie</th>
             <th>Status</th>
             <th>Désactiver le service</th>
             <th>Activer le service</th>
             <th>Mettre à jour le service</th>
             <th>Supprimer ce service</th>

         </tr>

     </thead>


<?php


   foreach ($data->fetchAll() as $service)
   {
       echo"<tr>";
       echo "<td>".$service["servicesId"]."</td>";
       echo "<td>".$service["servicesName"]."</td>";
       echo "<td>".$service["price"]."</td>";
       echo "<td>".$service["description"]."</td>";
       echo "<td>".$service["categoryName"]."</td>";
       echo "<td>".$service["status"]."</td>";
       echo "<td>".'<button class="btn btn-warning" onclick="disableService('.$service['servicesId'].')">X</button>'."</td>";
       echo "<td>".'<button class="btn btn-success" onclick="enableService('.$service['servicesId'].')">V</button>'."</td>";
       echo "<td>".'<a class="btn btn-primary" href="update-services.php?id='.$service['servicesId'].'">Update</a>'."</td>";
       echo "<td>".'<button class="btn btn-danger" onclick="rmService('.$service['servicesId'].')">X</button>'."</td>";
       echo "</tr>";
   }

?>





</div>
</div>
</div>
</div>
