<?php
require('tr_action.php');

$navbl=$bdd->query("select * from navire_deb order by id desc");
$navire=$bdd->query("select * from navire_deb order by id desc");

$navire2=$bdd->query("select * from navire_deb order by id desc");

?>	



<!DOCTYPE html>
<html lang="fr">
  <head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>Debarquement</title>
<link rel="stylesheet" type="text/css" href="situation_journaliere.css">
	<!-- Bootstrap CSS-->
	 <?php include('tr_link.php'); ?>
</head>
<body >

   <div id="cacherimprimer"> 

<style type="text/css">
	
.lienforme{
color:white;
 font-size: 20px;
  border: solid; background-color: black;
   margin-bottom: 50px;

}

 *{
  font-family: Times New Roman;
 } 

@media print {
  .no_print {
    display: none;
  }
    #deb_by_client {
    page-break-before: always !important;
  }
  #deb_by_cale {
    page-break-before: always;
  }
  #deb_by_produit {
    page-break-before: always;
  }
    #deb_by_destination {
    page-break-before: always !important;
  }
   #deb_by_avaries_cale {
    page-break-before: always;
  }
  

   body{
    font-family:Times New Roman;
    font-weight: bold;
  }
      .hidden {
    display: none;
}

    .enteteTable{
     background: linear-gradient(to bottom, blue, #1B2B65); background: linear-gradient(to left, blue, #1B2B65); background: linear-gradient(to top, blue, #1B2B65); color: white; text-align: center; font-weight: bold;
     vertical-align: middle; 
      border: 5px;
      border-color: black;

    }
         #table{
          border: 5px; 
     }
    #colLibeles{
      background: rgba(83,104,253,0.9); color: white;
      vertical-align: middle;
      text-align: center;

    } 
    #colManifeste{
      background: rgb(72,94,179); color:white;
      vertical-align: middle;
       text-align: center;
    }
    #colDeb24H{
      background-color: rgb(124, 158, 191); color:white;
      vertical-align: middle;
       text-align: center;
    }
    #colDebTOTAL{
      background-color: rgb(34, 155, 176); color:white;
      vertical-align: middle;
       text-align: center;
    }
    #colROB{
      background-color: rgb(28, 118, 51); color:white;
      vertical-align: middle;
       text-align: center;
    }
    #sousTOTAL{
       background-color:rgb(94,44,101);  color:white;
       font-weight: bold;
       text-align: center;
       vertical-align: middle;

    }
    #TOTAL{
      background: black;
      color: red;
      font-weight: bold;
      vertical-align: middle;
       text-align: center;
    }
    #colFlasque{
      background-color: rgb(193, 150, 0); color:white;
      vertical-align: middle;
       text-align: center; 
    }

    #colMouille{
      background-color: rgb(158, 106, 35); color:white;
      vertical-align: middle;
       text-align: center; 
    }
    #colCumulGen{
    background-color: rgb(200, 106, 90); color:white;
      vertical-align: middle;
      text-align: center;  
    }
    #all_imprime{
      display: none;
    }
     
#cacherimprimer{
      display: none;
    }
    #situation{
      display: none;
    }
    #btnafficher{
      display: none;
    }
    .footer{
      display: none;
    }

}

</style>








        

3039484774
 
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
					<a  class="active">
						<i class='bx bxs-dashboard icon' ></i> MENU PRINCIPAL
					</a>
                    <?php include('page.php'); ?>
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
 </div>




    <?php 
//111111111111111111111111111DEBUTPARTIE11111111111111111111111111111 
    //       PARTIE SITUATION DEBARQUEMENT
     ?>
     
        <div class="container-fluid1 " id="situation"  style=" background: rgb(0,141,202);" >
        <div class="row">
            
            
                <div class="col-lg-12 col-md-12">
                    <h1 class="hem2 text-white" style=" background: rgb(0,44,62); font-size: 30px;">SITUATIONS DU DEBARQUEMENT</h1><br>

                    
                    <form method="POST" >
                        <select  id="navires" class="mysel" style="margin-right: 15%; height: 30px;   width: 40%;"  onchange='goNavireSit()'>
                            <option value="">selectionner une navire</option>
                            <?php 
                            while ($row=$navire2->fetch()) {
                             ?>
                                <option  value=<?php echo $row['id']; ?>><?php echo $row['navire']; ?></option>
                            <?php } ?>

                 </select>
                        
                     <select id="date" class="mysel" name="date" style="margin-right: 2%; height: 30px;  width: 40%;" onchange='goDateSit()'>
                            <option  selected>selectionner la date</option>
                        </select>
                        
                 
                            
                    </form>
                
            </div>
        </div>
    </div>
    <!--  div pour cacher print !-->
   

    
    <div class="sit" id="sit">
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
          /*  var printContents=document.getElementById(dname).innerHTML;
            var originalContents=document.body.innerHTML;
            document.body.innerHTML=printContents;*/
            window.print();
           // document.body.innerHTML=originalContents;
          

        }
    </script>

<script type="text/javascript">
    

  function afdeb() {
    var lien = document.getElementById("liendeb");
   

    if (lien.style.display === "none") {
      lien.style.display = "table";
    
     
    } else {
      lien.style.display = "none";
     
    }
    
    
  }



    
</script>

<script type="text/javascript">
    

  function VisibleDebParCale() {
    var transavariesdes = document.getElementById("transf_by_avaries_destination");
    var debcale = document.getElementById("deb_by_cale");
    var debproduit = document.getElementById("deb_by_produit");
     var debdes = document.getElementById("deb_by_destination");
      var debclient = document.getElementById("deb_by_client");
       var avariescale = document.getElementById("deb_by_avaries_cale");
        var avariesproduit = document.getElementById("deb_by_avaries_produit");
         var transavariesproduit = document.getElementById("transf_by_avaries_produit");
          var restant_avaries = document.getElementById("avaries_restant_by_produit");
          var all = document.getElementById("all_imprime"); 
   

   
      debcale.style.display = "table";
      debproduit.style.display = "none";
      debdes.style.display = "none";
      debclient.style.display = "none";
       avariescale.style.display = "none";
       avariesproduit.style.display = "none";
       transavariesproduit.style.display = "none";
        transavariesdes.style.display = "none";
        restant_avaries.style.display = "none";
         all.style.display = "none";
    
     
    
    }
   
</script>


<script type="text/javascript">
    

  function VisibleDebParProduit() {
    var transavariesdes = document.getElementById("transf_by_avaries_destination");
    var debcale = document.getElementById("deb_by_cale");
    var debproduit = document.getElementById("deb_by_produit");
     var debdes = document.getElementById("deb_by_destination");
      var debclient = document.getElementById("deb_by_client");
       var avariescale = document.getElementById("deb_by_avaries_cale");
        var avariesproduit = document.getElementById("deb_by_avaries_produit");
         var transavariesproduit = document.getElementById("transf_by_avaries_produit");
          var restant_avaries = document.getElementById("avaries_restant_by_produit");
           var all = document.getElementById("all_imprime"); 

   

    
      debproduit.style.display = "table";
      debcale.style.display = "none";
      debdes.style.display = "none";
      debclient.style.display = "none";
       avariescale.style.display = "none";
       avariesproduit.style.display = "none";
        transavariesproduit.style.display = "none";
        transavariesdes.style.display = "none";
        restant_avaries.style.display = "none";
         all.style.display = "none";
        
    
     
  
  
     
    
    
    
  }
   
</script>



<script type="text/javascript">
    

  function VisibleDebParDes() {
    var transavariesdes = document.getElementById("transf_by_avaries_destination");
    var debcale = document.getElementById("deb_by_cale");
    var debproduit = document.getElementById("deb_by_produit");
    var debdes = document.getElementById("deb_by_destination");
     var debclient = document.getElementById("deb_by_client");
      var avariescale = document.getElementById("deb_by_avaries_cale");
       var avariesproduit = document.getElementById("deb_by_avaries_produit");
        var transavariesproduit = document.getElementById("transf_by_avaries_produit");
         var restant_avaries = document.getElementById("avaries_restant_by_produit");
        var all = document.getElementById("all_imprime"); 
   

   
      debdes.style.display = "table";
      debcale.style.display = "none";
      debproduit.style.display = "none";
      debclient.style.display = "none";
       avariescale.style.display = "none";
       avariesproduit.style.display = "none";
        transavariesproduit.style.display = "none";
        transavariesdes.style.display = "none";
        restant_avaries.style.display = "none";
         all.style.display = "none";

    
     
    
  
     
    
    
    
  }
   
</script>

<script type="text/javascript">
    

  function VisibleDebParClient() {
     var a=document.getElementById("statut_client");
     var transavariesdes = document.getElementById("transf_by_avaries_destination");
    var debclient = document.getElementById("deb_by_client");
    var debcale = document.getElementById("deb_by_cale");
    var debproduit = document.getElementById("deb_by_produit");
    var debdes = document.getElementById("deb_by_destination");
     var avariescale = document.getElementById("deb_by_avaries_cale");
      var avariesproduit = document.getElementById("deb_by_avaries_produit");
       var transavariesproduit = document.getElementById("transf_by_avaries_produit");
        var restant_avaries = document.getElementById("avaries_restant_by_produit");
       var all = document.getElementById("all_imprime"); 
      
   

   
      debclient.style.display = "none";
      debdes.style.display = "none";
      debcale.style.display = "none";
      debproduit.style.display = "none";
      avariescale.style.display = "none";
      avariesproduit.style.display = "none";
       transavariesproduit.style.display = "none";
       transavariesdes.style.display = "none";
       restant_avaries.style.display = "none";
       all.style.display = "none";
       a.style.height='';
   
     
    } 
  
     
    
    
    
  
   
</script>


<script type="text/javascript">
    

  function VisibleAvariesParCale() {
    var transavariesdes = document.getElementById("transf_by_avaries_destination");
    var avariescale = document.getElementById("deb_by_avaries_cale");
    var debclient = document.getElementById("deb_by_client");
    var debcale = document.getElementById("deb_by_cale");
    var debproduit = document.getElementById("deb_by_produit");
    var debdes = document.getElementById("deb_by_destination");
     var avariesproduit = document.getElementById("deb_by_avaries_produit");
      var transavariesproduit = document.getElementById("transf_by_avaries_produit");
       var restant_avaries = document.getElementById("avaries_restant_by_produit");
        var all = document.getElementById("all_imprime"); 
   

   
        avariescale.style.display = "table";
      debclient.style.display = "none";
      debdes.style.display = "none";
      debcale.style.display = "none";
      debproduit.style.display = "none";
      avariesproduit.style.display = "none";
       transavariesproduit.style.display = "none";
       transavariesdes.style.display = "none";
       restant_avaries.style.display = "none";
      all.style.display = "none";

 
    
  }
   
</script>

<script type="text/javascript">
    

  function VisibleAvariesParProduit() {
    var transavariesdes = document.getElementById("transf_by_avaries_destination");
     var avariesproduit = document.getElementById("deb_by_avaries_produit");
    var avariescale = document.getElementById("deb_by_avaries_cale");
    var debclient = document.getElementById("deb_by_client");
    var debcale = document.getElementById("deb_by_cale");
    var debproduit = document.getElementById("deb_by_produit");
    var debdes = document.getElementById("deb_by_destination");
     var transavariesproduit = document.getElementById("transf_by_avaries_produit");
      var restant_avaries = document.getElementById("avaries_restant_by_produit");
       var all = document.getElementById("all_imprime"); 
   

    
        avariesproduit.style.display = "table";
        avariescale.style.display = "none";
      debclient.style.display = "none";
      debdes.style.display = "none";
      debcale.style.display = "none";
      debproduit.style.display = "none";
       transavariesproduit.style.display = "none";
       transavariesdes.style.display = "none";
       restant_avaries.style.display = "none";
       
        all.style.display = "none";
    
     
    } 
  
     
    
    
    
  
   
</script>


<script type="text/javascript">
    

  function VisibleTransAvariesParProduit() {
    var transavariesdes = document.getElementById("transf_by_avaries_destination");
    var transavariesproduit = document.getElementById("transf_by_avaries_produit");
     var avariesproduit = document.getElementById("deb_by_avaries_produit");
    var avariescale = document.getElementById("deb_by_avaries_cale");
    var debclient = document.getElementById("deb_by_client");
    var debcale = document.getElementById("deb_by_cale");
    var debproduit = document.getElementById("deb_by_produit");
    var debdes = document.getElementById("deb_by_destination");
     var restant_avaries = document.getElementById("avaries_restant_by_produit");
     var all = document.getElementById("all_imprime"); 
   

 
        transavariesproduit.style.display = "table";
        avariesproduit.style.display = "none";
        avariescale.style.display = "none";
      debclient.style.display = "none";
      debdes.style.display = "none";
      debcale.style.display = "none";
      debproduit.style.display = "none";
      transavariesdes.style.display = "none";
      restant_avaries.style.display = "none";
        all.style.display = "none";

    
     
    } 
  
     

   
</script>


<script type="text/javascript">
    

  function VisibleTransAvariesParDes() {
    var transavariesdes = document.getElementById("transf_by_avaries_destination");
    var transavariesproduit = document.getElementById("transf_by_avaries_produit");
     var avariesproduit = document.getElementById("deb_by_avaries_produit");
    var avariescale = document.getElementById("deb_by_avaries_cale");
    var debclient = document.getElementById("deb_by_client");
    var debcale = document.getElementById("deb_by_cale");
    var debproduit = document.getElementById("deb_by_produit");
    var debdes = document.getElementById("deb_by_destination");
     var restant_avaries = document.getElementById("avaries_restant_by_produit");
      var all = document.getElementById("all_imprime"); 
   

    
        transavariesdes.style.display = "table";
        transavariesproduit.style.display = "none";
        avariesproduit.style.display = "none";
        avariescale.style.display = "none";
      debclient.style.display = "none";
      debdes.style.display = "none";
      debcale.style.display = "none";
      debproduit.style.display = "none";
      restant_avaries.style.display = "none";
      
        all.style.display = "none";
     
    } 
  
     

   
</script>

<script type="text/javascript">
function VisibleRestantAvaries() {
    var restant_avaries = document.getElementById("avaries_restant_by_produit");
    var transavariesdes = document.getElementById("transf_by_avaries_destination");
    var transavariesproduit = document.getElementById("transf_by_avaries_produit");
     var avariesproduit = document.getElementById("deb_by_avaries_produit");
    var avariescale = document.getElementById("deb_by_avaries_cale");
    var debclient = document.getElementById("deb_by_client");
    var debcale = document.getElementById("deb_by_cale");
    var debproduit = document.getElementById("deb_by_produit");
    var debdes = document.getElementById("deb_by_destination");
     var all = document.getElementById("all_imprime");
   

    
        restant_avaries.style.display = "table";
       transavariesdes.style.display = "none";
        transavariesproduit.style.display = "none";
        avariesproduit.style.display = "none";
        avariescale.style.display = "none";
      debclient.style.display = "none";
      debdes.style.display = "none";
      debcale.style.display = "none";
      debproduit.style.display = "none";
       all.style.display = "none";

    
     
    } 
  
     

   
</script>


<script type="text/javascript">
function VisibleGlobal() {


      var tousimprime = document.getElementById("all_imprime");
    
    var restant_avaries = document.getElementById("avaries_restant_by_produit");
    var transavariesdes = document.getElementById("transf_by_avaries_destination");
    var transavariesproduit = document.getElementById("transf_by_avaries_produit");
     var avariesproduit = document.getElementById("deb_by_avaries_produit");
    var avariescale = document.getElementById("deb_by_avaries_cale");
    var debclient = document.getElementById("deb_by_client");
    var debcale = document.getElementById("deb_by_cale");
    var debproduit = document.getElementById("deb_by_produit");
    var debdes = document.getElementById("deb_by_destination");
   

       tousimprime.style.display = "table";
        restant_avaries.style.display = "table";
       transavariesdes.style.display = "table";
        transavariesproduit.style.display = "table";
        avariesproduit.style.display = "table";
        avariescale.style.display = "table";
      debclient.style.display = "table";
      debdes.style.display = "table";
      debcale.style.display = "table";
      debproduit.style.display = "table";
      
    
   
  }
   
</script>


<script type="text/javascript">
function VisibleGlobal2() {


      var tousimprime = document.getElementById("all_imprime");
    
   
    
    var debclient = document.getElementById("deb_by_client");
    var debcale = document.getElementById("deb_by_cale");
    var debproduit = document.getElementById("deb_by_produit");
    var debdes = document.getElementById("deb_by_destination");
   

       tousimprime.style.display = "table";
        
      debclient.style.display = "table";
      debdes.style.display = "table";
      debcale.style.display = "table";
      debproduit.style.display = "table";
      
    
   
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
                xhr.open("POST","date_sit.php",true);
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
            function goDateSi(){
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
                xhr.open("POST","selectTableSituation.php",true);
                // ne pas oublier ça pour le post
                xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
                // ne pas oublier de poster les arguments
                // ici, l'id de l'auteur
                sel = document.getElementById('date');
                iddate = sel.options[sel.selectedIndex].value;
                xhr.send("idDate="+iddate);

            }

            //deb_by_client"
        </script>  
    
 </body>
</html>
