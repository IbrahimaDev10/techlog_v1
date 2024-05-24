<?php
require('../../../database.php');
// require('../../controller/control_excedent_sur_declaration.php');
 require('../../controller/afficher_les_debarquements.php');
// require('controller/afficher_les_filtres.php');
 
if(isset($_POST['delete_id'])){
	$id = $_POST['delete_id'];
	$c=$_POST['dis_bl'];
  $poids_sac=$_POST['poids_sac'];
  $produit=$_POST['id_produit'];
  $destination=$_POST['id_destination'];
  $navire=$_POST['id_navire'];
  $declaration=$_POST['id_declaration'];
  $statut=$_POST['statut'];
  $client=$_POST['client'];
  $transfert_sain=$_POST['transfert_sain'];

    $cale_filtre='';
  $date_filtre='';

  echo $produit;
  echo $poids_sac;
  echo $client;
  echo $statut;

$supprimerDemande=$bdd->prepare('delete from transfert_debarquement where id_register_manif=?');
$supprimerDemande->bindParam(1, $id);
 $supprimerDemande->execute();
 $supprimerDemande->closeCursor();

 
    

  
    $filtreColonne= filtreColonne($bdd,$produit,$poids_sac,$navire,$destination,$client);

  $resfiltre =resfiltre($bdd,$produit,$poids_sac,$navire,$destination,$client);
        ?>
  
 <div class="container-fluid bg-white" id="TableSain" >

<input type="text" name="" id="input_statut" value="<?php echo $statut ?>" >

    <div class="row">     
<?php //include('recap_debarquement.php'); ?> 
<?php //include('suivi_de_declaration.php'); ?>  

<?php include('../../entete_tableau.php'); ?>

 
    <tbody>
    <?php   /*if($type_navire_deb['type']=='SACHERIE'){ affichage_sain_new($bdd,$produit,$poids_sac,$navire,$destination,$statut);
    }  */        

         affichage_sain_new($bdd,$produit,$poids_sac,$navire,$destination,$statut,$client,$date_filtre,$cale_filtre);
      ?> 
    </tbody>       

            

</table>
<?php //include('pied_tableau.php'); ?>
</div>


</div>
</div>



<?php } ?>
