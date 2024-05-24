<?php 

/*function afficher_livraison_sain($bdd,$produit,$poids_sac,$navire,$destination,$statut){
         $affiche = $bdd->prepare("SELECT ds.*, be.*, liv.*,dis.id_dis,dis.id_produit,dis.poids_kg,dis.id_mangasin,nc.id_navire, sum(liv.sac_liv),sum(liv.poids_liv),ex.id_trans_extends,nr.num_relache,nr.status  FROM livraison_sain as liv 
                
             //left join dispatching_relache as r on r.id_dis_relache=liv.relache_liv 
             inner join declaration_sortie as ds on ds.id_decliv=liv.dec_liv
             inner join bon_enlevement as be on be.id_enleve=liv.bl_fournisseur_liv
             inner join transit_extends as ex on ex.id_trans_extends=ds.id_dec_entrant
             inner join dispat as dis on dis.id_dis=ex.id_bl_extends
             inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
             left join numero_relache as nr on nr.id_relache=liv.relache_liv

      
         WHERE dis.id_produit=? and dis.poids_kg=? and nc.id_navire=? and dis.id_mangasin=? and liv.statut=? group by liv.date_liv, liv.id_liv with rollup");
        $affiche->bindParam(1,$produit);
        $affiche->bindParam(2,$poids_sac);
        $affiche->bindParam(3,$navire);
         $affiche->bindParam(4,$destination);
         $affiche->bindParam(5,$statut);
        $affiche->execute();
        return $affiche;
      } */


      function afficher_livraison_sain($bdd,$produit,$poids_sac,$navire,$destination,$statut){
         $affiche = $bdd->prepare("SELECT ds.*, bn.*,br.*, liv.*,dis.id_dis,dis.id_produit,dis.poids_kg,dis.id_mangasin,nc.id_navire, sum(liv.sac_liv),sum(liv.poids_liv),ex.id_trans_extends  FROM livraison_sain as liv 
                
             /*left join dispatching_relache as r on r.id_dis_relache=liv.relache_liv */
             inner join declaration_sortie as ds on ds.id_decliv=liv.dec_liv
             inner join bon_relaches as br on br.id_bon_relache=liv.bl_fournisseur_liv
             inner join bon as bn on bn.id_bon=br.bon_id
             inner join transit_extends as ex on ex.id_trans_extends=ds.id_dec_entrant
             inner join dispat as dis on dis.id_dis=ex.id_bl_extends
             inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
            

      
         WHERE dis.id_produit=? and dis.poids_kg=? and nc.id_navire=? and dis.id_mangasin=? and liv.statut=? group by liv.date_liv, liv.id_liv with rollup");
        $affiche->bindParam(1,$produit);
        $affiche->bindParam(2,$poids_sac);
        $affiche->bindParam(3,$navire);
         $affiche->bindParam(4,$destination);
         $affiche->bindParam(5,$statut);
        $affiche->execute();
        return $affiche;
      }

      function afficher_livraison_mouille($bdd,$produit,$poids_sac,$navire,$destination){
         $affiche_mo = $bdd->prepare("SELECT ds.*, be.*, liv.*,dis.id_dis,nc.id_navire, sum(liv.sac_mo),sum(liv.poids_mo),ex.id_trans_extends,nr.num_relache,nr.status  FROM livraison_mouille as liv 
                
           
             inner join declaration_sortie as ds on ds.id_decliv=liv.dec_mo
             inner join bon_enlevement as be on be.id_enleve=liv.bl_fournisseur_mo
             inner join transit_extends as ex on ex.id_trans_extends=ds.id_dec_entrant
             inner join dispat as dis on dis.id_dis=ex.id_bl_extends
             inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
            left join numero_relache as nr on nr.id_relache=liv.relache_mo

      
         WHERE dis.id_produit=? and dis.poids_kg=? and nc.id_navire=? and dis.id_mangasin=? group by liv.date_mo, liv.id_mo with rollup");
         $affiche_mo->bindParam(1,$produit);
         $affiche_mo->bindParam(2,$poids_sac);
         $affiche_mo->bindParam(3,$navire);
          $affiche_mo->bindParam(4,$destination);
         $affiche_mo->execute();
        return  $affiche_mo;
      }

       function afficher_livraison_balayure($bdd,$produit,$poids_sac,$navire,$destination){
         $affiche_bal = $bdd->prepare("SELECT r.*,ds.*, be.*, liv.*,dis.id_dis,nc.id_navire, sum(liv.sac_bal),sum(liv.poids_bal),ex.id_trans_extends,nr.num_relache,nr.status  FROM livraison_balayure as liv 
                
             inner join dispatching_relache as r on r.id_dis_relache=liv.relache_bal
             inner join declaration_sortie as ds on ds.id_decliv=liv.dec_bal
             inner join bon_enlevement as be on be.id_enleve=liv.bl_fournisseur_bal
             inner join transit_extends as ex on ex.id_trans_extends=ds.id_dec_entrant
             inner join dispat as dis on dis.id_dis=ex.id_bl_extends
             inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
             inner join numero_relache as nr on nr.id_relache=r.id_relache

      
         WHERE dis.id_produit=? and dis.poids_kg=? and nc.id_navire=? and dis.id_mangasin=? group by liv.date_bal, liv.id_bal with rollup");
         $affiche_bal->bindParam(1,$produit);
         $affiche_bal->bindParam(2,$poids_sac);
         $affiche_bal->bindParam(3,$navire);
          $affiche_bal->bindParam(4,$destination);
         $affiche_bal->execute();
        return  $affiche_bal;
      }

      
      function affichage_livraison_sain($bdd,$produit,$poids_sac,$navire,$destination,$statut){

 ?>
   <?php
        $affiche=afficher_livraison_sain($bdd,$produit,$poids_sac,$navire,$destination,$statut);

   while ($aff=$affiche->fetch()){
 if(!empty($aff['date_liv']) and !empty($aff['id_liv'])){
    ?>

<tr  style="vertical-align: middle;"  style=" vertical-align: middle; background: white; " >
  <td  class="colaffiches" id="<?php echo $aff['id_liv'].'date_sain'; ?>"    ><?php echo $aff['date_liv'] ?></td>
  <td  class="colaffiches" id="<?php echo $aff['id_liv'].'heure_sain'; ?>"><?php echo $aff['heure_liv'] ?></td>
    <td  class="colaffiches" id="<?php echo $aff['id_liv'].'dec_sain'; ?>" ><?php echo $aff['num_decliv'] ?></td>
     <span style="display: none;"  id="<?php echo $aff['id_liv'].'id_dec_sain'; ?>">   <?php echo $aff['dec_liv'] ?> </span>
         <span style="display: none;"  id="<?php echo $aff['id_liv'].'id_rel_sain'; ?>">   <?php  echo $aff['relache_liv'] ?> </span>
             <span  style="display: none;" id="<?php echo $aff['id_liv'].'id_bl_fournisseur_sain'; ?>"><?php echo $aff['bl_fournisseur_liv'] ?></span>
  <td  class="colaffiches" id="<?php echo $aff['id_liv'].'rel_sain'; ?>" ><?php //echo $aff['num_relache'] ?> <?php  echo $aff['relache_liv'] ?> </td>
  <td  class="colaffiches" id="<?php echo $aff['id_liv'].'bl_simar_sain'; ?>" ><?php echo $aff['bl_simar'] ?></td>
  <td  class="colaffiches" id="<?php echo $aff['id_liv'].'bl_fournisseur_sain'; ?>" ><?php echo $aff['numero_bon'] ?> <a data-bs-toggle="modal" data-bs-target="#detail_bon"<?php   echo $aff['id_liv']; ?>><i class="fas fa-eye"> </i></a></td>
  <td  class="colaffiches" id=<?php echo $aff['id_liv'].'camion_sain'; ?> ><?php echo $aff['camion_liv'] ?></td>
  <td  class="colaffiches" id="<?php echo $aff['id_liv'].'chauffeur_sain'; ?>" ><?php echo $aff['chauffeur_liv'] ?></td>
  <span style="display: none;" id="<?php echo $aff['id_liv'].'id_dis_sain'; ?>">   <?php echo $aff['id_dis_liv'] ?> </span>
   <span style="display: none;" id="<?php echo $aff['id_liv'].'id_produit_sain'; ?>">   <?php echo $aff['id_produit'] ?> </span>
   <span style="display: none;" id="<?php echo $aff['id_liv'].'poids_sac_sain'; ?>">   <?php echo $aff['poids_kg'] ?> </span>
   <span style="display: none;" id="<?php echo $aff['id_liv'].'id_destination_sain'; ?>">   <?php echo $aff['id_mangasin'] ?> </span>
   <span style="display: none;" id="<?php echo $aff['id_liv'].'id_navire_sain'; ?>">   <?php echo $aff['id_navire'] ?> </span>


  <td  class="colaffiches" id="<?php echo $aff['id_liv'].'sac_sain'; ?>" ><?php echo $aff['sac_liv'] ?></td>
  <td  class="colaffiches" ><?php echo $aff['poids_liv'] ?> </td>

 
  <td class="cacher_cellule"  style="vertical-align: middle; text-align: center; " >
  
   <div style="display: flex; justify-content: center;">

 <a class="fabtn"  data-roles='update_livraison_sain' data-id="<?php echo $aff['id_liv'];  ?>" > <i class="fa fa-edit "  ></i></a>


<a  class="fabtn" target="blank" href="fichier_livraison_sain.php?id=<?php echo $aff['id_liv']; ?>"   >
  <i class="fa fa-eye " ></i> 
</a>

<a    id="<?php echo $aff['id_liv'] ?>" name="delete"   class="fabtn1 " onclick="delete_livraison_sain(<?php echo $aff['id_liv'] ?>)" > <i class="fa fa-trash  " ></i> </a>
</div>
</td>

<div class="modal fade" id="detail_bon"<?php echo $aff['id_liv']; ?> tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog">
    <div class="modal-content" style="text-align: center !important;">
            <div class="modal-header" style="background: white !important; border:none !important; text-align: center !important; height: 60px !important;">
              <center>
              
                <h6  style="text-align:center !important; color:blue !important;   ">INFORMATION SUR LE BON
                  <span style="color: red;"> <?php echo $aff['num_enleve'] ?>  </span></h6></center>
              
      </div>


  <div class="modal-body">
    <center>  

  <span>destination</span>  <span style="color: red;"><?php echo $aff['destinations'] ?> </span>
  <br>  
   <span>destinataire</span>  <span style="color: red;"><?php echo $aff['destinataires'] ?> </span>
   </center>

</div>




</tr>
<?php } ?> 

<?php  
if(!empty($aff['date_liv']) and empty($aff['id_liv'])){
    ?>

<tr style="background: black; color: white; text-align: center; vertical-align: middle; ">
  <td style="color: white;" class="sous_tatal_livraison" colspan="8"> TOTAL <?php echo $aff['date_liv'] ?></td>
 
  <td style="color: white;" class="sous_tatal_livraison" ><?php echo $aff['sum(liv.sac_liv)'] ?></td>
  <td style="color: white;" class="sous_tatal_livraison" ><?php echo $aff['sum(liv.poids_liv)'] ?></td>
   <td style="color: white;" class="sous_tatal_livraison" ></td>
  

</tr>
<?php } ?> 



<?php } 

}

//FERMETURE FUNCTION
?> 

<?php    
      function affichage_livraison_mouille($bdd,$produit,$poids_sac,$navire,$destination){

 ?>
      <?php
       $affiche_mo=afficher_livraison_mouille($bdd,$produit,$poids_sac,$navire,$destination);

   while ($aff=$affiche_mo->fetch()){
 if(!empty($aff['date_mo']) and !empty($aff['id_mo'])){
    ?>

<tr style="vertical-align: middle;">
  <td class="colaffiche" id="<?php echo $aff['id_mo'].'date_mouille'; ?>" ><?php echo $aff['date_mo'] ?></td>
  <td class="colaffiche" id="<?php echo $aff['id_mo'].'heure_mouille'; ?>" ><?php echo $aff['heure_mo'] ?></td>
    <td class="colaffiche" id="<?php echo $aff['id_mo'].'dec_mouille'; ?>" ><?php echo $aff['num_decliv'] ?></td>
  <td class="colaffiche" id="<?php echo $aff['id_mo'].'rel_mouille'; ?>" ><?php echo $aff['num_relache'] ?></td>
  <span style="display: none;" id="<?php echo $aff['id_mo'].'id_dec_mouille'; ?>" ><?php echo $aff['dec_mo'] ?></span>
  <span style="display: none;" id="<?php echo $aff['id_mo'].'id_rel_mouille'; ?>" ><?php echo $aff['relache_mo'] ?></span>
  <span style="display: none;" id="<?php echo $aff['id_mo'].'id_bl_fournisseur_mouille'; ?>" ><?php echo $aff['bl_fournisseur_mo'] ?></span>
  <span style="display: none;" id="<?php echo $aff['id_mo'].'id_dis_mouille'; ?>" ><?php echo $aff['id_dis_mo'] ?></span>
  <td class="colaffiche" ><?php echo $aff['bl_simar_mo'] ?></td>
  <td class="colaffiche" id="<?php echo $aff['id_mo'].'bl_fournisseur_mouille'; ?>"><?php echo $aff['num_enleve'] ?></td>
  <td class="colaffiche" id="<?php echo $aff['id_mo'].'camion_mouille'; ?>" ><?php echo $aff['camion_mo'] ?></td>
  <td class="colaffiche" id="<?php echo $aff['id_mo'].'chauffeur_mouille'; ?>"><?php echo $aff['chauffeur_mo'] ?></td>

  <td class="colaffiche" id="<?php echo $aff['id_mo'].'sac_mouille'; ?>" ><?php echo $aff['sac_mo'] ?></td>
  <td class="colaffiche" ><?php echo $aff['poids_mo'] ?></td>

   <td class="cacher_cellule"  style="vertical-align: middle; text-align: center; " >
  
   <div style="display: flex; justify-content: center;">

 <a class="fabtn"  data-roles='update_livraison_mouille' data-id="<?php echo $aff['id_mo'];  ?>" > <i class="fa fa-edit "  ></i></a>


<a  class="fabtn" target="blank" href="fichier_livraison_mouille.php?id=<?php echo $aff['id_mo']; ?>"   >
  <i class="fa fa-eye " ></i> 
</a>

<a    id="<?php echo $aff['id_mo'] ?>" name="delete"   class="fabtn1 " onclick="delete_livraison_mouille(<?php echo $aff['id_mo'] ?>)" > <i class="fa fa-trash  " ></i> </a>
</div>
</td>


</tr>
<?php } ?> 

<?php  
if(!empty($aff['date_mo']) and empty($aff['id_mo'])){
    ?>

<tr style="background: black; color: white; text-align: center; vertical-align: middle; ">

  <td style="color: white;"  class="colaffiche" colspan="8"> TOTAL <?php echo $aff['date_mo'] ?></td>
 
  <td style="color: white;" class="colaffiche" ><?php echo $aff['sum(liv.sac_mo)'] ?></td>
  <td style="color: white;" class="colaffiche" ><?php echo $aff['sum(liv.poids_mo)'] ?></td>
   <td style="color: white;" class="colaffiche" ></td>
  

</tr>
<?php } ?> 



<?php } 

} //FERMETURE ?> 

<?php  
   function affichage_livraison_balayure($bdd,$produit,$poids_sac,$navire,$destination){

 ?>
   <?php
       $affiche_bal=afficher_livraison_balayure($bdd,$produit,$poids_sac,$navire,$destination);
    
    while ($aff=$affiche_bal->fetch()){
 if(!empty($aff['date_bal']) and !empty($aff['id_bal'])){
    ?>

<tr style="vertical-align: middle;">
  <td class="colaffiches" id="<?php echo $aff['id_bal'].'date_bal' ?>" ><?php echo $aff['date_bal'] ?></td>
  <td class="colaffiches" id="<?php echo $aff['id_bal'].'heure_bal' ?>" ><?php echo $aff['heure_bal'] ?></td>
    <td class="colaffiches" id="<?php echo $aff['id_bal'].'dec_bal' ?>" ><?php echo $aff['num_decliv'] ?></td>
  <td class="colaffiches" id="<?php echo $aff['id_bal'].'rel_bal' ?>" ><?php echo $aff['num_relache'] ?></td>
  <td class="colaffiches" ><?php echo $aff['bl_simar_bal'] ?></td>
  <td class="colaffiches" id="<?php echo $aff['id_bal'].'bl_fournisseur_bal' ?>" ><?php echo $aff['num_enleve'] ?></td>

<span class="colaffiches" id="<?php echo $aff['id_bal'].'id_dec_bal' ?>" ><?php echo $aff['dec_bal'] ?></span>
  <sapn class="colaffiches" id="<?php echo $aff['id_bal'].'id_rel_bal' ?>" ><?php echo $aff['relache_bal'] ?></sapn>
  
  <span class="colaffiches" id="<?php echo $aff['id_bal'].'id_bl_fournisseur_bal' ?>" ><?php echo $aff['bl_fournisseur_bal'] ?></span>
  <span class="colaffiches" id="<?php echo $aff['id_bal'].'id_dis_bal' ?>" ><?php echo $aff['id_dis_bal'] ?></span>
  

  <td class="colaffiches" id="<?php echo $aff['id_bal'].'camion_bal' ?>" ><?php echo $aff['camion_bal'] ?></td>
  <td class="colaffiches" id="<?php echo $aff['id_bal'].'chauffeur_bal' ?>" ><?php echo $aff['chauffeur_bal'] ?></td>

  <td class="colaffiches" id="<?php echo $aff['id_bal'].'sac_bal' ?>" ><?php echo $aff['sac_bal'] ?></td>
  <td class="colaffiches" ><?php echo $aff['poids_bal'] ?></td>

  <td class="cacher_cellule"  style="vertical-align: middle; text-align: center; " >
  
   <div style="display: flex; justify-content: center;">

 <a class="fabtn"  data-roles='update_livraison_balayure' data-id="<?php echo $aff['id_bal'];  ?>" > <i class="fa fa-edit "  ></i></a>


<a  class="fabtn"target="blank" href="fichier_livraison_balayure.php?id=<?php echo $aff['id_bal']; ?>"    >
  <i class="fa fa-eye " ></i> 
</a>

<a    id="<?php echo $aff['id_bal'] ?>" name="delete"   class="fabtn1 " onclick="delete_livraison_balayure(<?php echo $aff['id_bal'] ?>)" > <i class="fa fa-trash  " ></i> </a>
</div>
</td>

</tr>
<?php } ?> 

<?php  
if(!empty($aff['date_bal']) and empty($aff['id_bal'])){
    ?>

<tr style="background: black; color: white; text-align: center; vertical-align: middle; ">
  <td style="color: white;" class="sous_tatal_livraison" colspan="8"> TOTAL <?php echo $aff['date_bal'] ?></td>
 
  <td style="color: white;" class="sous_tatal_livraison" ><?php echo $aff['sum(liv.sac_bal)'] ?></td>
  <td style="color: white;" class="sous_tatal_livraison" ><?php echo $aff['sum(liv.poids_bal)'] ?></td>
   <td style="color: white;" class="sous_tatal_livraison" ></td>
  

</tr>
<?php } ?> 



<?php } 

} //FERMETURE FUNCTION ?> 

<?php  
  function bouton_avaries_livraison($bdd,$produit,$poids_sac,$navire,$destination){
    $selectid_dis=$bdd->prepare("SELECT dis.id_produit,dis.poids_kg,dis.id_mangasin,nc.id_navire, liv.dec_liv,ds.id_decliv,liv.*,ex.id_trans_extends from livraison_sain as liv
      inner join declaration_sortie as ds on ds.id_decliv=liv.dec_liv
      inner join transit_extends as ex on ex.id_trans_extends=ds.id_dec_entrant


    inner join dispat as dis on dis.id_dis=ex.id_bl_extends
    inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
     WHERE dis.id_produit=? and dis.poids_kg=? and nc.id_navire=? and dis.id_mangasin=?");

 $selectid_dis->bindParam(1,$produit);
        $selectid_dis->bindParam(2,$poids_sac);
        $selectid_dis->bindParam(3,$navire);
         $selectid_dis->bindParam(4,$destination);
        $selectid_dis->execute();

        return $selectid_dis;
      }

      

      function afficher_avaries_livraison($bdd,$produit,$poids_sac,$navire,$destination){

$avaries_rep=$bdd->prepare("SELECT dis.id_produit,dis.poids_kg,dis.id_mangasin,nc.id_navire,  avl.*,sum(avl.sac_flasque_liv),sum(avl.sac_mouille_liv),ds.id_decliv,ex.id_trans_extends from avaries_de_livraison as avl
   inner join declaration_sortie as ds on ds.id_decliv=avl.id_declaration_av_liv
      inner join transit_extends as ex on ex.id_trans_extends=ds.id_dec_entrant

    inner join dispat as dis on dis.id_dis=ex.id_bl_extends
    inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
 WHERE dis.id_produit=? and dis.poids_kg=? and nc.id_navire=? and dis.id_mangasin=? group by avl.date_liv, avl.id_liv with rollup ");
  $avaries_rep->bindParam(1,$produit);
        $avaries_rep->bindParam(2,$poids_sac);
        $avaries_rep->bindParam(3,$navire);
         $avaries_rep->bindParam(4,$destination);
        $avaries_rep->execute();

        return $avaries_rep;
    }

    function affichage_avaries_livraison($bdd,$produit,$poids_sac,$navire,$destination){

    ?>

    <?php $avaries_rep=afficher_avaries_livraison($bdd,$produit,$poids_sac,$navire,$destination);

 while($av=$avaries_rep->fetch()){ 
if(!empty($av['id_liv']) and !empty($av['date_liv'])){
  //$d1=explode('-',$av['date_avr']);
 //$d=$d1[2].'-'.$d1[1].'-'.$d1[0];
  $total_avaries=$av['sac_flasque_liv']+$av['sac_mouille_liv'];
  $d=date("d-m-Y",strtotime($av['date_liv']));

  ?> 

  <tr style="text-align: center; vertical-align: middle; background: white;">
   <td  ><?php echo $d; ?></td> 
  
   <td  ><?php echo $av['sac_flasque_liv'] ?></td>
   <td  ><?php echo $av['sac_mouille_liv'] ?></td>
   <td  ><?php echo $total_avaries; ?></td>
   
  </tr>
<?php } ?>

<?php if(empty($av['id_liv']) and !empty($av['date_liv'])){ 

$sous_total_avaries=$av['sum(avl.sac_flasque_liv)']+$av['sum(avl.sac_mouille_liv)'];
  ?>
  <tr style="background: red; color:white; text-align: center; vertical-align: middle;">
  <td >TOTAL <?php echo $d; ?></td>
     <td><?php echo $av['sum(avl.sac_flasque_liv)'] ?></td>
   <td><?php echo $av['sum(avl.sac_mouille_liv)'] ?></td> 
   <td><?php echo $sous_total_avaries ?></td> 
   
   </tr>

<?php } ?>

<?php if(empty($av['id_liv']) and empty($av['date_liv'])){ 

$sum_total_avaries=$av['sum(avl.sac_flasque_liv)']+$av['sum(avl.sac_mouille_liv)'];
  ?>
  <tr style="background: black; color:white;  text-align: center; vertical-align: middle;">
  <td style="color:white;" >TOTAL</td>
     <td style="color:white;"><?php echo $av['sum(avl.sac_flasque_liv)'] ?></td>
   <td style="color:white;"><?php echo $av['sum(avl.sac_mouille_liv)'] ?></td> 
   <td style="color:white;"><?php echo $sum_total_avaries; ?></td> 
  
   </tr>

<?php } } 

 } //FERMETURE FUNCTION
?>


<?php  
  function afficher_recond_livraison($bdd,$produit,$poids_sac,$navire,$destination){
    $recond=$bdd->prepare("SELECT 
    dis.id_produit, dis.poids_kg, dis.id_mangasin, nc.id_navire, rl.*,
    SUM(rl.sac_eventres_liv) OVER (ORDER BY rl.id_recond_liv) AS cumulative_sum,
    ex.id_trans_extends
FROM
    reconditionnement_livraison AS rl
INNER JOIN declaration_sortie AS ds ON ds.id_decliv = rl.id_declaration_recliv
INNER JOIN transit_extends AS ex ON ex.id_trans_extends = ds.id_dec_entrant
INNER JOIN dispat AS dis ON dis.id_dis = ex.id_bl_extends
INNER JOIN numero_connaissement AS nc ON nc.id_connaissement = dis.id_con_dis
WHERE 
    dis.id_produit = ? 
    AND dis.poids_kg = ? 
    AND nc.id_navire = ? 
    AND dis.id_mangasin =?");

  $recond->bindParam(1,$produit);
         $recond->bindParam(2,$poids_sac);
         $recond->bindParam(3,$navire);
          $recond->bindParam(4,$destination);
         $recond->execute();

        return $recond;
      }

       function somme_avaries_livraison($bdd,$produit,$poids_sac,$navire,$destination){

$somme_avaries=$bdd->prepare("SELECT dis.id_produit,dis.poids_kg,dis.id_mangasin,nc.id_navire,  avl.*,sum(avl.sac_flasque_liv),sum(avl.sac_mouille_liv),ds.id_decliv,ex.id_trans_extends from avaries_de_livraison as avl
   inner join declaration_sortie as ds on ds.id_decliv=avl.id_declaration_av_liv
      inner join transit_extends as ex on ex.id_trans_extends=ds.id_dec_entrant

    inner join dispat as dis on dis.id_dis=ex.id_bl_extends
    inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
 WHERE dis.id_produit=? and dis.poids_kg=? and nc.id_navire=? and dis.id_mangasin=?  ");
  $somme_avaries->bindParam(1,$produit);
        $somme_avaries->bindParam(2,$poids_sac);
        $somme_avaries->bindParam(3,$navire);
         $somme_avaries->bindParam(4,$destination);
        $somme_avaries->execute();

        return $somme_avaries;
    }

?>

<?php function afficher_gestion_des_relaches($bdd,$produit,$poids_sac,$navire,$destination){
    $affiche_etat_relache=$bdd->prepare(" SELECT er.*, sum(er.quantite_relacher),bn.*,br.*,rel.*,dis.id_dis,nc.id_navire,liv.id_liv from etat_relache as er
        inner join livraison_sain as liv on liv.id_liv=er.id_liv
        inner join bon_relache as br on br.id_bon_relache=er.bon_relache_id 
        inner join bon as bn on bn.id_bon=br.bon_id
        inner join dispat as dis on dis.id_dis=bn.bon_id_dis
        inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
        inner join relaches as rel on rel.id_relache=br.relache_id
       WHERE dis.id_produit=? and dis.poids_kg=? and nc.id_navire=? and dis.id_mangasin=? group by er.bon_relache_id ");
      $affiche_etat_relache->bindParam(1,$produit);
        $affiche_etat_relache->bindParam(2,$poids_sac);
        $affiche_etat_relache->bindParam(3,$navire);
         $affiche_etat_relache->bindParam(4,$destination);
        $affiche_etat_relache->execute();
        return $affiche_etat_relache;
}


function affichage_gestion_des_relaches($bdd,$produit,$poids_sac,$navire,$destination){
  $affiche_etat_relache= afficher_gestion_des_relaches($bdd,$produit,$poids_sac,$navire,$destination);
  while($aff=$affiche_etat_relache->fetch()){


 ?>
 <tr style="color:black; text-align: center; vertical-align: middle;">
     <td><?php echo $aff['numero_relache'] ?></td>
     <td><?php echo $aff['sum(er.quantite_relacher)'] ?></td>
 </tr>
 <?php  
 }
  }
  ?>


  
  
  