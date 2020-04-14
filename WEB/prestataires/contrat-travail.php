<?php

	session_start();
	require_once "../certificat-prestataires.php";
	require_once '../functions.php';

	$id = $_SESSION["id"];
	$name = $_SESSION["name"];
	$firstname = $_SESSION["firstname"];

	$connect = connectDb();

	//adresse

	$data_address = $connect->prepare("SELECT noStreet, nameStreet FROM address, users, user_has_address 
		WHERE user_has_address.User_id = users.id
		AND user_has_address.Address_id = address.id
		AND users.id = ?");

	$data_address->execute([

		$id

	]);

	$address = $data_address->fetch();

	//téléphone

	$no_phone = $connect->prepare("SELECT phone FROM users WHERE id = ?");

	$no_phone->execute([

		$id

	]);

	$phone = $no_phone->fetch();


	$contrat = new PDF("P", "mm", "A4", $id, $name, $firstname, $address[0].' '.$address[1], $phone[0], 'x');
	$contrat->corps();
	



?>