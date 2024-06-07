<?php 
require("../../../database.php");
    require '../../../vendor/autoload.php';
    use Pro\TechlogNewVersion\Entete_tableaux_vrac;
 //require('controller/control_excedent_sur_declaration.php');
 require('../../controller/afficher_les_debarquements.php');
  //require('controller/afficher_les_filtres.php');
if(isset($_POST['id'])){
     $date=$_POST['date'];
   $d=explode('-', $date);
   $insertdate=$d[2].'-'.$d[1].'-'.$d[0];
   $heure=$_POST['heure'];
   $cale=$_POST['id_cale'];
   $declaration=$_POST['declaration'];
   $camion=$_POST['camion'];
   $chauffeur=$_POST['chauffeur'];
   $bl=$_POST['bl'];
   $c=$_POST['dis_bl'];
   $sac=$_POST['sac'];
   $poids_sac=$_POST['poids_sac'];
  // $poids=$_POST['sac']*$poids_sac/1000;
  $id=$_POST['id'];
  $produit=$_POST['id_produit'];
  $destination=$_POST['id_destination'];
  $navire=$_POST['id_navire'];
  $type= $_POST['type'];
  $statut=$_POST['statut'];
  $poids=$_POST['poids'];

  $sac_cale=$_POST['sac_cale'];
  $sac_reconditionne=$_POST['sac_reconditionne'];
  $id_detail=$_POST['id_detail'];
  $destinataire=$_POST['destinataire'];

  $client=$_POST['client'];

  $date_filtre='';
  $cale_filtre='';

    $type_de_navire=type_de_navire($bdd,$navire);

    $type_navire_deb=$type_de_navire->fetch();
  
  if(!empty($_POST['date']) and !empty($_POST['heure']) and !empty($_POST['id_cale']) and !empty($_POST['camion']) and !empty($_POST['chauffeur']) and !empty($_POST['bl'])){



  

 if ($type=="SACHERIE") {
     # code...
 
  //$calPoids=$sac*$poids_sac/1000; 
 
  } 
  if($poids_sac!=0 AND $statut!='flasque' ){
    $sac=$_POST['sac'];
    $calPoids=$sac*$poids_sac/1000;
  }
    if($poids_sac==0 AND $statut!='flasque'  ){
    $sac=$_POST['sac'];
    $calPoids=$_POST['poids'];
  }
   if($statut=='flasque'){
    $sac=$_POST['sac'];
    $calPoids=$_POST['poids'];
  }

  


 //$rob_dec_verif_dec=control_excedent_sur_declaration1($bdd,$produit,$poids_sac,$navire,$destination,$declaration);


      //    $rob_dec_verif_dec2=control_excedent_sur_declaration2($bdd,$produit,$poids_sac,$navire,$destination,$declaration);


  //  $row10=$rob_dec_verif_dec->fetch();
  
 /*     $row102=$rob_dec_verif_dec2->fetch(); 
      $rob_poidsD=$row10['poids_declarer_extends']-$row10['sum(rm.poids)']-$row102['sum(tr.poids_flasque_tr_av)']-$row102['sum(tr.poids_mouille_tr_av)']-$calPoids;

      $exces=$rob_poidsD;

  if($rob_poidsD>=0){ */

	$update=$bdd->prepare("UPDATE transfert_debarquement set dates=?, heure=?, bl=?, camions=?, chauffeur=?, id_declaration=?, cale=?, sac=?, poids=?, destinataire=?  where id_register_manif=?");
	$update->bindParam(1,$insertdate);
	$update->bindParam(2,$heure);
	$update->bindParam(3,$bl);
	$update->bindParam(4,$camion);
    $update->bindParam(5,$chauffeur);
    $update->bindParam(6,$declaration);
    $update->bindParam(7,$cale);
    $update->bindParam(8,$sac);
    $update->bindParam(9,$calPoids);
    $update->bindParam(10,$destinataire);
    $update->bindParam(11,$id);

	
	$update->execute();



}
else{

   echo '<div class="alert alert-danger" >ECHEC <i class="fas fa-close" style="" float:right;"  aria-label="Close"></i></div>';

  }
   }  

   if(!empty($sac_cale) and !empty($sac_reconditionne) and !empty($id_detail)  ){
    $poids_cale=$sac_cale*$poids_sac/1000;
    $poids_reconditionne=$sac_reconditionne*$poids_sac/1000;

    $update2=$bdd->prepare('UPDATE detail_chargement set sac_cale=?, poids_cale=?, sac_reconditionne=?, poids_reconditionne=? where id_detail=?');
    $update2->bindParam(1,$sac_cale);
    $update2->bindParam(2,$poids_cale);
    $update2->bindParam(3,$sac_reconditionne);
    $update2->bindParam(4,$poids_reconditionne);
    $update2->bindParam(5,$id_detail);
    $update2->execute();
   }    

    if(!empty($sac_cale) and !empty($sac_reconditionne) and empty($id_detail)  ){
    $poids_cale=$sac_cale*$poids_sac/1000;
    $poids_reconditionne=$sac_reconditionne*$poids_sac/1000;

    $update2=$bdd->prepare('INSERT INTO detail_chargement(sac_cale,poids_cale,sac_reconditionne, poids_reconditionne,register_manif_id) VALUES(?,?,?,?,?)');
    $update2->bindParam(1,$sac_cale);
    $update2->bindParam(2,$poids_cale);
    $update2->bindParam(3,$sac_reconditionne);
    $update2->bindParam(4,$poids_reconditionne);
    $update2->bindParam(5,$id);
    
    $update2->execute();
   }    

    

    $resfiltre =resfiltre($bdd,$produit,$poids_sac,$navire,$destination,$client);
    $filtreColonne= filtreColonne($bdd,$produit,$poids_sac,$navire,$destination,$client);


//$resfil=$resfiltre->fetch();
//$filtre=$filtreColonne->fetch();


 


      

	?>


<div class="container-fluid" id="TableSain" >

<input type="text" name="" id="input_statut" value="<?php echo $statut; ?>" >

 <div class="row";>

 <?php //include('recap_debarquement.php'); ?> 
<?php //include('suivi_de_declaration.php'); ?>

<br><br>
<?php include('../../entete_tableau.php') ?>
    <tbody id='tbody_transfert_deb'>
    <?php    affichage_sain_new($bdd,$produit,$poids_sac,$navire,$destination,$statut,$client,$date_filtre,$cale_filtre); ?> 
    </tbody>       

            

</table>
<?php //include('pied_tableau.php'); ?>
</div>


</div>
</div>

<?php 
if($update){
 ?>
<script type="text/javascript">
    swal.fire({
        icon:'success',
        title:'Reussi',
        text:'Enregistrement modifie avec success',
        confirmButtonText:'OK'
    });
</script>
<?php   } ?>




