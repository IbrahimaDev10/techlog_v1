<?php require('../database.php');
if(isset($_POST['bl'])){
	$bl=explode('-', $_POST['bl']);

 $con=$bl[0];
 $dec=$bl[1];
 $mg=$bl[2];

	$detail=$bdd->prepare('SELECT d.*,mg.mangasin,nc.num_connaissement from declaration as d
		inner join numero_connaissements as nc on nc.id_connaissement=d.id_bl
		inner join mangasin as mg on mg.id=d.id_destination
		where d.id_declaration=? ');
	$detail->bindParam(1,$dec);
	
	$detail->execute();
while($det=$detail->fetch()){ ?>
	<span id='detail' > detail: connaissement=> <?php echo $det['num_connaissement']; ?> entrepot=> <?php echo $det['mangasin']; ?> </span>

	<?php  
}
}
 ?>