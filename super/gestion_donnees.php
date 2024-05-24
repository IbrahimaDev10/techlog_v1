<?php
include('../database.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


//require('controller/afficher_declaration.php');
$cacheExpire = 60 * 60; // 1 heure
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

	if(empty($_SESSION['profil'])){
		header('location:../index.php');
	}
	
	

	$navire=$bdd->query("select * from navire_deb order by id desc");
	$navire2=$bdd->query("select * from navire_deb order by id desc");
	$navire3=$bdd->query("select * from navire_deb order by id desc");
	$chercheNav = $bdd->query("select * from navire_deb order by id desc");
	$chercheNav2 = $bdd->query("select * from navire_deb order by id desc");
	$transNav = $bdd->query("select * from navire_deb order by id desc");

$chercheNavDIS = $bdd->query("select * from navire_deb order by id desc");
$client = $bdd->query("select * from client order by id desc");
$mangasin = $bdd->query("select * from mangasin order by id desc");
$NavireDispat = $bdd->query("select * from navire_deb order by id desc");
$NavireDispat2 = $bdd->query("select * from navire_deb order by id desc");

$NavireDispatCli = $bdd->query("select * from navire_deb order by id desc");
$NavireDispatMang = $bdd->query("select * from navire_deb order by id desc");

$CalculNavire=$bdd->query("select count(navire) from navire_deb");
$CalculProduit=$bdd->query("select count(produit) from produit_deb");
$CalculClient=$bdd->query("select count(client) from client");
$CalculTransporteur=$bdd->query("select count(nom) from transporteur");
$CalculAffreteur=$bdd->query("select count(affreteur) from affreteur");
$CalculBanque=$bdd->query("select count(banque) from banque");
$CalculCamions=$bdd->query("select count(num_camions) from camions");
$CalculChauffeur=$bdd->query("select count(nom_chauffeur) from chauffeur");
$CalculMangasinier=$bdd->query("select count(prenom) from simar_user where profil='Mangasinier'");
$CalculMangasin=$bdd->query("select count(mangasin) from mangasin");
$CalculCategories=$bdd->query("select count(nom_categories) from categories");

$LesNavires=$bdd->query("select *  from navire_deb ");
$LesProduits=$bdd->query("select * from categories ");
$LesClients=$bdd->query("select * from client ");
$LesTransporteurs=$bdd->query("select * from transporteur ");
$LesnewProduits=$bdd->query("select * from produit_deb ");

	$MesClients = $bdd->query("select * from client order by id desc");

$transp=$bdd->query("select * from transporteur order by id desc");

$rowchauffeur=$bdd->query("select * from chauffeur ");

$new_mang=$bdd->query('select mg.*,su.* from mangasin as mg left join simar_user as su on su.id_sim_user=mg.id_mangasinier order by mg.mangasin asc ');

$affreteur=$bdd->query('select * from affreteur ');
$banque=$bdd->query('select * from banque ');

	$message="";
	$mes=1;

$anneeclient=$bdd->query("SELECT YEAR(eta) as an
FROM navire_deb
GROUP BY YEAR(eta)");
$anneenavire=$bdd->query("SELECT YEAR(eta) as an
FROM navire_deb
GROUP BY YEAR(eta)");

$anneeProduit=$bdd->query("SELECT YEAR(eta) as an
FROM navire_deb
GROUP BY YEAR(eta)");

$rowcamion=$bdd->query('SELECT c.*, tr.* 
FROM camions as c 
LEFT JOIN transporteur as tr ON c.id_trans = tr.id 
 
ORDER BY c.num_camions ');

$bouton_rowcamion=$bdd->query('SELECT num_camions FROM camions  
 
ORDER BY num_camions ASC LIMIT 30
 
');	

$mangasinier_user=$bdd->query("SELECT us.*,mg.id_mangasinier, mg.mangasin from simar_user as us
 left join mangasin as mg on mg.id_mangasinier=us.id_sim_user where us.profil='Mangasinier' ");

if (isset($_POST['begin_declare'])) {
	if(!empty($_POST['navire'])){
		$nav=$_POST['navire'];
		$Navdec = $bdd->prepare("select id,navire,type from navire_deb where id=? ");
		try {

		 $Navdec->bindParam(1,$nav);

		 $Navdec->execute();
		 $find=$Navdec->fetch();
		 if($find['type']=='SACHERIE'){
		 	header('location:auth3.php?m='.$nav);
		 	$_GET['p']=0;
		 	
		 }
		 else if($find['type']=='VRAQUIER') {
		 	header('location:auth2_cale.php?m='.$nav);
		 }
		
			else{
		$message=1;
		
      
	
	
}

		 
		 
		} catch (Exception $e) {
			
		}
	}
	else{
		header('location:debarquement.php?p='.$mes);
		
      
	}




}
if(isset($_POST['sub'])){
	
	header('location:debarquement.php');
}


if (isset($_POST['begin_dispat'])) {
	if(!empty($_POST['navires'])){
		$nav=$_POST['navires'];
		$Navdec = $bdd->prepare("select id,navire,type from navire_deb where id=? ");
		try {

		 $Navdec->bindParam(1,$nav);

		 $Navdec->execute();
		 $find=$Navdec->fetch();
		 if($find['type']=='SACHERIE'){
		 	header('location:gestion_stock.php?m='.$nav);
		 }
		else if($find['type']=='VRAQUIER'){
		 	header('location:gestion_stock.php?m='.$nav);
		 }
		 else{
		 	header('location:gestion_stock_vrac.php?m='.$nav);
		 }
		} catch (Exception $e) {
			
		}
	}
	else{
		$message=1;

		

	
}
	# code...
}






if (isset($_POST['begin_transit'])) {
	if(!empty($_POST['navire'])){
		$nav=$_POST['navire'];
		$Navdec = $bdd->prepare("select id,navire,type from navire_deb where id=? ");
		try {

		 $Navdec->bindParam(1,$nav);

		 $Navdec->execute();
		 $find=$Navdec->fetch();
		 if($find['type']=='VRAQUIER'){
		 	header('location:auth_transit.php?m='.$nav);
		 }
		else  if($find['type']=='SACHERIE'){
		 	header('location:auth_transit.php?m='.$nav);
		 }
		 else{
		 	header('location:debarquement.php');
		 }
		} catch (Exception $e) {
			
		}
	}
	else{
		$message=1;

		

	
}
	# code...
}

	# code...






$navi=$bdd->query("select * from navire_deb");


?>



<!doctype html>
<html lang="fr">
  <head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
 

	<title>Debarquement</title>
	<link rel="stylesheet" type="text/css" href="gestion_donnees.css">
<link href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" rel="stylesheet">
 

	<!-- Bootstrap CSS-->
	<?php include('link_deb.php'); ?>
	</head>
<body >

<style type="text/css">
	 *{
  font-family: Times New Roman;
 } 
 .fabtn1{
  border: none;
   /*margin-right: 3px;*/
  color:rgb(0,141,202);

 }
 #colRouge{
 	color: red;
 }
 #dateclient{
 	color:white;
 	background:blue;
 	font-size: 20px;
 	font-weight: bold;
 }
 #dateproduit{
 	color:white;
 	background:blue;
 	font-size: 20px;
 	font-weight: bold;
 }
  #datenavire{
 	color:white;
 	background:blue;
 	font-size: 20px;
 	font-weight: bold;
 }
 #colmedium{
 	vertical-align: middle;
 }
 .details{
 	color: black;
 	font-weight: bold;
 	float:left;
 }
 #front_details_clients{
 	color: white;
 	float:left;
 	
 }

.cel_clients{
	color: blue;
	margin-top: 2px;
	font-weight: bolder;
	float: right;
	margin-left: 25px;
	font-size: 15px;
	display: flex; justify-content: center;
	 
}
#celAlign{
	vertical-align: middle;
}
	
</style>
<style type="text/css">
 .full-screen-modal .modal-dialog {
    position: fixed;
    top: 0;
   
    bottom: 0;
    
    margin: 0;
    width: 100%;
    height: 100%;
  }

  .full-screen-modal .modal-content {
    height: 100%;
    width: 100%;
  }

  .logoo{
      border-radius: 50px;
       height: 100px;
        width: 100px;
       
        z-index: 2;
        text-align: center;

    }
    .modal-header-detailsEntrepots{
      
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

    .dataTables_wrapper .dataTables_paginate .paginate_button {
 background: linear-gradient(-45deg, #004362, #0183d0) !important;
  color: white; /* Couleur du texte */
  /* Autres styles de texte, comme la taille, la police, etc. */

}
.dataTables_wrapper .dataTables_paginate .paginate_button.current {
  background-color: black;
  color: white; /* Couleur du texte du bouton actif */
  /* Autres styles de texte pour le bouton actif */
}

</style>

  
  <!--Topbar -->
  
  <br><br><br>
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
									nouveau navire
								  <div class="time text-primary"> il y'a 3 Minutes</div>
								</div>
							  </a>

							  <a href="#" class="dropdown-item">
								<div class="dropdown-item-icon bg-info text-white">
								  <i class="far fa-user"></i>
								</div>
								<div class="dropdown-item-desc">
								  greve niveau du port
								  <div class="time">il y'a 7 semaines</div>
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
	<div class="sidebar transition overlay-scrollbars animate__animated  animate__slideInLeft" style="background: linear-gradient(-45deg, #004362, #0183d0); !important  position: fixed;" >
        <div class="sidebar-content"> 
        	<div id="sidebar">
			
			<!-- Logo -->
			<div class="logo">
				<br>	
					<h2 class="mb-4"><img style="width: 150px; height: 100px;  border-radius: 50%; color: white;" src="../images/mylogo4.png"> </h2>
			</div>

            <ul class="side-menu">
                <li>
					<a  href="" class="active">
						<i class='bx bxs-dashboard icon' ></i> MENU PRINCIPAL
					</a>
		<?php include('page.php'); ?>
				</li>
		
 <?php include('ajout_nouvelle_donnees.php'); ?>
 

				
     <li>
                    <a class="nav-link mt-4" href="#" style="font-size: 11px;">
						<i class='bx bx-data icon bx-4x' style="color: yellow;" ></i> 
						MES DONNEES
						<i class='bx bx-chevron-right icon-right' ></i>
					</a>
                    <ul class="side-dropdown">


                       <li><button style="font-size: 15px;" class="btn text-white "    id="btnNavire" onclick="visible_navire()"> NAVIRES</button></li>
						<li><button style="font-size: 15px;"  class="btn text-white "  onclick="visible_produit()">PRODUITS</button></li>
						<li><button style="font-size: 15px;"  class="btn text-white "  onclick="visible_new_produit()"> VARIETES</button></li>
						<li><button style="font-size: 15px;" class="btn text-white "  onclick="visible_client()"> RECEPTIONNAIRES</button></li>
						<li><button style="font-size: 15px;" class="btn text-white "  onclick="visible_entrepots()"> ENTREPOTS</button></li>
						<li><button style="font-size: 15px;" class="btn text-white "  onclick="visible_affreteur()"> FOURNISSEURS</button></li>
						<li><button style="font-size: 15px;" class="btn text-white "  onclick="visible_banque()"> BANQUES</button></li>
					
						<li><button style="font-size: 15px;" class="btn text-white "  onclick="visible_transporteur()"> TRANSPORTEURS</button></li>
						<li><button style="font-size: 15px;" class="btn text-white "  onclick="visible_chauffeur()"> CHAUFFEURS</button></li>
						<li><button style="font-size: 15px;" class="btn text-white "  onclick="visible_camion()"> CAMIONS</button></li>
						<li><button style="font-size: 15px;" class="btn text-white "  onclick="visible_mangasinier()"> MANGASINIER</button></li>
						                        
                    </ul>
                </li>                              
                                      




				
     				               



               

				<!-- Divider-->
                
  

 




               
            </div>
        </div>

       </div> 
	 </div>
	</div><!-- End Sidebar-->


	<div class="sidebar-overlay"></div>


	<!--Content Start-->
	<div class="content-start transition" style="background: white;
    margin: 0px; border: none; border-radius: 0px; z-index: -5; ">
		<div class="container-fluid dashboard">
			<div class="content-header">
<div class="row">
				<?php 
          if(isset($_GET['p'])){
          	if($_GET['p']==1){
          	
	

			 	               echo '<div style="font-size:70px;" class="alert alert-danger alert-dismissible fade show text-center" role="alert">
  <strong>Veuillez choisir un navire</strong>
  <form method="POST">
  <button type="submit" class="btn-close" data-bs-dismiss="alert" aria-label="Close" name="sub"></button>
  
  </form>
</div>';

}
}



			 ?>
			

				<div class="col-md-6 col-lg-3" >
					<div class="card">
						<div class="card-body" style="background: linear-gradient(-45deg, #004362, #0183d0) !important; border: solid; border-color: yellow;  "  onclick="visible_navire()">
							<div class="row">
								<div class=" col col-4 d-flex align-items-center"  >
									<i class="fas fa-inbox icon-home bg-primary text-light"></i>
								</div>
								
								<div class="col-8">
							   	<h6 style="font-weight: bold; color: white; font-size: 16px;">NAVIRES</h6>
									<?php while($cal=$CalculNavire->fetch()){ ?>
									<h6 style="color:yellow; font-size: 16px;"><a><?php echo $cal['count(navire)']; ?></a></h6>
									<?php } $CalculNavire->closeCursor(); ?>
								</div>
								
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-6 col-lg-3">
					<div class="card">
						<div class="card-body" style="background: linear-gradient(-45deg, #004362, #0183d0) !important; border: solid; border-color: orange;" onclick="visible_new_produit()">
							<div class="row">
								<div class="col-4 d-flex align-items-center">
									<i style="background: orange;" class="fas fa-clipboard-list icon-home  text-light"></i>
								</div>
								<div class="col-8">
									<h6  style="font-weight: bold; color: white; font-size: 16px;"  >VARIETES</h6>
									<?php while($cal=$CalculProduit->fetch()){ ?>
									<h3 style="color:orange; font-size: 16px;"><a><?php echo $cal['count(produit)']; ?></a></h3>
								<?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>
<div class="col-md-6 col-lg-3">
					<div class="card">
						<div class="card-body" style="background: linear-gradient(-45deg, #004362, #0183d0) !important; border: solid; border-color: orange;">
							<div class="row">
								<div class="col-4 d-flex align-items-center">
									<i style="background: orange;" class="fas fa-clipboard-list icon-home  text-light"></i>
								</div>
								<div class="col-8">
									<h6  style="font-weight: bold; color: white; font-size: 16px;" onclick="visible_new_produit()" >PRODUITS</h6>
									<?php while($cal=$CalculCategories->fetch()){ ?>
									<h3 style="color:orange; font-size: 16px;"><a><?php echo $cal['count(nom_categories)']; ?></a></h3>
								<?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>				

				<div class="col-md-6 col-lg-3">
					<div class="card">
						<div class="card-body" style="background: linear-gradient(-45deg, #004362, #0183d0) !important; border: solid; border-color: black;  ">
							<div class="row">
								<div class="col-4 d-flex align-items-center">
									<i style="background: black;" class="fas fa-chart-bar  icon-home  text-light"></i>
								</div>
								<div class="col-8">
									<h6  style="font-weight: bold; color: white; font-size: 16px;">CLIENTS</h6>
									<?php while($cal=$CalculClient->fetch()){ ?>
									<h3 style=" color: white; font-size: 16px;"><a><?php echo $cal['count(client)']; ?></a></h3>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-6 col-lg-3">
					<div class="card">
						<div class="card-body" style="background: linear-gradient(-45deg, #004362, #0183d0) !important; border: solid; border-color: white; ">
							<div class="row">
								<div class="col-4 d-flex align-items-center">
									<i class="fas fa-id-card  icon-home bg-warning text-light"></i>
								</div>
								<div class="col-8">
									<h6 style="font-weight: bold; color: white; font-size: 16px;">TRANSPORTS</h6>
									<?php while($cal=$CalculTransporteur->fetch()){ ?>
										<h3 class="number_nav" style=" color: white; font-size: 16px; "><a><?php echo $cal['count(nom)']; ?></a></h3>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>

				</div>

		<div class="col-md-6 col-lg-3">
					<div class="card">
						<div class="card-body" style="background: linear-gradient(-45deg, #004362, #0183d0) !important; border: solid; border-color: white; ">
							<div class="row">
								<div class="col-4 d-flex align-items-center">
									<i class="fas fa-id-card  icon-home bg-warning text-light"></i>
								</div>
								<div class="col-8">
									<h6 style="font-weight: bold; color: white; font-size: 14px;">FOURNISSEURS</h6>
									<?php while($cal=$CalculAffreteur->fetch()){ ?>
										<h3 class="number_nav" style=" color: white; font-size: 16px; "><a><?php echo $cal['count(affreteur)']; ?></a></h3>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>

				</div>	
	<div class="col-md-6 col-lg-3">
					<div class="card">
						<div class="card-body" style="background: linear-gradient(-45deg, #004362, #0183d0) !important; border: solid; border-color: white; ">
							<div class="row">
								<div class="col-4 d-flex align-items-center">
									<i class="fas fa-id-card  icon-home bg-warning text-light"></i>
								</div>
								<div class="col-8">
									<h6 style="font-weight: bold; color: white; font-size: 16px;">BANQUES</h6>
									<?php while($cal=$CalculBanque->fetch()){ ?>
										<h3 class="number_nav" style=" color: white; font-size: 16px; "><a><?php echo $cal['count(banque)']; ?></a></h3>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>

				</div>

<div class="col-md-6 col-lg-3">
					<div class="card">
						<div class="card-body" style="background: linear-gradient(-45deg, #004362, #0183d0) !important; border: solid; border-color: white; ">
							<div class="row">
								<div class="col-4 d-flex align-items-center">
									<i class="fas fa-id-card  icon-home bg-warning text-light"></i>
								</div>
								<div class="col-8">
									<h6 style="font-weight: bold; color: white; font-size: 16px;">CAMIONS</h6>
									<?php while($cal=$CalculCamions->fetch()){ ?>
										<h3 class="number_nav" style=" color: white; font-size: 16px; "><a><?php echo $cal['count(num_camions)']; ?></a></h3>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>

				</div>	
<div class="col-md-6 col-lg-3">
					<div class="card">
						<div class="card-body" style="background: linear-gradient(-45deg, #004362, #0183d0) !important; border: solid; border-color: white; ">
							<div class="row">
								<div class="col-4 d-flex align-items-center">
									<i class="fas fa-id-card  icon-home bg-warning text-light"></i>
								</div>
								<div class="col-8">
									<h6 style="font-weight: bold; color: white; font-size: 16px;">CHAUFFEURS</h6>
									<?php while($cal=$CalculChauffeur->fetch()){ ?>
										<h3 class="number_nav" style=" color: white; font-size: 16px; "><a><?php echo $cal['count(nom_chauffeur)']; ?></a></h3>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>

				</div>	

<div class="col-md-6 col-lg-3">
					<div class="card">
						<div class="card-body" style="background: linear-gradient(-45deg, #004362, #0183d0) !important; border: solid; border-color: white; ">
							<div class="row">
								<div class="col-4 d-flex align-items-center">
									<i class="fas fa-id-card  icon-home bg-warning text-light"></i>
								</div>
								<div class="col-8">
									<h6 style="font-weight: bold; color: white; font-size: 16px;">MAGASINIER</h6>
									<?php while($cal=$CalculMangasinier->fetch()){ ?>
										<h3 class="number_nav" style=" color: white; font-size: 16px; "><a><?php echo $cal['count(prenom)']; ?></a></h3>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>

				</div>	

<div class="col-md-6 col-lg-3">
					<div class="card">
						<div class="card-body" style="background: linear-gradient(-45deg, #004362, #0183d0) !important; border: solid; border-color: white; ">
							<div class="row">
								<div class="col-4 d-flex align-items-center " >
									<i class="fas fa-id-card  icon-home bg-warning text-light"></i>
								</div>
								<div class="col-8">
									<h6 style="font-weight: bold; color: white; font-size: 16px;">ENTREPÔTS</h6>
									<?php while($cal=$CalculMangasin->fetch()){ ?>
										<h3 class="number_nav" style=" color: white; font-size: 16px; "><a><?php echo $cal['count(mangasin)']; ?></a></h3>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>

				</div>													





<center>
<div  id="calnavire"  style="display: none;"  class="col-md-12">
	
 
      <center>
       
         
          <form>
		<select style="background: blue; color: white; width: 10%; text-align: center; font-size: 24px;" name="datenavire" id="datenavire" style="margin-top: 10px;" onchange="func_date_navire()">
			<option selected="">ANNEE</option>
			<?php while($annee=$anneenavire->fetch()){ ?>
				<option value="<?php echo $annee['an'] ?>" ><?php echo $annee['an']  ?></option>
			<?php } ?>
		</select>


	</form>
	<br>
            
               <div class="table-responsive" > 
                 <table class='table table-hover table-bordered table-striped'  border='2' style="  border-color: black; background: white;" >
                   <thead> 
                   	<td colspan="7" class="titreNavire"> Navires</td>
                     <tr id="entete_navire" >
                     	<th  scope="col" ></th>
                        <th scope="col" >NAVIRES</th>
                       
                           <th  scope="col" >DATE D'ACOSTAGE</th>
                            <th  scope="col" >POIDS MANIFESTES</th>
                          <th  scope="col" >FOURNISSEUR</th>
                           <th  scope="col" >RECEPTIONNAIRES</th>

                            
                               
                               <th  scope="col" > ACTIONS  </th>
                                 </tr>
                               
                                  
                                  </thead>
                                   <tbody style="font-weight: bold;">
                                    <?php 
                                    while($row = $navi->fetch()){
            $a=explode('-', $row['eta']); $b=explode('-', $row['etb']); $d=explode('-', $row['etd']);                       	
      $calculLigne=$bdd->prepare("select count(navire) from navire_deb where id<=?");
      $calculLigne->bindParam(1,$row['id']);
      $calculLigne->execute();
      $cal=$calculLigne->fetch(); 

      $nav_produit = $bdd->prepare("select  n.*, p.*,c.* from navire_deb as n
left join produit_manifest as p on n.id=p.id_navire
left join categories as c on c.id_categories=p.produit_navire where n.id=? ");
       $nav_produit->bindParam(1,$row['id']);
       $nav_produit->execute();
     // $navid= $nav_produit->fetch();              	
                                     ?>
                          <tr class="cellule_navire" border='5' id="<?php echo $row['id'] ?>">
                          	<td ><span style="color: red; margin-left: 0px; " >	<?php echo  $cal['count(navire)']; ?></span> </td>
                         <td id="<?php echo $row['id'].'navire' ?>" > <?php echo  $row['navire']?></td>
                                
                              <td id="<?php echo $row['id'].'etb' ?>" ><?php echo $b[2].'-'.$b[1].'-'.$b[0]; ?> </td>
                             
                            <td  ><?php while($navid= $nav_produit->fetch()){ echo $navid['nom_categories']; ?>: <span style="color: red;"> <?php echo number_format($navid['poids_manifest'], 3,',',' ');  ?>T</span><br>  <?php } ?> </td> 
                          
                         <td id="<?php echo $row['id'].'affreteur_nav' ?>"> <?php echo $row['chatered']; ?></td>
                      	 <td id="<?php echo $row['id'].'client_nav' ?>"> <?php echo $row['client_navire']; ?></td>
                             <td >

   <div class="modal fade" id="vue_details_navire<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content" style="margin-left: 0px;">
          <div class="modal-header-detailsEntrepots" style="background: blue;">
        	 <button style="float: right; top: 0px;" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          <center>
                <h4 class="modal-title fs-10 text-white text-center" id="exampleModalLabel " style="text-align:center;   ">DETAILS NAVIRE: <?php echo $row['navire'] ?></h4></center>
                <center>
              <img class="logoo" src="../images/mylogo.ico" >
             
       </center>
          
        </div>
        <div class="modal-body" style="text-align: left;">
          
         <h6 style="margin-bottom: 1px;"  id="front_details_clients" ><span class="details">LOAD PORT:</span>  <span class="cel_clients" id="<?php echo $row['id'].'load_port' ?>" > <?php echo $row['load_port'];  ?></span></h6><br><br>
    <h6 style="margin-bottom: 1px;" id="front_details_clients" ><span class="details">DESTINATION:</span>  <span class="cel_clients" id="<?php echo $row['id'].'destination' ?>" > <?php echo $row['destination'];  ?></span></h6><br><br>

    

    <h6 style="margin-bottom: 1px;" id="front_details_clients" ><span class="details">ETA:</span>  <span class="cel_clients" > <?php echo $a[2].'-'.$a[1].'-'.$a[0];  ?></span></h6><br><br>

      <h6 style="margin-bottom: 1px;" id="front_details_clients" ><span class="details">ETB:</span>  <span class="cel_clients" id="<?php echo $row['id'].'etb' ?>" > <?php echo $b[2].'-'.$b[1].'-'.$b[0];  ?></span></h6><br><br>

      <h6 style="margin-bottom: 1px;" id="front_details_clients" ><span class="details" >ETD:</span> <span class="cel_clients" id="<?php echo $row['id'].'etd' ?>"> <?php echo $d[2].'-'.$d[1].'-'.$d[0];  ?></span></h6><br><br>

        
          	
          	
         
        </div>
        <div class="modal-footer">
         
        </div>
      </div>
    </div>
  </div>
                       <div style="display: flex; justify-content: center;">

                          	<a  id="<?php echo $row['id'] ?>" name="deleteNavire" type="submit"  class="fabtn1 " onclick="deleteNavire(<?php echo $row['id'] ?>)" > <i class="fa fa-trash  " ></i> </a>
                          	<a class="fabtn" data-role="update_navire" data-id="<?php echo $row['id'] ?>"       id="btnbtn" > <i class="fa fa-edit " ></i></a>
                          	<a id="<?php echo $row['id'] ?>" name="details_nav" type="submit"  class="fabtn1 " data-bs-toggle="modal" data-bs-target="#vue_details_navire<?php echo $row['id'] ?>" onclick="setModalContent(<?php echo $row['id'] ?>)"> <i class="fas fa-info-circle  " ></i> </a></td> 
                          	</div>   
                        </tr>
                      <?php } ?>	
                    </tbody>
                 </table>
             </div>
          </div>

</center>
 


 <div  id="calproduits" class="col-md-12" style="display: none;">
  <div class="card">
    <div class="card-header">
      <center>
        
          <form>
		<select name="dateproduit" id="dateproduit"  onchange="func_date_produit()">
			<option selected="">ANNEE</option>
			<?php while($annee=$anneeProduit->fetch()){ ?>
				<option value="<?php echo $annee['an']; ?>" ><?php echo $annee['an'];  ?></option>
			<?php } ?>
		</select>
        </center>

	</form>
          </div>
            <div class="card-body"> 
               <div class="table-responsive" border=1> 
               	
                 <table class='table table-hover table-bordered table-striped'  border='5' style="border-color: black;" >
                   <thead> 
                     <tr style="color:white; font-weight: bold; background: rgb(0,141,202);  border-color: white; text-align: center;" border='5' >
                     	<th style="border-color:white; vertical-align: middle;" scope="col" > </th>
                        <th style="border-color:white; vertical-align: middle;" scope="col" >PRODUIT</th>
                         
                        <th style="border-color:white; vertical-align: middle;" scope="col" >POIDS</th>
                        <th style="border-color:white; vertical-align: middle;" scope="col" >TAXE DE PORT</th>

                        <th style="border-color:white; vertical-align: middle;" scope="col" > ACTIONS  </th>

                         
                                 </tr>
                                  </thead>
                                   <tbody style="font-weight: bold;">
                                    <?php 
                                    while($row = $LesProduits->fetch()){

                            $calculLigne=$bdd->prepare("select count(nom_categories) from categories where id_categories<=?");
      $calculLigne->bindParam(1,$row['id_categories']);
      $calculLigne->execute();
      $cal=$calculLigne->fetch();

      $calculTonne=$bdd->prepare("select sum(dis.quantite_poids),dis.id_produit, p.*, cat.* from categories as cat
      	left join produit_deb as p on p.id_cat=cat.id_categories
        left join dispat as dis on p.id=dis.id_produit
        
       
                        	where cat.id_categories=? group by cat.id_categories  ");
      $calculTonne->bindParam(1,$row['id_categories']);
      $calculTonne->execute();
       $calT=$calculTonne->fetch();
              	
                                     ?>
                          <tr  style="text-align:center;" border='5' id="<?php echo $row['id_categories'].'delcategories' ?>">
                          	<td ><span style="color: red; margin-left: 0px; " >	<?php echo  $cal['count(nom_categories)']; ?></span> </td>
       
                                 <td id="<?php echo $row['id_categories'].'categorie' ?>" > <?php echo $row['nom_categories']; ?> </td>
                                 
                                 <td><span id="colRouge"><?php if(!empty($calT['sum(dis.quantite_poids)'])){ echo number_format($calT['sum(dis.quantite_poids)'], 3,',',' '). ' T'; } ?> </span></td> 
                                 <td id="<?php echo $row['id_categories'].'taxe' ?>" ><span id="colRouge"><?php echo $calT['taxe_port']; ?> </span></td> 
                                 <td  >
                          	<button  id="<?php echo $row['id_categories'] ?>" name="deleteprod" type="submit"  class="fabtn1 " onclick="deleteProduit(<?php echo $row['id_categories'] ?>)" > <i class="fa fa-trash  " ></i> </button>
                          	<a class="fabtn" type="" name="modify" href="#" data-role="update_categorie" data-id="<?php echo $row['id_categories']; ?>"     id="btnbtn" > <i class="fa fa-edit " ></i></a></td>    
                              </tr>
                      <?php } ?>	
                    </tbody>
                 </table>
                 
             </div>
          </div>
     </div>
  </div>


  <div  id="calmangasinier" class="col-md-12" style="display: none;">
  <div class="card">
    <div class="card-header">
      <center>
        <h1 style="color: white; background:  rgb(0,141,202);" >Mangasinier</h1>
         
          </div>
            <div class="card-body"> 
               <div class="table-responsive" border=1> 
               	
                 <table class='table table-hover table-bordered table-striped'  border='5' style="border-color: black;" >
                   <thead> 
                     <tr style="color:white; font-weight: bold; background: rgb(0,141,202);  border-color: white; text-align: center;" border='5' >
                     	<th style="border-color:white; vertical-align: middle;" scope="col" > </th>
                        <th style="border-color:white; vertical-align: middle;" scope="col" >PRENOM</th>
                         
                        <th style="border-color:white; vertical-align: middle;" scope="col" >NOM</th>
                        <th style="border-color:white; vertical-align: middle;" scope="col" >EMAIL</th>
                        <th style="border-color:white; vertical-align: middle;" scope="col" >TELEPHONE</th>
                        <th style="border-color:white; vertical-align: middle;" scope="col" >ENTREPOT</th>

                        <th style="border-color:white; vertical-align: middle;" scope="col" > ACTIONS  </th>

                         
                                 </tr>
                                  </thead>
                                   <tbody style="font-weight: bold;">
                                    <?php 
                                    while($row = $mangasinier_user->fetch()){

     /*                       $calculLigne=$bdd->prepare("select count(nom_categories) from categories where id_categories<=?");
      $calculLigne->bindParam(1,$row['id_categories']);
      $calculLigne->execute();
      $cal=$calculLigne->fetch();

      $calculTonne=$bdd->prepare("select  sum(dis.poids_t),dis.id_produit, p.*, cat.* from categories as cat
      	left join produit_deb as p on p.id_cat=cat.id_categories
        left join dispatching as dis on p.id=dis.id_produit
        
       
                        	where cat.id_categories=? group by cat.id_categories  ");
      $calculTonne->bindParam(1,$row['id_categories']);
      $calculTonne->execute();
       $calT=$calculTonne->fetch();*/
              	
                                     ?>
                          <tr  style="text-align:center;" border='5' >
                          	<td ><span style="color: red; margin-left: 0px; " >	<?php // echo  $cal['count(nom_categories)']; ?></span> </td>
       
                                 <td id="<?php echo $row['id_sim_user'].'pren' ?>" > <?php echo $row['prenom']; ?> </td>
                                 
                                 <td><?php echo $row['nom']; ?></td> 
                                 <td  ><?php echo $row['email']; ?> </td> 
                                 <td  ><?php echo $row['telephone']; ?> </td> 
                                 <td  ><?php echo $row['mangasin']; ?> </td> 
                                 <td  >
                          	<button  id="<?php echo $row['id_sim_user'] ?>" name="deleteprod" type="submit"  class="fabtn1 " onclick="deleteProdu(<?php echo $row['id_sim_user'] ?>)" > <i class="fa fa-trash  " ></i> </button>
                          	<a class="fabtn" type="" name="modify" href="#" data-role="update_categorie" data-id="<?php echo $row['id_sim_user']; ?>"     id="btnbtn" > <i class="fa fa-edit " ></i></a></td>    
                              </tr>
                      <?php } ?>	
                    </tbody>
                 </table>
                 
             </div>
          </div>
     </div>
  </div>



  <div  id="calnewproduits" class="col-md-12" style="display: none; ">
  
      <center>
       
         
         
            
               <div class="table-responsive" border=1 style=" border-color: orange;"> 
               	
                 <table class='table table-hover table-bordered table-striped'  border='2' style="background: white;"  >
                   <thead> 
                     <tr id="entete_variete" border='2' >
                     	<th   > </th>
                        <th   >PRODUIT</th>
                         
                        <th   >QUALITE</th>
                        

                        <th   > ACTIONS  </th>

                         
                                 </tr>
                                  </thead>
                                   <tbody style="font-weight: bold;">
                                    <?php 
                                    while($row = $LesnewProduits->fetch()){

                            $calculLigne=$bdd->prepare("select count(produit) from produit_deb where id<=?");
      $calculLigne->bindParam(1,$row['id']);
      $calculLigne->execute();
      $cal=$calculLigne->fetch();

      
              	
                                     ?>
                          <tr  class="cellule_variete" border='2' id="<?php echo $row['id'].'delproduit' ?>">
                          	<td ><span style="color: red; margin-left: 0px; " >	<?php echo  $cal['count(produit)']; ?></span> </td>
       
                                 <td id="<?php echo $row['id'].'newproduit' ?>"  > <?php echo $row['produit']; ?> </td>
                                 <td id="<?php echo $row['id'].'qualite' ?>" > <?php echo $row['qualite']; ?> </td>
                                 
                                 
                                 <td  >
                          	<button id="<?php echo $row['id'] ?>" name="deleteprod" type="submit"  class="fabtn1 " onclick="deleteNewProduit(<?php echo $row['id'] ?>)" > <i class="fa fa-trash  " ></i> </button>
                          	<a class="fabtn" type="" name="modify" href="#" data-role="update_newproduit" data-id="<?php echo $row['id']; ?>"       id="btnbtn" > <i class="fa fa-edit " ></i></a></td>    
                              </tr>
                      <?php } ?>	
                    </tbody>
                 </table>
                 
             </div>
          </div>





 <div  id="calclient" class="col-md-12" style="display: none;">
 		
 

      <center>
    
 	
    <form>
		<select name="dateclient" id="dateclient" style="margin-top: 10px;" onchange="func_date_client()">
			<option selected="">ANNEE</option>
			<?php while($annee=$anneeclient->fetch()){ ?>
				<option value="<?php echo $annee['an'] ?>" ><?php echo $annee['an']  ?></option>
			<?php } ?>
		</select>


	</form>
         
               <div class="table-responsive" border=1 > 
               	<center>
                 <table class='table table-hover table-bordered table-striped'  border='2' style="border-color: black; background: white; " >
                   <thead> 
                     <tr id="entete_client"  border='2' >
                     	 <th  scope="col" ></th>
                        
                        <th  scope="col" >RECEPTIONNAIRES</th>
                        <th  scope="col" >PRODUIT</th>
                       
                         <th  scope="col" >TOTAUX</th>
                         <th  scope="col" >CODE PPM</th>
                         <th  scope="col" >ADRESSE</th>
                         <th  scope="col" >TELEPHONE</th>
                         <th  scope="col" >EMAIL</th>
                          
                         	
                         
                     
                        <th  scope="col" >ACTIONS</th>

                         
                                 </tr>
                                  </thead>
                                   <tbody style="font-weight: bold;">
                                    <?php 
                                    while($row = $LesClients->fetch()){
                  $calculLigne=$bdd->prepare("select count(client) from client where id<=? ");
      $calculLigne->bindParam(1,$row['id']);
      $calculLigne->execute();
      $cal=$calculLigne->fetch();

             $cli=$bdd->prepare("select cli.*,dis.id_client,dis.id_produit, p.*,
                     c.* 
                        	from client as cli left join dispat as dis on  dis.id_client=cli.id
                        	left join produit_deb as p on p.id=dis.id_produit
                        	left join categories as c on c.id_categories=p.id_cat  
                        	where cli.id=? group by p.id_cat");
      $cli->bindParam(1,$row['id']);
      $cli->execute();

      $calculTonne=$bdd->prepare("select cli.*, sum(dis.quantite_poids),dis.id_client, p.* from client as cli
        left join dispat as dis on cli.id=dis.id_client
        inner join produit_deb as p on p.id=dis.id_produit 
       
                        	where cli.id=? group by p.id_cat ");
      $calculTonne->bindParam(1,$row['id']);
      $calculTonne->execute();


      $calculCat=$bdd->prepare("select cli.*, sum(dis.quantite_poids),dis.id_client, p.*,c.*,count(c.nom_categories), count(p.id_cat) as tot
       from client as cli 
        left join dispat as dis on cli.id=dis.id_client
        inner join produit_deb as p on p.id=dis.id_produit 
        inner join categories as c on c.id_categories=p.id_cat 
       
                        	where cli.id=?   ");
      $calculCat->bindParam(1,$row['id']);
      $calculCat->execute();
      //$cl=$cli->fetch();              	
       $total=$calculCat->fetch();                              ?>
                          <tr id="<?php echo $row['id'].'delclient' ?>" style="text-align:center;" border='5' >
                          	<td ><span style="color: red; margin-left: 0px; " >	<?php echo  $cal['count(client)']; ?></span> </td>
                          	<td  id="<?php echo $row['id'].'client' ?>"  style="vertical-align: middle;" data_target="clientp" >	<?php echo  $row['client']; ?> </td>
                          	
                          	 
                          	
                          	<td style=" vertical-align: middle;" >
                          		<?php 
                          	 ?>	
                          		<?php while($cl=$cli->fetch()){  echo  $cl['nom_categories'];?> <br><br>  <?php } ?> <span style="background: red;color: white;"><?php  
                          		echo "TOTAL";
                           ?> </span>   </td>
                          	
                          	<td style=" vertical-align: middle;" id="colRouge">	<?php while($clTonne=$calculTonne->fetch()){  echo number_format($clTonne['sum(dis.quantite_poids)'], 3,',',' '). ' T <br><br>'; } ?> 
                          		<?php  echo  number_format($total['sum(dis.quantite_poids)'], 3,',',' ');
                           ?>  T </td>
                <td id="<?php echo $row['id'].'code' ?>" style="vertical-align: middle;"> 	<?php echo  $row['code_ppm_client']; ?> </td>
                 <td id="<?php echo $row['id'].'adresse' ?>" style="vertical-align: middle;"> 	<?php echo  $row['adresse_client']; ?> </td>
                  <td id="<?php echo $row['id'].'tel' ?>" style="vertical-align: middle;"> 	<?php echo  $row['tel_client']; ?> </td>
                   <td id="<?php echo $row['id'].'email' ?>" style="vertical-align: middle;"> 	<?php echo  $row['email_client']; ?> </td>§PM



                          <td>
                          	<button  id="<?php echo $row['id'] ?>" name="deletecli" type="submit"  class="fabtn1 " onclick="deleteClient(<?php echo $row['id'] ?>)" > <i class="fa fa-trash  " ></i> </button>
                          	<a class="fabtn" href="#" data-role="update_cli" data-id="<?php echo $row['id']; ?>"       id="btnbtn" > <i class="fa fa-edit " ></i></a>
     </td>         
                              </tr>
                      <?php } ?>	
                    </tbody>
                 </table>
                 </center>
             </div>
          </div>
 






 <div  id="caltransporteur" class="col-md-12" style="display: none;">
  <
      <center>

         
            
               <div  class="table-responsive" border=2 > 
               	
                 <table class='table table-hover table-bordered table-striped'  border='5' style="border-color: black; width: 500px; background: white;" >
                   <thead> 
                     <tr id="entete_transporteur"  border='2'  >
                     	<th style="border-color:white;" scope="col" ></th>
                        <th style="border-color:white;" scope="col" >TRANSPORTEURS</th>
                        <th style="border-color:white;" scope="col" >FLOAT</th>
                        
                         
                                 </tr>
                                  </thead>
                                   <tbody style="font-weight: bold;">
                                    <?php 
                                    while($row = $LesTransporteurs->fetch()){
              $calculLigne=$bdd->prepare("select count(nom) from transporteur where id<=?");
      $calculLigne->bindParam(1,$row['id']);
      $calculLigne->execute();
      $cal=$calculLigne->fetch(); 

      $calculTRP=$bdd->prepare("select count(id_camions) from camions where id_trans=?");
      $calculTRP->bindParam(1,$row['id']);
      $calculTRP->execute();
      $calTRP=$calculTRP->fetch();             	
                                     ?>
                          <tr style="text-align:center;" border='5' id="<?php echo $row['id'].'deltransporteur' ?>">
                          	<td ><span style="color: red; margin-left: 0px; " >	<?php echo  $cal['count(nom)']; ?></span> </td>
                                 <td id="<?php echo $row['id'].'transporteur' ?>" ><?php echo $row['nom']; ?></td>
                                  <td ><?php echo $calTRP['count(id_camions)']; ?></td>

                                     
                              </tr>
                      <?php } ?>	
                    </tbody>
                 </table>
                 
             </div>
          </div>
          </center>
 




<div  id="calAffreteur" class="col-md-12" style="display: none;">
  <div class="card">
    <div class="card-header">
      <center>
        <h1 style="background: linear-gradient(to bottom, blue, #1B2B65); background: linear-gradient(to left, blue, #1B2B65); background: linear-gradient(to top, blue, #1B2B65);" class="htransporteur text-white" >MES FOURNISSEURS</h1>
          </div>
          <center>
            <div class="card-body"> 
               <div class="table-responsive" border=1> 
               	<center>
                 <table class='table table-hover table-bordered table-striped'  border='5' style="border-color: black; width: 500px;" >
                   <thead> 
                     <tr style="color:white; font-weight: bold; background: linear-gradient(to bottom, blue, #1B2B65); background: linear-gradient(to left, blue, #1B2B65); background: linear-gradient(to top, blue, #1B2B65); font-family: montserrat; border-color: white; text-align: center;" border='5'  >
                     	<th style="border-color:white;" scope="col" ></th>
                        <th style="border-color:white;" scope="col" >FOURNISSEURS</th>
                        
                        <th style="border-color:white;" scope="col" >ADRESSES</th>
                        <th style="border-color:white;" scope="col" >TELEPHONES</th>
                        <th style="border-color:white;" scope="col" >EMAIL</th>
                        <th style="border-color:white;" scope="col" >ACTIONS</th>
                         
                                 </tr>
                                  </thead>
                                   <tbody style="font-weight: bold;">
                                    <?php 
                                    while($row = $affreteur->fetch()){
              $calculLigne=$bdd->prepare("select count(affreteur) from affreteur where id<=?");
      $calculLigne->bindParam(1,$row['id']);
      $calculLigne->execute();
      $cal=$calculLigne->fetch(); 

              	
                                     ?>
                          <tr style="text-align:center;" border='5' id="<?php echo $row['id'].'delaffreteur' ?>">
                          	<td style="vertical-align: middle;" ><span style="color: red; margin-left: 0px; " >	<?php echo  $cal['count(affreteur)']; ?></span> </td>
                                 <td id="<?php echo $row['id'].'affreteur' ?>" style="vertical-align: middle;" ><?php echo $row['affreteur']; ?></td>
                                 
                                   <td id="<?php echo $row['id'].'adresse_aff' ?>" style="vertical-align: middle;" ><?php echo $row['adresse_affreteur']; ?></td>
                                    <td id="<?php echo $row['id'].'tel_aff' ?>" style="vertical-align: middle;" ><?php echo $row['tel_affreteur']; ?></td>
                                     <td id="<?php echo $row['id'].'email_aff' ?>" style="vertical-align: middle;" ><?php echo $row['email_affreteur']; ?></td>

                                        <td style="vertical-align: middle;"  >
              <div style="display: flex; justify-content: center;">                    	
                          	<a style="float:left;"  id="<?php echo $row['id'] ?>" name="deleteMg"   class="fabtn1 " onclick="deleteAffreteur(<?php echo $row['id'] ?>)" > <i class="fa fa-trash  " ></i> </a>
                          	<a style="display: flex; justify-content: center; float:right;"  class="fabtn1" type=""  href="#" data-role="update_affreteur" data-id="<?php echo $row['id']; ?>"       id="btnbtn" > <i class="fa fa-edit " ></i></a>
 </a>

</td>           
                              </tr>
                      <?php } ?>	
                    </tbody>
                 </table>
                 </center>
             </div>
          </div>
          </center>
     </div>

  </div>



  <div  id="calBanque" class="col-md-12" style="display: none;">
  <div class="card">
    <div class="card-header">
      <center>
        <h1 style="background: linear-gradient(to bottom, blue, #1B2B65); background: linear-gradient(to left, blue, #1B2B65); background: linear-gradient(to top, blue, #1B2B65);" class="htransporteur text-white" >MES BANQUES</h1>
          </div>
          <center>
            <div class="card-body"> 
               <div class="table-responsive" border=1> 
               	<center>
                 <table class='table table-hover table-bordered table-striped'  border='5' style="border-color: black; width: 500px;" >
                   <thead> 
                     <tr style="color:white; font-weight: bold; background: linear-gradient(to bottom, blue, #1B2B65); background: linear-gradient(to left, blue, #1B2B65); background: linear-gradient(to top, blue, #1B2B65); font-family: montserrat; border-color: white; text-align: center;" border='5'  >
                     	<th style="border-color:white; " scope="col" ></th>
                        <th style="border-color:white;" scope="col" >BANQUE</th>
                        
                        <th style="border-color:white;" scope="col" >ADRESSE</th>
                        <th style="border-color:white;" scope="col" >TELEPHONE</th>
                        <th style="border-color:white;" scope="col" >EMAIL</th>
                        <th style="border-color:white;" scope="col" >ACTIONS</th>
                         
                                 </tr>
                                  </thead>
                                   <tbody style="font-weight: bold;">
                                    <?php 
                                    while($row = $banque->fetch()){
              $calculLigne=$bdd->prepare("select count(banque) from banque where id<=?");
      $calculLigne->bindParam(1,$row['id']);
      $calculLigne->execute();
      $cal=$calculLigne->fetch(); 

              	
                                     ?>
                          <tr style="text-align:center;" border='5' id="<?php echo $row['id'].'delbanque' ?>">
                          	<td style="vertical-align: middle;" ><span style="color: red; margin-left: 0px; " >	<?php echo  $cal['count(banque)']; ?></span> </td>
                                 <td id="<?php echo $row['id'].'banque' ?>" style="vertical-align: middle;" ><?php echo $row['banque']; ?></td>
                                 
                                   <td id="<?php echo $row['id'].'adresse_banque' ?>" style="vertical-align: middle;" ><?php echo $row['adresse_banque']; ?></td>
                                    <td id="<?php echo $row['id'].'tel_banque' ?>" style="vertical-align: middle;" ><?php echo $row['tel_banque']; ?></td>
                                     <td id="<?php echo $row['id'].'email_banque' ?>" style="vertical-align: middle;" ><?php echo $row['email_banque']; ?></td>

                                        <td style="vertical-align: middle;"  >
              <div style="display: flex; justify-content: center;">                    	
                          	<a style="float:left;"  id="<?php echo $row['id'] ?>" name="deleteMg"  class="fabtn1 " onclick="deleteBanque(<?php echo $row['id'] ?>)" > <i class="fa fa-trash  " ></i> </a>
                          	<a style="display: flex; justify-content: center; float:right;"  class="fabtn1" type=""   href="#" data-role="update_banque" data-id="<?php echo $row['id']; ?>"       id="btnbtn" > <i class="fa fa-edit " ></i></a>
 </a>

</td>           
                              </tr>
                      <?php } ?>	
                    </tbody>
                 </table>
                 </center>
             </div>
          </div>
          </center>
     </div>

  </div>






  <div  id="calEntrepots" class="col-lg-12" style="display: none; ">
  <div class="card">
    <div class="card-header">
      <center>
        <h1  style="color: white; background:  rgb(0,141,202);" >MES ENTREPOTS</h1>
    </center>
          </div>
            <div class="card-body"> 
               <div class="table-responsive" border=1 id="tabEntrepot"> 
               	
                 <table class='table table-responsive table-hover table-bordered table-striped'  border='5' style="border-color: black; width: 100%;" >
                   <thead> 
                     <tr style="color:white; font-weight: bold; background: rgb(0,141,202); font-family: montserrat; border-color: white; text-align: center; font-size: 12px;" border='5'  >
                     	<th id="celAlign" rowspan="2" style="border-color:white;" scope="col" > </th>
                     	<th id="celAlign" rowspan="2" style="border-color:white;" scope="col" >NOM ENTREPOT </th>
                     	<th id="celAlign" rowspan="2" style="border-color:white; font-size: 10px;" scope="col" >CODE D'ENTREPOT</th>
                        <th  id="celAlign" rowspan="2" style="border-color:white;" scope="col" style="font-size: 10px;" >N° AGREMENT</th>
                        <th id="celAlign" rowspan="2" style="border-color:white; font-size: 12px;" scope="col" >SUPERFICIE (m²)</th>
                        <th id="celAlign"  colspan="2" style="border-color:white; font-size: 12px;" scope="col" > CAPACITE DE STOCKAGE </th>
                        <th id="celAlign" colspan="2" style="border-color:white; font-size: 12px;" scope="col" > QUANTITE STOCKEE </th>
                        <th id="celAlign" colspan="2" style="border-color:white; font-size: 12px;" scope="col" > ESPACE A STOCKER </th>
                         <th id="celAlign" rowspan="2" style="border-color:white; font-size: 12px;" scope="col" > ACTIONS </th>
                               </tr>
                               <tr  style="color:white; font-weight: bold; background: rgb(0,141,202); font-family: montserrat; border-color: white; text-align: center; vertical-align: middle; font-size: 12px;" border='5'>
                               	<th id="celAlign">SACS (50 KGS)</th>
                               	<th id="celAlign">POIDS (T)</th>
                               	<th id="celAlign">SACS (50 KGS)</th>
                               	<th id="celAlign">POIDS (T)</th>
                               	<th id="celAlign">SACS (50 KGS)</th>
                               	<th id="celAlign">POIDS (T)</th>
                               </tr>
                                  </thead>
                    <tbody style="font-weight: bold;">
                                    <?php 
                                    while($row = $new_mang->fetch()){

                            $calculLigne=$bdd->prepare("select count(mangasin) from mangasin where mangasin<=?");
      $calculLigne->bindParam(1,$row['mangasin']);
      $calculLigne->execute();
      $cal=$calculLigne->fetch();

      $calculTonne=$bdd->prepare("select  sum(rm.poids),rm.id_destination, mg.id from register_manifeste as rm
        left join mangasin as mg on rm.id_destination=mg.id
        
       
                        	where mg.id=?  ");
      $calculTonne->bindParam(1,$row['id']);
      $calculTonne->execute();
       $calT=$calculTonne->fetch();

// ICI ON CALCUL LE STOCKAGE EN SAC MANGASINS
       $sac_stocker=$calT['sum(rm.poids)']*1000/50;

       // ICI ON CALCUL LES RESTANTS MANGASINS
       $poids_restant=$row['poids_stock']-$calT['sum(rm.poids)'];
       $sac_restant=$row['sac_stock']-$calT['sum(rm.poids)']*1000/50;

 /*$images=$bdd->prepare('select * from fichier_mangasin where id_fichier_dis=?');
      $images->bindParam(1,$row['id']);
      $images->execute();*/ 

              	
                                     ?>
                          <tr  style="text-align:center; vertical-align: middle; " border='5' id="<?php echo $row['id'] ?>">
                          	<td style="vertical-align: middle; font-size: 10px;" ><span style="color: red; margin-left: 0px; " >	<?php echo  $cal['count(mangasin)']; ?></span> </td>
          <td id="<?php echo $row['id'].'mangasin' ?>" style="vertical-align: middle; " > <?php echo $row['mangasin']   ; ?> </td>
          <td id="<?php echo $row['id'].'code_mangasin' ?>" style="vertical-align: middle;" > <?php echo $row['code']   ; ?> </td>
                         <td id="<?php echo $row['id'].'agrement' ?>" style="vertical-align: middle;" > <?php echo $row['num_agrement']   ; ?> </td>
        <td id="<?php echo $row['id'].'superficie' ?>" style="vertical-align: middle;" > <?php echo number_format($row['superficie'], 0,',',' ').' m²'; ?> </td>
         <td id="<?php echo $row['id'].'sac_mg' ?>" style="vertical-align: middle; white-space: nowrap;" > <?php echo number_format($row['sac_stock'], 0,',',' '). ' sacs' ?> </td>
       <td id="<?php echo $row['id'].'poids_mg' ?>" style="vertical-align: middle;  white-space: nowrap;" > <?php echo number_format($row['poids_stock'], 3,',',' '). ' T' ?> </td>
       <td style="vertical-align: middle; white-space: nowrap;"> <?php echo number_format($sac_stocker, 0,',',' '); ?></td> 
       <td style="vertical-align: middle; white-space: nowrap;"> <?php //echo number_format($calT['sum(rm.poids)'], 3,',',' '). ' T'; ?></td> 
                                 
       <td style="vertical-align: middle; white-space: nowrap;"> <?php echo number_format($sac_restant, 0,',',' '); ?></td>
       <td  style="vertical-align: middle; white-space: nowrap;"> <?php echo number_format($poids_restant, 3,',',' '); ?></td> 


    <div  class="modal fade" id="vue_details_entrepots<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog" >
      <div class="modal-content" style="margin-left: 0px;   border: solid; border-color:rgb(0,141,202);">
        <div class="modal-header-detailsEntrepots" style="background: blue;">
        	 <button style="float: right; top: 0px;" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          <center>
                <h5 class="modal-title fs-10 text-white text-center" id="exampleModalLabel " style="text-align:center;   ">DETAILS ENTREPOT: <span ><?php echo $row['mangasin'] ?></span></h5></center>
                <center>
              <img class="logoo" src="../images/mylogo.ico" >
             
       </center>
          
        </div>
        <div class="modal-body" style="text-align: left;">
         

         <div style="display: flex; ">
    <h6 style="margin-bottom: 1px;" id="front_details_clients" ><span class="details">CODE:  </span>  <span class="cel_clients" > <?php echo $row['code'];  ?></span></h6>
    </div><br>

    <div style="display: flex; ">
    <h6 style="margin-bottom: 1px;" id="front_details_clients" ><span class="details">N AGREMENT:</span>  <span class="cel_clients" > <?php echo $row['num_agrement'];  ?></span></h6>
    </div><br>

    <div style="display: flex; ">
    <h6 style="margin-bottom: 1px;" id="front_details_clients" ><span class="details">SUPERFICIE:</span>  <span class="cel_clients" > <?php echo $row['superficie'];  ?></span></h6></div><br>
    
    <div style="display: flex; ">
      <h6 style="margin-bottom: 1px;" id="front_details_clients" ><span class="details">CAPACITE DE STOCKAGE EN SAC:</span>  <span class="cel_clients" > <?php echo number_format($row['sac_stock'], 0,',',' ');   ?></span></h6></div><br>

   <div style="display: flex; ">
      <h6 style="margin-bottom: 1px;" id="front_details_clients" ><span class="details">CAPACITE DE STOCKAGE EN POIDS:</span> <span class="cel_clients" > <?php echo number_format($row['poids_stock'], 3,',',' ');   ?></span></h6>
      </div><br>
       <div style="display: flex; ">
    <h6 style="margin-bottom: 1px;" id="front_details_clients" ><span class="details">N ADRESSE:</span>  <span class="cel_clients" id="<?php echo $row['id'].'adresse_mg' ?>" > <?php echo $row['adresse'];  ?></span></h6>
    </div><br>
        
        <div style="display: flex; ">
        <h6 style="margin-bottom: 1px;" id="front_details_clients" ><span class="details">MANGASINIER:</span>  <span class="cel_clients" id="<?php echo $row['id'].'mangasinier' ?>" > <?php echo $row['prenom'].' '.$row['nom']  ?></span>
        	<span style="display: none;" class="cel_clients" id="<?php echo $row['id'].'id_user' ?>" > <?php echo $row['id_sim_user'];  ?></span></h6></div><br>

        <div style="display: flex; ">
        <h6 style="margin-bottom: 1px;" id="front_details_clients"><span class="details">EMAIL:</span>  <span class="cel_clients"> <?php echo $row['email'] ?></span></h6></div><br>

        <div style="display: flex; ">
        <h6 style="margin-bottom: 1px;" id="front_details_clients"><span class="details">TELEPHONE:</span> <span class="cel_clients" ><?php echo $row['telephone'] ?></span></h6></div>
         
          	
          	
         
        </div>
        <div class="modal-footer">
         
        </div>
      </div>
    </div>
  </div>

<center>
  <div style="z-index: 6666666; width:100%;" class="modal fade full-screen-modal" id="vue_details_images<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"  >

    <div class="modal-dialog">
      <div class="modal-content ">
        <div class="modal-header" style="background: blue;">
          <h5 class="modal-title" id="myModalLabel" style="color: white;">DETAILS EN IMAGES</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="text-align: left;">
        	<?php
        	/*
          $rown=$images->fetch();
            if($rown) { 
         readfile($rown['path_fichier_mg']); */?>
  
    

           
    
       
</div> 
       	
         
        </div>
        <div class="modal-footer">
         
        </div>
      </div>
    </div>
  </div>
  </center> 
   
  
                                 
                                 <td style="vertical-align: middle;"  >
              <div style="display: flex; justify-content: center;">                    	
                          	<a style="float:left;"  id="<?php echo $row['id'] ?>" name="deleteMg"   class="fabtn1 " onclick="deleteMg(<?php echo $row['id'] ?>)" > <i class="fa fa-trash  " ></i> </a>
                          	<a  style="display: flex; justify-content: center;"  class="fabtn1" type=""   data-role="update_mangasin" data-id="<?php echo $row['id']; ?>"       id="btnbtn" > <i class="fa fa-edit " ></i></a>
<a style="display: flex; justify-content: center;"  id="<?php echo $row['id'] ?>" name="details" type="submit"  class="fabtn1 " data-bs-toggle="modal" data-bs-target="#vue_details_entrepots<?php echo $row['id'] ?>" onclick="setModalContent(<?php echo $row['id'] ?>)"> <i class="fas fa-info-circle   " ></i> </a>
<a  style="display: flex; justify-content: center;"  href="insertion_fichier_entrepot.php?id=<?php echo $row['id'] ?>"   class="fabtn1 "  onclick="setModalContent(<?php echo $row['id'] ?>)"> <i class="fas fa-folder  " ></i> </a>

</td>    
                              </tr>
                      <?php } ?>	
                    </tbody>

                </table>
                 </center>
             </div>
          </div>
     </div>
  </div>



  <div   class="col-md-12" id="calchauffeur" style="display: none;" >
  <div class="card"  style="background: red !important;" >
    <div class="card-header">
      <center>
        <h4 style="background: linear-gradient(-45deg, #004362, #0183d0) !important;" class="hnavire text-white" >MES CHAUFFEURS</h4>
          </div>
            <div class="card-body"> 
               <div class="table-responsive" border=1
               style=" width:100%;" 
               id='tabchauffeur'> 
                 <table class='table  table-striped'  border='5'  style="  border-color: black;" >
                   <thead> 
                     <tr style="background: linear-gradient(-45deg, #004362, #0183d0) !important; color:white; font-weight: bold; font-family: montserrat; border-color: white; text-align: center;" border='5' >
                     	<th style="border-color:white;" scope="col" >N°</th>
                     	 <th style="border-color:white;" scope="col" >CHAUFFEURS</th>
                       
                           <th style="border-color:white;" scope="col" > N° PERMIS</th>
                             <th style="border-color:white;" scope="col" >N° TELEPHONE</th>
                          
                               <th style="border-color:white;" scope="col" > ACTIONS  </th>
                                 </tr>
                                  </thead>
                                   <tbody style="font-weight: bold;">
                                    <?php 
               while($row = $rowchauffeur->fetch()){
$chauffeur=str_replace("_", " ",$row['nom_chauffeur']);

$permis=str_replace("_", " ",$row['n_permis']);
$tel=str_replace("_", " ",$row['num_telephone']);


                       $calculLigne=$bdd->prepare("select count(id_chauffeur) from chauffeur where id_chauffeur<=?");
      $calculLigne->bindParam(1,$row['id_chauffeur']);
      $calculLigne->execute();
      $cal=$calculLigne->fetch();              	
                                     ?>
                          <tr style="text-align:center;" border='5' id="<?php echo $row['id_chauffeur'] ?>">
                          	<td ><span style="color: red; margin-left: 0px; " >	<?php echo  $cal['count(id_chauffeur)']; ?></span> </td>
                                 <td id="<?php echo $row['id_chauffeur'].'chauffeur' ?>" ><?php echo $chauffeur; ?></td>
                               
                              <td id="<?php echo $row['id_chauffeur'].'permis' ?>" ><?php echo $permis; ?> </td>
                            <td id="<?php echo $row['id_chauffeur'].'tel_chauffeur' ?>" ><?php echo $tel ?> </td>
                          
                          <td  >
  <button id="<?php echo $row['id_chauffeur'] ?>" name="deletechauf" type="submit"  class="fabtn1 " onclick="deleteChauffeur(<?php echo $row['id_chauffeur'] ?>)" > <i class="fa fa-trash  " ></i> </button>
                          	<a class="fabtn"  type="" name="modify" data-role="update_chauffeur"   data-id="<?php echo $row['id_chauffeur']; ?>"       id="btnbtn" s> <i class="fa fa-edit " ></i></a></td>
                        </tr>
                      <?php } ?>	
                    </tbody>
                 </table>
             </div>
          </div>
     </div>
  </div>



<div id="calcam"  class="col-md-12" id="calchauffeur" style="display: none;">
  <div class="card"   >
    <div class="card-header">
    	<?php $compteur=0; 
    	while($bouton_next=$bouton_rowcamion->fetch()){
    		$compteur=$compteur+1;
    		
    	        if($compteur==30){ ?>
    	<a class="fas fa-arrow-right" data-role="first_suivant"  >SUIVANT<span id="id_compteur" style="display: none;"><?php echo $bouton_next['num_camions']; ?></span> </a>

    <?php 	}
    if($compteur==1){?>
    	<span id="id_compteur_intermediare" style="display: none;"><?php echo $bouton_next['num_camions']; ?></span>
<?php 	 
     } } ?>

      
        
          </div>
            <div class="card-body"> 
               <div class="table-responsive" border=1
               style=" width:100%;" 
              id="tabcamion" > 
                 <table class='table table-hover table-bordered table-striped'  border='5'  style="  border-color: black;" >
                   <thead> 
                   	<tr class="titrecamion">	
                   	<td colspan="4"  >MES CAMIONS</td>
                   	</tr>
                     <tr style=" background: linear-gradient(to bottom, blue, #1B2B65); background: linear-gradient(to left, blue, #1B2B65); background: linear-gradient(to top, blue, #1B2B65); color:white; font-weight: bold; font-family: montserrat; border-color: white; text-align: center;" border='5' >
                     	<th style="border-color:white;" scope="col"> </th>
                     	<th style="border-color:white;" scope="col" >N° CAMION</th>
                     	 <th style="border-color:white;" scope="col" >TRASPORTEURS</th>
                     	  <th style="border-color:white;" scope="col" >ACTIONS</th>
                       
                                                            </tr>
                                  </thead>
                                   <tbody style="font-weight: bold;">
                                    <?php 
               while($row = $rowcamion->fetch()){

                       $calculLigne=$bdd->prepare("select count(num_camions) from camions where num_camions<=? order by num_camions asc");
      $calculLigne->bindParam(1,$row['num_camions']);
      $calculLigne->execute();
      $cal=$calculLigne->fetch();              	
                                     ?>
                          <tr style="text-align:center;" border='5' id="<?php echo $row['id_camions'].'delcamion' ?>">
                          	<td ><span style="color: red; margin-left: 0px; " >	<?php echo  $cal['count(num_camions)']; ?> </span> </td>
                                 <td id="<?php echo $row['id_camions'].'camions' ?>"><?php echo $row['num_camions']; ?></td>
                               
                              <td id="<?php echo $row['id_camions'].'trnom' ?>"><?php echo $row['nom'] ?></td><span style="display: none;" id="<?php echo $row['id_camions'].'trcamion' ?>"><?php echo $row['id'] ?></span>
                           
                          
                          <td  >
  <a id="<?php echo $row['id_camions'] ?>" name="deletecam"   class="fabtn1 " onclick="deleteCamion(<?php echo $row['id_camions'] ?>)" > <i class="fa fa-trash  " ></i> </a>
                          	<a class="fabtn"   name="modify"   data-role="update_camion"   data-id="<?php echo $row['id_camions']; ?>"    id="btnbtn" > <i class="fa fa-edit " ></i></a></td>
                        </tr>
                      <?php } ?>	
                    </tbody>
                 </table>
             </div>
          </div>
     </div>
  </div>






<div class="modal fade" id="navires" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
      	<center>
        <h1 class="modal-title fs-5 text-white text-center" id="exampleModalLabel " style="text-align:center; ">Ajout navire</h1></center>
        <button type="button" class="btn-close " style="color:white;" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      	<div id="auth-right">
					<div class="auth-logo">
						<a href="control_debarquement.php"><img src="assets/images/mylogo.ico" alt="Logo"> Ajouter un navire</a>  
					</div>
					</div>
      	<form  method="POST">

      

  
      
  <input type="text" class="form-control"  id="exampleFormControlInput1" placeholder="navire" name="navire">

                           <select name="type_navire" class="mb-3 " style="width:50%">
                            <option value="">type de chargement</option>
                          
                            <option value="SACHERIE"> EN SACS</option>
                            <option value="VRAQUIER"> EN VRAC</option>
                             </select>
                            


  
  <input type="text" class="form-control"  id="exampleFormControlInput1" placeholder="LOAD PORT" name="load_port">
  
  <input type="text" class="form-control"  id="exampleFormControlInput1" placeholder="DESTINATION" name="destination">

  
  <input type="text" class="form-control"  id="exampleFormControlInput1" placeholder="PRODUIT(S)" name="description">

	<label for="exampleFormControlInput1" class="form-label">ETA</label>
  
  <input type="date" class="form-control" id="exampleFormControlInput1" placeholder="ETA" name="eta">
  
	<label for="exampleFormControlInput1" class="form-label">ETB</label>
  <input type="date" class="form-control"  id="exampleFormControlInput1" placeholder="ETB" name="etb">

<label for="exampleFormControlInput1" class="form-label">ETD</label>  
  <input type="date" class="form-control"  id="exampleFormControlInput1" placeholder="ETD" name="etd">



<fieldset><legend>choix du client</legend>
	
<?php while ($clients=$MesClients->fetch()) {
	// code...
 ?>

  <input type="Checkbox"  style="height: 20px;width: 10%; font-size: 30px;  background-color: none;" id="" placeholder="client" name="client[]"  value="<?php echo $clients['client'];	 ?>"><?php 	echo  $clients['client']; ?>
<?php } ?>
  </fieldset>                              
 
         <center>
      <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="valider_navire">valider</button>
</form> 
      </div>   
      <div class="modal-footer">
 
        
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="produits" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
      	<center>
        <h1 class="modal-title fs-5 text-white text-center" id="exampleModalLabel " style="text-align:center; ">Ajout produit</h1></center>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      	<div id="auth-right">
					<div class="auth-logo">
						<a href="control_debarquement.php"><img src="assets/images/mylogo.ico" alt="Logo"> Ajouter un navire</a>  
					</div>
					</div>
      	<form  method="POST">

      

  
                           <div class="form-group position-relative has-icon-left mb-4">
                           	<select name="nombre" id="nombre" onchange="goInput()">
                           		<option value="">selectionner le nombre de produit</option>
                           		<option value="1">1</option>
                           		<option value="2">2</option>
                           		<option value="3">3</option>
                           		<option value="4">4</option>
                           	</select>
                           	  <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                           

  <div class="form-group position-relative has-icon-left mb-4" id="lesinputs">
                                                                               
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>                       
                      
                       <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="valider_produit">valider</button>
					</form>

				</div>   
      <div class="modal-footer">
 
        
      </div>
    </div>
  </div>
</div>










<div class="modal fade" id="client" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
      	<center>
        <h1 class="modal-title fs-5 text-white text-center" id="exampleModalLabel " style="text-align:center; ">Ajouter client</h1></center>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      	<div id="auth-right">
					<div class="auth-logo">
						<a href="control_debarquement.php"><img src="assets/images/mylogo.ico" alt="Logo"> CLIENT</a>  
					</div>
					</div>
      	<form  method="POST">

      

   <div class="mb-3">
      
  <input type="text" class="form-control"  id="exampleFormControlInput1" placeholder="client" name="client"><br>
  <input type="text" class="form-control"  id="exampleFormControlInput1" placeholder="CODE PPM" name="code"><br>
  <input type="text" class="form-control"  id="exampleFormControlInput1" placeholder="ADRESSE" name="adresse"><br>
  <input type="text"  class="form-control"  id="telephoneInput" placeholder="TELEPHONE" name="telephone" oninput="formatTelephone()" required><br>
   <input type="text" class="form-control"  id="exampleFormControlInput1" placeholder="EMAIL" name="email"><br>
</div>



         <center>
        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="valider_client">valider</button>
</form> 
      </div>   
      <div class="modal-footer">
 
        
      </div>
    </div>
  </div>
</div>




<div class="modal fade" id="modif_cli" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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





   <div class="mb-3">
    
   
    <label>RECEPTIONNAIRE</label>  
  <input type="text" class="form-control"  id="m_client"  name="conditionnement"  > 
  <label>CODE PPM</label>
  <input type="text" class="form-control"  id="m_code_cli" name="nombre_sac" ><br>
  <label>ADRESSE </label>
   <input type="text" class="form-control"  id="m_adresse_cli"  name="nom"  ><br>
   
   
   
 <label>TELEPHONE </label>
    <input type="text" class="form-control"  id="m_tel_cli" name="nav" >
     <label>EMAIL </label>
    <input type="text"  class="form-control"  id="m_email_cli" name="nav" >

     <input style="display: none;" type="text" class="form-control"  id="m_id_cli" name="dec"  ><br>
    
    
</div>




        
        
 
       
      <div class="modal-footer">
    <a id="save_cli"   class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="modifier_declaration">valider</a>
        
      </div>
      </form>
       </div> 
    </div>
  </div>
</div>



<div class="modal fade" id="modif_mangasin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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





   <div class="mb-3">
    
   
    <label>NOM ENTREPOT</label>  
  <input type="text" class="form-control"  id="m_mangasin"  name="conditionnement"  > <br>
  <label>CODE </label>
  <input type="text" class="form-control"  id="m_code" name="nombre_sac" ><br>
  <label>AGREMENT </label>
   <input type="text" class="form-control"  id="m_agrement"  name="nom"  ><br>
   <label>ADRESSE </label>
   <input type="text" class="form-control"  id="m_adres"  name="nom"  ><br>
   
   
 <label>SUPERFICIE </label>
    <input type="text" class="form-control"  id="m_superficie" name="nav" >
     <label>STOCKAGE EN SAC </label>
    <input type="text" class="form-control"  id="m_sac" name="nav" >

    
    <label>MAGASINIER </label><br>
    <select id="m_mangasinier">
    	<?php $mangasinier=$bdd->query("SELECT id_sim_user,prenom,nom from simar_user where profil='Mangasinier'");
    	while($mg=$mangasinier->fetch()){ ?>
    		<option value="<?php echo $mg['id_sim_user'] ?>"> <?php echo $mg['prenom'].' '.$mg['nom']; ?></option>
    		<?php } ?>
    </select>
     <input style="display: none;" type="text" class="form-control"  id="m_id_mg" name="dec"  ><br>
    
</div>


</center>

        
        
 
       
      <div class="modal-footer">
    <a id="save_mangasin"   class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="modifier_declaration">valider</a>
        
      </div>
      </form>
       </div> 
    </div>
  </div>
</div>




<div class="modal fade" id="modif_navire" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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





   <div class="mb-3">
    
   
    <label>NAVIRE</label>  
  <input type="text" class="form-control"  id="m_navire"  name="conditionnement"  > <br>
  <label>DATE D'ACOSTAGE </label>
  <input type="text" class="form-control"  id="m_eta" name="nombre_sac" ><br>
  <label>ETB </label>
   <input type="text" class="form-control"  id="m_etb"  name="nom"  ><br>
   <label>ETD </label>
   <input type="text" class="form-control"  id="m_etd"  name="nom"  ><br>
   
   
 <label>LOAD PORT </label>
    <input type="text" class="form-control"  id="m_load_port" name="nav" >
     <label>DESTINATION </label>
    <input type="text" class="form-control"  id="m_destination" name="nav" >
    <label>RECEPTIONNAIRE </label>
    <input type="text" class="form-control"  id="m_client_nav" name="nav" >

     
    <label>FOURNISSEUR </label><br>
    <select id="m_affreteur_nav">
    	<?php $mangasinier=$bdd->query("SELECT affreteur from affreteur ");
    	while($mg=$mangasinier->fetch()){ ?>
    		<option value="<?php echo $mg['affreteur'] ?>"> <?php echo $mg['affreteur'] ?></option>
    		<?php } ?>
    </select>
     <input style="display: none;" type="text" class="form-control"  id="m_id_nav" name="dec"  ><br>
    
</div>


</center>

        
        
 
       
      <div class="modal-footer">
    <a id="save_navire"   class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="modifier_declaration">valider</a>
        
      </div>
      </form>
       </div> 
    </div>
  </div>
</div>




<div class="modal fade" id="modif_affreteur" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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





   <div class="mb-3">
    
   
    <label>FOURNISSEUR</label>  
  <input type="text" class="form-control"  id="m_affreteur"  name="conditionnement"  > <br>
 
  <label>ADRESSE </label>
   <input type="text" class="form-control"  id="m_adresse_aff"  name="nom"  ><br>
   
   <center>
   
 <label>TELEPHONE </label>
    <input type="text" class="form-control"  id="m_tel_aff" name="nav" >
     <label>EMAIL </label>
    <input type="text" class="form-control"  id="m_email_aff" name="nav" >

     <input style="display: none;" type="text" class="form-control"  id="m_id_aff" name="dec"  ><br>
    </center>
    
</div>


</center>

        
        
 
       
      <div class="modal-footer">
    <a id="save_aff" href="#"  class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="modifier_declaration">valider</a>
        
      </div>
      </form>
       </div> 
    </div>
  </div>
</div>



<div class="modal fade" id="modif_banque" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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





   <div class="mb-3">
    
   
    <label>BANQUE</label>  
  <input type="text" class="form-control"  id="m_banque"  name="conditionnement"  > <br>
 
  <label>ADRESSE </label>
   <input type="text" class="form-control"  id="m_adresse_banque"  name="nom"  ><br>
   
   <center>
   
 <label>TELEPHONE </label>
    <input type="text" class="form-control"  id="m_tel_banque" name="nav" >
     <label>EMAIL </label>
    <input type="text" class="form-control"  id="m_email_banque" name="nav" >

     <input style="display: none;" type="text" class="form-control"  id="m_id_banque" name="dec"  ><br>
    </center>
    
</div>


</center>

        
        
 
       
      <div class="modal-footer">
    <a id="save_banque" href="#"  class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="modifier_declaration">valider</a>
        
      </div>
      </form>
       </div> 
    </div>
  </div>
</div>



<div class="modal fade" id="modif_newproduit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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





   <div class="mb-3">
    
   
    <label>PRODUIT</label>  
  <input type="text" class="form-control"  id="m_newproduit"  name="conditionnement"  > <br>
 
  <label>QUALITE </label>
   <input type="text" class="form-control"  id="m_qualite"  name="nom"  ><br>
   
   <center>
   
 

     <input style="display: none;" type="text" class="form-control"  id="m_id_newproduit" name="dec"  ><br>
    </center>
    
</div>


</center>

        
        
 
       
      <div class="modal-footer">
    <a id="save_newproduit" href="#"  class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="modifier_declaration">valider</a>
        
      </div>
      </form>
       </div> 
    </div>
  </div>
</div>



<div class="modal fade" id="modif_categorie" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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





   <div class="mb-3">
    
   
    <label>PRODUIT</label>  
  <input  type="text" class="form-control"  id="m_categorie"  name="conditionnement"  > <br>
 
  <label>PRODUIT</label>  
  <input  type="text" class="form-control"  id="m_taxe"  name="conditionnement"  > <br>
   
   <center>
   
 <

     <input style="display: none;" type="text" class="form-control"  id="m_id_categorie" name="dec"  ><br>
    </center>
    
</div>


</center>

        
        
 
       
      <div class="modal-footer">
    <a id="save_categorie" href="#"  class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="modifier_declaration">valider</a>
        
      </div>
      </form>
       </div> 
    </div>
  </div>
</div>




<div class="modal fade" id="modif_trans" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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





   <div class="mb-3">
    
   
    <label>TRANSPORTEUR</label>  
  <input type="text" class="form-control"  id="m_transporteur"  name="conditionnement"  > <br>
 
 
   <input type="text" class="form-control"  id="m_id_trans"  name="nom"  ><br>
   
   
</div>




        
        
 
       
      <div class="modal-footer">
    <a id="save_trans" href="#"  class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="modifier_declaration">valider</a>
        
      </div>
      </form>
       </div> 
    </div>
  </div>
</div>



<div class="modal fade" id="modif_camion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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





   <div class="mb-3">
    
   
    <label>CAMION</label>  
  <input type="text" class="form-control"  id="m_camion"  name="conditionnement"  > <br><br>
  <label>TRANSPORTEUR</label> 
  <select class="form-control" id="m_trans_cam" style="width: 50%;">
  	<?php $trans=$bdd->query("select * from transporteur");
  	while($tr=$trans->fetch()){ ?>
<option value="<?php echo $tr['id'] ?>"><?php echo $tr['nom'] ?></option>
<?php } ?>

  </select><br>
 
 
   <input type="text" class="form-control"   id="m_id_camions"  name="nom" hidden="true"  ><br>
   
   
</div>
 <div class="modal-footer">
    <a id="save_camion"   class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="modifier_declaration">valider</a>
        
      </div>
      </form>
       </div> 
    </div>
  </div>
</div>



<div class="modal fade" id="modif_chauffeur" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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





   <div class="mb-3">
    
   
    <label>CHAUFFEUR</label>  
  <input type="text" class="form-control"  id="m_chauffeur"  name="conditionnement"  > <br>
 <label>PERMIS</label>
   <input type="text" class="form-control"  id="m_permis"  name="nom"  ><br>
<label>TELEPHONE</label>
   <input type="text" class="form-control"  id="m_tel_chauffeur"  name="nom"  ><br>
   <input type="text" class="form-control"  id="m_id_chauffeur"  name="nom" hidden="true"  ><br>   
   
</div>
 
      <div class="modal-footer">
    <a id="save_chauffeur"   class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="modifier_declaration">valider</a>
        
      </div>
      </form>
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

	        <?php 
if(isset($_GET['z'])){

 ?>
 <div class="flash-data" data-flashdata=<?=$_GET['z']; ?>></div>
<?php } ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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



  






  



	<script type="text/javascript">
		function imprimer(dname){
			var printContents=document.getElementById(dname).innerHTML;
			var originalContents=document.body.innerHTML;
			document.body.innerHTML=printContents;
			window.print();
			document.body.innerHTML=originalContents;


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
            function go(){
                var xhr = getXhr();
                // On définit ce qu'on va faire quand on aura la réponse
                xhr.onreadystatechange = function(){
                    // On ne fait quelque chose que si on a tout reçu et que le serveur est OK
                    if(xhr.readyState == 4 && xhr.status == 200){
                        leselect = xhr.responseText;
                        // On se sert de innerHTML pour rajouter les options à la liste
                        document.getElementById('fetch_cargo_plan').innerHTML = leselect;

                    }
                }
 
                // Ici on va voir comment faire du post
                xhr.open("POST","selectDeclaration_chargement.php",true);
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
            function go2(){
                var xhr = getXhr();
                // On définit ce qu'on va faire quand on aura la réponse
                xhr.onreadystatechange = function(){
                    // On ne fait quelque chose que si on a tout reçu et que le serveur est OK
                    if(xhr.readyState == 4 && xhr.status == 200){
                        leselect = xhr.responseText;
                        // On se sert de innerHTML pour rajouter les options à la liste
                        document.getElementById('fetch_sta_cale').innerHTML = leselect;

                    }
                }
 
                // Ici on va voir comment faire du post
                xhr.open("POST","selectStaCale.php",true);
                // ne pas oublier ça pour le post
                xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
                // ne pas oublier de poster les arguments
                // ici, l'id de l'auteur
                sel = document.getElementById('naviresta');
                idnaviresta = sel.options[sel.selectedIndex].value;
                xhr.send("idNaviresta="+idnaviresta);
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
            function go3(){
                var xhr = getXhr();
                // On définit ce qu'on va faire quand on aura la réponse
                xhr.onreadystatechange = function(){
                    // On ne fait quelque chose que si on a tout reçu et que le serveur est OK
                    if(xhr.readyState == 4 && xhr.status == 200){
                        leselect = xhr.responseText;
                        // On se sert de innerHTML pour rajouter les options à la liste
                        document.getElementById('fetch_sta_var').innerHTML = leselect;

                    }
                }
 
                // Ici on va voir comment faire du post
                xhr.open("POST","selectStaVar.php",true);
                // ne pas oublier ça pour le post
                xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
                // ne pas oublier de poster les arguments
                // ici, l'id de l'auteur
                sel = document.getElementById('naviresta2');
                idnaviresta2 = sel.options[sel.selectedIndex].value;
                xhr.send("idNaviresta2="+idnaviresta2);
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
            function goDC(){
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
                sel = document.getElementById('selnavire');
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
            function goDIS(){
                var xhr = getXhr();
                // On définit ce qu'on va faire quand on aura la réponse
                xhr.onreadystatechange = function(){
                    // On ne fait quelque chose que si on a tout reçu et que le serveur est OK
                    if(xhr.readyState == 4 && xhr.status == 200){
                        leselect = xhr.responseText;
                        // On se sert de innerHTML pour rajouter les options à la liste
                        document.getElementById('produitDIS').innerHTML = leselect;

                    }
                }
 
                // Ici on va voir comment faire du post
                xhr.open("POST","selectProduitDIS.php",true);
                // ne pas oublier ça pour le post
                xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
                // ne pas oublier de poster les arguments
                // ici, l'id de l'auteur
                sel = document.getElementById('selnavireDIS');
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
            function func_date_client(){
                var xhr = getXhr();
                // On définit ce qu'on va faire quand on aura la réponse
                xhr.onreadystatechange = function(){
                    // On ne fait quelque chose que si on a tout reçu et que le serveur est OK
                    if(xhr.readyState == 4 && xhr.status == 200){
                        leselect = xhr.responseText;
                        // On se sert de innerHTML pour rajouter les options à la liste
                        document.getElementById('calclient').innerHTML = leselect;

                    }
                }
 
                // Ici on va voir comment faire du post
                xhr.open("POST","select_date_client.php",true);
                // ne pas oublier ça pour le post
                xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
                // ne pas oublier de poster les arguments
                // ici, l'id de l'auteur
                sel = document.getElementById('dateclient');
                iddate_client = sel.options[sel.selectedIndex].value;
                xhr.send("idDate_client="+iddate_client);
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
            function func_date_produit(){
                var xhr = getXhr();
                // On définit ce qu'on va faire quand on aura la réponse
                xhr.onreadystatechange = function(){
                    // On ne fait quelque chose que si on a tout reçu et que le serveur est OK
                    if(xhr.readyState == 4 && xhr.status == 200){
                        leselect = xhr.responseText;
                        // On se sert de innerHTML pour rajouter les options à la liste
                        document.getElementById('calproduits').innerHTML = leselect;

                    }
                }
 
                // Ici on va voir comment faire du post
                xhr.open("POST","select_date_produit.php",true);
                // ne pas oublier ça pour le post
                xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
                // ne pas oublier de poster les arguments
                // ici, l'id de l'auteur
                sel = document.getElementById('dateproduit');
                iddate_produit = sel.options[sel.selectedIndex].value;
                xhr.send("idDate_produit="+iddate_produit);
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
            function func_date_navire(){
                var xhr = getXhr();
                // On définit ce qu'on va faire quand on aura la réponse
                xhr.onreadystatechange = function(){
                    // On ne fait quelque chose que si on a tout reçu et que le serveur est OK
                    if(xhr.readyState == 4 && xhr.status == 200){
                        lesele = xhr.responseText;
                        // On se sert de innerHTML pour rajouter les options à la liste
                        document.getElementById('calnavire').innerHTML = lesele;

                    }
                }
 
                // Ici on va voir comment faire du post
                xhr.open("POST","select_date_navire.php",true);
                // ne pas oublier ça pour le post
                xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
                // ne pas oublier de poster les arguments
                // ici, l'id de l'auteur
                sel = document.getElementById('datenavire');
                iddate_navire = sel.options[sel.selectedIndex].value;
                xhr.send("idDate_navire="+iddate_navire);
            }
        </script>

<script>
  function visible_mangasinier() {
  	var mangasinier = document.getElementById("calmangasinier");
    var navire = document.getElementById("calnavire");
    var produit = document.getElementById("calproduits");
    var client = document.getElementById("calclient");
    var transporteur = document.getElementById("caltransporteur");
    var chauffeur = document.getElementById("calchauffeur");
    var entrepot = document.getElementById("calEntrepots");
    var affreteur = document.getElementById("calAffreteur");
    var banque = document.getElementById("calBanque");
    var newprod = document.getElementById("calnewproduits");
    var camion = document.getElementById("calcam");

    
   
    
    
    if (mangasinier.style.display === "none") {
    	mangasinier.style.display = "table";
      navire.style.display = "none";
      produit.style.display = "none";
      client.style.display = "none";
      transporteur.style.display = "none";
      chauffeur.style.display = "none";
      entrepot.style.display = "none";
      affreteur.style.display = "none";
      banque.style.display = "none";
      newprod.style.display = "none";
      camion.style.display = "none";

       mangasinier.scrollIntoView({ behavior: 'smooth' });
     
    } else {
      mangasinier.style.display = "none";
     
    }
    
    
  }
</script>

<script>
  function visible_navire() {
    var navire = document.getElementById("calnavire");
    var produit = document.getElementById("calproduits");
    var client = document.getElementById("calclient");
    var transporteur = document.getElementById("caltransporteur");
    var chauffeur = document.getElementById("calchauffeur");
    var entrepot = document.getElementById("calEntrepots");
    var affreteur = document.getElementById("calAffreteur");
    var banque = document.getElementById("calBanque");
    var newprod = document.getElementById("calnewproduits");
    var camion = document.getElementById("calcam");

    
   
    
    
    if (navire.style.display === "none") {
      navire.style.display = "table";
      produit.style.display = "none";
      client.style.display = "none";
      transporteur.style.display = "none";
      chauffeur.style.display = "none";
      entrepot.style.display = "none";
      affreteur.style.display = "none";
      banque.style.display = "none";
      newprod.style.display = "none";
      camion.style.display = "none";

       navire.scrollIntoView({ behavior: 'smooth' });
     
    } else {
      navire.style.display = "none";
     
    }
    
    
  }
</script>

<script>
  function visible_produit() {
    var produit = document.getElementById("calproduits");
   var navire = document.getElementById("calnavire");
   var client = document.getElementById("calclient");
   var transporteur = document.getElementById("caltransporteur");
var chauffeur = document.getElementById("calchauffeur");
 var entrepot = document.getElementById("calEntrepots");
      var affreteur = document.getElementById("calAffreteur");
    var banque = document.getElementById("calBanque");
    var newprod = document.getElementById("calnewproduits");
    var camion = document.getElementById("calcam");

    
    if (produit.style.display === "none") {
      produit.style.display = "table";
      navire.style.display = "none";
      client.style.display = "none";
      produit.scrollIntoView({ behavior: 'smooth' });
      transporteur.style.display = "none";
      chauffeur.style.display = "none";
      entrepot.style.display = "none";
      affreteur.style.display = "none";
      banque.style.display = "none";
      newprod.style.display = "none";
      camion.style.display = "none";

     
    } else {
      produit.style.display = "none";
     
    }
    
    
  }
</script>

<script>
  function visible_client() {
    var produit = document.getElementById("calproduits");
    var navire = document.getElementById("calnavire");
    var client = document.getElementById("calclient");
   var transporteur = document.getElementById("caltransporteur");
   var chauffeur = document.getElementById("calchauffeur");
    var entrepot = document.getElementById("calEntrepots");
    var affreteur = document.getElementById("calAffreteur");
    var banque = document.getElementById("calBanque");
    var newprod = document.getElementById("calnewproduits");
    var camion = document.getElementById("calcam");
    
    
    if (client.style.display === "none") {
      client.style.display = "table";
       client.scrollIntoView({ behavior: 'smooth' });
       navire.style.display = "none";
       produit.style.display = "none";
       transporteur.style.display = "none";
       chauffeur.style.display = "none";
       entrepot.style.display = "none";
      affreteur.style.display = "none";
      banque.style.display = "none";
      camion.style.display = "none";
      newprod.style.display = "none";


    } else {
      client.style.display = "none";
     
    }
    
    
  }
</script>

<script>
  function visible_transporteur() {
    var produit = document.getElementById("calproduits");
    var navire = document.getElementById("calnavire");
    var client = document.getElementById("calclient");
   var transporteur = document.getElementById("caltransporteur");
   var chauffeur = document.getElementById("calchauffeur");
    var entrepot = document.getElementById("calEntrepots");
         var affreteur = document.getElementById("calAffreteur");
    var banque = document.getElementById("calBanque");
      var newprod = document.getElementById("calnewproduits");
    var camion = document.getElementById("calcam");

    
    
    if (transporteur.style.display === "none") {
      transporteur.style.display = "table";
       transporteur.scrollIntoView({ behavior: 'smooth' });
       navire.style.display = "none";
       produit.style.display = "none";
       client.style.display = "none";
       chauffeur.style.display = "none";
       entrepot.style.display = "none";
      affreteur.style.display = "none";
      banque.style.display = "none";
      camion.style.display = "none";
      newprod.style.display = "none";

    } else {
      transporteur.style.display = "none";
     
    }
    
    
  }
</script>


<script>
  function visible_chauffeur() {
    var produit = document.getElementById("calproduits");
    var navire = document.getElementById("calnavire");
    var client = document.getElementById("calclient");
   var transporteur = document.getElementById("caltransporteur");
   var chauffeur = document.getElementById("calchauffeur");
    var entrepot = document.getElementById("calEntrepots");
    var affreteur = document.getElementById("calAffreteur");
    var banque = document.getElementById("calBanque");
    var newprod = document.getElementById("calnewproduits");
    var camion = document.getElementById("calcam");

    
    if (chauffeur.style.display === "none") {
      chauffeur.style.display = "table";
       chauffeur.scrollIntoView({ behavior: 'smooth' });
       navire.style.display = "none";
       produit.style.display = "none";
       client.style.display = "none";
       transporteur.style.display = "none";
       entrepot.style.display = "none";
      affreteur.style.display = "none";
      banque.style.display = "none";
      camion.style.display = "none";
      newprod.style.display = "none";

    } else {
      chauffeur.style.display = "none";
     
    }
    
    
  }
</script>


<script>
  function visible_entrepots() {
    var produit = document.getElementById("calproduits");
    var navire = document.getElementById("calnavire");
    var client = document.getElementById("calclient");
   var transporteur = document.getElementById("caltransporteur");
   var chauffeur = document.getElementById("calchauffeur");
    var entrepot = document.getElementById("calEntrepots");
     var affreteur = document.getElementById("calAffreteur");
    var banque = document.getElementById("calBanque");
    var newprod = document.getElementById("calnewproduits");
    var camion = document.getElementById("calcam");
    
    if (entrepot.style.display === "none") {
      entrepot.style.display = "table";
       entrepot.scrollIntoView({ behavior: 'smooth' });
       navire.style.display = "none";
       produit.style.display = "none";
       client.style.display = "none";
       transporteur.style.display = "none";
       chauffeur.style.display = "none";
      affreteur.style.display = "none";
      banque.style.display = "none";
      camion.style.display = "none";
      newprod.style.display = "none";

    } else {
      entrepot.style.display = "none";
     
    }
    
    
  }
</script>


<script>
  function visible_camion() {
  	 var camion = document.getElementById("calcam");
    var produit = document.getElementById("calproduits");
    var navire = document.getElementById("calnavire");
    var client = document.getElementById("calclient");
   var transporteur = document.getElementById("caltransporteur");
   var chauffeur = document.getElementById("calchauffeur");
    var entrepot = document.getElementById("calEntrepots");
        var affreteur = document.getElementById("calAffreteur");
    var banque = document.getElementById("calBanque");
    var newprod = document.getElementById("calnewproduits");
   
    

    
    if (entrepot.style.display === "none") {
    	 camion.style.display = "table";
    	 camion.scrollIntoView({ behavior: 'smooth' });
      entrepot.style.display = "none";
       
       navire.style.display = "none";
       produit.style.display = "none";
       client.style.display = "none";
       transporteur.style.display = "none";
       chauffeur.style.display = "none";
      affreteur.style.display = "none";
      banque.style.display = "none";


    } else {
      camion.style.display = "none";
     
    }
    
    
  }
</script>

<script>
  function visible_affreteur() {
  	var affreteur = document.getElementById("calAffreteur");
  	var banque = document.getElementById("calBanque");
    var navire = document.getElementById("calnavire");
    var produit = document.getElementById("calproduits");
    var client = document.getElementById("calclient");
    var transporteur = document.getElementById("caltransporteur");
    var chauffeur = document.getElementById("calchauffeur");
    var entrepot = document.getElementById("calEntrepots");
    var newprod = document.getElementById("calnewproduits");
    var camion = document.getElementById("calcam");
   
    
    
    if (affreteur.style.display === "none") {
    	affreteur.style.display = "table";
    	banque.style.display = "none";
      navire.style.display = "none";
      produit.style.display = "none";
      client.style.display = "none";
      transporteur.style.display = "none";
      chauffeur.style.display = "none";
      entrepot.style.display = "none";
       affreteur.scrollIntoView({ behavior: 'smooth' });
      camion.style.display = "none";
      newprod.style.display = "none";
     
    } else {
      affreteur.style.display = "none";
     
    }
    
    
  }
</script>


<script>
  function visible_banque() {
  	var banque = document.getElementById("calBanque");
  	var affreteur = document.getElementById("calAffreteur");
    var navire = document.getElementById("calnavire");
    var produit = document.getElementById("calproduits");
    var client = document.getElementById("calclient");
    var transporteur = document.getElementById("caltransporteur");
    var chauffeur = document.getElementById("calchauffeur");
    var entrepot = document.getElementById("calEntrepots");
    var camion = document.getElementById("calcam");
    var newprod = document.getElementById("calnewproduits");
   
    
    
    if (banque.style.display === "none") {
    	banque.style.display = "table";
    	 affreteur.style.display = "none";
      navire.style.display = "none";
      produit.style.display = "none";
      client.style.display = "none";
      transporteur.style.display = "none";
      chauffeur.style.display = "none";
      entrepot.style.display = "none";
      affreteur.scrollIntoView({ behavior: 'smooth' });
      camion.style.display = "none";
      newprod.style.display = "none";
     
    } else {
      banque.style.display = "none";
     
    }
    
    
  }
</script>

<script>
  function visible_new_produit() {
  	var newproduit = document.getElementById("calnewproduits");
  	var banque = document.getElementById("calBanque");
  	var affreteur = document.getElementById("calAffreteur");
    var navire = document.getElementById("calnavire");
    var produit = document.getElementById("calproduits");
    var client = document.getElementById("calclient");
    var transporteur = document.getElementById("caltransporteur");
    var chauffeur = document.getElementById("calchauffeur");
    var entrepot = document.getElementById("calEntrepots");
    var camion = document.getElementById("calcam");
    
   
    
    
    if (newproduit.style.display === "none") {
    	newproduit.style.display = "table";
    	banque.style.display = "none";
    	 affreteur.style.display = "none";
      navire.style.display = "none";
      produit.style.display = "none";
      client.style.display = "none";
      transporteur.style.display = "none";
      chauffeur.style.display = "none";
      entrepot.style.display = "none";
       camion.style.display = "none";
       newproduit.scrollIntoView({ behavior: 'smooth' });
     
    } else {
      newproduit.style.display = "none";
     
    }
    
    
  }
</script>






 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script type="text/javascript">
  function deleteProduit(id){
   
       if(confirm('Voulez vous vraiment supprimer ce donnée?')){
         
         $.ajax({

              type:'post',
              url:'delete_produit.php',
              data:{delete_id:id},
              success:function(data){
              
                   $('#'+id+'delcategories').hide('slow');

              }

         });

       }


     }

 


 </script>



 <script type="text/javascript">
  function deleteNewProduit(id){
   
       if(confirm('Voulez vous vraiment supprimer ce donnée?')){
         
         $.ajax({

              type:'post',
              url:'delete_new_produit.php',
              data:{delete_id:id},
              success:function(data){
              
                   $('#'+id+'delproduit').hide('slow');

              }

         });

       }


     }

 


 </script>




<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script type="text/javascript">
  function deleteClient(id){
   
       if(confirm('Voulez vous vraiment supprimer ce donnée?')){
         
         $.ajax({

              type:'post',
              url:'delete_client.php',
              data:{delete_id:id},
              success:function(data){
              
                   $('#'+id+'delclient').hide('slow');

              }

         });

       }


     }


 </script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script type="text/javascript">
  function deleteChauffeur(id){
   
       if(confirm('Voulez vous vraiment supprimer ce donnée?')){
         
         $.ajax({

              type:'post',
              url:'delete_chauffeur.php',
              data:{delete_id:id},
              success:function(data){
              
                   $('#'+id).hide('slow');

              }

         });

       }


     }


 </script>

 <script type="text/javascript">
  function deleteCamion(id){
   
       if(confirm('Voulez vous vraiment supprimer ce donnée?')){
         
         $.ajax({

              type:'post',
              url:'delete_camion.php',
              data:{delete_id:id},
              success:function(data){
              
                   $('#'+id+'delcamion').hide('slow');

              }

         });

       }


     }


 </script>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


 	<script type="text/javascript">
  function deleteNavire(id){
   
       if(confirm('Voulez vous vraiment supprimer ce donnée?')){
         
         $.ajax({

              type:'post',
              url:'delete_navire.php',
              data:{delete_id:id},
              success:function(data){
              
                   $('#'+id).hide('slow');

              }

         });

       }


     }


 </script>




<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


 	<script type="text/javascript">
  function deleteAffreteur(id){
   
       if(confirm('Voulez vous vraiment supprimer ce donnée?')){
         
         $.ajax({

              type:'post',
              url:'delete_affreteur.php',
              data:{delete_id:id},
              success:function(data){
              
                   $('#'+id+'delaffreteur').hide('slow');

              }

         });

       }


     }


 </script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
   function setModalContent(buttonId) {
  var modal = document.getElementById("vue_details_client");
  var buttonIdInput = modal.querySelector("#buttonIdInput");
  var codePpmClient = modal.querySelector("#code_ppm_client");
  var adresseClient = modal.querySelector("#adresse_client");
  var telClient = modal.querySelector("#tel_client");

  // Mettre à jour les valeurs avec les données correspondantes
  buttonIdInput.
  buttonIdInput
value = buttonId;
  codePpmClient.textContent = "<?php echo $row['code_ppm_client'] ?>";
  adresseClient.textContent = "<?php echo $row['adresse_client'] ?>";
  telClient.textContent = "<?php echo $row['tel_client'] ?>";
}
  </script>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script type="text/javascript">
  function deleteMg(id){
   
       if(confirm('Voulez vous vraiment supprimer ce donnée?')){
         
         $.ajax({

              type:'post',
              url:'delete_entrepot.php',
              data:{delete_id:id},
              success:function(data){
              
                   $('#'+id).hide('slow');

              }

         });

       }


     }


 </script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


 <script type="text/javascript">
  function deleteTransp(id){
   
       if(confirm('Voulez vous vraiment supprimer ce donnée?')){
         
         $.ajax({

              type:'post',
              url:'delete_transporteur.php',
              data:{delete_id:id},
              success:function(data){
              
                   $('#'+id+'deltransporteur').hide('slow');

              }

         });

       }


     }


 </script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script type="text/javascript">
  function deleteBanque(id){
   
       if(confirm('Voulez vous vraiment supprimer ce donnée?')){
         
         $.ajax({

              type:'post',
              url:'delete_banque.php',
              data:{delete_id:id},
              success:function(data){
              
                   $('#'+id+'delbanque').hide('slow');

              }

         });

       }


     }


 </script>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script type="text/javascript">


	$(document).ready(function(){
    $(document).on('click','a[data-role=update_cli]',function(){
        var id = $(this).data('id');
        var client = $('#'+id+'client').text();
        var code = $('#'+id+'code').text();
        var adresse = $('#'+id+'adresse').text();
        var tel = $('#'+id+'tel').text();
        var email = $('#'+id+'email').text();
       
       
        
        $('#m_client').val(client);
        $('#m_code_cli').val(code);
        $('#m_adresse_cli').val(adresse);
        $('#m_tel_cli').val(tel);
        $('#m_email_cli').val(email);
        $('#m_id_cli').val(id);
       
       
       
       
        
        
        $('#modif_cli').modal('toggle');
    });
    
    $('#save_cli').click(function(){
        var client = $('#m_client').val();
        var code = $('#m_code_cli').val();
         var adresse = $('#m_adresse_cli').val();
          var tel = $('#m_tel_cli').val();
           var email = $('#m_email_cli').val();
            var id = $('#m_id_cli').val();
        

        
        $.ajax({
		url:'modifier_client2.php',
		method:'post',
		data:{client:client,code:code,adresse:adresse,tel:tel,email:email,id:id},
		success: function(response){
			$('#calclient').html(response);
			/*$('#'+id).children('td[data-target=cales]').text(cale);
		$('#'+id).children('td[data-target=nom_chargeur]').text(ch);
		$('#'+id).children('td[data-target=conditionnement]').text(cond+' KGS');
		//$('#modif_dec').modal('toggle');*/
		$('#modif_cli').modal('toggle');
		}
	});
    });
});

</script>
 

 <script type="text/javascript">


	$(document).ready(function(){
    $(document).on('click','a[data-role=update_affreteur]',function(){
        var id = $(this).data('id');
        var affreteur = $('#'+id+'affreteur').text();
       
        var adresse = $('#'+id+'adresse_aff').text();
        var tel = $('#'+id+'tel_aff').text();
        var email = $('#'+id+'email_aff').text();
       
       
        
        $('#m_affreteur').val(affreteur);
       
        $('#m_adresse_aff').val(adresse);
        $('#m_tel_aff').val(tel);
        $('#m_email_aff').val(email);
        $('#m_id_aff').val(id);
       
       
       
       
        
        
        $('#modif_affreteur').modal('toggle');
    });
    
    $('#save_aff').click(function(){
        var affreteur = $('#m_affreteur').val();
        
         var adresse = $('#m_adresse_aff').val();
          var tel = $('#m_tel_aff').val();
           var email = $('#m_email_aff').val();
            var id = $('#m_id_aff').val();
        

        
        $.ajax({
		url:'modifier_affreteur2.php',
		method:'post',
		data:{affreteur:affreteur,adresse:adresse,tel:tel,email:email,id:id},
		success: function(response){
			$('#calAffreteur').html(response);
			/*$('#'+id).children('td[data-target=cales]').text(cale);
		$('#'+id).children('td[data-target=nom_chargeur]').text(ch);
		$('#'+id).children('td[data-target=conditionnement]').text(cond+' KGS');
		//$('#modif_dec').modal('toggle');*/
		$('#modif_affreteur').modal('toggle');
		}
	});
    });
});

</script>




<script type="text/javascript">


	$(document).ready(function(){
    $(document).on('click','a[data-role=update_banque]',function(){
        var id = $(this).data('id');
        var banque = $('#'+id+'banque').text();
       
        var adresse = $('#'+id+'adresse_banque').text();
        var tel = $('#'+id+'tel_banque').text();
        var email = $('#'+id+'email_banque').text();
       
       
        
        $('#m_banque').val(banque);
       
        $('#m_adresse_banque').val(adresse);
        $('#m_tel_banque').val(tel);
        $('#m_email_banque').val(email);
        $('#m_id_banque').val(id);
       
       
       
       
        
        
        $('#modif_banque').modal('toggle');
    });
    
    $('#save_banque').click(function(){
        var banque = $('#m_banque').val();
        
         var adresse = $('#m_adresse_banque').val();
          var tel = $('#m_tel_banque').val();
           var email = $('#m_email_banque').val();
            var id = $('#m_id_banque').val();
        

        
        $.ajax({
		url:'modifier_banque2.php',
		method:'post',
		data:{banque:banque,adresse:adresse,tel:tel,email:email,id:id},
		success: function(response){
			$('#calBanque').html(response);
			/*$('#'+id).children('td[data-target=cales]').text(cale);
		$('#'+id).children('td[data-target=nom_chargeur]').text(ch);
		$('#'+id).children('td[data-target=conditionnement]').text(cond+' KGS');
		//$('#modif_dec').modal('toggle');*/
		$('#modif_banque').modal('toggle');
		}
	});
    });
});

</script>



<script type="text/javascript">


	$(document).ready(function(){
    $(document).on('click','a[data-role=update_newproduit]',function(){
        var id = $(this).data('id');
        var produit = $('#'+id+'newproduit').text();
       
        var qualite = $('#'+id+'qualite').text();
        
       
       
        
        $('#m_newproduit').val(produit);
       
        $('#m_qualite').val(qualite);
       
        $('#m_id_newproduit').val(id);
       
       
       
       
        
        
        $('#modif_newproduit').modal('toggle');
    });
    
    $('#save_newproduit').click(function(){
         var produit = $('#m_newproduit').val();
          var qualite = $('#m_qualite').val();
           var id = $('#m_id_newproduit').val();
        

        
        $.ajax({
		url:'modifier_newproduit2.php',
		method:'post',
		data:{produit:produit,qualite:qualite,id:id},
		success: function(response){
			$('#calnewproduits').html(response);
			/*$('#'+id).children('td[data-target=cales]').text(cale);
		$('#'+id).children('td[data-target=nom_chargeur]').text(ch);
		$('#'+id).children('td[data-target=conditionnement]').text(cond+' KGS');
		//$('#modif_dec').modal('toggle');*/
		$('#modif_newproduit').modal('toggle');
		}
	});
    });
});

</script>


<script type="text/javascript">


	$(document).ready(function(){
    $(document).on('click','a[data-role=update_categorie]',function(){
        var id = $(this).data('id');
        var categorie = $('#'+id+'categorie').text();
        var taxe = $('#'+id+'taxe').text();

        
        $('#m_categorie').val(categorie);
        $('#m_id_categorie').val(id);
        $('#m_taxe').val(taxe);

        $('#modif_categorie').modal('toggle');
    });
    
    $('#save_categorie').click(function(){
         var categorie = $('#m_categorie').val();
           var id = $('#m_id_categorie').val();
           var taxe = $('#m_taxe').val();

        $.ajax({
		url:'modifier_categorie2.php',
		method:'post',
		data:{categorie:categorie,taxe:taxe,id:id},
		success: function(response){
			$('#calproduits').html(response);
			/*$('#'+id).children('td[data-target=cales]').text(cale);
		$('#'+id).children('td[data-target=nom_chargeur]').text(ch);
		$('#'+id).children('td[data-target=conditionnement]').text(cond+' KGS');
		//$('#modif_dec').modal('toggle');*/
		$('#modif_categorie').modal('toggle');
		}
	});
    });
});

</script>



<script type="text/javascript">


	$(document).ready(function(){
    $(document).on('click','a[data-role=update_transporteur]',function(){
        var id = $(this).data('id');
        var transporteur = $('#'+id+'transporteur').text();
   
        $('#m_transporteur').val(transporteur);
        $('#m_id_trans').val(id);

        
        $('#modif_trans').modal('toggle');
    });
    
    $('#save_trans').click(function(){
    	
        var transporteur = $('#m_transporteur').val();
     
            var id = $('#m_id_trans').val();
        

        
        $.ajax({
		url:'modifier_transporteur2.php',
		method:'post',
		data:{transporteur:transporteur,id:id},
		success: function(response){
			$('#caltransporteur').html(response);
			/*$('#'+id).children('td[data-target=cales]').text(cale);
		$('#'+id).children('td[data-target=nom_chargeur]').text(ch);
		$('#'+id).children('td[data-target=conditionnement]').text(cond+' KGS');
		//$('#modif_dec').modal('toggle');*/
		$('#modif_trans').modal('toggle');
		}
	});
    });
});

</script>



<script type="text/javascript">


	$(document).ready(function(){
    $(document).on('click','a[data-role=update_camion]',function(){
        var id = $(this).data('id');
        //ID DU TRANSPORTEUR
        
        var id_tr = $('#'+id+'trcamion').text();
        var camion = $('#'+id+'camions').text();
        //NOM DU TRANSPORTEUzR
        var nom = $('#'+id+'trnom').text();

        var existingOption = $('#m_trans_cam option[value="' + id_tr + '"]');
if (existingOption.length > 0) {
   // Mettre à jour le texte de l'option existante
   existingOption.text(nom);
} else {
   // Ajouter une nouvelle option avec la valeur et le texte correspondants
   var newOption = $('<option>', {
      value: id_tr,
      text: nom
   });
   $('#m_trans_cam').prepend(newOption);
   // Sélectionner l'option par défaut
   newOption.prop('selected', true);
}
   $('#m_trans_cam').val(id_tr);
        $('#m_camion').val(camion);
        $('#m_id_camions').val(id);
        //$('#m_trans_cam').val(id_tr);

        
        $('#modif_camion').modal('toggle');
    });
    
    $('#save_camion').click(function(){
    	
        var camion = $('#m_camion').val();
        var noms=$('#m_trans_cam').val();
     
            var id = $('#m_id_camions').val();
        

        
        $.ajax({
		url:'modifier_camion2.php',
		method:'post',
		data:{camion:camion,noms:noms,id:id},
		success: function(response){
			$('#calcam').html(response);
			/*$('#'+id).children('td[data-target=cales]').text(cale);
		$('#'+id).children('td[data-target=nom_chargeur]').text(ch);
		$('#'+id).children('td[data-target=conditionnement]').text(cond+' KGS');
		//$('#modif_dec').modal('toggle');*/
		$('#modif_camion').modal('toggle');
		}
	});
    });
});

</script>

<script type="text/javascript">


	$(document).ready(function(){
    $(document).on('click','a[data-role=update_chauffeur]',function(){
        var id = $(this).data('id');
        var chauffeur = $('#'+id+'chauffeur').text();
        var permis = $('#'+id+'permis').text();
        var tel = $('#'+id+'tel_chauffeur').text();
   
        $('#m_chauffeur').val(chauffeur);
        $('#m_permis').val(permis);
        $('#m_tel_chauffeur').val(tel);
        $('#m_id_chauffeur').val(id);

        
        $('#modif_chauffeur').modal('toggle');
    });
    
    $('#save_chauffeur').click(function(){
    	
        var chauffeur = $('#m_chauffeur').val();
        var permis = $('#m_permis').val();
        var tel = $('#m_tel_chauffeur').val();
        var id = $('#m_id_chauffeur').val();
        

        
        $.ajax({
		url:'modifier_chauffeur2.php',
		method:'post',
		data:{chauffeur:chauffeur,permis:permis,tel:tel,id:id},
		success: function(response){
			$('#calchauffeur').html(response);
			/*$('#'+id).children('td[data-target=cales]').text(cale);
		$('#'+id).children('td[data-target=nom_chargeur]').text(ch);
		$('#'+id).children('td[data-target=conditionnement]').text(cond+' KGS');
		//$('#modif_dec').modal('toggle');*/
		$('#modif_chauffeur').modal('toggle');
		}
	});
    });
});

</script>



<script type="text/javascript">


	$(document).ready(function(){
    $(document).on('click','a[data-role=update_mangasin]',function(){
        var id = $(this).data('id');
        var mangasin = $('#'+id+'mangasin').text();
        var code = $('#'+id+'code_mangasin').text();
        var agrement = $('#'+id+'agrement').text();
        var adresse = $('#'+id+'adresse_mg').text();
        var mangasinier = $('#'+id+'mangasinier').text();
        var id_user = $('#'+id+'id_user').text();
        var superficie = $('#'+id+'superficie').text();        
        superficie=superficie.replace(' m²', '');
         superficie=superficie.replace(' ', '');
                 var sac = $('#'+id+'sac_mg').text();
        sac=sac.replace(' sacs', '');
        sac=sac.replace(' ', '');
        

             var existingOption = $('#m_mangasinier option[value="' + id_user + '"]');
if (existingOption.length > 0) {
   // Mettre à jour le texte de l'option existante
   existingOption.text(mangasinier);
} else {
   // Ajouter une nouvelle option avec la valeur et le texte correspondants
   var newOption = $('<option>', {
      value: id_user,
      text: mangasinier
   });
   $('#m_mangasinier').prepend(newOption);
   // Sélectionner l'option par défaut
   newOption.prop('selected', true);
}
   $('#m_mangasinier').val(id_user);
       
       
        
        $('#m_mangasin').val(mangasin);
        $('#m_code').val(code);
        $('#m_agrement').val(agrement);
        $('#m_superficie').val(superficie);
        $('#m_sac').val(sac);
        $('#m_adres').val(adresse);
        $('#m_id_mg').val(id);
       // $('#m_email_cli').val(email);
        //$('#m_id_cli').val(id);

       
       
       
       
        
        
        $('#modif_mangasin').modal('toggle');
    });
    
    $('#save_mangasin').click(function(){
        var mangasin = $('#m_mangasin').val();
        var code = $('#m_code').val();
        var agrement = $('#m_agrement').val();
         var adresse = $('#m_adres').val();
          var superficie = $('#m_superficie').val();
           var sac = $('#m_sac').val();
           var mangasinier = $('#m_mangasinier').val();

            var id = $('#m_id_mg').val();
        

        
        $.ajax({
		url:'modifier_mangasin2.php',
		method:'post',
		data:{mangasin:mangasin,code:code,agrement:agrement,adresse:adresse,superficie:superficie,sac:sac,mangasinier:mangasinier,id:id},
		success: function(response){
			$('#calEntrepots').html(response);
			/*$('#'+id).children('td[data-target=cales]').text(cale);
		$('#'+id).children('td[data-target=nom_chargeur]').text(ch);
		$('#'+id).children('td[data-target=conditionnement]').text(cond+' KGS');
		//$('#modif_dec').modal('toggle');*/
		$('#modif_mangasin').modal('toggle');
		}
	});
    });
});

</script>



<script type="text/javascript">


	$(document).ready(function(){
    $(document).on('click','a[data-role=update_navire]',function(){
        var id = $(this).data('id');
        var navire = $('#'+id+'navire').text();
        var eta = $('#'+id+'eta').text();
        eta=eta.replace(' ','');
        var etb = $('#'+id+'etb').text();
        etb=etb.replace(' ','');
        var etd = $('#'+id+'etd').text();
        etd=etd.replace(' ','');
        var load_port = $('#'+id+'load_port').text();
        var destination = $('#'+id+'destination').text();
        var client = $('#'+id+'client_nav').text();
        var affreteur = $('#'+id+'affreteur_nav').text();        

        

             var existingOption = $('#m_affreteur_nav option[value="' + affreteur + '"]');
if (existingOption.length > 0) {
   // Mettre à jour le texte de l'option existante
   existingOption.text(affreteur);
} else {
   // Ajouter une nouvelle option avec la valeur et le texte correspondants
   var newOption = $('<option>', {
      value: affreteur,
      text: affreteur
   });
   $('#m_affreteur_nav').prepend(newOption);
   // Sélectionner l'option par défaut
   newOption.prop('selected', true);
}
   $('#m_affreteur_nav').val(affreteur);
       
       
        
        $('#m_navire').val(navire);
        $('#m_eta').val(eta);
        $('#m_etb').val(etb);
        $('#m_etd').val(etd);
        $('#m_load_port').val(load_port);
        $('#m_destination').val(destination);
        $('#m_client_nav').val(client);
       
        $('#m_id_nav').val(id);
       // $('#m_email_cli').val(email);
        //$('#m_id_cli').val(id);

       
       
       
       
        
        
        $('#modif_navire').modal('toggle');
    });
    
    $('#save_navire').click(function(){

       var navire=$('#m_navire').val();
       var affreteur= $('#m_affreteur_nav').val();
      var eta=  $('#m_eta').val();
      var etb=  $('#m_etb').val();
      var etd=  $('#m_etd').val();
 
        var load_port= $('#m_load_port').val();
       var destination= $('#m_destination').val();
       var client= $('#m_client_nav').val();
       
      var id= $('#m_id_nav').val();

        

        
        $.ajax({
		url:'modifier_navire2.php',
		method:'post',
		data:{navire:navire,affreteur:affreteur,eta:eta,etb:etb,etd:etd,load_port:load_port,destination:destination,client:client,id:id},
		success: function(response){
			$('#calnavire').html(response);
			/*$('#'+id).children('td[data-target=cales]').text(cale);
		$('#'+id).children('td[data-target=nom_chargeur]').text(ch);
		$('#'+id).children('td[data-target=conditionnement]').text(cond+' KGS');
		//$('#modif_dec').modal('toggle');*/
		$('#modif_navire').modal('toggle');
		}
	});
    });
});

</script>

<script type="text/javascript">


	$(document).ready(function(){
    $(document).on('click','a[data-role=first_suivant]',function(){
        var id = $('#id_compteur').text();
       
        
        $.ajax({
		url:'firts_suivant_camion.php',
		method:'post',
		data:{id:id},
		success: function(response){
			$('#calcam').html(response);
	
		}
	});
    });
});

</script>

<script type="text/javascript">


	$(document).ready(function(){
    $(document).on('click','a[data-role=first_retour]',function(){
        var id = $('#id_compteur2').text();
        var id_inter = $('#id_compteur_intermediare').text();
        
        $.ajax({
		url:'firts_retour_camion.php',
		method:'post',
		data:{id:id,id_inter:id_inter},
		success: function(response){
			$('#calcam').html(response);
	
		}
	});
    });
});

</script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script>
 $(document).ready(function() {
  $('#tabchauffeur table').DataTable({
    // Options de DataTables, si vous en avez besoin
    
  });
});

 $(document).ready(function() {
  $('#tabcamion table').DataTable({
    // Options de DataTables, si vous en avez besoin
    
  });
});

 $(document).ready(function() {
  //$('#tabEntrepot table').DataTable({
    // Options de DataTables, si vous en avez besoin
    
  });
//});

</script>

 </body>
</html>
