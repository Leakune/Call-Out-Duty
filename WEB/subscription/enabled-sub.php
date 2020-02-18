<?php


include '../functions.php';

if(isset($_GET['id'])){

$connect = connectDb();

$enable = $connect->prepare("UPDATE subscription_offer set status= 0 WHERE id = :id;");

$enable->execute([

":id" => $_GET['id']

]);

}

header("Location: ges-subscription.php");

?>