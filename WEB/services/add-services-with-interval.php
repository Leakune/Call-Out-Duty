<?php

require_once '../functions.php';


if (
  isset($_POST["name"])
  && isset($_POST["price"])
  && isset($_POST["description"])
  && isset($_POST["option_categories"])
  && isset($_POST["option_time"])

){

    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $option_categories = $_POST['option_categories'];
    $option_time = $_POST['option_time'];

    $err = " ";


    //Pour l'importation de l'image



     // $file_name = $_FILES['file']['name'];
     // $file_type = $_FILES['file']['type'];
     // $file_ext = strrchr($file_name, ".");
     // $file_tmp_name = $_FILES['file']['tmp_name'];
     // $file_dest = 'files/'.$file_name;

    //

    $connect = connectDb();

    $data_exist = $connect->prepare("SELECT name, Category_id FROM services WHERE name=? AND Category_id=? ");

    $data_exist -> execute(
      [
        $name,
        $option_categories

      ]);



    if ($data_exist -> rowCount() == 0) 
    {
      
      $data = $connect->prepare("INSERT INTO services(name, price, description, status, Category_id, intervalle) VALUES(?,?,?,0, ?, ?) ");

      $data -> execute([

      $name,
      $price,
      $description,
      $option_categories,
      $option_time

        ]);

    }
}
?>

