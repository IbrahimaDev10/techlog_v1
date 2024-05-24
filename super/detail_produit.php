<?php require('../database.php');
if(isset($_POST['client'])){
 $client=$_POST['client'];
 $id_navire=$_POST['id_navire'];

	$detail=$bdd->prepare('SELECT nc.id_produit,nc.poids_kg, p.produit,p.qualite,p.id  from produit_deb as p 
		inner join numero_connaissements as nc on nc.id_produit=p.id
		
		where nc.id_client=? and nc.id_navire=? group by p.id,nc.poids_kg');
	$detail->bindParam(1,$client);
	$detail->bindParam(2,$id_navire);
	
	$detail->execute();

 ?>

 	<select name="produit" id='produit' style="max-width: 50%;" data-role='choix_produit'>
		<option>CHOISIR produit</option>
		<?php while($det=$detail->fetch()){ ?>
			<option value="<?php echo $det['id'].'-'.$det['poids_kg']; ?>"><?php echo $det['produit']; ?> <?php echo $det['qualite']; ?> <?php echo $det['poids_kg'].' KG'; ?></option>
		
	</select>
	<?php }

	} ?>