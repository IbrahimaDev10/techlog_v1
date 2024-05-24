<?php
require('../database.php');
require('controller/afficher_navire.php');
//require('control_dc.php');
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");


?>



<!doctype html>
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
					<a href="../star_superviseur.php" class="active">
						<i class='bx bxs-dashboard icon' ></i> MENU PRINCIPAL
					</a>
					<?php include('../super/page.php'); ?>
				</li>

		    		
   			
            </div>
        </div>

       </div> 
	 </div>
	</div><!-- End Sidebar-->
<a href="https://www.freepik.com/free-photo/big-ship-dry-dock_1186463.htm#query=port%20autonome%20gratuit&position=16&from_view=search&track=ais">Image by bearfotos</a> on Freepik

	<div class="sidebar-overlay"></div>


	<!--Content Start-->
	<div class="content-start transition" style="background-image: url('../images/bg_page.jpg'); background-repeat:no-repeat; background-size: 100%;  margin: 0px; border: none; border-radius: 0px;">
		<div class="container-fluid dashboard">
			<div class="content-header">

			
			
			<div class="container-fluid" >
				<div class="row">
					<center>
			<h3 class="ajout_dis" style="color: white;">DISPATCHER RELÂCHES</h3>
			</center>
			
<div class="col col-lg-6" >			
	<div class="" id="" tabindex="-1" >
  <div class="modal-dialog">
    <div class="modal-content" style=" border: solid; border-color:rgb(0,141,202); ">
            <div class="modal-header" style="">
              <center>
              	<h3 class="modal-title fs-10 text-white text-center" id="exampleModalLabel " style="text-align:center;   "> relâche</h3></center>
              	<center>
              <img class="logoo" src="../images/mylogo.ico" >
       </center>
      	
      </div>
       <br>	<br>
      <div class="modal-body">

      	<form action="" method="POST" enctype="multipart/form-data">


                      

<div class="form-group position-relative has-icon-left mb-5">
   <input id="date" type="date" class="" placeholder="date" name="manifeste" style="width:45%; margin-right:20px ">
	<?php $navire=afficher_navire($bdd);  ?>

        <select id="navire" name="bl" data-role="choix_navire">
        	<option>Choisir un navire</option>
        	<?php while($nav=$navire->fetch()){ ?>
        		<option value="<?php echo $nav['id']; ?>"><?php echo $nav['navire']; ?></option>
        		<?php } ?>
        </select><br><br>

<?php 
        ?>
               <select id="connaissement" data-role="choix_connaissement" style="max-width: 50%;">
               	<option>choisir un bon</option>
              
               </select>

                <select id="destination">
               	<option>choisir une destination</option>
              
               </select> <br><br>


                   
                                
                            <input id="quantite" type="text" class="" placeholder="quantite" name="manifeste" style="width:45%; margin-right:20px "><br><br>	

                                   
				
				
   <center>
<a class="btn" style="width: 100%; " data-role="inserer_dispath_bon">Ajouter</a>
   </center> 
   
   </div>
      
</form>
  
     
    </div>
  </div>
  </div>
	</div>
	</div>

	<center>
		<div id="affichage">
			
		</div>
	</center>

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
  $(document).ready(function(){
    $(document).on('change','select[data-role=choix_navire]',function(){
  //$('#type').css('display', 'block');

    var id_navire = $('#navire').val();
      //var type_dec = $('#type_dec').val();
     

        $.ajax({
        url:'afficher_un_bon.php',
        method:'post',
        data:{id_navire:id_navire},
        success: function(response){
            $('#connaissement').html(response);

       
        }
    });
 

  });
});
</script>

<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('change','select[data-role=choix_connaissement]',function(){
  //$('#type').css('display', 'block');

    var id_connaissement = $('#connaissement').val();
      //var type_dec = $('#type_dec').val();
     

        $.ajax({
        url:'afficher_select_destination.php',
        method:'post',
        data:{id_connaissement:id_connaissement},
        success: function(response){
            $('#destination').html(response);

       
        }
    });
 

  });
});
</script>


<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('click','a[data-role=inserer_dispath_bon]',function(){
  //$('#type').css('display', 'block');

    var connaissement = $('#connaissement').val();
    var navire = $('#navire').val();
    var destination = $('#destination').val();
    var quantite = $('#quantite').val();
    var date = $('#date').val();

      //var type_dec = $('#type_dec').val();
     

        $.ajax({
        url:'insertion_dispatching_bon.php',
        method:'post',
        data:{connaissement:connaissement,navire:navire,destination:destination,quantite:quantite,date:date},
        success: function(response){
            $('#affichage').html(response);

       
        }
    });
 

  });
});
</script>





 </body>
</html>
