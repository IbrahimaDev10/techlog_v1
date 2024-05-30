<?php
require('../database.php');
//require('tr_action.php');
//header("Cache-Control: no-cache, must-revalidate");
//header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
require('controller/produit_du_navire.php');
require('controller/date_situation.php');
 if($_SESSION['profil']!="superviseur" and $_SESSION['profil']!="Admin" and $_SESSION['profil']!="Pointeur" and $_SESSION['profil']!="Mangasinier" and empty($_SESSION['aut']) and $_SESSION['profil']!="pont" ){
  header('location:../index.php');
}
if($_SESSION['profil']!="superviseur" and $_SESSION['profil']!="Admin" and $_SESSION['profil']!="Pointeur" and $_SESSION['profil']!="Mangasinier" and !empty($_SESSION['aut']) and $_SESSION['profil']!="pont" ){
  header('location:../star_superviseur.php');
}




$menu=$bdd->prepare('select * from navire_deb where id=?');
$menu->bindParam(1,$_SESSION['produit']);
$menu->execute();
$navbl=$bdd->query("select * from navire_deb order by id desc");
$navire=$bdd->query("select * from navire_deb order by id desc");

$navire2=$bdd->query("select * from navire_deb order by id desc");
$navire3=$bdd->query("select * from navire_deb order by id desc");
if(isset($_POST['SIT'])){

    header('location:tr.situations.php');
    


}

$verific=$bdd->query("SELECT count(rm.bl), rm.bl, nav.id,nav.navire from register_manifeste as rm
      inner join navire_deb as nav on nav.id=rm.id_navire and rm.bl!='ref' group by rm.bl

      ");

if($_SESSION['profil']=='superviseur'){

$m=$_GET['m'];

$nav_ex=explode('-', $m);

$navire_initiale=$nav_ex[0];
}


?>	
<!DOCTYPE html>
<html lang="fr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="google" content="notranslate">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Debarquement</title>
<link rel="stylesheet" type="text/css" href="situation_journaliere.css" media="print">

 <link rel= "stylesheet" href= "https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">


   <link rel="stylesheet" type="text/css" href="imprimer_transfert.css" media="print">
   <link rel="stylesheet" type="text/css" href="css/vrac_pont.css" >
   <link rel="stylesheet" type="text/css" href="css/style.css" >
    
<!-- Bootstrap CSS-->

    <?php include('tr_link.php'); ?>
    
    <link href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" rel="stylesheet"> 
         <style>
        .restant {
            color: red !important;
        }
                .restant_noir {
            color: black !important;
        }
        #btn_pont{
  font-size: 16px !important;
  background:white;
  color: black !;
  margin-top: 5px;
  margin-bottom: 5px;
  border-radius: 40px;

}
.lien_debut{
   display: flex;
 justify-content: center;
}
    </style> 
</head>
<body >

    <div class="container LesOperations" id="pont_deb"  >
      <div class="row" >
       <div class="col-col-md-12 col-col-lg-12" style="padding-bottom: 0px !important; width: 100% !important; background: black;">
      <span class="lien_debut"> 
      <a id="liste"  style="display: flex; justify-content: center; color: white; border:solid; border-color: blue; border-radius: 50px; margin-right: 30px;" data-role="liste_camion"><i style="color: blue;" class="fas fa-truck" ></i> Liste des camions en attentes</a>

       <a id="btn_camion_peses" style="display: flex; justify-content: center; color: white; border:solid; border-color: blue; border-radius: 50px;  margin-right: 30px;"  onclick="camions_peses()"><i style="color: blue;" class="fas fa-eye" ></i> </i>Camions pesés</a>
        <a id="btn_situation" style="display: flex; justify-content: center; color: white; border:solid; border-color: blue; border-radius: 50px;"  onclick="situations()"><i style="color: blue;" class="fas fa-eye" ></i> </i>Situations</a>
       </span>
    </div>
  </div>
</div>
<br><br>
    




  <!-- input situation !-->
  <div style="display: none;">
   <input type="text" id="deb_client" name="" value="0" >
   <input type="text" id="deb_cale" name="" value="0" >
   <input type="text" id="deb_produit" name="" value="0" >
   <input type="text" id="deb_sain" name="" value="0" >
   <input type="text" id="deb_destination" name="" value="0" >

   <input type="text" id="deb_av_cale" name="" value="0" >
   <input type="text" id="deb_av_produit" name="" value="0" >
   <input type="text" id="deb_av_destination" name="" value="0" >
    <input type="text" id="transfert_sain_deb" name="" value="0" >

 <!-- input transfert !-->
 <input type="text" id="transfert_sain" name="" value="0" >


   
   <input type="text" id="transfert_des_avaries" name="" value="0" >
    <input type="text" id="transfert_sain_avaries" name="" value="0" >
    <input type="text" id="transfert_avaries" name="" value="0" >
   <input type="text" id="avaries_de_deb" name="" value="0" >

   <input type="text" id="input_navire_initiale" name="" value="<?php echo $navire_initiale; ?>" >

   <input type="text" name="" id="input_statut_new" >
   </div>
<style type="text/css">
	

</style>



  
  <!--Topbar -->
   
  
	<!--Sidebar-->

  

    <!-- end row!-->




<div class="sidebar transition overlay-scrollbars animate__animated  animate__slideInLeft" style="background: linear-gradient(-45deg, #004362, #0183d0) !important; ">
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

                <!-- Divider-->
                <li class="divider" style="font-size: 18px;" data-text="STARTER"> DEBARQUEMENT</li>

                <li>
                    <a href="#">
                        <i class='bx bx-columns icon' ></i> 
                        Enregistrement des bons de Transfert / Livraison
                        <i class='bx bx-chevron-right icon-right' ></i>
                    </a>
                    <ul class="side-dropdown">
                       
                        
                                                
                    </ul>
                </li>

                       <li><a id="varier" data-bs-toggle="modal" data-bs-target="#Les_avaries">
                        <i class='bx bx-columns icon' ></i>AJOUTER SITUATION
                       </a>
                   </li> 
                   

                    <li><a   href="tr.situations.php"> <i class='bx bx-columns icon' ></i> MES SITUATION</a></li>
                    </a>
                     <li id='fr'><a href="final_report.php"> <i class='bx bx-columns icon' ></i> FINAL REPORT</a></li>
                    </a>
                    
                       

 
 


                
               

                <!-- Divider-->
       </div> 
     </div>
    </div><!-- End Sidebar-->


    <div class="sidebar-overlay"></div>
    
 <div class="bars">
        <button type="button" class="btn transition" id="sidebar-toggle">
            <i class="fa fa-bars"></i>
        </button>
    </div>
	












	<!--Content Start-->
	<div class="content-start transition" style="padding-top: 0px !important; top: 0px !important; top:0px; " >
		<div class="container-fluid dashboard">
			<div class="content-header">

<center>
  <div class="container-fluid" style="width: 50%; display: none;" id='espace_produit_pont'> 
 
    <div class="row">

      
       
        <div class="col-lg-12 col-md-12">
          <h1 class="hem" style="font-size: 16px !important;"> ENREGISTREMENT DES PONTS BASCULES </h1><br>

          
          <form method="POST" >
                        <div>
                            
                       
                           
                       <center>

                        <?php $nav_pont=$bdd->query('SELECT navire,id from navire_deb'); ?>

                  <select id="navire_pont_bascule" class="mysel" name="produit" style=" height: 30px;  width: 40%; float: left;" data-role='goProduit_navire' >
                            <option value="" disabled="true" selected>selectionner produit</option>
                            <?php  while($nav_p=$nav_pont->fetch()){ ?>
                               <option   value=<?php echo $nav_p['id'] ?> ><?php echo $nav_p['navire']; ?> </option>
                             <?php  } ?>

  
                        </select>      
                      
                           <?php   ?>
                        <select id="produit_pont_bascule" class="mysel" name="produit" style=" height: 30px;  width: 40%; float: right;" data-role='goProduit_pont' >
                            <option value="" selected disabled="true" >selectionner produit</option>
                           

  
                        </select>
                         </center>
                        </div>
            
                 
              
          </form>
        
      </div>
    </div>
   </div> 
  
 
  </center>


  <center>
  <div class="container-fluid" style="width: 50%; display: none;" id='espace_situation'> 
 
    <div class="row">

      
       
        <div class="col-lg-12 col-md-12">
          <h1 class="hem" style="font-size: 16px !important;"> SITUATION DE DEBARQUEMENT </h1><br>

          
          <form method="POST" >
                        <div>
                            
                       
                           
                       <center>

                        <?php $nav_pont=$bdd->query('SELECT navire,id from navire_deb'); ?>

                  <select id="navire_situation" class="mysel" name="produit" style=" height: 30px;  width: 40%; float: left;" data-role='goNavire_situation' >
                            <option value="" disabled="true" selected>selectionner produit</option>
                            <?php  while($nav_p=$nav_pont->fetch()){ ?>
                               <option   value=<?php echo $nav_p['id'] ?> ><?php echo $nav_p['navire']; ?> </option>
                             <?php  } ?>

  
                        </select>      
                      
                           <?php   ?>
                        <select id="date_situation" class="mysel" name="produit" style=" height: 30px;  width: 40%; float: right;" data-role='goDate_situation' >
                            <option value="" disabled="true" selected>selectionner la date</option>
                           

  
                        </select>
                         </center>
                        </div>
            
                 
              
          </form>
        
      </div>
    </div>
   </div> 
  
 
  </center>





           <div class="container-fluid2 " id="main2" style="width: 100%; margin:0; ">
      <div class="row">
     
      </div>
     </div>

      <div class="container-fluid2 " id="tableau_situation" style="width: 100%; margin:0; ">
      <div class="row">
     
      </div>
     </div>   
           
<br>
<center>
  

    <center>
     <div class="container-fluid ">
      <div class="row">
             <div id="situationc">  
            <div id="situation" class="container-fluid1"   style=" background: rgb(162,205,219); display: none; width: 50%; " >
               <div class="row" >
                 <div class="col-lg-12 col-md-12">
                    <h1 class="hem2 text-white" style=" background: rgb(0,44,62); font-size: 30px; font-size: 14px !important;">SITUATIONS DU DEBARQUEMENT</h1><br>

                    
                    <form method="POST" >
                     <!--   <select  id="navires" class="mysel" style="margin-right: 15%; height: 30px;   width: 40%;"  onchange='goNavireSit()'> 
                            

                 </select> !-->
                        <?php $date_sit=date_situation($bdd,$navire_initiale); ?>
                     <select id="date" class="mysel" name="date" style="margin-right: 2%; height: 30px;  width: 40%;" data-role='goDateSit'>


                            <option value="" disabled="true" selected>selectionner la date</option>
                            <?php while($date_sits=$date_sit->fetch()){ 
                                 $date=explode('-', $date_sits['date_pont']);
                              ?>
                              <option  value=<?php echo $date_sits['date_pont']; ?> > <?php echo $date['2'].'-' .$date[1]. '-'.$date[0];  ?> </option>
                            <?php } ?>
                        </select>
                        
                 
                            
                    </form>
                
            </div>
        </div>
    </div>
   </div>
</div>
</div>
 </center>
    <div class="container-fluid2" id="sit">
      
    </div>


 
    
      <center>
     <div class="container-fluid ">
      <div class="row">
             <div id="facturec">  
            <div id="facturation" class="container-fluid1"   style=" background: rgb(162,205,219); display: none; width: 50%; " >
               <div class="row" >
                 <div class="col-lg-12 col-md-12">
                    <h1 class="hem2 text-white" style=" background: rgb(0,44,62); font-size: 30px; font-size: 14px !important;">TRANSPORT /FACTURATION</h1><br>
                       <?php $navire4=$bdd->query('select * from navire_deb'); ?>
                    

                    <form method="POST" >
                        <select  id="navirefacture" class="mysel" style="margin-right: 15%; height: 30px;   width: 40%;"  data-role='goNavireFacture'>
                            <option value="">selectionner un navire</option>
                            <?php 
                            while ($row=$navire4->fetch()) {
                             ?>
                                <option  value=<?php echo $row['id']; ?> ><?php echo $row['navire']; ?></option>
                            <?php } ?>
                             </select>

                 
                 
                            
                    </form>
                
            </div>
        </div>
    </div>
   </div>
</div>
</div>



<div class="container-fluid">
  <div class="row">
<div class="col-col-md-12 col-col-lg-12" id='liste_camion'>
     <div class="table table-responsive " id='table_liste_camion' style="display: none;">
      <center>
     <table class="table table-hover table-bordered  table-responsive table-striped" >
       <thead >
        <tr style="background: blue; color: white; vertical-align: middle; text-align: center;">
          <th>DATE</th>
          <th>HEURE</th>
          <th>NAVIRE</th>
         <th>PRODUIT</th>
         <th>BL</th>
         <th>CAMION</th>
         <th>CHAUFFEUR</th>
         <th>TEL</th>
         <th>SACS</th>
         <th>POIDS</th>
         <th>ACTIONS</th>
         </tr>
       </thead>
       <tbody id='body_liste_camion'></tbody>
     </table> 
</center>
     </div>
      
    </div>

<div class="modal fade" id="form_poids_pont" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog" style="max-width: 800px;">
    <div class="modal-content" >
      <div class="modal-header bg-primary">
        <center>
        <h2 class="modal-title fs-5 text-white text-center" id="exampleModalLabel " style="text-align:center; ">Pont Bascule</h2></center>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" >
               <center>
            <img class="logo" src="assets/images/mylogo.ico" style="border-radius: 50px;">

        </center>
        <form method="POST">
         

<div id='element_pont' class="row">
   <div class="mb-3">
           <label>BL</label>
        <input type="number" class="form-control"   name="sacm"  id="bl_pont"  value="0" 
    disabled="true" > <br>
       <label>NBRE DE SAC</label>
        <input type="number" class="form-control"   name="sacm"  id="nbre_sac_pont"   value="0" 
     disabled="true"> <br> 

    <label>TICKET PONT</label>
    <input type="number" class="form-control"   name="sacf"  id="ticket_pont"  value="0"
     >
     <br> 
     <label>POIDS BRUT VEHICULE</label>
    <input type="number" class="form-control"   name="sacm"  id="poids_pont"  value="0"
     oninput='calcul_poids_pont()'> <br> </div>
<div style="">
          <label>TARE VEHICULE</label>
    <input type="number" class="form-control"   name="sacm"  id="tare_vehicule"  value="0"
     oninput='calcul_poids_pont()' > <br> 

     

        <label>NET PONT BASCULE</label>
    <input type="text" class="form-control"   name="sacm"  id="net_pont"  value="0"
     disabled="true" style="background: black; color: white;"> <br>


     <?php /* $select_tare=$bdd->prepare('SELECT poids_tare_sac from tare_sac where id_produit_tare=? and poids_sac_tare=? and id_navire_tare=? and id_destination_tare=? and id_client_tare=?');
     $select_tare->bindParam(1,$produit);
     $select_tare->bindParam(2,$poids_sac);
     $select_tare->bindParam(3,$navire);
     $select_tare->bindParam(4,$destination);
     $select_tare->bindParam(5,$client);
     $select_tare->execute();
     $sel_tare=$select_tare->fetch(); */
      ?>

          <label>TARE SAC</label>
    <input type="number" class="form-control"   name="sacm"  id="val_tare_sac" disabled="true"  value="<?php  //echo $sel_tare['poids_tare_sac']; ?>"
    style="background: black; color: white;" > <br> 

         <label>NET MARCHAND</label>
    <input type="number" class="form-control"   name="sacm"  id="net_marchand"  value="0"
     disabled="true" style="background: black; color: white;"> <br>
</div>
  <div style="display: none;">
<input type="text" name="" id='produit_pont'>
<input type="text" name="" id='poids_sac_pont'>
<input type="text" name="" id='navire_pont'>
<input type="text" name="" id='destination_pont'>
<input type="text" name="" id='client_pont'>
   <input type="text" name="" id='id_pont'> </div>
 </div>




  
   <div class="mb-3">


        

         <center>
        <a id='btn_ajouter_pont' class="btn btn-primary" style="text-align: center;" name="valider_Avaries3" data-role="ajouter_poids_pont" >enregistrer</a>
    <a id='btn_modifier_pont' class="btn btn-primary " style="text-align: center;" name="valider_Avaries3" data-role="update_poids_pont" >enregistrer</a>
      </center>
        </div>
    

    
</form> 
</div>
       
      <div class="modal-footer">
 
        
      </div>
    
  
</div>
</div>






</center>
    <div class="container-fluid2" id="fact">

      
    </div>






      <center>
     <div class="container-fluid " >
      <div class="row">
             <div id="avariesc">  
            <div id="avaries_navire" class="container-fluid1"   style=" background: rgb(162,205,219); display: none; width: 50%; " >
               <div class="row" >
                 <div class="col-lg-12 col-md-12">
                    <h1 class="hem2 text-white" style=" background: rgb(0,44,62); font-size: 30px; font-size: 14px !important;">AVARIES DE DEBARQUEMENT</h1><br>
                       <?php $navire5=$bdd->query("select * from navire_deb where type='SACHERIE'"); ?>
                    

                    <form method="POST" >
                        <select  id="valeur_avaries_navire" class="mysel" style="margin-right: 15%; height: 30px;   width: 30%;"  data-role='goNavireAvaries'>
                            <option value="">selectionner un navire</option>
                            <?php 
                            while ($row=$navire5->fetch()) {
                             ?>
                                <option  value=<?php echo $row['id']; ?> ><?php echo $row['navire']; ?></option>
                            <?php } ?>
                             </select>

                             <select  id="valeur_produit_navire" class="mysel" style="margin-right: 5%; height: 30px;   width: 30%;"  data-role='goProduitNavireAvaries'>
                            <option value="">selectionner un produit</option>

                             </select>

                 
                 
                            
                    </form>
                
            </div>
        </div>
    </div>
   </div>
 </center>
    <div class="container-fluid2" id="espace_avaries">
      
    </div>
     </div>

   </div>


<center>
 <div class="container-fluid ">
      <div class="row">
             <div id="reconditionnementc">  
            <div id="reconditionnement" class="container-fluid1"   style=" background: rgb(162,205,219); display: none;  width: 50%; " >
               <div class="row" >
                 <div class="col-lg-12 col-md-12">
                    <h1 class="hem2 text-white" style=" background: rgb(0,44,62); font-size: 30px; font-size: 14px !important;">RECONDITIONNEMENT</h1><br>
                       <?php $navire5=$bdd->query("select * from navire_deb where type='SACHERIE'"); ?>
                    

                    <form method="POST" >
                        <select  id="valeur_recond_navire" class="mysel" style="margin-right: 15%; height: 30px;   width: 30%;"  data-role='goNavireRecond'>
                            <option value="">selectionner un navire</option>
                            <?php 
                            while ($row=$navire5->fetch()) {
                             ?>
                                <option  value=<?php echo $row['id']; ?> ><?php echo $row['navire']; ?></option>
                            <?php } ?>
                             </select>

                             <select  id="valeur_recond_produit_navire" class="mysel" style="margin-right: 5%; height: 30px;   width: 30%;"  data-role='goProduitNavireRecond'>
                            <option value="">selectionner un produit</option>

                             </select>

                 
                 
                            
                    </form>
                
            </div>
        </div>
    </div>
   </div>
 </center>
    <div class="container-fluid2" id="espace_reconditionnement">
      
    </div>
     </div>

   </div>




</div>
</div>
</div>



     
        
      


    <?php 
//111111111111111111111111111DEBUTPARTIE11111111111111111111111111111 
    //       PARTIE SITUATION DEBARQUEMENT
     ?>
     








        
		

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
							<a  class="author-footer">Ibradev</a>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="js/afficher_tableau_bl.js?=<?php echo time(); ?>"></script>
<script src="js/afficher_formulaire_bl.js?=<?php echo time(); ?>"></script>
<script src="js/afficher_liste_camion.js?=<?php echo time(); ?>"></script>
<script src="js/afficher_form_pont.js?=<?php echo time(); ?>"></script>
<script src="js/afficher_form_pont.js?=<?php echo time(); ?>"></script>
<script src="js/afficher_tableau_bl_pont.js?=<?php echo time(); ?>"></script>
<script src="js/choix_navire_pont.js?=<?php echo time(); ?>"></script>

<script src="js/transport/recherche_camion.js?=<?php echo time(); ?>"></script>
<script src="js/transport/recherche_remorque.js?=<?php echo time(); ?>"></script>
<script src="js/transport/recherche_chauffeur.js?=<?php echo time(); ?>"></script>

<script src="js/crud/ajouter_bl.js?=<?php echo time(); ?>"></script>
<script src="js/crud/delete_bl.js?=<?php echo time(); ?>"></script>
<script src="js/crud/modifier_bl.js?=<?php echo time(); ?>"></script>
<script src="js/crud/afficher_situation.js?=<?php echo time(); ?>"></script>
<script src="js/crud/ajout_poids_pont.js?=<?php echo time(); ?>"></script>
<script src="js/crud/update_bl_pont.js?=<?php echo time(); ?>"></script>
<script src="js/crud/update_pont.js?=<?php echo time(); ?>"></script>
<script src="js/crud/delete_bl_pont.js?=<?php echo time(); ?>"></script>

<script src="js/choix_navire_situation.js?=<?php echo time(); ?>"></script>

  <script type="text/javascript">
      function descendre_dernier_enregistrement(){
         var elements = document.querySelectorAll('#dernierEnregistrement');

    // Vérifier s'il y a des éléments correspondants
    if (elements.length > 0) {
        // Récupérer le dernier élément correspondant
        var lastElement = elements[elements.length - 1];

        // Récupérer la position de l'élément par rapport au haut de la page
        var position = lastElement.getBoundingClientRect().top + window.pageYOffset;

        // Faire défiler la page jusqu'à la position de l'élément
        window.scrollTo({
            top: position,
            behavior: 'smooth' // Pour un défilement fluide
        });
        }
      }
  </script> 

<script type="text/javascript"> 
// Sélectionnez le tableau et l'en-tête
function fixerEnTeteTableau() {
  const tableBody = document.querySelector('.table-body');
  const tableHeader = document.querySelector('.headers');

  tableHeader.style.left = fixed;
}



    </script>


 <script type="text/javascript"> 
     
    </script>


<script type="text/javascript">
 function camions_peses(){
  $('#espace_produit_pont').css('display','block');
  $('#liste_camion').css('display','none');
  $('#btn_camion_peses').css('background','yellow');
  $('#btn_camion_peses').css('color','blue');
  $('#main2').css('display','block');
   $('#tableau_situation').css('display','none');
    $('#espace_situation').css('display','none');

  $('#btn_situation').css('background','black');
  $('#btn_situation').css('color','white');
  $('#liste').css('background','black');
  $('#liste').css('color','white');
 }

  function situations(){
  $('#espace_situation').css('display','block');
  $('#tableau_situation').css('display','block');
  $('#main2').css('display','none');
   $('#espace_produit_pont').css('display','none');
  $('#liste_camion').css('display','none');
  $('#btn_situation').css('background','yellow');
  $('#btn_situation').css('color','blue');

  $('#btn_camion_peses').css('background','black');
  $('#btn_camion_peses').css('color','white');
  $('#liste').css('background','black');
  $('#liste').css('color','white');
 
 }

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
      function filtreca_m_rm() {
        var search = document.getElementById('myInput_m_rm').value;
        var camionList = document.getElementById('camionList_m_rm');
        camionList.style.display="block";
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'action_m_rm.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
          if (xhr.readyState === 4 && xhr.status === 200) {
            camionList.innerHTML = xhr.responseText;
          }
        };
        xhr.send('query=' + search);
      }

       function stockerIds_m_rm(element) {
    var camionId = element.id;
    var input2 = document.getElementById("val_input2_m_rm");
    input2.value = camionId;

   /* var camionText = element.innerText;
    var input = document.getElementById("myInput");
    input.value = camionText;
    var div = document.getElementById("camionList");
    div.style.display = "none"; */
    var camtext = document.getElementById("n_camions_m_rm"+camionId);
    var camionText = camtext.innerText;
    var input = document.getElementById("myInput_m_rm");
    input.value = camtext.innerText;
    var div = document.getElementById("camionList_m_rm");
    div.style.display = "none";

    var trtext = document.getElementById("transp_m_rm"+camionId);
     var transpText = trtext.innerText;
    var input3 = document.getElementById("myInputTransp_m_rm");
    input3.value = transpText;
     

    
  }
    </script>



<script type="text/javascript"> 
      function filtreChau_m_rm() {
        var search = document.getElementById('myInputc_m_rm').value;
        var camionList = document.getElementById('camionListc_m_rm');
        camionList.style.display="block";
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'action_chauffeur_m_rm.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
          if (xhr.readyState === 4 && xhr.status === 200) {
            camionList.innerHTML = xhr.responseText;
          }
        };
        xhr.send('query=' + search);
      }

        function stockerIdcm(element) {
    var camionId = element.id;
    var input2 = document.getElementById("val_input2c_m_rm");
    input2.value = camionId;

    var camionText = element.innerText;
    var input = document.getElementById("myInputc_m_rm");
    input.value = camionText;
    var div = document.getElementById("camionListc_m_rm");
    div.style.display = "none";

  input2.value = chauffeurId;

    
  }
    </script>



    <script type="text/javascript"> 
      function filtreca_m_av() {
        var search = document.getElementById('myInput_m_av').value;
        var camionList = document.getElementById('camionList_m_av');
        camionList.style.display="block";
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'action_m_av.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
          if (xhr.readyState === 4 && xhr.status === 200) {
            camionList.innerHTML = xhr.responseText;
          }
        };
        xhr.send('query=' + search);
      }

       function stockerIds_m_av(element) {
    var camionId = element.id;
    var input2 = document.getElementById("val_input2_m_av");
    input2.value = camionId;

   /* var camionText = element.innerText;
    var input = document.getElementById("myInput");
    input.value = camionText;
    var div = document.getElementById("camionList");
    div.style.display = "none"; */
    var camtext = document.getElementById("n_camions_m_av"+camionId);
    var camionText = camtext.innerText;
    var input = document.getElementById("myInput_m_av");
    input.value = camtext.innerText;
    var div = document.getElementById("camionList_m_av");
    div.style.display = "none";

    var trtext = document.getElementById("transp_m_av"+camionId);
     var transpText = trtext.innerText;
    var input3 = document.getElementById("myInputTransp_m_av");
    input3.value = transpText;
     

    
  }
    </script>


<script type="text/javascript"> 
      function filtreChau_m_av() {
        var search = document.getElementById('myInputc_m_av').value;
        var camionList = document.getElementById('camionListc_m_av');
        camionList.style.display="block";
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'action_chauffeur_m_av.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
          if (xhr.readyState === 4 && xhr.status === 200) {
            camionList.innerHTML = xhr.responseText;
          }
        };
        xhr.send('query=' + search);
      }

        function stockerIdcav(element) {
    var camionId = element.id;
    var input2 = document.getElementById("val_input2c_m_av");
    input2.value = camionId;

    var camionText = element.innerText;
    var input = document.getElementById("myInputc_m_av");
    input.value = camionText;
    var div = document.getElementById("camionListc_m_av");
    div.style.display = "none";

  input2.value = chauffeurId;

    
  }
    </script>




    <script type="text/javascript"> 
      function filtreca_m_vrac() {
        var search = document.getElementById('myInput_m_vrac').value;
        var camionList = document.getElementById('camionList_m_vrac');
        camionList.style.display="block";
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'action_m_vrac.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
          if (xhr.readyState === 4 && xhr.status === 200) {
            camionList.innerHTML = xhr.responseText;
          }
        };
        xhr.send('query=' + search);
      }

       function stockerIds_m_vrac(element) {
    var camionId = element.id;
    var input2 = document.getElementById("val_input2_m_vrac");
    input2.value = camionId;

   /* var camionText = element.innerText;
    var input = document.getElementById("myInput");
    input.value = camionText;
    var div = document.getElementById("camionList");
    div.style.display = "none"; */
    var camtext = document.getElementById("n_camions_m_vrac"+camionId);
    var camionText = camtext.innerText;
    var input = document.getElementById("myInput_m_vrac");
    input.value = camtext.innerText;
    var div = document.getElementById("camionList_m_vrac");
    div.style.display = "none";

    var trtext = document.getElementById("transp_m_vrac"+camionId);
     var transpText = trtext.innerText;
    var input3 = document.getElementById("myInputTransp_m_vrac");
    input3.value = transpText;
     

    
  }
    </script>



<script type="text/javascript"> 
      function filtreChau_m_vrac() {
        var search = document.getElementById('myInputc_m_vrac').value;
        var camionList = document.getElementById('camionListc_m_vrac');
        camionList.style.display="block";
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'action_chauffeur_m_vrac.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
          if (xhr.readyState === 4 && xhr.status === 200) {
            camionList.innerHTML = xhr.responseText;
          }
        };
        xhr.send('query=' + search);
      }

        function stockerIdcvrac(element) {
    var camionId = element.id;
    var input2 = document.getElementById("val_input2c_m_vrac");
    input2.value = camionId;

    var camionText = element.innerText;
    var input = document.getElementById("myInputc_m_vrac");
    input.value = camionText;
    var div = document.getElementById("camionListc_m_vrac");
    div.style.display = "none";

  input2.value = chauffeurId;

    
  }
    </script>

<script type="text/javascript"> 
      function filtreca_m_vrac0() {
        var search = document.getElementById('myInput_m_vrac0').value;
        var camionList = document.getElementById('camionList_m_vrac0');
        camionList.style.display="block";
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'action_m_vrac0.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
          if (xhr.readyState === 4 && xhr.status === 200) {
            camionList.innerHTML = xhr.responseText;
          }
        };
        xhr.send('query=' + search);
      }

       function stockerIds_m_vrac0(element) {
    var camionId = element.id;
    var input2 = document.getElementById("val_input2_m_vrac0");
    input2.value = camionId;

   /* var camionText = element.innerText;
    var input = document.getElementById("myInput");
    input.value = camionText;
    var div = document.getElementById("camionList");
    div.style.display = "none"; */
    var camtext = document.getElementById("n_camions_m_vrac0"+camionId);
    var camionText = camtext.innerText;
    var input = document.getElementById("myInput_m_vrac0");
    input.value = camtext.innerText;
    var div = document.getElementById("camionList_m_vrac0");
    div.style.display = "none";

    var trtext = document.getElementById("transp_m_vrac0"+camionId);
     var transpText = trtext.innerText;
    var input3 = document.getElementById("myInputTransp_m_vrac0");
    input3.value = transpText;
     

    
  }
    </script>



    <script type="text/javascript"> 
      function filtreChau_m_vrac0() {
        var search = document.getElementById('myInputc_m_vrac0').value;
        var camionList = document.getElementById('camionListc_m_vrac0');
        camionList.style.display="block";
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'action_chauffeur_m_vrac0.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
          if (xhr.readyState === 4 && xhr.status === 200) {
            camionList.innerHTML = xhr.responseText;
          }
        };
        xhr.send('query=' + search);
      }

        function stockerIdcvrac0(element) {
    var camionId = element.id;
    var input2 = document.getElementById("val_input2c_m_vrac0");
    input2.value = camionId;

    var camionText = element.innerText;
    var input = document.getElementById("myInputc_m_vrac0");
    input.value = camionText;
    var div = document.getElementById("camionListc_m_vrac0");
    div.style.display = "none";

  input2.value = chauffeurId;

    
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
                       // leselect2 = xhr.responseText;

                        document.getElementById('produit').innerHTML = leselect;
                        //document.getElementById('varier').innerHTML = leselect2;

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
                localStorage.setItem('idnavire', idnavire);
                xhr.send("idNavire="+idnavire);
            }

       
        </script>

        <script type='text/javascript'>

  /* mettre en commentaire
           $(document).ready(function(){
    $(document).on('change','select[data-role=goProduit]',function(){
  //$('#type').css('display', 'block');

    var idProduit = $('#produit').val();
    var transfert_sain = $('#transfert_sain').val();
    var transfert_des_avaries = $('#transfert_des_avaries').val();
    var avaries_de_deb = $('#avaries_de_deb').val();
     var statut=$('#input_statut').val();

   /*     if(transfert_sain==0){
          $('#input_statut').val('yess');
     
      
    } */

      //var type_dec = $('#type_dec').val();
/*

        $.ajax({
        url:'selectTable.php',
        method:'post',
        data:{idProduit:idProduit,transfert_sain:transfert_sain,transfert_des_avaries:transfert_des_avaries,avaries_de_deb:avaries_de_deb,statut:statut},
        success: function(response){
            $('#main').html(response);
           
     
       
        }
    });


 

  });
});
 */

  

            
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
                        document.getElementById('date').innerHTML = ladate;

                    }
                }
 
                // Ici on va voir comment faire du post
                xhr.open("POST","date_sit.php",true);
                // ne pas oublier ça pour le post
                xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
                // ne pas oublier de poster les arguments
                // ici, l'id de l'auteur
                sel = document.getElementById('navires');
                idnavires = sel.options[sel.selectedIndex].value;
                xhr.send("idNavires="+idnavires);
            }
        </script>


        <script type='text/javascript'>
 

        </script>  
         <script type='text/javascript'>

   
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




</script>






<script type="text/javascript">




</script>







<script type="text/javascript">


    $(document).ready(function(){
    $(document).on('click','a[data-role=btn_transfert_avaries]',function(){
        
   // Mettre à jour le texte de l'option existante
  

        
        
  
        var dates = $('#datetrav').val();
        //date=date.replace(' ','');
        var heure = $('#heuretrav').val();
        var navire = $('#naviretrav').val();
       // var type = $('#typesain').val();
        var bl = $('#bltrav').val();
        var poids_sac = $('#poids_sactrav').val();
        var declaration = $('#declarationtrav').val();
        var cale = $('#caletrav').val();
        var id_dis = $('#id_distrav').val();
        var client = $('#clienttrav').val();
        var mangasin = $('#mangasintrav').val();
        var destinataire = $('#destinatairetrav').val();
        var autre_destinataire = $('#autre_destinatairetrav').val();
        var val_input3 = $('#val_input3').val();
        var val_input3c = $('#val_input3c').val();
        var sacf = $('#sacftrav').val();
        var sacm = $('#sacmtrav').val();
        var poidsf = $('#poidsftrav').val();
        var poidsm = $('#poidsmtrav').val();
        var id_produit = $('#produittrav').val();
        $('#enregistrement_transfert').modal('toggle');
  
        
        $.ajax({
        url:'ajouttransfertavaries.php',
        method:'post',
        data:{dates:dates,heure:heure,navire:navire,poids_sac:poids_sac,declaration:declaration,client:client,mangasin:mangasin,destinataire:destinataire,val_input3:val_input3,val_input3c:val_input3c,sacf:sacf,poidsf:poidsf,sacm:sacm,poidsm:poidsm,cale:cale,id_dis:id_dis,bl:bl,id_produit:id_produit,autre_destinataire:autre_destinataire},
        success: function(response){
            $('#TableAvariesTrans').html(response);

        
        }
    });
    });
});

</script>




<script type="text/javascript">


    $(document).ready(function(){
    $(document).on('click','a[data-role=btn_avaries_debarquement]',function(){
        
   // Mettre à jour le texte de l'option existante
  

        
        
  
        var dates = $('#dateavdeb').val();
        //date=date.replace(' ','');
       // var heure = $('#heuretrav').val();
        var navire = $('#navireavdeb').val();
       // var type = $('#typesain').val();
       // var bl = $('#bltrav').val();
        var poids_sac = $('#poids_sacavdeb').val();
       // var declaration = $('#declarationtrav').val();
      //  var cale = $('#caleavdeb').val();

        var cale = $('#cale_pour_avaries').val();
        var id_dis = $('#id_disavdeb').val();
       // var client = $('#clienttrav').val();
     //   var mangasin = $('#mangasintrav').val();
       // var destinataire = $('#destinatairetrav').val();
      //  var autre_destinataire = $('#autre_destinatairetrav').val();
      //  var val_input3 = $('#val_input3').val();
      //  var val_input3c = $('#val_input3c').val();
        var sacf = $('#sacfavdeb').val();
        var sacm = $('#sacmavdeb').val();
       // var poidsf = $('#poidsftrav').val();
      //  var poidsm = $('#poidsmtrav').val();
        var id_produit = $('#produitavdeb').val();
        $('#Les_avaries2').modal('toggle');
  
        
        $.ajax({
        url:'ajoutavariesdebarquement.php',
        method:'post',
        data:{dates:dates,navire:navire,poids_sac:poids_sac,sacf:sacf,sacm:sacm,cale:cale,id_dis:id_dis,id_produit:id_produit},
        success: function(response){
            $('#avaries_debarquement').html(response);

        
        }
    });
    });
});

</script>







<script type="text/javascript">


    $(document).ready(function(){
    $(document).on('click','a[data-role=btn_situation_sacherie]',function(){
        
   // Mettre à jour le texte de l'option existante
 
        var formData = $('#myForm').serializeArray();
        $('#Les_avaries').modal('toggle');
        
        $.ajax({
            url: 'ajoutsituation24H.php',
            method: 'post',
            data: formData,
            success: function(response) {
              //  $('#main').html(response);        
        }
    });
    });
});

</script>



















<script type="text/javascript">


    $(document).ready(function(){
    $(document).on('click','a[data-role=update_avaries_deb]',function(){
        var id = $(this).data('id');
        var date = $('#'+id+'date_avaries_deb').text();
        var id_navire = $('#'+id+'id_navire_avaries_deb').text();
        var id_cale = $('#'+id+'id_cale_avaries_deb').text();
         var cale = $('#'+id+'cale_avaries_deb').text();
        
        var sacf = $('#'+id+'flasque_avaries_deb').text();
        var sacm = $('#'+id+'mouille_avaries_deb').text();
        var id_dis = $('#'+id+'id_dis_avaries_deb').text();
        var poids_sac = $('#'+id+'conditionnement_avaries_deb').text();
         var produit = $('#'+id+'produit_avaries_deb').text();
        
        var existingOptioncale = $('#cale_avdeb option[value="' + id_cale + '"]');
if (existingOptioncale.length > 0) {
   // Mettre à jour le texte de l'option existante
   existingOptioncale.text(cale);
} else {
   // Ajouter une nouvelle option avec la valeur et le texte correspondants
   var newOption = $('<option>', {
      value: id_cale,
      text: cale
   });
   $('#cale_avdeb').prepend(newOption);
   // Sélectionner l'option par défaut
   newOption.prop('selected', true);
} 

        $('#cale_avdeb').val(id_cale);
        $('#date_avdeb').val(date);
        $('#sacf_avdeb').val(sacf);
        $('#sacm_avdeb').val(sacm);
         $('#id_avdeb').val(id);
          $('#id_navire_avdeb').val(id_navire);
          $('#id_dis_avdeb').val(id_dis);
           $('#poids_sac_avdeb').val(poids_sac);
           $('#produit_avdeb').val(produit);
    

        
        $('#modif_avaries_deb').modal('toggle');
    });
    
    
</script>


<script type="text/javascript">

/*
    $(document).ready(function(){
    $(document).on('click','a[data-role=update_avaries_deb2]',function(){
        var id = $(this).data('id');
        var date = $('#'+id+'date_avaries_deb').text();
        var id_navire = $('#'+id+'id_navire_avaries_deb').text();
        
        var sacf = $('#'+id+'flasque_avaries_deb').text();
        var sacm = $('#'+id+'mouille_avaries_deb').text();
        $('#date_avdeb2').val(date);
        $('#sacf_avdeb2').val(sacf);
        $('#sacm_avdeb2').val(sacm);
         $('#id_avdeb2').val(id);
          $('#id_navire_avdeb2').val(id_navire);
    

        
        $('#modif_avaries_deb2').modal('toggle');
    });
    
    $('#mod_avaries_deb2').click(function(){
      var date=  $('#date_avdeb2').val();
          date.replace(' ','');
      var sacf=  $('#sacf_avdeb2').val();
      var sacm= $('#sacm_avdeb2').val();
      var id= $('#id_avdeb2').val();
      var id_navire=  $('#id_navire_avdeb2').val();
       // $('#frontend').css('display', 'none');

        
        $.ajax({
        url:'modifier_avaries_deb2.php',
        method:'post',
        data:{date:date,id:id,sacf:sacf,sacm:sacm,id_navire:id_navire},
        success: function(response){
            $('#avaries_debarquement').html(response);

        $('#modif_avaries_deb2').modal('toggle');
        }
    });
    });
});

*/

</script>









<script type="text/javascript">
    
function scrollToTopOfDiv() {
  var element = $('#TableSain');
  
 
var offset = element.offset();
  $(
 
'html, body').animate({ scrollTop: offset.top }, 'slow');
}

</script>





<script type="text/javascript">


    $(document).ready(function(){
    $(document).on('click','a[data-role=update_register_avaries]',function(){
        var id = $(this).data('id');
        var date = $('#'+id+'date_av').text();
        var heure = $('#'+id+'heure_av').text();
        var bl = $('#'+id+'bl_av').text();
        var sacf = $('#'+id+'sacf_av').text();
        var sacm = $('#'+id+'sacm_av').text();
        var poidsf = $('#'+id+'poidsf_av').text();
        var poidsm = $('#'+id+'poidsm_av').text();
        var camion = $('#'+id+'camion_av').text();
        var transport = $('#'+id+'transporteur_av').text();
        var chauffeur = $('#'+id+'chauffeur_av').text();
        var id_camion = $('#'+id+'id_camion_av').text();
        var id_chauffeur = $('#'+id+'id_chauffeur_av').text();
        var id_declaration = $('#'+id+'id_declaration_av').text();
        var declaration = $('#'+id+'declaration_av').text();
       // var cale = $('#'+id+'cale_av').text();
       // var id_cale = $('#'+id+'id_cale_av').text();
        var dis_bl = $('#'+id+'dis_bl_av').text();
        var poids_sac = $('#'+id+'poids_sac_av').text();
         var id_destination = $('#'+id+'id_destination_av').text();
         var id_navire = $('#'+id+'id_navire_av').text();
         var id_produit = $('#'+id+'id_produit_av').text();



           var existingOption = $('#declaration_m_av option[value="' + id_declaration + '"]');
if (existingOption.length > 0) {
   // Mettre à jour le texte de l'option existante
   existingOption.text(declaration);
} else {
   // Ajouter une nouvelle option avec la valeur et le texte correspondants
   var newOption = $('<option>', {
      value: id_declaration,
      text: declaration
   });
   $('#declaration_m_av').prepend(newOption);
   // Sélectionner l'option par défaut
   newOption.prop('selected', true);
}

/*
var existingOptioncale = $('#cale_m_av option[value="' + id_cale + '"]');
if (existingOptioncale.length > 0) {
   // Mettre à jour le texte de l'option existante
   existingOptioncale.text(cale);
} else {
   // Ajouter une nouvelle option avec la valeur et le texte correspondants
   var newOption = $('<option>', {
      value: id_cale,
      text: cale
   });
   $('#cale_m_av').prepend(newOption);
   // Sélectionner l'option par défaut
   newOption.prop('selected', true);
} 

         $('#cale_m_av').val(id_cale); */
         $('#declaration_m_av').val(id_declaration);
         $('#date_m_av').val(date);
        
        $('#bl_m_av').val(bl);
        $('#sacf_m_av').val(sacf);
        $('#poidsf_m_av').val(poidsf);
         $('#sacm_m_av').val(sacm);
        $('#poidsm_m_av').val(poidsm);
        $('#myInput_m_av').val(camion);
        $('#myInputTransp_m_av').val(transport);
        $('#myInputc_m_av').val(chauffeur);
        $('#val_input2_m_av').val(id_camion);
        $('#val_input2c_m_av').val(id_chauffeur);
        $('#dis_bl_m_av').val(dis_bl);
        $('#poids_sac_m_av').val(poids_sac);
         $('#id_destination_m_av').val(id_destination);
         $('#id_navire_m_av').val(id_navire);
         $('#id_produit_m_av').val(id_produit);

        $('#id_m_av').val(id);
                        

        $('#heure_m_av').val(heure);
        
        $('#modif_register_avaries').modal('toggle');
    });
    
    $('#mod_avaries').click(function(){
        var date = $('#date_m_av').val();
       date=date.replace(' ','');
        var heure = $('#heure_m_av').val();
     var declaration = $('#declaration_m_av').val();
       // var id_cale = $('#cale_m_av').val();
        var camion = $('#val_input2_m_av').val();
        var chauffeur = $('#val_input2c_m_av').val();
        var bl = $('#bl_m_av').val();
        var sacf = $('#sacf_m_av').val();
        var sacm = $('#sacm_m_av').val();
        var poidsf = $('#poidsf_m_av').val();
        var poidsm = $('#poidsm_m_av').val();
        var dis_bl = $('#dis_bl_m_av').val();
        var poids_sac = $('#poids_sac_m_av').val();
        var id_destination=$('#id_destination_m_av').val();
         var id_navire=$('#id_navire_m_av').val();
         var id_produit=$('#id_produit_m_av').val();
     
            var id = $('#id_m_av').val();
        

        
        $.ajax({
        url:'modification_avaries.php',
        method:'post',
        data:{date:date,heure:heure,declaration:declaration,/*id_cale:id_cale,*/camion:camion,chauffeur:chauffeur,bl:bl,id:id,dis_bl:dis_bl,sacf:sacf,sacm:sacm,poidsf:poidsf,poidsm:poidsm,poids_sac:poids_sac,id_destination:id_destination,id_navire:id_navire,id_produit:id_produit},
        success: function(response){
            $('#tr_avariess').html(response);

        $('#modif_register_avaries').modal('toggle');
        
        }
    });
    });
});

</script>




<script type="text/javascript">


    $(document).ready(function(){
    $(document).on('click','a[data-role=update_register_vrac]',function(){
        var id = $(this).data('id');
        var date = $('#'+id+'date_rm').text();
        var heure = $('#'+id+'heure_rm').text();
        var bl = $('#'+id+'bl_rm').text();
        var sac = $('#'+id+'sac_rm').text();
        var poids = $('#'+id+'poids_rm').text();
        var camion = $('#'+id+'camion_rm').text();
        var transport = $('#'+id+'transporteur_rm').text();
        var chauffeur = $('#'+id+'chauffeur_rm').text();
        var id_camion = $('#'+id+'id_camion_rm').text();
        var id_chauffeur = $('#'+id+'id_chauffeur_rm').text();
        var id_declaration = $('#'+id+'id_declaration_rm').text();
        var declaration = $('#'+id+'declaration_rm').text();
        var cale = $('#'+id+'cale_rm').text();
        var dis_bl = $('#'+id+'dis_bl_rm').text();
        var poids_sac = $('#'+id+'poids_sac_rm').text();


           var existingOption = $('#declaration_m_rm option[value="' + id_declaration + '"]');
if (existingOption.length > 0) {
   // Mettre à jour le texte de l'option existante
   existingOption.text(declaration);
} else {
   // Ajouter une nouvelle option avec la valeur et le texte correspondants
   var newOption = $('<option>', {
      value: id_declaration,
      text: declaration
   });
   $('#declaration_m_vrac').prepend(newOption);
   // Sélectionner l'option par défaut
   newOption.prop('selected', true);
}

var existingOptioncale = $('#declaration_m_vrac option[value="' + cale + '"]');
if (existingOptioncale.length > 0) {
   // Mettre à jour le texte de l'option existante
   existingOptioncale.text(cale);
} else {
   // Ajouter une nouvelle option avec la valeur et le texte correspondants
   var newOption = $('<option>', {
      value: cale,
      text: cale
   });
   $('#cale_m_vrac').prepend(newOption);
   // Sélectionner l'option par défaut
   newOption.prop('selected', true);
}

         $('#cale_m_vrac').val(cale);
         $('#declaration_m_vrac').val(id_declaration);
         $('#date_m_vrac').val(date);
        $('#heure_m_vrac').val(heure);
        $('#bl_m_vrac').val(bl);
        $('#sac_m_vrac').val(sac);
        $('#poids_m_vrac').val(poids);
        $('#myInput_m_vrac').val(camion);
        $('#myInputTransp_m_vrac').val(transport);
        $('#myInputc_m_vrac').val(chauffeur);
        $('#val_input2_m_vrac').val(id_camion);
        $('#val_input2c_m_vrac').val(id_chauffeur);
        $('#dis_bl_m_vrac').val(dis_bl);
        $('#poids_sac_m_vrac').val(poids_sac);

        $('#id_m_vrac').val(id);



        
        $('#modif_register_vrac').modal('toggle');
    });
    
    $('#mod_vrac').click(function(){
        var date = $('#date_m_vrac').val();
        date=date.replace(' ','');
        var heure = $('#heure_m_vrac').val();
        var declaration = $('#declaration_m_vrac').val();
        var cale = $('#cale_m_vrac').val();
        var camion = $('#val_input2_m_vrac').val();
        var chauffeur = $('#val_input2c_m_vrac').val();
        var bl = $('#bl_m_vrac').val();
        var sac = $('#sac_m_vrac').val();
            sac =sac.replace(' ','');
        var poids = $('#poids_m_vrac').val();
        var dis_bl = $('#dis_bl_m_vrac').val();
        var poids_sac = $('#poids_sac_m_vrac').val();
     
            var id = $('#id_m_vrac').val();
            $('#frontend').css('display', 'none');
        

        
        $.ajax({
        url:'modification_vrac.php',
        method:'post',
        data:{date:date,heure:heure,declaration:declaration,cale:cale,camion:camion,chauffeur:chauffeur,bl:bl,id:id,dis_bl:dis_bl,sac:sac,poids_sac:poids_sac,poids:poids},
        success: function(response){
            $('#TableSain').html(response);

        $('#modif_register_vrac').modal('toggle');
        }
    });
    });
});

</script>





<script type="text/javascript">


    $(document).ready(function(){
    $(document).on('click','a[data-role=update_register_vrac0]',function(){
        var id = $(this).data('id');
        var date = $('#'+id+'date_rm').text();
        var heure = $('#'+id+'heure_rm').text();
        var bl = $('#'+id+'bl_rm').text();
    
        var poids = $('#'+id+'poids_rm').text();
        var camion = $('#'+id+'camion_rm').text();
        var transport = $('#'+id+'transporteur_rm').text();
        var chauffeur = $('#'+id+'chauffeur_rm').text();
        var id_camion = $('#'+id+'id_camion_rm').text();
        var id_chauffeur = $('#'+id+'id_chauffeur_rm').text();
        var id_declaration = $('#'+id+'id_declaration_rm').text();
        var declaration = $('#'+id+'declaration_rm').text();
        var cale = $('#'+id+'cale_rm').text();
        var dis_bl = $('#'+id+'dis_bl_rm').text();
        var poids_sac = $('#'+id+'poids_sac_rm').text();


           var existingOption = $('#declaration_m_rm option[value="' + id_declaration + '"]');
if (existingOption.length > 0) {
   // Mettre à jour le texte de l'option existante
   existingOption.text(declaration);
} else {
   // Ajouter une nouvelle option avec la valeur et le texte correspondants
   var newOption = $('<option>', {
      value: id_declaration,
      text: declaration
   });
   $('#declaration_m_vrac0').prepend(newOption);
   // Sélectionner l'option par défaut
   newOption.prop('selected', true);
}

var existingOptioncale = $('#declaration_m_vrac option[value="' + cale + '"]');
if (existingOptioncale.length > 0) {
   // Mettre à jour le texte de l'option existante
   existingOptioncale.text(cale);
} else {
   // Ajouter une nouvelle option avec la valeur et le texte correspondants
   var newOption = $('<option>', {
      value: cale,
      text: cale
   });
   $('#cale_m_vrac0').prepend(newOption);
   // Sélectionner l'option par défaut
   newOption.prop('selected', true);
}

         $('#cale_m_vrac0').val(cale);
         $('#declaration_m_vrac0').val(id_declaration);
         $('#date_m_vrac0').val(date);
        $('#heure_m_vrac0').val(heure);
        $('#bl_m_vrac0').val(bl);
        
        $('#poids_m_vrac0').val(poids);
        $('#myInput_m_vrac0').val(camion);
        $('#myInputTransp_m_vrac0').val(transport);
        $('#myInputc_m_vrac0').val(chauffeur);
        $('#val_input2_m_vrac0').val(id_camion);
        $('#val_input2c_m_vrac0').val(id_chauffeur);
        $('#dis_bl_m_vrac0').val(dis_bl);
        $('#poids_sac_m_vrac0').val(poids_sac);

        $('#id_m_vrac0').val(id);


        
        $('#modif_register_vrac0').modal('toggle');
    });
    
    $('#mod_vrac0').click(function(){
        var date = $('#date_m_vrac0').val();
        //date=date.replace(' ','');
        var heure = $('#heure_m_vrac0').val();
        var declaration = $('#declaration_m_vrac0').val();
        var cale = $('#cale_m_vrac0').val();
        var camion = $('#val_input2_m_vrac0').val();
        var chauffeur = $('#val_input2c_m_vrac0').val();
        var bl = $('#bl_m_vrac0').val();
        
        var poids = $('#poids_m_vrac0').val();
        var dis_bl = $('#dis_bl_m_vrac0').val();
        var poids_sac = $('#poids_sac_m_vrac0').val();
     
            var id = $('#id_m_vrac0').val();
            $('#frontend').css('display', 'none');
        

        
        $.ajax({
        url:'modification_vrac0.php',
        method:'post',
        data:{date:date,heure:heure,declaration:declaration,cale:cale,camion:camion,chauffeur:chauffeur,bl:bl,id:id,dis_bl:dis_bl,poids_sac:poids_sac,poids:poids},
        success: function(response){
            $('#TableSain').html(response);

        $('#modif_register_vrac0').modal('toggle');
        }
    });
    });
});

</script>




<script type="text/javascript">


    $(document).ready(function(){
    $(document).on('click','a[data-role=fermer]',function(){
        $('#LesErreurs').css('display', 'none');
    });
    
    
});

</script>

<script type="text/javascript">


    $(document).ready(function(){
    $(document).on('click','a[data-role=fermerVIDES]',function(){
        $('#LesErreursVIDES').css('display', 'none');
    });
    
    
});

</script>





<script type="text/javascript">
  function deleteAjax2m(id){
   
       if(confirm('Voulez vous vraiment supprimer ce donnée?')){
        var dis_bl = $('#'+id+'dis_bl_rm').text();
         //var navire=navires.text();
         //$("#masquage").hide();
         $('#frontend').css('display', 'none');

         
         $.ajax({

              type:'post',
              url:'delete2m.php',
              data:{delete_id:id,dis_bl:dis_bl},
              success:function(response){
              
                   $('#main').html(response);
                   scrollToTopOfDiv();

              }

         });

       }


     }

 


 </script>



 <script type="text/javascript">
  function delete_avaries_deb(id){
   
       if(confirm('Voulez vous vraiment supprimer ce donnée?')){
        var id_navire = $('#'+id+'id_navire_avaries_deb').text();
         var poids_sac = $('#'+id+'conditionnement_avaries_deb').text();
         var produit = $('#'+id+'produit_avaries_deb').text();
         var id_dis = $('#'+id+'id_dis_avaries_deb').text();
         //var navire=navires.text();
         //$("#masquage").hide();
         //$('#frontend').css('display', 'none');
         
         $.ajax({

              type:'post',
              url:'delete_avaries_deb.php',
              data:{delete_id:id,id_navire:id_navire,id_dis:id_dis,poids_sac:poids_sac,produit:produit},
              success:function(response){
              
                   $('#avaries_debarquement').html(response);

              }

         });

       }


     }

 


 </script>


 <script type="text/javascript">
  function delete_avaries_deb2(id){
   
       if(confirm('Voulez vous vraiment supprimer ce donnée?')){
        var id_navire = $('#'+id+'id_navire_avaries_deb').text();
        var date = $('#'+id+'date_avaries_deb').text();
         //var navire=navires.text();
         //$("#masquage").hide();
         //$('#frontend').css('display', 'none');
         
         $.ajax({

              type:'post',
              url:'delete_avaries_deb2.php',
              data:{delete_id:id,id_navire:id_navire,date:date},
              success:function(response){
              
                   $('#avaries_debarquement').html(response);

              }

         });

       }


     }

 


 </script>





 <script type="text/javascript">
  function deleteAvaries(id){
   
       if(confirm('Voulez vous vraiment supprimer ce donnée?')){
        var dis_bl = $('#'+id+'disbl').text();
        var poids_sac = $('#'+id+'poids_sac_av').text();
         var id_destination = $('#'+id+'id_destination_av').text();
         var id_navire = $('#'+id+'id_navire_av').text();
         var id_produit = $('#'+id+'id_produit_av').text();
         //var navire=navires.text();
        // $("#tr_avaries").hide();
         
         $.ajax({

              type:'post',
              url:'delete_avaries.php',
              data:{delete_id:id,dis_bl:dis_bl,poids_sac:poids_sac,id_destination:id_destination,id_navire:id_navire,id_produit:id_produit},
              success:function(response){
              
                   $('#tr_avariess').html(response);

              }

         });

       }


     }

 


 </script>


<script type="text/javascript">
    /*
  function deleteAjax(id){
   
       if(confirm('Voulez vous vraiment supprimer ce donnée?')){
        var dis_bl = $('#'+id+'dis_bl_rm').text();
        var poids_sac = $('#'+id+'poids_sac_rm').text();
        var id_produit = $('#'+id+'id_produit_rm').text();
        var id_destination = $('#'+id+'id_destination_rm').text();
        var id_navire = $('#'+id+'id_navire_rm').text();
         var id_declaration = $('#'+id+'id_declaration_rm').text();
         var statut= $('#'+id+'statut_rm').text();
         var transfert_sain=$('#transfert_sain').val();

         //var navire=navires.text();
         
         $.ajax({

              type:'post',
              url:'delete.php',
              data:{delete_id:id,dis_bl:dis_bl,poids_sac:poids_sac,id_produit:id_produit,id_destination:id_destination,id_navire:id_navire,id_declaration:id_declaration,statut:statut,transfert_sain:transfert_sain},
              success:function(response){
              
                   $('#TableSain').html(response);

              }

         });

       }


     } */


   

 


 </script>


<script>
  $(document).ready(function () {
        $(document).on('click', 'button[data-role=VisibleSain]', function () {

    var sain = document.getElementById("TableSain");
    var deb = document.getElementById("TableAvariesTrans");
   // var rep = document.getElementById("avaries_debarquement");

            //var rep = document.getElementById("transfert_sain");

    $('#transfert_sain').val(1);
    $('#transfert_des_avaries').val(0);
   // $('#avaries_de_deb').val(0);

    
      sain.style.display = "block";
     deb.style.display = "none";
    //  rep.style.display = "none";
   
  
    

       sain.scrollIntoView({ behavior: 'smooth' });
     
   
    
     var statut='sain';
    var navire = $('#input_navire').val();
    var produit = $('#input_produit').val();
    var destination = $('#input_destination').val();
    var poids_sac = $('#input_poids_sac').val();
     var client = $('#input_client').val();
    var transfert_sain=$('#transfert_sain').val();
    var transfert_des_avaries=$('#transfert_des_avaries').val();
  //  var avaries_de_deb=$('#avaries_de_deb').val();
    var poids_kg=$('#input_poids_sac').val();
    
    
    
    $('#input_statut').val(statut);
    $('#input_statut_new').val(statut);

        if(poids_kg!=0){
      $('#poids_cacher').css('display','none');
       $('#sac_cacher').css('display','block');
    }
           else{
  $('#sac_cacher').css('display','none');
      $('#poids_cacher').css('display','block');
    }


                $.ajax({
        url:'recuperer_statut_avaries2.php',
        method:'post',
        data:{statut:statut,navire:navire,produit:produit,destination:destination,poids_sac:poids_sac,transfert_sain:transfert_sain,transfert_des_avaries:transfert_des_avaries,client:client},
        success: function(response){

            $('#TableSain').html(response);
          }
          });
  });
  });


  $(document).ready(function () {
        $(document).on('click', 'button[data-role=VisibleMouille]', function () {

    var sain = document.getElementById("TableSain");
    var deb = document.getElementById("TableAvariesTrans");
    //var rep = document.getElementById("avaries_debarquement");

            //var rep = document.getElementById("transfert_sain");

    $('#transfert_sain').val(1);
    $('#transfert_des_avaries').val(0);
   // $('#avaries_de_deb').val(0);

    
      sain.style.display = "block";
      deb.style.display = "none";
    //  rep.style.display = "none";
   
  
    

       sain.scrollIntoView({ behavior: 'smooth' });
     
   
    
     var statut='mouille';
    var navire = $('#input_navire').val();
    var produit = $('#input_produit').val();
    var destination = $('#input_destination').val();
    var poids_sac = $('#input_poids_sac').val();
    var transfert_sain=$('#transfert_sain').val();
    var transfert_des_avaries=$('#transfert_des_avaries').val();
  //  var avaries_de_deb=$('#avaries_de_deb').val();
    var poids_kg=$('#input_poids_kg');
    
    $('#input_statut').val(statut);
    $('#input_statut_new').val(statut);

    if(poids_sac!=0){
      $('#poids_cacher').css('display','none');
    }


                $.ajax({
        url:'recuperer_statut_avaries2.php',
        method:'post',
        data:{statut:statut,navire:navire,produit:produit,destination:destination,poids_sac:poids_sac,transfert_sain:transfert_sain,transfert_des_avaries:transfert_des_avaries},
        success: function(response){

            $('#TableSain').html(response);
          }
          });
  });
  });


  $(document).ready(function () {
        $(document).on('click', 'button[data-role=VisibleFlasque]', function () {

    var sain = document.getElementById("TableSain");
    var deb = document.getElementById("TableAvariesTrans");
   //var rep = document.getElementById("avaries_debarquement");

            //var rep = document.getElementById("transfert_sain");

    $('#transfert_sain').val(1);
  //  $('#transfert_des_avaries').val(0);
   // $('#avaries_de_deb').val(0);

    
      sain.style.display = "block";
   //   deb.style.display = "none";
    //  rep.style.display = "none";
   
  
    

       sain.scrollIntoView({ behavior: 'smooth' });
     
   
    
     var statut='flasque';
    var navire = $('#input_navire').val();
    var produit = $('#input_produit').val();
    var destination = $('#input_destination').val();
    var poids_sac = $('#input_poids_sac').val();
    var transfert_sain=$('#transfert_sain').val();
    var transfert_des_avaries=$('#transfert_des_avaries').val();
 //   var avaries_de_deb=$('#avaries_de_deb').val();
    var poids_kg=$('#input_poids_kg');
    
    $('#input_statut').val(statut);
    $('#input_statut_new').val(statut);
    $('#poids_cacher').css('display','block');



                $.ajax({
        url:'recuperer_statut_avaries2.php',
        method:'post',
        data:{statut:statut,navire:navire,produit:produit,destination:destination,poids_sac:poids_sac,transfert_sain:transfert_sain,transfert_des_avaries:transfert_des_avaries},
        success: function(response){

            $('#TableSain').html(response);
          }
          });
  });
  });
function cacher_input_poids(){
  var statut=$('#input_statut_new').val();
  if(staut=='flasque'){
    $("#poids_cacher").css('display','none');
  }
}
cacher_input_poids();

</script>


<script>
  function visibleAvariesDeb() {
    var sain = document.getElementById("TableSain");
    var deb = document.getElementById("TableAvariesTrans");
    var rep = document.getElementById("avaries_debarquement");

        $('#transfert_sain').val(1);
    $('#transfert_des_avaries').val(0);
    $('#avaries_de_deb').val(0);

  
      rep.style.display = "none";
      sain.style.display = "table";
      deb.style.display = "none";
     
     

       rep.scrollIntoView({ behavior: 'smooth' });

     var statut='mouille';
    var navire = $('#input_navire').val();
    var produit = $('#input_produit').val();
    var destination = $('#input_destination').val();
    var poids_sac = $('#input_poids_sac').val();
    var transfert_sain=$('#transfert_sain').val();
 $('#poids_cacher').css('display','none');

    $('#input_statut').val(statut);


                $.ajax({
        url:'recuperer_statut_avaries.php',
        method:'post',
        data:{statut:statut,navire:navire,produit:produit,destination:destination,poids_sac:poids_sac,transfert_sain:transfert_sain},
        success: function(response){

            $('#TableSain').html(response);
          }
          });
    
  }


  function visibleAvariesRep() {
    var sain = document.getElementById("TableSain");
    var deb = document.getElementById("TableAvariesTrans");
    var rep = document.getElementById("avaries_debarquement");

        $('#transfert_sain').val(0);
    $('#transfert_des_avaries').val(0);
    $('#avaries_de_deb').val(1);

  
      rep.style.display = "table";
      sain.style.display = "none";
      deb.style.display = "none";
     
     

       rep.scrollIntoView({ behavior: 'smooth' });

   
    
  }
</script>

<script>
  function visibleAvariesTrans() {
    var sain = document.getElementById("TableSain");
    var deb = document.getElementById("TableAvariesTrans");
    var rep = document.getElementById("avaries_debarquement");

    $('#transfert_sain').val(1);
    $('#transfert_des_avaries').val(0);
    $('#avaries_de_deb').val(0);


    
      deb.style.display = "none";
      rep.style.display = "none";
      sain.style.display = "table";
     
     

       deb.scrollIntoView({ behavior: 'smooth' });
     
        var statut='flasque';
    var navire = $('#input_navire').val();
    var produit = $('#input_produit').val();
    var destination = $('#input_destination').val();
    var poids_sac = $('#input_poids_sac').val();
    var transfert_sain=$('#transfert_sain').val();
 $('#poids_cacher').css('display','block');

    $('#input_statut').val(statut);


                $.ajax({
        url:'recuperer_statut_avaries.php',
        method:'post',
        data:{statut:statut,navire:navire,produit:produit,destination:destination,poids_sac:poids_sac,transfert_sain:transfert_sain},
        success: function(response){

            $('#TableSain').html(response);
          }
          });
    
    
  }
</script>






<script>
  function visibleSain2() {
    var sain = document.getElementById("TableSain");
    var deb = document.getElementById("TableAvariesTrans2");
    var rep = document.getElementById("avaries_debarquement2");



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
  function visibleAvariesDeb2() {
    var sain = document.getElementById("TableSain");
    var deb = document.getElementById("TableAvariesTrans2");
    var rep = document.getElementById("avaries_debarquement2");

    if (rep.style.display === "none") {
      rep.style.display = "table";
      sain.style.display = "none";
      deb.style.display = "none";
     
     

       rep.scrollIntoView({ behavior: 'smooth' });
     
    } else {
      rep.style.display = "none";
     
    }
    
    
  }
</script>

<script>
  function visibleAvariesTrans2() {
    var sain = document.getElementById("TableSain");
    var deb = document.getElementById("TableAvariesTrans2");
    var rep = document.getElementById("avaries_debarquement2");

    if (deb.style.display === "none") {
      deb.style.display = "table";
     
      sain.style.display = "none";
     
     

       deb.scrollIntoView({ behavior: 'smooth' });
     
    } else {
      deb.style.display = "none";
     
    }
    
    
  }
</script>


<script type="text/javascript">
        function imprimer(dname){
          /*  var printContents=document.getElementById(dname).innerHTML;
            var originalContents=document.body.innerHTML;
            document.body.innerHTML=printContents;*/
            var st=document.getElementById('situation');
            st.style.display="none";
          //  window.print(dname);

           // document.body.innerHTML=originalContents;
          

        }
    </script>

<script type="text/javascript">
  
    $(document).ready(function () {
        $(document).on('click', 'a[data-role=imprimer_tableau_sain]', function () {
            var contentToPrint = $('#tableau_sain').html();
            var printWindow = window.open('', '_blank');
             var cssLink = '<link rel="stylesheet" type="text/css" href="imprimer_transfert.css">';
             var cssLink2 = '<link rel="stylesheet" type="text/css" href="../assets/modules/bootstrap-5.1.3/css/bootstrap.css">';
        printWindow.document.write('<html><head><title>Impression</title>' + cssLink + cssLink2 + '</head><body>' + contentToPrint + '</body></html>');
           // printWindow.document.write('<html><head><title>Impression</title></head><body>' + contentToPrint + '</body></html>');
            printWindow.document.close();
            printWindow.print(); 
        });
    }); 
</script>

<script type="text/javascript">
  
    $(document).ready(function () {
        $(document).on('click', 'a[data-role=imprimer_tableau_transfert]', function () {
            var contentToPrint = $('#tableau_transfert').html();
            var printWindow = window.open('', '_blank');
             var cssLink = '<link rel="stylesheet" type="text/css" href="imprimer_transfert.css">';
             var cssLink2 = '<link rel="stylesheet" type="text/css" href="../assets/modules/bootstrap-5.1.3/css/bootstrap.css">';
        printWindow.document.write('<html><head><title>Impression</title>' + cssLink + cssLink2 + '</head><body>' + contentToPrint + '</body></html>');
           // printWindow.document.write('<html><head><title>Impression</title></head><body>' + contentToPrint + '</body></html>');
            printWindow.document.close();
            printWindow.print(); 
        });
    }); 
</script>


<script type="text/javascript">
  
    $(document).ready(function () {
        $(document).on('click', 'a[data-role=imprimer_tableau_avaries]', function () {
            var contentToPrint = $('#tableau_avaries').html();
            var printWindow = window.open('', '_blank');
             var cssLink = '<link rel="stylesheet" type="text/css" href="imprimer_transfert.css">';
             var cssLink2 = '<link rel="stylesheet" type="text/css" href="../assets/modules/bootstrap-5.1.3/css/bootstrap.css">';
        printWindow.document.write('<html><head><title>Impression</title>' + cssLink + cssLink2 + '</head><body>' + contentToPrint + '</body></html>');
           // printWindow.document.write('<html><head><title>Impression</title></head><body>' + contentToPrint + '</body></html>');
            printWindow.document.close();
            printWindow.print(); 
        });
    }); 
</script>



<script type="text/javascript">
  
    $(document).ready(function () {
        $(document).on('click', 'a[data-role=imprimer_par_cale]', function () {
            var contentToPrint = $('#deb_by_cale').html();
            var printWindow = window.open('', '_blank');
             var cssLink = '<link rel="stylesheet" type="text/css" href="situation_journaliere.css">';
        printWindow.document.write('<html><head><title>Impression</title>' + cssLink + '</head><body>' + contentToPrint + '</body></html>');
           // printWindow.document.write('<html><head><title>Impression</title></head><body>' + contentToPrint + '</body></html>');
            printWindow.document.close();
            printWindow.print(); 
        });
    }); 
</script>

<script type="text/javascript">
  
    $(document).ready(function () {
        $(document).on('click', 'a[data-role=imprimer_par_produit]', function () {
            var contentToPrint = $('#deb_by_produit').html();
            var printWindow = window.open('', '_blank');
             var cssLink = '<link rel="stylesheet" type="text/css" href="situation_journaliere.css">';
        printWindow.document.write('<html><head><title>Impression</title>' + cssLink + '</head><body>' + contentToPrint + '</body></html>');;
           // printWindow.document.write('<html><head><title>Impression</title></head><body>' + contentToPrint + '</body></html>');
            printWindow.document.close();
            printWindow.print(); 
        });
    }); 
</script>

<script type="text/javascript">
  
    $(document).ready(function () {
        $(document).on('click', 'a[data-role=imprimer_par_destination]', function () {
            var contentToPrint = $('#deb_by_destination').html();
            var printWindow = window.open('', '_blank');
             var cssLink = '<link rel="stylesheet" type="text/css" href="situation_journaliere.css">';
        printWindow.document.write('<html><head><title>Impression</title>' + cssLink + '</head><body>' + contentToPrint + '</body></html>');;
           // printWindow.document.write('<html><head><title>Impression</title></head><body>' + contentToPrint + '</body></html>');
            printWindow.document.close();
            printWindow.print(); 
        });
    }); 
</script>

<script type="text/javascript">
  
    $(document).ready(function () {
        $(document).on('click', 'a[data-role=imprimer_par_client]', function () {
            var contentToPrint = $('#deb_by_client').html();
            var printWindow = window.open('', '_blank');
             var cssLink = '<link rel="stylesheet" type="text/css" href="situation_journaliere.css">';
        printWindow.document.write('<html><head><title>Impression</title>' + cssLink + '</head><body>' + contentToPrint + '</body></html>');;
           // printWindow.document.write('<html><head><title>Impression</title></head><body>' + contentToPrint + '</body></html>');
            printWindow.document.close();
            printWindow.print(); 
        });
    }); 
</script>

<script type="text/javascript">
  
    $(document).ready(function () {
        $(document).on('click', 'a[data-role=imprimer_par_avaries_cale]', function () {
            var contentToPrint = $('#deb_by_avaries_cale').html();
            var printWindow = window.open('', '_blank');
             var cssLink = '<link rel="stylesheet" type="text/css" href="situation_journaliere.css">';
        printWindow.document.write('<html><head><title>Impression</title>' + cssLink + '</head><body>' + contentToPrint + '</body></html>');;
           // printWindow.document.write('<html><head><title>Impression</title></head><body>' + contentToPrint + '</body></html>');
            printWindow.document.close();
            printWindow.print(); 
        });
    }); 
</script>

<script type="text/javascript">
  
    $(document).ready(function () {
        $(document).on('click', 'a[data-role=imprimer_par_avaries_produit]', function () {
            var contentToPrint = $('#deb_by_avaries_produit').html();
            var printWindow = window.open('', '_blank');
             var cssLink = '<link rel="stylesheet" type="text/css" href="situation_journaliere.css">';
        printWindow.document.write('<html><head><title>Impression</title>' + cssLink + '</head><body>' + contentToPrint + '</body></html>');;
           // printWindow.document.write('<html><head><title>Impression</title></head><body>' + contentToPrint + '</body></html>');
            printWindow.document.close();
            printWindow.print(); 
        });
    }); 
</script>



<script type="text/javascript">
    /* function imprimerCale(elementId) {
      
        var contentToPrint = $(elementId).html();
        var printWindow = window.open('', '_blank');
        var cssLink = '<link rel="stylesheet" type="text/css" href="situation_journaliere.css">';
        printWindow.document.write('<html><head><title>Impression</title>' + cssLink + '</head><body>' + contentToPrint + '</body></html>');
        printWindow.document.close();
        printWindow.print(); 
    }

    $(document).ready(function () {
        $(document).on('click', 'a[data-role=imprimer_par_cale]', function () {
            var targetElement = $(this).data('target');
            imprimerCale(targetElement);
        });
    });
    */
</script>




<script type="text/javascript">
  function visible_EnregistrementBL(){
    var bl=document.getElementById("select_enregistrement");
    var sit=document.getElementById("situation");
      var id_sit=document.getElementById("sit");
      var main=document.getElementById("main");
       var facturation=document.getElementById("facturation");
       var fact=document.getElementById("fact");
           var avaries=document.getElementById("avaries_navire");
      var espace_av=document.getElementById("espace_avaries");
            var recond=document.getElementById("reconditionnement");
      var espace_recond=document.getElementById("espace_reconditionnement");
      var espace_pont=document.getElementById("pont_deb");
    bl.style.display="table";
    main.style.display="table";
     sit.style.display="none";
     id_sit.style.display="none";
    facturation.style.display="none";
    fact.style.display="none";
            avaries.style.display="none";
    espace_av.style.display="none";
      recond.style.display="none";
    espace_recond.style.display="none";  
    espace_pont.style.display="none"; 
    $('#main2').css('display','none');

  }


    function visible_Pont(){
    var bl=document.getElementById("select_enregistrement");
    var sit=document.getElementById("situation");
      var id_sit=document.getElementById("sit");
      var main=document.getElementById("main");
       var facturation=document.getElementById("facturation");
       var fact=document.getElementById("fact");
           var avaries=document.getElementById("avaries_navire");
      var espace_av=document.getElementById("espace_avaries");
            var recond=document.getElementById("reconditionnement");
      var espace_recond=document.getElementById("espace_reconditionnement");
       var espace_pont=document.getElementById("pont_deb");
    bl.style.display="none";
    main.style.display="none";
     sit.style.display="none";
     id_sit.style.display="none";
    facturation.style.display="none";
    fact.style.display="none";
            avaries.style.display="none";
    espace_av.style.display="none";
      recond.style.display="none";
    espace_recond.style.display="none"; 
      espace_pont.style.display="table";  
      $('#main2').css('display','block');

  }
</script>

<script type="text/javascript">
  function visible_facturations(){
    var bl=document.getElementById("select_enregistrement");
    var sit=document.getElementById("situation");
  
      var id_sit=document.getElementById("sit");
      var main=document.getElementById("main");
       var facturation=document.getElementById("facturation");
       var fact=document.getElementById("fact");
           var avaries=document.getElementById("avaries_navire");
      var espace_av=document.getElementById("espace_avaries");
       var recond=document.getElementById("reconditionnement");
      var espace_recond=document.getElementById("espace_reconditionnement");     
    bl.style.display="none";
    main.style.display="none";
     sit.style.display="none";
     id_sit.style.display="none";
    facturation.style.display="table";
    fact.style.display="table";
                avaries.style.display="none";
    espace_av.style.display="none";
      recond.style.display="none";
    espace_recond.style.display="none"; 
  }
</script>

<script type="text/javascript">
  function visible_Situations(){
    var sit=document.getElementById("situation");
     var bl=document.getElementById("select_enregistrement");
      var id_sit=document.getElementById("sit");
      var main=document.getElementById("main");
      var facturation=document.getElementById("facturation");
      var fact=document.getElementById("fact");
          var avaries=document.getElementById("avaries_navire");
      var espace_av=document.getElementById("espace_avaries");
      var recond=document.getElementById("reconditionnement");
      var espace_recond=document.getElementById("espace_reconditionnement");      
    sit.style.display="table";
    bl.style.display="none";
    id_sit.style.display="table";
     main.style.display="none";
    facturation.style.display="none";
    fact.style.display="none";
                avaries.style.display="none";
    espace_av.style.display="none";
      recond.style.display="none";
    espace_recond.style.display="none"; 
    $('#pont_deb').css('display','none');
    $('#main2').css('display','none');
  }
</script>


<script type="text/javascript">
  function visible_Avaries(){
    var sit=document.getElementById("situation");
     var bl=document.getElementById("select_enregistrement");
      var id_sit=document.getElementById("sit");
      var main=document.getElementById("main");
      var facturation=document.getElementById("facturation");
      var fact=document.getElementById("fact");
    var avaries=document.getElementById("avaries_navire");
      var espace_av=document.getElementById("espace_avaries");
       var recond=document.getElementById("reconditionnement");
      var espace_recond=document.getElementById("espace_reconditionnement");     
    sit.style.display="none";
    bl.style.display="none";
    id_sit.style.display="none";
     main.style.display="none";
    facturation.style.display="none";
    fact.style.display="none";
        avaries.style.display="table";
    espace_av.style.display="table";
      recond.style.display="none";
    espace_recond.style.display="none"; 
  }
</script> 


<script type="text/javascript">
  function visible_Reconditionnement(){
    var sit=document.getElementById("situation");
     var bl=document.getElementById("select_enregistrement");
      var id_sit=document.getElementById("sit");
      var main=document.getElementById("main");
      var facturation=document.getElementById("facturation");
      var fact=document.getElementById("fact");
    var avaries=document.getElementById("avaries_navire");
      var espace_av=document.getElementById("espace_avaries");
      var recond=document.getElementById("reconditionnement");
      var espace_recond=document.getElementById("espace_reconditionnement");
    sit.style.display="none";
    bl.style.display="none";
    id_sit.style.display="none";
     main.style.display="none";
    facturation.style.display="none";
    fact.style.display="none";
        avaries.style.display="none";
    espace_av.style.display="none";

    recond.style.display="table";
    espace_recond.style.display="table";

  }
</script>      


<script type="text/javascript">
    

  function VisibleDebParCale() {
    var deb_cale=document.getElementById("deb_cale");
     var deb_sain=document.getElementById("deb_sain");
    var transfert_sain=document.getElementById("transfert_sain");
    var transfert_avaries=document.getElementById("transfert_avaries");
    var deb_produit=document.getElementById("deb_produit");
    var deb_destination=document.getElementById("deb_destination");
    var deb_client=document.getElementById("deb_client");
    var deb_av_cale=document.getElementById("deb_av_cale");
    var deb_av_produit=document.getElementById("deb_av_produit");
    var deb_av_destination=document.getElementById("deb_av_destination");
    var transavariesdes = document.getElementById("transf_by_avaries_destination");
    var debcale = document.getElementById("deb_by_cale");
    var debsain = document.getElementById("deb_by_sain");
    var debproduit = document.getElementById("deb_by_produit");
     var debdes = document.getElementById("deb_by_destination");
     var debdes_all = document.getElementById("deb_by_destination_all");
      var debclient = document.getElementById("deb_by_client");
       var avariescale = document.getElementById("deb_by_avaries_cale");
        var avariesproduit = document.getElementById("deb_by_avaries_produit");
         var transavariesproduit = document.getElementById("transf_by_avaries_produit");
          var restant_avaries = document.getElementById("avaries_restant_by_produit");
          var all = document.getElementById("all_imprime"); 
   
      $('#deb_cale').val(1);
      $('#deb_produit').val(1);
      $('#deb_sain').val(0);
      $('#deb_destination').val(0);
      $('#deb_client').val(0);
      $('#deb_av_cale').val(0);
      $('#deb_av_produit').val(0);
      $('#deb_av_destination').val(0);
      $('#transfert_sain').val(0);
      $('#transfert_sain_avaries').val(0); 
   
      debcale.style.display = "table";
      debproduit.style.display = "table";
      debsain.style.display = "none";
      debdes.style.display = "none";
      debdes_all.style.display = "none";
      debclient.style.display = "none";
       avariescale.style.display = "none";
       avariesproduit.style.display = "none";
       transavariesproduit.style.display = "none";
        transavariesdes.style.display = "none";
        restant_avaries.style.display = "none";
         all.style.display = "none";
    
     
    
    }


    function VisibleDebParSain() {
    var deb_cale=document.getElementById("deb_cale");
     var deb_sain=document.getElementById("deb_sain");
    var deb_produit=document.getElementById("deb_produit");
    var deb_destination=document.getElementById("deb_destination");
    var deb_client=document.getElementById("deb_client");
    var deb_av_cale=document.getElementById("deb_av_cale");
    var deb_av_produit=document.getElementById("deb_av_produit");


    var deb_av_destination=document.getElementById("deb_av_destination");
    var transavariesdes = document.getElementById("transf_by_avaries_destination");



    var debcale = document.getElementById("deb_by_cale");
    var debsain = document.getElementById("deb_by_sain");
    var debproduit = document.getElementById("deb_by_produit");
     var debdes = document.getElementById("deb_by_destination");
     var debdes_all = document.getElementById("deb_by_destination_all");
      var debclient = document.getElementById("deb_by_client");
       var avariescale = document.getElementById("deb_by_avaries_cale");
        var avariesproduit = document.getElementById("deb_by_avaries_produit");
         var transavariesproduit = document.getElementById("transf_by_avaries_produit");
          var restant_avaries = document.getElementById("avaries_restant_by_produit");
          var all = document.getElementById("all_imprime"); 
   
      $('#deb_cale').val(0);
      $('#deb_produit').val(0);
      $('#deb_sain').val(1);
      $('#deb_destination').val(0);
      $('#deb_client').val(0);
      $('#deb_av_cale').val(0);
      $('#deb_av_produit').val(0);
      $('#deb_av_destination').val(0);
      $('#transfert_sain').val(0);
      $('#transfert_sain_avaries').val(0);      
   
      debcale.style.display = "none";
      debproduit.style.display = "none";
      debsain.style.display = "table";
      debdes.style.display = "none";
       debdes_all.style.display = "none"; 
      debclient.style.display = "none";
      avariescale.style.display = "none";
      avariesproduit.style.display = "none";
       transavariesproduit.style.display = "none";
        transavariesdes.style.display = "none";
        restant_avaries.style.display = "none";
         all.style.display = "none";

    
     
    
    }
   
</script>


<script type="text/javascript">
    

  function VisibleDebParProduit() {
        var deb_cale=document.getElementById("deb_cale");
    var deb_produit=document.getElementById("deb_produit");
    var deb_destination=document.getElementById("deb_destination");
    var deb_client=document.getElementById("deb_client");
    var deb_av_cale=document.getElementById("deb_av_cale");
    var deb_av_produit=document.getElementById("deb_av_produit");
    var deb_av_destination=document.getElementById("deb_av_destination");
     var transfert_sain=document.getElementById("transfert_sain");
    var transfert_avaries=document.getElementById("transfert_avaries");

    var transavariesdes = document.getElementById("transf_by_avaries_destination");
    var debcale = document.getElementById("deb_by_cale");
    var debproduit = document.getElementById("deb_by_produit");
     var debdes = document.getElementById("deb_by_destination");
      var debclient = document.getElementById("deb_by_client");
       var avariescale = document.getElementById("deb_by_avaries_cale");
        var avariesproduit = document.getElementById("deb_by_avaries_produit");
         var transavariesproduit = document.getElementById("transf_by_avaries_produit");
          var restant_avaries = document.getElementById("avaries_restant_by_produit");
           var all = document.getElementById("all_imprime"); 

      $('#deb_cale').val(0);
      $('#deb_produit').val(1);
      $('#deb_destination').val(0);
      $('#deb_client').val(0);
      $('#deb_av_cale').val(0);
      $('#deb_av_produit').val(0);
      $('#deb_av_destination').val(0);
      $('#transfert_sain').val(0);
      $('#transfert_sain_avaries').val(0);

    
      debproduit.style.display = "table";
      debcale.style.display = "none";
      debdes.style.display = "none";
      debclient.style.display = "none";
       avariescale.style.display = "none";
       avariesproduit.style.display = "none";
        transavariesproduit.style.display = "none";
        transavariesdes.style.display = "none";
        restant_avaries.style.display = "none";
         all.style.display = "none";
        
    
     
  
  
     
    
    
    
  }
   
</script>



<script type="text/javascript">
    

  function Visible_transfert_sain_avaries() {
       var deb_cale=document.getElementById("deb_cale");
    var deb_produit=document.getElementById("deb_produit");
    var deb_destination=document.getElementById("deb_destination");
    var deb_client=document.getElementById("deb_client");
    var deb_av_cale=document.getElementById("deb_av_cale");
    var deb_av_produit=document.getElementById("deb_av_produit");
    var deb_av_destination=document.getElementById("deb_av_destination");
    var transfert_sain=document.getElementById("transfert_sain");
    var transfert_avaries=document.getElementById("transfert_avaries");
     var transfert_sain_avaries=document.getElementById("transfert_sain_avaries");
     var deb_sain=document.getElementById("deb_sain");

          $('#deb_cale').val(0);
      $('#deb_produit').val(0);
      $('#deb_destination').val(0);
      $('#deb_client').val(0);
      $('#deb_av_cale').val(0);
      $('#deb_av_produit').val(0);
      $('#deb_av_destination').val(0);
      $('#transfert_sain').val(0);
      $('#transfert_avaries').val(0);
      $('#deb_sain').val(0);
      $('#transfert_sain_avaries').val(1);
      var debcale = document.getElementById("deb_by_cale");
    var transavariesdes = document.getElementById("transf_by_avaries_destination");
    var transavariesproduit = document.getElementById("transf_by_avaries_produit");
     var avariesproduit = document.getElementById("deb_by_avaries_produit");
    var avariescale = document.getElementById("deb_by_avaries_cale");
    var debclient = document.getElementById("deb_by_client");
    
    //var debproduit = document.getElementById("deb_by_produit");
    var debdes = document.getElementById("deb_by_destination"); //enlevement par destination sain +avaries
     var restant_avaries = document.getElementById("avaries_restant_by_produit");
      var all = document.getElementById("all_imprime");

    var debdes_all = document.getElementById("deb_by_destination_all"); //enlevement par destination sain
    var debsain = document.getElementById("deb_by_sain");

        debcale.style.display = "none";
        debdes.style.display = "table";
        transavariesdes.style.display = "none";
        transavariesproduit.style.display = "none";
        avariesproduit.style.display = "none";
        avariescale.style.display = "none";
      debclient.style.display = "none";
      debdes_all.style.display = "none";
      debsain.style.display = "none";
      
     // debproduit.style.display = "none";
      restant_avaries.style.display = "none";
      
        all.style.display = "none";
   
    
  }
   
</script>

<script type="text/javascript">
    

  function VisibleDebParClient() {
    var deb_cale=document.getElementById("deb_cale");
    var deb_sain=document.getElementById("deb_sain");
    var deb_produit=document.getElementById("deb_produit");
    var deb_destination=document.getElementById("deb_destination");
    var deb_client=document.getElementById("deb_client");
    var deb_av_cale=document.getElementById("deb_av_cale");
    var deb_av_produit=document.getElementById("deb_av_produit");
    var deb_av_destination=document.getElementById("deb_av_destination");

          $('#deb_cale').val(0);
          $('#deb_sain').val(0);
      $('#deb_produit').val(0);
      $('#deb_destination').val(0);
      $('#deb_client').val(1);
      $('#deb_av_cale').val(0);
      $('#deb_av_produit').val(0);
      $('#deb_av_destination').val(0);

    var deb_client=document.getElementById("deb_client");
    var transavariesdes = document.getElementById("transf_by_avaries_destination");
    var debclient = document.getElementById("deb_by_client");
    var debcale = document.getElementById("deb_by_cale");
    var debsain = document.getElementById("deb_by_sain");
    var debproduit = document.getElementById("deb_by_produit");
    var debdes = document.getElementById("deb_by_destination");
     var avariescale = document.getElementById("deb_by_avaries_cale");
      var avariesproduit = document.getElementById("deb_by_avaries_produit");
       var transavariesproduit = document.getElementById("transf_by_avaries_produit");
        var restant_avaries = document.getElementById("avaries_restant_by_produit");
       var all = document.getElementById("all_imprime"); 

   

   // a.style.background='blue';
  
      debclient.style.display = "table";
      debdes.style.display = "none";
      debcale.style.display = "none";
      debsain.style.display = "none";
      debproduit.style.display = "none";
      avariescale.style.display = "none";
      avariesproduit.style.display = "none";
       transavariesproduit.style.display = "none";
       transavariesdes.style.display = "none";
       restant_avaries.style.display = "none";
       all.style.display = "none";


    
     
    } 
  
     
    
    
    
  
   
</script>


<script type="text/javascript">
    

  function VisibleAvariesParCale() {
    var deb_cale=document.getElementById("deb_cale");
    var deb_sain=document.getElementById("deb_sain");
    var deb_produit=document.getElementById("deb_produit");
    var deb_destination=document.getElementById("deb_destination");
    var deb_client=document.getElementById("deb_client");
    var deb_av_cale=document.getElementById("deb_av_cale");
    var deb_av_produit=document.getElementById("deb_av_produit");
    var deb_av_destination=document.getElementById("deb_av_destination");

          $('#deb_cale').val(0);
          $('#deb_sain').val(0);
      $('#deb_produit').val(0);
      $('#deb_destination').val(0);
      $('#deb_client').val(0);
      $('#deb_av_cale').val(1);
      $('#deb_av_produit').val(0);
      $('#deb_av_destination').val(0);
      $('#transfert_sain').val(0);
      $('#transfert_sain_avaries').val(0); 

    var transavariesdes = document.getElementById("transf_by_avaries_destination");
    var avariescale = document.getElementById("deb_by_avaries_cale");
    var debclient = document.getElementById("deb_by_client");
    var debcale = document.getElementById("deb_by_cale");
     var debsain = document.getElementById("deb_by_sain");
    var debproduit = document.getElementById("deb_by_produit");
    var debdes = document.getElementById("deb_by_destination");
    var debdes_all = document.getElementById("deb_by_destination_all");
     var avariesproduit = document.getElementById("deb_by_avaries_produit");
      var transavariesproduit = document.getElementById("transf_by_avaries_produit");
       var restant_avaries = document.getElementById("avaries_restant_by_produit");
        var all = document.getElementById("all_imprime"); 
   

   
        avariescale.style.display = "table";
      debclient.style.display = "none";
      debdes.style.display = "none";
      debdes_all.style.display = "none";
      debcale.style.display = "none";
      debsain.style.display = "none";
      debproduit.style.display = "none";
      avariesproduit.style.display = "none";
       transavariesproduit.style.display = "none";
       transavariesdes.style.display = "none";
       restant_avaries.style.display = "none";
      all.style.display = "none";


 
    
  }


/*
  function VisibleAvariesParCaleFiltre() {
    
    var deb_cale=document.getElementById("deb_cale");
    var deb_produit=document.getElementById("deb_produit");
    var deb_destination=document.getElementById("deb_destination");
    var deb_client=document.getElementById("deb_client");
    var deb_av_cale=document.getElementById("deb_av_cale");
    var deb_av_produit=document.getElementById("deb_av_produit");
    var deb_av_destination=document.getElementById("deb_av_destination");

          $('#deb_cale').val(0);
      $('#deb_produit').val(0);
      $('#deb_destination').val(0);
      $('#deb_client').val(0);
      $('#deb_av_cale').val(1);
      $('#deb_av_produit').val(0);
      $('#deb_av_destination').val(0);

    var transavariesdes = document.getElementById("transf_by_avaries_destination");
    var avariescale = document.getElementById("deb_by_avaries_cale");
    var debclient = document.getElementById("deb_by_client");
    var debcale = document.getElementById("deb_by_cale");
    var debproduit = document.getElementById("deb_by_produit");
    var debdes = document.getElementById("deb_by_destination");
     var avariesproduit = document.getElementById("deb_by_avaries_produit");
      var transavariesproduit = document.getElementById("transf_by_avaries_produit");
       var restant_avaries = document.getElementById("avaries_restant_by_produit");
        var all = document.getElementById("all_imprime"); 
   

   
        avariescale.style.display = "table";
      debclient.style.display = "none";
      debdes.style.display = "none";
      debcale.style.display = "none";
      debproduit.style.display = "none";
      avariesproduit.style.display = "none";
       transavariesproduit.style.display = "none";
       transavariesdes.style.display = "none";
       restant_avaries.style.display = "none";
      all.style.display = "none";

 
    var filtre=$("#situation_par_cale_filtre").val();


    if(filtre=='avaries'){

    VisibleAvariesParCale();
      filtre.val(''); 
    }
    if(filtre=='sains'){
        VisibleDebParProduit();

    }
    
  }

  function VisibleAvariesParCaleFiltre2() {
     var filtre=$("#situation_par_cale_filtre2").val();

     if(filtre=='sains'){
        VisibleDebParCale();
        filtre.val(''); 
    }
    
  }
  */
   
</script>

<script type="text/javascript">
    

  function VisibleAvariesParProduit() {
    var deb_cale=document.getElementById("deb_cale");
    var deb_produit=document.getElementById("deb_produit");
    var deb_destination=document.getElementById("deb_destination");
    var deb_client=document.getElementById("deb_client");
    var deb_av_cale=document.getElementById("deb_av_cale");
    var deb_av_produit=document.getElementById("deb_av_produit");
    var deb_av_destination=document.getElementById("deb_av_destination");

          $('#deb_cale').val(0);
      $('#deb_produit').val(0);
      $('#deb_destination').val(0);
      $('#deb_client').val(0);
      $('#deb_av_cale').val(0);
      $('#deb_av_produit').val(1);
      $('#deb_av_destination').val(0);
    var transavariesdes = document.getElementById("transf_by_avaries_destination");
     var avariesproduit = document.getElementById("deb_by_avaries_produit");
    var avariescale = document.getElementById("deb_by_avaries_cale");
    var debclient = document.getElementById("deb_by_client");
    var debcale = document.getElementById("deb_by_cale");
    var debproduit = document.getElementById("deb_by_produit");
    var debdes = document.getElementById("deb_by_destination");
     var transavariesproduit = document.getElementById("transf_by_avaries_produit");
      var restant_avaries = document.getElementById("avaries_restant_by_produit");
       var all = document.getElementById("all_imprime"); 
   

    
        avariesproduit.style.display = "table";
        avariescale.style.display = "none";
      debclient.style.display = "none";
      debdes.style.display = "none";
      debcale.style.display = "none";
      debproduit.style.display = "none";
       transavariesproduit.style.display = "none";
       transavariesdes.style.display = "none";
       restant_avaries.style.display = "none";
       
        all.style.display = "none";
    
     
    } 
  
     
    
    
    
  
   
</script>


<script type="text/javascript">
    

  function VisibleTransAvariesParProduit() {
    var transavariesdes = document.getElementById("transf_by_avaries_destination");
    var transavariesproduit = document.getElementById("transf_by_avaries_produit");
     var avariesproduit = document.getElementById("deb_by_avaries_produit");
    var avariescale = document.getElementById("deb_by_avaries_cale");
    var debclient = document.getElementById("deb_by_client");
    var debcale = document.getElementById("deb_by_cale");
    var debproduit = document.getElementById("deb_by_produit");
    var debdes = document.getElementById("deb_by_destination");
     var debdes_all = document.getElementById("deb_by_destination_all");
     var restant_avaries = document.getElementById("avaries_restant_by_produit");
     var all = document.getElementById("all_imprime"); 
     var transfert_sain_avaries=document.getElementById("transfert_sain_avaries");
      var transfert_sain_deb=document.getElementById("transfert_sain_deb");
      var transfert_avaries=document.getElementById("transfert_avaries");
      var debsain=document.getElementById("deb_by_sain");
   
       $('#deb_cale').val(0);
      $('#deb_produit').val(0);
      $('#deb_destination').val(0);
      $('#deb_client').val(0);
      $('#deb_av_cale').val(0);
      $('#deb_av_produit').val(0);
      $('#deb_av_destination').val(0);
      $('#transfert_sain_deb').val(0);
      $('#transfert_avaries').val(1);
      $('#transfert_sain_avaries').val(0);
       $('#deb_sain').val(0);
       
     debsain.style.display = "none";
        transavariesproduit.style.display = "table";
        avariesproduit.style.display = "none";
        avariescale.style.display = "none";
      debclient.style.display = "none";
      debdes.style.display = "none";
      debdes_all.style.display = "none";
      debcale.style.display = "none";
      debproduit.style.display = "none";
      transavariesdes.style.display = "none";
      restant_avaries.style.display = "none";
        debsain.style.display = "none";

    
     
    } 
  
     

   
</script>


<script type="text/javascript">
    

  function Visible_transfert_sain() {
      var deb_cale=document.getElementById("deb_cale");
    var deb_produit=document.getElementById("deb_produit");
    var deb_destination=document.getElementById("deb_destination");
    var deb_client=document.getElementById("deb_client");
    var deb_av_cale=document.getElementById("deb_av_cale");
    var deb_av_produit=document.getElementById("deb_av_produit");
    var deb_av_destination=document.getElementById("deb_av_destination");
    var transfert_sain=document.getElementById("transfert_sain");
    var transfert_avaries=document.getElementById("transfert_avaries");
     var transfert_sain_avaries=document.getElementById("transfert_sain_avaries");
     var deb_sain=document.getElementById("deb_sain");

          $('#deb_cale').val(0);
      $('#deb_produit').val(0);
      $('#deb_destination').val(0);
      $('#deb_client').val(0);
      $('#deb_av_cale').val(0);
      $('#deb_av_produit').val(0);
      $('#deb_av_destination').val(0);
      $('#transfert_sain').val(1);
      $('#transfert_avaries').val(0);
      $('#deb_sain').val(0);
      $('#transfert_sain_avaries').val(0);
      var debcale = document.getElementById("deb_by_cale");
    var transavariesdes = document.getElementById("transf_by_avaries_destination");
    var transavariesproduit = document.getElementById("transf_by_avaries_produit");
     var avariesproduit = document.getElementById("deb_by_avaries_produit");
    var avariescale = document.getElementById("deb_by_avaries_cale");
    var debclient = document.getElementById("deb_by_client");
    
    //var debproduit = document.getElementById("deb_by_produit");
    var debdes = document.getElementById("deb_by_destination"); //enlevement par destination sain +avaries
     var restant_avaries = document.getElementById("avaries_restant_by_produit");
      var all = document.getElementById("all_imprime");

    var debdes_all = document.getElementById("deb_by_destination_all"); //enlevement par destination sain
    var debsain = document.getElementById("deb_by_sain");

        debcale.style.display = "none";
        debdes.style.display = "none";
        transavariesdes.style.display = "none";
        transavariesproduit.style.display = "none";
        avariesproduit.style.display = "none";
        avariescale.style.display = "none";
      debclient.style.display = "none";
      debdes_all.style.display = "table";
      debsain.style.display = "none";
      
     // debproduit.style.display = "none";
      restant_avaries.style.display = "none";
      
        all.style.display = "none";
     
    } 
  
     

   
</script>

<script type="text/javascript">
function VisibleRestantAvaries() {
    var restant_avaries = document.getElementById("avaries_restant_by_produit");
    var transavariesdes = document.getElementById("transf_by_avaries_destination");
    var transavariesproduit = document.getElementById("transf_by_avaries_produit");
     var avariesproduit = document.getElementById("deb_by_avaries_produit");
    var avariescale = document.getElementById("deb_by_avaries_cale");
    var debclient = document.getElementById("deb_by_client");
    var debcale = document.getElementById("deb_by_cale");
    var debproduit = document.getElementById("deb_by_produit");
    var debdes = document.getElementById("deb_by_destination");
     var all = document.getElementById("all_imprime");
   

    
        restant_avaries.style.display = "table";
       transavariesdes.style.display = "none";
        transavariesproduit.style.display = "none";
        avariesproduit.style.display = "none";
        avariescale.style.display = "none";
      debclient.style.display = "none";
      debdes.style.display = "none";
      debcale.style.display = "none";
      debproduit.style.display = "none";
       all.style.display = "none";

    
     
    } 
  
     

   
</script>


<script type="text/javascript">
function VisibleGlobal() {

      var deb_produit=document.getElementById("deb_produit");
    var deb_destination=document.getElementById("deb_destination");
    var deb_client=document.getElementById("deb_client");
    var deb_av_cale=document.getElementById("deb_av_cale");
    var deb_av_produit=document.getElementById("deb_av_produit");
    var deb_av_destination=document.getElementById("deb_av_destination");

          $('#deb_cale').val(1);
      $('#deb_produit').val(1);
      $('#deb_destination').val(1);
      $('#deb_client').val(1);
      $('#deb_av_cale').val(1);
      $('#deb_av_produit').val(1);
     // $('#deb_av_destination').val(1);


      var tousimprime = document.getElementById("all_imprime");
    
    var restant_avaries = document.getElementById("avaries_restant_by_produit");
    var transavariesdes = document.getElementById("transf_by_avaries_destination");
    var transavariesproduit = document.getElementById("transf_by_avaries_produit");
     var avariesproduit = document.getElementById("deb_by_avaries_produit");
    var avariescale = document.getElementById("deb_by_avaries_cale");
    var debclient = document.getElementById("deb_by_client");
    var debcale = document.getElementById("deb_by_cale");
    var debproduit = document.getElementById("deb_by_produit");
    var debdes = document.getElementById("deb_by_destination");
   

       tousimprime.style.display = "table";
      //  restant_avaries.style.display = "table";
      // transavariesdes.style.display = "table";
      //  transavariesproduit.style.display = "table";
        avariesproduit.style.display = "table";
        avariescale.style.display = "table";
      debclient.style.display = "table";
      debdes.style.display = "table";
      debcale.style.display = "table";
      debproduit.style.display = "table";
      
    
   
  }
   
</script>


<script type="text/javascript">
function VisibleGlobal2() {
      var deb_produit=document.getElementById("deb_produit");
    var deb_destination=document.getElementById("deb_destination");
    var deb_client=document.getElementById("deb_client");
    var deb_av_cale=document.getElementById("deb_av_cale");
 //   var deb_av_produit=document.getElementById("deb_av_produit");
  //  var deb_av_destination=document.getElementById("deb_av_destination");

          $('#deb_cale').val(1);
      $('#deb_produit').val(1);
      $('#deb_destination').val(1);
      $('#deb_client').val(1);
   //   $('#deb_av_cale').val(1);
    //  $('#deb_av_produit').val(1);

      var tousimprime = document.getElementById("all_imprime");
    
   
    
    var debclient = document.getElementById("deb_by_client");
    var debcale = document.getElementById("deb_by_cale");
    var debproduit = document.getElementById("deb_by_produit");
    var debdes = document.getElementById("deb_by_destination");
   

       tousimprime.style.display = "table";
        
      debclient.style.display = "table";
      debdes.style.display = "table";
      debcale.style.display = "table";
      debproduit.style.display = "table";
      
    
   
  }
   
</script>

 <script type='text/javascript'>

           $(document).ready(function(){
    $(document).on('click','a[data-role=ajout_new_camion]',function(){
  //$('#type').css('display', 'block');

    var camion = $('#new_camion').val();
    var transporteur = $('#transporteur_add').val();
      //var type_dec = $('#type_dec').val();
      /*  if ($.trim(camion) !== '' && $.trim(transporteur) !== '') {
    // La variable 'a' n'est pas vide
    // Votre code ici
  
     $('#form_camion').modal('toggle');
     } */

        $.ajax({
        url:'nouveau_transport/ajout_camion.php',
        method:'post',
        data:{camion:camion,transporteur:transporteur},
        success: function(response){
            $('#message_add_camion').html(response);
             $('#message_add_camion').css('display','block');
       
        }
    });




  });
});


    $(document).ready(function(){
    $(document).on('click','a[data-role=ajout_new_remorque]',function(){
  //$('#type').css('display', 'block');

    var camion = $('#new_remorque').val();
    var transporteur = $('#transporteur_add_remorque').val();


        $.ajax({
        url:'nouveau_transport/ajout_remorque.php',
        method:'post',
        data:{camion:camion,transporteur:transporteur},
        success: function(response){
            $('#message_add_remorque').html(response);
            $('#message_add_remorque').css('display','block');
       
        }
    });


 

  });
});           

</script>

<script type='text/javascript'>

           $(document).ready(function(){
    $(document).on('click','a[data-role=ajout_new_transporteur]',function(){
  //$('#type').css('display', 'block');

    var transporteur = $('#new_transporteur').val();
   
     

        $.ajax({
        url:'nouveau_transport/ajout_transporteur.php',
        method:'post',
        data:{transporteur:transporteur},
        success: function(response){
            $('#message_add_transporteur').html(response);
        
       
        }
    });


 

  });
});

</script> 


<script type='text/javascript'>

           $(document).ready(function(){
    $(document).on('click','a[data-role=ajout_new_chauffeur]',function(){
  //$('#type').css('display', 'block');

    var chauffeur = $('#new_nom_chauffeur').val();
    var permis = $('#new_permis').val();
    var tel = $('#new_telephone').val();
   
     

        $.ajax({
        url:'nouveau_transport/ajout_chauffeur.php',
        method:'post',
        data:{chauffeur:chauffeur,permis:permis,tel:tel},
        success: function(response){
            $('#message_add_chauffeur').html(response);
        
       
        }
    });


 

  });
});


     $(document).ready(function(){
    $(document).on('click','a[data-role=nouveau_chauffeur]',function(){
  $('#form_chauffeur').modal('toggle');
  $('#form_chauffeur').css('z-index','99999999999');
  });
  }); 

   $(document).ready(function(){
    $(document).on('click','a[data-role=nouveau_camion]',function(){
  $('#form_camion').modal('toggle');
  $('#form_camion').css('z-index','99999999999');
   $('#new_camion').val('');
        $('#transporteur_add').val('');
        $('#message_add_camion').css('display','none');
  });
  });  


    $(document).ready(function(){
    $(document).on('click','a[data-role=nouveau_remorque]',function(){
  $('#form_remorque').modal('toggle');
  $('#form_remorque').css('z-index','99999999999');
  $('#new_remorque').val('');
        $('#transporteur_add_remorque').val('');
        $('#message_add_remorque').css('display','none');
  });
  });

    $(document).ready(function(){
    $(document).on('click','a[data-role=nouveau_transporteur]',function(){
  $('#form_transporteur').modal('toggle');
  $('#form_transporteur').css('z-index','99999999999');
  });
  });            

</script> 




<script type="text/javascript">

  $(document).ready(function(){
    $(document).on('change','select[data-role=goNavireFacture]',function(){
  //$('#type').css('display', 'block');

    var navire = $('#navirefacture').val();

  



        $.ajax({
        url:'SelectTableFacturation.php',
        method:'post',
        data:{navire:navire},
        success: function(response){
            $('#fact').html(response);
           
     
       
        }
    });


 

  });
});
  
</script>


<script type="text/javascript">

  $(document).ready(function(){
    $(document).on('change','select[data-role=goProduitNavireAvaries]',function(){
  //$('#type').css('display', 'block');

    var produit = $('#valeur_produit_navire').val();

  



        $.ajax({
        url:'SelectTableAvaries.php',
        method:'post',
        data:{produit:produit},
        success: function(response){
            $('#espace_avaries').html(response);
           
     
       
        }
    });


 

  });
});


 $(document).ready(function(){
    $(document).on('change','select[data-role=goNavireAvaries]',function(){
  //$('#type').css('display', 'block');

    var navire = $('#valeur_avaries_navire').val();

  



        $.ajax({
        url:'SelectProduitAvaries.php',
        method:'post',
        data:{navire:navire},
        success: function(response){
            $('#valeur_produit_navire').html(response);
           
     
       
        }
    });


 

  });
});  
  
</script>






<script type="text/javascript">

  $(document).ready(function(){
    $(document).on('click','a[data-role=voir_liste_camion]',function(){
  //$('#type').css('display', 'block');

     var navire = $(this).data('navire').val();
     var transporteur = $(this).data('transporteur').val();

  



        $.ajax({
        url:'SelectTableDetailTransporteur.php',
        method:'post',
        data:{navire:navire,transporteur:transporteur},
        success: function(response){
          $('#detail_transporteurdiv').html(response);
         // $('#detail_transporteur').modal('toggle');
            

           
     
       
        }
    });


 

  });
});
  
</script>
<script type="text/javascript">
  
</script>


<!-- //////// SCRIPT POUR LES FILTRES DU TABLEAU DEBARQUEMENT  //////// !-->
<script type="text/javascript">
   

  $(document).ready(function(){
    $(document).on('change','select[data-role=filtrer_par_date]',function(){
  //$('#type').css('display', 'block');

     var navire = $('#input_navire').val();
      var produit = $('#input_produit').val();
       var destination = $('#input_destination').val();
        var poids_sac = $('#input_poids_sac').val();
        var statut = $('#input_statut').val();
        var client = $('#input_client').val();
        var date = $('#valeur_filtre_date').val();
        $('#input_dates').val(date);

    

  



        $.ajax({
        url:'filtre_table/par_date.php',
        method:'post',
        data:{navire:navire,produit:produit,destination:destination,poids_sac:poids_sac,statut:statut,date:date,client:client},
        success: function(response){
          $('#tbody_transfert_deb').html(response);
         // $('#detail_transporteur').modal('toggle');
            

           
     
       
        }
    });


 

  });
});



$(document).ready(function(){
    $(document).on('change','select[data-role=filtrer_par_declaration]',function(){
  //$('#type').css('display', 'block');

     var navire = $('#input_navire').val();
      var produit = $('#input_produit').val();
       var destination = $('#input_destination').val();
        var poids_sac = $('#input_poids_sac').val();
        var statut = $('#input_statut').val();
        var declaration = $('#valeur_filtre_declaration').val();
    

  



        $.ajax({
        url:'filtre_table/par_declaration.php',
        method:'post',
        data:{navire:navire,produit:produit,destination:destination,poids_sac:poids_sac,statut:statut,declaration:declaration},
        success: function(response){
          $('#tbody_transfert_deb').html(response);
         // $('#detail_transporteur').modal('toggle');
            

           
     
       
        }
    });


 

  });
});


$(document).ready(function(){
    $(document).on('change','select[data-role=filtrer_par_cale]',function(){
  //$('#type').css('display', 'block');

     var navire = $('#input_navire').val();
      var produit = $('#input_produit').val();
       var destination = $('#input_destination').val();
        var poids_sac = $('#input_poids_sac').val();
        var statut = $('#input_statut').val();
        var client = $('#input_client').val();
        var cale = $('#valeur_filtre_cale').val();
    

  



        $.ajax({
        url:'filtre_table/par_cale.php',
        method:'post',
        data:{navire:navire,produit:produit,destination:destination,poids_sac:poids_sac,statut:statut,cale:cale,client:client},
        success: function(response){
          $('#tbody_transfert_deb').html(response);
         // $('#detail_transporteur').modal('toggle');
            

           
     
       
        }
    });


 

  });
});



function cherche_par_bl() {
    // Récupérer la valeur saisie dans l'input de recherche
    var recherche = document.getElementById("valeur_filtre_bl").value.toUpperCase();
    
    // Sélectionner tous les éléments de la table
    var lignes = document.querySelectorAll("#tableau_sain tbody tr");

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


function cherche_par_cale() {
    // Récupérer la valeur saisie dans l'input de recherche
    var recherche = document.getElementById("valeur_filtre_cale").value.toUpperCase();
    
    // Sélectionner tous les éléments de la table
    var lignes = document.querySelectorAll("#tableau_sain tbody tr");

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




function cherche_par_date() {
    // Récupérer la valeur saisie dans l'input de recherche
    var recherche = document.getElementById("valeur_filtre_date").value.toUpperCase();
    
    // Sélectionner tous les éléments de la table
    var lignes = document.querySelectorAll("#tableau_sain tbody tr");

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
  
  function cherche_par_declaration() {
    // Récupérer la valeur saisie dans l'input de recherche
    var recherche = document.getElementById("valeur_filtre_declaration").value.toUpperCase();
    
    // Sélectionner tous les éléments de la table
    var lignes = document.querySelectorAll("#tableau_sain tbody tr");

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


function cherche_par_destinataire() {
    // Récupérer la valeur saisie dans l'input de recherche
    var recherche = document.getElementById("valeur_filtre_destinataire").value.toUpperCase();
    
    // Sélectionner tous les éléments de la table
    var lignes = document.querySelectorAll("#tableau_sain tbody tr");

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
    $(document).ready(function(){
    $(document).on('change','select[data-role=choix_produit_pour_cale]',function(){
  //$('#type').css('display', 'block');

     var produit = $('#produit_cale').val();

    

  



        $.ajax({
        url:'cale_pour_avaries.php',
        method:'post',
        data:{produit:produit},
        success: function(response){
          $('#cale_pour_avaries').html(response);
         // $('#detail_transporteur').modal('toggle');
            

           
     
       
        }
    });


 

  });
});



     $(document).ready(function(){
    $(document).on('click','a[data-role=btn_avaries_debarquement]',function(){
        
   // Mettre à jour le texte de l'option existante
  

        
        
  
        var dates = $('#dateavdeb').val();
        //date=date.replace(' ','');
       // var heure = $('#heuretrav').val();
        var navire = $('#navireavdeb').val();
       // var type = $('#typesain').val();
       // var bl = $('#bltrav').val();
       // var poids_sac = $('#poids_sacavdeb').val();
       // var declaration = $('#declarationtrav').val();
        var cale = $('#cale_pour_avaries').val();
       // var id_dis = $('#id_disavdeb').val();
       // var client = $('#clienttrav').val();
     //   var mangasin = $('#mangasintrav').val();
       // var destinataire = $('#destinatairetrav').val();
      //  var autre_destinataire = $('#autre_destinatairetrav').val();
      //  var val_input3 = $('#val_input3').val();
      //  var val_input3c = $('#val_input3c').val();
        var sacf = $('#sacfavdeb').val();
        var sacm = $('#sacmavdeb').val();
       // var poidsf = $('#poidsftrav').val();
      //  var poidsm = $('#poidsmtrav').val();
        var id_produit = $('#produit_avaries_insert').val();
        var poids_sac = $('#poids_sac_avaries_insert').val();
        $('#Les_avaries2').modal('toggle');
  
        
        $.ajax({
        url:'ajoutavariesdebarquement.php',
        method:'post',
        data:{dates:dates,navire:navire,sacf:sacf,sacm:sacm,cale:cale,id_produit:id_produit,poids_sac:poids_sac},
        success: function(response){
            $('#avaries_debarquement').html(response);

        
        }
    });
    });
});


    $(document).ready(function(){
    $(document).on('click','a[data-role=update_avaries_debarquement]',function(){
        
   var id=$(this).data('id');
   var date=$('#'+id+'dates_avaries').text();
   var sacf=$('#'+id+'sacf_avaries').text();
   var cale=$('#'+id+'cale_avaries').text();
   var sacm=$('#'+id+'sacm_avaries').text();
 //  var id_produit=$('#'.id.'sacm_avaries').text();
 //  var poids_sac=$('#'.id.'poids_sac_avaries').text();
 //  var id_navire=$('#'.id.'id_navire_avaries').text();
    $('#dateavdeb').val(date);
    var navire = $('#navireavdeb').val();

        
        
  
        
          $('#cale_pour_avaries').val(cale);
       
        $('#sacfavdeb').val(sacf);
        $('#sacmavdeb').val(sacm);
        $('#idavdeb').val(id);

       
     //   var sacf = $('#sacfavdeb').val();
      //  var sacm = $('#sacmavdeb').val();

 
       
        $('#save_av').css('display','none');
        $('#update_av2').css('display','block');
        $('#formulaire_avaries').modal('toggle');
      });
}); 
     



    /*    $.ajax({
        url:'ajoutavariesdebarquement.php',
        method:'post',
        data:{dates:dates,navire:navire,sacf:sacf,sacm:sacm,cale:cale,id_produit:id_produit,poids_sac:poids_sac},
        success: function(response){
            $('#avaries_debarquement').html(response);

        
        }
    }); */


function deleteAvariesDebarquement(id){
   
       if(confirm('Voulez vous vraiment supprimer ce donnée?')){
        var id_produit = $('#produit_avaries_insert').val();
        var poids_sac = $('#poids_sac_avaries_insert').val();
        var navire = $('#navire_avaries_insert').val();
        

         //var navire=navires.text();
         
         $.ajax({

              type:'post',
              url:'delete_avaries_debarquement.php',
              data:{delete_id:id,navire:navire,id_produit:id_produit,poids_sac:poids_sac},
              success:function(response){
              
                   $('#avaries_debarquement').html(response);

              }

         });

       }


     }

 

    $(document).ready(function(){
    $(document).on('click','a[data-role=update_les_avdeb]',function(){
       var dates=  $('#dateavdeb').val();
    var navire = $('#navireavdeb').val();
    
     var cale= $('#cale_pour_avaries').val();
       

        var sacf = $('#sacfavdeb').val();
        var sacm = $('#sacmavdeb').val();
        var id = $('#idavdeb').val();
 
        var id_produit = $('#produit_avaries_insert').val();
        var poids_sac = $('#poids_sac_avaries_insert').val();
        var navire = $('#navire_avaries_insert').val();

           $.ajax({
        url:'update_avaries_debarquement.php',
        method:'post',
        data:{dates:dates,navire:navire,sacf:sacf,sacm:sacm,cale:cale,id_produit:id_produit,poids_sac:poids_sac,id:id},
        success: function(response){
            //$('#avaries_debarquement').html(response);
            $('#avaries_debarquement').html(response);
             $('#Les_avaries2').modal('toggle');
        
        }
    }); 
        
  
        
      });
}); 

   


     $(document).ready(function(){
    $(document).on('click','button[data-role=afficher_formulaire_avaries]',function(){
        $('#dateavdeb').val('');
    
    
    
       

        var sacf = $('#sacfavdeb').val('');
        var sacm = $('#sacmavdeb').val('');
        var id = $('#idavdeb').val('');
       
       $('#save_av').css('display','block');
       $('#update_av2').css('display','none');
        $('#main').css('display','none');
       
       $('#formulaire_avaries').modal('toggle');

          
        
  
        
      });
});    
    

</script>


<script type="text/javascript">

  $(document).ready(function(){
    $(document).on('change','select[data-role=goProduitNavireRecond]',function(){
  //$('#type').css('display', 'block');

    var produit = $('#valeur_recond_produit_navire').val();

  



        $.ajax({
        url:'SelectTableRecond.php',
        method:'post',
        data:{produit:produit},
        success: function(response){
            $('#espace_reconditionnement').html(response);
           
     
       
        }
    });


 

  });
});

   $(document).ready(function(){
    $(document).on('change','select[data-role=goNavireRecond]',function(){
  //$('#type').css('display', 'block');

    var navire = $('#valeur_recond_navire').val();

  



        $.ajax({
        url:'SelectProduitRecond.php',
        method:'post',
        data:{navire:navire},
        success: function(response){
            $('#valeur_recond_produit_navire').html(response);
           
     
       
        }
    });


 

  });
}); 



 $(document).ready(function(){
    $(document).on('click','button[data-role=afficher_formulaire_recond]',function(){
        $('#dateavdeb').val('');
    
    
    
       

     /*   var sacf = $('#sacfavdeb').val('');
        var sacm = $('#sacmavdeb').val('');
        var id = $('#idavdeb').val(''); */
       
       $('#save_recs').css('display','block');
       $('#update_rec2').css('display','none'); 
        $('#sac_dechires').val(0);
        $('#sac_obtenus').val(0);
        $('#date_recond').val('');
       
       $('#Les_recond2').modal('toggle');

          
        
  
        
      });
});    
    

   $(document).ready(function(){
    $(document).on('click','a[data-role=btn_recond_debarquement]',function(){
        
   // Mettre à jour le texte de l'option existante
  

        
        
  
        var dates = $('#date_recond').val();
        //date=date.replace(' ','');
       // var heure = $('#heuretrav').val();
        var navire = $('#navire_recond').val();
       // var type = $('#typesain').val();
       // var bl = $('#bltrav').val();
        var poids_sac = $('#poids_sac_avaries_insert_rec').val();
       // var declaration = $('#declarationtrav').val();
    
       // var client = $('#clienttrav').val();
     //   var mangasin = $('#mangasintrav').val();
       // var destinataire = $('#destinatairetrav').val();
      //  var autre_destinataire = $('#autre_destinatairetrav').val();
      //  var val_input3 = $('#val_input3').val();
      //  var val_input3c = $('#val_input3c').val();
        var sac_dechires = $('#sac_dechires').val();
        var sac_obtenus = $('#sac_obtenus').val();
       // var poidsf = $('#poidsftrav').val();
      //  var poidsm = $('#poidsmtrav').val();
        var id_produit = $('#produit_avaries_insert_rec').val();
        $('#Les_recond2').modal('toggle');
  
        
        $.ajax({
        url:'ajoutreconddebarquement.php',
        method:'post',
        data:{dates:dates,navire:navire,poids_sac:poids_sac,sac_obtenus:sac_obtenus,sac_dechires:sac_dechires,id_produit:id_produit},
        success: function(response){
            $('#recond_debarquement').html(response);

        
        }
    });
    });
});


function deleteRecondDebarquement(id){
   
       if(confirm('Voulez vous vraiment supprimer ce donnée?')){
        var id_produit = $('#produit_avaries_insert_rec').val();
        var poids_sac = $('#poids_sac_avaries_insert_rec').val();
        var navire = $('#navire_avaries_insert_rec').val();
        

         //var navire=navires.text();
         
         $.ajax({

              type:'post',
              url:'delete_recond_debarquement.php',
              data:{delete_id:id,navire:navire,id_produit:id_produit,poids_sac:poids_sac},
              success:function(response){
              
                   $('#recond_debarquement').html(response);

              }

         });

       }


     }



   $(document).ready(function(){
    $(document).on('click','a[data-role=update_recond_debarquement]',function(){
        
   var id=$(this).data('id');
   var date=$('#'+id+'dates_avaries').text();
   var sac_dechires=$('#'+id+'sacf_avaries').text();

   var sac_obtenus=$('#'+id+'sacm_avaries').text();
 //  var id_produit=$('#'.id.'sacm_avaries').text();
 //  var poids_sac=$('#'.id.'poids_sac_avaries').text();
 //  var id_navire=$('#'.id.'id_navire_avaries').text();
    $('#date_recond').val(date);
    var navire = $('#navire_avaries_insert_rec').val();

        
        
  
        
         
       
        $('#sac_dechires').val(sac_dechires);
        $('#sac_obtenus').val(sac_obtenus);
        $('#idavdeb').val(id);

              $('#save_recs').css('display','none');
       $('#update_rec2').css('display','block'); 
      

 
     /*  
        $('#save_av').css('display','none');
        $('#update_av2').css('display','block'); */
        $('#Les_recond2').modal('toggle'); 
      });
}); 



$(document).ready(function(){
    $(document).on('click','a[data-role=update_les_recond]',function(){
       var dates=  $('#date_recond').val();
 
    
     
       

        var sac_dechires = $('#sac_dechires').val();
        var sac_obtenus = $('#sac_obtenus').val();
        var id = $('#idavdeb').val();
 
        var id_produit = $('#produit_avaries_insert_rec').val();
        var poids_sac = $('#poids_sac_avaries_insert_rec').val();
        var navire = $('#navire_avaries_insert_rec').val();

           $.ajax({
        url:'update_recond_debarquement.php',
        method:'post',
        data:{dates:dates,navire:navire,sac_dechires:sac_dechires,sac_obtenus:sac_obtenus,id_produit:id_produit,poids_sac:poids_sac,id:id},
        success: function(response){
            $('#recond_debarquement').html(response);
             $('#Les_recond2').modal('toggle');
        
        }
    }); 
        
  
        
      });
});    



$(document).ready(function(){
$(document).on('click','a[data-role=detail_chargement]', function(){

    $('#les_inputs_detail_chargement').css('display','block');

});

});




function verifier_sac_detail1(){
  /*  var sac_cale_val=$('#sac_cale').val();
    var sac_reconditionne_val=$('#sac_reconditionne').val(); */

/*

    var sac_cale=$('#sac_cale').val();
    sac_cale=parseInt(sac_cale);

    var sac_reconditionne=$('#sac_reconditionne').val();
    sac_reconditionne=parseInt(sac_reconditionne);

    var sac=$('#sacsain').val();
    sac=parseInt(sac);

    var sac_exact=sac_reconditionne;
    sac_exact=parseInt(sac_exact);

    var verifier_sac=sac-sac_exact;
    verifier_sac=parseInt(verifier_sac);
    if(sac_exact!=sac){
         $('#register').css('display','none');
        $('#register').prop('disabled',true);
        $('#reste_detail').css('display','table');
        if(verifier_sac>=0){
        $('#reste_detail').text('restant: '+verifier_sac);
        $('#sac_cale').val(verifier_sac);
        } 
                if(verifier_sac<0){
        $('#reste_detail').text('exces de: '+verifier_sac*(-1));

        } 



    }
    else{
        $('#register').css('display','table');
        $('#register').prop('disabled',false); 
        $('#reste_detail').text('restant: '+verifier_sac);
    }

    if(sac_cale_val=='' && sac_reconditionne_val==''){
        $('#register').css('display','table');
        $('#register').prop('disabled',false);  
         $('#reste_detail').css('display','none');
    } */

    var sac_cale=$('#sac_cale').val();
    sac_cale=parseInt(sac_cale);

    var sac_reconditionne=$('#sac_reconditionne').val();
    sac_reconditionne=parseInt(sac_reconditionne);

    var sac=$('#sacsain').val();
    sac=parseInt(sac);

    var verifier_sac=sac-sac_reconditionne;

    if(verifier_sac>=0){
      $('#sac_cale').val(verifier_sac);
    }
       /*
        if(verifier_sac!=0){
         $('#register').css('display','none');
        $('#register').prop('disabled',true);
        $('#reste_detail').css('display','table');
      }
       if(verifier_sac==0){
         $('#register').css('display','table');
        $('#register').prop('disabled',false);
        $('#reste_detail').css('display','table');
      }
      */
    /*    if(verifier_sac>=0){
        $('#reste_detail').text('restant: '+verifier_sac);
        $('#sac_cale').val(verifier_sac);
        } */
        
}




$(document).ready(function(){
$(document).on('click','a[data-role=detail_chargement2]', function(){

    $('#les_inputs_detail_chargement_m_rm').css('display','block');

});

});



function verifier_sac_detail2(){
    var sac_cale_val=$('#sac_cale_m_rm').val();
    var sac_reconditionne_val=$('#sac_reconditionne_m_rm').val();



    var sac_cale=$('#sac_cale_m_rm').val();
    sac_cale=parseInt(sac_cale);

    var sac_reconditionne=$('#sac_reconditionne_m_rm').val();
    sac_reconditionne=parseInt(sac_reconditionne);

    var sac=$('#sac_m_rm').val();
        sac=sac.replace(' ','');
    sac=parseInt(sac);

    var sac_exact=sac_cale+sac_reconditionne;
    sac_exact=parseInt(sac_exact);

    var verifier_sac=sac-sac_exact;
    verifier_sac=parseInt(verifier_sac);
    if(sac_exact!=sac){
         $('#btn_modif_register').css('display','none');
        $('#btn_modif_register').prop('disabled',true);
        $('#reste_detail_m_rm').css('display','table');
        if(verifier_sac>0){
        $('#reste_detail_m_rm').text('restant: '+verifier_sac);
        } 
                if(verifier_sac<0){
        $('#reste_detail_m_rm').text('exces de: '+verifier_sac*(-1));

        } 



    }
    else{
        $('#btn_modif_register').css('display','table');
        $('#btn_modif_register').prop('disabled',false); 
        $('#reste_detail_m_rm').text('restant: '+verifier_sac);
    }

    if(sac_cale_val=='' && sac_reconditionne_val==''){
        $('#btn_modif_register').css('display','table');
        $('#btn_modif_register').prop('disabled',false);  
         $('#reste_detail_m_rm').css('display','none');
    }
}

</script>

<script type="text/javascript">
    function scrollDown() {
    var elements = document.querySelectorAll('#dernierEnregistrement');

    // Vérifier s'il y a des éléments correspondants
    if (elements.length > 0) {
        // Récupérer le dernier élément correspondant
        var lastElement = elements[elements.length - 1];

        // Récupérer la position de l'élément par rapport au haut de la page
        var position = lastElement.getBoundingClientRect().top + window.pageYOffset;

        // Faire défiler la page jusqu'à la position de l'élément
        window.scrollTo({
            top: position,
            behavior: 'smooth' // Pour un défilement fluide
        });
    }
}


    function scrollDownFirst() {
    var elements = document.getElementById('scrollDownBtn');

    // Vérifier s'il y a des éléments correspondants
    if (elements) {
        // Récupérer le dernier élément correspondant
        

        // Récupérer la position de l'élément par rapport au haut de la page
        var position = elements.getBoundingClientRect().top + window.pageYOffset;

        // Faire défiler la page jusqu'à la position de l'élément
        window.scrollTo({
            top: position,
            behavior: 'smooth' // Pour un défilement fluide
        });
    }
}

</script>

<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('click','a[data-role=update_poids_pont]',function(){
      var id =$(this).data('id_pont');
      $('#id_pont').val(id);

        var poids_sac = $('#'+id+'poids_sac_rm').text();
        var produit = $('#'+id+'id_produit_rm').text();
        var destination = $('#'+id+'id_destination_rm').text();
        var navire = $('#'+id+'id_navire_rm').text();
        var client = $('#'+id+'id_client_rm').text();
        var poids_brut = $('#'+id+'poids_brut_rm').text();
        var tare_vehicule = $('#'+id+'tare_vehicule_rm').text();
        var ticket_pont = $('#'+id+'ticket_pont_rm').text();
        var bl = $('#'+id+'bl_rm').text();
        var sac = $('#'+id+'sac_rm').text();
        $('#produit_pont').val(produit);
        $('#poids_sac_pont').val(poids_sac);
        $('#destination_pont').val(destination);
        $('#navire_pont').val(navire);
        $('#client_pont').val(client);
        $('#ticket_pont').val(ticket_pont);
        $('#poids_pont').val(poids_brut);
        $('#nbre_sac_pont').val(sac);
        $('#tare_vehicule').val(tare_vehicule);
        $('#bl_pont').val(bl);

      $('#form_poids_pont').modal('toggle');

    });
  });
/*
$(document).ready(function(){
    $(document).on('click','a[data-role=ajouter_poids_pont]',function(){

        var id =$('#id_pont').val();
       var produit= $('#produit_pont').val();
       var poids_sac= $('#poids_sac_pont').val();
       var destination= $('#destination_pont').val();
      var navire=  $('#navire_pont').val();
       var client= $('#client_pont').val();
      var ticket_pont=$('#ticket_pont').val();
      var poids_pont=$('#poids_pont').val();
      var tare_vehicule=$('#tare_vehicule').val();
       

      


  $.ajax({
        url:'ajouter_poids_pont.php',
        method:'post',
        data:{produit:produit,navire:navire,poids_sac:poids_sac,destination:destination,client:client,ticket_pont:ticket_pont,poids_pont:poids_pont,id:id,tare_vehicule:tare_vehicule},
        success: function(response){
            $('#tbody_transfert_deb').html(response);
           
       $('#form_poids_pont').modal('toggle');
       
        }
    });


 

  });
}); */


$(document).ready(function(){
    $(document).on('click','a[data-role=ajouter_tare]',function(){

        
       var produit= $('#produit_tare').val();
       var poids_sac= $('#poids_sac_tare').val();
       var destination= $('#destination_tare').val();
      var navire=  $('#navire_tare').val();
       var client= $('#client_tare').val();
      var tare_sac=$('#tare_sac').val();
     

      


  $.ajax({
        url:'controller/ajouter_tare_sac.php',
        method:'post',
        data:{produit:produit,navire:navire,poids_sac:poids_sac,destination:destination,client:client,tare_sac:tare_sac},
        success: function(response){
            $('#info_tare').html(response);
           
       $('#form_tare_sac').modal('toggle');
       
        }
    });


 

  });
});


function calcul_poids_pont(){
  var poids_pont=$('#poids_pont').val();
  var tare_vehicule=$('#tare_vehicule').val();
  var val_tare_sac=$('#val_tare_sac').val();
  var nbre_sac=$('#nbre_sac_pont').val();

  var net_pont=poids_pont-tare_vehicule;
  var net_marchand=net_pont/1000-nbre_sac*val_tare_sac/1000;
 // net_marchand=net_marchand.replace(',','.');
   

  $('#net_pont').val(net_pont);
  $('#net_marchand').val(net_marchand);
}






</script>

 </body>
</html>
