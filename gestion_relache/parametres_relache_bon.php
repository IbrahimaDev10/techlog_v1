<?php
include('../database.php');
require('controller/afficher_navire.php');
//require('controller/action_transit.php');
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
	if(empty($_SESSION['profil'])){
		header('location:../index.php');
	}
?>
<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
  

	<title>PARAMETRES RELACHES & BONS</title>


	<!-- Bootstrap CSS-->
	<?php //include('../super/tr_link.php'); ?>
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
	<link rel="stylesheet" type="text/css" href="debarquement.css">
</head>
<body >

<style type="text/css">
	 *{
  font-family: Times New Roman;
 } 

</style>
 
  <!--Topbar -->
  <?php include('topbar.php'); ?>

   	<!--Sidebar-->
	<?php include('sidebar.php'); ?>
	<!-- End Sidebar-->


	<div class="sidebar-overlay"></div>


	<!--Content Start-->
	<div class="content-start transition" style="background:white;  margin: 0px; border: none; border-radius: 0px; z-index: -5; " >
		<div class="container-fluid dashboard" >
			<div class="content-header">
        <div class="container-fluid" style="background-image: linear-gradient(-45deg, #004362, #0183d0); !important top:0; border-radius: 20px;">
    <div class="row">
     
        <div class="col col-md-12 col col-lg-12">
          <center>
       
         <a id="bouton_mes_declarations" style="color: white;" data-role="afficher_select"><i class="fas fa-eye"></i> Mes relaches</a>   <a id="bouton_mes_declarations" style="color: white;" data-role="afficher_select"><i class="fas fa-eye"></i> Mes bons</a>
   
         
        </center>
    </div>
   

    </div>
     
   </div>
<br><br>

 


   <div class="container-fluid" style="background-image: linear-gradient(-45deg, #004362, #0183d0); !important width: 50%; display: none;" id='partie_select'>
    <div class="row">
     
        <div class="col col-md-12 col col-lg-12">
          
        
         <center>
        <select id="navire" data-role="afficher_relache_par_destination">
          <option value="">Choisir un navire</option>
          <?php $navire=afficher_navire($bdd);
          while($nav=$navire->fetch()){ ?>
             <option value="<?php echo $nav['id']; ?>"><?php echo $nav['navire']; ?></option>
           <?php } ?>
        </select>
      </center>
      
    </div>
    <br><br>

    <div class="col col-md-12 col col-lg-12" style="display: none;" id="type">
          
        
         <center>
        <select id="type_dec" data-role="afficher_declaration">
          <option value="">Choisir le type de  declaration</option>
           <option value="1">ENTREE</option>
           <option value="2">SORTIE</option>
         
       
        </select>
      </center>
       </div>

    </div>
     
   </div>

<div class="row">
			<div class="container-fluid" id='table_relache'>
      <div class="row">
        
      </div>  
      </div>




			</div>

			

 <div class="modal fade" id="ajout_transit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <center>
        <h1 class="modal-title fs-5 text-white text-center" id="exampleModalLabel " style="text-align:center; ">Ajout transit</h1></center>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="auth-right">
          <div class="auth-logo">
            <a ><img src="../assets/images/mylogo.ico" alt="Logo"> TRANSIT</a>  
          </div>
          </div>
        <form action="controller/action_transit.php" method="POST">
<div class="form-group position-relative has-icon-left mb-4">
                          <div class="form-group position-relative has-icon-left mb-4">
                           <select id="selnavire" name="navire" class="form-control form-control-xl " onchange='goDC()'>
                            <option value="">choix du navire</option>
                            <?php $navire=afficher_navire($bdd); 
                            while ($chNav=$navire->fetch()) {
                              ?>
                            <option value="<?= $chNav['id']; ?>"><?php echo $chNav['navire']; ?> </option>  
                           <?php } ?> 
                       </select>
                        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="begin_transit">Ajouter une declaration</button>
                         
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








<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('change','select[data-role=afficher_relache_par_destination]',function(){
  //$('#type').css('display', 'block');

    var id_navire = $('#navire').val();
      //var type_dec = $('#type_dec').val();
     

        $.ajax({
        url:'afficher_tableau_modifier_relache.php',
        method:'post',
        data:{id_navire:id_navire},
        success: function(response){
            $('#table_relache').html(response);

       
        }
    });
 

  });
});
</script>





<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('click','a[data-role=update_transit]',function(){
     

  });
});
</script>


<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('click','a[data-role=afficher_select]',function(){
   $('#partie_select').css('display', 'block');
  

  });
});
</script>

<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('click','a[data-role=afficher_type_ajout]',function(){
   $('#partie_select_form').css('display', 'block');
     $('#partie_select').css('display', 'none');
   $('#bouton_ajout_declaration').css('color', 'black');
   $('#bouton_mes_declarations').css('color', 'blue');


  });
});
</script>

<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('change','select[data-role=afficher_formulaire_declaration]',function(){
   //$('#partie_select').css('display', 'block');
   //$('#bouton_mes_declarations').css('color', 'black');
   //$('#bouton_ajout_declaration').css('color', 'blue');
     //$('#partie_select_form').css('display', 'none');
     var type=$('#type_dec_form').val();
     if(type==1){
      $('#ajout_transit').modal('toggle');
     }
          if(type==2){
      window.location.href='ajout_declaration_sortie.php';
     }

  });
});
</script>

<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('click','a[data-role=modifier_simple]',function(){
    var id=$(this).data('id');
    var num_relache = $('#'+id +'num_relache').text();
     var navire = $('#'+id +'navire').text();
        var quantite = $('#'+id +'quantite').text();
    quantite=quantite.replace(" ","");
    quantite=quantite.replace(",","."); 
    var date= $('#'+id +'dates').text();
   var dateParts = date.split('/');
    
    // Formater la date au format YYYY-MM-DD
    var formattedDate = '20' + dateParts[2] + '-' + dateParts[1] + '-' + dateParts[0];


    $('#num_relache_form').val(num_relache);
    $('#quantite_form').val(quantite);
    $('#id_form').val(id);
    $('#date_form').val(formattedDate);
     $('#navire_form').val(navire);



    
    
    $('#modifier_simple_relache').modal('toggle');
  });
    

   $(document).on('click','a[data-role=btn_modifier_simple]',function(){
  var num_relache=$('#num_relache_form').val();
  var quantite=$('#quantite_form').val();
  var id=$('#id_form').val();
  var date=$('#date_form').val();
  var navire=$('#navire_form').val();


  
  $.ajax({
    url:'modifier_simple_relache.php',
    method:'post',
    data:{num_relache:num_relache,quantite:quantite,id:id,date:date,navire:navire},
    success: function(response){
      $('#tableau_modifier_relache').html(response);

    $('#modifier_simple_relache').modal('toggle');
    }
  });

  });
});
</script>

<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('click','a[data-role=modifier_avec_transfert]',function(){
    var id=$(this).data('id');
    var num_relache = $('#'+id +'num_relache').text();
     var navire = $('#'+id +'navire').text();
    
      var quantite = $('#'+id +'quantite').text();
    quantite=quantite.replace(" ","");
    quantite=quantite.replace(",","."); 


    var date= $('#'+id +'dates').text();
   var dateParts = date.split('/');
    
    // Formater la date au format YYYY-MM-DD
    var formattedDate = '20' + dateParts[2] + '-' + dateParts[1] + '-' + dateParts[0];
    //variable pour afficher le select mangasin
     var id_con_dis = $('#'+id +'id_con_dis').text();
      var id_mangasin = $('#'+id +'id_mangasin').text();
       var id_produit = $('#'+id +'id_produit').text();
        var poids_kg = $('#'+id +'poids_kg').text();
        var quantite_reelle=$('#quantite_reelle2').val();

    $('#num_relache_form2').val(num_relache);
    $('#quantite_reelle2').val(quantite);
    $('#id_form2').val(id);
    $('#date_form2').val(formattedDate);
     $('#navire_form2').val(navire);
     $('#id_mangasin_form2').val(id_mangasin);
      $('#id_produit_form2').val(id_produit);
       $('#poids_kg_form2').val(poids_kg);
        $('#id_con_dis_form2').val(id_con_dis);
 
 
 
 
    $('#modifier_transfert_relache').modal('toggle');

    $.ajax({
    url:'select_mangasin.php',
    method:'post',
    data:{id_con_dis:id_con_dis,id_mangasin:id_mangasin,id_produit:id_produit,poids_kg:poids_kg,quantite_reelle:quantite_reelle},
    success: function(response){
      $('#mangasin_form2').html(response);

   
    }
  });

  });
    

   $(document).on('click','a[data-role=btn_modifier_transfert]',function(){
  var num_relache=$('#num_relache_form2').val();
  var quantite_reelle=$('#quantite_reelle2').val();
  var id=$('#id_form2').val();
  var date=$('#date_form2').val();
  var navire=$('#navire_form2').val();
   var id_mangasin=$('#id_mangasin_form2').val();
     var id_produit= $('#id_produit_form2').val();
      var poids_kg= $('#poids_kg_form2').val();
     var id_con_dis=$('#id_con_dis_form2').val();
         var id_nouvel_id_dis=$('#mangasin_form2').val();
         var quantite_transfert=$('#quantite_transfert2').val(); 


  
  $.ajax({
    url:'modifier_transfert_relache.php',
    method:'post',
    data:{num_relache:num_relache,quantite_reelle:quantite_reelle,id:id,date:date,navire:navire,id_mangasin:id_mangasin,id_produit:id_produit,poids_kg:poids_kg ,id_con_dis:id_con_dis,id_nouvel_id_dis:id_nouvel_id_dis,quantite_transfert:quantite_transfert},
    success: function(response){
      $('#tableau_modifier_relache').html(response);
       $('#modifier_transfert_relache').modal('toggle');

   
    }
  });


  });
});
</script>


 </body>
</html>
