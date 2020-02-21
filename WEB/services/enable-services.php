<?php


include '../functions.php';

if(isset($_GET['id']))
{

$connect = connectDb();

$enable = $connect->prepare("UPDATE services set status= 1 WHERE id = :id;");

$enable->execute([

":id" => $_GET['id']

]);

}

header("Location: ges-services.php");

?>