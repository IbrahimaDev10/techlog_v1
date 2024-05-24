<?php
require('control_dc.php');
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

if(isset($_POST['valider_camion'])){
	if(!empty($_POST['camion']) ){

		$camion= $_POST['camion'];
		$transporteur= $_POST['transporteur'];

		$select=$bdd->prepare("select num_camions from camions where num_camions=?");

$select->bindParam(1,$_POST['camion']);
$select->execute();
$cherche=$select->fetch();

		
if(!$cherche){



 
$insertChauf = $bdd->prepare("INSERT INTO camions(num_camions,id_trans) VALUES(?,?)");

$insertChauf->bindParam(1,$camion);
$insertChauf->bindParam(2,$transporteur);



$insertChauf->execute();

  echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
                echo '<script type="text/javascript">';

echo 'setTimeout(function () { swal("REUSSI","Insertion reussi avec success");';
                echo '}, 100);</script>';


}
else{
	 echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
                echo '<script type="text/javascript">';
                
               
echo 'setTimeout(function () { swal("ECHEC"," Ce numero de camions existe deja  ","erreur");';
                echo '}, 100);</script>';
             
}
}


else{
	 echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
                echo '<script type="text/javascript">';
                
               
echo 'setTimeout(function () { swal("ECHEC"," Verifier les informations   ","erreur");';
                echo '}, 100);</script>';
             
}

}


$rowcamion=$bdd->query("select  c.*,tr.* from camions as c inner join transporteur as tr on c.id_trans=tr.id order by c.id_camions desc 
	  ");

$transp=$bdd->query("select * from transporteur order by id desc");

?>



<!doctype html>
<html lang="fr">
  <head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>ajouter chauffeur</title>

	<!-- Bootstrap CSS-->
	<?php include('link_deb.php'); ?>
	
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
	vertical-align: middle;
	text-align: center;
}

 .fabtn1{
  border: none;
   margin-right: 3px;
  color:rgb(0,141,202);

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
		<?php include('page.php'); ?>
				</li>

		    		

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
			<h3 class="ajout_dis" style="color: white;">INSERTION DES camions</h3>
			</center>
			
<div class="col col-lg-6" >			
	<div class="" id="" tabindex="-1" >
  <div class="modal-dialog">
     <div class="modal-content" style=" border: solid; border-color:rgb(0,141,202); ">
            <div class="modal-header" style="">
              <center>
              	<h3 class="modal-title fs-10 text-white text-center" id="exampleModalLabel " style="text-align:center;   ">AJOUT CAMION</h3></center>
              	<center>
              <img class="logoo" src="../images/mylogo.ico" >
       </center>
      	
      </div>
       <br>	<br>
      <div class="modal-body">
      	<form action="" method="POST">


                      

<div class="form-group position-relative has-icon-left mb-5">

      
  
  <input type="text" class="form-control"  id="exampleFormControlInput1" placeholder="CAMION" name="camion"><br>

<select name="transporteur">
	<option selected="">TRANSPORTEUR</option>
	<?php while($tr=$transp->fetch()){ ?>
		<option value=<?php echo $tr['id']; ?> ><?php echo $tr['nom']; ?></option>
	<?php } ?>	
	
</select>



         <center>
        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="valider_camion">valider</button>
					</form>
                    
				</div>
      

  
     
    </div>
  </div>
  </div>
	</div>
	</div>

	<div class="col col-lg-6">
		<br>
		<center>
		<h3 style="color: white; background: blue;">DONNEES DEJA INSEREES </h3>
		</center>
		 <div  class="table-responsive" border=1 >
          <center>
 <table  class='table table-hover table-bordered table-striped'  border='2'  >
 	<thead>
 	<tr style="color: blue; text-align: center;">
 	<th style="border-color:white;" scope="col" ></th>
                       <tr style="color:white; font-weight: bold; background: rgb(0,141,202);border-color: white; text-align: center;" border='5' >
                     	  <th style="border-color:white; vertical-align: middle;" scope="col" > </th>
                     	 <th style="border-color:white; vertical-align: middle;" scope="col" >N° CAMIONS</th>
                       
                           <th style="border-color:white; vertical-align: middle;" scope="col" >TRANSPORTEUR</th>
                           
                            
                                 </tr>
                                  </thead>
                                   <tbody style="font-weight: bold;">

                                   <?php while($row=$rowcamion->fetch()){ ?>

      <?php 	     $calculLigne=$bdd->prepare("select count(num_camions) from camions where id_camions<=? order by id_camions desc");
      $calculLigne->bindParam(1,$row['id_camions']);
      $calculLigne->execute();
      $cal=$calculLigne->fetch(); ?>                        
                          
                          	     <td id="coltd" ><?php echo $cal['count(num_camions)']; ?>
                                 <td id="coltd" ><?php echo $row['num_camions']; ?></td>
                                <td id="coltd" ><?php echo $row['nom'];?></td>
                             
                            
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
	<script src="../assets/modules/fontawesome6.1.1/js/all.js"></script>


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



 </body>
</html>
