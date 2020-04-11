<?php

include '../functions.php';

session_start();

$id_user = $_SESSION['id'];

$connect = connectDb();

$date = $connect->query("SELECT dateMeeting FROM reservation WHERE User_id =".$id_user);

?>