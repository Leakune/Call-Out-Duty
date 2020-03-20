<?php


?>

<!DOCTYPE html>
<html lang="fr">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Planning</title>

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
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-text mx-3 form-group-row">

          <?php
            session_start();
            echo "Bonjour ".$_SESSION['firstname']." !";

           ?>

        </div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="profil-users.php">
          <span>Mon profil</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <li class="nav-item">
        <a class="nav-link collapsed" href="../planning/ges-planning.php" id="planning">
          <span>Planning</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">
      <!-- Heading -->
      <div class="sidebar-heading">
        Interface
      </div>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#">
          <span>Mes commandes</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="../login-home/buy-subscriptions.php">
          <span>Abonnements</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#">
          <span>Services</span>
        </a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Interface
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="bill/bill.php">
          <span>Factures</span>
        </a>
      </li>

      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link" href="charts.html">
          <span>Devis</span></a>
      </li>

      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="tables.html">
          <span>Paramètres</span>
        </a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">



    </ul>
    <!-- End of Sidebar -->


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
                <span class="badge badge-danger badge-counter" id="counter_notification">
                  <!-- On mettra un compteur en js et quand une personne recevra un message, on incremetenra la notification -->

                  <!-- code js -->
                </span>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown" id="messages">
                <h6 class="dropdown-header">
                  notification(s) reçu(s)
                </h6>



              </div>

            </li>

            <li class="nav-item dropdown no-arrow mx-1" style="margin-top : 15px">

                <a href='../log-out.php' class="btn btn-danger">Se déconnecter</a>

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
                                        <th>Dimanche</th>
                                        <th>Lundi</th>
                                        <th>Mardi</th>
                                        <th>Mercredi</th>
                                        <th>Jeudi</th>
                                        <th>Vendredi</th>
                                        <th>Samedi</th>
                                    </tr>
                                    </thead>

                                    <tbody id="planning-body">

                                    </tbody>
                                </table>
                              </div>

                              <div class="form-inline">

                                  <button class="btn btn-outline-primary col-sm-6" id="previous" onclick="previous()">Précédent</button>

                                  <button class="btn btn-outline-primary col-sm-6" id="next" onclick="next()">Suivant</button>
                              </div>
                              <br/>
                              <form class="form-inline">

                                  <label class="lead mr-2 ml-2" for="month">Aller à: </label>
                                  <select class="form-control col-sm-4" name="month" id="month" onchange="gotodate()">
                                      <option value=0>Janvier</option>
                                      <option value=1>Février</option>
                                      <option value=2>Mars</option>
                                      <option value=3>Avril</option>
                                      <option value=4>Mai</option>
                                      <option value=5>Juin</option>
                                      <option value=6>Juillet</option>
                                      <option value=7>Août</option>
                                      <option value=8>Septembre</option>
                                      <option value=9>Octobre</option>
                                      <option value=10>Novembre</option>
                                      <option value=11>Décembre</option>
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
                            <div class="form-group" id="form-event">

                            </div>
                          </div>
                        </div>
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

</body>
</html>
