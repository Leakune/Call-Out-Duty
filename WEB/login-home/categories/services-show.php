 <?php
              require_once "../../functions.php";
              $connect = connectDb();
              if(isset($_GET['id'])){
              $Category_id=strval($_GET['id']);
               $response=$connect->prepare("SELECT * FROM services WHERE Category_id IN (SELECT id FROM category WHERE chemin LIKE ?)");
               $response->execute(array("%$Category_id%"));
               $services=$response->fetchAll();
               foreach($services as $service){

                  echo "<div id=\"".$service['id']."\"  class=\"col-lg col-sm col-sx out\"><div name=\"service\"class=\"card h-100 inline\" style=\"width: 14rem;\">
                  <img id=\"".$service['id']."\" name=\"service\" src=\"../../services/".$service['img_path']."\" class=\"card-img-top\" >
                  <div id=\"".$service['id']."\" name=\"service\" class=\"card-body\">
                  <h5 id=\"".$service['id']."\" name=\"service\" class=\"card-title text-center\">".$service['name']." : ".$service['price']."€/h</h5><p id=\"".$service['id']."\" name=\"service\" class=\"card-text\">".$service['description']."</p>
                 
                  
                  </div>
                  </div></div>";

               }
             }
               

               ?>