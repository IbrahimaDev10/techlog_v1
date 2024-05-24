<?php require('../database.php');

$nc=$_POST['nc'];
$poids=str_replace(' ', '', $_POST['poids']) ;
$banque=$_POST['banque'];
$affreteur=$_POST['affreteur'];
$id=$_POST['id'];
$navire=$_POST['navire'];
$produit=explode('-', $_POST['produit']);
$id_produit=$produit[0];
$poids_sac=$produit[1];
$update=$bdd->prepare("UPDATE numero_connaissements set num_connaissement=?, poids_connaissement=?, id_banque=?, id_fournisseur=?, id_produit=?, poids_kg=? WHERE id_connaissement=?");
$update->bindParam(1,$nc);
$update->bindParam(2,$poids);
$update->bindParam(3,$banque);
$update->bindParam(4,$affreteur);
$update->bindParam(5,$id_produit);
$update->bindParam(6,$poids_sac);
$update->bindParam(7,$id);
$update->execute(); 

$mes_connaissement=$bdd->prepare("SELECT nc.*,b.*,af.*,p.produit,p.qualite FROM numero_connaissements as nc LEFT join banque as b on b.id=nc.id_banque
	LEFT join produit_deb as p on p.id=nc.id_produit
	left join affreteur as af on af.id=nc.id_fournisseur where id_navire=?");
$mes_connaissement->bindParam(1,$navire);
$mes_connaissement->execute(); ?>

 		 <div  class="table-responsive" border=1 id="tableau_num_connaissement">
          <center>
 <table  class='table table-hover table-bordered table-striped'  border='2'  >
 	<thead>
 	<tr style="color: white; background: blue; font-size:12px; vertical-align: center; text-align: center; vertical-align:middle;">
 	<th colspan="6" ><h6 style="color: white;">NUMERO DE CONNAISSEMENT</h6> </th></tr>
 	<tr style="background: blue; color: white; font-size:12px; text-align: center; vertical-align:middle;">
 		<th>N° CONNAISSEMENT</th>
 			<th>PRODUIT & <br>QUALITE</th>
 		<th>BANQUE</th>
 		<th>FOURNISSEUR</th>
 		<th>POIDS</th>
 		<th>ACTION</th>
 	</tr>

 	</thead>

 <?php while($aff=$mes_connaissement->fetch()){ ?>
 	<tr style="font-size:12px; background: white; vertical-align: middle; text-align: center; vertical-align:middle;">
<td id=<?php echo $aff['id_connaissement'].'nc' ?>><?php echo $aff['num_connaissement'] ?></td>
<td ><?php echo $aff['produit'] ?> <?php echo $aff['qualite'] ?> <span style="color:red;"> <?php echo $aff['poids_kg'].' KG'; ?></span></td>
<td ><?php echo $aff['banque'] ?></td>
<td  ><?php echo $aff['affreteur'] ?></td>
<td style=" white-space: nowrap;" id="<?php echo $aff['id_connaissement'].'poids'; ?>"><?php echo number_format($aff['poids_connaissement'], 3,',',' '); ?></td>
<span id=<?php echo $aff['id_connaissement'].'banque' ?>><?php echo $aff['id_banque'] ?></span>
<span id=<?php echo $aff['id_connaissement'].'affreteur' ?>><?php echo $aff['id_fournisseur'] ?></span>
<span id=<?php echo $aff['id_connaissement'].'navire_con' ?>><?php echo $aff['id_navire'] ?></span>
<span id=<?php echo $aff['id_connaissement'].'produit_con' ?>><?php echo $aff['id_produit'].'-'.$aff['poids_kg'] ?></span>

<td style="display: flex; justify-content: center; vertical-align:middle;"><a data-role="modifier_connaissement" data-id="<?php echo $aff['id_connaissement']; ?>" ><i class="fas fa-edit"></i></a>
<a onclick="deleteConnaissement(<?php echo $aff['id_connaissement'] ?>)"><i class="fas fa-trash"></i></a></td>

 </tr>
 <?php } ?> 

	

 	</tr>
</table>
</div>
