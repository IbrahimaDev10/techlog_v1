<?php 
 require('../database.php');
 require('controller/afficher_les_transferts.php');
 require('controller/acces_transfert.php');
 //require('controller/afficher_les_debarquements.php');
 //require('controller/control_excedent_sur_declaration.php');
    // code...
      
 

$poids_sac= $_POST['poids_sac'];
$produit= $_POST['produit'];
$destination= $_POST['destination'];
$navire= $_POST['navire'];

$dec= $_POST['dec'];
 $sac= $_POST['sac'];
 $date= $_POST['date'];
 $heure= $_POST['heure'];
 $camion= $_POST['camion'];
 $chauffeur= $_POST['chauffeur'];
 
  
  $poids= $sac*$poids_sac/1000;





 
     $insertRecep1= $bdd->prepare("INSERT INTO transfert_sain(date_trsain,heure_trsain,camion_trsain,chauffeur_trsain,dec_trsain,sac_trsain,poids_trsain) VALUES(?,?,?,?,?,?,?)"); 



$insertRecep1->bindParam(1,$date); 
$insertRecep1->bindParam(2,$heure);
$insertRecep1->bindParam(3,$camion);
$insertRecep1->bindParam(4,$chauffeur);

$insertRecep1->bindParam(5,$dec);
$insertRecep1->bindParam(6,$sac);
$insertRecep1->bindParam(7,$poids);

$insertRecep1->execute();

/*
$manquant=0;

$select=$bdd->query("select id_register_manif from register_manifeste order by id_register_manif desc");
$sel=$select->fetch();
if($sel){
    $insert=$bdd->prepare("INSERT INTO pre_register_reception(manquant,id_pre_register_manif) values(?,?)" );
    $insert->bindParam(1,$manquant);
    $insert->bindParam(2,$sel['id_register_manif']);
    $insert->execute();


}

*/
/*else{
    echo "erreurrrrrrrrrrrrrrr";
}*/
$manquant=0;
$select=$bdd->query("select id_trsain from transfert_sain order by id_trsain desc");
$sel=$select->fetch();
if($sel){
    $insert=$bdd->prepare("INSERT INTO pre_register_transfert(manquant,id_pre_transfert_sain) values(?,?)" );
    $insert->bindParam(1,$manquant);
    $insert->bindParam(2,$sel['id_trsain']);
    $insert->execute();

}

 //echo "bienbienei endhddcnief"
  

  ?>


  <div class="container-fluid" class="" id="TableLivraison"  >
      <div class="row">

<div class="col-md-12 col-lg-12"> 
  <br>
<?php  $res4=res4($bdd,$produit,$poids_sac,$navire,$destination);
   if($find=$res4->fetch()){ ?>     
<a  class="btn1"  style="background:rgb(0,162,232);" data-roles="afficher_form_tr_sain" data-produit="<?php echo $produit; ?>" data-poids_sac="<?php echo $poids_sac; ?>" data-navire="<?php echo $navire; ?>" data-destination="<?php echo $destination; ?>" >AJOUTER LIVRAISON  </a>
<?php   } ?>
<br>

</div>
<div class="col-md-12 col-lg-12">

 <div class="table-responsive" border=1>



  <table class='table table-hover table-bordered table-striped table-responsive' id='table_register' border='2' >


    

 <thead style="background:rgb(0,162,232);">
      <td  class="titreAVR" colspan="11"  >TRANSFERTS SAINS</td> 
  
       
  
    <?php $res4=res4($bdd,$produit,$poids_sac,$navire,$destination);
    while($inf=$res4->fetch()){ 

     ?>
      <tr  style="background:rgb(0,162,232); color: white;  font-size: 12px; vertical-align: middle; border: none;"   >
     <td class="no_border"  colspan="2">NAVIRE: <span id="lesInfos"> <?php echo $inf['navire']; ?></span></td>
      <td class="no_border" colspan="2">TYPE:<span id="lesInfos"> <?php echo $inf['type']; ?></span></td>
      <td class="no_border" colspan="4">PRODUIT:<span id="lesInfos"> <?php echo $inf['produit']; ?> <?php echo $inf['qualite']; ?> </span></td>
        <td class="no_border" colspan="3">CONDITIONNEMENT:<span id="lesInfos"> <?php echo $inf['poids_kg'].' KG';; ?></span></td>
        </tr>
        <tr  style="background:rgb(0,162,232); color: white; border-color: black; font-size: 12px; vertical-align: middle;"   >
         <td class="no_border" colspan="2">ENTREPOT:<span id="lesInfos"> <?php echo $inf['mangasin']; ?></span></td>
          <td class="no_border" colspan="3">RECEPTIONNAIRE:<span id="lesInfos"> <?php echo $inf['client']; ?></span></td>
           <td class="no_border" colspan="6"></td>
        </tr>
<?php } ?>


        
    
    <tr  style="background:rgb(0,162,232); text-align: center; color: white; font-weight: bold;"  >
      
      <td class="colaffiches" scope="col"   >DATE</td>
      <td class="colaffiches" scope="col" > HEURE</td>
      <td class="colaffiches" scope="col"  >N° DECLARATION</td>
      <td class="colaffiches"  >N° RELACHE</td>
      <td class="colaffiches"  >BL SIMAR</td>
      <td class="colaffiches"  >BL FOURNISSEUR</td>
      <td class="colaffiches"  >CAMION</td>
      <td class="colaffiches"  >CHAUFFEUR</td>
      <td class="colaffiches"  >SAC</td>
      <td class="colaffiches"  >POIDS</td>
      <td class="colaffiches"  >ACTIONS</td>
      

  
     </tr>
     
    
     </thead>

<tbody> 
  <?php affichage_transfert_sain($bdd,$produit,$poids_sac,$navire,$destination); ?>
   

 




 </tbody>
</table>
</div>
</div>
</div>
</div>




 

