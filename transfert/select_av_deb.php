<?php 
require("../database.php");
if(isset($_POST['Dates']) ){

$date=$_POST['Dates'];
$dt0=explode('-', $date);
$dt10=$dt0[2].'-'.$dt0[1].'-'.$dt0[0];
$navire=$_POST['Navire'];
echo $date;

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
 
 
    <input type="text" id="mon_navire" value="<?php echo $navire; ?>" hidden="true">
<?php    
  


  $disdate=$bdd->prepare("select id_navire from dispatching where id_navire=?");
  $disdate->bindParam(1,$navire);
  $disdate->execute();
  while($dis=$disdate->fetch()){ ?>
    
  <?php  
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
  $chavaries->bindParam(1,$navire);
  
  $chavaries->execute();
  while($chav=$chavaries->fetch()){
   
 $avaries_deb=$bdd->prepare("SELECT p.produit,p.qualite, av.* FROM avaries as av inner join produit_deb as p on av.id_produit=p.id WHERE av.id_navire=? and av.date_avaries=? order by av.date_avaries");
 $avaries_deb->bindParam(1,$chav['id_navire']);
 $avaries_deb->bindParam(2,$date);
 $avaries_deb->execute();

 $somme=$bdd->prepare("SELECT sum(sac_flasque), sum(sac_mouille) from avaries where id_navire=? and date_avaries=? ");
$somme->bindParam(1,$chav['id_navire']);
$somme->bindParam(2,$date);
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
      $dates=explode('-', $avaries['date_avaries']);
      $dt=$dates[2].'-'.$dates[1].'-'.$dates[0]; ?>
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



<?php 	} ?>