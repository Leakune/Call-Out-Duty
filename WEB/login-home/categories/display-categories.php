<?php

require_once '../../functions.php';

$connect = connectDb();

$categories = $connect->query('SELECT * FROM category');

