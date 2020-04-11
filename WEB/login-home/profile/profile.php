<?php
session_start();
include "../../functions.php";
if(!(isset($_SESSION['firstname']) && !empty($_SESSION['firstname']))){
	header("location: ../../login.php");
}
// echo '<pre>';
// print_r($_SERVER);
// echo '</pre>';
// $CheminComplet = $_SERVER['PHP_SELF'];
// $NomDuFichier = substr($CheminComplet, strrpos($CheminComplet, "/" )+1);
// echo $NomDuFichier;
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
<body onload="displayCustomerData()">
<script type="text/javascript" src="profile.js"></script>

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
							<a class="dropdown-item" href="./profile.php?lang=fr"><?= DROP_MENU_FR ?></a>
							<a class="dropdown-item" href="./profile.php?lang=en"><?= DROP_MENU_EN ?></a>
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
			<?php
						if(isset($_GET['success']) && $_GET['success'] == 1)
							{
								echo '<div class="alert alert-success">'. PROFILE_HAS_BEEN_UPDATED . '</div>';
								echo '<script>redirectIntoLoginPageAfterUpdate()</script>';
							}
			?>
      <h1><?= PROFILE_TITLE ?></h1>
		<div class="row pt-3 px-4">
       		<h2><?= PROFILE_DATA_INFORMATION ?></h2>
        		<div class="col-sm-12 mb-6 mb-sm-0" style="margin-top: 30px;">
        	        <div id="tableCustomer"></div>
									<div>
										<a href="update-profile.php"><input type="button" value="Modifier vos informations"></a>
	                </div>
									<div>
										<a href="change-password.php"><input type="button" value="Changer de mot de passe"></a>
	                </div>
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


</body>


</html>
