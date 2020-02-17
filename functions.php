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
