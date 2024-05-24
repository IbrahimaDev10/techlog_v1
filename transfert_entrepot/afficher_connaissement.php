<?php 
require("../database.php");
require("controller/acces_transfert.php");
//if(isset($_POST['navire'])){
	  	 	$id_navire=$_POST['navire'];

	$connaissement=connaissement($bdd,$id_navire); 
   
	?>
	  <select id="connaissement_dec" class="mysel" name="produit" style="max-width: 200px;" >

	  		
	  	<option  selected><?php echo $id_navire; ?></option>

	  	<?php  while($con=$connaissement->fetch() ) { ?>
	  		<option value="<?php echo $con['id_dis']; ?>"> <?php echo $con['num_connaissement']; ?> ( <?php echo $con['produit']. $con['qualite'] .$con['poids_kg']. 'KG '.$con['mangasin'].' '. $con['quantite_poids'].' T' ?>) </option>
	  	<?php } ?>
	  
                        </select>
	  	
                            
<?php //} ?>

