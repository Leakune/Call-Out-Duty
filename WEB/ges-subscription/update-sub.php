<?php

// echo "<pre>";
// var_dump($_POST);
// echo "</pre>";

// var_dump($_GET);


include '../functions.php';

if(isset($_GET['id'])
	&& !empty($_POST["name"])
	&& !empty($_POST["hourPerMonth"])
	&& !empty($_POST["openTime"])
	&& !empty($_POST["price"])
	){

	echo "string";


	$id = $_GET['id'];
	$name = $_POST["name"];
	$hourPerMonth = $_POST["hourPerMonth"];
	$openTime = $_POST["openTime"];
	$price = $_POST["price"];

$connect = connectDb();

//modification du nom de l'offre
$update = $connect->prepare("UPDATE subscription_offer SET name= ?, price= ?, hourPerMonth= ?, openTime= ?, status = -1 WHERE id = ?; ");

$update->execute([

$id,
$name,
$price,
$hourPerMonth,
$openTime

]);

// //modification du temps en heure des services
// $update_hourPerMonth = $connect->prepare("UPDATE `subscription_offer` SET `hourPerMonth`= ? WHERE id = ?; ");

// $update_hourPerMonth->execute([

// $id,
// $hourPerMonth

// ]);

// //modification du nombre de jour
// $update_openTime = $connect->prepare("UPDATE `subscription_offer` SET `openTime`= ? WHERE id = ?; ");

// $update_openTime->execute([

// $id,
// $openTime

// ]);

// //modification du nombre de jour
// $update_price = $connect->prepare("UPDATE `subscription_offer` SET `price`= ? WHERE id = ?; ");

// $update_price->execute([

// $id,
// $price

// ]);



        $success = "<div class='alert alert-success'>Offer updated !";


}else{

	        $failed = "<div class='alert alert-danger'>Error, check information you put !";

}


?>




<!DOCTYPE html>
<html>
<head>
	<title>Modification des offres d'abonnements</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="../css/freelancer.css" rel="stylesheet">
    <link href="../css/sb-admin-2.css" rel="stylesheet">

</head>
<body  class="bg-gradient-primary">

	<div class="container">

		<?php

            if (!empty($success)) {
                
                // header("Location: ges-subscription.php");


            }else{
                if (empty($failed)) {
                    
                    echo $failed;
                }
            }

        ?>  

    <form class="user" method="POST">


        <div class="form-group">
        	<div class="col-sm-6 mb-3 mb-sm-0">
	        	<input type="text" name="name" class="form-control-user form-control" placeholder="Subscription's name">
	        </div>

	        <div class="col-sm-6 mb-3 mb-sm-0">
	        	<input type="number" name="hourPerMonth" class="form-control-user form-control" placeholder="Hour per month">
	        </div>
	        <div class="col-sm-6 mb-3 mb-sm-0">
	        	<input type="number" name="openTime" class="form-control-user form-control" placeholder="open time">
	        </div>
	        <div class="col-sm-6 mb-3 mb-sm-0">
	        	<input type="number" name="price" class="form-control-user form-control" placeholder="price">
	        </div>
	        <div class="col-sm-6 mb-3 mb-sm-0">
	        	<input type="submit" value="Set offer" class="btn btn-primary btn-user btn-block">
	        </div>

        </div>

    </form>

</div>


</body>
</html>