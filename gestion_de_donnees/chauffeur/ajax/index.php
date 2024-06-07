<?php 
require('../../../database.php');
require('../../controller/chauffeur/chauffeurController.php');

 ?>

 <div class="container-fluid" id='content'>
	<div class="row">
		
		<div class="col-lg-3">
		
		</div>
		<div class="col-lg-12" style="background: white;"> 
		<div class="table-responsive" id='chauffeur_ajax'>
			<table class="table table-responsive table-bordered" >

			<thead>
				<tr>
					<th colspan="7" ><a style="float: left;" class="btn btn-primary"  >Ajouter</a><br> <center><h3>LISTE DES CHAUFFEURS</h3> </center>  </th>
				</tr>
				
  <tr class="entete_table" >
                     	<th style="border-color:white;" scope="col" >N°</th>
                     	 <th style="border-color:white;" scope="col" >CHAUFFEURS</th>
                       
                           <th style="border-color:white;" scope="col" > N° PERMIS</th>
                             <th style="border-color:white;" scope="col" >N° TELEPHONE</th>
                          
                               <th style="border-color:white;" scope="col" > ACTIONS  </th>
                                 </tr>
						
		</thead>
		<tbody id='body_categories'>
			<?php 	affichage_chauffeur($bdd); ?>
			
		</tbody>	

			
		    </table>
			
		</div>
	</div>	
		
	</div>
</div>
<script type="text/javascript">
	 $(document).ready(function() {
  $('#chauffeur_ajax table').DataTable({
    // Options de DataTables, si vous en avez besoin
    
  });
});
</script>