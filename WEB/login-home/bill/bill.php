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
				<a class="nav-link collapsed" href="../buy-subscriptions.php" id="abonnements">
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
				<a class="nav-link collapsed" href="#" id="factures">
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
