<?php 
require('database.php');
require('connexion.php');


if(empty($_SESSION['id'])){
  header('location:index');
}
 if(isset($_POST['reception'])){
  if($_SESSION['profil']=="Mangasinier" or $_SESSION['profil']=="Admin" or $_SESSION['profil']=="superviseur"){
    $id=$_SESSION['id'];
    $hashedId=password_hash($id, PASSWORD_BCRYPT);
   //header("location:reception/rep_accueil.php?id=".$_SESSION['id']);
    header("location:reception_test/rep_accueil?id=".$hashedId);
  }
  else{
  echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
                echo '<script type="text/javascript">';
                
               
echo 'setTimeout(function () { swal("Information","Cette partie est en cours de développement");';
                echo '}, 100);</script>';

 echo '<script>window.history.replaceState({}, document.title, "' . $_SERVER['PHP_SELF'] . '");</script>';
}
} 

if(isset($_POST['reception_transfert'])){
  if($_SESSION['profil']=="Mangasinier" or $_SESSION['profil']=="Admin" or $_SESSION['profil']=="superviseur"){
    $id=$_SESSION['id'];
    $hashedId=password_hash($id, PASSWORD_BCRYPT);
   //header("location:reception/rep_accueil.php?id=".$_SESSION['id']);
    header("location:reception_transfert/rep_accueil?id=".$hashedId);
  }
  else{
  echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
                echo '<script type="text/javascript">';
                
               
echo 'setTimeout(function () { swal("Information","Cette partie est en cours de développement");';
                echo '}, 100);</script>';

 echo '<script>window.history.replaceState({}, document.title, "' . $_SERVER['PHP_SELF'] . '");</script>';
}
} 

if(isset($_POST['livraison'])){
 if($_SESSION['profil']=="Mangasinier" or $_SESSION['profil']=="Admin" or $_SESSION['profil']=="superviseur"){
    header("location:livraison/livraison?id=".$_SESSION['id']);
  }
  else{
  echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
                echo '<script type="text/javascript">';
                
               
echo 'setTimeout(function () { swal("Information","Cette partie est en cours de développement");';
                echo '}, 100);</script>';

 echo '<script>window.history.replaceState({}, document.title, "' . $_SERVER['PHP_SELF'] . '");</script>';
}
}
if(isset($_POST['g_stock'])){
  if($_SESSION['profil']=="superviseur" or $_SESSION['profil']=="Admin" ){
    header("location:stock/stock.php?id=".$_SESSION['id']);
    
}
}
//if(isset($_POST['debarquement'])){
  //header('location:super/debarquement.php');

  // } 
   if(isset($_POST['archives'])){

  header('location:transfert/archives_dossiers');
}
// REQUETE DE RECUPERATION DES MESSAGES
$notification=$bdd->prepare("SELECT * from notification where user_destinataire=? ");
$notification->bindParam(1,$_SESSION['id']);
$notification->execute();

$nbre_notification=$bdd->prepare("SELECT count(message) from notification where status_lecture=0 and user_destinataire=? ");
$nbre_notification->bindParam(1,$_SESSION['id']);
$nbre_notification->execute();


   
             ?>                              
 

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             
<!DOCTYPE html>

  



  

<html>


<head>

  <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
 

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">




  
  <!-- Style CSS -->
  







<link rel="stylesheet" href="assets/modules/bootstrap-5.1.3/css/bootstrap.css">
  
  <!-- Style CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  
  <!-- FontAwesome CSS-->
  <link rel="stylesheet" href="assets/modules/fontawesome6.1.1/css/all.css">
  <!-- Boxicons CSS-->
  <link rel="stylesheet" href="assets/modules/boxicons/css/boxicons.min.css">
  <!-- Apexcharts  CSS -->
  <link rel="stylesheet" href="assets/modules/apexcharts/apexcharts.css">


  
   




<link rel="shortcut icon" type="image/png" href="mylogo.ico"/>
 <meta charset="utf-8">
  
 


 
  <title></title>
</head>
<body>

        <style type="text/css">
    body{
        padding: 0;
        margin: 0;
    }
    *{
      font-family: Times New Roman
    }
    .card{
      background:rgb(240,240,240);
      border:solid;
     border-color: rgb(0,141,202);
     border-width: 2px;
     border-radius: 50%;
     
    
    /*  border: 10px dashed rgb(0,141,202);*/

    /* width: 50%;
     height: 220px;*/
    /*  border-bottom-left-radius: 40%;
  border-bottom-right-radius: 40%;*/
    }
        .card-title{
      border:solid;
      background: linear-gradient(to top, blue, #1B2B65); 
     border-color: white;
     border-width: 5px;

   border-top-left-radius: 100%;  
  border-top-right-radius: 100%;
    border-bottom-left-radius: 100%;  
  border-bottom-right-radius: 100%;
    }
    .image{
      outline: none;
      border: solid;
      border-width: 1px;
      border-radius: 50%;
      width: 150px;
      height: 150px;




    }
    .bt{
      border: none !important;

    }
    .container-fluid{
       width: 90%; 
       background-image: url('images/bg2.avif');  background-size: cover;
   background-position: center center background: linear-gradient(-45deg, #004362, #0183d0); !important;
  background-repeat: no-repeat;
        
        margin-left: 5%; border: none;
         border-radius: 20px; 
    }

    </style>

   <?php  

include('navbar.php');
   ?> 
   <br>
   <?php  // LA PARTIE OU JE RECUPERE MES MESSAGES ?>
    <div class="topbar transition">

  <div class="bars">
    <button type="button" class="btn transition" id="sidebar-toggle">
      <i class="fa fa-bars"></i>
    </button>
  </div>
    <div class="menu" style="margin-right: 100px;" id="notifications-container">
      <ul>
        <li class="nav-item dropdown dropdown-list-toggle">
          <a class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
             <i class="fa fa-bell size-icon-1"></i><span class="badge bg-danger notif"><?php  if($nbre_notif=$nbre_notification->fetch()){ echo $nbre_notif['count(message)']; }  ?></span>
          </a>         
          <div class="dropdown-menu dropdown-list" >
            <div class="dropdown-header">Notifications</div>
            <div class="dropdown-list-content dropdown-list-icons">
              <div class="custome-list-notif">
              <?php while($notif=$notification->fetch()){  ?> 
              <a href="#" class="dropdown-item dropdown-item-unread">
                <div class="dropdown-item-icon bg-primary text-white">
                  <i class="fas fa-code"></i>
                </div>
                <div class="dropdown-item-desc">
                  <?php echo $notif['message'];  ?>
                  <div class="time text-primary"> il y'a 3 Minutes</div>
                </div>
                </a>
              <?php   } ?>

                

            
          </li>
       
          <li class="nav-item dropdown" >
          <a class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="assets/images/avatar/avatar-1.png" alt="">
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="my-profile.html"><i class="fa fa-user size-icon-1"></i> <span>MON PROFIL</span></a>
            <a class="dropdown-item" href="settings.html"><i class="fa fa-cog size-icon-1"></i> <span>PARAMETRES</span></a>
            <hr class="dropdown-divider">
            <a class="dropdown-item" href="logout"><i class="fa fa-logout  size-icon-1"></i> <span>DECONNEXION</span></a>
          </ul>
          </li>
      </ul>
    </div>
  </div>    


  <form method="POST">    
  <div class="container-fluid "   >
   <div class="row">


      
<br>

<?php if($_SESSION['profil']=="superviseur" or $_SESSION['profil']=="Admin" ){ ?>

<div style=" " class="col col-sm-12 col-md-6 col-lg-4" >

   <center>
    <div class="card" style="width: 300px;" >
      <div class="card-header" >
        <center>
         <h5 class="card-title text-white" style="font-weight: bold;" >GESTION DONNEES</h5>
         </center>
         </div>

  <div class="card-body" >
   
    <center>
      
  <!--  <a href="super/gestion_donnees" class="bt" > !-->
    <a href="gestion_de_donnees/index" class="bt" >
      
      <img class="image" src="images/logogdonneesL1.png" >

    </a>
  
    </center>
  </div>
</div>

<br>
</div>

<?php   } ?>





<?php if($_SESSION['profil']=="superviseur" or $_SESSION['profil']=="Admin" or $_SESSION['profil']=="Pointeur" or $_SESSION['profil']=="pont" ){ ?>

<div style=" " class="col col-sm-12 col-md-6 col-lg-4" >
  <center>
    <div class="card" style="width: 300px;" >
      <div class="card-header" >
        <center>
         <h5 class="card-title text-white" style="font-weight: bold;" >DEBARQUEMENT</h5>
         </center>
         </div>

  <div class="card-body" >
   
    <center>
      
    <a href="super/debarquement" class="bt"   name="debarquement">
      <img class="image" src="images/logonavireL1.png" >
    </a>
  
    </center>
  </div>
</div>
</center>
<br>
</div>
<?php  } ?>




 <?php if($_SESSION['profil']=="superviseur" or $_SESSION['profil']=="Admin" or $_SESSION['profil']=="Mangasinier" ){ ?>

<div class="col col-sm-12 col-md-6 col-lg-4" >
   <center>
    <div class="card" style="width: 300px;" >
      <div class="card-header" >
        <center>
         <h5 class="card-title text-white" style="font-weight: bold;" >RECEPTION</h5>
         </center>
         </div>
  <div class="card-body" >
   
    <center>
   
    <a  class="bt" name="reception" data-bs-target="#sous_menu_reception" data-bs-toggle="modal">
      <img class="image" src="images/logoreceptionL1.png" > 
    </a>
    </center>
 
  </div>
</div>
</center>
<br>
</div>
<?php   } ?>

<?php if($_SESSION['profil']=="superviseur" or $_SESSION['profil']=="Admin" or $_SESSION['profil']=="Mangasinier" ){ ?>

<div class="col col-sm-12 col-md-6 col-lg-4" >
   <center>
    <div class="card" style="width: 300px;" >
      <div class="card-header" >
        <center>
         <h5 class="card-title text-white" style="font-weight: bold;" >LIVRAISON</h5>
         </center>
         </div>
  <div class="card-body" >
   
    <center>
    <button  class="bt" name="livraison">
     <img class="image" src="images/logolivraisonL1.png" > 
    </button>
    </center>
   
  </div>
</div>
</center>
<br>
</div>
<?php   } ?>

<?php if($_SESSION['profil']=="superviseur" or $_SESSION['profil']=="Admin" or $_SESSION['profil']=="Mangasinier" ){ ?>

<div class="col col-sm-12 col-md-6 col-lg-4" >
   <center>
    <div class="card" style="width: 300px;" >
      <div class="card-header" >
        <center>
         <h5 class="card-title text-white" style="font-weight: bold;" >TRANSFERT</h5>
         </center>
         </div>
  <div class="card-body"  style="background: blue;">
   
    <center>
   
    <a <?php if($_SESSION['profil']=="superviseur"){ ?> href="transfert_entrepot/demande_transfert" <?php } ?> <?php if($_SESSION['profil']=="Mangasinier"){ ?> href="transfert_entrepot/transfert" <?php } ?>  class="bt" name="transf" >
      <img class="image" src="images/logoreceptionL1.png"   > 
    </a>
    </center>
 
  </div>
</div>
</center>
<br>
</div>
<?php   } ?>



<?php if($_SESSION['profil']=="superviseur" or $_SESSION['profil']=="Admin" ){ ?>

<div class="col col-sm-12 col-md-6 col-lg-4" >


   <center>
    <div class="card" style="width: 300px;" >
      <div class="card-header">
        <center>
         <h5 class="card-title text-white" style="font-weight: bold;" >GESTION DE STOCK</h5>
         </center>
         </div>
  <div class="card-body" >
   
    <center>
     
    <button  class="bt" name="g_stock">
      <img class="image" src="images/logogstock.avif" > 
    </button>
 
    </center>
  </div>
</div>
</center>
<br>
</div>
<?php } ?>



<div class="col col-sm-12 col-md-6 col-lg-4" >
  <a href="messages/accueil.php">
   <center>
    <div class="card" style="width: 300px;" >
      <div class="card-header" >
        <center>

         <h5 class="card-title text-white" style="font-weight: bold;" >MESSAGERIE</h5>
         </center>
         </div>
  <div class="card-body" >
   
    <center>
    
     <img class="image" src="images/sms.png" > 
    
    </center>
   
  </div>
</div>
</center>
</a>
<br>
</div>


<?php if($_SESSION['profil']=="superviseur" or $_SESSION['profil']=="Admin" ){ ?>


<div class="col col-sm-12 col-md-6 col-lg-4" >
   <center>
    <div class="card" style="width: 300px;" >
      <div class="card-header">
        <center>
         <h5 class="card-title text-white" style="font-weight: bold;" >ARCHIVES</h5>
         </center>
         </div>
  <div class="card-body" >

    <center>
    <button  class="bt" name="archives">
      <img class="image" src="images/logoarchive.avif" > 
    </button>
    </center>
  
  </div>



</div>
</center>
<br>

</div>

<?php  } ?>



<div class="col col-sm-12 col-md-6 col-lg-4" >
   <center>
    <div class="card" style="width: 300px;"  >
      <div class="card-header" >
        <center>
         <h5 class="card-title text-white" style="font-weight: bold;" >FACTURATION</h5>
         </center>
         </div>
  <div class="card-body" >
   
    <center>
    <button  class="bt" name="facturation">
     <img class="image" src="images/facturation.avif" > 
    </button>
    </center>
   
  </div>
</div>
</center>
<br>
</div>

<?php if($_SESSION['profil']=="superviseur" or $_SESSION['profil']=="Admin" ){ ?>


<div class="col col-sm-12 col-md-6 col-lg-4" >
   <center>
    <div class="card" style="width: 300px;" >
      <div class="card-header">
        <center>
         <h5 class="card-title text-white" style="font-weight: bold;" >GESTION TRANSIT</h5>
         </center>
         </div>
  <div class="card-body" >

    <center>
    <a href="gestion_transit/transit" class="bt" name="archives">
      <img class="image" src="images/logoarchive.avif" > 
    </a>
    </center>
  
  </div>



</div>
</center>
<br>

</div>

<?php  } ?>




<?php if($_SESSION['profil']=="superviseur" or $_SESSION['profil']=="Admin" ){ ?>


<div class="col col-sm-12 col-md-6 col-lg-4" >
   <center>
    <div class="card" style="width: 300px;" >
      <div class="card-header">
        <center>
         <h5 class="card-title text-white" style="font-weight: bold;" >GESTION DES RELÂCHES</h5>
         </center>
         </div>
  <div class="card-body" >

    <center>
    <a href="gestion_relache/relache" class="bt" name="archives">
      <img class="image" src="images/logoarchive.avif" > 
    </a>
    </center>
  
  </div>



</div>
</center>
<br>

</div>

<?php  } ?>





<div class="modal fade" id="sous_menu_reception" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <div class="modal-body">
        <div class="container-fluid" style="background: white;">
          <div class="row">
            
        <div class="col-md-4 col-lg-4">
      <button class="btn btn-primary" style="float:left;" name="reception">NAVIRE</button>
      </div>
       <div class="col-md-4 col-lg-4">
      <button class="btn btn-primary" style="float:left;" name="reception_transfert">TRANSFERT</button>
      </div>
         <div class="col-md-4 col-lg-4">
       <div   class="dropdown" style="float-right; ">
                    <button  class="btn btn-success " style="float-right; display: flex; justify-content: center;"  id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        CONTENEUR <i class="dropdown-toggle"></i>
                    </button>
                    
                    <ul id="drop_debarquement" class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="background: white;"> 
                      <center>  
                        
                        <li><a style="color: green !important;" class="dropdown-item" href="conteneur/pre_reception_conteneur"> PRE-RECEPTION</a></li>
                        <br>  
                        <li><a style="color: green !important;" class="dropdown-item"  href="conteneur/reception_conteneur" > RECEPTION</a></li><br>
                       
                        </center>
                        
                        
                    </ul>
                    </div>
                 </div> 
                </div>

  </div>
</div>
</div>
</div>

</form>
 
              <br>

  <script src="assets/js/atrana.js"></script>

  <!-- JS Libraies -->
  <script src="assets/modules/jquery/jquery.min.js"></script>
  <script src="assets/modules/bootstrap-5.1.3/js/bootstrap.bundle.min.js"></script>
  <script src="assets/modules/popper/popper.min.js"></script>

  <!-- Chart Js -->
  <script src="assets/modules/apexcharts/apexcharts.js"></script>
  <script src="assets/js/ui-apexcharts.js"></script>

    <!-- Template JS File -->
  <script src="assets/js/script.js"></script>
  <script src="assets/js/custom.js"></script>



    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/isotope/isotope.pkgd.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>

    <!-- Template Javascript -->
  

   

<script type="text/javascript">
  $(document).ready(function(){
    $('#icon').click(function(){
      $('ul').toggleClass('show');
    });                
  });
</script> 

<script>
// Fonction pour récupérer et mettre à jour les notifications
function fetchNotifications() {
    $.ajax({
        url: 'fetch_notifications.php', // URL du script PHP pour récupérer les notifications
        type: 'GET', // Méthode de requête GET
        success: function(data) { // Fonction exécutée en cas de succès de la requête
            $('#notifications-container').html(data); // Met à jour le contenu de la section avec les notifications reçues
        }
    });
}

// Actualise les notifications toutes les 20 secondes
setInterval(fetchNotifications, 20000);

// Appelle fetchNotifications une première fois au chargement de la page
fetchNotifications();
</script>


        
  </body>
  </html>                                                                                                                           