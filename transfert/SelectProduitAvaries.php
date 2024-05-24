<?php require('../database.php');
    $navire=$_POST['navire'];
function choix_produit($bdd,$navire){
	$choix_prod=$bdd->prepare('SELECT dc.*,p.* from declaration_chargement as dc
		inner join produit_deb as p on p.id=dc.id_produit where id_navire=? GROUP by dc.id_produit, dc.conditionnement');
	$choix_prod->bindParam(1,$navire);
	$choix_prod->execute();
	return $choix_prod;
} 
 ?>

 <select  id="valeur_produit_navire" class="mysel" style="margin-right: 5%; height: 30px;   width: 30%;"  data-role='goProduitNavireAvaries'>
 	 <option value="">selectionner un produit</option>
 	<?php $choix_prod=choix_produit($bdd,$navire);

 	      while($ch=$choix_prod->fetch()){ ?>
 	      	<option value="<?php echo $ch['id_produit'].'-'.$ch['conditionnement'].'-'.$ch['id_navire']; ?>"><?php echo $ch['produit'] ?> <?php echo $ch['qualite'] ?> <?php echo $ch['conditionnement'].' KG'; ?></option>
                         <?php } ?>  

                             </select>