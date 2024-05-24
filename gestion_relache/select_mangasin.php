<?php require('../database.php'); 
  $id_con_dis=$_POST['id_con_dis'];
  $id_mangasin=$_POST['id_mangasin'];
  $id_produit=$_POST['id_produit'];
  $poids_kg=$_POST['poids_kg'];

  $afficher_select=$bdd->prepare('SELECT dis.*,mg.mangasin from dispat as dis 
  	inner join mangasin as mg on mg.id=dis.id_mangasin
  	WHERE dis.id_produit=? AND dis.poids_kg=? AND dis.id_con_dis=? AND dis.id_mangasin!=? ');
  $afficher_select->bindParam(1,$id_produit);
  $afficher_select->bindParam(2,$poids_kg);
  $afficher_select->bindParam(3,$id_con_dis);
  $afficher_select->bindParam(4,$id_mangasin);
  $afficher_select->execute();
?>
<select class="form-control" id='mangasin_form2'>
	<?php while($afficher_sel=$afficher_select->fetch()){ ?>
<option value="<?php echo $afficher_sel['id_dis'] ?>"> <?php echo $afficher_sel['mangasin'] ?></option>
<?php } ?>
</select>