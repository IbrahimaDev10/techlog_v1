<?php
require('../database.php');
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

$select=$bdd->prepare("SELECT  p.produit,p.qualite,nav.navire,nav.type,cli.client,mang.mangasin,trp.*,trs.*,ch.*, manif.*, cam.*   FROM register_manifeste as manif 
                
                inner join  produit_deb as p on manif.id_produit=p.id 

                inner join navire_deb as nav on manif.id_navire=nav.id 
                
                inner join client as cli on manif.id_client=cli.id
                inner join mangasin as mang on manif.id_destination=mang.id
                
                left join chauffeur as ch on manif.chauffeur=ch.id_chauffeur 
                left join camions as cam on manif.camions=cam.id_camions
                left join transporteur as trp on cam.id_trans=trp.id
                left join transit as trs on manif.id_declaration=trs.id_trans

                   WHERE manif.id_register_manif=? ");

           $select->bindParam(1,$_GET['id']);
           $select->execute();

if(isset($_POST['valider_reception']) ){
  if(!empty($_POST['date']) and !empty($_POST['bl']) and !empty($_POST['chauffeur']) and !empty($_POST['camion']) and !empty($_POST['sac'])) {
$date=$_POST['date'];
$bl=$_POST['bl'];
$chauffeur=$_POST['chauffeur'];
$camions=$_POST['camion'];
$sac=$_POST['sac'];
$manquant=$_POST['manquant'];
$poids_sac=$_POST['poids_sac'];
$client=$_POST['client'];
$destination=$_POST['destination'];
$navire=$_POST['navire'];
$declaration=$_POST['declaration'];
$id_dis_bl=$_POST['id_dis_bl'];
$id_produit=$_POST['id_produit'];
$poids=$sac*$poids_sac/1000;

try{
$insert=$bdd->prepare("INSERT INTO reception(dates_recep,bl_recep,id_dis_recep_bl,id_dec,camion_recep,chauffeur_recep,sac_recep,poids_recep,manquant_recep,id_produit_recep,poids_sac_recep,id_client_recep,id_destination_recep,id_navire_recep) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
  $insert->bindParam(1,$date);
  $insert->bindParam(2,$bl);
  $insert->bindParam(3,$id_dis_bl);
  $insert->bindParam(4,$declaration);
  $insert->bindParam(5,$camions);
  $insert->bindParam(6,$chauffeur);
  $insert->bindParam(7,$sac);
  $insert->bindParam(8,$poids);
  $insert->bindParam(9,$manquant);
  $insert->bindParam(10,$id_produit);
  $insert->bindParam(11,$poids_sac);
  $insert->bindParam(12,$client);
  $insert->bindParam(13,$destination);
  $insert->bindParam(14,$navire);
  $insert->execute();

  $delete=$bdd->prepare("delete from pre_register_reception where id_pre_register_manif=?");
  $delete->bindParam(1,$_GET['id']);
  $delete->execute();
  header("location:rep_accueil.php?id=".$_SESSION['id']);
}

catch(PDOException $e){
    die('Erreur:' .$e->getMessage());
    
}
}
  
 
}

?>	



<!DOCTYPE html>
<html lang="fr">
  <head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


	<title>Debarquement</title>

	<!-- Bootstrap CSS-->
    
  <link rel="stylesheet" href="../assets/modules/bootstrap-5.1.3/css/bootstrap.css">
  <!-- Style CSS -->
  <link rel="stylesheet" href="../transfert/css/style.css">
  <link rel="stylesheet" href="assets/css/stylecell.css">
  <!-- FontAwesome CSS-->
  <link rel="stylesheet" href="../assets/modules/fontawesome6.1.1/css/all.css">
  <!-- Boxicons CSS-->
  <link rel="stylesheet" href="assets/modules/boxicons/css/boxicons.min.css">
  <!-- Apexcharts  CSS -->
  <link rel="stylesheet" href="../assets/modules/apexcharts/apexcharts.css">
    <link rel="shortcut icon" type="image/png" href="../assets/images/mylogo.ico"/>
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
      height: 130px;
    }
    
  
    .fabtn1{
  border: none;
   margin-right: 3px;
  color:rgb(0,141,202);

 }
 .btn1{
  background: linear-gradient(to bottom, blue, #1B2B65); background: linear-gradient(to left, blue, #1B2B65); background: linear-gradient(to top, blue, #1B2B65);
 }
    
 .logoo{

      border-radius: 50px;
       height: 200px;
        width: 200px;
        margin-left: 40%;
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
				<li class="nav-item dropdown dropdown-list-toggle">
					<a class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
					   <i class="fa fa-bell size-icon-1"></i><span class="badge bg-danger notif">4</span>
					</a> 				 
					<div class="dropdown-menu dropdown-list">
						<div class="dropdown-header">Notifications</div>
						<div class="dropdown-list-content dropdown-list-icons">
							<div class="custome-list-notif"> 
							<a href="#" class="dropdown-item dropdown-item-unread">
								<div class="dropdown-item-icon bg-primary text-white">
								  <i class="fas fa-code"></i>
								</div>
								<div class="dropdown-item-desc">
									The Atrana template has the latest update!
								  <div class="time text-primary">3 Min Ago</div>
								</div>
							  </a>

							  <a href="#" class="dropdown-item">
								<div class="dropdown-item-icon bg-info text-white">
								  <i class="far fa-user"></i>
								</div>
								<div class="dropdown-item-desc">
								   Sri asks you for friendship!
								  <div class="time">12 Hours Ago</div>
								</div>
							  </a>

							  <a href="#" class="dropdown-item">
								<div class="dropdown-item-icon bg-danger text-white">
								  <i class="fas fa-check"></i>
								</div>
								<div class="dropdown-item-desc">
									Storage has been cleared, now you can get back to work!
								  <div class="time">20 Hours Ago</div>
								</div>
							  </a>

						  
							  <a href="#" class="dropdown-item">
								<div class="dropdown-item-icon bg-info text-white">
								  <i class="fas fa-bell"></i>
								</div>
								<div class="dropdown-item-desc">
								    Welcome to Atrana Template, I hope you enjoy using this template!
								  <div class="time">Yesterday</div>
								</div>
							  </a>
 
							</div>
						</div>

						<div class="dropdown-footer text-center">
						  <a href="#">View All</a>
						</div>

					  
				  </li>
			 
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


                       <li><a href="../star_superviseur.php" >ACCUEIL</a></li>
            <li><a href="gestion_donnees.php" >GESTION DE DONNEES</a></li>
            <li><a href="debarquement.php" >DEBARQUEMENT</a></li>
            
            <li><a href="" >LIVRAISON</a></li>
            <li><a href="" >RECEPTION</a></li>
            <li><a href="" >MESSAGERIE</a></li>
            <li><a href="" >ARCHIVES</a></li>
            <li><a href="" >FACTURATION</a></li>
            
                                    
                    </ul>
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

                       <li><a  data-bs-toggle="modal" data-bs-target="#Les_avaries">
                        <i class='bx bx-columns icon' ></i>AJOUTER AVARIES
                       </a>
                   </li>
                   

                    <li><a   href="tr.situations.php"> <i class='bx bx-columns icon' ></i> MES SITUATION</a></li>
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


     <div class="" id="cli">
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
    <?php while($row=$select->fetch()){ ?>
    <label>DATE</label>  
   <input type="date" id="exampleFormControlInput1" class="form-control" id="exampleFormControlInput1"   name="date" value="<?php echo htmlspecialchars($row['dates']); ?>"><br>
  
    <label>BL</label>
    <input style="height: 25px;" type="text" class="form-control"   placeholder="chauffeur" name="bl" value="<?php echo htmlspecialchars($row['bl']);  ?>" ><br>
     <label>CAMION</label>
     <input style="height: 25px;" type="text" class="form-control"  id="exampleFormControlInput1"  name="camion" value="<?php echo htmlspecialchars($row['num_camions'])  ?>" ><br>
     <label>CHAUFFEUR</label>
      <input style="height: 25px;" type="text" class="form-control"  id="exampleFormControlInput1"  name="chauffeur" value="<?php echo htmlspecialchars($row['nom_chauffeur']);  ?>" ><br>
      <label>SAC</label>
        <input style="height: 25px;" type="text" class="form-control"  id="exampleFormControlInput1"  name="sac" value="<?php echo htmlspecialchars($row['sac']);  ?>" ><br>
        
         <label>MANQUANT</label>
        <input style="height: 25px;" type="text" class="form-control"  id="exampleFormControlInput1"  name="manquant" value="0" ><br>
                
       
       <div style="display: none;" >
       
         <label>poids sac</label>
        <input style="height: 25px;" type="text" class="form-control"  id="exampleFormControlInput1"  name="poids_sac" value="<?php echo htmlspecialchars($row['poids_sac']);  ?>" >
         
         <label>id_produit</label>
        <input style="height: 25px;" type="text" class="form-control"  id="exampleFormControlInput1"  name="id_produit" value="<?php echo htmlspecialchars($row['id_produit']);  ?>" >
        <label>id_dis</label>
        <input style="height: 25px;" type="text" class="form-control"  id="exampleFormControlInput1"  name="id_dis_bl" value="<?php echo htmlspecialchars($row['id_dis_bl']);  ?>" >
          <label>DEC</label>
        <input style="height: 25px;" type="text" class="form-control"  id="exampleFormControlInput1"  name="declaration" value="<?php echo htmlspecialchars($row['id_declaration']);  ?>" >
         <label>CLI</label>
        <input style="height: 25px;" type="text" class="form-control"  id="exampleFormControlInput1"  name="client" value="<?php echo $row['id_client'];  ?>" >
         <label>des</label>
        <input style="height: 25px;" type="text" class="form-control"  id="exampleFormControlInput1"  name="destination" value="<?php echo $row['id_destination'];  ?>" >
         <label>NAVIRE</label>
        <input style="height: 25px;" type="text" class="form-control"  id="exampleFormControlInput1"  name="navire" value="<?php echo htmlspecialchars($row['id']);  ?>" >
        
        </div>

    <?php } ?>
</div>


</center>



         <center>
        <button  type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="valider_reception">valider</button>
</form> 
      </div>   
      <div class="modal-footer">
 
        
      </div>
    </div>
  </div>
</div>


         
     <div >
        
         

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


 
   







 </body>
</html>
