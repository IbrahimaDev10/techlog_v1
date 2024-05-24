<div class="col col-lg-12" id="deb_by_cale" style="display: none;">
  <?php 
 $cale=$bdd->prepare("SELECT dc.*,count(dc.cales), sum(dc.nombre_sac), sum(dc.poids), p.* FROM declaration_chargement as dc LEFT join produit_deb as p on dc.id_produit=p.id  where dc.id_navire=?  group by dc.cales,p.produit, dc.conditionnement  ");
          $cale->bindParam(1,$a[0]);
          
          
          $cale->execute();  ?>



<div class="table-responsive"  >
        	<?php if(!empty($tr['dates'])){
            $DateDebut=explode('-',$tr['dates']);
           if(!empty($tr2['dates'])){
            $DateActuel=explode('-',$tr2['dates']);?>

 <table class='table table-hover table-bordered table-striped' id='table' >";
    

<thead>
           <tr style="background: linear-gradient(to bottom, blue, #1B2B65); background: linear-gradient(to left, blue, #1B2B65); background: linear-gradient(to top, blue, #1B2B65); color: white; text-align: center; font-weight: bold; " >
           <td colspan="10" ><h4 style="color: white;">	SITUATION DU DEBARQUEMENT <span style="color:yellow;">PAR CALE</span> DU <span style="color: red; background: white;"><?php echo  $DateActuel[2]. '-' .$DateActuel[1].'-'.$DateActuel[0];?></span></h4></td></tr>
<?php 
         }  }
	 ?>
        	



	
 <tr class="EnteteTableSituation" style="font-size: 12px;" >
      

      <td id="colLibeles" scope="col"  rowspan="2"  >CALES</td>
      <td id="colLibeles" scope="col"  rowspan="2"  >PRODUIT</td>
      <td id="colManifeste" colspan="2" >MANIFESTE</td>
      <td scope="col" colspan="2" id="colDeb24H" >DEB 24H</td>
      <td scope="col" colspan="2" id="colDebTOTAL" > TOTAL DEB</td>
      <td scope="col" colspan="2" id="colROB">ROB</td>
  </tr>
  	<tr class="EnteteTableSituation"  >
      
      <td id="colManifeste">NBRE SACS</td>
      <td id="colManifeste">POIDS</td>
        <td scope="col" id="colDeb24H" >NBRE SACS</td>
      <td scope="col" id="colDeb24H" >POIDS</td>
        <td scope="col" id="colDebTOTAL" >NBRE SACS</td>
      <td scope="col" id="colDebTOTAL" >POIDS</td>
        <td scope="col" id="colROB">NBRE SACS</td>
      <td scope="col" id="colROB" >POIDS</td>
        
     
     
 
         </tr>
         </thead> 
         <tbody> 
         
       <?php 
        
       while($cal2=$cale->fetch()){

        $avaries_deb24H=$bdd->prepare("SELECT * , sum(sac_flasque),sum(poids_flasque),sum(sac_mouille),sum(poids_mouille) from avaries  where id_navire=? and date_avaries=? and poids_sac_avaries=? and id_produit=? and cale_avaries=?  group by cale_avaries,id_produit, poids_sac_avaries ");

                  $avaries_deb24H->bindParam(1,$a[0]);
                  $avaries_deb24H->bindParam(2,$a[1]);
                  $avaries_deb24H->bindParam(3,$cal2['conditionnement']);
                  $avaries_deb24H->bindParam(4,$cal2['id_produit']);
                  $avaries_deb24H->bindParam(5,$cal2['cales']);
          $avaries_deb24H->execute();

          $sain_deb24H=$bdd->prepare("SELECT * , sum(sac),sum(poids) from register_manifeste  where id_navire=? and dates=? and poids_sac=? and id_produit=? and cale=?  group by cale, id_produit, poids_sac ");

                  $sain_deb24H->bindParam(1,$a[0]);
                  $sain_deb24H->bindParam(2,$a[1]);
                  $sain_deb24H->bindParam(3,$cal2['conditionnement']);
                  $sain_deb24H->bindParam(4,$cal2['id_produit']);
                  $sain_deb24H->bindParam(5,$cal2['cales']);
          $sain_deb24H->execute();

           $avaries_debST24H=$bdd->prepare("SELECT * , sum(sac_flasque),sum(poids_flasque),sum(sac_mouille),sum(poids_mouille) from avaries  where id_navire=? and date_avaries=?   group by cale_avaries   ");

                  $avaries_debST24H->bindParam(1,$a[0]);
                  $avaries_debST24H->bindParam(2,$a[1]);
                 
          $avaries_debST24H->execute();

         $sain_debST24H=$bdd->prepare("SELECT * , sum(sac),sum(poids) from register_manifeste  where id_navire=? and dates=?  group by cale ");

                  $sain_debST24H->bindParam(1,$a[0]);
                  $sain_debST24H->bindParam(2,$a[1]);

                 
          $sain_debST24H->execute(); 

          $avaries_debSTT=$bdd->prepare("SELECT * , sum(sac_flasque),sum(poids_flasque),sum(sac_mouille),sum(poids_mouille) from avaries  where id_navire=? and date_avaries<=?   group by cale_avaries   ");

                  $avaries_debSTT->bindParam(1,$a[0]);
                  $avaries_debSTT->bindParam(2,$a[1]);
                  
          $avaries_debSTT->execute();

         $sain_debSTT=$bdd->prepare("SELECT * , sum(sac),sum(poids) from register_manifeste  where id_navire=? and dates=?  group by cale ");

                  $sain_debSTT->bindParam(1,$a[0]);
                  $sain_debSTT->bindParam(2,$a[1]);

                  
          $sain_debSTT->execute(); 


          $avaries_debT=$bdd->prepare("SELECT * , sum(sac_flasque),sum(poids_flasque),sum(sac_mouille),sum(poids_mouille) from avaries  where id_navire=? and date_avaries=? and poids_sac_avaries=? and id_produit=? and cale_avaries=?  group by cale_avaries,id_produit, poids_sac_avaries ");

                  $avaries_debT->bindParam(1,$a[0]);
                  $avaries_debT->bindParam(2,$a[1]);
                  $avaries_debT->bindParam(3,$cal2['conditionnement']);
                  $avaries_debT->bindParam(4,$cal2['id_produit']);
                  $avaries_debT->bindParam(5,$cal2['cales']);
          $avaries_debT->execute();

          $sain_debT=$bdd->prepare("SELECT * , sum(sac),sum(poids) from register_manifeste  where id_navire=? and dates=? and poids_sac=? and id_produit=? and cale=?  group by cale, id_produit, poids_sac ");

                  $sain_debT->bindParam(1,$a[0]);
                  $sain_debT->bindParam(2,$a[1]);
                  $sain_debT->bindParam(3,$cal2['conditionnement']);
                  $sain_debT->bindParam(4,$cal2['id_produit']);
                  $sain_debT->bindParam(5,$cal2['cales']);
          $sain_debT->execute();




$fm=$bdd->prepare("SELECT dc.*,av.*, sum(sac_flasque),sum(poids_flasque),sum(sac_mouille),sum(poids_mouille), p.produit from declaration_chargement as dc LEFT join produit_deb as p on dc.id_produit=p.id
 LEFT join avaries as av on dc.id_produit=av.id_produit and dc.cales=av.cale_avaries 
 and dc.conditionnement=av.poids_sac_avaries and dc.id_navire=av.id_navire where dc.id_navire=? and av.date_avaries=? and dc.conditionnement=? and dc.id_produit=? group by dc.cales,p.produit, dc.conditionnement with rollup;");

                  $fm->bindParam(1,$a[0]);
                  $fm->bindParam(2,$a[1]);
                  $fm->bindParam(3,$cal2['conditionnement']);
                  $fm->bindParam(4,$cal2['id_produit']);
          
          
          $fm->execute();          



        $caleT=$bdd->prepare("SELECT dc.*,sum(dc.nombre_sac), p.*, rm.*, sum(rm.sac),sum(rm.poids)  FROM declaration_chargement as dc
          LEFT  join produit_deb as p on dc.id_produit=p.id
          LEFT  join register_manifeste as rm on  dc.id_produit=rm.id_produit and dc.cales=rm.cale
          and dc.conditionnement=rm.poids_sac 
          
         where  dc.id_navire=? and rm.dates<=? and dc.conditionnement=? and dc.id_produit=?    group by dc.cales,p.produit, dc.conditionnement  with rollup ");
                  $caleT->bindParam(1,$a[0]);
                  $caleT->bindParam(2,$a[1]);
                  $caleT->bindParam(3,$cal2['conditionnement']);
                  $caleT->bindParam(4,$cal2['id_produit']);
          
          $caleT->execute();


       $calTOT=$caleT->fetch();
       $av_deb=$avaries_deb24H->fetch();
       $s_deb=$sain_deb24H->fetch();
      $av_debT=$avaries_debT->fetch();
       $s_debT=$sain_debT->fetch();
       //$avaries2=$fm->fetch();
       $av_debST=$avaries_debST24H->fetch();
       $s_debST=$sain_debST24H->fetch();

       $av_debSTT=$avaries_debSTT->fetch();
       $s_debSTT=$sain_debSTT->fetch();


      //VARIABLES AVARIES
      if(empty($av_deb['sum(sac_flasque)'])){
        $sac_avaries=0;
      }
      else{
        $sac_avaries= $av_deb['sum(sac_flasque)'];
      }
      if(empty($av_deb['sum(poids_flasque)'])){
        $poids_avaries=0;
      }
      else{
        $poids_avaries= $av_deb['sum(poids_flasque)'];
      }

    if(empty($av_debT['sum(sac_flasque)'])){
        $sac_avariesT=0;
      }
      else{
        $sac_avariesT= $av_debT['sum(sac_flasque)'];
      }
      if(empty($av_debT['sum(poids_flasque)'])){
        $poids_avariesT=0;
      }
      else{
        $poids_avariesT= $av_debT['sum(poids_flasque)'];
      }

      if(empty($av_debST['sum(sac_flasque)'])){
        $sac_avariesST=0;
      }
      else{
        $sac_avariesST= $av_debST['sum(sac_flasque)'];
      }
      if(empty($av_debST['sum(poids_flasque)'])){
        $poids_avariesST=0;
      }
      else{
        $poids_avariesST= $av_debST['sum(poids_flasque)'];
      }

      if(empty($av_debSTT['sum(sac_flasque)'])){
        $sac_avariesSTT=0;
      }
      else{
        $sac_avariesSTT= $av_debSTT['sum(sac_flasque)'];
      }
      if(empty($av_debSTT['sum(poids_flasque)'])){
        $poids_avariesSTT=0;
      }
      else{
        $poids_avariesSTT= $av_debSTT['sum(poids_flasque)'];
      }


      //VARIABLES SAINS
      if(empty($s_deb['sum(sac)'])){
        $sac_sains=0;
      }
      else{
        $sac_sains= $s_deb['sum(sac)'];
      }
      if(empty($s_deb['sum(poids)'])){
        $poids_sains=0;
      }
      else{
        $poids_sains= $s_deb['sum(poids)'];
      }

      if(empty($s_debT['sum(sac)'])){
        $sac_sainsT=0;
      }
      else{
        $sac_sainsT= $s_debT['sum(sac)'];
      }
      if(empty($s_debT['sum(poids)'])){
        $poids_sainsT=0;
      }
      else{
        $poids_sainsT= $s_debT['sum(poids)'];
      }

      if(empty($s_debST['sum(sac)'])){
        $sac_sainsST=0;
      }
      else{
        $sac_sainsST= $s_debST['sum(sac)'];
      }
      if(empty($s_debST['sum(poids)'])){
        $poids_sainsST=0;
      }
      else{
        $poids_sainsST= $s_debST['sum(poids)'];
      }

       if(empty($s_debSTT['sum(sac)'])){
        $sac_sainsSTT=0;
      }
      else{
        $sac_sainsSTT= $s_debSTT['sum(sac)'];
      }
      if(empty($s_debSTT['sum(poids)'])){
        $poids_sainsSTT=0;
      }
      else{
        $poids_sainsSTT= $s_debSTT['sum(poids)'];
      }
      
      


        
       
    /*   $sum_sac=$cal2['nombre_sac']-$calTOT['sum(rm.sac)']-$avariesT['sum(sac_flasque)']-$avariesT['sum(sac_mouille)'];

       $poids=$cal2['nombre_sac']*$cal2['conditionnement']/1000;
       $sum_poids=$poids-$calTOT['sum(rm.poids)']-$avaries2['sum(poids_flasque)']-$avaries2['sum(poids_mouille)'];

      // $sacs_24H=$cal2['sum(rm.sac)']+$avaries2['sum(sac_flasque)']+$avaries2['sum(sac_mouille)'];
        $sacs_24H=$cal2['sum(rm.sac)']+$avaries2['sum(sac_flasque)']+$avaries2['sum(sac_mouille)'];
       // $poids_24H=$cal2['sum(rm.poids)']+$avaries2['sum(poids_flasque)']+$avaries2['poids_mouille'];
        $poids_24H=$cal2['sum(rm.poids)']+$avaries2['sum(poids_flasque)']+$avaries2['sum(poids_mouille)'];
        $total_sac=$calTOT['sum(rm.sac)']+$avariesT['sum(sac_flasque)']+$avariesT['sum(sac_mouille)'];
        $total_poids=$calTOT['sum(rm.poids)']+$avariesT['sum(poids_flasque)']+$avariesT['sum(poids_mouille)']; */

        ?>

       	
          <?php //if(!empty($cal2['produit']) and !empty($cal2['conditionnement']) and !empty($cal2['cales'])) {?>
            <tr class="CelluleTableSituation" >
    <td id="colLibeles" scope="col"   ><?php echo $cal2['cales']; ?> <?php  echo $cal2['count(dc.cales)']; ?></td>
    <td id="colLibeles"  scope="col"   ><?php echo $cal2['produit']; ?> <?php echo $cal2['conditionnement']; ?> KGS</td>
    
    <td  scope="col" id="colManifeste"  ><?php echo number_format($cal2['nombre_sac'], 0,',',' ');  ?></td>
    <td  scope="col" id="colManifeste" ><?php echo number_format($cal2['poids'], 3,',',' '); ?></td>
    
     	<td id="colDeb24H" scope="col" ><?php echo number_format($sac_avaries + $sac_sains, 0,',',' '); ?></td>
     	<td id="colDeb24H" scope="col"  ><?php echo number_format($poids_avaries + $poids_sains , 3,',',' '); ?></td>
     	<td scope="col" id="colDebTOTAL"><?php echo number_format($sac_avariesT + $sac_sainsT, 0,',',' '); ?></td>
     	<td scope="col" id="colDebTOTAL"><?php echo number_format($poids_avariesT + $poids_sainsT , 3,',',' '); ?></td>
     <td scope="col" id="colROB"><?php echo number_format($cal2['nombre_sac']-($sac_avariesT + $sac_sainsT), 0,',',' '); ?></td>
     	<td scope="col" id="colROB" ><?php echo number_format($cal2['poids']-($poids_avariesT + $poids_sainsT), 3,',',' '); ?></td>
     </tr>

     <?php //} ?>
     <tr > 
      <td id="sousTOTAL" colspan="2">  TOTAL <?php  echo $cal2['cales'];  ?></td>
      <td id="sousTOTAL" scope="col" ><?php echo number_format($cal2['sum(dc.nombre_sac)'], 0,',',' '); ?></td>
       <td id="sousTOTAL" scope="col" ><?php echo number_format($cal2['sum(dc.poids)'], 3,',',' '); ?></td>
        <td id="sousTOTAL" scope="col"  ><?php echo number_format($sac_avariesST + $sac_sainsST , 0,',',' '); ?></td>
          <td id="sousTOTAL" scope="col"  ><?php echo number_format($poids_avariesST + $poids_sainsST , 3,',',' '); ?></td>
          <td id="sousTOTAL" scope="col"  ><?php echo number_format($sac_avariesSTT + $sac_sainsSTT , 0,',',' '); ?></td>
          <td id="sousTOTAL" scope="col"  ><?php echo number_format($poids_avariesSTT + $poids_sainsSTT , 3,',',' '); ?></td>
          <td id="sousTOTAL" scope="col"  ><?php echo number_format($cal2['sum(dc.nombre_sac)']- ($sac_avariesSTT + $sac_sainsSTT) , 0,',',' '); ?></td>
          <td id="sousTOTAL" scope="col"  ><?php echo number_format($cal2['sum(dc.poids)']- ($poids_avariesSTT + $poids_sainsSTT) , 3,',',' '); ?></td>          

     </tr>

    

     <?php }  ?>
    
 
      
	 </tbody>


 </table>
</div>

<style type="text/css">
  @media print {
  .no_print {
    display: none;
  }
   
  #btnafficher, #cacherimprimer, #situation, .footer {
    display: none;
  
  }
   
  }
</style>


<button style="margin:auto-right;" class="btn btn-primary no_print" onClick="imprimer('deb_by_cale')">imprimer</button>
</div>
<br>  
