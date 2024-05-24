<?php 

function afficher_avaries($bdd,$produit,$poids_sac,$navire){
	$afficher_avaries=$bdd->prepare('SELECT dc.*,p.produit,p.qualite, av.*, sum(av.sac_flasque),sum(av.sac_mouille) from avaries as av
		inner join declaration_chargement as dc on av.cale_avaries=dc.id_dec
		inner join produit_deb as p on p.id=dc.id_produit  where dc.id_produit=? and dc.conditionnement=? and dc.id_navire=? GROUP by  av.date_avaries,av.id_avaries with rollup');
	$afficher_avaries->bindParam(1,$produit);
	$afficher_avaries->bindParam(2,$poids_sac);
	$afficher_avaries->bindParam(3,$navire);
	$afficher_avaries->execute();
	return $afficher_avaries;

}

function affichage_avaries($bdd,$produit,$poids_sac,$navire){
        $afficher_avaries=afficher_avaries($bdd,$produit,$poids_sac,$navire);
         

$aff=$afficher_avaries->fetchAll(PDO::FETCH_ASSOC);

   
   $dates='NULL';
  
   $rowspan_produit='NULL';

foreach ($aff as $avaries ) {
echo '<tr>';
if(!empty($avaries['date_avaries'])  and !empty($avaries['id_avaries'])  ){
	$dateObj = date_create_from_format('Y-m-d', $avaries['date_avaries']);
                $date_converti = $dateObj->format('d-m-Y');
	?>
	
<td ><?php echo $date_converti ?></td>
<span style="display: none;" id='<?php echo $avaries['id_avaries'].'dates_avaries' ?>'><?php echo $avaries['date_avaries'] ?></span>
<?php } 

if($dates!=$avaries['date_avaries']  and !empty($avaries['date_avaries']) and !empty($avaries['id_avaries'])  ){
	$rowspan_produit=0;
	$dates=$avaries['date_avaries'];
	
	
	
	foreach($aff as $r){
		if($dates===$r['date_avaries']   ){
			$rowspan_produit++;
		}
	}
	?>
	<td  rowspan=<?php echo $rowspan_produit-1 ?> style='text-align:center; vertical-align:middle;'> <?php echo $avaries['produit'] ?> <br><?php echo $avaries['qualite'] ?> <?php echo $avaries['conditionnement'].' KG'; ?> </td>
	<?php 
}

if( !empty($avaries['date_avaries']) and !empty($avaries['id_avaries'] ) ){
	?>
<td  style="text-align:center; vertical-align: middle; "><?php echo $avaries['cales'] ?></td>	
<td id=<?php echo $avaries['id_avaries'].'sacf_avaries' ?> style="text-align:center; vertical-align: middle;"><?php echo $avaries['sac_flasque'] ?></td>
<td id=<?php echo $avaries['id_avaries'].'sacm_avaries' ?> style="text-align:center; vertical-align: middle;"><?php echo $avaries['sac_mouille'] ?></td>
<span style="display: none;" id=<?php echo $avaries['id_avaries'].'id_produit_avaries' ?> style="text-align:center; vertical-align: middle;"><?php echo $avaries['id_produit'] ?></span>
<span style="display: none;" id=<?php echo $avaries['id_avaries'].'poids_sac_avaries' ?> style="text-align:center; vertical-align: middle;"><?php echo $avaries['conditionnement'] ?></span>
<span style="display: none;" id=<?php echo $avaries['id_avaries'].'cale_avaries' ?> style="text-align:center; vertical-align: middle;"><?php echo $avaries['id_dec'] ?></span>
<span style="display: none;" id=<?php echo $avaries['id_avaries'].'id_navire_avaries' ?> style="text-align:center; vertical-align: middle;"><?php echo $avaries['id_navire'] ?></span>
<td style="text-align:center; vertical-align: middle;">
	<div style="display: flex; justify-content: center;">

 <a class="fabtn"  name="modify"   data-role='update_avaries_debarquement'  data-id="<?php echo $avaries['id_avaries']  ?>"  > <i class="fa fa-edit " ></i></a>




<a    id="<?php echo $avaries['id_avaries'] ?>" name="delete" type="submit"  class="fabtn1 " onclick="deleteAvariesDebarquement(<?php echo $avaries['id_avaries'] ?>)" > <i class="fa fa-trash  " ></i> </a>
</div>
</td>

<?php } 


if( !empty($avaries['date_avaries']) and empty($avaries['id_avaries'] ) ){
	?>

<td colspan="3" style="text-align:center; vertical-align: middle; background: blue; color: white;">TOTAL <?php echo $avaries['produit'] ?> <?php echo $avaries['qualite'] ?> <?php echo $avaries['conditionnement'].' KG'; ?></td>	
<td style="text-align:center; vertical-align: middle; background: blue; color: white;"><?php echo $avaries['sum(av.sac_flasque)'] ?></td>
<td style="text-align:center; vertical-align: middle; background: blue; color: white;"><?php echo $avaries['sum(av.sac_mouille)'] ?></td>
<td  style="text-align:center; vertical-align: middle; background: blue; color: white;"></td>

<?php }
if( empty($avaries['date_avaries']) and empty($avaries['id_avaries'] )){
	?>
<td colspan="3" style="text-align:center; vertical-align: middle; background: black; color: white;">TOTAL</td>	
<td style="text-align:center; vertical-align: middle;  background: black; color: white;"><?php echo $avaries['sum(av.sac_flasque)'] ?></td>
<td style="text-align:center; vertical-align: middle;  background: black; color: white;"><?php echo $avaries['sum(av.sac_mouille)'] ?></td>
<td  style="text-align:center; vertical-align: middle;  background: black; color: white;">
	
</td>
 <?php }


 echo '</tr>';  

 ?>        

<?php  
}

}

?>	 