<?php

include '../functions.php';

// $connect = connectDb();
//
// $id = $connect -> query('SELECT id FROM users WHERE id.');

if(isset($_GET['id']))
{

$id = $_GET['id'];

$connect = connectDb();

$dateMeeting = $connect->prepare("SELECT dateMeeting FROM RESERVATION WHERE id = ?");

$dateMeeting->execute([

$id

]);

echo $id;

}
