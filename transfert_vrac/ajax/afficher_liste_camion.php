<?php 
require('../../database.php');

$navire=$_POST['navire'];

function afficher_liste_camion($bdd,$navire){

$afficher=$bdd->prepare("SELECT td.*,p.* from transfert_debarquement as td 
	inner join produit_deb as p on p.id=td.id_produit 
	where  td.etat_pont='non' ");
$afficher->execute();
return $afficher;
}

function affichage_liste_camion($bdd,$navire){
	$afficher=afficher_liste_camion($bdd,$navire);
	while($affichers=$afficher->fetch()){
?>
<tr style="text-align: center; vertical-align: middle;">
	<td style="display: none;" id=<?php echo $affichers['id_register_manif'].'produits'; ?>><?php echo $affichers['id_produit']; ?></td>
	<td style="display: none;" id=<?php echo $affichers['id_register_manif'].'poids_sac'; ?>><?php echo $affichers['poids_sac']; ?></td>
	<td style="display: none;" id=<?php echo $affichers['id_register_manif'].'navire'; ?>><?php echo $affichers['id_navire']; ?></td>
	<td style="display: none;" id=<?php echo $affichers['id_register_manif'].'destination'; ?>><?php echo $affichers['id_destination']; ?></td>
	<td style="display: none;" id=<?php echo $affichers['id_register_manif'].'client'; ?>><?php echo $affichers['id_client']; ?></td>
<td><?php echo $affichers['produit'] ?> <?php echo $affichers['poids_sac'].' KG'; ?></td>

<td><?php echo $affichers['bl'] ?></td>
<td></td>
<td id=<?php echo $affichers['id_register_manif'].'sac'; ?>><?php echo $affichers['sac'] ?></td>
<td><?php echo $affichers['poids'] ?></td>
<td><a data-role='afficher_form_pont' data-id=<?php echo $affichers['id_register_manif']; ?>><i class="fas fa-edit"></i></a></td>
</tr>


<?php } }

affichage_liste_camion($bdd,$navire); ?>


