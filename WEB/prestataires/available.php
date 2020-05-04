<?php


include '../functions.php';

session_start();

if(isset($_SESSION['id']))
{

$connect = connectDb();

$disable = $connect->prepare("UPDATE users set status= 3 WHERE id = :id;");

$disable->execute([

":id" => $_SESSION['id']

]);

}

?>