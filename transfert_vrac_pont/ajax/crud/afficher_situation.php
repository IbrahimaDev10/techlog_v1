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

      $my_navire=navire($bdd,$navire);

      $my_nav=$my_navire->fetch();

       $dateObj = date_create_from_format('Y-m-d', $date_deb);
                $date_converti = $dateObj->format('d-m-Y');

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
        .titre{
          color:red;
          font-weight: bold;
        }

       </style>
<br>
<div class="table-responsive" style="background: white;" >
  <center>
  <h6>SITUATION DU DEBARQUEMENT PAR CALE DU <span class="titre"><?php echo $date_converti; ?></span>  </h6>    
  <h6>NAVIRE: <span class="titre"><?php echo $my_nav['navire']; ?></span>  </h6>
    </center> 

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
          <?php //if(!empty($row['cales']) and !empty($row['produit']) and !empty($row['poids_sac']) or $row['poids_sac']!='NULL')
          if(!empty($row['cales']) AND !empty($row['produit']) and $row['poids_sac']!=''){ 
                  
                 
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
          <td rowspan="<?php echo $rows_deb['nombre_de_lignes']; ?>"><?php echo $row['cales']; ?>  </td>
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
          <td  rowspan="<?php echo /*$row_manifest-$soustraction+1;*/ $rows_deb['nombre_de_lignes']+1; ?>" <?php echo filtrage_rob($proprietaire); ?> ><?php echo number_format($manif['sum(poids)'], 3,',',' '); ?><?php echo /*$row_manifest-$soustraction+1;*/ $rows_deb['nombre_de_lignes']+1; ?> </td>
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

 <?php  if(!empty($row['cales']) AND empty($row['produit']) and $row['poids_sac']==''){  ?>
         <tr class="cellule_st">
          <td colspan="2"> TOTAL <?php echo $row['cales']; ?>  </td>
          <td ><?php echo number_format($sac_ST24h, 0,',',' '); ?></td>
          <td ><?php echo number_format($net_marchand_ST24h, 3,',',' ');; ?></td>
          <td ><?php echo number_format($sac_STT, 0,',',' ');; ?></td>
          <td ><?php echo number_format($net_marchand_STT, 3,',',' ');; ?></td>
          </tr> 
 <?php } ?>

 <?php  if(empty($row['cales']) AND empty($row['produit']) and $row['poids_sac']==''){ 
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

<div class="table-responsive" style="background: white; border-radius: 15px;" >
   <center>
  <h6>SITUATION DU DEBARQUEMENT PAR PRODUIT DU <span class="titre"><?php echo $date_converti; ?></span>  </h6>    
  <h6>NAVIRE: <span class="titre"><?php echo $my_nav['navire']; ?></span>  </h6>
    </center>       

 <table class='table table-hover table-bordered ' id='table' >";
    

<thead>
          
  
 <tr class="EnteteTableSituation" style="font-size: 12px;" >
      

      <td id="colLibeles" scope="col"  rowspan="2"  >PRODUIT</td>
      <td id="colManifeste"  >MANIFESTE</td>
      <td id="colLibeles" scope="col"  rowspan="2"  >CALES</td>
       
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

    <?php    
           $nom_produit='NULL';
           $val_poids_sac='NULL';
           $rowp=0;

           $rob_produit='NULL';
           $val_poids_sac_rob='NULL';
           $rowrob=0;

       $produit=produit($bdd,$navire); 
        
         $produits=$produit->fetchAll(PDO::FETCH_ASSOC);
         foreach($produits as $row){
          $id_produit=$row['id_produit'];
          $poids_sac=$row['poids_sac'];
          $cale_deb=$row['id_dec'];

              $rowspan_deb_produit=rowspan_deb_produit($bdd,$navire,$id_produit,$poids_sac);
              $rows_deb_prod=$rowspan_deb_produit->fetch();

             $manifeste_produit= manifeste_produit($bdd,$navire,$id_produit,$poids_sac);
             $manif_prod=$manifeste_produit->fetch();




               if(!empty($row['produit']) and  $row['poids_sac']!='' and !empty($row['cales']) and !empty($row['id_dec'])){

                ?>
                <tr style="text-align: center; vertical-align: middle;">
                  <?php if($nom_produit!=$row['produit'] or $val_poids_sac!=$row['poids_sac']){
                    $nom_produit=$row['produit'];
                    $val_poids_sac=$row['poids_sac'];
                   
                    foreach ($produits as $r ) {
                      if($r['produit']===$nom_produit and !empty($r['produit']) and $r['poids_sac']===$val_poids_sac){
                        $rowp++;
                      # code...
                    }
                  } ?>
          <td rowspan="<?php echo $rows_deb_prod['nombre_de_lignes']; ?>"><?php echo $row['produit']; ?> <?php if($row['poids_sac']!=0){ echo $row['poids_sac'].' KG';} ?> </td>
          <td rowspan="<?php echo $rows_deb_prod['nombre_de_lignes']; ?>"><?php echo number_format($manif_prod['sum(dis.quantite_poids)'],3,',',' ')  ?>  </td>
         <?php } ?>
         <td><?php echo $row['cales'] ?></td>

         <?php $deb_produit_24H=deb_produit_24H($bdd,$navire,$id_produit,$poids_sac,$date_deb,$cale_deb);
               $deb_produit_TOT=deb_produit_TOT($bdd,$navire,$id_produit,$poids_sac,$date_deb,$cale_deb);
               while($deb_prod_24h=$deb_produit_24H->fetch()){ 
                     $deb_prod_TOT=$deb_produit_TOT->fetch();

                     $net_marchand=  $deb_prod_24h['sum(pb.poids_net)'];
                     $sac_24h=  $deb_prod_24h['sum(td.sac)'];

                     $net_marchand_TOT=  $deb_prod_TOT['sum(pb.poids_net)'];
                     $sac_24h_TOT=  $deb_prod_TOT['sum(td.sac)'];

                 //ICI ON UTILISE LA REQUETE SOUS TOTALE DU POIDS POUR LE SOUSTRAIRE AU POIDS NET TOTALE AFIN D'avoir le rob
                     $deb_produit_ST_TOT=deb_produit_ST_TOT($bdd,$navire,$id_produit,$poids_sac,$date_deb);
                     $deb_prod_ST_TOT_ROB=$deb_produit_ST_TOT->fetch();

                    $net_marchand_TOTS=  $deb_prod_ST_TOT_ROB['sum(pb.poids_net)'];

                     //rob
                     $rob_net=$manif_prod['sum(dis.quantite_poids)']-$net_marchand_TOTS;


                ?>
                <td><?php echo number_format($sac_24h,0,',',' ') ?></td>
                <td><?php echo number_format($net_marchand,3,',',' ') ?></td>
                <td><?php echo number_format($sac_24h_TOT,0,',',' ') ?></td>
                <td><?php echo number_format($net_marchand_TOT,3,',',' ') ?></td>
              
               
              
             

             <?php // colonne rob 
             if($rob_produit!=$row['produit'] or $val_poids_sac_rob!=$row['poids_sac']){
                    $rob_produit=$row['produit'];
                    $val_poids_sac_rob=$row['poids_sac'];
                   
                    foreach ($produits as $r ) {
                      if($r['produit']===$rob_produit and !empty($r['produit']) and $r['poids_sac']===$val_poids_sac_rob){
                        $rowrob++;
                      # code...
                    }
                  } ?>
          <td rowspan="<?php echo $rows_deb_prod['nombre_de_lignes']; ?>"> <?php echo number_format($rob_net,3,',',' '); ?> </td>
        
         <?php } ?>
       </tr>
       <?php } ?>

       <?php } ?>
        <?php  if(!empty($row['produit'])  and $row['poids_sac']!='' AND empty($row['cales']) AND empty($row['id_dec'])){  ?>
         <tr class="cellule_st">
          <td colspan="3"> TOTAL <?php echo $row['produit']; ?> <?php if($row['poids_sac']!=0){ echo $row['poids_sac'].' KG';} ?> </td>
           

           <?php  
           $deb_produit_ST_24H=deb_produit_ST_24H($bdd,$navire,$id_produit,$poids_sac,$date_deb);
               $deb_produit_ST_TOT=deb_produit_ST_TOT($bdd,$navire,$id_produit,$poids_sac,$date_deb);
               while($deb_prod_ST_24h=$deb_produit_ST_24H->fetch()){ 
                     $deb_prod_ST_TOT=$deb_produit_ST_TOT->fetch();

                     $net_marchand=  $deb_prod_ST_24h['sum(pb.poids_net)'];
                     $sac_24h=  $deb_prod_ST_24h['sum(td.sac)'];

                     $net_marchand_TOT=  $deb_prod_ST_TOT['sum(pb.poids_net)'];
                     $sac_24h_TOT=  $deb_prod_ST_TOT['sum(td.sac)'];

                     //rob
                     


                ?>
                <td><?php echo number_format($sac_24h,0,',',' ') ?></td>
                <td><?php echo number_format($net_marchand,3,',',' ') ?></td>
                <td><?php echo number_format($sac_24h_TOT,0,',',' ') ?></td>
                <td><?php echo number_format($net_marchand_TOT,3,',',' ') ?></td>
                <td></td>
              <?php } ?>
          

        <?php } ?>


                <?php  if(empty($row['produit'])  and $row['poids_sac']=='' AND empty($row['cales']) AND empty($row['id_dec'])){  ?>
         <tr style="background: black; color: white; text-align: center;">
          <td > TOTAL   </td>
          

           <?php  
           $deb_produit_GEN_24H=deb_produit_GEN_24H($bdd,$navire,$date_deb);
               $deb_produit_GEN_TOT=deb_produit_GEN_TOT($bdd,$navire,$date_deb);
               while($deb_prod_GEN_24H=$deb_produit_GEN_24H->fetch()){ 
                     $deb_prod_GEN_TOT=$deb_produit_GEN_TOT->fetch();

                   $manifeste_produit_TOT=  manifeste_produit_TOT($bdd,$navire);

                   $manifeste_TOT=$manifeste_produit_TOT->fetch();

                     $net_marchand=  $deb_prod_GEN_24H['sum(pb.poids_net)'];
                     $sac_24h=  $deb_prod_GEN_24H['sum(td.sac)'];

                     $net_marchand_TOT=  $deb_prod_GEN_TOT['sum(pb.poids_net)'];
                     $sac_24h_TOT=  $deb_prod_GEN_TOT['sum(td.sac)'];

                     $rob_net=$manifeste_TOT['sum(dis.quantite_poids)']-$net_marchand_TOT;

                     //rob
                     


                ?>
                <td> <?php echo number_format($manifeste_TOT['sum(dis.quantite_poids)'],3,',',' '); ?></td>
                <td> </td>
                <td><?php echo number_format($sac_24h,0,',',' ') ?></td>
                <td><?php echo number_format($net_marchand,3,',',' ') ?></td>
                <td><?php echo number_format($sac_24h_TOT,0,',',' ') ?></td>
                <td><?php echo number_format($net_marchand_TOT,3,',',' ') ?></td>
                 <td > <?php echo number_format($rob_net,3,',',' '); ?> </td>
              <?php } ?>
          

        <?php } ?>

       <?php  
              } //fermeture foreach debut   ?> 


         </tbody>
        </table>
       </div>  

<br><br>
<div class="table-responsive" style="background: white; border-radius: 15px;" >
   <center>
  <h6>SITUATION DU DEBARQUEMENT PAR DESTINATION DU <span class="titre"><?php echo $date_converti; ?></span>  </h6>    
  <h6>NAVIRE: <span class="titre"><?php echo $my_nav['navire']; ?></span>  </h6>
    </center>        

 <table class='table table-hover table-bordered ' id='table' >";
    

<thead>
          
  
 <tr class="EnteteTableSituation" style="font-size: 12px;" >
      

      <td id="colLibeles" scope="col"  rowspan="2"  >DESTINATION</td>
      <td id="colManifeste"  >MANIFESTE</td>
       <td id="colLibeles" scope="col"  rowspan="2"  >PRODUIT</td>
      
       
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

            <?php    
           $nom_destination='NULL';
          // $val_poids_sac='NULL';
           $row_destination=0;

           $nom_destination_rob='NULL';
          // $val_poids_sac='NULL';
           $row_destination_rob=0;

         /*  $rob_produit='NULL';
           $val_poids_sac_rob='NULL';
           $rowrob=0; */

       $destination=destination($bdd,$navire); 
        
         $destinations=$destination->fetchAll(PDO::FETCH_ASSOC);
         foreach($destinations as $row){
          $id_produit=$row['id_produit'];
          $poids_sac=$row['poids_sac'];
          $destination_deb=$row['id_mangasin'];

             if(!empty($row['id_mangasin']) AND !empty($row['produit']) and $row['poids_sac']!=''){ 
                  
             $manifeste_destination=manifeste_destination($bdd,$navire,$destination_deb);
             $manif_des=$manifeste_destination->fetch();    
                

                  $deb_destination_ST_TOT=deb_destination_ST_TOT($bdd,$navire,$date_deb,$destination_deb);
                     $deb_des_ST_TOT_ROB=$deb_destination_ST_TOT->fetch();

                     $net_marchand_TOT=  $deb_des_ST_TOT_ROB['sum(pb.poids_net)'];

                     //rob
                     $rob_net=$manif_des['sum(dis.quantite_poids)']-$net_marchand_TOT;     




            ?>
         <tr class="cellule">

          <?php if($nom_destination!=$row['mangasin']){
                    $row_destination=0;
                    $nom_destination=$row['mangasin'];
                   
                    foreach ($destinations as $r ) {
                      if($r['mangasin']===$nom_destination and !empty($r['produit']) and $r['poids_sac']!='' ){
                        $row_destination++;
                      # code...
                    }
                  } ?>
          <td rowspan="<?php echo $row_destination; ?>"><?php echo $row['mangasin']; ?>  </td>
          <td rowspan="<?php echo $row_destination; ?>"><?php echo number_format($manif_des['sum(dis.quantite_poids)'],3,',',' ') ?>  </td>
         <?php } ?>
         
         <td><?php echo $row['produit']; ?></td>
         <?php 
         $deb_destination_24H=deb_destination_24H($bdd,$navire,$id_produit,$poids_sac,$date_deb,$destination_deb);
               $deb_destination_TOT=deb_destination_TOT($bdd,$navire,$id_produit,$poids_sac,$date_deb,$destination_deb);

               $deb_destination_ST_TOT=deb_destination_ST_TOT($bdd,$navire,$date_deb,$destination_deb);

               while($deb_des_24h=$deb_destination_24H->fetch()){ 
                    $deb_des_TOT=$deb_destination_TOT->fetch();



                     $net_marchand=  $deb_des_24h['sum(pb.poids_net)'];
                     $sac_24h=  $deb_des_24h['sum(td.sac)'];

                     $net_marchand_TOT=  $deb_des_TOT['sum(pb.poids_net)'];
                     $sac_24h_TOT=  $deb_des_TOT['sum(td.sac)']; ?>

                <td><?php echo number_format($sac_24h,0,',',' ') ?></td>
                <td><?php echo number_format($net_marchand,3,',',' ') ?></td>
                <td><?php echo number_format($sac_24h_TOT,0,',',' ') ?></td>
                <td><?php echo number_format($net_marchand_TOT,3,',',' ') ?></td>
                
                <?php if($nom_destination_rob!=$row['mangasin']){
                    $row_destination_rob=0;
                    $nom_destination_rob=$row['mangasin'];
                   
                    foreach ($destinations as $r ) {
                      if($r['mangasin']===$nom_destination_rob and !empty($r['produit']) and $r['poids_sac']!='' ){
                        $row_destination_rob++;
                      # code...
                    }
                  } ?>
          
          <td rowspan="<?php echo $row_destination_rob; ?>"><?php echo number_format($rob_net,3,',',' ') ?>  </td>
         <?php } ?>

              <?php } ?>
             
</tr>
       <?php } //endif empty?> 

       <?php  if(!empty($row['id_mangasin'])  and $row['poids_sac']=='' AND empty($row['produit']) ){  ?>
         <tr class="cellule_st">
          <td > TOTAL <?php echo $row['mangasin']; ?>  </td>
          <td></td>
          <td></td>

         <?php  
           $deb_destination_ST_24H=deb_destination_ST_24H($bdd,$navire,$date_deb,$destination_deb);
               $deb_destination_ST_TOT=deb_destination_ST_TOT($bdd,$navire,$date_deb,$destination_deb);
               while($deb_des_ST_24h=$deb_destination_ST_24H->fetch()){ 
                     $deb_des_ST_TOT=$deb_destination_ST_TOT->fetch();

                     $net_marchand=  $deb_des_ST_24h['sum(pb.poids_net)'];
                     $sac_24h=  $deb_des_ST_24h['sum(td.sac)'];

                     $net_marchand_TOT=  $deb_des_ST_TOT['sum(pb.poids_net)'];
                     $sac_24h_TOT=  $deb_des_ST_TOT['sum(td.sac)'];

                     //rob
                     


                ?>
                <td><?php echo number_format($sac_24h,0,',',' ') ?></td>
                <td><?php echo number_format($net_marchand,3,',',' ') ?></td>
                <td><?php echo number_format($sac_24h_TOT,0,',',' ') ?></td>
                <td><?php echo number_format($net_marchand_TOT,3,',',' ') ?></td>
                <td></td>
              <?php } ?>  

        <?php } //endif ?>
         <?php  if(empty($row['id_mangasin'])  and $row['poids_sac']=='' AND empty($row['produit']) ){  ?>
         <tr style="background: black; color: white; text-align: center;">
          <td > TOTAL   </td>
          <td></td>
          <td></td>
     <?php  
           $deb_destination_GEN_24H=deb_produit_GEN_24H($bdd,$navire,$date_deb);
               $deb_destination_GEN_TOT=deb_produit_GEN_TOT($bdd,$navire,$date_deb);
               while($deb_des_GEN_24H=$deb_destination_GEN_24H->fetch()){ 
                     $deb_des_GEN_TOT=$deb_destination_GEN_TOT->fetch();

                  // $manifeste_produit_TOT=  manifeste_produit_TOT($bdd,$navire);

                  // $manifeste_TOT=$manifeste_produit_TOT->fetch();

                     $net_marchand=  $deb_des_GEN_24H['sum(pb.poids_net)'];
                     $sac_24h=  $deb_des_GEN_24H['sum(td.sac)'];

                     $net_marchand_TOT=  $deb_des_GEN_TOT['sum(pb.poids_net)'];
                     $sac_24h_TOT=  $deb_des_GEN_TOT['sum(td.sac)'];

                  //   $rob_net=$manifeste_TOT['sum(dis.quantite_poids)']-$net_marchand_TOT;

                     //rob ?>
                     


                ?>

                <td><?php echo number_format($sac_24h,0,',',' ') ?></td>
                <td><?php echo number_format($net_marchand,3,',',' ') ?></td>
                <td><?php echo number_format($sac_24h_TOT,0,',',' ') ?></td>
                <td><?php echo number_format($net_marchand_TOT,3,',',' ') ?></td>
                <td></td>
                 
              <?php } ?>

        <?php } //endif ?>


       
     <?php } //endforeach ?>
</tbody>
</table>
</div>


        