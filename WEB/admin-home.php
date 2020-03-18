<?php

  include 'functions.php';

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

  <title>Administrateur</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">


  <!-- Theme CSS -->
  <link href="css/freelancer.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.css" rel="stylesheet">

  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>


  <link rel="shortcut icon" href="image/logo.png">
  <link rel="stylesheet" href="themes/blue/pace-theme-corner-indicator.css">  

</head>

<body class="bg-gradient-primary">

<!-- Navigation -->
  <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="index.html">Call-Out Duty</a>
      <button class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        
        <i class="fas fa-bars"></i>
      </button>

      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item mx-0 mx-lg-1">
            <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger bg-secondary" href="log-out.php">Se déconnecter</a>
          </li>
          <li class="nav-item mx-0 mx-lg-1">

        <?php

            echo "<p> Salut ".$_SESSION['firstname']." ".$_SESSION['name']." !</p>";
            
        ?>          


        </li>

          
        </ul>
      </div>
        

    </div>

    

  </nav>

 <div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5 " style="background-color: rgba(128,128,128,0);">
      <div class="card-body p-0">
        <div class="p-5">
          <div class="text-center">
            <h1 id="add" class="h4 text-gray-900 mb-4">Menu de navigation</h1>

            <div class="form-group user"> 
              <div class="col-sm-12 mb-6 mb-sm-4">
                <button type="button" class="btn btn-info"><a class="h2_a" href="ges-users/ges-users.php">Gestion des utilisateurs</a></button>
              </div>              
              <div class="col-sm-12 mb-6 mb-sm-4">
                <button type="button" class="btn btn-info"><a class="h2_a" href="ges-subscription/ges-subscription.php">Gestion des abonnements</a></button>                
              </div>              

              <div class="col-sm-12 mb-6 mb-sm-4">
                <button type="button" class="btn btn-info"><a class="h2_a" href="services/ges-services.php">Gestion des services</a></button>                
              </div>              

              <div class="col-sm-12 mb-6 mb-sm-4">
                <button type="button" class="btn btn-info"><a class="h2_a" href="#">Consulter l'historique des réservations</a></button>                
              </div> 
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
              



    <script src="barre.js"></script> 


</body>
</html>

