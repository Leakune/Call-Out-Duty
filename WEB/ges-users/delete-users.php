<?php


include '../functions.php';

if(isset($_GET['id'])){

$connect = connectDb();

$delete = $connect->prepare("DELETE FROM users WHERE id = :id;");

$delete->execute([

":id" => $_GET['id']

]);

}

header("Location: ges-users.php");

?>