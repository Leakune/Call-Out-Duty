
<!DOCTYPE html>
<html lang="fr">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?= $title; ?></title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <link rel="stylesheet" href="themes/blue/pace-theme-corner-indicator.css">


  <!-- Theme CSS -->
  <link href="css/freelancer.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.css" rel="stylesheet">

  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>


  <link rel="shortcut icon" href="image/logo.png">


</head>

<body class="bg-gradient-primary">

<!-- Navigation -->
  <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="index.php">Call-Out Duty</a>
      <button class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">

        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <?= navItem('subscription/ges-subscription.php', 'Abonnements', $_SERVER['SCRIPT_NAME']); ?>
          <?= navItem('service.php', 'Services', $_SERVER['SCRIPT_NAME']); ?>
          <?= navItem('register.php', "S'inscrire", $_SERVER['SCRIPT_NAME']); ?>
          <?= navItem('login.php', 'Se connecter', $_SERVER['SCRIPT_NAME']); ?>
          <?= navItem('register.php', "Consulter l'historique des réservations", $_SERVER['SCRIPT_NAME']); ?>
        </ul>
      </div>
    </div>
  </nav>
