<?php require('../../database.php'); 
    $idm=$_POST['id_navire'];
	
		
		
		$produit=$_POST['produit'];
		$nombre_sac=$_POST['nombre_sac'];
		$poids_sac=$_POST['poids_sac'];
		
		$cale=$_POST['cale'];
		$nom_ch=$_POST['nom_chargeur'];

		$poids=$nombre_sac*$poids_sac/1000;
 
			 $insertCargoPlan= $bdd->prepare("INSERT INTO declaration_chargement(cales,nom_chargeur,nombre_sac,conditionnement,poids,id_produit,id_navire) VALUES(?,?,?,?,?,?,?)");
			 try{

		 $insertCargoPlan->bindParam(1,$cale);
		 $insertCargoPlan->bindParam(2,$nom_ch);
		 $insertCargoPlan->bindParam(3,$nombre_sac);
		 $insertCargoPlan->bindParam(4,$poids_sac);
		 $insertCargoPlan->bindParam(5,$poids);
		 $insertCargoPlan->bindParam(6,$produit);
		 $insertCargoPlan->bindParam(7,$idm);

		 $insertCargoPlan->execute();

		

	
	}
	catch(Exception $e){

	}
	

	


$afficher=$bdd->prepare("select dc.*, p.* from declaration_chargement as dc 
	inner join produit_deb as p on dc.id_produit=p.id

  where dc.id_navire=?");
$afficher->bindParam(1,$idm);
$afficher->execute();

?>

	 <div  class="table-responsive" border=1 id='donnees_cale'>
          <center>
 <table  class='table table-hover table-bordered table-striped'  border='2'  >
 	<thead>
 		<td colspan="6" style="background: rgb(0,141,202); color: white; text-align:center;">DONNEES DEJA INSEREES</td>
 	<tr style="background: rgb(0,141,202); color: white; text-align:center;">
 	<th>cale</th>
 	<th>produit</th>
 	<th>sac</th>
 	<th>poids_sac</th>
 	<th>tonnage</th>
 	<th>nom_chargeur</th>
 </tr>
 	
 	</thead>

 <?php while($aff=$afficher->fetch()){?>
 	<tr style="background: white; color: black; text-align: center; vertical-align: middle;">
<td ><?php echo $aff['cales'] ?></td>
<td ><?php echo $aff['produit'] ?></td>
<td ><?php echo $aff['nombre_sac'] ?></td>
<td ><?php echo $aff['conditionnement'] ?></td>
<td ><?php echo $aff['poids'] ?></td>
<td ><?php echo $aff['nom_chargeur'] ?></td>

 </tr>
 <?php } ?> 

	

 	</tr>
</table>
</div>
<?php if($insertCargoPlan){ ?>
<script type="text/javascript">
	  Swal.fire({
        icon: 'success',
        title: 'Reussi',
        text: 'Donnees enregistrees avec succes.',
        confirmButtonText: 'OK'
    });
</script>
<?php } ?>


