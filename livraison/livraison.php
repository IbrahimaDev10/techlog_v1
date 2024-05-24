<?php
require('../database.php');

if(empty($_SESSION['id'])){
  header('location:../index.php');
}
require('controller/access_livraison.php');
//header("Cache-Control: no-cache, must-revalidate");
//header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");


               

/*$naviress=$bdd->prepare("select dis.*, mg.*,nav.* from dispatching as dis 
                 inner join mangasin as mg on dis.id_mangasin=mg.id
                 
                 inner join navire_deb as nav on dis.id_navire=nav.id
                 inner join simar_user as user on user.id_sim_user=mg.id_mangasinier
                 where mg.id_mangasinier=? group by nav.navire");
      $naviress->bindParam(1,$_SESSION['id']);
      $naviress->execute(); */






?>	



<!DOCTYPE html>
<html lang="fr" translate="no">
  <head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
   


	<title>Debarquement</title>

	<!-- Bootstrap CSS-->
    
  <link rel="stylesheet" href="../assets/modules/bootstrap-5.1.3/css/bootstrap.css">
  <!-- Style CSS -->
  <link rel="stylesheet" href="../transfert/css/style.css">
 
   <link rel="stylesheet" href="../assets/css/repAccueil.css">
  <!-- FontAwesome CSS-->
  <link rel="stylesheet" href="../assets/modules/fontawesome6.1.1/css/all.css">
  <!-- Boxicons CSS-->
  <link rel="stylesheet" href="../assets/modules/boxicons/css/boxicons.min.css">
  <!-- Apexcharts  CSS -->
  <link rel="stylesheet" href="../assets/modules/apexcharts/apexcharts.css">
    <link rel="shortcut icon" type="image/png" href="../assets/images/mylogo.ico"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="btn.css">


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
        #p_erreur{
        color:black;
        font-weight: bold;

    }
    .err{
        width: 500px;
        
        background: white;
        vertical-align: middle;
        border: solid;
        border-color: black;
    }
    @keyframes clignoter {
            0% { opacity: 1; }
            50% { opacity: 0; }
            100% { opacity: 1; }
        }


        .ers{
        width: 500px;
       /* height: 300px; */
        background: white;
        vertical-align: middle;
       
    }
    #alerte_excedent{
        width: 500px;
       /* height: 300px; */
        
        vertical-align: middle;
        animation: clignoter 1s infinite;
        color:red !important;
        font-weight: bold;
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
.colaffiches{
  font-size: 14px;
  text-align: center;
  vertical-align: center;
}
#mangasinOption{
  color: red;

}
#lesInfos{
  color: yellow;

}
#lesInfos2{
  color: black;

}
#soustotal{
  color: white;
}
.sain{
  background: yellow;
}
#EnteteRecapStockDep{
  background: black;
  color: white;
  text-align: center;
  vertical-align: middle;
  font-size: 12px;
}
.celrecap{
  text-align: center !important;
  vertical-align: middle !important;
}
.titre_recap{
  
  width: 100%;
  font-size: 20px;

 
}
#div_recap{
  background: white;
 
 
  border: solid;
  border-color: blue;
/*  border-bottom-right-radius: 30%;
  border-bottom-left-radius: 30%; */
 /* border-radius: 80%; */
 margin-bottom: 10px;
}
#RecapStockDep{
  background: blue;
  color: white;
  text-align: center;
  vertical-align: middle;
  font-size: 16px;
}
   

@media (max-width: 1200px){
.tr_data_attente_avaries{
 font-size:10px;
}
}

#th_table_rec{
      background: linear-gradient(to bottom, blue, rgb(0,141,202));
       text-align: center; 
        color: white;
         font-weight: bold;
         font-size:12px;
         vertical-align: middle;

    }
    .tr_data_sain{
  text-align: center;
    vertical-align: middle;
    font-size: 14px !important;
}
.LesOperations{
  background:rgb(0,162,232);
  border: solid;
  border-radius: 40px;
 margin-left: 0;
 margin-right: 0;
 width: 100%;

}
.TitreOperation{
  color: white !important;
}
.lien_debut{
   display: flex;
 justify-content: center;
}
</style>



  <?php include('navbar.php'); ?>
  <!--Topbar -->
  <div class="container-fluid" style="background: white;">
  <div class="row">
    <center> 
    <div class="col-col-md-12 col-col-lg-12">
      <span class="lien_debut"> 
      <a id="partie_deb"  style="display: flex; justify-content: center; color: blue; border:solid; border-color: blue; border-radius: 50px; margin-right: 30px;" data-role="livraison_deb"><i style="color: blue;" class="fas fa-truck" ></i> NAVIRES ISSUS DU DEBARQUEMENT</a>

       <a id="partie_trans" style="display: flex; justify-content: center; color: blue; border:solid; border-color: blue; border-radius: 50px;"  data-role="livraison_trans"><i style="color: blue;" class="fas fa-eye" ></i> </i>NAVIRES ISSUS DU TRANSFERT</a>
       </span>
    </div>
     </center>
  </div>
</div>

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
                 <?php include('../reception/page.php'); ?>
				</li>

				<!-- Divider-->
                <li class="divider" style="font-size: 18px;" data-text="STARTER"> LIVRAISON</li>

                <li>
                    <a href="#">
                        <i class='bx bx-columns icon' ></i> 
                        GESTION DES RELACHES
                        <i class='bx bx-chevron-right icon-right' ></i>
                    </a>
                    <ul class="side-dropdown">
                       
                        
                                                
                    </ul>
                </li>

                       <li> <a style="font-size:12px;"  data-bs-toggle="modal" data-bs-target="#situation_24h">
                        <i class='bx bx-columns icon'  ></i>GESTION DES BONS D'ENLEVEMENT 
                       </a>
                    
                   </li>

                    <li> <a style="font-size:12px;" href="pv_reception.php?id=<?php echo $_GET['id']; ?>">
                        <i class='bx bx-columns icon'  ></i>RECONDITIONNEMENT
                       </a>
                    
                   </li>
                   

                    <li><a   href="situation_de_reception.php?id=<?php echo $_GET['id']; ?>"> <i class='bx bx-columns icon' ></i> MES SITUATIONS</a></li>
                     <li><a   href="reconditionnement.php?id=<?php echo $_SESSION['id']; ?>"> <i class='bx bx-columns icon' ></i> PV DE LIVRAISON</a></li>
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











  
    
  
 
<div id="livraison_issus_debarquement" style="display: none;"> 
<div class="container-fluid1 " id="situation"  style=" background: rgb(0,141,202);" >
        <div class="row">
            
            
                <div class="col-lg-12 col-md-12">
                    <h1 class="hem2" > LIVRAISON</h1><br>

                    
                    <form method="POST" >
                      <?php $a=$_SESSION['id']; ?>
                        <select  id="navires" class="mysel" style="margin-right: 3%; height: 30px;   width: 30%;"  onchange='goNavireSit()'>
                            <option value="">selectionner un navire</option>
                            <?php $naviress=choix_du_navire($bdd,$a);
                            while ($row=$naviress->fetch()) {
                             ?>
                                <option value=<?php echo $row['id_navire'].'-'.$_GET['id']; ?> >  <?php echo $row['navire'] ?> </option>
                            <?php } ?>

                 </select>

                 <select id="client" class="mysel" style="margin-right: 3%; height: 30px;  width: 30%;" onchange='goClient()'>
                            <option  selected>selectionner le client</option>
                        </select>
                        
                     <select id="produit" class="mysel" name="produit" style="margin-right: 3%; height: 30px;  width: 30%;" onchange='goProduit()'>
                            <option  selected>selectionner le produit</option>
                        </select>
                        
                 
                            
                    </form>
                
            </div>
        </div>
    </div>



 
  



    <br><br>
    <div class="sit" id="sit">
    </div>

     <div id="main">
    </div>
        <div id="pv">
    </div>
            <div id="pv_recond">
    </div>

    <div id="situation_bon">
    </div>
        <div id="situation_relache">
    </div>

           <div id="situation_transit">
    </div>

    </div>

<div id="livraison_issus_transfert" style="display: none;">
  <div class="container-fluid1 " id="situation2"  style=" background: rgb(0,141,202);" >
        <div class="row">
            
            
                <div class="col-lg-12 col-md-12">
                    <h1 class="hem2" > LIVRAISON TRANSFERT</h1><br>

                    
                    <form method="POST" >
                      <?php $a=$_SESSION['id']; ?>
                        <select  id="navires_tr" class="mysel" style="margin-right: 3%; height: 30px;   width: 30%;"  onchange='goNavireSit_tr()'>
                            <option value="">selectionner un navire</option>
                            <?php $naviress=choix_du_navire_issus_transfert($bdd,$a);
                            while ($row=$naviress->fetch()) {
                             ?>
                                <option value=<?php echo $row['id_navire'].'-'.$_GET['id']; ?> >  <?php echo $row['navire'] ?> </option>
                            <?php } ?>

                 </select>

                 <select id="client_tr" class="mysel" style="margin-right: 3%; height: 30px;  width: 30%;" onchange='goClient_tr()'>
                            <option  selected>selectionner le client</option>
                        </select>
                        
                     <select id="produit_tr" class="mysel" name="produit" style="margin-right: 3%; height: 30px;  width: 30%;" onchange='goProduit_tr()'>
                            <option  selected>selectionner le produit</option>
                        </select>
                        
                 
                            
                    </form>
                
            </div>
        </div>
    </div>

          <div id="main2">
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

    <!-- Template JS File -->
	<script src="../assets/js/script.js"></script>
	<script src="../assets/js/custom.js"></script>
  <script src="livraison.js"></script>
   
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>




<script type="text/javascript">
    $(document).ready(function(){
    $(document).on('click','a[data-roles=update_livraison_sain]',function(){
      //LES VALEURS DES COLONNES DU TABLEAU
     var id = $(this).data('id');
      var date = $('#'+id+'date_sain').text();
       var heure = $('#'+id+'heure_sain').text();
        var camion = $('#'+id+'camion_sain').text();
         var chauffeur = $('#'+id+'chauffeur_sain').text();
          var sac = $('#'+id+'sac_sain').text();
           var id_dis = $('#'+id+'id_dis_sain').text();
            var dec = $('#'+id+'dec_sain').text();
             var id_dec = $('#'+id+'id_dec_sain').text();
              var rel = $('#'+id+'rel_sain').text();
               var id_rel = $('#'+id+'id_rel_sain').text();
                var bl_fournisseur = $('#'+id+'bl_fournisseur_sain').text();
                 var id_bl_fournisseur = $('#'+id+'id_bl_fournisseur_sain').text();
        /*          var id_produit = $('#'+id+'id_produit_sain').text();
                   var poids_sac = $('#'+id+'poids_kg_sain').text();
                    var id_destination = $('#'+id+'id_destination_sain').text(); */


      var existingOption = $('#dec_liv_update_sain option[value="' + id_dec + '"]');
if (existingOption.length > 0) {
   // Mettre à jour le texte de l'option existante
   existingOption.text(dec);
} else {
   // Ajouter une nouvelle option avec la valeur et le texte correspondants
   var newOption = $('<option>', {
      value: id_dec,
      text: dec
   });
   $('#dec_liv_update_sain').prepend(newOption);
   // Sélectionner l'option par défaut
   newOption.prop('selected', true);
}

 var existingOption = $('#rel_liv_update_sain option[value="' + id_rel + '"]');
if (existingOption.length > 0) {
   // Mettre à jour le texte de l'option existante
   existingOption.text(rel);
} else {
   // Ajouter une nouvelle option avec la valeur et le texte correspondants
   var newOption = $('<option>', {
      value: id_rel,
      text: rel
   });
   $('#rel_liv_update_sain').prepend(newOption);
   // Sélectionner l'option par défaut
   newOption.prop('selected', true);
}

  var existingOption = $('#bl_fournisseur_update_sain option[value="' + id_bl_fournisseur + '"]');
if (existingOption.length > 0) {
   // Mettre à jour le texte de l'option existante
   existingOption.text(bl_fournisseur);
} else {
   // Ajouter une nouvelle option avec la valeur et le texte correspondants
   var newOption = $('<option>', {
      value: id_bl_fournisseur,
      text: bl_fournisseur
   });
   $('#bl_fournisseur_update_sain').prepend(newOption);
   // Sélectionner l'option par défaut
   newOption.prop('selected', true);
}




        //STOCKES LES VALEURS
     $('#date_liv_update_sain').val(date);
      $('#heure_liv_update_sain').val(heure); 
       $('#camion_liv_update_sain').val(camion);
       $('#chauffeur_liv_update_sain').val(chauffeur);
       $('#sac_liv_update_sain').val(sac);
       $('#id_dis_liv_update_sain').val(id_dis);
       $('#bl_fournisseur_update_sain').val(id_bl_fournisseur);
       $('#rel_liv_update_sain').val(id_rel);
       $('#dec_liv_update_sain').val(id_dec);
       $('#id_liv_update_sains').val(id);

    
                   $('#form_update_livraison_sain').modal('toggle');
                   });
                  });

   
$(document).on('click','a[data-roles=click_update_livraison_sain]',function(){ 
     var date = $('#date_liv_update_sain').val();
       var heure= $('#heure_liv_update_sain').val();
        var bl_fournisseur = $('#bl_fournisseur_update_sain').val();
         var camion = $('#camion_liv_update_sain').val();
          
          // var permis = $('#permis_mo').val();
          //  var tel = $('#tel_mo').val();
             var dec = $('#dec_liv_update_sain').val();
              var rel = $('#rel_liv_update_sain').val();
               var sac = $('#sac_liv_update_sain').val();
               var chauf = $('#chauffeur_liv_update_sain').val();
               var id = $('#id_liv_update_sains').val();
               var id_produit = $('#id_produit_update_sain').val();
               var poids_sac = $('#poids_sac_update_sain').val();
               var id_destination = $('#id_destination_update_sain').val();
               var id_navire = $('#id_navire_update_sain').val();

                
                  var id_dis = $('#id_dis_liv_update_sain').val();
                
                    $.ajax({
                      url:'update_livraison_sain.php',
                       method:'post',
                        data:{date:date,heure:heure,bl_fournisseur:bl_fournisseur,camion:camion,dec:dec,rel:rel,sac:sac,chauf:chauf,id_dis:id_dis,id:id,id_produit:id_produit,poids_sac:poids_sac,id_destination:id_destination,id_navire:id_navire},
                         success: function(response){
                        $('#TableLivraison').html(response);
                       $('#form_update_livraison_sain').modal('toggle');
                     }
                   });
                    });  
               
        
</script>



<script type="text/javascript">
    $(document).ready(function(){
    $(document).on('click','a[data-roles=update_livraison_mouille]',function(){
      //LES VALEURS DES COLONNES DU TABLEAU
     var id = $(this).data('id');
      var date = $('#'+id+'date_mouille').text();
       var heure = $('#'+id+'heure_mouille').text();
        var camion = $('#'+id+'camion_mouille').text();
        var chauffeur = $('#'+id+'chauffeur_mouille').text();
        var sac = $('#'+id+'sac_mouille').text();
        var id_dis = $('#'+id+'id_dis_mouille').text();
        var dec = $('#'+id+'dec_mouille').text();
        var id_dec = $('#'+id+'id_dec_mouille').text();
        var rel = $('#'+id+'rel_mouille').text();
        var id_rel = $('#'+id+'id_rel_mouille').text();
        var bl_fournisseur = $('#'+id+'bl_fournisseur_mouille').text();
        var id_bl_fournisseur = $('#'+id+'id_bl_fournisseur_mouille').text();

      var existingOption = $('#dec_liv_update_mouille option[value="' + id_dec + '"]');
if (existingOption.length > 0) {
   // Mettre à jour le texte de l'option existante
   existingOption.text(dec);
} else {
   // Ajouter une nouvelle option avec la valeur et le texte correspondants
   var newOption = $('<option>', {
      value: id_dec,
      text: dec
   });
   $('#dec_liv_update_mouille').prepend(newOption);
   // Sélectionner l'option par défaut
   newOption.prop('selected', true);
}

 var existingOption = $('#rel_liv_update_mouille option[value="' + id_rel + '"]');
if (existingOption.length > 0) {
   // Mettre à jour le texte de l'option existante
   existingOption.text(rel);
} else {
   // Ajouter une nouvelle option avec la valeur et le texte correspondants
   var newOption = $('<option>', {
      value: id_rel,
      text: rel
   });
   $('#rel_liv_update_mouille').prepend(newOption);
   // Sélectionner l'option par défaut
   newOption.prop('selected', true);
}

  var existingOption = $('#bl_fournisseur_update_mouille option[value="' + id_bl_fournisseur + '"]');
if (existingOption.length > 0) {
   // Mettre à jour le texte de l'option existante
   existingOption.text(bl_fournisseur);
} else {
   // Ajouter une nouvelle option avec la valeur et le texte correspondants
   var newOption = $('<option>', {
      value: id_bl_fournisseur,
      text: bl_fournisseur
   });
   $('#bl_fournisseur_update_mouille').prepend(newOption);
   // Sélectionner l'option par défaut
   newOption.prop('selected', true);
}




        //STOCKES LES VALEURS
     $('#date_liv_update_mouille').val(date);
      $('#heure_liv_update_mouille').val(heure); 
       $('#camion_liv_update_mouille').val(camion);
       $('#chauffeur_liv_update_mouille').val(chauffeur);
       $('#sac_liv_update_mouille').val(sac);
       $('#id_dis_liv_update_mouille').val(id_dis);
       $('#bl_fournisseur_update_mouille').val(id_bl_fournisseur);
       $('#rel_liv_update_mouille').val(id_rel);
       $('#dec_liv_update_mouille').val(id_dec);
       $('#id_liv_update_mouille').val(id);

    
                   $('#form_update_livraison_mouille').modal('toggle');
                   });
                  });

   
$(document).on('click','a[data-roles=click_update_livraison_mouille]',function(){ 
     var date = $('#date_liv_update_mouille').val();
       var heure= $('#heure_liv_update_mouille').val();
        var bl_fournisseur = $('#bl_fournisseur_update_mouille').val();
         var camion = $('#camion_liv_update_mouille').val();
          
          // var permis = $('#permis_mo').val();
          //  var tel = $('#tel_mo').val();
             var dec = $('#dec_liv_update_mouille').val();
              var rel = $('#rel_liv_update_mouille').val();
               var sac = $('#sac_liv_update_mouille').val();
               var chauf = $('#chauffeur_liv_update_mouille').val();
               var id = $('#id_liv_update_mouille').val();

                
                  var id_dis = $('#id_dis_liv_update_mouille').val();
                
                    $.ajax({
                      url:'update_livraison_mouille.php',
                       method:'post',
                        data:{date:date,heure:heure,bl_fournisseur:bl_fournisseur,camion:camion,dec:dec,rel:rel,sac:sac,chauf:chauf,id_dis:id_dis,id:id},
                         success: function(response){
                        $('#TableMouille').html(response);
                       $('#form_update_livraison_mouille').modal('toggle');
                     }
                   });
                    });  
               
        
</script>


<script type="text/javascript">
    $(document).ready(function(){
    $(document).on('click','a[data-roles=update_livraison_balayure]',function(){
      //LES VALEURS DES COLONNES DU TABLEAU
     var id = $(this).data('id');
      var date = $('#'+id+'date_bal').text();
       var heure = $('#'+id+'heure_bal').text();
        var camion = $('#'+id+'camion_bal').text();
        var chauffeur = $('#'+id+'chauffeur_bal').text();
        var sac = $('#'+id+'sac_bal').text();
        var id_dis = $('#'+id+'id_dis_bal').text();
        var dec = $('#'+id+'dec_bal').text();
        var id_dec = $('#'+id+'id_dec_bal').text();
        var rel = $('#'+id+'rel_bal').text();
        var id_rel = $('#'+id+'id_rel_bal').text();
        var bl_fournisseur = $('#'+id+'bl_fournisseur_bal').text();
        var id_bl_fournisseur = $('#'+id+'id_bl_fournisseur_bal').text();

      var existingOption = $('#dec_liv_update_balayure option[value="' + id_dec + '"]');
if (existingOption.length > 0) {
   // Mettre à jour le texte de l'option existante
   existingOption.text(dec);
} else {
   // Ajouter une nouvelle option avec la valeur et le texte correspondants
   var newOption = $('<option>', {
      value: id_dec,
      text: dec
   });
   $('#dec_liv_update_balayure').prepend(newOption);
   // Sélectionner l'option par défaut
   newOption.prop('selected', true);
}

 var existingOption = $('#rel_liv_update_balayure option[value="' + id_rel + '"]');
if (existingOption.length > 0) {
   // Mettre à jour le texte de l'option existante
   existingOption.text(rel);
} else {
   // Ajouter une nouvelle option avec la valeur et le texte correspondants
   var newOption = $('<option>', {
      value: id_rel,
      text: rel
   });
   $('#rel_liv_update_balayure').prepend(newOption);
   // Sélectionner l'option par défaut
   newOption.prop('selected', true);
}

  var existingOption = $('#bl_fournisseur_update_balayure option[value="' + id_bl_fournisseur + '"]');
if (existingOption.length > 0) {
   // Mettre à jour le texte de l'option existante
   existingOption.text(bl_fournisseur);
} else {
   // Ajouter une nouvelle option avec la valeur et le texte correspondants
   var newOption = $('<option>', {
      value: id_bl_fournisseur,
      text: bl_fournisseur
   });
   $('#bl_fournisseur_update_balayure').prepend(newOption);
   // Sélectionner l'option par défaut
   newOption.prop('selected', true);
}




        //STOCKES LES VALEURS
     $('#date_liv_update_balayure').val(date);
      $('#heure_liv_update_balayure').val(heure); 
       $('#camion_liv_update_balayure').val(camion);
       $('#chauffeur_liv_update_balayure').val(chauffeur);
       $('#sac_liv_update_balayure').val(sac);
       $('#id_dis_liv_update_balayure').val(id_dis);
       $('#bl_fournisseur_update_balayure').val(id_bl_fournisseur);
       $('#rel_liv_update_balayure').val(id_rel);
       $('#dec_liv_update_balayure').val(id_dec);
       $('#id_liv_update_balayure').val(id);

    
                   $('#form_update_livraison_balayure').modal('toggle');
                   });
                  });

   
$(document).on('click','a[data-roles=click_update_livraison_balayure]',function(){ 
     var date = $('#date_liv_update_balayure').val();
       var heure= $('#heure_liv_update_balayure').val();
        var bl_fournisseur = $('#bl_fournisseur_update_balayure').val();
         var camion = $('#camion_liv_update_balayure').val();
          
          // var permis = $('#permis_mo').val();
          //  var tel = $('#tel_mo').val();
             var dec = $('#dec_liv_update_balayure').val();
              var rel = $('#rel_liv_update_balayure').val();
               var sac = $('#sac_liv_update_balayure').val();
               var chauf = $('#chauffeur_liv_update_balayure').val();
               var id = $('#id_liv_update_balayure').val();

                
                  var id_dis = $('#id_dis_liv_update_balayure').val();
                
                    $.ajax({
                      url:'update_livraison_balayure.php',
                       method:'post',
                        data:{date:date,heure:heure,bl_fournisseur:bl_fournisseur,camion:camion,dec:dec,rel:rel,sac:sac,chauf:chauf,id_dis:id_dis,id:id},
                         success: function(response){
                        $('#TableBalayure').html(response);
                       $('#form_update_livraison_balayure').modal('toggle');
                     }
                   });
                    });  
               
        
</script>

<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('click','a[data-roles=afficher_formulaire_liv_sain]',function(){
      var produit= $(this).data('produit');
      var poids_sac= $(this).data('poids_sac');
      var navire= $(this).data('navire');
      var destination= $(this).data('destination');
      $('#form_livraison').modal('toggle');
      $('#ajout_m').css('display','none');
       $('#ajout_s').css('display','block');
       $('#ajout_bal').css('display','none');
      Update_Time();

         var statut='sain';
          $('#statut').val(statut);

      $.ajax({
                    url:'changer_select_controller.php',
                       method:'post',
                        data:{produit:produit,poids_sac:poids_sac,navire:navire,destination:destination,statut:statut},
                         success: function(response){
                        $('#changer_select').html(response);
                         
                    
                     }
                   });

    });
  });
</script>

<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('click','a[data-roles=afficher_formulaire_liv_mouille]',function(){
      var produit= $(this).data('produit');
      var poids_sac= $(this).data('poids_sac');
      var navire= $(this).data('navire');
      var destination= $(this).data('destination');
      $('#form_livraison').modal('toggle');
      $('#ajout_s').css('display','block');
      $('#ajout_m').css('display','none');
      $('#ajout_bal').css('display','none');

               var statut='mouille';
          $('#statut').val(statut);

      $.ajax({
                    url:'changer_select_controller.php',
                       method:'post',
                        data:{produit:produit,poids_sac:poids_sac,navire:navire,destination:destination,statut:statut},
                         success: function(response){
                        $('#changer_select').html(response);
                         
                    
                     }
                   });

    });
  });
</script>


<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('click','a[data-roles=afficher_formulaire_liv_balayure]',function(){
      var produit= $(this).data('produit');
      var poids_sac= $(this).data('poids_sac');
      var navire= $(this).data('navire');
      var destination= $(this).data('destination');
      $('#form_livraison').modal('toggle');
      $('#ajout_s').css('display','block');
      $('#ajout_m').css('display','none');
      $('#ajout_bal').css('display','none');

               var statut='balayure';
          $('#statut').val(statut);

      $.ajax({
                    url:'changer_select_controller.php',
                       method:'post',
                        data:{produit:produit,poids_sac:poids_sac,navire:navire,destination:destination,statut:statut},
                         success: function(response){
                        $('#changer_select').html(response);
                         
                    
                     }
                   });

    });
  });
</script>


<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('click','a[data-roles=afficher_pv]',function(){
      var id= $(this).data('id');
      $('#pv').css('display', 'block');
      $('#TableLivraison').css('display', 'none');
      $('#TableMouille').css('display', 'none');
      $('#TableBalayure').css('display', 'none');
      $('#TableDeclaration').css('display', 'none');
      $('#TableRelache').css('display', 'none');
      $('#TableEnleve').css('display', 'none');
      $('#TableAvaries').css('display', 'none');
      $('#TableRecond').css('display', 'none');
      $('#pv_recond').css('display', 'none');
      
      $.ajax({
                    url:'selectTablePv.php',
                       method:'post',
                        data:{id:id},
                         success: function(response){
                        $('#pv').html(response);
                         
                    
                     }
                   });
     
    });
  });
</script>


<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('click','a[data-roles=afficher_pv_recond]',function(){
      var id= $(this).data('id');
      var produit= $(this).data('produit');
      var poids_sac= $(this).data('poids_sac');
      var navire= $(this).data('navire');
      var destination= $(this).data('destination');
      $('#pv_recond').css('display', 'block');
      $('#TableLivraison').css('display', 'none');
      $('#TableMouille').css('display', 'none');
      $('#TableBalayure').css('display', 'none');
      $('#TableDeclaration').css('display', 'none');
      $('#TableRelache').css('display', 'none');
      $('#TableEnleve').css('display', 'none');
      $('#TableAvaries').css('display', 'none');
      $('#TableRecond').css('display', 'none');
      $('#pv').css('display', 'none');
     // $('#pv_recond').('toggle');

      
      $.ajax({
                    url:'selectTablePvRecond.php',
                       method:'post',
                        data:{id:id,produit:produit,poids_sac:poids_sac,destination:destination,navire:navire},
                         success: function(response){
                        $('#pv_recond').html(response);
                        
                         
                    
                     }
                   });
    
    });
  });
</script>

<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('click','a[data-roles=situation_bon]',function(){
      var id= $(this).data('id');
      var produit= $(this).data('produit');
      var poids_sac= $(this).data('poids_sac');
      var navire= $(this).data('navire');
      var destination= $(this).data('destination');
      $('#pv_recond').css('display', 'block');
      $('#TableLivraison').css('display', 'none');
      $('#TableMouille').css('display', 'none');
      $('#TableBalayure').css('display', 'none');
      $('#TableDeclaration').css('display', 'none');
      $('#TableRelache').css('display', 'none');
      $('#TableEnleve').css('display', 'none');
      $('#TableAvaries').css('display', 'none');
      $('#TableRecond').css('display', 'none');
      $('#pv').css('display', 'none');

      $('#situation_bon').css('display', 'table');
      $('#situation_relache').css('display', 'none');
      $('#situation_transit').css('display', 'none');
     // $('#pv_recond').('toggle');

      
      $.ajax({
                    url:'situation/situation_bon.php',
                       method:'post',
                        data:{id:id,produit:produit,poids_sac:poids_sac,destination:destination,navire:navire},
                         success: function(response){
                        $('#situation_bon').html(response);
                        
                         
                    
                     }
                   });
    
    });
  });
</script>


<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('click','a[data-roles=situation_relache]',function(){
      var id= $(this).data('id');
      var produit= $(this).data('produit');
      var poids_sac= $(this).data('poids_sac');
      var navire= $(this).data('navire');
      var destination= $(this).data('destination');
      $('#pv_recond').css('display', 'block');
      $('#TableLivraison').css('display', 'none');
      $('#TableMouille').css('display', 'none');
      $('#TableBalayure').css('display', 'none');
      $('#TableDeclaration').css('display', 'none');
      $('#TableRelache').css('display', 'none');
      $('#TableEnleve').css('display', 'none');
      $('#TableAvaries').css('display', 'none');
      $('#TableRecond').css('display', 'none');
      $('#pv').css('display', 'none');
     // $('#pv_recond').('toggle');

      $('#situation_bon').css('display', 'none');
      $('#situation_relache').css('display', 'block');
      $('#situation_transit').css('display', 'none');

      
      $.ajax({
                    url:'situation/situation_relache.php',
                       method:'post',
                        data:{id:id,produit:produit,poids_sac:poids_sac,destination:destination,navire:navire},
                         success: function(response){
                        $('#situation_relache').html(response);
                        
                         
                    
                     }
                   });
    
    });
  });
</script>


<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('click','a[data-roles=situation_transit]',function(){
      var id= $(this).data('id');
      var produit= $(this).data('produit');
      var poids_sac= $(this).data('poids_sac');
      var navire= $(this).data('navire');
      var destination= $(this).data('destination');
      $('#pv_recond').css('display', 'block');
      $('#TableLivraison').css('display', 'none');
      $('#TableMouille').css('display', 'none');
      $('#TableBalayure').css('display', 'none');
      $('#TableDeclaration').css('display', 'none');
      $('#TableRelache').css('display', 'none');
      $('#TableEnleve').css('display', 'none');
      $('#TableAvaries').css('display', 'none');
      $('#TableRecond').css('display', 'none');
      $('#pv').css('display', 'none');
     // $('#pv_recond').('toggle');

           $('#situation_bon').css('display', 'none');
      $('#situation_relache').css('display', 'none');
      $('#situation_transit').css('display', 'table');

      
      $.ajax({
                    url:'situation/situation_transit.php',
                       method:'post',
                        data:{id:id,produit:produit,poids_sac:poids_sac,destination:destination,navire:navire},
                         success: function(response){
                        $('#situation_transit').html(response);
                        
                         
                    
                     }
                   });
    
    });
  });
</script>




<script type="text/javascript">
  function delete_livraison_sain(id){
   
       if(confirm('Voulez vous vraiment supprimer ce donnée?')){
        var dis_bl = $('#'+id+'id_dis_sain').text();
        var id_produit = $('#'+id+'id_produit_sain').text();
        var poids_sac = $('#'+id+'poids_sac_sain').text();
        var id_destination = $('#'+id+'id_destination_sain').text();
        var id_navire = $('#'+id+'id_navire_sain').text();
         //var navire=navires.text();
         
         $.ajax({

              type:'post',
              url:'delete_livraison_sain.php',
              data:{delete_id:id,dis_bl:dis_bl,id_produit:id_produit,poids_sac:poids_sac,id_destination:id_destination,id_navire:id_navire},
              success:function(response){
              
                   $('#TableLivraison').html(response);

              }

         });

       }


     }

 


 </script>

 <script type="text/javascript">
  function delete_livraison_mouille(id){
   
       if(confirm('Voulez vous vraiment supprimer ce donnée?')){
        var dis_bl = $('#'+id+'id_dis_mouille').text();
         //var navire=navires.text();
         
         $.ajax({

              type:'post',
              url:'delete_livraison_mouille.php',
              data:{delete_id:id,dis_bl:dis_bl},
              success:function(response){
              
                   $('#TableMouille').html(response);

              }

         });

       }


     }

 


 </script>


 <script type="text/javascript">
  function delete_livraison_balayure(id){
   
       if(confirm('Voulez vous vraiment supprimer ce donnée?')){
        var dis_bl = $('#'+id+'id_dis_bal').text();
         //var navire=navires.text();
         
         $.ajax({

              type:'post',
              url:'delete_livraison_balayure.php',
              data:{delete_id:id,dis_bl:dis_bl},
              success:function(response){
              
                   $('#TableBalayure').html(response);

              }

         });

       }


     }

 


 </script>

<script type="text/javascript">
  
    $(document).ready(function () {
        $(document).on('click', 'a[data-role=imprimer_bl_sain]', function () {
         var id = $(this).data('id');
            var contentToPrint = $('#vue_bl_sain'+id).html();
            var printWindow = window.open('', '_blank');
             var cssLink = '<link rel="stylesheet" type="text/css" href="../transfert/imprimer_transfert.css">';
             var cssLink2 = '<link rel="stylesheet" type="text/css" href="../assets/modules/bootstrap-5.1.3/css/bootstrap.css">';
        printWindow.document.write('<html><head><title>Impression</title>' + cssLink + cssLink2 + '</head><body>' + contentToPrint + '</body></html>');
           // printWindow.document.write('<html><head><title>Impression</title></head><body>' + contentToPrint + '</body></html>');
            printWindow.document.close();
            printWindow.print(); 
        });
    }); 
</script>

  <script type="text/javascript">
    $(document).ready(function(){
    $(document).on('click','a[data-role=affiche_formulaire_av]',function(){
        //var id_dis = $(this).data('id');
       //var nav = $(this).data('navire');
       //var nav = $(this).data('navire');
       var declaration = $(this).data('declaration');
        //var date = $('#'+id+'date').text();
   
        
       // var date = $('#date_sit_rep').val();
         //var flasque = $('#flasque_sit').val();
         //var mouille = $('#mouille_sit').val();

         //$('#id_dis_rec').val(id_dis);
         //$('#id_navire_rec').val(nav);
         $('#id_declaration_avl').val(declaration);
         //var id_dis = $('#id_dis_rec').val();


         
        
$('#form_avaries_livraison').modal('toggle');

 $(document).ready(function(){
    $(document).on('click','a[data-role=ajout_avl]',function(){


   
    var date = $('#date_avl').val();
    var flasque = $('#flasque_avl').val(); 
    var mouille = $('#mouille_avl').val();
    var id_dis = $('#id_dis_avl').val();
    var produit = $('#id_produit_avl').val();
    var poids_sac = $('#poids_sac_avl').val();
    var destination = $('#id_destination_avl').val();
     var navire = $('#id_navire_avl').val();
     var declaration = $('#id_declaration_avl').val();
        $.ajax({
    url:'insertion_avaries.php',
    method:'post',
    data:{date:date,flasque:flasque,mouille:mouille,id_dis:id_dis,navire:navire,produit:produit,poids_sac:poids_sac,destination:destination,declaration:declaration},
    success: function(response){
       
      $('#TableAvaries').html(response);
      /*$('#'+id).children('td[data-target=cales]').text(cale);
    $('#'+id).children('td[data-target=nom_chargeur]').text(ch);
    $('#'+id).children('td[data-target=conditionnement]').text(cond+' KGS');*/
    $('#form_avaries_livraison').modal('toggle');
    
    }
  });
    });
});

       });
  });
  </script>

   <script type="text/javascript">
    $(document).ready(function(){
    $(document).on('click','a[data-role=affiche_formulaire_reond_liv]',function(){
        //var id_dis = $(this).data('id');
       //var nav = $(this).data('navire');
       //var nav = $(this).data('navire');
       var declaration = $(this).data('declaration');
        //var date = $('#'+id+'date').text();
   
        
       // var date = $('#date_sit_rep').val();
         //var flasque = $('#flasque_sit').val();
         //var mouille = $('#mouille_sit').val();

         //$('#id_dis_rec').val(id_dis);
         //$('#id_navire_rec').val(nav);
         $('#id_declaration_recond').val(declaration);
         //var id_dis = $('#id_dis_rec').val();


         
        
$('#form_reconditionnement').modal('toggle');


      $(document).ready(function(){
    $(document).on('click','a[data-role=ajout_recond]',function(){
                
        var date = $('#date_recond').val();
        var sac_eventres = $('#sac_eventres').val();
        var sacf = $('#sac_recond').val();
       // date=date.replace(' ','');
        var sac_bal = $('#sac_balayure').val();
        var poids_bal = $('#poids_balayure').val();
       
        var id_dis= $('#id_dis_recond').val();
       var navire= $('#navire_recond').val();
        var produit= $('#id_produit_recond').val();
        var poids_sac= $('#poids_sac_recond').val();
        var destination= $('#id_destination_recond').val();
         var declaration= $('#id_declaration_recond').val();

        

        
        $.ajax({
    url:'insert_recond_liv.php',
    method:'post',
    data:{date:date,sac_bal:sac_bal,poids_bal:poids_bal,poids_sac:poids_sac,id_dis:id_dis,navire:navire,produit:produit,destination:destination,sacf:sacf,sac_eventres:sac_eventres,declaration:declaration},
    success: function(response){
      $('#TableRecond').html(response);
      /*$('#'+id).children('td[data-target=cales]').text(cale);
    $('#'+id).children('td[data-target=nom_chargeur]').text(ch);
    $('#'+id).children('td[data-target=conditionnement]').text(cond+' KGS');
    //$('#modif_dec').modal('toggle');*/
    $('#form_reconditionnement').modal('toggle');
    }
  });
    });
});

});
});
</script>


<script type="text/javascript">
   $(document).ready(function(){
    $(document).on('click','a[data-role=livraison_deb]',function(){
      $('#livraison_issus_debarquement').css('display', 'block');
      $('#livraison_issus_transfert').css('display', 'none');
    //  $('#main').css('display', 'none');
      $('#partie_deb').css('background', 'yellow');
      $('#partie_trans').css('background', 'white');
    });
  });

</script>

<script type="text/javascript">
   $(document).ready(function(){
    $(document).on('click','a[data-role=livraison_trans]',function(){
      $('#livraison_issus_transfert').css('display', 'block');
      $('#livraison_issus_debarquement').css('display', 'none');
    //  $('#main').css('display', 'none');
      $('#partie_trans').css('background', 'yellow');
      $('#partie_deb').css('background', 'white');
    });
  });

</script>
 
<script type="text/javascript">
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
  
          function goNavireSit_tr(){
                var xhr = getXhr();
                // On définit ce qu'on va faire quand on aura la réponse
                xhr.onreadystatechange = function(){
                    // On ne fait quelque chose que si on a tout reçu et que le serveur est OK
                    if(xhr.readyState == 4 && xhr.status == 200){
                        leselect = xhr.responseText;
                        // On se sert de innerHTML pour rajouter les options à la liste
                        document.getElementById('client_tr').innerHTML = leselect;

                    }
                }
 
                // Ici on va voir comment faire du post
                xhr.open("POST","selectNavire_tr.php",true);
                // ne pas oublier ça pour le post
                xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
                // ne pas oublier de poster les arguments
                // ici, l'id de l'auteur
                sel = document.getElementById('navires_tr');
                idnavire = sel.options[sel.selectedIndex].value;
                xhr.send("idNavire="+idnavire);
            }    

               function goClient_tr(){
                var xhr = getXhr();
                // On définit ce qu'on va faire quand on aura la réponse
                xhr.onreadystatechange = function(){
                    // On ne fait quelque chose que si on a tout reçu et que le serveur est OK
                    if(xhr.readyState == 4 && xhr.status == 200){
                        lecale = xhr.responseText;
                        // On se sert de innerHTML pour rajouter les options à la liste
                        document.getElementById('produit_tr').innerHTML = lecale;

                    }
                }
 
                // Ici on va voir comment faire du post
                xhr.open("POST","selectClient_tr.php",true);
                // ne pas oublier ça pour le post
                xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
                // ne pas oublier de poster les arguments
                // ici, l'id de l'auteur
                sel = document.getElementById('client_tr');
                idclient = sel.options[sel.selectedIndex].value;
                xhr.send("idClient="+idclient);
            }  

            function goProduit_tr(){
                var xhr = getXhr();
                // On définit ce qu'on va faire quand on aura la réponse
                xhr.onreadystatechange = function(){
                    // On ne fait quelque chose que si on a tout reçu et que le serveur est OK
                    if(xhr.readyState == 4 && xhr.status == 200){
                        lecales = xhr.responseText;
                        // On se sert de innerHTML pour rajouter les options à la liste
                        document.getElementById('main2').innerHTML = lecales;


                    }
                }
 
                // Ici on va voir comment faire du post
                xhr.open("POST","selectTableLivraison_tr.php",true);
                // ne pas oublier ça pour le post
                xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
                // ne pas oublier de poster les arguments
                // ici, l'id de l'auteur

                sel = document.getElementById('produit_tr');
                idproduit = sel.options[sel.selectedIndex].value;
                xhr.send("idProduit="+idproduit);
            } 






function visibleSain() {
    var sain = document.getElementById("TableLivraison");
    var mouille = document.getElementById("TableMouille");
     var balayure = document.getElementById("TableBalayure");
      var relaches = document.getElementById("situation_relache");
      var bons = document.getElementById("situation_bon");
      var transits = document.getElementById("situation_transit");
       var pv_recond = document.getElementById("pv_recond");

    /*var relache = document.getElementById("TableRelache");
     var declaration = document.getElementById("TableDeclaration");
    
    var avaries = document.getElementById("TableAvaries");
     var recond = document.getElementById("TableRecond");
      var enleve = document.getElementById("TableEnleve");
      
       var pv = document.getElementById("pv");
       */
   
      sain.style.display = "table";
       mouille.style.display = "none";
       balayure.style.display = "none";
       relaches.style.display = "none";
       bons.style.display = "none";
       transits.style.display = "none";
       pv_recond.style.display = "none"; 
    /*  relache.style.display = "none";
      declaration.style.display = "none";
     
      avaries.style.display = "none";
      recond.style.display = "none";
      enleve.style.display = "none";
       
       pv.style.display = "none";
       */
   var statut='sain';
    var navire = $('#input_navire').val();
    var produit = $('#input_produit').val();
    var destination = $('#input_destination').val();
    var poids_sac = $('#input_poids_sac').val();
    var table_avaries_deb_visible=1;
  /*  var produit = $(this).data('produit');
    var destination = $(this).data('destination');
    var poids_sac = $(this).data('poids_sac'); */

               $.ajax({
        url:'recuperer_statut_livraison.php',
        method:'post',
        data:{statut:statut,navire:navire,produit:produit,destination:destination,poids_sac:poids_sac/*,table_avaries_deb_visible:table_avaries_deb_visible*/},
        success: function(response){

            $('#TableLivraison').html(response);
          }
          });
    
  }


   function visibleBalayure() {
    var sain = document.getElementById("TableLivraison");
    var mouille = document.getElementById("TableMouille");
     var balayure = document.getElementById("TableBalayure");
      var relaches = document.getElementById("situation_relache");
      var bons = document.getElementById("situation_bon");
      var transits = document.getElementById("situation_transit");
       var pv_recond = document.getElementById("pv_recond");

    /*var relache = document.getElementById("TableRelache");
     var declaration = document.getElementById("TableDeclaration");
    
    var avaries = document.getElementById("TableAvaries");
     var recond = document.getElementById("TableRecond");
      var enleve = document.getElementById("TableEnleve");
      
       var pv = document.getElementById("pv");
       */
   
      sain.style.display = "table";
       mouille.style.display = "none";
       balayure.style.display = "none";
       relaches.style.display = "none";
       bons.style.display = "none";
       transits.style.display = "none";
       pv_recond.style.display = "none"; 
    /*  relache.style.display = "none";
      declaration.style.display = "none";
     
      avaries.style.display = "none";
      recond.style.display = "none";
      enleve.style.display = "none";
       
       pv.style.display = "none";
       */
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
        url:'recuperer_statut_livraison.php',
        method:'post',
        data:{statut:statut,navire:navire,produit:produit,destination:destination,poids_sac:poids_sac/*,table_avaries_deb_visible:table_avaries_deb_visible*/},
        success: function(response){

            $('#TableLivraison').html(response);
          }
          });
    
  }


function visibleMouille() {
    var sain = document.getElementById("TableLivraison");
    var mouille = document.getElementById("TableMouille");
     var balayure = document.getElementById("TableBalayure");
      var relaches = document.getElementById("situation_relache");
      var bons = document.getElementById("situation_bon");
      var transits = document.getElementById("situation_transit");
       var pv_recond = document.getElementById("pv_recond");

    /*var relache = document.getElementById("TableRelache");
     var declaration = document.getElementById("TableDeclaration");
    
    var avaries = document.getElementById("TableAvaries");
     var recond = document.getElementById("TableRecond");
      var enleve = document.getElementById("TableEnleve");
      
       var pv = document.getElementById("pv");
       */
   
      sain.style.display = "table";
       mouille.style.display = "none";
       balayure.style.display = "none";
       relaches.style.display = "none";
       bons.style.display = "none";
       transits.style.display = "none";
       pv_recond.style.display = "none"; 
    /*  relache.style.display = "none";
      declaration.style.display = "none";
     
      avaries.style.display = "none";
      recond.style.display = "none";
      enleve.style.display = "none";
       
       pv.style.display = "none";
       */
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
        url:'recuperer_statut_livraison.php',
        method:'post',
        data:{statut:statut,navire:navire,produit:produit,destination:destination,poids_sac:poids_sac/*,table_avaries_deb_visible:table_avaries_deb_visible*/},
        success: function(response){

            $('#TableLivraison').html(response);
          }
          });
    
  }

 

   $(document).ready(function(){
    $(document).on('click','a[data-role=ajout_liv]',function(){
      var date = $('#date_liv').val();
       var heure= $('#heure_liv').val();
        var bl_fournisseur = $('#bl_fournisseur').val();
         var camion = $('#camion_liv').val();
          var chauf = $('#chauf_liv').val();
           var permis = $('#permis_liv').val();
            var tel = $('#tel_liv').val();
             var dec = $('#dec_liv').val();
              var rel = $('#rel_liv').val();
               var sac = $('#sac_liv').val();
                var id_produit = $('#id_produit_liv').val();
                 var poids_sac = $('#poids_sac_liv').val();
                  var id_dis = $('#id_dis_liv').val();
                   var navire = $('#id_navire_liv').val(); 
                   var destination = $('#id_destination_liv').val(); 
                  // var destination_livraison = $('#destination_livraison').val(); 
                   var bl_simar = $('#bl_simar').val(); 
                   var statut = $('#statut').val(); 
                    $.ajax({
                      url:'insertion_livraison_sain.php',
                       method:'post',
                        data:{date:date,heure:heure,bl_fournisseur:bl_fournisseur,camion:camion,chauf:chauf,permis: permis,tel:tel,dec:dec,rel:rel,sac:sac,id_produit:id_produit,poids_sac:poids_sac,navire:navire,id_dis:id_dis,destination:destination,bl_simar:bl_simar,statut:statut},
                         success: function(response){

                        $('#TableLivraison').html(response);
                       $('#form_livraison').modal('toggle');
                     }
                   });
                });
             });   
 
 function Update_Time(){ 
var maintenant = new Date();
  var heures = maintenant.getHours();
  var minutes = maintenant.getMinutes();

  // Formater l'heure et les minutes pour qu'ils aient toujours deux chiffres (par exemple, 09:05)
  if (heures < 10) heures = "0" + heures;
  if (minutes < 10) minutes = "0" + minutes;

  // Combinez l'heure et les minutes dans le format HH:MM
  var heureActuelle = heures + ":" + minutes;

  // Définir la valeur par défaut du champ d'entrée sur l'heure actuelle
  document.getElementById("heure_liv").value = heureActuelle;
}

</script>
 </body>
</html>
