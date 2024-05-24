<?php  

require('../database.php');

if(isset($_POST['navire'])){

 $navire=$_POST['navire'];
 $produit=$_POST['produit'];
 $poids_sac=$_POST['poids_sac'];
 $destination=$_POST['destination'];
 $navire=$_POST['navire'];
 $declaration=$_POST['declaration'];
 $c=$_POST['id_dis'];
 $date=$_POST['date'];
 
 $sacf=$_POST['sacf'];
 $sac_eventres=$_POST['sac_eventres'];
 $poids_eventres=$sac_eventres*$poids_sac/1000;
 $sac_bal=$_POST['sac_bal'];
 $poids_bal=$_POST['poids_bal'];
 $poidsf=$sacf*$poids_sac/1000;

 





 try{
  $insert=$bdd->prepare("INSERT INTO reconditionnement_livraison(dates_recond_liv,sac_eventres_liv,poids_eventres_liv,sac_av_recond_liv,poids_av_recond_liv,sac_balayure_recond_liv,poids_balayure_recond_liv,poids_sac_recond_liv,id_produit_recond_liv,id_destination_recond_liv,id_navire_recond_liv,id_dis_recond_liv,id_declaration_recliv) values(?,?,?,?,?,?,?,?,?,?,?,?,?)");

$insert->bindParam(1,$date);
$insert->bindParam(2,$sac_eventres);
$insert->bindParam(3,$poids_eventres);
$insert->bindParam(4,$sacf);
$insert->bindParam(5,$poidsf);
$insert->bindParam(6,$sac_bal);
$insert->bindParam(7,$poids_bal);
$insert->bindParam(8,$poids_sac);
$insert->bindParam(9,$produit);
$insert->bindParam(10,$destination);
$insert->bindParam(11,$navire);
$insert->bindParam(12,$c);
$insert->bindParam(13,$declaration);
$insert->execute();
}

catch(PDOException $e){
    die('Erreur:' .$e->getMessage());
    
}


 ?>

 <div class="container-fluid" id="TableRecond" >  
  <br>

  
  <div class="col-md-12 col-lg-12">      
<a  class="btn1"  style="background: rgb(65,180,190); " data-bs-toggle="modal" data-bs-target="#form_reconditionnement" >AJOUTER RECONDITIONNEMENT  </a>
<br><br>
</div>

 <div class="col col-md-12 col-lg-12">
       
<div class="table-responsive" border=1 >



 <table class='table table-hover table-bordered table-striped table-responsive'  border='2'  >

 <thead style="background-color: rgba(50, 159, 218, 0.9);">
  <td  colspan="13" class="titreSAIN"  >RECONDITIONNEMENT</td>
      
    
    <tr id="th_table_rec"  >
      <td  rowspan="2"   >N°</td>
       <td   rowspan="2"   >DATE</td>
        <td   colspan="2"   >FLASQUES DE LIVRAISON</td>
        <td  rowspan="2"  >SACS DECHIRES</td>
     
      <td   colspan="2" > RECONDITIONNES</td>
      <td   colspan="2"  >BALAYURES </td>
     
     
      <td   rowspan="2" > PERTES EN SACS</td>
       <td   rowspan="2"  >FLASQUES RESTANTS</td>
  </tr>
      
 <tr id="th_table_rec" >
      <td   >SACS</td>
    
      <td    >POIDS</td>

   

            <td   >SACS</td>
    
      <td  >POIDS</td>

      <td  >SACS</td>
    
      <td   >POIDS</td>

     
          
        
     



   
     </tr>
      

     
     
      


      
     </thead>


<tbody>
  <?php

        $recond = $bdd->prepare("SELECT *  from reconditionnement_livraison
                   WHERE id_dis_recond_liv=? ");
        
        
        $recond ->bindParam(1,$c);
        $recond ->execute();

        
        $recondLigne = $bdd->prepare("SELECT count(sac_av_recond_liv)  from reconditionnement_livraison
                   WHERE id_dis_recond_liv=? ");
        
        
        $recondLigne->bindParam(1,$c);
        $recondLigne ->execute();
        
        $SomAvrLigne = $bdd->prepare("SELECT  sum(sac_flasque_liv) from avaries_de_livraison
                   WHERE id_dis_liv=? ");
        
        
        $SomAvrLigne->bindParam(1,$c);
        $SomAvrLigne->execute();
      



            /*              $SomRaLigne = $bdd->prepare("SELECT  sum(sac_flasque_liv),sum(sac_mouille_liv),sum(poids_flasque_liv),sum(poids_mouille_ra) from reception_avaries
                   WHERE id_dis_bl_ra=? ");
        
        
        $SomRaLigne->bindParam(1,$c);
        $SomRaLigne->execute(); */
            

       

        

                  $SomAvr = $bdd->prepare("SELECT  sum(sac_flasque_liv) from avaries_de_livraison
                   WHERE id_dis_liv=? ");
        $SomAvr->bindParam(1,$c);
         $SomAvr->execute();
      



      /*                    $SomRa = $bdd->prepare("SELECT  sum(sac_flasque_ra),sum(sac_mouille_ra),sum(poids_flasque_ra),sum(poids_mouille_ra) from reception_avaries
                   WHERE id_dis_bl_ra=? ");
        
        
        $SomRa->bindParam(1,$c); */
     

                         $MyPoids = $bdd->prepare("SELECT  poids_kg from dispatching
                   WHERE id_dis=? ");
        $MyPoids->bindParam(1,$c);
         $MyPoids->execute();

           $compterecond=$bdd->prepare("select count(id_dis_recond_liv) from reconditionnement_livraison where id_dis_recond_liv=?");
$compterecond->bindParam(1,$c);
$compterecond->execute();



   $compte=$compterecond->fetch();

  if($compte['count(id_dis_recond_liv)']<1){ ?>
      <tr style="text-align: center;">
        <td colspan="13">AUCUN ENREGISTREMENT</td>
      </tr>
    <?php } ?> 
  <?php while($rec=$recond->fetch()){ 

       

  $recond2 = $bdd->prepare("SELECT sum(sac_eventres_liv), sum(poids_eventres_liv), count(sac_av_recond_liv), sum(sac_av_recond_liv), sum(poids_av_recond_liv),sum(sac_balayure_recond_liv), sum(poids_balayure_recond_liv)  from reconditionnement_livraison
                   WHERE id_recond_liv<=? ");
        
        
        $recond2 ->bindParam(1,$rec['id_recond_liv']);
        $recond2 ->execute();

     
        $SomAvr->execute();

        $MyPoids->execute();




    $avr=$SomAvr->fetch();
//$ra=$SomRa->fetch();
$poids=$MyPoids->fetch();
$rec2=$recond2->fetch();

    

$poidsf_avr=$avr['sum(sac_flasque_liv)']*$poids['poids_kg']/1000;
$sacflasque=$avr['sum(sac_flasque_liv)'];
$poidsflasque=$poidsf_avr;
$perte=$rec['sac_eventres_liv']-$rec['sac_av_recond_liv']-$rec['sac_balayure_recond_liv'];




//$perte_recul recupere de valeur de l'avant dernier du perte en sac pour l'afficher dans la cellule suivante du flasques receptionnés 
$perte_recul=$sacflasque-$rec2['sum(sac_eventres_liv)'] ;
$poids_recul=$perte_recul*$poids['poids_kg']/1000;
 
 $date=explode('-', $rec['dates_recond_liv']);
   
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

      <td style="width: 5%;" class="colaffiche"> <?php echo $rec2['count(sac_av_recond_liv)'] ?>

<td style="width: 10%;" class="colaffiche" > <?php echo  $date[2].'-'.$date[1].'-'.$date[0] ?></td>
<?php if( $recligne=$recondLigne->fetch()){ 
  $avrLigne=$SomAvrLigne->fetch();
//$raLigne=$SomRaLigne->fetch();
 $poidsf_avrLigne=$avrLigne['sum(sac_flasque_liv)']*$poids['poids_kg']/1000;

$sacflasqueLigne=$avrLigne['sum(sac_flasque_liv)'];
$poidsflasqueLigne=$sacflasqueLigne*$poids['poids_kg']/1000;

  ?>
<td style="width: 8%;" class="colaffiche" rowspan="<?php echo $recligne['count(sac_av_recond_liv)'] ?>" > <?php echo number_format($sacflasqueLigne, 0,',',' '); ?> </td>
    <td style="width: 8%;" class="colaffiche" rowspan="<?php echo $recligne['count(sac_av_recond_liv)'] ?>" ><?php echo number_format($poidsflasqueLigne, 3,',',' '); ?></td>
  
  <?php } ?>
   
   <td style="width: 10%;" class="colaffiche"> <?php echo number_format($rec['sac_eventres_liv'], 0,',',' '); ?></td>
   
    <td style="width: 8%;" class="colaffiche"> <?php echo number_format($rec['sac_av_recond_liv'], 0,',',' '); ?></td>
    <td style="width: 8%;" class="colaffiche"><?php echo number_format($rec['poids_av_recond_liv'], 3,',',' '); ?></td>

    
    <td style="width: 10%;" class="colaffiche"><?php echo number_format($rec['sac_balayure_recond_liv'], 0,',',' '); ?></td>


    <td style="width: 10%;" id="mytd" class="colaffiche"><?php echo number_format($rec['poids_balayure_recond_liv'], 3,',',' '); ?></td>
    <td style="width: 8%;" id="mytd" class="colaffiche"><?php echo number_format($perte, 0,',',' '); ?></td>

     <td style="width: 10%;" class="colaffiche" > <?php if($rec2['count(sac_av_recond_liv)']==1){ echo number_format($perte_recul, 0,',',' '); } if($rec2['count(sac_av_recond_liv)']>1){ echo number_format($perte_recul, 0,',',' '); }  ?> </td>
   

   
      


</tr>


  <?php   } ?>




</tbody>
             

            

</table>
</div>
</div>
</div>

<?php } ?>




