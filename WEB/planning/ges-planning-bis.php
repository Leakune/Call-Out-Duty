<?php



function build_planning($month, $year)
{

  $days = ["Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"," Dimanche"];

//trouver le premier jour de chaque mois en fonction des années
  $first_day_on_month = mktime(0, 0, 0, $month, 1, $year);

//Trouver le nombre des jours dans le mois
  $numbers_days= date('t', $first_day_on_month);

//Récupérer des informations sur le premier jour de ce premier mois
  $dateComponents = getdate($first_day_on_month);

  //Récupérer le nom de ce mois
  $monthName = $dateComponents['month'];

  //Récupérer l'index du tableau des jours

  $day_of_week = $dateComponents['wday'];

  //récupérer la date current
  $date_today = date('Y-m-d');

  //Créer la table en html

  $planning = "<table class='table, table-bordered'>";
  $planning .= "<center><h2>$monthName $year</h2></center>";

  $planning .= "<tr>";

  //création du header du Planning

  foreach ($days as $day)
  {
    $planning .= "<th class='header'>$day</th>";

  }

  $planning = "</tr><tr>";

  if($days >0)
  {
    for ($i=0; $i <$days ; $i++)
    {
      $planning .= "<td></td>";
    }
  }

  $currentDay = 1;

  $month = str_pad($month, 2, "0", STR_PAD_LEFT);

  while($currentDay <= $numbers_days)
  {
    $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
    $date = "$year-$month-$currentDayRel";

    $planning.="<td><h4>$currentDay</h4></td>";

    $planning.="</td>";

    $currentDay++;
    $days++;


    if($days == 7){
      $days = 0;
      $planning .= "<tr></tr>";
    }


  }

if($days != 7)
{
  $remainingDays = 7-$days;

  for ($i=0; $i < $remainingDays; $i++) {
    $planning.="<td></td>";
  }
}

$planning.="</tr>";
$planning.="</table>";

echo $planning;


}



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

    <script src="../barre.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="planning.js"></script>

    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <?php

            $dateComponents = getdate();
            $month = $dateComponents['month'];
            $year = $dateComponents['year'];

            echo build_planning($month, $year);

           ?>
        </div>
      </div>
    </div>



</body>
</html>
