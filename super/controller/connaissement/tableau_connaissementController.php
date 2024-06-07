<?php  

function afficher_connaissement($bdd,$b){


  /*   $connaissement=$bdd->prepare('SELECT nc.id_connaissement,nc.num_connaissement,nc.id_navire,nc.id_produit,nc.poids_kg,dis.*,p.produit,p.qualite,cli.id,cli.client,mg.mangasin,b.banque,aff.affreteur,nav.navire,nav.type, nav.id as nav_id, d.*,d.poids as poids_declares from dispats as dis
        left join declaration as d on d.id_bl=dis.id_dis
        inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
        inner join produit_deb as p on p.id=dis.id_produits
        inner join client as cli on cli.id=nc.id_client
        
        inner join mangasin as mg on mg.id=dis.id_mangasin
        left join banque as b on b.id=nc.id_banque
        left join affreteur as aff on aff.id=nc.id_fournisseur
        inner join navire_deb as nav on nav.id=nc.id_navire
        where nc.id_navire=? order by nc.id_connaissement,mg.mangasin ');
    $connaissement->bindParam(1,$b);
    $connaissement->execute();
    return $connaissement; */

    $connaissement=$bdd->prepare('SELECT nc.id_connaissement,nc.num_connaissement,nc.id_navire,nc.id_produit,nc.poids_kg,dis.*,p.produit,p.qualite,cli.id,cli.client,mg.mangasin,b.banque,aff.affreteur,nav.navire,nav.type, nav.id as nav_id, d.*,d.poids as poids_declares, sum(dis.quantite_poids), sum(d.poids)  from dispats as dis
        left join declaration as d on d.id_bl=dis.id_dis
        inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
        inner join produit_deb as p on p.id=dis.id_produits
        inner join client as cli on cli.id=nc.id_client
        
        inner join mangasin as mg on mg.id=dis.id_mangasin
        left join banque as b on b.id=nc.id_banque
        left join affreteur as aff on aff.id=nc.id_fournisseur
        inner join navire_deb as nav on nav.id=nc.id_navire
        where nc.id_navire=? group by nc.num_connaissement, mangasin,  dis.id_dis with rollup ');
    $connaissement->bindParam(1,$b);
    $connaissement->execute();
    return $connaissement;
}

function navire_type($bdd,$b){
    $nav=$bdd->prepare("SELECT type,navire from navire_deb where id=?");
    $nav->bindParam(1,$b);
    $nav->execute();
    return $nav;
}

 


 function affichage_par_connaissement($bdd,$b){
    $nav=navire_type($bdd,$b);
    $types=$nav->fetch();


  ?>  

                                <?php  
                       $connaissement=afficher_connaissement($bdd,$b);
                       $con=$connaissement->fetchAll(PDO::FETCH_ASSOC);

            $num_connaissement='NULL';
            $mangasin_connaissement='NULL';

            $rowspanConnaissement = 0;
             $num_navire='NULL';
            $rowspanNavire = 0;

                        $num_con_produit='NULL';
                        $id_produit='NULL';
                        $poids_kg=0;
                         $mangasin_produit='NULL';
            $rowspanProduit = 0;


                              $num_con_mg='NULL';
                              $mg='NULL';
                              $mg_connaissement='NULL';
                                            $produit_poids='NULL';
              $poids_poids='NULL';
                              $rowspanMg = 0;

                              $num_con_poids='NULL';
                              $mg_poids='NULL';
                              $rowspanPoids = 0;

                              $num_con_sac='NULL';
                              $mg_sac='NULL';
                              $rowspanSac = 0;

     foreach ($con as $row) {
       # code...
      $politique_modif = $bdd->prepare("SELECT count(manif.bl)   FROM transfert_debarquement as manif 
             inner join declaration as d  on manif.id_declaration=d.id_declaration
                inner join dispats as dis on dis.id_dis=d.id_bl
                inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis

                

                   WHERE nc.id_connaissement=? ");
                   $politique_modif->bindParam(1,$row['id_connaissement']);
                   $politique_modif->execute();
                   $pol_modif=$politique_modif->fetch();


                   $afficher_produit=$bdd->prepare('SELECT p.*,dis.id_dis,dis.poids_kgs,nc.id_connaissement from dispats as dis 
                    left join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
                    left join produit_deb as p on p.id=dis.id_produits
                    where nc.id_navire=? and dis.id_con_dis=? ');
                   $afficher_produit->bindParam(1,$row['id_navire']);
                   $afficher_produit->bindParam(2,$row['id_con_dis']);
                   $afficher_produit->execute();

                   $aff_produit=$afficher_produit->fetch();

            ?>
          
           
               
 <?php if( !empty($row['num_connaissement']) and !empty($row['mangasin']) and !empty($row['id_dis']) ){ ?>  
     <tr  id="<?php echo $row['id_dis']; ?>" style="text-align:center; background: white; font-size: 14px;" border='5'>


          <?php  if($num_connaissement!=$row['num_connaissement'] ){
                    $rowspanConnaissement=0;
                    $num_connaissement=$row['num_connaissement'];
                   
                    foreach ($con as $r ) {
                      if($r['num_connaissement']===$num_connaissement  and !empty($r['num_connaissement'])   and !empty($r['mangasin']) and  !empty($r['id_dis'])){
                        $rowspanConnaissement++;
                      # code...
                    }
                  }
           ?>        
             <td  class="colcel" id="<?php echo $row['id_dis'].'bl_diss' ?>" rowspan="<?php echo $rowspanConnaissement; ?>" ><?php echo $row['num_connaissement']; ?> </td> 
             
             <td rowspan="<?php echo $rowspanConnaissement; ?>" class="colcel" id="<?php echo $row['id_dis'].'cli_dis' ?>" ><?php echo $row['client']; ?></td>

              <td rowspan="<?php echo $rowspanConnaissement; ?>" class="colcel" id="<?php echo $row['banque'].'banque_di' ?>" ><?php echo $row['banque']; ?></td>
           <?php  } ?>
            
             <?php  if( $mg!=$row['mangasin'] or $mg_connaissement!=$row['num_connaissement'] ){
                    $rowspanMg=0;
                   // $num_con_mg=$row['num_connaissement']; 
                    $mg=$row['mangasin'];
                    $mg_connaissement=$row['num_connaissement'];
                    
                    foreach ($con as $r ) {
                      if($r['mangasin']===$mg and $r['num_connaissement']===$mg_connaissement and !empty($r['num_connaissement']) and !empty($r['mangasin']) and !empty($r['id_dis']) ){
                        $rowspanMg++;
                      # code...
                    }
                  }
           ?>    

<td rowspan="<?php echo $rowspanMg; ?>" class="colcel" id="<?php echo $row['id_dis'].'mg_dis' ?>" ><?php echo $row['mangasin'] ?> </td>

<?php } ?>

       <!--      <td class="colcel" id="<?php //echo $row['id_dis'].'mg_dis' ?>" ><?php //echo $row['mangasin'] ?> </td> !-->
             <span style="display: none;" class="colcel" id="<?php echo $row['id_dis'].'id_mg_dis' ?>" ><?php echo $row['id_destination']; ?></span>
             <span style="display: none;" class="colcel" id="<?php echo $row['id_dis'].'poids_sac_diss' ?>" ><?php  echo $row['poids_kgs']; ?></span>
             <span style="display: none;" class="colcel" id="<?php echo $row['id_dis'].'id_produit_diss' ?>" ><?php  echo $row['id_produits']; ?></span>
             <span style="display: none;" class="colcel" id="<?php echo $row['id_dis'].'poids_diss' ?>" ><?php  echo $row['quantite_poids']; ?></span>

           

             <span style="display: none;" class="colcel" id="<?php echo $row['id_dis'].'type_navire' ?>" ><?php echo $row['type']; ?></span>
              <span style="display: none;" class="colcel" id="<?php echo $row['id_dis'].'des_douane_dis' ?>" ><?php echo $row['des_douane']; ?></span>

  <?php  if($num_con_produit!=$row['num_connaissement'] OR $id_produit!=$row['id_produits'] OR $poids_kg!=$row['poids_kgs']  OR $mangasin_produit!=$row['mangasin'] ){
                    $rowspanProduit=0;
                    $num_con_produit=$row['num_connaissement']; 
                    $id_produit=$row['id_produits'];
                    $poids_kg=$row['poids_kgs'];
                    $mangasin_produit=$row['mangasin'];
                   
                    foreach ($con as $r ) {
                      if($r['num_connaissement']===$num_con_produit and $r['id_produits']===$id_produit and $r['poids_kgs']===$poids_kg  and $r['mangasin']===$mangasin_produit   and !empty($r['num_connaissement']) and !empty($r['mangasin'])  and !empty($r['id_dis']) ){
                        $rowspanProduit++;
                      # code...
                    }
                  }
           ?>    
<td rowspan="<?php echo $rowspanProduit; ?>" class="colcel"  ><?php echo $row['produit']; ?> <?php echo $row['poids_kgs'].' KG';  ?>  </td>


<?php } ?>


    <?php if($types['type']=="SACHERIE"){ ?>
                  <?php  if($num_con_sac!=$row['num_connaissement'] OR $mg_sac!=$row['mangasin']  ){
                    $rowspanSac=0;
                    $num_con_sac=$row['num_connaissement']; 
                    $mg_sac=$row['mangasin'];
                    
                    foreach ($con as $r ) {
                      if($r['num_connaissement']===$num_con_sac and $r['mangasin']===$mg_sac ){
                        $rowspanSac++;
                      # code...
                    }
                  }
           ?>    


 <td rowspan="<?php echo $rowspanSac; ?>" class="colcel" id="<?php echo $row['id_dis'].'sac_dis' ?>"><?php echo number_format($row['quantite_sac'], 0,',',' '); ?></td >

<?php } ?>    

       
      <?php }     


      ?>
                  <?php  if($num_con_poids!=$row['num_connaissement'] OR $mg_poids!=$row['mangasin'] or $produit_poids!=$row['id_produits'] or $poids_poids!=$row['poids_kgs']  ){
                    $rowspanPoids=0;
                    $num_con_poids=$row['num_connaissement']; 
                    $mg_poids=$row['mangasin'];
                    $produit_poids=$row['id_produits'];
                    $poids_poids=$row['poids_kgs'];
                    
                    foreach ($con as $r ) {
                      if($r['num_connaissement']===$num_con_poids and $r['mangasin']===$mg_poids and $r['id_produits']===$produit_poids and $r['poids_kgs']===$poids_poids and !empty($r['num_connaissement']) and !empty($r['mangasin'])  and !empty($r['id_dis']) ){
                        $rowspanPoids++;
                      # code...
                    }
                  }
           ?>    



<td rowspan="<?php echo $rowspanPoids; ?>" style="white-space: nowrap;" class="colcel"><?php echo number_format($row['sum(dis.quantite_poids)'], 3,',',' '); ?></td>

<?php } ?>

         
       <td style="" class="colcel" id="<?php echo $row['id_dis'].'num_dec' ?>"><?php echo $row['num_declaration']; ?> <br>  (<?php if($row['poids_declares']>0){ echo $row['poids_declares'].' T'; } else{ echo 'aucune declaration';} ?>)</td>
          <span style="display: none;" class="colcel" id="<?php echo $row['id_dis'].'id_num_dec' ?>"  ><?php echo $row['id_mangasin']; ?></span>
           <span style="display: none;" class="colcel" id="<?php echo $row['id_dis'].'id_con_dis_dis' ?>"  ><?php echo $row['id_con_dis']; ?></span>

          <span style="display: none;" class="colcel" id="<?php echo $row['id_dis'].'id_bl_dis' ?>"  ><?php echo $row['id_connaissement']; ?></span>
           <span style="display: none;" class="colcel" id="<?php echo $row['id_dis'].'bl_dis' ?>"  ><?php echo $row['id_connaissement']; ?></span>
             
              <span style="display: none;" id="<?php echo $row['id_dis'].'navire_dis' ?>" class="colcel"  style=""><?php echo $row['nav_id'] ?></span>
               <td class="colcel" data-target="affreteur_dis" style="display: none;"><?php echo $row['affreteur'] ?></td>
                <td class="colcel" data-target="banque_dis" style="display: none;"><?php echo $row['banque'] ?></td>
            <span style="display: none;" id="<?php echo $row['id_dis'].'type_decharge'; ?>" ><?php echo $row['type_decharge'] ?></span>
            <td class="colcel" >
               <div style="display: flex; justify-content: center;"> 
              <a name="deletedis" type="submit"  class="btn btn-text-danger" onclick="deleteDispatching(<?php echo $row['id_dis'] ?>)" style="color:rgb(0,141,202); margin-left: 0px;"> <i class="fa fa-trash " ></i> </a>
     <a class="btn"  name="modifys"  data-role="update_dis" data-id="<?php echo $row['id_dis']; ?>" data-pol_modif=<?php echo $pol_modif['count(manif.bl)']; ?>    style="border: none; margin-right: 1px; color:rgb(0,141,202);"> <i class="fa fa-edit  " ></i></a>
     <span style="display: none;" class="colcel" id="<?php echo $row['id_dis'].'id_prod_diss' ?>" ><?php echo $row['id_produit'].'-'.$row['poids_kg']; ?></span>
     <span style="display: none;" id="<?php echo $row['id_dis'].'prod_dis' ?>" ><?php echo $row['produit']; ?> <br><?php echo $row['qualite']; ?> <br><?php echo $row['poids_kg']; ?> kgs </span>
     <a class="fabtn1" href="insertion_fichier_mangasin.php?id=<?php echo $row['id_dis'] ?>" style="float:right;" target="blank" name="modify"         id="btnbtn" >  <i class="fa fa-folder"  ></i></a>
   </div>
    </td>
    <span style="display: none;" id="<?php echo $row['id_dis'].'conditionnemen' ?>"><?php echo $row['poids_kg']; ?></span>
    <span style="display: none;" id="<?php echo $row['id_dis'].'id_clien' ?>"><?php echo $row['poids_kg']; ?></span>
     <span style="display: none;" id="<?php echo $row['id_dis'].'id_navir' ?>"><?php echo $row['id_navire']; ?></span>

  
    
  </tr> <?php } ?>
 <?php if( !empty($row['num_connaissement']) and empty($row['mangasin']) and empty($row['id_dis']) ){ ?>
    <tr style="color: white; background: blue; text-align: center;">
    <td colspan="5">TOTAL <?php echo $row['num_connaissement']; ?></td>
    <td > <?php echo number_format($row['sum(dis.quantite_poids)'], 3,',',' '); ?></td>
    <td > <?php echo number_format($row['sum(d.poids)'], 3,',',' '); ?></td>
    <td > </td>
    </tr>
<?php } ?>

 <?php if( empty($row['num_connaissement']) and empty($row['mangasin']) and empty($row['id_dis']) ){ ?>
    <tr style="color: white; background: black; text-align: center;">
    <td colspan="5">TOTAL </td>
    <td > <?php echo number_format($row['sum(dis.quantite_poids)'], 3,',',' '); ?></td>
    <td > <?php echo number_format($row['sum(d.poids)'], 3,',',' '); ?></td>
    <td > </td>
    </tr>
<?php } ?>

    <?php } } ?>
    
    
 