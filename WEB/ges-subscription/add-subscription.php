<?php

require_once '../functions.php';

    if (isset($_POST["hour"])
    	&& isset($_POST["openTime"])
    	&& isset($_POST["name"])
    	&& isset($_POST["price"])

    ){
        $name = $_POST['name'];
        $price = $_POST['price'];
        $openTime = $_POST['openTime'];
        $hourPerMonth = $_POST['hour'];

        $success ="";
        $failed ="";

    $connect = connectDb();

        $data = $connect->prepare("INSERT INTO subscription_offer(name,price, hourPerMonth, openTime, status) VALUES(?,?,?,?,0) ");

        $data -> execute([

            $name,
            $price,
            $openTime,
            $hourPerMonth

        ]);

        $success = "<div class='alert alert-success'>Offer created successful !";

    }else{

        $failed = "<div class='alert alert-danger'>Error, check information you put !";

    }