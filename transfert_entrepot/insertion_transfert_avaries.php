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
 $statut=$_POST['statut'];
  $etat_reception=$_POST['etat_reception'];
  
  $poids= $sac*$poids_sac/1000;





 
  /*   $insertRecep1= $bdd->prepare("INSERT INTO transfert_mouille(dates,heure,id_camion,id_chauffeur,id_declaration,sac_mouille,poids_mouille,id_destination,id_produit,poids_sac,id_navire) VALUES(?,?,?,?,?,?,?,?,?,?,?)"); */
$insertRecep1= $bdd->prepare("INSERT INTO transfert_des_avaries(dates,heure,id_camion,id_chauffeur,id_declaration,sac,poids,id_destination,id_produit,poids_sac,id_navire,etat_reception,statut) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)");


$insertRecep1->bindParam(1,$date); 
$insertRecep1->bindParam(2,$heure);
$insertRecep1->bindParam(3,$camion);
$insertRecep1->bindParam(4,$chauffeur);

$insertRecep1->bindParam(5,$dec);
$insertRecep1->bindParam(6,$sac);
$insertRecep1->bindParam(7,$poids);
$insertRecep1->bindParam(8,$destination);
$insertRecep1->bindParam(9,$produit);
$insertRecep1->bindParam(10,$poids_sac);
$insertRecep1->bindParam(11,$navire);
$insertRecep1->bindParam(12,$etat_reception);
$insertRecep1->bindParam(13,$statut);

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

/*
$manquant=0;
$select=$bdd->query("select id_trsain from transfert_sain order by id_trsain desc");
$sel=$select->fetch();
if($sel){
    $insert=$bdd->prepare("INSERT INTO pre_register_transfert(manquant,id_pre_transfert_sain) values(?,?)" );
    $insert->bindParam(1,$manquant);
    $insert->bindParam(2,$sel['id_trsain']);
    $insert->execute(); 

} */

 //echo "bienbienei endhddcnief"
  

  ?>


<div class="container-fluid" class=""<?php if($statut=='mouille'){ echo "id='TableMouille'";} 
elseif ($statut=='flasque') {
echo "id='TableMouille'";
}
elseif ($statut=='sain') {
echo "id='TableLivraison'";
}
else  {
echo "id='TableBalayure'";
}  ?>   >
      <div class="row">

           

        

<div class="col-md-12 col-lg-12">  
<br><br>    
<?php // $res4=res4($bdd,$produit,$poids_sac,$navire,$destination);
   //if($find=$res4->fetch()){ ?>     
<a class="btn1"  style="background:rgb(0,162,232); margin-bottom: 0 !important;" <?php if($statut=='mouille'){ echo "data-roles='afficher_formulaire_liv_mouille'";} 
elseif ($statut=='flasque') {
echo "data-roles='afficher_formulaire_liv_flasque'";
}
else  {
echo "data-roles='afficher_formulaire_liv_balayure'";
}  ?>  data-produit="<?php //echo $find['id_produit']; ?>" data-poids_sac="<?php //echo $find['poids_kg']; ?>" data-navire="<?php //echo $find['id_navire']; ?>" data-destination="<?php //echo $find['id_mangasin']; ?>" >AJOUTER TRANSFERT <?php echo strtoupper($statut); ?>  </a>
<?php  // } ?>

</div>
<div class="col-md-12 col-lg-12">

 <div class="table-responsive" border=1 style="margin-top: 0;">



  <table class='table table-hover table-bordered table-striped table-responsive' id='table_register' border='2' >

    

 <thead style="background:rgb(0,162,232);">
      <td  class="titreAVR" colspan="11"  >TRANSFERT DES <?php echo strtoupper($statut).'S'; ?></td> 
  
   <?php //$infos=afficher_infos($bdd,$produit,$poids_sac,$navire,$destination);
    //while($inf=$infos->fetch()){ 

     ?>
      <tr  style="background:rgb(0,162,232); color: white;  font-size: 12px; vertical-align: middle; border: none;"   >
     <td class="no_border"  colspan="2">NAVIRE: <span id="lesInfos"> <?php //echo $inf['navire']; ?></span></td>
      <td class="no_border" colspan="2">TYPE:<span id="lesInfos"> <?php //echo $inf['type']; ?></span></td>
      <td class="no_border" colspan="4">PRODUIT:<span id="lesInfos"> <?php //echo $inf['produit']; ?> <?php //echo $inf['qualite']; ?> </span></td>
        <td class="no_border" colspan="3">CONDITIONNEMENT:<span id="lesInfos"> <?php //echo $inf['poids_kg'].' KG';; ?></span></td>
        </tr>
        <tr  style="background:rgb(0,162,232); color: white; border-color: black; font-size: 12px; vertical-align: middle;"   >
         <td class="no_border" colspan="2">ENTREPOT:<span id="lesInfos"> <?php //echo $inf['mangasin']; ?></span></td>
          <td class="no_border" colspan="3">RECEPTIONNAIRE:<span id="lesInfos"> <?php //echo $inf['client']; ?></span></td>
           <td class="no_border" colspan="6"></td>
        </tr>
<?php //} ?>


      <?php 

 

       ?>

    
    <tr  style="background:rgb(0,162,232); text-align: center; color: white; font-weight: bold;"  >
      
      <td id="mytd" scope="col"   >DATE</td>
      <td id="mytd" scope="col" > HEURE</td>
      <td id="mytd" scope="col"  >N° DECLARATION</td>
      <td id="mytd" scope="col"  >N° RELACHE</td>
      <td id="mytd" scope="col"  >BL SIMAR</td>
      <td id="mytd" scope="col"  >BL FOURNISSEUR</td>
      <td id="mytd" scope="col"  >CAMION</td>
      <td id="mytd" scope="col"  >CHAUFFEUR</td>
      <td id="mytd" scope="col"  >SAC</td>
      <td id="mytd" scope="col"  >POIDS</td>
       <td id="mytd" scope="col"  >ACTIONS</td>
      

  
     </tr>
     
    
     </thead>

<tbody> 
  
<?php 
  affichage_transfert_avaries($bdd,$produit,$poids_sac,$navire,$destination,$statut); ?>


 </tbody>
</table>
</div>
</div>
</div>
</div>




 

