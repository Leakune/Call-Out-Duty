<?php

include 'Stripe.php';

// Set your secret key. Remember to switch to your live secret key in production!
// See your keys here: https://dashboard.stripe.com/account/apikeys
Stripe::setApiKey('pk_test_dbQT1JyUBd6sd8YxcvqSYmS8001hfpDRwN');

$session = \Stripe\Checkout\Session::create([
  'payment_method_types' => ['card'],
  'subscription_data' => [
    'items' => [[
      'plan' => 'plan_123',
    ]],
  ],
  'success_url' => 'localhost',
  'cancel_url' => 'localhost',
]);

 ?>
