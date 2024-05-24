<?php 	
require('../database.php');
require('controller/les_intervenants.php');
$choix_intervenant=$_POST['choix_intervenant'];
$produit=$_POST['produit'];
$poids_sac=$_POST['poids_sac'];
$destination=$_POST['destination']; 
$navire=$_POST['navire']; 

$verifier=$bdd->prepare('SELECT id from intervenant_reception where id_produit=? and poids_sac=? and id_navire=? and id_destination=? and id_intervenant=? ');

$verifier->bindParam(1,$produit);
$verifier->bindParam(2,$poids_sac);
$verifier->bindParam(3,$navire);
$verifier->bindParam(4,$destination); 
$verifier->bindParam(5,$choix_intervenant); 
$verifier->execute();

$verifiers=$verifier->fetch();

if(empty($verifiers)){

$insertion=$bdd->prepare("INSERT INTO intervenant_reception(id_intervenant,id_produit,poids_sac,id_navire,id_destination) values(?,?,?,?,?)");
$insertion->bindParam(1,$choix_intervenant);
$insertion->bindParam(2,$produit);
$insertion->bindParam(3,$poids_sac);
$insertion->bindParam(4,$navire);
$insertion->bindParam(5,$destination); 
$insertion->execute();

$reussi=1;

	}

	if(!empty($verifiers)){
		$reussi=0;

	} ?>

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
  <span style="color: black; font-size: 16px; font-weight: bold;"> SIMAR</span>
  
</div>
<?php   $les_intervenants=afficher_les_intervenants($bdd,$produit, $poids_sac,$navire,$destination);
while($inter=$les_intervenants->fetch()){ ?>
<div class="col col-md-<?php echo $col; ?> col-lg-<?php echo $col; ?>" style="color: black; font-size: 16px; font-weight: bold;">
  <span style="color: black; font-size: 16px; font-weight: bold;"> <?php  echo $inter['nom_intervenant'] ?></span>
  
</div>
<?php  } ?>

<br> <br> <br>  <br> <br> <br> 


</div></div> </center>

<?php if($reussi==0){ ?>
	<script type="text/javascript">
	  Swal.fire({
        icon: 'error',
        title: 'Erreur',
        text: ' Erreur cette  intervenant a deja ete choisi.',
        confirmButtonText: 'OK'
    }); 
	  </script>

	  <?php 	
} ?>

<?php if($reussi==1){ ?>
	<script type="text/javascript">
	  Swal.fire({
        icon: 'success',
        title: 'Reussi',
        text: ' Intervenant ajoute avec succes.',
        confirmButtonText: 'OK'
    }); 
	  </script>

	  <?php 	
} ?>
