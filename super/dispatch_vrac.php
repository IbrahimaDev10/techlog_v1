<?php
require('control_dc.php');

$idm=$_GET['m'];

$navire2=$bdd->prepare("SELECT type from navire_deb where id=?");
$navire2->bindParam(1,$idm);
$navire2->execute();
$navs=$navire2->fetch(); 



include('bouton_valider_form_ajout.php');

$chercheNav2 = $bdd->query("select * from navire_deb order by id desc");
$NavireDispat2 = $bdd->query("select * from navire_deb order by id desc");
$transNav = $bdd->query("select * from navire_deb order by id desc");

if($navs['type']=="SACHERIE"){

if(isset($_POST['ajout_dispat']) and isset($_GET['m'])){
	if( !empty($_POST['nombre_sac']) /*and !empty($_POST['poids_sac'])*/  and !empty($_POST['connaissement']) and  !empty($_POST['destination_douaniere'])){
		//$nav=$_POST['navire'];

		
		//$bl=explode('-', $_POST['bl']);
		
	
		$destination=$_POST['destination'];
	//	$poids_sac=$_POST['poids_sac'];


		//$produit=explode('-', $_POST['produit']);

		//NOMBRE_SAC=POIDS
		$poids=$_POST['nombre_sac'];
		$connaissement=$_POST['connaissement'];
		$produit=explode('-', $_POST['produit']);

		$poids_sac=$produit[1];
		
		//$client=$_POST['client'];
		//$poids1=$explode_bl[1];
		
	
		
		$des_doua=$_POST['destination_douaniere'];

		$decharge=1;
         
         $nombre_sac=$poids*1000/$poids_sac;



     
	
			 $insertDispat= $bdd->prepare("INSERT INTO dispats(quantite_sac,quantite_poids,des_douane,type_decharge,id_con_dis,id_mangasin) VALUES(?,?,?,?,?,?)");
			 

		
		 
		 $insertDispat->bindParam(1,$nombre_sac);
		 
		 $insertDispat->bindParam(2,$poids);
		
		 $insertDispat->bindParam(3,$des_doua);
		  $insertDispat->bindParam(4,$decharge);
		   $insertDispat->bindParam(5,$connaissement);

		 
		  $insertDispat->bindParam(6,$destination);

		
		 $insertDispat->execute();

	
	
	  echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
                echo '<script type="text/javascript">';

echo 'setTimeout(function () { swal("GOOD","<i class="fas fa-check-circle"></i>");';
                echo '}, 100);</script>';

     
	  //header('location:gestion_stock2.php?m='.$idm);

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
                $select=$bdd->query("select id_dis from dispats order by id_dis desc");
                if($sel=$select->fetch()){
               
                $req =$bdd->prepare("INSERT INTO fichier_mangasin (nom_fichier_mg, path_fichier_mg, taille_fichier_mg, type_fichier_mg, id_fichier_dis) VALUES (?,?,?,?,?)");
                $req->bindParam(1,$fileName);
                $req->bindParam(2,$fileDestination);
                $req->bindParam(3,$fileSize);
                $req->bindParam(4,$fileType);
                $req->bindParam(5,$sel['id_dis']);
                $req->execute();
               

                echo "Votre fichier a été téléchargé avec succès.";
            }
            else {
                echo "Une Erreur de Reseau est survenue ";
            }
                
            } else {
                echo "Le fichier est trop volumineux.";
            }
        } else {
            echo "Une erreur s'est produite lors du téléchargement de votre fichier.";
        }
    } else {
        echo "Ce type de fichier n'est pas autorisé.";
    }
}
else {
        echo "veuillez choisir un fichier.";
    } 
   
}
}



if($navs['type']=="VRAQUIER"){

if(isset($_POST['ajout_dispat']) and isset($_GET['m'])){
	if(!empty($_POST['connaissement']) and  !empty($_POST['destination_douaniere'])){
		//$nav=$_POST['navire'];

		
		//$bl=explode('-', $_POST['bl']);
		
	
		$destination=$_POST['destination'];
	//	$poids_sac=$_POST['poids_sac'];


		//$produit=explode('-', $_POST['produit']);

		//NOMBRE_SAC=POIDS
		
		$poids=$_POST['nombre_sac'];
		$connaissement=$_POST['connaissement'];
		$produit=explode('-', $_POST['produit']);

		//$poids_sac=$produit[1];
		
		//$client=$_POST['client'];
		//$poids1=$explode_bl[1];
		
	
		
		$des_doua=$_POST['destination_douaniere'];

		$decharge=1;
		$pp=$_POST['poids_sc2'];

        if(!empty($pp)){

         $nombre_sac=$poids*1000/$pp;
         }
         if(empty($pp)){
         	$nombre_sac=0;
         }



     
	
			 $insertDispat= $bdd->prepare("INSERT INTO dispats(quantite_sac,quantite_poids,des_douane,type_decharge,id_con_dis,id_mangasin) VALUES(?,?,?,?,?,?)");
			 

		
		 
		 $insertDispat->bindParam(1,$nombre_sac);
		 
		 $insertDispat->bindParam(2,$poids);
		
		 $insertDispat->bindParam(3,$des_doua);
		  $insertDispat->bindParam(4,$decharge);
		   $insertDispat->bindParam(5,$connaissement);

		  $insertDispat->bindParam(6,$destination);
		

		
		 $insertDispat->execute();

	
	
	  echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
                echo '<script type="text/javascript">';

echo 'setTimeout(function () { swal("GOOD","<i class="fas fa-check-circle"></i>");';
                echo '}, 100);</script>';

     
	  //header('location:gestion_stock2.php?m='.$idm);

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
                $select=$bdd->query("select id_dis from dispats order by id_dis desc");
                if($sel=$select->fetch()){
               
                $req =$bdd->prepare("INSERT INTO fichier_mangasin (nom_fichier_mg, path_fichier_mg, taille_fichier_mg, type_fichier_mg, id_fichier_dis) VALUES (?,?,?,?,?)");
                $req->bindParam(1,$fileName);
                $req->bindParam(2,$fileDestination);
                $req->bindParam(3,$fileSize);
                $req->bindParam(4,$fileType);
                $req->bindParam(5,$sel['id_dis']);
                $req->execute();
               

                echo "Votre fichier a été téléchargé avec succès.";
            }
            else {
                echo "Une Erreur de Reseau est survenue ";
            }
                
            } else {
                echo "Le fichier est trop volumineux.";
            }
        } else {
            echo "Une erreur s'est produite lors du téléchargement de votre fichier.";
        }
    } else {
        echo "Ce type de fichier n'est pas autorisé.";
    }
}
else {
        echo "veuillez choisir un fichier.";
    }

	
}
}










$afficher=$bdd->prepare("SELECT dis.*, cli.client,nc.num_connaissement,nc.poids_kg, nc.poids_connaissement,nc.id_navire, mg.mangasin, p.produit,p.qualite from dispats as dis
   # inner join declaration as d on d.id_declaration=dis.declaration_id 
    inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis 
    inner join client as cli on nc.id_client=cli.id
    inner join mangasin as mg on dis.id_mangasin=mg.id
    inner join produit_deb as p on dis.id_produits=p.id
	
	
  where nc.id_navire=?");
$afficher->bindParam(1,$_GET['m']);
$afficher->execute(); 

$affreteur=$bdd->query("select * from affreteur");

$banque=$bdd->query("select * from banque");

?>



<!doctype html>
<html lang="fr">
  <head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


	<title>ajouter destination</title>
  <?php include('link_deb.php'); ?>
	<!-- Bootstrap CSS-->
	
</head>
<body >
<style type="text/css">
	
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
       height: 80px;
        width: 100px;
       
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
.interne_span{
	color:red;
}

</style>


<?php include('navbar.php'); ?>
  
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
<?php include('sidebar_pre_deb.php'); ?>


	<div class="sidebar-overlay"></div>


	<!--Content Start-->
	<div class="content-start transition" style="background:white;   margin: 0px; border: none; border-radius: 0px;">
		<div class="container-fluid dashboard">
			<div class="content-header">

				
 <div class="container-fluid" >
				<div class="row">
					<center>
			<h6 class="ajout_dis" style="color: white;">INSERTION DISPATCHING</h6>
			</center>
			
<div class="col col-lg-6" >			
	<div class="" id="" tabindex="-1" >
  <div class="modal-dialog">
     <div class="modal-content" style=" border: solid; border-color:rgb(0,141,202); ">
            <div class="modal-header" style="">
              <center>
              	<h3 class="modal-title fs-10 text-white text-center" id="exampleModalLabel " style="text-align:center;   ">DISPATCHING</h3></center>
              	<center>
              <img class="logoo" src="../images/mylogo.ico" >
       </center>
      	
      </div>
       <br>	<br>
      <div class="modal-body">
      	<form action="" method="POST" enctype="multipart/form-data">


                      

<div class="form-group position-relative has-icon-left mb-5">

 <?php if($navs['type']=='VRAQUIER'){ ?>
                    	 <select id="type_chargement" name="type" class=" "  data-role="type_chargement" style="  margin-bottom:10px;  width:50%; ">

                        <option selected>CHOISIR LE TYPE DE CHARGEMENT </option>
                           <option value="1">EN SACHETS </option>
                           <option value="2">EN VRAC </option>
                           </select>
                           
                       <?php } ?>
	<center>	

<?php $choix_client=$bdd->prepare('SELECT nc.num_connaissement,nc.id_navire,cli.client,cli.id   from client as cli
	inner join numero_connaissements as nc on nc.id_client=cli.id
     	               
                  where nc.id_navire=? group by cli.id');
	   $choix_client->bindParam(1,$idm);
	   $choix_client->execute(); ?>
	<select name="client" id='client' style="max-width: 30%;" data-role='detail_client'>
		<option>CHOISIR CLIENT</option>
		<?php while($cli=$choix_client->fetch()){ ?>
			<option value="<?php echo $cli['id']; ?>" ><?php echo $cli['client']; ?>   </option>
		<?php } ?>
		
	</select>
	<select name="produit"  style="max-width: 30%; display: none; " data-role='detail_produit'>
		<option></option>
		
		
	</select>

	<select name="connaissement" id='connaissement' style="max-width: 30%;" data-role='type_de_chargement' >
		<option>CHOISIR connaissement</option>
		
		
	</select> <br><br>
	<div id='sp' style="display: none;"><input name='poids_sc' type="text" id="poids_scon" ></div>

	<div id="poids_sac_vrac" style="display: none;">

<?php $choix_qualite=$bdd->query('SELECT * from produit_deb ');
	   ?>
		                    	<select name="" id='produit' style="max-width: 50%; " >
		<option selected disabled="true">CHOISIR MARQUE DU SAC</option>
		<?php while($qual=$choix_qualite->fetch()){ ?>
			<option value="<?php echo $qual['id']; ?>" ><?php echo $qual['produit']; ?> <?php echo $qual['qualite']; ?> </option>
		<?php } ?>
		

	</select><br><br>	
                           	<select name="poids_sac_vrac" id='poids_sac_en_vrac'>
                           		<option value="0">CHOISIR LE POIDS (KG)</option>
                           		<option value="25">25 KG</option>
                           		<option value="40">40 KG</option>
                           		<option value="45">45 KG</option>
                           		<option value="50">50 KG</option>

                           	</select> <br><br>
                           	
  
                           	

       
                           	
                           </div><br>

	
	

	<?php $choix_destination=$bdd->query('SELECT mangasin, id from mangasin ');
	   ?>
	<select name="destination" id='destination' style="max-width: 50%;" >
		<option>CHOISIR Destination</option>
		<?php while($dest=$choix_destination->fetch()){ ?>
			<option value="<?php echo $dest['id']; ?>" ><?php echo $dest['mangasin']; ?> </option>
		<?php } ?>
		
	</select>

<!--	<span id='detail' ></span><br><br>	
		<select name="poids_sac" <?php if($navs['type']=='VRAQUIER'){ ?> style='display:none;' <?php } ?>>
                           		<option value="">CHOISIR LE POIDS (KG)</option>
                           		<option value="25">25 KG</option>
                           		<option value="40">40 KG</option>
                           		<option value="45">45 KG</option>
                           		<option value="50">50 KG</option>
                           	</select> <br><br> !-->

     <?php /* $choix_declaration=$bdd->prepare('SELECT nc.num_connaissement,nc.id_connaissement,d.num_declaration,d.id_declaration,d.id_destination   from declaration as d
     	
     	
     	inner join numero_connaissements as nc on nc.id_connaissement=d.id_bl
                     
                      
                  where nc.id_navire=? group by d.id_declaration');
	   $choix_declaration->bindParam(1,$idm);
	   $choix_declaration->execute(); */ ?>
<!--	<select name="bl" id='bl' style="max-width: 50%;" data-role='detail_declaration'>
		<option>CHOISIR UNE DECLARATION</option> !-->
		<?php // while($con=$choix_declaration->fetch()){ ?>
		<!--	<option value="<?php //echo $con['id_connaissement'].'-'.$con['id_declaration'].'-'.$con['id_destination']; ?>" ><?php //echo $con['num_declaration']; ?>   </option>
		<?php //} ?>
		
	</select><span id='detail' ></span><br><br>	!-->
		<select name="poids_sac" <?php if($navs['type']=='VRAQUIER' or $navs['type']=='SACHERIE'){ ?> style='display:none;' <?php } ?>>
                           		<option value="">CHOISIR LE POIDS (KG)</option>
                           		<option value="25">25 KG</option>
                           		<option value="40">40 KG</option>
                           		<option value="45">45 KG</option>
                           		<option value="50">50 KG</option>
                           		<option value="0">AUCUNE</option>
                           	</select> <br><br>

                               

                        
                            <input type="text" class=""  <?php if($navs['type']=='VRAQUIER'){ ?> placeholder="TONNAGE" <?php } ?>  <?php if($navs['type']=='SACHERIE'){ ?> placeholder="TONNAGE" <?php } ?> name="nombre_sac" id='poids' style=" width:50%;  margin-bottom: 10px;"><br><br>

                       
                               <select id="destination_douaniere" name="destination_douaniere" class=" "   style=" width:50%;  margin-bottom: 10px;">
                               	<option value="" > TRANSFERT / LIVRAISON</option>
                           <option value="TRANSFERT" >transfert</option>
                    <option value="LIVRAISON" >livraison</option></select>

                    </select>

                   
                         
                             

              
                  <label for="image" style=" width:45%; margin-right:5%; margin-bottom: 10px;">CHOISIR UN FICHIER :</label><br>
  <input type="file" name="fileInput" id="fileInput" style=" width:45%; margin-right:5%; margin-bottom: 10px;">
          </center>

          <input type="text" id='id_navire' style=" width:45%; margin-right:5%; margin-bottom: 10px; display: none;" value=<?php echo $idm; ?>>
          <input type="text" id='type' style=" width:45%; margin-right:5%; margin-bottom: 10px; display: none;" value=<?php echo $navs['type']; ?>>

                                               </div>                             
    

   <center>
<a class="btn" style="width: 100%;" name="ajout_dispat" data-role="ajout_dispat">ajouter</a>
   </center>                                         
                          
					</form>
                    
				</div>
      

  
      <div class="modal-footer">
 
        
      </div>
    </div>
  </div>
  </div>
	</div>






	<div class="col col-lg-6">

		 <div  class="table-responsive" border=1 id='tableau_dispatching' >
          <center>
 <table  class='table table-hover table-bordered table-striped'  border='2'  >
 	<thead>
 		<td colspan="9" style="background: blue; color:white; text-align:center;">DONNEES DEJA INSERES</td>
 	<tr style="color: white; background: blue; font-size:12px;">
 	<th>BL</th>
 	<th>CLIENT</th>
 	<th>PRODUIT</th>
 	<th>SAC</th>
 	<th>POIDS</th>
 	<th>TONNAGE</th>
 	<th>DESTINATION</th>
 	<th>ACTION</th>
 	
 </tr>
 	</thead>
<tbody>

 <?php while($aff=$afficher->fetch()){ ?>
<tr  style="background: white; color:black; text-align:center; vertical-align: middle;">
    <td><?php echo $aff['num_connaissement'] ?></td>
    <td><?php echo $aff['client'] ?></td>

    <td><?php echo $aff['produit'] ?> <?php echo $aff['qualite'] ?> <?php echo $aff['poids_kgs'].' KG' ?></td>

    <td><?php echo $aff['quantite_sac'] ?></td>

    <td><?php echo $aff['quantite_poids'] ?></td>

    <td><?php echo $aff['mangasin'] ?></td>
    <td style="display: flex; justify-content: center; vertical-align:middle;"><a data-role="modifier_dispatching" data-id="<?php echo $aff['id_dis']; ?>" ><i class="fas fa-edit"></i></a>
<a onclick="deleteDispatching(<?php echo $aff['id_dis'] ?>)"><i class="fas fa-trash"></i></a></td> 
<span id=<?php echo $aff['id_dis'].'navire_diss' ?>><?php echo $aff['id_navire'] ?></td>
 <?php } ?>

    </tbody>

 	</tr>
</table>
</div>

	</div>
<?php include('formulaire_ajout.php'); ?>

	<div class="modal fade" id="form_modif_dis" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    
     <center>
        
              <label>CHOISIR UN CONNAISSMENT</label><br>         	
                            <select id='produit_modifier' name="produit" class=" "  onchange="getpoids()"  style=" width:45%; margin-right:5%; ">

                        <option value="">CHOISIR UN PRODUIT </option>
                       <?php   
                           $p=$bdd->prepare("SELECT p.*, nc.*,cli.client from numero_connaissements as nc
                             inner join produit_deb as p on p.id=nc.id_produit
                             inner join client as cli on cli.id=nc.id_client where nc.id_navire=? ");
                            $p->bindParam(1,$idm);
                            $p->execute();
                            while ($a2=$p->fetch()) {
                            	?>
                                                            
                           <option value="<?php   echo   $a2["poids_connaissement"].'-'.$a2["id_produit"].'-'.$a2['poids_kg']; ?>" >Connaissement <span class="interne_span"><?php  echo  $a2["produit"]; ?> <?php  echo $a2["qualite"];  ?> <?php  echo $a2["poids_kg"].' KG';  ?></span>  </option>
                           <?php } ?>
                                 
                           </select> <br><br>
                       

      <label>BANQUE</label><br> 
    <select id="bank" style="width: 50%;">
    	<?php $prod=$bdd->query("select * from banque");
    	while($p=$prod->fetch()){ ?>
    		<option value="<?php echo $p['id'];	 ?>"	> <?php echo $p['banque']	 ?> 	</option> <?php 	} ?>
    		 <option value="0" >AUCUNE</option>
   
</select><br><br>

     <label>AFFRETEUR</label><br> 
    <select id="affret" style="width: 50%;">
    	<?php $prod=$bdd->query("select * from affreteur");
    	while($p=$prod->fetch()){ ?>
    		<option value="<?php echo $p['id'];	 ?>"	><?php echo $p['affreteur']	?> 	</option> <?php 	} ?>
    		 <option value="0" >AUCUN</option>
   
</select><br><br>

    

    </center><br>
     <label>N° CONNAISSEMENT</label>  
  <input type="text" class="form-control"  id="nc"  name="conditionnedis"  > <br>
    <label>POIDS</label>  
  <input type="text" class="form-control"  id="poids2"  name="conditionnedis"  > <br>

  <div style="display: none;">
   <label>id</label>  
  <input type="text" class="form-control"  id="id_con"  name="conditionnedis"  > <br>
   <label>navire</label>  
  <input type="text" class="form-control"  id="navire_con"  name="conditionnedis"  > <br>
  </div>
    </center>
    



</center>



         <center>
        <a style="width: 50%;" data-role="save_con"   class="btn btn-primary btn-block btn-lg shadow-lg mt-5" >valider</a>
</form> 
        
      <div class="modal-footer">
         
        </div>
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


        <script type="text/javascript">
        	$(document).ready(function(){
		$(document).on('change','select[data-role=type_chargement]',function(){
		var type=$('#type_chargement').val();
		if (type==1) {
			$('#poids_sac_vrac').css('display','block');
		}
		else{
			$('#poids_sac_vrac').css('display','none');
		}
	});
	});
        </script>

    <script type="text/javascript">
        	$(document).ready(function(){
		$(document).on('change','select[data-role=detail_declaration]',function(){
		var bl=$('#bl').val();
		$.ajax({
        url:'detail_declaration.php',
        method:'post',
        data:{bl:bl},
        success: function(response){
            $('#detail').html(response);
           
        }
    });
	});
	});
        </script>

     <script type="text/javascript">
        	$(document).ready(function(){
		$(document).on('change','select[data-role=detail_client]',function(){
		var client=$('#client').val();
		var id_navire=$('#id_navire').val();
		$.ajax({
        url:'detail_connaissement_vrac.php',
        method:'post',
        data:{client:client,id_navire:id_navire},
        success: function(response){
            $('#connaissement').html(response);
           
        }
    });
	});
	});
        </script>  

 <script type="text/javascript">
        	$(document).ready(function(){
		$(document).on('change','select[data-role=detail_produit]',function(){
		var produit=$('#produit').val();
		var id_navire=$('#id_navire').val();
		$.ajax({
        url:'detail_connaissement.php',
        method:'post',
        data:{produit:produit,id_navire:id_navire},
        success: function(response){
            $('#connaissement').html(response);
           
        }
    });
	});
	});
        </script>           

<script type="text/javascript">
  function deleteDispatching(id){
   
       if(confirm('Voulez vous vraiment supprimer ce donnée?')){
       	var navire=$('#'+id+'navire_diss').text();
         //var navire=navires.text();
         
         $.ajax({

              type:'post',
              url:'delete_dispatching_register.php',
              data:{delete_id:id,navire:navire},
              success:function(response){
              
                   $('#tableau_dispatching').html(response);

              }

         });

       }


     }

 


 </script>


  <script type="text/javascript">
        	$(document).ready(function(){
		$(document).on('click','a[data-role=modifier_dispatching]',function(){
			/*
		var id=$(this).data('id');
		var poids=$('#'+id+'poids').text();
		var banque=$('#'+id+'banque').text();
		var nc=$('#'+id+'nc').text();
		var affreteur=$('#'+id+'affreteur').text();
		var navire=$('#'+id+'navire_con').text();
		var produit=$('#'+id+'produit_con').text();
		//var cale=$('#'+id +'cales').text();

		$('#poids2').val(poids);
		$('#nc').val(nc);
		$('#bank').val(banque);
		$('#affret').val(affreteur);
		$('#id_con').val(id);
		$('#navire_con').val(navire);
		$('#produit_modifier').val(produit); */
		$('#form_modif_dis').modal('toggle');
	});
	});

    $(document).ready(function(){
		$(document).on('click','a[data-role=save_dis]',function(){
	/*	var poids= $('#poids2').val(); 
		var nc= $('#nc').val(); 
		var banque= $('#bank').val(); 
		var affreteur= $('#affret').val();  
		var id= $('#id_con').val(); 
		var navire= $('#navire_con').val(); 
		var produit= $('#produit_modifier').val(); */

			$.ajax({
		url:'modifier_num_connaissement.php',
		method:'post',
		data:{poids:poids,nc:nc,banque:banque,affreteur:affreteur,id:id,navire:navire,produit:produit},
		success: function(response){
			$('#tableau_num_connaissement').html(response);
			/*$('#'+id).children('td[data-target=cales]').text(cale);
		$('#'+id).children('td[data-target=nom_chargeur]').text(ch);
		$('#'+id).children('td[data-target=conditionnement]').text(cond+' KGS');
		//$('#modif_dec').modal('toggle');*/
		$('#form_modif_con').modal('toggle');
		}
	});
		});
		});  

	
 	
        </script>

          <script type="text/javascript">
        	$(document).ready(function(){
		$(document).on('change','select[data-role=type_de_chargement]',function(){
		var connaissement=$('#connaissement').val();
		
		$.ajax({
        url:'type_de_chargement.php',
        method:'post',
        data:{connaissement:connaissement},
        success: function(response){
            $('#sp').html(response);
           
        }
    });
	});
	});
        </script>  

        <script type="text/javascript">
        	/*
 $(document).on('click','a[data-role=ajout_dispat]',function(){
      
       var connaissement = $('#connaissement').val();
       var destination = $('#destination').val();
       var destination_douaniere = $('#destination_douaniere').val();
       var produit = $('#produit').val();
       
       var poids = $('#poids').val();
       var id_navire = $('#id_navire').val();
       var type = $('#type').val();
        
     if(connaissement!='' && poids!='' && produit!='' && destination!='' && destination_douaniere!=''  && id_navire!='' && type==='SACHERIE'){ 

        
        $.ajax({
		url:'ajax_ajout_dispat/ajout_dispat.php',
		method:'post',
		data:{connaissement:connaissement,destination:destination,poids:poids,id_navire:id_navire,type:type,destination_douaniere:destination_douaniere,produit:produit},
		success: function(response){
			$('#tableau_dispatching').html(response);
			
		
		}
	});
    }
    else{
   Swal.fire({
        icon: 'error',
        title: 'Erreur',
        text: 'Veuillez remplir tous les champs obligatoires.',
        confirmButtonText: 'OK'
    });
    }
    }); */

$(document).on('click', 'a[data-role=ajout_dispat]', function() {
    var formData = new FormData();

    // Ajoutez les autres données du formulaire
    var connaissement = $('#connaissement').val();
    var destination = $('#destination').val();
    var destination_douaniere = $('#destination_douaniere').val();
    var produit = $('#produit').val();
    var poids = $('#poids').val();
    var id_navire = $('#id_navire').val();
    var type = $('#type').val();
    var type_chargement = $('#type_chargement').val();
   
    var poids_sac_en_vrac= $('#poids_sac_en_vrac').val();


    


        if (connaissement != '' && poids != ''  && destination != '' && destination_douaniere != '' && id_navire != '' && type_chargement!='' && poids_sac_en_vrac!=''  && type === 'VRAQUIER') {
        formData.append('connaissement', connaissement);
        formData.append('destination', destination);
        formData.append('poids', poids);
        formData.append('id_navire', id_navire);
        formData.append('type', type);
        formData.append('destination_douaniere', destination_douaniere);
        formData.append('poids_sac_en_vrac', poids_sac_en_vrac);
        formData.append('type_chargement', type_chargement);
        formData.append('produit', produit);
       

        // Ajoutez le fichier
        var fileInput = document.getElementById('fileInput');
        formData.append('image', fileInput.files[0]);

        // Effectuez la requête AJAX
        $.ajax({
            url: 'ajax_ajout_dispat/ajout_dispat_vrac.php',
            method: 'POST',
            data: formData,
            contentType: false, // N'utilisez pas de type de contenu par défaut
            processData: false, // Ne pas traiter les données (FormData s'en charge)
            success: function(response) {
                $('#tableau_dispatching').html(response);
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: 'Une erreur s\'est produite lors de l\'envoi du formulaire.',
                    confirmButtonText: 'OK'
                });
            }
        });
    } else {
        Swal.fire({
            icon: 'error',
            title: 'Erreur',
            text: 'Veuillez remplir tous les champs obligatoires.',
            confirmButtonText: 'OK'
        });
    }
});


	

</script>

 </body>
</html>
