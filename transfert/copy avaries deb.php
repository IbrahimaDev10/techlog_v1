<?php 
//MODIFIER AVARIES DEB 
require("../database.php");
if(isset($_POST['id'])){

   $date=$_POST['date'];
   $d=explode('-', $date);
   $insertdate=$d[2].'-'.$d[1].'-'.$d[0];
   $sacf=$_POST['sacf'];
   $sacm=$_POST['sacm'];
   $id_navire=$_POST['id_navire'];

  $id=$_POST['id'];
  $update=$bdd->prepare("UPDATE avaries set date_avaries=?, sac_flasque=?, sac_mouille=?  where id_avaries=?");
  $update->bindParam(1,$insertdate);
  $update->bindParam(2,$sacf);
  $update->bindParam(3,$sacm);
  $update->bindParam(4,$id);

  $update->execute();
  ?>

<div id="avaries_debarquement">
<div class="container-fluid1  " style="width: 100%; background: orange;" >
    <div class="row">
      <div class="col-lg-12 col-md-12">
          <h1 class="hem" > AVARIES DE DEBARQUEMENT</h1><br>
              </div>
    </div>
  </div>
  <br><br>     
 <form> 
  <input type="text" id="mon_navire" value="<?php echo $id_navire; ?>" hidden="true">


 <?php $disdate=$bdd->prepare("select id_navire from dispatching where id_navire=?");
  $disdate->bindParam(1,$id_navire);
  $disdate->execute();
  while($dis=$disdate->fetch()){  
    $dater=$bdd->prepare("SELECT date_avaries from avaries where id_navire=? GROUP BY date_avaries");
      $dater->bindParam(1,$dis['id_navire']);
  $dater->execute();
  } ?>
<center>  
  <select id="date_avaries" onchange="func_av_deb()"> 
  <option value=""> FILTRE PAR DATE </option> 
  <?php   while($dt=$dater->fetch()){
    $dt1=explode('-', $dt['date_avaries']);
    $dt2=$dt1[2].'-'.$dt1[1].'-'.$dt1[0];
 ?>
 <option value="<?php echo $dt['date_avaries']; ?>"> <?php echo $dt2; ?> </option> 
<?php  } ?>

  </select>

</center>
    

 </form>
  
      
<?php
  $chavaries=$bdd->prepare("select id_navire from dispatching where id_navire=?");
  $chavaries->bindParam(1,$id_navire);
  $chavaries->execute();
  while($chav=$chavaries->fetch()){
   
 $avaries_deb=$bdd->prepare("SELECT p.produit,p.qualite, av.* FROM avaries as av inner join produit_deb as p on av.id_produit=p.id WHERE av.id_navire=? and av.date_avaries=? order by av.date_avaries");
 $avaries_deb->bindParam(1,$chav['id_navire']);
  $avaries_deb->bindParam(2,$insertdate);
 $avaries_deb->execute();

 $somme=$bdd->prepare("SELECT sum(sac_flasque), sum(sac_mouille) from avaries where id_navire=? and date_avaries=? ");
$somme->bindParam(1,$chav['id_navire']);
$somme->bindParam(2,$insertdate);
$somme->execute();

}
 ?>
        

          <div class="table-responsive" border=1>
  
<?php


 echo " <table class='table table-hover table-bordered table-striped table-responsive' id='table_register' border='2' >";
    
?> 
 <thead style="background-color: rgba(50, 159, 218, 0.9);">
       
    
    <tr  style="background: linear-gradient(to bottom, #FFFFFF, orange); text-align: center; color: white; font-weight: bold; font-size: 12px;"  >
      <td class="mytd" scope="col" rowspan="2"  >DATES</td>
      <td class="mytd" scope="col" rowspan="2"  >PRODUIT</td>
      <td class="mytd" scope="col" rowspan="2"  >CALE</td>
      <td class="mytd" scope="col" rowspan="2" >SAC FLASQUE</td>
      <td class="mytd" scope="col" rowspan="2" > SAC MOUILLE</td>
      <td class="mytd" scope="col" rowspan="2" >ACTION</td>
    </tr>
    </thead>
    <tbody>
      <?php while($avaries=$avaries_deb->fetch()){ 
       $date=explode('-', $avaries['date_avaries']);
      $dt=$date[2].'-'.$date[1].'-'.$date[0];
        ?>
        <tr style="text-align: center; vertical-align: middle; background: white;">
          <td id="<?php echo $avaries['id_avaries'].'date_avaries_deb' ?>"><?php echo $dt; ?></td>
          <td><?php echo $avaries['produit'] ?> <?php echo $avaries['qualite'] ?> <?php echo $avaries['poids_sac_avaries'].' KGS'; ?></td>
          <td><?php echo $avaries['cale_avaries']; ?></td>
          <td id="<?php echo $avaries['id_avaries'].'flasque_avaries_deb' ?>"><?php echo $avaries['sac_flasque']; ?></td>
          <td id="<?php echo $avaries['id_avaries'].'mouille_avaries_deb' ?>" ><?php echo $avaries['sac_mouille']; ?></td>
          <span style="display: none;" id="<?php echo $avaries['id_avaries'].'id_navire_avaries_deb' ?>" ><?php echo $avaries['id_navire']; ?></span>
          <td>  <a  class="fabtn" type=""   data-role='update_avaries_deb2'  data-id="<?php echo $avaries['id_avaries']  ?>" > <i class="fa fa-edit " style="color: orange;" ></i></a>
           <a class="fabtn" type=""   onclick="delete_avaries_deb2(<?php echo $avaries['id_avaries'] ?>)" > <i class="fa fa-trash " style="color: orange;" ></i></a></td>
          

        </tr>
      <?php } 
while($som=$somme->fetch()){

      ?>
      <tr style="text-align: center; vertical-align: middle; background: blue; color:white;">
       <td colspan="3">TOTAL</td>
          <td><?php echo $som['sum(sac_flasque)']; ?></td>
          <td><?php echo $som['sum(sac_mouille)']; ?></td>
          <td></td>
        </tr>
<?php   } ?>

    </tbody>
</div>


          
          
  
  <br><br>
</div>




<?php } ?>


<?php   // DELETE AVARIES DEB
require("../database.php");
if(isset($_POST['delete_id'])){


   $id_navire=$_POST['id_navire'];

  $id=$_POST['delete_id'];
  $delete=$bdd->prepare("DELETE from  avaries  where id_avaries=?");

  $delete->bindParam(1,$id);

  $delete->execute();


  ?>
  <?php  //SELECT TABLE AVARIES_DEB ?>

<div id="avaries_debarquement">
<div class="container-fluid1  " style="width: 100%; background: orange;" >
    <div class="row">
      <div class="col-lg-12 col-md-12">
          <h1 class="hem" > AVARIES DE DEBARQUEMENT</h1><br>
              </div>
    </div>
  </div>
  <br><br>     
 <form>

<?php
 $forid=$bdd->prepare("select id_navire from dispatching where id_navire=?");
  $forid->bindParam(1,$id_navire);
  $forid->execute();
  $a=$forid->fetch();
  
  if($a['id_navire']){ ?>
    <input type="text" id="mon_navire" value="<?php echo $a['id_navire']; ?>" hidden="true">
<?php    
  } 

 $disdate=$bdd->prepare("select id_navire from dispatching where id_navire=?");
  $disdate->bindParam(1,$id_navire);
  $disdate->execute();
  while($dis=$disdate->fetch()){  
    $date=$bdd->prepare("SELECT date_avaries from avaries where id_navire=? GROUP BY date_avaries");
      $date->bindParam(1,$dis['id_navire']);
  $date->execute();
  } ?>
<center>  
  <select id="date_avaries" onchange="func_av_deb()" > 
  <option value=""> FILTRE PAR DATE </option> 
  <?php   while($dt=$date->fetch()){
    $dt1=explode('-', $dt['date_avaries']);
    $dt2=$dt1[2].'-'.$dt1[1].'-'.$dt1[0];
 ?>
 <option value="<?php echo $dt['date_avaries']; ?>"> <?php echo $dt2; ?> </option> 
<?php  } ?>

  </select>

</center>
    

 </form>
  
      
<?php
  $chavaries=$bdd->prepare("select id_navire from dispatching where id_navire=?");
  $chavaries->bindParam(1,$id_navire);
  $chavaries->execute();
  while($chav=$chavaries->fetch()){
   
 $avaries_deb=$bdd->prepare("SELECT p.produit,p.qualite, av.* FROM avaries as av inner join produit_deb as p on av.id_produit=p.id WHERE av.id_navire=? order by av.date_avaries");
 $avaries_deb->bindParam(1,$chav['id_navire']);
 $avaries_deb->execute();

 $somme=$bdd->prepare("SELECT sum(sac_flasque), sum(sac_mouille) from avaries where id_navire=? ");
$somme->bindParam(1,$chav['id_navire']);
$somme->execute();

}
 ?>
        

          <div class="table-responsive" border=1>
  
<?php


 echo " <table class='table table-hover table-bordered table-striped table-responsive' id='table_register' border='2' >";
    
?> 
 <thead style="background-color: rgba(50, 159, 218, 0.9);">
       
    
    <tr  style="background: linear-gradient(to bottom, #FFFFFF, orange); text-align: center; color: white; font-weight: bold; font-size: 12px;"  >
      <td class="mytd" scope="col" rowspan="2"  >DATES</td>
      <td class="mytd" scope="col" rowspan="2"  >PRODUIT</td>
      <td class="mytd" scope="col" rowspan="2"  >CALE</td>
      <td class="mytd" scope="col" rowspan="2" >SAC FLASQUE</td>
      <td class="mytd" scope="col" rowspan="2" > SAC MOUILLE</td>
      <td class="mytd" scope="col" rowspan="2" >ACTION</td>
    </tr>
    </thead>
    <tbody>
      <?php while($avaries=$avaries_deb->fetch()){ 
       $date=explode('-', $avaries['date_avaries']);
      $dt=$date[2].'-'.$date[1].'-'.$date[0];
        ?>
        <tr style="text-align: center; vertical-align: middle; background: white;">
          <td id="<?php echo $avaries['id_avaries'].'date_avaries_deb' ?>"><?php echo $avaries['date_avaries']; ?></td>
          <td><?php echo $avaries['produit'] ?> <?php echo $avaries['qualite'] ?> <?php echo $avaries['poids_sac_avaries'].' KGS'; ?></td>
          <td><?php echo $avaries['cale_avaries']; ?></td>
          <td id="<?php echo $avaries['id_avaries'].'flasque_avaries_deb' ?>"><?php echo $avaries['sac_flasque']; ?></td>
          <td id="<?php echo $avaries['id_avaries'].'mouille_avaries_deb' ?>" ><?php echo $avaries['sac_mouille']; ?></td>
          <span style="display: none;" id="<?php echo $avaries['id_avaries'].'id_navire_avaries_deb' ?>" ><?php echo $avaries['id_navire']; ?></span>
          <td>  <a  class="fabtn" type=""   data-role='update_avaries_deb'  data-id="<?php echo $avaries['id_avaries']  ?>" > <i class="fa fa-edit " style="color: orange;" ></i></a>
           <a class="fabtn" type=""   onclick="delete_avaries_deb(<?php echo $avaries['id_avaries'] ?>)" > <i class="fa fa-trash " style="color: orange;" ></i></a></td>
          

        </tr>
      <?php } 
while($som=$somme->fetch()){

      ?>
      <tr style="text-align: center; vertical-align: middle; background: blue; color:white;">
       <td colspan="3">TOTAL</td>
          <td><?php echo $som['sum(sac_flasque)']; ?></td>
          <td><?php echo $som['sum(sac_mouille)']; ?></td>
          <td></td>
        </tr>
<?php   } ?>

    </tbody>
</div>


          
          
  
  <br><br>
</div>




<?php } ?>

<div class="container-fluid" id="avaries_debarquement" style="display: none;">

  <br><br>     
 <form> 
 <?php
 $forid=$bdd->prepare("select id_navire from dispatching where id_dis=?");
  $forid->bindParam(1,$c);
  $forid->execute();
  $a=$forid->fetch();
  if($a['id_navire']){ ?>
    <input type="text" id="mon_navire" value="<?php echo $a['id_navire']; ?>" hidden="true">
<?php    
  } 


  $disdate=$bdd->prepare("select id_navire from dispatching where id_dis=?");
  $disdate->bindParam(1,$c);
  $disdate->execute();
  while($dis=$disdate->fetch()){ ?>
    
  <?php  
    $date=$bdd->prepare("SELECT date_avaries from avaries where id_navire=? GROUP BY date_avaries");
      $date->bindParam(1,$dis['id_navire']);
  $date->execute();
  } ?>
<center>  
  <select id="date_avaries" onchange="func_av_deb()"> 
  <option value=""> FILTRE PAR DATE </option> 
  <?php   while($dt=$date->fetch()){
    $dt1=explode('-', $dt['date_avaries']);
    $dt2=$dt1[2].'-'.$dt1[1].'-'.$dt1[0];
 ?>
 <option value="<?php echo $dt['date_avaries']; ?>"> <?php echo $dt2; ?> </option> 
<?php  } ?>

  </select>

</center>
    

 </form>
  
      
<?php
  $chavaries=$bdd->prepare("select id_navire from dispatching where id_dis=?");
  $chavaries->bindParam(1,$c);
  $chavaries->execute();
  while($chav=$chavaries->fetch()){
   
 $avaries_deb=$bdd->prepare("SELECT p.produit,p.qualite, av.* FROM avaries as av inner join produit_deb as p on av.id_produit=p.id WHERE av.id_navire=? order by av.date_avaries, av.cale_avaries");
 $avaries_deb->bindParam(1,$chav['id_navire']);
 $avaries_deb->execute();

 $somme=$bdd->prepare("SELECT sum(sac_flasque), sum(sac_mouille) from avaries where id_navire=? ");
$somme->bindParam(1,$chav['id_navire']);
$somme->execute();

}
 ?>
        

          <div class="table-responsive" border=1>
  
<?php


 echo " <table class='table table-hover table-bordered table-striped table-responsive' id='table_register' border='2' >";
    
?> 
 <thead style="background-color: rgba(50, 159, 218, 0.9);">
   <td  colspan="6" class="titreSAIN" style="background: orange;"  ><i class="fas fa-bell" style="float: left;"> </i> AVARIES DE DEBARQUEMENT</td>
       
    
    <tr  style="background: linear-gradient(to bottom, #FFFFFF, orange); text-align: center; color: white; font-weight: bold; font-size: 12px;"  >
      <td class="mytd" scope="col" rowspan="2"  >DATES</td>
      <td class="mytd" scope="col" rowspan="2"  >PRODUIT</td>
      <td class="mytd" scope="col" rowspan="2"  >CALE</td>
      <td class="mytd" scope="col" rowspan="2" >SAC FLASQUE</td>
      <td class="mytd" scope="col" rowspan="2" > SAC MOUILLE</td>
      <td class="mytd" scope="col" rowspan="2" >ACTION</td>
    </tr>
    </thead>
    <tbody>
      <?php while($avaries=$avaries_deb->fetch()){
      $date=explode('-', $avaries['date_avaries']);
      $dt=$date[2].'-'.$date[1].'-'.$date[0]; ?>
        <tr style="text-align: center; vertical-align: middle; background: white;">
<td id="<?php echo $avaries['id_avaries'].'date_avaries_deb' ?>"><?php echo $dt; ?></td>
          <td><?php echo $avaries['produit'] ?> <?php echo $avaries['qualite'] ?> <?php echo $avaries['poids_sac_avaries'].' KGS'; ?></td>
          <td><?php echo $avaries['cale_avaries']; ?></td>
          <td id="<?php echo $avaries['id_avaries'].'flasque_avaries_deb' ?>"><?php echo $avaries['sac_flasque']; ?></td>
          <td id="<?php echo $avaries['id_avaries'].'mouille_avaries_deb' ?>" ><?php echo $avaries['sac_mouille']; ?></td>
          <span style="display: none;" id="<?php echo $avaries['id_avaries'].'id_navire_avaries_deb' ?>" ><?php echo $avaries['id_navire']; ?></span>
          <td>  <a  class="fabtn" type=""   data-role='update_avaries_deb'  data-id="<?php echo $avaries['id_avaries']  ?>" > <i class="fa fa-edit " style="color: orange;" ></i></a>
           <a class="fabtn" type=""   onclick="delete_avaries_deb(<?php echo $avaries['id_avaries'] ?>)"   > <i class="fa fa-trash " style="color: orange;" ></i></a></td>
          

        </tr>
      <?php } 
while($som=$somme->fetch()){

      ?>
      <tr style="text-align: center; vertical-align: middle; background: blue; color:white;">
       <td colspan="3">TOTAL</td>
          <td><?php echo $som['sum(sac_flasque)']; ?></td>
          <td><?php echo $som['sum(sac_mouille)']; ?></td>
          <td></td>
        </tr>
<?php   } ?>

    </tbody>
  </table>
</div>


  <br><br>
</div>





