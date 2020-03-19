<?php

require_once '../functions.php';


$connect = connectDb();

     $data = $connect->query("SELECT * FROM services");

?>

     <thead class="thead-dark">

         <tr>
             <th>ID</th>
             <th>Nom du service</th>
             <th>Prix du service</th>
             <th>Nom de l'image</th>
             <th>Chemin de l'image</th>
             <th>Description du service</th>
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
       echo "<td>".$service["id"]."</td>";
       echo "<td>".$service["name"]."</td>";
       echo "<td>".$service["price"]."</td>";
       echo "<td>".$service["img_name"]."</td>";
       echo "<td>".$service["img_path"]."</td>";
       echo "<td>".$service["description"]."</td>";
       echo "<td>".$service["status"]."</td>";
       echo "<td>".'<button class="btn btn-warning" onclick="disableService('.$service['id'].')">X</button>'."</td>";
       echo "<td>".'<button class="btn btn-success" onclick="enableService('.$service['id'].')">V</button>'."</td>";
       echo "<td>".'<a class="btn btn-primary" href="update-services.php?id='.$service['id'].'">Update</a>'."</td>";
       echo "<td>".'<button class="btn btn-danger" onclick="rmService('.$service['id'].')">X</button>'."</td>";
       echo "</tr>";
   }

?>





</div>
</div>
</div>
</div>
