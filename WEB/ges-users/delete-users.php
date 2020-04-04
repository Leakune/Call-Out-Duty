<?php


include '../functions.php';

if(isset($_GET['id'])){

$connect = connectDb();

$delete = $connect->prepare("

	DELETE FROM user_has_address WHERE User_id = (SELECT id FROM users WHERE id = :id);
	DELETE FROM users WHERE id = :id;"
);

$delete->execute([

":id" => $_GET['id'],
":id" => $_GET['id']

]);

}

header("Location: ges-users.php");

?>