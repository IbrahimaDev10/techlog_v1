<?php
require('../database.php');
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
if(empty($_SESSION['id'])){
  header('location:../index.php');
}
$a=$_SESSION['id'];


require("controller/acces_reception.php");
//header("Cache-Control: no-cache, must-revalidate");
//header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");


?>	



<!DOCTYPE html>
<html lang="fr">
  <head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
  


	<title>RECEPTION</title>

	<!-- Bootstrap CSS-->
    
  <link rel="stylesheet" href="../assets/modules/bootstrap-5.1.3/css/bootstrap.css">
  <!-- Style CSS -->
 <link rel="stylesheet" href="../transfert/css/style.css">  
  <link rel="stylesheet" href="assets/css/stylecell.css"> 
   <link rel="stylesheet" href="../assets/css/repAccueil.css"> 
  <!-- FontAwesome CSS-->
  <link rel="stylesheet" href="../assets/modules/fontawesome6.1.1/css/all.css">
  <!-- Boxicons CSS-->
  <link rel="stylesheet" href="assets/modules/boxicons/css/boxicons.min.css">
  <!-- Apexcharts  CSS -->
  <link rel="stylesheet" href="../assets/modules/apexcharts/apexcharts.css">
    <link rel="shortcut icon" type="image/png" href="../assets/images/mylogo.ico"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" rel="stylesheet">

</head>
<body >
  <div style="display: none;" >
  <input type="text" id="table_sain_visible" name="" value="0">
   <input type="text" id="table_avaries_reception_visible" name="" value="0">
    <input type="text" id="table_avaries_deb_visible" name="" value="0">
    <input type="text" id="table_pv_reception_visible" name="" value="0">
    </div>
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
       
        background: white;
        vertical-align: middle;
    }
    #close_erreur{
        font-size: 30px;
    }
    .fa-truck{


  font-size: 18px;
color: white;
vertical-align: middle;
display: flex; 
margin-right: 5px;


}
.lien_debut{
   display: flex;
 justify-content: center;
}


   

@media (max-width: 1200px){
.tr_data_attente_avaries{
 font-size:12px;
}
 .agrandir_table{
    display: none;
  }
  .btn_detail{
    display:block;
  }
}

@media (min-width: 1200px){

 .agrandir_table{
    display: none;
  }
    .btn_detail{
    display:none;
  }
}

</style>

<style type="text/css">
  @media (max-width: 1000px){
  .produit_hide, .bl_hide, .chauffeur_hide,.camion_hide{

    display:none; 
  }
  .agrandir_table{
    display: block;
  }
  }
</style>


<?php include('navbar.php'); ?>

<div class="container-fluid" style="background: white;">
  <div class="row">
    <center> 
    <div class="col-col-md-12 col-col-lg-12">
      <span class="lien_debut"> 
      <a id="liste"  style="display: flex; justify-content: center; color: blue; border:solid; border-color: blue; border-radius: 50px; margin-right: 30px;" data-role="liste_camion"><i style="color: blue;" class="fas fa-truck" ></i> Liste des camions en attentes</a>

       <a id="vue_reception" style="display: flex; justify-content: center; color: blue; border:solid; border-color: blue; border-radius: 50px;"  data-role="mes_receptions"><i style="color: blue;" class="fas fa-eye" ></i> </i>Mes receptions</a>
       </span>
    </div>
     </center>
  </div>
</div>

  
  <!--Topbar -->
  <div class="topbar transition">
	<div class="bars">
		<button type="button" class="btn transition" id="sidebar-toggle">
			<i class="fa fa-bars"></i>
		</button>
	</div>
		<div class="menu" >
			<ul>
				
			 
				  <li class="nav-item dropdown" >
					<a class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
					  <img src="../assets/images/avatar/avatar-1.png" alt="">
					</a>
					<ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="background: linear-gradient(-45deg, #004362, #0183d0) !important;">
						<a style="color: white;"  class="dropdown-item" href="#"><i class="fa fa-user size-icon-1"></i> <span>MON PROFIL</span></a>
						<a style="color: white;" class="dropdown-item" href="#"><i class="fa fa-cog size-icon-1"></i> <span>PARAMETRES</span></a>
						<hr class="dropdown-divider">
						<a style="color: white;" class="dropdown-item" href="../logout.php"><i class="fa fa-sign-out-alt  size-icon-1"></i> <span>SE DECONNECTER</span></a>
					</ul>
				  </li>
			</ul>
		</div>
	</div>


	<!--Sidebar-->
	<div class="sidebar transition overlay-scrollbars animate__animated  animate__slideInLeft" style="background: linear-gradient(-45deg, #004362, #0183d0) !important;">
        <div class="sidebar-content"> 
        	<div id="sidebar">
			
			<!-- Logo -->
			<div class="logo">
        <br>
					<h2 class="mb-4"><img style="width: 150px; height: 100px; border-radius: 50%;" src="../images/mylogo4.png"> </h2>
			</div>

            <ul class="side-menu">
                <li>
					<a href="../star_superviseur.php" class="active">
						<i class='bx bxs-dashboard icon' ></i> MENU PRINCIPAL
					</a>
                 <?php include('page.php'); ?>
				</li>

				<!-- Divider--> <!--
                <li class="divider" style="font-size: 18px;" data-text="STARTER"> RECEPTION</li>

                

                       <li> <a style="font-size:12px; display: none;"  data-bs-toggle="modal" data-bs-target="#situation_24h">
                        <i class='bx bx-columns icon'  ></i>SITUATION JOURNALIERE 
                       </a>
                    
                   </li>

                    <li> <a style="font-size:12px;" href="pv_reception.php?id=<?php echo $_GET['id']; ?>">
                        <i class='bx bx-columns icon'  ></i>PV DE RECEPTION
                       </a>
                    
                   </li>
                   

                    <li><a style="display: none;"  href="situation_de_reception.php?id=<?php echo $_GET['id']; ?>"> <i class='bx bx-columns icon' ></i> MES SITUATIONS</a></li>
                     <li><a   href="reconditionnement.php?id=<?php echo $_SESSION['id']; ?>"> <i class='bx bx-columns icon' ></i> RECONDITIONNEMENT</a></li>
                    </a>
                    !-->
                    
                       

 
 


				
               

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
       
       
         <label style="display: none;">poids sac</label>
        <input style="height: 25px;" type="text" class="form-control"  id="poids_sac_up_aff"  name="poids_sac" hidden="true" >
         
         
       
        <input style="height: 25px;" type="text" class="form-control"  id="id_dis_bl_up_aff"  name="id_dis_bl" hidden="true" >
                           
        <input style="height: 25px;" type="text" class="form-control"  id="id_up_aff"  name="id" hidden="true" >
        <input style="height: 25px;" type="text" class="form-control"  id="produit_up_aff"  name="id"  >
         <input style="height: 25px;" type="text" class="form-control"  id="destination_up_aff"  name="id"  >
          <input style="height: 25px;" type="text" class="form-control"  id="navire_up_aff"  name="id"  >
        
        

    
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
    <input hidden="true" style="height: 25px;" type="text" class="form-control"   id="bl_rep"  >
     <label hidden="true">CAMION</label>
     <input hidden="true" style="height: 25px;" type="text" class="form-control"  id="camion_rep"  name="camion"  >
     <label hidden="true">CHAUFFEUR</label>
      <input hidden="true" style="height: 25px;" type="text" class="form-control"  id="chauffeur_rep"  name="chauffeur"  >
      <label>SAC</label>
        <input style="height: 25px;" type="text" class="form-control"  id="sac_rep"  name="sac"  ><br>
        
         <label>MANQUANT</label>
        <input style="height: 25px;" type="text" class="form-control"  id="manquant_rep"  name="manquant" value="0" ><br>
       
       <div style="display: block;">  
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
    <span style="color: black; float: left;">BL:  <span  id='bls_avv' style="color: red;"></span> </span> <br> <br>

    <span style="color: black; float: left;">CAMION :  <span  id='camions_avv' style="color: red;"></span> </span> 
    <span style="color: black; float: right;">CHAUFFEUR :  <span  id='chauffeurs_avv' style="color: red;"></span> </span> <br>
    
    <label>DATE</label>  
   <input type="date" id="date_avv" class="form-control"   name="date" ><br>
       <label>HEURE</label>  
   <input type="time" id="time_avv" class="form-control"   name="date" ><br>
  
    <label hidden="true">BL</label>
    <input  style="height: 25px;" type="text" class="form-control"   id=bl_avv disabled='true' hidden="true">
     <label hidden="true">CAMION</label>
     <input hidden="true" style="height: 25px;" type="text" class="form-control"  id="camion_avv"  name="camion"  >
     <label hidden="true">CHAUFFEUR</label>
      <input hidden="true" style="height: 25px;" type="text" class="form-control"  id="chauffeur_avv"  name="chauffeur"  >
      <label>SACS </label>
        <input style="height: 25px;" type="text" class="form-control"  id="sacf_avv"  name="sac"  ><br>
        <div id='visible_poids'>
        <label>POIDS </label>
        <input style="height: 25px;" type="text" class="form-control"  id="poidsf_avv"  name="sac"  ><br>
        </div>
       
           <label>MANQUANT</label>
        <input style="height: 25px;" type="text" class="form-control"  id="manquant_avv"  name="sac" value="0" ><br>
        
        <label>DESTINATION</label><br>
   <?php $cherche_mangasins=$bdd->prepare('SELECT id, mangasin from mangasin where id_mangasinier=?');
         $cherche_mangasins->bindParam(1,$_SESSION['id']);
         $cherche_mangasins->execute(); ?> 
         <select id='destination_recep_deb0' style="width: 80%;">
          <?php while($mes_mgs=$cherche_mangasins->fetch()){ ?>
           <option value='<?php echo $mes_mgs['id'] ?>'><?php echo $mes_mgs['mangasin'] ?></option>
         <?php } ?>
         </select> <br>
       
       <div style="display: none;" >  
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

        <label>id</label>
        <input style="height: 25px;" type="text" class="form-control"  id="id_avv"  name="id"  >
         
        <input style="height: 25px;" type="text" class="form-control"  id="statut_avv"  name="id" >
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


<div class="modal fade" id="changer_destination" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style=" border: solid; border-color:rgb(0,141,202); ">
            <div class="modal-header" style="">
              <center>
                <h3 class="modal-title fs-10 text-white text-center" id="exampleModalLabel " style="text-align:center;   ">DESTINATION</h3></center>
                <center>
              <img class="logoo" src="../images/mylogo.ico" >
       </center>
        
      </div>
       <br> <br>
        <form  method="POST">

  
   

<center>

   <div class="mb-3">
  
   <label>Changer destination</label><br>
   <?php $change_destination=$bdd->query('SELECT id,mangasin from mangasin'); ?>
   <select id='select_changer_destination'>
    <?php while($ch_dest=$change_destination->fetch()){ ?>
      <option value="<?php echo $ch_dest['id']; ?>" ><?php echo $ch_dest['mangasin']; ?></option>
    <?php } ?>
     
   </select>
  
        </div>
       
         
        
        
       
       <div style="display: none" >  
        

        <label>id</label>
        <input style="height: 25px;" type="text" class="form-control"  id="ch_dest"  name="id"  >
         
     
        </div>
  
          




</center>



         
        

       <center>  
      <div class="modal-footer">
          
         <a  id="sa" data-role='valider_changer_destination' style="width: 50%;" class="btn btn-primary " name="valider_reception">valider</a> 
         
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
         
         <div style="display: none;">      
        <label>id_dis</label>
        <input style="height: 25px;" type="text" class="form-control"  id="id_dis_avr2"  name="id_dis_bl"  >
          
                 <label>id</label>
        <input style="height: 25px;" type="text" class="form-control"  id="id_avr2"  name="id"  >
         <input style="height: 25px;" type="text" class="form-control"  id="poids_sac_avr2"  name="id"  >
          <input style="height: 25px;" type="text" class="form-control"  id="id_produit_avr2"  name="id"  >
           <input style="height: 25px;" type="text" class="form-control"  id="id_destination_avr2"  name="id"  >
            <input style="height: 25px;" type="text" class="form-control"  id="id_navire_avr2"  name="id"  >
             <input style="height: 25px;" type="text" class="form-control"  id="id_declaration_avr2"  name="id"  >
       </div>  

    
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
   <input type="time" id="time_deb2" class="form-control"    ><br>
   <label>DESTINATION</label><br>
   <?php $cherche_mangasin=$bdd->prepare('SELECT id, mangasin from mangasin where id_mangasinier=?');
         $cherche_mangasin->bindParam(1,$_SESSION['id']);
         $cherche_mangasin->execute(); ?> 
         <select id='destination_recep_deb2'>
          <?php while($mes_mg=$cherche_mangasin->fetch()){ ?>
           <option value='<?php echo $mes_mg['id'] ?>'><?php echo $mes_mg['mangasin'] ?></option>
         <?php } ?>
         </select> <br>

   <div style="display: none;">  
   <label>BL</label>  
  <input type="text" id="bl_deb2" class="form-control"   ><br>
  </div>
   
      <label>SACS </label>
        <input style="height: 25px;" type="text" class="form-control"  id="sacf_deb2"  name="sac"  ><br>
        <label>SACS MANQUANT </label>
        <input style="height: 25px;" type="text" class="form-control"  id="manquant_deb2"    ><br>
<div id="visible_poids_modif">
         <label>POIDS </label>
        <input style="height: 25px;" type="text" class="form-control"  id="poidsf_deb2"  name="sac"  ><br>
        </div>
         <div style="display:none;"> 
        <label>SAC MOUILLE</label>
        <input style="height: 25px;" type="text" class="form-control"  id="sacm_deb2"  name="sac"  ><br>
        </div> 
           <div style="display: none;">    
        <label>id_dis</label>
        <input style="height: 25px;" type="text" class="form-control"  id="id_dis_deb2"  name="id_dis_bl"  >
          
                 <label>id</label>
        <input style="height: 25px;" type="text" class="form-control"  id="id_deb2"  name="id"  >
                     <label>p_sac</label>
        <input style="height: 25px;" type="text" class="form-control"  id="poids_sac_deb2"  name="id"  >
        <input style="height: 25px;" type="text" class="form-control"  id="id_produit_deb2"  name="id"  >
        <input style="height: 25px;" type="text" class="form-control"  id="id_destination_deb2"  name="id"  >
        <input style="height: 25px;" type="text" class="form-control"  id="id_navire_deb2"  name="id"  >
        <input style="height: 25px;" type="text" class="form-control"  id="statut_deb2"    >
        </div> 
        
        

    
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







  
     <div class="main" id="pole" style="display: none;">

     
 <div class="row">
<?php $total_camions_en_attentes=total_camions_en_attentes($bdd,$a); ?> 
  <div class="col-md-6 col-lg-6">
      <span style="display:flex; justify-content: center; float:left;"><h6>NBRE CAMIONS EN ATTENTES: <?php if($total_camions=$total_camions_en_attentes->fetch()) ?> <span style="color:red; background: white;"><?php echo $total_camions['count(trd.id_register_manif)']; ?></span> </h6>   </span>  
      </div>
     
<div class="col-md-6 col-lg-6">
      <span style="display:flex; justify-content: center; float:right;"><h6>RECHERCHE </h6>  <input   type="search" id="valeur_filtre_bl_camion" oninput='cherche_par_bl_camion()' > </span>  
      </div>
        


<div class="col-md-12 col-lg-12">


  <div class="table-responsive" border=1>

  
 
  <br>

 
  
 <table class='table table-hover table-bordered table-striped' id='table_camion' border='2' >
    

 <thead >
       
     <td colspan="12" class="titre" style="background: linear-gradient(-45deg, #004362, #0183d0) !important; color: orange;"><i class="fas fa-truck" style="background: linear-gradient(-45deg, #004362, #0183d0) !important; color: orange;" ></i> CAMION EN ATTENTES <a  class="agrandir_table" data-role="agrandir_table" ><i class="fa fa-eye"></i></a> </td>
    <tr class="tr_attente_avaries" style="background: linear-gradient(-45deg, #004362, #0183d0) !important; color: white;" > </tr>
      
      <tr style="background: linear-gradient(-45deg, #004362, #0183d0) !important; color: white;">
      
       <td scope="col"    >DATES</td> 
       <td scope="col"    >HEURE</td> 
           <td   >NAVIRE</td>
           <td >ENTREPOT</td>
    <td class="produit_hide" >PRODUIT</td>    
                 <td class="bl_hide" scope="col"  >BL</td>
               <td class="camion_hide" scope="col"   >CAMIONS</td> 
               <td class="chauffeur_hide" scope="col"   >CHAUFFEUR</td>       
  <td scope="col" >SACS</td>
      <td scope="col"  >POIDS</td>
      <td scope="col"  >STATUT</td>
      <td scope="col"  >ACTIONS</td>
      
     
  </tr>


      
    
     </thead>


<tbody>
<?php afficher_camions_en_attentes_avaries($bdd); ?>
</tbody>
</table>
</div>
 </div> 

</div>

         
     </div>
        
      


    <?php 
//111111111111111111111111111DEBUTPARTIE11111111111111111111111111111 
    //       PARTIE SITUATION DEBARQUEMENT
     ?>
     <div >
        
         

</div>


      

<center>  
<div class="container-fluid1 " id="situation"  style=" background: rgb(0,141,202); display: none; width: 50%; margin-top: 0;"  >
        <div class="row">
            
            
                <div class="col-lg-12 col-md-12">
                    <h1 class="hem2" > RECEPTION</h1><br>

                    
                    <form method="POST" >
                        <select  id="navires" class="mysel" style="margin-right: 15%; height: 20px;   width: 40%;"  onchange='goNavireSit()'>
                            <option value="">selectionner un navire</option>
                            <?php
                                $a=$_SESSION['id'];
                                  if($_SESSION['profil']=="Mangasinier"){
                                 $naviress=choix_du_navire($bdd,$a);
                               }
                               else{
                                $naviress=choix_du_navire2($bdd);
                              }
                                 
                      

                            while ($row=$naviress->fetch()) {
                             ?>
                                <option value=<?php echo $row['id_navire'].'-'.$_SESSION['id']; ?> >  <?php echo $row['navire'] ?> </option>
                            <?php } ?>
                               }

                 </select>
                        
                     <select id="mesprod" class="mysel" name="produit" style="margin-right: 2%; height: 20px;  width: 40%;" data-role='goProduit'>
                            <option  value="">selectionner le produit</option>
                        </select>
                        
                 
                            
                    </form>
                
            </div>
        </div>
    </div>
</center>
  
  <div id="main">


  </div>
 
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
     <div style="display: none;">  
   <label>id_dis</label>  
   <input type="text" id="id_dis_rec"  class="form-control"   name="FF" ><br>
      <label>id_nav</label>  
   <input type="text" id="id_navire_rec"  class="form-control"   name="FF" ><br>  
    <input type="text" id="id_declaration_rec"  class="form-control"   name="FF" ><br> 
    <input type="text" id="id_destination_rec"  class="form-control"   name="FF" >
    <input type="text" id="id_produit_rec"  class="form-control"   name="FF" >
    <input type="text" id="poids_sac_rec"  class="form-control"   name="FF" >
   </div>     

    
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


   
		

	<!-- Footer -->				
	<footer>
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

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Template JS File -->
	<script src="../assets/js/script.js"></script>
	<script src="../assets/js/custom.js"></script>
   
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
 
   

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
 
        /*    function getXhr(){
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
            } */
 
            /**
            * Méthode qui sera appelée sur le clic du bouton
            */
    /*        function goProduit(){
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
                xhr.open("POST","selectTable.php",true);
                // ne pas oublier ça pour le post
                xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
                // ne pas oublier de poster les arguments
                // ici, l'id de l'auteur
                sel = document.getElementById('mesprod');
                id_dis=document.getElementById('id_dis_sit');

                idproduit = sel.options[sel.selectedIndex].value;
                id_dis.value=idproduit;
                xhr.send("idProduit="+idproduit);

        
            } */

                  $(document).ready(function(){
    $(document).on('change','select[data-role=goProduit]',function(){
  //$('#type').css('display', 'block');
  
  
  
    var idProduit = $('#mesprod').val();
    var table_sain_visible=$('#table_sain_visible').val();
    var table_avaries_reception_visible=$('#table_avaries_reception_visible').val();
    var table_avaries_deb_visible=$('#table_avaries_deb_visible').val();
    var table_pv_reception_visible=$('#table_pv_reception_visible').val();
    
    var verifier_statut=$('#input_statut').val();
    if(!verifier_statut){
    var  statut='NULL';
    }
    else{
     var statut=$('#input_statut').val();
    }



      //var type_dec = $('#type_dec').val();
      /*
$(document).ready(function() {
 $('#tabsain table').DataTable({
    // Options de DataTables, si vous en avez besoin

});
}); */
        $.ajax({
        url:'selectTable.php',
        method:'post',
        data:{idProduit:idProduit,table_sain_visible:table_sain_visible,table_avaries_reception_visible:table_avaries_reception_visible,table_avaries_deb_visible:table_avaries_deb_visible,statut:statut,table_pv_reception_visible:table_pv_reception_visible},
        success: function(response){

            $('#main').html(response);
                  
          
     
       
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
       var nav = $(this).data('navire');
       var destination = $(this).data('destination');
       var declaration = $(this).data('declaration');
       var produit = $(this).data('produit');
       var poids_sac = $(this).data('poids_sac');
        //var date = $('#'+id+'date').text();
   
        
         var date = $('#date_sit_rep').val();
         var flasque = $('#flasque_sit').val();
         var mouille = $('#mouille_sit').val();

         $('#id_dis_rec').val(id_dis);
         $('#id_navire_rec').val(nav);
         $('#id_declaration_rec').val(declaration);
         $('#id_destination_rec').val(destination);
         $('#id_produit_rec').val(produit);
         $('#poids_sac_rec').val(poids_sac);
         //var id_dis = $('#id_dis_rec').val();


         
        
$('#form_situation_reception').modal('toggle');

       });
    
    $('#save_situation2').click(function(){ 
    var date = $('#date_sit_rep').val();
    var flasque = $('#flasque_sit').val(); 
    var mouille = $('#mouille_sit').val();
    var id_dis = $('#id_dis_rec').val();
     var navire = $('#id_navire_rec').val();
     var id_declaration = $('#id_declaration_rec').val();
     var destination = $('#id_destination_rec').val();
     var produit = $('#id_produit_rec').val();
     var poids_sac = $('#poids_sac_rec').val();
        $.ajax({
    url:'insertion_situation_reception_24h.php',
    method:'post',
    data:{date:date,flasque:flasque,mouille:mouille,id_dis:id_dis,navire,navire,id_declaration:id_declaration,destination:destination,produit:produit,poids_sac:poids_sac},
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
        var id_produit = $('#'+id+'id_produit').text();
        var id_destination = $('#'+id+'id_destination').text();
        var id_navire = $('#'+id+'id_navire').text();
   
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

        
        $('#produit_up_aff').val(id_produit);
        $('#destination_up_aff').val(id_destination);
        $('#navire_up_aff').val(id_navire);

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
         var id_produit = $('#produit_up_aff').val();
         var id_destination = $('#destination_up_aff').val();
         var id_navire = $('#navire_up_aff').val();
        
        var id_dis_bl = $('#id_dis_bl_up_aff').val();
        
        var id = $('#id_up_aff').val();

        
        $.ajax({
    url:'modifier_table_reception.php',
    method:'post',
    data:{date:date,bl:bl,sac:sac,manquant:manquant,poids_sac:poids_sac,id_dis_bl:id_dis_bl,id:id,heure:heure,id_produit:id_produit,id_destination:id_destination,id_navire:id_navire},
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
    $(document).on('click','a[data-role=update_avr_reception]',function(){
        var id = $(this).data('id');
        var date = $('#'+id+'date_avr').text();
        var sacf = $('#'+id+'sac_flasque_avr').text();
         var sacm = $('#'+id+'sac_mouille_avr').text();
          var id_dis = $('#'+id+'id_dis_avr').text();
        var poids_sac = $('#'+id+'poids_sac_avr').text();
        var id_produit = $('#'+id+'id_produit_avr').text();
        var id_destination = $('#'+id+'id_destination_avr').text();
        var id_navire = $('#'+id+'id_navire_avr').text();
        var id_declaration = $('#'+id+'id_declaration_avr').text();
        $('#date_avr2').val(date);
       
        $('#sacf_avr2').val(sacf);
           $('#sacm_avr2').val(sacm);
           $('#id_dis_avr2').val(id_dis);
           $('#id_avr2').val(id);
           $('#poids_sac_avr2').val(poids_sac);
           $('#id_produit_avr2').val(id_produit);
           $('#id_destination_avr2').val(id_destination);
           $('#id_navire_avr2').val(id_navire);
           $('#id_declaration_avr2').val(id_declaration);

        
        
        $('#form_avaries_reception').modal('toggle');
    });
    
    $('#save_avaries_reception').click(function(){
         
        var date = $('#date_avr2').val();
        date=date.replace(' ','');
        var sacf = $('#sacf_avr2').val();
        var sacm = $('#sacm_avr2').val();
        
        var id_dis = $('#id_dis_avr2').val();
        
        var id = $('#id_avr2').val();

        var poids_sac= $('#poids_sac_avr2').val();
       var id_produit= $('#id_produit_avr2').val();
        var id_destination= $('#id_destination_avr2').val();
         var id_navire= $('#id_navire_avr2').val();
         var id_declaration= $('#id_declaration_avr2').val();

        
        $.ajax({
    url:'update_avaries_reception.php',
    method:'post',
    data:{date:date,sacf:sacf,sacm:sacm,id_dis:id_dis,id:id,poids_sac:poids_sac,id_produit:id_produit,id_destination:id_destination,id_navire:id_navire,id_declaration:id_declaration},
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
        var dates = $('#'+id+'date_deb').text();
        var dates=dates.replace(' ','');
        var heure = $('#'+id+'heures').text();
        var bl = $('#'+id+'bl_deb').text();
      var sacf = $('#'+id+'flasque_deb').text();
       var poidsf = $('#'+id+'poids_flasque_deb').text();
         var sacm = $('#'+id+'mouille_deb').text();
            var id_dis = $('#'+id+'id_dis_deb').text();
            var poids_sac = $('#'+id+'poids_sac_deb').text();
        var id_produit = $('#'+id+'id_produit_deb').text();
        var id_destination = $('#'+id+'id_destination_deb').text();
        var id_navire = $('#'+id+'id_navire_deb').text();
        var manquant = $('#'+id+'manquant_deb').text();
         var destination_recep = $('#'+id+'id_destination_deb').text();
        var statut = $('#input_statut').val();
       
       
        $('#sacf_deb2').val(sacf);
        $('#time_deb2').val(heure);
           $('#sacm_deb2').val(sacm);
           $('#id_dis_deb2').val(id_dis);
           $('#id_deb2').val(id);
            $('#date_deb2').val(dates);
             $('#bl_deb2').val(bl);
              $('#poidsf_deb2').val(poidsf);
              $('#poids_sac_deb2').val(poids_sac);
              $('#id_produit_deb2').val(id_produit);
              $('#id_destination_deb2').val(id_destination);
              $('#id_navire_deb2').val(id_navire);
              $('#statut_deb2').val(statut);
              $('#manquant_deb2').val(manquant);
              $('#destination_recep_deb2').val(destination_recep);

 if(statut=='sain' || statut=='mouille' || statut=='balayure' ){
                    $('#visible_poids_modif').css('display','none');
                  }
                   if(statut=='flasque'){
                    $('#visible_poids_modif').css('display','block');
                  }
        
        
        $('#form_avaries_debarquement').modal('toggle');
    });
    
    $('#save_avaries_debarquement').click(function(){
         
        var dates = $('#date_deb2').val();
        dates=dates.replace(' ','');
         var heure = $('#time_deb2').val();
        var sacf = $('#sacf_deb2').val();
        var poidsf = $('#poidsf_deb2').val();
         var poids_sac = $('#poids_sac_deb2').val();
        var sacm = $('#sacm_deb2').val();
        
        var id_dis = $('#id_dis_deb2').val();
        var bl = $('#bl_deb2').val();
         var id_produit = $('#id_produit_deb2').val();
          var id_destination = $('#id_destination_deb2').val();
           var id_navire = $('#id_navire_deb2').val();
           var statut = $('#statut_deb2').val();
           var manquant = $('#manquant_deb2').val();
           var destination_recep = $('#destination_recep_deb2').val();
        
        
        var id = $('#id_deb2').val();

          

        
        $.ajax({
    url:'update_avaries_debarquement.php',
    method:'post',
    data:{dates:dates,sacf:sacf,sacm:sacm,id_dis:id_dis,id:id,bl:bl,poidsf:poidsf,poids_sac:poids_sac,heure:heure,id_produit:id_produit,id_destination:id_destination,id_navire:id_navire,statut:statut,manquant:manquant,destination_recep:destination_recep  },
    success: function(response){
      $('#TableReceptionAvaries').html(response);
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
        var statut = $('#'+id+'statut_ra').text();
        $('#date_avv').val(date);
         $('#sacf_avv').val(sacf);
          $('#sacm_avv').val(sacm);
           $('#poidsf_avv').val(poidsf);
            $('#bl_avv').val(bl);
            $('#bls_avv').text(bl);
             $('#camion_avv').val(camion);
              $('#camions_avv').text(camion);
              $('#chauffeurs_avv').text(chauffeur);
              $('#chauffeur_avv').val(chauffeur);
               $('#poids_sac_avv').val(poids_sac);
                $('#id_produit_avv').val(id_produit);
                 $('#id_declaration_avv').val(id_declaration);
                  //$('#id_destination_avv').val(id_destination); 
                  $('#destination_recep_deb0').val(id_destination);
                   $('#id_client_avv').val(id_client);
                    $('#id_navire_avv').val(id_navire);
                     $('#get_id_avv').val(getid);
                     $('#id_dis_bl_avv').val(id_dis_bl);
                      $('#statut_avv').val(statut);
                      $('#manquant_avv').val(0);

                         var maintenant = new Date();
    var heures = maintenant.getHours();
  var minutes = maintenant.getMinutes();

  // Formater l'heure et les minutes pour qu'ils aient toujours deux chiffres (par exemple, 09:05)
  if (heures < 10) heures = "0" + heures;
  if (minutes < 10) minutes = "0" + minutes;

  // Combinez l'heure et les minutes dans le format HH:MM
  var heureActuelle = heures + ":" + minutes;

  // Définir la valeur par défaut du champ d'entrée sur l'heure actuelle
 // document.getElementById("heuresain").value = heureActuelle;
  $('#time_avv').val(heureActuelle);
                     // $('#manquant_avv').val(manquant);
                       $('#id_avv').val(id);
                       if(statut=='sain' || statut=='mouille' || statut=='balayure' ){
                    $('#visible_poids').css('display','none');
                  }
                   if(statut=='flasque'){
                    $('#visible_poids').css('display','block');
                  }
                  


   
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
             //  var id_destination=  $('#id_destination_avv').val(); 
             var id_destination=  $('#destination_recep_deb0').val();
                var id_client=  $('#id_client_avv').val();
                 var  id_navire= $('#id_navire_avv').val();
                 var getid=  $('#get_id_avv').val();
                 var manquant=  $('#manquant_avv').val();
                 var id_dis_bl=  $('#id_dis_bl_avv').val();
                 var statut=  $('#statut_avv').val();
                  var id= $('#id_avv').val();



       
        
        $.ajax({
    url:'insert_rep_avv.php',
    method:'post',
    data:{date:date,bl:bl,chauffeur:chauffeur,camion:camion,sacf:sacf,sacm:sacm,poidsf:poidsf,manquant:manquant,poids_sac:poids_sac,id_produit:id_produit,id_dis_bl:id_dis_bl,id_declaration:id_declaration,id_destination:id_destination,id_client:id_client,id_navire:id_navire,id:id,getid:getid,heure:heure,statut:statut},
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
        var poids_sac = $('#'+id+'poids_sac_avr').text();
        var id_produit = $('#'+id+'id_produit_avr').text();
        var id_destination = $('#'+id+'id_destination_avr').text();
        var id_navire = $('#'+id+'id_navire_avr').text();
        var id_declaration = $('#'+id+'id_declaration_avr').text();

         //var navire=navires.text();
         
         $.ajax({

              type:'post',
              url:'delete_avaries_reception.php',
              data:{delete_id:id,id_dis:id_dis,poids_sac:poids_sac,id_produit:id_produit,id_destination:id_destination,id_navire:id_navire,id_declaration:id_declaration},
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
        var poids_sac = $('#'+id+'poids_sac_deb').text();
        var id_produit = $('#'+id+'id_produit_deb').text();
        var id_destination = $('#'+id+'id_destination_deb').text();
        var id_navire = $('#'+id+'id_navire_deb').text();

         //var navire=navires.text();
         
         $.ajax({

              type:'post',
              url:'delete_avaries_debs.php',
              data:{delete_id:id,id_dis:id_dis,poids_sac:poids_sac,id_produit:id_produit,id_destination:id_destination,id_navire:id_navire},
              success:function(response){
              
                   $('#TableReceptionAvaries').html(response);

              }

         });

       }


     }

 

 function delete_reception_deb(id){
   
           Swal.fire({
        title: 'Êtes-vous sûr?',
        text: 'Voulez-vous vraiment supprimer cette donnée?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oui, supprimer!',
        cancelButtonText: 'Annuler'
    }).then((result) => {
        if (result.isConfirmed) {
        //var id = $('#'+id+'getid').text();
        var id_dis = $('#'+id+'id_dis_deb').text();
        var poids_sac = $('#'+id+'poids_sac_deb').text();
        var id_produit = $('#'+id+'id_produit_deb').text();
        var id_destination = $('#'+id+'id_destination_deb').text();
        var id_navire = $('#'+id+'id_navire_deb').text();
         var bl = $('#'+id+'bl_deb').text();
          var statut = $('#'+id+'statut_deb').text();

         //var navire=navires.text();
         
         $.ajax({

              type:'post',
              url:'delete_reception.php',
              data:{delete_id:id,id_dis:id_dis,poids_sac:poids_sac,id_produit:id_produit,id_destination:id_destination,id_navire:id_navire,bl:bl,statut:statut},
              success:function(response){
              
                   $('#TableReceptionAvaries').html(response);

                     }
            });
        }
    });
}


function deleteIntervenant(id){
   
           Swal.fire({
        title: 'Êtes-vous sûr?',
        text: 'Voulez-vous vraiment supprimer cette donnée?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oui, supprimer!',
        cancelButtonText: 'Annuler'
    }).then((result) => {
        if (result.isConfirmed) {
        //var id = $('#'+id+'getid').text();
        var produit = $('#valeur_produit').val(); //$(this).data('prod');  
        var poids_sac =$('#valeur_poids_sac').val();  //$(this).data('poids_sac'); 
       
        var destination = $('#valeur_destination').val();   //$(this).data('destination'); 
        var navire = $('#valeur_navire').val();    //$(this).data('navire'); 


         //var navire=navires.text();
         
         $.ajax({

              type:'post',
              url:'delete_intervenant_reception.php',
              data:{delete_id:id,poids_sac:poids_sac,produit:produit,destination:destination,navire:navire},
              success:function(response){
              
                   $('#liste_intervenant').html(response);

                     }
            });
        }
    });
}




 </script>






<script type="text/javascript">
  function deletereceptionaff(id){
   
       if(confirm('Voulez vous vraiment supprimer ce donnée?')){
        
        var id_dis = $('#'+id+'id_dis_up').text();
        var id_produit = $('#'+id+'id_produit').text();
        var poids_sac = $('#'+id+'poids_sac').text();
        var id_destination = $('#'+id+'id_destination').text();
        var id_navire = $('#'+id+'id_navire').text();

         //var navire=navires.text();
         
         $.ajax({

              type:'post',
              url:'deleteRepaff.php',
              data:{delete_id:id,id_dis:id_dis,id_produit:id_produit,poids_sac:poids_sac,id_destination:id_destination,id_navire:id_navire},
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
      $(document).ready(function(){
    $(document).on('click','button[data-role=visiblePV]',function(){
     $('#btnPV').css('background','yellow');
     $('#btnPV').css('border-color','blue');

    $('#btnReception').css('background','white');
     $('#btnReception').css('border-color','white');
     
    $('#btnAvariesRep').css('background','white');
     $('#btnAvariesRep').css('border-color','white');
     var table_sain_visible = document.getElementById("table_sain_visible");
     var table_avaries_reception_visible = document.getElementById("table_avaries_reception_visible");
     var table_avaries_deb_visible = document.getElementById("table_avaries_deb_visible");
     var table_pv_reception_visible = document.getElementById("table_pv_reception_visible");
    table_sain_visible=$('#table_sain_visible').val(0);
    table_avaries_reception_visible=$('#table_avaries_reception_visible').val(0);
    table_avaries_deb_visible=$('#table_avaries_deb_visible').val(0);
    table_pv_reception_visible=$('#table_pv_reception_visible').val(1);
   // var sain = document.getElementById("tableSain");
    var deb = document.getElementById("TableReceptionAvaries");
    var rep = document.getElementById("avaries_receptions");
    var pv = document.getElementById("pv_reception");
    $('#btnSain').css('background-color','yellow');
    $('#btnAvariesDeb').css('background-color','white');
    $('#btnAvariesRep').css('background-color','white');


   
    //  sain.style.display = "none";
      pv.style.display = "table";
      rep.style.display = "none";
      deb.style.display = "none";
//$('#liste').css('background','red');
          

       

      // sain.scrollIntoView({ behavior: 'smooth' });
     
    var statut='sain';
    var navire = $('#input_navire').val();
    var produit = $('#input_produit').val();
    var destination = $('#input_destination').val();
    var poids_sac = $('#input_poids_sac').val();

     $.ajax({
    url:'afficher_pv.php',
    method:'post',
    data:{poids_sac:poids_sac,produit:produit,destination:destination,navire:navire,statut:statut},
    success: function(response){
      $('#pv_reception').html(response);
 
    
    }
  });

       });
      });

    
  /*  var produit = $(this).data('produit');
    var destination = $(this).data('destination');
    var poids_sac = $(this).data('poids_sac'); */

           
    
  



   function visibleSain() {


     $('#btnReception').css('background','yellow');
     $('#btnReception').css('border-color','blue');

    $('#btnAvariesRep').css('background','white');
     $('#btnAvariesRep').css('border-color','white');

    $('#btnPV').css('background','white');
     $('#btnPV').css('border-color','white');

     var table_sain_visible = document.getElementById("table_sain_visible");
     var table_avaries_reception_visible = document.getElementById("table_avaries_reception_visible");
     var table_avaries_deb_visible = document.getElementById("table_avaries_deb_visible");
     var table_pv_reception_visible = document.getElementById("table_pv_reception_visible");
    table_sain_visible=$('#table_sain_visible').val(0);
    table_avaries_reception_visible=$('#table_avaries_reception_visible').val(0);
    table_avaries_deb_visible=$('#table_avaries_deb_visible').val(1);
     table_pv_reception_visible=$('#table_pv_reception_visible').val(0);
   // var sain = document.getElementById("tableSain");
    var deb = document.getElementById("TableReceptionAvaries");
    var rep = document.getElementById("avaries_receptions");
    var pv = document.getElementById("pv_reception");
    $('#btnSain').css('background-color','yellow');
    $('#btnAvariesDeb').css('background-color','white');
    $('#btnAvariesRep').css('background-color','white');


   
    //  sain.style.display = "none";
      deb.style.display = "table";
      rep.style.display = "none";
       pv.style.display = "none";
//$('#liste').css('background','red');
          

       

      // sain.scrollIntoView({ behavior: 'smooth' });
     
    var statut='sain';
    var navire = $('#input_navire').val();
    var produit = $('#input_produit').val();
    var destination = $('#input_destination').val();
    var poids_sac = $('#input_poids_sac').val();
    var table_avaries_deb_visible=1;
    var table_pv_reception_visible=0;
  /*  var produit = $(this).data('produit');
    var destination = $(this).data('destination');
    var poids_sac = $(this).data('poids_sac'); */

               $.ajax({
        url:'recuperer_statut_avaries.php',
        method:'post',
        data:{statut:statut,navire:navire,produit:produit,destination:destination,poids_sac:poids_sac,table_avaries_deb_visible:table_avaries_deb_visible,table_pv_reception_visible:table_pv_reception_visible},
        success: function(response){

            $('#TableReceptionAvaries').html(response);
          }
          });
   
    
  }


</script>


<script>
  function visibleAvariesDeb() {
    
        $('#btnSain').css('background-color','white');
    $('#btnFlasque').css('background-color','white');
    $('#btnMouille').css('background-color','yellow');
     $('#btnBalayure').css('background-color','white');
     var table_sain_visible = document.getElementById("table_sain_visible");
     var table_avaries_reception_visible = document.getElementById("table_avaries_reception_visible");
     var table_avaries_deb_visible = document.getElementById("table_avaries_deb_visible");
    table_sain_visible=$('#table_sain_visible').val(0);
    table_avaries_reception_visible=$('#table_avaries_reception_visible').val(0);
    table_avaries_deb_visible=$('#table_avaries_deb_visible').val(0);


    var sain = document.getElementById("tableSain");
    var deb = document.getElementById("TableReceptionAvaries");
    var rep = document.getElementById("avaries_receptions");
   

   
      deb.style.display = "table";
    //  sain.style.display = "none";
      rep.style.display = "none";
      pv.style.display = "none";
     
     

      // deb.scrollIntoView({ behavior: 'smooth' });
     

    var statut='mouille';
    var navire = $('#input_navire').val();
    var produit = $('#input_produit').val();
    var destination = $('#input_destination').val();
    var poids_sac = $('#input_poids_sac').val();
    var table_avaries_deb_visible=1;
  /*  var produit = $(this).data('produit');
    var destination = $(this).data('destination');
    var poids_sac = $(this).data('poids_sac'); */

               $.ajax({
        url:'recuperer_statut_avaries.php',
        method:'post',
        data:{statut:statut,navire:navire,produit:produit,destination:destination,poids_sac:poids_sac,table_avaries_deb_visible:table_avaries_deb_visible},
        success: function(response){

            $('#TableReceptionAvaries').html(response);
          }
          });
          


    
    
    
  }


  function visibleAvariesRep() {

     $('#btnAvariesRep').css('background','yellow');
     $('#btnAvariesRep').css('border-color','blue');

    $('#btnReception').css('background','white');
     $('#btnReception').css('border-color','white');
     
    $('#btnPV').css('background','white');
     $('#btnPV').css('border-color','white');
         var table_sain_visible = document.getElementById("table_sain_visible");
     var table_avaries_reception_visible = document.getElementById("table_avaries_reception_visible");
     var table_avaries_deb_visible = document.getElementById("table_avaries_deb_visible");
    table_sain_visible=$('#table_sain_visible').val(0);
    table_avaries_reception_visible=$('#table_avaries_reception_visible').val(1);
    table_avaries_deb_visible=$('#table_avaries_deb_visible').val(0);

  //  var sain = document.getElementById("tableSain");
    var deb = document.getElementById("TableReceptionAvaries");
    var rep = document.getElementById("avaries_receptions");
     var pv = document.getElementById("pv_reception");

  
      rep.style.display = "table";
      deb.style.display = "none";
       pv.style.display = "none";
     // sain.style.display = "none";
     
     


    var navire = $('#input_navire').val();
    var produit = $('#input_produit').val();
    var destination = $('#input_destination').val();
    var poids_sac = $('#input_poids_sac').val();
    var table_avaries_reception_visible=1;
  /*  var produit = $(this).data('produit');
    var destination = $(this).data('destination');
    var poids_sac = $(this).data('poids_sac'); */

               $.ajax({
        url:'recuperer_statut_avaries_recep.php',
        method:'post',
        data:{navire:navire,produit:produit,destination:destination,poids_sac:poids_sac,table_avaries_reception_visible:table_avaries_reception_visible},
        success: function(response){

            $('#avaries_receptions').html(response);
          }
          });
          
    
    
  }




   function visibleRecepFlasque() {
    
        $('#btnSain').css('background-color','white');
    $('#btnFlasque').css('background-color','yellow');
    $('#btnMouille').css('background-color','white');
     $('#btnBalayure').css('background-color','white');
     var table_sain_visible = document.getElementById("table_sain_visible");
     var table_avaries_reception_visible = document.getElementById("table_avaries_reception_visible");
     var table_avaries_deb_visible = document.getElementById("table_avaries_deb_visible");
    table_sain_visible=$('#table_sain_visible').val(0);
    table_avaries_reception_visible=$('#table_avaries_reception_visible').val(0);
    table_avaries_deb_visible=$('#table_avaries_deb_visible').val(1);

   // var sain = document.getElementById("tableSain");
    var deb = document.getElementById("TableReceptionAvaries");
    var rep = document.getElementById("avaries_receptions");

   
      deb.style.display = "table";
    //  sain.style.display = "none";
      rep.style.display = "none";
     
     

       deb.scrollIntoView({ behavior: 'smooth' });
     
     
    var statut='flasque';
    var navire = $('#input_navire').val();
    var produit = $('#input_produit').val();
    var destination = $('#input_destination').val();
    var poids_sac = $('#input_poids_sac').val();
    var table_avaries_deb_visible=1;
  /*  var produit = $(this).data('produit');
    var destination = $(this).data('destination');
    var poids_sac = $(this).data('poids_sac'); */

               $.ajax({
        url:'recuperer_statut_avaries.php',
        method:'post',
        data:{statut:statut,navire:navire,produit:produit,destination:destination,poids_sac:poids_sac,table_avaries_deb_visible:table_avaries_deb_visible},
        success: function(response){

            $('#TableReceptionAvaries').html(response);
          }
          });
          


    
    
    
  }

  function visibleRecepBalayure() {
    
        $('#btnSain').css('background-color','white');
    $('#btnFlasque').css('background-color','white');
    $('#btnMouille').css('background-color','white');
     $('#btnBalayure').css('background-color','yellow');
     var table_sain_visible = document.getElementById("table_sain_visible");
     var table_avaries_reception_visible = document.getElementById("table_avaries_reception_visible");
     var table_avaries_deb_visible = document.getElementById("table_avaries_deb_visible");
    table_sain_visible=$('#table_sain_visible').val(0);
    table_avaries_reception_visible=$('#table_avaries_reception_visible').val(0);
    table_avaries_deb_visible=$('#table_avaries_deb_visible').val(1);

   // var sain = document.getElementById("tableSain");
    var deb = document.getElementById("TableReceptionAvaries");
    var rep = document.getElementById("avaries_receptions");

   
      deb.style.display = "table";
     // sain.style.display = "none";
      rep.style.display = "none";
     
     

       deb.scrollIntoView({ behavior: 'smooth' });
     
     
    var statut='balayure';
    var navire = $('#input_navire').val();
    var produit = $('#input_produit').val();
    var destination = $('#input_destination').val();
    var poids_sac = $('#input_poids_sac').val();
    var table_avaries_deb_visible=1;
  /*  var produit = $(this).data('produit');
    var destination = $(this).data('destination');
    var poids_sac = $(this).data('poids_sac'); */

               $.ajax({
        url:'recuperer_statut_avaries.php',
        method:'post',
        data:{statut:statut,navire:navire,produit:produit,destination:destination,poids_sac:poids_sac,table_avaries_deb_visible:table_avaries_deb_visible},
        success: function(response){

            $('#TableReceptionAvaries').html(response);
          }
          });
          


    
    
    
  }
</script>



<script type="text/javascript">


    $(document).ready(function(){
    $(document).on('click','a[data-role=fermerVIDES]',function(){
        $('#LesErreursVIDES').css('display', 'none');
    });
    
    
});

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



<script>
  // Obtenir l'heure actuelle
  /*
  var maintenant = new Date();
  var heures = maintenant.getHours();
  var minutes = maintenant.getMinutes();

  // Formater l'heure et les minutes pour qu'ils aient toujours deux chiffres (par exemple, 09:05)
  if (heures < 10) heures = "0" + heures;
  if (minutes < 10) minutes = "0" + minutes;

  // Combinez l'heure et les minutes dans le format HH:MM
  var heureActuelle = heures + ":" + minutes;

  // Définir la valeur par défaut du champ d'entrée sur l'heure actuelle
  document.getElementById("time_avv").value = heureActuelle; */
</script>

<script type="text/javascript">
   $(document).ready(function(){
    $(document).on('click','a[data-role=liste_camion]',function(){
      $('#pole').css('display', 'block');
      $('#situation').css('display', 'none');
      $('#main').css('display', 'none');
      $('#liste').css('background', 'yellow');
      $('#vue_reception').css('background', 'white');
      var ac=1;
       $.ajax({
    url:'afficher_les_camions.php',
    method:'post',
    data:{ac:ac},
    success: function(response){
      $('#pole').html(response);

    }
  });
    });

    });
  

</script>

<script type="text/javascript">
   $(document).ready(function(){
    $(document).on('click','a[data-role=mes_receptions]',function(){

      var table_sain_visible=$('#table_sain_visible').val();
      var table_avaries_reception_visible=$('#table_avaries_reception_visible').val();
       var table_pv_reception_visible=$('#table_pv_reception_visible').val();
      var table_avaries_deb_visible=$('#table_avaries_deb_visible').val();
     
      $('#table_sain_visible').css('background','red');
     
 
      $('#situation').css('display', 'block');
      $('#pole').css('display', 'none');
      $('#main').css('display', 'block');
      $('#vue_reception').css('background', 'yellow');
      $('#liste').css('background', 'white');

      if(table_sain_visible==1){
        var valeur_poids_sac=$('#valeur_poids_sac').val();
        var valeur_produit=$('#valeur_produit').val();
        var valeur_navire=$('#valeur_navire').val();
        var valeur_destination=$('#valeur_destination').val(); 
 $(document).ready(function(){
                $.ajax({
        url:'table_sain_etat_visible.php',
        method:'post',
        data:{table_sain_visible:table_sain_visible,valeur_produit:valeur_produit,valeur_poids_sac:valeur_poids_sac,valeur_destination:valeur_destination,valeur_navire:valeur_navire,table_avaries_reception_visible:table_avaries_reception_visible,table_avaries_deb_visible:table_avaries_deb_visible,table_pv_reception_visible:table_pv_reception_visible},
        success: function(response){

            $('#tableSain').html(response);
          }
          });
          }); 

      }

 if(table_avaries_deb_visible==1){
        var valeur_poids_sac=$('#valeur_poids_sac').val();
        var valeur_produit=$('#valeur_produit').val();
        var valeur_navire=$('#valeur_navire').val();
        var valeur_destination=$('#valeur_destination').val(); 
        var statut=$('#input_statut').val();
 $(document).ready(function(){
                $.ajax({
        url:'table_sain_etat_visible.php',
        method:'post',
        data:{table_sain_visible:table_sain_visible,valeur_produit:valeur_produit,valeur_poids_sac:valeur_poids_sac,valeur_destination:valeur_destination,valeur_navire:valeur_navire,table_avaries_reception_visible:table_avaries_reception_visible,table_avaries_deb_visible:table_avaries_deb_visible,statut:statut,table_pv_reception_visible:table_pv_reception_visible},
        success: function(response){

            $('#TableReceptionAvaries').html(response);
          }
          });
          }); 

      }

         if(table_pv_reception_visible==1){
        var valeur_poids_sac=$('#valeur_poids_sac').val();
        var valeur_produit=$('#valeur_produit').val();
        var valeur_navire=$('#valeur_navire').val();
        var valeur_destination=$('#valeur_destination').val(); 
 $(document).ready(function(){
                $.ajax({
        url:'table_sain_etat_visible.php',
        method:'post',
        data:{table_sain_visible:table_sain_visible,valeur_produit:valeur_produit,valeur_poids_sac:valeur_poids_sac,valeur_destination:valeur_destination,valeur_navire:valeur_navire,table_avaries_reception_visible:table_avaries_reception_visible,table_avaries_deb_visible:table_avaries_deb_visible,table_pv_reception_visible:table_pv_reception_visible},
        success: function(response){

            $('#pv_reception').html(response);
          }
          });
          }); 

      }

      if(table_avaries_reception_visible==1){
        var valeur_poids_sac=$('#valeur_poids_sac').val();
        var valeur_produit=$('#valeur_produit').val();
        var valeur_navire=$('#valeur_navire').val();
        var valeur_destination=$('#valeur_destination').val(); 
 $(document).ready(function(){
                $.ajax({
        url:'table_sain_etat_visible.php',
        method:'post',
        data:{table_sain_visible:table_sain_visible,valeur_produit:valeur_produit,valeur_poids_sac:valeur_poids_sac,valeur_destination:valeur_destination,valeur_navire:valeur_navire,table_avaries_reception_visible:table_avaries_reception_visible,table_avaries_deb_visible:table_avaries_deb_visible,table_pv_reception_visible:table_pv_reception_visible},
        success: function(response){

            $('#avaries_receptions').html(response);
          }
          });
          }); 

      }

   

    });
  });

</script>


<script>
// Fonction pour récupérer et mettre à jour les notifications
function fetchPole() {
    $.ajax({
        url: 'fetch_pole.php', // URL du script PHP pour récupérer les notifications
        type: 'GET', // Méthode de requête GET
        success: function(data) { // Fonction exécutée en cas de succès de la requête
            $('#pole').html(data); // Met à jour le contenu de la section avec les notifications reçues
        }
    });
}

// Actualise les notifications toutes les 20 minutes
setInterval(fetchPole, 1200000);

// Appelle fetchNotifications une première fois au chargement de la page
fetchPole();


   $(document).ready(function(){
   $(document).on('click','a[data-role=agrandir_table]',function(){
  
  $('.produit_hide').css('display','block'); 
  $('.bl_hide').css('display','block');
  $('.camion_hide').css('display','block');

});
});

</script>

<script type="text/javascript">
  function cacher_les_input(){
  var statut=$('#statut_avv').val();
  if(statut=='flasque'){
    $('#poidsf_avv').css('display','none');
  }
}
cacher_les_input();
</script>


<script type="text/javascript">
  function cherche_par_bl_camion() {
    // Récupérer la valeur saisie dans l'input de recherche
    var recherche = document.getElementById("valeur_filtre_bl_camion").value.toUpperCase();
    
    // Sélectionner tous les éléments de la table
    var lignes = document.querySelectorAll("#table_camion tbody tr");

    // Parcourir toutes les lignes de la table
    lignes.forEach(function(ligne) {
        // Récupérer le texte de chaque cellule dans la ligne
        var contenuCellules = ligne.textContent.toUpperCase();
        
        // Vérifier si la valeur de recherche est présente dans le contenu de la ligne
        if (contenuCellules.indexOf(recherche) > -1) {
            // Afficher la ligne si elle correspond à la recherche
            ligne.style.display = "";
        } else {
            // Masquer la ligne si elle ne correspond pas à la recherche
            ligne.style.display = "none";
        }
    });
}
</script>

<script type="text/javascript">
  
    $(document).ready(function () {
        $(document).on('click', 'a[data-role=imprimer_pv]', function () {
            //var contentToPrint = $('#pv_reception').html();
            var contentToPrint = $('#pv_reception').html(); 
      
        // Supprimer le titre et la date du contenu à imprimer
        //contentToPrint.find('title, date').remove();
            var printWindow = window.open('', '_blank');
           //  var cssLink = '<link rel="stylesheet" type="text/css" href="imprimer_transfert.css">';
             var cssLink2 = '<link rel="stylesheet" type="text/css" href="../assets/modules/bootstrap-5.1.3/css/bootstrap.css">';
       // printWindow.document.write('<html><body>' + contentToPrint + '</body></html>');
       printWindow.document.write('<html><head>' + cssLink2 + '</head><body>' + contentToPrint + '</body></html>');
           // printWindow.document.write('<html><head><title>Impression</title></head><body>' + contentToPrint + '</body></html>');
            printWindow.document.close();
            printWindow.print(); 
           
            
        });
    }); 
</script>


<script type="text/javascript">
  
        $(document).ready(function(){
    $(document).on('click','a[data-role=ajout_intervenant]',function(){

       var produit = $(this).data('produit');
       var poids_sac = $(this).data('poids_sac');
       var navire = $(this).data('navire');
       var destination = $(this).data('destination');
       $('#produit_inter').val(produit);
       $('#poids_sac_inter').val(poids_sac);
       $('#navire_inter').val(navire);
       $('#destination_inter').val(destination);

      $('#form_ajout_intervenant').modal('toggle');
 
});
  });

</script>
<script type="text/javascript">
    $(document).ready(function(){
    $(document).on('click','a[data-role=inserer_intervenant]',function(){

    var choix_intervenant= $('#choix_intervenant').val();
    var produit= $('#produit_inter').val();
      var poids_sac=  $('#poids_sac_inter').val();
      var navire=  $('#navire_inter').val();
      var destination=  $('#destination_inter').val();

     if(choix_intervenant!=''){

         $.ajax({
    url:'insertion_intervenant.php',
    method:'post',
    data:{poids_sac:poids_sac,produit:produit,destination:destination,navire:navire,choix_intervenant:choix_intervenant},
    success: function(response){
      $('#liste_intervenant').html(response);
 
    $('#form_ajout_intervenant').modal('toggle');
    }
  });
        
    }
    else{
         Swal.fire({
        icon: 'error',
        title: 'Erreur',
        text: 'Veuillez choisir un intervenant.',
        confirmButtonText: 'OK'
    }); 
    }
 
});
  });        


   
    

</script>


<script type="text/javascript">
               $(document).ready(function(){
    $(document).on('click','a[data-role=changer_destination]',function(){
      var id=$(this).data('id');
      $('#ch_dest').val(id);
      $('#changer_destination').modal('toggle');
    });
  });


    $(document).ready(function(){
    $(document).on('click','a[data-role=valider_changer_destination]',function(){
      //var id=$(this).data('id');
    var id=  $('#ch_dest').val();
    var destination=  $('#select_changer_destination').val();

    if(id!='' && destination!=''){

       $.ajax({
    url:'changer_destination.php',
    method:'post',
    data:{id:id,destination:destination},
    success: function(response){
      $('#pole').html(response);
      /*$('#'+id).children('td[data-target=cales]').text(cale);
    $('#'+id).children('td[data-target=nom_chargeur]').text(ch);
    $('#'+id).children('td[data-target=conditionnement]').text(cond+' KGS');
    //$('#modif_dec').modal('toggle');*/
   $('#changer_destination').modal('toggle');
    }
  });
     }

     else{
         Swal.fire({
        icon: 'error',
        title: 'Erreur',
        text: 'Veuillez remplir.',
        confirmButtonText: 'OK'
    }); 
    }    

      
    });
  });              
</script>

 </body>
</html>
