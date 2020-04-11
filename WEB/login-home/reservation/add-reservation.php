<?php

require_once '../../functions.php';

session_start();

$id_user = $_SESSION["id"];


if(isset($_POST['option_services']) 
  &&isset($id_user)
  &&isset($_POST['at-date'])
  &&isset($_POST['to-date'])
){

  $atDate = $_POST['at-date'];
  $toDate = $_POST['to-date'];
  $service = $_POST["option_services"];

  $connect = connectDb();

  $data = $connect ->prepare('INSERT INTO RESERVATION (amount, dateMeeting, dateMeetingEnd, status, User_id, Service_id)
                              VALUES ( (SELECT price FROM services WHERE services.id = ?) ,?, ?, 0, ?, ?)');

  $data->execute([

  $service,
  $atDate,
  $toDate,
	$id_user,
	$service

  ]);

}
