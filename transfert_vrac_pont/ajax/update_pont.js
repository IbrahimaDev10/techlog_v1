<?php 
 require('../../../database.php');

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

/*
  $net_pont_bascule=$poids_brut-$tare_vehicule;
        
    
     $net_marchand=$net_pont_bascule-$sac*$tare_sac/1000; */
     

$insert=$bdd->prepare("UPDATE pont_bascule set ticket_ponts=? ,poids_bruts=? ,tare_vehicules=? , poids_net=? , date_pont=? where id_pont=?) values(?,?,?,?,?,?) ");
$insert->bindParam(1,$ticket);
$insert->bindParam(2,$poids_brut);
$insert->bindParam(3,$tare_vehicule);


$insert->bindParam(4,$net_marchand);
$insert->bindParam(5,$dates);
$insert->bindParam(6,$id);
$insert->execute(); ?>


<div class="container-fluid bg-white" id="Table_pont" style="background: white; border: solid; border-radius: 2%;">



  <br>    



<div class="row">

 <?php //include('recap_debarquement.php'); ?> 
<?php //include('suivi_de_declaration.php'); ?>

<br><br>
  
 <?php include('../entete_tableau_pont.php'); ?>
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
