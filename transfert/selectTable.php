<?php
require('../database.php');
require('controller/afficher_les_debarquements.php');
?>
<?php include("tr_link.php"); ?>
<style type="text/css">
 *{
  font-family: Times New Roman;
 } 
 .fabtn{
  border: none;
  
  color:rgb(0,141,202);

 }
  .fabtn1{
  border: none;
 
  color:rgb(0,141,202);

 }
 .btn1{
  background: linear-gradient(to bottom, blue, #1B2B65); background: linear-gradient(to left, blue, #1B2B65); background: linear-gradient(to top, blue, #1B2B65);
 }

    
  .modal-header{
      
     /* background-image: url("images/simar2.jpg");
      background-repeat: no-repeat;
      background-size: 100%;
      background: #1B2B65;*/
       background: linear-gradient(to bottom, blue, #1B2B65);
       background: linear-gradient(to top, blue, #1B2B65);
       background: linear-gradient(to left, blue, #1B2B65);
      
      border-bottom-left-radius: 35%;
      border-bottom-right-radius: 35%;
      border: solid;
      border-color: rgb(145,145,255);
      border-width: 8px;
      height: 100px;
    }
    
 .logoo{
      border-radius: 50px;
       height: 200px;
        width: 200px;
        margin-left: 40%;
        z-index: 2;
        text-align: center;

    }

    .mytd{
      font-size:14px;
    }
    


</style>




<?php /*$verific=$bdd->query("SELECT count(rm.bl), rm.bl, nav.id,nav.navire from register_manifeste as rm
      inner join navire_deb as nav on nav.id=rm.id_navire and rm.bl!='ref'
       group by rm.bl 

      "); 
$calculerreur=$bdd->query("SELECT count(sub.total_count) AS total_sum
FROM (
    SELECT COUNT(rm.bl) AS total_count
    FROM register_manifeste AS rm
    INNER JOIN navire_deb AS nav ON nav.id = rm.id_navire AND rm.bl != 'ref'
    GROUP BY rm.bl
    HAVING COUNT(rm.bl)>1
) AS sub;") ; */
      ?>


<?php 



  if(isset($_POST["idProduit"])){
 

$c=$_POST["idProduit"];
//$_SESSION['c']=$c;

 $explode=explode('-', $c);

      $produit=$explode[0];
      $poids_sac=$explode[1];
      $navire=$explode[2];
      $destination=$explode[3];
      $id_dis=$explode[4];

      $transfert_sain=$_POST['transfert_sain'];
      $transfert_des_avaries=$_POST['transfert_des_avaries'];
      $avaries_de_deb=$_POST['avaries_de_deb'];



     /*   echo    $produit;
     echo $poids_sac;
     echo $navire;
    echo  $destination; */
    


      
/*
         $res4n= $bdd->prepare("SELECT  p.produit,p.qualite,nav.navire,cli.client,mang.mangasin, nav.id, nav.type, dis.*   FROM dispatching as dis 
                
                inner join  produit_deb as p on dis.id_produit=p.id 

                inner join navire_deb as nav on dis.id_navire=nav.id 
                
                inner join client as cli on dis.id_client=cli.id
                inner join mangasin as mang on dis.id_mangasin=mang.id
                 

                   WHERE dis.id_dis=?  ");
        $res4n->bindParam(1,$c);
        $res4n->execute(); */

 

        $resdesModif= $bdd->prepare("SELECT trans.*, dis.*   FROM dispatching as dis 
                inner join transit as trans on dis.id_dis=trans.id_bl

                   WHERE dis.id_dis=? 
                   ");
        $resdesModif->bindParam(1,$c);
      //S  $resdesModif->execute();

          $resdes2= $bdd->prepare("SELECT trans.*, dis.*   FROM dispatching as dis 
                inner join transit as trans on dis.id_dis=trans.id_bl

                   WHERE dis.id_dis=? 
                   ");
        $resdes2->bindParam(1,$c);
       // $resdes2->execute();
        

        

        $rescaleAvaries= $bdd->prepare("SELECT  *  FROM dispatching 
               

                   WHERE id_dis=? 
                   ");
        $rescaleAvaries->bindParam(1,$c);
     //   $rescaleAvaries->execute();

       

        $rescale1= $bdd->prepare("SELECT * FROM dispatching 

                   WHERE id_dis=? 
                   ");
        $rescale1->bindParam(1,$c);
       // $rescale1->execute();


 



      $res3_avt = $bdd->prepare("SELECT  p.produit,p.qualite,nav.navire,cli.client,mang.mangasin, nav.id, nav.type, dis.*   FROM dispatching as dis 
                
                inner join  produit_deb as p on dis.id_produit=p.id 

                inner join navire_deb as nav on dis.id_navire=nav.id 
                
                inner join client as cli on dis.id_client=cli.id
                inner join mangasin as mang on dis.id_mangasin=mang.id
                

                   WHERE dis.id_dis=? ");
        
        $res3_avt ->bindParam(1,$c);
     //   $res3_avt ->execute();


      $res3_avDEB = $bdd->prepare("SELECT  p.produit,p.qualite,nav.navire,cli.client,mang.mangasin, nav.id, nav.type, dis.*   FROM dispatching as dis 
                
                inner join  produit_deb as p on dis.id_produit=p.id 

                inner join navire_deb as nav on dis.id_navire=nav.id 
                
                inner join client as cli on dis.id_client=cli.id
                inner join mangasin as mang on dis.id_mangasin=mang.id
                

                   WHERE dis.id_dis=? ");
        
       $res3_avDEB ->bindParam(1,$c);
      // $res3_avDEB ->execute();

        
  



$resfiltre =resfiltre($bdd,$produit,$poids_sac,$navire,$destination);



        $filtreColonne= filtreColonne($bdd,$produit,$poids_sac,$navire,$destination);
       // $filtre2=$filtreColonne->fetch();


   
$transport=$bdd->query("select * from transporteur order by id desc");

    /*      $resbl= $bdd->prepare("SELECT  dis.*, bl.*   FROM bl
          inner join dispatching as dis on bl.id_n_bl=dis.id_dis 
               

                   WHERE bl.id_n_bl=? 
                   ");
        $resbl->bindParam(1,$c);
        $resbl->execute(); */

    /*     $rob=$bdd->prepare("select dis.*,  rm.*, sum(rm.sac),sum(rm.poids), n.type FROM dispatching as dis
         
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
         $rob_dec2->execute(); */



  


/*
$res3 = $bdd->prepare("SELECT  p.produit,p.qualite,nav.navire,cli.client,mang.mangasin, nav.id, nav.type, dis.*   FROM dispatching as dis 
                
                inner join  produit_deb as p on dis.id_produit=p.id 

                inner join navire_deb as nav on dis.id_navire=nav.id 
                
                inner join client as cli on dis.id_client=cli.id
                inner join mangasin as mang on dis.id_mangasin=mang.id
                

                   WHERE dis.id_dis=? ");
        
        $res3->bindParam(1,$c);
        
        
        $res3->execute(); */




/*

         $rob_avt=$bdd->prepare("select dis.*,  rm.*, sum(rm.sac),sum(rm.poids), n.type FROM dispatching as dis
         
          inner  join register_manifeste as rm on  dis.id_produit=rm.id_produit and dis.id_dis=rm.id_dis_bl
          and dis.id_mangasin=rm.id_destination

          and dis.poids_kg=rm.poids_sac and dis.id_navire=rm.id_navire
        inner join navire_deb as n on dis.id_navire=n.id
          
         where  dis.id_dis=?  ");
         $rob_avt->bindParam(1,$c);
         $rob_avt->execute();

         $rob_colone_avt=$bdd->prepare("select n.type , dis.poids_kg, dis.* from dispatching as dis inner join navire_deb as n
         on n.id=dis.id_navire where dis.id_dis=?");
         $rob_colone_avt->bindParam(1,$c);
         $rob_colone_avt->execute();
         

         $rob_dec_avt=$bdd->prepare("SELECT trans.poids_declarer, trans.numero_declaration, sum(rm.sac), sum(rm.poids) from transit as trans left join register_manifeste as rm on trans.id_trans=rm.id_declaration
            
          WHERE trans.id_bl=?  group by trans.numero_declaration");
                   $rob_dec_avt->bindParam(1,$c);
         $rob_dec_avt->execute();

          $rob_dec2_avt=$bdd->prepare("SELECT trans.poids_declarer, trans.numero_declaration,  sum(tr.poids_flasque_tr_av),sum(tr.poids_mouille_tr_av)  from transit as trans  
           left join transfert_avaries as tr on trans.id_trans=tr.id_declaration_tr 
          WHERE trans.id_bl=?  group by trans.numero_declaration");
                   $rob_dec2_avt->bindParam(1,$c);
         $rob_dec2_avt->execute();


         $rob_avr=$bdd->prepare("select dis.*,  rm.*, sum(rm.sac),sum(rm.poids), n.type FROM dispatching as dis
         
          inner  join register_manifeste as rm on  dis.id_produit=rm.id_produit and dis.id_dis=rm.id_dis_bl
          and dis.id_mangasin=rm.id_destination

          and dis.poids_kg=rm.poids_sac and dis.id_navire=rm.id_navire
        inner join navire_deb as n on dis.id_navire=n.id
          
         where  dis.id_dis=?  ");
         $rob_avr->bindParam(1,$c);
         $rob_avr->execute();

         $rob_colone_avr=$bdd->prepare("select n.type , dis.poids_kg, dis.* from dispatching as dis inner join navire_deb as n
         on n.id=dis.id_navire where dis.id_dis=?");
         $rob_colone_avr->bindParam(1,$c);
         $rob_colone_avr->execute();
         

         $rob_dec_avr=$bdd->prepare("SELECT trans.poids_declarer, trans.numero_declaration, sum(rm.sac), sum(rm.poids) from transit as trans left join register_manifeste as rm on trans.id_trans=rm.id_declaration
            
          WHERE trans.id_bl=?  group by trans.numero_declaration");
                   $rob_dec_avr->bindParam(1,$c);
         $rob_dec_avr->execute();

          $rob_dec2_avr=$bdd->prepare("SELECT trans.poids_declarer, trans.numero_declaration,  sum(tr.poids_flasque_tr_av),sum(tr.poids_mouille_tr_av)  from transit as trans  
           left join transfert_avaries as tr on trans.id_trans=tr.id_declaration_tr 
          WHERE trans.id_bl=?  group by trans.numero_declaration");
                   $rob_dec2_avr->bindParam(1,$c);
         $rob_dec2_avr->execute();

               $res3_avr = $bdd->prepare("SELECT  p.produit,p.qualite,nav.navire,cli.client,mang.mangasin, nav.id, nav.type, dis.*   FROM dispatching as dis 
                
                inner join  produit_deb as p on dis.id_produit=p.id 

                inner join navire_deb as nav on dis.id_navire=nav.id 
                
                inner join client as cli on dis.id_client=cli.id
                inner join mangasin as mang on dis.id_mangasin=mang.id
                

                   WHERE dis.id_dis=? ");
        
        $res3_avr ->bindParam(1,$c);
        $res3_avr ->execute();


       

                $affiche = $bdd->prepare("SELECT p.produit,p.qualite,nav.navire,nav.type,cli.client,mang.mangasin,trp.*,trs.*,ch.*, manif.*, dis.*, sum(manif.sac),sum(manif.poids),cam.*   FROM register_manifeste as manif 
                inner join dispatching as dis on manif.id_dis_bl=dis.id_dis
                inner join  produit_deb as p on dis.id_produit=p.id 

                inner join navire_deb as nav on dis.id_navire=nav.id 
                
                inner join client as cli on dis.id_client=cli.id
                inner join mangasin as mang on dis.id_mangasin=mang.id
                
                left join chauffeur as ch on manif.chauffeur=ch.id_chauffeur 
                left join camions as cam on manif.camions=cam.id_camions
                left join transporteur as trp on cam.id_trans=trp.id
                inner join transit as trs on manif.id_declaration=trs.id_trans

                   WHERE manif.id_dis_bl=? and manif.bl!='ref' group by manif.dates, manif.id_register_manif with rollup ");
        
        
        
        $affiche->bindParam(1,$c);
        $affiche->execute(); */

  

        /*      $afficheAvaries = $bdd->prepare("SELECT  p.produit,p.qualite,nav.navire,nav.type,cli.client,mang.mangasin,trp.*,trs.*,ch.*,trav.*,cam.*, sum(trav.sac_flasque_tr_av),sum(trav.poids_flasque_tr_av),sum(trav.poids_mouille_tr_av),sum(trav.sac_mouille_tr_av)   FROM transfert_avaries as trav 
                
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

/*

         $selcale = $bdd->prepare("select id_navire from dispatching where id_dis=?");
         $selcale->bindParam(1,$c);
         $selcale->execute();
         while ($roow=$selcale->fetch()) {
           $selcale2 = $bdd->prepare("select dc.*, p.* from declaration_chargement as dc
           inner join produit_deb as p on dc.id_produit=p.id
            where id_navire=?");
         $selcale2->bindParam(1,$roow['id_navire']);
         $selcale2->execute();
         }



           $avaries0 = $bdd->prepare("select id_navire from dispatching where id_dis=?");
         $avaries0->bindParam(1,$c);
        $avaries0->execute();
         while ($roow=$avaries0->fetch()) {
           $avaries = $bdd->prepare("select dc.*, p.* from declaration_chargement as dc
           inner join produit_deb as p on dc.id_produit=p.id
            where id_navire=?");
         $avaries->bindParam(1,$roow['id_navire']);
         $avaries->execute();
         }
         
         
        
          $cli_desti0 = $bdd->prepare("select id_navire from dispatching where id_dis=?");
         $cli_desti0->bindParam(1,$c);
        $cli_desti0->execute();
        while ( $roow=$cli_desti0->fetch()) {

         $cli_desti=$bdd->prepare("select * from dispatching where id_navire=?");
          $cli_desti->bindParam(1,$roow['id_navire']);
          $cli_desti->execute();
      }

         $camions= $bdd->query("SELECT c.*,tr.* FROM camions as c
          inner join transporteur as tr on c.id_trans=tr.id
                  group by c.num_camions ");
         $camions2= $bdd->query("SELECT  * FROM camions 
                  group by num_camions ");
         $camionsModif= $bdd->query("SELECT * FROM camions 
                  group by num_camions ");
          $chauffeurs= $bdd->query("SELECT * FROM chauffeur 
                  group by nom_chauffeur ");

 */
  

        ?>





  

<?php /*$bouton=$bdd->prepare("SELECT nav.type, dis.id_navire from dispatching as dis inner join navire_deb as nav on nav.id=dis.id_navire where dis.id_navire=? ");
      $bouton->bindParam(1,$navire);
      $bouton->execute();
      $btn=$bouton->fetch(); */
      $bouton=$bdd->prepare("SELECT nav.type, dis.id_con_dis, nc.id_navire from dispat as dis
        inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
   inner join navire_deb as nav on nav.id=nc.id_navire where nc.id_navire=? ");
      $bouton->bindParam(1,$navire);
      $bouton->execute();
      $btn=$bouton->fetch() ?>

 
<div class="container-fluid LesOperations" style="background: white; ">
  <div class="row">
   
      <center>
      <div class="col col-sm-12 col-md-12 col-lg-12">
         <span class="lien_debut"> 
        <button class="dropdown-toggle" style="display: flex; justify-content: center; color: blue; border:solid; border-color: blue; border-radius: 50px; width: 20%; font-size:16px;  background: white; align-items: center;  "  class="btn " type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >TRANSFERT</button>
         <ul id="drop_debarquement" class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="background: white;">
          <center>
          <li>
          <button  style="display: flex; justify-content: center; color: white; border:solid; border-color: blue; border-radius: 50px; background: white;  "  class="btn " id="btnSain"  onclick="visibleSain()">SAINS</button>
        </li>
                <?php //if($btn['type']=="SACHERIE"){ ?>
          <li><button style=" display: flex; justify-content: center; color: blue; border:solid; border-color: blue; border-radius: 50px;  background: white;  "  class="btn " id="btnMouille"  onclick="visibleAvariesDeb()"    >MOUILLES</button></li>
           <li><button style=" display: flex; justify-content: center; color: blue; border:solid; border-color: blue; border-radius: 50px;  background: white  "  class="btn " id="btnFlasque" onclick="visibleAvariesTrans()">FLASQUES</button></li>
            <li><button style=" display: flex; justify-content: center; color: blue; border:solid; border-color: blue; border-radius: 50px;  background: white  "  class="btn " id="btnBalayure" onclick="visibleRecepBalayure()">BALAYURES</button></li>
         
            </center>
          </ul>
           <button style="display: flex; justify-content: center; color: blue; border:solid; border-color: blue; border-radius: 50px; background: white; width:  "  class="btn " id="btnAvariesRep" onclick="visibleAvariesRep()">AVARIES DE DEBARQUEMENT</button>
            <?php //} ?>
      <div style="">
        <input type="" name="" id="input_navire" value="<?php echo $navire; ?>">
        <input type="" name="" id="input_produit" value="<?php echo $produit; ?>">
        <input type="" name="" id="input_destination" value="<?php echo $destination; ?>">
        <input type="" name="" id="input_poids_sac" value="<?php echo $poids_sac; ?>">
      </div>
          


       
    
      </span>
      </div>
        </center>
    <?php //} ?>

   
    

    <?php //} ?>
  </div>
</div>



<div class="container-fluid" id="TableSain" <?php if($transfert_sain==0){ ?> style="display: none; <?php } ?> width: 100%;">
<?php $statut=$_POST['statut'];
        ?>
<input type="text" name="" id="input_statut" value="<?php echo $statut; ?>">

      



  <div class="col-md-12 col-lg-12">      
<button id="insertion_sain" type="submit" class="btn1" data-bs-toggle="modal" data-bs-target="#enregistrement" >Insertion </button>

</div>



<div class="col col-md-12 col-lg-12" >
  <div class="table-responsive" id="tableau_sain" >

<table  class='table table-hover table-bordered table-striped table-responsive'  border='1'   >
    
 
 <thead style="background: linear-gradient(-45deg, #004362, #0183d0) !important;">
  <td  colspan="14" class="titreSAIN"  >TRANSFERT DES SACS SAINS <?php echo $statut; ?></td>
  <?php   $entete=entete_sain($bdd,$produit,$poids_sac,$navire,$destination);
          if($entetes=$entete->fetch()){ ?>
            <tr>  
            <td  colspan="14" style="background: linear-gradient(-45deg, #004362, #0183d0) !important; color: white;" >POIDS MANIFEST <?php   echo $entetes['sum(dis.quantite_poids)'];  ?></td>
            </tr>
          <?php   } ?>

  

       
    
    <tr id="entete_table_sain" style="vertical-align: middle;"   >
      <td  scope="col" style="width: 1%;"  >ROTA <br> TION</td>
      <td  scope="col"   >DATES</td>
      <td  scope="col"   >HEURE</td>
      <td  scope="col"  >CALE</td>
      <td  scope="col"  > N° BL</td>
      <td  scope="col"  >CAMIONS</td>
      <td  scope="col"  >CHAUFFEUR</td>
      
          <td  scope="col"  >TRANSPOR <br> TEUR</td>
      <td  scope="col"  >N°DEC / TRANSFERT</td>
      <?php if ($resfil=$resfiltre->fetch()) {
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
     <td  id="cacher_cellule" >ACTION</td>


   
     </tr>
      

      
     </thead>

    <tbody>
    <?php   affichage_sain_new($bdd,$produit,$poids_sac,$navire,$destination,$statut); ?> 
    </tbody>       

            

</table>
</div>

<a  style="margin:auto-right; width: 20%;" class="btn btn-primary hide-on-print" data-role="imprimer_tableau_sain">imprimer</a>
<button style="margin:auto-right;" class="btn btn-primary no_print" onClick="imprimer('tableau_sain')">imprimer</button>
</div>
</div>










<?php   $filtreavaries= $bdd->prepare("SELECT  nav.navire,nav.type,nc.*, dis.id_dis   FROM dispat as dis 
                
                 
                inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
                inner join navire_deb as nav on nc.id_navire=nav.id 
                
               
                 

                   WHERE nc.id_navire=?  ");
        $filtreavaries->bindParam(1,$navire);
        $filtreavaries->execute();
        $cherche=$filtreavaries->fetch();
       if($cherche['type']=="SACHERIE"){  ?>

           

  
<div id="tr_avariess">
<div class="container-fluid" id="TableAvariesTrans" <?php if($transfert_des_avaries==0){ ?> style="display: none"; <?php } ?>>

  <div class="entete_image" style="background-image: url('../images/bg_page.jpg'); background-repeat: no-repeat; background-size: 100%; background-color: blue;  ">
        <center> 
              
        
        </div>


<br>


        <div class="col-md-12 col-lg-12">      
<button id="insertion_transfert" type="submit" class="btn1" data-bs-toggle="modal" data-bs-target="#enregistrement_transfert" >Insertion transfert avaries</button>



</span>
    </div>

 <div id="tableau_transfert" class="table-responsive" border=1>
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

<?php affichage_transfert_avaries($bdd,$produit,$poids_sac,$navire,$destination); ?>


</tbody>
             

  
</table> 
</div> 
<style type="text/css">
  @media print {
  .no_print {
    display: none;
  }
    #btnSain, #btnAvariesRep, #btnAvariesDeb, #tabledec1, #tabledec2, .menu, #sidebar, .operation, .container-fluid1, .sidebar, .topbar, .entete_image, #insertion_transfert, .bars, .cacher_cellule, .great , .LesOperations, #sit, .loader,.loader-overla,br {
    display: none !important;
  }


   .footer{
    display: none;
   }
  }
</style>

<a  style="margin:auto-right; width: 20%;" class="btn btn-primary hide-on-print" data-role="imprimer_tableau_transfert">imprimer</a>

<button style="margin:auto-right;" class="btn btn-primary no_print" onClick="imprimer('tableau_transfert')">imprimer</button>

</div>


</div>






<?php   } ?>

   
  <?php if($cherche['type']=="VRAQUIER"){  ?> 
 
<?php } ?>
       



 <?php 
 $element_form=element_du_formulaire($bdd,$produit,$poids_sac,$navire,$destination);
while($rown=$element_form->fetch()){

  ?>
  <div class="modal fade" id="form_camion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-centered" style="z-index: 1;">
    <div class="modal-content" style=" border: solid; border-color:rgb(0,141,202); " >
      <div class="modal-header bg-primary">
         <center>
        <h6 class="modal-title fs-10 text-white text-center" id="exampleModalLabel " style=" margin-left: 0px;   ">AJOUT NOUVEAU CAMION</h6></center>
        <center>
              <img class="logoo" src="../images/mylogo.ico" >
              </center>
       
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
         <div  id="message_add_camion"> </div>
        <form> 
          <?php $transporteur=$bdd->query('SELECT * from transporteur'); ?>
        <div>
        <input id="new_camion" style="float: left;" type="text" name="" placeholder="NUMERO DE CAMIONS" required/>
        <select style="float: right;" id="transporteur_add" required> 
          <option value="">Choisir un transporteur</option>
          <?php while($tp=$transporteur->fetch()){ ?>
            <option value="<?php echo $tp['id']; ?>" > <?php echo $tp['nom'] ?> </option>
          <?php } ?>
         </select> <br> 
         
      </div>
     </div>
      <div style="display: flex; justify-content: center;" class="modal-footer"> <center> <a class="btn btn-primary" data-role="ajout_new_camion" >
       AJOUTER</a></center> </div> 
        </form>
     
    </div>
   </div>
  </div>
 

 <div class="modal fade" id="form_transporteur" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-centered" style="z-index: 1;">
    <div class="modal-content" style=" border: solid; border-color:rgb(0,141,202); " >
      <div class="modal-header bg-primary">
         <center>
        <h6 class="modal-title fs-10 text-white text-center" id="exampleModalLabel " style=" margin-left: 0px;   ">AJOUT NOUVEAU TRANSPORTEUR</h6></center>
        <center>
              <img class="logoo" src="../images/mylogo.ico" >
              </center>
       
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
         <div  id="message_add_transporteur"> </div>
        <form> 
          
        <div>
          <center>
        <input id="new_transporteur" type="text" name="" placeholder="transporteur" required/>
        </center>
        
         
      </div>
     </div>
      <div style="display: flex; justify-content: center;" class="modal-footer"> <center> <a class="btn btn-primary" data-role="ajout_new_transporteur" >
       AJOUTER</a></center> </div> 
        </form>
     
    </div>
   </div>
  </div>


<div class="modal fade" id="form_chauffeur" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-centered" style="z-index: 1;">
    <div class="modal-content" style=" border: solid; border-color:rgb(0,141,202); " >
      <div class="modal-header bg-primary">
         <center>
        <h6 class="modal-title fs-10 text-white text-center" id="exampleModalLabel " style=" margin-left: 0px;   ">AJOUT NOUVEAU CHAUFFEUR</h6></center>
        <center>
              <img class="logoo" src="../images/mylogo.ico" >
              </center>
       
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
         <div  id="message_add_chauffeur"> </div>
        <form> 
          
        <div>
          <center>
        <input id="new_nom_chauffeur" type="text" name="" placeholder="nom du chauffeur" required/><br><br>
         <input id="new_permis" type="text" name="" placeholder="permis" required/><br><br>
          <input id="new_telephone" type="text" name="" placeholder="new_telephone" required/>
        </center>
        
         
      </div>
     </div>
      <div style="display: flex; justify-content: center;" class="modal-footer"> <center> <a class="btn btn-primary" data-role="ajout_new_chauffeur" >
       AJOUTER</a></center> </div> 
        </form>
     
    </div>
   </div>
  </div>  
        

<div class="modal fade" id="enregistrement" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog modal-dialog-centered" style="z-index: 1;">
    <div class="modal-content" style=" border: solid; border-color:rgb(0,141,202); " >
      <div class="modal-header bg-primary">
         <center>
        <h3 class="modal-title fs-10 text-white text-center" id="exampleModalLabel " style=" margin-left: 0px;   ">Enregistrement</h3></center>
        <center>
              <img class="logoo" src="../images/mylogo.ico" >
              </center>
       
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        
      
      <div class="modal-body"  >
              
        <form method="POST" >

   <div class="mb-3">
      
  <input type="text" class="form-control"  placeholder="navire"  name="navire"  id="naviresain" hidden="true" value=<?php  
        echo $rown['id_navire'];
    ?> > 
    <input type="text" class="form-control"  placeholder="type"  name="type" hidden="true"  id="typesain"  value=<?php  
        echo $rown['type'];
    ?> > 

</div>

   <div class="mb-3">
     
  <input type="text" class="form-control"  placeholder="produit" name="produit"  id="produitsain" hidden="true" value=<?php  
        echo $rown['id_produit'];
    ?> >
</div>

   <div class="mb-3">
     
  <input type="text" class="form-control"  placeholder="id_dis" name="id_di"  id="id_dissain" hidden="true" value=<?php  
        echo $rown['id_dis'];
    ?> >
</div>


   <div class="mb-3">
      
  <input type="text" class="form-control"  placeholder="produit" name="poids"  id="poids_sacssain" hidden="true" value=<?php  
        echo $rown['poids_kg'];
    ?> >
</div>

   <div class="mb-3">
    
      <label  for="exampleFormControlInput1" class="form-label">date</label>
      <label style="float: right;" for="exampleFormControlInput1" class="form-label">heure</label>
      <br>
  <input type="date" class="inputselect"    name="date" id="datesain">

  
      
  <input type="time" class="inputselect"   name="heure" id="heuresain" style="float: right;">
</div>

   <div class="mb-3">
    <select class="inputselect" name="declaration"  style="height: 30px;" id="declarationsain">
    <option value="" > choisir une declaration</option>
    <?php
        $resdes=declaration($bdd,$produit,$poids_sac,$navire,$destination);
     while($dec=$resdes->fetch()){ ?> 
    <option value=<?php  echo $dec['id_trans_extends']; ?> ><?php  echo $dec['num_declaration']; ?> </option>  
   <?php } ?>
    </select>

  <select class="inputselect"  name="cale" id="calesain" style="float: right;" >
    <option value="">Cale</option>

    <?php

 $rescale=cale($bdd,$produit,$poids_sac,$navire,$destination);
     if($rown['type']=="SACHERIE"){
       $rescale=cale($bdd,$produit,$poids_sac,$navire,$destination);
     while($res=$rescale->fetch()){ 
            $rescale2= $bdd->prepare("SELECT cales,id_dec   FROM declaration_chargement
               

                   WHERE id_navire=? and id_produit=? and conditionnement=? 
                  ");
        $rescale2->bindParam(1,$res['id_navire']);
        $rescale2->bindParam(2,$res['id_produit']);
        $rescale2->bindParam(3,$res['poids_kg']);
        $rescale2->execute(); } 
    while($rownn=$rescale2->fetch()){ ?>
      <option value=<?php echo $rownn['id_dec']; ?>><?php echo $rownn['cales']; ?> </option>
    <?php } }?>
     <?php if($rown['type']=="VRAQUIER"){ while($res=$rescale->fetch()){ 
            $rescale2= $bdd->prepare("SELECT cales,id_dec   FROM declaration_chargement
               

                   WHERE id_navire=? and id_produit=? 
                  ");
        $rescale2->bindParam(1,$res['id_navire']);
        $rescale2->bindParam(2,$res['id_produit']);
       
        $rescale2->execute(); } 
    while($rownn=$rescale2->fetch()){ ?>
      <option value=<?php echo $rownn['id_dec']; ?> ><?php echo $rownn['cales']; ?> </option>
    <?php } }?>
  </select>

</div>
<div style="background: rgb(248,248,248);">
   <div class="mb-3">
      <center>  
    <h6 style="background: white; color: blue;">TRANSPORT</h6>
   
 <h6 style="color: white; color: blue;">CAMIONS  </h6>
  </center> 
<input class="inputtransportform" type="text" id="myInput"  placeholder="SAISIR LE N° DE CAMION"  onkeyup="filtreca();" autocomplete="off"> <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#form_camion" ><span class="text-white bg-danger"> + </span></a><br><br>
<input class="inputtransportform" type="text" id="myInputTransp" placeholder="transporteur" style=" border: none;" disabled="true"  > <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#form_transporteur" ><span class="text-white bg-danger"> + </span></a>

<div id="camionList" style="background: white; display: none; " >
  </div>
 

<br>  





<input type="" name="input2" id="val_input2" hidden="true"  >
 <center> <br>  
<h6 style="color: blue;">CHAUFFEUR  </h6> 
</center> 
<input class="inputtransportform" type="text" id="myInputc"  placeholder="chauffeur" style="width: 80%;" onkeyup="filtreChau();" autocomplete="off"> <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#form_chauffeur" ><span class="text-white bg-danger"> + </span></a>

<div id="camionListc" style="background: white; display: none;" >
  

</div>
<input type="" name="input2c" id="val_input2c" hidden="true" >
<div id="details" style="background: white; display: none;" >
  <?php  ?>
  </div>

  
</div>
 </div>



<div class="mb-3">

    <input class="inputform" type="text"  style=" margin-bottom: 20px; margin-top: 20px;" name="numero_bl"  id="blsain" placeholder="numero bl" >
   



</div>
   <div class="mb-3">
  <input type="text" class="form-control"  placeholder="" name="client"  id="clientsain" hidden="true"  value=<?php  
        echo $rown['id_client'];
    ?> >
     <input type="text" class="form-control" id="mangasinsain" placeholder="" name="destination" hidden="true" value=<?php  
        echo $rown['id_mangasin'];
    ?> >

</div>

<?php if($rown['des_douane']=="LIVRAISON"){ ?>


 <div class="mb-3">
 
  <input class="inputform" type="text"  id="destinatairesain" placeholder="destinataire" name="destinataire"  >
</div>
<?php 
}
 if($rown['des_douane']=="TRANSFERT"){  ?>
  <div class="mb-3">
 
  <input type="text" class="form-control" id="destinatairesain" placeholder="destinataire" name="destinataire" value="AUCUN" hidden="true" >
</div>


<?php  

} ?>

  
<?php //if($rown['type']=="SACHERIE" and $rown['poids_kg']!=0){ ?>
  <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">nombre sac</label>
  <input class="inputform" type="number"   placeholder="0" name="sac" id="sacsain">
  </div>
  <div class="mb-3"  id='poids_cacher'>
      <label for="exampleFormControlInput1" class="form-label">poids</label>
  <input class="inputform" type="text"  id="poidssain" placeholder="poids" name="poids_s"  value="0" >
</div> 

<?php //} ?>

<input type="text" id='input_type_navire' value="<?php echo $rown['type'] ?>">
<input type="text" id='input_poids_kg' value="<?php echo $rown['poids_kg'] ?>">

<?php  //if($rown['type']=="VRAQUIER" and $rown['poids_kg']==0){ ?>
<!-- <div class="mb-3"  >
      <label for="exampleFormControlInput1" class="form-label">nombre_sac</label>
  <input class="inputform" type="text"  placeholder="0" value="0" name="sac" id="sacsain" >
</div>
<div class="mb-3" id='poids_cacher'>
      <label for="exampleFormControlInput1" class="form-label">poids</label>
  <input class="inputform" type="text" class="form-control" id="poidssain" placeholder="poids" name="poids_s" >

</div> !-->

<?php //} ?>
<?php  //if($rown['type']=="VRAQUIER" and $rown['poids_kg']!=0){ ?>

<!-- <div class="mb-3" >
      <label for="exampleFormControlInput1" class="form-label">nombre_sac</label>
  <input class="inputform" type="text"  id="sacsain" placeholder="0"  name="sac"  >
</div>
<div class="mb-3" id='poids_cacher'>
      <label for="exampleFormControlInput1" class="form-label">poids</label>
  <input class="inputform" type="text"  id="poidssain" placeholder="poids" name="poids_s" >

</div> !-->

<?php //} ?>






   <div class="mb-3">


        

         <center>
        <a  class="btn btn-primary" style="text-align: center;" name="register" id="register" data-role="btn_register" >enregistrer</a></center>
</form> 
      </div>   
      <div class="modal-footer">
 
        
      </div>
    </div>
  </div>
</div>
</div>



<div class="modal fade" id="modif_register" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style=" border: solid; border-color:rgb(0,141,202); ">
            <div class="modal-header" style="">
              <center>
                <h3 class="modal-title fs-10 text-white text-center" id="exampleModalLabel " style="text-align:center;   ">MODIFICATION ffsfsfs</h3></center>
                <center>
              <img class="logoo" src="../images/mylogo.ico" >
       </center>
        
      </div>
       <br> <br>
        <form  method="POST">





   <div class="mb-3">
    
   <label>DATE</label>  
  <input type="text" class="form-control"  id="date_m_rm"  name="conditionnement"  > <br>
  <label>HEURE</label>  
  <input type="time" class="form-control"  id="heure_m_rm"  name="conditionnement"  > <br>
    <label>BL</label>  
  <input type="text" class="form-control"  id="bl_m_rm"  name="conditionnement"  > <br>
  <label>SAC</label>  
  <input type="text" class="form-control"  id="sac_m_rm"  name="conditionnement"  > <br>
  <input type="text" class="form-control"  id="id_m_rm" hidden="true"  name="conditionnement"  >
   <input type="text" class="form-control"  id="type_m_rm" hidden="true"  name="conditionnement" value="<?php echo $rown['type']; ?>"  >
<label>DECLARATION</label>

<?php
       $resdes=declaration($bdd,$produit,$poids_sac,$navire,$destination);
 
 ?>
   <select id="declaration_m_rm">
    <?php 
     while($dec=$resdes->fetch()){ ?>
      <option value=<?php echo $dec['id_trans_extends']; ?>><?php echo $dec['num_declaration']  ?></option>
    <?php } ?>
  
  </select><br> 
  <label>CALE</label>
   <select id="cale_m_rm">
    <?php
       $rescale=cale($bdd,$produit,$poids_sac,$navire,$destination);
    
          while($res=$rescale->fetch()){ 
            $rescale2= $bdd->prepare("SELECT cales,id_dec   FROM declaration_chargement
               

                   WHERE id_navire=? and id_produit=? and conditionnement=? 
                  ");
        $rescale2->bindParam(1,$res['id_navire']);
        $rescale2->bindParam(2,$res['id_produit']);
        $rescale2->bindParam(3,$res['poids_kg']);
        $rescale2->execute(); } 
    while($rownn=$rescale2->fetch()){ ?>
      <option value=<?php echo $rownn['id_dec']; ?>><?php echo $rownn['cales']; ?> </option>
    <?php } ?>
     
   
  </select>

<div style="background: blue">
   <div class="mb-3">
      <center>  
    <h3 style="background: white; color: blue;">TRANSPORT</h3>
   
 <label style="color: white;">CAMIONS  </label><br> 
  </center> 
  

   
<input type="text" id="myInput_m_rm"  placeholder="SAISIR LE N° DE CAMION" style="width: 50%; " onkeyup="filtreca_m_rm();" ><br><br>

<label style="color: white;">TRANSPORTEUR  </label><br> 
<input type="text" id="myInputTransp_m_rm" placeholder="transporteur" style="width: 50%; " disabled="true" >


<div id="camionList_m_rm" style="background: white; display: none; " >
  </div>
 



<input type="" name="input2" id="val_input2_m_rm"   hidden="true"  >

 <center> <br>  
<label style="color: white;">CHAUFFEUR  </label> 
</center> 
 
<input type="text" id="myInputc_m_rm"  placeholder="chauffeur" style="width: 100%;" onkeyup="filtreChau_m_rm();"  >

<div id="camionListc_m_rm" style="background: white; display: none;" >
  

</div>
<input type="" name="input2c" id="val_input2c_m_rm" hidden="true">
<input type=""  id="dis_bl_m_rm" hidden="true" >
<input type=""  id="poids_sac_m_rm" hidden="true" >

<input type="" name="input2c" id="id_produit_m_rm" hidden="true">
<input type=""  id="id_destination_m_rm" hidden="true" >
<input type=""  id="id_navire_m_rm" hidden="true" >
  
  </div>

  
</div>
 </div><br> 






   
  
    </center>
    



</center>

        
        
 
       
      <div class="modal-footer">
    <a data-role="mod"   class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="modifier_les_register">valider</a>
        </div>
      </div>
      </form>
       </div> 
    </div>
  </div>
</div>












 

 <div class="modal fade" id="enregistrement_transfert" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="z-index: 1;">
    <div class="modal-content" style=" border: solid; border-color:rgb(0,141,202);">
      <div class="modal-header bg-primary">
        <center>
              <img class="logoo" src="../images/mylogo.ico" >
              </center>
        <center>
        <h3 class="modal-title fs-10 text-white text-center" id="exampleModalLabel " style="text-align:center;   ">Connectez vous</h3></center>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" >
              
        <form method="POST">

   <div class="mb-3">
      
  <input type="text" class="form-control"  placeholder="navire"  name="navire"  id="naviretrav"  value="<?php  
        echo $rown['id_navire']; 
    ?>" hidden="true" > 
</div>

   <div class="mb-3">
     
  <input type="text" class="form-control"  placeholder="produit" name="produit"  id="produittrav" hidden="true" value=<?php  
        echo $rown['id_produit'];
    ?> >
</div>

   <div class="mb-3">
     
  <input type="text" class="form-control"  placeholder="id_dis" name="id_di"  id="id_distrav" hidden="true" value=<?php  
        echo $rown['id_dis'];
    ?> >
</div>


   <div class="mb-3">
      
  <input type="text" class="form-control"  placeholder="produit" name="poids"  id="poids_sactrav" hidden="true" value=<?php  
        echo $rown['poids_kg'];
    ?> >
</div>

   <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">date</label>
  <input type="date" class="form-control"   name="date" id="datetrav">
</div>
  <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">heure</label>
  <input type="time" class="form-control"  name="heure" id="heuretrav">
</div>

   <div class="mb-3">
    <select name="declaration"  style="height: 30px;" id="declarationtrav">
    <option selected > choisir une declaration</option>
     <?php    $resdes=declaration($bdd,$produit,$poids_sac,$navire,$destination);
     while($dec=$resdes->fetch()){ ?> 
    <option value=<?php  echo $dec['id_trans_extends']; ?> ><?php  echo $dec['num_declaration']; ?> </option>  
   <?php } ?>
    </select>
</div>



   <div class="mb-3">
   <select class="inputselect"  name="cale" id="caletrav" style="float: right;" >
    <option value="">Cale</option>

    <?php

 $rescale=cale($bdd,$produit,$poids_sac,$navire,$destination);
     
       $rescale=cale($bdd,$produit,$poids_sac,$navire,$destination);
     while($res=$rescale->fetch()){ 
            $rescale2= $bdd->prepare("SELECT cales,id_dec   FROM declaration_chargement
               

                   WHERE id_navire=? and id_produit=? and conditionnement=? 
                  ");
        $rescale2->bindParam(1,$res['id_navire']);
        $rescale2->bindParam(2,$res['id_produit']);
        $rescale2->bindParam(3,$res['poids_kg']);
        $rescale2->execute(); } 
    while($rownn=$rescale2->fetch()){ ?>
      <option value=<?php echo $rownn['id_dec']; ?>><?php echo $rownn['cales']; ?> <?php echo $rownn['id_dec']; ?></option>
    <?php } ?>
    
  </select>

</div>
<div style="background: blue">
   <div class="mb-3">
      <center>  
    <h3 style="background: white; color: blue;">TRANSPORT</h3>
   
 <h6 style="color: white;">CAMIONS  </h6>
  </center> 
<input type="search" id="myInput3"  placeholder="SAISIR LE N° DE CAMION" style="width: 50%; " onkeyup="filtreca3();">
<i class="fas fa-search" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%);"></i>
<input type="text" id="myInputTransp3" placeholder="transporteur" style="width: 50%; float: right; color: white !important;" disabled="true"  >

<div id="camionList3" style="background: white; display: none; " >
  </div>
 

<br><br>   





<input type="" name="input3" id="val_input3" hidden="true"  >
 <center> <br>  
<h6 style="color: white;">CHAUFFEUR  </h6> 
</center> 
<input type="text" id="myInputc3"  placeholder="chauffeur" style="width: 100%;" onkeyup="filtreChau3();" >

<div id="camionListc3" style="background: white; display: none;" >
  

</div>
<input type="" name="input3c" id="val_input3c" hidden="true" >
<div id="details" style="background: white; display: none;" >
  <?php  ?>
  </div>

  
</div>
 </div>

 



   <div class="mb-3">

    <input  style=" margin-bottom: 20px;margin-top: 20px;" name="numero_bl" id="bltrav" placeholder="numero bl" >
   

</div>
   <div class="mb-3">
  <input type="text" class="form-control"  placeholder="" name="client"  id="clienttrav" hidden="true"  value=<?php  
        echo $rown['id_client'];
    ?> >
     <input type="text" class="form-control" id="mangasintrav" placeholder="" name="destination" hidden="true" value=<?php  
        echo $rown['id_mangasin'];
    ?> >

</div>

<?php if($rown['des_douane']=="LIVRAISON"){ ?>
  <div class="mb-3">
 
  <input type="text" class="form-control" id="autre_destinatairetrav" placeholder="destination" name="autre_destination" >
</div>

 <div class="mb-3">
 
  <input type="text" class="form-control" id="destinatairetrav" placeholder="destinataire" name="destinataire" >
</div>
<?php 
}
else { ?>
  <div class="mb-3">
 
  <input type="text" class="form-control" id="destinatairetrav" placeholder="destinataire" name="destinataire" value="AUCUN" hidden="true">
</div>

  <div class="mb-3">
 
  <input type="text" class="form-control" id="autre_destinatairetrav" placeholder="destinataire" name="autre_destination" value="AUCUNE" hidden="true" >
</div>
<?php  

} ?>

   <div class="mb-3">
      
  <input type="number" class="form-control" id="sacftrav" placeholder="nbre sacs flasques" name="sac_flasque" >
</div>
  <div class="mb-3">
      
  <input type="number" class="form-control" id="poidsftrav" placeholder="poids flasques" name="poids_flasque" >
</div>
  <div class="mb-3">
      
  <input type="number" class="form-control" id="sacmtrav" placeholder="nbre sacs mouille" name="sac_mouille" >
</div>

  <div class="mb-3">
      
  <input type="number" class="form-control" id="poidsmtrav" placeholder="poids mouille" name="poids_mouille" hidden='true' >
</div>
   
      


  
   <div class="mb-3">


        

         <center>
        <a class="btn btn-primary " style="text-align: center;" name="valider_tr_avaries"  data-role="btn_transfert_avaries">enregistrer</a></center>
</form> 
      </div>   
      <div class="modal-footer">
 
        
      </div>
    </div>
  </div>
</div>
</div>


<div class="modal fade" id="modif_register_avaries" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style=" border: solid; border-color:rgb(0,141,202); ">
            <div class="modal-header" style="">
              <center>
                <h3 class="modal-title fs-10 text-white text-center" id="exampleModalLabel " style="text-align:center;   ">MODIFICATION</h3></center>
                <center>
              <img class="logoo" src="../images/mylogo.ico" >
       </center>
        
      </div>
       <br> <br>
        <form  method="POST">





   <div class="mb-3">
    
   <label>DATE</label>  
  <input type="text" class="form-control"  id="date_m_av"  name="conditionnement"  > <br>
  <label>HEURE</label>  
  <input type="time" class="form-control"  id="heure_m_av"  name="conditionnement"  > <br>
   
<label>DECLARATION</label><br>
   <select id="declaration_m_av">
  
  </select><br> 
  <label>CALE</label><br>
   <select id="cale_m_av">
     <?php

 $rescale=cale($bdd,$produit,$poids_sac,$navire,$destination);
     
       $rescale=cale($bdd,$produit,$poids_sac,$navire,$destination);
     while($res=$rescale->fetch()){ 
            $rescale2= $bdd->prepare("SELECT cales,id_dec  FROM declaration_chargement
               

                   WHERE id_navire=? and id_produit=? and conditionnement=? 
                  ");
        $rescale2->bindParam(1,$res['id_navire']);
        $rescale2->bindParam(2,$res['id_produit']);
        $rescale2->bindParam(3,$res['poids_kg']);
        $rescale2->execute(); } 
    while($rownn=$rescale2->fetch()){ ?>
      <option value=<?php echo $rownn['id_dec']; ?>><?php echo $rownn['cales']; ?> <?php echo $rownn['id_dec']; ?></option>
    <?php } ?>
   
  </select><br>
</div>

<div style="background: blue">
   <div class="mb-3">
      <center>  
    <h3 style="background: white; color: blue ;">TRANSPORT</h3>
   
 <label style="color: white !important;">CAMIONS  </label><br> 
  </center> 
  

   
<input type="text" id="myInput_m_av"  placeholder="SAISIR LE N° DE CAMION" style="width: 50%; " onkeyup="filtreca_m_av();" ><br><br>

<label style="color: white !important;">TRANSPORTEUR  </label><br> 
<input type="text" id="myInputTransp_m_av" placeholder="transporteur" style="width: 50%; " disabled="true" >


<div id="camionList_m_av" style="background: white; display: none; " >
  </div>
 



<input type="" name="input2" id="val_input2_m_av" hidden="true" >

 <center> <br>  
<label style="color: white !important;">CHAUFFEUR  </label> 
</center> 
 
<input type="text" id="myInputc_m_av"  placeholder="chauffeur" style="width: 100%;" onkeyup="filtreChau_m_av();" >

<div id="camionListc_m_av" style="background: white; display: none;" >
  

</div>
<input type="" name="input2c" id="val_input2c_m_av" hidden="true" >
<input type=""  id="dis_bl_m_av" hidden="true" >
<input type=""  id="poids_sac_m_av" hidden="true" ><br><br>

  </div>

  
</div>
<div class="mb-3">

 <label style="">BL</label><br>  
  <input type="text" class="form-control"  id="bl_m_av"  name="conditionnement"  > <br>
  <label style="">SACS FLASQUE</label> <br> 
  <input type="text" class="form-control"  id="sacf_m_av"  name="conditionnement"  > <br>
  <label style="">POIDS FLASQUE</label><br>  
  <input type="text" class="form-control"  id="poidsf_m_av"  name="conditionnement"  > <br>
  <label style="">SACS MOUILLE</label><br>  
  <input type="text" class="foav-control"  id="sacm_m_av"  name="conditionnement"  > <br>
  <label hidden="true" style="">POIDS MOUILLE</label><br>  
  <input type="text" class="form-control"  id="poidsm_m_av"  name="conditionnement" hidden='true' > <br>
  <input type="text" class="form-control"  id="id_m_av"  name="conditionnement" hidden="true"  >
  <input type="text" class="form-control"  id="id_destination_m_av"   >
  <input type="text" class="form-control"  id="id_navire_m_av"   >
   <input type="text" class="form-control"  id="id_produit_m_av"   >
  
  </div>

  
<br> 






   
  
    </center>
    



</center>

        
        
 
       
      <div class="modal-footer">
    <a id="mod_avaries"   class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="modifier_les_register">valider</a>
        </div>
      </div>
      </form>
       </div> 
    </div>
  </div>
</div>



<div class="modal fade" id="modif_avaries_deb" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style=" border: solid; border-color:rgb(0,141,202); ">
            <div class="modal-header" style="">
              <center>
                <h3 class="modal-title fs-10 text-white text-center" id="exampleModalLabel " style="text-align:center;   ">MODIFICATION</h3></center>
                <center>
              <img class="logoo" src="../images/mylogo.ico" >
       </center>
        
      </div>
       <br> <br>
        <form  method="POST">





   <div class="mb-3">
    
   <label>DATE</label>  
  <input  type="text"  id="date_avdeb"   class="form-control" > <br>
 
 <label style="">SACS FLASQUE</label> <br> 
  <input type="text" class="form-control"  id="sacf_avdeb"  name="conditionnement"  > <br>
   <label style="">SACS MOUILLE</label> <br> 
  <input type="text" class="form-control"  id="sacm_avdeb"  name="conditionnement"  > <br>
  <label>CALE</label><br>
   <select style="width: 50%; margin-bottom: 20px; height: 30px;" name="cale" id="cale_avdeb" >
   
  <?php  
     
       $rescale=cale($bdd,$produit,$poids_sac,$navire,$destination);
     while($res=$rescale->fetch()){ 
            $rescale2= $bdd->prepare("SELECT cales,id_dec   FROM declaration_chargement
               

                   WHERE id_navire=? and id_produit=? and conditionnement=? 
                  ");
        $rescale2->bindParam(1,$res['id_navire']);
        $rescale2->bindParam(2,$res['id_produit']);
        $rescale2->bindParam(3,$res['poids_kg']);
        $rescale2->execute(); } 
    while($rownn=$rescale2->fetch()){ ?>
      <option value=<?php echo $rownn['id_dec']; ?>><?php echo $rownn['cales']; ?></option>
    <?php } ?>
  </select>

  <label style="">id_navire</label> <br> 
  <input type="text" class="form-control"  id="id_navire_avdeb"  name="conditionnement"  > <br>
  <label style="">id</label> <br> 
  <input type="text" class="form-control"  id="id_avdeb"  name="conditionnement"  > <br>
  <label style="">id_dis</label> <br> 
  <input type="text" class="form-control"  id="id_dis_avdeb"  name="conditionnement"  >
   <br>
    <input type="text" class="form-control"  id="poids_sac_avdeb"  name="conditionnement"  >
     <input type="text" class="form-control"  id="produit_avdeb"  name="conditionnement"  >
  
  </div>

  
<br> 






   
  
    </center>
    



</center>

        
        
 
       
      <div class="modal-footer">
    <a data-role="mod_avaries_deb"   class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="modifier_les_register">valider</a>
        </div>
      </div>
      </form>
       </div> 
    </div>
  </div>
</div>





<div class="modal fade" id="fichier" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="z-index: 1;">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <center>
        <h2 class="modal-title fs-5 text-white text-center" id="exampleModalLabel " style="text-align:center; ">ARCHIVRAGE</h2></center>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" >
               <center>
            <img class="logo" src="assets/images/mylogo.ico" style="border-radius: 50px;">

        </center>
        <form method="POST" enctype="multipart/form-data">

   <div class="mb-3">
    <label for="image">Choisir une image :</label>
  <input type="file" name="image" id="image">
  <input type="text" name="ids" id="id_image">

   

    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="navire"  name="navire"  id="navire"  value=<?php  
        echo $rown['id_navire'];
    ?> >  
  <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="id_dis" name="id_di"  id="produit" hidden="true" value=<?php  
        echo $rown['id_dis'];
    ?> >
</div>
      
 
 <div class="mb-3">


        

         <center>
        <button type="submit" class="btn btn-primary " style="text-align: center;" name="archiver" id="deb" >enregistrer</button></center>
</form> 
      </div>  
       
      <div class="modal-footer">
 
        
      </div>
    </div>
  </div>
</div>



</div>



<div class="modal fade" id="Les_avaries2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <center>
        <h2 class="modal-title fs-5 text-white text-center" id="exampleModalLabel " style="text-align:center; ">Ajouter Avaries</h2></center>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" >
               <center>
            <img class="logo" src="assets/images/mylogo.ico" style="border-radius: 50px;">

        </center>
        <form method="POST">
          <?php if($rown['type']=='SACHERIE'){ ?>


   <div class="mb-3">
       <label for="exampleFormControlInput1" class="form-label">date</label>
  <input type="date" class="form-control"   name="date" id="dateavdeb">
  <br>  

    <label>SAC FLASQUE</label>
    <input type="number" class="form-control"   name="sacf"  id="sacfavdeb"  value="0"
     >
     <br> 
     <label>SAC MOUILLE</label>
    <input type="number" class="form-control"    name="sacm"  id="sacmavdeb"  value="0"
     >
     <br> 
<select name="cale" id="caleavdeb"> 
<option selected value=""> CHOISIR CALE</option> 
<?php 
     $rescale=cale($bdd,$produit,$poids_sac,$navire,$destination); 
while($res=$rescale->fetch()){ 
            $rescale2= $bdd->prepare("SELECT cales,id_dec   FROM declaration_chargement
               

                   WHERE id_navire=? and id_produit=? and conditionnement=? 
                  ");
        $rescale2->bindParam(1,$res['id_navire']);
        $rescale2->bindParam(2,$res['id_produit']);
        $rescale2->bindParam(3,$res['poids_kg']);
        $rescale2->execute(); } 
    while($rownn=$rescale2->fetch()){ ?>
      <option value=<?php echo $rownn['id_dec']; ?>><?php echo $rownn['cales']; ?> </option>
    <?php }  ?>
    </select>



      
  <input type="text" class="form-control"  placeholder="navire"  name="navire"  id="navireavdeb" hidden="true" value=<?php  
        echo $rown['id_navire'];
    ?> > 
    <input type="text" class="form-control"  placeholder="navire"  id="id_disavdeb" hidden="true" value=<?php  
        echo $rown['id_dis'];
    ?> > 
     <input type="text" class="form-control"  placeholder="navire"  name="poids_sac"  id="poids_sacavdeb" hidden="true" value=<?php  
        echo $rown['poids_kg'];
    ?> >
     <input type="text" class="form-control"  placeholder="navire"  name="id_produit"  id="produitavdeb" hidden="true" value=<?php  
        echo $rown['id_produit'];
    ?> >
   
</div>
  
 




  
   <div class="mb-3">


        

         <center>
        <a class="btn btn-primary " style="text-align: center;" name="valider_Avaries3" data-role="btn_avaries_debarquement" >enregistrer</a></center>
        </div>
      <?php }  ?>

    
</form> 
       
      <div class="modal-footer">
 
        
      </div>
    </div>
  </div>
</div>
</div>






<?php } ?>

 
  

<?php } 

?>
</div>




 ?>



