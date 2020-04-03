<?php

require_once '../functions.php';


if (
  isset($_POST["name"])
  && isset($_POST["price"])
  && isset($_POST["description"])
  && isset($_POST["option_categories"])

){

    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $option_categories = $_POST['option_categories'];

    //Pour l'importation de l'image



     // $file_name = $_FILES['file']['name'];
     // $file_type = $_FILES['file']['type'];
     // $file_ext = strrchr($file_name, ".");
     // $file_tmp_name = $_FILES['file']['tmp_name'];
     // $file_dest = 'files/'.$file_name;

    //

    $connect = connectDb();


      $data = $connect->prepare("INSERT INTO services(name, price, description, status, Category_id) VALUES(?,?,?,0, ?) ");

      $data -> execute([

      $name,
      $price,
      $description,
      $option_categories

        ]);

}
