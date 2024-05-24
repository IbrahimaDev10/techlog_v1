<?php
require('../database.php');

$navbl=$bdd->query("select * from navire_deb order by id desc");
//$navire=$bdd->query("select * from navire_deb order by id desc");

/*$navire=$bdd->prepare("select dis.*, mg.*,nav.* from dispatching as dis 
                 inner join mangasin as mg on dis.id_mangasin=mg.id
                 
                 inner join navire_deb as nav on dis.id_navire=nav.id
                 inner join simar_user as user on user.id_sim_user=mg.id_mangasinier
                 where mg.id_mangasinier=? group by nav.navire");
      $navire->bindParam(1,$_GET['id']);
      $navire->execute();*/

?>	



<!DOCTYPE html>
<html lang="fr">
  <head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>FINAL REPORT</title>

	<!-- Bootstrap CSS-->
	 <link rel="stylesheet" href="../assets/modules/bootstrap-5.1.3/css/bootstrap.css">
  <!-- Style CSS -->
  <link rel="stylesheet" href="../transfert/css/style.css">
  <link rel="stylesheet" href="final_report.css">
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

  td {
      height: 5px !important;
    }

</style>






 


        



  
  <!--Topbar -->
  <div id="boutonmenu"> 
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
    <?php $intervenant=$bdd->query("select * from intervenant_deb"); ?>
    <label>INTERVENANT</label><br>  
   <select id="intervenant">
     <option value=""> Choisir intervenant </option>
    <?php while ($inter=$intervenant->fetch()) { ?>
        <option value="<?php echo $inter['id_intervenant'] ?>"> <?php echo $inter['nom_intervenant'] ?> </option>
    <?php } ?>
       
  
   </select><br>
  <div style="display: none;">
    <label>dis_bl</label>
    <input style="height: 25px;" type="text" class="form-control"   id=id_navire ><br>
    <input style="height: 25px;" type="text" class="form-control"   id=id_client ><br>
  </div>

    
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
     <div id="situationss">  
         <div class="container-fluid1 " id="situation"  style=" background: rgb(0,141,202);" >
        <div class="row">
            
            
                <div class="col-lg-12 col-md-12">
                    <h1 class="hem2 text-white" style=" background: rgb(0,44,62); font-size: 30px;">FINAL REPORT</h1><br>

                    
                    <form method="POST" >
                        <select  id="navires" class="mysel" style="margin-right: 3%; height: 30px;   width: 30%;"  onchange='goNavireSit()'>
                            <option value="">selectionner un navire</option>
                            <?php 
                            while ($row=$navbl->fetch()) {
                             ?>
                                <option value=<?php echo $row['id'] ?> >  <?php echo $row['navire'] ?> </option>
                            <?php } ?>

                 </select>

                 <select id="client" class="mysel" name="date" style="margin-right: 3%; height: 30px;  width: 30%;" onchange='goClient()'>
                            <option  selected>selectionner le client</option>
                        </select>
                        
                     <select id="produit" class="mysel" name="date" style="margin-right: 3%; height: 30px;  width: 30%;" onchange='goProduit()'>
                            <option  selected>selectionner le produit</option>
                        </select>
                        <br><br>
                        <center>
                          <a style=" display: none; " id="global" class="hide-on-print"  data-id="<?php //echo $t['id_dis_recep_bl'] ?>" >VOIR SUMMARY GLOBAL <center> <i class="fas fa-eye fa-6x;" style="color: white; "></i> </center></a>
                        </center>
                        
                 
                            
                    </form>
                
            </div>
        </div>
    </div>
    </div>
   
    <div class="sit" id="sit">
    </div>
   

<div class="table" id="final_report">
  
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
   
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    


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
                        document.getElementById('client').innerHTML = ladate;

                    }
                }
 
                // Ici on va voir comment faire du post
                xhr.open("POST","selectNavireFinal.php",true);
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
            function goClient(){
                var xhr = getXhr();
                // On définit ce qu'on va faire quand on aura la réponse
                xhr.onreadystatechange = function(){
                    // On ne fait quelque chose que si on a tout reçu et que le serveur est OK
                    if(xhr.readyState == 4 && xhr.status == 200){
                        ladate = xhr.responseText;
                        // On se sert de innerHTML pour rajouter les options à la liste
                        document.getElementById('produit').innerHTML = ladate;

                    }
                }
 
                // Ici on va voir comment faire du post
                xhr.open("POST","selectClientFinal.php",true);
                // ne pas oublier ça pour le post
                xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
                // ne pas oublier de poster les arguments
                // ici, l'id de l'auteur
                sel = document.getElementById('client');
                idclient = sel.options[sel.selectedIndex].value;
                xhr.send("idClient="+idclient);
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
            function goProduit(){
                var xhr = getXhr();
                // On définit ce qu'on va faire quand on aura la réponse
                xhr.onreadystatechange = function(){
                    // On ne fait quelque chose que si on a tout reçu et que le serveur est OK
                    if(xhr.readyState == 4 && xhr.status == 200){
                        lecales = xhr.responseText;
                        // On se sert de innerHTML pour rajouter les options à la liste
                        document.getElementById('sit').innerHTML = lecales;
                        global =document.getElementById('global');
                       global.style.display="table";

                    }
                }
 
                // Ici on va voir comment faire du post
                xhr.open("POST","selectProduitFinal.php",true);
                // ne pas oublier ça pour le post
                xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
                // ne pas oublier de poster les arguments
                // ici, l'id de l'auteur
                sel = document.getElementById('produit');
                iddate = sel.options[sel.selectedIndex].value;
                xhr.send("idDate="+iddate);
            }
        </script> 


<script type="text/javascript">


  $(document).ready(function(){
    $(document).on('click','button[data-role=ajout_intervenant]',function(){
        var id_navire = $(this).data('id_navire');
          var id_client = $(this).data('id_client');
        
   $("#id_navire").val(id_navire);
    $("#id_client").val(id_client);   
        

        
        $('#form_intervenant').modal('toggle');
    });
    
    $('#valider_intervenant').click(function(){
         
        var id_navire = $('#id_navire').val();
        var id_client = $('#id_client').val();
        var intervenant = $('#intervenant').val();
        
        
        $.ajax({
    url:'insert_intervenant_deb.php',
    method:'post',
    data:{intervenant:intervenant,id_navire:id_navire,id_client:id_client},
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


    $(document).ready(function(){
    
    $('#global').click(function(){
      var navire= $('#navires').val();
        
       // $('#frontend').css('display', 'none');

        
        $.ajax({
        url:'global.php',
        method:'post',
        data:{navire:navire},
        success: function(response){
            $('#final_report').html(response);

       
        }
    });
    });
});

</script>

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
  
    $(document).ready(function () {
        $(document).on('click', 'a[data-role=imprimer_final_report]', function () {
            var contentToPrint = $('#pdf').html();
            var printWindow = window.open('', '_blank');
             var cssLink = '<link rel="stylesheet" type="text/css" href="final_report.css">';
        printWindow.document.write('<html><head><title>Impression</title>' + cssLink + '</head><body>' + contentToPrint + '</body></html>');
           // printWindow.document.write('<html><head><title>Impression</title></head><body>' + contentToPrint + '</body></html>');
            printWindow.document.close();
            printWindow.print();
        });
    }); 
</script>
    
 </body>
</html>
