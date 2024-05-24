
<?php

include('control_dc.php');



?>	



<!doctype html>
<html lang="fr">
  <head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>Debarquement</title>

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
	<div class="sidebar transition overlay-scrollbars animate__animated  animate__slideInLeft">
        <div class="sidebar-content"> 
        	<div id="sidebar">
			
			<!-- Logo -->
			<div class="logo">
					<h2 class="mb-4"><img style="width: 150px; height: 150px;" src="assets/images/mylogo.ico"> </h2>
			</div>

            <ul class="side-menu">
                <li>
					<a href="index.html" class="active">
						<i class='bx bxs-dashboard icon' ></i> MENU PRINCIPAL
					</a>
				</li>

				<!-- Divider-->
                <li class="divider" data-text="STARTER">Navire</li>

                <li>
                    <a href="#">
						<i class='bx bx-columns icon' ></i> 
						Gestion des Navires 
						<i class='bx bx-chevron-right icon-right' ></i>
					</a>
                    <ul class="side-dropdown">
                        <li><a href="#user">Mes Navires</a></li>
                        <li><a href="" data-bs-toggle="modal" data-bs-target="#navires">Ajouter un navire</a></li>
                        
                    </ul>
                </li>

 
 <li class="divider" data-text="Atrana">Produits</li>

				<li>
                    <a href="#">
						<i class='bx bx-columns icon' ></i> 
						Gestion des produits
						<i class='bx bx-chevron-right icon-right' ></i>
					</a>
                    <ul class="side-dropdown">
                        <li><a href="component-avatar.html">Mes produits</a></li>
						<li><a href="" data-bs-toggle="modal" data-bs-target="#produits">Ajouter nouveau produit</a></li>
						                        
                    </ul>
                </li>                              


<li class="divider" data-text="Atrana">Clients</li>

				<li>
                    <a href="#">
						<i class='bx bx-columns icon' ></i> 
						Gestion des clients
						<i class='bx bx-chevron-right icon-right' ></i>
					</a>
                    <ul class="side-dropdown">
                        <li><a href="">Mes clients</a></li>
						<li><a href="" data-bs-toggle="modal" data-bs-target="#client">Ajouter nouveau client</a></li>
						                        
                    </ul>
                </li>
               

				<!-- Divider-->
                <li class="divider" data-text="Atrana">Cargo plan</li>

				<li>
                    <a href="#">
						<i class='bx bx-columns icon' ></i> 
						declaration de chargement
						<i class='bx bx-chevron-right icon-right' ></i>
					</a>
                    <ul class="side-dropdown">
                        <li><a href="#fetch_cargo_plan">Mes declaration de chargement</a></li>
						<li><a href="" data-bs-toggle="modal" data-bs-target="#DC">Ajouter declaration de chargement</a></li>
                        
                        
                    </ul>
                </li>

 <li class="divider" data-text="Atrana">Gestion du stockage</li>

				<li>
                    <a href="#">
						<i class='bx bx-columns icon' ></i> 
						Gestion du stockage
						<i class='bx bx-chevron-right icon-right' ></i>
					</a>
                    <ul class="side-dropdown">
                        <li><a href="component-avatar.html">Mole</a></li>
						<li><a href="#fetch_dispat">Mes dispatching</a></li>
						<li><a href="#fetch_dispatcli"> Dispatching par client</a></li>
						<li><a href="#fetch_dispatmang">Dispatching par mangasin</a></li>
						<li><a href="" data-bs-toggle="modal" data-bs-target="#daap">Ajouter dispatching</a></li>
                        
  
                    </ul>
                </li>


 <li class="divider" data-text="Atrana">Statistique</li>

				<li>
                    <a href="#">
						<i class='bx bx-columns icon' ></i> 
						Statistique du Navire
						<i class='bx bx-chevron-right icon-right' ></i>
					</a>
                    <ul class="side-dropdown">
                        <li><a href="fetch_sta_cale">Par cale</a></li>
						<li><a href="fetch_sta_var">Par variété</a></li>
						
                        
  
                    </ul>
                </li>               





                <li>
                    <a href="#">
						<i class='bx bxs-notepad icon' ></i> 
						Forms 
						<i class='bx bx-chevron-right icon-right' ></i>
					</a>
                    <ul class="side-dropdown">
                        <li><a href="forms-editor.html">Editor</a></li>
                        <li><a href="forms-validation.html">Validation</a></li>
                        <li><a href="forms-checkbox.html">Checkbox</a></li>
                        <li><a href="forms-radio.html">Radio</a></li>
                    </ul>
                </li>

				<li>
                    <a href="#">
						<i class='bx bxs-widget icon' ></i> 
						Widgets 
						<i class='bx bx-chevron-right icon-right' ></i>
					</a>
                    <ul class="side-dropdown">
                        <li><a href="widgets-chatboxs.html">ChatBox</a></li>
                        <li><a href="widgets-email.html">Emails</a></li>
                        <li><a href="widgets-pricing.html">Pricing</a></li>
                    </ul>
                </li>

				<li>
                    <a href="#">
						<i class='bx bxs-bar-chart-alt-2 icon' ></i> 
						Charts 
						<i class='bx bx-chevron-right icon-right' ></i>
					</a>
                    <ul class="side-dropdown">
                        <li><a href="chart-chartjs.html">ChartJS</a></li>
                        <li><a href="chart-apexcharts.html">Apexcharts</a></li>
                    </ul>
                </li>

				<li>
                    <a href="#">
						<i class='bx bxs-cloud-rain icon' ></i> 
						Icons 
						<i class='bx bx-chevron-right icon-right' ></i>
					</a>
                    <ul class="side-dropdown">
                        <li><a href="icons-fontawesome.html">Fontawesome</a></li>
                        <li><a href="icons-boostrap.html">Bootstrap Icons</a></li>
                    </ul>
                </li>

				<!-- Divider-->
				<li class="divider" data-text="Pages">Pages</li>

				<li>
                    <a href="#">
						<i class='bx bxs-user icon' ></i> 
						Auth 
						<i class='bx bx-chevron-right icon-right' ></i>
					</a>
                    <ul class="side-dropdown">
                        <li><a href="auth-login.html">Login</a></li>
                        <li><a href="auth-register.html">Register</a></li>
                        <li><a href="auth-forgot-password.html">Forgot Password</a></li>
                        <li><a href="auth-reset-password.html">Reset Password</a></li>
                    </ul>
                </li>

				<li>
                    <a href="#">
						<i class='bx bxs-error icon' ></i> 
						Errors 
						<i class='bx bx-chevron-right icon-right' ></i>
					</a>
                    <ul class="side-dropdown">
                        <li><a href="errors-403.html">403</a></li>
                        <li><a href="errors-404.html">404</a></li>
                        <li><a href="errors-500.html">500</a></li>
                        <li><a href="errors-503.html">503</a></li>
                    </ul>
                </li>


				<li>
					<a href="credits.html"><i class='fa fa-pencil-ruler icon' ></i> 
						Credits
					</a>
				</li>

            </ul>

            <div class="ads">
				<div class="wrapper">
					<div class="help-icon"><i class="fa fa-circle-question fa-3x"></i></div>
					<p>Need Help with <strong>Atrana</strong>?</p>
                    <a href="docs/" class="btn-upgrade">Documentation</a>
                 </div>
            </div>
        </div>

       </div> 
	 </div>
	</div><!-- End Sidebar-->


	<div class="sidebar-overlay"></div>


	<!--Content Start-->
	<div class="content-start transition">
		<div class="container-fluid dashboard">
			<div class="content-header">

			
		

				
			<div class="container-fluid" >
				<div class="row">
					<div class="col-lg-12">
						<center>
						<h1>Gestion de stockages</h1>
						<h3>Cliquer les boutons ci dessous pour commencer l'insertion</h3>
						<br>
						</center>
					</div>
					<CENTER>
				<div class="col-lg-12">

                     <a class="lienforme" href="" data-bs-toggle="modal" data-bs-target="#dispate" style="">Dispatcher</a>
                     </div>  
                     <br><br>
                   
                
			</div>
			
			
				
	<div class="modal fade" id="dispate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
      	<center>
        <h1 class="modal-title fs-5 text-white text-center" id="exampleModalLabel " style="text-align:center; ">Cale 1</h1></center>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      	<div id="auth-right">
					<div class="auth-logo">
						<a href=""><img src="assets/images/mylogo.ico" alt="Logo">DC C1</a>  
					</div>
					</div>
      	<form action="" method="POST">
<div class="form-group position-relative has-icon-left mb-4">
                        	
                          <label for="exampleFormControlInput1" class="form-label">Inserer elements</label>
                      
                    
                           <select id="p1" name="p1" class="mb-3 " onchange="pdispat()">
                            <option  selected>SELECTIONNER LE NBR DE CONNAISSEMENT</option>
                    

                        

                            <option value="1"> 1</option>
                            <option value="2"> 2</option>
                            <option value="3"> 3</option>
                            <option value="4"> 4</option>
                            <option value="5"> 5</option>
                             <option value="6"> 6</option>
                            <option value="7"> 7</option>
                            <option value="8"> 8</option>
                            <option value="9"> 9</option>
                            <option value="10"> 10</option>
                             <option value="11"> 11</option>
                            <option value="12"> 12</option>
                            <option value="13"> 13</option>
                            <option value="14"> 14</option>
                            <option value="15"> 15</option>
                            
                                
                            </select>

                            
                        
                        <div class="" id="dis1">

                            </div> 


   

                                            
                          
					</form>
                    
				</div>
      

  
      <div class="modal-footer">
 
        
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
	<script src="assets/js/atrana.js"></script>

	<!-- JS Libraies -->
	<script src="assets/modules/jquery/jquery.min.js"></script>
	<script src="assets/modules/bootstrap-5.1.3/js/bootstrap.bundle.min.js"></script>
	<script src="assets/modules/popper/popper.min.js"></script>

	<!-- Chart Js -->
	<script src="assets/modules/apexcharts/apexcharts.js"></script>
	<script src="assets/js/ui-apexcharts.js"></script>

    <!-- Template JS File -->
	<script src="assets/js/script.js"></script>
	<script src="assets/js/custom.js"></script>


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
                xhr.open("POST","form_dispat_vrac2.php",true);
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