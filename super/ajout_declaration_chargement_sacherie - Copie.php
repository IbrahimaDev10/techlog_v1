<?php
require('control_dc.php');
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
if(isset($_POST['ajout_dc']) and isset($_GET['m'])){
	if(!empty($_POST['produit']) and !empty($_POST['nombre_sac']) and !empty($_POST['poids_sac']) and !empty($_POST['nom_chargeur']) and !empty($_POST['cale'])){
		//$nav=$_POST['navire'];
		$idm=$_GET['m'];
		$produit=$_POST['produit'];
		$nombre_sac=$_POST['nombre_sac'];
		$poids_sac=$_POST['poids_sac'];
		
		$cale=$_POST['cale'];
		$nom_ch=$_POST['nom_chargeur'];

		$poids=$nombre_sac*$poids_sac/1000;
 
			 $insertCargoPlan= $bdd->prepare("INSERT INTO declaration_chargement(cales,nom_chargeur,nombre_sac,conditionnement,poids,id_produit,id_navire) VALUES(?,?,?,?,?,?,?)");
			 try{

		 $insertCargoPlan->bindParam(1,$cale);
		 $insertCargoPlan->bindParam(2,$nom_ch);
		 $insertCargoPlan->bindParam(3,$nombre_sac);
		 $insertCargoPlan->bindParam(4,$poids_sac);
		 $insertCargoPlan->bindParam(5,$poids);
		 $insertCargoPlan->bindParam(6,$produit);
		 $insertCargoPlan->bindParam(7,$idm);

		 $insertCargoPlan->execute();

		

	
	}
	catch(Exception $e){

	}
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



$afficher=$bdd->prepare("select dc.*, p.* from declaration_chargement as dc 
	inner join produit_deb as p on dc.id_produit=p.id

  where dc.id_navire=?");
$afficher->bindParam(1,$_GET['m']);
$afficher->execute();



?>



<!doctype html>
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
					<a href="index.html" class="active">
						<i class='bx bxs-dashboard icon' ></i> MENU PRINCIPAL
					</a>
					<?php include('page.php'); ?>
				</li>

		    		
   			<li>


				

               

				<!-- Divider-->
                
 


  
 

            </div>
        </div>

       </div> 
	 </div>
	</div><!-- End Sidebar-->
	<div class="sidebar-overlay"></div>


	<!--Content Start-->
	<div class="content-start transition" style="background-image: url('../images/bg_page.jpg'); background-repeat:no-repeat; background-size: 100%;  margin: 0px; border: none; border-radius: 0px;">
		<div class="container-fluid dashboard">
			<div class="content-header">

			
		

				
			<div class="container-fluid" >
				<div class="row">
					<center>
			<h3 class="ajout_dis" style="color: white;">INSERTION DES CALES</h3>
			</center>
			
<div class="col col-lg-6" >			
	<div class="" id="" tabindex="-1" >
  <div class="modal-dialog">
     <div class="modal-content" style=" border: solid; border-color:rgb(0,141,202); ">
            <div class="modal-header" style="">
              <center>
              	<h3 class="modal-title fs-10 text-white text-center" id="exampleModalLabel " style="text-align:center;   ">Insertion cale</h3></center>
              	<center>
              <img class="logoo" src="../images/mylogo.ico" >
       </center>
      	
      </div>
       <br>	<br>
      <div class="modal-body">
      	<form action="" method="POST">


                      

<div class="form-group position-relative has-icon-left mb-5">

                 <select id="prod1" name="produit" class=" " style="width:45%; margin-right:20px; margin-bottom:10px;" onchange="getpoids()">

                        <option value="">choisir produit </option>
                       <?php  
                            $p=$bdd->prepare("select * from produit_deb where id_navire=?");
                            $p->bindParam(1,$idm);
                            $p->execute();

                            while ($a1=$p->fetch()) { ?>
                                                            
                           <option value=<?php   echo   $a1["id"] ?> > <?php   echo  $a1["produit"]  ?> <?php echo  $a1["qualite"] ?> </option>
                               <?php } ?> 
                               </select>
 
                            <input type="text" class="" placeholder="nombre_sac" name="nombre_sac" style="width:45%; margin-right:20px ">
                              <select id="poids_sac" name="poids_sac" class=" " style="width:45%; margin-right:20px; margin-bottom:10px;">
                            <option value="">choisir poids sac en KG</option>
                            <option value="5">20KG</option>
                            <option value="25">25KG</option>
                            <option value="45">45KG</option>
                            <option value="50">50KG</option>
                                
                            </select>

                         <select name="cale" class=" " style="width:45%; margin-right:20px; margin-bottom:10px;">
                            <option value="">choisir cale</option>
                            <option value="C1">cale 1</option>
                            <option value="C2">cale 2</option>
                            <option value="C3">cale 3</option>
                            <option value="C4">cale 4</option>
                            <option value="C5">cale 5</option>
                                
                            </select>


                       <input type="text" class="" placeholder="nom_chargeur" name="nom_chargeur" style="width:45%; margin-right:20px "> </div>                                                  
                            
                            
    

   <center>
<button class="btn" style="width: 100%;" name="ajout_dc">ajouter</button>
   </center>                                         
                          
					</form>
                    
				</div>
      

  

    </div>
  </div>
  </div>
	</div>

	<div class="col col-lg-6">
		<br>
		<center>
		<h3 style="background: rgb(0,141,202); color: white;">DONNEES DEJA INSEREES </h3>
		</center>
		 <div  class="table-responsive" border=1 >
          <center>
 <table  class='table table-hover table-bordered table-striped'  border='2'  >
 	<thead>
 	<tr style="background: rgb(0,141,202); color: white;">
 	<th>cale</th>
 	<th>produit</th>
 	<th>sac</th>
 	<th>poids_sac</th>
 	<th>tonnage</th>
 	<th>nom_chargeur</th>
 	
 	</thead>

 <?php while($aff=$afficher->fetch()){?>
 	<tr style="background: rgb(213,242,255);">
<td style="color: white;"><?php echo $aff['cales'] ?></td>
<td style="color: white;"><?php echo $aff['produit'] ?></td>
<td style="color: white;"><?php echo $aff['nombre_sac'] ?></td>
<td style="color: white;"><?php echo $aff['conditionnement'] ?></td>
<td style="color: white;"><?php echo $aff['poids'] ?></td>
<td style="color: white;"><?php echo $aff['nom_chargeur'] ?></td>

 </tr>
 <?php } ?> 

	

 	</tr>
</table>
</div>

	</div>


</div>
</div>

	
	<div class="modal fade" id="DC" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
      	<center>
        <h1 class="modal-title fs-5 text-white text-center" id="exampleModalLabel " style="text-align:center; ">Ajout declaration de chargement</h1></center>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      	<div id="auth-right">
					<div class="auth-logo">
						<a href="control_debarquement.php"><img src="../assets/images/mylogo.ico" alt="Logo"> Ajouter un navire</a>  
					</div>
					</div>
      	<form action="debarquement.php" method="POST">
<div class="form-group position-relative has-icon-left mb-4">
                        	<div class="form-group position-relative has-icon-left mb-4">
                           <select id="selnavire" name="navire" class="form-control form-control-xl " onchange='goDC()'>
                            <option value="">choix du navire</option>
                            <?php 
                            while ($chNav=$chercheNav2->fetch()) {
                            	?>
                            <option value="<?= $chNav['id']; ?>"><?php echo $chNav['navire']; ?> </option>	
                           <?php } ?> 
                       </select>
                        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="begin_declare">commencer</button>
                           </div> 
                                             
                          
					</form>
                    
				</div>
      

  
      <div class="modal-footer">
 
        
      </div>
    </div>
  </div>
</div>
</div>
			


<div class="modal fade" id="daap" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
      	<center>
        <h1 class="modal-title fs-5 text-white text-center" id="exampleModalLabel " style="text-align:center; ">Dispatcher le stockage</h1></center>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      	<div id="auth-right">
					<div class="auth-logo">
						<a href="control_debarquement.php"><img src="../assets/images/mylogo.ico" alt="Logo"> Ajouter un navire</a>  
					</div>
					</div>
      	<form action="control_debarquement.php" method="POST">
<div class="form-group position-relative has-icon-left mb-4">
                        	<div class="form-group position-relative has-icon-left mb-4">
                           <select id="selnavires" name="navires" class="form-control form-control-xl " >
                            <option value="">choix du navire</option>
                            <?php 
                            
                            
                            while ($Nav=$NavireDispat2->fetch()) {
                            	?>
                            <option value="<?= $Nav['id']; ?>"><?php echo $Nav['navire']; ?> </option>	
                           <?php } ?> 
                       </select>
                        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="begin_dispat">commencer</button>
                           </div> 
                           
                        <br><br><br>

   

                                            
                          
					</form>
                    
				</div>
      

  
      <div class="modal-footer">
 
        
      </div>
    </div>
  </div>
</div>
  </div>
</div>

  
<div class="modal fade" id="transit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
      	<center>
        <h1 class="modal-title fs-5 text-white text-center" id="exampleModalLabel " style="text-align:center; ">Ajout transit</h1></center>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      	<div id="auth-right">
					<div class="auth-logo">
						<a href="control_debarquement.php"><img src="../assets/images/mylogo.ico" alt="Logo"> TRANSIT</a>  
					</div>
					</div>
      	<form action="debarquement.php" method="POST">
<div class="form-group position-relative has-icon-left mb-4">
                        	<div class="form-group position-relative has-icon-left mb-4">
                           <select id="selnavire" name="navire" class="form-control form-control-xl " onchange='goDC()'>
                            <option value="">choix du navire</option>
                            <?php 
                            while ($chNav=$transNav->fetch()) {
                            	?>
                            <option value="<?= $chNav['id']; ?>"><?php echo $chNav['navire']; ?> </option>	
                           <?php } ?> 
                       </select>
                        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="begin_transit">commencere</button>
                           </div> 
                                             
                          
					</form>
                    
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
            function pdispat(){
                var xhr = getXhr();
                // On définit ce qu'on va faire quand on aura la réponse
                xhr.onreadystatechange = function(){
                    // On ne fait quelque chose que si on a tout reçu et que le serveur est OK
                    if(xhr.readyState == 4 && xhr.status == 200){
                        leselect = xhr.responseText;
                        // On se sert de innerHTML pour rajouter les options à la liste
                        document.getElementById('dis1').innerHTML = leselect;

                    }
                }
 
                // Ici on va voir comment faire du post
                xhr.open("POST","form_dispat2.php",true);
                // ne pas oublier ça pour le post
                xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
                // ne pas oublier de poster les arguments
                // ici, l'id de l'auteur
                sel = document.getElementById('p1');
                idp1 = sel.options[sel.selectedIndex].value;
                xhr.send("idP1="+idp1);
            }
        </script>




 </body>
</html>
