<?php

require_once '../../functions.php';

$connect = connectDb();

$services = $connect->query('SELECT * FROM services WHERE status = 1');