<?php require('../database.php');
if(isset($_POST['produit'])){
 $produit=explode('-', $_POST['produit']);
 $id_produit=$produit[0];
 $poids_sac=$produit[1];
 $id_navire=$_POST['id_navire'];

	$detail=$bdd->prepare('SELECT * from numero_connaissements  
		where id_produit=? and poids_kg=? and id_navire=?
		
		');
	$detail->bindParam(1,$id_produit);
	$detail->bindParam(2,$poids_sac);
	$detail->bindParam(3,$id_navire);
	
	$detail->execute();

 ?>

 	<select name="nc" id='connaissement' style="max-width: 50%;" data-role='type_de_chargement' >
		<option>CHOISIR connaissement</option>
		<?php while($det=$detail->fetch()){ ?>
			<option value="<?php echo $det['id_connaissement']; ?>"><?php echo $det['num_connaissement']; ?>  </option>
		
	</select>
	<?php }

	} ?>