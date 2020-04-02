<?php

   require_once '../functions.php';

   	$connect = connectDb();

    $data = $connect->query("SELECT * FROM category");

 ?>
                <thead class="thead-dark">
                
                <tr>

                <th>ID</th>
                <th>Category's name</th>
                <th>Delete category</th>



                </tr>

                </thead>


<?php

    foreach ($data->fetchAll() as $category) 
    {
        echo"<tr>";
        echo "<td>".$category["id"]."</td>";
        echo "<td>".$category["name"]."</td>";
        echo "<td>".'<button type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-danger" onclick=del('.$category['id'].')>X</button>'."</td>";

        echo "</tr>";
    }