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
    #mybutton{
      background: blue;
       color:white;
       font-size: 18px;
    }
  
</style>
 <div class="sit" id="sit"> 

<div class="container-fluid-great"  >
        <div class="row">
        	<?php if (isset($_POST['idDate'])) {
        		 $b=$_POST["idDate"];
             $date1=$bdd->prepare("select dates_recep from reception where id_dis_recep_bl=?");
             $date1->bindParam(1,$b);
             $date1->execute();


              $date2=$bdd->prepare("select dates_recep from reception where id_dis_recep_bl=? order by id_recep desc");
             $date2->bindParam(1,$b);
             $date2->execute();

             $intervenant=$bdd->prepare("select inter.*,intprod.* from intervenant as inter inner join intervenant_produit as intprod on inter.id_intervenant=intprod.id_inter where intprod.id_dis_inter_prod=?");
             $intervenant->bindParam(1,$b);
             $intervenant->execute();
        		   
$titre=$bdd->prepare("select r.id_dis_recep_bl, p.*,mg.*, dis.id_dis,nav.navire,nav.type,cli.client, dis.poids_kg from reception as r
  inner join dispatching as dis on dis.id_dis=r.id_dis_recep_bl
  inner join client as cli on cli.id=dis.id_client
  inner join navire_deb as nav on nav.id=dis.id_navire
  inner join produit_deb as p on p.id=r.id_produit_recep
  inner join mangasin as mg on mg.id=r.id_destination_recep
  where r.id_dis_recep_bl=? group by r.id_dis_recep_bl ");
 $titre->bindParam(1,$b);
 $titre->execute();
 
$situation_r=$bdd->prepare("select r.*, sum(r.sac_recep),sum(r.poids_recep), sum(r.manquant_recep),p.*,mg.* from reception as r

  inner join produit_deb as p on p.id=r.id_produit_recep
  inner join mangasin as mg on mg.id=r.id_destination_recep
  where r.id_dis_recep_bl=? ");
 $situation_r->bindParam(1,$b);
 $situation_r->execute();


  $situation_avr=$bdd->prepare("select avr.*, sum(avr.sac_flasque_avr),sum(avr.sac_mouille_avr), dis.id_dis,p.id,mg.id from avaries_de_reception as avr
  inner join dispatching as dis on dis.id_dis=avr.id_dis_avr
  inner join produit_deb as p on p.id=dis.id_produit
  inner join mangasin as mg on mg.id=dis.id_mangasin
  where id_dis_avr=? ");
   $situation_avr->bindParam(1,$b);
 $situation_avr->execute();

   $situation_rav=$bdd->prepare("select rav.*, sum(rav.sac_flasque_ra),sum(rav.sac_mouille_ra),sum(rav.poids_mouille_ra),sum(rav.poids_flasque_ra), p.id,mg.id from reception_avaries as rav
 
  inner join produit_deb as p on p.id=rav.id_produit_ra
  inner join mangasin as mg on mg.id=rav.id_destination_ra
  where rav.id_dis_bl_ra=? ");
   $situation_rav->bindParam(1,$b);
 $situation_rav->execute();
 ?>
 <div id="pdf">
<div style="background: white;">
 <div class="container-fluid">
  <div class="row">
   <div class="col col-md-3 col-lg-3"> 
  <img src="../mylogo.ico" style="height: 200px;">
  </div>
  </div>
</div>
 <div class="container-fluid">
  <div class="row">
  <div class="col col col-md-3 col-lg-3">
  <h6 style="float: left; font-weight: bolder; color: rgb(50, 159, 170);">Societé des Industries Maritimes</h6>
   <h6 style="float: left; color: rgba(50, 159, 218, 0.9); ">Shipping - Manutention - Transit</h6>
    <h6 style="float: left; color: rgba(50, 159, 218, 0.9); ">Logistique - Transport -Entreposage</h6>
    </div>


 </div>
  </div>


 
  <br>
  <div id="entete">
  <center>
  <h5>PROCES VERBAL DE RECEPTION</h5>
  </center>
</div>
<br>
<div class="table-responsive"  >
          
     <center>
  <table class='table ' id='table' style="border: none; width: 50%;" >

<?php while($t=$titre->fetch()){ ?>

  <tr style="border: none; font-size: 14px;">
    <td style="border: none;">NAVIRE</td>
    <td style="border: none;"><span style="color:red;"> :<?php echo $t['navire']; ?></span></td>
  </tr> 
    <tr style="border: none; font-size: 14px;">
    <td style="border: none;">MANUTENTION</td>
    <td style="border: none;"><span style="color:red;">:SIMAR SA</span></td>
  </tr> 
    <tr>
    <td style="border: none; font-size: 14px;">CLIENT</td>
    <td style="border: none;"><span style="color:red;">:<?php echo $t['client']; ?></span></td>
  </tr> 
    <tr>
    <td style="border: none; font-size: 14px;">VARIETE</td>
    <td style="border: none;"><span style="vertical-align: middle; color: red;">  :<?php    echo $t['produit'].' '. $t['qualite'].' '.$t['poids_kg'].' KGS';  ?></span></td>
  </tr>   
    <tr>
    <td style="border: none; font-size: 14px;">ENTREPOT DE STOCKAGE</td>
    <td style="border: none;"><span style="color:red;">:<?php echo $t['mangasin'] ?></span></td>
  </tr>
  

  
  </table>
  </center> 
  </div>
<center>
  <button id="mybutton" class="hide-on-print" data-role="ajout_intervenant" data-id="<?php echo $t['id_dis_recep_bl'] ?>" >ajouter un intervenant</button>
  <?php } ?>
 <h5> DU <span style="color:red; font-weight: bold;"><?php if($d1=$date1->fetch()){
   $d1ex=explode('-', $d1['dates_recep']); 
  echo $d1ex[2].' au '; } ?>
  <?php if($d2=$date2->fetch()){
   $d2ex=explode('-', $d2['dates_recep']); 
  echo $d2ex[2].'-'.$d2ex[1].'-'.$d2ex[0]; } ?> </span></h5>
  </center>
  

  <div class="table-responsive" style=""  > 
    
<center> 
  <table class='table table-hover table-bordered table-striped' id='table' style="width: 50%;"  >
    
 
<thead>
         
          



  


  
 <tr class="" style="border: 2px; border-color: black; font-size: 14px;"  >
      
      
      <th id="colLibeles" scope="col"  >NATURE DES SACS</th>
      <th id="colLibeles" scope="col"    >QUANTITE</th>
      <th id="colLibeles"  >POIDS</th>
      
      
      
  </tr>
</thead>
   
        <tbody>
          <?php   while($row=$situation_r->fetch()){ 
           $rav=$situation_rav->fetch();
           $avr=$situation_avr->fetch(); 
          //LES VARIABLES NECESSAIRE
           //POIDS MOUILLE RECEPTION
           $poids_mouille_avr=$avr['sum(avr.sac_mouille_avr)']*$row['poids_sac_recep']/1000;

            //POIDS FLASQUE RECEPTION
           $poids_flasque_avr=$avr['sum(avr.sac_flasque_avr)']*$row['poids_sac_recep']/1000;

           //SACS SAINS
           $sac_sain=$row['sum(r.sac_recep)']-$avr['sum(avr.sac_flasque_avr)']-$avr['sum(avr.sac_mouille_avr)'];
           //POIDS SAIN
           $poids_sain=$sac_sain*$row['poids_sac_recep']/1000;

           //TOTAL FLASQUE (RECEPTION + DEBARQUEMENT)
           $total_flasque=$avr['sum(avr.sac_flasque_avr)']+$rav['sum(rav.sac_flasque_ra)'];

           $total_mouille=$avr['sum(avr.sac_mouille_avr)']-$rav['sum(rav.sac_mouille_ra)'];
           $total_poids_mouille=($avr['sum(avr.sac_mouille_avr)']+$rav['sum(rav.sac_mouille_ra)'])*$row['poids_sac_recep']/1000;
           $total_sac_receptionnes=$sac_sain+$avr['sum(avr.sac_flasque_avr)']+$avr['sum(avr.sac_mouille_avr)']+$rav['sum(rav.sac_flasque_ra)']+$rav['sum(rav.sac_mouille_ra)'];;
           $total_poids_receptionnes=$poids_sain+$poids_mouille_avr+$poids_flasque_avr+$rav['sum(rav.poids_flasque_ra)']+$rav['sum(rav.poids_mouille_ra)'];

           ?>
           <tr style="text-align: center; vertical-align: middle; font-size: 14px;"> 
            <td > SACS SAINS DE RECEPTION </td>
            <td> <?php  echo number_format($sac_sain,0,',',' ') ?> </td>
             <td> <?php  echo number_format($poids_sain,3,',',' ') ?> </td>
           </tr>
           <tr style="text-align: center; vertical-align: middle; font-size: 14px;"> 
             <td > FLASQUES DE RECEPTION </td>

             <td> <?php  echo number_format($avr['sum(avr.sac_flasque_avr)'],0,',',' ') ?> </td>
             <td > <?php  echo number_format($poids_flasque_avr,3,',',' ') ?> </td>
           </tr>

           <tr style="text-align: center; vertical-align: middle; font-size: 14px;"> 
            <td > MOUILLES DE RECEPTION </td>
            <td > <?php  echo number_format($avr['sum(avr.sac_mouille_avr)'],0,',',' ') ?> </td>
             <td> <?php  echo number_format($poids_mouille_avr,3,',',' ') ?> </td>
           </tr>

           <tr style="text-align: center; vertical-align: middle; font-size: 14px;"> 
            <td > FLASQUE DE DEBARQUEMENT </td>
            <td > <?php  echo number_format($rav['sum(rav.sac_flasque_ra)'],0,',',' ') ?> </td>
             <td> <?php  echo number_format($rav['sum(rav.poids_flasque_ra)'],3,',',' ') ?> </td>
           </tr>
            <tr style="text-align: center; vertical-align: middle;"> 
            <td > MOUILLE DE DEBARQUEMENT </td>
            <td > <?php  echo number_format($rav['sum(rav.sac_mouille_ra)'],0,',',' ') ?> </td>
             <td> <?php  echo number_format($rav['sum(rav.poids_mouille_ra)'],3,',',' ') ?> </td>
           </tr>

            </tr>
            <tr style="text-align: center; vertical-align: middle; color: white; background: black; font-size: 14px;"> 
            <td > TOTAL RECEPTIONNES </td>
            <td > <?php  echo number_format($total_sac_receptionnes,0,',',' ') ?> </td>
             <td> <?php  echo number_format($total_poids_receptionnes,3,',',' ') ?> </td>
           </tr>
             
         <?php  } ?>
         <tr style="border: none; font-size: 14px;">
           <td style="text-align: center; border: none;" colspan="3">INTERVENANT</td>
         </tr>
         
         </tbody>
       </table>
       </center> 
     
 <center>
     <div id="afficher_intervenant" style="width: 70%;">
      <div class="row">
           <?php while ($inter=$intervenant->fetch()) { ?>
            <div class="col-md-4 col-lg-4">
            <p><?php echo $inter['nom_intervenant']; ?></p>
            </div>
          <?php } ?>
          </div>
         </div>
         </center>
<br><br><br><br>


<div class="container-fluid">
  <div class="row">
   <div class="col col col-md-12 col-lg-12" style="border: solid; border-top:2px; border-color:rgba(50, 159, 218, 0.9);">  
</div>
 <div class="col col col-md-12 col-lg-12" > 
  <center>
  <h6 style="color:rgba(50, 159, 218, 0.9) !important">
    RC 2000 B 69 -NINEA 0394586 2G3 -NITI 202204477/B
  </h6>
  <h6 style="color:rgba(50, 159, 218, 0.9) !important">
    Adresse: 2, Place de l'independance - BP 27190 Dakar - Tel: 33 823 69 96- Fax: 33 823 69 95 - www.simarsn.com

  </h6>
  <h6 style="color:rgba(50, 159, 218, 0.9) !important">
   E-mail: www.simarsn.com
     
  </h6>
  </center>

</div>
<style type="text/css">
  @media print {
  .hide-on-print {
    display: none !important;
  }
}
 #colLibeles{
      background: rgba(83,104,253,0.9); color: white;
      vertical-align: middle;
      text-align: center;

    } 
         #table{
          border: 5px; 
     }
</style>
<div class="hide-on-print">
   <button style="margin:auto-right;" class="btn btn-primary" onClick="imprimer('pdf')">imprimer</button></div>
  </div>
  </div>
<?php     
 } ?>
</div>
</div>
</center>
</div>
</div>
</div>
</div>





	

