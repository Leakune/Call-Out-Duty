<?php

require_once '../../functions.php';

  $connect = connectDb();

  $search = htmlspecialchars($_GET['search']);


  if (isset($_GET["id"])) 
  {
    $id = $_GET["id"];

      $data = $connect->query("SELECT * from services
      WHERE
      name LIKE '%".$search."%'
      AND Category_id =".$id
       );

  }else{

      $data = $connect->query("SELECT * from services
      WHERE
      name LIKE '%".$search."%'"
       );

  }

     ?>
<table class="table" id="tableau">
  <thead>
    <tr class="btn-dark">
      <th scope="col">Service</th>
      <th scope="col">Prix</th>
      <th scope="col">Image</th>
      <th scope="col">Acheter</th>
    </tr>



<?php

if($data -> rowCount() > 0)
{

    if (!empty($_GET['search']))
    {
      foreach($data as $service)
      {
        echo "<tr class='table-primary'>";
        echo "<td>".$service['name']."</td>";
        echo "<td>".$service['price']."€</td>";
        echo "<td><img src='../../services/files/".$service['img_name']."' style='width: 250px; height: 200px;' class='img-thumbnail'></td>";
        echo "<td><a href='#' class='btn btn-success'>Acheter</a></td>";
        echo "</tr>";
      }


    }else{

      echo "<th>Vous ne recherchez rien ...</th>";

    }
}else{

   echo "<th>Aucun résultat pour cette recherche</th>";
}







?>
