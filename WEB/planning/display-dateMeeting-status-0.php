<?php

require_once '../functions.php';


$connect = connectDb();

$data_reservation = $connect->prepare("SELECT dateMeeting FROM RESERVATION WHERE status = 0 AND User_id = ?");

$data_reservation->execute([

	$_SESSION["id"]

]);


?>