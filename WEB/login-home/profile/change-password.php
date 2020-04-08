<?php
session_start();
include "../../functions.php";
if(!(isset($_SESSION['firstname']) && !empty($_SESSION['firstname']))){
	header("location: ../../login.php");
}

if(count($_POST) == 2
    && isset($_POST['pwd'])
    && isset($_POST['pwdConfirm'])

  ){

    $pwd = $_POST['pwd'];
    $pwdConfirm = $_POST['pwdConfirm'];

    $listOfErrors = "";

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


    //Si tout est bon

    if( empty($listOfErrors)){
      //modification des informations du client
      $pwd = password_hash($pwd, PASSWORD_DEFAULT);
      $connect = connectDb();
      $update = $connect->prepare("UPDATE users SET pwd = :pwd WHERE id = :id; ");

      $update->execute([

      ':pwd' => $pwd,
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
							<a class="dropdown-item" href="./change-password.php?lang=fr"><?= DROP_MENU_FR ?></a>
							<a class="dropdown-item" href="./change-password.php?lang=en"><?= DROP_MENU_EN ?></a>
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
      <h1><?= PROFILE_PASSWORD ?></h1>
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
            <label><?= USER_NEW_PASSWORD ?></label>
            <input type="password" class="form-control form-control-user" required="required" name="pwd" placeholder="<?= USER_NEW_PASSWORD ?>">
          </div>
          <div class="col-sm-6">
            <label><?= USER_NEW_PASSWORD_CONFIRM ?></label>
            <input type="password" class="form-control form-control-user" required="required" name="pwdConfirm" placeholder="<?= USER_NEW_PASSWORD_CONFIRM ?>">
          </div>
        </div>

					<input type="submit" value="<?= CHANGE_PASSWORD ?>" class="btn btn-primary btn-user btn-block">

			</form>
		</div>
	 </div>
  </div>
</div>

	<script src="../../barre.js"></script>
  <script src="https://js.stripe.com/v3/"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <!-- <script type="text/javascript" src="profile.js"></script> -->

</body>
</html>
