<?php
require('../database.php');
require('controller/afficher_navire.php');

header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

       // $explode=explode('-', $_GET['m']);
       // $navire=$explode[0];
       // $declaration=$explode[1];
if(isset($_POST['ajout_declare2']) and isset($_GET['m'])){
	if(!empty($_POST['bl'])  and !empty($_POST['numero']) and !empty($_POST['poids']) ){
		//$nav=$_POST['navire'];
		
		$bl=$_POST['bl'];

		$numero=$_POST['numero'];
	
		$poids=$_POST['poids'];
		
		
        $reelle="false";
        



			 

		 

		 

		
		  $insertDispat2= $bdd->prepare("INSERT INTO transit_extends(poids_declarer_extends,id_bl_extends,id_trans_navire_extends,reelle,id_trans_reelle) VALUES(?,?,?,?,?)");
			 




		 $insertDispat2->bindParam(1,$poids);
		 $insertDispat2->bindParam(2,$bl);
		 $insertDispat2->bindParam(3,$navire);
		 $insertDispat2->bindParam(4,$reelle);
		 $insertDispat2->bindParam(5,$numero);


		 $insertDispat2->execute();

		 $poids_reelle=$bdd->prepare("SELECT poids_declarer from transit_reelle where id_trans_reelle=?");
		 $poids_reelle->bindParam(1,$numero);
		 $poids_reelle->execute();
		 $poids_r=$poids_reelle->fetch();

		 $poids_heritier=$bdd->prepare("SELECT sum(poids_declarer_extends) from transit_extends where id_trans_reelle=? and reelle='false' ");
		 $poids_heritier->bindParam(1,$numero);
		 $poids_heritier->execute();
		 $poids_h=$poids_heritier->fetch();

		 $nouveau_poids=$poids_r['poids_declarer']-$poids_h['sum(poids_declarer_extends)'];

		 $update=$bdd->prepare("UPDATE transit_extends set poids_declarer_extends=? where id_trans_reelle=? and reelle='true' ");
		 $update->bindParam(1,$nouveau_poids);
		 $update->bindParam(2,$numero);
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


?>



<!Doctype html>
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
					<a  class="active">
						<i class='bx bxs-dashboard icon' ></i> MENU PRINCIPAL
					</a>
					<?php include('../super/page.php'); ?>
				</li>

		    		
   			                          

            </div>
        </div>

       </div> 
	 </div>
	</div><!-- End Sidebar-->
<a >Image by bearfotos</a> on Freepik

	<div class="sidebar-overlay"></div>


	<!--Content Start-->
	<div class="content-start transition" style="background-image: url('../images/bg_page.jpg'); background-repeat:no-repeat; background-size: 100%;  margin: 0px; border: none; border-radius: 0px;">
		<div class="container-fluid dashboard">
			<div class="content-header">

			
			
			<div class="container-fluid" >
				<div class="row">
					<center>
			<h3 class="ajout_dis" style="color: white;">INSERTION DES DECLARATIONS</h3>
			</center>
			
<div class="col col-lg-6" >			
	<div class="" id="" tabindex="-1" >
  <div class="modal-dialog">
    <div class="modal-content" style=" border: solid; border-color:rgb(0,141,202); ">
            <div class="modal-header" style="">
              <center>
              	<h3 class="modal-title fs-10 text-white text-center" id="exampleModalLabel " style="text-align:center;   ">DECLARATION DE SORTIE</h3></center>
              	<center>
              <img class="logoo" src="../images/mylogo.ico" >
       </center>
      	
      </div>
       <br>	<br>
      <div class="modal-body">

      	<form action="" method="POST" enctype="multipart/form-data">


                      

<div class="form-group position-relative has-icon-left mb-5">
	<?php $navire=afficher_navire($bdd); ?>
<select style="width: 100%; text-align: center;" id="navire" data-role="afficher_autres_inputs">
	<option> CHOISIR UN NAVIRE</option>
	<?php while($nav=$navire->fetch()){ ?>
		<option value="<?php echo $nav['id'] ?>"> <?php echo $nav['navire'] ?></option>
	<?php } ?>
</select>
<br>
<div id="autres_inputs" style="display: none;">
<br>
	<select id="dec_entrant">
		<option>choisir declaration entrant</option>
	</select>
</div>
<br>
<input style="float: left; width: 45%;" type="date" name="" placeholder="date" id="dates">
<input style="float: right; width: 45%;" type="text" name="" placeholder="numero declaration" id="numero_dec">
<br><br>
<input style="float: left; width: 45%;" type="text" name="" placeholder="poids à declarer" id="poids_dec">


                  
                          

  
                                  		
   <center>
<a id="inserer" class="btn" style="width: 100%; " data-role="inserer_declaration_sortie" >ajouter</a>
   </center> 
   
   </div>
      
</form>
  
     
    </div>
  </div>
  </div>
	</div>
	</div>
	<div id="verifier"></div>

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


<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('change','select[data-role=afficher_autres_inputs]',function(){
   $('#autres_inputs').css('display', 'block');

    var navire = $('#navire').val();
      //var type_dec = $('#type_dec').val();
     

        $.ajax({
        url:'afficher_autres_inputs.php',
        method:'post',
        data:{navire:navire},
        success: function(response){
            $('#autres_inputs').html(response);

       
        }
    });



  });
});
</script>


<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('click','a[data-role=inserer_declaration_sortie]',function(){
   

    var navire = $('#navire').val();
    var dates = $('#dates').val();
    var num_dec = $('#numero_dec').val();
    var poids_dec = $('#poids_dec').val();
    var dec_entrant = $('#dec_entrant').val();
      //var type_dec = $('#type_dec').val();
     

        $.ajax({
        url:'inserer_declaration_sortie.php',
        method:'post',
        data:{navire:navire,dates:dates,num_dec:num_dec,poids_dec:poids_dec,dec_entrant:dec_entrant},
        success: function(response){
            $('#verifier').html(response);

       
        }
    });



  });
});
</script>


 </body>
</html>
