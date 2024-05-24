<?php 
require('../database.php');
require('controller/les_intervenants.php'); 

$id=$_POST['delete_id'];
$produit=$_POST['produit'];
$poids_sac=$_POST['poids_sac'];
$destination=$_POST['destination'];
$navire=$_POST['navire'];

$delete=$bdd->prepare('delete from intervenant_reception where id=?');
$delete->bindParam(1,$id);
$delete->execute();

?>

<center> 
<div class="container-fluid" id='liste_intervenant'>
<div class="row">

  <?php  $compte_intervenants= compte_intervenants($bdd,$produit, $poids_sac,$navire,$destination);
        $compte=$compte_intervenants->fetch();
         $col=1; 
         $col_simar=1;
         if($compte['count(inter_rep.id)']==0){
          $col=0;
          $col_simar=12;
         }
          if($compte['count(inter_rep.id)']==1){
          $col=6;
          $col_simar=6;
         }
         if($compte['count(inter_rep.id)']==2){
          $col=4;
          $col_simar=4;
         }
         if($compte['count(inter_rep.id)']==3){
          $col=3;
          $col_simar=3;
         }
         if($compte['count(inter_rep.id)']==4){
          $col=2;
          $col_simar=4;
         }
         if($compte['count(inter_rep.id)']==5){
          $col=2;
          $col_simar=2;
         } ?>
 
<div class="col col-md-<?php echo $col_simar; ?> col-lg-<?php echo $col_simar; ?>" style="">
  <span style="color: black; font-size: 16px; font-weight: bold; text-decoration: underline;"> SIMAR</span>
  
</div>
<?php   $les_intervenants=afficher_les_intervenants($bdd,$produit, $poids_sac,$navire,$destination);
while($inter=$les_intervenants->fetch()){ ?>
<div class="col col-md-<?php echo $col; ?> col-lg-<?php echo $col; ?>" style="color: black; font-size: 16px; font-weight: bold;">
  <span style="color: black; font-size: 16px; font-weight: bold; text-decoration: underline;"> <?php  echo $inter['nom_intervenant'] ?></span> <a title='supprimer ' style="color: blue;" data-role='supprimer_intervenant'  onclick="deleteIntervenant(<?php echo $inter['id'] ?>)" data-prod='<?php echo $produit ?>' data-poids_sac='<?php echo $poids_sac ?>' data-navire='<?php echo $navire ?>' data-destination='<?php echo $destination ?>' >> <i class="fas fa-trash"></i></a>
  
</div>
<?php  } ?>




</div></div> </center>