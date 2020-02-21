<?php

   include '../functions.php';

 
   $connect = connectDb();

        $data = $connect->query("SELECT * FROM subscription_offer");

    if (isset($_POST["hourPerMonth"])
    	&& isset($_POST["openTime"])
    	&& isset($_POST["name"])
    	&& isset($_POST["price"])

    ){
        $name = $_POST['name'];
        $price = $_POST['price'];
        $openTime = $_POST['openTime'];
        $hourPerMonth = $_POST['hourPerMonth'];

        $success ="";
        $failed ="";

        $data = $connect->prepare("INSERT INTO subscription_offer(name,price, hourPerMonth, openTime, status) VALUES(?,?,?,?,0) ");

        $data -> execute([

            $name,
            $price,
            $openTime,
            $hourPerMonth

        ]);

        $success = "<div class='alert alert-success'>Offer created successful !";

        header("Location: ges-subscription.php");

    }else{

        $failed = "<div class='alert alert-danger'>Error, check information you put !";

    }


?>

<!DOCTYPE html>
<html>
<head>
	<title>Gestion des offres d'abonnements</title>
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
          <li class="nav-item mx-0 mx-lg-1">
            <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#page-top">Gestion des abonnements</a>
          </li>
          <li class="nav-item mx-0 mx-lg-1">
            <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="../services/ges-services.php">Gestion des services</a>
          </li>
          <li class="nav-item mx-0 mx-lg-1">
            <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="../ges-users/ges-users.php">Gestion des utilisateurs</a>
          </li>
      </div>


        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item mx-0 mx-lg-1">
                    <a class="nav-link py-12 px-0 px-lg-3 rounded js-scroll-trigger" href="#add">Ajouter un abonnement</a>
                </li>          
            </ul>
        </div>

    </div>
  </nav>


        <table id="tableau" border="1px" class="table table table-striped" style="margin-top: 15%;">

                <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Subscription's name</th>
                <th>Price</th>
                <th>Hour per month</th>
                <th>Open Time</th>
                <th>Status</th>
                <th>Disabled offer</th>
                <th>Enable offer</th>
                <th>Update offer</th>
                <th>Delete offer</th>

        </thead>



        <?php

            foreach ($data->fetchAll() as $key => $subscription_offer) {
                echo"<tr>";
                echo "<td>".$subscription_offer["id"]."</td>";
                echo "<td>".$subscription_offer["name"]."</td>";
                echo "<td>".$subscription_offer["price"]."</td>";
                echo "<td>".$subscription_offer["openTime"]."</td>";
                echo "<td>".$subscription_offer["hourPerMonth"]."</td>";
                echo "<td>".$subscription_offer["status"]."</td>";
                echo "<td>".'<a class="btn btn-warning" href="disabled-sub.php?id='.$subscription_offer['id'].'">X</a>'."</td>";
                echo "<td>".'<a class="btn btn-success" href="enabled-sub.php?id='.$subscription_offer['id'].'">V</a>'."</td>";
                echo "<td>".'<a class="btn btn-primary" href="update-sub.php?id='.$subscription_offer['id'].'">Update</a>'."</td>";
                echo "<td>".'<a class="btn btn-danger" href="delete-sub.php?id='.$subscription_offer['id'].'">X</a>'."</td>";
                echo "</tr>";
            }

        ?>

        </table>

        <div class="container">
            <div class="card o-hidden border-0 shadow-lg my-5 ">
              <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                    <div class="p-5">
                      <div class="text-center">
                        <h1 id="add" class="h4 text-gray-900 mb-4">Ajouter une offre d'abonnement</h1>
                      </div>


                      <center>

        <form class="user" method="POST">

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
    	        	<input type="text" name="name" class="form-control-user form-control" id="name" placeholder="Subscription's name">
    	        </div>
    	        <br>
    	        <div class="col-sm-6 mb-3 mb-sm-0">
    	        	<input type="number" name="hourPerMonth" class="form-control-user form-control" id="hour" placeholder="Hour per month">
    	        </div>
    	        <br>
    	        <div class="col-sm-6 mb-3 mb-sm-0">
    	        	<input type="number" name="openTime" class="form-control-user form-control" id="openTime" placeholder="open time">
    	        </div>
    	        <br>
    	        <div class="col-sm-6 mb-3 mb-sm-0">
    	        	<input type="number" name="price" class="form-control-user form-control" id="price" placeholder="price">
    	        </div>
    	        <br>

    	        <div class="col-sm-6 mb-3 mb-sm-0">
    	        	<input type="submit" value="Add offer" class="btn btn-primary btn-user btn-block" onclick="add()">
    	        </div>

    	        <br>


            </div>

        </form>
    </center>

    </div>
</div>
</div>
</div>
</div>
</div>


    <script src="add-subscription.js"></script>
    <script src="../barre.js"></script> 

</body>
</html>

