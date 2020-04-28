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

  <link href="../../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

  <link rel="stylesheet" href="../../themes/blue/pace-theme-corner-indicator.css">


  <link href="../../css/freelancer.css" rel="stylesheet">
  <link href="../../css/sb-admin-2.css" rel="stylesheet">
  <link rel="shortcut icon" href="../../image/logo.png">
  <style type="text/css">
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

<body  id="page-top">

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
            <div class="container">
              <div style="text-align:center;margin-top:40px;margin-bottom: 50px;">
                <span class="step">1</span>
                <span class="step">2</span>
                <span class="step">3</span>
              </div>
              <div id="categories" class="row tab"> 
            <?php  
              require_once 'display-categories.php';



              
              foreach ($categories as $category)
              {
                 echo "<div id=\"".$category['id']."\"  class=\"col-lg col-sm col-sx out\"><div name=\"category\"class=\"card h-100 inline\" style=\"width: 14rem;\">
                  <img id=\"".$category['id']."\" name=\"category\" src=\"../../".$category['image']."\" class=\"card-img-top\" >
                  <div id=\"".$category['id']."\" name=\"category\" class=\"card-body\">
                  <h5 id=\"".$category['id']."\" name=\"category\" class=\"card-title text-center\">".$category['name']."</h5>
                 
                  
                  </div>
                  </div></div>";

              }

             ?>   

            <!--  <div class="container">
                <div class="row">
                  <div class="col-md-12">

                    <div class="btn-group">
                      <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Sélectionner une catégorie
                      </button>
                      <div class="dropdown-menu">

                        <?php

                     /*   require_once 'display-categories.php';

                        foreach ($categories as $category)
                        {


                          echo '<a class="dropdown-item" href="../services/services.php?id='.$category['id'].'">'.$category['name'].'</a>';

                        }
                        */

                        ?>


                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="category.php">Annuler</a>
                      </div>
                    </div>


                  </div>

                </div>
              </div>-->
             </div> 
             <div id="services-tab" class="row tab">
             
             </div>

             <div id="service-form" class="row tab" style="text-align: center;">
             </div>
              <div style="overflow:auto; margin-bottom: 10px;">
    <div style="text-align: center;">
      <button type="button" id="prevBtn" onclick="nextPrev(-1)" class="btn btn-outline-primary btn-lg">Previous</button>
      <button type="button" id="nextBtn" onclick="nextPrev(1)" class="btn btn-outline-success btn-lg">Next</button>
    </div>
  </div>
            </div>


    <script type="text/javascript">
      function isEmpty(val){
    return (val === undefined || val == null || val.length <= 0);
      }

      var currentTab =0; // afficher la premiere div

      showTab(currentTab);

      function showTab(n){
        var x=document.getElementsByClassName("tab");
        x[n].style.display="flex";
        if(n==0){
          document.getElementById("prevBtn").style.display="none";
        }else{
          document.getElementById("prevBtn").style.display="inline";
        }
        if(n==(x.length -1)){
          document.getElementById("nextBtn").innerHTML="Submit";
        }else{
          document.getElementById("nextBtn").innerHTML="Next";
        }
        fixStepIndicator(n)
      }

      function insertHiddenInput(v, name, destId){
        var dest, input;
        dest=document.getElementById(destId)
        input=document.createElement("input");
        input.type="hidden";
        input.name=name;
        input.value=v;
        dest.appendChild(input);

      }
      function nextPrev(n){
        var x = document.getElementsByClassName("tab");
       // window.alert(currentTab);
        if(n==1 && !validateForm()) return false;
       // window.alert("hello");
        x[currentTab].style.display="none";
        currentTab=currentTab+n;
        if(currentTab>= x.length){
         // Insert service & category ids as hidden inputs
          insertHiddenInput(service, "service_id", "hidden1");
          insertHiddenInput(category, "category_id", "hidden2");
        
          document.getElementById("regForm").submit();
          currentTab=0
          return false;
        }
        showTab(currentTab);
      }

      function validateForm(){
        var x, y, i, valid =true;
        if(isEmpty(category)){

          valid =false;
          
        }else if(isEmpty(service) && !isEmpty(category) && currentTab != 0){
          valid=false;
          
        }

        x=document.getElementsByClassName("tab");
        y=x[currentTab].getElementsByTagName("input");

        for(i =0; i<y.length; i++){
          if(y[i].value==""){
            y[i].className+= " invalid";
            valid=false;
          }
        }

        if(valid){
          document.getElementsByClassName("step")[currentTab].className += " finish";
        }
        return valid;
      }

      function fixStepIndicator(n){
        var i, x=document.getElementsByClassName("step");
        for(i=0; i<x.length; i++){
          x[i].className=x[i].className.replace("active", "");
        }
        x[n].className += " active";

      }
      var category, service, resultat;
    var getCategoryName = function() {
    document.onclick = function(e) {
      if (e.target.getAttribute("name") == 'category' || e.target.getAttribute("name") == 'service') {

        if (e.target.getAttribute("name") == 'category'){
          category = e.target.getAttribute("id");
          showServices(category);
          resultat=category
        }
        if(e.target.getAttribute("name") == 'service'){
          service = e.target.getAttribute("id");
         showServiceForm(service);
         resultat=service
        }
        var selectedCards= document.getElementsByClassName("card");
        Array.from(selectedCards).forEach((sc)=>{
          sc.classList.remove("selected");

        // window.alert(category);


        });
        if(e.target.tagName=='IMG'){
          e.target.parentElement.classList.add("selected");
        }
        if(e.target.tagName=='H5'){
          e.target.parentElement.parentElement.classList.add("selected");
        }
        if(e.target.tagName=='P'){
          e.target.parentElement.parentElement.classList.add("selected");
        }
         if(e.target.tagName=='DIV'){
          if(e.target.classList.contains("card-body")){e.target.parentElement.classList.add("selected");}
          else{e.target.classList.add("selected");}
        }
      }
    }

    return resultat;
   
    }

    getCategoryName()

    function showServices(c){
      if(window.XMLHttpRequest){
        xmlhttp= new XMLHttpRequest();
      } else {
        xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
      }
      xmlhttp.open("GET", "services-show.php?id="+c, true);
      xmlhttp.onload=()=>{
       // console.log(xmlhttp.response);
        document.getElementById("services-tab").innerHTML=xmlhttp.response;
      };
      xmlhttp.send();

    }
    function showServiceForm(s){
      if(window.XMLHttpRequest){
        xmlhttp= new XMLHttpRequest();
      } else {
        xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
      }
      xmlhttp.open("GET", "service_form_generator.php?id="+s, true);
      xmlhttp.onload=()=>{
       // console.log(xmlhttp.response);
        document.getElementById("service-form").innerHTML=xmlhttp.response;
      };
      xmlhttp.send();

    }

    window.onbeforeunload = function() {
      if(currentTab<3 && currentTab!=0){
       return "Vous pouvez perdre vos données ! ";
      }else{
        return
      }

   
};

    //getServiceName()


   /* function test(event){
      var x= event.target.getAttribute("name");
      if(x=='category'){
      alert(x);
    }
    }
    */

  //document.addEventListener("click", test(e));

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
