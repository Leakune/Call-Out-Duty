<?php


?>

<!DOCTYPE html>
<html lang="fr">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Planning</title>

  <!-- Custom fonts for this template -->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <link href="../css/sb-admin-2.min.css" rel="stylesheet">

  <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

  <link rel="stylesheet" href="../themes/blue/pace-theme-corner-indicator.css">


  <link href="../css/freelancer.css" rel="stylesheet">
  <link href="../css/sb-admin-2.css" rel="stylesheet">
  <link rel="shortcut icon" href="../image/logo.png">


</head>

<body id="page-top">



  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-text mx-3 form-group-row">

          <?php
            session_start();
            echo "Bonjour ".$_SESSION['firstname']." !";

           ?>

        </div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="profil-users.php">
          <span>Mon profil</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <li class="nav-item">
        <a class="nav-link collapsed" href="../planning/ges-planning.php" id="planning">
          <span>Planning</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">
      <!-- Heading -->
      <div class="sidebar-heading">
        Interface
      </div>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#">
          <span>Mes commandes</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="buy-subscriptions.php">
          <span>Abonnements</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#">
          <span>Services</span>
        </a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Interface
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="bill/bill.php">
          <span>Factures</span>
        </a>
      </li>

      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link" href="charts.html">
          <span>Devis</span></a>
      </li>

      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="tables.html">
          <span>Paramètres</span>
        </a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">



    </ul>
    <!-- End of Sidebar -->


    <!-- Début planning -->



    <div class="container">
      <div class="row">
        <div class="col-md-12">

          <h1 id="titre_date"></h1>

          <table class="table table-responsive" id="planning" style="width: 100%">
            <thead class="thead-blue">
              <tr>
              <th style="width: 10%;"></th>
              <th>Lundi</th>
              <th>Mardi</th>
              <th>Mercredi</th>
              <th>Jeudi</th>
              <th>Vendredi</th>
              <th>Samedi</th>
              <th>Dimanche</th>
              <tr>

              <?php

              $j = 1;

                for ($i=0; $i <24  ; $i++)
                {
                    $k = 0;

                    if ($i <= 9 && $j <=9)
                    {
                      echo "<tr>";
                      echo "<th class='thead-blue'>".$k.$i."h-".$k.$j."h</th>";
                      echo "<td class='cell-planning' id='lundi'></td>";
                      echo "<td class='cell-planning' id='mardi'></td>";
                      echo "<td class='cell-planning' id='mercredi'></td>";
                      echo "<td class='cell-planning' id='jeudi'></td>";
                      echo "<td class='cell-planning' id='vendredi'></td>";
                      echo "<td class='cell-planning' id='samedi'></td>";
                      echo "<td class='cell-planning' id='dimanche'></td>";
                      echo "</tr>";
                    }else{
                      echo "<tr>";
                      echo "<th class='thead-blue'>".$i."h-".$j."h</th>";
                      echo "<td class='cell-planning' id='lundi'></td>";
                      echo "<td class='cell-planning' id='mardi'></td>";
                      echo "<td class='cell-planning' id='mercredi'></td>";
                      echo "<td class='cell-planning' id='jeudi'></td>";
                      echo "<td class='cell-planning' id='vendredi'></td>";
                      echo "<td class='cell-planning' id='samedi'></td>";
                      echo "<td class='cell-planning' id='dimanche'></td>";
                      echo "</tr>";

                    }



                  $j++;
                }

               ?>



          </table>

        </div>
      </div>
    </div>


    <!-- Fin planning -->



    <script src="../barre.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="planning.js"></script>

</body>
</html>
