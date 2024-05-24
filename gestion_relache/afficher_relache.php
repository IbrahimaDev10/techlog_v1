<?php require('../database.php'); 
      require('controller/afficher_navire.php');

$navire=$_POST['id_navire'];


?>
 
<div class="container-fluid" id="partransit2" >
<?php 
    $mes_relaches=$bdd->prepare("SELECT  dis.*, p.produit,p.qualite, mg.mangasin, cli.client,nc.*,nr.*,nr.id_relache as idrel,nav.navire,b.* /* , sum(s.poids_liv), sum(mo.poids_mo), sum(bal.poids_bal) */   from dispat as dis
     
     
      left join numero_relache as nr on dis.id_dis=nr.id_dis_relache  
    /*  left join livraison_sain as s on s.relache_liv=nr.id_relache
      left join livraison_mouille as mo on mo.relache_mo=nr.id_relache
      left join livraison_balayure as bal on bal.relache_bal=nr.id_relache */
    
      
      inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis

      inner join produit_deb as p on p.id=dis.id_produit 
       LEFT join mangasin as mg on dis.id_mangasin=mg.id
      
      inner join client as cli on cli.id=dis.id_client
      inner join navire_deb as nav on nav.id=nc.id_navire
      inner join banque as b on b.id=nc.id_banque

    
    
      WHERE nc.id_navire=? and nr.status=0  order by nc.num_connaissement,mg.mangasin");
      $mes_relaches->bindParam(1,$navire);
      
      $mes_relaches->execute();
     $nomb= $mes_relaches->fetchAll(PDO::FETCH_ASSOC);

    
    
     //$nombre=$nombre_dec->fetch();
 
  



     
     ?>
              <center>
             
              </center>


            <div class="table-responsive" border=1> 
             <table class='table table-responsive table-hover table-bordered table-striped' id="fetch_cargo_plan" border='5' style="border-color: black; " >
            
          <thead>  
          	<?php $navire2=afficher_navire2($bdd,$navire); 
          	if($nav=$navire2->fetch()){
          	 ?>
          	
 
   <td style="text-align: center; background-image: linear-gradient(-45deg, #004362, #0183d0); !important; color:white;" colspan="13"> <h6 class="hdeclaration text-white" style="font-size: 14px;" >SITUATION DES RELACHES ( <br><?php echo $nav['navire']; ?></h6></td> <?php } ?> 
  
          
 <tr style="color:white; font-weight: bold; background-image: linear-gradient(-45deg, #004362, #0183d0); !important;  border-color: white; text-align: center; font-size: 12px; vertical-align: middle; font-size: 12px;" border='5' >                              <th   scope="col" >NAVIRE </th>
                                 <th   scope="col" >BL N° </th>
                                <th  scope="col" >PRODUIT </th>
                                <th  scope="col" >MANIFESTE </th>
                                
                             
                                 <td   scope="col" >ENTREPÔTS </td>
                             
 
                              
                             
                                
                                 <th   >STOCK DEPART </th>
                                <th >N° ET DATE RELACHE </th>
                                
                                <th scope="col" >BANQUE </th>
                               <th  scope="col" >QUANTITE RELACHE </th>
                              
                               <th scope="col" >BALANCE </th>
                                <th scope="col" >N° DEPASSEMENT </th>
                                <th scope="col" >QUANTITE DEPASSES </th>

                               <!--   <th  scope="col" >LIVRAISON</th>

                                   <th   scope="col" >RESTE A LIVREV SUR RELACHE</th>
                                   <th    scope="col" >DISPONIBILITE</th> !-->
                                 


                             </tr>
                              </thead>
                               <tbody style="font-weight: bold; font-size: 12px;">
                                 
    <?php
            $num_connaissement='NULL';
            $rowspanConnaissement = 0;
            $num_connaissementDepasse='NULL';
            $rowspanConnaissementDepasse= 0;
            $produit='NULL';
            $poids=60;
            $num_con_produit='NULL';
            $rowspanProduit=0;
            $manifest='NULL';
            $num_con='NULL';
            $rowspanManifest=0;
            $stock_dep='NULL';
           
            $rowspanManifest=0;
            $num_dec2='NULL';
            $rowspanStock_dep = 0;
            $client='NULL';
            $rowspanClient=0;
            $bl='NULL';
            $rowspanBl=0;
            $num_dec3='NULL';
            $reste_declarer=0;
            $rowspanDestination3 = 0;
              $num_dec4='NULL';
        
            $rowspanDestination4 = 0;
            $num_con_destination='NULL';
            $num_dec5='NULL';
            $num_connaissement5='NULL';
            $rowspanDestination5 = 0;
            $num_dec6='NULL';
            $rowspanDestination6 = 0;
                        $num_dec7='NULL';
            $rowspanDestination7 = 0;
            $num_dec_sortie='NULL';
            $rowspanDestinationSortie = 0;
            $num_dec_sortie2='NULL';
            $rowspanDestinationSortie2 = 0;
            $num_dec_sortie3='NULL';
            $c3='NULL';
            $rowspanDestinationSortie3 = 0;
            $num_dec_sortie4='NULL';
            $rowspanDestinationSortie4 = 0;
            $num_dec_sortie5='NULL';
            $rowspanDestinationSortie5 = 0;
            $num_dec_sortie6='NULL';
            $rowspanDestinationSortie6 = 0;
            $rowspanVides=0;

            $numero_relache='NULL';
            $mangasin_receve_relache='NULL';
            $meme_relache='NULL';
             
                         $numero_relacheD='NULL';
            $mangasin_receve_relacheD='NULL';
           $rowspanRelacheD=0;
            

            $numero_relache_mang='NULL';
            $numero_relache_con='NULL';
            $rowspanRelache=0;
            $rowspanRelache2=0;
            $banque='NULL';
            $rowspanBanque=0;
            $num_con_banque;

            $num_navire='NULL';
            $rowspanNavire=0;
            $rembourser='NULL';
            $rowspanRembourser=0;
            $num_con_balance='NULL';

            $numero_relacheD='NULL';
            
            $numero_relacheQD='NULL';
            $rowspanRelacheQD=0;
     foreach ($nomb as $row) { 

  //    $quantite_depasse=$row['sum(s.poids_liv)']+$row['sum(mo.poids_mo)']+$row['sum(bal.poids_bal)'];

      $manifeste=$bdd->prepare("SELECT  dis.*,sum(dis.quantite_poids),nc.*  from dispat as dis
      
      
      inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis

   
    
      WHERE nc.id_navire=? and nc.id_connaissement=? order by nc.num_connaissement ");
     $manifeste->bindParam(1,$navire);
     $manifeste->bindParam(2,$row['id_connaissement']);
      $manifeste->execute();
      $manife=$manifeste->fetch();

       $quantite_relacher=$bdd->prepare("SELECT  dis.*,sum(nr.quantite),nc.*  from dispat as dis
      
      
      inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
      inner join numero_relache as nr on nr.id_connaissement=nc.id_connaissement

   
    
      WHERE nc.id_navire=? and nc.id_connaissement=? order by nc.num_connaissement ");
     $quantite_relacher->bindParam(1,$navire);
     $quantite_relacher->bindParam(2,$row['id_connaissement']);
      $quantite_relacher->execute();
      $qr=$quantite_relacher->fetch();


      ?>
     <tr style="background: white; vertical-align: middle; text-align: center;">

       <?php    
    // Colonne Destination
    if ($num_navire!= $row['navire'] )  {
      // $rowspanNavire = 0; // Réinitialisation du rowspan pour la nouvelle destination
        $num_navire = $row['navire'];
        foreach ($nomb as $r) {
            if ($r['navire']===$row['navire']) {
              //ici on compte le nombre de destination
                $rowspanNavire++;
           }
        }
        // Colonne Destination
?>
        <td style="vertical-align: middle;" rowspan='<?php echo $rowspanNavire; ?>'><?php echo $row['navire']; ?> </td>
     
         
         

      <?php   } ?> 
   
     <?php    
    // Colonne Destination
    if ($num_connaissement!= $row['num_connaissement'] )  {
        $rowspanConnaissement = 0; // Réinitialisation du rowspan pour la nouvelle destination
        $num_connaissement = $row['num_connaissement'];
        foreach ($nomb as $r) {
            if ($r['num_connaissement'] === $num_connaissement) {
              //ici on compte le nombre de destination
                $rowspanConnaissement++;
            }
        }
        // Colonne Destination
?>
        
         <td style="vertical-align: middle;" rowspan='<?php echo $rowspanConnaissement; ?>'><?php echo $row['num_connaissement']; ?>
         </td>
         
         

      <?php   } ?>

        <?php    
    // Colonne Destination
    if ($produit!= $row['id_produit'] or $poids!=$row['poids_kg'] or $num_con_produit!=$row['num_connaissement']  )  {
        $rowspanProduit = 0; // Réinitialisation du rowspan pour la nouvelle destination
        $produit = $row['id_produit'];
        $poids = $row['poids_kg'];
        $num_con_produit=$row['num_connaissement'];
        
        foreach ($nomb as $r) {
            if ($r['id_produit'] === $produit and $r['poids_kg']===$poids and $r['num_connaissement']===$num_con_produit ) {
              //ici on compte le nombre de destination
                $rowspanProduit++;
            }
        }
        // Colonne Destination
?>
     
         <td rowspan='<?php echo $rowspanProduit; ?>' > <?php  echo $row['produit'].' '.$row['qualite'].' '.$row['poids_kg'].' kg'; ?> <?php echo $rowspanProduit; ?> </td>
         

      <?php   } ?>
   <?php    
    // Colonne Destination
    if ($manifest!= $row['num_connaissement'] )  {
        $rowspanManifest = 0; // Réinitialisation du rowspan pour la nouvelle destination
        $manifest = $row['num_connaissement'];
       
        foreach ($nomb as $r) {
            if ($r['num_connaissement'] === $manifest ) {
              //ici on compte le nombre de destination
                $rowspanManifest++;
            }
        }
        // Colonne Destination
?>
     
         <td rowspan='<?php echo $rowspanManifest; ?>' ><?php  echo $manife['sum(dis.quantite_poids)'] ; ?>  </td>
         

      <?php   } ?>

         <?php    
    // Colonne Destination
    if ($num_dec4!= $row['mangasin'] or $num_con_destination!=$row['num_connaissement'])  {
        $rowspanDestination4 = 0; // Réinitialisation du rowspan pour la nouvelle destination
        $num_dec4 = $row['mangasin'];
        $num_con_destination=$row['num_connaissement'];
        foreach ($nomb as $r) {
            if ($r['mangasin'] === $num_dec4 and !empty($row['mangasin']) and $r['num_connaissement']===$num_con_destination) {
              //ici on compte le nombre de destination
                $rowspanDestination4++;
            }
        }
        // Colonne Destination
?>

     
       <td rowspan="<?php echo $rowspanDestination4; ?>"  > <?php echo $row['mangasin']; ?>  </td>
      <?php   } ?>

       <?php    
    // Colonne Destination
    if ($stock_dep!= $row['num_connaissement'] )  {
        $rowspanStock_dep = 0; // Réinitialisation du rowspan pour la nouvelle destination
        $stock_dep = $row['num_connaissement'];
       
        foreach ($nomb as $r) {
            if ($r['num_connaissement'] === $stock_dep ) {
              //ici on compte le nombre de destination
                $rowspanStock_dep++;
            }
        }
        // Colonne Destination
?>
     
         <td rowspan='<?php echo $rowspanStock_dep; ?>' > A DEFINIR<?php  //echo $som_manif['sum(dis.quantite_poids)'] ; ?>  </td>
         

      <?php   } ?>
         
      <?php    
    // Colonne Destination
   /*   if ($numero_relache!= $row['idrel']   )  {
      $rowspanRelache = 0; // Réinitialisation du rowspan pour la nouvelle destination
        $numero_relache = $row['idrel'];
        $numero_relache_mang=$row['mangasin'];
        $numero_relache_con=$row['num_connaissement'];
        foreach ($nomb as $r) {
            if ($r['idrel'] === $numero_relache and $r['mangasin']!=$numero_relache_mang and $r['num_connaissement']===$numero_relache_con ) {
              //ici on compte le nombre de destination
                $rowspanRelache++;
            }
             if ($r['idrel'] === $numero_relache and $r['mangasin']===$numero_relache_mang and $r['num_connaissement']===$numero_relache_con ) {
              //ici on compte le nombre de destination
                $rowspanRelache=1;
            }
        } */
        // Colonne Destination
?>
       
       
         
         

      <?php  // } ?>

       <?php    
    // Colonne Destination
     if ($numero_relache!= $row['num_connaissement'] or $mangasin_receve_relache!=$row['mangasin'] or $meme_relache!=$row['id_relache']  )  {
      $rowspanRelache = 0; // Réinitialisation du rowspan pour la nouvelle destination
        $numero_relache = $row['num_connaissement'];
        $mangasin_receve_relache=$row['mangasin'];
        $meme_relache=$row['id_relache'];

       
        foreach ($nomb as $r) {
            if ($r['num_connaissement'] === $numero_relache and $r['mangasin']===$mangasin_receve_relache and $r['id_relache']===$meme_relache ) {
              //ici on compte le nombre de destination
                $rowspanRelache++;
            }
             
          }  
        
        // Colonne Destination
?>
        <td  rowspan='<?php echo $rowspanRelache; ?> '><?php echo $row['num_relache']; ?> </td>
       
         
         

      <?php  } ?>


        <?php    
    // Colonne Destination
    if ($banque!= $row['banque'] or $num_con_banque!=$row['num_connaissement'] )  {
        $rowspanBanque = 0; // Réinitialisation du rowspan pour la nouvelle destination
        $banque = $row['banque'];
        $num_con_banque=$row['num_connaissement'];
        foreach ($nomb as $r) {
            if ($r['banque'] === $banque and $r['num_connaissement']===$num_con_banque) {
              //ici on compte le nombre de destination
                $rowspanBanque++;
            }
        }
        // Colonne Destination
?>
        <td style="vertical-align: middle;" rowspan='<?php echo $rowspanBanque; ?>'><?php echo $row['banque']; ?> </td>
       
         
         

      <?php   } ?>

          <?php    
    // Colonne Destination
    if ($num_dec5!= $row['idrel'] /*or $num_connaissement5!=$row['num_connaissement'] */ )  {
        $rowspanDestination5 = 0; // Réinitialisation du rowspan pour la nouvelle destination
        $num_dec5 = $row['idrel'];
       // $num_connaissement5=$row['num_connaissement'];
        foreach ($nomb as $r) {
            if ($r['idrel'] === $num_dec5 and !empty($row['mangasin']) /*and $r['num_connaissement'] === $num_connaissement5*/ ) {
              //ici on compte le nombre de destination
                $rowspanDestination5++;
            }
        }
        // Colonne Destination
?>

     
       <td rowspan="<?php echo $rowspanDestination5; ?>"  style="vertical-align: middle; "  > <?php echo $row['quantite']; ?>    </td>
      <?php   } ?>

          

           <?php    
    // Colonne Destination
    if ( $num_con_balance!=$row['num_connaissement'] )  {
        $rowspanDestination7 = 0; // Réinitialisation du rowspan pour la nouvelle destination
       
        $num_con_balance=$row['num_connaissement'];
        foreach ($nomb as $r) {
            if ( $r['num_connaissement']===$num_con_balance) {
              //ici on compte le nombre de destination
                $rowspanDestination7++;
            }
        }
        // Colonne Destination
?>

     
       <td rowspan="<?php echo $rowspanDestination7; ?>"  > <?php //echo $row['quantite_dispath']; ?>  </td>
      <?php   } ?>
    



 <?php    
    // Colonne Destination
     if ($numero_relacheD!= $row['num_connaissement'] or $mangasin_receve_relacheD!=$row['mangasin']   )  {
      $rowspanRelacheD = 0; // Réinitialisation du rowspan pour la nouvelle destination
        $numero_relacheD = $row['num_connaissement'];
        $mangasin_receve_relacheD=$row['mangasin'];
        

       
        foreach ($nomb as $r) {
            if ($r['num_connaissement'] === $numero_relacheD and $r['mangasin']===$mangasin_receve_relacheD ) {
              //ici on compte le nombre de destination
                $rowspanRelacheD++;
            }
             
          } 

          $mes_relachesD=$bdd->prepare("SELECT  dis.*, nc.*,nr.*,nr.id_relache as idrel,mg.mangasin   from dispat as dis
      left join numero_relache as nr on dis.id_dis=nr.id_dis_relache 
      
    
      
      inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
      left join mangasin as mg on mg.id=dis.id_mangasin

     
    
    
      WHERE nr.id_dis_relache=? and nr.status=1 group by nr.id_relache ");
      $mes_relachesD->bindParam(1,$row['id_dis_relache']);
      $mes_relachesD->execute(); 
        
        // Colonne Destination
?>
        <td  rowspan='<?php echo $rowspanRelacheD; ?> '><?php  while($depas=$mes_relachesD->fetch()){ echo $depas['num_relache']; } ?> </td>
       
         
         

      

  <?php   
            $livraison_relache=$bdd->prepare("SELECT  dis.*, nc.*,nr.*,nr.id_relache as idrel,mg.mangasin , sum(s.poids_liv), sum(mo.poids_mo), sum(bal.poids_bal)   from dispat as dis
      left join numero_relache as nr on dis.id_dis=nr.id_dis_relache 
      
   left join livraison_sain as s on s.relache_liv=nr.id_relache
      left join livraison_mouille as mo on mo.relache_mo=nr.id_relache
      left join livraison_balayure as bal on bal.relache_bal=nr.id_relache 
    
      
      inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
      left join mangasin as mg on mg.id=dis.id_mangasin

     
    
    
      WHERE nr.id_dis_relache=? and nr.status=1 group by nr.id_relache ");
      $livraison_relache->bindParam(1,$row['id_dis_relache']);
      $livraison_relache->execute();  ?>

        <td  rowspan='<?php echo $rowspanRelacheD; ?> '><?php while ($liv_relache=$livraison_relache->fetch()){ $quantite_depasse=$liv_relache['sum(s.poids_liv)']+$liv_relache['sum(mo.poids_mo)']+$liv_relache['sum(bal.poids_bal)']; ?> <?php echo $quantite_depasse; } ?>  </td>
         
          <?php    
   // FERMER
       ?>
         
         <?php  } ?>

               </tr>
             <?php  } ?>

</tbody>
</table>
</div>

 
</div>






