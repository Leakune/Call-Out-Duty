<?php


include '../functions.php';

if(isset($_GET['id']))
{
	// date("Y-m-d H:i:s", $subsData['created']);
	date_default_timezone_set('Europe/Paris'); 

	$current_date = date("Y-m-d H:i:s");


	$connect = connectDb();

	// $get_last_user = $connect->query("SELECT * FROM subscription, subscription_offer where '".$current_date."' < endDate 

	// 	AND SubscriptionOffer_id = (SELECT subscription_offer.id FROM subscription_offer, subscription WHERE SubscriptionOffer_id = subscription_offer.id) 

	// 	AND subscription_offer.id = SubscriptionOffer_id");




	// foreach ($get_last_user as $last) 
	// {
	// 	echo "<br><div>".$last["endDate"]."</div><br>";
	// 	echo "<br><div>".$last["name"]."</div><br>";
	// 	echo "<br><div>".$last["id"]."</div><br>";
	// }

	$disable = $connect->prepare("UPDATE subscription_offer set status= -1 WHERE id = :id;");

	$disable->execute([

	":id" => $_GET['id']

	]);

}

// header("Location: ges-subscription.php");

?>