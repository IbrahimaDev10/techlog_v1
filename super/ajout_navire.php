<?php
// PAGE connexion.php
require('control_dc.php');
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

if(isset($_POST['valider_navire'])){
	if(!empty($_POST['navire']) and !empty($_POST['type_navire'])  ){
		$date=date('y-m-d');
		$navire=htmlspecialchars($_POST['navire']);
		$type=htmlspecialchars($_POST['type_navire']);
		$load=htmlspecialchars($_POST['load_port']);
		$dest=htmlspecialchars($_POST['destination']);
		
		$eta=htmlspecialchars($_POST['eta']);
		$etb=htmlspecialchars($_POST['etb']);
		$etd=htmlspecialchars($_POST['etd']);
		$proprietaire=htmlspecialchars($_POST['proprietaire']);

	//	print_r($_POST['client']);
		if(!empty($_POST['affreteur'])){
		$chatered=$_POST['affreteur'];
        $a=implode("/ ",$chatered);
	}
	else{
		$a='';
	}
	if(!empty($_POST['client'])){
		$cli=$_POST['client'];
		
		$b=implode("/ ",$cli);
	}
	else{
		$b='';
	}

		$num_manifeste=$_POST['num_manifeste'];
	
	
//$a=implode("/ ",$cli);
//$b=implode("/ ",$chatered);
//$b="a";

//echo $a;





	



$insertNavire = $bdd->prepare("INSERT INTO navire_deb(navire,type,load_port,destination,eta,etb,etd,chatered,client_navire,num_manifeste,proprietaire) VALUES(?,?,?,?,?,?,?,?,?,?,?)");
$insertNavire->bindParam(1,$navire);
$insertNavire->bindParam(2,$type);
$insertNavire->bindParam(3,$load);
$insertNavire->bindParam(4,$dest);

$insertNavire->bindParam(5,$eta);
$insertNavire->bindParam(6,$etb);
$insertNavire->bindParam(7,$etd);
$insertNavire->bindParam(8,$b);
$insertNavire->bindParam(9,$a);
$insertNavire->bindParam(10,$num_manifeste);
$insertNavire->bindParam(11,$proprietaire);
$insertNavire->execute();

echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
                echo '<script type="text/javascript">';

echo 'setTimeout(function () { swal("REUSSI","Navire ajouté avec success");';
                echo '}, 100);</script>';

            
 echo '<script>window.location.href = "ajout_manifest.php"</script>';

}



     
   
//header('location:debarquement.php');




else{
			 echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
                echo '<script type="text/javascript">';
                
               
echo 'setTimeout(function () { swal("ECHEC"," Verifier les informations   ","erreur");';
                echo '}, 100);</script>';

                 
}
}


$MesClients2 = $bdd->query("select * from client order by id desc");

$MesClients = $bdd->query("select * from client order by id desc");

$nav = $bdd->query("select  n.*, p.* from navire_deb as n
inner join produit_manifest as p on n.id=p.id_navire order by id desc limit 5");

$affreteur = $bdd->query("select * from affreteur");



?>



<!doctype html>
<html lang="fr">
  <head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>ajouter chauffeur</title>

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
#coltd{
	background: white;
}

 .fabtn1{
  border: none;
   margin-right: 3px;
  color:rgb(0,141,202);

 }
 #colcel{
 	background: white;
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
<?php include('../gestion_relache/sidebar.php'); ?>


	<div class="sidebar-overlay"></div>


	<!--Content Start-->
	<div class="content-start transition" style="background:white;  margin: 0px; border: none; border-radius: 0px;">
		<div class="container-fluid dashboard">
			<div class="content-header">

			
		

				
			<div class="container-fluid" >
				<div class="row">
					<center>
			<h6 class="ajout_dis" style="color: white;">INSERTION DES NAVIRES</h6>
			</center>
			
<div class="col col-lg-6" >			
	<div class="" id="" tabindex="-1" >
  <div class="modal-dialog">
     <div class="modal-content" style=" border: solid; border-color:rgb(0,141,202); ">
            <div class="modal-header" style="">
              <center>
              	<h3 class="modal-title fs-10 text-white text-center" id="exampleModalLabel " style="text-align:center;   ">AJOUT NAVIRE</h3></center>
              	<center>
              <img class="logoo" src="../images/mylogo.ico" >
       </center>
      	
      </div>
       <br>	<br>
      <div class="modal-body">
      	<form action="" method="POST">


                      

<div class="form-group position-relative has-icon-left mb-5">

      
  
   <input type="text" class="form-control"  id="exampleFormControlInput1" placeholder="navire" name="navire"><br>
      <select name="proprietaire" class="mb-3 " style="width:50%">
                            <option value="" disabled="TRUE" selected>QUANTITE MANUTENTION</option>
                          
                            <option value="PARTIELLE">PARTIELLE</option>
                            <option value="GLOBALE"> GLOBALE</option>
                           </select><br>

                         <select name="type_navire" class="mb-3 " style="width:50%">
                            <option value="">type de chargement</option>
                          
                            <option value="SACHERIE"> EN SACS</option>
                            <option value="VRAQUIER"> EN VRAC</option>
                             </select><br>
                            
        

  
  <input type="text" class="form-control"  id="exampleFormControlInput1" placeholder="LOAD PORT" name="load_port"><br>
  
  <input type="text" class="form-control"  id="exampleFormControlInput1" placeholder="DESTINATION" name="destination"><br>

  <label for="exampleFormControlInput1" class="form-label">NUMERO MANIFESTE</label>
  
  <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="000" name="num_manifeste"><br>


	<label for="exampleFormControlInput1" class="form-label">ETA</label>
  
  <input type="date" class="form-control" id="exampleFormControlInput1" placeholder="ETA" name="eta"><br>
  
	<label for="exampleFormControlInput1" class="form-label">ETB</label>
  <input type="date" class="form-control"  id="exampleFormControlInput1" placeholder="ETB" name="etb"><br>

<label for="exampleFormControlInput1" class="form-label">ETD</label>  
  <input type="date" class="form-control"  id="exampleFormControlInput1" placeholder="ETD" name="etd"><br>

<fieldset style=" "><legend>FOURNISSEUR</legend>
	
<?php while ($aff=$affreteur->fetch()) {
	// code...
 ?>

  <?php echo  $aff['affreteur']; ?><input type="Checkbox"  style="height: 15px; margin-right: 10px; font-size: 20px;  background-color: none; color:black;" id=""  name="affreteur[]"  value="<?php echo $aff['affreteur'];	 ?>"><span>	 </span>
<?php } ?>
  </fieldset> <br>

  

<fieldset style=" "><legend>RECEPTIONNAIRE</legend>
	
<?php while ($clients=$MesClients->fetch()) {
	// code...
 ?>

  <?php 	echo  $clients['client']; ?><input type="Checkbox"  style="height: 15px; margin-right: 10px; font-size: 30px;  background-color: none;" id="" placeholder="client" name="client[]"  value="<?php echo $clients['client'];	 ?>"><span>	 </span>
<?php } ?>
  </fieldset> <br>	                             
 
 	
      
 <div class="form-group position-relative has-icon-left mb-4" id="lesinputs">
               
              	
              </div> 

        
</div>

   
                       
                                         <center>
      <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="valider_navire">valider</button>
  </center>  
      					</form>
                    
		
      <div class="modal-footer">
 
        
      </div>
    </div>
  </div>
  </div>
	</div>
	</div>

	<div class="col col-lg-6">
		<br>
		
		 <div  class="table-responsive" border=1 >
          <center>
 <table  class='table table-hover table-bordered table-striped'  border='2'  >
 	<thead>
 		<td colspan="5" style="background: blue; color:white; text-align:center;">DONNEES DEJA INSEREES</td>
 	<tr style="color: blue;">
 	<th style="border-color:white;" scope="col" ></th>
                       <tr style="color:white; font-weight: bold; background: rgb(0,141,202); font-family: montserrat; border-color: white; text-align: center;" border='5' >
                     	
                     	 <th style="border-color:white;" scope="col" >Navire</th>
                        <th style="border-color:white;" scope="col" >TYPE</th>
                           <th style="border-color:white;" scope="col" >ETA</th>
                             <th style="border-color:white;" scope="col" >ETB</th>
                             
                               <th style="border-color:white;" scope="col" > ACTIONS  </th>
                                 </tr>
                                  </thead>
                                   <tbody style="font-weight: bold;">
                                   	<?php 
                                    while($row = $nav->fetch()){
                          	
                                     ?>
                          <tr style="text-align:center;" border='5'>
                          
                                 <td id="colcel" ><?php echo $row['navire']; ?></td>
                                    <td id="colcel" ><?php echo $row['type']; ?></td>
                                    <td id="colcel" ><?php echo $row['eta']; ?></td>
                                     <td id="colcel" ><?php echo $row['etb']; ?></td>
                               <td id="colcel" >
                          	<button  id="<?php echo $row['id'] ?>" name="deleteNavire" type="submit"  class="fabtn1 " onclick="deleteNavire(<?php echo $row['id'] ?>)" > <i class="fa fa-trash  " ></i> </button>
                          	<a class="fabtn" type="" name="modify"  href="modifier_transporteur.php?id=<?php echo $row['id']; ?>"       id="btnbtn" > <i class="fa fa-edit " ></i></a></td>          
                              </tr>
                          <?php } ?>
                                 	
                    </tbody>
 	
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
            function goInput(){
                var xhr = getXhr();
                // On définit ce qu'on va faire quand on aura la réponse
                xhr.onreadystatechange = function(){
                    // On ne fait quelque chose que si on a tout reçu et que le serveur est OK
                    if(xhr.readyState == 4 && xhr.status == 200){
                        leselects = xhr.responseText;
                        // On se sert de innerHTML pour rajouter les options à la liste
                        document.getElementById('lesinputs').innerHTML = leselects;

                    }
                }
 
                // Ici on va voir comment faire du post
                xhr.open("POST","NombreInput.php",true);
                // ne pas oublier ça pour le post
                xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
                // ne pas oublier de poster les arguments
                // ici, l'id de l'auteur
                sel = document.getElementById('nombre');
                idnombre = sel.options[sel.selectedIndex].value;
                xhr.send("idNombre="+idnombre);
            }
        </script>

 </body>
</html>
