<div class="container-fluid" id='content'>
	<div class="row">
		
		<div class="col-lg-3">
		
		</div>
		<div class="col-lg-12" style="background: white;"> 
		<div class="table-responsive" id='categories_ajax'>
			<table class="table table-responsive table-bordered" >

			<thead>
				<tr>
					<th colspan="7" ><a style="float: left;" class="btn btn-primary"  >Ajouter</a> <br> <center><h3>LISTE DES CATEGORIES</h3> </center>  </th>
				</tr>
				
			   <tr class="entete_table" >
                     	<th style="border-color:white; vertical-align: middle;" scope="col" > </th>
                        <th style="border-color:white; vertical-align: middle;" scope="col" >PRODUIT</th>
                         
                      
                        <th style="border-color:white; vertical-align: middle;" scope="col" >TAXE DE PORT</th>

                        <th style="border-color:white; vertical-align: middle;" scope="col" > ACTIONS  </th>
						
		</thead>
		<tbody id='body_categories'>
			<?php 	affichage_categories($bdd); ?>
			
		</tbody>	

			
		    </table>
			
		</div>
	</div>	
		
	</div>
</div>
<script type="text/javascript">
	 $(document).ready(function() {
  $('#categories_ajax table').DataTable({
    // Options de DataTables, si vous en avez besoin
    
  });
});
</script>