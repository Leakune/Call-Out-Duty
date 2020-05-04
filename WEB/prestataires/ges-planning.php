
<?php
  session_start();
  require_once '../functions.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?= SCHEDULE ?></title>

  <!-- Custom fonts for this template -->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <link href="../css/sb-admin-2.min.css" rel="stylesheet">

  <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

  <link rel="stylesheet" href="../themes/blue/pace-theme-corner-indicator.css">


  <link href="../css/freelancer.css" rel="stylesheet">
  <link href="../css/sb-admin-2.css" rel="stylesheet">
  <link rel="shortcut icon" href="../image/logo.png">


</head>

<body id="page-top">



  <!-- Page Wrapper -->
  <div id="wrapper">


    <!-- Sidebar -->
  <?php

  require_once 'HeaderPrestataires.php';

  $header = new HeaderPrestataires("#","ges-planning.php","contrats.php", "status_provider.php");

  $header->head_structure();

  ?>




    <div id="content-wrapper" class="d-flex flex-column">

          <!-- Main Content -->
          <div id="content">

            <!-- header -->

            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

              <ul class="navbar-nav ml-auto">
                <div class="dropdown show">
                  <a class="btn btn-secondary dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?= DROP_MENU_LANG ?>
                  </a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="./ges-planning.php?lang=fr"><?= DROP_MENU_FR ?></a>
                    <a class="dropdown-item" href="./ges-planning.php?lang=en"><?= DROP_MENU_EN ?></a>
                  </div>
                </div>

                <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Messages -->
                <span class="badge badge-danger badge-counter" id="counter_notification">

                </span>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown" id="messages">

                <h6 class="dropdown-header">
                  <?= NOTIFICATION_RECEIVED ?>
                </h6>




              </div>


                <li class="nav-item dropdown no-arrow mx-1" style="margin-top : 15px">

                  <a href='../log-out.php' class="btn btn-danger"><?= DECONNEXION ?></a>

                </li>

            </ul>

          </nav>
            <!-- header -->

            <!-- Contenu de la paget -->
            <div class="container-fluid">

              <!-- Début planning -->


              <div class="container">

                <div class="row">
                  <div class="col-md-12">
                        <h3 class="card-header" id="monthAndYear">

                        </h3>
                              <div class="table-responsive">
                                <table class="table table-bordered table-responsive-sm" id="calendar">
                                    <thead>
                                    <tr>
                                        <th><?= SUNDAY ?></th>
                                        <th><?= MONDAY ?></th>
                                        <th><?= TUESDAY ?></th>
                                        <th><?= WEDNESDAY ?></th>
                                        <th><?= THURSDAY ?></th>
                                        <th><?= FRIDAY ?></th>
                                        <th><?= SATURDAY ?></th>
                                    </tr>
                                    </thead>

                                    <tbody id="planning-body">

                                    </tbody>
                                </table>
                              </div>

                              <div class="form-inline">

                                  <button class="btn btn-outline-primary col-sm-6" id="previous" onclick="previous()">Précédent</button>

                                  <button class="btn btn-outline-primary col-sm-6" id="next" onclick="next()"><?= NEXT ?></button>
                              </div>
                              <br/>
                              <form class="form-inline">

                                  <label class="lead mr-2 ml-2" for="month"><?= GO_TO ?> </label>
                                  <select class="form-control col-sm-4" name="month" id="month" onchange="gotodate()">
                                      <option value=0><? JANUARY ?></option>
                                      <option value=1><?= FEBRUARY ?></option>
                                      <option value=2><?= MARCH ?></option>
                                      <option value=3><?= APRIL ?></option>
                                      <option value=4><?= MAY ?></option>
                                      <option value=5><?= JUNE ?></option>
                                      <option value=6><?= JULLY ?></option>
                                      <option value=7><?= AUGUST ?></option>
                                      <option value=8><?= SEPTEMBER ?></option>
                                      <option value=9><?= OCTOBER ?></option>
                                      <option value=10><?= NOVEMBER ?></option>
                                      <option value=11><?= DECEMBER ?></option>
                                  </select>


                                  <label for="year"></label>
                                  <select class="form-control col-sm-4" name="year" id="year" onchange="gotodate()">
                                  <option value=1990>1990</option>
                                  <option value=1991>1991</option>
                                  <option value=1992>1992</option>
                                  <option value=1993>1993</option>
                                  <option value=1994>1994</option>
                                  <option value=1995>1995</option>
                                  <option value=1996>1996</option>
                                  <option value=1997>1997</option>
                                  <option value=1998>1998</option>
                                  <option value=1999>1999</option>
                                  <option value=2000>2000</option>
                                  <option value=2001>2001</option>
                                  <option value=2002>2002</option>
                                  <option value=2003>2003</option>
                                  <option value=2004>2004</option>
                                  <option value=2005>2005</option>
                                  <option value=2006>2006</option>
                                  <option value=2007>2007</option>
                                  <option value=2008>2008</option>
                                  <option value=2009>2009</option>
                                  <option value=2010>2010</option>
                                  <option value=2011>2011</option>
                                  <option value=2012>2012</option>
                                  <option value=2013>2013</option>
                                  <option value=2014>2014</option>
                                  <option value=2015>2015</option>
                                  <option value=2016>2016</option>
                                  <option value=2017>2017</option>
                                  <option value=2018>2018</option>
                                  <option value=2019>2019</option>
                                  <option value=2020>2020</option>
                                  <option value=2021>2021</option>
                                  <option value=2022>2022</option>
                                  <option value=2023>2023</option>
                                  <option value=2024>2024</option>
                                  <option value=2025>2025</option>
                                  <option value=2026>2026</option>
                                  <option value=2027>2027</option>
                                  <option value=2028>2028</option>
                                  <option value=2029>2029</option>
                                  <option value=2030>2030</option>
                              </select>

                            </form>




                    <!-- Nested Row within Card Body -->
                        <div class="p-5">
                          <div class="text-center">
                            <center>
                            <div class="form-group" id="form-event">

                            </div>
                          </center>
                          </div>
                        </div>
                      </div>
                    </div>



                              


                      </div>

                  </div>
                </div>






    <!-- Fin planning -->



    <script src="../barre.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="planning.js"></script>
    <script src="../js/notifications.js"></script>

</body>
</html>
