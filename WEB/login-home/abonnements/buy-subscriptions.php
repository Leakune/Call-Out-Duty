<?php
session_start();
include "../../functions.php";
if(!(isset($_SESSION['firstname']) && !empty($_SESSION['firstname']))){
	header("location: ../../login.php");
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

  <?php


  require_once '../../Header.php';

  $header = new Header("#", '../../planning/ges-planning.php', '#', 'buy-subscriptions.php', '../categories/category.php' ,'../services/services.php', '../bill/bill.php', '#');

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
							<a class="dropdown-item" href="./buy-subscriptions.php?lang=fr"><?= DROP_MENU_FR ?></a>
							<a class="dropdown-item" href="./buy-subscriptions.php?lang=en"><?= DROP_MENU_EN ?></a>
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
			<div class="row pt-3 px-4">
      		<form action="payment.php" method="POST" id="paymentFrm">
      			<div class="form-group">
      					<label><?= SELECT_SUBSCRIPTION ?></label>
      					<select name="subscr_plan" id="subscr_plan" class="form-control">


      					<option selected="selected"><?= CHOOSE ?></option>

      					<?php
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
      					<label><?= NAME ?></label>
      					<input type="text" name="name" id="name" placeholder="<?= YOUR_NAME ?>" required="" autofocus="" class="form-control">
      				</div>
      				<div class="form-group col-md-6">
      					<label><?= EMAIL ?></label>
      					<input type="email" name="email" id="email" placeholder="<?= YOUR_EMAIL ?>" required="" class="form-control">
      				</div>
      			</div>
      			<div >
      				<label style="width: 100%;" >
      					<span><span><?= CREDIT_CARD ?></span></span>
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
      			<button type="submit" class="btn btn-success" id="payBtn"><?= VALIDATE_PAYMENT ?>

      			</button>

      		</form>
      </div>
		</div>
  </div>


	<script src="../../barre.js"></script>
  <script src="https://js.stripe.com/v3/"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
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
