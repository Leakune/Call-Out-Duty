<?php

   require_once '../functions.php';
   require_once 'add-subscription.php';

   $connect = connectDb();

        $data = $connect->query("SELECT * FROM subscription_offer");

?>

<!DOCTYPE html>
<html>
<head>
	<title><?= TITRE_SUBSCRIPTION_OFFER ?></title>
	<meta charset="utf-8">
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
          <div class="dropdown show">
            <a class="btn btn-secondary dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <?= DROP_MENU_LANG ?>
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <a class="dropdown-item" href="./ges-subscription.php?lang=fr"><?= DROP_MENU_FR ?></a>
              <a class="dropdown-item" href="./ges-subscription.php?lang=en"><?= DROP_MENU_EN ?></a>
            </div>
          </div>
          <li class="nav-item mx-0 mx-lg-1">
            <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#page-top" id="ongletAbonnement"><?= GES_SUBS ?></a>
          </li>
          <li class="nav-item mx-0 mx-lg-1">
            <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="../services/ges-services.php"><?= GES_SERVICES ?></a>
          </li>
          <li class="nav-item mx-0 mx-lg-1">
            <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="../ges-users/ges-users.php"><?= GES_USERS ?></a>
          </li>
      </div>


        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item mx-0 mx-lg-1">
                    <a class="nav-link py-12 px-0 px-lg-3 rounded js-scroll-trigger" href="#add"><?= ADD_SUBSCRIPTION_OFFER ?></a>
                </li>
            </ul>
        </div>

    </div>
  </nav>


        <table id="tableau" border="1px" class="table table table-striped" style="margin-top: 15%;">

                <thead class="thead-dark">

                <tr>

                <th><?= SUBSCRIPTION_OFFER_ID ?></th>
                <th><?= SUBSCRIPTION_OFFER_NAME ?></th>
                <th><?= SUBSCRIPTION_OFFER_PRICE ?></th>
                <th><?= SUBSCRIPTION_OFFER_HOUR_PER_MONTH ?></th>
                <th><?= SUBSCRIPTION_OFFER_OPEN_TIME ?></th>
                <th><?= SUBSCRIPTION_OFFER_STATUS ?></th>
                <th><?= SUBSCRIPTION_OFFER_DISABLED ?></th>
                <th><?= SUBSCRIPTION_OFFER_ACTIVATED ?></th>
                <th><?= SUBSCRIPTION_OFFER_UPDATED ?></th>
                <th><?= SUBSCRIPTION_OFFER_DROP ?></th>

                </tr>

                </thead>




        </table>

        <div class="container">
            <div class="card o-hidden border-0 shadow-lg my-5 ">
              <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                    <div class="p-5">
                      <div class="text-center">
                        <h1 id="add" class="h4 text-gray-900 mb-4"><?= ADD_SUBSCRIPTION_OFFER ?></h1>
                      </div>


                      <center>

        <div class="user">

        	<?php

                if (!empty($success)) {

                    echo $success;

                }else{
                    if (empty($failed)) {

                        echo $failed;
                    }
                }

            ?>


            <div class="form-group">
            	<div class="col-sm-6 mb-3 mb-sm-0">
    	        	<input type="text" name="name" class="form-control-user form-control" id="name" placeholder="<?= SUBSCRIPTION_OFFER_NAME ?>">
    	        </div>
    	        <br>
    	        <div class="col-sm-6 mb-3 mb-sm-0">
    	        	<input type="number" name="hourPerMonth" class="form-control-user form-control" id="hour" placeholder="<?= SUBSCRIPTION_OFFER_HOUR_PER_MONTH ?>">
    	        </div>
    	        <br>
    	        <div class="col-sm-6 mb-3 mb-sm-0">
    	        	<input type="number" name="openTime" class="form-control-user form-control" id="openTime" placeholder="<?= SUBSCRIPTION_OFFER_OPEN_TIME ?>">
    	        </div>
    	        <br>
    	        <div class="col-sm-6 mb-3 mb-sm-0">
    	        	<input type="number" name="price" class="form-control-user form-control" id="price" placeholder="<?= SUBSCRIPTION_OFFER_PRICE ?>">
    	        </div>
    	        <br>

    	        <div class="col-sm-6 mb-3 mb-sm-0">
    	        	<input type="submit" value="<?= ADD_OFFER ?>" class="btn btn-primary btn-user btn-block" onclick="add()">
    	        </div>

                <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="submit" value="<?= DISPLAY_SUBSCRIPTIONS_OFFER ?>" class="btn btn-primary btn-user btn-block" onclick="display()">
                </div>

    	        <br>


            </div>

        </div>
    </center>

    </div>
</div>
</div>
</div>
</div>
</div>


    <script src="subscription.js"></script>
    <script src="../barre.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>
