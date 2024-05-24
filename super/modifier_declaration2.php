<?php 	
require('../database.php');
require('controller/requete_predebarquement.php');

if (isset($_POST['ch'])) {
    
      
      $nom_chargeur= $_POST['ch'];
      $id=$_POST['id'];
      $cale=$_POST['cale'];
      $conditionnement=$_POST['cond'];
      $id_produit=$_POST['produitId'];
      $sac=$_POST['sac'];
     
      $b=$_POST['navire'];
      $type=$_POST['type'];


       $restriction_modifier=$bdd->prepare("SELECT count(dis.id_dis), nc.id_navire from dispat as dis inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
       where nc.id_navire=? ");
      $restriction_modifier->bindParam(1,$b);
       $restriction_modifier->execute();
       
       $restrict=$restriction_modifier->fetch();

       $cherche_conditionnement=$bdd->prepare('SELECT conditionnement from declaration_chargement where id_dec=?');
       $cherche_conditionnement->bindParam(1,$id);
       $cherche_conditionnement->execute();
       $ch_con=$cherche_conditionnement->fetch();


      $type=$bdd->prepare("select type from navire_deb where id=?");
      $type->bindParam(1,$b);
       $type->execute();
       $types=$type->fetch();

      // if($types['type']=='SACHERIE' and $restrict['count(dis.id_dis)']==0){
       //  
    //   }
        // if($types['type']=='VRAQUIER'){
        // $poids=$_POST['poids_is_vrac'];
      // }
   //    if($restrict['count(dis.id_dis)']==0){
      
try{
  if($types['type']=='SACHERIE' ){
    $poids=$_POST['sac']*$conditionnement/1000;
     $insertRecep1= $bdd->prepare("UPDATE declaration_chargement set cales=?, nom_chargeur=?,conditionnement=?, id_produit=?, nombre_sac=?, poids=?   where id_dec=? "); 
$insertRecep1->bindParam(1,$cale); 
$insertRecep1->bindParam(2,$nom_chargeur);
$insertRecep1->bindParam(3,$conditionnement);
$insertRecep1->bindParam(4,$id_produit);
$insertRecep1->bindParam(5,$sac);
$insertRecep1->bindParam(6,$poids);
$insertRecep1->bindParam(7,$id);

$insertRecep1->execute();
}

if($types['type']=='VRAQUIER'){
  $poids=$_POST['poids_is_vrac'];
     $insertRecep1= $bdd->prepare("UPDATE declaration_chargement set cales=?, nom_chargeur=?, id_produit=?,  poids=?   where id_dec=? "); 
$insertRecep1->bindParam(1,$cale); 
$insertRecep1->bindParam(2,$nom_chargeur);

$insertRecep1->bindParam(3,$id_produit);

$insertRecep1->bindParam(4,$poids);
$insertRecep1->bindParam(5,$id);

$insertRecep1->execute();
}



}
catch(PDOException $e){
    die('Erreur:' .$e->getMessage());   
}
//}

/*
if($restrict['count(dis.id_dis)']>0){
 if( $types['type']=='SACHERIE'){
      
         $poids=$_POST['sac']*$ch_con['conditionnement']/1000;
       
try{
     $insertRecep1= $bdd->prepare("UPDATE declaration_chargement set  nombre_sac=?, poids=?   where id_dec=? "); 

$insertRecep1->bindParam(1,$sac);
$insertRecep1->bindParam(2,$poids);
$insertRecep1->bindParam(3,$id);

$insertRecep1->execute();




}

catch(PDOException $e){
    die('Erreur:' .$e->getMessage());   
}
}

if($types['type']=='VRAQUIER'){
      
         $poids=$_POST['poids_is_vrac'];
       
try{
     $insertRecep1= $bdd->prepare("UPDATE declaration_chargement set  poids=?   where id_dec=? "); 


$insertRecep1->bindParam(1,$poids);
$insertRecep1->bindParam(2,$id);

$insertRecep1->execute();


}
catch(PDOException $e){
    die('Erreur:' .$e->getMessage());   
}
}
} */

?>

<?php $navirefichier=$bdd->prepare("select id from navire_deb where id=?");
       $navirefichier->bindParam(1,$b);
       $navirefichier->execute();  ?>

<div class="container-fluid" id="parcale"  >

 
                      <center>
  <div style=" display: flex; ">
  <a style="background: blue; width: 40px; height: 25px; display: flex; justify-content: center; align-items: center; "  data-role='imprimer_par_cale'><i class="fa fa-print text-white"></i></a>

  <?php while($fichier=$navirefichier->fetch()){ ?>

  <span id="joindre_fichier">
   <a  style="background: blue; width: 40px; height: 25px; display: flex; justify-content: center; align-items: center; margin-left: 30px;" href="insertion_fichier_declaration_chargement.php?id=<?php echo $fichier['id'] ?>" target="blank"  name="modify"         id="btnbtn" > <i class="fa fa-folder text-white "  ></i></a>
 <?php } ?>
</span>
</div>
  <br>                      
 <?php affichage_par_cale($bdd,$b); ?>
  </div>
<?php  
}

 ?>


 