<?php 
require('../database.php');
 require('controller/afficher_les_debarquements.php');
$poids_sac= $_POST['poids_sac'];
$navire= $_POST['navire'];

 $destination= $_POST['mangasin'];
  $produit= $_POST['id_produit'];

if (isset($_POST['navire'])) {
    // code...
    if(!empty($_POST['navire']) and !empty($_POST['id_produit'])  and !empty($_POST['poids_sac']) and !empty($_POST['dates'])    and !empty($_POST['cale']) and !empty($_POST['heure']) and !empty($_POST['declaration']) and !empty($_POST['bl']) /* and !empty($_POST['camions']) and !empty($_POST['chauffeur'])  and !empty($_POST['permis']) and !empty($_POST['tel'])  and !empty($_POST['transport'])*/       ){

        $nav=$_POST['navire'];
        $prod=$_POST['id_produit'];
        $poids=$_POST['poids_sac']; 
        $date=$_POST['dates'];
        $heure=$_POST['heure'];
        $declaration=$_POST['declaration'];
        $c=$_POST['id_dis'];
        
        $cale=$_POST['cale']; 
        //$chauffeur=$_POST['chauffeur'];
        $camions=$_POST['val_input3'];
        $chauffeur=$_POST['val_input3c'];
        //$cam=explode(",", $chauffeur);
       // $permis=$_POST['permis'];
       // $tel=$_POST['tel'];
       // $transport=$_POST['transport'];
        $essai=9;
        $essai2=1;

         
        $bl=$_POST['bl']; 
        $sacf=$_POST['sacf']; 
         $sacm=$_POST['sacm']; 
          $poidsf=$_POST['poidsf']; 
          $poidsm=$_POST['poidsm'];
        $poids_net=$_POST['poids_sac'];
        $client=$_POST['client'];
        $destination=$_POST['mangasin'];
         $autre_destination=$_POST['autre_destinataire'];

        $destinataire=$_POST['destinataire'];
        if(empty($sacf)){
          $sacf=0;
        }
         if(empty($sacm)){
          $sacm=0;
        }

        $poids_mouille=$sacm*$poids/1000;

try{


    $insertRecep1= $bdd->prepare("INSERT INTO transfert_avaries(date_tr_avaries,heure_tr,cale_tr_avaries,bl_tr,id_cam,id_chauffeur_tr,sac_flasque_tr_av,poids_flasque_tr_av,sac_mouille_tr_av,poids_mouille_tr_av,id_dis_bl_tr,id_declaration_tr,poids_sac_tr_av,id_produit,id_client,id_destination_tr,id_navire,autre_destination_tr,destinataire_tr) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)"); 

    $insertRecep1->bindParam(1,$date); 
$insertRecep1->bindParam(2,$heure);

$insertRecep1->bindParam(3,$cale);
$insertRecep1->bindParam(4,$bl);

$insertRecep1->bindParam(5,$camions);
$insertRecep1->bindParam(6,$chauffeur);
$insertRecep1->bindParam(7,$sacf);
$insertRecep1->bindParam(8,$poidsf);
$insertRecep1->bindParam(9,$sacm);

$insertRecep1->bindParam(10,$poids_mouille);
$insertRecep1->bindParam(11,$c);
$insertRecep1->bindParam(12,$declaration);
$insertRecep1->bindParam(13,$poids_sac);
$insertRecep1->bindParam(14,$produit);
$insertRecep1->bindParam(15,$client);
$insertRecep1->bindParam(16,$destination);
$insertRecep1->bindParam(17,$navire);
 $insertRecep1->bindParam(18,$autre_destination);
 $insertRecep1->bindParam(19,$destinataire);
 $insertRecep1->execute();
 echo   'Insertion reussi';

$select=$bdd->query("select id_tr_avaries from transfert_avaries order by id_tr_avaries desc");
$sel=$select->fetch();
if($sel){
    $insert=$bdd->prepare("INSERT INTO pre_reception_avaries(id_pre_tr_av) values(?)" );
    $insert->bindParam(1,$sel['id_tr_avaries']);
    $insert->execute();

}

}
catch(Exception $e){

    }

}
    else{
 echo '<center><div  class="err" id="erreur" ><button  type="button" class="btn-close"  id="close_erreur" onclick="fermer()" ></button><h3 id="perreur"> ERREUR</h3>
 <h5 id="perreur"> Veuillez si tous les les champs ont été bien saisi ou selectionner</h5></div></center>';
 
}



/* $afficheAvaries = $bdd->prepare("SELECT p.produit,p.qualite,nav.navire,nav.type,cli.client,mang.mangasin,trp.*,trs.*,ch.*,trav.*,cam.*, sum(trav.sac_flasque_tr_av),sum(trav.poids_flasque_tr_av),sum(trav.poids_mouille_tr_av),sum(trav.sac_mouille_tr_av)   FROM transfert_avaries as trav 
                
                inner join  produit_deb as p on trav.id_produit=p.id 

                inner join navire_deb as nav on trav.id_navire=nav.id 
                
                inner join client as cli on trav.id_client=cli.id
                inner join mangasin as mang on trav.id_destination_tr=mang.id
                left join camions as cam on trav.id_cam=cam.id_camions
                left join transporteur as trp on cam.id_trans=trp.id
                left join chauffeur as ch on trav.id_chauffeur_tr=ch.id_chauffeur 
                inner join transit as trs on trav.id_declaration_tr=trs.id_trans

                   WHERE trav.id_dis_bl_tr=? and trav.bl_tr!='ref' group by trav.date_tr_avaries, trav.id_tr_avaries with rollup ");
        
        
        $afficheAvaries->bindParam(1,$c);
        $afficheAvaries->execute(); */




 ?>


<div id="tr_avariess">
<div class="container-fluid" id="TableAvariesTrans" >
  <div class="entete_image" style="background-image: url('../images/bg_page.jpg'); background-repeat: no-repeat; background-size: 100%; background-color: blue;  ">
        <center> 
              
     

  </div>
<br>

        <div class="col-md-12 col-lg-12">      
<button type="submit" class="btn1" data-bs-toggle="modal" data-bs-target="#enregistrement_transfert" >Insertion transfert avaries</button>
<br><br>


</span>
    </div>

 <div class="table-responsive" border=1>
<?php


 echo " <table class='table table-hover table-bordered table-striped' id='table' border='2' >";
    
?> 
 <thead >
    <td  colspan="15" class="titreTRANSAV" style="background: linear-gradient(-45deg, #004362, #0183d0) !important;" >TRANSFERT DES AVARIES DE DEBARQUEMENT</td>   

    
    <tr id="entete_table_transfert_avaries" style="background: linear-gradient(-45deg, #004362, #0183d0) !important;" >
      
      
      
       <td scope="col"  rowspan="3"  style="vertical-align: middle;">DATES</td>
              <td scope="col"  rowspan="3" style="vertical-align: middle;" >HEURE</td>
                     <td scope="col"  rowspan="3" style="vertical-align: middle;" >CALE</td>
                      <td scope="col"  rowspan="3" style="vertical-align: middle;" >BL</td>
               <td scope="col" rowspan="3" style="vertical-align: middle;" >CAMIONS</td> 
               <td scope="col"  rowspan="3"  style="vertical-align: middle;">CHAUFFEUR</td>
               <td scope="col"  rowspan="3" style="vertical-align: middle;" >TRANSPORTEUR</td>
               <td scope="col"  rowspan="3"style="vertical-align: middle;" >N°DEC / TRANSFERT</td>            
      <td scope="col" colspan="2" >FLASQUES</td>
      <td scope="col" colspan="2" >MOUILLES</td>
      <td scope="col" colspan="2" >TOTAL AVARIES</td>
      <td scope="col" rowspan="2"  >ACTIONS</td>
      
     
  </tr>
    <tr id="entete_table_transfert_avaries" style="background: linear-gradient(-45deg, #004362, #0183d0) !important;">
      
      <td scope="col"   >SACS</td>
      <td scope="col"  >POIDS</td>
      <td scope="col" >SACS</td>
      <td scope="col"  >POIDS</td>
      <td scope="col" >SACS</td>
      <td scope="col" >POIDS</td>
      </tr>
      

     
     
    


      
     </thead>


<tbody>
  <?php 

      echo  $nav=$_POST['navire'];
       echo $prod=$_POST['id_produit'];
      echo  $poids=$_POST['poids_sac']; 
      echo  $date=$_POST['dates'];
      echo  $heure=$_POST['heure'];
      echo  $declaration=$_POST['declaration'];
      echo  $c=$_POST['id_dis'];
      echo  $cale=$_POST['cale']; 
        //$chauffeur=$_POST['chauffeur'];
      echo  $camions=$_POST['val_input3'];
      echo  $chauffeur=$_POST['val_input3c'];
        
        $cale=$_POST['cale']; 
        //$chauffeur=$_POST['chauffeur'];
        $camions=$_POST['val_input3'];
        $chauffeur=$_POST['val_input3c']; ?>
 <?php affichage_transfert_avaries($bdd,$produit,$poids_sac,$navire,$destination); ?>


</tbody>
             

  
</table> 
</div>  
</div>
</div>



<?php } ?>


