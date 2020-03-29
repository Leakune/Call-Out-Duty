<?php



	//require_once '../../conf.inc.php';


?>

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

		<!-- Sidebar -->
		<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

			<!-- Sidebar - Brand -->
			<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
				<div class="sidebar-brand-text mx-3 form-group-row">

					<?php



					session_start();
					if(isset($_SESSION['firstname']) && !empty($_SESSION['firstname'])){
						echo "Bonjour ".$_SESSION['firstname']." !";
					}
					else{
						header('location: ../../login.php');
					}

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


		<div class="container">
			<div class="row pt-3 px-4">
      		<form action="payment.php" method="POST" id="paymentFrm">
      			<div class="form-group">

      					<label>Sélectionner un abonnement</label>
      					<select name="subscr_plan" id="subscr_plan" class="form-control">
      					<option selected="selected">Choisir...</option>
      					<?php
      					include "../../functions.php";
      					$connect=connectDb();
      					$query= "SELECT name, price, intervaltime FROM subscription_offer";
      					$result=$connect->query($query);
      					foreach ($result as $id => $plan) {

      					echo "<option value=\"".$id."\">".$plan['name']."[".$plan['price']."€/".$plan['intervaltime']."]</option>";
      				}
      					?>


      					</select>

      			</div>
      			<div class="form-row">
      				<!-- Display errors -->
      				<div class="card-errors"></div>
      				<!-- Payment form -->
      				<div class= "form-group col-md-6">
      					<label>Nom</label>
      					<input type="text" name="name" id="name" placeholder="Votre nom" required="" autofocus="" class="form-control">
      				</div>
      				<div class="form-group col-md-6">
      					<label>Email</label>
      					<input type="email" name="email" id="email" placeholder="Votre mail" required="" class="form-control">
      				</div>
      			</div>
      			<div >
      				<label style="width: 100%;" >
      					<span><span>Carte bancaire</span></span>
      					<div id="card-element" class="field is-empty" ></div>

      				</label>
      			</div>

      		<!--		<div class="form-group">
      					<label>Numéro de votre Carte Bancaire</label>
      					<input type="text" name="card_number" id="card_number" placeholder="1234 1234 1234 1234" maxlength="16"	 autocomplete="off" required="">
      				</div>
      				<div class="row">
      					<div class="left">
      						<div class="form-group">
      							<label>Date d'expiration</label>
      							<div class="col-1">
      								<input type="text" name="card_exp_month" id="card_exp_month" placeholder="MM" maxlength="2" required="">
      							</div>
      							<div class="col-2">
      								<input type="text" name="card_exp_year" id="card_exp_year" placeholder="YYYY" maxlength="4" required="">
      							</div>

      						</div>
      					</div>
      					<div class="right">
      						<div class="form-group">
      							<label>CVC code</label>
      							<input type="text" name="card_cvc" id="card_cvc" placeholder="CVC" maxlength="3" autocomplete="off" required="">
      						</div>

      					</div> -->
      			</div>
      			<button type="submit" class="btn btn-success" id="payBtn">Valider paiement

      			</button>

      		</form>
      </div>
  </div>


	<script src="../../barre.js"></script>
  <script src="https://js.stripe.com/v3/"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="front-login.js"></script>

	<script type="text/javascript">
		// Create a Stripe client.
		 var stripe= Stripe('<?php echo STRIPE_PUBLISHABLE_KEY ?>');
		 var elements= stripe.elements();

		var card = elements.create('card', {
			  'style': {
			    'base': {
			      'fontFamily': 'Arial, sans-serif',

			      'color': '#C1C7CD',
			    },
			    'invalid': {
			      'color': 'red',
			    },
			  }
			});
		card.mount('#card-element');



		function stripeTokenHandler(token) {
		  // Insert the token ID into the form so it gets submitted to the server
		  var form = document.getElementById('paymentFrm');
		  var hiddenInput = document.createElement('input');
		  hiddenInput.setAttribute('type', 'hidden');
		  hiddenInput.setAttribute('name', 'stripeToken');
		  hiddenInput.setAttribute('value', token.id);
		  form.appendChild(hiddenInput);

		  // Submit the form
		  form.submit();
		}

		function subscrPlanHandler(value) {
		  // Insert the token ID into the form so it gets submitted to the server
		  var form = document.getElementById('paymentFrm');
		  var hiddenInput = document.createElement('input');
		  hiddenInput.setAttribute('type', 'hidden');
		  hiddenInput.setAttribute('name', 'subscr_plan');
		  hiddenInput.setAttribute('value', value);
		  form.appendChild(hiddenInput);


		}

		function createToken() {
		  stripe.createToken(card).then(function(result) {
		    if (result.error) {
		      // Inform the user if there was an error
		      var errorElement = document.getElementById('card-errors');
		      errorElement.textContent = result.error.message;
		    } else {
		      // Send the token to your server
		      stripeTokenHandler(result.token);
		    }
		  });
		};

		// Create a token when the form is submitted.
		var form = document.getElementById('paymentFrm');
		form.addEventListener('submit', function(e) {
		  e.preventDefault();
		  var sub= document.getElementById('subscr_plan');
		  var subscr_plan=sub.options[sub.selectedIndex].value;
		  subscrPlanHandler(subscr_plan);
		  createToken();
		});

		card.addEventListener('change', function(event) {
		  var displayError = document.getElementById('card-errors');
		  if (event.error) {
		    displayError.textContent = event.error.message;
		  } else {
		    displayError.textContent = '';
		  }
		});

/*
		// Callback to handle the response from stripe
		function stripeResponseHandler(status, response) {
    		if (response.error) {
       		 // Enable the submit button
       		 $('#payBtn').removeAttr("disabled");
       		 // Display the errors on the form
        	$(".payment-status").html('<p>'+response.error.message+'</p>');
    		} else {
        	var form$ = $("#paymentFrm");
        	// Get token id
       	 	var token = response.id;
       	 	// Insert the token into the form
       	 	var hiddenInput = document.createElement('input');
    		hiddenInput.setAttribute('type', 'hidden');
    		hiddenInput.setAttribute('name', 'stripeToken');
    		hiddenInput.setAttribute('value', token);
       	 	form$.appendChild(hiddenInput);
       	 	console.log(token);
        	// Submit form to the server
        	form$.submit();
    				}
			}

			$(document).ready(function() {
    		// On form submit
   			 $("#paymentFrm").submit(function() {
     			   // Disable the submit button to prevent repeated clicks
        	$('#payBtn').attr("disabled", "disabled");

        	// Create single-use token to charge the user
        	stripe.createToken({
            number: $('#card_number').val(),
            exp_month: $('#card_exp_month').val(),
            exp_year: $('#card_exp_year').val(),
            cvc: $('#card_cvc').val()
       		 }, stripeResponseHandler);

        	// Submit from callback
        	return false;
    			});
			});
*/
	</script>
</body>


</html>
