<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Abonnements</title>

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
<body>


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
				<a class="nav-link collapsed" href="buy-subscriptions.php" id="abonnements">
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
				<a class="nav-link collapsed" href="#">
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


		<!-- header -->


		<!-- formulaire -->

		<div class="contain">

			<div class="container">
						<div class="card-body p-0">
							<!-- Nested Row within Card Body -->
									<div class="p-5">
										<div class="text-center">
											<h1 id="add" class="h4 text-gray-900 mb-4">Souscrire à un abonnement</h1>
										</div>

				<form  method="POST" id="paymentForm">
					<div class="form-row">
						<div class="col-md-4 mb-3">
							<label for="validationDefault01">Nom</label>
							<input type="text" class="form-control" id="validationDefault01" placeholder="Nom" value="" required name="name">
						</div>
						<div class="col-md-4 mb-3">
							<label for="validationDefault02">Prénom</label>
							<input type="text" class="form-control" id="validationDefault02" placeholder="Prénom" value="" required>
						</div>
						<div class="col-md-4 mb-3">
							<label for="validationDefaultUsername">Identifiant</label>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text" id="inputGroupPrepend2">@</span>
								</div>
								<input type="email" class="form-control" id="validationDefaultUsername" placeholder="email" aria-describedby="inputGroupPrepend2" required name="email">
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-md-6 mb-3">
							<label for="validationDefault03">Code</label>
							<input type="text" class="form-control" id="validationDefault03" placeholder="1234 1234 1234 1234 " required data-stripe="number">
						</div>
						<div class="col-md-3 mb-3">
							<label for="validationDefault04">Nationalité</label>
							<input type="text" class="form-control" id="validationDefault04" placeholder="Votre nationalité" required>
						</div>
						<div class="col-md-3 mb-3">
							<label for="validationDefault05">CVC</label>
							<input type="text" class="form-control" id="validationDefault05" placeholder="Votre CVC" required data-stripe="cvc">
						</div>
					</div>

							<div class="form-row">

							<div class="col-md-6 mb-4">
								<label for="validationDefault04">Expiration mois</label>
								<input type="text" class="form-control" id="validationDefault04" placeholder="MM" required data-stripe="exp_month">
							</div>

							<div class="col-md-6 mb-4">
								<label for="validationDefault05">Expiration année</label>
								<input type="text" class="form-control" id="validationDefault05" placeholder="YY" required data-stripe="exp_year">
							</div>

						</div>


					<button class="btn btn-primary" type="submit">Acheter</button>
				</form>

		</div>
	</div>
</div>
</div>
</div>






	<script src="../barre.js"></script>
  <script src="https://js.stripe.com/v3/"></script>
  <script src="front-login.js"></script>

</body>
</html>
