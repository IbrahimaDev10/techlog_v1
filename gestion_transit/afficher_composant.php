<?php require('../database.php');
 $id_navire=$_POST['id_navire'];
 echo $_POST['val_id_dis']; 
$bl_entrant=$bdd->prepare("SELECT p.*, mg.mangasin ,nc.*, dis.* from dispat as dis
		
      inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
	inner join produit_deb as p on p.id=dis.id_produit
	
	inner join mangasin as mg on mg.id=dis.id_mangasin 
	 
	  where nc.id_navire=?");
	$bl_entrant->bindParam(1,$navire);
	$bl_entrant->execute(); ?>

	 <div class="mb-12" id="les_composants">
                      
                     <select class="" id='val_id_connaissement'> 
             <?php while($bls=$bl_entrant->fetch()){ ?>        	
                     <option value="<?php echo $bls['id_dis'] ?>"><?php echo $bls['num_connaissement']; ?> DESTINATION <?php echo $bls['mangasin']; ?> PRODUIT <?php echo $bls['produit']; ?> <?php echo $bls['qualite']; ?> <?php echo $bls['poids_kg'].' KG'; ?></option> 
                     <?php } ?> 
                       </select>
                    <select class="ml-3" style="margin-left:10px;" id='val_id_declaration'> 
                     <option>declaration</option>  
                       </select>
                       </div>