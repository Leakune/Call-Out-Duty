<?php

require 'functions.php';

// var_dump($_POST);

session_start();

if(count($_POST) == 17
    && isset($_POST['name'])
    && isset($_POST['firstname'])
    && isset($_POST['pseudo'])
    && isset($_POST['mail'])
    && isset($_POST['pwd'])
    && isset($_POST['pwdConfirm'])
    && isset($_POST['birthday'])
    && isset($_POST['phone'])
    && isset($_POST['captcha'])
    && isset($_POST['noStreet'])
    && isset($_POST['address'])
    && isset($_POST['postal'])
    && isset($_POST['gender'])
    && isset($_POST['city'])
    && isset($_POST['noStreet2'])
    && isset($_POST['address2'])
    && isset($_POST['postal2'])



  ){



    $name = $_POST['name'];
    $firstname = $_POST['firstname'];
    $pseudo = $_POST['pseudo'];
    $email = trim(strtolower($_POST['mail']));
    $pwd = $_POST['pwd'];
    $pwdConfirm = $_POST['pwdConfirm'];
    $birthday = trim($_POST['birthday']);
    $phone = trim($_POST['phone']);
    $captcha = $_POST['captcha'];
    $noStreet = $_POST['noStreet'];
    $address = $_POST['address'];
    $postal = $_POST['postal'];
    $gender = $_POST['gender'];
    $city = $_POST['city'];

    $noStreet2 = $_POST['noStreet2'];
    $address2 = $_POST['address2'];
    $postal2 = $_POST['postal2'];



    $listOfErrors = "";


    if ( strlen($name)<1 || strlen($name)>105)
    {

      $listOfErrors = " &diams; Votre nom doit faire entre 2 et 105 caractères<br>";

    }

    if ( strlen($firstname)<1 || strlen($firstname)>105 )
    {

      $listOfErrors .= " &diams; Votre prénom doit faire entre 2 et 105 caractères<br>";

    }

    $connect = connectDb();

    $check_pseudo = $connect->prepare("SELECT id FROM users WHERE pseudo = ?;");

    $check_pseudo->execute([$pseudo]);

    if (!empty($check_pseudo->fetchAll())) {

        $listOfErrors .= "&diams; Le pseudo existe déjà !<br>";
    }

    if (strlen($pseudo)<1 || strlen($pseudo)>64) {

      $listOfErrors .= "&diams; Votre pseudo doit être compris entre 2 et 64 caractères<br>";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL) ){

      $listOfErrors .= "&diams; Votre email n'est pas valide<br>";

    }

    $connect = connectDb();

    $queryPrepared = $connect->prepare("SELECT id FROM users WHERE email = :email;");

    $queryPrepared->execute([":email"=>$email]);

    if (  !empty( $queryPrepared->fetchAll( ) )  ) {

      $listOfErrors .= "&diams; Votre email existe déjà<br>";

    }

    if( strlen($pwd)<8
      || strlen($pwd)>64
      || !preg_match("#[a-z]#", $pwd)
      || !preg_match("#[A-Z]#", $pwd)
      || !preg_match("#[0-9]#", $pwd)
    ){
      $listOfErrors .= "&diams; Votre mot de passe doit faire entre 8 et 64 caractères avec des minuscules, des majuscules et des chiffres <br>";
    }

    if ($pwd != $pwdConfirm) {

      $listOfErrors .= "&diams; Votre mot de passe de confirmation ne correspond pas<br>";
    }

    $secondlife = time() - strtotime($birthday);

    $yearLife =  $secondlife/3600/24/365.242;

    if ( !preg_match("#\d{4}-\d{2}-\d{2}#", $birthday) ) {

      $listOfErrors .= "&diams; Votre date de naissance doit être au format yyyy-mm-dd<br>";

    } else {

      $birthdayExploded = explode("-", $birthday);

      if ( !checkdate($birthdayExploded[1], $birthdayExploded[2], $birthdayExploded[0]) ){
        $listOfErrors .= "&diams; Votre date de naissance n'existe pas<br>";

      } elseif ($yearLife<16 || $yearLife>120) {
        $listOfErrors .= "&diams; Vous êtes trop jeunes ou trop vieux<br>";
      }

    }

    if (!preg_match("#^0[6-7][0-9]{8}$#", $phone) )
    {

      $listOfErrors .="&diams; Votre numéro de téléphone mobile est incorrect<br>";
    }

    $connect = connectDb();

    $queryPrepared = $connect->prepare("SELECT id FROM users WHERE phone = :phone;");

    $queryPrepared->execute([":phone"=>$phone]);

    if (  !empty( $queryPrepared->fetchAll( ) )  ) {

      $listOfErrors .= "&diams; Votre numéro de téléphone correspond déjà à un utilisateur<br>";

    }

    if($gender != "Mr" && $gender !="Mme" && $gender !="Autre"){

      $listOfErrors .= "&diams; le genre n'existe pas<br>";
    }

    if (!preg_match("#[0-9]{5}$#", $postal)) {

      $listOfErrors .= "&diams; Le code postal est incorrect";

    }


    if(strlen($address) < 5
      || strlen($address) > 100
      || !preg_match("#[a-z]#", $address)
      || preg_match("#[A-Z]#", $address)
      || preg_match("#[0-9]#", $address))
    {
      $listOfErrors .= "&diams; Votre adresse est incorrect<br>";
    }


    if( $captcha != $_SESSION["captcha"] ){

            $listOfErrors .= "&diams; Captcha incorrect<br>";
        }


    //Si tout est bon

    if( empty($listOfErrors)){

      //interaction avec la table users

      $connect = connectDb();

      $queryPrepared_users = $connect->prepare("INSERT INTO users
                      (name, firstname, pseudo, pwd, email, birthday, gender, phone, status)
                      VALUES
                      (?, ?, ?, ?, ?, ?, ?, ?, 0) ");

      $pwd = password_hash($pwd, PASSWORD_DEFAULT);

      $queryPrepared_users->execute( [
        $name,
        $firstname,
        $pseudo,
        $pwd,
        $email,
        $birthday,
        $gender,
        $phone

        ] );

      //Interaction avec table adresse

      $queryPrepared_address = $connect->prepare("INSERT INTO address
                      (noStreet, nameStreet)
                      VALUES
                      (?, ?) ");

      $queryPrepared_address->execute( [

        $noStreet,
        $address


        ] );

      $queryPrepared_address2 = $connect->prepare("INSERT INTO address
                      (noStreet, nameStreet)
                      VALUES
                      (?, ?) ");

      $queryPrepared_address2->execute( [

        $noStreet2,
        $address2


        ] );

      $queryPrepared_postal = $connect->prepare("INSERT INTO city
                      (nameCity, postalCode)
                      VALUES
                      (?, ?) ");

      $queryPrepared_postal->execute( [

        $city,
        $postal


        ] );

      $queryPrepared_postal2 = $connect->prepare("INSERT INTO city
                      (nameCity, postalCode)
                      VALUES
                      (?, ?) ");

      $queryPrepared_postal2->execute( [

        $city,
        $postal2


        ] );


      // $header = "From:support@driving-together.site"."\n";
      // $header .= "Content-type: text/html; charset= utf-8\n";

      // $queryPrepared = $connect -> query("SELECT id from users where email = '".$email."'");

      // $id = $queryPrepared -> fetch();

      // $id = $id[0];

      // $message = "
      //   Veuillez cliquez sur ce lien pour confirmer votre compte:

      //   "."<a target=_blank href='https://www.driving-together.site/confirmation_mail.php?id=".$id."'>Pour confirmer votre compte, c'est ici</a>";

      // mail($email, "Confirmation de votre compte", $message, $header);


      header('Location: index.html');



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

  <title>Inscription</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <link rel="stylesheet" href="themes/blue/pace-theme-corner-indicator.css">


  <link href="css/freelancer.css" rel="stylesheet">
  <link href="css/sb-admin-2.css" rel="stylesheet">

  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>


  <link rel="shortcut icon" href="image/logo.png">
  <script src="barre.js"></script>

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


  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5 ">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-4 d-none d-lg-block bg-register-image"></div>
          <div class="col-lg-8">
            <div class="p-5">
              <div class="text-center">

                <h1 class="h4 text-gray-900 mb-4">Créez votre compte</h1>
              </div>


              <!-- début formulaire -->

              <?php

                  if (isset($listOfErrors)) {

                    echo "<div class='alert alert-danger'>";
                    echo $listOfErrors;
                    echo "</div>";

                  };

              ?>

              <form class="user" method="POST">

                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" required="required" name="name" placeholder="Nom">
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" required="required" name="firstname" placeholder="Prénom">
                  </div>
                </div>


                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="email" class="form-control form-control-user" required="required" name="mail" placeholder="Mail" >
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" required="required" name="pseudo" placeholder="Pseudo">
                  </div>

                </div>

                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control form-control-user" required="required" name="pwd" placeholder="Mot de passe">
                  </div>
                  <div class="col-sm-6">
                    <input type="password" class="form-control form-control-user" required="required" name="pwdConfirm" placeholder="Confirmation du mot de passe">
                  </div>
                </div>

                <center>
                 <div class="form-group row">
                  <div class="col-sm-12 mb-3 mb-sm-0">

                    <label>
                      Homme<input type="radio" class="form-control form-control-user" name="gender" value="Mr">
                    </label>

                    <label>
                      Femme<input type="radio" class="form-control form-control-user" name="gender" value="Mme">
                    </label>

                    <label>
                      Autre<input type="radio" class="form-control form-control-user" name="gender" value="Autre">
                    </label>

                  </div>
                </div>
              </center>

                <div class="form-group row">
                  <div class="col-sm-3 mb-2 mb-sm-0">
                    <input type="number" class="form-control form-control-user" name="noStreet" placeholder="N° voie">
                  </div>
                  <div class="col-sm-6 mb-2 mb-sm-0">
                    <input type="text" class="form-control form-control-user" name="address" placeholder="Adresse n°1">
                  </div>
                  <div class="col-sm-3 mb-2">
                    <input type="number" class="form-control form-control-user" name="postal" placeholder="Code postal n°1">
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-sm-3 mb-2 mb-sm-0">
                    <input type="number" class="form-control form-control-user" name="noStreet2" placeholder="N° voie">
                  </div>
                  <div class="col-sm-6 mb-2 mb-sm-0">
                    <input type="text" class="form-control form-control-user" name="address2" placeholder="Adresse n°2 (facultatif)">
                  </div>
                  <div class="col-sm-3 mb-2">
                    <input type="number" class="form-control form-control-user" name="postal2" placeholder="Code postal n°2 (facultatif)">
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-sm-12 mb-6 mb-sm-0">
                    <input type="text" class="form-control form-control-user" name="city" placeholder="Ville">
                  </div>
                </div>

                <div class="form-group row">

                  <div class="col-sm-6 mb-3 mb-sm-0">
                   <input class="form-control-user form-control" type="date" required="required" name="birthday" placeholder="aaaa-mm-jj">
                  </div>

                  <div class="col-sm-6">
                    <input class="form-control-user form-control" type="phone" placeholder="Mobile" name="phone">
                  </div>

                </div>

                <center>
                <div class="form-group">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                     <img src="captcha.php" width="200px">
                  </div>

                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user " required="required" name="captcha" placeholder="Veuillez saisir le captcha" style="width: 200px">
                  </div>
                </div>
              </center>




                <input type="submit" value="S'inscrire" class="btn btn-primary btn-user btn-block">


              </form>


              <!-- fin formulaire -->

              <hr>
              <div class="text-center">
                <a class="small" href="forgot-password.html">Mot de passe oublié?</a>
              </div>
              <div class="text-center">
                <a class="small" href="login.php">Déjà un compte? Connectez-vous</a>
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


  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>
