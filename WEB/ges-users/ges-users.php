<?php

require '../functions.php';


    $connect = connectDb();

        $data_users = $connect->query("SELECT * FROM users;");
        $data_users1 = $connect->query("SELECT * FROM users;");
        $data_address = $connect->query("SELECT * FROM address;");
        $data_city = $connect->query("SELECT * FROM city;");

// var_dump($_POST);

session_start();

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

    }

    header("Location: ges-users.php");


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

  <title>Gestion des utilisateurs</title>

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
  <script src="../barre.js"></script> 

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
          <li class="nav-item mx-0 mx-lg-1">
            <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="subcriptions.php">Gestion des abonnements</a>
          </li>
          <li class="nav-item mx-0 mx-lg-1">
            <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="services.php">Gestion des services</a>
          </li>
          <li class="nav-item mx-0 mx-lg-1">
            <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="register.php">Consulter l'historique des réservations</a>
          </li>
      </div>


        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item mx-0 mx-lg-1">
                    <a class="nav-link py-12 px-0 px-lg-3 rounded js-scroll-trigger" href="#add">Ajouter un utilisateur</a>
                </li>          
            </ul>
        </div>

    </div>
  </nav>


<!-- barre de recherche -->

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="margin-top: 10%;">
      <form class="form-inline">

        <input class="form-control" type="text" id="search-user" placeholder="Rechercher un client" name="search">
        <input class="btn btn-outline-info my-2 my-sm-0" type="submit" value="Chercher">

      </form>
    </div>
  </nav>


  <!--  -->



              <!-- Affichage des utilisateurs -->


              <table id="tableau" border="1px" class="table table table-striped">

            <thead class="thead-dark">
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Pseudo</th>
            <th>Email</th>
            <th>Date de naissance</th>
            <th>Civilité</th>
            <th>No Téléphone</th>
            <th>Adresse postale</th>
            <th>Status</th>
            <th>Abonné(e) à</th>
            <th>Désactiver compte</th>
            <th>Doit confirmer son mail</th>
            <th>Activer compte</th>
            <th>Mettre à jour</th>
            <th>Supprimer définitivement</th>
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

              <!-- Fin affichage -->




  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5 ">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
            <div class="p-5">
              <div class="text-center">
                <h1 id="add" class="h4 text-gray-900 mb-4">Ajouter un utilisateur</h1>
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
                      Autre<input type="radio" class="form-control form-control-user" name="gender" value="Other">
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


                <input type="submit" value="Ajouter un utilisateur" class="btn btn-primary btn-user btn-block">


              </form>


              <!-- fin formulaire -->

            
            </div>
          </div>
        </div>
      </div>
  </div>

</body>
</html>

