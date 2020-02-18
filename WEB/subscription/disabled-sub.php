<?php


include '../functions.php';

if(isset($_GET['id'])){

$connect = connectDb();

$disable = $connect->prepare("UPDATE subscription_offer set status= -1 WHERE id = :id;");

$disable->execute([

":id" => $_GET['id']

]);

}

header("Location: ges-subscription.php");

?>