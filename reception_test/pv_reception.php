<?php
require('../database.php');

require("controller/acces_reception.php");

?>	



<!doctype html>
<html lang="fr">
  <head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>PV RE RECEPTION</title>

	<!-- Bootstrap CSS-->
	 <link rel="stylesheet" href="../assets/modules/bootstrap-5.1.3/css/bootstrap.css">
  <!-- Style CSS -->
  <link rel="stylesheet" href="../transfert/css/style.css">
  <link rel="stylesheet" href="assets/css/stylecell.css">
  <!-- FontAwesome CSS-->
  <link rel="stylesheet" href="../assets/modules/fontawesome6.1.1/css/all.css">
  <!-- Boxicons CSS-->
  <link rel="stylesheet" href="assets/modules/boxicons/css/boxicons.min.css">
  <!-- Apexcharts  CSS -->
  <link rel="stylesheet" href="../assets/modules/apexcharts/apexcharts.css">
    <link rel="shortcut icon" type="image/png" href="../assets/images/mylogo.ico"/>
</head>
<body >
<style type="text/css">
	
.lienforme{
color:white; font-size: 20px; border: solid; background-color: black; margin-bottom: 50px;

}

 *{
  font-family: Times New Roman;
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
	<div class="sidebar transition overlay-scrollbars animate__animated  animate__slideInLeft">
        <div class="sidebar-content"> 
            <div id="sidebar">
			
			<!-- Logo -->
			<div class="logo">
					<h2 class="mb-4"><img style="width: 150px; height: 150px;" src="../assets/images/mylogo.ico"> </h2>
			</div>

            <ul class="side-menu">
                <li>
					<a href="index.html" class="active">
						<i class='bx bxs-dashboard icon' ></i> MENU PRINCIPAL
					</a>
				</li>

				<!-- Divider-->
              
  <li class="divider" style="font-size: 18px;" data-text="STARTER"> DEBARQUEMENT</li>

                <li>
                    <a href="#">
                        <i class='bx bx-columns icon' ></i> 
                        Enregistrement des bons de Transfert / Livraison
                        <i class='bx bx-chevron-right icon-right' ></i>
                    </a>
                    <ul class="side-dropdown">
                        <li><a href="tr_manifest.php">Mes Enregistrements</a></li>
                        
                                                
                    </ul>
                </li>

          


               

                        <li>
                    <a href="#">
                        <i class='bx bx-columns icon' ></i> 
                        AVARIES
                        <i class='bx bx-chevron-right icon-right' ></i>
                    </a>
                    <ul class="side-dropdown">
                        <li><a  data-bs-toggle="modal" data-bs-target="#Les_avaries">Ajouter Avaries</a></li>
                        
                                                
                    </ul>
                </li>        

 
 


				<li>
                    <a href="#">
						<i class='bx bx-columns icon' ></i> 
						SITUATIONS
						<i class='bx bx-chevron-right icon-right' ></i>
					</a>
                    <ul class="side-dropdown">
                        <li><a href="#situation">Mes SITUATIONS</a></li>
						
						                        
                    </ul>
                </li>
               </ul>

				<!-- Divider-->
       </div> 
	 </div>
	</div><!-- End Sidebar-->
  <div class="sidebar-overlay"></div>


  <div class="modal fade" id="form_intervenant" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    <?php $intervenant=$bdd->query("select * from intervenant"); ?>
    <label>INTERVENANT</label><br>  
   <select id="intervenant">
    <?php while ($inter=$intervenant->fetch()) { ?>
        <option value="<?php echo $inter['id_intervenant'] ?>"> <?php echo $inter['nom_intervenant'] ?> </option>
    <?php } ?>
       
  
   </select><br>
  
    <label>dis_bl</label>
    <input style="height: 25px;" type="text" class="form-control"   id=id_dis ><br>
    


    
</div>


</center>



         
        
</form> 
       <center>  
      <div class="modal-footer">
          
         <a  id="valider_intervenant" style="width: 50%;" class="btn btn-primary " name="valider_reception">valider</a> 
         
      </div>
  </center>
      </div>
    </div>
  </div>
</div>


    <?php 
//111111111111111111111111111DEBUTPARTIE11111111111111111111111111111 
    //       PARTIE SITUATION DEBARQUEMENT
     ?>
     
         <div class="container-fluid1 " id="situation"  style=" background: rgb(0,141,202);" >
        <div class="row">
            
            
                <div class="col-lg-12 col-md-12">
                    <h1 class="hem2 text-white" style=" background: rgb(0,44,62); font-size: 30px;">PV DE RECEPTION</h1><br>

                    
                    <form method="POST" >
                        <select  id="navires" class="mysel" style="margin-right: 15%; height: 30px;   width: 40%;"  onchange='goNavireSit()'>
                            <option value="">selectionner un navire</option>
                            <?php 
                              if($_SESSION['profil']=="Mangasinier"){
                                 $naviress=choix_du_navire($bdd,$a);
                               }
                               else{
                                $naviress=choix_du_navire2($bdd);
                              }
                            while ($row=$naviress->fetch()) {
                             ?>
                                <option value=<?php echo $row['id_navire'].'-'.$_GET['id']; ?> >  <?php echo $row['navire'] ?> </option>
                            <?php } ?>

                 </select>
                        
                     <select id="date" class="mysel" name="date" style="margin-right: 2%; height: 30px;  width: 40%;" onchange='goDateSit()'>
                            <option  selected>selectionner le produit</option>
                        </select>
                        
                 
                            
                    </form>
                
            </div>
        </div>
    </div>
    <br><br>
    <div class="sit" id="sit">
    </div>
    </div>



        
			
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
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
            function goNavireSit(){
                var xhr = getXhr();
                // On définit ce qu'on va faire quand on aura la réponse
                xhr.onreadystatechange = function(){
                    // On ne fait quelque chose que si on a tout reçu et que le serveur est OK
                    if(xhr.readyState == 4 && xhr.status == 200){
                        ladate = xhr.responseText;
                        // On se sert de innerHTML pour rajouter les options à la liste
                        document.getElementById('date').innerHTML = ladate;

                    }
                }
 
                // Ici on va voir comment faire du post
                xhr.open("POST","selectNavire.php",true);
                // ne pas oublier ça pour le post
                xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
                // ne pas oublier de poster les arguments
                // ici, l'id de l'auteur
                sel = document.getElementById('navires');
                idnavires = sel.options[sel.selectedIndex].value;
                xhr.send("idNavires="+idnavires);
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
            function goDateSit(){
                var xhr = getXhr();
                // On définit ce qu'on va faire quand on aura la réponse
                xhr.onreadystatechange = function(){
                    // On ne fait quelque chose que si on a tout reçu et que le serveur est OK
                    if(xhr.readyState == 4 && xhr.status == 200){
                        lecales = xhr.responseText;
                        // On se sert de innerHTML pour rajouter les options à la liste
                        document.getElementById('sit').innerHTML = lecales;

                    }
                }
 
                // Ici on va voir comment faire du post
                xhr.open("POST","selectProduit.php",true);
                // ne pas oublier ça pour le post
                xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
                // ne pas oublier de poster les arguments
                // ici, l'id de l'auteur
                sel = document.getElementById('date');
                iddate = sel.options[sel.selectedIndex].value;
                xhr.send("idDate="+iddate);
            }
        </script> 


<script type="text/javascript">


  $(document).ready(function(){
    $(document).on('click','button[data-role=ajout_intervenant]',function(){
        var id = $(this).data('id');
        
   $("#id_dis").val(id);
       
        

        
        $('#form_intervenant').modal('toggle');
    });
    
    $('#valider_intervenant').click(function(){
         
        var id_dis = $('#id_dis').val();
        var intervenant = $('#intervenant').val();
        
        
        $.ajax({
    url:'insertion_intervenant_produit.php',
    method:'post',
    data:{intervenant:intervenant,id_dis:id_dis},
    success: function(response){
      $('#afficher_intervenant').html(response);
      /*$('#'+id).children('td[data-target=cales]').text(cale);
    $('#'+id).children('td[data-target=nom_chargeur]').text(ch);
    $('#'+id).children('td[data-target=conditionnement]').text(cond+' KGS');
    //$('#modif_dec').modal('toggle');*/
    $('#form_intervenant').modal('toggle');
    }
  });
    });
});

</script>

<script type="text/javascript">
    function imprimer(dname){
      var printContents=document.getElementById(dname).innerHTML;
      var originalContents=document.body.innerHTML;
      document.body.innerHTML=printContents;
      window.print();
      document.body.innerHTML=originalContents;


    }
  </script>
    
 </body>
</html>
