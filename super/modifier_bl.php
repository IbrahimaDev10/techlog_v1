<?php 	
require('../database.php');
require('controller/requete_predebarquement.php');

if (isset($_POST['id'])) {
    $b=$_POST['id_navire'];
   $type=$_POST['type_navire'];
    if($type=='VRAQUIER'){

      
    /*  $bl= $_POST['bl'];
      $id=$_POST['id'];
     
      $conditionnement=$_POST['cond'];
      $sac=$_POST['sac'];
      $b=$_POST['navire']; 
      $ex_produit=explode('-', $_POST['produit']);
      $id_produit=$ex_produit[0];
      $poids_kg=$ex_produit[1];
      $client=$_POST['client'];
      $destination=$_POST['destination'];
      $des_douane=$_POST['des_douane']; */
     // $banque=$_POST['banquedis'];
     // $poids=$_POST['sac']*$conditionnement/1000;
    
         //$qt_poids=$sac*$poids_kg/1000;
     
     $dec=$_POST['num_dec'];
     $poids_sac=$_POST['poids_sac'];
     $poids=$_POST['poids'];
     $type_decharge=$_POST['type_decharge'];
     $des_douane=$_POST['des_douane'];
     $id=$_POST['id'];
     $id_con_dis=$_POST['id_con_dis'];
     $poids2=str_replace(' ', '', $poids);

      
      
try{
     $insertRecep1= $bdd->prepare("UPDATE dispats set /*id_con_dis=?, quantite_sac=?,  id_client=?, id_produit=?, poids_kg=? , id_mangasin=?, quantite_poids=?, des_douane=?*/ quantite_poids=?, poids_kg=?, des_douane=?, type_decharge=?, id_mangasin=?, id_con_dis=?  where id_dis=? "); 
$insertRecep1->bindParam(1,$poids2); 
$insertRecep1->bindParam(2,$poids_sac);
$insertRecep1->bindParam(3,$des_douane); 
$insertRecep1->bindParam(4,$type_decharge);
$insertRecep1->bindParam(5,$dec);
$insertRecep1->bindParam(6,$id_con_dis);
$insertRecep1->bindParam(7,$id);

/*$insertRecep1->bindParam(3,$client);
$insertRecep1->bindParam(4,$id_produit);
$insertRecep1->bindParam(5,$poids_kg);
$insertRecep1->bindParam(6,$destination);
$insertRecep1->bindParam(7,$qt_poids);
$insertRecep1->bindParam(8,$des_douane);
//$insertRecep1->bindParam(8,$banque);
$insertRecep1->bindParam(9,$id);*/


$insertRecep1->execute();




}
catch(PDOException $e){
    die('Erreur:' .$e->getMessage());   
}
}

   if($type=='SACHERIE'){

      
    /*  $bl= $_POST['bl'];
      $id=$_POST['id'];
     
      $conditionnement=$_POST['cond'];
      $sac=$_POST['sac'];
      $b=$_POST['navire']; 
      $ex_produit=explode('-', $_POST['produit']);
      $id_produit=$ex_produit[0];
      $poids_kg=$ex_produit[1];
      $client=$_POST['client'];
      $destination=$_POST['destination'];
      $des_douane=$_POST['des_douane']; */
     // $banque=$_POST['banquedis'];
     // $poids=$_POST['sac']*$conditionnement/1000;
    
         //$qt_poids=$sac*$poids_kg/1000;
      
     $dec=$_POST['num_dec'];
     $sac=$_POST['sac'];
     $sac2=str_replace(' ', '',$sac);
          $id_con_dis=explode('-', $_POST['id_con_dis']);
     $id_con=$id_con_dis[0];
     $poids_kg=$id_con_dis[1];

     $poids_sac=$_POST['poids_sac'];
     $poids=$sac2*$poids_kg/1000;
     $type_decharge=$_POST['type_decharge'];
     $des_douane=$_POST['des_douane'];
     $id=$_POST['id'];


      
      
try{
     $insertRecep1= $bdd->prepare("UPDATE dispats set /*id_con_dis=?, quantite_sac=?,  id_client=?, id_produit=?, poids_kg=? , id_mangasin=?, quantite_poids=?, des_douane=?*/quantite_sac=?, quantite_poids=?, des_douane=?, type_decharge=?, id_mangasin=?, id_con_dis=?  where id_dis=? "); 
$insertRecep1->bindParam(1,$sac2);      
$insertRecep1->bindParam(2,$poids); 

$insertRecep1->bindParam(3,$des_douane); 
$insertRecep1->bindParam(4,$type_decharge);
$insertRecep1->bindParam(5,$dec);
$insertRecep1->bindParam(6,$id_con);
$insertRecep1->bindParam(7,$id);

/*$insertRecep1->bindParam(3,$client);
$insertRecep1->bindParam(4,$id_produit);
$insertRecep1->bindParam(5,$poids_kg);
$insertRecep1->bindParam(6,$destination);
$insertRecep1->bindParam(7,$qt_poids);
$insertRecep1->bindParam(8,$des_douane);
//$insertRecep1->bindParam(8,$banque);
$insertRecep1->bindParam(9,$id);*/


$insertRecep1->execute();




}
catch(PDOException $e){
    die('Erreur:' .$e->getMessage());   
}
}
?>
<div class="container-fluid" id="parconnaissement"  >

  <?php  affichage_par_connaissement($bdd,$b); ?>
   
 </div>
<?php
 }
  ?>

 