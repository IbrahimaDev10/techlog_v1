<?php require('../database.php');


$id=$_POST['delete_id'];
$navire=$_POST['navire'];
$update=$bdd->prepare("DELETE from dispats WHERE id_dis=?");

$update->bindParam(1,$id);
$update->execute(); 

$afficher=$bdd->prepare("SELECT dis.*, cli.client,nc.num_connaissement,nc.poids_kg, nc.poids_connaissement, mg.mangasin, p.produit,p.qualite from dispats as dis
   # inner join declaration as d on d.id_declaration=dis.declaration_id 
    inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis 
	inner join client as cli on nc.id_client=cli.id
	inner join mangasin as mg on dis.id_mangasin=mg.id
	inner join produit_deb as p on nc.id_produit=p.id
	
  where nc.id_navire=?");
$afficher->bindParam(1,$navire);
$afficher->execute(); ?>

	 <div  class="table-responsive" border=1 id='tableau_dispatching' >
          <center>
 <table  class='table table-hover table-bordered table-striped'  border='2'  >
 	<thead>
 		<td colspan="7" style="background: blue; color:white; text-align:center;">DONNEES DEJA INSERES</td>
 	<tr style="color: white; background: blue; font-size:12px;">
 	<th>BL</th>
 	<th>CLIENT</th>
 	<th>PRODUIT</th>
 	<th>SAC</th>
 	<th>POIDS</th>
 	<th>TONNAGE</th>
 	<th>DESTINATION</th>
 	<th>ACTION</th>
 	
 </tr>
 	</thead>
<tbody>
 <?php while($aff=$afficher->fetch()){ ?>
<tr  style="background: white; color:black; text-align:center; vertical-align: middle;">
	<td><?php echo $aff['num_connaissement'] ?></td>
	<td><?php echo $aff['client'] ?></td>

	<td><?php echo $aff['produit'] ?> <?php echo $aff['qualite'] ?> <?php echo $aff['poids_kg'].' KG' ?></td>

	<td><?php echo $aff['quantite_sac'] ?></td>

	<td><?php echo $aff['poids_connaissement'] ?></td>

	<td><?php echo $aff['quantite_poids'] ?></td>

	<td><?php echo $aff['mangasin'] ?></td>
    <td style="display: flex; justify-content: center; vertical-align:middle;"><a data-role="modifier_dispatching" data-id="<?php echo $aff['id_dis']; ?>" ><i class="fas fa-edit"></i></a>
<a onclick="deleteDispatching(<?php echo $aff['id_dis'] ?>)"><i class="fas fa-trash"></i></a></td> 
<span id=<?php echo $aff['id_dis'].'navire_diss' ?>><?php echo $aff['id_navire'] ?></td>
 <?php } ?>

	</tbody>

 	</tr>
</table>
</div>
