<?php 
	include 'functions.php';

	/* Check connecting
		session_start();
		$connected = isset($_SESSION['email']) ? true : false;

		if(!$connected){
			header('location: connexion.php');
			exit;
		}

	*/

  // Get data from RESERVATION table

    $connect = connectDb();

    $data= $connect->query("SELECT * FROM RESERVATION");

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
    function check_booking_date_status($id){
      $answer=$GLOBALS['connect']->query("SELECT dateMeeting FROM RESERVATION WHERE id='$id'");
      $booking_date=$answer->fetch();
      $today= date("Y-m-d");
      return var_dump($booking_date["dateMeeting"] >= $today);

    }
    function get_booking_status($id){
      $answer=$GLOBALS['connect']->query("SELECT status FROM RESERVATION WHERE id='$id'");
      $value=false;
      $status=$answer->fetch();
     
      if ($status["status"] == 1) // status=1=confirmé
      {
        $value=!$value;
      }

      return $value;
    }


?>

<!DOCTYPE html>
<html>
<head>

	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

	<title>Gestion des réservations</title>
  <!-- Custom fonts for this theme -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">
  <link href="css/bootstrap-yeti.min.css" rel="stylesheet">

  <!-- Theme CSS -->
  <link href="css/freelancer.css" rel="stylesheet">
</head>
<body onload="viewData()">

	  <!-- Navigation -->
  <header class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="#page-top">Call-Out Duty</a>
      <button class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item mx-0 mx-lg-1">
            <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#portfolio">Accès</a>
          </li>
          <li class="nav-item mx-0 mx-lg-1">
            <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#about">A propos</a>
          </li>
          <li class="nav-item mx-0 mx-lg-1">
            <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#contact">Contact</a>
          </li>
          <li class="nav-item mx-0 mx-lg-1">
            <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="register.php">S'inscrire</a>
          </li>
          <li class="nav-item mx-0 mx-lg-1">
            <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="">Se connecter</a>
          </li>
        </ul>
      </div>
    </div>
  </header>



<section  class="page-section portfolio" id="portfolio">
  <div class="container">
    <h5 class="card-title">Gestion des réservations:</h5>
    <table id="tableau" border="1px" class="table table-bordered table-striped">

      <thead class="thead-dark">
        <tr>
            <th>ID</th>
            <th>Date de creation</th>
            <th>Durée</th>
            <th>Montant</th>
            <th>Date du rendez-vous</th>
            <th>Client</th>
            <th>Service</th>
            <th>Status</th>
        </tr>
      </thead>
      <tbody></tbody>
      <?php 
      /*
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
            $actions='<td style="'.'text-align:center">';

            if(check_booking_date_status($reservation["id"])){
            //verifier le status de la reservation
            if(get_booking_status($reservation['id']))
            {
              $actions.='<a class="btn btn-warning marginButton" href="cancel-book.php?id='.$reservation['id'].'">Annuler</a>';
            }
            else
            {
              $actions.='<a class="btn btn-success marginButton" href="confirm-book.php?id='.$reservation['id'].'">Confirmer</a>';
            }
            $actions.='<a class="btn btn-primary marginButton" href="update-book.php?id='.$reservation['id'].'">Modifier</a>';
          }
            echo $actions.'</td>';
          echo "</tr>";

        }

        */
      ?> 

    </table>
  </div>  
  
  
</section>



<script src="js/jquery.min.js"></script>
<script src="js/jquery.tabledit.js"></script>
<script src="js/bootstrap.js"></script>
<script type="text/javascript">

function viewData(){
  $.ajax({
      url: 'actions.php?p=view',
      method: 'GET'
  }).done(function(data){
    $('tbody').html(data)
    tableData()
  })
}
function tableData(){
  $('#tableau').Tabledit({
    url: 'actions.php',
    eventType: 'dblclick',
    editButton: true,
    deleteButton: true,
    hideIdentifier: true,
    buttons: {
    edit: {
        class: 'btn btn-sm btn-warning',
        html: '<span class="glyphicon glyphicon-pencil"></span> Modifier',
        action: 'edit'
    },
    delete: {
        class: 'btn btn-sm btn-danger',
        html: '<span class="glyphicon glyphicon-trash"></span> Annuler',
        action: 'delete'
    },
    save: {
        class: 'btn btn-sm btn-success',
        html: 'Save'
    },
    restore: {
        class: 'btn btn-sm btn-warning',
        html: 'Restore',
        action: 'restore'
    },
    confirm: {
        class: 'btn btn-sm btn-default',
        html: 'Confirm'
    }
    },
    columns:{
        identifier: [0, 'id'],
        editable: [[2, 'duration'],[3, 'amount'],[4, 'dateMeeting']]
    },
    onSuccess: function(data, textStatus, jqXHR) {
        viewData()
    },
    onFail: function(jqXHR, textStatus, errorThrown) {
        console.log('onFail(jqXHR, textStatus, errorThrown)');
        console.log(jqXHR);
        console.log(textStatus);
        console.log(errorThrown);
    },
    onAjax: function(action, serialize) {
        console.log('onAjax(action, serialize)');
        console.log(action);
        console.log(serialize);
    }
  });
}
  

</script>

</body>
</html>
