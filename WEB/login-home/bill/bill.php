<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Factures</title>

  <!-- Custom fonts for this template -->
  <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <link href="../../css/sb-admin-2.min.css" rel="stylesheet">

  <link href="../../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

  <link rel="stylesheet" href="../../themes/blue/pace-theme-corner-indicator.css">


  <link href="../../css/freelancer.css" rel="stylesheet">
  <link href="../../css/sb-admin-2.css" rel="stylesheet">
  <link rel="shortcut icon" href="../../image/logo.png">


</head>
<body>


	<!-- Page Wrapper -->
	<div id="wrapper">

		  <?php

			  require_once '../../Header.php';

			  $header = new Header("#", '../../planning/ges-planning.php', '#', '../abonnements/buy-subscriptions.php', '#', '../bill/bill.php', '#');

			  $header->head_structure();

		  ?>


		<!-- header -->

		

    <!-- End of header -->

		<div class="contain">

			<div class="container">
						<div class="card-body p-0">
							<!-- Nested Row within Card Body -->
									<div class="p-5">
											<h1 id="add" class="h4 text-gray-900 mb-4">Factures</h1>

												<button type="button" class="btn btn-primary" id="button" onclick="display_bill()">
													Afficher toutes mes factures
												</button>
												<div>

													<table id="generate_bill" border="1px" class="table table table-striped">

													</table>


												</div>



									</div>
						</div>
			</div>
		</div>


		</div>




  <script src="bill.js"></script>
	<script src="../../barre.js"></script>

</body>
</html>
