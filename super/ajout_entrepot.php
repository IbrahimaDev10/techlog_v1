<?php
require('control_dc.php');

if(isset($_POST['valider_entrepot'])){
	if(!empty($_POST['nom']) ){
		
		$nom=htmlspecialchars($_POST['nom']);
		$code=htmlspecialchars($_POST['code']);
		$adresse=htmlspecialchars($_POST['adresse']);
		$num_agrement=htmlspecialchars($_POST['num_agrement']);
		$poids_stock=htmlspecialchars($_POST['tonne_stock']);
		$sac_stock=$poids_stock*1000/50;
		$superficie=htmlspecialchars($_POST['superficie']);
		$mang=htmlspecialchars($_POST['mangasinier']);
		
		

     $verify = $bdd->prepare("select mangasin from mangasin where mangasin=?");
$verify->bindParam(1,$nom);
$verify->execute();
$row=$verify->fetch();

if(!$row){
$insertClient = $bdd->prepare("INSERT INTO mangasin(code,mangasin,adresse,num_agrement,superficie,sac_stock,poids_stock,id_mangasinier) VALUES(?,?,?,?,?,?,?,?)");
$insertClient->bindParam(1,$code);
$insertClient->bindParam(2,$nom);
$insertClient->bindParam(3,$adresse);
$insertClient->bindParam(4,$num_agrement);
$insertClient->bindParam(5,$superficie);
$insertClient->bindParam(6,$sac_stock);
$insertClient->bindParam(7,$poids_stock);
$insertClient->bindParam(8,$mang);


$insertClient->execute();

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
else{
	echo "veuillez remplir";
}
}

$LesMangasin=$bdd->query("select * from mangasin ");

?>



<!doctype html>
<html lang="fr">
  <head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>ajouter destination</title>

	<!-- Bootstrap CSS-->
	<link rel="stylesheet" href="../assets/modules/bootstrap-5.1.3/css/bootstrap.css">
	<!-- Style CSS -->
	<link rel="stylesheet" href="../assets/css/style.css">
	<link rel="stylesheet" href="../assets/css/stylecell.css">
	<!-- FontAwesome CSS-->
	<link rel="stylesheet" href="../assets/modules/fontawesome6.1.1/css/all.css">
	<!-- Boxicons CSS-->
	<link rel="stylesheet" href="../assets/modules/boxicons/css/boxicons.min.css">
	<!-- Apexcharts  CSS -->
	<link rel="stylesheet" href="../assets/modules/apexcharts/apexcharts.css">
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

#coltd{
	background: white;
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
					<a href="" class="active">
						<i class='bx bxs-dashboard icon' ></i> MENU PRINCIPAL
					</a>
		
				</li>

		 <?php include('page.php'); ?>    		

 <?php include('ajout_nouvelle_donnees.php'); ?>

       </ul>		
 
 
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
			<h3 class="ajout_dis" style="color: white;">AJOUT ENTREPOT</h3>
			</center>
			
<div class="col col-lg-6" >			
	<div class="" id="" tabindex="-1" >
  <div class="modal-dialog">
     <div class="modal-content" style=" border: solid; border-color:rgb(0,141,202); ">
            <div class="modal-header" style="">
              <center>
              	<h3 class="modal-title fs-10 text-white text-center" id="exampleModalLabel " style="text-align:center;   ">AJOUT ENTREPOT</h3></center>
              	<center>
              <img class="logoo" src="../images/mylogo.ico" >
       </center>
      	
      </div>
       <br>	<br>
      <div class="modal-body">
      	<form action="" method="POST">


                      

<div class="form-group position-relative has-icon-left mb-5">

      
  <input type="text" class="form-control"  placeholder="NOM ENTREPOT" name="nom"><br>
  <input type="text" class="form-control"  id="exampleFormControlInput1" placeholder="CODE entrepot" name="code"><br>
  <input type="text" class="form-control"  id="exampleFormControlInput1" placeholder="ADRESSE" name="adresse"><br>
  <input type="text"  class="form-control" placeholder="NUMERO AGREMENT" name="num_agrement" ><br>
   <input type="text" class="form-control"  id="exampleFormControlInput1" placeholder="SUPERFICIE" name="superficie"><br>
   <label>CAPACITE DE STOCKAGE EN TONNE</label>
   <input type="text" class="form-control"  id="exampleFormControlInput1" placeholder="CAPACITE DE STOCKAGE EN TONNE " name="tonne_stock" value="0"><br>
   <br>
   <div style="background: blue;">
   	<center>
   		<h6 style="color: white;">MANGASINIER</h6>
   	</center>
   	<?php $nom=$bdd->query("select * from simar_user where profil='Mangasinier'"); ?>
   	<select name="mangasinier">
   		<?php while($mang=$nom->fetch()){ ?>
   			<option value="<?php echo $mang['id_sim_user']; ?>"><?php echo $mang['prenom'].' '.$mang['nom'];  ?></option>
   		<?php } ?>
   		<option value="AUTRES">AUTRES</option>
   	</select>
   	 <br>
   	
   </div>


   




         <center>
        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="valider_entrepot">valider</button>
					</form>
                    
				</div>
      

  
      <div class="modal-footer">
 
        
      </div>
    </div>
  </div>
  </div>
	</div>
	</div>

	<div class="col col-lg-6">
		<br>
		<center>
		<h3>DONNEES DEJA INSEREES </h3>
		</center>
		 <div  class="table-responsive" border=1 >
          <center>
 <table  class='table table-hover table-bordered table-striped'  border='2'  >
 	<thead>
 	<tr style="color: blue;">
 	<th style="border-color:white;" scope="col" ></th>
                       <tr style="color:white; font-weight: bold; background: rgb(0,141,202); font-family: montserrat; border-color: white; text-align: center;" border='5' >
                     	 
                     	  <th style="border-color:white;" scope="col" >NOM ENTREPOT</th>
                     	  <th style="border-color:white;" scope="col" >N° AGREMENT DOUANE</th>
                        <th style="border-color:white;" scope="col" >CODE D'ENTREPOT</th>

                        <th style="border-color:white;" scope="col" >SUPERFICIE</th>
                        <th style="border-color:white;" scope="col" >CAPACITE DE STOCKAGE (TONNE) </th>
                        
                        <th style="border-color:white;" scope="col" >ADRESSE ENTREPOT</th>
                        <th style="border-color:white;" scope="col" >MANGASINIER</th>
                        <th style="border-color:white;" scope="col" >TELEPHONE</th>
                        <th style="border-color:white;" scope="col" >EMAIL</th>

                         
                                 </tr>

 	</thead>

 <?php 
                                    while($row = $LesMangasin->fetch()){
                             	
                                     ?>
                          <tr style="text-align:center;" border='5' id="<?php echo $row['id'] ?>">
                          
                          	<td id="coltd">	<?php echo  $row['mangasin']; ?> </td>
                          	<td id="coltd">	<?php echo  $row['num_agrement']; ?> </td>
                          	
                          	<td id="coltd">	<?php echo  $row['code']; ?> </td>
                          	
                          	<td id="coltd">	<?php echo  $row['superficie']; ?> </td>
                          	<?php $poids=$row['sac_stock']*50/1000; ?>
                           <td id="coltd">	<?php echo  number_format($poids,3,',',' '); ?> </td>
                                 
                              </tr>
                      <?php } ?>	
	

 	
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
