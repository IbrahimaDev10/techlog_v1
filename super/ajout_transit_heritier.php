<?php
require('control_dc.php');
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

        $explode=explode('-', $_GET['m']);
        $navire=$explode[0];
        $id_trans_reelle=$explode[1];
        $id_connaissement=$explode[2];
        $id_dis=$explode[3];
if(isset($_POST['ajout_declare2']) and isset($_GET['m'])){
	if(!empty($_POST['bl'])  and !empty($_POST['numero']) and !empty($_POST['poids']) ){
		//$nav=$_POST['navire'];
		
		$bl=$_POST['bl'];

		$numero=$_POST['numero'];
	
		$poids=$_POST['poids'];
		
		
        $reelle="false";
        



			 

		 

		 

		
		  $insertDispat2= $bdd->prepare("INSERT INTO transit_extends(id_declaration_extends,poids_declarer_extends,id_bl_extends,id_trans_navire_extends,reelle,id_trans_reelle) VALUES(?,?,?,?,?,?)");
			 



          $insertDispat2->bindParam(1,$numero);
		 $insertDispat2->bindParam(2,$poids);
		 $insertDispat2->bindParam(3,$bl);
		 $insertDispat2->bindParam(4,$navire);
		 $insertDispat2->bindParam(5,$reelle);
		 $insertDispat2->bindParam(6,$id_trans_reelle);


		 $insertDispat2->execute();

		 $poids_reelle=$bdd->prepare("SELECT poids_declarer from transit_reelle where id_trans_reelle=?");
		 $poids_reelle->bindParam(1,$id_trans_reelle);
		 $poids_reelle->execute();
		 $poids_r=$poids_reelle->fetch();

		 $poids_heritier=$bdd->prepare("SELECT sum(poids_declarer_extends) from transit_extends where id_trans_reelle=? and reelle='false' ");
		 $poids_heritier->bindParam(1,$id_trans_reelle);
		 $poids_heritier->execute();
		 $poids_h=$poids_heritier->fetch();

		 $nouveau_poids=$poids_r['poids_declarer']-$poids_h['sum(poids_declarer_extends)'];

		 $update=$bdd->prepare("UPDATE transit_extends set poids_declarer_extends=? where id_trans_reelle=? and reelle='true' ");
		 $update->bindParam(1,$nouveau_poids);
		 $update->bindParam(2,$id_trans_reelle);
		 $update->execute(); 

	
	 	   echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
                echo '<script type="text/javascript">';

echo 'setTimeout(function () { swal("REUSSI","Insertion reussi avec success");';
                echo '}, 100);</script>';
}


	else{
		 		  echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
                echo '<script type="text/javascript">';
                
               
echo 'setTimeout(function () { swal("ECHEC"," Verifier les informations   ","erreur");';
                echo '}, 100);</script>';
	}


	if(!empty($_FILES['image'])){
    $file = $_FILES['image'];
    $fileName = $_FILES['image']['name'];
    $fileTmpName = $_FILES['image']['tmp_name'];
    $fileSize = $_FILES['image']['size'];
    $fileError = $_FILES['image']['error'];
    $fileType = $_FILES['image']['type'];

    //$id=$_POST['ids'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png', 'gif', 'pdf');

    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 1000000000) { // taille maximale de 1 Mo
                $fileNameNew = uniqid('', true).".".$fileActualExt;
                $fileDestination = 'uploads_fichier/'.$fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);

                // Enregistrement de l'information de l'image dans la base de données

                $select=$bdd->query("select id_trans from transit order by id_trans desc");

               if($sel=$select->fetch()){
                $req =$bdd->prepare("INSERT INTO fichier_transit (nom_fichier_trans, path_fichier_trans, taille_fichier_trans, type_fichier_trans, id_fichier_trans) VALUES (?,?,?,?,?)");
                $req->bindParam(1,$fileName);
                $req->bindParam(2,$fileDestination);
                $req->bindParam(3,$fileSize);
                $req->bindParam(4,$fileType);
                $req->bindParam(5,$sel['id_trans']);
                $req->execute();

               

                echo "Votre fichier a été téléchargé avec succès.";
                
            }
            else {
                echo "Une Erreur de reseau est survenue.";
            }
        }
             else {
                echo "Le fichier est trop volumineux.";
            }
        } else {
            echo "Une erreur s'est produite lors du téléchargement de votre fichier.";
        }
    } else {
        echo "Ce type de fichier n'est pas autorisé.";
    }
   
}

	
}

if (isset($_POST['begin_declare'])) {
	if(!empty($_POST['navire'])){
		$nav=$_POST['navire'];
		$Navdec = $bdd->prepare("select id,navire,type from navire_deb where id=? ");
		try {

		 $Navdec->bindParam(1,$nav);

		 $Navdec->execute();
		 $find=$Navdec->fetch();
		 if($find['type']=='SACHERIE'){
		 	header('location:ajout_declaration_chargement_sacherie.php?m='.$nav);
		 	$_GET['p']=0;
		 	
		 }
		 else if($find['type']=='VRAQUIER') {
		 	header('location:ajout_declaration_chargement_vrac.php?m='.$nav);
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


if (isset($_POST['begin_dispat'])) {
	if(!empty($_POST['navires'])){
		$nav=$_POST['navires'];
		$Navdec = $bdd->prepare("select id,navire,type from navire_deb where id=? ");
		try {

		 $Navdec->bindParam(1,$nav);

		 $Navdec->execute();
		 $find=$Navdec->fetch();
		 if($find['type']=='SACHERIE'){
		 	//header('location:gestion_stock.php?m='.$nav);
		 	header('location:dispatessai.php?m='.$nav);
		 }
		if ($find['type']=='VRAQUIER'){
		 	header('location:ajout_dispatch_vrac.php?m='.$nav);
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
		 	header('location:ajout_declaration.php?m='.$nav);
		 }
		else  if($find['type']=='SACHERIE'){
		 	header('location:ajout_declaration.php?m='.$nav);
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
$chercheNav2 = $bdd->query("select * from navire_deb order by id desc");
$NavireDispat2 = $bdd->query("select * from navire_deb order by id desc");
$transNav = $bdd->query("select * from navire_deb order by id desc");



/*
$afficher=$bdd->prepare("SELECT tr_r.*, tr_ex.*, dis.n_bl from transit_extends as tr_ex 
	inner join transit_reelle as tr_r on tr_r.id_trans_reelle=tr_ex.id_trans_reelle
	inner join dispatching as dis on dis.id_dis=tr_ex.id_bl_extends

  where tr_ex.id_trans_navire_extends=?");
$afficher->bindParam(1,$_GET['m']);
$afficher->execute();

$afficher2=$bdd->prepare("SELECT count(tr_ex.id_trans_extends), tr_r.poids_declarer, tr_ex.*, dis.n_bl from transit_reelle as tr_r 
	inner join transit_extends as tr_ex on tr_r.id_trans_reelle=tr_ex.id_trans_reelle
	inner join dispatching as dis on dis.id_dis=tr_ex.id_bl_extends

  where tr_ex.id_trans_navire_extends=? ");
$afficher2->bindParam(1,$_GET['m']);
$afficher2->execute();
*/
?>



<!Doctype html>
<html lang="fr">
  <head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>ajouter destination</title>

	<!-- Bootstrap CSS-->
	<?php include('link_deb.php'); ?>
</head>
<body >
<style type="text/css">
	*{
		font-family: Times New Roman;

	}

.lienforme{
color:white; font-size: 20px; border: solid; background-color: black; margin-bottom: 50px;

}

.ajout_dis{
	background-color: rgb(0,141,202);
	font-weight: bold;
	width: 75%;
	border: solid;
	border-top-right-radius: 45%;
	border-bottom-right-radius: 45%;

}

.logoo{
      border-radius: 50px;
       height: 150px;
        width: 200px;
       
        z-index: 2;
        text-align: center;

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

 .btn{
 	background: linear-gradient(to bottom, blue, #1B2B65);
       background: linear-gradient(to top, blue, #1B2B65);
       background: linear-gradient(to left, blue, #1B2B65);
       color:white;
       font-weight: bold;
 }
#colonne{
	font-size: 12px;
	vertical-align: middle;
	text-align: center;
	font-weight: bold;
}

</style>



  
  <!--Topbar -->
  <div class="topbar transition" style="background: white;">
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
					  <img src="assets/images/avatar/avatar-1.png" alt="">
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
<div class="sidebar transition overlay-scrollbars animate__animated  animate__slideInLeft" style="background: linear-gradient(to bottom, blue, #1B2B65); background: linear-gradient(to left, blue, #1B2B65); background: linear-gradient(to top, blue, #1B2B65);" >
        <div class="sidebar-content"> 
        	<div id="sidebar">
			
			<!-- Logo -->
			<div class="logo">
					<h2 class="mb-4"><img style="width: 150px; height: 150px;  border-radius: 50px; color: white;" src="../assets/images/mylogo.ico"> </h2>
			</div>

            <ul class="side-menu">
                <li>
					<a href="../star_superviseur.php" class="active">
						<i class='bx bxs-dashboard icon' ></i> MENU PRINCIPAL
					</a>
					<?php include('page.php'); ?>
				</li>

		    		
   			                          

            </div>
        </div>

       </div> 
	 </div>
	</div><!-- End Sidebar-->
<a href="https://www.freepik.com/free-photo/big-ship-dry-dock_1186463.htm#query=port%20autonome%20gratuit&position=16&from_view=search&track=ais">Image by bearfotos</a> on Freepik

	<div class="sidebar-overlay"></div>


	<!--Content Start-->
	<div class="content-start transition " style="background:white; margin-left:275px; ">

		<div class="container-fluid dashboard" style="margin-left: 0 !important;">
			<h3 class="ajout_dis" style="color: white;">INSERTION DES DECLARATIONS</h3>
			<div class="content-header">

			
			
			
				<div class="row">
					
			
			
			
<div  style="float: left; margin-left: 0;">			
	<div class="" id="" tabindex="-1" >
  <div class="modal-dialog">
    <div class="modal-content" style=" border: solid; border-color:rgb(0,141,202); ">
            <div class="modal-header" style="">
              <center>
              	<h3 class="modal-title fs-10 text-white text-center" id="exampleModalLabel " style="text-align:center;   ">DECLARATION</h3></center>
              	<center>
              <img class="logoo" src="../images/mylogo.ico" >
       </center>
      	
      </div>
       <br>	<br>
      <div class="modal-body">

      	<form action="" method="POST" enctype="multipart/form-data">


                      

<div class="form-group position-relative has-icon-left mb-5">

                 <?php           
                        $connaissement = $bdd->prepare("SELECT dis.*,nc.*, p.*,cli.*, b.banque, b.id, mg.mangasin from dispat as dis
                        
                        inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
                        inner join client as cli on dis.id_client=cli.id 
                         
                        
                        inner join produit_deb as p  on dis.id_produit=p.id
                        inner join mangasin as mg on mg.id=dis.id_mangasin
                        left join banque as b on b.id=nc.id_banque
                         
                      
                        where nc.id_navire=? and nc.id_connaissement=? and dis.id_dis!=?  order by nc.num_connaissement ");
        $connaissement->bindParam(1,$navire);
         $connaissement->bindParam(2,$id_connaissement);
          $connaissement->bindParam(3,$id_dis);
       
        $connaissement->execute(); ?>

        <select name="bl" style="width: 100%;">
        	<option>choisir bl</option>
        	<?php while($con=$connaissement->fetch()){ ?>
        		<option value="<?php echo $con['id_dis']; ?>"><?php echo 'bl: ' .$con['num_connaissement'].' '.$con['produit'].' '.$con['qualite'].' '.$con['poids_kg'].' kg destination '.$con['mangasin']; ?></option>
        		<?php } ?>
        </select>
                                </select>
                                <div style="display: none;">
                      <label>numuro declaration</label><br>
                     <select id="" name="numero" class=" " style="width:45%; margin-right:20px; margin-bottom:20px;" onchange="getpoids()">

                        
                        <?php  
                            $declare=$bdd->prepare("SELECT dc.*, re.id_trans_reelle  from transit_reelle as re 
                            inner join declaration as dc on dc.id_declaration=re.id_declaration_reelle where re.id_trans_navire=? and re.id_trans_reelle=?");
                            $declare->bindParam(1,$navire);
                            $declare->bindParam(2,$declaration);
                            $declare->execute();
                            
                            while ($dec=$declare->fetch()) { ?>
                                                            
                           <option value=<?php   echo   $dec["id_trans_reelle"]; ?> > <?php echo $dec["num_declaration"]; ?> </option>
                              <?php } ?> 
                                </select> 
                                </div>

                                <?php $declaration=$bdd->prepare('SELECT * from declaration where id_navire=?');
               $declaration->bindParam(1,$_GET['m']);
               $declaration->execute(); ?>
               <select name="numero">
               	<option>choisir une declaration</option>
               	<?php while($dec=$declaration->fetch()){ ?>
               		<option value="<?php echo $dec['id_declaration']; ?>"><?php echo $dec['num_declaration']; ?></option>
               	<?php } ?>
               </select>


                                  
                                  <input type="text" class="" placeholder="poids declares" name="poids" style="width:45%; margin-right:20px ">
                          

  
                                    
				
				
   <center>
<button class="btn" style="width: 100%; " name="ajout_declare2">ajouter</button>
   </center> 
   
   </div>
      
</form>
  
     
    </div>
  </div>
  </div>
	</div>
	</div>

	<div class="col col-lg-6">
		<br>
		<center>
		<h3 style="background-color: rgb(0,141,202); color: white; ">DONNEES DEJA INSEREES  </h3>
		</center>
		 <div  class="table-responsive" border=1 >
          <center>
 <table  class='table table-hover table-bordered table-striped'  border='2'  >
 	<thead>
 	<tr style="color: white; background: blue;">
 	<th id="colonne">NUMERO BL</th>
 	<th id="colonne">DESTINATION DOUANIERE</th>
 	<th id="colonne">STATUT DOUANIER</th>
 	<th id="colonne">NUMERO MANIFESTE</th>
 	<th id="colonne">NUMERO DECLARATION</th>
 	<th id="colonne">POIDS DECLARES</th>
 	
 	
 	</thead>

 

	

 	
</table>
</div>

	</div>


</div>
</div>

	
				

  
			



      

  
      <div class="modal-footer">
 
        
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







 </body>
</html>
