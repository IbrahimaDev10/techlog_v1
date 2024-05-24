<?php 
 require('../../../database.php');

$navire=$_POST['navire'];

$ticket=$_POST['ticket'];
$poids_brut=$_POST['poids_brut'];
$id_tare=$_POST['id_tare'];
$tare_vehicule=$_POST['tare_vehicule'];
$id=$_POST['id'];
$dates=$_POST['dates'];
$sac=$_POST['sac'];
$tare_sac=$_POST['tare_sac'];
  $net_pont_bascule=$poids_brut-$tare_vehicule;
        
    
     $net_marchand=$net_pont_bascule-$sac*$tare_sac/1000;
     

$insert=$bdd->prepare("INSERT INTO pont_bascule(ticket_ponts,poids_bruts,tare_vehicules,id_transfert,id_tare_sac,poids_net,date_pont) values(?,?,?,?,?,?,?) ");
$insert->bindParam(1,$ticket);
$insert->bindParam(2,$poids_brut);
$insert->bindParam(3,$tare_vehicule);
$insert->bindParam(4,$id);
$insert->bindParam(5,$id_tare);
$insert->bindParam(6,$net_marchand);
$insert->bindParam(7,$dates);
$insert->execute();

$update=$bdd->prepare("UPDATE transfert_debarquement set etat_pont='oui' where id_register_manif=? ");

$update->bindParam(1,$id);
$update->execute();
function afficher_liste_camion($bdd,$navire){

$afficher=$bdd->prepare(" SELECT td.*,p.* from transfert_debarquement as td 
	inner join produit_deb as p on p.id=td.id_produit 
	where td.id_navire=? and td.etat_pont='non' ");
$afficher->bindParam(1,$navire);
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


