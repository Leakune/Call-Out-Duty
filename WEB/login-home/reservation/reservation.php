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

  <title>Réservation</title>

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

      $header = new Header('#','../../planning/ges-planning.php','#' ,'#','../abonnements/buy-subscriptions.php','../categories/category.php','../services/services.php','#', '#'); 
      
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

                  <h1>Réserver un service</h1>

                  <?php

                  if(isset($_GET["id"]))
                  {

                    $id = $_GET["id"];
                  
                    $connect = connectDb();

                    $cat = $connect->prepare("SELECT name from category WHERE id=?");

                    $cat->execute([

                      $id

                    ]);

                    foreach($cat->fetchAll() as $res)
                    {
                      echo "<h3>dans la catégorie : ".$res["name"]."</h3>";
                    }

                  }

                  ?>

                  <div id="div_msg"></div>

                  <div style="margin-top: 70px">

                    <div class="col-sm-12 mb-3 mb-sm-2">
  
                    <div class="row">
                      <div class="col-sm-6 mb-3 mb-sm-2">

                        <label>De :</label>
                        <input type="datetime-local" required="required"  id="at-date" class="form-control-user form-control mb-sm-3">
                      </div>
                      <div class="col-sm-6 mb-3 mb-sm-2">
                        <label>A :</label>
                        <input type="datetime-local" required="required"  id="to-date" class="form-control-user form-control mb-sm-3">

                      </div>

                    </div>


                        <div class="btn-group">
                          <button type="button" class="alert alert-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Sélectionner une catégorie
                          </button>

                          <div class="dropdown-menu">

                            <?php

                            $connect = connectDb();

                            $categories = $connect->query("SELECT * from category");



                            foreach ($categories as $category)
                            {


                              echo '<a class="dropdown-item" href="reservation.php?id='.$category['id'].'">'.$category['name'].'</a>';

                            }

                            ?>


                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Annuler</a>
                          </div>
                       
                        <select id="services_select" class="alert alert-primary">

                          <?php

                          require_once 'display-services.php';

                          foreach ($services as $service) 
                          {

                            if ($service["intervalle"] == null) 
                            {

                              echo "<option value='".$service["id"]."'>".$service["name"]." : ".$service["price"]."€</option>";

                            }else{

                              echo "<option value='".$service["id"]."'>".$service["name"]." : ".$service["price"]."€/".$service['intervalle']."</option>";

                            }

                          }                          

                          ?>
                        </select>

                    </div>
 

                    </div>
                      <input type="submit" value="Réserver" class="btn btn-primary" onclick="add_event()">

                    </div>

                  </div>

                </div>
              </div>
            </div>
          </div>


        </div>
      </div>


    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script src="../../barre.js"></script>
    <script src="../../js/notifications.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script src="reservation.js"></script>
    <!-- <script src="../../js/notifications.js"></script> -->


</body>
</html>
