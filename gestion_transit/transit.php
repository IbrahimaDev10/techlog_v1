<?php
include('../database.php');
require('controller/afficher_navire.php');
require('controller/action_transit.php');
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
  

	<title>TRANSIT</title>


	<!-- Bootstrap CSS-->
	<?php include('../super/link_deb.php'); ?>
	<link rel="stylesheet" type="text/css" href="debarquement.css">
</head>
<body >

<style type="text/css">
	 *{
  font-family: Times New Roman;
 } 

 
	
</style>

<?php include('navbar.php'); ?>
  
  <!--Topbar -->
   <div class="container-fluid" style="background: white;">
    <div class="row">
     
        <div class="col col-md-12 col col-lg-12">
          <center>
        <a style="color: blue;" id="bouton_ajout_declaration" data-role="afficher_type_ajout"><i class="fas fa-add"></i> Ajouter declaration</a>
         <a id="bouton_mes_declarations" style="color: blue;" data-role="afficher_select"><i class="fas fa-eye"></i> Mes declarations</a>
        </center>
    </div>
   

    </div>
     
   </div>
<br><br>

 <div class="container-fluid" style="background: blue; width: 50%; display: none;" id='partie_select_form'>
    <div class="row">
   <div class="col col-md-12 col col-lg-12"  id="type_ajout">
          
        
         <center>
        <select id="type_dec_form" data-role="afficher_formulaire_declaration">
          <option value="">Choisir le type de declaration</option>
           <option value="1">ENTREE</option>
           <option value="2">SORTIE</option>
         
       
        </select>
      </center>
       </div>
     </div>
   </div>


   <div class="container-fluid" style="background: blue; width: 50%; display: none;" id='partie_select'>
    <div class="row">
     
        <div class="col col-md-12 col col-lg-12">
          
        
         <center>
        <select id="navire" data-role="afficher_declaration">
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
	<!--Sidebar-->
  <?php include('sidebar.php'); ?>
	<!-- End Sidebar-->


	<div class="sidebar-overlay"></div>


	<!--Content Start-->
	<div class="content-start transition" style="background-image: url('../images/debarquement.jpg');  background-size: cover;
   background-position: center center;
  background-repeat: no-repeat;  margin: 0px; border: none; border-radius: 0px; z-index: -5; " >
		<div class="container-fluid dashboard">
			<div class="content-header">
<div class="row">
			<div class="container-fluid" id='table_declaration'>
      <div class="row">
        
      </div>  
      </div>




			</div>

			

 

<style type="text/css">
  .modal-fullscreen{
    width: 80% !important;
     height: 100%;
     z-index: 99999999999;
     margin-left: auto;
     margin-right: auto;
  }
  .modal {
  z-index: 99999999999; /* Valeur par défaut de Bootstrap pour les modals */
}
  .modal-dialog {
  width: 80%;
  height: 100%;
 /* margin: 0; */
}

.modal-content {
  height: 100%;
  border: 0;
  border-radius: 0;
}
</style>

<center>



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
    $(document).on('change','select[data-role=choix_navire]',function(){
   $('#type').css('display', 'block');


    var id_navire = $('#navire').val();
      var type = $('#type').val();
     

        $.ajax({
        url:'type_de_declaration.php',
        method:'post',
        data:{id_navire:id_navire,type:type},
        success: function(response){
            $('#type').html(response);

       
        }
    });
 

  });
});
</script>

<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('change','select[data-role=afficher_declaration]',function(){
  //$('#type').css('display', 'block');

    var id_navire = $('#navire').val();
      //var type_dec = $('#type_dec').val();
     

        $.ajax({
        url:'afficher_declaration.php',
        method:'post',
        data:{id_navire:id_navire},
        success: function(response){
            $('#table_declaration').html(response);

       
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
   $('#bouton_mes_declarations').css('color', 'black');
   $('#bouton_ajout_declaration').css('color', 'blue');
     $('#partie_select_form').css('display', 'none');

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
    $(document).on('click','a[data-role=afficher_form_modif]',function(){
     var id = $(this).data('id');
    var id_navire = $('#'+id+'id_navire').text();
    var id_dis=$('#'+id+'id_dis').text();
    var id_dis_text=$('#'+id+'id_dis_text').text();
    var poids=$('#'+id+'poids').text();
     var id_declaration=$('#'+id+'id_declaration').text();
      var num_declaration=$('#'+id+'num_declaration').text();
  
           var existingId_dis = $('#val_id_dis option[value="' + id_dis + '"]');
if (existingId_dis.length > 0) {
   // Mettre à jour le texte de l'option existante
   existingId_dis.text(id_dis_text);
} else {
   // Ajouter une nouvelle option avec la valeur et le texte correspondants
   var newOption = $('<option>', {
      value: id_dis,
      text: id_dis_text
   });
   $('#val_id_dis').prepend(newOption);
   // Sélectionner l'option par défaut
   newOption.prop('selected', true);
} 


   var existingId_dec = $('#val_id_declaration option[value="' + id_declaration + '"]');
if (existingId_dec.length > 0) {
   // Mettre à jour le texte de l'option existante
   existingId_dec.text(num_declaration);
} else {
   // Ajouter une nouvelle option avec la valeur et le texte correspondants
   var newOption = $('<option>', {
      value: id_declaration,
      text: num_declaration
   });
   $('#val_id_declaration').prepend(newOption);
   // Sélectionner l'option par défaut
   newOption.prop('selected', true);
} 

   $('#val_id').val(id);
   $('#val_id_navire').val(id_navire);
      
      
      $('#val_id_dis').val(id_dis);
         $('#val_poids').val(poids);
      
      $('#val_id_declaration').val(id_declaration);
      

   $('#val_id_connaissement').val(id_dis);
     
$('#form_update_transit').modal('toggle');
     

    $(document).on('click','a[data-role=valider_modif]',function(){
      var poids=$('#val_poids').val();
      var val_id_declaration=$('#val_id_declaration').val();
      var val_id=$('#val_id').val();
      var val_id_dis=$('#val_id_dis').val();
      var val_id_navire=$('#val_id_navire').val();

      $.ajax({

        url:'modifier_declaration.php',
        method:'post',
        data:{val_id:val_id,val_id_dis:val_id_dis,poids:poids,val_id_declaration:val_id_declaration,val_id_navire:val_id_navire},
        success: function(response){
            $('#partransit2').html(response);
            $('#form_update_transit').modal('toggle');

         
        }
  
    });
    });
 
  });
});
  

</script>

<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('click','i[data-role=fermer1]',function(){
      $('#alerte1').css('display','none');
    });
  });

   $(document).ready(function(){
    $(document).on('click','i[data-role=fermer2]',function(){
      $('#alerte2').css('display','none');
    });
  });
</script>


 </body>
</html>
