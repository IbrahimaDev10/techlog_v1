<?php 
function afficher_liste_camion($bdd,$navire){

$afficher=$bdd->prepare("SELECT td.*,p.*,nav.navire,cam.*,ch.* from transfert_debarquement as td 
	inner join produit_deb as p on p.id=td.id_produit 
	inner join navire_deb as nav on nav.id=td.id_navire
	left join camions as cam on cam.id_camions=td.camions
	left join chauffeur as ch on ch.id_chauffeur=td.chauffeur
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
	<td style="" id=<?php echo $affichers['id_register_manif'].'dates'; ?>><?php echo $affichers['dates']; ?></td>
	<td style="" id=<?php echo $affichers['id_register_manif'].'heure'; ?>><?php echo $affichers['heure']; ?></td>
	<td><?php echo $affichers['navire']; ?></td>
<td ><?php echo $affichers['produit'] ?> <?php echo $affichers['poids_sac'].' KG'; ?></td>

<td id=<?php echo $affichers['id_register_manif'].'blp'; ?> ><?php echo $affichers['bl'] ?></td>
<td id=<?php echo $affichers['id_register_manif'].'w'; ?> ><?php echo $affichers['num_camions'] ?></td>
<td id=<?php echo $affichers['id_register_manif'].'dd'; ?> ><?php echo $affichers['nom_chauffeur'] ?></td>
<td id=<?php echo $affichers['id_register_manif'].'dd'; ?> ><?php echo $affichers['num_telephone'] ?></td>

<td id=<?php echo $affichers['id_register_manif'].'sac'; ?>><?php echo $affichers['sac'] ?></td>
<td><?php echo $affichers['poids'] ?></td>
<td><a data-role='afficher_form_pont' data-id=<?php echo $affichers['id_register_manif']; ?>><i class="fas fa-edit"></i></a></td>
</tr>


<?php } }
 ?>


