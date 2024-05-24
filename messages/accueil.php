<?php
include('../database.php');
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
	if(empty($_SESSION['profil'])){
		header('location:../index.php');
	}
	

?>
<!doctype html>
<html lang="fr">
  <head>
   




	<title>Debarquement</title>
        <meta charset="utf-8">
  
    <meta content="" name="keywords">
    <meta content="" name="description">


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

	<link rel="stylesheet" type="text/css" href="../super/debarquement.css">
</head>
<body >

<style type="text/css">
	 *{
  font-family: Times New Roman;
 } 

  .CellTotalElement{
	background-color:yellow; 
	color: red;
}
	100% {
		-webkit-transform: scale(1);
		transform: scale(1);
		opacity: 1
	}
}
.lienforme{
	background-color: blue;
	color: white;
	font-size: 20px;
}
.hnavire{
	background-color: #1B2B65;
	border: solid;
	border-top-left-radius: 50%;
	border-bottom-left-radius: 50%;
	border-top-right-radius: 50%;
	border-bottom-right-radius: 50%;
}

.hproduit{
	background-color: green;
	border: solid;
	border-top-left-radius: 50%;
	border-bottom-left-radius: 50%;
	border-top-right-radius: 50%;
	border-bottom-right-radius: 50%;
}
.hclient{
	background-color: rgb(0,128,128);
	border: solid;
	border-top-left-radius: 50%;
	border-bottom-left-radius: 50%;
	border-top-right-radius: 50%;
	border-bottom-right-radius: 50%;
}
.htransporteur{
	background-color: rgb(240,171,79);
	border: solid;
	border-top-left-radius: 50%;
	border-bottom-left-radius: 50%;
	border-top-right-radius: 50%;
	border-bottom-right-radius: 50%;
}

.hdeclaration{
	background-color: background: linear-gradient(to bottom, blue, #1B2B65);
	 background: linear-gradient(to left, blue, #1B2B65);
	  background: linear-gradient(to top, blue, #1B2B65);
	border: solid;
	
	border-top-right-radius: 50%;
	border-bottom-right-radius: 50%;
	font-weight: bold;
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
    .colcel, #soustotal, #total{
      font-size: 12px;

    }

 
#exampleFormControlInput1{
  width: 50%;

}
	
</style>


  
  <!--Topbar -->

 
	<!--Sidebar-->
  <?php include('../super/navbar.php'); ?>

	<div class="sidebar transition overlay-scrollbars animate__animated  animate__slideInLeft " style="background: linear-gradient(-45deg, #004362, #0183d0) !important;  position: fixed; " >
        <div class="sidebar-content"> 
        	<div id="sidebar">
			
			<!-- Logo -->
			<div class="logo">
        <br>  
					<h2 class="mb-4"><img class="mt-5" style="width: 150px; height: 60px;  border-radius: 50%; color: white;" src="../images/mylogo4.png"> </h2>
			</div>

            <ul class="side-menu">
                <li>
					<a  class="active">
						<i class='bx bxs-dashboard icon' ></i> MENU PRINCIPAL
					</a>
					<?php include('../super/page.php'); ?>
				</li>

		    		


               
            </div>
        </div>

       </div> 
	 </div>
	</div><!-- End Sidebar-->


	<div class="sidebar-overlay"></div>


	<!--Content Start-->
<!--	<div class="content-start transition" style="background-image: url('../images/img_port.jpg');  background-size: cover;
   background-position: center center;
  background-repeat: no-repeat;  margin: 0px; border: none; border-radius: 0px; z-index: -5; " > !-->
  <div class="content-start transition" style="background:rgb(239,239,239); " >
		<div class="container-fluid dashboard">
			<div class="content-header">

   
  <div class="row"> 
    <div class="col col-lg-4" style="">
      <div class="card" > 
 
      
       <div class="card-body"> 
      <h6 style="text-align: left;"> SMS </h6>
      <a  style="color: blue !important; width: 50px; height: 30px; margin-bottom: 20px;"> <img src="../assets/images/avatar/avatar-1.png" alt="" style="width: 50px; height: 30px; margin-bottom: 20px;"> </i> BONJOUR </a><br>  
       <a  style="color: blue !important; width: 50px; height: 30px; margin-bottom: 20px;"> <img src="../assets/images/avatar/avatar-1.png" alt="" style="width: 50px; height: 30px; margin-bottom: 20px;"> </i> HELLO </a>
      </div>
      </div>
      </div>
     
 

   
    <div class="col col-lg-8" >
      <div class="card" > 
 
      
       <div class="card-body"> 
      <h6 style="text-align: left;"> USER </h6>
      <input type="text" name="" style=" bottom: 0; width: 80%; "> <a style="color: blue !important;" class="fas fa-paper-plane"></a>
     
      </div>
      </div>
      </div>
 </div>
 
 <div class="container" style="background-image: url('entete3.jpg');">
   <div class="row">
     <div ></div>
     <h3>DBYDOVZ8FHZ78</h3>
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

	        <?php 
if(isset($_GET['z'])){

 ?>
 <div class="flash-data" data-flashdata=<?=$_GET['z']; ?>></div>
<?php } ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


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



  
    <script src="../lib/wow/wow.min.js"></script>
    <script src="../lib/easing/easing.min.js"></script>
    <script src="../lib/waypoints/waypoints.min.js"></script>
    <script src="../lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="../lib/isotope/isotope.pkgd.min.js"></script>
    <script src="../lib/lightbox/js/lightbox.min.js"></script>






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
                        leselect = xhr.responseText;
                        // On se sert de innerHTML pour rajouter les options à la liste
                        document.getElementById('lesinputs').innerHTML = leselect;

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


  



	<script type="text/javascript">
		function imprimer(dname){
      window.print();

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
            function go(){
                var xhr = getXhr();
                // On définit ce qu'on va faire quand on aura la réponse
                xhr.onreadystatechange = function(){
                    // On ne fait quelque chose que si on a tout reçu et que le serveur est OK
                    if(xhr.readyState == 4 && xhr.status == 200){
                        leselect = xhr.responseText;
                        // On se sert de innerHTML pour rajouter les options à la liste
                        document.getElementById('fetch_cargo_plan').innerHTML = leselect;

                    }
                }
 
                // Ici on va voir comment faire du post
                xhr.open("POST","selectDeclaration_chargement.php",true);
                // ne pas oublier ça pour le post
                xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
                // ne pas oublier de poster les arguments
                // ici, l'id de l'auteur
                sel = document.getElementById('navire');
                idnavire = sel.options[sel.selectedIndex].value;
                xhr.send("idNavire="+idnavire);
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
            function go2(){
                var xhr = getXhr();
                // On définit ce qu'on va faire quand on aura la réponse
                xhr.onreadystatechange = function(){
                    // On ne fait quelque chose que si on a tout reçu et que le serveur est OK
                    if(xhr.readyState == 4 && xhr.status == 200){
                        leselect = xhr.responseText;
                        // On se sert de innerHTML pour rajouter les options à la liste
                        document.getElementById('fetch_sta_cale').innerHTML = leselect;

                    }
                }
 
                // Ici on va voir comment faire du post
                xhr.open("POST","selectStaCale.php",true);
                // ne pas oublier ça pour le post
                xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
                // ne pas oublier de poster les arguments
                // ici, l'id de l'auteur
                sel = document.getElementById('naviresta');
                idnaviresta = sel.options[sel.selectedIndex].value;
                xhr.send("idNaviresta="+idnaviresta);
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
            function go3(){
                var xhr = getXhr();
                // On définit ce qu'on va faire quand on aura la réponse
                xhr.onreadystatechange = function(){
                    // On ne fait quelque chose que si on a tout reçu et que le serveur est OK
                    if(xhr.readyState == 4 && xhr.status == 200){
                        leselect = xhr.responseText;
                        // On se sert de innerHTML pour rajouter les options à la liste
                        document.getElementById('fetch_sta_var').innerHTML = leselect;

                    }
                }
 
                // Ici on va voir comment faire du post
                xhr.open("POST","selectStaVar.php",true);
                // ne pas oublier ça pour le post
                xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
                // ne pas oublier de poster les arguments
                // ici, l'id de l'auteur
                sel = document.getElementById('naviresta2');
                idnaviresta2 = sel.options[sel.selectedIndex].value;
                xhr.send("idNaviresta2="+idnaviresta2);
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
            function goDC(){
                var xhr = getXhr();
                // On définit ce qu'on va faire quand on aura la réponse
                xhr.onreadystatechange = function(){
                    // On ne fait quelque chose que si on a tout reçu et que le serveur est OK
                    if(xhr.readyState == 4 && xhr.status == 200){
                        leselect = xhr.responseText;
                        // On se sert de innerHTML pour rajouter les options à la liste
                        document.getElementById('produit').innerHTML = leselect;

                    }
                }
 
                // Ici on va voir comment faire du post
                xhr.open("POST","selectProduit.php",true);
                // ne pas oublier ça pour le post
                xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
                // ne pas oublier de poster les arguments
                // ici, l'id de l'auteur
                sel = document.getElementById('selnavire');
                idnavire = sel.options[sel.selectedIndex].value;
                xhr.send("idNavire="+idnavire);
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
            function goDIS(){
                var xhr = getXhr();
                // On définit ce qu'on va faire quand on aura la réponse
                xhr.onreadystatechange = function(){
                    // On ne fait quelque chose que si on a tout reçu et que le serveur est OK
                    if(xhr.readyState == 4 && xhr.status == 200){
                        leselect = xhr.responseText;
                        // On se sert de innerHTML pour rajouter les options à la liste
                        document.getElementById('produitDIS').innerHTML = leselect;

                    }
                }
 
                // Ici on va voir comment faire du post
                xhr.open("POST","selectProduitDIS.php",true);
                // ne pas oublier ça pour le post
                xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
                // ne pas oublier de poster les arguments
                // ici, l'id de l'auteur
                sel = document.getElementById('selnavireDIS');
                idnavire = sel.options[sel.selectedIndex].value;
                xhr.send("idNavire="+idnavire);
            }
        </script>


<script type="text/javascript">
  function deleteDec(id){
   
       if(confirm('Voulez vous vraiment supprimer ce donnée?')){
       	var navire=$('#'+id).children('td[data-target=navire]').text();
         //var navire=navires.text();
         
         $.ajax({

              type:'post',
              url:'delete_declaration.php',
              data:{delete_id:id,navire,navire},
              success:function(response){
              
                   $('#parcale').html(response);

              }

         });

       }


     }

 


 </script>


 <script type="text/javascript">
  function deleteDecvrac(id){
   
       if(confirm('Voulez vous vraiment supprimer ce donnée?')){
       	var navire=$('#'+id).children('td[data-target=navire_vrac]').text();
         //var navire=navires.text();
         
         $.ajax({

              type:'post',
              url:'delete_declarationvrac.php',
              data:{delete_id:id,navire:navire},
              success:function(response){
              
                   $('#parcale').html(response);

              }

         });

       }


     }

 


 </script>


 <script type="text/javascript">
  function deleteDispatching(id){
   
       if(confirm('Voulez vous vraiment supprimer ce donnée?')){
       	var navire=$('#'+id+'navire_dis').text();
         //var navire=navires.text();
         
         $.ajax({

              type:'post',
              url:'delete_dispatching.php',
              data:{delete_id:id,navire:navire},
              success:function(response){
              
                   $('#parconnaissement').html(response);

              }

         });

       }


     }

 


 </script>



 <script type="text/javascript">
  function deleteDispatchingvrac(id){
   
       if(confirm('Voulez vous vraiment supprimer ce donnée?')){
       	var navire=$('#'+id+'id_navire_dis_delvrac').text();
         //var navire=navires.text();
         
         $.ajax({

              type:'post',
              url:'delete_dispatchingvrac.php',
              data:{delete_id:id,navire:navire},
              success:function(response){
              
                   $('#parclient').html(response);

              }

         });

       }


     }


 </script>

 <script type="text/javascript">
  function deleteTransit(id){
   
       if(confirm('Voulez vous vraiment supprimer ce donnée?')){
       	var navire=$('#'+id+'id_navire_del_trans').text();
         //var navire=navires.text();
         
         $.ajax({

              type:'post',
              url:'delete_transit.php',
              data:{delete_id:id,navire:navire},
              success:function(response){
              
                   $('#partransit').html(response);

              }

         });

       }


     }


 </script>

<script>
  function visibleBanque() {
    var parbanque = document.getElementById("parbanque");
    var parcale = document.getElementById("parcale");
    var parproduit = document.getElementById("parproduit");
    var parclient = document.getElementById("parclient");
    var pardestination = document.getElementById("pardestination");
    var parbl = document.getElementById("parbl");
    var partransit = document.getElementById("partransit"); 
    if (parbanque.style.display === "none") {
      parbanque.style.display = "table";
      parproduit.style.display = "none";
      parcale.style.display = "none";
      parclient.style.display = "none";
      pardestination.style.display = "none";
      parbl.style.display = "none";
      partransit.style.display = "none";
     

       parbanque.scrollIntoView({ behavior: 'smooth' });
     
    } else {
      parbanque.style.display = "none";
     
    }
    
    
  }
</script>


 
<script>
  function visibleProduit() {
    var parcale = document.getElementById("parcale");
    var parproduit = document.getElementById("parproduit");
    var parclient = document.getElementById("parclient");
    var pardestination = document.getElementById("pardestination");
    var parconnaissement = document.getElementById("parconnaissement");
    var partransit = document.getElementById("partransit");
     var parbanque = document.getElementById("parbanque"); 
    if (parproduit.style.display === "none") {
      parproduit.style.display = "table";
      parcale.style.display = "none";
      parclient.style.display = "none";
      pardestination.style.display = "none";
      parconnaissement.style.display = "none";
      partransit.style.display = "none";
       parbanque.style.display = "none";
     

       parproduit.scrollIntoView({ behavior: 'smooth' });
     
    } else {
      parproduit.style.display = "none";
     
    }
    
    
  }
</script>



<script>
  function visibleCale() {
    var parcale = document.getElementById("parcale");
    var parproduit = document.getElementById("parproduit");
    var parclient = document.getElementById("parclient");
    var pardestination = document.getElementById("pardestination");
    var parconnaissement = document.getElementById("parconnaissement");
    var partransit = document.getElementById("partransit"); 
    var btncale = document.getElementById("btncale"); 
     var parbanque = document.getElementById("parbanque");
    if (parcale.style.display === "none") {
      parcale.style.display = "block";
      parproduit.style.display = "none";
      parclient.style.display = "none";
      pardestination.style.display = "none";
      parconnaissement.style.display = "none";
      partransit.style.display = "none";
      parbanque.style.display = "none";
     

       btncale.scrollIntoView({ behavior: 'smooth' });
     
    } else {
      parcale.style.display = "none";
     
    }
    
    
  }
</script>



<script>
  function visibleClient() {
    var parcale = document.getElementById("parcale");
    var parproduit = document.getElementById("parproduit");
    var parclient = document.getElementById("parclient");
    var pardestination = document.getElementById("pardestination");
    var parconnaissement = document.getElementById("parconnaissement");
    var partransit = document.getElementById("partransit");
     var parbanque = document.getElementById("parbanque"); 
    if (parclient.style.display === "none") {
      parclient.style.display = "table";
      parcale.style.display = "none";
      parproduit.style.display = "none";
      pardestination.style.display = "none";
      parconnaissement.style.display = "none";
      partransit.style.display = "none";
      parbanque.style.display = "none";
     

       parclient.scrollIntoView({ behavior: 'smooth' });
     
    } else {
      parclient.style.display = "none";
     
    }
    
    
  }
</script>


<script>
  function visibleDestination() {
    var parcale = document.getElementById("parcale");
    var parproduit = document.getElementById("parproduit");
    var parclient = document.getElementById("parclient");
    var pardestination = document.getElementById("pardestination");
    var parconnaissement = document.getElementById("parconnaissement");
    var partransit = document.getElementById("partransit"); 
     var parbanque = document.getElementById("parbanque");
    if (pardestination.style.display === "none") {
      pardestination.style.display = "table";
      parproduit.style.display = "none";
      parclient.style.display = "none";
      parcale.style.display = "none";
      parbl.style.display = "none";
      partransit.style.display = "none";
      parbanque.style.display = "none";
     

       pardestination.scrollIntoView({ behavior: 'smooth' });
     
    } else {
      pardestination.style.display = "none";
     
    }
    
    
  }
</script>

<script>
  function visibleBl() {
    var parcale = document.getElementById("parcale");
    var parproduit = document.getElementById("parproduit");
    var parclient = document.getElementById("parclient");
    var pardestination = document.getElementById("pardestination");
    var parconnaissement = document.getElementById("parconnaissement");
    var partransit = document.getElementById("partransit");
     var parbanque = document.getElementById("parbanque"); 
    if (parconnaissement.style.display === "none") {
      parconnaissement.style.display = "table";
      parproduit.style.display = "none";
      parclient.style.display = "none";
      parcale.style.display = "none";
      pardestination.style.display = "none";
      partransit.style.display = "none";
      parbanque.style.display = "none";
     

       parconnaissement.scrollIntoView({ behavior: 'smooth' });
     
    } else {
      parbl.style.display = "none";
     
    }
    
    
  }
</script>

<script>
  function visibleTransit() {
    var parcale = document.getElementById("parcale");
    var parproduit = document.getElementById("parproduit");
    var parclient = document.getElementById("parclient");
    var pardestination = document.getElementById("pardestination");
    var parbl = document.getElementById("parconnaissement");
    var partransit = document.getElementById("partransit");
    var parbanque = document.getElementById("parbanque"); 
    if (partransit.style.display === "none") {
      partransit.style.display = "table";
      parproduit.style.display = "none";
      parclient.style.display = "none";
      parcale.style.display = "none";
      parbl.style.display = "none";
      pardestination.style.display = "none";
      parbanque.style.display = "none";
     

       partransit.scrollIntoView({ behavior: 'smooth' });
     
    } else {
      partransit.style.display = "none";
     
    }
    
    
  }
</script>

<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('click','a[data-role=update]',function(){
		var id=$(this).data('id');
		var cale=$('#'+id +'cales').text();
   
		var sac=$('#'+id).children('td[data-target=sac]').text();
		sac = sac.replace(' ', '');
		var navire=$('#'+id).children('td[data-target=navire]').text();
		var ch=$('#'+id).children('td[data-target=nom_chargeur]').text();
		var produit = $('#'+id).children('td[data-target=produit]').text();
var produitId = $('#'+id +'produit-id').text();
var produitText = $('#'+id).children('td[data-target=produit]').text();
var type = $('#'+id +'type').text();
var poids_is_vrac = $('#'+id +'poids_is_vrac').text();





//$('#id_produit').val(produitId);




		var cond=$('#'+id).children('td[data-target=conditionnement]').text();
		cond = cond.replace(' KGS', '');
		$('#caleform').val(cale);
		$('#chform').val(ch);
		$('#iddec').val(id);

		$('#id_produit').val(produitId);
		$('#conditionnement').val(cond);
		$('#sac').val(sac);
		$('#navire_dc').val(navire);
    $('#type').val(type);
    $('#poids_is_vrac').val(poids_is_vrac);
		
		$('#modif_dec').modal('toggle');
	});
		

	$(document).ready(function(){
    $(document).on('click','a[data-role=saves]',function(){
	var cale=$('#caleform').val();
	var ch=$('#chform').val();
	var id=$('#iddec').val();
	var produitId=$('#id_produit').val();
	var sac=$('#sac').val();
	var navire=$('#navire_dc').val();
  var type=$('#type').val();
  var poids_is_vrac=$('#poids_is_vrac').val();

	var cond=$('#conditionnement').val();
	$.ajax({
		url:'modifier_declaration2.php',
		method:'post',
		data:{cale:cale,ch:ch,id:id,cond:cond,produitId:produitId,sac:sac,navire:navire,type:type,poids_is_vrac:poids_is_vrac},
		success: function(response){
			$('#parcale').html(response);
			/*$('#'+id).children('td[data-target=cales]').text(cale);
		$('#'+id).children('td[data-target=nom_chargeur]').text(ch);
		$('#'+id).children('td[data-target=conditionnement]').text(cond+' KGS');
		//$('#modif_dec').modal('toggle');*/
		$('#modif_dec').modal('toggle');
		}
	});

	});
});
});
</script>





<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('click','a[data-role=update_transit]',function(){
		var id=$(this).data('id');
		var num_dec = $('#'+id +'numero_declaration').text();
		var poids_dec = $('#'+id +'poids_declarer').text();
		poids_dec=poids_dec.replace(" ","");
		poids_dec=poids_dec.replace(",",".");
		var statut = $('#'+id +'statut_douaniere').text();
		var des_douane = $('#'+id +'destination_douaniere').text();
		var navire = $('#'+id +'navire_trans').text();
    var bl = $('#'+id +'bl_transit').text();
    var id_bl = $('#'+id +'id_bl_transit').text();

		
		//var id_produit = $('#'+id+'id_produit_transit').text();
//var produit = $('#'+id +'produit_transit').text();

/*
var existingOption = $('#id_produit_tr option[value="' + id_produit + '"]');
if (existingOption.length > 0) {
   // Mettre à jour le texte de l'option existante
   existingOption.text(produit);
} else {
   // Ajouter une nouvelle option avec la valeur et le texte correspondants
   var newOption = $('<option>', {
      value: id_produit,
      text: produit
   });
   $('#id_produit_tr').prepend(newOption);
   // Sélectionner l'option par défaut
   newOption.prop('selected', true);
}
//$('#id_produit').val(produitId); */


var existingOptionStatut = $('#statut option[value="' + statut + '"]');
if (existingOptionStatut.length > 0) {
   // Mettre à jour le texte de l'option existante
   existingOptionStatut.text(statut);
} else {
   // Ajouter une nouvelle option avec la valeur et le texte correspondants
   var newOptions = $('<option>', {
      value: statut,
      text: statut
   });
   $('#statut').prepend(newOptions);
   // Sélectionner l'option par défaut
   newOptions.prop('selected', true);
}
 $('#statut').val(statut);


 var existingOptionStatut = $('#n_bl_transit option[value="' + id_bl + '"]');
if (existingOptionStatut.length > 0) {
   // Mettre à jour le texte de l'option existante
   existingOptionStatut.text(bl);
} else {
   // Ajouter une nouvelle option avec la valeur et le texte correspondants
   var newOptions = $('<option>', {
      value: id_bl,
      text: bl
   });
   $('#n_bl_transit').prepend(newOptions);
   // Sélectionner l'option par défaut
   newOptions.prop('selected', true);
}
 $('#n_bl_transit').val(id_bl);




 var existingOptionDes = $('#des_douane option[value="' + des_douane + '"]');
if (existingOptionDes.length > 0) {
   // Mettre à jour le texte de l'option existante
   existingOptionDes.text(des_douane);
} else {
   // Ajouter une nouvelle option avec la valeur et le texte correspondants
   var newOptions = $('<option>', {
      value: des_douane,
      text: des_douane
   });
   $('#des_douane').prepend(newOptions);
   // Sélectionner l'option par défaut
   newOptions.prop('selected', true);
}
 $('#des_douane').val(des_douane);



		//$('#id_produit_tr').val(id_produit);
		$('#num_dec').val(num_dec);
		$('#poids_dec').val(poids_dec);
		$('#id_trans').val(id);
		$('#navire_transit').val(navire);
		
		
		
		$('#modif_transit').modal('toggle');
	});
		

	 $(document).on('click','a[data-role=save_transit]',function(){
	var num_dec=$('#num_dec').val();
	// var id_produit=$('#id_produit_tr').val();
	var poids_dec=$('#poids_dec').val();
	var id=$('#id_trans').val();
	var des_douane=$('#des_douane').val();
	var statut=$('#statut').val();
	var navire=$('#navire_transit').val();
  var bl=$('#n_bl_transit').val();

	
	$.ajax({
		url:'modifier_transit2.php',
		method:'post',
		data:{num_dec:num_dec,id:id,poids_dec:poids_dec,des_douane:des_douane,statut:statut,navire:navire,bl:bl},
		success: function(response){
			$('#partransit').html(response);
			/*$('#'+id).children('td[data-target=cales]').text(cale);
		$('#'+id).children('td[data-target=nom_chargeur]').text(ch);
		$('#'+id).children('td[data-target=conditionnement]').text(cond+' KGS');
		//$('#modif_dec').modal('toggle');*/
		$('#modif_transit').modal('toggle');
		}
	});

	});
});
</script>





<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('click','a[data-role=update_table_transit]',function(){
    var id=$(this).data('id');
    
    
   $('#val_id').val(id);
    
    
    
    
    $('#update_tab_transit').modal('toggle');
  });
    

   
});
</script>






<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('click','a[data-role=update_transitvrac]',function(){
			var id=$(this).data('id');
			var num_dec = $('#'+id +'numero_declarationvrac').text();
			var poids_dec = $('#'+id +'poids_declarervrac').text();
			var navire = $('#'+id +'navire_transvrac').text();
			var statut = $('#'+id +'statut_douanierevrac').text();
    var bl = $('#'+id +'bl_transitvrac').text();
    var id_bl = $('#'+id +'id_bl_transitvrac').text();
	
		
		
		poids_dec=poids_dec.replace(" ","");
		poids_dec=poids_dec.replace(",",".");
		
		var des_douane = $('#'+id +'destination_douanierevrac').text();
		
		






 var existingOptionDes = $('#des_douanev option[value="' + des_douane + '"]');
if (existingOptionDes.length > 0) {
   // Mettre à jour le texte de l'option existante
   existingOptionDes.text(des_douane);
} else {
   // Ajouter une nouvelle option avec la valeur et le texte correspondants
   var newOptions = $('<option>', {
      value: des_douane,
      text: des_douane
   });
   $('#des_douanev').prepend(newOptions);
   // Sélectionner l'option par défaut
   newOptions.prop('selected', true);
}
 $('#des_douanev').val(des_douane);


 var existingOptionDes = $('#n_bl_transitvrac option[value="' + id_bl + '"]');
if (existingOptionDes.length > 0) {
   // Mettre à jour le texte de l'option existante
   existingOptionDes.text(bl);
} else {
   // Ajouter une nouvelle option avec la valeur et le texte correspondants
   var newOptions = $('<option>', {
      value: id_bl,
      text: bl
   });
   $('#n_bl_transitvrac').prepend(newOptions);
   // Sélectionner l'option par défaut
   newOptions.prop('selected', true);
}
 $('#n_bl_transitvrac').val(id_bl);



 var existingOptionStatut = $('#statutv option[value="' + statut + '"]');
if (existingOptionStatut.length > 0) {
   // Mettre à jour le texte de l'option existante
   existingOptionStatut.text(statut);
} else {
   // Ajouter une nouvelle option avec la valeur et le texte correspondants
   var newOptions = $('<option>', {
      value: statut,
      text: statut
   });
   $('#statutv').prepend(newOptions);
   // Sélectionner l'option par défaut
   newOptions.prop('selected', true);
}

$('#statutv').val(statut); 




		$('#id_transv').val(id);
		$('#num_decv').val(num_dec);
		$('#poids_decv').val(poids_dec);
		$('#navire_transitv').val(navire);
		 
		
		$('#modif_transitv').modal('toggle');
	});
		

	$(document).on('click','a[data-role=save_transitvrac]',function(){
	var num_dec=$('#num_decv').val();
	// var id_produit=$('#id_produit_tr').val();
	var poids_dec=$('#poids_decv').val();
	var id=$('#id_transv').val();
	var des_douane=$('#des_douanev').val();
	var statut=$('#statutv').val();
	var navire=$('#navire_transitv').val();
  var bl=$('#n_bl_transitvrac').val();

	
	$.ajax({
		url:'modifier_transit2vrac.php',
		method:'post',
		data:{num_dec:num_dec,id:id,poids_dec:poids_dec,des_douane:des_douane,statut:statut,navire:navire,bl:bl},
		success: function(response){
			$('#partransit').html(response);
			/*$('#'+id).children('td[data-target=cales]').text(cale);
		$('#'+id).children('td[data-target=nom_chargeur]').text(ch);
		$('#'+id).children('td[data-target=conditionnement]').text(cond+' KGS');
		//$('#modif_dec').modal('toggle');*/
		$('#modif_transitv').modal('toggle');
		}
	});

	});
});
</script>





<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('click','a[data-role=update_vrac]',function(){
		var id=$(this).data('id');
		var cale=$('#'+id).children('td[data-target=cales_vrac]').text();
		var poids=$('#'+id).children('td[data-target=poids_vrac]').text();
		poids = poids.replace(' ', '');
		poids = poids.replace(',', '.');
		var navire=$('#'+id).children('td[data-target=navire_vrac]').text();
		var ch=$('#'+id).children('td[data-target=nom_chargeur_vrac]').text();
		var produit = $('#'+id).children('td[data-target=produit_vrac]').text();
var produitId = $('#'+id +'produit-id-vrac').text();
var produitText = $('#'+id).children('td[data-target=produit_vrac]').text();

var existingOption = $('#id_produit option[value="' + produitId + '"]');
if (existingOption.length > 0) {
   // Mettre à jour le texte de l'option existante
   existingOption.text(produitText);
} else {
   // Ajouter une nouvelle option avec la valeur et le texte correspondants
   var newOption = $('<option>', {
      value: produitId,
      text: produitText
   });
   $('#id_produit_vrac').prepend(newOption);
   // Sélectionner l'option par défaut
   newOption.prop('selected', true);
}
//$('#id_produit').val(produitId);




	
		$('#caleform_vrac').val(cale);
		$('#chform_vrac').val(ch);
		$('#iddec_vrac').val(id);

		$('#id_produit_vrac').val(produitId);
		
		$('#poids_vrac').val(poids);
		$('#navire_dc_vrac').val(navire);
		
		$('#modif_dec_vrac').modal('toggle');
	});
		

	$('#save_vrac').click(function(){
	var cale=$('#caleform_vrac').val();
	var ch=$('#chform_vrac').val();
	var id=$('#iddec_vrac').val();
	var produitId=$('#id_produit_vrac').val();
	var poids=$('#poids_vrac').val();
	var navire=$('#navire_dc_vrac').val();

	
	$.ajax({
		url:'modifier_declaration2_vrac.php',
		method:'post',
		data:{cale:cale,ch:ch,id:id,produitId:produitId,poids:poids,navire:navire},
		success: function(response){
			$('#parcale').html(response);
			/*$('#'+id).children('td[data-target=cales]').text(cale);
		$('#'+id).children('td[data-target=nom_chargeur]').text(ch);
		$('#'+id).children('td[data-target=conditionnement]').text(cond+' KGS');
		//$('#modif_dec').modal('toggle');*/
		$('#modif_dec_vrac').modal('toggle');
		}
	});

	});
});
</script>



<script type="text/javascript">


	$(document).ready(function(){
    $(document).on('click','a[data-role=update_dis]',function(){
        var id = $(this).data('id');
        var cond = $('#' + id+'conditionnement' ).text();
        var bl = $('#' + id+'bl_dis' ).text(); 
        var id_bl = $('#' + id+'id_bl_dis' ).text(); 
        var navire = $('#' + id+'navire_dis' ).text();
        var sac = $('#' + id+'sac_dis' ).text();
        var type_navire = $('#' + id+'type_navire' ).text();
           sac = sac.replace(' ', '');

          var idclient = $('#'+id+'id_client_dis').text();
        var client = $('#'+id+'cli_dis').text();
        var iddestidis = $('#'+id+'id_mg_dis').text();
        var destidis= $('#'+id+'mg_dis').text();
        var idproduitdis = $('#'+id+'id_prod_diss').text();
        var produitdis= $('#'+id+'prod_dis').text(); 
        var banquedis= $('#'+id+'banque_dis').text(); 
         var des_douane= $('#'+id+'des_douane_dis').text();
        var zero=0;

        var existingOptioncale = $('#produit_updiss option[value="' + idproduitdis + '"]');
if (existingOptioncale.length > 0) {
   // Mettre à jour le texte de l'option existante
   existingOptioncale.text(produitdis);
} else {
   // Ajouter une nouvelle option avec la valeur et le texte correspondants
   var newOption = $('<option>', {
      value: idproduitdis,
      text: produitdis
   });
   $('#produit_updiss').prepend(newOption);
   // Sélectionner l'option par défaut
   newOption.prop('selected', true);
} 
   
           $('#clientupdis').val(idclient);
        $('#destinationupdis').val(iddestidis);
        $('#produit_updiss').val(idproduitdis);
       
        
        $('#conditionnement_dis').val(idproduitdis);
        $('#sac_dis').val(sac);
        $('#bl_dis').val(bl);
        $('#navire_dis').val(navire);
        $('#type_nav').val(type_navire);
        $('#des_douane').val(des_douane);
       if (type_navire=='SACHERIE') {
        $('#visibilite_poids').css('display','none');
         $('#conditionnement_dis').val(zero);
       }
       
       
        $('#id_dis').val(id);
        
            $.ajax({
    url:'selection_des_poids_modifier.php',
    method:'post',
    data:{type_navire:type_navire},
    success: function(response){
      $('#poids_modif').html(response);
      /*$('#'+id).children('td[data-target=cales]').text(cale);
    $('#'+id).children('td[data-target=nom_chargeur]').text(ch);
    $('#'+id).children('td[data-target=conditionnement]').text(cond+' KGS');
    //$('#modif_dec').modal('toggle');*/
    $('#modif_dis').modal('toggle');
    }
  });
    });
    
    $(document).on('click','a[data-role=save_dis]',function(){
       var bl = $('#bl_dis').val();
       var sac = $('#sac_dis').val();
       var cond = $('#conditionnement_dis').val();
       var id = $('#id_dis').val();
       var navire = $('#navire_dis').val();

        var client =$('#clientupdis').val();
        var destination= $('#destinationupdis').val();
        var produit= $('#produit_updiss').val();
        var banquedis= $('#banqueupdis').val();
        var type_nav=$('#type_nav').val();
        var des_douane=$('#des_douane').val();

        
        $.ajax({
		url:'modifier_bl.php',
		method:'post',
		data:{bl:bl,sac:sac,cond:cond,id:id,navire:navire,client:client,produit:produit,destination:destination,banquedis:banquedis,type_nav:type_nav,des_douane:des_douane},
		success: function(response){
			$('#parconnaissement').html(response);
			/*$('#'+id).children('td[data-target=cales]').text(cale);
		$('#'+id).children('td[data-target=nom_chargeur]').text(ch);
		$('#'+id).children('td[data-target=conditionnement]').text(cond+' KGS');
		//$('#modif_dec').modal('toggle');*/
		$('#modif_dis').modal('toggle');
		}
	});
    });
});

</script>


<script type="text/javascript">


  $(document).ready(function(){
    $(document).on('click','a[data-role=update_disvrac]',function(){
        var id = $(this).data('id');
        var cond = $('#' + id+'conditionnementvrac' ).text();
        var bl = $('#' + id+'bl_disvrac' ).text(); 
        var navire = $('#' + id+'id_navirevrac' ).text();
        var poids = $('#' + id+'poids_disvrac' ).text();
           poids = poids.replace(' ', '');

          var idclient = $('#'+id+'id_client_disvrac').text();
        var client = $('#'+id+'cli_disvrac').text();
        var iddestidis = $('#'+id+'id_mg_disvrac').text();
        var destidis= $('#'+id+'mg_disvrac').text();
        var idproduitdis = $('#'+id+'id_prod_disvrac').text();
        var produitdis= $('#'+id+'prod_disvrac').text(); 
        var banquedis= $('#'+id+'banque_disvrac').text(); 


          var existingOption = $('#clientupdisv option[value="' + idclient+ '"]');
if (existingOption.length > 0) {
   // Mettre à jour le texte de l'option existante
   existingOption.text(client);
} else {
   // Ajouter une nouvelle option avec la valeur et le texte correspondants
   var newOption = $('<option>', {
      value: idclient,
      text: client
   });
   $('#clientupdisv').prepend(newOption);
   // Sélectionner l'option par défaut
   newOption.prop('selected', true);
}

         var existingOption = $('#banqueupdisv option[value="' + banquedis+ '"]');
if (existingOption.length > 0) {
   // Mettre à jour le texte de l'option existante
   existingOption.text(banquedis);
} else {
   // Ajouter une nouvelle option avec la valeur et le texte correspondants
   var newOption = $('<option>', {
      value: banquedis,
      text: banquedis
   });
   $('#banqueupdisv').prepend(newOption);
   // Sélectionner l'option par défaut
   newOption.prop('selected', true);
}

        var existingOptiondesti = $('#destinationupdisv option[value="' + iddestidis+ '"]');
if (existingOptiondesti.length > 0) {
   // Mettre à jour le texte de l'option existante
   existingOptiondesti.text(destidis);
} else {
   // Ajouter une nouvelle option avec la valeur et le texte correspondants
   var newOption = $('<option>', {
      value: iddestidis,
      text: destidis
   });
   $('#destinationupdisv').prepend(newOption);
   // Sélectionner l'option par défaut
   newOption.prop('selected', true);
}


       var existingOptionpdis = $('#produitclientupdisv option[value="' + idproduitdis+ '"]');
if (existingOptionpdis.length > 0) {
   // Mettre à jour le texte de l'option existante
   existingOptionpdis.text(produitdis);
} else {
   // Ajouter une nouvelle option avec la valeur et le texte correspondants
   var newOption = $('<option>', {
      value: idproduitdis,
      text: produitdis
   });
   $('#produitclientupdisv').prepend(newOption);
   // Sélectionner l'option par défaut
   newOption.prop('selected', true);
}
   
           $('#clientupdisv').val(idclient);
        $('#destinationupdisv').val(iddestidis);
        $('#produitclientupdisv').val(idproduitdis);
       
        
        $('#conditionnement_disv').val(cond);
        $('#poids_disv').val(poids);
        $('#bl_disv').val(bl);
        $('#navire_disv').val(navire);
       
       
       
       
        $('#id_disv').val(id);
        
        $('#modif_disvrac').modal('toggle');
    });
    
    $('#save_disvrac').click(function(){
       var bl = $('#bl_disv').val();
       var poids = $('#poids_disv').val();
       var cond = $('#conditionnement_disv').val();
       var id = $('#id_disv').val();
       var navire = $('#navire_disv').val();

        var client =$('#clientupdisv').val();
        var destination= $('#destinationupdisv').val();
        var produit= $('#produitclientupdisv').val();
        var banquedis= $('#banqueupdisv').val();
        

        
        $.ajax({
    url:'modifier_bl_vrac.php',
    method:'post',
    data:{bl:bl,poids:poids,cond:cond,id:id,navire:navire,client:client,produit:produit,destination:destination,banquedis:banquedis},
    success: function(response){
      $('#parbl').html(response);
      /*$('#'+id).children('td[data-target=cales]').text(cale);
    $('#'+id).children('td[data-target=nom_chargeur]').text(ch);
    $('#'+id).children('td[data-target=conditionnement]').text(cond+' KGS');
    //$('#modif_dec').modal('toggle');*/
    $('#modif_disvrac').modal('toggle');
    }
  });
    });
});

</script>



<script type="text/javascript">


	$(document).ready(function(){
    $(document).on('click','a[data-role=update_disclient]',function(){
        var id = $(this).data('id');
        //ID DU TRANSPORTEUR
        
        var idclient = $('#'+id+'idclientdiscol').text();
        var client = $('#'+id+'clientdis').text();
        var iddestidis = $('#'+id+'iddestidis').text();
        var destidis= $('#'+id+'destidis').text();
        var idproduitdis = $('#'+id+'idproduitdis').text();
        var produitdis= $('#'+id+'produitdis').text();
        var condidis= $('#'+id+'condidis').text();
        var navire= $('#'+id+'navdis').text();
        var n_bl= $('#'+id+'n_bl_dis').text();

        var sac= $('#'+id+'sacsdis').text();
        sac = sac.replace(' ', '');
        //NOM DU TRANSPORTEUzR
        

        var existingOption = $('#clientdis option[value="' + idclient+ '"]');
if (existingOption.length > 0) {
   // Mettre à jour le texte de l'option existante
   existingOption.text(client);
} else {
   // Ajouter une nouvelle option avec la valeur et le texte correspondants
   var newOption = $('<option>', {
      value: idclient,
      text: client
   });
   $('#clientdis').prepend(newOption);
   // Sélectionner l'option par défaut
   newOption.prop('selected', true);
}

        var existingOptiondesti = $('#destinationdis option[value="' + iddestidis+ '"]');
if (existingOptiondesti.length > 0) {
   // Mettre à jour le texte de l'option existante
   existingOptiondesti.text(destidis);
} else {
   // Ajouter une nouvelle option avec la valeur et le texte correspondants
   var newOption = $('<option>', {
      value: iddestidis,
      text: destidis
   });
   $('#destinationdis').prepend(newOption);
   // Sélectionner l'option par défaut
   newOption.prop('selected', true);
}


       var existingOptionpdis = $('#produitclientdis option[value="' + idproduitdis+ '"]');
if (existingOptionpdis.length > 0) {
   // Mettre à jour le texte de l'option existante
   existingOptionpdis.text(produitdis);
} else {
   // Ajouter une nouvelle option avec la valeur et le texte correspondants
   var newOption = $('<option>', {
      value: idproduitdis,
      text: produitdis
   });
   $('#produitclientdis').prepend(newOption);
   // Sélectionner l'option par défaut
   newOption.prop('selected', true);
}
   

        //$('#m_trans_cam').val(id_tr);
        $('#clientdis').val(idclient);
        $('#destinationdis').val(iddestidis);
        $('#produitclientdis').val(idproduitdis);
        $('#conditionnedis').val(condidis);
        $('#sacclientdis').val(sac);
        $('#naviredis').val(navire);
        $('#idclientdis').val(id);
        $('#nbl_dis').val(n_bl);
        
        $('#modif_disclient').modal('toggle');
    });
    
    $('#save_client_dis').click(function(){
    	
        var client = $('#clientdis').val();
        var destination=$('#destinationdis').val();
         var produit = $('#produitclientdis').val();
          var cond = $('#conditionnedis').val();
           var sac = $('#sacclientdis').val();
            var navire = $('#naviredis').val();
            var n_bl = $('#nbl_dis').val();
     
            var id = $('#idclientdis').val();
        

        
        $.ajax({
		url:'modifier_clientdis.php',
		method:'post',
		data:{client:client,destination:destination,produit:produit,cond:cond,sac:sac,navire:navire,n_bl:n_bl,id:id},
		success: function(response){
			$('#parclient').html(response);
			/*$('#'+id).children('td[data-target=cales]').text(cale);
		$('#'+id).children('td[data-target=nom_chargeur]').text(ch);
		$('#'+id).children('td[data-target=conditionnement]').text(cond+' KGS');
		//$('#modif_dec').modal('toggle');*/
		$('#modif_disclient').modal('toggle');
		}
	});
    });
});

</script>







<script type="text/javascript">


	$(document).ready(function(){
    $(document).on('click','a[data-role=update_disclientvrac]',function(){
        var id = $(this).data('id');
        //ID DU TRANSPORTEUR
        
        var idclient = $('#'+id+'idclientdiscolvrac').text();
        var client = $('#'+id+'clientdisvrac').text();
        
        var iddestidis = $('#'+id+'iddestidisvrac').text();
        var destidis= $('#'+id+'destidisvrac').text();
        var idproduitdis = $('#'+id+'idproduitdisvrac').text();
        var produitdis= $('#'+id+'produitdisvrac').text();
        var condidis= $('#'+id+'condidisvrac').text();
        var navire= $('#'+id+'navdisvrac').text();
        var n_bl= $('#'+id+'n_bl_disvrac').text();

        var sac= $('#'+id+'poidsdisvrac').text();
        sac = sac.replace(' ', '');
        //NOM DU TRANSPORTEUzR
       

        var existingOption = $('#clientdisv option[value="' + idclient+ '"]');
if (existingOption.length > 0) {
   // Mettre à jour le texte de l'option existante
   existingOption.text(client);
} else {
   // Ajouter une nouvelle option avec la valeur et le texte correspondants
   var newOption = $('<option>', {
      value: idclient,
      text: client
   });
   $('#clientdisv').prepend(newOption);
   // Sélectionner l'option par défaut
   newOption.prop('selected', true);
} 



        var existingOptiondesti = $('#destinationdisv option[value="' + iddestidis+ '"]');
if (existingOptiondesti.length > 0) {
   // Mettre à jour le texte de l'option existante
   existingOptiondesti.text(destidis);
} else {
   // Ajouter une nouvelle option avec la valeur et le texte correspondants
   var newOption = $('<option>', {
      value: iddestidis,
      text: destidis
   });
   $('#destinationdisv').prepend(newOption);
   // Sélectionner l'option par défaut
   newOption.prop('selected', true);
} 


       var existingOptionpdis = $('#produitclientdisv option[value="' + idproduitdis+ '"]');
if (existingOptionpdis.length > 0) {
   // Mettre à jour le texte de l'option existante
   existingOptionpdis.text(produitdis);
} else {
   // Ajouter une nouvelle option avec la valeur et le texte correspondants
   var newOption = $('<option>', {
      value: idproduitdis,
      text: produitdis
   });
   $('#produitclientdisv').prepend(newOption);
   // Sélectionner l'option par défaut
   newOption.prop('selected', true);
}
  

       
       
        $('#destinationdisv').val(iddestidis);
        $('#produitclientdisv').val(idproduitdis);
        $('#conditionnedisv').val(condidis);
        $('#poidsclientdisv').val(sac);
        $('#naviredisv').val(navire);
        $('#idclientdisv').val(id);
        $('#nbl_disv').val(n_bl);
        $('#clientdisv').val(idclient);
        
        $('#modif_disclientvrac').modal('toggle');
    });
    
    $('#save_client_disvrac').click(function(){
    	
        var client = $('#clientdisv').val();

        var destination=$('#destinationdisv').val();
         var produit = $('#produitclientdisv').val();
          var cond = $('#conditionnedisv').val();
           var sac = $('#poidsclientdisv').val();
           sac=sac.replace(" ","");
            var navire = $('#naviredisv').val();
            var n_bl = $('#nbl_disv').val();
     
            var id = $('#idclientdisv').val();
        

        
        $.ajax({
		url:'modifier_clientdisvrac.php',
		method:'post',
		data:{client:client,destination:destination,produit:produit,cond:cond,sac:sac,navire:navire,n_bl:n_bl,id:id},
		success: function(response){
			$('#parclient').html(response);
			/*$('#'+id).children('td[data-target=cales]').text(cale);
		$('#'+id).children('td[data-target=nom_chargeur]').text(ch);
		$('#'+id).children('td[data-target=conditionnement]').text(cond+' KGS');
		//$('#modif_dec').modal('toggle');*/
		$('#modif_disclientvrac').modal('toggle');
		}
	});
    });
});

</script>
<script type="text/javascript">
	function visibleBtn(){
		var btn=document.getElementById("btn_pre_deb");
		btn.style.display="table";

	}
</script>

<script type="text/javascript">
	function visibleCargoPlan(){
		var cargo_plan=document.getElementById("fetch_cargo_plan");
		cargo_plan.style.display="table";

	}
</script>

<style>
  #b {
    visibility: hidden;
  }
</style>


<script type="text/javascript">
  
    $(document).ready(function () {
        $(document).on('click', 'a[data-role=imprimer_par_cale]', function () {
            var contentToPrint = $('#table_bl').html();
            var printWindow = window.open('', '_blank');
             var cssLink = '<link rel="stylesheet" type="text/css" href="css/imprimer.css">';
             var cssLink2 = '<link rel="stylesheet" type="text/css" href="../assets/modules/bootstrap-5.1.3/css/bootstrap.css">';
        printWindow.document.write('<html><head><title>Impression</title>' + cssLink + cssLink2 + '</head><body>' + contentToPrint + '</body></html>');
           // printWindow.document.write('<html><head><title>Impression</title></head><body>' + contentToPrint + '</body></html>');
            printWindow.document.close();
            printWindow.print(); 
        });
    }); 
</script>

<script type="text/javascript">
  
    $(document).ready(function () {
        $(document).on('click', 'a[data-role=imprimer_par_produit]', function () {
            var contentToPrint = $('#tab_par_produit').html();
            var printWindow = window.open('', '_blank');
             var cssLink = '<link rel="stylesheet" type="text/css" href="css/imprimer.css">';
             var cssLink2 = '<link rel="stylesheet" type="text/css" href="../assets/modules/bootstrap-5.1.3/css/bootstrap.css">';
        printWindow.document.write('<html><head><title>Impression</title>' + cssLink + cssLink2 + '</head><body>' + contentToPrint + '</body></html>');
           // printWindow.document.write('<html><head><title>Impression</title></head><body>' + contentToPrint + '</body></html>');
            printWindow.document.close();
            printWindow.print(); 
        });
    }); 
</script>

<script type="text/javascript">
  
    $(document).ready(function () {
        $(document).on('click', 'a[data-role=imprimer_par_connaissement]', function () {
            var contentToPrint = $('#tab_par_connaissement').html();
            var printWindow = window.open('', '_blank');
             var cssLink = '<link rel="stylesheet" type="text/css" href="css/imprimer.css">';
             var cssLink2 = '<link rel="stylesheet" type="text/css" href="../assets/modules/bootstrap-5.1.3/css/bootstrap.css">';
        printWindow.document.write('<html><head><title>Impression</title>' + cssLink + cssLink2 + '</head><body>' + contentToPrint + '</body></html>');
           // printWindow.document.write('<html><head><title>Impression</title></head><body>' + contentToPrint + '</body></html>');
            printWindow.document.close();
            printWindow.print(); 
        });
    }); 
</script>

<script type="text/javascript">
  
    $(document).ready(function () {
        $(document).on('click', 'a[data-role=imprimer_par_client]', function () {
            var contentToPrint = $('#tab_par_client').html();
            var printWindow = window.open('', '_blank');
             var cssLink = '<link rel="stylesheet" type="text/css" href="css/imprimer.css">';
             var cssLink2 = '<link rel="stylesheet" type="text/css" href="../assets/modules/bootstrap-5.1.3/css/bootstrap.css">';
        printWindow.document.write('<html><head><title>Impression</title>' + cssLink + cssLink2 + '</head><body>' + contentToPrint + '</body></html>');
           // printWindow.document.write('<html><head><title>Impression</title></head><body>' + contentToPrint + '</body></html>');
            printWindow.document.close();
            printWindow.print(); 
        });
    }); 
</script>

<script type="text/javascript">
  
    $(document).ready(function () {
        $(document).on('click', 'a[data-role=imprimer_par_destination]', function () {
            var contentToPrint = $('#tab_par_destination').html();
            var printWindow = window.open('', '_blank');
             var cssLink = '<link rel="stylesheet" type="text/css" href="css/imprimer.css">';
             var cssLink2 = '<link rel="stylesheet" type="text/css" href="../assets/modules/bootstrap-5.1.3/css/bootstrap.css">';
        printWindow.document.write('<html><head><title>Impression</title>' + cssLink + cssLink2 + '</head><body>' + contentToPrint + '</body></html>');
           // printWindow.document.write('<html><head><title>Impression</title></head><body>' + contentToPrint + '</body></html>');
            printWindow.document.close();
            printWindow.print(); 
        });
    }); 
</script>


 </body>
</html>
