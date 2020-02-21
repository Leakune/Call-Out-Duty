<?php


include '../include/functions.php';

if(isset($_GET['id'])){

$connect = connectDb();

$delete = $connect->prepare("DELETE FROM subscription_offer WHERE id = :id;");

$delete->execute([

":id" => $_GET['id']

]);

}

header("Location: ../ges-subscription.php");

?>
