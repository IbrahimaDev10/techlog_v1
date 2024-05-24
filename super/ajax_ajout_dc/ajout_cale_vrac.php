<?php 
require('../../database.php'); 
$idm=$_POST['id_navire'];

	if(!empty($_POST['produit']) and !empty($_POST['tonnage'])  and !empty($_POST['cale']) ){
		//$nav=$_POST['navire'];
		
		$produit=$_POST['produit'];
		$tonnage=$_POST['tonnage'];
		$poids_sac=0;
		
		$cale=$_POST['cale'];
		$nom_ch=$_POST['nom_chargeur'];
		$nombre=0;


	
			 $insertCargoPlan= $bdd->prepare("INSERT INTO declaration_chargement(cales,nom_chargeur,nombre_sac,conditionnement,poids,id_navire,categories_id) VALUES(?,?,?,?,?,?,?)");
			 


	


		 $insertCargoPlan->bindParam(1,$cale);
		 $insertCargoPlan->bindParam(2,$nom_ch);
		 $insertCargoPlan->bindParam(3,$nombre);
		 $insertCargoPlan->bindParam(4,$poids_sac);
		 $insertCargoPlan->bindParam(5,$tonnage);
		 $insertCargoPlan->bindParam(6,$idm);
		 $insertCargoPlan->bindParam(7,$produit);

		 $insertCargoPlan->execute();

		

	
	

	 	 
	 

	}

	

$afficher=$bdd->prepare("select dc.*, c.* from declaration_chargement as dc 
	inner join categories as c on dc.categories_id=c.id_categories

  where dc.id_navire=?");
$afficher->bindParam(1,$idm);
$afficher->execute();

 ?>

 		 <div  class="table-responsive" border=1 id='donnees_cale'>
          <center>
 <table  class='table table-hover table-bordered table-striped'  border='2'  >
 	<thead>
 		<td colspan="4" style="background: rgb(0,141,202); color: white; text-align:center;">DONNEES DEJA INSEREES</td>
 	<tr style="background: rgb(0,141,202); color: white; vertical-align: middle; text-align: center;">
 	<th>cale</th>
 	<th>produit</th>
 	
 	<th>tonnage</th>
 	<th>nom_chargeur</th>
 </tr>
 	
 	</thead>

 <?php while($aff=$afficher->fetch()){?>
 	<tr style="background: white; color: black; text-align:center; vertical-align: middle;">
<td ><?php echo $aff['cales'] ?></td>
<td ><?php echo $aff['nom_categories'] ?></td>

<td ><?php echo $aff['poids'] ?></td>
<td ><?php echo $aff['nom_chargeur'] ?></td style="color: white;">

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