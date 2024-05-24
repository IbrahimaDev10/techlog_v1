<?php
require('../database.php');
if(empty($_SESSION['id'])){
  header('location:../index.php');
}
require("controller/acces_reception.php");
//header("Cache-Control: no-cache, must-revalidate");
//header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");


?>	



<!DOCTYPE html>
<html lang="fr">
  <head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


	<title>Debarquement</title>

	<!-- Bootstrap CSS-->
   <link rel="stylesheet" type="text/css" href="pv_reception.css"> 
  <link rel="stylesheet" type="text/css" href="../assets/modules/bootstrap-5.1.3/css/bootstrap.css">
  <!-- Style CSS -->
  <link rel="stylesheet" type="text/css" href="../transfert/css/style.css">
  <link rel="stylesheet" type="text/css" href="assets/css/stylecell.css">
   <link rel="stylesheet" type="text/css" href="../assets/css/repAccueil.css">
  <!-- FontAwesome CSS-->
  <link rel="stylesheet" type="text/css" href="../assets/modules/fontawesome6.1.1/css/all.css">
  <!-- Boxicons CSS-->
  <link rel="stylesheet" type="text/css" href="assets/modules/boxicons/css/boxicons.min.css">
  <!-- Apexcharts  CSS -->
  <link rel="stylesheet" type="text/css" href="../assets/modules/apexcharts/apexcharts.css">
    <link rel="shortcut icon" type="image/png" href="../assets/images/mylogo.ico"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<body >
<style type="text/css">
	
.lienforme{
color:white; font-size: 20px; border: solid; background-color: black; margin-bottom: 50px;

}

 *{
  font-family: Times New Roman;
 } 

   .modal-header{
      
     /* background-image: url("images/simar2.jpg");
      background-repeat: no-repeat;
      background-size: 100%;
      background: #1B2B65;*/
       background: linear-gradient(to bottom, blue, #1B2B65);
       background: linear-gradient(to top, blue, #1B2B65);
       background: linear-gradient(to left, blue, #1B2B65);
      
      border-bottom-left-radius: 35%;
      border-bottom-right-radius: 35%;
      border: solid;
      border-color: rgb(145,145,255);
      border-width: 8px;
    }
    
  .modal-header{
      
     /* background-image: url("images/simar2.jpg");
      background-repeat: no-repeat;
      background-size: 100%;
      background: #1B2B65;*/
       background: linear-gradient(to bottom, blue, #1B2B65);
       background: linear-gradient(to top, blue, #1B2B65);
       background: linear-gradient(to left, blue, #1B2B65);
      
      border-bottom-left-radius: 35%;
      border-bottom-right-radius: 35%;
      border: solid;
      border-color: rgb(145,145,255);
      border-width: 8px;
      height: 150px;
    }

    .fabtn1{
  border: none;
   margin-right: 3px;
  color:rgb(0,141,202);
  text-align: center;


 }
 .btn1{
  background: linear-gradient(to bottom, blue, #1B2B65); background: linear-gradient(to left, blue, #1B2B65); background: linear-gradient(to top, blue, #1B2B65);
  text-align: center;

 }
    
 .logoo{

      border-radius: 50px;
       height: 120px;
        width: 200px;
        float: right;
        z-index: 2;
        text-align: center;

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
    .fa-truck{
 float: left;
  font-size: 18px;
color: white;
vertical-align: middle;
display: flex; 
margin-right: 5px;


}
#th_table_rec{
      background: linear-gradient(to bottom, blue, rgb(0,141,202));
       text-align: center; 
        color: white;
         font-weight: bold;
         font-size:12px;
         vertical-align: middle;

    }
    .colaffiche{
      vertical-align: middle;
      text-align: center;
    }
   

@media (max-width: 1200px){
.tr_data_attente_avaries{
 font-size:10px;
}
}
</style>



  
  <!--Topbar -->
  <div class="topbar transition">
	<div class="bars">
		<button type="button" class="btn transition" id="sidebar-toggle">
			<i class="fa fa-bars"></i>
		</button>
	</div>
		<div class="menu">
			<ul>
				
			 
				  <li class="nav-item dropdown">
					<a class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
					  <img src="../assets/images/avatar/avatar-1.png" alt="">
					</a>
					<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="my-profile.html"><i class="fa fa-user size-icon-1"></i> <span>My Profile</span></a>
						<a class="dropdown-item" href="settings.html"><i class="fa fa-cog size-icon-1"></i> <span>Settings</span></a>
						<hr class="dropdown-divider">
						<a class="dropdown-item" href="#"><i class="fa fa-sign-out-alt  size-icon-1"></i> <span>My Profile</span></a>
					</ul>
				  </li>
			</ul>
		</div>
	</div>

	<!--Sidebar-->
	<div class="sidebar transition overlay-scrollbars animate__animated  animate__slideInLeft">
        <div class="sidebar-content"> 
        	<div id="sidebar">
			
			<!-- Logo -->
			<div class="logo">
					<h2 class="mb-4"><img style="width: 150px; height: 150px;" src="../assets/images/mylogo.ico"> </h2>
			</div>

            <ul class="side-menu">
                <li>
					<a href="../star_superviseur.php" class="active">
						<i class='bx bxs-dashboard icon' ></i> MENU PRINCIPAL
					</a>
                 <?php include('page.php'); ?>
				</li>

				<!-- Divider-->
                <li class="divider" style="font-size: 18px;" data-text="STARTER"> RECEPTION</li>

                <li>
                    <a href="#">
                        <i class='bx bx-columns icon' ></i> 
                        Enregistrement des bons de Transfert / Livraison
                        <i class='bx bx-chevron-right icon-right' ></i>
                    </a>
                    <ul class="side-dropdown">
                       
                        
                                                
                    </ul>
                </li>

                       <li> <a style="font-size:12px;"  data-bs-toggle="modal" data-bs-target="#situation_24h">
                        <i class='bx bx-columns icon'  ></i>SITUATION JOURNALIERE 
                       </a>
                    
                   </li>

                    <li> <a style="font-size:12px;" href="pv_reception.php?id=<?php echo $_GET['id']; ?>">
                        <i class='bx bx-columns icon'  ></i>PV DE RECEPTION
                       </a>
                    
                   </li>
                   

                    <li><a   href="situation_de_reception.php?id=<?php echo $_GET['id']; ?>"> <i class='bx bx-columns icon' ></i> MES SITUATION</a></li>
                     <li><a   href="reconditionnement.php?id=<?php echo $_SESSION['id']; ?>"> <i class='bx bx-columns icon' ></i> RECONDITIONNEMENT</a></li>
                    </a>
                    
                       

 
 


				
               

				<!-- Divider-->
       </div> 
	 </div>
	</div><!-- End Sidebar-->


	<div class="sidebar-overlay"></div>


	<!--Content Start-->
	<div class="content-start transition">
		<div class="container-fluid dashboard">
			<div class="content-header">




<div class="modal fade" id="form_update_aff" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style=" border: solid; border-color:rgb(0,141,202); ">
            <div class="modal-header" style="">
              <center>
                <h3 class="modal-title fs-10 text-white text-center" id="exampleModalLabel " style="text-align:center;   ">MODIFICATION</h3></center>
                <center>
              <img class="logoo" src="../images/mylogo.ico" >
       </center>
        
      </div>
       <br> <br>
        <form  method="POST">

     

      
        
        

      ?>

<center>

   <div class="mb-3">
    
    <label>DATE</label>  
   <input type="text" id="date_up_aff" class="form-control"   name="date" ><br>
       <label>HEURE</label>  
   <input type="time" id="time_up_aff" class="form-control"   name="date" ><br>
  <div style="display: none;"> 
    <label>BL</label>
    <input style="height: 25px;" type="text" class="form-control"   id=bl_up_aff ><br></div>
     
     
      <label>SAC </label>
        <input style="height: 25px;" type="text" class="form-control"  id="sac_up_aff"  name="sac"  ><br>
             
        
               
        
         <label>MANQUANT</label>
        <input style="height: 25px;" type="text" class="form-control"  id="manquant_up_aff"  name="manquant" value="0" ><br>
       
       
         <label>poids sac</label>
        <input style="height: 25px;" type="text" class="form-control"  id="poids_sac_up_aff"  name="poids_sac" hidden="true" >
         
         
       
        <input style="height: 25px;" type="text" class="form-control"  id="id_dis_bl_up_aff"  name="id_dis_bl" hidden="true" >
                           
        <input style="height: 25px;" type="text" class="form-control"  id="id_up_aff"  name="id" hidden="true" >
        
        

    
</div>


</center>



         
        
</form> 
       <center>  
      <div class="modal-footer">
          
         <a  id="save_up_aff" style="width: 50%;" class="btn btn-primary " name="valider_reception">valider</a> 
         
      </div>
  </center>
      
    </div>
  </div>
</div>





<div class="modal fade" id="form_fichier_reception" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style=" border: solid; border-color:rgb(0,141,202); ">
            <div class="modal-header" style="">
              <center>
                <h3 class="modal-title fs-10 text-white text-center" id="exampleModalLabel " style="text-align:center;   ">MODIFICATION</h3></center>
                <center>
              <img class="logoo" src="../images/mylogo.ico" >
       </center>
        
      </div>
       <br> <br>
        <form  method="POST">

     

      
        
        

      

<center>

   <div class="mb-3">
    <input type="file" name="image" id="image">
    
    </div>
     
     
    
         
         
       
      
        
        

    
</div>


</center>



         
        
</form> 
       <center>  
      <div class="modal-footer">
          
         <a  id="save_fichier_reception" style="width: 50%;" class="btn btn-primary " name="valider_reception">valider</a> 
         
      </div>
  </center>
      
    </div>
  </div>
</div>






  <div class="modal fade" id="form_reception" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style=" border: solid; border-color:rgb(0,141,202); ">
            <div class="modal-header" >
              <center>
                <h3 class="modal-title fs-10 text-white text-center" id="exampleModalLabel " style="text-align:center;   ">MODIFICATION</h3></center>
                <center>
              <img class="logoo" src="../images/mylogo.ico" >
       </center>
        
      </div>
       <br> <br>
        <form  method="POST">

     

      
        
        

      ?>

<center>

   <div class="mb-3">
    
    <label>DATE</label>  
   <input type="date" id="date_rep" class="form-control"   name="date" ><br>
   <label>HEURE</label>  
   <input type="time" id="time_rep" class="form-control"   name="date" value="HH:MM"  ><br>
  
    <label hidden="true">BL</label>
    <input hidden="true" style="height: 25px;" type="text" class="form-control"   id=bl_rep >
     <label hidden="true">CAMION</label>
     <input hidden="true" style="height: 25px;" type="text" class="form-control"  id="camion_rep"  name="camion"  >
     <label hidden="true">CHAUFFEUR</label>
      <input hidden="true" style="height: 25px;" type="text" class="form-control"  id="chauffeur_rep"  name="chauffeur"  >
      <label>SAC</label>
        <input style="height: 25px;" type="text" class="form-control"  id="sac_rep"  name="sac"  ><br>
        
         <label>MANQUANT</label>
        <input style="height: 25px;" type="text" class="form-control"  id="manquant_rep"  name="manquant" value="0" ><br>
       
       <div style="display: none;">  
         <label>poids sac</label>
        <input style="height: 25px;" type="text" class="form-control"  id="poids_sac_rep"  name="poids_sac"  >
         
         <label>id_produit</label>
        <input style="height: 25px;" type="text" class="form-control"  id="id_produit_rep"  name="id_produit"  >
        <label>id_dis</label>
        <input style="height: 25px;" type="text" class="form-control"  id="id_dis_bl_rep"  name="id_dis_bl"  >
          <label>DEC</label>
        <input style="height: 25px;" type="text" class="form-control"  id="id_declaration_rep"  name="declaration"  >
         <label>CLI</label>
        <input style="height: 25px;" type="text" class="form-control"  id="id_client_rep"  name="client"  >
         <label>des</label>
        <input style="height: 25px;" type="text" class="form-control"  id="id_destination_rep"  name="destination"  >
         <label>NAVIRE</label>
        <input style="height: 25px;" type="text" class="form-control"  id="id_navire_rep"  name="navire"  >
                 <label>id</label>
        <input style="height: 25px;" type="text" class="form-control"  id="id_rep"  name="id"  >
        <input style="height: 25px;" type="text" class="form-control"  id="get_id"  name="id"  >
        </div>
        

    
</div>


</center>



         
        
</form> 
       <center>  
      <div class="modal-footer">
          
         <a  id="save_reception" style="width: 50%;" class="btn btn-primary " name="valider_reception">valider</a> 
         
      </div>
  </center>
      </div>
    </div>
  </div>





<div class="modal fade" id="form_reception_av" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style=" border: solid; border-color:rgb(0,141,202); ">
            <div class="modal-header" style="">
              <center>
                <h3 class="modal-title fs-10 text-white text-center" id="exampleModalLabel " style="text-align:center;   ">MODIFICATION</h3></center>
                <center>
              <img class="logoo" src="../images/mylogo.ico" >
       </center>
        
      </div>
       <br> <br>
        <form  method="POST">

     

      
        
        

      ?>

<center>

   <div class="mb-3">
    
    <label>DATE</label>  
   <input type="date" id="date_avv" class="form-control"   name="date" ><br>
       <label>HEURE</label>  
   <input type="time" id="time_avv" class="form-control"   name="date" ><br>
  
    <label hidden="true">BL</label>
    <input hidden="true" style="height: 25px;" type="text" class="form-control"   id=bl_avv >
     <label hidden="true">CAMION</label>
     <input hidden="true" style="height: 25px;" type="text" class="form-control"  id="camion_avv"  name="camion"  >
     <label hidden="true">CHAUFFEUR</label>
      <input hidden="true" style="height: 25px;" type="text" class="form-control"  id="chauffeur_avv"  name="chauffeur"  >
      <label>SACS FLASQUE</label>
        <input style="height: 25px;" type="text" class="form-control"  id="sacf_avv"  name="sac"  ><br>
        <label>POIDS FLASQUE</label>
        <input style="height: 25px;" type="text" class="form-control"  id="poidsf_avv"  name="sac"  ><br>
         <label>SACS MOUILLE</label>
        <input style="height: 25px;" type="text" class="form-control"  id="sacm_avv"  name="sac"  ><br>
           <label>MANQUANT</label>
        <input style="height: 25px;" type="text" class="form-control"  id="manquant_avv"  name="sac" value="0" ><br>
        
        
       
       <div >  
         <label>poids sac</label>
        <input style="height: 25px;" type="text" class="form-control"  id="poids_sac_avv"  name="poids_sac"  >
         
         <label>id_produit</label>
        <input style="height: 25px;" type="text" class="form-control"  id="id_produit_avv"  name="id_produit"  >
        <label>id_dis</label>
        <input style="height: 25px;" type="text" class="form-control"  id="id_dis_bl_avv"  name="id_dis_bl"  >
          <label>DEC</label>
        <input style="height: 25px;" type="text" class="form-control"  id="id_declaration_avv"  name="declaration"  >
         <label>CLI</label>
        <input style="height: 25px;" type="text" class="form-control"  id="id_client_avv"  name="client"  >
         <label>des</label>
        <input style="height: 25px;" type="text" class="form-control"  id="id_destination_avv"  name="destination"  >
         <label>NAVIRE</label>
        <input style="height: 25px;" type="text" class="form-control"  id="id_navire_avv"  name="navire"  >
                 <label>id</label>
        <input style="height: 25px;" type="text" class="form-control"  id="id_avv"  name="id"  >
         
        <input style="height: 25px;" type="text" class="form-control"  id="get_id_avv"  name="id" >
        </div>
  
          

</div>


</center>



         
        

       <center>  
      <div class="modal-footer">
          
         <a  id="save_re" style="width: 50%;" class="btn btn-primary " name="valider_reception">valider</a> 
         
      </div>
      </form> 
  </center>
      </div>
    </div>
  </div>













<div class="modal fade" id="form_reception_ra" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style=" border: solid; border-color:rgb(0,141,202); ">
            <div class="modal-header" style="">
              <center>
                <h3 class="modal-title fs-10 text-white text-center" id="exampleModalLabel " style="text-align:center;   ">MODIFICATION</h3></center>
                <center>
              <img class="logoo" src="../images/mylogo.ico" >
       </center>
        
      </div>
       <br> <br>
        <form  method="POST">

     

      
        
        

      ?>

<center>

   <div class="mb-3">
    
    <label>DATE</label>  
   <input type="date" id="date_rep_ra" class="form-control"   name="date" ><br>
  
    <label>BL</label>
    <input style="height: 25px;" type="text" class="form-control"   id=bl_rep_ra ><br>
     <label>CAMION</label>
     <input style="height: 25px;" type="text" class="form-control"  id="camion_rep_ra"  name="camion"  ><br>
     <label>CHAUFFEUR</label>
      <input style="height: 25px;" type="text" class="form-control"  id="chauffeur_rep_ra"  name="chauffeur"  ><br>
      <label>SAC Flasque</label>
        <input style="height: 25px;" type="text" class="form-control"  id="sacf_rep_ra"  name="sac"  ><br>
             <label>POIDS Flasque</label>
        <input style="height: 25px;" type="text" class="form-control"  id="poidsf_rep_ra"  name="sac"  ><br>
        <label>SAC MOUILLE</label>
        <input style="height: 25px;" type="text" class="form-control"  id="sacm_rep_ra"  name="sac"  ><br>
               <label>POIDS MOUILLE</label>
        <input style="height: 25px;" type="text" class="form-control"  id="poidsm_rep_ra"  name="sac"  ><br>
        
         <label>MANQUANT</label>
        <input style="height: 25px;" type="text" class="form-control"  id="manquant_rep_ra"  name="manquant" value="0" ><br>
       
       
         <label>poids sac</label>
        <input style="height: 25px;" type="text" class="form-control"  id="poids_sac_rep_ra"  name="poids_sac"  >
         
         <label>id_produit</label>
        <input style="height: 25px;" type="text" class="form-control"  id="id_produit_rep_ra"  name="id_produit"  >
        <label>id_dis</label>
        <input style="height: 25px;" type="text" class="form-control"  id="id_dis_bl_rep_ra"  name="id_dis_bl"  >
          <label>DEC</label>
        <input style="height: 25px;" type="text" class="form-control"  id="id_declaration_rep_ra"  name="declaration"  >
         <label>CLI</label>
        <input style="height: 25px;" type="text" class="form-control"  id="id_client_rep_ra"  name="client"  >
         <label>des</label>
        <input style="height: 25px;" type="text" class="form-control"  id="id_destination_rep_ra"  name="destination"  >
         <label>NAVIRE</label>
        <input style="height: 25px;" type="text" class="form-control"  id="id_navire_rep_ra"  name="navire"  >
                 <label>id</label>
        <input style="height: 25px;" type="text" class="form-control"  id="id_rep_ra"  name="id"  >
        
        

    
</div>


</center>



         
        
</form> 
       <center>  
      <div class="modal-footer">
          
         <a  id="save_reception_ra" style="width: 50%;" class="btn btn-primary " name="valider_reception">valider</a> 
         
      </div>
  </center>
      </div>
    </div>
  </div>
</div>





<div class="modal fade" id="form_avaries_reception" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style=" border: solid; border-color:rgb(0,141,202); ">
            <div class="modal-header" style="">
              <center>
                <h3 class="modal-title fs-10 text-white text-center" id="exampleModalLabel " style="text-align:center;   ">MODIFICATION AVR</h3></center>
                <center>
              <img class="logoo" src="../images/mylogo.ico" >
       </center>
        
      </div>
       <br> <br>
        <form  method="POST">

     

      
        
        

      ?>

<center>

   <div class="mb-3">
    
    <label>DATE</label>  
   <input type="text" id="date_avr2" class="form-control"   name="date" ><br>
  
   
      <label>SAC Flasque</label>
        <input style="height: 25px;" type="text" class="form-control"  id="sacf_avr2"  name="sac"  ><br>
           
        <label>SAC MOUILLE</label>
        <input style="height: 25px;" type="text" class="form-control"  id="sacm_avr2"  name="sac"  ><br>
              
        <label>id_dis</label>
        <input style="height: 25px;" type="text" class="form-control"  id="id_dis_avr2"  name="id_dis_bl"  >
          
                 <label>id</label>
        <input style="height: 25px;" type="text" class="form-control"  id="id_avr2"  name="id"  >
        
        

    
</div>


</center>



         
        
</form> 
       <center>  
      <div class="modal-footer">
          
         <a  id="save_avaries_reception" style="width: 50%;" class="btn btn-primary " name="valider_reception">valider</a> 
         
      </div>
  </center>
      </div>
    </div>
  </div>




<div class="modal fade" id="form_avaries_debarquement" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style=" border: solid; border-color:rgb(0,141,202); ">
            <div class="modal-header" style="">
              <center>
                <h3 class="modal-title fs-10 text-white text-center" id="exampleModalLabel " style="text-align:center;   ">MODIFICATION AVR</h3></center>
                <center>
              <img class="logoo" src="../images/mylogo.ico" >
       </center>
        
      </div>
       <br> <br>
        <form  method="POST">

     

      
        
        

      ?>

<center>

   <div class="mb-3">
    
    <label>DATE</label>  
   <input type="text" id="date_deb2" class="form-control"   name="date" ><br>
   <label>HEURE</label>  
   <input type="time" id="time_deb2" class="form-control"   name="date" ><br>

   <div style="display: none;">  
   <label>BL</label>  
  <input type="text" id="bl_deb2" class="form-control"   ><br>
  </div>
   
      <label>SAC Flasque</label>
        <input style="height: 25px;" type="text" class="form-control"  id="sacf_deb2"  name="sac"  ><br>

         <label>POIDS Flasque</label>
        <input style="height: 25px;" type="text" class="form-control"  id="poidsf_deb2"  name="sac"  ><br>
           
        <label>SAC MOUILLE</label>
        <input style="height: 25px;" type="text" class="form-control"  id="sacm_deb2"  name="sac"  ><br>
              
        <label>id_dis</label>
        <input style="height: 25px;" type="text" class="form-control"  id="id_dis_deb2"  name="id_dis_bl"  >
          
                 <label>id</label>
        <input style="height: 25px;" type="text" class="form-control"  id="id_deb2"  name="id"  >
                     <label>p_sac</label>
        <input style="height: 25px;" type="text" class="form-control"  id="poids_sac_deb2"  name="id"  >
        
        

    
</div>


</center>



         
        
</form> 
       <center>  
      <div class="modal-footer">
          
         <a  id="save_avaries_debarquement" style="width: 50%;" class="btn btn-primary " name="valider_reception">valider</a> 
         
      </div>
  </center>
      </div>
    </div>
  </div>







  
     
  <div id="main">

<div class="container-fluid1 " id="situation"  style=" background: rgb(0,141,202);" >
        <div class="row">
            
            
                <div class="col-lg-12 col-md-12">
                    <h1 class="hem2" > RECONDITIONNEMENT</h1><br>

                    
                    <form method="POST" >
                        <select  id="navires" class="mysel" style="margin-right: 15%; height: 30px;   width: 40%;"  onchange='goNavireSit()'>
                            <option value="">selectionner un navire</option>
                            <?php 
                            
                              if($_SESSION['profil']=="Mangasinier"){
                                 $naviress=choix_du_navire($bdd,$a);
                               }
                               else{
                                $naviress=choix_du_navire2($bdd);
                              }

                             while($row=$naviress->fetch()) {
                             ?>
                                <option value=<?php echo $row['id_navire'].'-'.$_GET['id']; ?> >  <?php echo $row['navire'] ?> </option>
                            <?php } ?>

                 </select>
                        
                     <select id="mesprod" class="mysel" name="produit" style="margin-right: 2%; height: 30px;  width: 40%;" onchange='goProduit()'>
                            <option  selected>selectionner le produit</option>
                        </select>
                        
                 
                            
                    </form>
                
            </div>
        </div>
    </div>



  </div>
  <br><br>



    <br><br>
    <div class="sit" id="sit">
    </div>
    </div>



<div style="z-index: 9999999;" class="modal fade" id="situation_24h" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style=" border: solid; border-color:rgb(0,141,202); ">
            <div class="modal-header" style="">
              <center>
                <h3 class="modal-title fs-10 text-white text-center" id="exampleModalLabel " style="text-align:center;   ">MODIFICATION</h3></center>
                <center>
              <img class="logoo" src="../images/mylogo.ico" >
       </center>
        
      </div>
       <br> <br>
        <form  method="POST">

     

      
        
        

      ?>

<center>

   <div class="mb-3">
    
    <label>DATE</label>  
   <input type="date" id="date_sit" class="form-control"   name="date" ><br>
   <label> FLASQUES DE RECEPTION EN SACS</label>
    <input style="height: 25px;" type="number" class="form-control"   id=flasque_si ><br>
     <label>MOUILLE DE RECEPTION EN SACS</label>
     <input style="height: 25px;" type="number" class="form-control"  id="mouille_si"  name="camion"  ><br>
   <label>id_dis</label>  
   <input type="text" id="id_dis_sit"  class="form-control"   name="FF" ><br>
        
        

    
</div>


</center>



         
        
</form> 
       <center>  
      <div class="modal-footer">
          
         <a  id="save_situation" style="width: 50%;" class="btn btn-primary " name="valider_reception">valider</a> 
         
      </div>
  </center>
      </div>
    </div>
  </div>
</div>






<div style="z-index: 9999999;" class="modal fade" id="form_situation_reception" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style=" border: solid; border-color:rgb(0,141,202); ">
            <div class="modal-header" style="">
              <center>
                <h3 class="modal-title fs-10 text-white text-center" id="exampleModalLabel " style="text-align:center;   ">MODIFICATION</h3></center>
                <center>
              <img class="logoo" src="../images/mylogo.ico" >
       </center>
        
      </div>
       <br> <br>
        <form  method="POST">

     

      
        
        

      ?>

<center>

   <div class="mb-3">
    
    <label>DATE</label>  
   <input type="date" id="date_sit_rep" class="form-control"   name="date" ><br>
   <label> FLASQUES DE RECEPTION EN SACS</label>
    <input style="height: 25px;" type="number" class="form-control" value="0"   id=flasque_sit ><br>
     <label>MOUILLE DE RECEPTION EN SACS</label>
     <input style="height: 25px;" type="number" class="form-control" value="0"  id="mouille_sit"  name="camion"  ><br>
   <label>id_dis</label>  
   <input type="text" id="id_dis_rec"  class="form-control"   name="FF" ><br>
        
        

    
</div>


</center>



         
        
</form> 
       <center>  
      <div class="modal-footer">
          
         <a  id="save_situation2" style="width: 50%;" class="btn btn-primary " name="valider_reception">valider</a> 
         
      </div>
  </center>
      </div>
    </div>
  </div>
</div>




<div style="z-index: 9999999;" class="modal fade" id="form_reconditionnement" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style=" border: solid; border-color:rgb(0,141,202); ">
            <div class="modal-header" style="">
              <center>
                <h3 class="modal-title fs-10 text-white text-center" id="exampleModalLabel " style="text-align:center;   ">RECONDITIONNEMENT</h3></center>
                <center>
              <img class="logoo" src="../images/mylogo.ico" >
       </center>
        
      </div>
       <br> <br>
        <form  method="POST">

     

      
        
        

      ?>

<center>

   <div class="mb-3">
    
    <label>DATE</label>  
   <input type="date" id="date_recond" class="form-control"   name="date" ><br>
   <label> SACS EVENTRES</label>
    <input style="height: 25px;" type="number" class="form-control" value="0"   id=sac_eventres ><br>
   <label> SACS RECONDITIONNER</label>
    <input style="height: 25px;" type="number" class="form-control" value="0"   id=sac_recond ><br>
     <label>balayure sac</label>
     <input style="height: 25px;" type="number" class="form-control" value="0"  id="sac_balayure"  name="camion"  ><br>
   <label>balayure poids</label>  
   <input type="number" id="poids_balayure"  class="form-control"   name="FF" value="0" ><br>
   <div style="">  
    <input type="text" id="poids_sac_recond"  class="form-control"   name="FF" ><br>     
      <input type="text" id="id_dis_recond"  class="form-control"   name="FF" ><br>
       <input type="text" id="navire_recond"  class="form-control"   name="FF" ><br>   
      <input type="text" id="id_produit_recond"  class="form-control"   name="FF" ><br> 
      <input type="text" id="id_destination_recond"  class="form-control"   name="FF" ><br> 
      <input type="text" id="id_declaration_recond"  class="form-control"   name="FF" ><br> 
      </div>
    
</div>


</center>



         
        
</form> 
       <center>  
      <div class="modal-footer">
          
         <a  id="save_recond" style="width: 50%;" class="btn btn-primary " name="valider_reception">valider</a> 
         
      </div>
  </center>
      </div>
    </div>
  </div>
</div>












        
		

	<!-- Footer -->				
	<footer style="display: none;">
		<div class="footer">
			<div class="float-start">
				<p>2023 &copy; Ibradev</p>
			</div>
				<div class="float-end">
					<p>Created with 
						<span class="text-danger">
							<i class="fa fa-heart"></i> by 
							<a href="https://www.facebook.com/andreew.co.id/" class="author-footer">Ibradev</a>
						</span> 
					</p>
			</div>
		</div>
	</footer>


	<!-- Preloader -->
	<div class="loader">
		<div class="spinner-border text-light" role="status">
			<span class="sr-only">Loading...</span>
		</div>
	</div>
	
	<!-- Loader -->
	<div class="loader-overlay"></div>

	<!-- General JS Scripts -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="../assets/js/atrana.js"></script>

	<!-- JS Libraies -->
	<script src="../assets/modules/jquery/jquery.min.js"></script>

	<script src="../assets/modules/bootstrap-5.1.3/js/bootstrap.bundle.min.js"></script>
	<script src="../assets/modules/popper/popper.min.js"></script>

	<!-- Chart Js -->
	<script src="../assets/modules/apexcharts/apexcharts.js"></script>
	<script src="../assets/js/ui-apexcharts.js"></script>

    <!-- Template JS File -->
	<script src="../assets/js/script.js"></script>
	<script src="../assets/js/custom.js"></script>
   
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


 
   

<script type="text/javascript"> 
      function filtreca() {
        var search = document.getElementById('myInput').value;
        var camionList = document.getElementById('camionList');
        camionList.style.display="block";
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'action.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
          if (xhr.readyState === 4 && xhr.status === 200) {
            camionList.innerHTML = xhr.responseText;
          }
        };
        xhr.send('query=' + search);
      }

       function stockerIds(element) {
    var camionId = element.id;
    var input2 = document.getElementById("val_input2");
    input2.value = camionId;

   /* var camionText = element.innerText;
    var input = document.getElementById("myInput");
    input.value = camionText;
    var div = document.getElementById("camionList");
    div.style.display = "none"; */
    var camtext = document.getElementById("n_camions"+camionId);
    var camionText = camtext.innerText;
    var input = document.getElementById("myInput");
    input.value = camtext.innerText;
    var div = document.getElementById("camionList");
    div.style.display = "none";

    var trtext = document.getElementById("transp"+camionId);
     var transpText = trtext.innerText;
    var input3 = document.getElementById("myInputTransp");
    input3.value = transpText;
     

    
  }
    </script>


 <script type="text/javascript"> 
      function filtreChau() {
        var search = document.getElementById('myInputc').value;
        var camionList = document.getElementById('camionListc');
        camionList.style.display="block";
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'action_chauffeur.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
          if (xhr.readyState === 4 && xhr.status === 200) {
            camionList.innerHTML = xhr.responseText;
          }
        };
        xhr.send('query=' + search);
      }

        function stockerIdc(element) {
    var camionId = element.id;
    var input2 = document.getElementById("val_input2c");
    input2.value = camionId;

    var camionText = element.innerText;
    var input = document.getElementById("myInputc");
    input.value = camionText;
    var div = document.getElementById("camionListc");
    div.style.display = "none";

  input2.value = chauffeurId;

    
  }
    </script>


<script type="text/javascript"> 
      function filtreca3() {
        var search = document.getElementById('myInput3').value;
        var camionList = document.getElementById('camionList3');
        camionList.style.display="block";
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'action3.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
          if (xhr.readyState === 4 && xhr.status === 200) {
            camionList.innerHTML = xhr.responseText;
          }
        };
        xhr.send('query=' + search);
      }

       function stockerIds3(element) {
    var camionId = element.id;
    var input2 = document.getElementById("val_input3");
    input2.value = camionId;

   /* var camionText = element.innerText;
    var input = document.getElementById("myInput");
    input.value = camionText;
    var div = document.getElementById("camionList");
    div.style.display = "none"; */
    var camtext = document.getElementById("n_camions"+camionId);
    var camionText = camtext.innerText;
    var input = document.getElementById("myInput3");
    input.value = camtext.innerText;
    var div = document.getElementById("camionList3");
    div.style.display = "none";

    var trtext = document.getElementById("transp"+camionId);
     var transpText = trtext.innerText;
    var input3 = document.getElementById("myInputTransp3");
    input3.value = transpText;
     

    
  }
    </script>


 <script type="text/javascript"> 
      function filtreChau3() {
        var search = document.getElementById('myInputc3').value;
        var camionList = document.getElementById('camionListc3');
        camionList.style.display="block";
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'action_chauffeur3.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
          if (xhr.readyState === 4 && xhr.status === 200) {
            camionList.innerHTML = xhr.responseText;
          }
        };
        xhr.send('query=' + search);
      }

        function stockerIdc3(element) {
    var camionId = element.id;
    var input2 = document.getElementById("val_input3c");
    input2.value = camionId;

    var camionText = element.innerText;
    var input = document.getElementById("myInputc3");
    input.value = camionText;
    var div = document.getElementById("camionListc3");
    div.style.display = "none";

  input2.value = chauffeurId;

    
  }
    </script>




   <script type="text/javascript">
  function deleteAjax(id){
   
       if(confirm('Voulez vous vraiment supprimer ce donnée?')){
         
         $.ajax({

              type:'post',
              url:'delete.php',
              data:{delete_id:id},
              success:function(data){
              
                   $('#'+id+'colonnebl').hide('slow');

              }

         });

       }


     }

 


 </script>



  <script type='text/javascript'>
 
            function getXhr(){
                                var xhr = null; 
                if(window.XMLHttpRequest) // Firefox et autres
                   xhr = new XMLHttpRequest(); 
                else if(window.ActiveXObject){ // Internet Explorer 
                   try {
                            xhr = new ActiveXObject("Msxml2.XMLHTTP");
                        } catch (e) {
                            xhr = new ActiveXObject("Microsoft.XMLHTTP");
                        }
                }
                else { // XMLHttpRequest non supporté par le navigateur 
                   alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest..."); 
                   xhr = false; 
                } 
                                return xhr;
            }
 
            /**
            * Méthode qui sera appelée sur le clic du bouton
            */
            function goNavire(){
                var xhr = getXhr();
                // On définit ce qu'on va faire quand on aura la réponse
                xhr.onreadystatechange = function(){
                    // On ne fait quelque chose que si on a tout reçu et que le serveur est OK
                    if(xhr.readyState == 4 && xhr.status == 200){
                        leselect = xhr.responseText;
                        // On se sert de innerHTML pour rajouter les options à la liste
                        document.getElementById('produit').innerHTML = leselect;

                    }
                }
 
                // Ici on va voir comment faire du post
                xhr.open("POST","selectProduit.php",true);
                // ne pas oublier ça pour le post
                xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
                // ne pas oublier de poster les arguments
                // ici, l'id de l'auteur
                sel = document.getElementById('navire');
                idnavire = sel.options[sel.selectedIndex].value;
                xhr.send("idNavire="+idnavire);
            }
        </script>

        <script type='text/javascript'>
 
            function getXhr(){
                                var xhr = null; 
                if(window.XMLHttpRequest) // Firefox et autres
                   xhr = new XMLHttpRequest(); 
                else if(window.ActiveXObject){ // Internet Explorer 
                   try {
                            xhr = new ActiveXObject("Msxml2.XMLHTTP");
                        } catch (e) {
                            xhr = new ActiveXObject("Microsoft.XMLHTTP");
                        }
                }
                else { // XMLHttpRequest non supporté par le navigateur 
                   alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest..."); 
                   xhr = false; 
                } 
                                return xhr;
            }
 
            /**
            * Méthode qui sera appelée sur le clic du bouton
            */
            function goProduit(){
                var xhr = getXhr();
                // On définit ce qu'on va faire quand on aura la réponse
                xhr.onreadystatechange = function(){
                    // On ne fait quelque chose que si on a tout reçu et que le serveur est OK
                    if(xhr.readyState == 4 && xhr.status == 200){
                        lecale = xhr.responseText;
                        // On se sert de innerHTML pour rajouter les options à la liste
                        document.getElementById('main').innerHTML = lecale;

                    }
                }
 
                // Ici on va voir comment faire du post
                xhr.open("POST","selectTableRecond.php",true);
                // ne pas oublier ça pour le post
                xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
                // ne pas oublier de poster les arguments
                // ici, l'id de l'auteur
                sel = document.getElementById('mesprod');
                id_dis=document.getElementById('id_dis_sit');

                idproduit = sel.options[sel.selectedIndex].value;
                id_dis.value=idproduit;
                xhr.send("idProduit="+idproduit);
            }
        </script>




        
        <script type='text/javascript'>
 
            function getXhr(){
                                var xhr = null; 
                if(window.XMLHttpRequest) // Firefox et autres
                   xhr = new XMLHttpRequest(); 
                else if(window.ActiveXObject){ // Internet Explorer 
                   try {
                            xhr = new ActiveXObject("Msxml2.XMLHTTP");
                        } catch (e) {
                            xhr = new ActiveXObject("Microsoft.XMLHTTP");
                        }
                }
                else { // XMLHttpRequest non supporté par le navigateur 
                   alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest..."); 
                   xhr = false; 
                } 
                                return xhr;
            }
 
            /**
            * Méthode qui sera appelée sur le clic du bouton
            */
            function goDateSit(){
                var xhr = getXhr();
                // On définit ce qu'on va faire quand on aura la réponse
                xhr.onreadystatechange = function(){
                    // On ne fait quelque chose que si on a tout reçu et que le serveur est OK
                    if(xhr.readyState == 4 && xhr.status == 200){
                        lecales = xhr.responseText;
                        // On se sert de innerHTML pour rajouter les options à la liste
                        document.getElementById('sit').innerHTML = lecales;

                    }
                }
 
                // Ici on va voir comment faire du post
                xhr.open("POST","selectTableSituation.php",true);
                // ne pas oublier ça pour le post
                xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
                // ne pas oublier de poster les arguments
                // ici, l'id de l'auteur
                sel = document.getElementById('date');
                iddate = sel.options[sel.selectedIndex].value;
                xhr.send("idDate="+iddate);
            }
        </script>  


        <script type='text/javascript'>
 
            function getXhr(){
                                var xhr = null; 
                if(window.XMLHttpRequest) // Firefox et autres
                   xhr = new XMLHttpRequest(); 
                else if(window.ActiveXObject){ // Internet Explorer 
                   try {
                            xhr = new ActiveXObject("Msxml2.XMLHTTP");
                        } catch (e) {
                            xhr = new ActiveXObject("Microsoft.XMLHTTP");
                        }
                }
                else { // XMLHttpRequest non supporté par le navigateur 
                   alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest..."); 
                   xhr = false; 
                } 
                                return xhr;
            }
 
            /**
            * Méthode qui sera appelée sur le clic du bouton
            */
            function camion(){
                var xhr = getXhr();
                // On définit ce qu'on va faire quand on aura la réponse
                xhr.onreadystatechange = function(){
                    // On ne fait quelque chose que si on a tout reçu et que le serveur est OK
                    if(xhr.readyState == 4 && xhr.status == 200){
                     var   lec = xhr.responseText;
                        // On se sert de innerHTML pour rajouter les options à la liste
                        document.getElementById('chauf').innerHTML = lec;
                     
                        // On se sert de innerHTML pour rajouter les options à la liste
                        

                    }
                }
 
                // Ici on va voir comment faire du post
                xhr.open("POST","selectCamions.php",true);
                // ne pas oublier ça pour le post
                xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
                // ne pas oublier de poster les arguments
                // ici, l'id de l'auteur
                sel = document.getElementById('cam');
                idcam = sel.options[sel.selectedIndex].value;
                xhr.send("idCam="+idcam);
            }
        </script>  


 <script type='text/javascript'>
 
            function getXhr(){
                                var xhr = null; 
                if(window.XMLHttpRequest) // Firefox et autres
                   xhr = new XMLHttpRequest(); 
                else if(window.ActiveXObject){ // Internet Explorer 
                   try {
                            xhr = new ActiveXObject("Msxml2.XMLHTTP");
                        } catch (e) {
                            xhr = new ActiveXObject("Microsoft.XMLHTTP");
                        }
                }
                else { // XMLHttpRequest non supporté par le navigateur 
                   alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest..."); 
                   xhr = false; 
                } 
                                return xhr;
            }
 
            /**
            * Méthode qui sera appelée sur le clic du bouton
            */
            function chauffe(){
                var xhr = getXhr();
                // On définit ce qu'on va faire quand on aura la réponse
                xhr.onreadystatechange = function(){
                    // On ne fait quelque chose que si on a tout reçu et que le serveur est OK
                    if(xhr.readyState == 4 && xhr.status == 200){
                     var   lek = xhr.responseText;
                        // On se sert de innerHTML pour rajouter les options à la liste
                        document.getElementById('info_chauffeur').innerHTML = lek;
                         
                        // On se sert de innerHTML pour rajouter les options à la liste
                        

                    }
                }
 
                // Ici on va voir comment faire du post
                xhr.open("POST","selectInfoChauffeur2.php",true);
                // ne pas oublier ça pour le post
                xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
                // ne pas oublier de poster les arguments
                // ici, l'id de l'auteur
                sel = document.getElementById('chauf');
                idchauffeur = sel.options[sel.selectedIndex].value;
                xhr.send("idChauffeur="+idchauffeur);
            }
        </script>  



        <script type='text/javascript'>
 
            function getXhr(){
                                var xhr = null; 
                if(window.XMLHttpRequest) // Firefox et autres
                   xhr = new XMLHttpRequest(); 
                else if(window.ActiveXObject){ // Internet Explorer 
                   try {
                            xhr = new ActiveXObject("Msxml2.XMLHTTP");
                        } catch (e) {
                            xhr = new ActiveXObject("Microsoft.XMLHTTP");
                        }
                }
                else { // XMLHttpRequest non supporté par le navigateur 
                   alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest..."); 
                   xhr = false; 
                } 
                                return xhr;
            }
 
            /**
            * Méthode qui sera appelée sur le clic du bouton
            */
            function camion2(){
                var xhr = getXhr();
                // On définit ce qu'on va faire quand on aura la réponse
                xhr.onreadystatechange = function(){
                    // On ne fait quelque chose que si on a tout reçu et que le serveur est OK
                    if(xhr.readyState == 4 && xhr.status == 200){
                     var   lec = xhr.responseText;
                        // On se sert de innerHTML pour rajouter les options à la liste
                        document.getElementById('chauf2').innerHTML = lec;
                     
                        // On se sert de innerHTML pour rajouter les options à la liste
                        

                    }
                }
 
                // Ici on va voir comment faire du post
                xhr.open("POST","selectCamions2.php",true);
                // ne pas oublier ça pour le post
                xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
                // ne pas oublier de poster les arguments
                // ici, l'id de l'auteur
                sel = document.getElementById('cam2');
                idcam = sel.options[sel.selectedIndex].value;
                xhr.send("idCam="+idcam);
            }
        </script>  


 <script type='text/javascript'>
 
            function getXhr(){
                                var xhr = null; 
                if(window.XMLHttpRequest) // Firefox et autres
                   xhr = new XMLHttpRequest(); 
                else if(window.ActiveXObject){ // Internet Explorer 
                   try {
                            xhr = new ActiveXObject("Msxml2.XMLHTTP");
                        } catch (e) {
                            xhr = new ActiveXObject("Microsoft.XMLHTTP");
                        }
                }
                else { // XMLHttpRequest non supporté par le navigateur 
                   alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest..."); 
                   xhr = false; 
                } 
                                return xhr;
            }
 
            /**
            * Méthode qui sera appelée sur le clic du bouton
            */
            function chauffe2(){
                var xhr = getXhr();
                // On définit ce qu'on va faire quand on aura la réponse
                xhr.onreadystatechange = function(){
                    // On ne fait quelque chose que si on a tout reçu et que le serveur est OK
                    if(xhr.readyState == 4 && xhr.status == 200){
                     var   lek = xhr.responseText;
                        // On se sert de innerHTML pour rajouter les options à la liste
                        document.getElementById('info_chauffeur2').innerHTML = lek;
                         
                        // On se sert de innerHTML pour rajouter les options à la liste
                        

                    }
                }
 
                // Ici on va voir comment faire du post
                xhr.open("POST","selectInfoChauffeur2.php",true);
                // ne pas oublier ça pour le post
                xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
                // ne pas oublier de poster les arguments
                // ici, l'id de l'auteur
                sel = document.getElementById('chauf2');
                idchauffeur = sel.options[sel.selectedIndex].value;
                xhr.send("idChauffeur="+idchauffeur);
            }
        </script> 


  

    




 <script type="text/javascript">
  function deleteAjax2(id){
   
       if(confirm('Voulez vous vraiment supprimer ce donnée?')){
         
         $.ajax({

              type:'post',
              url:'delete.php',
              data:{delete_id:id},
              success:function(data){
              
                   $('#'+id+'colonnebl').hide('slow');

              }

         });

       }


     }

 


 </script>





 



<script type="text/javascript">
    
$(document).ready(function() {
  $('#archive-button').click(function() {
    // Insérez ici le code pour archiver les dossiers
  });
});


</script>





<script type="text/javascript">
function filterOptions() {
  var input = document.getElementById("myInput");
  var select = document.getElementById("came");
  var filter = input.value.toLowerCase();

  // Parcourir toutes les options du select à partir de l'index 1 (excluant l'option "Sélectionnez un camion")
  for (var i = 1; i < select.options.length; i++) {
    var option = select.options[i];
    var text = option.textContent.toLowerCase();

    // Vérifier si le texte de l'option contient le filtre saisi
    if (text.indexOf(filter) > -1) {
      option.style.display = ""; // Afficher l'option
    } else {
      option.style.display = "none"; // Masquer l'option
    }
  }

  // Sélectionner automatiquement la première option correspondante
  select.selectedIndex = 0; // Réinitialiser la sélection

  for (var i = 1; i < select.options.length; i++) {
    var option = select.options[i];
    if (option.style.display !== "none") {
      select.selectedIndex = i; // Sélectionner l'option correspondante
      break;
    }
  }
}


</script>


<script type="text/javascript">
function filtreChauffeurs() {
  var input = document.getElementById("myInput2");
  var select = document.getElementById("chauf");
  var filter = input.value.toLowerCase();


  

  // Parcourir toutes les options du select à partir de l'index 1 (excluant l'option "Sélectionnez un camion")
  for (var i = 1; i < select.options.length; i++) {
    
    var option = select.options[i];


    var text = option.textContent.toLowerCase();

    // Vérifier si le texte de l'option contient le filtre saisi
    if (text.indexOf(filter) > -1) {
      option.style.display = ""; // Afficher l'option
     
    } else {
      option.style.display = "none"; // Masquer l'option
    }
  }


  // Sélectionner automatiquement la première option correspondante
  select.selectedIndex = 0; // Réinitialiser la sélection

  for (var i = 1; i < select.options.length; i++) {
    var option = select.options[i];
    if (option.style.display !== "none") {
      select.selectedIndex = i; // Sélectionner l'option correspondante
      break;
    }
  }

}



</script>


<script>
  // Récupérer le bouton de fermeture d'erreur
  var closeButton = document.getElementById('close_erreur');

  // Récupérer le div d'erreur
  var errorDiv = document.getElementById('erreur');

  // Ajouter un gestionnaire d'événement au clic sur le bouton de fermeture
  closeButton.addEventListener('click', function() {
    // Masquer le div d'erreur en modifiant sa propriété de style
    errorDiv.style.display = 'none';
  });
</script>


<script type="text/javascript">


  $(document).ready(function(){
    $(document).on('click','a[data-role=insert_reception]',function(){
        var id = $(this).data('id');
        var date = $('#'+id+'date').text();
        var getid = $('#'+id+'getid').text();
        var bl = $('#'+id+'bl').text();
        var camion = $('#'+id+'camion').text();
        var chauffeur = $('#'+id+'chauffeur').text();
        var sac = $('#'+id+'sac').text();
        var manquant = $('#'+id+'manquant').text();
        var id_dis_bl = $('#'+id+'id_dis_bl').text();
        var poids_sac = $('#'+id+'poids_sac').text();
        var id_produit = $('#'+id+'id_produit').text();
        var id_declaration = $('#'+id+'id_declaration').text();
        var id_destination = $('#'+id+'id_destination').text();
        var id_client = $('#'+id+'id_client').text();
        var id_navire = $('#'+id+'id_navire').text();
   
        $('#date_rep').val(date);

        $('#bl_rep').val(bl);
        $('#sac_rep').val(sac);
        $('#camion_rep').val(camion);
        $('#chauffeur_rep').val(chauffeur);
        $('#bl_rep').val(bl);
        $('#poids_sac_rep').val(poids_sac);
        $('#id_produit_rep').val(id_produit);
        $('#id_dis_bl_rep').val(id_dis_bl);
        $('#id_declaration_rep').val(id_declaration);
        $('#id_destination_rep').val(id_destination);
        $('#id_client_rep').val(id_client);
        $('#id_navire_rep').val(id_navire);
        $('#id_rep').val(id);
         $('#get_id').val(getid);
        

        
        $('#form_reception').modal('toggle');
    });
    
    $('#save_reception').click(function(){
         
        var date = $('#date_rep').val();
       var heure= $('#time_rep').val();
        var bl = $('#bl_rep').val();
        var chauffeur = $('#chauffeur_rep').val();
        var camion = $('#camion_rep').val();
        var manquant = $('#manquant_rep').val();
        var sac = $('#sac_rep').val();
        var poids_sac = $('#poids_sac_rep').val();
        var id_produit = $('#id_produit_rep').val();
        var id_dis_bl = $('#id_dis_bl_rep').val();
        var id_declaration = $('#id_declaration_rep').val();
        var id_destination = $('#id_destination_rep').val();
        var id_client = $('#id_client_rep').val();
        var id_navire = $('#id_navire_rep').val();
        var id = $('#id_rep').val();
        var getid = $('#get_id').val();

        
        $.ajax({
    url:'insertion_reception.php',
    method:'post',
    data:{date:date,bl:bl,chauffeur:chauffeur,camion:camion,sac:sac,manquant:manquant,poids_sac:poids_sac,id_produit:id_produit,id_dis_bl:id_dis_bl,id_declaration:id_declaration,id_destination:id_destination,id_client:id_client,id_navire:id_navire,id:id,getid:getid,heure:heure},
    success: function(response){
      $('#pole').html(response);
      /*$('#'+id).children('td[data-target=cales]').text(cale);
    $('#'+id).children('td[data-target=nom_chargeur]').text(ch);
    $('#'+id).children('td[data-target=conditionnement]').text(cond+' KGS');
    //$('#modif_dec').modal('toggle');*/
    $('#form_reception').modal('toggle');
    }
  });
    });
});

</script>


<script type="text/javascript">


  $(document).ready(function(){
    $(document).on('click','a[data-role=insert_receptionSain]',function(){
        var id = $(this).data('id');
        var date = $('#'+id+'date').text();
        var getid = $('#'+id+'getid').text();
        var bl = $('#'+id+'bl').text();
        var camion = $('#'+id+'camion').text();
        var chauffeur = $('#'+id+'chauffeur').text();
        var sac = $('#'+id+'sac').text();
        var manquant = $('#'+id+'manquant').text();
        var id_dis_bl = $('#'+id+'id_dis_bl').text();
        var poids_sac = $('#'+id+'poids_sac').text();
        var id_produit = $('#'+id+'id_produit').text();
        var id_declaration = $('#'+id+'id_declaration').text();
        var id_destination = $('#'+id+'id_destination').text();
        var id_client = $('#'+id+'id_client').text();
        var id_navire = $('#'+id+'id_navire').text();
   

       $.ajax({
    url:'insertion_reception2.php',
    method:'post',
    data:{date:date,bl:bl,chauffeur:chauffeur,camion:camion,sac:sac,manquant:manquant,poids_sac:poids_sac,id_produit:id_produit,id_dis_bl:id_dis_bl,id_declaration:id_declaration,id_destination:id_destination,id_client:id_client,id_navire:id_navire,id:id,getid:getid},
    success: function(response){
      $('#pole').html(response);
      /*$('#'+id).children('td[data-target=cales]').text(cale);
    $('#'+id).children('td[data-target=nom_chargeur]').text(ch);
    $('#'+id).children('td[data-target=conditionnement]').text(cond+' KGS');
    //$('#modif_dec').modal('toggle');*/
    
    }  

        
       
    });
    
   

        
       
  });
    });


</script>


<script type="text/javascript">


  $(document).ready(function(){
    $(document).on('click','a[data-role=insert_receptionSain3]',function(){
        var id = $(this).data('id');
        var date = $('#'+id+'date').text();
        var getid = $('#'+id+'getid').text();
        var bl = $('#'+id+'bl').text();
        var camion = $('#'+id+'camion').text();
        var chauffeur = $('#'+id+'chauffeur').text();
        var sac = $('#'+id+'sac').text();
        var manquant = $('#'+id+'manquant').text();
        var id_dis_bl = $('#'+id+'id_dis_bl').text();
        var poids_sac = $('#'+id+'poids_sac').text();
        var id_produit = $('#'+id+'id_produit').text();
        var id_declaration = $('#'+id+'id_declaration').text();
        var id_destination = $('#'+id+'id_destination').text();
        var id_client = $('#'+id+'id_client').text();
        var id_navire = $('#'+id+'id_navire').text();
   

       $.ajax({
    url:'insertion_reception3.php',
    method:'post',
    data:{date:date,bl:bl,chauffeur:chauffeur,camion:camion,sac:sac,manquant:manquant,poids_sac:poids_sac,id_produit:id_produit,id_dis_bl:id_dis_bl,id_declaration:id_declaration,id_destination:id_destination,id_client:id_client,id_navire:id_navire,id:id,getid:getid},
    success: function(response){
      $('#pole').html(response);
      /*$('#'+id).children('td[data-target=cales]').text(cale);
    $('#'+id).children('td[data-target=nom_chargeur]').text(ch);
    $('#'+id).children('td[data-target=conditionnement]').text(cond+' KGS');
    //$('#modif_dec').modal('toggle');*/
    
    }  

        
       
    });
    
   

        
       
  });
    });


</script>









<script type="text/javascript">


  $(document).ready(function(){
    $(document).on('click','a[data-role=situation_reception]',function(){
        var id_dis = $(this).data('id');
       
        //var date = $('#'+id+'date').text();
   
        
        var date = $('#date_sit_rep').val();
         var flasque = $('#flasque_sit').val();
         var mouille = $('#mouille_sit').val();
         $('#id_dis_rec').val(id_dis);
         //var id_dis = $('#id_dis_rec').val();


         
        
$('#form_situation_reception').modal('toggle');

       });
    
    $('#save_situation2').click(function(){ 
    var date = $('#date_sit_rep').val();
    var flasque = $('#flasque_sit').val(); 
    var mouille = $('#mouille_sit').val();
    var id_dis = $('#id_dis_rec').val();
        $.ajax({
    url:'insertion_situation_reception_24h.php',
    method:'post',
    data:{date:date,flasque:flasque,mouille:mouille,id_dis:id_dis},
    success: function(response){
       
      $('#avaries_receptions').html(response);
      /*$('#'+id).children('td[data-target=cales]').text(cale);
    $('#'+id).children('td[data-target=nom_chargeur]').text(ch);
    $('#'+id).children('td[data-target=conditionnement]').text(cond+' KGS');*/
    $('#form_situation_reception').modal('toggle');
    $('#info_situation').modal('toggle');
    }
  });
    });
});

</script>







<script type="text/javascript">


  $(document).ready(function(){
    $(document).on('click','a[data-role=insert_reception_avaries1]',function(){
        var id = $(this).data('id');
        var date = $('#'+id+'date_ra').text();
        var bl = $('#'+id+'bl_ra').text();
        var camion = $('#'+id+'camion_ra').text();
        var chauffeur = $('#'+id+'chauffeur_ra').text();
        var sacf = $('#'+id+'sac_flasque_ra').text();
        var sacm = $('#'+id+'sac_mouille_ra').text();
        var poidsf = $('#'+id+'poids_flasque_ra').text();
         var poidsm = $('#'+id+'poids_mouille_ra').text();
        var manquant = $('#'+id+'manquant_ra').text();
        var id_dis_bl = $('#'+id+'id_dis_bl_ra').text();
        var poids_sac = $('#'+id+'poids_sac_ra').text();
        var id_produit = $('#'+id+'id_produit_ra').text();
        var id_declaration = $('#'+id+'id_declaration_ra').text();
        var id_destination = $('#'+id+'id_destination_ra').text();
        var id_client = $('#'+id+'id_client_ra').text();
        var id_navire = $('#'+id+'id_navire_ra').text();
   
        $('#date_rep_ra').val(date);
        $('#bl_rep_ra').val(bl);
        $('#sacf_rep_ra').val(sacf);
        $('#sacm_rep_ra').val(sacm);
        $('#poidsf_rep_ra').val(poidsf);
        $('#poidsm_rep_ra').val(poidsm);
        $('#camion_rep_ra').val(camion);
        $('#chauffeur_rep_ra').val(chauffeur);
        $('#bl_rep_ra').val(bl);
        $('#poids_sac_rep_ra').val(poids_sac);
        $('#id_produit_rep_ra').val(id_produit);
        $('#id_dis_bl_rep_ra').val(id_dis_bl);
        $('#id_declaration_rep_ra').val(id_declaration);
        $('#id_destination_rep_ra').val(id_destination);
        $('#id_client_rep_ra').val(id_client);
        $('#id_navire_rep_ra').val(id_navire);
        $('#id_rep_ra').val(id);
        

        
        $('#form_reception_ra').modal('toggle');
    });
    
    $('#save_reception_ra').click(function(){
         
        var date = $('#date_rep_ra').val();
        var bl = $('#bl_rep_ra').val();
        var chauffeur = $('#chauffeur_rep_ra').val();
        var camion = $('#camion_rep_ra').val();
        var manquant = $('#manquant_rep_ra').val();
        var sacf = $('#sacf_rep_ra').val();
        var sacm = $('#sacm_rep_ra').val();
        var poidsf = $('#poidsf_rep_ra').val();
        var poidsm = $('#poidsm_rep_ra').val();
        var poids_sac = $('#poids_sac_rep_ra').val();
        var id_produit = $('#id_produit_rep_ra').val();
        var id_dis_bl = $('#id_dis_bl_rep_ra').val();
        var id_declaration = $('#id_declaration_rep_ra').val();
        var id_destination = $('#id_destination_rep_ra').val();
        var id_client = $('#id_client_rep_ra').val();
        var id_navire = $('#id_navire_rep_ra').val();
        var id = $('#id_rep_ra').val();

        
        $.ajax({
    url:'insertion_reception_ra.php',
    method:'post',
    data:{date:date,bl:bl,chauffeur:chauffeur,camion:camion,sacf:sacf,sacm:sacm,poidsf:poidsf,poidsm:poidsm,manquant:manquant,poids_sac:poids_sac,id_produit:id_produit,id_dis_bl:id_dis_bl,id_declaration:id_declaration,id_destination:id_destination,id_client:id_client,id_navire:id_navire,id:id},
    success: function(response){
      $('#main').html(response);
      /*$('#'+id).children('td[data-target=cales]').text(cale);
    $('#'+id).children('td[data-target=nom_chargeur]').text(ch);
    $('#'+id).children('td[data-target=conditionnement]').text(cond+' KGS');
    //$('#modif_dec').modal('toggle');*/
    $('#form_reception_ra').modal('toggle');
    }
  });
    });
});

</script>






<script type="text/javascript">


  $(document).ready(function(){
    $(document).on('click','a[data-role=fichier_reception]',function(){
        
        

        
        $('#form_fichier_reception').modal('toggle');
    });
    
    $('#save_reception_ra').click(function(){
         
        var date = $('#date_rep_ra').val();
        var bl = $('#bl_rep_ra').val();
        var chauffeur = $('#chauffeur_rep_ra').val();
        var camion = $('#camion_rep_ra').val();
        var manquant = $('#manquant_rep_ra').val();
        var sacf = $('#sacf_rep_ra').val();
        var sacm = $('#sacm_rep_ra').val();
        var poidsf = $('#poidsf_rep_ra').val();
        var poidsm = $('#poidsm_rep_ra').val();
        var poids_sac = $('#poids_sac_rep_ra').val();
        var id_produit = $('#id_produit_rep_ra').val();
        var id_dis_bl = $('#id_dis_bl_rep_ra').val();
        var id_declaration = $('#id_declaration_rep_ra').val();
        var id_destination = $('#id_destination_rep_ra').val();
        var id_client = $('#id_client_rep_ra').val();
        var id_navire = $('#id_navire_rep_ra').val();
        var id = $('#id_rep_ra').val();

        
        $.ajax({
    url:'insertion_reception_ra.php',
    method:'post',
    data:{date:date,bl:bl,chauffeur:chauffeur,camion:camion,sacf:sacf,sacm:sacm,poidsf:poidsf,poidsm:poidsm,manquant:manquant,poids_sac:poids_sac,id_produit:id_produit,id_dis_bl:id_dis_bl,id_declaration:id_declaration,id_destination:id_destination,id_client:id_client,id_navire:id_navire,id:id},
    success: function(response){
      $('#main').html(response);
      /*$('#'+id).children('td[data-target=cales]').text(cale);
    $('#'+id).children('td[data-target=nom_chargeur]').text(ch);
    $('#'+id).children('td[data-target=conditionnement]').text(cond+' KGS');
    //$('#modif_dec').modal('toggle');*/
    $('#form_reception_ra').modal('toggle');
    }
  });
    });
});

</script>






<script type="text/javascript">


  $(document).ready(function(){
    $(document).on('click','a[data-role=update_receptionaff]',function(){
        var id = $(this).data('id');
        var date = $('#'+id+'date').text();
        var heure = $('#'+id+'heure').text();
        var bl = $('#'+id+'bl').text();
        //var camion = $('#'+id+'camion_ra').text();
        //var chauffeur = $('#'+id+'chauffeur_ra').text();
        var sac = $('#'+id+'sac').text();
        //var sacm = $('#'+id+'sac_mouille_ra').text();
        //var poidsf = $('#'+id+'poids_flasque_ra').text();
        // var poidsm = $('#'+id+'poids_mouille_ra').text();
        var manquant = $('#'+id+'manquant').text();
        var id_dis_bl = $('#'+id+'id_dis_up').text();
        var poids_sac = $('#'+id+'poids_sac').text();
        //var id_produit = $('#'+id+'id_produit_ra').text();
        //var id_declaration = $('#'+id+'id_declaration_ra').text();
        //var id_destination = $('#'+id+'id_destination_ra').text();
        //var id_client = $('#'+id+'id_client_ra').text();
        //var id_navire = $('#'+id+'id_navire_ra').text();
   
        $('#date_up_aff').val(date);
        $('#bl_up_aff').val(bl);
        $('#sac_up_aff').val(sac);
       // $('#sacm_rep_ra').val(sacm);
        //$('#poidsf_rep_ra').val(poidsf);
        //$('#poidsm_rep_ra').val(poidsm);
        //$('#camion_rep_ra').val(camion);
        //$('#chauffeur_rep_ra').val(chauffeur);
        //$('#bl_rep_ra').val(bl);
        $('#poids_sac_up_aff').val(poids_sac);
        //$('#id_produit_rep_ra').val(id_produit);
        $('#id_dis_bl_up_aff').val(id_dis_bl);
        $('#manquant_up_aff').val(manquant);
        $('#time_up_aff').val(heure);
       // $('#id_destination_rep_ra').val(id_destination);
        //$('#id_client_rep_ra').val(id_client);
        //$('#id_navire_rep_ra').val(id_navire);
        $('#id_up_aff').val(id); 
        
        
        
        $('#form_update_aff').modal('toggle');
    });
    
    $('#save_up_aff').click(function(){
         
        var date = $('#date_up_aff').val();
        var heure = $('#time_up_aff').val();
        date=date.replace(' ','');
        var bl = $('#bl_up_aff').val();
       

        var manquant = $('#manquant_up_aff').val();
        var sac = $('#sac_up_aff').val();
   
        var poids_sac = $('#poids_sac_up_aff').val();
        
        var id_dis_bl = $('#id_dis_bl_up_aff').val();
        
        var id = $('#id_up_aff').val();

        
        $.ajax({
    url:'modifier_table_reception.php',
    method:'post',
    data:{date:date,bl:bl,sac:sac,manquant:manquant,poids_sac:poids_sac,id_dis_bl:id_dis_bl,id:id,heure:heure},
    success: function(response){
      $('#tableSain').html(response);
      /*$('#'+id).children('td[data-target=cales]').text(cale);
    $('#'+id).children('td[data-target=nom_chargeur]').text(ch);
    $('#'+id).children('td[data-target=conditionnement]').text(cond+' KGS');
    //$('#modif_dec').modal('toggle');*/
    $('#form_update_aff').modal('toggle');
    }
  });
    });
});

</script>






<script type="text/javascript">


  $(document).ready(function(){
    $(document).on('click','a[data-role=insert_reconditionnement]',function(){
        var id_dis = $(this).data('id');
        var navire = $(this).data('navire');
        var id_produit = $(this).data('produit');
        var poids_sac = $(this).data('poids_sac');
        var id_destination = $(this).data('destination');
        var id_declaration = $(this).data('declaration');

        $('#id_dis_recond').val(id_dis);
        $('#navire_recond').val(navire);
        $('#id_produit_recond').val(id_produit);
        $('#poids_sac_recond').val(poids_sac);
        $('#id_destination_recond').val(id_destination);
        $('#id_declaration_recond').val(id_declaration);
        // $('#id_up_aff').val(id); 
        
        
        
        $('#form_reconditionnement').modal('toggle');
    });
    
    $('#save_recond').click(function(){
         
        var date = $('#date_recond').val();
        var sac_eventres = $('#sac_eventres').val();
        var sacf = $('#sac_recond').val();
       // date=date.replace(' ','');
        var sac_bal = $('#sac_balayure').val();
        var poids_bal = $('#poids_balayure').val();
       
        var id_dis= $('#id_dis_recond').val();
       var navire= $('#navire_recond').val();
        var id_produit= $('#id_produit_recond').val();
        var poids_sac= $('#poids_sac_recond').val();
        var id_destination= $('#id_destination_recond').val();
        var id_declaration= $('#id_declaration_recond').val();

        

        
        $.ajax({
    url:'insert_recond.php',
    method:'post',
    data:{date:date,sac_bal:sac_bal,poids_bal:poids_bal,poids_sac:poids_sac,id_dis:id_dis,navire:navire,id_produit:id_produit,id_destination:id_destination,sacf:sacf,sac_eventres:sac_eventres,id_declaration:id_declaration},
    success: function(response){
      $('#main').html(response);
      /*$('#'+id).children('td[data-target=cales]').text(cale);
    $('#'+id).children('td[data-target=nom_chargeur]').text(ch);
    $('#'+id).children('td[data-target=conditionnement]').text(cond+' KGS');
    //$('#modif_dec').modal('toggle');*/
    $('#form_reconditionnement').modal('toggle');
    }
  });
    });
});

</script>










<script type="text/javascript">


  $(document).ready(function(){
    $(document).on('click','a[data-role=update_avr_reception]',function(){
        var id = $(this).data('id');
        var date = $('#'+id+'date_avr').text();
        var sacf = $('#'+id+'sac_flasque_avr').text();
         var sacm = $('#'+id+'sac_mouille_avr').text();
          var id_dis = $('#'+id+'id_dis_avr').text();
        $('#date_avr2').val(date);
       
        $('#sacf_avr2').val(sacf);
           $('#sacm_avr2').val(sacm);
           $('#id_dis_avr2').val(id_dis);
           $('#id_avr2').val(id);

        
        
        $('#form_avaries_reception').modal('toggle');
    });
    
    $('#save_avaries_reception').click(function(){
         
        var date = $('#date_avr2').val();
        date=date.replace(' ','');
        var sacf = $('#sacf_avr2').val();
        var sacm = $('#sacm_avr2').val();
        
        var id_dis = $('#id_dis_avr2').val();
        
        var id = $('#id_avr2').val();

        
        $.ajax({
    url:'update_avaries_reception.php',
    method:'post',
    data:{date:date,sacf:sacf,sacm:sacm,id_dis:id_dis,id:id},
    success: function(response){
      $('#avaries_receptions').html(response);
      /*$('#'+id).children('td[data-target=cales]').text(cale);
    $('#'+id).children('td[data-target=nom_chargeur]').text(ch);
    $('#'+id).children('td[data-target=conditionnement]').text(cond+' KGS');
    //$('#modif_dec').modal('toggle');*/
    $('#form_avaries_reception').modal('toggle');
    }
  });
    });
});

</script>




<script type="text/javascript">


  $(document).ready(function(){
    $(document).on('click','a[data-role=update_recep_deb]',function(){
        var id = $(this).data('id');
        var date = $('#'+id+'date_deb').text();
        var heure = $('#'+id+'heures').text();
        var bl = $('#'+id+'bl_deb').text();
      var sacf = $('#'+id+'flasque_deb').text();
       var poidsf = $('#'+id+'poids_flasque_deb').text();
         var sacm = $('#'+id+'mouille_deb').text();
            var id_dis = $('#'+id+'id_dis_deb').text();
            var poids_sac = $('#'+id+'poids_sac_deb').text();
       
       
        $('#sacf_deb2').val(sacf);
        $('#time_deb2').val(heure);
           $('#sacm_deb2').val(sacm);
           $('#id_dis_deb2').val(id_dis);
           $('#id_deb2').val(id);
            $('#date_deb2').val(date);
             $('#bl_deb2').val(bl);
              $('#poidsf_deb2').val(poidsf);
              $('#poids_sac_deb2').val(poids_sac);

        
        
        $('#form_avaries_debarquement').modal('toggle');
    });
    
    $('#save_avaries_debarquement').click(function(){
         
        var date = $('#date_deb2').val();
        date=date.replace(' ','');
         var heure = $('#time_deb2').val();
        var sacf = $('#sacf_deb2').val();
        var poidsf = $('#poidsf_deb2').val();
         var poids_sac = $('#poids_sac_deb2').val();
        var sacm = $('#sacm_deb2').val();
        
        var id_dis = $('#id_dis_deb2').val();
        var bl = $('#bl_deb2').val();
        
        
        var id = $('#id_deb2').val();

        
        $.ajax({
    url:'update_avaries_debarquement.php',
    method:'post',
    data:{date:date,sacf:sacf,sacm:sacm,id_dis:id_dis,id:id,bl:bl,poidsf:poidsf,poids_sac:poids_sac,heure:heure},
    success: function(response){
      $('#tableAvariesDeb').html(response);
      /*$('#'+id).children('td[data-target=cales]').text(cale);
    $('#'+id).children('td[data-target=nom_chargeur]').text(ch);
    $('#'+id).children('td[data-target=conditionnement]').text(cond+' KGS');
    //$('#modif_dec').modal('toggle');*/
    $('#form_avaries_debarquement').modal('toggle');
    }
  });
    });
});

</script>








<script type="text/javascript">


  $(document).ready(function(){
    $(document).on('click','a[data-role=insert_rep_av]',function(){
        var id = $(this).data('id');
        var date = $('#'+id+'date_ra').text();
        var getid = $('#'+id+'getid_avaries').text();
        var bl = $('#'+id+'bl_ra').text();
        var camion = $('#'+id+'camion_ra').text();
        var chauffeur = $('#'+id+'chauffeur_ra').text();
        var sacf = $('#'+id+'sac_flasque_ra').text();
        var sacm = $('#'+id+'sac_mouille_ra').text();
        var poidsf = $('#'+id+'poids_flasque_ra').text();
        var poidsm = $('#'+id+'poids_mouille_ra').text();
        var manquant = $('#'+id+'manquant_ra').text();
        var id_dis_bl = $('#'+id+'id_dis_bl_ra').text();
        var poids_sac = $('#'+id+'poids_sac_ra').text();
        var id_produit = $('#'+id+'id_produit_ra').text();
        var id_declaration = $('#'+id+'id_declaration_ra').text();
        var id_destination = $('#'+id+'id_destination_ra').text();
        var id_client = $('#'+id+'id_client_ra').text();
        var id_navire = $('#'+id+'id_navire_ra').text();
   
        
         
       
        
        $.ajax({
    url:'insertion_reception_avaries.php',
    method:'post',
    data:{date:date,bl:bl,chauffeur:chauffeur,camion:camion,sacf:sacf,sacm:sacm,poidsf:poidsf,poidsm:poidsm,manquant:manquant,poids_sac:poids_sac,id_produit:id_produit,id_dis_bl:id_dis_bl,id_declaration:id_declaration,id_destination:id_destination,id_client:id_client,id_navire:id_navire,id:id,getid:getid},
    success: function(response){
      $('#pole').html(response);
      /*$('#'+id).children('td[data-target=cales]').text(cale);
    $('#'+id).children('td[data-target=nom_chargeur]').text(ch);
    $('#'+id).children('td[data-target=conditionnement]').text(cond+' KGS');
    //$('#modif_dec').modal('toggle');*/
    
    }
  });
    });
    });


</script>



<script type="text/javascript">


  $(document).ready(function(){
    $(document).on('click','a[data-role=update_reception_avaries]',function(){
        var id = $(this).data('id');
        var date = $('#'+id+'date_ra').text();
        var getid = $('#'+id+'getid_avaries').text();
        var bl = $('#'+id+'bl_ra').text();
        var camion = $('#'+id+'camion_ra').text();
        var chauffeur = $('#'+id+'chauffeur_ra').text();
        var sacf = $('#'+id+'sac_flasque_ra').text();
        var sacm = $('#'+id+'sac_mouille_ra').text();
        var poidsf = $('#'+id+'poids_flasque_ra').text();
        var poidsm = $('#'+id+'poids_mouille_ra').text();
       // var manquant = $('#'+id+'manquant_ra').text();
        var id_dis_bl = $('#'+id+'id_dis_bl_ra').text();
        var poids_sac = $('#'+id+'poids_sac_ra').text();
        var id_produit = $('#'+id+'id_produit_ra').text();
        var id_declaration = $('#'+id+'id_declaration_ra').text();
        var id_destination = $('#'+id+'id_destination_ra').text();
        var id_client = $('#'+id+'id_client_ra').text();
        var id_navire = $('#'+id+'id_navire_ra').text();
        $('#date_avv').val(date);
         $('#sacf_avv').val(sacf);
          $('#sacm_avv').val(sacm);
           $('#poidsf_avv').val(poidsf);
            $('#bl_avv').val(bl);
             $('#camion_avv').val(camion);
              $('#chauffeur_avv').val(chauffeur);
               $('#poids_sac_avv').val(poids_sac);
                $('#id_produit_avv').val(id_produit);
                 $('#id_declaration_avv').val(id_declaration);
                  $('#id_destination_avv').val(id_destination);
                   $('#id_client_avv').val(id_client);
                    $('#id_navire_avv').val(id_navire);
                     $('#get_id_avv').val(getid);
                     $('#id_dis_bl_avv').val(id_dis_bl);
                     // $('#manquant_avv').val(manquant);
                       $('#id_avv').val(id);


   
        $('#form_reception_av').modal('toggle');
    });
    
    $('#save_re').click(function(){
     
      var  date=$('#date_avv').val();
      date=date.replace(' ','');
      var heure=$('#time_avv').val();
      var sacf= $('#sacf_avv').val();
         var sacm= $('#sacm_avv').val();
          var poidsf=$('#poidsf_avv').val();
           var bl=$('#bl_avv').val();
           var camion= $('#camion_avv').val();
             var chauffeur= $('#chauffeur_avv').val();
             var poids_sac= $('#poids_sac_avv').val();
              var id_produit= $('#id_produit_avv').val();
               var id_declaration= $('#id_declaration_avv').val();
               var id_destination=  $('#id_destination_avv').val();
                var id_client=  $('#id_client_avv').val();
                 var  id_navire= $('#id_navire_avv').val();
                 var getid=  $('#get_id_avv').val();
                 var manquant=  $('#manquant_avv').val();
                 var id_dis_bl=  $('#id_dis_bl_avv').val();
                  var id= $('#id_avv').val();   
       
        
        $.ajax({
    url:'insert_rep_avv.php',
    method:'post',
    data:{date:date,bl:bl,chauffeur:chauffeur,camion:camion,sacf:sacf,sacm:sacm,poidsf:poidsf,manquant:manquant,poids_sac:poids_sac,id_produit:id_produit,id_dis_bl:id_dis_bl,id_declaration:id_declaration,id_destination:id_destination,id_client:id_client,id_navire:id_navire,id:id,getid:getid,heure:heure},
    success: function(response){
      $('#pole').html(response);
   
    $('#form_reception_av').modal('toggle');
    
    }
  });
    });
    });


</script>







<script type="text/javascript">


  $(document).ready(function(){
    $(document).on('click','a[data-role=fermer]',function(){

      $('#erreur').css('display', 'none');
    });
    });
    
    

</script>
















<script type="text/javascript">
  $(document).ready(function(){


    $('#save_situationA').click(function(){
         
       /* var date = $('#date_sit').val();

        var flasque = $('#flasque_sit').val();
        var mouille = $('#mouille_sit').val();
        
        var id_dis_bl = $('#id_dis_bl_sit').val(); */
         var date = $('#date_sit').val();
         var flasque = $('#flasque_sit').val();
         var mouille = $('#mouille_sit').val();
         var id_dis = $('#id_dis_sit').val();


        
        $.ajax({
    url:'',
    method:'post',
    data:{date:date,flasque:flasque,mouille:mouille,id_dis:id_dis},
    success: function(response){
      
      /*$('#'+id).children('td[data-target=cales]').text(cale);
    $('#'+id).children('td[data-target=nom_chargeur]').text(ch);
    $('#'+id).children('td[data-target=conditionnement]').text(cond+' KGS');*/
    $('#situation_24hA').modal('toggle');
    
    }
  });
    });
});


</script>


 <script type='text/javascript'>
 
            function getXhr(){
                                var xhr = null; 
                if(window.XMLHttpRequest) // Firefox et autres
                   xhr = new XMLHttpRequest(); 
                else if(window.ActiveXObject){ // Internet Explorer 
                   try {
                            xhr = new ActiveXObject("Msxml2.XMLHTTP");
                        } catch (e) {
                            xhr = new ActiveXObject("Microsoft.XMLHTTP");
                        }
                }
                else { // XMLHttpRequest non supporté par le navigateur 
                   alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest..."); 
                   xhr = false; 
                } 
                                return xhr;
            }
 
            /**
            * Méthode qui sera appelée sur le clic du bouton
            */
            function goNavireSit(){
                var xhr = getXhr();
                // On définit ce qu'on va faire quand on aura la réponse
                xhr.onreadystatechange = function(){
                    // On ne fait quelque chose que si on a tout reçu et que le serveur est OK
                    if(xhr.readyState == 4 && xhr.status == 200){
                        ladate = xhr.responseText;
                        // On se sert de innerHTML pour rajouter les options à la liste
                        document.getElementById('mesprod').innerHTML = ladate;

                    }
                }
 
                // Ici on va voir comment faire du post
                xhr.open("POST","selectNavireProd.php",true);
                // ne pas oublier ça pour le post
                xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
                // ne pas oublier de poster les arguments
                // ici, l'id de l'auteur
                sel = document.getElementById('navires');
                idnavires = sel.options[sel.selectedIndex].value;
                xhr.send("idNavires="+idnavires);
            }
        </script>


<script type="text/javascript">
  function deletePre_Reception(id){
   
       if(confirm('Voulez vous vraiment supprimer ce donnée?')){
        var getid = $('#'+id+'getid').text();
        var id_dis = $('#'+id+'id_dis_bl').text();

         //var navire=navires.text();
         
         $.ajax({

              type:'post',
              url:'deleteReception.php',
              data:{delete_id:id,id_dis:id_dis,getid:getid},
              success:function(response){
              
                   $('#pole').html(response);

              }

         });

       }


     }

 


 </script>


 <script type="text/javascript">
  function delete_avaries_rep(id){
   
       if(confirm('Voulez vous vraiment supprimer ce donnée?')){
        //var id = $('#'+id+'getid').text();
        var id_dis = $('#'+id+'id_dis_avr').text();

         //var navire=navires.text();
         
         $.ajax({

              type:'post',
              url:'delete_avaries_reception.php',
              data:{delete_id:id,id_dis:id_dis},
              success:function(response){
              
                   $('#avaries_receptions').html(response);

              }

         });

       }


     }

 


 </script>




 <script type="text/javascript">
  function delete_avaries_deb(id){
   
       if(confirm('Voulez vous vraiment supprimer ce donnée?')){
        //var id = $('#'+id+'getid').text();
        var id_dis = $('#'+id+'id_dis_deb').text();

         //var navire=navires.text();
         
         $.ajax({

              type:'post',
              url:'delete_avaries_debs.php',
              data:{delete_id:id,id_dis:id_dis},
              success:function(response){
              
                   $('#tableAvariesDeb').html(response);

              }

         });

       }


     }

 


 </script>






<script type="text/javascript">
  function deletereceptionaff(id){
   
       if(confirm('Voulez vous vraiment supprimer ce donnée?')){
        
        var id_dis = $('#'+id+'id_dis_up').text();

         //var navire=navires.text();
         
         $.ajax({

              type:'post',
              url:'deleteRepaff.php',
              data:{delete_id:id,id_dis:id_dis},
              success:function(response){
              
                   $('#tableSain').html(response);

              }

         });

       }


     }

 


 </script>









 <script type="text/javascript">
  function deletePre_ReceptionAV(id){
   
       if(confirm('Voulez vous vraiment supprimer ce donnée?')){
        var getid = $('#'+id+'getid_avaries').text();
        var id_dis = $('#'+id+'id_dis_bl_ra').text();

         //var navire=navires.text();
         
         $.ajax({

              type:'post',
              url:'deleteReceptionAvaries.php',
              data:{delete_id:id,id_dis:id_dis,getid:getid},
              success:function(response){
              
                   $('#pole').html(response);

              }

         });

       }


     }

 


 </script>




<script>
  function visibleSain() {
    var sain = document.getElementById("tableSain");
    var deb = document.getElementById("tableAvariesDeb");
    var rep = document.getElementById("avaries_receptions");

    if (sain.style.display === "none") {
      sain.style.display = "table";
      deb.style.display = "none";
      rep.style.display = "none";
     
     

       sain.scrollIntoView({ behavior: 'smooth' });
     
    } else {
      sain.style.display = "none";
     
    }
    
    
  }
</script>


<script>
  function visibleAvariesDeb() {
    var sain = document.getElementById("tableSain");
    var deb = document.getElementById("tableAvariesDeb");
    var rep = document.getElementById("avaries_receptions");

    if (deb.style.display === "none") {
      deb.style.display = "table";
      sain.style.display = "none";
      rep.style.display = "none";
     
     

       deb.scrollIntoView({ behavior: 'smooth' });
     
    } else {
      deb.style.display = "none";
     
    }
    
    
  }
</script>

<script>
  function visibleAvariesRep() {
    var sain = document.getElementById("tableSain");
    var deb = document.getElementById("tableAvariesDeb");
    var rep = document.getElementById("avaries_receptions");

    if (rep.style.display === "none") {
      rep.style.display = "table";
      deb.style.display = "none";
      sain.style.display = "none";
     
     

       rep.scrollIntoView({ behavior: 'smooth' });
     
    } else {
      rep.style.display = "none";
     
    }
    
    
  }
</script>



<script>
  // Obtenir l'heure actuelle
  var maintenant = new Date();
  var heures = maintenant.getHours();
  var minutes = maintenant.getMinutes();

  // Formater l'heure et les minutes pour qu'ils aient toujours deux chiffres (par exemple, 09:05)
  if (heures < 10) heures = "0" + heures;
  if (minutes < 10) minutes = "0" + minutes;

  // Combinez l'heure et les minutes dans le format HH:MM
  var heureActuelle = heures + ":" + minutes;

  // Définir la valeur par défaut du champ d'entrée sur l'heure actuelle
  document.getElementById("time_rep").value = heureActuelle;
</script>






<script type="text/javascript">
  
    $(document).ready(function () {
        $(document).on('click', 'a[data-role=imprimer_pv_reception]', function () {
            var contentToPrint = $('#pv').html();
            var printWindow = window.open('', '_blank');
             var cssLink = '<link rel="stylesheet" type="text/css" href="pv_reception.css">';
             var cssLink2 = '<link rel="stylesheet" type="text/css" href="../assets/modules/bootstrap-5.1.3/css/bootstrap.css">';
        printWindow.document.write('<html><head><title>Impression</title>' + cssLink + cssLink2 + '</head><body>' + contentToPrint + '</body></html>');
           // printWindow.document.write('<html><head><title>Impression</title></head><body>' + contentToPrint + '</body></html>');
            printWindow.document.close();
            printWindow.print(); 
        });
    }); 
</script>




 </body>
</html>

