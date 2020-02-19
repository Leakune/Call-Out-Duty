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
function regexNavActive(string $pathern, string $script_name): int{
	$pathern .= "$#";
	$pathern = "#" . $pathern;
	$preg = preg_match($pathern, $script_name);
	if( $preg == 1) return 1;
	else return -1;
}
function navItem(string $link, string $title, string $script_name): string{
	$active = regexNavActive($link, $script_name);
	$class = 'nav-item mx-0 mx-lg-1';
	if ($active == 1){
		$class .= 'active';
	}
		return '<li class="' . $class . '">
			<a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="'. $link .'">'. $title .'</a>
		</li>';
	}
