<?php
require('../database.php');  
require('controller/afficher_les_receptions.php');



 if(isset($_POST['id_declaration']) ){ 
  $c=$_POST['id_dis'];
$navire=$_POST['navire'];
if(!empty($_POST['date'])) {
$date=$_POST['date'];
$flasque=$_POST['flasque'];
$mouille=$_POST['mouille'];
$id_declaration=$_POST['id_declaration'];
$destination=$_POST['destination'];
$produit=$_POST['produit'];
$poids_sac=$_POST['poids_sac'];



try{
$insert=$bdd->prepare("INSERT INTO avaries_de_reception(dates,sac_flasque,sac_mouille,id_dis,id_navire,declaration_id,destination_id) values(?,?,?,?,?,?,?)");
  $insert->bindParam(1,$date);
  $insert->bindParam(2,$flasque);
  $insert->bindParam(3,$mouille);
  $insert->bindParam(4,$c);
   $insert->bindParam(5,$navire);
  $insert->bindParam(6,$id_declaration); 
  $insert->bindParam(7,$destination);

  $insert->execute();
/*
  $insert2=$bdd->prepare("INSERT INTO date_situation_reception (date_sit_avr,id_dis_sit_avr) values(?,?)");
  $insert2->bindParam(1,$date);
  $insert2->bindParam(2,$c);
  $insert2->execute(); */
  
  

  
}

catch(PDOException $e){
    die('Erreur:' .$e->getMessage());
    
    
} 


}



 ?>

 
     <div class="container-fluid" class="" id="avaries_receptions" >
      <div class="row">
<?php $selectid_dis=bouton_avaries($bdd,$produit,$poids_sac,$navire,$destination);
if($afdis=$selectid_dis->fetch()){ ?>
  <div class="col-md-12 col-lg-12">      
<a  class="btn1"  style="background: rgb(65,180,190); " data-role="situation_reception" data-id="<?php echo $afdis['id'] ?>" data-navire="<?php echo $afdis['id_navire'] ?>"
data-declaration="<?php echo $afdis['id_declaration'] ?>" data-destination="<?php echo $afdis['id_destination'];  ?>"  data-produit="<?php echo $afdis['id_produit'] ?>" data-poids_sac="<?php echo $afdis['poids_sac'] ?>"  >AJOUTER AVARIES  </a>
<br><br>
</div>
<?php } ?>
<?php if(empty($_POST['date'])){ ?>
  <center><div  class="err" id="LesErreursVIDES" ><a  type="button" class="btn-close"  id="close_erreur" data-role="fermerVIDES" ></a><h3 id="perreurVIDES" > ERREUR</h3>
    
 <h5 id="perreur"> Veuillez inserer une date  </span> </h5>
</div>
<?php   } ?>

<div class="col-md-12 col-lg-12">

 <div class="table-responsive" border=1>



  <table class='table table-hover table-bordered table-striped table-responsive' id='table_register' border='2' >

    

 <thead style="background:  rgb(65,180,190);">
      <td  class="titreAVR" colspan="5"  >AVARIES DE RECEPTION</td> 
     
    
    <tr  style="background: linear-gradient(to bottom, #FFFFFF, rgb(65,180,174)); text-align: center; color: white; font-weight: bold;"  >
      
      <td id="mytd" scope="col"  >DATES</td>
     
     

      <td id="mytd" scope="col"  >SACS FLASQUES</td>
      <td id="mytd" scope="col"  >SACS MOUILLES</td>
      <td id="mytd" scope="col"  >TOTAL AVARIES</td>
      
         


      
    
       <td id="mytd"  scope="col" rowspan="2" >ACTIONS</td>
     </tr>
     </thead>

<tbody> 
<?php affichage_avaries($bdd,$produit,$poids_sac,$navire,$destination); ?>

 </tbody>
</table>
</div>
</div>
</div>
</div>

<?php   
}

//}

 ?>