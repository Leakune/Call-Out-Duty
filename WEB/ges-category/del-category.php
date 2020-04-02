<?php


include '../functions.php';

if(isset($_GET['id']))
{

	$connect = connectDb();

	$del = $connect->prepare("DELETE FROM CATEGORY WHERE id = :id;");

	$del->execute([

	":id" => $_GET['id']

	]);

}

?>