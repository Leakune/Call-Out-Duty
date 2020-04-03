<?php

require_once '../functions.php';

    if (isset($_POST["name"])

    ){

        $name = $_POST['name'];

        $success ="";
        $failed ="";

        $connect = connectDb();

        $data = $connect->prepare("INSERT INTO category(name) VALUES(?) ");

        $data -> execute([

            $name

        ]);

    }