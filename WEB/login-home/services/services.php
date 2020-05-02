<?php

session_start();

?>


<!DOCTYPE html>
<html lang="fr">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Services</title>

  <!-- Custom fonts for this template -->
  <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <link href="../../css/sb-admin-2.min.css" rel="stylesheet">

  <link href="../../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

  <link rel="stylesheet" href="../../themes/blue/pace-theme-corner-indicator.css">


  <link href="../../css/freelancer.css" rel="stylesheet">
  <link href="../../css/sb-admin-2.css" rel="stylesheet">
  <link rel="shortcut icon" href="../../image/logo.png">


</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <?php


      require_once '../../Header.php';

      $header = new Header('#','../../planning/ges-planning.php','#','../abonnements/buy-subscriptions.php','../categories/category.php','#','#', '#'); 
      
      $header->head_structure();

    ?>

    <div id="content-wrapper" class="d-flex flex-column">

          <!-- Main Content -->
          <div id="content">

            <!-- header -->

            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

              <ul class="navbar-nav ml-auto">

                <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Messages -->
                <span class="badge badge-danger badge-counter" id="counter_notification"> <!-- js --></span>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown" id="messages">
                <h6 class="dropdown-header">
                  notification(s) reçu(s)
                </h6>



              </div>

            </li>

            <li class="nav-item dropdown no-arrow mx-1" style="margin-top : 15px">

                <a href='../../log-out.php' class="btn btn-danger">Se déconnecter</a>

            </li>


              </ul>

            </nav>
            <!-- header -->

          <!-- Contenu de la page -->
          <div class="container-fluid">
            <div class="container">
              <div class="row">
                <div class="col-md-12">

                      <?php

                        if(isset($_GET["id"]))
                        {

                          $id = $_GET["id"];

                          $connect = connectDb();

                          $data_cat = $connect->query("SELECT * FROM category WHERE category.id =".$id.";");


                          foreach ($data_cat->fetchAll() as $data) 
                          {
                            echo "<h4 class='card-header'>Vous êtes dans la catégorie : ".$data["name"]."</h4>";
                          }
                          
                        }else{

                            echo "<h4 class='card-header'>Vous êtes dans toutes les catégories</h4>";

                        }
                      ?>
                  <nav class="navbar navbar-light bg-light">
                    <div class="form-inline">
                      <input class="form-control mr-sm-2" type="search" id="search-services" placeholder="Chercher un service" aria-label="Search">

                      <button class="btn btn-outline-success my-2 my-sm-0" type="submit" id="search_without_category" onclick="search_services()"></button>
                      <button class="btn btn-outline-success my-2 my-sm-0" type="submit" id="search_with_category" onclick="search_services()"></button>

                      <div class="btn-group">
                      <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Sélectionner une catégorie
                      </button>
                      <div class="dropdown-menu">

                        <?php

                        require_once '../categories/display-categories.php';

                        foreach ($categories as $category)
                        {


                          echo '<a class="dropdown-item" href="../services/services.php?id='.$category['id'].'">'.$category['name'].'</a>';

                        }
                        

                        ?>


                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="category.php">Annuler</a>
                      </div>
                    </div>
                    </div>
                  </nav>
                  <table class="table" id="tableau">
                    <thead>
                      <tr class="btn-dark">
                        <th scope="col">Service</th>
                        <th scope="col">Prix</th>
                        <th scope="col">Image</th>
                        <th scope="col">Acheter</th>
                      </tr>


                    </thead>
                    <tbody>

                      <?php

                    require_once 'display-services.php';

                    foreach($services as $service)
                    {
                      echo "<tr class='table-primary'>";
                      echo "<td>".$service['servicesName']."</td>";
                      if($service["intervalle"] != null)
                       {
                         echo "<td>".$service["price"]."€/".$service["intervalle"]."</td>";

                       }else{

                         echo "<td>".$service["price"]."€</td>";

                       }

                      if($service["img_name"] != null)
                      {
                        echo "<td><img src='../../services/files/".$service['img_name']."' style='width: 250px; height: 200px;'   class='img-thumbnail'></td>";

                      }else{
                        echo "<td>Image indisponible</td>";
                      }
                      echo "<td><a href='#' class='btn btn-success'>Acheter</a></td>";
                      echo "</tr>";
                    }

                  ?>
                    </tbody>
                  </table>


                </div>
              </div>
            </div>
          </div>


        </div>
      </div>


    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script src="../../barre.js"></script>
    <script src="services.js"></script>
    <script src="../../js/notifications.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>
