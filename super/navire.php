<?php 
include('../database.php');


 ?>

<!doctype html>
<html lang="fr">
  <head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>Ajout_navire</title>

	<!-- Bootstrap CSS-->
	<link rel="stylesheet" href="assets/modules/bootstrap-5.1.3/css/bootstrap.css">
	<!-- Style CSS -->
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="../nav3.css">
	<!-- Boostrap Icon-->
	<link rel="stylesheet" href="assets/modules/bootstrap-icons/bootstrap-icons.css">
</head>
<body>
 
	<div id="auth">
        
		<div class="row h-100">
			<div class="col-lg-4 d-none d-lg-block">
				<div id="auth-left">
		
				</div>
			</div>
			<div class="col-lg-8 col-12">
				<div id="auth-right">
					<div class="auth-logo">
						<a href="control_debarquement.php"><img src="assets/images/logo.png" alt="Logo"> SIMAR</a>  
					</div>
					<h1 class="auth-title">AJOUTER UN NAVIRE</h1>
					<p class="auth-subtitle mb-5">Input your data to register to our website.</p>
		
					<form action="control_debarquement.php" method="POST">
					    <div class="form-group position-relative has-icon-left mb-4">

                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" class="form-control form-control-xl" placeholder="Navire" name="navire">
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>

               


                        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="valider_navire">valider_navire</button>
					</form>
                    <div class="text-center mt-5 text-lg fs-4">
                        <p class='text-gray-600'>Already have an account? <a href="auth-login.html" class="font-bold">Login</a>.</p>
                    </div>
				</div>
			</div>
			
		</div>
	</div>
		
	 

	<!-- General JS Scripts -->
	<script src="assets/js/atrana.js"></script>

	<!-- JS Libraies -->
	<script src="assets/modules/jquery/jquery.min.js"></script>
	<script src="assets/modules/bootstrap-5.1.3/js/bootstrap.bundle.min.js"></script>
	<script src="assets/modules/popper/popper.min.js"></script>
 
    <!-- Template JS File -->
	<script src="assets/js/script.js"></script>
	<script src="assets/js/custom.js"></script>
 </body>
</html>
