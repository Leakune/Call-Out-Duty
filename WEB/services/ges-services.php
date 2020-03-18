<?php

require_once 'services.php';
require_once 'add-services.php';

?>

<!DOCTYPE html>
<html>
<head>
	<title>Gestion des services</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link href="../css/freelancer.css" rel="stylesheet">
    <link href="../css/sb-admin-2.css" rel="stylesheet">

    <link rel="shortcut icon" href="../image/logo.png">
    <link rel="stylesheet" href="../themes/blue/pace-theme-corner-indicator.css">


</head>
<body class="bg-gradient-primary">

    <!-- Navigation -->
  <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="../index.html">Call-Out Duty</a>
      <button class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">

        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item mx-0 mx-lg-1">
            <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="../ges-subscription/ges-subscription.php">Gestion des abonnements</a>
          </li>
          <li class="nav-item mx-0 mx-lg-1">
            <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="ges-services.php" id="ongletService">Gestion des services</a>
          </li>
          <li class="nav-item mx-0 mx-lg-1">
            <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="../ges-users/ges-users.php">Gestion des utilisateurs</a>
          </li>
      </div>


        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item mx-0 mx-lg-1">
                    <a class="nav-link py-12 px-0 px-lg-3 rounded js-scroll-trigger" href="#add">Ajouter un service</a>
                </li>
            </ul>
        </div>

    </div>
  </nav>


        <table id="tableau" border="1px" class="table table table-striped" style="margin-top: 15%;">

        <thead class="thead-dark">

            <tr>
                <th>ID</th>
                <th>Nom du service</th>
                <th>Prix du service</th>
                <th>Nom de l'image</th>
                <th>Chemin de l'image</th>
                <th>Description du service</th>
                <th>Status</th>
                <th>Désactiver le service</th>
                <th>Activer le service</th>
                <th>Mettre à jour le service</th>
                <th>Supprimer ce service</th>

            </tr>

        </thead>


        </table>

        <div class="container">
            <div class="card o-hidden border-0 shadow-lg my-5 ">
              <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                    <div class="p-5">
                      <div class="text-center">
                        <h1 id="add" class="h4 text-gray-900 mb-4">Ajouter un service</h1>
                      </div>


                      <center>

        <div  id="formulaire">




            <div class="form-group" enctype="multipart/form-data">
            	<div class="col-sm-6 mb-3 mb-sm-2">
    	        	<input type="text" name="name" id="name-service" class="form-control-user form-control" placeholder="Service's name">
    	        </div>
    	        <div class="col-sm-6 mb-3 mb-sm-2">
    	        	<input type="number" step="0.01" name="price" id="price" class="form-control-user form-control" placeholder="Price">
    	        </div>


    	        <div class="col-sm-6 mb-3 mb-sm-4">
    	        	<textarea type="text" name="description" class="form-control-user form-control" placeholder="About this service" id="description"></textarea>
    	        </div>

							<div class="form-group row">
									<p class="col-sm-12 mb-6 mb-sm-2">
										Quel type de champ est nécessaire à l'ajout de votre service?
									</p>

									<div class="col-sm-6 mb-3 mb-sm-0">

										<button type="button" class="btn btn-info" onclick="addWeightInput()">
												Ajouter un input pour un poids (en kg)
										</button>
									</div>

									<div class="col-sm-6 mb-3 mb-sm-2">
										<button type="button" class="btn btn-info" onclick="addDateInput()">
												Ajouter un input pour une tranche horaires
										</button>


									</div>
							</div>

							<div class="form-group">
								<div id="inputs" class="col-sm-6 mb-3 mb-sm-2">

								</div>



    	        <div class="col-sm-6 mb-3 mb-sm-2">
    	        	<input type="submit" value="Add service" class="btn btn-primary btn-user btn-block" onclick="addServices()">
    	        </div>
            </div>

        </div>


    </center>

    </div>
    </div>
    </div>
    </div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Supprimer cet élément?</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
Cet élément sera supprimé à vie, voulez-vous continuer?
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>

<?php

	echo '<button type="button" class="btn btn-danger" onclick="rmService()">Supprimer</button>';

 ?>


</div>
</div>
</div>
</div>

		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="../barre.js"></script>
    <script src="services.js"></script>

</body>
</html>