<?php
require('../database.php');
require('controller/requete_reception.php');
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 

if(empty($_SESSION['id'])){
  header('location:../index.php');
}

//header("Cache-Control: no-cache, must-revalidate");
//header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");


               




?>	



<!DOCTYPE html>
<html lang="fr">
  <head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="google" content="notranslate">
   


	<title>Debarquement</title>

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
        background: white;
        vertical-align: middle;
        animation: clignoter 1s infinite;
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
  color: white;

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
.left{
  float:left;
   width: 47%;
}
.right{
  float:right; 
  width: 47%;
}
.left_conteneur{
  float:left;
   width: 30%;
}
.right_conteneur{
  float:right; 
  width: 30%;
}
.les_th{
  text-align: center;
  vertical-align: middle;
  background: blue;
  color:white;
  font-size: 12px;
}
.les_td{
  text-align: center;
  vertical-align: middle;

}
.les_td2{
  text-align: center;
  vertical-align: middle;
  background: black;
  color: white !important;

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
                     <ul class="side-dropdown">

      <?php if($_SESSION['profil']=="Admin" or $_SESSION['profil']=="superviseur" or $_SESSION['profil']=="Mangasinier" ){ ?>
                       <li><a href="../star_superviseur.php" >ACCUEIL</a></li>
                   <?php } ?>
                   <?php if($_SESSION['profil']=="Admin" or $_SESSION['profil']=="superviseur" ){ ?>
            <li><a href="pre_reception_conteneur.php" >PRE RECEPTION</a></li>
          <?php } ?>
          <?php if($_SESSION['profil']=="Admin" or $_SESSION['profil']=="superviseur" ){ ?>
            <li><a href="debarquement.php" >DEBARQUEMENT</a></li>
          <?php } ?>
      <?php if($_SESSION['profil']=="Admin" or $_SESSION['profil']=="superviseur" or $_SESSION['profil']=="Mangasinier" ){ ?>
            <li><a href="pre_reception_conteneur.php" >PRE RECEPTION</a></li>
          <?php } ?>
    <?php if($_SESSION['profil']=="Admin" or $_SESSION['profil']=="superviseur" or $_SESSION['profil']=="Mangasinier" ){ ?>     
            <li><a href="../reception/rep_accueil.php?id=<?php echo $_SESSION['id']; ?>" >RECEPTION</a></li>
          <?php } ?>
          <?php if($_SESSION['profil']=="Admin" or $_SESSION['profil']=="superviseur" or $_SESSION['profil']=="Mangasinier" ){ ?>
            <li><a href="" >MESSAGERIE</a></li>
          <?php } ?>
          <?php if($_SESSION['profil']=="Admin" or $_SESSION['profil']=="superviseur"  ){ ?>
            <li><a href="" >ARCHIVES</a></li>
          <?php } ?>
          <?php if($_SESSION['profil']=="Admin" or $_SESSION['profil']=="superviseur" or $_SESSION['profil']=="Mangasinier" ){ ?>
            <li><a href="" >FACTURATION</a></li>
          <?php } ?>
            
                                    
                    </ul>
               

				</li>

				<!-- Divider-->
               

				<!-- Divider-->
       </div> 
	 </div>
	</div><!-- End Sidebar-->


	<div class="sidebar-overlay"></div>


	<!--Content Start-->
	<div class="content-start transition">
		<div class="container-fluid dashboard">
			<div class="content-header">
        <div id="infos_ajout_declaration"></div>

 
 

<div class="container-fluid1 " id="situation"  style=" background: rgb(0,141,202);" >
        <div class="row">
            
            
                <div class="col-lg-12 col-md-12">
                    <h1 class="hem2" > RECEPTION CONTENEUR</h1><br>

                    
                    <form method="POST" >
                        <select  id="client" class="mysel" style="margin-right: 3%; height: 30px;   width: 30%;"  data-role='choix_client'>
                            <option value="">selectionner un client</option>
                            <?php
                            $cli=$_SESSION['id'];
                            $client=getclient($bdd,$cli);
                            while ($clients=$client->fetch()) {
                             ?>
                                <option value=<?php echo $clients['idclient'].'-'.$clients['id_mangasinier']; ?> >  <?php echo $clients['client'] ?> </option>
                            <?php } ?>

                 </select>

                 <select id="mangasin" class="mysel" style="margin-right: 3%; height: 30px;  width: 30%;"data-role="choix_mangasin">
                            <option  selected>selectionner le magasin</option>
                        </select>
                        
                     <select id="connaissement" class="mysel" name="produit" style="margin-right: 3%; height: 30px;  width: 30%;" data-role="choix_connaissement">
                            <option  selected>selectionner le numero de connaissement</option>
                        </select>
                        
                 
                            
                    </form>
                
            </div>
        </div>
    </div>



  </div>

<div id="mes_receptions"></div>

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

    <!-- Template JS File -->
	<script src="../assets/js/script.js"></script>
	<script src="../assets/js/custom.js"></script>

   
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script type="text/javascript">
  $(document).ready(function(){
  /*  var client = localStorage.getItem('client');


        if (client) {
            $('#client').val(client);
        } */
        var mangasin = localStorage.getItem('client');
    $(document).on('change','select[data-role=choix_client]', function(){
        client=$('#client').val();
     
      
      $.ajax({
        
        url:'choix_client.php',
        method:'post',
        data:{client,client},
        success: function(response){
          $("#mangasin").html(response);
            localStorage.setItem('client', client);
         // localStorage.setItem('client', client);
          
        }
        });

    });

  });
</script>

<script type="text/javascript">
  $(document).ready(function(){
  /* 

        if (mangasin) {
            $('#mangasin').val(client);
        } */

       var mangasin = localStorage.getItem('mangasin');
    $(document).on('change','select[data-role=choix_mangasin]', function(){
       
       mangasin=$('#mangasin').val();

     
    

      $.ajax({
       
        url:'choix_mangasin.php',
        method:'post',
        data:{mangasin,mangasin},
        success: function(response){
          $("#connaissement").html(response);
           localStorage.setItem('mangasin', mangasin);
           
         //  
          
        }
        });

    });

  });
</script>

<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('change','select[data-role=choix_connaissement]', function(){
      var connaissement=$('#connaissement').val();

      $.ajax({
        url:'choix_connaissement.php',
        method:'post',
        data:{connaissement:connaissement},
        success: function(response){
          $("#mes_receptions").html(response);
          
        }
        });

    });

  });
</script>


<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('click','a[data-role=fermer_connaissement]', function(){
    $("#infos_ajout_connaissement").css('display','none');
   
    });

  });
</script>

<script type="text/javascript">
  $(document).ready(function(){
   $(document).on('keyup','input[data-role=afficher_num_bl]', function(){
    $("#mes_num_bl").css('display','block');
    var search= $("#affiche").val();
    var num= $("#val_num").val();
    if (search=="") {
      $("#mes_num_bl").css('display','none');
    }
    $.ajax({
          url:"afficher_num_bl.php",
          method:"post",
          data:{search:search,num:num},
          success: function(response){
            $("#mes_num_bl").html(response);
          }
    });

   });

  });

  $(document).ready(function(){
   $(document).on('click','a[data-role=stocker_input]', function(){
    var id = $(this).data('id');
    var val=$('#'+id+'num_conteneur').text();
    var poids_kg=$('#'+id+'poids_kg').text();
    $('#affiche').val(val);
     $("#mes_num_bl").css('display','none');
     $('#val_id_num_conteneur').val(id);
     $('#poids_kg').val(poids_kg);


   });
 }); 


</script>

<script type="text/javascript">
  $(document).ready(function(){
   $(document).on('keyup','input[data-role=afficher_num_bl_modif]', function(){
    $("#mes_num_bl_modif").css('display','block');
    var search= $("#affiche_modif").val();
    var num= $("#val_num_modif").val();
    if (search=="") {
      $("#mes_num_bl_modif").css('display','none');
    }
    $.ajax({
          url:"afficher_num_bl_modif.php",
          method:"post",
          data:{search:search,num:num},
          success: function(response){
            $("#mes_num_bl_modif").html(response);
          }
    });

   });

  });


  $(document).ready(function(){
   $(document).on('click','a[data-role=stocker_input]', function(){
    var id = $(this).data('id');
    var val=$('#'+id+'num_conteneur').text();
    var poids_kg=$('#'+id+'poids_kg').text();
    $('#affiche_modif').val(val);
     $("#mes_num_bl_modif").css('display','none');
     $('#val_id_num_conteneur_m').val(id);
     $('#poids_kg_m').val(poids_kg);


   });
 }); 


</script>

<script type="text/javascript">
  $(document).ready(function(){
   $(document).on('click','a[data-role=insertion_reception]', function(){ 
       var dates=$('#dates').val();
       var id_connaissement=$('#val_num').val();
       var sain=$('#sain').val();
       var flasque=$('#flasque').val();
       var mouille=$('#mouille').val();
       var id_num_conteneur=$('#val_id_num_conteneur').val();
       var id_declaration=$('#id_declaration').val();
       var camion=$('#camion').val();
       var id_transporteur=$('#transporteur').val();
       var poids_kg=$('#poids_kg').val();
       $('#enregistrement').modal('toggle');
       $.ajax({
        url:"insertion_reception.php",
        method:"post",
        data:{dates:dates,id_connaissement:id_connaissement,sain:sain,flasque:flasque,mouille:mouille,id_num_conteneur:id_num_conteneur,id_declaration:id_declaration,camion:camion,id_transporteur:id_transporteur,poids_kg:poids_kg},
        success: function(response){
          $('#afficher_reception').html(response);
          $('#enregistrement').modal('toggle');
        }

       });

          });
 });

</script>

<script type="text/javascript">
  $(document).ready(function(){
   $(document).on('click','a[data-role=modifier_conteneur]', function(){ 
   var id = $(this).data('id');
      var dates=$('#'+id+'dates_rec').text();
      var sain=$('#'+id+'sain_rec').text();
      var flasque=$('#'+id+'flasque_rec').text();
      var mouille=$('#'+id+'mouille_rec').text();
      var camion=$('#'+id+'camion_rec').text();
      var num_conteneur=$('#'+id+'num_conteneur_rec').text();
      var poids_kg=$('#'+id+'poids_kg_rec').text();
       var id_num_conteneur=$('#'+id+'id_num_conteneur_rec').text();
       var transporteur=$('#'+id+'transporteur_rec').text();
       var id_transporteur=$('#'+id+'id_transporteur_rec').text();
      $('#dates_m').val(dates);
      $('#sain_m').val(sain);
      $('#flasque_m').val(flasque);
      $('#mouille_m').val(mouille);
       $('#camion_m').val(camion);
       $('#poids_kg_m').val(poids_kg);
       $('#affiche_modif').val(num_conteneur);
       $('#val_id_num_conteneur_m').val(id_num_conteneur);
       var id_connaissement=$('#val_num_modif').val();

               var existingOption = $('#transporteur_m option[value="' + id_transporteur + '"]');
if (existingOption.length > 0) {
   // Mettre à jour le texte de l'option existante
   existingOption.text(transporteur);
} else {
   // Ajouter une nouvelle option avec la valeur et le texte correspondants
   var newOption = $('<option>', {
      value: id_transporteur,
      text: transporteur
   });
   $('#transporteur_m').prepend(newOption);
   // Sélectionner l'option par défaut
   newOption.prop('selected', true);
}
$('#transporteur_m').val(id_transporteur);
      // var id_connaissement=$('#val_num').val();

        $("#form_modifier_conteneur").modal('toggle');

$(document).on('click','a[data-role=modifier_reception]', function(){
   var dates=$('#dates_m').val();
     var sain= $('#sain_m').val();
    var flasque=  $('#flasque_m').val();
     var mouille= $('#mouille_m').val();
     var camion = $('#camion_m').val();
     var poids_kg=  $('#poids_kg_m').val();
     var id_transporteur=$('#transporteur_m').val();
      
     var id_num_conteneur=  $('#val_id_num_conteneur_m').val();
  
   $.ajax({
    
        url:"modifier_reception.php",
        method:"post",
        data:{dates:dates,sain:sain,flasque:flasque,mouille:mouille,id_num_conteneur:id_num_conteneur,camion:camion,id_transporteur:id_transporteur,poids_kg:poids_kg,id_connaissement:id_connaissement,id:id},
        success: function(response){
          $('#afficher_reception').html(response);
          $('#form_modifier_conteneur').modal('toggle');
        }

       });



});
          });
 });

</script>


 <script type="text/javascript">
  function delete_reception(id){
   
       if(confirm('Voulez vous vraiment supprimer ce donnée?')){
       
         var id_connaissement = $('#'+id+'id_connaissement').text();
         //var navire=navires.text();
         //$("#masquage").hide();
         //$('#frontend').css('display', 'none');
         
         $.ajax({

              type:'post',
              url:'delete_reception.php',
              data:{id:id,id_connaissement:id_connaissement},
              success:function(response){
              
                   $('#afficher_reception').html(response);

              }

         });

       }


     }

 


 </script>


  

 

 </body>
</html>
