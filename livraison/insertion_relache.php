<?php   
require("../database.php");
require("controller/remplacer_relache.php");

if(isset($_POST['date'])){

  $date=$_POST['date'];
  $num=$_POST['num'];
  $banque=$_POST['banque'];
  $id_dis=$_POST['id_dis'];
  $c=$id_dis;
  $navire=$_POST['navire'];
  $poids=$_POST['poids'];

  $somme_relache=$bdd->prepare("SELECT sum(poids_rel) from relache where id_dis_rel=?");
  $somme_relache->bindParam(1,$c);
  $somme_relache->execute();
  $som_rel=$somme_relache->fetch();

  $p_manifest=$bdd->prepare("SELECT poids_t FROM dispatching where id_dis=?");
   $p_manifest->bindParam(1,$c);
   $p_manifest->execute();
  $p_manif=$p_manifest->fetch();

  $controle_relache=$p_manif['poids_t']-$som_rel['sum(poids_rel)']-$poids;


if($controle_relache>=0){

  $insert=$bdd->prepare("INSERT INTO relache(date_rel,num_rel,poids_rel,id_banque_rel,id_dis_rel,id_navire_rel) VALUES(?,?,?,?,?,?)");
  $insert->bindParam(1,$date);
  $insert->bindParam(2,$num);
  $insert->bindParam(3,$poids);
  $insert->bindParam(4,$banque);
  $insert->bindParam(5,$c);
  $insert->bindParam(6,$navire);
  $insert->execute();

  $select_id=$bdd->query("SELECT max(id_rel) from relache");
  $sel_id=$select_id->fetch();

  $id_replace=$sel_id['max(id_rel)'];

  
     

  
$liv_som_rel_simar=$bdd->prepare("SELECT id_liv
     FROM (
         SELECT id_liv, SUM(poids_liv) OVER (ORDER BY id_liv) AS cumulative_sum
         FROM livraison_sain
         WHERE id_dis_liv = ? AND relache_liv = 7
         ) AS subquery
           WHERE cumulative_sum <= ?
          ORDER BY id_liv DESC
                        LIMIT 1  ");
      $liv_som_rel_simar->bindParam(1,$c);
     
      $liv_som_rel_simar->bindParam(2,$poids);
      $liv_som_rel_simar->execute();
    

while($liv3=$liv_som_rel_simar->fetch()){
   
 
 
    $id3=$liv3['id_liv'];
    echo $id3;
   // echo $liv3['cumulative_sum'];
    echo $id_replace;
  $update_relache=$bdd->prepare("UPDATE livraison_sain set relache_liv=? WHERE
   id_dis_liv=? and relache_liv=7 and id_liv<=? ");
      $update_relache->bindParam(1,$id_replace);
      $update_relache->bindParam(2,$c);
      $update_relache->bindParam(3,$id3);

    $update_relache->execute();
     
    
  
}

 



  }

   

 ?>

<?php if($controle_relache<0){
 ?>

 <center><div  class="err" id="LesErreurs" ><a  type="button" class="btn-close"  id="close_erreur" data-role="fermer" ></a><h3 id="perreur" > ERREUR</h3>
 <h5 id="perreur"> Vous ne pouvez pas ajouter une nouvelle relache de   <span style="color: black">  <?php  echo $poids.' Tonnes' ?></span>  </h5></div></center>
<?php } ?>

 <div class="container-fluid" class="" id="TableRelache"   >
      <div class="row">
<br>

 <center>
      <div class="col-md-12 col-lg-12">      
<a  class="btn1"  style="background: rgb(65,180,190); " data-bs-toggle="modal" data-bs-target="#form_relache" >AJOUTER RELACHE  </a>
<br>
</div>  <br>
              
      <div   class="table-responsive" border=1>
          
  
 <table  class='table table-hover table-bordered table-striped'  border='2' style="width: 50%; " id='tabledec1'>
    
      <?php $recap_Relache=$bdd->prepare("SELECT rel.*, sum(liv.sac_liv), sum(liv.poids_liv) from relache as rel
      left join livraison_sain as liv on rel.id_rel=liv.relache_liv 
      WHERE rel.id_dis_rel=? GROUP BY rel.num_rel,rel.id_rel order by rel.id_rel");
   $recap_Relache->bindParam(1,$c);
   $recap_Relache->execute();

           
          $relacheT=$bdd->prepare("SELECT sum(poids_rel) from relache 
      WHERE id_dis_rel=? ");
   $relacheT->bindParam(1,$c);
   $relacheT->execute();

            $livraisonT=$bdd->prepare("SELECT sum(poids_liv) from livraison_sain 
      WHERE id_dis_liv=? ");
   $livraisonT->bindParam(1,$c);
   $livraisonT->execute();
   
 
      ?>
         <td  class="titreAVR" colspan="6"  >SITUATION DES RELACHES</td>
         <?php  
          $infos_rel=$bdd->prepare("SELECT dis.poids_kg, dis.n_bl,  p.*, mg.mangasin, nav.navire, nav.type,cli.client,b.banque
         from dispatching as dis
         inner join produit_deb as p on p.id=dis.id_produit
         inner join navire_deb as nav on nav.id=dis.id_navire
         inner join mangasin as mg on mg.id=dis.id_mangasin
         inner join client as cli on cli.id=dis.id_client
         left join banque as b on b.id=dis.id_banque_dis
         where dis.id_dis=?
         ");
        $infos_rel->bindParam(1,$c);
        $infos_rel->execute();
       

       if($inf=$infos_rel->fetch()){

     ?>
      <tr class="entete_relache"    >
     <td style="border: none;" >NAVIRE: <span id="lesInfos"> <?php echo $inf['navire']; ?></span></td>
      <td >TYPE:<span id="lesInfos"> <?php echo $inf['type']; ?></span></td>
      <td  >PRODUIT:<span id="lesInfos"> <?php echo $inf['produit']; ?> <?php echo $inf['qualite']; ?> </span></td>
        <td >CONDITIONNEMENT:<span id="lesInfos"> <?php echo $inf['poids_kg'].' KG';; ?></span></td>
        <td  >CONNAISSEMENT:<span id="lesInfos"> <?php echo $inf['n_bl']; ?></span></td>

         
          </tr>
         <tr class="entete_relache"    >
          <td >ENTREPOT:<span id="lesInfos"> <?php echo $inf['mangasin']; ?></span></td>
          <td colspan="2"  >RECEPTIONNAIRE:<span id="lesInfos"> <?php echo $inf['client']; ?></span></td>
          <td colspan="2"  >BANQUE:<span id="lesInfos"> <?php echo $inf['banque']; ?></span></td>
        </tr>
           
       
<?php } ?>
            <tr id="entete_table_relache"  >
              <td  style="">POIDS MANIFEST</td>
              <td   >N° RELACHE</td>
              
              <td  >QUANTITE RELACHE</td>
              <td  >BALANCE</td>
             
               <td  >RESTE A LIVRER SUR RELACHE</td>

            </tr>

          <?php 
          $recap_Relacherow=$bdd->prepare("SELECT rel.*, sum(liv.sac_liv), sum(liv.poids_liv) from relache as rel
      left join livraison_sain as liv on rel.id_rel=liv.relache_liv 
      WHERE rel.id_dis_rel<=? GROUP BY rel.num_rel,rel.id_rel");
   $recap_Relacherow->bindParam(1,$c);
   $recap_Relacherow->execute();

             $compte_relache=$bdd->prepare("SELECT count(num_rel) from relache where id_dis_rel=?");
   $compte_relache->bindParam(1,$c);
   $compte_relache->execute();

            


          while($recapl=$recap_Relache->fetch()){
             $manifest=$bdd->prepare("SELECT poids_t from dispatching where id_dis=?");
             $manifest->bindParam(1,$c);
             $manifest->execute();
           $manif=$manifest->fetch();

            $relache_inferieur=$bdd->prepare("SELECT sum(poids_rel) from relache where id_dis_rel=? and id_rel<=?");
             $relache_inferieur->bindParam(1,$c);
             $relache_inferieur->bindParam(2,$recapl['id_rel']);
             $relache_inferieur->execute();
           $relinf=$relache_inferieur->fetch();



            $reste_relache=$recapl['poids_rel']-$recapl['sum(liv.poids_liv)'];
            $balance=$manif['poids_t']-$relinf['sum(poids_rel)'];

            $Sains0 = $bdd->prepare("SELECT poids_sac_recep,  sum(sac_recep), sum(poids_recep)  from reception
                   WHERE id_dis_recep_bl=? ");
               $Sains0->bindParam(1,$c);
        $Sains0->execute();

     /*   $SainsL0 = $bdd->prepare("SELECT poids_sac_liv,  sum(sac_liv), sum(poids_liv)  from livraison_sain
                   WHERE id_dis_liv=? ");
               $SainsL0->bindParam(1,$c);
        $SainsL0->execute(); */

      $recond_DEPART0 = $bdd->prepare("SELECT count(sac_av_recond), sum(sac_av_recond), sum(poids_av_recond),sum(sac_balayure_recond), sum(poids_balayure_recond)  from reconditionnement_reception
                   WHERE id_dis_recond=? ");
        
        
        $recond_DEPART0 ->bindParam(1,$c);
        $recond_DEPART0 ->execute();

                  $SomAvr_DEPART0 = $bdd->prepare("SELECT  sum(sac_flasque_avr),sum(sac_mouille_avr) from avaries_de_reception
                   WHERE id_dis_avr=? ");

      /*            $recond_DEPARTL0 = $bdd->prepare("SELECT count(sac_av_recond_liv), sum(sac_av_recond_liv), sum(poids_av_recond_liv),sum(sac_balayure_recond_liv), sum(poids_balayure_recond_liv)  from reconditionnement_livraison
                   WHERE id_dis_recond_liv=? ");
        
        
        $recond_DEPARTL0 ->bindParam(1,$c);
        $recond_DEPARTL0 ->execute(); */
        
        
        $SomAvr_DEPART0->bindParam(1,$c);
        $SomAvr_DEPART0->execute(); 

       /*                $SomAvl_DEPARTL0 = $bdd->prepare("SELECT  sum(sac_flasque_liv),sum(sac_mouille_liv) from avaries_de_livraison
                   WHERE id_dis_liv=? ");
        
        
        $SomAvl_DEPARTL0->bindParam(1,$c);
        $SomAvl_DEPARTL0->execute(); */





                          $SomRa_DEPART0 = $bdd->prepare("SELECT  sum(sac_flasque_ra),sum(sac_mouille_ra),sum(poids_flasque_ra),sum(poids_mouille_ra) from reception_avaries
                   WHERE id_dis_bl_ra=? ");
        
        
        $SomRa_DEPART0->bindParam(1,$c);
        $SomRa_DEPART0->execute();


       $sain=$Sains0->fetch();
            $avr=$SomAvr_DEPART0->fetch();
  //  $avl=$SomAvl_DEPARTL0->fetch();
   // $sainl=$SainsL0->fetch();
//$ra=$SomRa_DEPART->fetch();
$rec=$recond_DEPART0->fetch();
// $recl=$recond_DEPARTL0->fetch();
 $ra=$SomRa_DEPART0->fetch();

 $poidsf_avr=$avr['sum(sac_flasque_avr)']*$sain['poids_sac_recep']/1000;
$SacSain=$sain['sum(sac_recep)']-$avr['sum(sac_flasque_avr)']-$avr['sum(sac_mouille_avr)']-$ra['sum(sac_flasque_ra)']-$ra['sum(sac_mouille_ra)']+$rec['sum(sac_av_recond)'];
$poidsSain=$SacSain*$sain['poids_sac_recep']/1000;
$poidsflasque=$poidsf_avr+$ra['sum(poids_flasque_ra)'];
$SacMouille=$avr['sum(sac_mouille_avr)']+$ra['sum(sac_mouille_ra)'];
$poidsMouille=$SacMouille*$sain['poids_sac_recep']/1000;

$total_sac=$SacSain+$SacMouille+$rec['sum(sac_balayure_recond)'];
$total_poids=$poidsSain+$poidsMouille+$rec['sum(poids_balayure_recond)'];


/*
$poidsf_avrL=$avr['sum(sac_flasque_avr)']*$sain['poids_sac_recep']/1000;
$SacSainL=$SacSain - $sainl['sum(sac_liv)']-$avl['sum(sac_flasque_liv)']-$avl['sum(sac_mouille_liv)']+$recl['sum(sac_av_recond_liv)'];
$poidsSainL=$SacSainL*$sain['poids_sac_recep']/1000;
$poidsflasqueL=$poidsf_avrL;
$SacMouilleL=$avl['sum(sac_mouille_liv)'];
$poidsMouilleL=$SacMouilleL*$sain['poids_sac_recep']/1000; */

//$total_sacL=$SacSainL+$SacMouilleL+$recl['sum(sac_balayure_recond_liv)'];
/*
$total_sacL=$SacSainL+$SacMouilleL+$recl['sum(sac_balayure_recond_liv)'] ;
$total_poidsL=$poidsSainL+$poidsMouilleL+$recl['sum(poids_balayure_recond_liv)']; */





             ?>
   <tr style="vertical-align: middle; text-align: center ; color: red; background: white;" >
    <?php if($com=$compte_relache->fetch()){ ?>
    <td rowspan="<?php echo $com['count(num_rel)']; ?>"><?php echo $manif['poids_t'] ?></td>
  <?php } ?>
     <td><?php echo $recapl['num_rel'] ?></td>
    
     <td><?php echo $recapl['poids_rel'] 
      ?></td>
     <td><?php echo $balance ?></td>
     <td><?php echo $reste_relache  ?></td>
     
   </tr>
 <?php } ?>
   <?php while($relT=$relacheT->fetch()){
                      $manifestT=$bdd->prepare("SELECT poids_t from dispatching where id_dis=?");
             $manifestT->bindParam(1,$c);
             $manifestT->execute();
           $manifT=$manifestT->fetch();

                $relache_inferieurT=$bdd->prepare("SELECT sum(poids_rel) from relache where id_dis_rel=? ");
             $relache_inferieurT->bindParam(1,$c);
  
             $relache_inferieurT->execute();
           $relinfT=$relache_inferieurT->fetch();
    $livT=$livraisonT->fetch(); 
    $reste_relacheT=$relT['sum(poids_rel)']-$livT['sum(poids_liv)'];
    $balanceT=$manifT['poids_t']-$relinfT['sum(poids_rel)'];


    ?>
    <tr style="background: red; color: white; text-align: center; vertical-align: middle;">
      <td colspan="3"> TOTAL</td>
      <td><?php echo $relT['sum(poids_rel)'] ?></td>
       <td><?php echo $balanceT ?></td>
    <td><?php echo $reste_relacheT ?></td>
 
    </tr>

    <?php  } ?>

 
     
      

          </table>
          </center>
        </div>





</div>
</div>

<?php   } ?>

