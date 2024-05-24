<?php 
require('../database.php');
require('controller/requete_reception.php');
$c=$_POST['id_connaissement'];

if(!empty($_POST['dates']) and !empty($_POST['id_connaissement']) and !empty($_POST['sain'])  and !empty($_POST['id_connaissement']) and !empty($_POST['id_num_conteneur']) and !empty($_POST['id_connaissement']) and !empty($_POST['id_declaration']) and !empty($_POST['camion']) and !empty($_POST['id_transporteur'])){
	$dates=$_POST['dates'];
	$sain=$_POST['sain'];
	$flasque=$_POST['flasque'];
	$mouille=$_POST['mouille'];
	$id_num_conteneur=$_POST['id_num_conteneur'];
	$id_declaration=$_POST['id_declaration'];
	$id_connaissement=$_POST['id_connaissement'];
	$camion=$_POST['camion'];
	$id_transporteur=$_POST['id_transporteur'];
	$poids_kg=$_POST['poids_kg'];
	$poids=($sain+$mouille+$flasque)*$poids_kg/1000;

	$insertion=$bdd->prepare("INSERT INTO reception_conteneur(dates,sain,flasque,mouille,poids_rc,id_num_conteneur,id_declaration,id_connaissement,camion,id_transporteur) VALUES(?,?,?,?,?,?,?,?,?,?)");
	$insertion->bindParam(1,$dates);
	$insertion->bindParam(2,$sain);
	$insertion->bindParam(3,$flasque);
	$insertion->bindParam(4,$mouille);
	$insertion->bindParam(5,$poids);
	$insertion->bindParam(6,$id_num_conteneur);
	$insertion->bindParam(7,$id_declaration);
	$insertion->bindParam(8,$id_connaissement);
	$insertion->bindParam(9,$camion);
	$insertion->bindParam(10,$id_transporteur);
	$insertion->execute();

}
else{
	echo "errrrrrrrrrrreur";
}

 ?>
 <div class="container-fluid" id="afficher_reception">
	<div class="row">
		<div class="col-md-3 col-lg-3">	
	<a class="btn-primary" data-bs-target="#enregistrement" data-bs-toggle="modal">Nouvelles receptions</a>	
	<br>
	</div>
	<div class="table-responsive">

	<table class='table table-hover table-bordered table-striped table-responsive'  border='1'   >
		<thead>
			<?php $bl=bl_et_declaration($bdd,$c);
			if($bls=$bl->fetch()){ ?>
				<tr class="les_th">
			<td colspan="7"> CONNAISSEMENT: <?php echo $bls['n_bl']; ?></td>
			<td colspan="7"> DECLARATION: <?php echo $bls['num_declare']; ?></td>
			<?php } ?>	
				</tr>
			<tr class="les_th" >
				<th rowspan="2">DATE</th>
				<th rowspan="2">N TC</th>
				<th colspan="5">NOMBRE DE COLIS DECHARGES</th>
				<th colspan="2">MANIFEST EN (T)</th>
				<th colspan="2">MANQUANT</th>
				<th rowspan="2">CAMION TC</th>
				<th rowspan="2">TRANSPORTEUR</th>
				<th rowspan="2">ACTIONS</th>
			</tr>
			<tr class="les_th">
				<th>S</th>
				<th>F</th>
				<th>M</th>
				<th>T</th>
				<th>POIDS</th>
				<th>NBRE</th>
				<th>POIDS</th>
				<th>NBRE</th>
				<th>POIDS</th>				
			</tr>
		</thead>
		<tbody>
			<?php 	$compte=compte_reception($bdd,$c);
			     $compt=$compte->fetch();
			if($compt['count(id_recep)']==0){ ?>
				<td colspan="14" class="les_td">AUCUN ENREGISTREMENT</td>
			<?php  } ?>

	<?php

	 $afficher=afficher_reception($bdd,$c);
	   while($aff=$afficher->fetch()){
	$total_sac=$aff['sain'] + $aff['flasque'] + $aff['mouille'];
	
	$manquant_sac=$aff['sacs']-$total_sac;
	$manquant_poids=$aff['poids']-$aff['poids_rc'];

	    ?>
	   <tr class="les_td">
	   	<td id="<?php echo $aff['id_recep'].'dates_rec' ?>"><?php echo $aff['dates'] ?></td>
	   	<td id="<?php echo $aff['id_recep'].'num_conteneur_rec' ?>"><?php echo $aff['num_conteneur'] ?></td>
	   	<td id="<?php echo $aff['id_recep'].'sain_rec' ?>"><?php echo $aff['sain'] ?></td>
	   	<td id="<?php echo $aff['id_recep'].'flasque_rec' ?>"><?php echo $aff['flasque'] ?></td>
	   	<td id="<?php echo $aff['id_recep'].'mouille_rec' ?>"><?php echo $aff['mouille'] ?></td>
	   	<td><?php echo $total_sac ?></td>
	   	<td><?php echo $aff['poids_rc'] ?></td>
	   	<td><?php echo $aff['sacs'] ?></td>
	   	<td><?php echo $aff['poids'] ?></td>
	    <td><?php echo $manquant_sac ?></td>
	   	<td><?php echo $manquant_poids ?></td>
	   	<td id="<?php echo $aff['id_recep'].'camion_rec' ?>" ><?php echo $aff['camion'] ?></td>
	   	<td id="<?php echo $aff['id_recep'].'transporteur_rec' ?>" ><?php echo $aff['nom'] ?></td>
	   	<span style="display: none;" id=<?php echo $aff['id_recep'].'id_connaissement'; ?>><?php echo $aff['id_connaissement']; ?>	</span>
	   	<span id="<?php echo $aff['id_recep'].'id_num_conteneur_rec' ?>"><?php echo $aff['id_num_conteneur'] ?></span>
	   	<span id="<?php echo $aff['id_recep'].'id_transporteur_rec' ?>"><?php echo $aff['id'] ?></span>
	   	<span id="<?php echo $aff['id_recep'].'poids_kg_rec' ?>"><?php echo $aff['poids_kg'] ?></span>
       <td>	
      <div style="display: flex; justify-content: center;">

 <a class="fabtn" data-role="modifier_conteneur" data-id="<?php echo $aff['id_recep']; ?>" > <i class="fa fa-edit " ></i></a>




<a  class="fabtn1 " onclick="delete_reception(<?php echo $aff['id_recep'] ?>)" > <i class="fa fa-trash  " ></i> </a>
</div>
       </td>
	   </tr>	
	   <?php } ?>
	   <?php $afficherT=somme_reception($bdd,$c);
	   while($afft=$afficherT->fetch()){ 
	    if($afft['sum(rc.sain)']>0){		
$total_sac=$afft['sum(rc.sain)'] + $afft['sum(rc.flasque)'] + $afft['sum(rc.mouille)'];
	
	$manquant_sac=$afft['sum(nc.sacs)']-$total_sac;
	$manquant_poids=$afft['sum(nc.poids)']-$afft['sum(rc.poids_rc)']; ?>
	<tr class="les_td2">
		<td style="color: white;" colspan="2"> TOTAL DU BL <?php echo $afft['n_bl'] ?></td>
		<td style="color: white;" >  <?php echo $afft['sum(rc.sain)'] ?></td>
		<td style="color: white;">  <?php echo $afft['sum(rc.flasque)'] ?></td>
		<td style="color: white;">  <?php echo $afft['sum(rc.mouille)'] ?></td>
		<td style="color: white;">  <?php echo $total_sac ?></td>
		<td style="color: white;">  <?php echo $afft['sum(rc.poids_rc)'] ?></td>
		<td style="color: white;">  <?php echo $afft['sum(nc.sacs)'] ?></td>
		<td style="color: white;"><?php echo $afft['sum(nc.poids)'] ?></td>
		<td style="color: white;">  <?php echo $manquant_sac ?></td>
		<td style="color: white;">  <?php echo $manquant_poids ?></td>
		<td colspan="3"></td>
	</tr>
<?php } } ?>

		</tbody>
	</table>	
	</div>
	</div>
</div>

