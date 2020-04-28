<?php

session_start();
require_once "../../functions.php";

if(empty($_SESSION['firstname']) && empty($_SESSION['firstname']))
{
  header("location: ../../login.php");
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
          .btn {
        background-color: DodgerBlue;
        border: none;
        color: white;
        padding: 12px 30px;
        cursor: pointer;
        font-size: 20px;
      }

      /* Darker background on mouse-over */
      .btn:hover {
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

<body  onload="showBookingDetails()" id="page-top">

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
             
            </div>


    <script type="text/javascript">
     


    function showBookingDetails(){
      if(window.XMLHttpRequest){
        xmlhttp= new XMLHttpRequest();
      } else {
        xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
      }
      xmlhttp.open("GET", "save_booking.php", true);
      xmlhttp.onload=()=>{
       // console.log(xmlhttp.response);
        document.getElementById("booking_recap").innerHTML=xmlhttp.response;
      };
      xmlhttp.send();

    }




    </script>        

    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script src="../../barre.js"></script>
    <script src="category.js"></script>
    <script src="../../js/notifications.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>
