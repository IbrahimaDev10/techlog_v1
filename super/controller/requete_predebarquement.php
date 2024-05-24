<?php 

function par_cale($bdd,$b){
  $requete_cale = $bdd->prepare("SELECT  p.*, dc.*, sum(dc.nombre_sac), sum(dc.poids) from produit_deb as p left join declaration_chargement as dc on p.id=dc.id_produit  where dc.id_navire=? group by dc.cales, p.produit, dc.id_dec  with rollup ");
            $requete_cale ->bindParam(1,$b);
            $requete_cale ->execute();
            return $requete_cale;
}	

function par_cale_vrac($bdd,$b){
  $requete_cale = $bdd->prepare("SELECT  c.*, dc.*, sum(dc.nombre_sac), sum(dc.poids),des.* from categories as c left join declaration_chargement as dc on c.id_categories=dc.categories_id 
    left join description_categories as des on des.id_descrip=dc.id_description where dc.id_navire=?
   group by dc.cales, c.id_categories, dc.id_dec  with rollup ");
            $requete_cale ->bindParam(1,$b);
            $requete_cale ->execute();
            return $requete_cale;
} 
function form_modif($bdd,$b){
    $form=$bdd->prepare("SELECT id_navire from declaration_chargement where id_navire=?");
    $form->bindParam(1,$b);
    $form->execute();
    return $form;
}

function navire_con($bdd,$b){
            $navs2=$bdd->prepare("select * from navire_deb where id=?");
            $navs2->bindParam(1,$b);
            $navs2->execute();
            return $navs2;
}
  function affichage_par_cale($bdd,$b){
    $navs2=navire_con($bdd,$b);
    $types=$navs2->fetch(); ?>

                   <div id="parcale" class="table table-responsive" border=1> 
                  <table class='table table-hover table-bordered table-striped table-responsive' id="fetch_cargo_plan" border='5' style="border-color: black;" >
                <thead> 
                  <tr  style="text-align: center;">  
        <td class="enteteparcale"  colspan="7" style="font-size: 22px !important;" >CHARGEMENT PAR CALE</td></tr>
               <tr style="color:white; font-weight: bold; background: linear-gradient(to bottom, #FFFFFF, rgb(0,141,202));  border-color: white; text-align: center; font-size: 14px;" border='5'  >
              <th style="border-color:white;" scope="col" >CALES</th>
              <th style="border-color:white;" scope="col" >NOM CHARGEUR</th>
             <th style="border-color:white;" scope="col" >PRODUIT</th>
             <?php if($types['type']=="SACHERIE"){?>
            <th style="border-color:white;" scope="col" >CONDITIONNEMENT</th>
                          
   
           <th style="border-color:white;" scope="col" > QUANTITE  </th>
         <?php } ?>
          <th style="border-color:white;" scope="col" >POIDS (T)</th>
          <th class="no-print" style="border-color:white;" scope="col" >ACTIONS</th>
         
         </tr>
        </thead>

      <tbody style="font-weight: bold;" style="font-size: 14px;">

      <?php 

               $requete_cale=par_cale($bdd,$b);
             while($row2 = $requete_cale->fetch()){

               $politique_modif = $bdd->prepare("SELECT count(manif.bl)   FROM transfert_debarquement as manif 
             inner join declaration_chargement as dc  on dc.id_dec=manif.cale


                

                   WHERE manif.cale=? ");
                   $politique_modif->bindParam(1,$row2['id_dec']);
                   $politique_modif->execute();
                   $pol_modif=$politique_modif->fetch();
            ?>
      
              <?php 
              if(!empty($row2['produit']) and !empty($row2['id_dec']) and !empty($row2['cales']) ){ ?>
                <tr id="<?php echo $row2['id_dec'] ?>" style="text-align:center; background: white; font-size: 14px;" border='5'>
        
      <td class="colcel" id="<?php echo $row2['id_dec'].'cales'; ?>"  ><?php echo $row2['cales']; ?></td>
  
      <td class="colcel"  id="<?php echo $row2['id_dec'].'nom_chargeur'; ?>" ><?php echo $row2['nom_chargeur']; ?></td>
   <td class="colcel"   id="<?php echo $row2['id_dec'].'produit'; ?>"  >   <?php echo $row2['produit']; ?> <pre><?php echo $row2['qualite']; ?></pre></td><span style="display: none;" id="<?php echo $row2['id_dec'].'produit-id'; ?>" style="display: none;"><?php echo $row2['id_produit'] ?></span>
   <span style="display: none;" id="<?php echo $row2['id_dec'].'type'; ?>" style="display: none;" ><?php echo $types['type'] ?></span>

   <span style="display: none;" id="<?php echo $row2['id_dec'].'poids_is_vrac'; ?>"  ><?php echo $row2['sum(dc.poids)'] ?></span>
    <span style="display: none;" class="colcel" id="<?php echo $row2['id_dec'].'conditionnement'; ?>" ><?php echo $row2['conditionnement']; ?> KGS</span>
   <span style="display: none;" class="colcel" id="<?php echo $row2['id_dec'].'sac'; ?>" ><?php echo number_format($row2['sum(dc.nombre_sac)'], 0,',',' '); ?></span>
   <?php if($types['type']=="SACHERIE"){ ?>
   <td class="colcel" data-target="conditionn" ><?php echo $row2['conditionnement']; ?> KGS</td>
   <td class="colcel" data-target="sa" ><?php echo number_format($row2['sum(dc.nombre_sac)'], 0,',',' '); ?></td>
 <?php } ?>
   <td class="colcel" id="<?php echo $row2['id_dec'].'poids'; ?>" ><?php echo number_format($row2['sum(dc.poids)'], 3,',',' '); ?></td>
   

     <td style="display: none;" class="colcel" id="<?php echo $row2['id_dec'].'navire'; ?>" ><?php echo $row2['id_navire'] ?></td>
   <td id="no-print" class="colcel"  >
<div  style="display: flex; justify-content: center; display: flex; vertical-align: middle;">
    <a class="fabtn1"  style="display: flex; justify-content: center; vertical-align: middle;"  id="<?php echo $row2['id_dec'].'aa' ?>" name="delete"    onclick="deleteDec(<?php echo $row2['id_dec'] ?>)" > <i class="fa fa-trash " ></i> </a>
     <a class="fabtn1" style="display: flex; justify-content: center; vertical-align: middle;"  name="modify"  data-role="update" data-id="<?php echo $row2['id_dec']; ?>" data-pol_modif_cale=<?php echo $pol_modif['count(manif.bl)']; ?> ><i class="fa fa-edit  "  ></i></a>
 </div>

   <!--  <a class="fabtn1" style="display: flex; justify-content: center; vertical-align: middle;"  name="modify" >  <i class="fa fa-ellipsis-v "  ></i>  </a> !-->
     
   </div>
    </td>
  
    </tr>
         <?php } ?>

                <?php 
              if(empty($row2['produit']) and empty($row2['id_dec']) and !empty($row2['cales'])){ ?>
          <tr  style="text-align:center;  " border='5'>
    <td  id="soustotal" >TOTAL <?php echo $row2['cales']; ?></td>
     <td   id="soustotal"  <?php if($types['type']=="SACHERIE"){?> colspan="3" <?php } ?> <?php if($types['type']=="VRAQUIER"){?> colspan="2" <?php } ?> >  </td>
     <?php if($types['type']=="SACHERIE"){?>  
      <td  id="soustotal"  > <?php  echo number_format($row2['sum(dc.nombre_sac)'], 0,',',' '); ?> </td>
      <?php } ?>


    <td id="soustotal"  ><?php echo number_format($row2['sum(dc.poids)'], 3,',',' '); ?></td>
     <td class="no-print" id="soustotal"  > </td>
   </tr>
                 <?php } ?>

<?php 
              if(empty($row2['cales']) and empty($row2['produit']) and empty($row2['id_dec'])){

               ?>
               <tr>
               
             

<td id="total" <?php if($types['type']=="SACHERIE"){?> colspan="4" <?php } ?> <?php if($types['type']=="VRAQUIER"){?> colspan="3" <?php } ?> >TOTAL </td>

<?php if($types['type']=="SACHERIE"){ ?>
<td id="total" ><?php echo number_format($row2['sum(dc.nombre_sac)'], 0,',',' '); ?></td>
<?php } ?>
<td id="total" ><?php echo number_format($row2['sum(dc.poids)'], 3,',',' '); ?></td>
<td class="no-print" id="total" ></td>
</tr>
<?php } ?>

    </tr>
               <?php } ?>
    </tbody>
   </table>  
  </div>
<?php   } //FERMETURE FUNC ?>



<?php  
  function affichage_par_cale_vrac($bdd,$b){
    $navs2=navire_con($bdd,$b);
    $types=$navs2->fetch(); ?>

                   <div id="parcale" class="table table-responsive" border=1> 
                  <table class='table table-hover table-bordered table-striped table-responsive' id="fetch_cargo_plan" border='5' style="border-color: black;" >
                <thead> 
                  <tr  style="text-align: center;">  
        <td class="enteteparcale"  colspan="7" style="font-size: 22px !important;" >CHARGEMENT PAR CALE</td></tr>
               <tr style="color:white; font-weight: bold; background: linear-gradient(to bottom, #FFFFFF, rgb(0,141,202));  border-color: white; text-align: center; font-size: 14px;" border='5'  >
              <th style="border-color:white;" scope="col" >CALES</th>
              <th style="border-color:white;" scope="col" >NOM CHARGEUR</th>
             <th style="border-color:white;" scope="col" >PRODUIT</th>
             <?php if($types['type']=="SACHERIE"){?>
            <th style="border-color:white;" scope="col" >CONDITIONNEMENT</th>
                          
   
           <th style="border-color:white;" scope="col" > QUANTITE </th>
         <?php } ?>
          <th style="border-color:white;" scope="col" >POIDS (T)</th>
          <th class="no-print" style="border-color:white;" scope="col" >ACTIONS</th>
         
         </tr>
        </thead>

      <tbody style="font-weight: bold;" style="font-size: 14px;">

      <?php 

               $requete_cale=par_cale_vrac($bdd,$b);
             while($row2 = $requete_cale->fetch()){

               $politique_modif = $bdd->prepare("SELECT count(manif.bl)   FROM transfert_debarquement as manif 
             inner join declaration_chargement as dc  on dc.id_dec=manif.cale


                

                   WHERE manif.cale=? ");
                   $politique_modif->bindParam(1,$row2['id_dec']);
                   $politique_modif->execute();
                   $pol_modif=$politique_modif->fetch();
            ?>
      
              <?php 
              if(!empty($row2['id_categories']) and !empty($row2['id_dec']) and !empty($row2['cales']) ){ ?>
                <tr id="<?php echo $row2['id_dec'] ?>" style="text-align:center; background: white; font-size: 14px;" border='5'>
        
      <td class="colcel" id="<?php echo $row2['id_dec'].'cales'; ?>"  ><?php echo $row2['cales']; ?></td>
  
      <td class="colcel"  id="<?php echo $row2['id_dec'].'nom_chargeur'; ?>" ><?php echo $row2['nom_chargeur']; ?></td>
   <td class="colcel"   id="<?php echo $row2['id_dec'].'produit'; ?>"  >   <?php echo $row2['nom_categories']; ?> <?php echo $row2['nom_descrip']; ?></td><span style="display: none;" id="<?php echo $row2['id_dec'].'produit-id'; ?>" style="display: none;"><?php echo $row2['id_categories'] ?></span>
   <span style="display: none;" id="<?php echo $row2['id_dec'].'type'; ?>" style="display: none;" ><?php echo $types['type'] ?></span>

   <span style="display: none;" id="<?php echo $row2['id_dec'].'poids_is_vrac'; ?>"  ><?php echo $row2['sum(dc.poids)'] ?></span>
    <span style="display: none;" class="colcel" id="<?php echo $row2['id_dec'].'conditionnement'; ?>" ><?php echo $row2['conditionnement']; ?> KGS</span>
   <span style="display: none;" class="colcel" id="<?php echo $row2['id_dec'].'sac'; ?>" ><?php echo number_format($row2['sum(dc.nombre_sac)'], 0,',',' '); ?></span>
   <?php if($types['type']=="SACHERIE"){ ?>
   <td class="colcel" data-target="conditionn" ><?php echo $row2['conditionnement']; ?> KGS</td>
   <td class="colcel" data-target="sa" ><?php echo number_format($row2['sum(dc.nombre_sac)'], 0,',',' '); ?></td>
 <?php } ?>
   <td class="colcel" id="<?php echo $row2['id_dec'].'poids'; ?>" ><?php echo number_format($row2['sum(dc.poids)'], 3,',',' '); ?></td>
   

     <td style="display: none;" class="colcel" id="<?php echo $row2['id_dec'].'navire'; ?>" ><?php echo $row2['id_navire'] ?></td>
   <td id="no-print" class="colcel"  >
<div  style="display: flex; justify-content: center; display: flex; vertical-align: middle;">
    <a class="fabtn1"  style="display: flex; justify-content: center; vertical-align: middle;"  id="<?php echo $row2['id_dec'].'aa' ?>" name="delete"    onclick="deleteDec(<?php echo $row2['id_dec'] ?>)" > <i class="fa fa-trash " ></i> </a>
     <a class="fabtn1" style="display: flex; justify-content: center; vertical-align: middle;"  name="modify"  data-role="update" data-id="<?php echo $row2['id_dec']; ?>" data-pol_modif_cale=<?php echo $pol_modif['count(manif.bl)']; ?> ><i class="fa fa-edit  "  ></i></a>
 </div>

   <!--  <a class="fabtn1" style="display: flex; justify-content: center; vertical-align: middle;"  name="modify" >  <i class="fa fa-ellipsis-v "  ></i>  </a> !-->
     
   </div>
    </td>
  
    </tr>
         <?php } ?>

                <?php 
              if(empty($row2['id_categories']) and empty($row2['id_dec']) and !empty($row2['cales'])){ ?>
          <tr  style="text-align:center;  " border='5'>
    <td  id="soustotal" >TOTAL <?php echo $row2['cales']; ?></td>
     <td   id="soustotal"  <?php if($types['type']=="SACHERIE"){?> colspan="3" <?php } ?> <?php if($types['type']=="VRAQUIER"){?> colspan="2" <?php } ?> >  </td>
     <?php if($types['type']=="SACHERIE"){?>  
      <td  id="soustotal"  > <?php  echo number_format($row2['sum(dc.nombre_sac)'], 0,',',' '); ?> </td>
      <?php } ?>


    <td id="soustotal"  ><?php echo number_format($row2['sum(dc.poids)'], 3,',',' '); ?></td>
     <td class="no-print" id="soustotal"  > </td>
   </tr>
                 <?php } ?>

<?php 
              if(empty($row2['cales']) and empty($row2['id_categories']) and empty($row2['id_dec'])){

               ?>
               <tr>
               
             

<td id="total" <?php if($types['type']=="SACHERIE"){?> colspan="4" <?php } ?> <?php if($types['type']=="VRAQUIER"){?> colspan="3" <?php } ?> >TOTAL </td>

<?php if($types['type']=="SACHERIE"){ ?>
<td id="total" ><?php echo number_format($row2['sum(dc.nombre_sac)'], 0,',',' '); ?></td>
<?php } ?>
<td id="total" ><?php echo number_format($row2['sum(dc.poids)'], 3,',',' '); ?></td>
<td class="no-print" id="total" ></td>
</tr>
<?php } ?>

    </tr>
               <?php } ?>
    </tbody>
   </table>  
  </div>
<?php   } //FERMETURE FUNC ?>





<?php  
function par_destination($bdd,$b){
	                        $destination = $bdd->prepare("SELECT   dis.id_dis,dis.n_bl,dis.nombre_sac,dis.poids_t,dis.poids_kg, p.produit,cli.client,mang.mangasin,mang.id as idmg, sum(dis.nombre_sac), sum(dis.poids_t),q.* from dispatching as dis
                        inner join mangasin as mang on dis.id_mangasin=mang.id 
                        inner join client as cli on dis.id_client=cli.id 
                        inner join produit_deb as p  on dis.id_produit=p.id
                        left join qualite_produit_vrac as q on q.id_qual=dis.id_qualite
                        
                        
                        where dis.id_navire=?  group by mang.mangasin, cli.client, dis.id_dis ORDER BY mang.mangasin with rollup ");
        $destination->bindParam(1,$b);
       

        $destination->execute();

       return $destination; 
}

function nombre_client($bdd,$b,$mg){
	$lesclient=$bdd->prepare("SELECT cli.client,count(cli.client), dis.id_mangasin from dispatching as dis inner join client as cli on cli.id=dis.id_client
         where dis.id_navire=? and dis.id_mangasin=? group by cli.client");
         $lesclient->bindParam(1,$b);
         $lesclient->bindParam(2,$mg);
         $lesclient->execute();
         return $lesclient;
}

function nombre_client_par_mangasin($bdd,$mg,$b){
	        $somme_mg=$bdd->prepare("SELECT count(id_client),id_client from dispatching
         WHERE id_mangasin=? and id_navire=?  ");
        
         $somme_mg->bindParam(1,$mg);
         $somme_mg->bindParam(2,$b);
          
         $somme_mg->execute();
         return $somme_mg;
}

function repetition_des_client_par_mangasin($bdd,$mg,$b,$nbre_client){
	 $somme_mg2=$bdd->prepare("SELECT count(id_client) from dispatching
         WHERE id_mangasin=? and id_navire=? and id_client=? ");
        
         $somme_mg2->bindParam(1,$mg);
         $somme_mg2->bindParam(2,$b);
         $somme_mg2->bindParam(3,$nbre_client);
         $somme_mg2->execute();
         return $somme_mg2;
}

function afficher_connaissement($bdd,$b){
  /*
    $connaissement=$bdd->prepare('SELECT nc.*,dis.*,p.*,cli.*,mg.*,b.banque,aff.affreteur,nav.navire,nav.type from dispats as dis
        inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
        inner join produit_deb as p on p.id=nc.id_produit
        inner join client as cli on cli.id=nc.id_client
        inner join mangasin as mg on mg.id=dis.id_mangasin
        left join banque as b on b.id=nc.id_banque
        left join affreteur as aff on aff.id=nc.id_fournisseur
        inner join navire_deb as nav on nav.id=nc.id_navire
        where nc.id_navire=? order by nc.num_connaissement');
    $connaissement->bindParam(1,$b);
    $connaissement->execute();
    return $connaissement;
    */

     $connaissement=$bdd->prepare('SELECT nc.id_connaissement,nc.num_connaissement,nc.id_navire,nc.id_produit,nc.poids_kg,dis.*,p.produit,p.qualite,cli.id,cli.client,mg.mangasin,b.banque,aff.affreteur,nav.navire,nav.type, nav.id as nav_id, d.*,d.poids as poids_declares from dispats as dis
        left join declaration as d on d.id_bl=dis.id_dis
        inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
        inner join produit_deb as p on p.id=nc.id_produit
        inner join client as cli on cli.id=nc.id_client
        
        inner join mangasin as mg on mg.id=dis.id_mangasin
        left join banque as b on b.id=nc.id_banque
        left join affreteur as aff on aff.id=nc.id_fournisseur
        inner join navire_deb as nav on nav.id=nc.id_navire
        where nc.id_navire=? order by nc.id_connaissement,mg.mangasin');
    $connaissement->bindParam(1,$b);
    $connaissement->execute();
    return $connaissement;
}



function afficher_destination($bdd,$b){
    $destination=$bdd->prepare('SELECT nc.*,dis.*,p.*,cli.client,mg.mangasin,b.banque,aff.affreteur,nav.navire, sum(dis.quantite_sac), sum(dis.quantite_poids) /*,d.id_declaration as decla*/ from dispats as dis
    /*  left join declaration as d on d.id_bl=dis.id_dis */
        inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
        inner join produit_deb as p on p.id=nc.id_produit
        inner join client as cli on cli.id=nc.id_client
        inner join mangasin as mg on mg.id=dis.id_mangasin
        left join banque as b on b.id=nc.id_banque
        left join affreteur as aff on aff.id=nc.id_fournisseur
        inner join navire_deb as nav on nav.id=nc.id_navire
       /* left join qualite_produit_vrac as q on q.id_qual=dis.id_qualite */
        where nc.id_navire=? group by mg.mangasin,dis.id_dis /*,cli.client*/ with rollup');
    $destination->bindParam(1,$b);
    $destination->execute();
    return $destination;
}

function afficher_client($bdd,$b){
    $client=$bdd->prepare('SELECT nc.*,dis.*,p.*,cli.client,mg.mangasin,b.banque,aff.affreteur,nav.navire, sum(dis.quantite_sac), sum(dis.quantite_poids),d.* from dispats as dis inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis left join declaration as d on d.id_bl=dis.id_dis inner join produit_deb as p on p.id=nc.id_produit inner join client as cli on cli.id=nc.id_client inner join mangasin as mg on mg.id=dis.id_mangasin left join banque as b on b.id=nc.id_banque left join affreteur as aff on aff.id=nc.id_fournisseur inner join navire_deb as nav on nav.id=nc.id_navire where nc.id_navire=? group by cli.client,nc.id_connaissement,dis.id_dis,d.id_declaration;');
    $client->bindParam(1,$b);
    $client->execute();
    return $client;
}

/* requete unique SELECT nc.*,dis.*,p.*,cli.client,mg.mangasin,b.banque,aff.affreteur,nav.navire, sum(dis.quantite_sac), sum(dis.quantite_poids),d.* from dispats as dis inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis left join declaration as d on d.id_bl=dis.id_dis inner join produit_deb as p on p.id=nc.id_produit inner join client as cli on cli.id=nc.id_client inner join mangasin as mg on mg.id=dis.id_mangasin left join banque as b on b.id=nc.id_banque left join affreteur as aff on aff.id=nc.id_fournisseur inner join navire_deb as nav on nav.id=nc.id_navire where nc.id_navire=57 group by cli.client,nc.id_connaissement,dis.id_dis,d.id_declaration; */



function affichage_par_connaissement($bdd,$b){
    $navs2=navire_con($bdd,$b);
    $types=$navs2->fetch();
  ?>  
<div style=" display: flex; ">
  <a style="background: blue; width: 40px; height: 25px; display: flex; justify-content: center; align-items: center; "  data-role='imprimer_par_connaissement'><i class="fa fa-print text-white"></i></a>
</div>
<br>  
              

            <div id="tab_par_connaissement" class="table-responsive" > 
             <table id="tab_par_connaissement2" class='table table-responsive table-hover table-bordered table-striped'  border='2' style="border-color: black; " >
            
          <thead> 
          <tr id='entete_head' style="text-align: center;">  <td colspan="9">PAR CONNAISSEMENT</td></tr>  
 <tr style="color:white; font-weight: bold; color:white; font-weight: bold; background: linear-gradient(to bottom, #FFFFFF, rgb(0,141,202));  border-color: white; text-align: center; font-size: 14px;" border='5' >
                                <th  scope="col" >NAVIRE</th>
                                <th  scope="col" >N° BL</th>
                                <th  scope="col" >RECEP<br>
                                TIONNAIRE</th>
                                <th  scope="col" >BANQUE</th>
                                
                                 <th  scope="col" >DESTINATION</th>
                                <th  scope="col" >PRODUIT</th>
                            <?php if($types['type']=="SACHERIE"){ ?>
                                <th  scope="col" >QUANTITE</th>
                              <?php } ?>
                               <th  scope="col" >POIDS (T)</th> 
                               <th  scope="col" >DECLARATION (T)</th> 
                              
                               <th scope="col" >ACTIONS</th>
                                
                                


                                
                              </tr>
                              </thead>
                               <tbody style="font-weight: bold;">
                                <?php  
                       $connaissement=afficher_connaissement($bdd,$b);
                       $con=$connaissement->fetchAll(PDO::FETCH_ASSOC);

            $num_connaissement='NULL';

            $rowspanConnaissement = 0;
             $num_navire='NULL';
            $rowspanNavire = 0;

                        $num_con_produit='NULL';
                        $id_produit='NULL';
                        $poids_kg=0;
            $rowspanProduit = 0;


                              $num_con_mg='NULL';
                              $mg='NULL';
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
          
           
                <tr  id="<?php echo $row['id_dis']; ?>" style="text-align:center; background: white; font-size: 14px;" border='5'>
        <?php  if($num_navire!=$row['navire']){
                    $rowspanNavire=0;
                    $num_navire=$row['navire'];
                    foreach ($con as $r ) {
                      if($r['navire']===$num_navire){
                        $rowspanNavire++;
                      # code...
                    }
                  }
           ?>        
             <td  class="colcel" id="<?php echo $row['id_dis'].'bl_dis' ?>" rowspan="<?php echo $rowspanNavire; ?>" ><?php echo $row['navire']; ?></td> 
           <?php  } ?>

          <?php  if($num_connaissement!=$row['num_connaissement']){
                    $rowspanConnaissement=0;
                    $num_connaissement=$row['num_connaissement'];
                    foreach ($con as $r ) {
                      if($r['num_connaissement']===$num_connaissement){
                        $rowspanConnaissement++;
                      # code...
                    }
                  }
           ?>        
             <td  class="colcel" id="<?php echo $row['id_dis'].'bl_diss' ?>" rowspan="<?php echo $rowspanConnaissement; ?>" ><?php echo $row['num_connaissement']; ?></td> 
             
             <td rowspan="<?php echo $rowspanConnaissement; ?>" class="colcel" id="<?php echo $row['id_dis'].'cli_dis' ?>" ><?php echo $row['client']; ?></td>

              <td rowspan="<?php echo $rowspanConnaissement; ?>" class="colcel" id="<?php echo $row['banque'].'banque_di' ?>" ><?php echo $row['banque']; ?></td>
           <?php  } ?>
            
             <?php  if($num_con_mg!=$row['num_connaissement'] OR $mg!=$row['mangasin']  ){
                    $rowspanMg=0;
                    $num_con_mg=$row['num_connaissement']; 
                    $mg=$row['mangasin'];
                    
                    foreach ($con as $r ) {
                      if($r['num_connaissement']===$num_con_mg and $r['mangasin']===$mg  ){
                        $rowspanMg++;
                      # code...
                    }
                  }
           ?>    

<td rowspan="<?php echo $rowspanMg; ?>" class="colcel" id="<?php echo $row['id_dis'].'mg_dis' ?>" ><?php echo $row['mangasin'] ?> </td>

<?php } ?>

       <!--      <td class="colcel" id="<?php //echo $row['id_dis'].'mg_dis' ?>" ><?php //echo $row['mangasin'] ?> </td> !-->
             <span style="display: none;" class="colcel" id="<?php echo $row['id_dis'].'id_mg_dis' ?>" ><?php echo $row['id_destination']; ?></span>
             <span style="display: none;" class="colcel" id="<?php echo $row['id_dis'].'poids_sac_diss' ?>" ><?php  echo $row['poids_kg']; ?></span>
             <span style="display: none;" class="colcel" id="<?php echo $row['id_dis'].'poids_diss' ?>" ><?php  echo $row['quantite_poids']; ?></span>

           

             <span style="display: none;" class="colcel" id="<?php echo $row['id_dis'].'type_navire' ?>" ><?php echo $row['type']; ?></span>
              <span style="display: none;" class="colcel" id="<?php echo $row['id_dis'].'des_douane_dis' ?>" ><?php echo $row['des_douane']; ?></span>

  <?php  if($num_con_produit!=$row['num_connaissement'] OR $id_produit!=$row['id_produit'] OR $poids_kg!=$row['poids_kg']  ){
                    $rowspanProduit=0;
                    $num_con_produit=$row['num_connaissement']; 
                    $id_produit=$row['id_produit'];
                    $poids_kg=$row['poids_kg'];
                    foreach ($con as $r ) {
                      if($r['num_connaissement']===$num_con_produit and $r['id_produit']===$id_produit and $r['poids_kg']===$poids_kg ){
                        $rowspanProduit++;
                      # code...
                    }
                  }
           ?>    
<td rowspan="<?php echo $rowspanProduit; ?>" class="colcel"  ><?php echo $aff_produit['produit']; ?> <?php echo $aff_produit['poids_kgs'].' KG';  ?>  <br><?php if( $types['type']=='SACHERIE'){ echo $row['qualite']; ?> <br><?php echo $row['poids_kg'].' KG'; } ?>  </td>


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

       
      <?php } ?>
                  <?php  if($num_con_poids!=$row['num_connaissement'] OR $mg_poids!=$row['mangasin']  ){
                    $rowspanPoids=0;
                    $num_con_poids=$row['num_connaissement']; 
                    $mg_poids=$row['mangasin'];
                    
                    foreach ($con as $r ) {
                      if($r['num_connaissement']===$num_con_poids and $r['mangasin']===$mg_poids  ){
                        $rowspanPoids++;
                      # code...
                    }
                  }
           ?>    



<td rowspan="<?php echo $rowspanPoids; ?>" style="white-space: nowrap;" class="colcel"><?php echo number_format($row['quantite_poids'], 3,',',' '); ?></td>

<?php } ?>

         
       <td style="" class="colcel" id="<?php echo $row['id_dis'].'num_dec' ?>"><?php echo $row['num_declaration']; ?> <br>  (<?php if($row['poids_declares']>0){ echo $row['poids_declares'].' T'; } else{ echo 'aucune declaration';} ?>)</td>
          <span style="display: none;" class="colcel" id="<?php echo $row['id_dis'].'id_num_dec' ?>"  ><?php echo $row['id_mangasin']; ?></span>
           <span style="display: none;" class="colcel" id="<?php echo $row['id_dis'].'id_con_dis_dis' ?>"  ><?php echo $row['id_con_dis'].'-'.$row['poids_kg']; ?></span>

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

  
    
  </tr>
    <?php } ?>
    
     </tbody>
   </table>  
  </div>
  <style type="text/css">
  body{
    font-family:Times New Roman;
  }
  .colcel{

    vertical-align: middle;
  }
  #soustotal{
     background: linear-gradient(to bottom, blue, #1B2B65);
      background: linear-gradient(to left, blue, #1B2B65); background: linear-gradient(to top, blue, #1B2B65);
     color: white;
     vertical-align: middle;
     font-size: 16px; 
     text-align: center;
  }
  #total{
    background-color:#1B2B65;  color:white ; border: none; font-size: 16px; font-weight: bold; vertical-align: middle;
    text-align: center;
  }
  .hdeclaration{
  background-color: background: linear-gradient(to bottom, blue, #1B2B65);
   background: linear-gradient(to left, blue, #1B2B65);
    background: linear-gradient(to top, blue, #1B2B65);
  border: solid;
  
  border-top-right-radius: 50%;
  border-bottom-right-radius: 50%;
  font-weight: bold;
}
</style>
<?php   } //FERMETURE FUNCTION 

function connaissement_unique($bdd,$b){
  $mes_connaissement=$bdd->prepare("SELECT nc.*,b.*,af.*,p.produit,p.qualite,cli.client,cli.id,cat.*,des.* FROM numero_connaissements as nc LEFT join banque as b on b.id=nc.id_banque
  LEFT join produit_deb as p on p.id=nc.id_produit
  left join client as cli on cli.id=nc.id_client
  left join affreteur as af on af.id=nc.id_fournisseur
  left join categories as cat on cat.id_categories=nc.categories_id_vrac
  left join description_categories as des on des.id_descrip=nc.id_description where id_navire=?");
$mes_connaissement->bindParam(1,$b);
$mes_connaissement->execute();
return $mes_connaissement;
}

function affichage_connaissement_unique($bdd,$b){
$mes_connaissement=connaissement_unique($bdd,$b);

?>



 <?php while($aff=$mes_connaissement->fetch()){ ?>
  <tr style="font-size:12px; background: white; vertical-align: middle; text-align: center; vertical-align:middle;">
<td id=<?php echo $aff['id_connaissement'].'nc' ?>><?php echo $aff['num_connaissement'] ?></td>
<td ><?php echo $aff['nom_categories'] ?> <?php echo $aff['nom_descrip'] ?></td>
<td ><?php echo $aff['client'] ?></td>
<td ><?php echo $aff['banque'] ?></td>
<td  ><?php echo $aff['affreteur'] ?></td>
<td id="<?php echo $aff['id_connaissement'].'poids'; ?>"><?php echo $aff['poids_connaissement'] ?></td>
<span id=<?php echo $aff['id_connaissement'].'banque' ?>><?php echo $aff['id_banque'] ?></span>
<span id=<?php echo $aff['id_connaissement'].'affreteur' ?>><?php echo $aff['id_fournisseur'] ?></span>
<span id=<?php echo $aff['id_connaissement'].'navire_con' ?>><?php echo $aff['id_navire'] ?></span>

<td style="display: flex; justify-content: center; vertical-align:middle;"><a data-role="modifier_connaissement" data-id="<?php echo $aff['id_connaissement']; ?>" ><i class="fas fa-edit"></i></a>
<a ><i class="fas fa-trash"></i></a></td>

 </tr>
 <?php } ?> 

  

 
<?php } //function close ?>



