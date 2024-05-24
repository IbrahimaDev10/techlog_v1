<?php require('../../database.php');

$produit=$_POST['produit'];
$poids_sac=$_POST['poids_sac'];
$destination=$_POST['destination'];

$navire=$_POST['navire'];
$client=$_POST['client']; 
$tare_sac=$_POST['tare_sac']; 

$statut='sain';

$verifier=$bdd->prepare('SELECT poids_tare_sac from tare_sac where id_produit_tare=? and poids_sac_tare=? and id_navire_tare=? and id_destination_tare=? and id_client_tare=?');
$verifier->bindParam(1,$produit);
$verifier->bindParam(2,$poids_sac);
$verifier->bindParam(3,$navire);
$verifier->bindParam(4,$destination);
$verifier->bindParam(5,$client);
$verifier->execute();

$verif=$verifier->fetch();

if(!$verif){
$insert=$bdd->prepare('INSERT INTO tare_sac(poids_tare_sac,id_produit_tare,poids_sac_tare,id_navire_tare,id_destination_tare,id_client_tare) values(?,?,?,?,?,?)');
$insert->bindParam(1,$tare_sac);
$insert->bindParam(2,$produit);
$insert->bindParam(3,$poids_sac);
$insert->bindParam(4,$navire);
$insert->bindParam(5,$destination);
$insert->bindParam(6,$client);
$insert->execute();
}
else{

?>
<script type="text/javascript">
	 Swal.fire({
        icon: 'error',
        title: 'Erreur',
        text: 'Vous avez deja enregistrer un tare sac',
        confirmButtonText: 'OK'
    });
</script>

<?php 	} ?>


 
   
