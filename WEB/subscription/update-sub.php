<?php


include '../functions.php';

if(isset($_GET['id'])
	&& !empty($_POST["name"])
	&& !empty($_POST["hourPerMonth"])
	&& !empty($_POST["openTime"])
	&& !empty($_POST["price"])
	){


	$id = $_GET['id'];
	$name = $_POST["name"];
	$hourPerMonth = $_POST["hourPerMonth"];
	$openTime = $_POST["openTime"];
	$price = $_POST["price"];

$connect = connectDb();

$enable = $connect->prepare("UPDATE subscription_offer set name = ?, price = ?, hourPerMonth = ?, openTime = ?, status = -1)  WHERE id = ?;");

$enable->execute([

$id,
$name,
$price,
$hourPerMonth,
$openTime

]);

        $success = "<div class='alert alert-success'>Offer updated !";


}else{

	        $failed = "<div class='alert alert-danger'>Error, check information you put !";

}

// header("Location: ges-subscription.php");

?>




<!DOCTYPE html>
<html>
<head>
	<title>Modification des offres d'abonnements</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="css/freelancer.css" rel="stylesheet">
    <link href="css/sb-admin-2.css" rel="stylesheet">

</head>
<body>

	<div class="container">

		<?php

            if (!empty($success)) {
                
                echo $success;

            }else{
                if (empty($failed)) {
                    
                    echo $failed;
                }
            }

        ?>  

    <form method="POST">


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
	        	<input type="submit" value="Set offer" class="btn btn-primary btn-user btn-block" onclick="add()">
	        </div>

	        <br>


        </div>

    </form>

</div>


    <script src="add-subscription.js"></script>

</body>
</html>