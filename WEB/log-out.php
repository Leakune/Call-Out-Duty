<?php

	session_start();
	$_SESSION = [];

	if(!empty($_SESSION['pseudo']))
	{
	session_destroy();

	header('Location: login.php');

	exit;

	}else{

		header('Location: login.php');
	}

?>
