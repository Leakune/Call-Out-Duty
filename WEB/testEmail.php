<?php

  require_once 'functions.php';

  if(isset($_POST['submit']) && isset($_POST['email'])){
    sendEmailToConfirmPaymentSubscription($_POST['email']);
  }
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <div align= "center">
      <h1> Test Email </h1>
      <form method="POST" action="">
        <input type="text" placeholder="votre mail" name="email" required>
        <input type="submit" value="Envoyer un mail" name="submit">
      </form>
  </body>
</html>
