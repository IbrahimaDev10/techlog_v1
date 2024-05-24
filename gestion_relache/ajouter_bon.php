<?php
require('../database.php');
require('controller/afficher_navire.php');
//require('control_dc.php');
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

if(isset($_POST['ajout_declare']) and isset($_GET['m'])){
	if(!empty($_POST['bl']) and !empty($_POST['manifeste']) and !empty($_POST['des_douaniere']) and !empty($_POST['numero']) and !empty($_POST['poids']) and !empty($_POST['statut_douanier'])){
		//$nav=$_POST['navire'];
		
		$bl=$_POST['bl'];
		$manifeste=$_POST['manifeste'];
		$des_douaniere=$_POST['des_douaniere'];
		$numero=$_POST['numero'];
	
		$poids=$_POST['poids'];
		$statut=$_POST['statut_douanier'];
		
        $reelle="true";

	
			 $insertDispat= $bdd->prepare("INSERT INTO transit_reelle(n_manifeste,destination_douaniere,id_declaration_reelle,poids_declarer,statut_douaniere,id_bl,id_trans_navire) VALUES(?,?,?,?,?,?,?)");
			 




		 $insertDispat->bindParam(1,$manifeste);
		 $insertDispat->bindParam(2,$des_douaniere);
		 $insertDispat->bindParam(3,$numero);
		 $insertDispat->bindParam(4,$poids);
		 $insertDispat->bindParam(5,$statut);
		 $insertDispat->bindParam(6,$bl);
		 $insertDispat->bindParam(7,$_GET['m']);

		 

		 $insertDispat->execute();

		 $get_transit=$bdd->query("SELECT max(id_trans_reelle) from transit_reelle ");

            if($find=$get_transit->fetch()){
		  $insertDispat2= $bdd->prepare("INSERT INTO transit_extends(id_declaration_extends,poids_declarer_extends,id_bl_extends,id_trans_navire_extends,reelle,id_trans_reelle) VALUES(?,?,?,?,?,?)");
			 



         $insertDispat2->bindParam(1,$numero);
		 $insertDispat2->bindParam(2,$poids);
		 $insertDispat2->bindParam(3,$bl);
		 $insertDispat2->bindParam(4,$_GET['m']);
		 $insertDispat2->bindParam(5,$reelle);
		 $insertDispat2->bindParam(6,$find['max(id_trans_reelle)']);


		 

		 $insertDispat2->execute();


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





?>



<!doctype html>
<html lang="fr">
  <head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>ajouter destination</title>

	<!-- Bootstrap CSS-->
	<?php include('../super/link_deb.php'); ?>
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
					<?php include('../super/page.php'); ?>
				</li>

		    		
   			
            </div>
        </div>

       </div> 
	 </div>
	</div><!-- End Sidebar-->
<a href="https://www.freepik.com/free-photo/big-ship-dry-dock_1186463.htm#query=port%20autonome%20gratuit&position=16&from_view=search&track=ais">Image by bearfotos</a> on Freepik

	<div class="sidebar-overlay"></div>


	<!--Content Start-->
	<div class="content-start transition" style="background-image: url('../images/bg_page.jpg'); background-repeat:no-repeat; background-size: 100%;  margin: 0px; border: none; border-radius: 0px;">
		<div class="container-fluid dashboard">
			<div class="content-header">

			
			
			<div class="container-fluid" >
				<div class="row">
					<center>
			<h3 class="ajout_dis" style="color: white;">INSERTION DES RELÂCHES</h3>
			</center>
			
<div class="col col-lg-6" >			
	<div class="" id="" tabindex="-1" >
  <div class="modal-dialog">
    <div class="modal-content" style=" border: solid; border-color:rgb(0,141,202); ">
            <div class="modal-header" style="">
              <center>
              	<h3 class="modal-title fs-10 text-white text-center" id="exampleModalLabel " style="text-align:center;   ">Ajouter relâche</h3></center>
              	<center>
              <img class="logoo" src="../images/mylogo.ico" >
       </center>
      	
      </div>
       <br>	<br>
      <div class="modal-body">
<div id="info_validate"></div>
      	<form action="" method="POST" enctype="multipart/form-data">


                      

<div class="form-group position-relative has-icon-left mb-5">
   <input id="date" type="date" class="" placeholder="date" name="manifeste" style="width:45%; margin-right:20px "><br><br>		
	<?php $navire=afficher_navire($bdd);  ?>

        <select id="navire" name="bl" data-role="choix_navire" style="max-width: 200px;" required>
        	<option>Choisir un navire</option>
        	<?php while($nav=$navire->fetch()){ ?>
        		<option value="<?php echo $nav['id']; ?>"><?php echo $nav['navire']; ?></option>
        		<?php } ?>
        </select><br><br>

<?php 
        ?>
               <select id="connaissement"  style="max-width: 200px;" required>
               	<option>choisir client</option>
              
               </select><br>	


               <br>
               <input id="destination" type="text" class="" placeholder="destination " name="manifeste" style="width:45%; margin-right:20px " > 
               <br><br>
               <input id="destinataire" type="text" class="" placeholder="destinataire" name="manifeste" style="width:45%; margin-right:20px " required> 
               <br><br>



                   
                       <input id="numero" type="text" class=""   name="manifeste" style="width:45%; margin-right:20px " placeholder="numero bon" required>            
                            <input id="quantite" type="text" class="" placeholder="quantite" name="manifeste" style="width:45%; margin-right:20px " required><br><br>

                                   
				
				
   <center>
<a class="btn" style="width: 100%; " data-role="inserer">Ajouter</a>
   </center> 
   
   </div>
      
</form>
  
     
    </div>
  </div>
  </div>
	</div>
	</div>

	<center>
		<div id="affichage">
			
		</div>
	</center>

	


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
                       </select><br>	<br>	
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
                           <select id="selnavire" name="navire" class="form-control form-control-xl " onchange='goDC()' required>
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

<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('change','select[data-role=choix_navire]',function(){
  //$('#type').css('display', 'block');

    var id_navire = $('#navire').val();
      //var type_dec = $('#type_dec').val();
     

        $.ajax({
        url:'afficher_select_bon_connaissement.php',
        method:'post',
        data:{id_navire:id_navire},
        success: function(response){
            $('#connaissement').html(response);

       
        }
    });
 

  });
});
</script>








<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('click','a[data-role=inserer]',function(){
  //$('#type').css('display', 'block');

    
    var quantite = $('#quantite').val();
     var numero = $('#numero').val();
      var date = $('#date').val();
      var id_dis = $('#connaissement').val();
      var destination = $('#destination').val();
      var destinataire = $('#destinataire').val();
      var navire = $('#navire').val();

     
      //var type_dec = $('#type_dec').val();
     

        $.ajax({
        url:'insertion_bon.php',
        method:'post',
        data:{quantite:quantite,numero:numero,date:date,id_dis:id_dis,destination:destination,destinataire:destinataire,navire:navire},
        success: function(response){
            $('#affichage').html(response);

       
        }
    });
 

  });
});
</script>





 </body>
</html>
