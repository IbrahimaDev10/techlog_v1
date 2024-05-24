<?php
require('../database.php');
if(empty($_SESSION['id'])){
  header('location:../index.php');
}
require('controller/requete.php');
//header("Cache-Control: no-cache, must-revalidate");
//header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");


               




?>	



<!DOCTYPE html>
<html lang="fr">
  <head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
   


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

   <div class="container-fluid LesOperations"    >
        <div class="row">
         
          
            <div class="col col-md-4 col-lg-4" >
                <center>  
                    <a style="background: black;" id="btn_pre_debarquement"  class="btn " data-bs-target="#ajouter" data-bs-toggle="modal" ><i class="fas fa-add">  </i>
                        AJOUTER NOUVEAU CONNAISSEMENT
                    </a>
                    </center>
                    
                
            </div>

            <div class="col col-md-4 col-lg-4" >
                <center>  
                    <a id="btn_pre_debarquement"  class="btn " data-bs-target="#ajouter_declaration" data-bs-toggle="modal" ><i class="fas fa-add">  </i>
                        AJOUTER DECLARATION
                    </a>
                    </center>
                    
                
            </div>

                     <div class="col col-md-4 col-lg-4">
                <center>  
                    <a id="btn_debarquement" href="../transfert/tr_manifest.php" class="btn "  > <i class="fas fa-eye"> </i>
                        MES CONTENEURS
                    </a>
                    
                    </center>
                
            </div> 
              
           
    </div>
 </div>
 <?php if(!empty($inf)){ ?>
         <center>
  <div id="infos_ajout_connaissement" style="background: white; width: 50%;" >
    <center><a class="btn-close"  data-role="fermer_connaissement" ></a></center>
    <p>VEUILLEZ COMPLETER TOUS LES CHAMPS</p>
  </div>
     </center>
   <?php } ?>
 
 <div class="modal fade" id="ajouter_declaration" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header" style="background: blue">
    </div>
    <div class="modal-body">
      <form method="POST">
      <div class="mb-3">
             

      <label class="left" >NUMERO DECLARATION</label>
      <label class="right" >POIDS MANIFEST</label><br>
      <input class="left" type="text" id="num_dec">
      <input class="right" type="text" id="poids"><br><br>

      
     

            <label class="left" >CONNAISSEMENT</label><br>
      <select style="height: 26px;" class="left"  id="con">
        <?php $connaissement=connaissement($bdd);
        while($con=$connaissement->fetch()){ ?>
          <option value="<?php echo $con['id_bl']; ?>"><?php echo $con['n_bl']; ?></option>
      <?php } ?>
    </select><br><br>
     
      <center>
      <a class="btn btn-primary" id="declaration" data-role="ajout_declaration">AJOUTER</a>
      </center>


      </div>
      </form>
    </div>
  </div>

   </div>
 </div>


  <div class="modal fade" id="ajouter" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header" style="background: blue">
    </div>
    <div class="modal-body">
      <form method="POST">
      <div class="mb-3">
              <label style="width: 100%;" >DATE</label>
           <input style="width: 100%;" type="date" name="dates"><br><br>

      <label class="left" >NUMERO BL</label>
      <label class="right" >COMPAGNIE</label><br>
      <input class="left" type="text" name="bl">
      <input class="right" type="text" name="compagnie"><br><br>

      <label class="left" >CHARGEUR</label>
      <label class="right" >CONSIGNATION</label><br>
      <input class="left" type="text" name="chargeur">
      <input class="right" type="text" name="consignation"><br><br>

            <label class="left" >CLIENT</label>
      <label class="right" >NAVIRE</label><br>
      <select style="height: 26px;" class="left"  name="client">
        <?php $client=client($bdd);
        while($cli=$client->fetch()){ ?>
          <option value="<?php echo $cli['id']; ?>"><?php echo $cli['client']; ?></option>
      <?php } ?>
    </select>
      <input  class="right" type="text" name="navire"><br><br>
          <label class="left" >PORT DE CHARGEMENT</label>
           <label class="left" >DESTINATION</label><br>
      <input class="left" type="text" name="port">
      <select style="height: 26px;" class="right"  name="destination">
        <?php
        $session=$_SESSION['id'];
         $mangasin=mangasin($bdd,$session);
         while($mang=$mangasin->fetch()){ ?>
          <option value="<?php echo $mang['id']; ?>"><?php echo $mang['mangasin']; ?></option>
      <?php } ?>
    </select>
      <center>
      <button class="btn btn-primary" name="ajouter_conteneur">SUIVANT</button>
      </center>


      </div>
      </form>
    </div>
  </div>
   </div>
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

    <!-- Template JS File -->
	<script src="../assets/js/script.js"></script>
	<script src="../assets/js/custom.js"></script>
  <script src="livraison.js"></script>
   
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('click','a[data-role=ajout_declaration]', function(){
      var num_dec=$('#num_dec').val();
      var poids= $('#poids').val();
      var con=$('#con').val();
      $.ajax({
        url:'ajout_declaration.php',
        method:'post',
        data:{num_dec:num_dec,poids:poids,con:con},
        success: function(response){
          $("#infos_ajout_declaration").html(response);
          $("#ajouter_declaration").modal('toggle');
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


  

 

 </body>
</html>
