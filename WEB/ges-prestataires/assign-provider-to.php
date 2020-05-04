<?php

	include '../functions.php';

	$connect = connectDb();

	if(isset($_GET["id"]))
	{

		$reservation_id = $_GET["id"];
		$Provider_id = $_GET["id_prestataires"];

		$update_reservation = $connect->prepare("

		UPDATE RESERVATION SET status=1 WHERE id=? 

		");

		$update_reservation->execute([$reservation_id]);

		$update_provider_id = $connect->prepare("

		UPDATE RESERVATION set Provider_id=? WHERE id=?

		");

		$update_provider_id->execute([

			$Provider_id,
			$reservation_id


		]);

	}

?>