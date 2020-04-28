<?php
	include 'functions.php';
	$connect = connectDb();


	 // Function to get client name with his id
    function get_client_name($id){
      $answer=$GLOBALS['connect']->query("SELECT name, firstName FROM USERS WHERE id='$id'");
      $data=$answer->fetch();
      return $data["name"]." ".$data["firstName"];

    }

  // Function to get service name with his id
    function get_service_name($id){
      $answer=$GLOBALS['connect']->query("SELECT name FROM SERVICES WHERE id='$id'");
      $data=$answer->fetch();
      return $data["name"];
    }

	$page= isset($_GET['p'])? $_GET['p'] : '';
	if($page == 'view'){
		$data=$GLOBALS['connect']->query("SELECT * FROM RESERVATION");
		foreach ($data->fetchAll() as $key => $reservation) {
          echo"<tr>";
            echo "<td>".$reservation["id"]."</td>";
            echo "<td>".$reservation["dateCreation"]."</td>";
            echo "<td>".$reservation["duration"]."</td>";
            echo "<td>".$reservation["amount"]."</td>";
            echo "<td>".$reservation["dateMeeting"]."</td>";
            echo "<td>".get_client_name($reservation["User_id"])."</td>";
            echo "<td>".get_service_name($reservation["Service_id"])."</td>";
            echo "<td>".$reservation["status"]."</td>";
            
        }

	}else{

		header('Content-Type: application/json');

		$input=filter_input_array(INPUT_POST);

		if($input['action']=='edit'){
			$GLOBALS['connect']->query("UPDATE RESERVATION SET duration='".$input['duration']."', amount='".$input['amount']."', dateMeeting='".$input['dateMeeting']."' WHERE id='".$input['id']."'");
		}elseif ($input['action']=='delete'){
			$GLOBALS['connect']->query("UPDATE RESERVATION SET status=2 WHERE id='".$input['id']."'");
		}elseif ($input['action']=='restore') {
			$GLOBALS['connect']->query("UPDATE RESERVATION SET status=1 WHERE id='".$input['id']."'");
		}

		echo json_encode($input);





	}

?>