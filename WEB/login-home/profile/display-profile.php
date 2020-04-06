<?php
require_once '../../functions.php';

 $connect = connectDb();

 $data = $connect->prepare("SELECT * FROM users WHERE email = :email");
 $data->execute([
   'email' => $_SESSION['email']
 ]);
 $result = $data->fetch();


              echo '<div><p><b>' . USER_NAME . ':</b>' . $result['name'] . '</p></div>
                    <div><p><b>' . USER_FIRST_NAME . ':</b>' . $result['firstname'] . '</p></div>
                    <div><p><b>' . USER_PSEUDO . ':</b>' . $result['pseudo'] . '</p></div>
                    <div><p><b>' . USER_EMAIL . ':</b>' . $result['email'] . '</p></div>
                    <div><p><b>' . USER_BIRTHDAY . ':</b>' . $result['birthday'] . '</p></div>
                    <div><p><b>' . USER_GENDER . ':</b>' . $result['gender'] . '</p></div>
                    <div><p><b>' . USER_PHONE . ':</b>' . $result['phone'] . '</p></div>
                    <div><p><b>' . USER_SUBSCRIBED_TO . ':</b>' . isSubscribed($result['email'],
                                  $result['Subscription_id']) . '</p></div>';
                    // <div><a class="btn btn-primary" href="update-profile.php?id='.$result['id'].'">Update</a></td>;

 function isSubscribed($email, $subscription_id){
   $connect = connectDb();
   $d = $connect->prepare("SELECT users.Subscription_id, subscription_offer.name FROM users, subscription_offer
                          WHERE subscription_offer.id = :subscription_id AND email = :email");
   $d->execute([
     'subscription_id' => $subscription_id,
     'email' => $email
   ]);
   $result = $d->fetch();
   if($result['Subscription_id'] == NULL) return 'nothing';
   else return $result['name'];
 }
