<?php
require('control_dc.php');
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

include('bouton_valider_form_ajout.php');

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
	


	<!--Content Start-->
	<div class="content-start transition" style="background:white; background-repeat:no-repeat; background-size: 100%;  margin: 0px; border: none; border-radius: 0px;">
		<div class="container-fluid dashboard">
			<div class="content-header">

			
		

				
			<div class="container-fluid" >
				<div class="row">
					<center>
			<h6 class="ajout_dis" style="color: white;">INSERTION DES CALES</h6>
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

	
                 <select id="produit" name="produit" class=" " style="width:45%; margin-right:20px; margin-bottom:10px;" onchange="getpoids()">

                        <option value="">choisir produit </option>
                       <?php  
                            $p=$bdd->query("select * from produit_deb");

                            while ($a1=$p->fetch()) { ?>
                                                            
                           <option value=<?php   echo   $a1["id"] ?> > <?php   echo  $a1["produit"]  ?> <?php echo  $a1["qualite"] ?> </option>
                               <?php } ?> 
                               </select>

	                        <select id="cale" name="cale" class=" " style="width:45%; margin-right:20px; margin-bottom:10px;">
                            <option value="">choisir cale</option>
                            <option value="C1">cale 1</option>
                            <option value="C2">cale 2</option>
                            <option value="C3">cale 3</option>
                            <option value="C4">cale 4</option>
                            <option value="C5">cale 5</option>
                                
                            </select>

                                                          <select id="poids_sac" name="poids_sac" class=" " style="width:45%; margin-right:20px; margin-bottom:10px;">
                            <option value="">choisir poids sac en KG</option>
                            <option value="5">20KG</option>
                            <option value="25">25KG</option>
                            <option value="40">40KG</option>
                            <option value="45">45KG</option>
                            <option value="50">50KG</option>
                                
                            </select>

        <input type="text" id="nombre_sac" class="" placeholder="nombre_sac" name="nombre_sac" style="width:45%; margin-right:20px ">

 
                            

                      

                       <input id="nom_chargeur" type="text" class="" placeholder="nom_chargeur" name="nom_chargeur" style="width:45%; margin-right:20px "> </div> 

                       <input id="id_navire" type="text" class="" placeholder="nom_chargeur" name="nom_chargeur" style="width:45%; margin-right:20px; display:none; " value=<?php echo $_GET['m']; ?>>                                                  
                            
                            
    

   <center>
<a class="btn" style="width: 100%;" name="ajout_dc" data-role='ajout_dc'>ajouter</a>
   </center>                                         
                          
					</form>
                    
				</div>
      

  

    </div>
  </div>
  </div>
	</div>

	<div class="col col-lg-6">
		<br>
	
		 <div  class="table-responsive" border=1 id='donnees_cale'>
          <center>
 <table  class='table table-hover table-bordered table-striped'  border='2'  >
 	<thead>
 		<td colspan="6" style="background: rgb(0,141,202); color: white; text-align:center;">DONNEES DEJA INSEREES</td>
 	<tr style="background: rgb(0,141,202); color: white; text-align:center;">
 	<th>cale</th>
 	<th>produit</th>
 	<th>sac</th>
 	
 	<th>tonnage</th>
 	<th>nom_chargeur</th>
 </tr>
 	
 	</thead>

 <?php while($aff=$afficher->fetch()){?>
 	<tr style="background: white; color: black; text-align: center; vertical-align: middle;">
<td ><?php echo $aff['cales'] ?></td>
<td ><?php echo $aff['produit'] ?> <?php echo $aff['qualite'] ?> <?php echo $aff['conditionnement'].' KG' ?> </td>
<td ><?php echo $aff['nombre_sac'] ?></td>

<td ><?php echo $aff['poids'] ?></td>
<td ><?php echo $aff['nom_chargeur'] ?></td>

 </tr>
 <?php } ?> 

	

 	</tr>
</table>
</div>

	</div>
<?php include('formulaire_ajout.php') ?>

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
 $(document).on('click','a[data-role=ajout_dc]',function(){
      
       var nombre_sac = $('#nombre_sac').val();
       var cale = $('#cale').val();
       var produit = $('#produit').val();
       var nom_chargeur = $('#nom_chargeur').val();
       var poids_sac = $('#poids_sac').val();
       var id_navire = $('#id_navire').val();
        
     if(nombre_sac!='' && cale!='' && poids_sac!='' && produit!=''){ 

        
        $.ajax({
		url:'ajax_ajout_dc/ajout_cale.php',
		method:'post',
		data:{nombre_sac:nombre_sac,cale:cale,produit:produit,nom_chargeur:nom_chargeur,id_navire:id_navire,poids_sac:poids_sac},
		success: function(response){
			$('#donnees_cale').html(response);
			
		
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
    });
	

</script>


 </body>
</html>
