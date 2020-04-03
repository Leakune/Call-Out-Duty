<?php

// Subcription plans






// Database configuration

define("DBDRIVER", "mysql");
define("DBHOST", "localhost");
define("DBNAME", "projet_annuel");
define("DBPORT", "3308");
define("DBUSER", "root");
define("DBPWD", "root");

// STRIPE API CONFIGURATION
define('STRIPE_API_KEY', 'sk_test_jYyNTsbTFHI8H0iZAdF4Tg4r00JIUz3Y50');
define('STRIPE_PUBLISHABLE_KEY', 'pk_test_TkxT5Z5Lo6oueLmqNWil7QHS00AjJMbgra');

//Multilingual

if(empty($_GET['lang']) && empty($_SESSION['lang'])){
    $_SESSION['lang'] = "fr";
}else if(!empty($_GET['lang'])){
    switch($_GET['lang']){
        case "fr":
        $_SESSION['lang'] = "fr";
        break;
        case "en":
        $_SESSION['lang'] = "en";
        break;
        default :
        $_SESSION['lang'] = "fr"; //au cas ou quelqu'un rentre autre chose que fr/en
        break;
    }
}

switch($_SESSION['lang']){
        case "fr":
        $file_language = "libs/lang/fr.inc";
        break;
        case "en":
        $file_language = "libs/lang/en.inc";
        break;
}
require "$file_language";
?>
