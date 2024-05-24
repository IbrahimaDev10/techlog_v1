<?php 
require('database.php');
require('connexion.php');
if(!empty($_SESSION['profil'])){
  echo '<script type="text/javascript">
 window.location.href = "star_superviseur" </script>';

}
?>                               
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             
<!DOCTYPE html>

  

<html>
<head>



<link rel="stylesheet" href="assets/modules/bootstrap-5.1.3/css/bootstrap.css">
  
  <!-- Style CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  
  <!-- FontAwesome CSS-->
  <link rel="stylesheet" href="assets/modules/fontawesome6.1.1/css/all.css">
  <!-- Boxicons CSS-->
  <link rel="stylesheet" href="assets/modules/boxicons/css/boxicons.min.css">
  <!-- Apexcharts  CSS -->
  <link rel="stylesheet" href="assets/modules/apexcharts/apexcharts.css">

 
  
 
  <link rel="stylesheet" type="text/css" href="nav3.css"> 
    
   



<link rel="shortcut icon" type="image/png" href="mylogo.ico"/>
 <meta charset="utf-8">
  
 

 
 
  <title></title>
</head>
<body style="background-image:url('images/img_port.jpg'); ">

        <style type="text/css">
    body{
        padding: 0;
        margin: 0;
    }
    *{
      font-family: Times New Roman
    }
    .modal-header{
      
     /* background-image: url("images/simar2.jpg");MMM/
      background-repeat: no-repeat;
      background-size: 100%;
      background: #1B2B65;*/
      background: rgb(0,98,140);
     
      border-bottom-left-radius: 35%;
      border-bottom-right-radius: 35%;
      border: solid;
      border-color: white;
      border-width: 8px;
    }
    .logoo{
      border-radius: 50px;
       height: 120px;
        width: 300px;
      
        z-index: 2;
        text-align: center;
        float: left;

    }
    .btn{
     background: linear-gradient(to bottom, blue, rgb(0,141,202));
      
    }

    #perreur{
        color:red;
        font-weight: bold;
    }
    .err{
        width: 500px;
        height: 250px;
        background: white;
        vertical-align: middle;
    }
    #close_erreur{
        font-size: 30px;
    }

  /*  .footer {
    background-color: #f8f8f8;
    padding: 20px 0;
    text-align: center;
}*/

/* .footer p {
    margin: 0;
    color: #666;
    font-size: 14px;
}*/

@media (max-width: 1200px){
  .form-control{
    height: 50px;
  }
  .modal-content{
    height: 600px;
  }
 
}

/*@keyframes scintiller {
            0%, 100% {
                opacity: 1; /* Opacité à 100% au début et à la fin 
            }
            50% {
                opacity: 0.5; /* Opacité à 50% au milieu de l'animation 
            }*/
        

    .localisation {
           

        .local

        .

        .localisation {
            width: 40px;
            height: 60px;
            position: relative;
        }

        .pin {
            width: 20px;
            height: 20px;
            background-color: red;
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%) rotate(45deg);
        }

        .pin:before {
            content: "";
            width: 10px;
            height: 10px;
            background-color: red;
            position: absolute;
            bottom: 100%;
            left: 50%;
            transform: translateX(-50%) rotate(45deg);
        }


        .input-group-append {
  cursor: pointer; /* Change le curseur au survol */
}

.input-group-append .input-group-text {
  border-left: 0;
  background-color: #fff; /* Couleur de fond */
  border-color: #ced4da; /* Couleur de la bordure */
  padding: 0.375rem 0.75rem; /* Espace autour de l'icône */
}

.input-group-append .input-group-text:hover {
  background-color: #e9ecef; /* Couleur de fond au survol */
}

    </style>

   <?php  

include('header3.php');
   ?> 
   <br><br>
      
<p style="color: black !important;"><?php echo password_hash('@Diamnadio##2024', PASSWORD_DEFAULT); ?></p>
<p style="color: black !important;"><?php echo password_hash('PavillonCICES982420', PASSWORD_DEFAULT); ?></p>
<p style="color: black !important;"><?php echo password_hash('Hann0839SO@', PASSWORD_DEFAULT); ?></p>
<p style="color: black !important;"><?php echo password_hash('ZoneCamberene210@', PASSWORD_DEFAULT); ?></p>
<p style="color: black !important;"><?php echo password_hash('ZoneColobane@0920', PASSWORD_DEFAULT); ?></p>
<p style="color: black !important;"><?php echo password_hash('BASSE2024', PASSWORD_DEFAULT); ?></p>
<p style="color: black !important;"><?php echo password_hash('BATA11@2024', PASSWORD_DEFAULT); ?></p>
<p style="color: black !important;"><?php echo password_hash('LAYOUSSE019@2024', PASSWORD_DEFAULT); ?></p>
<p style="color: black !important;"><?php echo password_hash('SENICO020@2024', PASSWORD_DEFAULT); ?></p>
<p style="color: black !important;"><?php echo password_hash('PONTBASCULE@2024', PASSWORD_DEFAULT); ?></p>
<p style="color: black !important;"><?php echo password_hash('SOTIBA@2024', PASSWORD_DEFAULT); ?></p>

      
  <div class="container-fluid"  >
  <div class="row">
<div class="col col-sm-12 col-md-12 col-lg-12">
   
  

<!-- Modal -->
<div class=""   style="">
  <div class="modal-dialog">
      <center>
    <div class="modal-content" style="  border: solid; border-color:white; background: none; ">
            <div class="modal-header  " >
              <center>
              <img class="logoo" src="images/mylogo.ico" >
              </center>
        <center>
        <h3 class="modal-title fs-10 text-white text-center" id="exampleModalLabel " style="text-align:center; float: right;   ">Connectez vous</h3></center>
       
      </div>
      <div class="modal-body" >
               <center>
            

        </center>
      	<form method="POST">

   <div class="mb-3">
    <br>
      <label for="exampleFormControlInput1" class="form-label" style="color:white !important;   font-weight: bold; ">TELEPHONE</label>
  <input type="text" class="form-control" id="telephoneInput" placeholder="777777777" name="telephone1" id="t" oninput="formatTelephone()" style="width: 50%;  ">


</div>
<br>

        <div class="mb-3">
    <label for="exampleFormControlInput1" class="form-label" style="color:white !important; font-weight: bold;">MOT DE PASSE</label>
  <!--  <span>
  <input type="password" class="form-control" id="exampleFormControlInput1" placeholder="mot de passe" name="password1" style="width: 50%;  " > <i class="fas fa-eye"></i> </span> !-->

  <div class="input-group">
  <input type="password" class="form-control" id="champs_mdp" placeholder="Mot de passe" name="password1" style="width: 50%;">
  <div class="input-group-append">
    <span class="input-group-text">
      <i class="fas fa-eye"  id="togglePassword"></i>
    </span>
  </div>
</div>
  </div>
  <br>

 <center>
        <button style="width: 50%;" type="submit" class="btn text-white"  name="connecter">SE CONNECTER</button></center>
        </div>
         
        
</form> 
         
     
    </div>
  </div>
  </center>
</div>
</div>
</div>


      
<br><br><br>



    
</div>
        <div class="col-md-12 col-lg-12"> 
        <p>&copy; 2023 TECH LOGISTIC. Tous droits réservés.</p>
        </div>
        </div>
    </div>





  <script src="assets/js/atrana.js"></script>

  <!-- JS Libraies -->
  <script src="assets/modules/jquery/jquery.min.js"></script>
  <script src="assets/modules/bootstrap-5.1.3/js/bootstrap.bundle.min.js"></script>
  <script src="assets/modules/popper/popper.min.js"></script>

  <!-- Chart Js -->
  <script src="assets/modules/apexcharts/apexcharts.js"></script>
  <script src="../assets/js/ui-apexcharts.js"></script>

    <!-- Template JS File -->
  <script src="assets/js/script.js"></script>
  <script src="assets/js/custom.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


<script type="text/javascript">
  $(document).ready(function(){
    $('#icon').click(function(){
      $('ul').toggleClass('show');
    });                
  });
</script> 


<script>
function formatTelephone() {
  var telephoneInput = document.getElementById('telephoneInput');
  var telephone = telephoneInput.value;

  // Supprimer tous les espaces de la chaîne
  var telephoneSansEspaces = telephone.replace(/\s/g, '');

  // Formater le numéro de téléphone avec les espaces
  var telephoneFormate = telephoneSansEspaces.replace(/(\d{2})(\d{3})(\d{2})(\d{2})/, '$1 $2 $3 $4');

  // Mettre à jour la valeur de l'input avec le numéro de téléphone formaté
  telephoneInput.value = telephoneFormate;
}
</script>


<script>
  function fermer() {

    var fermer=document.getElementById("erreur");
    fermer.style.display="none";

</script>

<script>
document.getElementById('togglePassword').addEventListener('click', function() {
  const passwordInput = document.getElementById('champs_mdp');
  const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
  passwordInput.setAttribute('type', type);
});
</script>
        
  </body>
  </html>                                                                                                                           