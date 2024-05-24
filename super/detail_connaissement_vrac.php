<?php require('../database.php');
if(isset($_POST['client'])){
 $client=$_POST['client'];
 $id_navire=$_POST['id_navire'];

	$detail=$bdd->prepare('SELECT nc.*, c.*  from categories as c 
		inner join numero_connaissements as nc on nc.categories_id_vrac=c.id_categories
		
		where nc.id_client=? and nc.id_navire=? group by nc.id_connaissement');
	$detail->bindParam(1,$client);
	$detail->bindParam(2,$id_navire);
	
	$detail->execute();

 ?>

 	<select name="connaissement" id='connaissement' style="max-width: 50%;" data-role='choix_produit'>
		<option>CHOISIRss connaissement</option>
		<?php while($det=$detail->fetch()){ ?>
			<option value="<?php echo $det['id_connaissement'] ?>"><?php echo $det['num_connaissement']; ?> </option>
		
	</select>
	<?php }

	} ?>