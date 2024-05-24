<?php 
require("../database.php");
$navire=$_POST['navire'];

$final=$bdd->prepare("SELECT dis.*,rm.*,av.*, p.*, nav.*, sum(rm.sac),sum(rm.poids) from register_manifeste as rm
left join produit_deb as p on p.id=rm.id_produit
left join navire_deb as nav on nav.id=rm.id_navire
left join dispatching as dis on dis.id_produit=rm.id_produit and dis.poids_kg=rm.poids_sac

left join avaries as av on  av.poids_sac_avaries= rm.poids_sac and av.id_produit=rm.id_produit
where dis.id_navire=? 
 ");
$final->bindParam(1,$navire);

$final->execute();

$bl=$bdd->prepare("SELECT n_bl from dispatching
where  id_navire=? order by n_bl asc
 ");
$bl->bindParam(1,$navire);

$bl->execute();


$sain=$bdd->prepare("SELECT sum(sac) from register_manifeste
where  id_navire=?
 ");
$sain->bindParam(1,$navire);

$sain->execute();

$avaries=$bdd->prepare("SELECT sum(sac_flasque),sum(sac_mouille) from avaries
where  id_navire=?
 ");
$avaries->bindParam(1,$navire);

$avaries->execute();

$type_navire=$bdd->prepare("SELECT type from navire_deb where id=?");
$type_navire->bindParam(1,$navire);
$type_navire->execute();

$navires=$bdd->prepare("SELECT  navire from navire_deb where id=?");
$navires->bindParam(1,$navire);
$navires->execute();

$receptionnaire=$bdd->prepare("SELECT dis.id_client,cli.client from dispatching as dis inner join client as cli on cli.id=dis.id_client where dis.id_navire=? GROUP BY dis.id_client ");
$receptionnaire->bindParam(1,$navire);

$receptionnaire->execute();

?> 

<div class="table-responsive" id="final_report"  > 
    

  <table class='table table-hover table-bordered table-striped' id='table'  >
    
 
<thead>
         
          



  


  
 <tr class="" style="border: 2px; border-color: white; font-size: 18px;  color: blue; text-align: center; text-decoration: underline; font-weight: bold;"  >
     <th colspan="2"> FINAL REPORT SUMMARY GLOBAL</th> 
      
      
      
      
      
  </tr>
   
        <tbody>
          <?php while($fin=$final->fetch()){ 
         $nav=$navires->fetch(); 
             ?>

          <tr style="text-align: center; vertical-align: middle; font-size: 14px;"> 
            <td > NAVIRE </td>
            <td> <?php  echo $nav['navire']; ?> </td>
            
           </tr>
           <tr style="text-align: center; vertical-align: middle; font-size: 14px;"> 
             <td > DATE AND TIME ARRIVAL </td>

             <td><?php echo $fin['eta'] ?> </td>
             
           </tr>
           <tr style="text-align: center; vertical-align: middle; font-size: 14px;"> 
             <td > DESCRIPTION OF GOODS </td>

             <td> </td>
             
           </tr>

           <tr style="text-align: center; vertical-align: middle; font-size: 14px;"> 
            <td > BILL OF LOADING N° </td>
            <td > <?php while ($bls=$bl->fetch()) {
              # code...
             echo $bls['n_bl'].'  '; } ?> </td>
           
             
           </tr>

           <tr style="text-align: center; vertical-align: middle; font-size: 14px;"> 
            <td > QUALITY OF RICE/ QUALITE DU RIZ</td>
            <td > <?php echo $fin['qualite'] ?> </td>
             
           </tr>
          
           <tr style="text-align: center; vertical-align: middle; font-size: 14px;"> 
            <td > RECEIVER / RECEPTIONNAIRE</td>
            <td > <?php while ($recep=$receptionnaire->fetch()) {
              # code...
            echo $recep['client'].' , ';  } ?> </td>
             
           </tr>

           <?php while($sains=$sain->fetch()){ ?>
           <tr style="text-align: center; vertical-align: middle;"> 
            <td >SOUND BAGS / SAINS </td>
            <td ><?php echo $sains['sum(sac)'];  ?>  </td>
             
           </tr>
           <?php $type=$type_navire->fetch();
          if($type['type']=="SACHERIE"){ ?>

           <?php while($av=$avaries->fetch()){ ?>
            <tr style="text-align: center; vertical-align: middle;"> 
            <td > TORN BAGS / FLASQUES </td>
            <td > <?php echo $av['sum(sac_flasque)'] ?> </td>
             
           </tr>

            
            <tr style="text-align: center; vertical-align: middle;"> 
            <td > WET BAGS / MOUILLES  </td>
            <td > <?php echo $av['sum(sac_mouille)'];
             $total_sac=$av['sum(sac_flasque)']+$av['sum(sac_mouille)'] + $sains['sum(sac)']  ?> </td>
            </tr>

            <tr style="text-align: center; vertical-align: middle; font-size: 14px;"> 
            <td > EMPTY BAGS / VIDES </td>
            <td >  </td>
             
           </tr>
            
            <tr style="text-align: center; vertical-align: middle; font-size: 14px;"> 
            <td > FALLEN OF THE SEA / TOMBES EN MER</td>
            <td > </td>
             
           </tr>

             <tr style="text-align: center; vertical-align: middle;"> 
            <td > TOTAL DISCHARGED / TOTAL DECHARGE </td>
            <td > <?php echo $total_sac;
              ?> </td>
            </tr>
             <tr style="text-align: center; vertical-align: middle;"> 
            <td > MANIFEST IN BAGS / MANIFEST EN SACS </td>
            <td >  </td>
            </tr>
                         <tr style="text-align: center; vertical-align: middle;"> 
            <td > SHORTAGE / MANQUANT </td>
            <td >  </td>
            </tr>
                         <tr style="text-align: center; vertical-align: middle;"> 
            <td > EXCESS / EXCEDENT </td>
            <td >  </td>
            </tr>
                         <tr style="text-align: center; vertical-align: middle;"> 
            <td > MANIFEST IN METRIC TONS </td>
            <td >  </td>
            </tr>

          <?php } 
          if($type['type']=="VRAQUIER") {  ?>
            <tr style="text-align: center; vertical-align: middle;"> 
            <td >  TOTAL DISCHARGED / TOTAL DECHARGE </td>
            <td > <?php echo $sains['sum(sac)'] ?>
               </td>
             </tr>  

             <tr style="text-align: center; vertical-align: middle;"> 
            <td > MANIFEST IN BAGS / MANIFEST EN SACS </td>
            <td >  </td>
            </tr>
                         <tr style="text-align: center; vertical-align: middle;"> 
            <td > SHORTAGE / MANQUANT </td>
            <td >  </td>
            </tr>
                         <tr style="text-align: center; vertical-align: middle;"> 
            <td > EXCESS / EXCEDENT </td>
            <td >  </td>
            </tr>
                         <tr style="text-align: center; vertical-align: middle;"> 
            <td > MANIFEST IN METRIC TONS </td>
            <td >  </td>
            </tr>

           
             
         <?php } } } } ?>

         
         
         
         </tbody>
       </table>

