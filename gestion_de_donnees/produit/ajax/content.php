<div class="container-fluid" id='content'>
	<div class="row">
		
		<div class="col-lg-3">
		
		</div>
		<div class="col-lg-12" style="background: white;"> 
		<div class="table-responsive" id='produit_ajax'>
			<table class="table table-responsive table-bordered" >

			<thead>
				<tr>
					<th colspan="7" ><a style="float: left;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target='#form_ajout_produit' >Ajouter</a><br> <center><h3>LISTE DES PRODUITS</h3> </center>  </th>
				</tr>
				
			                      <tr id="entete_variete" border='2' >
                     	<th   > </th>
                        <th   >PRODUIT</th>
                         
                        <th   >QUALITE</th>
                        

                        <th   > ACTIONS  </th>

                         
                                 </tr>
						
		</thead>
		<tbody id='body_categories'>
			<?php 	affichage_produit($bdd); ?>
			
		</tbody>	

			
		    </table>
			
		</div>
	</div>	
		
	</div>
</div>



<div class="modal fade" id="form_ajout_produit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-largeur">
        <div class="modal-content" style="border: solid; border-color: rgb(0,141,202);">
            <div class="modal-header">
                <h3 class="modal-title fs-10 text-white text-center" id="exampleModalLabel">AJOUT NAVIRE</h3>
                <img class="logoo" src="../images/mylogo.ico">
            </div>
            <div class="modal-body">
                <form  method="POST">
                    <div class="form-group position-relative has-icon-left mb-5">
                       

                        <div class="row">
                            <div class="col-lg-6">
                                <input type="text" placeholder="PRODUIT" name="produit" id="produit_add_prod">
                            </div>
                            <div class="col-lg-6">
                                <input type="text" placeholder="QUALITE" name="destination" id="qualite_add_prod"><br><br>
                            </div>
                           
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                            	<?php $categories=$bdd->query("select * from categories"); ?>
                                <select name="categories" id=categories_add_prod>
	                            <option  disabled="false" selected> categories</option>
	                   <?php while($cat=$categories->fetch()){

		                                 ?>
		          <option value="<?php echo $cat['id_categories']; ?>"><?php echo $cat['nom_categories'] ?></option>
	            <?php } ?>
             </select>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" placeholder="TARIF" name="destination" id="tarif_add_prod">
                            </div>
                          
                        </div>

   
                      <br>
                        <center>
                            <a class="btn btn-primary"  data-role='ajouter_produits'>valider</a>
                        </center>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>





<script type="text/javascript">
	 $(document).ready(function() {
  $('#produit_ajax table').DataTable({
    // Options de DataTables, si vous en avez besoin
    
  });
});
</script>