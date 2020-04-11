<?php


if (isset($_GET["id"])) 
{

	$id = $_GET["id"];

  	$services = $connect->query("SELECT * FROM services WHERE status = 1 AND Category_id =".$id);


}

?>