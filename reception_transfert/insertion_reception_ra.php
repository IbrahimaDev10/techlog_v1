<?php
require('../database.php');  
if(isset($_POST['id']) ){
  if(!empty($_POST['date']) and !empty($_POST['bl']) and !empty($_POST['chauffeur']) and !empty($_POST['camion']) and !empty($_POST['sacf'])) {
$date=$_POST['date'];
$bl=$_POST['bl'];
$chauffeur=$_POST['chauffeur'];
$camion=$_POST['camion'];
$sacf=$_POST['sacf'];
$sacm=$_POST['sacm'];
$poidsf=$_POST['poidsf'];
$poidsm=$_POST['poidsm'];
$manquant=$_POST['manquant'];
$poids_sac=$_POST['poids_sac'];
$client=$_POST['id_client'];
$destination=$_POST['id_destination'];
$navire=$_POST['id_navire'];
$declaration=$_POST['id_declaration'];
$id_dis_bl=$_POST['id_dis_bl'];
$id_produit=$_POST['id_produit'];
$id=$_POST['id'];
//$poids=$sac*$poids_sac/1000;

try{
$insert=$bdd->prepare("INSERT INTO reception_avaries(date_ra,bl_ra,camion_ra,chauffeur_ra,id_declaration_ra,sac_flasque_ra,poids_flasque_ra,sac_mouille_ra,poids_mouille_ra,manquant_ra,poids_sac_ra,id_produit_ra,id_dis_bl_ra,id_destination_ra,id_client_ra,id_navire_ra) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
  $insert->bindParam(1,$date);
  $insert->bindParam(2,$bl);
  $insert->bindParam(3,$camion);
  $insert->bindParam(4,$chauffeur);
  $insert->bindParam(5,$declaration);
  $insert->bindParam(6,$sacf);
  $insert->bindParam(7,$poidsf);
  $insert->bindParam(8,$sacm);
  $insert->bindParam(9,$poidsm);
  $insert->bindParam(10,$manquant);
  $insert->bindParam(11,$poids_sac);
  $insert->bindParam(12,$id_produit);
  $insert->bindParam(13,$id_dis_bl);
  $insert->bindParam(14,$destination);
  $insert->bindParam(15,$client);
  $insert->bindParam(16,$navire);
  $insert->execute();

  $delete=$bdd->prepare("delete from pre_reception_avaries where id_pre_ra=?");
  $delete->bindParam(1,$id);
  $delete->execute();
  
}

catch(PDOException $e){
    die('Erreur:' .$e->getMessage());
    
}
}


//METTRE LE CODE POUR RECHARGER LA PAGE

?>


<div class="main " id="main" > 
<div class="container-fluid-great"  >
        <div class="row">
 
         

    
 
 
 
</div>

</div>

 
 
<br>

  


<?php 



  
 



$select=$bdd->prepare("select pre.*,rm.*,cam.*,ch.*,p.produit,p.qualite, nav.navire, from register_manifeste as rm
            inner join pre_register_reception as pre on pre.id_pre_register_manif=rm.id_register_manif
            left join camions as cam on cam.id_camions=rm.camions
            left join chauffeur as ch on ch.id_chauffeur=rm.chauffeur
            inner join produit_deb as p on p.id=rm.id_produit
            inner join navire_deb as nav on nav.id=rm.id_navire

            where rm.id_dis_bl=?");
               $select->bindParam(1,$id_dis_bl);
               $select->execute(); 

                  $affiche = $bdd->prepare("SELECT  p.produit,p.qualite,nav.navire,nav.type,cli.client,mang.mangasin,trp.*,trs.*,ch.*, rec.*, sum(rec.sac_recep),sum(rec.poids_recep),sum(rec.manquant_recep),cam.*   FROM reception as rec 
                
                inner join  produit_deb as p on rec.id_produit_recep=p.id 

                inner join navire_deb as nav on rec.id_navire_recep=nav.id 
                
                inner join client as cli on rec.id_client_recep=cli.id
                inner join mangasin as mang on rec.id_destination_recep=mang.id
                
                left join chauffeur as ch on rec.chauffeur_recep=ch.id_chauffeur 
                left join camions as cam on rec.camion_recep=cam.id_camions
                left join transporteur as trp on cam.id_trans=trp.id
                inner join transit as trs on rec.id_dec=trs.id_trans

                   WHERE rec.id_dis_recep_bl=? group by rec.dates_recep, rec.id_recep with rollup ");
        
        
        $affiche->bindParam(1,$id_dis_bl);
        $affiche->execute();


     $afficheT = $bdd->prepare("SELECT poids_t, nombre_sac from dispatching where id_dis=?");             
             $afficheT->bindParam(1,$id_dis_bl);
        $afficheT->execute();


        $afficheAvaries = $bdd->prepare("SELECT pre.*,  p.produit,p.qualite,nav.navire,nav.type,cli.client,mang.mangasin,trp.*,trs.*,ch.*,trav.*,cam.*, sum(trav.sac_flasque_tr_av),sum(trav.poids_flasque_tr_av),sum(trav.poids_mouille_tr_av),sum(trav.sac_mouille_tr_av)   FROM transfert_avaries as trav 
                
                inner join  produit_deb as p on trav.id_produit=p.id 
                inner join pre_reception_avaries as pre on pre.id_pre_tr_av=trav.id_tr_avaries

                inner join navire_deb as nav on trav.id_navire=nav.id 
                
                inner join client as cli on trav.id_client=cli.id
                inner join mangasin as mang on trav.id_destination_tr=mang.id
                left join camions as cam on trav.id_cam=cam.id_camions
                left join transporteur as trp on cam.id_trans=trp.id
                left join chauffeur as ch on trav.id_chauffeur_tr=ch.id_chauffeur 
                inner join transit as trs on trav.id_declaration_tr=trs.id_trans

                   WHERE trav.id_dis_bl_tr=?  ");
        
        
        $afficheAvaries->bindParam(1,$id_dis_bl);
        $afficheAvaries->execute();


        $afficheAvaries_ra = $bdd->prepare("SELECT pre.*, p.produit,p.qualite,nav.navire,nav.type,cli.client,mang.mangasin, sum(pre.sac_flasque_ra),sum(pre.poids_flasque_ra),sum(pre.poids_mouille_ra),sum(pre.sac_mouille_ra)   FROM reception_avaries as pre
                
                inner join  produit_deb as p on pre.id_produit_ra=p.id 

                inner join navire_deb as nav on pre.id_navire_ra=nav.id 
                
                inner join client as cli on pre.id_client_ra=cli.id
                inner join mangasin as mang on pre.id_destination_ra=mang.id
               

                   WHERE pre.id_dis_bl_ra=? group by pre.date_ra, pre.id_ra with rollup ");
        
        
        $afficheAvaries_ra->bindParam(1,$id_dis_bl);
        $afficheAvaries_ra->execute();

   
   

               ?>

                <div  class="table-responsive" border=1 >
          <center>
            <h1>CAMIONS EN ATTENTES</h1>
 <table  class='table table-hover table-bordered table-striped'  border='2' style="width: 50%; " id='tabledec2' >
  <tbody>
  <tr style="background: black; color:white; text-align:center; vertical-align: middle; ">
  <th style="color:white;">DATE</th>
  <th style="color:white;">BL</th>
  <th style="color:white;">CAMION</th>
  <th style="color:white;">CHAUFFEUR</th>
  <th style="color:white;">SAC</th>
  <th style="color:white;" >POIDS</th>
  <th style="color:white;">ACTIONS</th></tr>

  <?php while($aff=$select->fetch()){ ?>
<tr>
    <td id="<?php echo $aff['id_register_manif'].'date' ?>" class="colcel"><?php echo $aff['dates']; ?></td>
     <td id="<?php echo $aff['id_register_manif'].'bl' ?>" class="colcel"><?php echo $aff['bl']; ?></td>
      <td id="<?php echo $aff['id_register_manif'].'camion' ?>" class="colcel"><?php echo $aff['num_camions']; ?></td>
       <td id="<?php echo $aff['id_register_manif'].'chauffeur' ?>" class="colcel"><?php echo $aff['nom_chauffeur']; ?></td>
      <td id="<?php echo $aff['id_register_manif'].'sac' ?>" class="colcel"><?php echo $aff['sac']; ?></td>
       <td id="<?php echo $aff['id_register_manif'].'poids' ?>" class="colcel"><?php echo $aff['poids']; ?></td>
       <span style="display: none;" id="<?php echo $aff['id_register_manif'].'poids_sac'   ?>"> <?php echo $aff['poids_sac']   ?></span>
       <span style="display: none;" id="<?php echo $aff['id_register_manif'].'id_produit'   ?>"> <?php echo $aff['id_produit']   ?></span>
        <span style="display: none;" id="<?php echo $aff['id_register_manif'].'id_dis_bl'   ?>"> <?php echo $aff['id_dis_bl']   ?></span>
         <span style="display: none;" id="<?php echo $aff['id_register_manif'].'id_declaration'   ?>"> <?php echo $aff['id_declaration']   ?></span>
          <span style="display: none;" id="<?php echo $aff['id_register_manif'].'id_destination'   ?>"> <?php echo $aff['id_destination']   ?></span>
           <span style="display: none;" id="<?php echo $aff['id_register_manif'].'id_client'   ?>"> <?php echo $aff['id_client']   ?></span>
            <span style="display: none;" id="<?php echo $aff['id_register_manif'].'id_navire'   ?>"> <?php echo $aff['id_navire']   ?></span>

        <td class="colcel"><a href="#" data-role="insert_reception" data-id="<?php echo $aff['id_register_manif']; ?>" class="btn btn-primary">accepter</a></td>

        </tr>
        <?php } ?>
      </tbody>
    </table>
  </center>
</div>

<br><br><br>

<div class="table-responsive" border=1>
<?php


 echo " <table class='table table-hover table-bordered table-striped table-responsive' id='table_register' border='2' >";
    
?> 
 <thead style="background-color: rgba(50, 159, 218, 0.9);">
       
    
    <tr  style="background: linear-gradient(to bottom, #FFFFFF, rgb(0,141,202)); text-align: center; color: white; font-weight: bold;"  >
      
      <td id="mytd" scope="col" rowspan="2"  >DATES</td>
     
     
      <td id="mytd" scope="col" rowspan="2" > N° BL</td>
      <td id="mytd" scope="col" rowspan="2" >CAMIONS</td>
      <td id="mytd" scope="col" rowspan="2" >CHAUFFEUR</td>
      
         


      
      <td id="mytd" scope="col" rowspan="2" >SACS</td>
    
      <td id="mytd"  scope="col" rowspan="2" >POIDS</td>
       <td id="mytd"  scope="col" rowspan="2" >SACS MANQUANTS</td>
       <td id="mytd"  scope="col" rowspan="2" >ACTIONS</td>
     
          
        
     



   
     </tr>
      

     
     
      


      
     </thead>


<tbody>
  <?php while($aff=$affiche->fetch()){ 
   $date=explode('-', $aff['dates_recep']);
   
  
   $diff=$aff['poids_declarer']-$aff['sum(rec.poids_recep)'];
     
    ?>
   
      <?php if(empty($aff['id_recep']) and !empty($aff['dates_recep'])) {?>
         <tr class="ligne"   style="text-align: center; font-weight: bold; vertical-align: middle;" >

      <td id="mytd" colspan="4" class="colaffnull" style="background: linear-gradient(to bottom, #FFFFFF, rgb(82,82,226)); font-weight: bold; color:white;" >TOTAL  <?php echo $date[2].'-'.$date[1].'-'.$date[0] ?></td>
   
  
     
  
   
    <td id="mytd" class="colaffnull" style="background: linear-gradient(to bottom, #FFFFFF, rgb(82,82,226)); color: white;"><?php echo number_format($aff['sum(rec.sac_recep)'], 0,',',' ') ?></td>
  
    <td id="mytd" class="colaffnull" style="background: linear-gradient(to bottom, #FFFFFF, rgb(82,82,226)); color: white;"><?php echo number_format($aff['sum(rec.poids_recep)'], 3,',',' '); ?></td>
    
<td  class="colaffnull" colspan="2" style="background: linear-gradient(to bottom, #FFFFFF, rgb(82,82,226)); font-weight: bold; color:white;" ></td>
</tr>
<?php } ?>

   
   <?php 



    if(!empty($aff['id_recep']) and !empty($aff['dates_recep'])) {?>
     <tr class="ligne" id="<?php echo $aff['id_recep'].'colonnebl' ?>"  style="text-align: center; font-weight: bold; vertical-align: middle;" >

    <td id="mytd" class="colaffiche" ><?php echo  $date[2].'-'.$date[1].'-'.$date[0] ?> </td>
   
    <td id="mytd"  data-champ="bl"  class="colaffiche" ><?php echo $aff['bl_recep'] ?></td>
    <td id="mytd" class="colaffiche"><?php echo $aff['camion_recep'] ?></td>
    <td id="mytd" class="colaffiche"><?php echo $aff['chauffeur_recep'] ?></td>

    
    <td id="mytd" class="colaffiche"><?php echo number_format($aff['sac_recep'], 0,',',' '); ?></td>


    <td id="mytd" class="colaffiche"><?php echo number_format($aff['poids_recep'], 3,',',' '); ?></td>

   <td id="mytd" class="colaffiche"><?php echo number_format($aff['manquant_recep'], 0,',',' '); ?></td>
     
     
  


<form>  
 <td  style="vertical-align: middle; " > <button  id="<?php echo $aff['id_recep'] ?>" name="delete" type="submit"  class="fabtn1 " onclick="deleteAjax(<?php echo $aff['id_recep'] ?>)" > <i class="fa fa-trash  " ></i> </button>

 <a class="fabtn" type="" name="modify"  href="essai.php?id=<?php echo $aff['id_recep']; ?>"       id="btnbtn" s> <i class="fa fa-edit " ></i></a>

<a type="" class="fabtn" href="archive.php?id=<?php echo $aff['id_recep']; ?>"  id="#archive" >
  <i class="fa fa-archive " ></i> 
</a>
<a type="" class="fabtn " href="visualisation_archive.php?id=<?php echo $aff['id_recep']; ?>"  id="archive"  >
  <i class="fa fa-eye " ></i> 
</a>

    
</td>
</form>
</tr>










 
  <?php } ?>

  <?php  if(empty($aff['id_recep']) and empty($aff['dates_recep'])) { 
     $affT=$afficheT->fetch();
    $rob_sacT=$affT['nombre_sac']-$aff['sum(rec.sac_recep)'];
     $rob_poidsT=$affT['poids_t']-$aff['sum(rec.poids_recep)']; ?>
<tr style="font-weight: bold;">
  <td id="mytd" colspan="8" class="" style="background: black; color: white; font-weight: bold; text-align: center;" >SITUATION GENERALE  </td>
  </tr>
  
 <tr   style="text-align: center; font-weight: bold; vertical-align: middle;" >
  <td id="mytd" class="" colspan="2" style="background: black; color: white; font-weight: bold; text-align: center;" >TOTAL SACS RECEPTIONNES = <span style="color:red;"> <?php echo number_format($aff['sum(rec.sac_recep)'], 0,',',' '); ?></span>  </td>
  

  <td id="mytd" class="" colspan="2" style="background: black; color: white; font-weight: bold; text-align: center;"> TOTAL POIDS RECEPTIONNES = <span style="color:red;"><?php echo number_format($aff['sum(rec.poids_recep)'], 3,',',' '); ?></span></td> 

   <td id="mytd" class="" colspan="2" style="background: black; color: white; font-weight: bold; text-align: center;" >ROB EN SACS= <span style="color:red;"><?php echo number_format($rob_sacT, 0,',',' '); ?></span>  </td>
   

   <td id="mytd" class="" colspan="2"  style="background: black; color: white; font-weight: bold; text-align: center;"> ROB EN POIDS = <span style="color:red;"><?php echo number_format($rob_poidsT, 3,',',' '); ?></span></td>
<?php } 
 
?> 

  

  </tr> 
 
 

  <?php   } ?>




</tbody>
             

            

</table>
</div>
<br><br><br>

<?php 
    // FILTRER LE NAVIRE SI C SACHERIE ON AFFICHE LE TRANSFERT DES AVARIES
   $filtreavaries= $bdd->prepare("SELECT  nav.navire,nav.type, dis.id_dis   FROM dispatching as dis 
                
                 

                inner join navire_deb as nav on dis.id_navire=nav.id 
                
               
                 

                   WHERE dis.id_dis=?  ");
        $filtreavaries->bindParam(1,$id_dis_bl);
        $filtreavaries->execute();
        $cherche=$filtreavaries->fetch();
       if($cherche['type']=="SACHERIE"){  

          ?>


<div class="container-fluid1 " id="situation" >
        <div class="row">
            
            
                <div class="col-lg-12 col-md-12">
                    <h1 class="hem2 text-white">ENREGISTREMENT DES BONS DE RECEPTION DES AVARIES</h1><br>  
            </div>
             </div>
             </div>
        <div class="col-md-12 col-lg-12">      

<br>


</span>
    </div>

 <div class="table-responsive" border=1>
    <center>
  <h1>CAMIONS DES AVARIES EN ATTENTES</h1>
  </center>
<?php


 echo " <table class='table table-hover table-bordered table-striped' id='table' border='2' >";
    
?> 
 <thead style="background-color: rgba(50, 159, 218, 0.9);">
       
    
    <tr  style="background: black; color:white; text-align:center; vertical-align: middle; "  >
      
      
      
       <td scope="col"  rowspan="3"  style="color: white; font-weight: bold; vertical-align: middle;">DATES</td>     
                 <td scope="col"  rowspan="3"  style="color: white; font-weight: bold; vertical-align: middle;">BL</td>
               <td scope="col" rowspan="3"  style="color: white; font-weight: bold; vertical-align: middle; vertical-align: middle;">CAMIONS</td> 
               <td scope="col"  rowspan="3"  style="color: white; font-weight: bold; vertical-align: middle;">CHAUFFEUR</td>       
      <td scope="col" colspan="2"  style="color: white; font-weight: bold; vertical-align: middle;">FLASQUES</td>
      <td scope="col" colspan="2"  style="color: white; font-weight: bold; vertical-align: middle;">MOUILLES</td>
      <td scope="col" rowspan="2"  style="color: white; font-weight: bold; vertical-align: middle;">ACTIONS</td>
      
     
  </tr>
    <tr style="background: black; color:white; text-align:center; vertical-align: middle; " >
      
      <td scope="col"   style="color: white; font-weight: bold; vertical-align: middle;">SACS</td>
      <td scope="col"  style="color: white; font-weight: bold; vertical-align: middle;">POIDS</td>
      <td scope="col"   style="color: white; font-weight: bold; vertical-align: middle;">SACS</td>
      <td scope="col"  style="color: white; font-weight: bold; vertical-align: middle;">POIDS</td>
      </tr>

      

     
     
    


      
     </thead>


<tbody>
<?php while($aff=$afficheAvaries->fetch()){ ?>
  <tr >
  <td id="<?php echo $aff['id_pre_ra'].'date_ra' ?>" class="colcel"><?php echo $aff['date_tr_avaries'] ?></td> 
  <td id="<?php echo $aff['id_pre_ra'].'bl_ra' ?>" class="colcel"><?php echo $aff['bl_tr'] ?></td> 
  <td id="<?php echo $aff['id_pre_ra'].'camion_ra' ?>" class="colcel"><?php echo $aff['num_camions'] ?></td> 
  <td id="<?php echo $aff['id_pre_ra'].'chauffeur_ra' ?>" class="colcel"><?php echo $aff['nom_chauffeur'] ?></td> 
  <td id="<?php echo $aff['id_pre_ra'].'sac_flasque_ra' ?>" class="colcel"><?php echo $aff['sac_flasque_tr_av'] ?></td>
  <td id="<?php echo $aff['id_pre_ra'].'poids_flasque_ra' ?>" class="colcel"><?php echo $aff['poids_flasque_tr_av'] ?></td> 
  <td id="<?php echo $aff['id_pre_ra'].'sac_mouille_ra' ?>" class="colcel"><?php echo $aff['sac_mouille_tr_av'] ?></td>  
  <td id="<?php echo $aff['id_pre_ra'].'poids_mouille_ra' ?>" class="colcel"><?php echo $aff['poids_mouille_tr_av'] ?></td>
  <span style="display: none;" id="<?php echo $aff['id_pre_ra'].'poids_sac_ra'   ?>"> <?php echo $aff['poids_sac_tr_av']   ?></span>
       <span style="display: none;" id="<?php echo $aff['id_pre_ra'].'id_produit_ra'   ?>"> <?php echo $aff['id_produit']   ?></span>
        <span style="display: none;" id="<?php echo $aff['id_pre_ra'].'id_dis_bl_ra'   ?>"> <?php echo $aff['id_dis_bl_tr']   ?></span>
         <span style="display: none;" id="<?php echo $aff['id_pre_ra'].'id_declaration_ra'   ?>"> <?php echo $aff['id_declaration_tr']   ?></span>
          <span style="display: none;" id="<?php echo $aff['id_pre_ra'].'id_destination_ra'   ?>"> <?php echo $aff['id_destination_tr']   ?></span>
           <span style="display: none;" id="<?php echo $aff['id_pre_ra'].'id_client_ra'?>"> <?php echo $aff['id_client']   ?></span>
            <span style="display: none;" id="<?php echo $aff['id_pre_ra'].'id_navire_ra'?>"> <?php echo $aff['id_navire']   ?></span> 
  <td class="colcel"><a href="#" data-role="insert_reception_avaries" data-id="<?php echo $aff['id_pre_ra']; ?>" class="btn btn-primary">accepter</a></td> 

  </tr>
<?php } ?>
</tbody>
</div>
<br><br>

<div class="table-responsive" border=1>
<?php


 echo " <table class='table table-hover table-bordered table-striped' id='table' border='2' >";
    
?> 
 <thead style="background-color: rgba(50, 159, 218, 0.9);">
       
    
    <tr  style="background-color: rgba(50, 159, 218, 0.9); text-align: center;"  >
      
      
      
       <td scope="col"  rowspan="3"  style="color: white; font-weight: bold; vertical-align: middle;">DATES</td>
              
       
                      <td scope="col"  rowspan="3"  style="color: white; font-weight: bold; vertical-align: middle;">BL</td>
               <td scope="col" rowspan="3"  style="color: white; font-weight: bold; vertical-align: middle; vertical-align: middle;">CAMIONS</td> 
               <td scope="col"  rowspan="3"  style="color: white; font-weight: bold; vertical-align: middle;">CHAUFFEUR</td>
                        
      <td scope="col" colspan="2"  style="color: white; font-weight: bold; vertical-align: middle;">FLASQUES</td>
      <td scope="col" colspan="2"  style="color: white; font-weight: bold; vertical-align: middle;">MOUILLES</td>
      <td scope="col"  rowspan="3"  style="color: white; font-weight: bold; vertical-align: middle;">ACTIONS</td>
      
     
  </tr>
    <tr style="background-color: rgba(50, 159, 218, 0.9); text-align: center;" >
      
      <td scope="col"   style="color: white; font-weight: bold; vertical-align: middle;">SACS</td>
      <td scope="col"  style="color: white; font-weight: bold; vertical-align: middle;">POIDS</td>
      <td scope="col"   style="color: white; font-weight: bold; vertical-align: middle;">SACS</td>
      <td scope="col"  style="color: white; font-weight: bold; vertical-align: middle;">POIDS</td>
      </tr>
      

     
     
    


      
     </thead>


<tbody>
 <?php while($a=$afficheAvaries_ra->fetch()){ 
   $date=explode('-', $a['date_ra']);
   
  
   //$diff=$aff['poids_declarer']-$aff['sum(manif.poids)'];
     
    ?>
    <tr style="text-align: center; font-weight: bold; " >
      <?php if(empty($a['id_ra']) and !empty($a['date_ra'])) {?>
      <td colspan="4" class="colaffnull" style="background:rgb(82,82,226); font-weight: bold; color:white;" >TOTAL  <?php echo $date[2].'-'.$date[1].'-'.$date[0] ?></td>
   

    <td class="colaffnull" style="background:rgb(82,82,226); color: white;"><?php echo number_format($a['sum(pre.sac_flasque_ra)'], 0,',',' ') ?></td>
    <td class="colaffnull" style="background:rgb(82,82,226); color: white;"><?php echo number_format($a['sum(pre.poids_flasque_ra)'], 3,',',' '); ?></td>
    <td class="colaffnull" style="background:rgb(82,82,226); color: white;"><?php echo number_format($a['sum(pre.sac_mouille_ra)'], 0,',',' ') ?></td>
     <td class="colaffnull" style="background:rgb(82,82,226); color: white;"><?php echo number_format($a['sum(pre.poids_mouille_ra)'], 3,',',' '); ?></td>
     <td  style="background:rgb(82,82,226); color: white;"></td>
    
    


   
   <?php }



   else if(!empty($a['id_ra']) and !empty($a['date_ra'])) {?>


    <td class="colaffiche" ><?php echo  $date[2].'-'.$date[1].'-'.$date[0] ?></td>
   
    
    <td class="colaffiche"><?php echo $a['bl_ra'] ?></td>
    <td class="colaffiche"><?php echo $a['camion_ra'] ?></td>
    <td class="colaffiche"><?php echo $a['chauffeur_ra'] ?></td>


    <td class="colaffiche"><?php echo number_format($a['sac_flasque_ra'], 0,',',' '); ?></td>
    <td class="colaffiche"><?php echo $a['poids_flasque_ra'] ?></td>
  <td class="colaffiche"><?php echo number_format($a['sac_mouille_ra'], 0,',',' '); ?></td>
    <td class="colaffiche"><?php echo $a['poids_mouille_ra'] ?></td>
      <td class="colcel" style="vertical-align: middle;" ><a class="btn btn-primary" href="#" data-role="inse" data-id="<?php echo $a['id_ra']; ?>" >DELETE</a></td>

  
  <?php } ?>

  <?php   if(empty($a['id_ra']) and empty($a['date_ra'])) { /*
     $affT=$afficheT->fetch();
    $rob_sacT=$affT['nombre_sac']-$aff['sum(manif.sac)'];
     $rob_poidsT=$affT['poids_t']-$aff['sum(manif.poids)'];*/ ?>
<tr style="font-weight: bold;">
  <td colspan="9" class="" style="background: black; color: white; font-weight: bold; text-align: center;" >  </td>
  </tr>
  
 

  <?php  }  ?>
<?php  }  ?>



</tbody>
             

  
</table> 
</div>



<?php   } ?>
  

<?php 
} //ENDIF

?>  
