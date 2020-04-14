<?php

  session_start();
  var_dump($_SESSION);
  include 'functions.php';

  $errorConnection = "";

  if(isset($_POST['email'])
    && isset($_POST['pwd']))
  {


    $email = $_POST['email'];
    $pwd = $_POST['pwd'];

    $connect = connectDb();

    $data_status = $connect->prepare("SELECT status from users where email = ?;");

    $data_status->execute([

      $email

    ]);

    $status = $data_status->fetch();

    // print_r($_POST);

        $connect = connectDb();

        $queryPrepared = $connect->prepare("SELECT id, pwd, name, firstname, email, phone, pseudo, status FROM users where email = ?;");

        $queryPrepared->execute([

         $email

        ]);

        $result = $queryPrepared -> fetch();

        $pwdhashed = $result["pwd"];

        if (password_verify($_POST['pwd'], $pwdhashed))
        {

            if ($status[0] != -1)
            {
              if($status[0] != 0)
              {

                $_SESSION["id"]= $result["id"];
                $_SESSION["firstname"]= $result["firstname"];
                $_SESSION["email"]= $result["email"];
                $_SESSION["name"]= $result["name"];
                $_SESSION["phone"]= $result["phone"];
                $_SESSION["pwd"]= $result["pwd"];
                $_SESSION["pseudo"]=$result["pseudo"];
                $_SESSION["status"]=$result["status"];

                
                header("Location: login-home/login-success.php");

                if($status[0] == 2)
                {
                  header("Location: admin-home.php");
                }
                if ($status[0] == 3) 
                {
                  header("Location: prestataires/home.php");  
                }

                }else{

                $errorConnection .= "<div class='alert alert-danger'>Vous devez confirmer votre compte pour avoir accès à cette interface</div>";

                }
              }else{

              $errorConnection .= "<div class='alert alert-danger'>Compte désactivé</div>";

              }

        }else{

          $errorConnection = "<div class='alert alert-danger'>Identifiants incorrects</div>";

        }

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

  <title>Connexion</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <link rel="stylesheet" href="themes/blue/pace-theme-corner-indicator.css">


  <link href="css/freelancer.css" rel="stylesheet">
  <link href="css/sb-admin-2.css" rel="stylesheet">
  <link rel="shortcut icon" href="image/logo.png">

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
            <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="subcriptions.php">Abonnements</a>
          </li>
          <li class="nav-item mx-0 mx-lg-1">
            <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="services.php">Services</a>
          </li>
          <li class="nav-item mx-0 mx-lg-1">
            <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="register.php">S'inscrire</a>
          </li>
          <li class="nav-item mx-0 mx-lg-1">
            <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="login.php">Se connecter</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!--  -->

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Connexion</h1>
                  </div>

                  <form class="user" method="POST">

                    <?php

                      if (isset($errorConnection)) {

                        echo $errorConnection;

                      }

                      if (isset($status_zero)) {

                        echo $status_zero;
                      }

                    ?>

                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" required="required" placeholder="ID ou email" name="email">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" required="required" placeholder="Mot de passe" name="pwd">
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Se souvenir de moi</label>
                      </div>
                    </div>
                    <input type="submit" value="Se connecter" class="btn btn-primary btn-user btn-block">
                    </a>
                  </form>


                  <div class="text-center">
                    <hr>
                    <a class="small" href="forgot-password.php">Mot de passe oublié?</a>
                  </div>
                  <div class="text-center">
                    <a class="small" href="register.php">Pas de compte? Inscrivez-vous !</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <script src="barre.js"></script>

</body>

</html>
