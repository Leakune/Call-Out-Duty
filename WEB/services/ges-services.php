<?php

   include '../functions.php';

    // echo "<pre>";
    // var_dump($_FILES);
    // echo "</pre>";

 
   $connect = connectDb();

        $data = $connect->query("SELECT * FROM services");

    if (
    	isset($_POST["name"])
    	&& isset($_POST["price"])
    	&& isset($_POST["description"])
        && !empty($_FILES["img"])

    ){
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

        $success ="";
        $failed ="";

        if ($_FILES['import_lesson']['error'] == 0) 
        {
     
            if (move_uploaded_file($file_tmp_name, $file_dest)) 
            {

            $data = $connect->prepare("INSERT INTO services(name, price, img_name, img_path, description, status) VALUES(?,?,?,?,?,0) ");

            $data -> execute([

                $name,
                $price,
                $file_name,
                $file_dest,
                $description

            ]);

        $success = "<div class='alert alert-success'>Service created successful !";

        header("Location: ges-services.php");
             }
        }

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
            <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="services.php">Gestion des services</a>
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
                <th>Activer le service</th>
                <th>Désactiver le service</th>
                <th>Mettre à jour le service</th>
                <th>Supprimer ce service</th>

        </thead>



        <?php

            foreach ($data->fetchAll() as $key => $service) {
                echo"<tr>";
                echo "<td>".$service["id"]."</td>";
                echo "<td>".$service["name"]."</td>";
                echo "<td>".$service["price"]."</td>";
                echo "<td>".$service["img_name"]."</td>";
                echo "<td>".$service["img_path"]."</td>";
                echo "<td>".$service["description"]."</td>";
                echo "<td>".$service["status"]."</td>";
                echo "<td>".'<a class="btn btn-warning" href="disable-services.php?id='.$service['id'].'">X</a>'."</td>";
                echo "<td>".'<a class="btn btn-success" href="enable-services.php?id='.$service['id'].'">V</a>'."</td>";
                echo "<td>".'<a class="btn btn-primary" href="update-services.php?id='.$service['id'].'">Update</a>'."</td>";
                echo "<td>".'<a class="btn btn-danger" href="delete-services.php?id='.$service['id'].'">X</a>'."</td>";
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
                        <h1 id="add" class="h4 text-gray-900 mb-4">Ajouter un service</h1>
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

