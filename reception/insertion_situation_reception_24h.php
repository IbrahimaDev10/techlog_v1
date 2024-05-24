<?php
require('../database.php');  



 if(isset($_POST['id_dis']) ){ 
  $c=$_POST['id_dis'];
$navire=$_POST['navire'];
if(!empty($_POST['date'])) {
$date=$_POST['date'];
$flasque=$_POST['flasque'];
$mouille=$_POST['mouille'];
$id_declaration=$_POST['id_declaration'];



try{
$insert=$bdd->prepare("INSERT INTO avaries_de_reception(date_avr,sac_flasque_avr,sac_mouille_avr,id_dis_avr,id_navire_avr,id_declaration_avr) values(?,?,?,?,?,?)");
  $insert->bindParam(1,$date);
  $insert->bindParam(2,$flasque);
  $insert->bindParam(3,$mouille);
  $insert->bindParam(4,$c);
   $insert->bindParam(5,$navire);
  $insert->bindParam(6,$id_declaration); 

  $insert->execute();

  $insert2=$bdd->prepare("INSERT INTO date_situation_reception (date_sit_avr,id_dis_sit_avr) values(?,?)");
  $insert2->bindParam(1,$date);
  $insert2->bindParam(2,$c);
  $insert2->execute();
  
  

  
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
<a  class="btn1"  style="background: rgb(65,180,190); " data-role="situation_reception" data-id="<?php echo $afdis['id_dis_recep_bl'] ?>" data-navire="<?php echo $afdis['id_navire_recep'] ?>"
data-declaration="<?php echo $afdis['id_dec'] ?>"  >AJOUTER AVARIES  </a>
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
<?php while($av=$avaries_rep->fetch()){ 
if(!empty($av['id_avr']) and !empty($av['date_avr'])){
  //$d1=explode('-',$av['date_avr']);
 //$d=$d1[2].'-'.$d1[1].'-'.$d1[0];
  $d=date("d-m-Y",strtotime($av['date_avr']));
  $total_avaries=$av['sac_flasque_avr']+$av['sac_mouille_avr'];

  ?> 

  <tr style="text-align: center; vertical-align: middle;">
   <td id=<?php echo $av['id_avr'].'date_avr' ?> ><?php echo $d; ?></td> 

   <td id=<?php echo $av['id_avr'].'sac_flasque_avr' ?> ><?php echo $av['sac_flasque_avr'] ?></td>
   <td id=<?php echo $av['id_avr'].'sac_mouille_avr' ?> ><?php echo $av['sac_mouille_avr'] ?></td>
    <td  ><?php echo $total_avaries; ?></td>
   <span style="display: none;" id=<?php echo $av['id_avr'].'id_dis_avr' ?> > <?php echo $av['id_dis_avr'] ?> </span> 
   <span style="display: none;" id=<?php echo $av['id_avr'].'id_navire_avr' ?> > <?php echo $av['id_navire_avr'] ?> </span> 
   <td> 

 <a class="fabtn"   name="modify"  data-role="update_avr_reception"  data-id="<?php echo $av['id_avr']; ?>"  id="btnbtn" > <i class="fa fa-edit " ></i></a>
<a  id="<?php echo $av['id_avr'] ?>" name="delete"   class="fabtn1 " onclick="delete_avaries_rep(<?php echo $av['id_avr'] ?>)" > <i class="fa fa-trash  " ></i> </a></td>

  </tr>
<?php } ?>

<?php if(empty($av['id_avr']) and !empty($av['date_avr'])){ 
   $sous_total_avaries=$av['sum(avr.sac_flasque_avr)']+$av['sum(avr.sac_mouille_avr)']; 
   ?>
  <tr style="background: linear-gradient(to bottom, #FFFFFF, rgb(65,180,174)); color:white; text-align: center; vertical-align: middle;">
  <td ><?php echo $av['date_avr'] ?></td>
     <td><?php echo $av['sum(avr.sac_flasque_avr)'] ?></td>
   <td><?php echo $av['sum(avr.sac_mouille_avr)'] ?></td> 
   <td><?php echo $sous_total_avaries ?></td>
   <td></td>
   </tr>

<?php } ?>

<?php if(empty($av['id_avr']) and empty($av['date_avr'])){ 
  $sum_total_avaries=$av['sum(avr.sac_flasque_avr)']+$av['sum(avr.sac_mouille_avr)'];
   ?>
  <tr style="background: black; color:white;  text-align: center; vertical-align: middle;">
  <td style="color:white;" >TOTAL</td>
     <td style="color:white;"><?php echo $av['sum(avr.sac_flasque_avr)'] ?></td>
   <td style="color:white;"><?php echo $av['sum(avr.sac_mouille_avr)'] ?></td>
    <td style="color:white;"><?php echo $sum_total_avaries; ?></td>  
   <td style="color:white;"></td>
   </tr>

<?php } } ?>

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