
<?php

	//include('user.php');

?>	



<!doctype html>
<html lang="fr">
  <head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>Dashboard - Atrana</title>

	<!-- Bootstrap CSS-->
	<link rel="stylesheet" href="../assets/modules/bootstrap-5.1.3/css/bootstrap.css">
	<!-- Style CSS -->
	<link rel="stylesheet" href="../assets/css/style.css">
	<!-- FontAwesome CSS-->
	<link rel="stylesheet" href="../assets/modules/fontawesome6.1.1/css/all.css">
	<!-- Boxicons CSS-->
	<link rel="stylesheet" href="../assets/modules/boxicons/css/boxicons.min.css">
	<!-- Apexcharts  CSS -->
	<link rel="stylesheet" href="../assets/modules/apexcharts/apexcharts.css">
</head>
<body>
  
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
					<h2 class="mb-0"><img src="assets/images/logo.png"> SNTC</h2>
			</div>

            <ul class="side-menu">
                <li>
					<a href="index.html" class="active">
						<i class='bx bxs-dashboard icon' ></i> Dashboard
					</a>
				</li>

				<!-- Divider-->
                <li class="divider" data-text="STARTER">Utilisateurs</li>

                <li>
                    <a href="#">
						<i class='bx bx-columns icon' ></i> 
						Gestion des utilisateurs 
						<i class='bx bx-chevron-right icon-right' ></i>
					</a>
                    <ul class="side-dropdown">
                        <li><a href="#user">Mes utilisateurs</a></li>
                        <li><a href="auth-register.html">Ajouter un utilisateur</a></li>
                        <li><a href="auth-affecter.html">Affecter un utilisateur</a></li>
                    </ul>
                </li>

               

               

				<!-- Divider-->
                <li class="divider" data-text="Atrana">Magansins</li>

				<li>
                    <a href="#">
						<i class='bx bx-columns icon' ></i> 
						Gestion des mangasins
						<i class='bx bx-chevron-right icon-right' ></i>
					</a>
                    <ul class="side-dropdown">
                        <li><a href="component-avatar.html">Mes mangasin</a></li>
						<li><a href="component-toastify.html">Ajouter nouveau mangasin</a></li>
                        
                        
                    </ul>
                </li>

 <li class="divider" data-text="Atrana">Port (mole et cale)</li>

				<li>
                    <a href="#">
						<i class='bx bx-columns icon' ></i> 
						Gestion mole et cale
						<i class='bx bx-chevron-right icon-right' ></i>
					</a>
                    <ul class="side-dropdown">
                        <li><a href="component-avatar.html">Mole</a></li>
						<li><a href="component-toastify.html">Ajouter un mole</a></li>
						<li><a href="component-toastify.html">Ajouter un cale</a></li>
                        
                        <li><a href="component-hero.html">Hero</a></li>
                        <li><a href="component-sweet-alert.html">Sweet Alert</a></li>
                    </ul>
                </li>

<li class="divider" data-text="Atrana">Navires</li>

				<li>
                    <a href="#">
						<i class='bx bx-columns icon' ></i> 
						Gestion des navires
						<i class='bx bx-chevron-right icon-right' ></i>
					</a>
                    <ul class="side-dropdown">
                        <li><a href="component-avatar.html">Mes navires</a></li>
						<li><a href="navire.php">Ajouter nouveau navire</a></li>
						<li><a href="component-toastify.html">Ajouter un cale</a></li>
                        
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
						<li><a href="component-toastify.html">Ajouter nouveau produit</a></li>
						                        
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
				<h1>Dashboard</h1>
				<p></p>
			</div>
			
			<div class="row">

				<div class="col-md-6 col-lg-3">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-4 d-flex align-items-center">
									<i class="fas fa-inbox icon-home bg-primary text-light"></i>
								</div>
								<div class="col-8">
									<p>Utilisateurs</p>
									<h5><a href="">Debarquement</a></h5>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-6 col-lg-3">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-4 d-flex align-items-center">
									<i class="fas fa-clipboard-list icon-home bg-success text-light"></i>
								</div>
								<div class="col-8">
									<p>Navires</p>
									<h5>3000</h5>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-6 col-lg-3">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-4 d-flex align-items-center">
									<i class="fas fa-chart-bar  icon-home bg-info text-light"></i>
								</div>
								<div class="col-8">
									<p>Produit</p>
									<h5>5500</h5>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-6 col-lg-3">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-4 d-flex align-items-center">
									<i class="fas fa-id-card  icon-home bg-warning text-light"></i>
								</div>
								<div class="col-8">
									<p>mangasin</p>
									<h5>256</h5>
								</div>
							</div>
						</div>
					</div>

				</div>
		

				
				
				<div id="user" class="col-md-12">
					<div class="card">
						<div class="card-header">
							<h4>Mes utilisateurs</h4>
						</div>
						<div class="card-body"> 
						<div class="table-responsive"> 
						<table class="table table-striped">
							<thead>
							  <tr>
								<th scope="col">prenom</th>
								<th scope="col">nom</th>
								<th scope="col">telephone</th>
								<th scope="col">profil</th>

								
							  </tr>
							</thead>
							<tbody>
		

							</tbody>
						  </table>
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
				<p>2022 &copy; Atrana</p>
			</div>
				<div class="float-end">
					<p>Crafted with 
						<span class="text-danger">
							<i class="fa fa-heart"></i> by 
							<a href="https://www.facebook.com/andreew.co.id/" class="author-footer">Andre Tri Ramadana</a>
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
 </body>
</html>
