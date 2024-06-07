<?php 
require('../../../database.php');
require('../../controller/client/clientController.php');

 ?>

 <div class="container-fluid" id='content'>
	<div class="row">
		
		<div class="col-lg-3">
		
		</div>
		<div class="col-lg-12" style="background: white;"> 
		<div class="table-responsive" id='client_ajax'>
			<table class="table table-responsive table-bordered" >

			<thead>
				<tr>
					<th colspan="9" ><a style="float: left;" class="btn btn-primary"  >Ajouter</a> <br> <center><h3>LISTE DES RECEPTIONNAIRES</h3> </center>  </th>
				</tr>
			             <tr class="entete_table" >
                     	 <th  scope="col" ></th>
                        
                        <th  scope="col" >RECEPTIONNAIRES</th>
                        <th  scope="col" >PRODUIT</th>
                       
                         <th  scope="col" >TOTAUX</th>
                         <th  scope="col" >CODE PPM</th>
                         <th  scope="col" >ADRESSE</th>
                         <th  scope="col" >TELEPHONE</th>
                         <th  scope="col" >EMAIL</th>
                          
                         	
                         
                     
                        <th  scope="col" >ACTIONS</th>

                         
                                 </tr>
						
		</thead>
		<tbody id='body_categories'>
			<?php 	affichage_client($bdd); ?>
			
		</tbody>	

			
		    </table>
			
		</div>
	</div>	
		
	</div>
</div>
<script type="text/javascript">
	 $(document).ready(function() {
  $('#client_ajax table').DataTable({
    // Options de DataTables, si vous en avez besoin
    
  });
});
</script>