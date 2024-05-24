<?php 

function afficher_recond($bdd,$produit,$poids_sac,$navire){
	$afficher_avaries=$bdd->prepare('SELECT p.produit,p.qualite, recond.*, sum(recond.sac_dechires),sum(recond.sac_obtenus) from recond_debarquement as recond
		
		inner join produit_deb as p on p.id=recond.id_produit_rec  where recond.id_produit_rec=? and recond.poids_sac_rec=? and recond.id_navire_rec=? GROUP by  recond.date_recond_tr,recond.id_recond_tr with rollup');
	$afficher_avaries->bindParam(1,$produit);
	$afficher_avaries->bindParam(2,$poids_sac);
	$afficher_avaries->bindParam(3,$navire);
	$afficher_avaries->execute();
	return $afficher_avaries;

}

function restant_flasque($bdd,$produit,$poids_sac,$navire){
	$restanr_flasque=$bdd->prepare('SELECT av.*, sum(av.sac_flasque),sum(av.sac_mouille),p.* from avaries as av
	
	inner join produit_deb as p on p.id=av.id_produit

	where av.id_produit=? and av.poids_sac_avaries=? and av.id_navire=? ');
$restanr_flasque->bindParam(1,$produit);
	$restanr_flasque->bindParam(2,$poids_sac);
	$restanr_flasque->bindParam(3,$navire);
	$restanr_flasque->execute();
	return $restanr_flasque;
}

function total_recond($bdd,$produit,$poids_sac,$navire){
	$total_recond=$bdd->prepare('SELECT  *, sum(sac_dechires),sum(sac_obtenus) from recond_debarquement 

	where id_produit_rec=? and poids_sac_rec=? and id_navire_rec=? ');
   $total_recond->bindParam(1,$produit);
	$total_recond->bindParam(2,$poids_sac);
	$total_recond->bindParam(3,$navire);
	$total_recond->execute();
	return $total_recond;
}

function affichage_recond($bdd,$produit,$poids_sac,$navire){
        $afficher_avaries=afficher_recond($bdd,$produit,$poids_sac,$navire);
         

$aff=$afficher_avaries->fetchAll(PDO::FETCH_ASSOC);

   
   $dates='NULL';
  
   $rowspan_produit='NULL';

foreach ($aff as $avaries ) {
echo '<tr>';
if(!empty($avaries['date_recond_tr'])  and !empty($avaries['id_recond_tr'])  ){
	$dateObj = date_create_from_format('Y-m-d', $avaries['date_recond_tr']);
                $date_converti = $dateObj->format('d-m-Y');
	?>
	
<td ><?php echo $date_converti ?></td>
<span style="display: none;" id='<?php echo $avaries['id_recond_tr'].'dates_avaries' ?>'><?php echo $avaries['date_recond_tr'] ?></span>
<?php } 

if($dates!=$avaries['date_recond_tr']  and !empty($avaries['date_recond_tr']) and !empty($avaries['id_recond_tr'])  ){
	$rowspan_produit=0;
	$dates=$avaries['date_recond_tr'];
	
	
	
	foreach($aff as $r){
		if($dates===$r['date_recond_tr'] ){
			$rowspan_produit++;
		}
	}
	?>
	<td  rowspan=<?php echo $rowspan_produit-1 ?> style='text-align:center; vertical-align:middle;'> <?php echo $avaries['produit'] ?> <br><?php echo $avaries['qualite'] ?> <?php echo $avaries['poids_sac_rec'].' KG'; ?> </td>
	<?php 
}

if( !empty($avaries['date_recond_tr']) and !empty($avaries['id_recond_tr'] ) ){
	?>
	
<td id=<?php echo $avaries['id_recond_tr'].'sacf_avaries' ?> style="text-align:center; vertical-align: middle;"><?php echo $avaries['sac_dechires'] ?></td>
<td id=<?php echo $avaries['id_recond_tr'].'sacm_avaries' ?> style="text-align:center; vertical-align: middle;"><?php echo $avaries['sac_obtenus'] ?></td>
<span style="display: none;" id=<?php echo $avaries['id_recond_tr'].'id_produit_avaries' ?> style="text-align:center; vertical-align: middle;"><?php echo $avaries['id_produit'] ?></span>
<span style="display: none;" id=<?php echo $avaries['id_recond_tr'].'poids_sac_avaries' ?> style="text-align:center; vertical-align: middle;"><?php echo $avaries['conditionnement'] ?></span>

<span style="display: none;" id=<?php echo $avaries['id_recond_tr'].'id_navire_avaries' ?> style="text-align:center; vertical-align: middle;"><?php echo $avaries['id_navire_rec'] ?></span>
<td style="text-align:center; vertical-align: middle;">
	<div style="display: flex; justify-content: center;">

 <a class="fabtn"  name="modify"   data-role='update_recond_debarquement'  data-id="<?php echo $avaries['id_recond_tr']  ?>"  > <i class="fa fa-edit " ></i></a>




<a    id="<?php echo $avaries['id_recond_tr'] ?>" name="delete" type="submit"  class="fabtn1 " onclick="deleteRecondDebarquement(<?php echo $avaries['id_recond_tr'] ?>)" > <i class="fa fa-trash  " ></i> </a>
</div>
</td>

<?php } 


if( !empty($avaries['date_recond_tr']) and empty($avaries['id_recond_tr'] ) ){
	?>

<td colspan="2" style="text-align:center; vertical-align: middle; background: blue; color: white;">TOTAL <?php echo $avaries['produit'] ?> <?php echo $avaries['qualite'] ?> <?php echo $avaries['poids_sac_rec'].' KG'; ?></td>	
<td style="text-align:center; vertical-align: middle; background: blue; color: white;"><?php echo $avaries['sum(recond.sac_dechires)'] ?></td>
<td style="text-align:center; vertical-align: middle; background: blue; color: white;"><?php echo $avaries['sum(recond.sac_obtenus)'] ?></td>
<td  style="text-align:center; vertical-align: middle; background: blue; color: white;"></td>

<?php }
if( empty($avaries['date_recond_tr']) and empty($avaries['id_recond_tr'] )){
	?>
<td colspan="2" style="text-align:center; vertical-align: middle; background: black; color: white;">TOTAL</td>	
<td style="text-align:center; vertical-align: middle;  background: black; color: white;"><?php echo $avaries['sum(recond.sac_dechires)'] ?></td>
<td style="text-align:center; vertical-align: middle;  background: black; color: white;"><?php echo $avaries['sum(recond.sac_obtenus)'] ?></td>
<td  style="text-align:center; vertical-align: middle;  background: black; color: white;">
	
</td>
 <?php }


 echo '</tr>';  

 ?>        

<?php  
}

}

?>	 