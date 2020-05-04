<?php
	//header("Location: booking-success.php");
	session_start();
	require_once "../../functions.php";
	require_once "../../PDF.php";
  // 	print_r($_POST);
    $connect = connectDb();
 //   echo $_SESSION['id'];
    // Create quotation

  $quote=new PDF();
	$quote->AddFont('arial_narrow','','arial_narrow_7.php');
	$quote->AliasNbPages();
	$quote->AddPage();
	$quote->SetFont('Times','',12);

	$quote->SetFont('Arial','B',14);

	function getAddressId( $user_id){
		$response=$GLOBALS['connect']->prepare("SELECT Address_id FROM user_has_address WHERE User_id=?");
		$response->execute([$user_id]);
		$data=$response->fetch();
		return $data['Address_id'];

	}

	function getClientAddress( $id){
	$response=$GLOBALS['connect']->prepare("SELECT noStreet, nameStreet, id FROM address WHERE id=?");
	$address_id=getAddressId($id);
	$response->execute([$address_id]);
	$data=$response->fetch();
	$out['address']=$data['noStreet'].", ".$data['nameStreet'];
	$infoCity=getClientCity($address_id);
	$out['city']=$infoCity['city'];
	$out['cp']=$infoCity['cp'];
	return $out;

	}
	function getClientCity( $address_id){
		$response=$GLOBALS['connect']->prepare("SELECT nameCity, postalCode, City_id FROM city, address_has_city WHERE address_has_city.Address_id=? AND city.id=address_has_city.City_id");
		$response->execute([$address_id]);
		$data=$response->fetch();
		$infoCity['city']=$data['nameCity'];
		$infoCity['cp']=$data['postalCode'];
		return $infoCity;

	}
	function getClientSubscriptionId($user_id){
		$response=$GLOBALS['connect']->prepare("SELECT Subscription_id FROM users WHERE id=?");
		$response->execute([$user_id]);
		$data=$response->fetch();
		return $data['Subscription_id'];

	}

	function getClientSubscription($id){
		$response=$GLOBALS['connect']->prepare("SELECT SubscriptionOffer_id, startDate, name, intervaltime FROM subscription, subscription_offer WHERE subscription.id=? AND subscription_offer.id=subscription.SubscriptionOffer_id");
		$response->execute([getClientSubscriptionId($id)]);
		$data=$response->fetch();
		$out['subscriptionOfferName']=$data['name'];
		$endDate=date('d/m/y', strtotime('+1 '.$data['intervaltime'], strtotime($data['startDate'])));
		$out['period']= "Valable du ".date('d/m/y', strtotime($data['startDate']))." au ".$endDate;
		return $out;
		
	}
	//generate invoices number
	function invoice_num ($input, $pad_len = 7, $prefix = null) {
    if ($pad_len <= strlen($input))
        trigger_error('<strong>$pad_len</strong> peut pas etre inferieur ou egale la longueur de <strong>$input</strong> pour generer numero du devis', E_USER_ERROR);

    if (is_string($prefix))
        return sprintf("%s%s", $prefix, str_pad($input, $pad_len, "0", STR_PAD_LEFT));

    return str_pad($input, $pad_len, "0", STR_PAD_LEFT);
	}

	function getLastBookingId(){
		$response=$GLOBALS['connect']->query("SELECT MAX(id) AS max_id FROM reservation");
		$data=$response->fetch();
		return $data['max_id'];
	}
	function getServiceData(int $id){
		$response=$GLOBALS['connect']->query("SELECT name, price, Category_id FROM services WHERE id='$id'");
		$data=$response->fetch();
		$out['service']=$data['name'];
		$out['amount_ttc']=number_format($data['price']*$_POST['duration'], 2);
		$out['tva']=number_format($out['amount_ttc']*0.196, 2);
		$out['amount_ht']=$out['amount_ttc']+$out['tva'];
		$out['category_id']=$data['Category_id'];
		return $out;
	}
	function getCategoryName(int $id){
		$response=$GLOBALS['connect']->prepare("SELECT name FROM category WHERE id=?");
		$response->execute([$id]);
		$data=$response->fetch();
		return $data['name'];
	}

	function getServiceKeyId($keyName, $service_id){
		echo "keyname".$keyName."1";
		$response=$GLOBALS['connect']->prepare("SELECT * FROM services_details WHERE keyname=? AND service_id=?");

		$response->execute([htmlspecialchars($keyName),$service_id]);
		print_r($response->errorInfo());
		$data=$response->fetch();
		echo "aloService:".$data['id'] ;
		return $data['id'];

	}
	function setKeyValue(String $keyName, String$keyValue, int $booking_id){
		echo "post service id: ". $_POST['service_id'];
		echo " Insert values: service".getServiceKeyId($keyName, $_POST['service_id'])."key value:
		".$keyValue."booking id:".$booking_id;
		$response=$GLOBALS['connect']->prepare("INSERT INTO service_details_values (id_key, value, id_booking) VALUES(?, ?, ?)");
		$response->execute([
			getServiceKeyId($keyName, intval($_POST['service_id'])),
			$keyValue,
			$booking_id
		]);
		echo "Insert ERROR CODE : ";
		print_r($response->errorInfo());
		// code ..
	}
	$inputBookingId=getLastBookingId()+1;
	$clientInfo=getClientAddress($_SESSION['id']);
	$clientSubscription=getClientSubscription($_SESSION['id']);
	$serviceData=getServiceData($_POST['service_id']);

	$quoteName='DEVIS-'.invoice_num(strval($inputBookingId), 7, "F-").date('Y-m-d-H-i-s');
	$quote->ContactInfo($_SESSION['name'],$clientInfo['address'], $clientInfo['city'], "France", $clientInfo['cp'], $_SESSION['phone']);

	$quote->PdfTitle($clientSubscription['subscriptionOfferName'], $_SESSION['name'], $clientInfo['address'], $clientInfo['city'], $clientSubscription['period']);
	
	$quote->PdfTypeNum("DEVIS",invoice_num(strval($inputBookingId), 7, "F-"));
	$quote->PdfTotalMontant(strval($serviceData['amount_ht']), strval($serviceData['tva']), strval($serviceData['amount_ttc']));
	$quote->PdfElements(getCategoryName($_POST['category_id']), $serviceData['service'], $serviceData['amount_ttc']);
	//$quote->out($quoteName, "../../quotes");
	$quote->Output('F','../../quotes/'.$quoteName.'.pdf');
	// Insert DEVIS
	$insert_quote=$connect->prepare("INSERT INTO cost_estimate (emissionDate, pathCostEstimate) VALUES(?,?)");
	$insert_quote->execute(array(date('Y-m-d'), "quotes/".$quoteName));

	$lastbookid=$connect->lastInsertId();
	// Set duration number to time format
	$durationToSeconds=3600*intval($_POST['duration']);
	
	//echo gmdate('H:i:s', (int)$durationToSeconds);
	$hours_duration=floor((int)$durationToSeconds / 3600);
	$min_duration=((int)$durationToSeconds / 60) % 60;
	$sec_duration=(int)$durationToSeconds % 60;
	$duration=sprintf('%02d:%02d:%02d', $hours_duration, $min_duration, $sec_duration);
	
	// Insert Booking
    $booking=$connect->prepare("INSERT INTO reservation (dateCreation, duration, amount, dateMeeting, status, CostEstimate_id, User_id, Service_id) VALUES(?, ?, ?, ?, 0, ?, ?, ?)");
    $booking->execute(array(
    	date('Y-m-d'),
    	$duration,
    	$serviceData['amount_ttc'],
    	$_POST['date_rdv'],
    	$lastbookid,
    	$_SESSION['id'],
    	$_POST['service_id']
    ));
    $booking_id_insred=$connect->lastInsertId();
    $formKeys=array_keys($_POST);
    $services_details="";
    foreach ($_POST as $key => $value) {
    	if ($key != "date_rdv" && $key !="duration" && $key !="service_id" && $key !="category_id") {
    		setKeyValue($key, $value, intval($booking_id_insred));

    		$services_details.="<p>".$key." : ".$value."</p>";
    		
    	}
    }

?>
<!DOCTYPE html>
<html lang="fr">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Catégories</title>

  <!-- Custom fonts for this template -->
  <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <link href="../../css/sb-admin-2.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="../../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

  <link rel="stylesheet" href="../../themes/blue/pace-theme-corner-indicator.css">


  <link href="../../css/freelancer.css" rel="stylesheet">
  <link href="../../css/sb-admin-2.css" rel="stylesheet">
  <link rel="shortcut icon" href="../../image/logo.png">
  <style type="text/css">
          .btn-download {
        background-color: DodgerBlue;
        border: none;
        color: white;
        padding: 12px 30px;
        cursor: pointer;
        font-size: 20px;
      }

      /* Darker background on mouse-over */
      .download:hover {
        background-color: RoyalBlue;
      }
    .center_form{
      margin-left: auto;
      margin-right: auto;
    }
    .inline{
      display: inline-block;
      top: 0;
    }
    .margin{
      margin: 10px;
    }
    .out{
      text-align: center;
      margin-bottom: 10px;
    }
    .selected{
     border: 5px solid red;

    }

    .tab {
    display: none;
    }

    .step {
    height: 50px;
    width: 50px;
    margin: 0 2px;
    background-color: #bbbbbb;
    border: none;  
    border-radius: 50%;
    display: inline-block;
    opacity: 0.5;
    }
    .step.active {
      opacity: 1;
    }

    .step.finish {
     background-color: #4CAF50;
    }
    input.invalid{
      background-color: #ffdddd;
    }
  </style>


</head>

<body   id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <?php


      require_once '../../Header.php';

      $header = new Header('#','../../planning/ges-planning.php','#','../abonnements/buy-subscriptions.php','category.php','../services/services.php','#', '#');

      $header->head_structure();

    ?>

    <div id="content-wrapper" class="d-flex flex-column">

          <!-- Main Content -->
          <div id="content">

            <!-- header -->

            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

              <ul class="navbar-nav ml-auto">

                <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Messages -->
                <span class="badge badge-danger badge-counter" id="counter_notification"> <!-- js --></span>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown" id="messages">
                <h6 class="dropdown-header">
                  notification(s) reçu(s)
                </h6>



              </div>

            </li>

            <li class="nav-item dropdown no-arrow mx-1" style="margin-top : 15px">

                <a href='../../log-out.php' class="btn btn-danger">Se déconnecter</a>

            </li>


              </ul>

            </nav>
            <!-- header -->

            <!-- Contenu de la paget -->
            <div id="booking_recap" class="container">


 <?php

    echo "<div>
    		<h3 class=\"display-4\">Votre réservation a été bien enregistrée !</h2>
    		<p>Date du rendez-vous : ".$_POST['date_rdv']."</p>
    		<p>Adresse de rendez-vous : ".$clientInfo['address'].",".$clientInfo['city']." ".$clientInfo['cp']."</p>
    		<p>Service réservé : ".$serviceData['service']." (".getCategoryName($_POST['category_id']).") </p>".$services_details."
    		<p>Télécharger votre devis : </p>
    		<a href=\"../../quotes/".$quoteName.".pdf\" onclick=\"window.open(this.href); return false;\"><button class=\"btn-download\"><i class=\"fa fa-download\"></i>Télécharger</button></a>
    		</div>";

?>

</div>       

    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script src="../../barre.js"></script>
    <script src="category.js"></script>
    <script src="../../js/notifications.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>

