<?php

include '../../functions.php';

session_start();

//on définit le fuseau horaires de la fonction date()
date_default_timezone_set('Europe/Paris'); 
//

$connect = connectDb();

$query="SELECT id, name, price, intervaltime FROM subscription_offer WHERE status = 0";
$result=$connect->query($query);
$plans=$result->fetchAll();


$userID = $_SESSION["id"];

$payment_id=$statusMsg=$api_error='';

$ordStatus = 'error';



// Check whether stripe token is not empty
if((!empty($_POST['subscr_plan']) || $_POST['subscr_plan']=="0" ) && !empty($_POST['stripeToken'])){

    // Retrieve stripe token, card and user info from the submitted form data
    $token  = $_POST['stripeToken'];
    $name = $_POST['name'];
    $email = $_POST['email'];
/*   
    $card_number = preg_replace('/\s+/', '', $_POST['card_number']);
    $card_exp_month = $_POST['card_exp_month'];
    $card_exp_year = $_POST['card_exp_year'];
    $card_cvc = $_POST['card_cvc'];
 */
    // Plan info
    $planID = $_POST['subscr_plan'];
    $planInfo = $plans[$planID];
    $planName = $planInfo['name'];
    $planPrice = $planInfo['price'];
    $planInterval = $planInfo['intervaltime'];

    // Include Stripe PHP library
    require_once '../../stripe-php/init.php';

    // Set API key
    \Stripe\Stripe::setApiKey(STRIPE_API_KEY);

    // Add customer to stripe
    $customer= \Stripe\Customer::create(array(
    	'email'=>$email,
    	'source'=>$token
    ));

    //Convert price to cents
    $priceCents= round($planPrice*100);

    // Create a plan
    try{
    	$plan= \Stripe\Plan::create(array(
    		"product"=>[
    			"name"=>$planName
    		],
    		"amount"=>$priceCents,
    		"currency"=>"eur",
    		"interval"=>$planInterval,
    		"interval_count"=>1
    	));
    }catch(Exception $e ){
    	$api_error=$e->getMessage();
    }
    if(empty($api_error) && $plan){
    	// Creates a new subscription
    	try{
    		$subscription= \Stripe\Subscription::create(array(
    			"customer" => $customer->id,
    			"items" => array(
    				array(
    					"plan"=>$plan->id,
    				),
    			),
    		));
    	}catch(Exception $e){
    		$api_error=$e->getMessage();
    	}
    	if(empty($api_error) && $subscription){
    		// Retrieve subscription data
    		$subsData= $subscription->jsonSerialize();

    		// Check whether the subscription activation is successful
    		if($subsData['status']=='active')
            {

    			// Subscription infos
    			$subscrID = $subsData['id'];

    			$custID = $subsData['customer'];

    			$plansID = $subsData['plan']['id'];

    			$planAmount = ($subsData['plan']['amount']/100);

    			$planCurrency = $subsData['plan']['currency'];

    			$planinterval = $subsData['plan']['interval'];

    			$planIntervalCount = $subsData['plan']['interval_count'];

    			$created = date("Y-m-d H:i:s", $subsData['created']);

    			$current_period_start = date("Y-m-d H:i:s", $subsData['current_period_start']);

    			$current_period_end = date("Y-m-d H:i:s", $subsData['current_period_end']);
                
    			$status = $subsData['status'];

    			// Include database connection file
    			include_once '../../functions.php';

    			//Insert Transaction data into the database

    			// $sql="INSERT INTO subscription(startDate, SubscriptionOffer_id) VALUES('".$current_period_start."', '".$subscrID."')";
    			// $insert=$GLOBALS['connect']->query($sql);


                    $id_sub = $connect->query("SELECT id from subscription_offer WHERE name ='".$planName."'");

                    foreach ($id_sub as $sub) 
                    {

                        $idSub = $sub["id"];
                    }


                    $insert_to_subscription = $connect->prepare("INSERT INTO subscription(startDate, endDate, SubscriptionOffer_id, status) VALUES(?, ?, ?, 1);");

                    $insert_to_subscription->execute([

                        $current_period_start,
                        $current_period_end,
                        $idSub

                    ]);

                    $last_insert = $connect->lastInsertId();


                    $insert_to_uhso = $connect->prepare("
                    INSERT INTO user_has_subscription_offer(User_id, SubscriptionOffer_id) 
                    VALUES(? , ?);
                    ");

                    $insert_to_uhso->execute([

                        $userID,
                        $idSub

                    ]);


                    $update_sub_id = $connect -> prepare("
                    UPDATE users set Subscription_id = ?
                    WHERE users.id = ? ;");

                    $update_sub_id->execute([

                        $last_insert,
                        $userID

                    ]);


                    $ordStatus='success';
                    $statusMsg='Votre paiement d\'abonnement a été bien fait ';



    			// $sql2="INSERT INTO user_has_subscription_offer(User_id, SubscriptionOffer_id) VALUES('".$userID."', '".$subscrID."')";
    			// $insert2=$GLOBALS['connect']->query($sql2);

    		}else{
    			$statusMsg='Activation de votre abonnement a échouée';
    		}
    	}else{
    		$statusMsg='Création d\'abonnement a échouée';
    	}

    	}else{

    		$statusMsg="Plan creation failed!".$api_error;

    	}

    }else{

    	$statusMsg="Erreur dans le formulaire, merci de réessayez";

    }
  ?>
  <div class="container">
    <div class="status">
        <h1 class="<?php echo $ordStatus; ?>"><?php echo $statusMsg; ?></h1>
        <?php if(!empty($subscrID)){ 

            echo $last_insert;

            ?>

            <h4>Payment Information</h4>
            <p><b>Reference Number:</b> <?php echo $subscrID; ?></p>
            <p><b>Transaction ID:</b> <?php echo $subscrID; ?></p>
            <p><b>Amount:</b> <?php echo $planAmount.' '.$planCurrency; ?></p>

            <h4>Subscription Information</h4>
            <p><b>Plan Name:</b> <?php echo $planName; ?></p>
            <p><b>Amount:</b> <?php echo $planPrice.' eur' ?></p>
            <p><b>Plan Interval:</b> <?php echo $planInterval; ?></p>
            <p><b>Period Start:</b> <?php echo $current_period_start; ?></p>
            <p><b>Period End:</b> <?php echo $current_period_end; ?></p>
            <p><b>Status:</b> <?php echo $status; ?></p>
        <?php } ?>
    </div>
    <a href="buy-subscriptions.php" class="btn-link">Retourner à la page précédente</a>
</div>
