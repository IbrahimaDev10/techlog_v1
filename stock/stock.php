<?php
require('../database.php');
if(empty($_SESSION['id'])){
  header('location:../index.php');
}
//header("Cache-Control: no-cache, must-revalidate");
//header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

$naviress=$bdd->prepare("select * from navire_deb order by navire asc");
$naviress->execute();

$entrepots=$bdd->prepare("select * from mangasin order by mangasin asc");
$entrepots->execute();

$clients=$bdd->prepare("select * from client");
$clients->execute();

$currentDate = date('d-m-Y');
?>	



<!DOCTYPE html>
<html lang="fr">
  <head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
   


	<title>Gestion des stocks</title>

	<!-- Bootstrap CSS-->
    
  <link rel="stylesheet" href="../assets/modules/bootstrap-5.1.3/css/bootstrap.css">
  <!-- Style CSS -->
  <link rel="stylesheet" href="../transfert/css/style.css">
  <link rel="stylesheet" href="assets/css/stylecell.css">
   <link rel="stylesheet" href="../assets/css/repAccueil.css">
  <!-- FontAwesome CSS-->
  <link rel="stylesheet" href="../assets/modules/fontawesome6.1.1/css/all.css">
  <!-- Boxicons CSS-->
  <link rel="stylesheet" href="assets/modules/boxicons/css/boxicons.min.css">
  <!-- Apexcharts  CSS -->
  <link rel="stylesheet" href="../assets/modules/apexcharts/apexcharts.css">
    <link rel="shortcut icon" type="image/png" href="../assets/images/mylogo.ico"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="btn.css">
    <link rel="stylesheet" href="stock.css">

</head>
<body >
<style type="text/css">
	
.lienforme{
color:white; font-size: 20px; border: solid; background-color: black; margin-bottom: 50px;

}

 *{
  font-family: Times New Roman;
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
      height: 150px;
    }

    .fabtn1{
  border: none;
   margin-right: 3px;
  color:rgb(0,141,202);
  text-align: center;


 }
 .btn1{
  background: linear-gradient(to bottom, blue, #1B2B65); background: linear-gradient(to left, blue, #1B2B65); background: linear-gradient(to top, blue, #1B2B65);
  text-align: center;

 }
    
 .logoo{

      border-radius: 50px;
       height: 120px;
        width: 200px;
        float: right;
        z-index: 2;
        text-align: center;

    }
    #perreur{
        color:red;
        font-weight: bold;
    }
    .err{
        width: 500px;
        height: 250px;
        background: white;
        vertical-align: middle;
    }
    #close_erreur{
        font-size: 30px;
    }
    .fa-truck{
 float: left;
  font-size: 18px;
color: white;
vertical-align: middle;
display: flex; 
margin-right: 5px;
}
#mangasinOption{
  color: red;

}
#lesInfos{
  color: red;

}
#lesInfos2{
  color: black;

}
#soustotal{
  color: white;
}
.sain{
  background: yellow;
}
#EnteteRecapStockDep{
  background: black;
  color: white;
  text-align: center;
  vertical-align: middle;
  font-size: 12px;
}
.celrecap{
  text-align: center !important;
  vertical-align: middle !important;
}
.titre_recap{
  
  width: 100%;
  font-size: 20px;

 
}
#div_recap{
  background: white;
 
 
  border: solid;
  border-color: blue;
/*  border-bottom-right-radius: 30%;
  border-bottom-left-radius: 30%; */
  border-radius: 45%;
}
#RecapStockDep{
  background: blue;
  color: white;
  text-align: center;
  vertical-align: middle;
  font-size: 16px;
}
   

@media (max-width: 1200px){
.tr_data_attente_avaries{
 font-size:10px;
}
}

#th_table_rec{
      background: linear-gradient(to bottom, blue, rgb(0,141,202));
       text-align: center; 
        color: white;
         font-weight: bold;
         font-size:12px;
         vertical-align: middle;

    }
    .tr_data_sain{
  text-align: center;
    vertical-align: middle;
    font-size: 14px !important;
}
.LesOperations{
  background:rgb(0,162,232);
  border: solid;
  border-radius: 40px;

}
.TitreOperation{
  color: white !important;
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
					<a href="../star_superviseur.php" class="active">
						<i class='bx bxs-dashboard icon' ></i> MENU PRINCIPAL
					</a>
                 <?php include('../reception/page.php'); ?>
				</li>

				<!-- Divider-->
                <li class="divider" style="font-size: 18px;" data-text="STARTER">
                    <a href="stock.php">
                        <i class='bx bx-columns icon' ></i> 
                        GESTION DES STOCKS
                        <i class='bx bx-chevron-right icon-right' ></i>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <i class='bx bx-columns icon' ></i> 
                        GESTION DES RELACHES
                        <i class='bx bx-chevron-right icon-right' ></i>
                    </a>
                    <ul class="side-dropdown">
                       
                        
                                                
                    </ul>
                </li>

                       <li> <a style="font-size:12px;"  data-bs-toggle="modal" data-bs-target="#situation_24h">
                        <i class='bx bx-columns icon'  ></i>GESTION DES BONS D'ENLEVEMENT 
                       </a>
                    
                   </li>

                    <li> <a style="font-size:12px;" href="pv_reception.php?id=<?php echo $_GET['id']; ?>">
                        <i class='bx bx-columns icon'  ></i>RECONDITIONNEMENT
                       </a>
                    
                   </li>
                   

                    <li><a   href="situation_de_reception.php?id=<?php echo $_GET['id']; ?>"> <i class='bx bx-columns icon' ></i> MES SITUATIONS</a></li>
                     <li><a   href="reconditionnement.php?id=<?php echo $_SESSION['id']; ?>"> <i class='bx bx-columns icon' ></i> PV DE LIVRAISON</a></li>
                    </a>
                    
                       

 
 


				
               

				<!-- Divider-->
       </div> 
	 </div>
	</div><!-- End Sidebar-->


	<div class="sidebar-overlay"></div>


	<!--Content Start-->
	<div class="content-start transition">
		<div class="container-fluid dashboard">
			<div class="content-header">
                <div class="container-fluid1 " id="situation"  style=" background: rgb(0,141,202);" >
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <h1 class="hem2" > GESTION DE STOCK</h1><br>
                                <button class="btn btn-primary btnGestionDeStock" onclick="afficheDivEntrepot()">
                                    SITUATION DES <br>ENTREPOTS
                                </button>
                                <button class="btn btn-primary btnGestionDeStock" onclick="afficheDivNavire()">
                                    SITUATION DES <br>NAVIRES
                                </button>
                                <button class="btn btn-primary btnGestionDeStock" onclick="afficheDivClient()">
                                    SITUATION DES <br>RECEPTIONNAIRES
                                </button>
                                <button class="btn btn-primary btnGestionDeStock" onclick="afficheDivRelache()">
                                    SITUATION DES <br>RELACHES
                                </button>
                                <button class="btn btn-primary btnGestionDeStock" onclick="afficheDivBanque()">
                                    SITUATION DES <br>BANQUES
                                </button> 
                                <button class="btn btn-primary btnGestionDeStock">
                                    SITUATION DE <br>TRANSIT
                                </button>  
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12" id="divEntrepotStock">
                    <h1 class="titreStockGlobal">SITUATION DES ENTREPOTS</h1><br>
                    <div class="formStock">
                        <button id="globalButton" onclick="goEntrepotGlobal()" class="btn btn-primary btnGestionDeStockEntrepot">
                           SITUATION GLOBALE
                        </button>
                        <span id="choixEntrepot">CHOISIR UN ENTREPOT :</span>
                        <input type="text" id="entrepotChoisi"  placeholder="ENTREPOT" onkeyup="filtreEntrepot()" autocomplete="off">
                        <div id="entrepotSelection"></div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12" id="divNavireStock">
                    <h1 class="titreStockGlobal">SITUATION DES NAVIRES</h1><br>
                    <div class="formStock">
                        <button id="globalButton" onclick="goNavireGlobal()" class="btn btn-primary btnGestionDeStockEntrepot">
                           SITUATION GLOBALE
                        </button>
                        <span id="choixNavire">CHOISIR UN NAVIRE :</span>
                        <input type="text" id="navireChoisi"  placeholder="NAVIRE" oninput="filtreNavire()" autocomplete="off">
                        <div id="navireSelection"></div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12" id="divClientStock">
                    <h1 class="titreStockGlobal">SITUATION DES RECEPTIONNAIRES</h1><br>
                    <div class="formStock">
                        <button id="globalButton" onclick="goClientGlobal()" class="btn btn-primary btnGestionDeStockEntrepot">
                           SITUATION GLOBALE
                        </button>
                        <span id="choixClient">CHOISIR UN RECEPTIONNAIRE :</span>
                        <input type="text" id="clientChoisi"  placeholder="RECEPTIONNAIRE" oninput="filtreClient()" autocomplete="off">
                        <div id="clientSelection"></div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12" id="divRelacheStock">
                    <h1 class="titreStockGlobal">SITUATION DES RELACHES</h1><br>
                    <div class="formStock">
                        <button id="globalButton" onclick="goRelacheGlobal()" class="btn btn-primary btnGestionDeStockEntrepot">
                           SITUATION GLOBALE
                        </button>
                        <span id="choixRelache">CHOISIR UN RECEPTIONNAIRE :</span>
                        <input type="text" id="relacheChoisi"  placeholder="RECEPTIONNAIRE" oninput="filtreRelache()" autocomplete="off">
                        <div id="relacheSelection"></div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12" id="divBanqueStock">
                    <h1 class="titreStockGlobal">SITUATION DES BANQUES</h1><br>
                    <div class="formStock">
                        <button id="globalButton" onclick="goBanqueGlobal()" class="btn btn-primary btnGestionDeStockEntrepot">
                           SITUATION GLOBALE
                        </button>
                        <span id="choixBanque">CHOISIR UNE BANQUE :</span>
                        <input type="text" id="banqueChoisi"  placeholder="BANQUE" oninput="filtreBanque()" autocomplete="off">
                        <div id="banqueSelection"></div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12" id="divTransitStock">
                    <h1 class="titreStockGlobal">SITUATION TRANSIT DE SIMAR DU <?php echo $currentDate; ?> </h1><br>
                    <div class="formStock">
                        <button id="globalButton" onclick="goTransitGlobal()" class="btn btn-primary btnGestionDeStockEntrepot">
                           SITUATION GLOBALE
                        </button>
                        <span id="choixTransit">CHOISIR UN RECEPTIONNAIRE :</span>
                        <input type="text" id="transitChoisi"  placeholder="RECEPTIONNAIRE" oninput="filtreTransit()" autocomplete="off">
                        <div id="transitSelection"></div>
                    </div>
                </div>
            </div>       
        </div>
        <div id="gestionDeStockEntrepotGlobal"></div>
        <div id="gestionDeStockEntrepot"></div>   
        <div id="gestionDeStockNavireGlobal"></div>
        <div id="gestionDeStockNavire"></div>  
        <div id="gestionDeStockClientGlobal"></div>
        <div id="gestionDeStockClient"></div>
        <div id="gestionDeStockBanqueGlobal"></div>
        <div id="gestionDeStockBanque"></div>  
        <div id="gestionDeStockRelacheGlobal"></div>
        <div id="gestionDeStockRelache"></div>
        <div id="gestionDeStockTransitGlobal"></div>
        <div id="gestionDeStockTransit"></div>      
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
   
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

 
   
<!-- fonction d'affichage de la situation des entrepots-->
<script type='text/javascript'>    
    function afficheDivEntrepot () {
        document.getElementById("divEntrepotStock").style.display='block';
        document.getElementById("divNavireStock").style.display='none';
        document.getElementById("divClientStock").style.display='none';
        document.getElementById("divBanqueStock").style.display='none';
        document.getElementById("divRelacheStock").style.display='none';
        document.getElementById("divTransitStock").style.display='none';
        document.getElementById("gestionDeStockNavireGlobal").style.display='none';
        document.getElementById("gestionDeStockNavire").style.display='none';
        document.getElementById("gestionDeStockClientGlobal").style.display='none';
        document.getElementById("gestionDeStockClient").style.display='none';
        document.getElementById("gestionDeStockBanqueGlobal").style.display='none';
        document.getElementById("gestionDeStockBanque").style.display='none';
        document.getElementById("gestionDeStockRelacheGlobal").style.display='none';
        document.getElementById("gestionDeStockRelache").style.display='none';
        document.getElementById("gestionDeStockTransitGlobal").style.display='none';
        document.getElementById("gestionDeStockTransit").style.display='none';
        document.getElementById("entrepotChoisi").value='';
    }
</script>

<!-- fonction d'affichage de la situation des navires -->
<script type='text/javascript'>    
    function afficheDivNavire () {
        document.getElementById("divNavireStock").style.display='block';
        document.getElementById("divEntrepotStock").style.display='none';
        document.getElementById("divClientStock").style.display='none';
        document.getElementById("divBanqueStock").style.display='none';
        document.getElementById("divRelacheStock").style.display='none';
        document.getElementById("divTransitStock").style.display='none';
        document.getElementById("gestionDeStockEntrepotGlobal").style.display='none';
        document.getElementById("gestionDeStockEntrepot").style.display='none';
        document.getElementById("gestionDeStockClientGlobal").style.display='none';
        document.getElementById("gestionDeStockClient").style.display='none';
        document.getElementById("gestionDeStockBanqueGlobal").style.display='none';
        document.getElementById("gestionDeStockBanque").style.display='none';
        document.getElementById("gestionDeStockRelacheGlobal").style.display='none';
        document.getElementById("gestionDeStockRelache").style.display='none';
        document.getElementById("gestionDeStockTransitGlobal").style.display='none';
        document.getElementById("gestionDeStockTransit").style.display='none';
        document.getElementById("navireChoisi").value='';
    }
</script>

<!-- fonction d'affichage de la situation des clients -->
<script type='text/javascript'>    
    function afficheDivClient () {
        document.getElementById("divClientStock").style.display='block';
        document.getElementById("divEntrepotStock").style.display='none';
        document.getElementById("divNavireStock").style.display='none';
        document.getElementById("divBanqueStock").style.display='none';
        document.getElementById("divRelacheStock").style.display='none';
        document.getElementById("divTransitStock").style.display='none';
        document.getElementById("gestionDeStockNavireGlobal").style.display='none';
        document.getElementById("gestionDeStockNavire").style.display='none';
        document.getElementById("gestionDeStockEntrepotGlobal").style.display='none';
        document.getElementById("gestionDeStockEntrepot").style.display='none';
        document.getElementById("gestionDeStockBanqueGlobal").style.display='none';
        document.getElementById("gestionDeStockBanque").style.display='none';
        document.getElementById("gestionDeStockRelacheGlobal").style.display='none';
        document.getElementById("gestionDeStockRelache").style.display='none';
        document.getElementById("gestionDeStockTransitGlobal").style.display='none';
        document.getElementById("gestionDeStockTransit").style.display='none';
        document.getElementById("clientChoisi").value='';
    }
</script>

<!-- fonction d'affichage de la situation des banques -->
<script type='text/javascript'>    
    function afficheDivBanque () {
        document.getElementById("divBanqueStock").style.display='block';
        document.getElementById("divRelacheStock").style.display='none';
        document.getElementById("divClientStock").style.display='none';
        document.getElementById("divEntrepotStock").style.display='none';
        document.getElementById("divNavireStock").style.display='none';
        document.getElementById("divTransitStock").style.display='none';
        document.getElementById("gestionDeStockNavireGlobal").style.display='none';
        document.getElementById("gestionDeStockNavire").style.display='none';
        document.getElementById("gestionDeStockEntrepotGlobal").style.display='none';
        document.getElementById("gestionDeStockEntrepot").style.display='none';
        document.getElementById("gestionDeStockClientGlobal").style.display='none';
        document.getElementById("gestionDeStockClient").style.display='none';
        document.getElementById("gestionDeStockRelacheGlobal").style.display='none';
        document.getElementById("gestionDeStockRelache").style.display='none';
        document.getElementById("gestionDeStockTransitGlobal").style.display='none';
        document.getElementById("gestionDeStockTransit").style.display='none';
        document.getElementById("banqueChoisi").value='';
    }
</script>

<!-- fonction d'affichage de la situation des relaches -->
<script type='text/javascript'>    
    function afficheDivRelache () {
        document.getElementById("divRelacheStock").style.display='block';
        document.getElementById("divBanqueStock").style.display='none';
        document.getElementById("divClientStock").style.display='none';
        document.getElementById("divEntrepotStock").style.display='none';
        document.getElementById("divNavireStock").style.display='none';
        document.getElementById("divTransitStock").style.display='none';
        document.getElementById("gestionDeStockNavireGlobal").style.display='none';
        document.getElementById("gestionDeStockNavire").style.display='none';
        document.getElementById("gestionDeStockEntrepotGlobal").style.display='none';
        document.getElementById("gestionDeStockEntrepot").style.display='none';
        document.getElementById("gestionDeStockClientGlobal").style.display='none';
        document.getElementById("gestionDeStockClient").style.display='none';
        document.getElementById("gestionDeStockBanqueGlobal").style.display='none';
        document.getElementById("gestionDeStockBanque").style.display='none';
        document.getElementById("gestionDeStockTransitGlobal").style.display='none';
        document.getElementById("gestionDeStockTransit").style.display='none';
        document.getElementById("relacheChoisi").value='';
    }
</script>

<!-- fonction d'affichage de la situation de transit -->
<script type='text/javascript'>    
    function afficheDivTransit () {
        document.getElementById("divTransitStock").style.display='block';
        document.getElementById("divRelacheStock").style.display='none';
        document.getElementById("divBanqueStock").style.display='none';
        document.getElementById("divClientStock").style.display='none';
        document.getElementById("divEntrepotStock").style.display='none';
        document.getElementById("divNavireStock").style.display='none';
        document.getElementById("gestionDeStockNavireGlobal").style.display='none';
        document.getElementById("gestionDeStockNavire").style.display='none';
        document.getElementById("gestionDeStockEntrepotGlobal").style.display='none';
        document.getElementById("gestionDeStockEntrepot").style.display='none';
        document.getElementById("gestionDeStockClientGlobal").style.display='none';
        document.getElementById("gestionDeStockClient").style.display='none';
        document.getElementById("gestionDeStockBanqueGlobal").style.display='none';
        document.getElementById("gestionDeStockBanque").style.display='none';
        document.getElementById("gestionDeStockRelacheGlobal").style.display='none';
        document.getElementById("gestionDeStockRelache").style.display='none';
        document.getElementById("relacheChoisi").value='';
    }
</script>

<!-- Situation par entrepôt -->
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

    function goEntrepot(){
        document.getElementById("gestionDeStockEntrepot").style.display='block';
        document.getElementById("gestionDeStockEntrepotGlobal").style.display='none';
        document.getElementById("gestionDeStockNavireGlobal").style.display='none';
        document.getElementById("gestionDeStockNavire").style.display='none';
        document.getElementById("gestionDeStockClientGlobal").style.display='none';
        document.getElementById("gestionDeStockClient").style.display='none';
        document.getElementById("gestionDeStockBanque").style.display='none';
        document.getElementById("gestionDeStockBanqueGlobal").style.display='none';
        document.getElementById("gestionDeStockTransitGlobal").style.display='none';
        document.getElementById("gestionDeStockTransit").style.display='none';
        document.getElementById("gestionDeStockRelache").style.display='none';
        document.getElementById("gestionDeStockRelacheGlobal").style.display='none';
        document.getElementById("gestionDeStockEntrepot").innerHTML.reload
        var xhr = getXhr();
        // On définit ce qu'on va faire quand on aura la réponse
        xhr.onreadystatechange = function(){
            // On ne fait quelque chose que si on a tout reçu et que le serveur est OK
            if(xhr.readyState == 4 && xhr.status == 200){
                gestionDeStockEntrepot = xhr.responseText;
                // On se sert de innerHTML pour rajouter les options à la liste
                document.getElementById('gestionDeStockEntrepot').innerHTML = gestionDeStockEntrepot;

            }
        }
        // Ici on va voir comment faire du post
        xhr.open("POST","selectTableStock.php",true);
        // ne pas oublier ça pour le post
        xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
        idEntrepot = event.srcElement.id;
        entrepotSelect = event.srcElement.innerText;
        xhr.send("idEntrepot="+idEntrepot);
        document.getElementById("entrepotSelection").style.display='none';
        document.getElementById("entrepotChoisi").value = entrepotSelect;
        }
</script>

<!-- Situation globale des entrepôts -->
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
    
    function goEntrepotGlobal(){
        document.getElementById("gestionDeStockEntrepotGlobal").style.display='block';
        document.getElementById("gestionDeStockEntrepot").style.display='none';
        document.getElementById("gestionDeStockNavireGlobal").style.display='none';
        document.getElementById("gestionDeStockNavire").style.display='none';
        document.getElementById("gestionDeStockClientGlobal").style.display='none';
        document.getElementById("gestionDeStockClient").style.display='none';
        document.getElementById("gestionDeStockBanque").style.display='none';
        document.getElementById("gestionDeStockBanqueGlobal").style.display='none';
        document.getElementById("gestionDeStockTransitGlobal").style.display='none';
        document.getElementById("gestionDeStockTransit").style.display='none';
        document.getElementById("gestionDeStockRelache").style.display='none';
        document.getElementById("gestionDeStockRelacheGlobal").style.display='none';
        document.getElementById("entrepotChoisi").value='';
        document.getElementById("gestionDeStockEntrepotGlobal").innerHTML.reload
        var xhr = getXhr();
        // On définit ce qu'on va faire quand on aura la réponse
        xhr.onreadystatechange = function(){
            // On ne fait quelque chose que si on a tout reçu et que le serveur est OK
            if(xhr.readyState == 4 && xhr.status == 200){
                gestionDeStockEntrepotGlobal = xhr.responseText;
                // On se sert de innerHTML pour rajouter les options à la liste
                document.getElementById('gestionDeStockEntrepotGlobal').innerHTML = gestionDeStockEntrepotGlobal;

            }
        }
        // Ici on va voir comment faire du post
        xhr.open("POST","selectTableEntrepotGlobal.php",true);
        // ne pas oublier ça pour le post
        xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
        idEntrepotGlobal = "globalEntrepot";
        xhr.send("idEntrepotGlobal="+idEntrepotGlobal);
        }
</script>

<!-- Situation par navire -->
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
 
    function goNavire(){
        document.getElementById("gestionDeStockNavire").style.display='block';
        document.getElementById("gestionDeStockNavireGlobal").style.display='none';
        document.getElementById("gestionDeStockEntrepotGlobal").style.display='none';
        document.getElementById("gestionDeStockEntrepot").style.display='none';
        document.getElementById("gestionDeStockClientGlobal").style.display='none';
        document.getElementById("gestionDeStockClient").style.display='none';
        document.getElementById("gestionDeStockBanque").style.display='none';
        document.getElementById("gestionDeStockBanqueGlobal").style.display='none';
        document.getElementById("gestionDeStockTransitGlobal").style.display='none';
        document.getElementById("gestionDeStockTransit").style.display='none';
        document.getElementById("gestionDeStockRelache").style.display='none';
        document.getElementById("gestionDeStockRelacheGlobal").style.display='none';
        document.getElementById("gestionDeStockNavire").innerHTML.reload
        var xhr = getXhr();
        // On définit ce qu'on va faire quand on aura la réponse
        xhr.onreadystatechange = function(){
            // On ne fait quelque chose que si on a tout reçu et que le serveur est OK
            if(xhr.readyState == 4 && xhr.status == 200){
                gestionDeStockNavire = xhr.responseText;
                // On se sert de innerHTML pour rajouter les options à la liste
                document.getElementById('gestionDeStockNavire').innerHTML = gestionDeStockNavire;

            }
        }
        // Ici on va voir comment faire du post
        xhr.open("POST","selectTableNavireStock.php",true);
        // ne pas oublier ça pour le post
        xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
        idNavire = event.srcElement.id;
        navireSelect = event.srcElement.innerText;
        xhr.send("idNavire="+idNavire);
        document.getElementById("navireSelection").style.display='none';
        document.getElementById("navireChoisi").value = navireSelect;
    }
</script>

<!-- Situation globale des navires -->
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
    
    function goNavireGlobal(){
        document.getElementById("gestionDeStockNavireGlobal").style.display='block';
        document.getElementById("gestionDeStockNavire").style.display='none';
        document.getElementById("gestionDeStockEntrepotGlobal").style.display='none';
        document.getElementById("gestionDeStockEntrepot").style.display='none';
        document.getElementById("gestionDeStockBanque").style.display='none';
        document.getElementById("gestionDeStockBanqueGlobal").style.display='none';
        document.getElementById("gestionDeStockTransitGlobal").style.display='none';
        document.getElementById("gestionDeStockTransit").style.display='none';
        document.getElementById("gestionDeStockRelache").style.display='none';
        document.getElementById("gestionDeStockRelacheGlobal").style.display='none';
        document.getElementById("gestionDeStockClientGlobal").style.display='none';
        document.getElementById("gestionDeStockClient").style.display='none';
        document.getElementById("navireChoisi").value='';
        document.getElementById("gestionDeStockNavireGlobal").innerHTML.reload
        var xhr = getXhr();
        // On définit ce qu'on va faire quand on aura la réponse
        xhr.onreadystatechange = function(){
            // On ne fait quelque chose que si on a tout reçu et que le serveur est OK
            if(xhr.readyState == 4 && xhr.status == 200){
                gestionDeStockNavireGlobal = xhr.responseText;
                // On se sert de innerHTML pour rajouter les options à la liste
                document.getElementById('gestionDeStockNavireGlobal').innerHTML = gestionDeStockNavireGlobal;

            }
        }
        // Ici on va voir comment faire du post
        xhr.open("POST","selectTableNavireGlobal.php",true);
        // ne pas oublier ça pour le post
        xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
        idNavireGlobal = "globalNavire";
        xhr.send("idNavireGlobal="+idNavireGlobal);
        }
</script>

<!-- Situation globale des clients -->
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
    
    function goClientGlobal(){
        document.getElementById("gestionDeStockClientGlobal").style.display='block';
        document.getElementById("gestionDeStockClient").style.display='none';
        document.getElementById("gestionDeStockNavire").style.display='none';
        document.getElementById("gestionDeStockEntrepotGlobal").style.display='none';
        document.getElementById("gestionDeStockEntrepot").style.display='none';
        document.getElementById("gestionDeStockNavireGlobal").style.display='none';
        document.getElementById("gestionDeStockBanque").style.display='none';
        document.getElementById("gestionDeStockBanqueGlobal").style.display='none';
        document.getElementById("gestionDeStockTransitGlobal").style.display='none';
        document.getElementById("gestionDeStockTransit").style.display='none';
        document.getElementById("gestionDeStockRelache").style.display='none';
        document.getElementById("gestionDeStockRelacheGlobal").style.display='none';
        document.getElementById("clientChoisi").value='';
        document.getElementById("gestionDeStockClientGlobal").innerHTML.reload
        var xhr = getXhr();
        // On définit ce qu'on va faire quand on aura la réponse
        xhr.onreadystatechange = function(){
            // On ne fait quelque chose que si on a tout reçu et que le serveur est OK
            if(xhr.readyState == 4 && xhr.status == 200){
                gestionDeStockClientGlobal = xhr.responseText;
                // On se sert de innerHTML pour rajouter les options à la liste
                document.getElementById('gestionDeStockClientGlobal').innerHTML = gestionDeStockClientGlobal;

            }
        }
        // Ici on va voir comment faire du post
        xhr.open("POST","selectTableClientGlobal.php",true);
        // ne pas oublier ça pour le post
        xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
        idClientGlobal = "globalClient";
        xhr.send("idClientGlobal="+idClientGlobal);
        }
</script>



<!-- situation des clients -->
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

    function goClient(){
        document.getElementById("gestionDeStockClient").style.display='block';
        document.getElementById("gestionDeStockClientGlobal").style.display='none';
        document.getElementById("gestionDeStockEntrepot").style.display='none';
        document.getElementById("gestionDeStockEntrepotGlobal").style.display='none';
        document.getElementById("gestionDeStockNavireGlobal").style.display='none';
        document.getElementById("gestionDeStockNavire").style.display='none';
        document.getElementById("gestionDeStockBanque").style.display='none';
        document.getElementById("gestionDeStockBanqueGlobal").style.display='none';
        document.getElementById("gestionDeStockTransitGlobal").style.display='none';
        document.getElementById("gestionDeStockTransit").style.display='none';
        document.getElementById("gestionDeStockRelache").style.display='none';
        document.getElementById("gestionDeStockRelacheGlobal").style.display='none';
        document.getElementById("gestionDeStockClient").innerHTML.reload
        var xhr = getXhr();
        // On définit ce qu'on va faire quand on aura la réponse
        xhr.onreadystatechange = function(){
            // On ne fait quelque chose que si on a tout reçu et que le serveur est OK
            if(xhr.readyState == 4 && xhr.status == 200){
                gestionDeStockClient = xhr.responseText;
                // On se sert de innerHTML pour rajouter les options à la liste
                document.getElementById('gestionDeStockClient').innerHTML = gestionDeStockClient;

            }
        }
        // Ici on va voir comment faire du post
        xhr.open("POST","selectTableClientStock.php",true);
        // ne pas oublier ça pour le post
        xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
        idClient = event.srcElement.id;
        clientSelect = event.srcElement.innerText;
        xhr.send("idClient="+idClient);
        document.getElementById("clientSelection").style.display='none';
        document.getElementById("clientChoisi").value = clientSelect;
        }
</script>

<!-- situation des banques -->
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

    function goBanque(){
        document.getElementById("gestionDeStockBanque").style.display='block';
        document.getElementById("gestionDeStockBanqueGlobal").style.display='none';
        document.getElementById("gestionDeStockClient").style.display='none';
        document.getElementById("gestionDeStockClientGlobal").style.display='none';
        document.getElementById("gestionDeStockEntrepot").style.display='none';
        document.getElementById("gestionDeStockEntrepotGlobal").style.display='none';
        document.getElementById("gestionDeStockNavireGlobal").style.display='none';
        document.getElementById("gestionDeStockNavire").style.display='none';
        document.getElementById("gestionDeStockTransitGlobal").style.display='none';
        document.getElementById("gestionDeStockTransit").style.display='none';
        document.getElementById("gestionDeStockRelache").style.display='none';
        document.getElementById("gestionDeStockRelacheGlobal").style.display='none';
        document.getElementById("gestionDeStockBanque").innerHTML.reload
        var xhr = getXhr();
        // On définit ce qu'on va faire quand on aura la réponse
        xhr.onreadystatechange = function(){
            // On ne fait quelque chose que si on a tout reçu et que le serveur est OK
            if(xhr.readyState == 4 && xhr.status == 200){
                gestionDeStockBanque = xhr.responseText;
                // On se sert de innerHTML pour rajouter les options à la liste
                document.getElementById('gestionDeStockBanque').innerHTML = gestionDeStockBanque;

            }
        }
        // Ici on va voir comment faire du post
        xhr.open("POST","selectTableBanqueStock.php",true);
        // ne pas oublier ça pour le post
        xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
        idBanque = event.srcElement.id;
        banqueSelect = event.srcElement.innerText;
        xhr.send("idBanque="+idBanque);
        document.getElementById("banqueSelection").style.display='none';
        document.getElementById("banqueChoisi").value = banqueSelect;
        }
</script>

<!-- situation globale des banques -->
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

    function goBanqueGlobal(){
        document.getElementById("gestionDeStockBanqueGlobal").style.display='block';
        document.getElementById("gestionDeStockBanque").style.display='none';
        document.getElementById("gestionDeStockClient").style.display='none';
        document.getElementById("gestionDeStockClientGlobal").style.display='none';
        document.getElementById("gestionDeStockEntrepot").style.display='none';
        document.getElementById("gestionDeStockEntrepotGlobal").style.display='none';
        document.getElementById("gestionDeStockNavireGlobal").style.display='none';
        document.getElementById("gestionDeStockNavire").style.display='none';
        document.getElementById("gestionDeStockTransitGlobal").style.display='none';
        document.getElementById("gestionDeStockTransit").style.display='none';
        document.getElementById("gestionDeStockRelache").style.display='none';
        document.getElementById("gestionDeStockRelacheGlobal").style.display='none';
        document.getElementById("banqueChoisi").value='';
        document.getElementById("gestionDeStockBanqueGlobal").innerHTML.reload
        var xhr = getXhr();
        // On définit ce qu'on va faire quand on aura la réponse
        xhr.onreadystatechange = function(){
            // On ne fait quelque chose que si on a tout reçu et que le serveur est OK
            if(xhr.readyState == 4 && xhr.status == 200){
                gestionDeStockBanqueGlobal = xhr.responseText;
                // On se sert de innerHTML pour rajouter les options à la liste
                document.getElementById('gestionDeStockBanqueGlobal').innerHTML = gestionDeStockBanqueGlobal;

            }
        }
        // Ici on va voir comment faire du post
        xhr.open("POST","selectTableBanqueGlobal.php",true);
        // ne pas oublier ça pour le post
        xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
        idBanqueGlobal = "globalBanque";
        xhr.send("idBanqueGlobal="+idBanqueGlobal);
        }
</script>

<!-- situation des relaches -->
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

    function goRelache(){
        document.getElementById("gestionDeStockRelache").style.display='block';
        document.getElementById("gestionDeStockRelacheGlobal").style.display='none';
        document.getElementById("gestionDeStockBanque").style.display='none';
        document.getElementById("gestionDeStockBanqueGlobal").style.display='none';
        document.getElementById("gestionDeStockClient").style.display='none';
        document.getElementById("gestionDeStockClientGlobal").style.display='none';
        document.getElementById("gestionDeStockEntrepot").style.display='none';
        document.getElementById("gestionDeStockEntrepotGlobal").style.display='none';
        document.getElementById("gestionDeStockNavireGlobal").style.display='none';
        document.getElementById("gestionDeStockNavire").style.display='none';
        document.getElementById("gestionDeStockTransitGlobal").style.display='none';
        document.getElementById("gestionDeStockTransit").style.display='none';
        document.getElementById("gestionDeStockRelache").innerHTML.reload
        var xhr = getXhr();
        // On définit ce qu'on va faire quand on aura la réponse
        xhr.onreadystatechange = function(){
            // On ne fait quelque chose que si on a tout reçu et que le serveur est OK
            if(xhr.readyState == 4 && xhr.status == 200){
                gestionDeStockRelache = xhr.responseText;
                // On se sert de innerHTML pour rajouter les options à la liste
                document.getElementById('gestionDeStockRelache').innerHTML = gestionDeStockRelache;

            }
        }
        // Ici on va voir comment faire du post
        xhr.open("POST","selectTableRelacheStock.php",true);
        // ne pas oublier ça pour le post
        xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
        idRelache = event.srcElement.id;
        relacheSelect = event.srcElement.innerText;
        xhr.send("idRelache="+idRelache);
        document.getElementById("relacheSelection").style.display='none';
        document.getElementById("relacheChoisi").value = relacheSelect;
        }
</script>

<!-- situation globale des relaches -->
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

    function goRelacheGlobal(){
        document.getElementById("gestionDeStockRelacheGlobal").style.display='block';
        document.getElementById("gestionDeStockRelache").style.display='none';
        document.getElementById("gestionDeStockBanqueGlobal").style.display='none';
        document.getElementById("gestionDeStockBanque").style.display='none';
        document.getElementById("gestionDeStockClient").style.display='none';
        document.getElementById("gestionDeStockClientGlobal").style.display='none';
        document.getElementById("gestionDeStockEntrepot").style.display='none';
        document.getElementById("gestionDeStockEntrepotGlobal").style.display='none';
        document.getElementById("gestionDeStockNavireGlobal").style.display='none';
        document.getElementById("gestionDeStockNavire").style.display='none';
        document.getElementById("gestionDeStockTransitGlobal").style.display='none';
        document.getElementById("gestionDeStockTransit").style.display='none';
        document.getElementById("relacheChoisi").value='';
        document.getElementById("gestionDeStockRelacheGlobal").innerHTML.reload
        var xhr = getXhr();
        // On définit ce qu'on va faire quand on aura la réponse
        xhr.onreadystatechange = function(){
            // On ne fait quelque chose que si on a tout reçu et que le serveur est OK
            if(xhr.readyState == 4 && xhr.status == 200){
                gestionDeStockRelacheGlobal = xhr.responseText;
                // On se sert de innerHTML pour rajouter les options à la liste
                document.getElementById('gestionDeStockRelacheGlobal').innerHTML = gestionDeStockRelacheGlobal;

            }
        }
        // Ici on va voir comment faire du post
        xhr.open("POST","selectTableRelacheGlobal.php",true);
        // ne pas oublier ça pour le post
        xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
        idRelacheGlobal = "globalRelache";
        xhr.send("idRelacheGlobal="+idRelacheGlobal);
        }
</script>

<!-- Situation globale du transit -->
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
    
    function goTransitGlobal(){
        document.getElementById("gestionDeStockTransitGlobal").style.display='block';
        document.getElementById("gestionDeStockTransit").style.display='none';
        document.getElementById("gestionDeStockClient").style.display='none';
        document.getElementById("gestionDeStockClientGlobal").style.display='none';
        document.getElementById("gestionDeStockClient").style.display='none';
        document.getElementById("gestionDeStockNavire").style.display='none';
        document.getElementById("gestionDeStockEntrepotGlobal").style.display='none';
        document.getElementById("gestionDeStockEntrepot").style.display='none';
        document.getElementById("gestionDeStockNavireGlobal").style.display='none';
        document.getElementById("gestionDeStockBanque").style.display='none';
        document.getElementById("gestionDeStockBanqueGlobal").style.display='none';
        document.getElementById("gestionDeStockRelacheGlobal").style.display='none';
        document.getElementById("gestionDeStockRelache").style.display='none';
        document.getElementById("transitChoisi").value='';
        document.getElementById("gestionDeStockTransitGlobal").innerHTML.reload
        var xhr = getXhr();
        // On définit ce qu'on va faire quand on aura la réponse
        xhr.onreadystatechange = function(){
            // On ne fait quelque chose que si on a tout reçu et que le serveur est OK
            if(xhr.readyState == 4 && xhr.status == 200){
                gestionDeStockTransitGlobal = xhr.responseText;
                // On se sert de innerHTML pour rajouter les options à la liste
                document.getElementById('gestionDeStockTransitGlobal').innerHTML = gestionDeStockTransitGlobal;

            }
        }
        // Ici on va voir comment faire du post
        xhr.open("POST","selectTableTransitGlobal.php",true);
        // ne pas oublier ça pour le post
        xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
        idTransitGlobal = "globalTransit";
        xhr.send("idTransitGlobal="+idTransitGlobal);
        }
</script>

<!-- Situation globale du transit -->
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
    
    function goTransit(){
        document.getElementById("gestionDeStockTransit").style.display='block';
        document.getElementById("gestionDeStockTransitGlobal").style.display='none';
        document.getElementById("gestionDeStockClient").style.display='none';
        document.getElementById("gestionDeStockClientGlobal").style.display='none';
        document.getElementById("gestionDeStockClient").style.display='none';
        document.getElementById("gestionDeStockNavire").style.display='none';
        document.getElementById("gestionDeStockEntrepotGlobal").style.display='none';
        document.getElementById("gestionDeStockEntrepot").style.display='none';
        document.getElementById("gestionDeStockNavireGlobal").style.display='none';
        document.getElementById("gestionDeStockBanque").style.display='none';
        document.getElementById("gestionDeStockBanqueGlobal").style.display='none';
        document.getElementById("gestionDeStockRelacheGlobal").style.display='none';
        document.getElementById("gestionDeStockRelache").style.display='none';
        document.getElementById("gestionDeStockTransitGlobal").innerHTML.reload
        var xhr = getXhr();
        // On définit ce qu'on va faire quand on aura la réponse
        xhr.onreadystatechange = function(){
            // On ne fait quelque chose que si on a tout reçu et que le serveur est OK
            if(xhr.readyState == 4 && xhr.status == 200){
                gestionDeStockTransit = xhr.responseText;
                // On se sert de innerHTML pour rajouter les options à la liste
                document.getElementById('gestionDeStockTransit').innerHTML = gestionDeStockTransit;

            }
        }
        // Ici on va voir comment faire du post
        xhr.open("POST","selectTableTransitStock.php",true);
        // ne pas oublier ça pour le post
        xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
        idTransit = event.srcElement.id;
        transitSelect = event.srcElement.innerText;
        xhr.send("idTransit="+idTransit);
        document.getElementById("transitSelection").style.display='none';
        document.getElementById("transitChoisi").value = transitSelect;
        }
</script>

<!-- filtre entrepot -->
<script type="text/javascript"> 
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

    function filtreEntrepot(){
    document.getElementById("entrepotSelection").style.display='block';
    var xhr = getXhr();
    // On définit ce qu'on va faire quand on aura la réponse
    xhr.onreadystatechange = function(){
        // On ne fait quelque chose que si on a tout reçu et que le serveur est OK
        if(xhr.readyState == 4 && xhr.status == 200){
            entrepotSelection = xhr.responseText;
            // On se sert de innerHTML pour rajouter les options à la liste
            document.getElementById('entrepotSelection').innerHTML = entrepotSelection;

        }
    }
    // Ici on va voir comment faire du post
    xhr.open("POST","fetchDataEntrepot.php",true);
    // ne pas oublier ça pour le post
    xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
    var search = document.getElementById('entrepotChoisi').value;
    xhr.send("entrepotChoisi="+search);
    }
</script>

<!-- filtre navire -->
<script type="text/javascript"> 
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

    function filtreNavire(){
    document.getElementById("navireSelection").style.display='block';
    var xhr = getXhr();
    // On définit ce qu'on va faire quand on aura la réponse
    xhr.onreadystatechange = function(){
        // On ne fait quelque chose que si on a tout reçu et que le serveur est OK
        if(xhr.readyState == 4 && xhr.status == 200){
            navireSelection = xhr.responseText;
            // On se sert de innerHTML pour rajouter les options à la liste
            document.getElementById('navireSelection').innerHTML = navireSelection;

        }
    }
    // Ici on va voir comment faire du post
    xhr.open("POST","fetchDataNavire.php",true);
    // ne pas oublier ça pour le post
    xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
    var search = document.getElementById('navireChoisi').value;
    xhr.send("navireChoisi="+search);
    }
</script>

<!-- filtre client -->
<script type="text/javascript"> 
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

    function filtreClient(){
    document.getElementById("clientSelection").style.display='block';
    var xhr = getXhr();
    // On définit ce qu'on va faire quand on aura la réponse
    xhr.onreadystatechange = function(){
        // On ne fait quelque chose que si on a tout reçu et que le serveur est OK
        if(xhr.readyState == 4 && xhr.status == 200){
            clientSelection = xhr.responseText;
            // On se sert de innerHTML pour rajouter les options à la liste
            document.getElementById('clientSelection').innerHTML = clientSelection;

        }
    }
    // Ici on va voir comment faire du post
    xhr.open("POST","fetchDataClient.php",true);
    // ne pas oublier ça pour le post
    xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
    var search = document.getElementById('clientChoisi').value;
    xhr.send("clientChoisi="+search);
    }
</script>

<!-- filtre banque -->
<script type="text/javascript"> 
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

    function filtreBanque(){
    document.getElementById("banqueSelection").style.display='block';
    var xhr = getXhr();
    // On définit ce qu'on va faire quand on aura la réponse
    xhr.onreadystatechange = function(){
        // On ne fait quelque chose que si on a tout reçu et que le serveur est OK
        if(xhr.readyState == 4 && xhr.status == 200){
            banqueSelection = xhr.responseText;
            // On se sert de innerHTML pour rajouter les options à la liste
            document.getElementById('banqueSelection').innerHTML = banqueSelection;

        }
    }
    // Ici on va voir comment faire du post
    xhr.open("POST","fetchDataBanque.php",true);
    // ne pas oublier ça pour le post
    xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
    var search = document.getElementById('banqueChoisi').value;
    xhr.send("banqueChoisi="+search);
    }
</script>

<!-- filtre relache -->
<script type="text/javascript"> 
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

    function filtreRelache(){
    document.getElementById("relacheSelection").style.display='block';
    var xhr = getXhr();
    // On définit ce qu'on va faire quand on aura la réponse
    xhr.onreadystatechange = function(){
        // On ne fait quelque chose que si on a tout reçu et que le serveur est OK
        if(xhr.readyState == 4 && xhr.status == 200){
            relacheSelection = xhr.responseText;
            // On se sert de innerHTML pour rajouter les options à la liste
            document.getElementById('relacheSelection').innerHTML = relacheSelection;

        }
    }
    // Ici on va voir comment faire du post
    xhr.open("POST","fetchDataRelache.php",true);
    // ne pas oublier ça pour le post
    xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
    var search = document.getElementById('relacheChoisi').value;
    xhr.send("relacheChoisi="+search);
    }
</script>

<!-- filtre client -->
<script type="text/javascript"> 
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

    function filtreTransit(){
    document.getElementById("transitSelection").style.display='block';
    var xhr = getXhr();
    // On définit ce qu'on va faire quand on aura la réponse
    xhr.onreadystatechange = function(){
        // On ne fait quelque chose que si on a tout reçu et que le serveur est OK
        if(xhr.readyState == 4 && xhr.status == 200){
            transitSelection = xhr.responseText;
            // On se sert de innerHTML pour rajouter les options à la liste
            document.getElementById('transitSelection').innerHTML = transitSelection;

        }
    }
    // Ici on va voir comment faire du post
    xhr.open("POST","fetchDataTransit.php",true);
    // ne pas oublier ça pour le post
    xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
    var search = document.getElementById('transitChoisi').value;
    xhr.send("transitChoisi="+search);
    }
</script>

 </body>
</html>
