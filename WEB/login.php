<?php

  session_start();
  include 'include/functions.php';

  $errorConnection = "";

  if(isset($_POST['email'])
    && isset($_POST['pwd']))
  {


    $email = $_POST['email'];
    $pwd = $_POST['pwd'];

    $connect = connectDb();

    $data_status = $connect->prepare("SELECT status from users where email = ?;");

    $data_status->execute([

      $email

    ]);

    $status = $data_status->fetch();

    // print_r($_POST);

        $connect = connectDb();

        $queryPrepared = $connect->prepare("SELECT pwd, name, firstname, email, phone, pseudo FROM users where email = ?;");

        $queryPrepared->execute([

         $email

        ]);

        $result = $queryPrepared -> fetch();

        $pwdhashed = $result["pwd"];

        if (password_verify($_POST['pwd'], $pwdhashed))
        {

            if ($status[0] != -1)
            {
              if($status[0] != 0)
              {

                $_SESSION["firstname"]= $result["firstname"];
                $_SESSION["email"]= $result["email"];
                $_SESSION["name"]= $result["name"];
                $_SESSION["phone"]= $result["phone"];
                $_SESSION["pwd"]= $result["pwd"];
                $_SESSION["pseudo"]=$result["pseudo"];


                header("Location: login-success.php");

                }else{

                $errorConnection .= "<div class='alert alert-danger'>Vous devez confirmer votre compte pour avoir accès à cette interface</div>";

                }
              }else{

              $errorConnection .= "<div class='alert alert-danger'>Compte désactivé</div>";

              }

        }else{

          $errorConnection = "<div class='alert alert-danger'>Identifiants incorrects</div>";

        }

}
  $title = "Connexion";
  require('include/header.php');
  ?>


  <!--  -->

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Connexion</h1>
                  </div>

                  <form class="user" method="POST">

                    <?php

                      if (isset($errorConnection)) {

                        echo $errorConnection;

                      }

                      if (isset($status_zero)) {

                        echo $status_zero;
                      }

                    ?>

                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" required="required" placeholder="ID ou email" name="email">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" required="required" placeholder="Mot de passe" name="pwd">
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Se souvenir de moi</label>
                      </div>
                    </div>
                    <input type="submit" value="Se connecter" class="btn btn-primary btn-user btn-block">
                    </a>
                  </form>


                  <div class="text-center">
                    <hr>
                    <a class="small" href="forgot-password.php">Mot de passe oublié?</a>
                  </div>
                  <div class="text-center">
                    <a class="small" href="register.php">Pas de compte? Inscrivez-vous !</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <script src="barre.js"></script>

</body>

</html>
