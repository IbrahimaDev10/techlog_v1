<?php require('../database.php'); 
$produit=explode('-', $_POST['produit']);
$id_produit=$produit[0];
$poids_sac=$produit[1];
$navire=$produit[2];

$choix_cale=$bdd->prepare('select id_dec,cales from declaration_chargement where id_produit=? and conditionnement=? and id_navire=? group by cales');
$choix_cale->bindParam(1,$id_produit);
$choix_cale->bindParam(2,$poids_sac);
$choix_cale->bindParam(3,$navire);
$choix_cale->execute();
?>
<select id='cale_pour_avaries' > 
<option > CHOISIR CALES</option> 
<?php while($choix=$choix_cale->fetch()){ ?>
	<option  value="<?php echo $choix['id_dec']; ?>"><?php echo $choix['cales']; ?> <?php echo $choix['id_dec']; ?></option>
	<?php } ?> 
</select> <br>