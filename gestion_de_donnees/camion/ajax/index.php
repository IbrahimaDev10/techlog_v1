<?php 
require('../../../database.php');
require('../../controller/camion/camionController.php');

 ?>

 <div class="container-fluid" id='content'>
	<div class="row">
		
		<div class="col-lg-3">
		
		</div>
		<div class="col-lg-12" style="background: white;"> 
		<div class="table-responsive" id='camion_ajax'>
			<table class="table table-responsive table-bordered" >

			<thead>
				<tr>
					<th colspan="7" ><a style="float: left;" class="btn btn-primary"  >Ajouter</a><br> <center><h3>LISTE DES CAMIONS</h3> </center>  </th>
				</tr>
				
			  <tr class="entete_table" >
                     	<th style="border-color:white;" scope="col"> </th>
                     	<th style="border-color:white;" scope="col" >N° CAMION</th>
                     	 <th style="border-color:white;" scope="col" >TRASPORTEURS</th>
                     	  <th style="border-color:white;" scope="col" >ACTIONS</th>
                       
                                                            </tr>
						
		</thead>
		<tbody id='body_categories'>
			<?php 	affichage_camion($bdd); ?>
			
		</tbody>	

			
		    </table>
			
		</div>
	</div>	
		
	</div>
</div>
<script type="text/javascript">
	 $(document).ready(function() {
  $('#camion_ajax table').DataTable({
    // Options de DataTables, si vous en avez besoin
    
  });
});
</script>