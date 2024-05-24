<?php 
require("../database.php");
if(isset($_POST['id'])){

	 $date=$_POST['date'];
	 $d=explode('-', $date);
	 $insertdate=$d[2].'-'.$d[1].'-'.$d[0];
	 $heure=$_POST['heure'];
	 $cale=$_POST['cale'];
	 $declaration=$_POST['declaration'];
	 $camion=$_POST['camion'];
	 $chauffeur=$_POST['chauffeur'];
	 $bl=$_POST['bl'];
	 $c=$_POST['dis_bl'];
	 $sac=$_POST['sac'];
	 $poids_sac=$_POST['poids_sac'];
	 $poids=$_POST['poids'];
	$id=$_POST['id'];
	$update=$bdd->prepare("UPDATE register_manifeste set dates=?, heure=?, bl=?, camions=?, chauffeur=?, id_declaration=?, cale=?, sac=?, poids=?  where id_register_manif=?");
	$update->bindParam(1,$insertdate);
	$update->bindParam(2,$heure);
	$update->bindParam(3,$bl);
	$update->bindParam(4,$camion);
    $update->bindParam(5,$chauffeur);
    $update->bindParam(6,$declaration);
    $update->bindParam(7,$cale);
    $update->bindParam(8,$sac);
    $update->bindParam(9,$poids);
    $update->bindParam(10,$id);


	$update->execute();

 
          $avaries_deb=$bdd->prepare("SELECT p.produit,p.qualite, av.*, sum(av.sac_flasque),sum(av.sac_mouille) FROM avaries as av inner join produit_deb as p on av.id_produit=p.id WHERE av.id_dis_av=? and av.ref=1  GROUP BY av.date_avaries, av.id_avaries WITH ROLLUP");
 $avaries_deb->bindParam(1,$c);
 $avaries_deb->execute();

  $rescaleAvaries= $bdd->prepare("SELECT  *  FROM dispatching 
               

                   WHERE id_dis=? 
                   ");
        $rescaleAvaries->bindParam(1,$c);
        $rescaleAvaries->execute();


        $rob=$bdd->prepare("select dis.*,  rm.*, sum(rm.sac),sum(rm.poids), n.type FROM dispatching as dis
         
          inner  join register_manifeste as rm on  dis.id_produit=rm.id_produit and dis.id_dis=rm.id_dis_bl
          and dis.id_mangasin=rm.id_destination

          and dis.poids_kg=rm.poids_sac and dis.id_navire=rm.id_navire
        inner join navire_deb as n on dis.id_navire=n.id
          
         where  dis.id_dis=?  ");
         $rob->bindParam(1,$c);
         $rob->execute();

         $rob_colone=$bdd->prepare("select n.type , dis.poids_kg, dis.* from dispatching as dis inner join navire_deb as n
         on n.id=dis.id_navire where dis.id_dis=?");
         $rob_colone->bindParam(1,$c);
         $rob_colone->execute();
         

         $rob_dec=$bdd->prepare("SELECT trans.poids_declarer, trans.numero_declaration, sum(rm.sac), sum(rm.poids) from transit as trans left join register_manifeste as rm on trans.id_trans=rm.id_declaration
            
          WHERE trans.id_bl=?  group by trans.numero_declaration");
                   $rob_dec->bindParam(1,$c);
         $rob_dec->execute();

          $rob_dec2=$bdd->prepare("SELECT trans.poids_declarer, trans.numero_declaration,  sum(tr.poids_flasque_tr_av),sum(tr.poids_mouille_tr_av)  from transit as trans  
           left join transfert_avaries as tr on trans.id_trans=tr.id_declaration_tr 
          WHERE trans.id_bl=?  group by trans.numero_declaration");
                   $rob_dec2->bindParam(1,$c);
         $rob_dec2->execute();

          $res3 = $bdd->prepare("SELECT  p.produit,p.qualite,nav.navire,cli.client,mang.mangasin, nav.id, nav.type, dis.*   FROM dispatching as dis 
                
                inner join  produit_deb as p on dis.id_produit=p.id 

                inner join navire_deb as nav on dis.id_navire=nav.id 
                
                inner join client as cli on dis.id_client=cli.id
                inner join mangasin as mang on dis.id_mangasin=mang.id
                

                   WHERE dis.id_dis=? ");
        
        $res3->bindParam(1,$c);
        
        
        $res3->execute();


        $resfiltre = $bdd->prepare("SELECT p.produit,p.qualite,nav.navire,cli.client,mang.mangasin, nav.id, nav.type, dis.*   FROM dispatching as dis 
                
                inner join produit_deb as p on dis.id_produit=p.id 

                inner join navire_deb as nav on dis.id_navire=nav.id 
                
                inner join client as cli on dis.id_client=cli.id
                inner join mangasin as mang on dis.id_mangasin=mang.id
                

                   WHERE dis.id_dis=?  ");
        
        $resfiltre->bindParam(1,$c);
        
        $resfiltre->execute();



        $filtreColonne= $bdd->prepare("SELECT des_douane from dispatching 
                
                   WHERE id_dis=? ");
        $filtreColonne->bindParam(1,$c);
        $filtreColonne->execute();


        $affiche = $bdd->prepare("SELECT p.produit,p.qualite,nav.navire,nav.type,cli.client,mang.mangasin,trp.*,trs.*,ch.*, manif.*, sum(manif.sac),sum(manif.poids),cam.*   FROM register_manifeste as manif 
                
                inner join  produit_deb as p on manif.id_produit=p.id 

                inner join navire_deb as nav on manif.id_navire=nav.id 
                
                inner join client as cli on manif.id_client=cli.id
                inner join mangasin as mang on manif.id_destination=mang.id
                
                left join chauffeur as ch on manif.chauffeur=ch.id_chauffeur 
                left join camions as cam on manif.camions=cam.id_camions
                left join transporteur as trp on cam.id_trans=trp.id
                inner join transit as trs on manif.id_declaration=trs.id_trans

                   WHERE manif.id_dis_bl=? and manif.bl!='ref' group by manif.dates, manif.id_register_manif with rollup ");
        
        
        $affiche->bindParam(1,$c);
        $affiche->execute();

  $afficheT = $bdd->prepare("SELECT poids_t, nombre_sac from dispatching where id_dis=?");             
             $afficheT->bindParam(1,$c);
        $afficheT->execute();

  ?>


 <div class="container-fluid" id="TableSain" >



      <div class="entete_image" style="background-image: url('../images/bg_page.jpg'); background-repeat: no-repeat; background-size: 100%; background-color: blue;  ">
        <center> 
              
        <div   class="table-responsive" border=1>
          
  
 <table  class='table table-hover table-bordered table-striped'  border='2' style="width: 50%; " id='tabledec1'>
         
            <tr id="entete_table_declaration"  >
              <td  scope="col" style="color: white;">N° DECLARATION</td>
              <td  scope="col" style="color: white;">RESTANT SUR DECLARATION</td>
            </tr>
          
     
       <?php 
while($row=$rob_dec->fetch()){
  $row2=$rob_dec2->fetch();

$rob_poids=$row['poids_declarer']-$row['sum(rm.poids)'] -$row2['sum(tr.poids_flasque_tr_av)']-$row2['sum(tr.poids_mouille_tr_av)'];
   ?>
   <tr id="data_table_declaration">
     
 
  <td>       
 <span class="th4" ><?php  
        echo  $row['numero_declaration']
    ?></span></td>
  <td>
            
 <span class="th4" ><?php  
        echo  number_format($rob_poids, 3,',',' ');
    ?></span>
  </td>
    </tr>
    
  <?php  } $rob_dec->closeCursor(); ?>
   </table>
      </div>
       </center>
       
  
        <div  class="table-responsive" border=1 >
          <center>
 <table  class='table table-hover table-bordered table-striped'  border='2' style="width: 50%; " id='tabledec2' >

   
         
            <tr id="entete_table_declaration2" >
              <td colspan="2" scope="col" style="color: white;  ">TOTAL DEB</td>
              <td  colspan="2" style="color: white;">ROB</td>
            </tr>
            <tr id="entete_table_declaration2"> 
            <?php while  ($rcolone=$rob_colone->fetch()){ 
             if($rcolone['type']=="SACHERIE"){ ?> 
            <td style="color: white;"> SACS </td> 
            <td style="color: white;">  POIDS</td>
          <?php }   
                     if($rcolone['type']=="VRAQUIER" and $rcolone['poids_kg']!=0 ){ ?> 
            <td style="color: white;"> SACS </td> 
            <td style="color: white;">  POIDS</td>
          <?php } 
                               if($rcolone['type']=="VRAQUIER" and $rcolone['poids_kg']==0 ){ ?> 
            
            <td colspan="2" style="color: white;">  POIDS</td>
          <?php } 
            

            if($rcolone['type']=="SACHERIE"){ ?>
             <td style="color: white;" id="entete_table_declaration2"> SACS </td> 
            <td style="color: white;" id="entete_table_declaration2">  POIDS</td>
          <?php } ?>
          <?php if($rcolone['type']=="VRAQUIER"){ ?>
             
            <td colspan="2" style="color: white;">  POIDS</td>
          <?php } ?>
        <?php } $rob_colone->closeCursor(); ?>
            </tr>
 <?php 
while($row=$rob->fetch()){
$rob_sac=$row['nombre_sac']-$row['sum(rm.sac)'];
$rob_poids=$row['poids_t']-$row['sum(rm.poids)'];
   ?>
   
   <tr id="data_table_declaration2"> <?php  if($row['type']=='SACHERIE'){ ?>
    <td>  
 <span class="th4" >
          <?php   echo number_format($row['sum(rm.sac)'], 0,',',' '); ?></span></td>
        <td>     
 <span class="th4" ><?php  
        echo $row['sum(rm.poids)'];
    ?></span></td>
    <td> <span class="th4" ><?php   
        echo  number_format($rob_sac, 0,',',' ');  ?>
  </span></td>
          
 <td> <span class="th4" ><?php  
        echo  number_format($rob_poids, 3,',',' ');
    ?></span></td>
  <?php } ?>
       <?php    if($row['type']=='VRAQUIER' and $row['poids_kg']!=0){ ?>
         <td>  <span class="th4" >
        <?php  
        echo number_format($row['sum(rm.sac)'], 0,',',' '); ?>
         </span></td>
         
         <td>  <span class="th4" >
        <?php  
        echo number_format($row['sum(rm.poids)'], 3,',',' '); ?>
         </span></td>         

     <td> <span class="th4" ><?php   
        echo  number_format($rob_sac, 0,',',' ');  ?>
  </span></td>
          
 <td> <span class="th4" ><?php  
        echo  number_format($rob_poids, 3,',',' ');
    ?></span></td>
      
   <?php } 
     ?>

      <?php    if($row['type']=='VRAQUIER' and $row['poids_kg']==0){ ?>
         <td>     
 <span class="th4" ><?php  
        echo $row['sum(rm.poids)'];
    ?></span></td>

        <td colspan="2"> 
                 
 <span class="th4" ><?php  
        echo $row['sum(rm.poids)'];
    ?></span></td>
      
   <?php } 
     ?>
 
         
 

  
   </tr>

  <?php } $rob->closeCursor(); ?>

          </table>
          </center>
        </div>

  

  </div>





  <div class="col-md-12 col-lg-12">      
<button id="insertion_sain" type="submit" class="btn1" data-bs-toggle="modal" data-bs-target="#enregistrement" >Insertion </button>


</div>

<div class="table-responsive" border=1 id="tableau_sain">
<?php


 echo " <table class='table table-hover table-bordered table-striped table-responsive' id='table_register' border='2' >";
    
?> 
 <thead style="background-color: rgba(50, 159, 218, 0.9);">
  <td  colspan="14" class="titreSAIN"  >TRANSFERT DES SACS SAINS</td>

  <?php while($row3=$res3->fetch()) {?>
  
  

    <tr style="text-align: center; vertical-align: middle; " >
      <div style="display: flex; justify-content: center;"> 
       <td id="eliminer_border"  colspan="3"> 
 <span class="titre_entete" > NAVIRE:</span>        
    <span class="contenu_entete"><?php echo $row3['navire'];?></span>
    </td>
     <td id="eliminer_border" colspan="3"> 
 <span class="titre_entete" > CONNAISSEMENT:</span>        
    <span class="contenu_entete"><?php echo $row3['n_bl'];?></span>
    </td>
     <td id="eliminer_border" colspan="4"><span class="titre_entete" > PRODUIT:</span><span class="contenu_entete"> <?php echo $row3['produit'];?> <span class="contenu_entete" > <?php  echo $row3['qualite'];?></span> <?php if($row3['poids_kg']!=0){ echo $row3['poids_kg'];?>KGS <?php } ?></span> </td>
      <td id="eliminer_border" colspan="3">
      <span class="titre_entete" > POIDS:</span>        
        <span class="contenu_entete" ><?php  
        echo number_format($row3['poids_t'], 3,',',' ');
    ?></span></td>
  </tr>

<tr style="text-align: center; vertical-align: middle; " >
      <td id="eliminer_border" colspan="5">
  <span class="titre_entete" > DESTINATION DOUANIERE:</span>
 <span class="contenu_entete" ><?php  
        echo $row3['des_douane'];
    ?></span></td>  

 
<td id="eliminer_border" colspan="4">
    <span class="titre_entete" > RECEPTIONNAIRE:</span>        
        <span class="contenu_entete" ><?php  
        echo $row3['client'];
    ?></span></td> 
    
   <td id="eliminer_border" colspan="4">
   <span class="titre_entete" > DESTINATION:</span>        
        <span class="contenu_entete" ><?php  
        echo $row3['mangasin'];
    ?></span> </td> 
  </div>
  </tr>
 
  


   <?php } $res3->closeCursor();?>
  
       
    
    <tr id="entete_table_sain"   >
      <td  scope="col" style="width: 1%;"  >ROTA <br> TION</td>
      <td  scope="col"   >DATES</td>
      <td  scope="col"   >HEURE</td>
      <td  scope="col"  >CALE</td>
      <td  scope="col"  > N° BL</td>
      <td  scope="col"  >CAMIONS</td>
      <td  scope="col"  >CHAUFFEUR</td>
      
          <td  scope="col"  >TRANSPOR <br> TEUR</td>
      <td  scope="col"  >N°DEC / TRANSFERT</td>
      <?php while ($resfil=$resfiltre->fetch()) {
        if($resfil['poids_kg']!=0){


      ?>
      <td  scope="col"  >NBRE SACS</td>
    <?php } } ?>
      <td   scope="col"  >POIDS</td>
      <?php 
      while($filtre=$filtreColonne->fetch()){
        if( $filtre["des_douane"]=="LIVRAISON"){
          ?>
          
          <td  scope="col"  >DESTINATAIRE</td>
          <?php  
        }

      } ?>
     
     <td  >OBSERVATION</td>
     <td  class="cacher_cellule" >ACTION</td>


   
     </tr>
      

      
     </thead>


<tbody>
  <?php while($aff=$affiche->fetch()){ 
   $date=explode('-', $aff['dates']);
   $heure=explode(':', $aff['heure']);
  
  // $diff=$aff['poids_declarer']-$aff['sum(manif.poids)'];
   $restant_declaration=$bdd->prepare("SELECT manif.*, sum(manif.poids), tr.poids_declarer  from register_manifeste as manif inner join transit as tr on tr.id_trans=manif.id_declaration where manif.id_declaration=? and manif.id_register_manif<=?");

   $restant_declaration->bindParam(1,$aff['id_declaration']);
   $restant_declaration->bindParam(2,$aff['id_register_manif']);

        $restant_declaration->execute();
       $rest=$restant_declaration->fetch(); 
        $diff=$rest['poids_declarer']-$rest['sum(manif.poids)'];

    $float = $bdd->prepare("SELECT count(bl) from register_manifeste

                   WHERE id_dis_bl=? and dates=? and id_register_manif<=?  ");
        
        
        $float->bindParam(1,$c);
        $float->bindParam(2,$aff['dates']);
        $float->bindParam(3,$aff['id_register_manif']);

        $float->execute();
        $f=$float->fetch();

        $cherche_en_cours=$bdd->prepare("SELECT id_pre_register_manif from pre_register_reception where id_pre_register_manif=?");

  $cherche_en_cours->bindParam(1,$aff['id_register_manif']);
  

        $cherche_en_cours->execute();

        $cherche_reception=$bdd->prepare("SELECT id_recep from reception where id_dis_recep_bl=? and bl_recep=? and dates_recep=?");

  $cherche_reception->bindParam(1,$c);
  $cherche_reception->bindParam(2,$aff['bl']);
  $cherche_reception->bindParam(3,$aff['dates']);
   $cherche_reception->execute();

       
       //$rest=$restant_declaration->fetch();
     
    ?>
   
      <?php if(empty($aff['id_register_manif']) and !empty($aff['dates'])) {?>
         <tr class="ligne"   style="text-align: center; font-weight: bold; vertical-align: middle; " >

      <td class="mytd" colspan="9" class="colaffnull" style="background: linear-gradient(to bottom, #FFFFFF, rgb(82,82,226)); font-weight: bold; color:white;" >TOTAL  <?php echo $date[2].'-'.$date[1].'-'.$date[0] ?></td>
   
  
     
  
   <?php if ($aff['poids_sac']!=0) { ?>
    <td class="mytd" class="colaffnull" style="background: linear-gradient(to bottom, #FFFFFF, rgb(82,82,226)); color: white;"><?php echo number_format($aff['sum(manif.sac)'], 0,',',' ') ?></td>
  <?php } ?>
    <td class="mytd" class="colaffnull" style="background: linear-gradient(to bottom, #FFFFFF, rgb(82,82,226)); color: white;"><?php echo number_format($aff['sum(manif.poids)'], 3,',',' '); ?></td>
    <?php if($aff['destinataire']!='AUCUN' and $aff['destinataire']!=1){ ?>
      
    <td class="mytd" class="colaffnull" style="background: linear-gradient(to bottom, #FFFFFF, rgb(82,82,226));"></td>
<?php } ?>
<td  class="colaffnull" colspan="4" style="background: linear-gradient(to bottom, #FFFFFF, rgb(82,82,226)); font-weight: bold; color:white;" ></td>
</tr>
<?php } ?>

   
   <?php 



    if(!empty($aff['id_register_manif']) and !empty($aff['dates'])) {  

     ?>
     <tr class="ligne" id="<?php echo $aff['id_register_manif'].'colonnebl' ?>"  style="text-align: center;  vertical-align: middle; width: 2px; " >
    <td class="rot"   ><?php echo  $f['count(bl)'] ?> </td>
    <td class="largeur_date" id="<?php echo $aff['id_register_manif'].'date_rm' ?>"   ><?php echo  $date[2].'-'.$date[1].'-'.$date[0]; ?> </td>
    <td id="<?php echo $aff['id_register_manif'].'heure_rm' ?>"  ><?php echo $heure[0].':'.$heure[1] ?></td>
    <td id="<?php echo $aff['id_register_manif'].'cale_rm' ?>"   ><?php echo $aff['cale'] ?> </td>
    <td id="<?php echo $aff['id_register_manif'].'bl_rm' ?>"   data-champ="bl"  ><?php echo $aff['bl'] ?></td>
    <td id="<?php echo $aff['id_register_manif'].'camion_rm' ?>"  ><?php echo $aff['num_camions'] ?></td>
    <td ><?php echo $aff['nom_chauffeur'] ?></td>
    <span style="display: none;" id="<?php echo $aff['id_register_manif'].'id_chauffeur_rm' ?>"><?php echo $aff['chauffeur'] ?></span>
    <span style="display: none;" id="<?php echo $aff['id_register_manif'].'id_camion_rm' ?>"><?php echo $aff['camions'] ?></span>
    <span style="display: none;" id="<?php echo $aff['id_register_manif'].'chauffeur_rm' ?>"><?php echo $aff['nom_chauffeur'].' permis: '.$aff['n_permis']. ' Tel: '.$aff['num_telephone'] ?></span>

    <center>
    <td id="<?php echo $aff['id_register_manif'].'transporteur_rm' ?>" >
      <?php  echo $aff['nom']; ?></td>
    </center>
    <td id="<?php echo $aff['id_register_manif'].'declaration_rm' ?>" ><?php echo $aff['numero_declaration'] ?></td>
    <span style="display: none;" id="<?php echo $aff['id_register_manif'].'id_declaration_rm' ?>"><?php echo $aff['id_declaration'] ?></span>
    <span style="display: none;" id="<?php echo $aff['id_register_manif'].'dis_bl_rm' ?>"><?php echo $aff['id_dis_bl'] ?></span>
     <span style="display: none;" id="<?php echo $aff['id_register_manif'].'poids_sac_rm' ?>"><?php echo $aff['poids_sac'] ?></span>

<?php if($aff['sac']!=0){ ?>
    <td id="<?php echo $aff['id_register_manif'].'sac_rm' ?>" ><?php echo number_format($aff['sac'], 0,',',' '); ?></td>
  <?php } ?>
    <td id="<?php echo $aff['id_register_manif'].'poids_rm' ?>" ><?php echo $aff['poids'] ?> </td>
     
     <?php if($aff['destinataire']!='AUCUN' and $aff['destinataire']!=1){ ?>
     
    <td ><?php echo $aff['destinataire'] ?></td>
<?php }
if($diff>=0){ ?>
  <td  style="color: green;"><?php echo "RAS" ?> 
  <?php if($en_cours=$cherche_en_cours->fetch()){  ?><br> En cours <?php } ?>
<?php if($receptio=$cherche_reception->fetch()){  ?><br> Receptionné <?php } ?></td>
<?php } ?>
<?php  
if($diff<0){ ?>
  <td   style="color: red;"><?php echo "EXCEDENT SUR DECLARATION / DESTINATION DE ".$diff.'T' ?></td>

<?php } ?>

<form>  
 <td class="cacher_cellule"  style="vertical-align: middle; text-align: center; " >
  
   <div style="display: flex; justify-content: center;">

 <a class="fabtn" type="" name="modify" <?php if($aff['type']=="SACHERIE"){ echo  "data-role='update_register'";  } ?> <?php if($aff['type']=="VRAQUIER" and $aff['poids_sac']!=0){ echo  "data-role='update_register_vrac'";  } ?>  <?php if($aff['type']=="VRAQUIER" and $aff['poids_sac']==0){ echo  "data-role='update_register_vrac0'";  } ?>  data-id="<?php echo $aff['id_register_manif']  ?>"  > <i class="fa fa-edit " ></i></a>


<a type="" class="fabtn" href="visualisation_archive.php?id=<?php echo $aff['id_register_manif']; ?>"  id="archive"  >
  <i class="fa fa-eye " ></i> 
</a>

<a    id="<?php echo $aff['id_register_manif'] ?>" name="delete" type="submit"  class="fabtn1 " onclick="deleteAjax(<?php echo $aff['id_register_manif'] ?>)" > <i class="fa fa-trash  " ></i> </a>
</div>

</td>
    
</td>
</form>
</tr>










 
  <?php } ?>

  <?php  if(empty($aff['id_register_manif']) and empty($aff['dates'])) { 
     $affT=$afficheT->fetch();
    $rob_sacT=$affT['nombre_sac']-$aff['sum(manif.sac)'];
     $rob_poidsT=$affT['poids_t']-$aff['sum(manif.poids)']; ?>
<tr style="font-weight: bold; ">
  <td class="mytd" colspan="14" class="" style="background: black; color: white; font-weight: bold; text-align: center;" >SITUATION GENERALE  </td>
  </tr>
  <?php if($aff['type']=="SACHERIE") { ?>
 <tr   style="text-align: center; font-weight: bold; vertical-align: middle;" >
  <td class="mytd" class="" colspan="4" style="background: black; color: white; font-weight: bold; text-align: center;" >TOTAL SACS DEB = <span style="color:red;"> <?php echo number_format($aff['sum(manif.sac)'], 0,',',' '); ?></span>  </td>
  

  <td class="mytd" class="" colspan="3" style="background: black; color: white; font-weight: bold; text-align: center;"> TOTAL POIDS DEB = <span style="color:red;"><?php echo number_format($aff['sum(manif.poids)'], 3,',',' '); ?></span></td> 

   <td class="mytd" class="" colspan="3" style="background: black; color: white; font-weight: bold; text-align: center;" >ROB EN SACS= <span style="color:red;"><?php echo number_format($rob_sacT, 0,',',' '); ?></span>  </td>
   

   <td class="mytd" class="" colspan="4"  style="background: black; color: white; font-weight: bold; text-align: center;"> ROB EN POIDS = <span style="color:red;"><?php echo number_format($rob_poidsT, 3,',',' '); ?></span></td>
<?php } 
 if($aff['type']=="VRAQUIER" AND $aff['poids_sac']!=0) { ?>
?> 

  <td class="mytd" class="" colspan="4" style="background: black; color: white; font-weight: bold; text-align: center;" >TOTAL SACS DEBARQUES = <span style="color:red;"> <?php echo number_format($aff['sum(manif.sac)'], 0,',',' '); ?></span>  </td>
  

  <td class="mytd" class="" colspan="4"style="background: black; color: white; font-weight: bold; text-align: center;"> TOTAL POIDS DEBARQUES = <span style="color:red;"><?php echo number_format($aff['sum(manif.poids)'], 3,',',' '); ?></span></td> 

  
   

   <td class="mytd" class="" colspan="4"  style="background: black; color: white; font-weight: bold; text-align: center;"> ROB EN POIDS = <span style="color:red;"><?php echo number_format($rob_poidsT, 3,',',' '); ?></span></td>
<?php } ?>


<?php 
 if($aff['type']=="VRAQUIER" AND $aff['poids_sac']==0) { ?>

<td class="mytd" class="" colspan="6"style="background: black; color: white; font-weight: bold; text-align: center;"> TOTAL POIDS DEBARQUES = <span style="color:red;"><?php echo number_format($aff['sum(manif.poids)'], 3,',',' '); ?></span></td> 

  
    

   <td class="mytd" class="" colspan="6"  style="background: black; color: white; font-weight: bold; text-align: center;"> ROB EN POIDS = <span style="color:red;"><?php echo number_format($rob_poidsT, 3,',',' '); ?></span></td>
   


<?php  } ?>
 

  </tr> 
 
 

  <?php  } } ?>




</tbody>
             

            

</table>
</div>
<style type="text/css">
  @media print {
  .no_print {
    display: none;
  }
    #btnSain, #btnAvariesRep, #btnAvariesDeb, #tabledec1, #tabledec2, .menu, #sidebar, .operation, .container-fluid1, .sidebar, .topbar, .entete_image, #insertion_sain, .bars, .cacher_cellule, .great ,br    {
    display: none !important;

  }
 /* #tableau_sain{
    page-break-before: always !important;
  } */
  .rot{
    width: 1%;
  }
  .largeur_date{
    width: 10%;
  }


   .footer{
    display: none;
   }
  }
</style>

<button style="margin:auto-right;" class="btn btn-primary no_print" onClick="imprimer('tableau_sain')">imprimer</button>
</div>


<?php } ?>
