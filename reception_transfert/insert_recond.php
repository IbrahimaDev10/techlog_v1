<?php 

require('../database.php');
require('controller/afficher_les_receptions.php');

if(isset($_POST['navire'])){

 $navire=$_POST['navire'];
 $id_produit=$_POST['id_produit'];
 $poids_sac=$_POST['poids_sac'];
 $id_destination=$_POST['id_destination'];
 $c=$_POST['id_dis'];
 $date=$_POST['date'];
 $navire=$_POST['navire'];
 $sacf=$_POST['sacf'];
 $sac_eventres=$_POST['sac_eventres'];
 $poids_eventres=$sac_eventres*$poids_sac/1000;
 $sac_bal=$_POST['sac_bal'];
 $poids_bal=$_POST['poids_bal'];
 $id_declaration=$_POST['id_declaration'];
 $poidsf=$sacf*$poids_sac/1000;

/* $naviress=$bdd->prepare("select dis.*, mg.*,nav.* from dispatching as dis 
                 inner join mangasin as mg on dis.id_mangasin=mg.id
                 
                 inner join navire_deb as nav on dis.id_navire=nav.id
                 inner join simar_user as user on user.id_sim_user=mg.id_mangasinier
                 where mg.id_mangasinier=? group by nav.navire");
      $naviress->bindParam(1,$_SESSION['id']);
      $naviress->execute(); */





 try{
	$insert=$bdd->prepare("INSERT INTO reconditionnement_reception_transfert(dates,sac_eventres,poids_eventres,sac_recond,poids_recond,sac_balayure,poids_balayure,poids_sac,id_produit,id_destination,id_navire,declaration_id) values(?,?,?,?,?,?,?,?,?,?,?,?)");

$insert->bindParam(1,$date);
$insert->bindParam(2,$sac_eventres);
$insert->bindParam(3,$poids_eventres);
$insert->bindParam(4,$sacf);
$insert->bindParam(5,$poidsf);
$insert->bindParam(6,$sac_bal);
$insert->bindParam(7,$poids_bal);
$insert->bindParam(8,$poids_sac);
$insert->bindParam(9,$id_produit);
$insert->bindParam(10,$id_destination);
$insert->bindParam(11,$navire);
$insert->bindParam(12,$id_declaration);
$insert->execute();
}

catch(PDOException $e){
    die('Erreur:' .$e->getMessage());
    
}


 ?>

<div class="main " id="main" > 

<div class="container-fluid1 " id="situation"  style=" background: rgb(0,141,202);" >
        <div class="row">
            
            
                <div class="col-lg-12 col-md-12">
                    <h1 class="hem2 text-white" style=" background: rgb(0,44,62); font-size: 30px;"> RECEPTION</h1><br>

                    
                    <form method="POST" >
                        <select  id="navires" class="mysel" style="margin-right: 15%; height: 30px;   width: 40%;"  onchange='goNavireSit()'>
                            <option value="">selectionner un navire</option>
                            <?php 
                            while ($row=$naviress->fetch()) {
                             ?>
                                <option value=<?php echo $row['id_navire'].'-'.$_SESSION['id']; ?> >  <?php echo $row['navire'] ?> </option>
                            <?php } ?>

                 </select>
                        
                     <select id="mesprod" class="mysel" name="produit" style="margin-right: 2%; height: 30px;  width: 40%;" onchange='goProduit()'>
                            <option  selected>selectionner le produit</option>
                        </select>
                        
                 
                            
                    </form>
                
            </div>
        </div>
    </div>


  
   <div class="col-md-12 col-lg-12">
   
</div>
<div class="container-fluid-great"  >
        <div class="row">
 
         

    
 
 
 
</div>

</div>
<br><br>

<div class="container-fluid">
  <div class="row">
  
      <div class="col col-sm-12 col-md-12 col-lg-12">
        <center>
        <button  class="btn btn-primary" id="btnSain"  onclick="visibleSain()">RECONDITIONNEMENT</button>
      
           <button  class="btn btn-primary" id="btnAvariesDeb" onclick="visibleAvariesDeb()">PV DE RECONDITIONNEMENT</button>
       
     
            
      
        </center>
      </div>
    

    
  </div>
</div>


 <?php  






    include("requete.php");

        $Sains = $bdd->prepare("SELECT poids_sac_recep,  sum(sac_recep), sum(poids_recep)  from reception
                   WHERE id_dis_recep_bl=? ");
               $Sains->bindParam(1,$c);
        $Sains->execute();

      $recond_DEPART = $bdd->prepare("SELECT * from reconditionnement_reception
                   WHERE id_dis_recond=? ");
        
        
        $recond_DEPART ->bindParam(1,$c);
        $recond_DEPART ->execute();

                  $SomAvr_DEPART = $bdd->prepare("SELECT  sum(sac_flasque_avr),sum(sac_mouille_avr) from avaries_de_reception
                   WHERE id_dis_avr=? ");
        
        
        $SomAvr_DEPART->bindParam(1,$c);
        $SomAvr_DEPART->execute();



                          $SomRa_DEPART = $bdd->prepare("SELECT  sum(sac_flasque_ra),sum(sac_mouille_ra),sum(poids_flasque_ra),sum(poids_mouille_ra) from reception_avaries
                   WHERE id_dis_bl_ra=? ");
        
        
        $SomRa_DEPART->bindParam(1,$c);
        $SomRa_DEPART->execute();




      

   

               ?>



<div class="container-fluid" id="tableSain" >  
  <br>

 <?php 
  $selectid_dis=bouton_avaries($bdd,$produit,$poids_sac,$navire,$destination);
if($afdis=$selectid_dis->fetch()){ ?>
  <div class="col-md-12 col-lg-12">      
<a  class="btn1"  style="background: rgb(65,180,190); " data-role="insert_reconditionnement" data-id="<?php echo $afdis['id_dis_recep_bl'] ?>" data-navire_recond="<?php echo $afdis['id_navire_recep'] ?>" data-id_produit_recond="<?php echo $afdis['id_produit_recep'] ?>"  data-poids_sac_recond="<?php echo $afdis['poids_sac_recep'] ?>" data-id_destination_recond="<?php echo $afdis['id_destination_recep'] ?>"  data-id_declaration_recond="<?php echo $afdis['id_dec'] ?>">AJOUTER RECONDITIONNEMENT  </a>
<br><br>
</div>
<?php } ?>
 <div class="col col-md-12 col-lg-12">
       
<div class="table-responsive" border=1 >



 <table class='table table-hover table-bordered table-striped table-responsive'  border='2'  >

 <thead style="background-color: rgba(50, 159, 218, 0.9);">
  <td  colspan="13" class="titreSAIN"  >RECONDITIONNEMENT</td>
      
    
    <tr id="th_table_rec"  >
      <td  rowspan="2"   >N°</td>
       <td   rowspan="2"   >DATE</td>
        <td   colspan="2"   >FLASQUES RECEPTIONNES</td>
        <td   colspan="2" >SACS EVENTRES</td>
     
      <td   colspan="2" >SACS RECONDITIONNES</td>
      <td   colspan="2"  >BALAYURES </td>
     
     
      <td   rowspan="2" > PERTES EN SACS</td>
       <td   colspan="2"   >FLASQUES RESTANTS</td>
  </tr>
      
 <tr id="th_table_rec" >
      <td   >SACS</td>
    
      <td    >POIDS</td>

            <td   >SACS</td>
    
      <td    >POIDS</td>

            <td   >SACS</td>
    
      <td  >POIDS</td>

      <td  >SACS</td>
    
      <td   >POIDS</td>
            <td  >SACS</td>
    
      <td  >POIDS</td>
     
          
        
     



   
     </tr>
      

     
     
      


      
     </thead>


<tbody>
  <?php $compte=$compterecond->fetch();

  if($compte['count(id_dis_recond)']<1){ ?>
      <tr style="text-align: center;">
        <td colspan="13">AUCUN ENREGISTREMENT</td>
      </tr>
    <?php } ?> 
  <?php while($rec=$recond->fetch()){ 

       

  $recond2 = $bdd->prepare("SELECT sum(sac_eventres), sum(poids_eventres), count(sac_av_recond), sum(sac_av_recond), sum(poids_av_recond),sum(sac_balayure_recond), sum(poids_balayure_recond)  from reconditionnement_reception
                   WHERE id_recond<=? ");
        
        
        $recond2 ->bindParam(1,$rec['id_recond']);
        $recond2 ->execute();

     
        $SomAvr->execute();

        $SomRa->execute();


       



 
        

        $MyPoids->execute();




    $avr=$SomAvr->fetch();
$ra=$SomRa->fetch();
$poids=$MyPoids->fetch();
$rec2=$recond2->fetch();

    

$poidsf_avr=$avr['sum(sac_flasque_avr)']*$poids['poids_kg']/1000;
$sacflasque=$avr['sum(sac_flasque_avr)']+$ra['sum(sac_flasque_ra)'];
$poidsflasque=$poidsf_avr+$ra['sum(poids_flasque_ra)'];
$perte=$rec['sac_eventres']-$rec['sac_av_recond']-$rec['sac_balayure_recond'];




//$perte_recul recupere de valeur de l'avant dernier du perte en sac pour l'afficher dans la cellule suivante du flasques receptionnés 
$perte_recul=$sacflasque-$rec2['sum(sac_eventres)'] ;
$poids_recul=$perte_recul*$poids['poids_kg']/1000;
 
 $date=explode('-', $rec['dates_recond']);
   
  /*  
   $diff=$aff['poids_declarer']-$aff['sum(rec.poids_recep)'];

   $float = $bdd->prepare("SELECT count(bl_recep) from reception

                   WHERE id_dis_recep_bl=? and dates_recep=? and id_recep<=?  ");
        
        $float->bindParam(1,$c);
        $float->bindParam(2,$aff['dates_recep']);
        $float->bindParam(3,$aff['id_recep']);

        $float->execute();
        $f=$float->fetch(); */
     
    ?>
   
      
     <tr id="tr_data_sain" >

      <td style="width: 2%;" class="colaffiche"> <?php echo $rec2['count(sac_av_recond)'] ?>

<td style="width: 8%;" class="colaffiche" > <?php echo  $date[2].'-'.$date[1].'-'.$date[0] ?></td>
<?php if( $recligne=$recondLigne->fetch()){ 
  $avrLigne=$SomAvrLigne->fetch();
$raLigne=$SomRaLigne->fetch();
 $poidsf_avrLigne=$avrLigne['sum(sac_flasque_avr)']*$poids['poids_kg']/1000;

$sacflasqueLigne=$avrLigne['sum(sac_flasque_avr)']+$raLigne['sum(sac_flasque_ra)'];
$poidsflasqueLigne=$sacflasqueLigne*$poids['poids_kg']/1000;

  ?>
<td style="width: 8%;" class="colaffiche" rowspan="<?php echo $recligne['count(sac_av_recond)'] ?>" > <?php echo number_format($sacflasqueLigne, 0,',',' '); ?> </td>
    <td style="width: 8%;" class="colaffiche" rowspan="<?php echo $recligne['count(sac_av_recond)'] ?>" ><?php echo number_format($poidsflasqueLigne, 3,',',' '); ?></td>
  
  <?php } ?>
   
   <td style="width: 10%;" class="colaffiche"> <?php echo number_format($rec['sac_eventres'], 0,',',' '); ?></td>
    <td style="width: 10%;" class="colaffiche"><?php echo number_format($rec['poids_eventres'], 3,',',' '); ?></td>
    <td style="width: 8%;" class="colaffiche"> <?php echo number_format($rec['sac_av_recond'], 0,',',' '); ?></td>
    <td style="width: 8%;" class="colaffiche"><?php echo number_format($rec['poids_av_recond'], 3,',',' '); ?></td>

    
    <td style="width: 10%;" class="colaffiche"><?php echo number_format($rec['sac_balayure_recond'], 0,',',' '); ?></td>


    <td style="width: 10%;" id="mytd" class="colaffiche"><?php echo number_format($rec['poids_balayure_recond'], 3,',',' '); ?></td>
    <td style="width: 8%;" id="mytd" class="colaffiche"><?php echo number_format($perte, 0,',',' '); ?></td>

     <td style="width: 10%;" class="colaffiche" > <?php if($rec2['count(sac_av_recond)']==1){ echo number_format($perte_recul, 0,',',' '); } if($rec2['count(sac_av_recond)']>1){ echo number_format($perte_recul, 0,',',' '); }  ?> </td>
    <td style="width: 10%;" class="colaffiche" > <?php if($rec2['count(sac_av_recond)']==1){ echo number_format($poidsflasqueLigne, 3,',',' '); } if($rec2['count(sac_av_recond)']>1){ echo number_format($poids_recul, 3,',',' '); }  ?> </td>

   
      


</tr>


  <?php   } ?>




</tbody>
             

            

</table>
</div>
</div>
</div>
<br><br>

<?php 
    // FILTRER LE NAVIRE SI C SACHERIE ON AFFICHE LE TRANSFERT DES AVARIES
   $filtreavaries= $bdd->prepare("SELECT  nav.navire,nav.type, dis.id_dis   FROM dispatching as dis 
                
                 

                inner join navire_deb as nav on dis.id_navire=nav.id 
                
               
                 

                   WHERE dis.id_dis=?  ");
        $filtreavaries->bindParam(1,$c);
        $filtreavaries->execute();
        $cherche=$filtreavaries->fetch();
    

          ?>

<div class="container-fluid" id="tableAvariesDeb" style="display: none;"> 

        <div class="row">
            
            
               
        <div class="col-md-12 col-lg-12">      


<div class="table-responsive" border=1>
  <center>  
 <table class='table table-hover table-bordered table-striped' id='table' border='2' style="width: 50%;" >

 <thead >
  <td   id="titreAVDEB" colspan="3"  >PV DE RECONDITIONNEMENT</td>     
    
    <tr id="tr_attente_avdeb"  >
      
      
      <td scope="col"    >NATURE DES SACS</td>
       <td scope="col"    >NOMBRE DE SACS </td>
              <td scope="col"    >POIDS</td>
       

      
     
  </tr>
   
      </tr>
      

     
     
    


      
     </thead>


<tbody>



 <?php  while($rec=$recondPV->fetch()){ 
  $avr=$SomAvrPV->fetch();
  $type=$type_nav_pv->fetch();

  
 $poids= $MyPoidsPV->fetch();
 $sain=$SainsPV->fetch();

if($type['type']=="SACHERIE"){
  $SomRaPV ->execute();

$ra=$SomRaPV->fetch();

 $Tsacflasque=$avr['sum(sac_flasque_avr)']+$ra['sum(sac_flasque_ra)'];
 $poidsf_avr=$avr['sum(sac_flasque_avr)']*$sain['poids_sac_recep']/1000;
 $Tpoidsflasque= $poidsf_avr+$ra['sum(poids_flasque_ra)'];

 
 $SacSain=$sain['sum(sac_recep)']-$avr['sum(sac_flasque_avr)']-$avr['sum(sac_mouille_avr)']-$ra['sum(sac_flasque_ra)']-$ra['sum(sac_mouille_ra)']+$rec['sum(sac_av_recond)'];
 $poidsSain=$SacSain*$sain['poids_sac_recep']/1000;
 $poidsflasque=$poidsf_avr+$ra['sum(poids_flasque_ra)'];
 $SacMouille=$avr['sum(sac_mouille_avr)']+$ra['sum(sac_mouille_ra)'];
 $poidsMouille=$SacMouille*$sain['poids_sac_recep']/1000;

  $total_sac=$SacSain+$SacMouille+$rec['sum(sac_balayure_recond)'];
  $total_poids=$poidsSain+$poidsMouille+$rec['sum(poids_balayure_recond)'];

  $perte_sac=$Tsacflasque-$rec['sum(sac_av_recond)']-$rec['sum(sac_balayure_recond)'];
  $perte_poids=$Tpoidsflasque-$rec['sum(poids_av_recond)']-$rec['sum(poids_balayure_recond)'];
  $sac_depart=$SacSain+$SacMouille+$rec['sum(sac_balayure_recond)'];
  $poids_depart=$poidsSain+$poidsMouille+$rec['sum(poids_balayure_recond)'];

}


if($type['type']=="VRAQUIER"){



 $Tsacflasque=$avr['sum(sac_flasque_avr)'];
 $poidsf_avr=$avr['sum(sac_flasque_avr)']*$sain['poids_sac_recep']/1000;
 $Tpoidsflasque= $poidsf_avr;

 
 $SacSain=$sain['sum(sac_recep)']-$avr['sum(sac_flasque_avr)']-$avr['sum(sac_mouille_avr)']+$rec['sum(sac_av_recond)'];
 $poidsSain=$SacSain*$sain['poids_sac_recep']/1000;
 $poidsflasque=$poidsf_avr;
 $SacMouille=$avr['sum(sac_mouille_avr)'];
 $poidsMouille=$SacMouille*$sain['poids_sac_recep']/1000;

  $total_sac=$SacSain+$SacMouille+$rec['sum(sac_balayure_recond)'];
  $total_poids=$poidsSain+$poidsMouille+$rec['sum(poids_balayure_recond)'];

  $perte_sac=$Tsacflasque-$rec['sum(sac_av_recond)']-$rec['sum(sac_balayure_recond)'];
  $perte_poids=$Tpoidsflasque-$rec['sum(poids_av_recond)']-$rec['sum(poids_balayure_recond)'];
  $sac_depart=$SacSain+$SacMouille+$rec['sum(sac_balayure_recond)']-$rec['sum(sac_av_recond)'];
  $poids_depart=$poidsSain+$poidsMouille+$rec['sum(poids_balayure_recond)'];

}




     
   ?>
   <tr>
     <td class="colaffiche">SACS SAINS</td>
     <td class="colaffiche" ><?php  echo number_format($SacSain,0,',',' '); ?></td>
     <td class="colaffiche"><?php  echo number_format($poidsSain,3,',',' '); ?></td>
   </tr>

      <tr>
     <td class="colaffiche">FLASQUES RECEPTIONNES</td>
     <td class="colaffiche" ><?php  echo number_format($Tsacflasque,0,',',' '); ?></td>
     <td class="colaffiche"><?php  echo number_format($Tpoidsflasque,3,',',' '); ?></td>
   </tr>
      <tr>
     <td class="colaffiche">MOUILLES RECEPTIONNES </td>
     <td class="colaffiche" ><?php  echo number_format($SacMouille,0,',',' '); ?></td>
     <td class="colaffiche"><?php  echo number_format($poidsMouille,3,',',' '); ?></td>
   </tr>
     <tr>
     <td class="colaffiche">SACS RECONDITIONNES </td>
     <td class="colaffiche" ><?php  echo number_format($rec['sum(sac_av_recond)'] ,0,',',' '); ?></td>
     <td class="colaffiche"><?php  echo number_format($rec['sum(poids_av_recond)'] ,3,',',' '); ?></td>
   </tr>
     <tr>
     <td class="colaffiche">BALAYURE </td>
     <td class="colaffiche" ><?php  echo number_format($rec['sum(sac_balayure_recond)'] ,0,',',' '); ?></td>
     <td class="colaffiche"><?php  echo number_format($rec['sum(poids_balayure_recond)'] ,3,',',' '); ?></td>
   </tr>
     <tr>
     <td class="colaffiche">PERTE </td>
     <td class="colaffiche" ><?php  echo number_format($perte_sac ,0,',',' '); ?></td>
     <td class="colaffiche"><?php  echo number_format($perte_poids ,3,',',' '); ?></td>
   </tr>
     <tr style="background: red; color: white;">
     <td class="colaffiche" style="color: white;">STOCK DE DEPART </td>
     <td class="colaffiche" style="color: white;" ><?php  echo number_format($sac_depart ,0,',',' '); ?></td>
     <td class="colaffiche" style="color: white;"><?php  echo number_format($poids_depart ,3,',',' '); ?></td>
   </tr>
 <?php } ?>
    


</tbody>
             

  
</table> 
</center>
</div>
</div>
</div>
</div>


<?php // formulaire pour inserer la situation 24H 

$donnees=$bdd->prepare("select * from dispatching  
   where id_dis=?");
   $donnees->bindParam(1,$c);
   $donnees->execute();  ?>

   




   
<?php } ?>
 