<?php

include 'functions.php';

$connect = connectDb();

$data = $connect->query('SELECT * from subscription_offer where name = "premium"');

$sub = $data->fetch();

if(!empty($sub)){
  echo "Bénéficez d'un abonnement ".$sub['name']."<br>";
  echo "Prix : ".$sub['price']."€ TTC /an"."<br>";
  echo "Nombres d'heures par mois : ".$sub['hourPerMonth']."h de services/mois"."<br>";
  echo "Nombres de jours par semaine : ".$sub['openTime']."j/7"."<br>";
}else{

  echo "Abonnement non disponible";
}



 ?>
