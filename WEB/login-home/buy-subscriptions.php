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
	</style>
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

			<li class="nav-item">
				<a class="nav-link collapsed" href="../planning/ges-planning.php" id="planning">
					<span>Planning</span></a>
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
									<div class="p-5">
										<div class="text-center">
											<h1 id="add" class="h4 text-gray-900 mb-4">Souscrire à un abonnement</h1>
										</div>

				<form action="/charge" method="POST" id="payment-form">
					<div class="form-row">

						<div class="col-md-8 mb-4" id ="card-element">
							<label for="card-element">Credit or debit card</label>
							<div id="card-element">
		      					<!-- A Stripe Element will be inserted here. -->
		    					</div>

							<!-- Used to display form errors. -->
		    					<div id="card-errors" role="alert"></div>
		  					</div>
						</div>

					</div>

					<button class="btn btn-primary">Submit Payment</button>
				</form>

		</div>
	</div>
</div>
</div>

</div>


	<script src="../barre.js"></script>
  <script src="https://js.stripe.com/v3/"></script>
  <script src="front-login.js"></script>
	<script type="text/javascript">
		// Create a Stripe client.
		var stripe = Stripe('pk_test_b0MvnRqWoapubW770qawT2GX0085l1sVTd');

		// Create an instance of Elements.
		var elements = stripe.elements();

		// Custom styling can be passed to options when creating an Element.
		// (Note that this demo uses a wider set of styles than the guide below.)
		var style = {
			base: {
				color: '#32325d',
				fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
				fontSmoothing: 'antialiased',
				fontSize: '16px',
				'::placeholder': {
					color: '#aab7c4'
				}
			},
			invalid: {
				color: '#fa755a',
				iconColor: '#fa755a'
			}
		};

		// Create an instance of the card Element.
		var card = elements.create('card', {style: style});

		// Add an instance of the card Element into the `card-element` <div>.
		card.mount('#card-element');

		// Handle real-time validation errors from the card Element.
		card.addEventListener('change', function(event) {
			var displayError = document.getElementById('card-errors');
			if (event.error) {
				displayError.textContent = event.error.message;
			} else {
				displayError.textContent = '';
			}
		});

		// Handle form submission.
		var form = document.getElementById('payment-form');
		form.addEventListener('submit', function(event) {
			event.preventDefault();

			stripe.createToken(card).then(function(result) {
				if (result.error) {
					// Inform the user if there was an error.
					var errorElement = document.getElementById('card-errors');
					errorElement.textContent = result.error.message;
				} else {
					// Send the token to your server.
					stripeTokenHandler(result.token);
				}
			});
		});

		// Submit the form with the token ID.
		function stripeTokenHandler(token) {
			// Insert the token ID into the form so it gets submitted to the server
			var form = document.getElementById('payment-form');
			var hiddenInput = document.createElement('input');
			hiddenInput.setAttribute('type', 'hidden');
			hiddenInput.setAttribute('name', 'stripeToken');
			hiddenInput.setAttribute('value', token.id);
			form.appendChild(hiddenInput);

			// Submit the form
			form.submit();
		}
	</script>
</body>
</html>
