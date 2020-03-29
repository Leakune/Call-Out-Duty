<?php

require '../functions.php';


    $connect = connectDb();

        $data_users = $connect->query("SELECT * FROM users;");
        $data_address = $connect->query("SELECT * FROM address;");


session_start();

// echo "ok";

// print_r(array_count_values($_POST) );

if(count($_POST) == 16
    && isset($_POST['name'])
    && isset($_POST['firstname'])
    && isset($_POST['pseudo'])
    && isset($_POST['mail'])
    && isset($_POST['pwd'])
    && isset($_POST['pwdConfirm'])
    && isset($_POST['birthday'])
    && isset($_POST['phone'])
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

      $listOfErrors = " &diams; Le nom doit faire entre 2 et 105 caractères<br>";

    }

    if ( strlen($firstname)<1 || strlen($firstname)>105 )
    {

      $listOfErrors .= " &diams; Le prénom doit faire entre 2 et 105 caractères<br>";

    }

    $connect = connectDb();

    $check_pseudo = $connect->prepare("SELECT id FROM users WHERE pseudo = ?;");

    $check_pseudo->execute([$pseudo]);

    if (!empty($check_pseudo->fetchAll())) {

        $listOfErrors .= "&diams; Le pseudo existe déjà !<br>";
    }

    if (strlen($pseudo)<1 || strlen($pseudo)>64) {

      $listOfErrors .= "&diams; Le pseudo doit être compris entre 2 et 64 caractères<br>";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL) ){

      $listOfErrors .= "&diams; L'email n'est pas valide<br>";

    }

    $connect = connectDb();

    $queryPrepared = $connect->prepare("SELECT id FROM users WHERE email = :email;");

    $queryPrepared->execute([":email"=>$email]);

    if (  !empty( $queryPrepared->fetchAll( ) )  ) {

      $listOfErrors .= "&diams; L'email existe déjà<br>";

    }

    if( strlen($pwd)<8
      || strlen($pwd)>64
      || !preg_match("#[a-z]#", $pwd)
      || !preg_match("#[A-Z]#", $pwd)
      || !preg_match("#[0-9]#", $pwd)
    ){
      $listOfErrors .= "&diams; Le mot de passe doit faire entre 8 et 64 caractères avec des minuscules, des majuscules et des chiffres <br>";
    }

    if ($pwd != $pwdConfirm) {

      $listOfErrors .= "&diams; Le mot de passe de confirmation ne correspond pas<br>";
    }

    $secondlife = time() - strtotime($birthday);

    $yearLife =  $secondlife/3600/24/365.242;

    if ( !preg_match("#\d{4}-\d{2}-\d{2}#", $birthday) ) {

      $listOfErrors .= "&diams; Le date de naissance doit être au format yyyy-mm-dd<br>";

    } else {

      $birthdayExploded = explode("-", $birthday);

      if ( !checkdate($birthdayExploded[1], $birthdayExploded[2], $birthdayExploded[0]) ){
        $listOfErrors .= "&diams; Le date de naissance n'existe pas<br>";

      } elseif ($yearLife<16 || $yearLife>120) {
        $listOfErrors .= "&diams; Vous êtes trop jeunes ou trop vieux<br>";
      }

    }

    if (!preg_match("#^0[6-7][0-9]{8}$#", $phone) )
    {

      $listOfErrors .="&diams; Le numéro de téléphone mobile est incorrect<br>";
    }

    $connect = connectDb();

    $queryPrepared = $connect->prepare("SELECT id FROM users WHERE phone = :phone;");

    $queryPrepared->execute([":phone"=>$phone]);

    if (  !empty( $queryPrepared->fetchAll( ) )  ) {

      $listOfErrors .= "&diams; Le numéro de téléphone correspond déjà à un utilisateur<br>";

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
      $listOfErrors .= "&diams; L'adresse est incorrect<br>";
    }


    //Si tout est bon

    if( empty($listOfErrors)){

      //interaction avec la table users


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

      header("Location: ges-users.php");

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

  <title><?= GES_USERS ?></title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">


  <!-- Theme CSS -->
  <link href="../css/freelancer.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin-2.css" rel="stylesheet">

  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>


  <link rel="shortcut icon" href="../image/logo.png">
  <link rel="stylesheet" href="../themes/blue/pace-theme-corner-indicator.css">

</head>

<body class="bg-gradient-primary">





<!-- Navigation -->
  <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="../index.html">Call-Out Duty</a>
      <button class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">

        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <div class="dropdown show">
            <a class="btn btn-secondary dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <?= DROP_MENU_LANG ?>
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <a class="dropdown-item" href="./ges-users.php?lang=fr"><?= DROP_MENU_FR ?></a>
              <a class="dropdown-item" href="./ges-users.php?lang=en"><?= DROP_MENU_EN ?></a>
            </div>
          </div>
          <li class="nav-item mx-0 mx-lg-1">
            <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="../ges-subscription/ges-subscription.php"><?= GES_SUBS ?></a>
          </li>
          <li class="nav-item mx-0 mx-lg-1">
            <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="../services/ges-services.php"><?= GES_SERVICES ?></a>
          </li>
          <li class="nav-item mx-0 mx-lg-1">
            <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" id="ongletUsers" href="../ges-users/ges-users.php"><?= GES_USERS ?></a>
          </li>
      </div>


        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item mx-0 mx-lg-1">
                    <a class="nav-link py-12 px-0 px-lg-3 rounded js-scroll-trigger" href="#add"><?= ADD_USER ?></a>
                </li>
            </ul>
        </div>

    </div>
  </nav>


<!-- barre de recherche -->

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="margin-top: 15%;">
      <div class="form-inline">

        <input class="form-control" type="text" id="search-user" placeholder="<?= SEARCH_BAR_CLIENT ?>" name="search">
        <input class="btn btn-outline-info my-2 my-sm-0" type="submit" value="<?= SEARCH_BAR ?>" onclick="search_users()">

      </div>

      <div class="form-inline">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-outline-info my-2 my-sm-0" data-toggle="modal" data-target="#exampleModal">
          <?= HELP_SEARCH_BAR ?>
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= HOW_TO_SEARCH_BAR ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                &diams; <?= HOW_TO_SEARCH_BAR_CONDITION ?><br>
                 <?= HOW_TO_SEARCH_BAR_NAME ?> <br>
                 <?= HOW_TO_SEARCH_BAR_FIRST_NAME ?> <br>
                 <?= HOW_TO_SEARCH_BAR_EMAIL ?> <br>
                 <?= HOW_TO_SEARCH_BAR_PSEUDO ?> <br>
                 <?= HOW_TO_SEARCH_BAR_PHONE ?>
                <br><br>
                &diams; <?= HOW_TO_SEARCH_BAR_REMARK ?>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= SEARCH_BAR_CLOSE ?></button>
              </div>
            </div>
          </div>
        </div>

      </div>

      <div class="form-inline">
        <button type="button" class="btn btn-outline-info my-2 my-sm-0" onclick="display()">
          <?= DISPLAY_USERS ?>
        </button>
      </div>

  </nav>


  <!--  -->



              <!-- Affichage des utilisateurs -->


              <div class="table-responsive">
              <table id="tableau" border="1px" class="table table table-striped">

            <thead class="thead-dark">
        <tr>
            <th><?= USER_ID ?></th>
            <th><?= USER_NAME ?></th>
            <th><?= USER_FIRST_NAME ?></th>
            <th><?= USER_PSEUDO ?></th>
            <th><?= USER_EMAIL ?></th>
            <th><?= USER_BIRTHDAY ?></th>
            <th><?= USER_GENDER ?></th>
            <th><?= USER_PHONE ?></th>
            <th><?= USER_ADDRESS ?></th>
            <th><?= USER_STATUS ?></th>
            <th><?= USER_SUBSCRIBED_TO ?></th>
            <th><?= USER_DISABLE_ACCOUNT ?></th>
            <th><?= USER_MUST_CONFIRM_EMAIL ?></th>
            <th><?= USER_ACTIVATE_ACCOUNT ?></th>
            <th><?= USER_UPDATE ?></th>
            <th><?= USER_DROP ?></th>
        </tr>


             </thead>



    <?php

    //Attribution des adresses respectives à chaque user

        foreach ($data_address->fetchAll() as $key => $address)
        {
            foreach ($data_users->fetchAll() as $key => $users)
            {

            echo"<tr>";
            echo "<td>".$users["id"]."</td>";
            echo "<td>".$users["name"]."</td>";
            echo "<td>".$users["firstname"]."</td>";
            echo "<td>".$users["pseudo"]."</td>";
            echo "<td>".$users["email"]."</td>";
            echo "<td>".$users["birthday"]."</td>";
            echo "<td>".$users["gender"]."</td>";
            echo "<td>".$users["phone"]."</td>";
            echo "<td>".$address["noStreet"]." ".$address["nameStreet"]."</td>";
            echo "<td>".$users["status"]."</td>";
            echo "<td>".$users["Subscription_id"]."</td>";
            echo "<td>".'<a class="btn btn-warning" href="disable-users.php?id='.$users['id'].'">X</a>'."</td>";
            echo "<td>".'<a class="btn btn-secondary" href="no-mail-users.php?id='.$users['id'].'">No confirmed mail</a>'."</td>";
            echo "<td>".'<a class="btn btn-success" href="enable-users.php?id='.$users['id'].'">V</a>'."</td>";
            echo "<td>".'<a class="btn btn-primary" href="update-users.php?id='.$users['id'].'">Update</a>'."</td>";
            echo "<td>".'<a class="btn btn-danger" href="delete-users.php?id='.$users['id'].'">X</a>'."</td>";
            echo "</tr>";
            }
        }

    ?>

    </table>

  </div>

              <!-- Fin affichage -->




  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5 ">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
            <div class="p-5">
              <div class="text-center">
                <h1 id="add" class="h4 text-gray-900 mb-4"><?= ADD_USER ?></h1>
              </div>


              <!-- début formulaire -->

              <?php

                if (!empty($listOfErrors)) {

                  echo "<div class='alert alert-danger'>";
                  echo $listOfErrors;
                  echo "</div>";

                };

              ?>

              <form class="user" method="POST">

                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" required="required" name="name" placeholder="<?= USER_NAME ?>">
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" required="required" name="firstname" placeholder="<?= USER_FIRST_NAME ?>">
                  </div>
                </div>


                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="email" class="form-control form-control-user" required="required" name="mail" placeholder="<?= USER_EMAIL ?>" >
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" required="required" name="pseudo" placeholder="<?= USER_PSEUDO ?>">
                  </div>

                </div>

                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control form-control-user" required="required" name="pwd" placeholder="<?= USER_PASSWORD ?>">
                  </div>
                  <div class="col-sm-6">
                    <input type="password" class="form-control form-control-user" required="required" name="pwdConfirm" placeholder="<?= USER_CONFIRM_PASSWORD ?>">
                  </div>
                </div>

                <center>
                 <div class="form-group row">
                  <div class="col-sm-12 mb-3 mb-sm-0">

                    <label>
                      <?= MAN ?><input type="radio" class="form-control form-control-user" name="gender" value="Mr">
                    </label>

                    <label>
                      <?= WOMAN ?><input type="radio" class="form-control form-control-user" name="gender" value="Mme">
                    </label>

                    <label>
                      <?= OTHER ?><input type="radio" class="form-control form-control-user" name="gender" value="Other">
                    </label>

                  </div>
                </div>
              </center>

                <div class="form-group row">
                  <div class="col-sm-3 mb-2 mb-sm-0">
                    <input type="number" class="form-control form-control-user" name="noStreet" placeholder="<?= ADDRESS_NUMBER_STREET ?>">
                  </div>
                  <div class="col-sm-6 mb-2 mb-sm-0">
                    <input type="text" class="form-control form-control-user" name="address" placeholder="<?= ADDRESS_1 ?>">
                  </div>
                  <div class="col-sm-3 mb-2">
                    <input type="number" class="form-control form-control-user" name="postal" placeholder="<?= ADDRESS_POST_CODE_1 ?>">
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-sm-3 mb-2 mb-sm-0">
                    <input type="number" class="form-control form-control-user" name="noStreet2" placeholder="<?= ADDRESS_NUMBER_STREET ?>">
                  </div>
                  <div class="col-sm-6 mb-2 mb-sm-0">
                    <input type="text" class="form-control form-control-user" name="address2" placeholder="<?= ADDRESS_2 ?>">
                  </div>
                  <div class="col-sm-3 mb-2">
                    <input type="number" class="form-control form-control-user" name="postal2" placeholder="<?= ADDRESS_POST_CODE_2 ?>">
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-sm-12 mb-6 mb-sm-0">
                    <input type="text" class="form-control form-control-user" name="city" placeholder="<?= CITY ?>">
                  </div>
                </div>

                <div class="form-group row">

                  <div class="col-sm-6 mb-3 mb-sm-0">
                   <input class="form-control-user form-control" type="date" required="required" name="birthday" placeholder="<?= BIRTHDAY_IN_A_DATE_FORMAT ?>">
                  </div>

                  <div class="col-sm-6">
                    <input class="form-control-user form-control" type="phone" placeholder="<?= MOBILE ?>" name="phone">
                  </div>

                </div>


                <input type="submit" value="<?= ADD_USER ?>" class="btn btn-primary btn-user btn-block">


              </form>


              <!-- fin formulaire -->


            </div>
          </div>
        </div>
      </div>
  </div>


  <script src="../barre.js"></script>
  <script src="users.js"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>
