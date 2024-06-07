<?php 
require('../../../database.php');
require('../../controller/transporteur/transporteurController.php');

 ?>

 <div class="container-fluid" id='content'>
	<div class="row">
		
		<div class="col-lg-3">
		
		</div>
		<div class="col-lg-12" style="background: white;"> 
		<div class="table-responsive" id='transporteur_ajax'>
			<table class="table table-responsive table-bordered" >

			<thead>
				<tr>
					<th colspan="7" ><a class="btn btn-primary"  >Ajouter</a> <center><h3>LISTE DES TRANSPORTEURS</h3> </center>  </th>
				</tr>
				
    <tr id="entete_transporteur"  border='2'  >
                     	<th style="border-color:white;" scope="col" ></th>
                        <th style="border-color:white;" scope="col" >TRANSPORTEURS</th>
                        <th style="border-color:white;" scope="col" >FLOAT</th>
                        
                         
                                 </tr>
						
		</thead>
		<tbody id='body_categories'>
			<?php 	affichage_transporteur($bdd); ?>
			
		</tbody>	

			
		    </table>
			
		</div>
	</div>	
		
	</div>
</div>
<script type="text/javascript">
	 $(document).ready(function() {
  $('#transporteur_ajax table').DataTable({
    // Options de DataTables, si vous en avez besoin
    
  });
});
</script>