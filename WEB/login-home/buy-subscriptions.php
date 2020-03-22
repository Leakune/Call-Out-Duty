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

	<script src="https://js.stripe.com/v3/"></script>
  <script src="stripe.js" data-rel-js></script>

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
				<a class="nav-link collapsed" href="bill/bill.php">
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
						<div class="p-5 cell example example3" id="example-3">
							<div class="text-center">
								<h1 id="add" class="h4 text-gray-900 mb-4">Souscrire à un abonnement</h1>
							</div>

							<form action="#" method="POST" id="paymentForm">
								<div class="form-row">
									<div class="col-md-4 mb-3">
										<label for="validationDefault01">Nom</label>
										<input type="text" class="form-control field" id="validationDefault01 example3-name" placeholder="Nom" value="" required name="name" data-tid="elements_examples.form.name_label">
									</div>
									<div class="col-md-4 mb-3">
										<label for="validationDefaultUsername">Identifiant</label>
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text" id="inputGroupPrepend2">@</span>
											</div>
											<input type="email" class="form-control field" id="validationDefaultUsername example3-email" placeholder="email" aria-describedby="inputGroupPrepend2" required name="email" data-tid="elements_examples.form.email_label">
										</div>
									</div>
									<div class="col-md-4 mb-3">
										<label for="validationDefault01">Téléphone</label>
										<input type="tel" class="form-control field" id="validationDefault01 example3-phone" placeholder="Phone" value="" required name="name" data-tid="elements_examples.form.phone_label">
									</div>
								</div>

								<div class="form-row">
									<div class="col-md-4 mb-3">
										<label for="validationDefault03">Code</label>
										<input type="text" class="form-control field" id="validationDefault03 example3-card-number" placeholder="1234 1234 1234 1234 " required data-stripe="number">
									</div>
									<div class="col-md-3 mb-3">
										<label for="validationDefault04">Expiration</label>
										<input type="text" class="form-control field" id="validationDefault04 example3-card-expiry" placeholder="MM / YY" required>
									</div>
									<div class="col-md-2 mb-2">
										<label for="validationDefault05">CVC</label>
										<input type="text" class="form-control field" id="validationDefault05 example3-card-cvc" placeholder="Votre CVC" required data-stripe="cvc">
									</div>
									<div class="col-md-3 mb-3">
										<label for="validationDefault06">Code postal</label>
										<input id="example3-zip" data-tid="elements_examples.form.postal_code_placeholder" class="field empty third-width" placeholder="94107">
									</div>
								</div>

								<!-- <div class="form-row">
									<div class="col-md-6 mb-4">
										<label for="validationDefault04">Expiration mois</label>
										<input type="text" class="form-control" id="validationDefault04" placeholder="MM" required data-stripe="exp_month">
									</div>

									<div class="col-md-6 mb-4">
										<label for="validationDefault05">Expiration année</label>
										<input type="text" class="form-control" id="validationDefault05" placeholder="YY" required data-stripe="exp_year">
									</div>
								</div> -->


									<button class="btn btn-primary" data-tid="elements_examples.form.pay_button" type="submit">Acheter</button>
						</form>

					</div>
			</div>
		</div>
	</div>
</div>


	<script src="../barre.js"></script>
  <script src="https://js.stripe.com/v3/"></script>
  <script src="front-login.js"></script>
	<!-- Simple localization script for Stripe's examples page. -->
  <script src="js/l10n.js" data-rel-js></script>
	<script type="text/javascript">
		(function() {
			'use strict';

			var elements = stripe.elements({
				fonts: [
					{
						cssSrc: 'https://fonts.googleapis.com/css?family=Quicksand',
					},
				],
				// Stripe's examples are localized to specific languages, but if
				// you wish to have Elements automatically detect your user's locale,
				// use `locale: 'auto'` instead.
				locale: window.__exampleLocale,
			});

			var elementStyles = {
				base: {
					color: '#fff',
					fontWeight: 600,
					fontFamily: 'Quicksand, Open Sans, Segoe UI, sans-serif',
					fontSize: '16px',
					fontSmoothing: 'antialiased',

					':focus': {
						color: '#424770',
					},

					'::placeholder': {
						color: '#9BACC8',
					},

					':focus::placeholder': {
						color: '#CFD7DF',
					},
				},
				invalid: {
					color: '#fff',
					':focus': {
						color: '#FA755A',
					},
					'::placeholder': {
						color: '#FFCCA5',
					},
				},
			};

			var elementClasses = {
				focus: 'focus',
				empty: 'empty',
				invalid: 'invalid',
			};

			var cardNumber = elements.create('cardNumber', {
				style: elementStyles,
				classes: elementClasses,
			});
			cardNumber.mount('#example3-card-number');

			var cardExpiry = elements.create('cardExpiry', {
				style: elementStyles,
				classes: elementClasses,
			});
			cardExpiry.mount('#example3-card-expiry');

			var cardCvc = elements.create('cardCvc', {
				style: elementStyles,
				classes: elementClasses,
			});
			cardCvc.mount('#example3-card-cvc');

			registerElements([cardNumber, cardExpiry, cardCvc], 'example3');
		})();
	</script>
</body>
</html>
