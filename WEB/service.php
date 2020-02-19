<?php
  $title = "Services";
  require('include/functions.php');
  require('include/header.php');
 ?>


  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5 ">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <!-- <div class="col-lg-4 d-none d-lg-block bg-register-image"></div> -->
          <div class="col-lg-12">
            <div class="p-5">
              <div class="text-center">

                <h1 class="h4 text-gray-900 mb-4">Gestion des services</h1>
              </div>


              <!-- début tableau des services -->

              <?php

      if (isset($listOfErrors)) {

        echo "<div class='alert alert-danger'>";
        echo $listOfErrors;
        echo "</div>";

      };

      ?>
              <table class="table">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Description</th>
                    <th scope="col">Categorie</th>
                    <th scope="col">Prix</th>
                    <!-- <th scope="col">Modifier</th>
                    <th scope="col"></th>
                    <th scope="col">Prix</th> -->
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    <td>20€</td>
                    <td style="border-style: none;" class="px-lg-0"><button type="button" class="btn btn-secondary">Modifier</button></td>
                    <td style="border-style: none;" class="px-lg-0"><button type="button" class="btn btn-danger">Supprimer</button></td>
                  </tr>
                </tbody>
              </table>
              <div class="text-center">

                <button type="button" class="btn btn-primary">Ajouter un service</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <!-- <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script> -->

  <!-- Core plugin JavaScript-->
  <!-- <script src="vendor/jquery-easing/jquery.easing.min.js"></script> -->

  <!-- Custom scripts for all pages-->
  <!-- <script src="js/sb-admin-2.min.js"></script> -->


  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>
