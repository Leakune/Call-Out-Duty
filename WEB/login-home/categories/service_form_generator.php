<?php
	 require_once "../../functions.php";
     $connect = connectDb();
     $nowDate=date('Y-m-dTH:i:s');
     if(isset($_GET['id'])){
     	$service_id=$_GET['id'];
     	echo "
     	<form id=\"regForm\" class=\"center_form\" action=\"save_booking.php\" method=\"post\">
     	<div class=\"form-group\">
     	<label for=\"date\">Date de rendez-vous</label><br>
     	<input type=\"datetime-local\" name=\"date_rdv\" id=\"date_rdv\" min=\"".$nowDate."\">
     	</div>
     	<div class=\"form-group\">
     	<label for=\"duration\">Durée estimée</label><br>
     	<input type=\"number\" name=\"duration\" id=\"duration\" min=\"1\" max=\"4\" step=\"0.5\"\>
     	</div>";

     	$response=$connect->prepare("SELECT * FROM services_details WHERE service_id=?");
     	$response->execute(array($service_id));
     	$inputs=$response->fetchAll();
     	foreach($inputs as $input){

     		echo "<div class=\"form-group\">
     		<label for=\"".$input['keyname']."\">".$input['keyname']."</lab20thanksel><br>
     		<input type=\"text\" class=\"form-control\" name=\"".$input['keyname']."\" id=\"".$input['keyname']."\">
     		</div>";
     		# code...
     	}
     	echo "<p id=\"hidden1\"></p><p id=\"hidden2\"></p></form>";
     }

?>