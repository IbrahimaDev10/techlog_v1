<div class="container-fluid" id='content'>
	<div class="row">
		
		<div class="col-lg-3">
		
		</div>
		<div class="col-lg-12" style="background: white;"> 
		<div class="table-responsive" id='entrepot_ajax'>
			<table class="table table-responsive table-bordered" >

			<thead>
				<tr>
					<th colspan="11" ><a style="float: left;" class="btn btn-primary"  >Ajouter</a> <br> <center><h3>LISTE DES ENTREPOTS</h3> </center>  </th>
				</tr>
				
			    <tr class="entete_table"  style="font-size: 12px;">
                     	<th id="celAlign" rowspan="2" style="border-color:white;" scope="col" > </th>
                     	<th id="celAlign" rowspan="2" style="border-color:white;" scope="col" >NOM ENTREPOT </th>
                     	<th id="celAlign" rowspan="2" style="border-color:white; font-size: 12px;" scope="col" >CODE D'ENTREPOT</th>
                        <th  id="celAlign" rowspan="2" style="border-color:white;" scope="col" style="font-size: 10px;" >N° AGREMENT</th>
                        <th id="celAlign" rowspan="2" style="border-color:white; font-size: 12px;" scope="col" >SUPERFICIE (m²)</th>
                        <th id="celAlign"  colspan="2" style="border-color:white; font-size: 12px;" scope="col" > CAPACITE DE STOCKAGE </th>
                        <th id="celAlign" colspan="2" style="border-color:white; font-size: 12px;" scope="col" > QUANTITE STOCKEE </th>
                        <th id="celAlign" colspan="2" style="border-color:white; font-size: 12px;" scope="col" > ESPACE A STOCKER </th>
                         <th id="celAlign" rowspan="2" style="border-color:white; font-size: 12px;" scope="col" > ACTIONS </th>
                               </tr>
                               <tr class="entete_table" style="font-size: 12px;">
                               	<th id="celAlign">SACS (50 KGS)</th>
                               	<th id="celAlign">POIDS (T)</th>
                               	<th id="celAlign">SACS (50 KGS)</th>
                               	<th id="celAlign">POIDS (T)</th>
                               	<th id="celAlign">SACS (50 KGS)</th>
                               	<th id="celAlign">POIDS (T)</th>
                               </tr>
						
		</thead>
		<tbody id='body_categories'>
			<?php 	affichage_entrepot($bdd); ?>
			
		</tbody>	

			
		    </table>
			
		</div>
	</div>	
		
	</div>
</div>
<script type="text/javascript">
	 $(document).ready(function() {
  $('#entrepot_ajax table').DataTable({
    // Options de DataTables, si vous en avez besoin
    
  });
});
</script>