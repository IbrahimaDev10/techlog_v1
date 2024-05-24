<?php require('../database.php');
require('controller/afficher_navire.php');

 $id_dis=$_POST['val_id_dis'];
 $id_dec=$_POST['val_id_declaration'];
 $poids=$_POST['poids'];
 $id=$_POST['val_id'];
 $navire=$_POST['val_id_navire'];
 if(!empty($_POST['poids'])){
$update=$bdd->prepare("UPDATE transit_extends set id_bl_extends=?, id_declaration_extends=?, poids_declarer_extends=? WHERE id_trans_extends=? ");
$update->bindParam(1,$id_dis);
$update->bindParam(2,$id_dec);
$update->bindParam(3,$poids);
$update->bindParam(4,$id);
$update->execute();
}
 ?>
 <?php if(!empty($update)){ ?>
 <div id="alerte1" class="alert alert-success"><i class="fas fa-close" style="float: right; top: 0;" data-role="fermer1"></i><center><span>MODIFIER AVEC SUCCESS</span></center> </div>
<?php } ?>

<?php if(empty($update)){ ?>
 <div id="alerte2" class="alert alert-danger"><center><span>ERREUR</span></center><i class="fas fa-close" style="float: right; top: 0;" data-role="fermer2"></i> </div>
<?php } ?>

<div class="container-fluid" id="partransit2" >
<?php afficher_declaration($bdd,$navire); ?>
      
</div>
<?php  ?>