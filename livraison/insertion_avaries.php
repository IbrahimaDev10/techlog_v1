<?php    
require("../database.php");
require('controller/afficher_les_livraisons.php');

if(isset($_POST['id_dis']) ){ 
 
$date=$_POST['date'];
$flasque=$_POST['flasque'];
$mouille=$_POST['mouille'];
$c=$_POST['id_dis'];

$produit=$_POST['produit'];
$poids_sac=$_POST['poids_sac'];
$destination=$_POST['destination'];
$navire=$_POST['navire'];

$declaration=$_POST['declaration'];


try{
$insert=$bdd->prepare("INSERT INTO avaries_de_livraison(date_liv,sac_flasque_liv,sac_mouille_liv,id_dis_liv,id_navire_liv,id_declaration_av_liv) values(?,?,?,?,?,?)");
  $insert->bindParam(1,$date);
  $insert->bindParam(2,$flasque);
  $insert->bindParam(3,$mouille);
  $insert->bindParam(4,$c);
   $insert->bindParam(5,$navire);
   $insert->bindParam(6,$declaration);

  $insert->execute();

  
  

  
}

catch(PDOException $e){
    die('Erreur:' .$e->getMessage());
    
    
} 
?>

<div class="container-fluid" class="" id="TableAvaries"  >
      <div class="row">

      

<br>
<div class="col-md-12 col-lg-12">      
<a  class="btn1"  style="background: rgb(65,180,190); " data-bs-toggle="modal" data-bs-target="#form_avaries_livraison" >AJOUTER AVARIES  </a>
<br><br>
</div>
<div class="col-md-12 col-lg-12">

 <div class="table-responsive" border=1>



  <table class='table table-hover table-bordered table-striped table-responsive' id='table_register' border='2' >

    

 <thead style="background:  rgb(65,180,190);">
      <td  class="titreAVR" colspan="4"  > AVARIES DE LIVRAISON</td> 
  
    <?php /*  $infos=$bdd->prepare("SELECT dis.poids_kg, p.*, mg.mangasin, nav.navire, nav.type,cli.client
         from dispatching as dis
         inner join produit_deb as p on p.id=dis.id_produit
         inner join navire_deb as nav on nav.id=dis.id_navire
         inner join mangasin as mg on mg.id=dis.id_mangasin
         inner join client as cli on cli.id=dis.id_client
         where dis.id_dis=?
         ");
        $infos->bindParam(1,$c);
        $infos->execute();
  
     if($inf=$infos->fetch()){ */

     ?>
      <tr  style="background: black; color: white; border-color: black; font-size: 12px; vertical-align: middle;"   >
     <td  >NAVIRE: <span id="lesInfos"> <?php //echo $inf['navire']; ?></span></td>
      <td >TYPE:<span id="lesInfos"> <?php //echo $inf['type']; ?></span></td>
      <td >PRODUIT:<span id="lesInfos"> <?php //echo $inf['produit']; ?> <?php //echo $inf['qualite']; ?> </span></td>
        <td >CONDITIONNEMENT:<span id="lesInfos"> <?php //echo $inf['poids_kg'].' KG';; ?></span></td>
        </tr>
        <tr  style="background: black; color: white; border-color: black; font-size: 12px; vertical-align: middle;"   >
         <td colspan="2">ENTREPOT:<span id="lesInfos"> <?php //echo $inf['mangasin']; ?></span></td>
          <td colspan="2">RECEPTIONNAIRE:<span id="lesInfos"> <?php //echo $inf['client']; ?></span></td>
           
        </tr>
<?php //} ?>

      
    <tr  style="background: linear-gradient(to bottom, #FFFFFF, rgb(65,180,174)); text-align: center; color: white; font-weight: bold;"  >
      
      <td id="mytd" scope="col"   >DATE</td>
      <td id="mytd" scope="col" > SAC FLASQUES</td>
      <td id="mytd" scope="col"  >SACS MOUILLES</td>
      <td id="mytd" scope="col"  >TOTAL AVARIES</td>

      

  
     </tr>
     
    
     </thead>

<tbody> 
  <?php affichage_avaries_livraison($bdd,$produit,$poids_sac,$navire,$destination); ?>




 </tbody>
</table>
</div>
</div>
</div>
</div>




<?php 
}

 ?>