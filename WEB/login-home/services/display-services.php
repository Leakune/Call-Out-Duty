<?php

require_once '../../functions.php';


if (isset($_GET["id"])) 
{
	$id = $_GET["id"];

	$connect = connectDb();

	$services = $connect->query('SELECT *, services.id serviceId, services.name servicesName, category.id categoryId FROM services, category
	WHERE status = 1 
	AND '.$id.' = Category_id
	AND category.id = Category_id;');

}else{
	$connect = connectDb();
	$services = $connect->query('SELECT *, services.name servicesName FROM services');
}