<?php require('../database.php');
      require('controller/afficher_navire.php');
      $navire=$_POST['navire'];
 ?>

 <div id="autres_inputs" >
<br>
<?php $bl_entrant=afficher_bl_entrant($bdd,$navire);
  
     ?>
	<select id="dec_entrant">
		<option>choisir declaration entrant</option>
		<?php while($bl=$bl_entrant->fetch()){ ?>
		<option value="<?php echo $bl['id_trans_extends'] ?>"><?php echo $bl['num_declaration'].' connaissement '.$bl['num_connaissement'].' destination '.$bl['mangasin']; ?></option>
		<?php } ?>	
	</select>
</div>