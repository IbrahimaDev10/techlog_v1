<?php 
 require('../../../database.php');
 require('../../controller/afficher_les_debarquements.php');
 //require('controller/control_excedent_sur_declaration.php');
 //require('controller/afficher_les_filtres.php');
    // code...
      
 
$id_di= $_POST['id_dis'];
$type= $_POST['type'];
$poids_sac= $_POST['poids_sac'];
$navire= $_POST['navire'];
 $destinataire= $_POST['destinataire'];
 $client= $_POST['client'];
 $destination= $_POST['mangasin'];
  $bl= $_POST['bl'];
  $produit= $_POST['id_produit'];
  $statut=$_POST['statut'];
  $etat='non';
  $etat_pont='non';
  //$bon=$_POST['bon'];

  $cale_filtre='';
  $date_filtre='';

  $transfert_sain=$_POST['transfert_sain'];

  $remorque=$_POST['val_input_remorque'];

      $type_de_navire=type_de_navire($bdd,$navire);

    $type_navire_deb=$type_de_navire->fetch();

  $resfiltre =resfiltre($bdd,$produit,$poids_sac,$navire,$destination,$client);
    $filtreColonne= filtreColonne($bdd,$produit,$poids_sac,$navire,$destination,$client);
//$resfil2=$resfiltre->fetch();

//$filtre2=$filtreColonne->fetch();
 
 echo $poids_sac;

/* if( ( !empty($_POST['dates']) and !empty($_POST['sac']) and !empty($_POST['declaration']) and !empty($_POST['cale']) and !empty($_POST['sac']) and !empty($_POST['val_input2']) and !empty($_POST['val_input2c'])  and !empty($_POST['heure']) and $resfil['poids_kg']!=0 ) OR ( !empty($_POST['dates'])  and !empty($_POST['declaration']) and !empty($_POST['cale'])  and !empty($_POST['val_input2']) and !empty($_POST['val_input2c'])  and !empty($_POST['heure'])  )  ){ */
try{
  $declaration= $_POST['declaration'];
   
   $sac= $_POST['sac'];
   if ( ($poids_sac!=0) and ($statut=='sain' or $statut=='mouille' and $type=='SACHERIE') ) {
     # code...
 
  $calPoids=$sac*$poids_sac/1000; 
 
  } 

  if ( ($poids_sac!=0) and ($statut=='flasque' or $statut=='balayure'  and $type=='SACHERIE' ) ) {
     # code...
 
  $calPoids=$_POST['poids']; 
 
  } 
  if ($poids_sac==0) {
     # code...
    $sac=0;
  $calPoids=$_POST['poids']; 
  
  }

  if ($poids_sac!=0 and $type=='VRAQUIER') {
     # code...
 
  $calPoids=$sac*$poids_sac/1000; 
 
  }

  /*  $rob_dec_verif_dec=control_excedent_sur_declaration1($bdd,$produit,$poids_sac,$navire,$destination,$declaration);


          $rob_dec_verif_dec2=control_excedent_sur_declaration2($bdd,$produit,$poids_sac,$navire,$destination,$declaration);


    $row10=$rob_dec_verif_dec->fetch();
  
      $row102=$rob_dec_verif_dec2->fetch(); 
      $rob_poidsD=$row10['poids_declarer_extends']-$row10['sum(rm.poids)']-$row102['sum(tr.poids_flasque_tr_av)']-$row102['sum(tr.poids_mouille_tr_av)']-$calPoids;

      $exces=$rob_poidsD; */
  

    $date= $_POST['dates'];
 $heure= $_POST['heure'];

 
 
 $cale= $_POST['cale'];


 $camions= $_POST['val_input2'];
 $chauffeur= $_POST['val_input2c'];
 
 // $_POST['poids'];


 


       
     // if($rob_poidsD>=0){



 
     $insertRecep1= $bdd->prepare("INSERT INTO transfert_debarquement(dates,heure,cale,bl,id_dis_bl,camions,chauffeur,id_declaration,sac,poids,id_produit,poids_sac,id_client,id_destination,id_navire,destinataire,statut,etat_reception,remorque_id,etat_pont) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)"); 



$insertRecep1->bindParam(1,$date); 
$insertRecep1->bindParam(2,$heure);

$insertRecep1->bindParam(3,$cale);
$insertRecep1->bindParam(4,$bl);
$insertRecep1->bindParam(5,$id_di);
$insertRecep1->bindParam(6,$camions);
$insertRecep1->bindParam(7,$chauffeur);


$insertRecep1->bindParam(8,$declaration);
$insertRecep1->bindParam(9,$sac);
$insertRecep1->bindParam(10,$calPoids);

$insertRecep1->bindParam(11,$produit);
$insertRecep1->bindParam(12,$poids_sac);
$insertRecep1->bindParam(13,$client);
$insertRecep1->bindParam(14,$destination);
$insertRecep1->bindParam(15,$navire);


$insertRecep1->bindParam(16,$destinataire);
$insertRecep1->bindParam(17,$statut);
$insertRecep1->bindParam(18,$etat);
$insertRecep1->bindParam(19,$remorque);
$insertRecep1->bindParam(20,$etat_pont);
//$insertRecep1->bindParam(20,$bon);

$insertRecep1->execute();


$manquant=0;

if($type=='SACHERIE' or $type=='VRAQUIER'){
if(!empty($_POST['sac_cale']) and !empty($_POST['sac_reconditionne'])){
  $sac_cale=$_POST['sac_cale'];
  $sac_reconditionne=$_POST['sac_reconditionne'];
  $poids_cale=$sac_cale*$poids_sac/1000;
  $poids_reconditionne=$sac_reconditionne*$poids_sac/1000;

  $sac_detail_exact=$sac_cale+$sac_reconditionne;

//if($sac_detail_exact==$sac){
$select=$bdd->query("select id_register_manif from transfert_debarquement order by id_register_manif desc");
$sel=$select->fetch();
if($sel){
    $insert=$bdd->prepare("INSERT INTO detail_chargement(sac_cale,poids_cale,sac_reconditionne,poids_reconditionne,register_manif_id) values(?,?,?,?,?)" );
    $insert->bindParam(1,$sac_cale);
    $insert->bindParam(2,$poids_cale);
    $insert->bindParam(3,$sac_reconditionne);
    $insert->bindParam(4,$poids_reconditionne);
    $insert->bindParam(5,$sel['id_register_manif']);
    $insert->execute();

}
} 
}
//else{
  ?><!-- <div class='alert alert-danger'><h4>VEUILLEZ VERIFIER SI LA SOMME DES SACS DETAILLE CORRESPOND AU NOMBRE DE SAC DU BL</h4></div> !-->
  <?php 
//}



//}
}


catch(PDOException $e){
    die('Erreur:' .$e->getMessage());
    
}
// fin empty}
//}




        



    // arrêt du script pour éviter l'affichage de la page actuelle après la soumission du formulaire 
?>


<div class="container-fluid bg-white" id="TableSain" <?php if($transfert_sain==0){ ?> style="display: none; <?php } ?> width: 100%;">

<input type="" name="" id="input_statut" value="<?php echo $statut; ?>">






  
<?php   ?>

</div>


<?php /* if(!empty($rob_poidsD) and $rob_poidsD<0){ 
$nom_declaration_exces=$bdd->prepare("SELECT dc.num_declaration from transit_extends as ex inner join declaration as dc on dc.id_declaration=ex.id_declaration_extends where id_trans_extends=?");
     $nom_declaration_exces->bindParam(1,$declaration);
     $nom_declaration_exces->execute(); ?>
<center><div  class="err" id="LesErreurs" ><a  type="button" class="btn-close"  id="close_erreur" data-role="fermer" ></a><h3 id="perreur" > ERREUR</h3>
 <h5 id="perreur"> IL Y'A DEPASSEMENT AU NIVEAU DE LA DECLARATION DE <span style="color: black">  <?php if($le_nom_dec=$nom_declaration_exces->fetch()){  echo $le_nom_dec['num_declaration']; } ?></span> de <span style="color:blue; ">   <?php  echo $exces.' TONNES';  ?> </span> </h5></div></center>
<?php } */ ?>

 <div class="row">

<?php //include('recap_debarquement.php'); ?> 
<?php //include('suivi_de_declaration.php'); ?>

  <?php include('../../entete_tableau.php'); ?>
  <div class="table-body" id="tbody_transfert_deb" onscroll="fixerEnTeteTableau()">
    <tbody  >
    <?php    //if($type_navire_deb['type']=='VRAQUIER'){ affichage_sain_new_vrac($bdd,$produit,$poids_sac,$navire,$destination,$statut,$client);
   // }
    // if($type_navire_deb['type']=='SACHERIE'){ 
      affichage_sain_new($bdd,$produit,$poids_sac,$navire,$destination,$statut,$client,$date_filtre,$cale_filtre);
    //}   ?> 
    </tbody>   
    </div>        

            

</table>
<?php //include('pied_tableau.php'); ?>
</div>


</div>
</div>




<?php  
  
if($insertRecep1){
  ?>
  <script type="text/javascript">
     Swal.fire({
        icon: 'success',
        title: 'Reussi',
        text: 'Ce camion est transfere avec succes.',
        confirmButtonText: 'OK'
    }); 
  </script>

 <?php  
}
?> 


 

