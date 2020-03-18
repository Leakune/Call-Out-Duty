<?php

   include '../functions.php';

    // echo "<pre>";
    // var_dump($_FILES);
    // echo "</pre>";


   $connect = connectDb();

        $data = $connect->query("SELECT * FROM services");
