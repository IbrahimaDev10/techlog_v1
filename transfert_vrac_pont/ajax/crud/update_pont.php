<?php 
 require('../../../database.php');
 require('../../controller/afficher_pont_bascule.php');

$navire=$_POST['navire'];
$produit=$_POST['produits'];
$poids_sac=$_POST['poids_sac'];
$destination=$_POST['destination'];
$client=$_POST['client'];

$ticket=$_POST['ticket'];
$poids_brut=$_POST['poids_brut'];

$tare_vehicule=$_POST['tare_vehicule'];
$id=$_POST['id'];
$dates=$_POST['dates'];
$sac=$_POST['sac'];
$tare_sac=$_POST['tare_sac'];
$net_marchand=$_POST['net_marchand'];
$statut='sain';


$net_pont=$poids_brut-$tare_vehicule;

        
    if(!empty($tare_sac)){
    $net_marchand=$net_pont/1000-$sac*$tare_sac/1000;
  }
      if(empty($tare_sac)){
    $net_marchand=$net_pont/1000;
  }

    $net_marchands=str_replace(',', '.', $net_marchand);

    $net_marchand_decimal = floatval($net_marchands);
     

$insert=$bdd->prepare("UPDATE pont_bascule set ticket_ponts=? ,poids_bruts=? ,tare_vehicules=? , poids_net=? , date_pont=? where id_pont=? ");
$insert->bindParam(1,$ticket);
$insert->bindParam(2,$poids_brut);
$insert->bindParam(3,$tare_vehicule);


$insert->bindParam(4,$net_marchand_decimal);
$insert->bindParam(5,$dates);
$insert->bindParam(6,$id);
$insert->execute(); ?>


<div class="container-fluid bg-white" id="Table_pont" style="background: white; border: solid; border-radius: 2%;">

<?php 
 echo  $navire;
echo   $produit;
echo   $poids_sac;
 echo  $destination;
 echo  $client;

 ?>

  <br>    



<div class="row">

 <?php //include('recap_debarquement.php'); ?> 
<?php //include('suivi_de_declaration.php'); ?>

<br><br>
  
 <?php include('../../entete_tableau_pont.php'); ?>
 <div class="table-body" id="tbody_transfert_deb" >
    <tbody  >
    <?php    //if($type_navire_deb['type']=='VRAQUIER'){ affichage_sain_new_vrac($bdd,$produit,$poids_sac,$navire,$destination,$statut,$client);
   // }
    // if($type_navire_deb['type']=='SACHERIE'){ 
     affichage_pont_bascule($bdd,$produit,$poids_sac,$navire,$destination,$statut,$client);
    //}   ?> 
    </tbody>   
    </div>    

            

</table>
<?php //include('pied_tableau.php'); ?>
</div>


</div>
</div>
