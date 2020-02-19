<?php


include '../functions.php';

if(isset($_GET['id']))
{

$connect = connectDb();

$disable = $connect->prepare("UPDATE users set status= 0 WHERE id = :id;");

$disable->execute([

":id" => $_GET['id']

]);

}

header("Location: ges-users.php");

?>