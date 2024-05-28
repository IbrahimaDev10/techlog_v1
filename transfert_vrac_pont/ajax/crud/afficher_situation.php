<?php require('../../../database.php');
      require('requete_situation.php');
    //  $navire=$_POST['navire'];
      $d=explode('_', $_POST['idDate']);
      $date_deb=$d[0];
      $navire=$d[1];

      $row_cale=0;
      $nom_cale='NULL';
      $row_manifest=0;
      $manifeste_cale='NULL';

      $row_rob=0;
      $rob_cale='NULL';

      $rowspan=rowspan($bdd,$navire);

      $soustraction_row=$rowspan->fetch();

      $soustraction=$soustraction_row['nombre_de_lignes'];

      $proprietaire_navire=$bdd->prepare("SELECT proprietaire from navire_deb where id=?");
      $proprietaire_navire->bindParam(1,$navire);
      $proprietaire_navire->execute();

      $filtre_rob=$proprietaire_navire->fetch();

      $proprietaire=$filtre_rob['proprietaire'];

      function filtrage_rob($proprietaire){
        if($proprietaire=='PARTIELLE'){ 
          return "style='display:none;'";

        }
        else{ 
          return "style='display:block;'";

        }
      }

       ?>
       <style type="text/css">
        .cellule{
          text-align: center;
          vertical-align: middle;
        }
        .cellule_st{
          text-align: center;
          vertical-align: middle;
          background: blue;
          color: white;
        }
       </style>

<div class="table-responsive" style="background: white;" >
  <h6>NAVIRE <?php echo $navire; ?> <?php echo $soustraction; ?></h6>
 <h6>SITUATION DU DEBARQUEMENT PAR CALE DU <?php echo $date_deb; ?> </h6>        

 <table class='table table-hover table-bordered ' id='table' >";
    

<thead>
          
  
 <tr class="EnteteTableSituation" style="font-size: 12px;" >
      

      <td id="colLibeles" scope="col"  rowspan="2"  >CALES</td>
      <td id="colLibeles" scope="col"  rowspan="2"  >PRODUIT</td>
      <td id="colManifeste" <?php echo filtrage_rob($proprietaire); ?> >MANIFESTE</td> 
      <td scope="col"  id="colDeb24H" colspan="2" >DEB 24H</td>
      <td scope="col"  id="colDebTOTAL"  colspan="2"> TOTAL DEB</td>
      <td scope="col"  id="colDebTOTAL" <?php echo filtrage_rob($proprietaire); ?>  > ROB</td>
   <!--   <td scope="col"  id="colROB">ROB</td> !-->
  </tr>
    <tr class="EnteteTableSituation"  >
      
     
      <td id="colManifeste" <?php echo filtrage_rob($proprietaire); ?>>POIDS</td> 
        <td scope="col" id="colDeb24H" >SACS</td>
      <td scope="col" id="colDeb24H" >POIDS</td>
              <td scope="col" id="colDeb24H" >SACS</td>
      <td scope="col" id="colDeb24H" >POIDS</td>
              
      <td scope="col" id="colDeb24H" <?php echo filtrage_rob($proprietaire); ?> >POIDS</td>
        
     
    <!--  <td scope="col" id="colROB" >POIDS</td> !-->
        
     
     
 
         </tr>
         </thead> 
         <tbody>

         <?php $cale=cales($bdd,$navire); 
        
         $cales=$cale->fetchAll(PDO::FETCH_ASSOC);
         foreach($cales as $row){ 



           $cale_manif=$row['cales'];
                  $manifeste=manifeste($bdd,$navire,$cale_manif);
                  $manif=$manifeste->fetch();

                       $id_produit=$row['id_produit'];
              $poids_sac=$row['poids_sac'];
              $cale_deb=$row['id_dec']; 

              $rowspan_deb=rowspan_deb($bdd,$navire,$cale_deb);
              $rows_deb=$rowspan_deb->fetch();

                    $calcul_rob=calcul_rob($bdd,$navire,$date_deb,$cale_deb);
          $calcul_rob_24h=calcul_rob_24h($bdd,$navire,$date_deb,$cale_deb);

            $deb_ROB=$calcul_rob->fetch(); 
            $deb_ROB_24h=$calcul_rob_24h->fetch();

            $deb_cale_GEN24H = deb_cale_GEN24H($bdd,$navire,$date_deb);
            $deb_cale_GENT=deb_cale_GENT($bdd,$navire,$date_deb);

            $deb_G24H=$deb_cale_GEN24H->fetch();
            $deb_GT=$deb_cale_GENT->fetch(); 

            if(!empty($deb_ROB_24h['sum(pb.poids_net)'])){

       $net_marchand_ST24h=$deb_ROB_24h['sum(pb.poids_net)'];
     }
     if(empty($deb_ROB_24h['sum(pb.poids_net)'])){

       $net_marchand_ST24h=0;
     }

    if(!empty($deb_ROB_24h['sum(td.sac)'])){

       $sac_ST24h=$deb_ROB_24h['sum(td.sac)'];
     }
     if(empty($deb_ROB_24h['sum(td.sac)'])){

       $sac_ST24h=0;
     }

     if(!empty($deb_ROB['sum(pb.poids_net)'])){

       $net_marchand_STT=$deb_ROB['sum(pb.poids_net)'];
     }
     if(empty($deb_ROB['sum(pb.poids_net)'])){

       $net_marchand_STT=0;
     }

    if(!empty($deb_ROB['sum(td.sac)'])){

       $sac_STT=$deb_ROB['sum(td.sac)'];
     }
     if(empty($deb_ROB['sum(td.sac)'])){

       $sac_STT=0;
     }

    if(!empty($deb_G24H['sum(td.sac)'])){

       $sac_G24h=$deb_G24H['sum(td.sac)'];
     }
     if(empty($deb_G24H['sum(td.sac)'])){

       $sac_G24h=0;
     }
          if(!empty($deb_G24H['sum(pb.poids_net)'])){

       $poids_net_G24h=$deb_G24H['sum(pb.poids_net)'];
     }
     if(empty($deb_G24H['sum(pb.poids_net)'])){

       $poids_net_G24h=0;
     }


    if(!empty($deb_GT['sum(td.sac)'])){

       $sac_GT=$deb_GT['sum(td.sac)'];
     }
     if(empty($deb_GT['sum(td.sac)'])){

       $sac_GT=0;
     }
          if(!empty($deb_GT['sum(pb.poids_net)'])){

       $poids_net_GT=$deb_GT['sum(pb.poids_net)'];
     }
     if(empty($deb_GT['sum(pb.poids_net)'])){

       $poids_net_GT=0;
     }

     $net_marchand_ROB=$manif['sum(poids)']-$deb_ROB['sum(pb.poids_net)'];

          ?>
          <?php if(!empty($row['cales']) and !empty($row['produit']) and !empty($row['poids_sac']) ){ 
                  
                 
                   $somme_net_marchand_TOT = 0;




            ?>
         <tr class="cellule">
          <?php if($nom_cale!=$row['cales']){
                    $row_cale=0;
                    $nom_cale=$row['cales'];
                   
                    foreach ($cales as $r ) {
                      if($r['cales']===$nom_cale and !empty($r['produit'])){
                        $row_cale++;
                      # code...
                    }
                  } ?>
          <td rowspan="<?php echo /*$row_cale-$soustraction;*/$rows_deb['nombre_de_lignes']; ?>"><?php echo $row['cales']; ?>  </td>
         <?php } ?>

         <td ><?php echo $row['produit']; ?>  </td>

    <?php if($manifeste_cale!=$row['cales']){
                    $row_manifest=0;
                    $manifeste_cale=$row['cales'];
                   
                    foreach ($cales as $r ) {
                      if($r['cales']===$manifeste_cale and !empty($r['produit'])){
                        $row_manifest++;
                      # code...
                    }
                  } ?>
          <td  rowspan="<?php echo /*$row_manifest-$soustraction+1;*/ $rows_deb['nombre_de_lignes']+1; ?>" <?php echo filtrage_rob($proprietaire); ?>><?php echo number_format($manif['sum(poids)'], 3,',',' '); ?><?php echo /*$row_manifest-$soustraction+1;*/ $rows_deb['nombre_de_lignes']+1; ?> </td>
         <?php } ?>
         
         <?php

 

          $deb_cale_24H=deb_cale_24H($bdd,$navire,$id_produit,$poids_sac,$date_deb,$cale_deb);
          $deb_cale_TOT=deb_cale_TOT($bdd,$navire,$id_produit,$poids_sac,$date_deb,$cale_deb);

          $my_tare=tare_sac($bdd,$id_produit,$poids_sac,$navire);
          while($deb_24h=$deb_cale_24H->fetch()){ 
            $tare=$my_tare->fetch();
            $deb_TOT=$deb_cale_TOT->fetch();


       /*     if(empty($deb_24h['sum(poids_brut)'])){
              $net_pont_bascule=0;
            }
              if(empty($deb_24h['sum(sac)'])){
              $som_sac_24h=0;
            }
              if(!empty($deb_24h['sum(sac)'])){
              $som_sac_24h=$deb_24h['sum(sac)'];
            } */

             /*           if(empty($deb_TOT['sum(poids_brut)'])){
              $net_pont_bascule_TOT=0;
            }
              if(empty($deb_TOT['sum(sac)'])){
              $som_sac_TOT=0;
            }
              if(!empty($deb_TOT['sum(sac)'])){
              $som_sac_TOT=$deb_TOT['sum(sac)'];
            } */

                        if(empty($deb_ROB['sum(poids_brut)'])){
              $net_pont_bascule_ROB=0;
            }
              if(empty($deb_ROB['sum(sac)'])){
              $som_sac_ROB=0;
            }
              if(!empty($deb_ROB['sum(sac)'])){
              $som_sac_ROB=$deb_ROB['sum(sac)'];
            }

          $net_marchand=  $deb_24h['sum(pb.poids_net)'];
          $sac_24h=  $deb_24h['sum(td.sac)'];

          $net_marchand_TOT=  $deb_TOT['sum(pb.poids_net)'];
          $sac_TOT=  $deb_TOT['sum(td.sac)'];
/*
     $net_pont_bascule=$deb_24h['sum(poids_brut)']-$deb_24h['sum(tare_vehicule)'];
     $net_marchand=$net_pont_bascule-$deb_24h['sum(sac)']*$tare['poids_tare_sac']/1000; */
 
  

        

     $somme_net_marchand_TOT += $net_marchand_TOT;
     





     
     

                  

            ?>
             <td><?php echo number_format($sac_24h, 0,',',' '); ?></td>
            <td><?php echo number_format($net_marchand, 3,',',' '); ?> </td>
            <td><?php echo number_format($sac_TOT, 0,',',' '); ?></td>
            <td ><?php echo number_format($net_marchand_TOT, 3,',',' '); ?> </td>
          <?php } ?>

              <?php if($rob_cale!=$row['cales']){
                    $row_rob=0;
                    $rob_cale=$row['cales'];
                   
                    foreach ($cales as $r ) {
                      if($r['cales']===$rob_cale and !empty($r['produit'])){
                        $row_rob++;
                        

                         
                      # code...
                    }
                  } ?>
          <td <?php echo filtrage_rob($proprietaire); ?> rowspan="<?php /*echo $row_rob-$soustraction+1*/ echo $rows_deb['nombre_de_lignes']+1; ?>"><?php echo number_format($net_marchand_ROB, 3,',',' '); ?> </td>
         <?php } ?>
          </tr> 
 <?php } 


 ?>

 <?php if(!empty($row['cales']) and empty($row['produit']) and empty($row['poids_sac']) ){ ?>
         <tr class="cellule_st">
          <td colspan="2"> TOTAL <?php echo $row['cales']; ?>  </td>
          <td ><?php echo $sac_ST24h; ?></td>
          <td ><?php echo $net_marchand_ST24h; ?></td>
          <td ><?php echo $sac_STT; ?></td>
          <td ><?php echo $net_marchand_STT; ?></td>
          </tr> 
 <?php } ?>

 <?php if(empty($row['cales']) and empty($row['produit']) and empty($row['poids_sac']) ){ 
     $manifeste_TOTAL=manifeste_TOTAL($bdd,$navire);
     $manif_T=$manifeste_TOTAL->fetch();  ?>
  <tr style="background: black; color: white; text-align: center;">  
  <td colspan="2"> TOTAL </td>
  <td <?php echo filtrage_rob($proprietaire); ?>> <?php echo number_format($manif_T['sum(poids)'], 3,',',' '); ?> </td>
  <td > <?php echo number_format($sac_G24h, 0,',',' '); ?> </td>
  <td > <?php echo number_format($poids_net_G24h, 3,',',' '); ?> </td>
    <td > <?php echo number_format($sac_GT, 0,',',' '); ?> </td>
  <td > <?php echo number_format($poids_net_GT, 3,',',' '); ?> </td>
  <td <?php echo filtrage_rob($proprietaire); ?> > <?php echo number_format($manif_T['sum(poids)'], 3,',',' '); ?> </td>
  </tr>
<?php } ?>

 

         <?php  } //end foreach ?>


        </tbody>
       </table>
      </div>    
<br><br>

<div class="table-responsive" style="background: white;" >
  <h6>NAVIRE <?php echo $navire ?> <?php echo $soustraction; ?></h6>
 <h6>SITUATION DU DEBARQUEMENT PAR PRODUIT DU <?php echo $_POST['idDate']; ?> </h6>        

 <table class='table table-hover table-bordered ' id='table' >";
    

<thead>
          
  
 <tr class="EnteteTableSituation" style="font-size: 12px;" >
      

      <td id="colLibeles" scope="col"  rowspan="2"  >PRODUIT</td>
      <td id="colLibeles" scope="col"  rowspan="2"  >CALES</td>
      <td id="colManifeste"  >MANIFESTE</td> 
      <td scope="col"  id="colDeb24H" colspan="2" >DEB 24H</td>
      <td scope="col"  id="colDebTOTAL"  colspan="2"> TOTAL DEB</td>
      <td scope="col"  id="colDebTOTAL"  > ROB</td>
   <!--   <td scope="col"  id="colROB">ROB</td> !-->
  </tr>
    <tr class="EnteteTableSituation"  >
      
     
      <td id="colManifeste">POIDS</td> 
        <td scope="col" id="colDeb24H" >SACS</td>
      <td scope="col" id="colDeb24H" >POIDS</td>
              <td scope="col" id="colDeb24H" >SACS</td>
      <td scope="col" id="colDeb24H" >POIDS</td>
              
      <td scope="col" id="colDeb24H" >POIDS</td>
        
     
    <!--  <td scope="col" id="colROB" >POIDS</td> !-->
        
     
     
 
         </tr>
         </thead> 
         <tbody>
