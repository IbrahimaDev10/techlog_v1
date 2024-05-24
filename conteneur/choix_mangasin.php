<?php 
require("../database.php");
require("controller/requete_reception.php");
?>
<select id="connaissement" class="mysel" style="margin-right: 3%; height: 30px;  width: 30%;" data-role="choix_mangasin">
	<option value="">selectionner le numero de connaissement</option>

<?php  
$mg= explode('-', $_POST['mangasin']) ;
$con=$mg[0];
$cli=$mg[1];
 $connaissement=getconnaissement($bdd,$con,$cli);

 while($connaissements=$connaissement->fetch()){


 ?>
 <option value="<?php echo $connaissements['id_bl'] ?>"><?php echo $connaissements['n_bl']; ?></option>
 <?php } ?>
</select>