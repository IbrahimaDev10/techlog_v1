<?php
require('../database.php');
require('controller/acces_reception.php');
//require('controller/mes_reconditionnement.php');
require('controller/afficher_les_receptions.php');
require('controller/stock_depart.php');
require('controller/situations_receptions_de_transferts.php');


?>

<style type="text/css">
 *{
  font-family: Times New Roman;
 } 
 .fabtn{
  border: none;
  vertical-align: middle;
 


 }
  .fabtn1{
  border: none;
   margin-right: 3px;
  color:rgb(0,141,202);

 }
 .btn1{
  background: linear-gradient(to bottom, blue, #1B2B65); background: linear-gradient(to left, blue, #1B2B65); background: linear-gradient(to top, blue, #1B2B65);
 }
  
   
    .colcel{
      text-align: center;
      vertical-align: middle;
    }
    .colaffiche{
      vertical-align: middle;
      text-align: center;
    }
    
   

</style>

<?php 



  if(isset($_POST["idProduit"])){ 

        $c=$_POST["idProduit"];

    $_SESSION['c']=$c;
    $explode=explode('-', $c);

      $produit=$explode[0];
      $poids_sac=$explode[1];
      $navire=$explode[2];
      $destination=$explode[3];

  

    ?>

<div class="main " id="main" > 

<div class="container-fluid1 " id="situation"  style=" background: rgb(0,141,202);" >
        <div class="row">
            
            
                <div class="col-lg-12 col-md-12">
                    <h1 class="hem2 text-white" style=" background: rgb(0,44,62); font-size: 30px;"> RECEPTION</h1><br>

                    
                    <form method="POST" >
                        <select  id="navires" class="mysel" style="margin-right: 15%; height: 30px;   width: 40%;"  onchange='goNavireSit()'>
                            <option value="">selectionner un navire</option>
                            <?php 
                              if($_SESSION['profil']=="Mangasinier"){
                                 $naviress=choix_du_navire($bdd,$c);
                               }
                               else{
                                $naviress=choix_du_navire2($bdd);
                              }
                            while ($row=$naviress->fetch()) {
                             ?>
                                <option value=<?php echo $row['id_navire'].'-'.$_SESSION['id']; ?> >  <?php echo $row['navire'] ?> </option>
                            <?php } ?>

                 </select>
                        
                     <select id="mesprod" class="mysel" name="produit" style="margin-right: 2%; height: 30px;  width: 40%;" onchange='goProduit()'>
                            <option  selected>selectionner le produit</option>
                        </select>
                        
                 
                            
                    </form>
                
            </div>
        </div>
    </div>


  
   <div class="col-md-12 col-lg-12">
   
</div>
<div class="container-fluid-great"  >
        <div class="row">
 
         

    
 
 
 
</div>

</div>
<br><br>

<div class="container-fluid">
  <div class="row">
  
      <div class="col col-sm-12 col-md-12 col-lg-12">
        <center>
        <button  class="btn btn-primary" id="btnSain"  onclick="visibleSain()">RECONDITIONNEMENT</button>
      
           <button  class="btn btn-primary" id="btnAvariesDeb" onclick="visibleAvariesDeb()">PV DE RECONDITIONNEMENT</button>
       
     
            
      
        </center>
      </div>
    

    
  </div>
</div>


 <?php  






    include("requete.php");

        $Sains = $bdd->prepare("SELECT poids_sac_recep,  sum(sac_recep), sum(poids_recep)  from reception
                   WHERE id_dis_recep_bl=? ");
               $Sains->bindParam(1,$c);
        $Sains->execute();

      $recond_DEPART = $bdd->prepare("SELECT * from reconditionnement_reception
                   WHERE id_dis_recond=? ");
        
        
        $recond_DEPART ->bindParam(1,$c);
        $recond_DEPART ->execute();

                  $SomAvr_DEPART = $bdd->prepare("SELECT  sum(sac_flasque_avr),sum(sac_mouille_avr) from avaries_de_reception
                   WHERE id_dis_avr=? ");
        
        
        $SomAvr_DEPART->bindParam(1,$c);
        $SomAvr_DEPART->execute();



                          $SomRa_DEPART = $bdd->prepare("SELECT  sum(sac_flasque_ra),sum(sac_mouille_ra),sum(poids_flasque_ra),sum(poids_mouille_ra) from reception_avaries
                   WHERE id_dis_bl_ra=? ");
        
        
        $SomRa_DEPART->bindParam(1,$c);
        $SomRa_DEPART->execute();




      

   

               ?>




<div class="container-fluid" id="tableSain" style="display: none;">  
  <br>

  <?php 
  $selectid_dis=bouton_avaries($bdd,$produit,$poids_sac,$navire,$destination);
if($afdis=$selectid_dis->fetch()){ ?>
  <div class="col-md-12 col-lg-12">  
     
<a  class="btn1"  style="background: rgb(65,180,190); " data-role="insert_reconditionnement" data-id="<?php echo $afdis['id'] ?>" data-navire="<?php echo $afdis['id_navire'] ?>"
data-declaration="<?php echo $afdis['id_declaration'] ?>" data-destination="<?php echo $afdis['id_destination'];  ?>"  data-produit="<?php echo $afdis['id_produit'] ?>" data-poids_sac="<?php echo $afdis['poids_sac'] ?>"  >AJOUTER RECONDITIONNEMENT  </a>
<br><br>
</div>
<?php } ?>
 <div class="col col-md-12 col-lg-12">
       
<div class="table-responsive" border=1 >



 <table class='table table-hover table-bordered table-striped table-responsive'  border='2'  >

 <thead style="background-color: rgba(50, 159, 218, 0.9);">
  <td  colspan="13" class="titreSAIN"  >RECONDITIONNEMENT</td>
      
    
    <tr id="th_table_rec"  >
      <td  rowspan="2"   >N°</td>
       <td   rowspan="2"   >DATE</td>
        <td   colspan="2"   >FLASQUES RECEPTIONNES</td>
        <td  rowspan="2"  >SACS EVENTRES</td>
     
      <td   colspan="2" > RECONDITIONNES</td>
      <td   colspan="2"  >BALAYURES </td>
     
     
      <td   rowspan="2" > PERTES EN SACS</td>
       <td   rowspan="2"  >FLASQUES RESTANTS</td>
  </tr>
      
 <tr id="th_table_rec" >
      <td   >SACS</td>
    
      <td    >POIDS</td>

   

            <td   >SACS</td>
    
      <td  >POIDS</td>

      <td  >SACS</td>
    
      <td   >POIDS</td>

     
          
        
     



   
     </tr>
      

     
     
      


      
     </thead>


    <?php afficher_reconditionnement_reception($bdd,$produit,$poids_sac,$navire,$destination); ?>         

            

</table>
</div>
</div>
</div>
<br><br>

<?php 
    // FILTRER LE NAVIRE SI C SACHERIE ON AFFICHE LE TRANSFERT DES AVARIES
   $filtreavaries= $bdd->prepare("SELECT  nav.navire,nav.type,nc.id_connaissement, dis.id_dis   FROM dispat as dis 
                
                 
                inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
                inner join navire_deb as nav on nc.id_navire=nav.id 
                
               
                 

                   WHERE dis.id_produit=? and dis.poids_kg=? and nc.id_navire=? and dis.id_mangasin=?  ");
        $filtreavaries->bindParam(1,$produit);
        $filtreavaries->bindParam(2,$poids_sac);
        $filtreavaries->bindParam(3,$navire);
        $filtreavaries->bindParam(4,$destination);
        $filtreavaries->execute();
        $cherche=$filtreavaries->fetch();
    

          ?>

<div class="container-fluid" id="tableAvariesDeb" style="display: none;"> 

 <div id="pv" >

<div style="background: white;">

 <div class="container-fluid">
  <div class="row">
   <div class=" col-md-3 col-lg-3"> 
  <img src="../img/logo_finaly2.PNG" style="height: 40px; width: 200px;">
  </div>

  </div>
</div>
 <div class="container-fluid">
  <div class="row">
  <div class=" col-md-12 col-lg-12" > <h6 style="font-weight: bolder; color: rgb(50, 159, 170); margin-bottom: 2px;">Societé des Industries Maritimes</h6>
  <h6 style=" color: rgba(50, 159, 218, 0.9); margin-bottom: 2px;">Shipping - Manutention - Transit</h6>
  <h6 style="float: left; color: rgba(50, 159, 218, 0.9); ">Logistique - Transport -Entreposage</h6>
</div>
 <div class=" col-md-3 col-lg-3">
    </div>
    <div class="col-md-9 col-lg-9" >
   
  <h6 style="float: right;">Dakar le ................................</h6>  
  </div>


 </div>
  </div>

   <br>
  <div id="entete">
  <center>
  <h6>PROCES VERBAL DE RECONDITIONNEMENT</h6>
  </center>
</div>
<br>
<div class="table-responsive"  >
          
     <center>
  <table class='table ' id='table' style="border: none; width: 70%;" >

<?php
   $titre=titre_entete_pv($bdd,$produit,$poids_sac,$navire,$destination);
 if($t=$titre->fetch()){ ?>

  <tr style="border: none; font-size: 12px;">
    <td style="border: none; margin-bottom: 3px; font-size: 12px;">NAVIRE</td>
    <td style="border: none; margin-bottom: 3px; font-size: 12px;"><span style="color:red;"> :<?php echo $t['navire']; ?></span></td>
  </tr> 
    <tr style="border: none; font-size: 12px;">
    <td style="border: none; margin-bottom: 1px; font-size: 12px;">MANUTENTIONNAIRE</td>
    <td style="border: none; margin-bottom: 1px; font-size: 12px;"><span style="color:red;">:SIMAR SA</span></td>
  </tr> 
    <tr>
    <td style="border: none; font-size: 12px; margin-bottom: 3px; font-size: 12px;">CLIENT</td>
    <td style="border: none; margin-bottom: 1px; font-size: 12px;"><span style="color:red;">:<?php echo $t['client']; ?></span></td>
  </tr> 
    <tr>
    <td style="border: none; font-size: 12px; margin-bottom: 1px;">VARIETE</td>
    <td colspan="2" style="border: none; margin-bottom: 1px; font-size: 12px;"><span style="vertical-align: middle; color: red;">  :<?php    echo $t['produit'].' '. $t['qualite'].' '.$t['poids_kg'].' KGS';  ?></span></td>
  </tr>   
    <tr>
    <td style="border: none; font-size: 12px; margin-bottom: 1px;">ENTREPOT DE STOCKAGE</td>
    <td style="border: none; margin-bottom: 1px; font-size: 12px;"><span style="color:red;">:<?php echo $t['mangasin'] ?></span></td>
  </tr>
    <?php } ?>

  
  </table>
  </center> 
  </div>

         
  <button class="btn-primary hide-on-print" id="mybutton" class="hide-on-print" data-role="ajout_intervenant" data-id="<?php echo $t['id_dis'] ?>" >ajouter un intervenant</button>
    
  <div class="table-responsive" id="reception"  > 
    
<center> 
  <table style="width: 50%;" class='table table-hover table-bordered table-striped table-responsive' id='table' border='1'  >
    
 
<thead>
         
          



  


  
 <tr class="" style="border: 2px; border-color: white; background: blue; color:white; text-align: center; text-decoration: underline; font-weight: bold;"  >
     <th colspan="2"> RECEPTION</th>      
  </tr>
   <tr   style="text-align: center; vertical-align: middle; font-size: 12px;  "  > 
            <td  style="color: black;"  > NATURE DES SACS </td>
            <td id="colcol"  > NOMBRE DE SACS </td>
            
           </tr>

</thead>
<tbody>
  <?php
         
  //$Sains_Recap=sain_reception($bdd,$produit,$poids_sac,$navire,$destination);
 /* $SomAvr_DEPART_Recap=avaries_reception($bdd,$produit,$poids_sac,$navire,$destination);
  $SomRa_DEPART_Recap=reception_avaries_reception($bdd,$produit,$poids_sac,$navire,$destination);
  $SomRa_DEPART_Recap->execute(); */
 
  $Total_reception=Total_Reception($bdd,$produit,$poids_sac,$navire,$destination);

    $total_avaries_reception=Total_Avaries_de_reception($bdd,$produit,$poids_sac,$navire,$destination);

    $total_reception_flasque_deb= Total_Reception_flasque_deb($bdd,$produit,$poids_sac,$navire,$destination);

     $total_reception_mouille_deb= Total_Reception_mouille_deb($bdd,$produit,$poids_sac,$navire,$destination);

      $total_reception_balayure_deb= Total_Reception_balayure_deb($bdd,$produit,$poids_sac,$navire,$destination);

      $recond_transfert=Total_Recond_transfert($bdd,$produit,$poids_sac,$navire,$destination);



 while($Total_receptions=$Total_reception->fetch()){ 
      $total_avaries_receptions=$total_avaries_reception->fetch();

      $fl_deb=$total_reception_flasque_deb->fetch();
       $m_deb=$total_reception_mouille_deb->fetch();
        $bl_deb=$total_reception_balayure_deb->fetch();

        $recond_tr=$recond_transfert->fetch();
/*  $avr=$SomAvr_DEPART_Recap->fetch();

  $ra=$SomRa_DEPART_Recap->fetch();

  $sac_sains=$sain['sum(rec.sac_recep)'] -($avr['sum(avr.sac_flasque_avr)']+$avr['sum(avr.sac_mouille_avr)']);
  $cumul_sac=$sac_sains + $ra['sum(ra.sac_mouille_ra)'] + $ra['sum(ra.sac_flasque_ra)']; */
  $sac_sains= $Total_receptions['sum(rta.sac)']-($total_avaries_receptions['sum(avt.sac_flasque)'] + $total_avaries_receptions['sum(avt.sac_mouille)']);

  $total_sacs_receptionnes=$sac_sains+$total_avaries_receptions['sum(avt.sac_flasque)']+$total_avaries_receptions['sum(avt.sac_mouille)']+$fl_deb['sum(rta.sac)']+$m_deb['sum(rta.sac)']+$bl_deb['sum(rta.sac)'];

  $perte_sur_reconditionnement=$recond_tr['sum(rt.sac_eventres)']-($recond_tr['sum(rt.sac_recond)'] + $recond_tr['sum(rt.sac_balayure)']);
  $sac_stock_depart=$total_sacs_receptionnes-$perte_sur_reconditionnement;
  $poids_stock_depart=$sac_stock_depart*$Total_receptions['poids_sac']/1000;

    ?>
<tr   style="text-align: center; vertical-align: middle; font-size: 12px;  "  > 
            <td  style="color: black;"  >SACS SAINS </td>
            <td id="colcol"  > <?php echo number_format($sac_sains,0,',',' '); ?> </td>
            
           </tr>
      <tr   style="text-align: center; vertical-align: middle; font-size: 12px;  "  > 
            <td  style="color: black;"  >FLASQUE RECEPTION </td>
            <td id="colcol"  > <?php echo number_format($total_avaries_receptions['sum(avt.sac_flasque)'],0,',',' '); ?> </td>
            
           </tr>
       <tr   style="text-align: center; vertical-align: middle; font-size: 12px;  "  > 
            <td  style="color: black;"  >MOUILLES RECEPTION </td>
            <td id="colcol"  >  <?php echo number_format($total_avaries_receptions['sum(avt.sac_mouille)'],0,',',' '); ?> </td>
            
           </tr>  
        <tr   style="text-align: center; vertical-align: middle; font-size: 12px;  "  > 
            <td  style="color: black;"  >FLASQUES DEBARQUEMENT </td>
            <td id="colcol"  > <?php echo number_format($fl_deb['sum(rta.sac)'],0,',',' '); ?> </td>
            
           </tr>   
            <tr   style="text-align: center; vertical-align: middle; font-size: 12px;  "  > 
            <td  style="color: black;"  >MOUILLES DEBARQUEMENT </td>
            <td id="colcol"  > <?php echo number_format($m_deb['sum(rta.sac)'],0,',',' '); ?> </td>
            
           </tr> 
          <tr   style="text-align: center; vertical-align: middle; font-size: 12px;  "  >
           <td  style="color: black;"  >BALAYURES DEBARQUEMENT </td>
            <td id="colcol"  > <?php echo number_format($bl_deb['sum(rta.sac)'],0,',',' '); ?> </td>
            
           </tr>

            <tr   style="text-align: center; vertical-align: middle; font-size: 12px; background: black; color: white;  "  > 
            <td  style="color: white;"  >CUMUL SACS RECEPTIONNES </td>
            <td id="colcol" style="color: white;" > <?php echo number_format($total_sacs_receptionnes,0,',',' '); ?>  </td>
            
           </tr>  
        
         
           

</tbody>
</table>
</center>
</div>
<style type="text/css" >
  .reg{
    bottom: 0;
  }
  .footer{
    display: none !important;
  }
</style>

<div class="table-responsive" id="reception"  > 
  <center> 
  <table style="width: 100%;" class='table table-hover table-bordered table-striped table-responsive' id='table' border='1'  >
    
 
<thead>
         
 <tr class="" style="border: 2px; border-color: white; background: blue; color:white; text-align: center; text-decoration: underline; font-weight: bold;"  >
     <th colspan="8"> RECONDITIONNEMENT DE RECEPTION</th> 
</tr>
<tr   style="text-align: center; vertical-align: middle; font-size: 12px;  "  > 
  <th>NATURE DES SACS</th>
   <th>NOMBRE DE SACS</th>
    <th>POIDS DES AVARIES</th>
     <th>RECONDITIONNEMENT EN SACS</th>
      <th>RECONDITIONNEMENT EN POIDS</th>
      <th>SACS BALAYURES</th>
      <th>POIDS BALAYURES</th>
       <th>PERTES EN SACS</th>
   </tr>
 </thead>
 <tbody>
  
<tr style="text-align: center; vertical-align: middle; font-size: 12px;  " >
    <th>FLASQUES</th>

  <td><?php echo number_format($recond_tr['sum(rt.sac_eventres)'],0,',',' '); ?></td>
  <td><?php echo number_format($recond_tr['sum(rt.poids_eventres)'],3,',',' '); ?></td>
  <td><?php echo number_format($recond_tr['sum(rt.sac_recond)'],0,',',' '); ?></td>
  <td><?php echo number_format($recond_tr['sum(rt.poids_recond)'],3,',',' '); ?></td>
   <td><?php echo number_format($recond_tr['sum(rt.sac_balayure)'],0,',',' '); ?></td>
   <td><?php echo number_format($recond_tr['sum(rt.poids_balayure)'],3,',',' '); ?></td>
  <td><?php echo number_format($perte_sur_reconditionnement,0,',',' '); ?></td>

  </tr>
   
 </tbody>
</table>
</center>
</div>  
<center>
  <h6 style="color: black !important; font-weight: bold;"> > Nouveaux stocks après reconditionnement <span style="color: red;"><?php echo number_format($sac_stock_depart,0,',',' '); ?></span> sacs soit <span style="color: red;"><?php echo number_format($poids_stock_depart,3,',',' ').' T'; ?> </span>
</center>

 <?php } ?> 
 
<?php afficher_stock_depart_reception($bdd,$produit,$poids_sac,$navire,$destination); ?>
<div class="container-fluid">
<div class="row">
<div class="col col-md-12 col-lg-12" style="border: solid; border-top:2px; border-color:rgba(50, 159, 218, 0.9);"></div></div></div> 
 <center>
 <div class="container" id="afficher_intervenant" >
      <div class="row">

       
           <?php
                 $intervenant=afficher_intervenant($bdd,$c);

            while ($inter=$intervenant->fetch()) { ?>
            <div class="col col-md-4 col-lg-4">
            <p style="color: blue !important;"><?php echo $inter['nom_intervenant']; ?></p>
            </div>
          <?php } ?>
          </div>
         </div><br><br>
    </center>

    <div class="container-fluid reg">
  <div class="row">
   <div class=" col-md-12 col-lg-12" style="border: solid; border-top:2px; border-color:rgba(50, 159, 218, 0.9);">  
</div>
 <div class=" col-md-12 col-lg-12" > 
  <center>
  <h6 style="color:rgba(50, 159, 218, 0.9) !important;">
    RC 2000 B 69 -NINEA 0394586 2G3 -NITI 202204477/B     Adresse: 2, Place de l'independance - BP 27190 Dakar - Tel: 33 823 69 96- Fax: 33 823 69 95 - www.simarsn.com
  </h6>
  </center>
  </div>
  
  

</div></div>
</div>
</div>
</div>




<?php } ?>
 