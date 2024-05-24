<?php
require('../database.php');

if(empty($_SESSION['id'])){
  header('location:../index.php');
}
require('controller/acces_transfert.php');
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
<html lang="fr">
  <head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
   


	<title>Demande de transfert</title>

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











  
    <div style="top: 0; background: blue; ">
      <center>
      <a style="color: white;" data-bs-toggle="modal" data-bs-target="#form_demande">Ajouter un transfert</a>   <a style="color: white;" data-bs-toggle="modal" data-bs-target="#form_declaration">Ajouter une declaration</a>
         </center></div>
  
 

<div class="modal fade" id="form_demande" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog">
    <div class="modal-content" style=" border: solid; border-color:rgb(0,141,202); ">
            <div class="modal-header" style="">
            
            
               
                    <h1 class="hem2" > ORDRE DE TRANSFERT</h1><br>
                  </div>

                <div class="modal-body">   
                    <form method="POST" >
                      <?php  ?>
                      <center>

                        <select  id="navire" class="mysel" style="" data-role="choix_navire" >
                            <option value="">selectionner un navire</option>
                            <?php $navire=navire($bdd);
                            while ($row=$navire->fetch()) {
                             ?>
                                <option value=<?php echo $row['id']; ?> >  <?php echo $row['navire'] ?> </option>
                            <?php } ?>

                 </select> <br><br>

                 
                        
                     <select id="connaissement" class="mysel" name="produit" style="max-width: 200px;" >
                            <option  selected>selectionner le connaissement</option>
                        </select><br><br>

                        <select id="destination" class="mysel" name="produit" style="" onchange='goProduit()'>
                            <option  selected>destinataire</option>
                            <?php $mangasin=mangasin($bdd);
                            while ($mang=$mangasin->fetch()) {
                             ?>
                                <option value=<?php echo $mang['id']; ?> >  <?php echo $mang['mangasin'] ?> </option>
                            <?php } ?>
                        </select><br><br>
                        <input id="quantite" type="text" placeholder="quantite" ><br><br>

                        <a class="btn btn-primary" id="ajouter" data-role="ajouter">valider</a>
                        </center>
                        
                 
                            
                    </form>
                
            </div>
        </div>
    </div>
     </div>


    <div class="modal fade" id="form_declaration" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog">
    <div class="modal-content" style=" border: solid; border-color:rgb(0,141,202); ">
            <div class="modal-header" style="">
            
            
               
                    <h1 class="hem2" > ORDRE DE TRANSFERT</h1><br>
                  </div>

                <div class="modal-body">   
                    <form method="POST" >
                      <?php  ?>
                      <center>

                        <select  id="navire_dec" class="mysel" style="" data-role="choix_navire_dec" >
                            <option value="">selectionner un navire</option>
                            <?php $navire=navire($bdd);
                            while ($row=$navire->fetch()) {
                             ?>
                                <option value="<?php echo $row['id']; ?>" >  <?php echo $row['navire'] ?> </option>

                            <?php } ?>

                 </select> <br><br>

                 
                        
                     <select id="connaissement_dec" class="mysel" name="produit" style="max-width: 200px;" >
                            <option  selected>selectionner le connaissement</option>
                        </select><br><br>

                        <select id="destination" class="mysel" name="produit" style="" onchange='goProduit()'>
                            <option  selected>destinataire</option>
                            <?php $mangasin=mangasin($bdd);
                            while ($mang=$mangasin->fetch()) {
                             ?>
                                <option value=<?php echo $mang['id']; ?> >  <?php echo $mang['mangasin'] ?> </option>
                            <?php } ?>
                        </select><br><br>
                        <input id="num_dec" type="text" placeholder="numero de declaration" ><br><br>
                        <input id="quantite_dec" type="text" placeholder="quantite" ><br><br>

                        <a class="btn btn-primary" id="ajouter" data-role="ajouter_dec_transfert">valider</a>
                        </center>
                        
                 
                            
                    </form>
                
            </div>
        </div>
    </div>
     </div>

<div id=infos></div>

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
    $(document).on('change','select[data-role=choix_navire]',function(){

         var navire=$('#navire').val();
   

        $.ajax({
    url:'afficher_connaissement.php',
    method:'post',
    data:{navire:navire},
    success: function(response){
      $('#connaissement').html(response);

    }
  });
    });
});



</script>

   <script type="text/javascript">
    $(document).ready(function(){
    $(document).on('change','select[data-role=choix_navire_dec]',function(){

         var navire=$('#navire_dec').val();
   

        $.ajax({
    url:'afficher_connaissement.php',
    method:'post',
    data:{navire:navire},
    success: function(response){
      $('#connaissement_dec').html(response);

    }
  });
    });
});



</script>

 <script type="text/javascript">
    $(document).ready(function(){
    $(document).on('click','a[data-role=ajouter]',function(){

        
         var connaissement=$('#connaissement').val();
         var quantite=$('#quantite').val();
         var destination=$('#destination').val();
   

        $.ajax({
    url:'ajouter_transfert.php',
    method:'post',
    data:{connaissement:connaissement,quantite:quantite,destination:destination},
    success: function(response){
      $('#infos').html(response);

    }
  });
    });
});


    $(document).ready(function(){
    $(document).on('click','a[data-role=ajouter_dec_transfert]',function(){

        
         var connaissement=$('#connaissement_dec').val();
         var quantite=$('#quantite_dec').val();
         var num_dec=$('#num_dec').val();
   

        $.ajax({
    url:'ajouter_declaration_transfert.php',
    method:'post',
    data:{connaissement:connaissement,quantite:quantite,num_dec:num_dec},
    success: function(response){
      $('#infos').html(response);
      $('#form_declaration').modal('toggle');

    }
  });
    });
});



</script>


 

 </body>
</html>
