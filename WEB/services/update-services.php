<?php


include '../functions.php';

// var_dump($_FILES);

    if (isset($_GET["id"])
    	&& !empty($_POST["name"])
    	&& !empty($_POST["price"])
    	&& !empty($_POST["description"])
        && !empty($_FILES)

    ){

    	$id = $_GET["id"];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $description = $_POST['description'];

        //Pour l'importation de l'image


         $file_name = $_FILES['img']['name'];
         $file_type = $_FILES['img']['type'];
         $file_ext = strrchr($file_name, ".");
         $file_tmp_name = $_FILES['img']['tmp_name'];
         $file_dest = 'files/'.$file_name;

        //

        $success = "";
        $failed = "";


		$connect = connectDb();

		$update = $connect->prepare("UPDATE services set name = ?, price = ?, img_name = ?, img_path = ?, description = ? WHERE id = ?;");

		$update->execute([

		$id,
		$name,
		$price,
		$file_name,
		$file_dest,
		$description

		]);

	$success = "<div class='alert alert-success'>Service created successful !";

        // header("Location: ges-services.php");
             

    }else{

        $failed = "<div class='alert alert-danger'>Error, check information you put !";

    }


?>

<!DOCTYPE html>
<html>
<head>
	<title>Gestion des services</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link href="../css/freelancer.css" rel="stylesheet">
    <link href="../css/sb-admin-2.css" rel="stylesheet">

    <link rel="stylesheet" href="../themes/blue/pace-theme-corner-indicator.css">  
    <link rel="shortcut icon" href="../image/logo.png">

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
            <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="ges-services.php">Gestion des services</a>
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

        <div class="container">
            <div class="card o-hidden border-0 shadow-lg my-5 ">
              <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                    <div class="p-5">
                      <div class="text-center">
                        <h1 id="add" class="h4 text-gray-900 mb-4">Modifier le service</h1>
                      </div>


                      <center>

 <form class="user" method="POST" enctype="multipart/form-data">

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
            	<div class="col-sm-6 mb-3 mb-sm-2">
    	        	<input type="text" name="name" class="form-control-user form-control" placeholder="Service's name">
    	        </div>
    	        <div class="col-sm-6 mb-3 mb-sm-2">
    	        	<input type="number" step="0.01" name="price" class="form-control-user form-control" placeholder="Price">
    	        </div>
                
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label class="form-control-file" for="exampleFormControlFile1">image</label>
                    <input type="file" name="img" class="form-control-file form-control-user" id="exampleFormControlFile1">
                </div>

    	        <div class="col-sm-6 mb-3 mb-sm-4">
    	        	<textarea type="text" name="description" class="form-control-user form-control" placeholder="About this service"></textarea>
    	        </div>


    	        <div class="col-sm-6 mb-3 mb-sm-2">
    	        	<input type="submit" value="Add service" class="btn btn-primary btn-user btn-block">
    	        </div>
            </div>

        </form>
    </center>

    </div>
    </div>
    </div>
    </div>
    </div>
    </div>

    <script src="../barre.js"></script> 

</body>
</html>

