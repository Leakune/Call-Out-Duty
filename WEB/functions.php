<?php

require "conf.inc.php";

function connectDb()
{

	try{

		$connect = new PDO(
			DBDRIVER.":host=".DBHOST.";dbname=".DBNAME.";port=".DBPORT,
			DBUSER,
			DBPWD);

	}catch(Exception $e){

		die('Erreur SQL '.$e->getMessage());

	}

	return $connect;

}
function sendEmailToConfirmPaymentSubscription(string $email){
	$header = "MIME-Version: 1.0\r\n";
	$header.='From: lfavier@live.fr'."\n";
	$header.='Content-type:text/html; charset="utf-8"'."\n";
	$header.='Content-Transfer-Encoding: 8bit';
	$to = $email;
	$subject = "Confirmation du paiement";
	$message='
	<html>
		<body>
			<div align="center">
				Votre paiment pour la subscription a bien été réalisée!
			</div>
		</body>
	</html>
	';
	mail($to, $subject, $message, $header);
}
