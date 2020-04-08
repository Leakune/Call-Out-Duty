<?php
session_start();
include "../../functions.php";
if(!(isset($_SESSION['firstname']) && !empty($_SESSION['firstname']))){
	header("location: ../../login.php");
}

if(count($_POST) == 7
    && isset($_POST['name'])
    && isset($_POST['firstname'])
    && isset($_POST['pseudo'])
    && isset($_POST['mail'])
    && isset($_POST['birthday'])
    && isset($_POST['phone'])
    && isset($_POST['gender'])
  ){

    $name = $_POST['name'];
    $firstname = $_POST['firstname'];
    $pseudo = $_POST['pseudo'];
    $email = trim(strtolower($_POST['mail']));
    $birthday = trim($_POST['birthday']);
    $phone = trim($_POST['phone']);

    if($_POST['gender'] == "Mr" || $_POST['gender'] == "M.")
      $gender = "M.";
    else if($_POST['gender'] == "Ms" || $_POST['gender'] == "Mme.")
      $gender = "Mme.";
    else $gender = "Autre";

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

    $check_pseudo = $connect->prepare("SELECT id FROM users WHERE pseudo = :pseudo AND email != :email");

    $check_pseudo->execute([
			":pseudo"=>$pseudo,
			"email"=>$_SESSION['email']
		]);

    if (!empty($check_pseudo->fetchAll())) {

        $listOfErrors .= "&diams; Le pseudo existe déjà !<br>";
    }

    if (strlen($pseudo)<1 || strlen($pseudo)>64) {

      $listOfErrors .= "&diams; Votre pseudo doit être compris entre 2 et 64 caractères<br>";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL) ){

      $listOfErrors .= "&diams; Votre email n'est pas valide<br>";

    }


    $queryPrepared = $connect->prepare("SELECT id FROM users WHERE email = :email AND email != :email2");

    $queryPrepared->execute([
			":email"=>$email,
			":email2"=>$_SESSION['email']
		]);

    if (  !empty( $queryPrepared->fetchAll( ) )  ) {

      $listOfErrors .= "&diams; Votre email existe déjà<br>";

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

    $queryPrepared = $connect->prepare("SELECT id FROM users WHERE phone = :phone AND email != :email");

    $queryPrepared->execute([
			":phone"=>$phone,
			":email"=>$_SESSION['email']
		]);

    if (  !empty( $queryPrepared->fetchAll( ) )  ) {

      $listOfErrors .= "&diams; Votre numéro de téléphone correspond déjà à un utilisateur<br>";

    }

    if($gender != "M." && $gender !="Mme." && $gender !="Autre"){

      $listOfErrors .= "&diams; le genre n'existe pas<br>";
    }


    //Si tout est bon

    if( empty($listOfErrors)){
      //modification des informations du client
      $update = $connect->prepare("UPDATE users SET name = :name,
                                                firstname = :firstname,
                                                pseudo = :pseudo,
                                                email = :email,
                                                birthday = :birthday,
                                                gender = :gender,
                                                phone = :phone
                                                WHERE id = :id; ");

      $update->execute([

      ':name' => $name,
      ':firstname' => $firstname,
      ':pseudo' => $pseudo,
      ':email' => $email,
      ':birthday' => $birthday,
      ':gender' => $gender,
      ':phone' => $phone,
      ':id' => $_SESSION['id']

      ]);
      header("location: profile.php?success=1");
    }
  }
?>

<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?= MY_PROFILE ?></title>

  <!-- Custom fonts for this template -->
  <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <link href="../../css/sb-admin-2.min.css" rel="stylesheet">

  <link href="../../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link rel="shortcut icon" href="../../image/logo.png">

  <link rel="stylesheet" href="../../themes/blue/pace-theme-corner-indicator.css">


  <link href="../../css/freelancer.css" rel="stylesheet">
  <link href="../../css/sb-admin-2.css" rel="stylesheet">

	<style media="screen">
		.StripeElement {
			box-sizing: border-box;

			height: 40px;

			padding: 10px 12px;

			border: 1px solid transparent;
			border-radius: 4px;
			background-color: white;

			box-shadow: 0 1px 3px 0 #e6ebf1;
			-webkit-transition: box-shadow 150ms ease;
			transition: box-shadow 150ms ease;
		}

		.StripeElement--focus {
			box-shadow: 0 1px 3px 0 #cfd7df;
		}

		.StripeElement--invalid {
			border-color: #fa755a;
		}

		.StripeElement--webkit-autofill {
			background-color: #fefde5 !important;
		}
		#cbContain{
			width: 100%;
		}
	</style>

</head>
<body>


	<!-- Page Wrapper -->
	<div id="wrapper">

  <?php


  require_once '../../Header.php';

  $header = new Header("profile.php", '../../planning/ges-planning.php', '#', '../abonnements/buy-subscriptions.php', '../categories/category.php' ,'../services/services.php', '../bill/bill.php', '#');

  $header->head_structure();
?>

		<!-- main content -->
		<div id="content-wrapper" class="d-flex flex-column">

			<!-- header -->
			<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

				<ul class="navbar-nav ml-auto">

					<div class="dropdown show">
						<a class="btn btn-secondary dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<?= DROP_MENU_LANG ?>
						</a>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
							<a class="dropdown-item" href="./update-profile.php?lang=fr"><?= DROP_MENU_FR ?></a>
							<a class="dropdown-item" href="./update-profile.php?lang=en"><?= DROP_MENU_EN ?></a>
						</div>
					</div>

					<li class="nav-item dropdown no-arrow mx-1">
						<a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="fas fa-bell fa-fw"></i>
							<!-- Counter - Messages -->
							<span class="badge badge-danger badge-counter" id="counter_notification">
								<!-- On mettra un compteur en js et quand une personne recevra un message, on incremetenra la notification -->

								<!-- code js -->
							</span>
						</a>
						<!-- Dropdown - Messages -->
						<div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown" id="messages">
							<h6 class="dropdown-header">
								<?= NOTIFICATION_RECEIVED ?>
							</h6>

							<button type="button" class="dropdown-item d-flex align-items-center" onclick="counter_decrement()">
								<div class="font-weight-bold">
									<div class="text-truncate content-message">
										sqdsqd
									</div>
								</div>
							</button>

						</div>

					</li>

					<li class="nav-item dropdown no-arrow mx-1" style="margin-top : 15px">

						<a href='../../log-out.php' class="btn btn-danger"><?= DECONNEXION ?></a>

					</li>


				</ul>

			</nav>

		<!-- formulaire -->


	<div class="container">
      <h1><?= PROFILE_UPDATE ?></h1>
		<div class="row pt-3 px-4">
       		<h2><?= PROFILE_DATA_INFORMATION ?></h2>
    </div>
		<div class="row" style="margin-top: 30px;">
			<?php

					if (isset($listOfErrors)) {

						echo "<div class='alert alert-danger'>";
						echo $listOfErrors;
						echo "</div>";

					};
					$connect = connectDb();

					$request = $connect->prepare("SELECT name, firstname, pseudo, email,
																			birthday, gender, phone
																			FROM users
																			WHERE email = ?");
					// echo $_SESSION['email'];
					$request->execute([
						$_SESSION['email']
					]);
					if($request->rowCount() == 0) echo '<div class="alert alert-danger">
																										Error, couldn\'t find your profile
																										</div>';
					$result = $request->fetch();


			?>
			<form class="user" method="POST">


					<div class="form-group row">
						<div class="col-sm-6 mb-3 mb-sm-0">
							<label><?= USER_NAME ?></label>
							<input type="text" name="name" value="<?= $result['name'] ?>" class="form-control-user form-control" placeholder="<?= USER_NAME ?>">
						</div>
						<div class="col-sm-6 mb-3 mb-sm-0">
							<label><?= USER_FIRST_NAME ?></label>
							<input type="text" name="firstname" value="<?= $result['firstname']?>" class="form-control-user form-control" placeholder="<?=  USER_FIRST_NAME ?>">
						</div>
					</div>

					<div class="form-group row">
						<div class="col-sm-6 mb-3 mb-sm-0">
							<label><?= USER_PSEUDO ?></label>
							<input type="text" name="pseudo" value="<?= $result['pseudo'] ?>" class="form-control-user form-control" placeholder="<?= USER_PSEUDO ?>">
						</div>
						<div class="col-sm-6 mb-3 mb-sm-0">
							<label><?= USER_EMAIL ?></label>
							<input type="email" name="mail" value="<?= $result['email'] ?>" class="form-control-user form-control" placeholder="<?= USER_EMAIL ?>">
						</div>
					</div>

					<center>
					 <div class="form-group row">
						<label><?= USER_GENDER ?></label>
						<div class="col-sm-12 mb-3 mb-sm-0">

							<label>
								<?= MAN ?><input type="radio" class="form-control form-control-user" name="gender" value="<?= MR ?>"
																		<?php if(isTheCheckBoxToSelect("M.", $_SESSION['email'])) echo 'checked="checked"'?>>
							</label>

							<label>
								<?= WOMAN ?><input type="radio" class="form-control form-control-user" name="gender" value="<?= MS ?>"
																		<?php if(isTheCheckBoxToSelect("Mme.", $_SESSION['email'])) echo 'checked="checked"'?>>
							</label>

							<label>
								<?= OTHER ?><input type="radio" class="form-control form-control-user" name="gender" value="<?= OTHER ?>"
																		<?php if(isTheCheckBoxToSelect("Autre", $_SESSION['email'])) echo 'checked="checked"'?>>
							</label>

						</div>
					 </div>
				 </center>

					<div class="form-group row">
						<div class="col-sm-6 mb-3 mb-sm-0">
							<label><?= USER_BIRTHDAY ?></label>
							<input type="date" name="birthday" value="<?= $result['birthday']?>" class="form-control-user form-control" placeholder="<?= USER_BIRTHDAY ?>">
						</div>
						<div class="col-sm-6 mb-3 mb-sm-0">
							<label><?= USER_PHONE ?></label>
							<input type="phone" name="phone" value="<?= $result['phone']?>" class="form-control-user form-control" placeholder="<?= USER_PHONE ?>">
						</div>
					</div>

							<input type="submit" value="<?= SET_UPDATE_PROFILE ?>" class="btn btn-primary btn-user btn-block">

			</form>
		</div>
	 </div>
  </div>
</div>
<?php

function isTheCheckBoxToSelect(string $gender, $email): int{
  $connect = connectDb();
  $request = $connect->prepare("SELECT gender FROM users WHERE email = ?");
  $request->execute([
    $email
  ]);
  if($request->rowCount() == 0) echo 'Error, couldn\'t find your gender';
  $result = $request->fetch();

  if($result['gender'] == $gender) return 1;
  else return 0;
}

 ?>

	<script src="../../barre.js"></script>
  <script src="https://js.stripe.com/v3/"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <!-- <script type="text/javascript" src="profile.js"></script> -->

</body>
</html>
