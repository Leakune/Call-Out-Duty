<?php

require_once '../functions.php';

session_start();

$id_user = $_SESSION["id"];


if(isset($_POST['dateMeeting']) )
{

  $dateMeeting = $_POST['dateMeeting'];

  $connect = connectDb();

  $data = $connect ->prepare('INSERT INTO RESERVATION (dateMeeting, status, User_id)
                              VALUES (?, 0, ?, ?)');

  $data->execute([

    $dateMeeting,
	$id_user	

  ]);

}
