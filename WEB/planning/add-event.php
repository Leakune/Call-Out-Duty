<?php

require_once '../functions.php';


if(isset($_POST['dateMeeting']) )
{

  $dateMeeting = $_POST['dateMeeting'];

  $connect = connectDb();

  $data = $connect ->prepare('INSERT INTO RESERVATION (dateMeeting, status)
                              VALUES (?, 0)');

  $data->execute([

    $dateMeeting
  ]);

}
?>
