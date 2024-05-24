<?php
require('../database.php');
?>

<style type="text/css">
  body{
    font-family:Times New Roman;
    font-weight: bold;
  }

    .enteteTable{
     background: linear-gradient(to bottom, blue, #1B2B65); background: linear-gradient(to left, blue, #1B2B65); background: linear-gradient(to top, blue, #1B2B65); color: white; text-align: center; font-weight: bold;
     vertical-align: middle; 
      border: 5px;
      border-color: black;

    }
         #table{
          border: 5px; 
     }
    #colLibeles{
      background: rgba(83,104,253,0.9); color: white;
      vertical-align: middle;
      text-align: center;

    } 
    #colManifeste{
      background: rgb(72,94,179); color:white;
      vertical-align: middle;
       text-align: center;
    }
    #colDeb24H{
      background-color: rgb(124, 158, 191); color:white;
      vertical-align: middle;
       text-align: center;
    }
    #colDebTOTAL{
      background-color: rgb(34, 155, 176); color:white;
      vertical-align: middle;
       text-align: center;
    }
    #colROB{
      background-color: rgb(28, 118, 51); color:white;
      vertical-align: middle;
       text-align: center;
    }
    #sousTOTAL{
       background-color:rgb(94,44,101);  color:white;
       font-weight: bold;
       text-align: center;
       vertical-align: middle;

    }
    #TOTAL{
      background: black;
      color: red;
      font-weight: bold;
      vertical-align: middle;
       text-align: center;
    }
    #colFlasque{
      background-color: rgb(193, 150, 0); color:white;
      vertical-align: middle;
       text-align: center; 
    }

    #colMouille{
      background-color: rgb(158, 106, 35); color:white;
      vertical-align: middle;
       text-align: center; 
    }
    #colCumulGen{
    background-color: rgb(200, 106, 90); color:white;
      vertical-align: middle;
      text-align: center;  
    }
  
</style>
 <div class="sit" id="sit"> 

<div class="container-fluid-great"  >
        <div class="row">
        	<?php if (isset($_POST['idDate'])) {
        		 $b=$_POST["idDate"];
        		   $a=explode(",",$b);

 
$situation_r=$bdd->prepare("select r.*, sum(r.sac_recep),sum(r.poids_recep), sum(r.manquant_recep),p.*,mg.* from reception as r

  inner join produit_deb as p on p.id=r.id_produit_recep
  inner join mangasin as mg on mg.id=r.id_destination_recep
  where r.dates_recep=? ");
 $situation_r->bindParam(1,$a[1]);
 $situation_r->execute();


  $situation_avr=$bdd->prepare("select avr.*, sum(avr.sac_flasque_avr),sum(avr.sac_mouille_avr), dis.id_dis,p.id,mg.id from avaries_de_reception as avr
  inner join dispatching as dis on dis.id_dis=avr.id_dis_avr
  inner join produit_deb as p on p.id=dis.id_produit
  inner join mangasin as mg on mg.id=dis.id_mangasin
  where avr.date_avr=? ");
   $situation_avr->bindParam(1,$a[1]);
 $situation_avr->execute();

   $situation_rav=$bdd->prepare("select rav.*, sum(rav.sac_flasque_ra),sum(rav.sac_mouille_ra),sum(rav.poids_mouille_ra),sum(rav.poids_flasque_ra), p.id,mg.id from reception_avaries as rav
 
  inner join produit_deb as p on p.id=rav.id_produit_ra
  inner join mangasin as mg on mg.id=rav.id_destination_ra
  where rav.date_ra=? ");
   $situation_rav->bindParam(1,$a[1]);
 $situation_rav->execute();
 ?>


<div class="table-responsive"  >
          

  <table class='table table-hover table-bordered table-striped' id='table' >
    
 
<thead>
         
          



  
 <tr class="EnteteTableSituation"  >
      
      
      <td id="colLibeles" scope="col"  rowspan="3"  >PRODUIT</td>
      <td id="colDeb24H" scope="col" rowspan="2"  colspan="2" style="vertical-align: bottom;" >SACS SAINS</td>
      <td id="colManifeste" colspan="4" >AVARIES DE RECEPTION</td>
      <td scope="col" colspan="4" id="colDebTOTAL" >AVARIES DE DEBARQUEMENT</td>
      
      <td scope="col" colspan="2" rowspan="2" id="colROB">TOTAL RECEPTONNES</td>
  </tr>
    <tr class="EnteteTableSituation"  >
      
      <td id="colManifeste" colspan="2">FLASQUES</td>
      <td id="colManifeste" colspan="2">MOUILLES</td>
      <td id="colDebTOTAL" colspan="2">FLASQUES</td>
      <td id="colDebTOTAL" colspan="2">MOUILLES</td>
     
    </tr>
    <tr>  
        <td scope="col" id="colDeb24H" >NBRE SACS</td>
      <td scope="col" id="colDeb24H" >POIDS</td>
        <td scope="col" id="colManifeste" >NBRE SACS</td>
        <td scope="col" id="colManifeste" >POIDS</td>
        <td scope="col" id="colManifeste" >NBRE SACS</td>
      <td scope="col" id="colManifeste" >POIDS</td>
        <td scope="col" id="colDebTOTAL">NBRE SACS</td>
      <td scope="col" id="colDebTOTAL" >POIDS</td>
              <td scope="col" id="colDebTOTAL">NBRE SACS</td>
      <td scope="col" id="colDebTOTAL" >POIDS</td>
              <td scope="col" id="colROB">NBRE SACS</td>
              <td scope="col" id="colROB">POIDS</td>

         </tr>
         </thead>
         <tbody>
          <?php   while($row=$situation_r->fetch()){ 
           $rav=$situation_rav->fetch();
           $avr=$situation_avr->fetch(); 
          //LES VARIABLES NECESSAIRE
           $poids_mouille_avr=$avr['sum(avr.sac_mouille_avr)']*$row['poids_sac_recep']/1000;
           $poids_flasque_avr=$avr['sum(avr.sac_flasque_avr)']*$row['poids_sac_recep']/1000;
           $sac_sain=$row['sum(r.sac_recep)']-$avr['sum(avr.sac_flasque_avr)']-$avr['sum(avr.sac_mouille_avr)'];

           $poids_sain=$sac_sain*$row['poids_sac_recep']/1000;

           $total_flasque=$avr['sum(avr.sac_flasque_avr)']+$rav['sum(rav.sac_flasque_ra)'];
           $total_mouille=$avr['sum(avr.sac_mouille_avr)']+$rav['sum(rav.sac_mouille_ra)'];
           $total_poids_mouille=($avr['sum(avr.sac_mouille_avr)']+$rav['sum(rav.sac_mouille_ra)'])*$row['poids_sac_recep']/1000;
           $total_sac_rep=$sac_sain+$avr['sum(avr.sac_flasque_avr)']+$avr['sum(avr.sac_mouille_avr)']+$rav['sum(rav.sac_flasque_ra)']+$rav['sum(rav.sac_mouille_ra)'];
           $total_poids_rep=$poids_sain+$poids_flasque_avr+$poids_mouille_avr+$rav['sum(rav.poids_flasque_ra)']+$rav['sum(rav.poids_mouille_ra)'];

           ?>
           <tr style="text-align: center; vertical-align: middle;"> 
            <td> <?php   echo $row['produit'] ?> <?php echo $row['qualite'] ?> <?php   echo $row['poids_sac_recep'] ?> KGS </td>
            <td> <?php  echo number_format($sac_sain,0,',',' ') ?> </td>
             <td> <?php  echo number_format($poids_sain,3,',',' ') ?> </td>
             <td> <?php  echo number_format($avr['sum(avr.sac_flasque_avr)'],0,',',' ') ?> </td>
             <td> <?php  echo number_format($poids_flasque_avr,3,',',' ') ?> </td>
             <td> <?php  echo number_format($avr['sum(avr.sac_mouille_avr)'],0,',',' ') ?> </td>
             <td> <?php  echo number_format($poids_mouille_avr,3,',',' ') ?> </td>
             <td> <?php  echo number_format($rav['sum(rav.sac_flasque_ra)'],0,',',' ') ?> </td>
             <td> <?php  echo number_format($rav['sum(rav.poids_flasque_ra)'],3,',',' ') ?> </td>
              <td> <?php  echo number_format($rav['sum(rav.sac_mouille_ra)'],0,',',' ') ?> </td>
             <td> <?php  echo number_format($rav['sum(rav.poids_mouille_ra)'],3,',',' ') ?> </td>
            
             <td> <?php  echo number_format($total_sac_rep,0,',',' '); ?> </td>
             <td> <?php  echo number_format($total_poids_rep,3,',',' '); ?> </td>
             

           </tr>
         <?php  } ?>
         </tbody>
       </table>
     </div>




<?php     
 } ?>
</div>
</div>
</div>





	

