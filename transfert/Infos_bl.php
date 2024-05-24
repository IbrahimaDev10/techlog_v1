<?php require('../database.php');
require('controller/increment_bl.php');
$produit=$_POST['produit'];
$poids_sac=$_POST['poids_sac'];
$navire=$_POST['navire'];
$destination=$_POST['destination'];
$statut=$_POST['statut'];

$client=$_POST['client'];


function type_de_navires($bdd,$navire){
  $type_de_navires=$bdd->prepare('SELECT type from navire_deb where id=?');
  $type_de_navires->bindParam(1,$navire);
  $type_de_navires->execute();
  return $type_de_navires;
}
$type_de_navires=type_de_navires($bdd,$navire);
$type=$type_de_navires->fetch();

if($type['type']=='SACHERIE'){

$bl=increment_bl($bdd,$produit,$poids_sac,$destination,$navire);
$bls=$bl->fetch();
}

if($type['type']=='VRAQUIER'){

$bl=increment_bl_vrac($bdd,$produit,$poids_sac,$destination,$navire,$client);
$bls=$bl->fetch();
}
?>
<?php if($bls){ ?>
<span style="display:none;">BL NUM</span> <span style="display:none;" id='num_du_bl'> <?php echo $bls['bl'] +1; ?></span>
<?php } ?>
<?php if(!$bls) { ?>
<span>BL NUM</span><span id='num_du_bl'> 1</span>
<?php } ?>
<script type="text/javascript">
	function get_bl(){
	var ab=$('#num_du_bl').text();
	var abInt=parseInt(ab);
	
	$('#blsain').val(abInt);
}
get_bl();
</script>