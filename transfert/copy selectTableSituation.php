<?php
require('../database.php');
?>

<style type="text/css">
  body{
    font-family:Times New Roman;
    font-weight: bold;
  }

    .enteteTable{
     background: linear-gradient(to bottom, blue, #1B2B65); background: linear-gradient(to left, blue, #1B2B65); background: linear-gradient(to top, blue, #1B2B65); color: white; text-align: center; font-weight: bold;
     vertical-align: middle; 
      border: 5px;
      border-color: black;

    }
         #table{
          border: 5px; 
     }
    #colLibeles{
      background: rgba(83,104,253,0.9); color: white;
      vertical-align: middle;
      text-align: center;

    } 
    #colManifeste{
      background: rgb(72,94,179); color:white;
      vertical-align: middle;
       text-align: center;
    }
    #colDeb24H{
      background-color: rgb(124, 158, 191); color:white;
      vertical-align: middle;
       text-align: center;
    }
    #colDebTOTAL{
      background-color: rgb(34, 155, 176); color:white;
      vertical-align: middle;
       text-align: center;
    }
    #colROB{
      background-color: rgb(28, 118, 51); color:white;
      vertical-align: middle;
       text-align: center;
    }
    #sousTOTAL{
       background-color:rgb(94,44,101);  color:white;
       font-weight: bold;
       text-align: center;
       vertical-align: middle;

    }
    #TOTAL{
      background: black;
      color: red;
      font-weight: bold;
      vertical-align: middle;
       text-align: center;
    }
    #colFlasque{
      background-color: rgb(193, 150, 0); color:white;
      vertical-align: middle;
       text-align: center; 
    }

    #colMouille{
      background-color: rgb(158, 106, 35); color:white;
      vertical-align: middle;
       text-align: center; 
    }
    #colCumulGen{
    background-color: rgb(200, 106, 90); color:white;
      vertical-align: middle;
      text-align: center;  
    }
  
</style>
 <div class="sit" id="sit"> 

<div class="container-fluid-great"  >
        <div class="row">
        	<?php if (isset($_POST['idDate'])) {
        		 $b=$_POST["idDate"];
        		   $a=explode(",",$b);

 $type_navire = $bdd->prepare("SELECT type from navire_deb where id=? " );
        $type_navire->bindParam(1,$a[0]);
        $type_navire->execute();
        $filtre_type=$type_navire->fetch();
       

 $titre=$bdd->query("SELECT * from register_manifeste");
 $tr=$titre->fetch();
 
        		    $res2 = $bdd->prepare("SELECT dates from register_manifeste where id_navire=? and dates=? " );
        $res2->bindParam(1,$a[0]);
        $res2->bindParam(2,$a[1]);
       
        
        $res2->execute();
        $tr2=$res2->fetch();


$titreP=$bdd->query("SELECT * from register_manifeste");
 $trP=$titreP->fetch();
 
                $res2P = $bdd->prepare("SELECT dates from register_manifeste where id_navire=? and dates=? " );
        $res2P->bindParam(1,$a[0]);
        $res2P->bindParam(2,$a[1]);
       
        
        $res2P->execute();
        $tr2P=$res2P->fetch();

$titreAC=$bdd->query("SELECT * from register_manifeste");
 $trAC=$titre->fetch();
 
                $res2AC = $bdd->prepare("SELECT dates from register_manifeste where id_navire=? and dates=? " );
        $res2AC->bindParam(1,$a[0]);
        $res2AC->bindParam(2,$a[1]);
       
        
        $res2AC->execute();
        $tr2AC=$res2AC->fetch();


 //$titreAP=$bdd->query("SELECT * from register_manifeste");
 $trAP=$titre->fetch();
  $trTAP=$titre->fetch();
  $trTAD=$titre->fetch();
  $trSD=$titre->fetch();
 
       /*         $res2AP = $bdd->prepare("SELECT dates from register_manifeste where id_navire=? and dates=? " );
        $res2AP->bindParam(1,$a[0]);
        $res2AP->bindParam(2,$a[1]);*/
       
        
       // $res2AP->execute();
        $tr2AP=$res2->fetch();       
        
//REQUETES TABLE SITUATION PAR CALE/////////////////
$fmT=$bdd->prepare("select dc.*,av.*, sum(sac_flasque),sum(poids_flasque),sum(sac_mouille),sum(poids_mouille), p.produit from declaration_chargement as dc inner join produit_deb as p on dc.id_produit=p.id inner join avaries as av on dc.id_produit=av.id_produit and dc.cales=av.cale_avaries and dc.conditionnement=av.poids_sac_avaries where dc.id_navire=? and av.date_avaries<=? group by dc.cales,p.produit, dc.conditionnement with rollup;");

                  $fmT->bindParam(1,$a[0]);
                  $fmT->bindParam(2,$a[1]);
          
          
          $fmT->execute();


$fm=$bdd->prepare("select dc.*,av.*, sum(sac_flasque),sum(poids_flasque),sum(sac_mouille),sum(poids_mouille), p.produit from declaration_chargement as dc inner join produit_deb as p on dc.id_produit=p.id inner join avaries as av on dc.id_produit=av.id_produit and dc.cales=av.cale_avaries and dc.conditionnement=av.poids_sac_avaries where dc.id_navire=? and av.date_avaries=? group by dc.cales,p.produit, dc.conditionnement with rollup;");

                  $fm->bindParam(1,$a[0]);
                  $fm->bindParam(2,$a[1]);
          
          
          $fm->execute();          



        $caleT=$bdd->prepare("select dc.*,sum(dc.nombre_sac), p.*, rm.*, sum(rm.sac),sum(rm.poids)  FROM declaration_chargement as dc
          inner  join produit_deb as p on dc.id_produit=p.id
          inner  join register_manifeste as rm on  dc.id_produit=rm.id_produit and dc.cales=rm.cale
          and dc.conditionnement=rm.poids_sac 
          
         where  dc.id_navire=? and rm.dates<=?    group by dc.cales,p.produit, dc.conditionnement  with rollup ");
                  $caleT->bindParam(1,$a[0]);
                  $caleT->bindParam(2,$a[1]);
          
          
          $caleT->execute();

                $cale=$bdd->prepare("select dc.*, p.*, rm.*, sum(rm.sac),sum(rm.poids) FROM declaration_chargement as dc inner join produit_deb as p on dc.id_produit=p.id inner join register_manifeste as rm on dc.id_produit=rm.id_produit and dc.cales=rm.cale and dc.conditionnement=rm.poids_sac where dc.id_navire=? and rm.dates=? group by dc.cales,p.produit, dc.conditionnement with rollup; ");
        	$cale->bindParam(1,$a[0]);
          $cale->bindParam(2,$a[1]);
        	
        	$cale->execute();
////////////FIN REQUETES TABLE SITUATION PAR CALE////////////////       

 
   $produitT=$bdd->prepare("select dc.*, sum(dc.nombre_sac), p.*, rm.*, sum(rm.sac),sum(rm.poids)  FROM declaration_chargement as dc
          inner  join produit_deb as p on dc.id_produit=p.id
          inner  join register_manifeste as rm on  dc.id_produit=rm.id_produit and dc.cales=rm.cale
          and dc.conditionnement=rm.poids_sac 

         where  dc.id_navire=? and rm.dates<=?    group by p.produit,  dc.conditionnement,dc.cales,dc.id_dec  with rollup ");
                  $produitT->bindParam(1,$a[0]);
                  $produitT->bindParam(2,$a[1]);
          
          
          $produitT->execute();


   $produit=$bdd->prepare("select dc.*, sum(dc.nombre_sac), p.*, rm.*, sum(rm.sac),sum(rm.poids)  FROM declaration_chargement as dc
          inner  join produit_deb as p on dc.id_produit=p.id
          inner  join register_manifeste as rm on  dc.id_produit=rm.id_produit and dc.cales=rm.cale
          and dc.conditionnement=rm.poids_sac 

         where  dc.id_navire=? and rm.dates=?    group by p.produit,  dc.conditionnement,dc.cales, dc.id_dec   with rollup ");
                  $produit->bindParam(1,$a[0]);
                  $produit->bindParam(2,$a[1]);
          
          
          $produit->execute();


 $fmpT=$bdd->prepare("select dc.*,av.*, sum(sac_flasque),sum(poids_flasque),sum(sac_mouille),sum(poids_mouille), p.* from declaration_chargement as dc inner join produit_deb as p on dc.id_produit=p.id inner join avaries as av on dc.id_produit=av.id_produit and dc.cales=av.cale_avaries and dc.conditionnement=av.poids_sac_avaries where dc.id_navire=? and av.date_avaries<=? group by p.produit,  dc.conditionnement,dc.cales, dc.id_dec with rollup");

                  $fmpT->bindParam(1,$a[0]);
                  $fmpT->bindParam(2,$a[1]);
          
          
          $fmpT->execute();


$fmp=$bdd->prepare("select dc.*,av.*, sum(sac_flasque),sum(poids_flasque),sum(sac_mouille),sum(poids_mouille), p.* from declaration_chargement as dc inner join produit_deb as p on dc.id_produit=p.id inner join avaries as av on dc.id_produit=av.id_produit and dc.cales=av.cale_avaries and dc.conditionnement=av.poids_sac_avaries where dc.id_navire=? and av.date_avaries=? group by p.produit,  dc.conditionnement,dc.cales, dc.id_dec with rollup");

                  $fmp->bindParam(1,$a[0]);
                  $fmp->bindParam(2,$a[1]);
          
          
          $fmp->execute();          
         
$fmTAC=$bdd->prepare("select dc.*,av.*, sum(av.sac_flasque),sum(av.poids_flasque),sum(av.sac_mouille),sum(av.poids_mouille), p.produit from declaration_chargement as dc inner join produit_deb as p on dc.id_produit=p.id inner join avaries as av on dc.id_produit=av.id_produit and dc.cales=av.cale_avaries and dc.conditionnement=av.poids_sac_avaries where dc.id_navire=? and av.date_avaries<=? group by dc.cales,p.produit, dc.conditionnement with rollup;");

                  $fmTAC->bindParam(1,$a[0]);
                  $fmTAC->bindParam(2,$a[1]);
          
          
          $fmTAC->execute();


$fmAC=$bdd->prepare("select dc.*,av.*, sum(av.sac_flasque),sum(av.poids_flasque),sum(av.sac_mouille),sum(av.poids_mouille), p.produit from declaration_chargement as dc inner join produit_deb as p on dc.id_produit=p.id inner join avaries as av on dc.id_produit=av.id_produit and dc.cales=av.cale_avaries and dc.conditionnement=av.poids_sac_avaries where dc.id_navire=? and av.date_avaries=? group by dc.cales,p.produit, dc.conditionnement with rollup;");

                  $fmAC->bindParam(1,$a[0]);
                  $fmAC->bindParam(2,$a[1]);
                  $fmAC->execute();
  
$caleTAC=$bdd->prepare("select dc.*, p.*, rm.*,av.*,sum(av.sac_flasque),sum(av.poids_flasque),sum(av.sac_mouille),sum(av.poids_mouille)  FROM declaration_chargement as dc
          inner  join produit_deb as p on dc.id_produit=p.id
          inner  join register_manifeste as rm on  dc.id_produit=rm.id_produit and dc.cales=rm.cale
          and dc.conditionnement=rm.poids_sac 
           inner  join avaries as av on  rm.id_produit=av.id_produit and rm.cale=av.cale_avaries
          and rm.poids_sac=av.poids_sac_avaries
         where  dc.id_navire=? and rm.dates<=?    group by dc.cales,p.produit, dc.conditionnement  with rollup ");
                  $caleTAC->bindParam(1,$a[0]);
                  $caleTAC->bindParam(2,$a[1]);
          
          
          $caleTAC->execute();

                $caleAC=$bdd->prepare("select dc.*, p.*, rm.*,av.*,sum(av.sac_flasque),sum(av.poids_flasque),sum(av.sac_mouille),sum(av.poids_mouille)  FROM declaration_chargement as dc
          inner  join produit_deb as p on dc.id_produit=p.id
          inner  join register_manifeste as rm on  dc.id_produit=rm.id_produit and dc.cales=rm.cale and dc.conditionnement=rm.poids_sac 
          inner  join avaries as av on  dc.id_produit=av.id_produit and dc.cales=av.cale_avaries
          and dc.conditionnement=av.poids_sac_avaries 
         where  dc.id_navire=?   and rm.dates=?   group by dc.cales,p.produit, dc.conditionnement  with rollup ");
          $caleAC->bindParam(1,$a[0]);
          $caleAC->bindParam(2,$a[1]);
          
          $caleAC->execute();


$fmTAP=$bdd->prepare("select dc.*,av.*, sum(av.sac_flasque),sum(av.poids_flasque),sum(av.sac_mouille),sum(av.poids_mouille), p.produit from declaration_chargement as dc inner join produit_deb as p on dc.id_produit=p.id inner join avaries as av on dc.id_produit=av.id_produit and dc.cales=av.cale_avaries and dc.conditionnement=av.poids_sac_avaries where dc.id_navire=? and av.date_avaries<=? group by p.produit,  dc.conditionnement,dc.cales,dc.id_dec with rollup;");

                  $fmTAP->bindParam(1,$a[0]);
                  $fmTAP->bindParam(2,$a[1]);
          
          
          $fmTAP->execute();


$fmAP=$bdd->prepare("select dc.*,av.*, sum(av.sac_flasque),sum(av.poids_flasque),sum(av.sac_mouille),sum(av.poids_mouille), p.produit from declaration_chargement as dc inner join produit_deb as p on dc.id_produit=p.id inner join avaries as av on dc.id_produit=av.id_produit and dc.cales=av.cale_avaries and dc.conditionnement=av.poids_sac_avaries where dc.id_navire=? and av.date_avaries=? group by p.produit,  dc.conditionnement,dc.cales,dc.id_dec with rollup;");

                  $fmAP->bindParam(1,$a[0]);
                  $fmAP->bindParam(2,$a[1]);
                  $fmAP->execute();

   $fmTRAVAP=$bdd->prepare("select dis.*,trav.*, sum(trav.sac_flasque_tr_av),sum(trav.poids_flasque_tr_av),sum(trav.sac_mouille_tr_av),sum(trav.poids_mouille_tr_av), p.* from transfert_avaries as trav inner join produit_deb as p on trav.id_produit=p.id
     inner join dispatching as dis on trav.id_produit=dis.id_produit and trav.id_client=dis.id_client and trav.id_destination_tr=dis.id_mangasin and trav.id_dis_bl_tr=dis.id_dis 
     and trav.poids_sac_tr_av=dis.poids_kg  where trav.id_navire=? and trav.date_tr_avaries=? group by p.produit, trav.poids_sac_tr_av");

                  $fmTRAVAP->bindParam(1,$a[0]);
                  $fmTRAVAP->bindParam(2,$a[1]);
                  $fmTRAVAP->execute();       

$fmTTRAVAP=$bdd->prepare("select dis.*,trav.*, sum(trav.sac_flasque_tr_av),sum(trav.poids_flasque_tr_av),sum(trav.sac_mouille_tr_av),sum(trav.poids_mouille_tr_av), p.* from transfert_avaries as trav inner join produit_deb as p on trav.id_produit=p.id
     inner join dispatching as dis on trav.id_produit=dis.id_produit and trav.id_client=dis.id_client and trav.id_destination_tr=dis.id_mangasin and trav.id_dis_bl_tr=dis.id_dis 
     and trav.poids_sac_tr_av=dis.poids_kg  where trav.id_navire=? and trav.date_tr_avaries<=? group by p.produit, trav.poids_sac_tr_av");

                  $fmTTRAVAP->bindParam(1,$a[0]);
                  $fmTTRAVAP->bindParam(2,$a[1]);
                  $fmTTRAVAP->execute();      
                   
$fmCUMULAP=$bdd->prepare("select dc.*,av.*, sum(av.sac_flasque),sum(av.poids_flasque),sum(av.sac_mouille),sum(av.poids_mouille), p.* from avaries as av inner join produit_deb as p on av.id_produit=p.id
     inner join declaration_chargement as dc on av.id_produit=dc.id_produit and av.poids_sac_avaries=dc.conditionnement   
     where av.id_navire=? and av.date_avaries<=? group by p.produit, dc.conditionnement");

                  $fmCUMULAP->bindParam(1,$a[0]);
                  $fmCUMULAP->bindParam(2,$a[1]);
                  $fmCUMULAP->execute(); 


 $fmTRAVAD=$bdd->prepare("select dis.id_dis,trav.*,mang.*, sum(trav.sac_flasque_tr_av),sum(trav.poids_flasque_tr_av),sum(trav.sac_mouille_tr_av),sum(trav.poids_mouille_tr_av), p.* from transfert_avaries as trav inner join produit_deb as p on trav.id_produit=p.id
     inner join dispatching as dis on trav.id_produit=dis.id_produit and trav.id_client=dis.id_client and trav.id_destination_tr=dis.id_mangasin and trav.id_dis_bl_tr=dis.id_dis 
     and trav.poids_sac_tr_av=dis.poids_kg
     inner join mangasin as mang on trav.id_destination_tr=mang.id
       where trav.id_navire=? and trav.date_tr_avaries=? group by mang.mangasin,p.produit, dis.id_dis with rollup");

                  $fmTRAVAD->bindParam(1,$a[0]);
                  $fmTRAVAD->bindParam(2,$a[1]);
                  $fmTRAVAD->execute();  

  $fmTTRAVAD=$bdd->prepare("select dis.id_dis,trav.*,mang.*, sum(trav.sac_flasque_tr_av),sum(trav.poids_flasque_tr_av),sum(trav.sac_mouille_tr_av),sum(trav.poids_mouille_tr_av), p.* from transfert_avaries as trav inner join produit_deb as p on trav.id_produit=p.id
     inner join dispatching as dis on trav.id_produit=dis.id_produit and trav.id_client=dis.id_client and trav.id_destination_tr=dis.id_mangasin and trav.id_dis_bl_tr=dis.id_dis 
     and trav.poids_sac_tr_av=dis.poids_kg
     inner join mangasin as mang on trav.id_destination_tr=mang.id
       where trav.id_navire=? and trav.date_tr_avaries<=? group by mang.mangasin,p.produit, dis.id_dis with rollup");

                  $fmTTRAVAD->bindParam(1,$a[0]);
                  $fmTTRAVAD->bindParam(2,$a[1]);
                  $fmTTRAVAD->execute();  

  $SD=$bdd->prepare("select dis.*,rm.*, sum(sac),sum(poids),p.* from register_manifeste as rm inner join produit_deb as p on rm.id_produit=p.id
     inner join dispatching as dis on rm.id_produit=dis.id_produit and rm.id_client=dis.id_client and rm.id_destination=dis.id_mangasin and rm.id_dis_bl=dis.id_dis 
     and rm.poids_sac=dis.poids_kg  where rm.id_navire=? and mr.dates=? group by p.produit, trav.poids_sac_tr_av");

                  $fmTRAVAP->bindParam(1,$a[0]);
                  $fmTRAVAP->bindParam(2,$a[1]);
                  $fmTRAVAP->execute();  

  
//REQUETE SITUATION RESTANT DES AVARIES
  
      

$fmTTRAVAPRES=$bdd->prepare("select dis.*,trav.*, sum(trav.sac_flasque_tr_av),sum(trav.poids_flasque_tr_av),sum(trav.sac_mouille_tr_av),sum(trav.poids_mouille_tr_av), p.* from transfert_avaries as trav inner join produit_deb as p on trav.id_produit=p.id
     inner join dispatching as dis on trav.id_produit=dis.id_produit and trav.id_client=dis.id_client and trav.id_destination_tr=dis.id_mangasin and trav.id_dis_bl_tr=dis.id_dis 
     and trav.poids_sac_tr_av=dis.poids_kg  where trav.id_navire=? and trav.date_tr_avaries<=? group by p.produit, trav.poids_sac_tr_av");

                  $fmTTRAVAPRES->bindParam(1,$a[0]);
                  $fmTTRAVAPRES->bindParam(2,$a[1]);
                  $fmTTRAVAPRES->execute();      
                   
$fmCUMULAPRES=$bdd->prepare("select av.*, sum(av.sac_flasque),sum(av.poids_flasque),sum(av.sac_mouille),sum(av.poids_mouille), p.* from avaries as av inner join produit_deb as p on p.id=av.id_produit where id_navire=? and date_avaries<=? group by p.produit, poids_sac_avaries");

                  $fmCUMULAPRES->bindParam(1,$a[0]);
                  $fmCUMULAPRES->bindParam(2,$a[1]);
                  $fmCUMULAPRES->execute(); 
  //FIN REQUETE


  /////REQUETE TRANSFERT ET LIVRAISON

  $TRANSF=$bdd->prepare("select rm.*,tr.*, dis.*, sum(rm.sac),sum(rm.poids),sum(tr.sac_flasque_tr_av),sum(tr.poids_flasque_tr_av),sum(tr.sac_mouille_tr_av),sum(tr.poids_mouille_tr_av) from register_manifeste as rm
    inner join dispatching as dis on dis.id_dis=rm.id_dis_bl
    inner join transfert_avaries as tr on rm.id_dis_bl=tr.id_dis_bl_tr
         where  rm.id_navire=? and rm.dates<=? and dis.des_douane='TRANSFERT'    ");
                   $TRANSF->bindParam(1,$a[0]);
                  $TRANSF->bindParam(2,$a[1]);
          
          
          $TRANSF->execute();    


////////PARTIE REQUETE SITUATION VRAC

 $caleTVRAC=$bdd->prepare("select dc.*, dc.poids as pd, sum(dc.nombre_sac), p.*, rm.*, sum(rm.sac),sum(rm.poids)  FROM declaration_chargement as dc
          inner  join produit_deb as p on dc.id_produit=p.id
          inner  join register_manifeste as rm on  dc.id_produit=rm.id_produit and dc.cales=rm.cale
          and dc.conditionnement=rm.poids_sac 
          
         where  dc.id_navire=? and rm.dates<=?    group by dc.cales,p.produit, dc.id_dec  with rollup ");
                 $caleTVRAC->bindParam(1,$a[0]);
                  $caleTVRAC->bindParam(2,$a[1]);
          
          
          $caleTVRAC->execute();

               $caleVRAC=$bdd->prepare("select dc.*,  dc.poids as pd, p.*, rm.*, sum(rm.sac),sum(rm.poids) FROM declaration_chargement as dc inner join produit_deb as p on dc.id_produit=p.id inner join register_manifeste as rm on dc.id_produit=rm.id_produit and dc.cales=rm.cale and dc.conditionnement=rm.poids_sac where dc.id_navire=? and rm.dates=? group by dc.cales,p.produit, dc.id_dec with rollup; ");
         $caleVRAC->bindParam(1,$a[0]);
          $caleVRAC->bindParam(2,$a[1]);
          
          $caleVRAC->execute();

 $produitTVRAC=$bdd->prepare("select dc.*,  dc.poids as pd, sum(dc.nombre_sac), p.*, rm.*, sum(rm.sac),sum(rm.poids)  FROM declaration_chargement as dc
          inner  join produit_deb as p on dc.id_produit=p.id

          inner  join register_manifeste as rm on  dc.id_produit=rm.id_produit and dc.cales=rm.cale
          and dc.conditionnement=rm.poids_sac 

         where  dc.id_navire=? and rm.dates<=?    group by p.produit,  p.qualite,dc.cales,dc.id_dec  with rollup ");
                  $produitTVRAC->bindParam(1,$a[0]);
                  $produitTVRAC->bindParam(2,$a[1]);
          
          
          $produitTVRAC->execute();


   $produitVRAC=$bdd->prepare("select dc.*, dc.poids as pd, sum(dc.nombre_sac), p.*, rm.*, sum(rm.sac),sum(rm.poids)  FROM declaration_chargement as dc
          inner  join produit_deb as p on dc.id_produit=p.id
          inner  join register_manifeste as rm on  dc.id_produit=rm.id_produit and dc.cales=rm.cale
          and dc.conditionnement=rm.poids_sac 

         where  dc.id_navire=? and rm.dates=?    group by p.produit,  p.qualite,dc.cales, dc.id_dec   with rollup ");
                  $produitVRAC->bindParam(1,$a[0]);
                  $produitVRAC->bindParam(2,$a[1]);
          
          
          $produitVRAC->execute();




 $STDVRAC=$bdd->prepare("select dis.*,rm.*,mang.*, sum(rm.sac),sum(rm.poids), p.*,cli.* from register_manifeste as rm inner join produit_deb as p on rm.id_produit=p.id
     inner join dispatching as dis on rm.id_produit=dis.id_produit and rm.id_client=dis.id_client and rm.id_destination=dis.id_mangasin and rm.id_dis_bl=dis.id_dis 
     and rm.poids_sac=dis.poids_kg
     inner join mangasin as mang on rm.id_destination=mang.id
     inner join client as cli on rm.id_client=cli.id
       where rm.id_navire=? and rm.dates=? group by mang.mangasin,p.produit, dis.id_dis with rollup");

                  $STDVRAC->bindParam(1,$a[0]);
                  $STDVRAC->bindParam(2,$a[1]);
                  $STDVRAC->execute();  

  $TSTDVRAC=$bdd->prepare("select dis.*,rm.*,mang.*, sum(rm.sac),sum(rm.poids), p.*,cli.* from register_manifeste as rm inner join produit_deb as p on rm.id_produit=p.id
     inner join dispatching as dis on rm.id_produit=dis.id_produit and rm.id_client=dis.id_client and rm.id_destination=dis.id_mangasin and rm.id_dis_bl=dis.id_dis 
     and rm.poids_sac=dis.poids_kg
     inner join mangasin as mang on rm.id_destination=mang.id
     inner join client as cli on rm.id_client=cli.id
       where rm.id_navire=? and rm.dates<=? group by mang.mangasin,p.produit, dis.id_dis with rollup");

                  $TSTDVRAC->bindParam(1,$a[0]);
                  $TSTDVRAC->bindParam(2,$a[1]);
                  $TSTDVRAC->execute();  




$STCLIVRAC=$bdd->prepare("select dis.*,rm.*,mang.*, sum(rm.sac),sum(rm.poids), p.*,cli.* from register_manifeste as rm inner join produit_deb as p on rm.id_produit=p.id
     inner join dispatching as dis on rm.id_produit=dis.id_produit and rm.id_client=dis.id_client  and rm.id_dis_bl=dis.id_dis 
     and rm.poids_sac=dis.poids_kg
     inner join mangasin as mang on rm.id_destination=mang.id
     inner join client as cli on rm.id_client=cli.id
       where rm.id_navire=? and rm.dates=? group by cli.client,p.produit, dis.id_dis with rollup");

                  $STCLIVRAC->bindParam(1,$a[0]);
                  $STCLIVRAC->bindParam(2,$a[1]);
                  $STCLIVRAC->execute();  

  $TSTCLIVRAC=$bdd->prepare("select dis.*,rm.*,mang.*, sum(rm.sac),sum(rm.poids), p.*,cli.* from register_manifeste as rm inner join produit_deb as p on rm.id_produit=p.id
     inner join dispatching as dis on rm.id_produit=dis.id_produit and rm.id_client=dis.id_client  and rm.id_dis_bl=dis.id_dis 
     and rm.poids_sac=dis.poids_kg
     inner join mangasin as mang on rm.id_destination=mang.id
     inner join client as cli on rm.id_client=cli.id
       where rm.id_navire=? and rm.dates<=? group by cli.client,p.produit, dis.id_dis with rollup");

                  $TSTCLIVRAC->bindParam(1,$a[0]);
                  $TSTCLIVRAC->bindParam(2,$a[1]);
                  $TSTCLIVRAC->execute();  

         

                               

        	?>
<?php // FILTRER NAVIRE SI C'EST VRAC OU SAC
           // 1 EN SAC     
           if($filtre_type['type']=="SACHERIE"){ ?>
<div id="deb_by_cale">

<style type="text/css">
  

    .enteteTable{
     background: linear-gradient(to bottom, blue, #1B2B65); background: linear-gradient(to left, blue, #1B2B65); background: linear-gradient(to top, blue, #1B2B65); color: white; text-align: center; font-weight: bold;
     vertical-align: middle; 
      border: 5px;
      border-color: black;

    }
         #table{
          border: 5px; 
     }
    #colLibeles{
      background: rgba(83,104,253,0.9); color: white;
      vertical-align: middle;
      text-align: center;

    } 
    #colManifeste{
      background: rgb(72,94,179); color:white;
      vertical-align: middle;
       text-align: center;
    }
    #colDeb24H{
      background-color: rgb(124, 158, 191); color:white;
      vertical-align: middle;
       text-align: center;
    }
    #colDebTOTAL{
      background-color: rgb(34, 155, 176); color:white;
      vertical-align: middle;
       text-align: center;
    }
    #colROB{
      background-color: rgb(28, 118, 51); color:white;
      vertical-align: middle;
       text-align: center;
    }
    #sousTOTAL{
       background-color:rgb(94,44,101);  color:white;
       font-weight: bold;
       text-align: center;
       vertical-align: middle;

    }
    #TOTAL{
      background: black;
      color: red;
      font-weight: bold;
      vertical-align: middle;
       text-align: center;
    }
    #colFlasque{
      background-color: rgb(193, 150, 0); color:white;
      vertical-align: middle;
       text-align: center; 
    }

    #colMouille{
      background-color: rgb(158, 106, 35); color:white;
      vertical-align: middle;
       text-align: center; 
    }
    #colCumulGen{
    background-color: rgb(200, 106, 90); color:white;
      vertical-align: middle;
      text-align: center;  
    }
  
</style>


<div class="table-responsive"  >
        	<?php if(!empty($tr['dates'])){
            $DateDebut=explode('-',$tr['dates']);
           if(!empty($tr2['dates'])){
            $DateActuel=explode('-',$tr2['dates']);?>

            <?php

 echo " <table class='table table-hover table-bordered table-striped' id='table' >";
    
?> 
<thead>
           <tr style="background: linear-gradient(to bottom, blue, #1B2B65); background: linear-gradient(to left, blue, #1B2B65); background: linear-gradient(to top, blue, #1B2B65); color: white; text-align: center; font-weight: bold; " >
           <td colspan="10" ><h4 style="color: white;">	SITUATION DU DEBARQUEMENT <span style="color:yellow;">PAR CALE</span> DU <span style="color: red; background: white;"><?php echo  $DateActuel[2]. '-' .$DateActuel[1].'-'.$DateActuel[0];?></span></h4></td></tr>
<?php 
         }  }
	 ?>
        	



	
 <tr class="EnteteTableSituation"  >
      <style type="text/css">
        .manif1{

        }
      </style>
      <td id="colLibeles" scope="col"  rowspan="2"  >CALES</td>
      <td id="colLibeles" scope="col"  rowspan="2"  >PRODUIT</td>
      <td id="colManifeste" colspan="2" >MANIFESTE</td>
      <td scope="col" colspan="2" id="colDeb24H" >DEB 24H</td>
      <td scope="col" colspan="2" id="colDebTOTAL" > TOTAL DEB</td>
      <td scope="col" colspan="2" id="colROB">ROB</td>
  </tr>
  	<tr class="EnteteTableSituation"  >
      
      <td id="colManifeste">NBRE SACS</td>
      <td id="colManifeste">POIDS</td>
        <td scope="col" id="colDeb24H" >NBRE SACS</td>
      <td scope="col" id="colDeb24H" >POIDS</td>
        <td scope="col" id="colDebTOTAL" >NBRE SACS</td>
      <td scope="col" id="colDebTOTAL" >POIDS</td>
        <td scope="col" id="colROB">NBRE SACS</td>
      <td scope="col" id="colROB" >POIDS</td>
        
     
     
 
         </tr>
         </thead> 
         
       <?php 
        
       while($cal2=$cale->fetch()){

       $calTOT=$caleT->fetch();
       $avariesT=$fmT->fetch();
       $avaries2=$fm->fetch();
/*
       $sac_sain_24H=$cal2['sum(rm.sac)'];
       $sac_flasque_24H=$avaries2['sum(av.sac_flasque)'];
       $sac_mouille_24H=$avaries2['sum(av.sac_mouille)'];

       $poids_sain_24H=$cal2['sum(rm.poids)'];
       $poids_flasque_24H=$avaries2['sum(av.poids_flasque)'];
       $poids_mouille_24H=$avaries2['sum(av.poids_mouille)'];

       $sac_total_deb*/
        
       
       $sum_sac=$cal2['nombre_sac']-$calTOT['sum(rm.sac)']-$avariesT['sum(sac_flasque)']-$avariesT['sum(sac_mouille)'];

       $poids=$cal2['nombre_sac']*$cal2['conditionnement']/1000;
       $sum_poids=$poids-$calTOT['sum(rm.poids)']-$avaries2['sum(poids_flasque)']-$avaries2['sum(poids_mouille)'];

      // $sacs_24H=$cal2['sum(rm.sac)']+$avaries2['sum(sac_flasque)']+$avaries2['sum(sac_mouille)'];
        $sacs_24H=$cal2['sum(rm.sac)']+$avaries2['sum(sac_flasque)']+$avaries2['sum(sac_mouille)'];
       // $poids_24H=$cal2['sum(rm.poids)']+$avaries2['sum(poids_flasque)']+$avaries2['poids_mouille'];
        $poids_24H=$cal2['sum(rm.poids)']+$avaries2['sum(poids_flasque)']+$avaries2['sum(poids_mouille)'];
        $total_sac=$calTOT['sum(rm.sac)']+$avariesT['sum(sac_flasque)']+$avariesT['sum(sac_mouille)'];
        $total_poids=$calTOT['sum(rm.poids)']+$avariesT['sum(poids_flasque)']+$avariesT['sum(poids_mouille)'];

        ?>

       	
          <?php if(!empty($cal2['produit']) and !empty($cal2['conditionnement']) and !empty($cal2['cales'])) {?>
            <tr class="CelluleTableSituation" >
    <td id="colLibeles" scope="col"   ><?php echo $cal2['cale']; ?></td>
    <td id="colLibeles"  scope="col"   ><?php echo $cal2['produit']; ?> <?php echo $cal2['conditionnement']; ?> KGS</td>
    
    <td  scope="col" id="colManifeste"  ><?php echo number_format($cal2['nombre_sac'], 0,',',' ');  ?></td>
    <td  scope="col" id="colManifeste" ><?php echo number_format($poids, 3,',',' '); ?></td>
    
     	<td id="colDeb24H" scope="col" ><?php echo number_format($sacs_24H, 0,',',' '); ?></td>
     	<td id="colDeb24H" scope="col"  ><?php echo number_format($poids_24H, 3,',',' '); ?></td>
     	<td scope="col" id="colDebTOTAL"><?php echo number_format($total_sac, 0,',',' '); ?></td>
     	<td scope="col" id="colDebTOTAL"><?php echo number_format($total_poids, 3,',',' '); ?></td>
     <td scope="col" id="colROB"><?php echo number_format($sum_sac, 0,',',' '); ?></td>
     	<td scope="col" id="colROB" ><?php echo number_format($sum_poids, 3,',',' '); ?></td>
     </tr>
     <?php } ?>

     <?php if(empty($cal2['produit']) and empty($cal2['conditionnement']) and !empty($cal2['cales'])) {?>
      <tr id="sousTOTAL" >
    <td id="sousTOTAL" scope="col" colspan="2" >TOTAL <?php echo $cal2['cale']; ?></td>
    
    <td scope="col" id="sousTOTAL"> <?php $total=$bdd->prepare("select sum(nombre_sac), sum(poids) from declaration_chargement where id_navire=? and cales=?");
       $total->bindParam(1,$a[0]);
       $total->bindParam(2,$cal2['cales']);
       $total->execute(); 
       while($t=$total->fetch()){ 
        echo number_format($t['sum(nombre_sac)'], 0,',',' ');?>
        </td>
    <td  scope="col" id="sousTOTAL" ><?php echo number_format($t['sum(poids)'], 3,',',' '); ?></td>
    
      <td  scope="col" id="sousTOTAL" ><?php echo number_format($sacs_24H, 0,',',' '); ?></td>
      <td  scope="col" id="sousTOTAL" ><?php echo number_format($poids_24H, 3,',',' '); ?></td>
      <td s scope="col"  id="sousTOTAL" ><?php echo number_format($total_sac, 0,',',' '); ?></td>
      <td  scope="col" id="sousTOTAL" ><?php echo number_format($total_poids, 3,',',' '); ?></td>
      <?php $rob_sac=$t['sum(nombre_sac)']-$total_sac;
            $rob_poids=$t['sum(poids)']-$total_poids;

       ?>
     <td id="sousTOTAL" scope="col" ><?php echo number_format($rob_sac, 0,',',' '); ?></td>
      <td id="sousTOTAL" scope="col" ><?php echo number_format($rob_poids, 3,',',' '); ?></td>

      <?php } ?>
      </tr>
     <?php } ?>



     <?php if(empty($cal2['produit']) and empty($cal2['conditionnement']) and empty($cal2['cales'])) {?>
      <tr class="CelluleTotal2" >

    <td id="TOTAL" scope="col" colspan="2"  >TOTAL </td>
    
    <td id="TOTAL" scope="col"   > <?php $total2=$bdd->prepare("select sum(nombre_sac), sum(poids) from declaration_chargement where id_navire=?  ");
       $total2->bindParam(1,$a[0]);
       
       $total2->execute(); 
       while($t=$total2->fetch()){ 
        echo number_format($t['sum(nombre_sac)'], 0,',',' ');?>
        </td>
    <td id="TOTAL" scope="col"   ><?php echo number_format($t['sum(poids)'], 3,',',' '); ?></td>
    
      <td id="TOTAL" scope="col"   ><?php echo number_format($sacs_24H, 0,',',' '); ?></td>
      <td id="TOTAL" scope="col"   ><?php echo number_format($poids_24H, 3,',',' '); ?></td>
      <td id="TOTAL" scope="col"   ><?php echo number_format($total_sac, 0,',',' '); ?></td>
      <td id="TOTAL" scope="col"  ><?php echo number_format($total_poids, 3,',',' '); ?></td>
            <?php $rob_sac2=$t['sum(nombre_sac)']-$total_sac;
            $rob_poids2=$t['sum(poids)']-$total_poids;

       ?>
     <td id="TOTAL" scope="col" ><?php echo number_format($rob_sac2, 0,',',' ') ?></td>
      <td id="TOTAL" scope="col"><?php echo number_format($rob_poids2, 3,',',' '); ?></td>
     <?php } ?>
   </tr>

     <?php } ?>


     <?php }  ?>
    
 
      
		 

 </table>
</div>
</div>
</div>
</div>

<button style="margin:auto-right;" class="btn btn-primary" onClick="imprimer('deb_by_cale')">imprimer</button>
<br><br><br><br><br>

<?php if(!empty($trP['dates'])){
            $DateDebut=explode('-',$tr['dates']);
           if(!empty($tr2P['dates'])){
            $DateActuel=explode('-',$tr2P['dates']);?>

            <?php

 echo " <table class='table table-hover table-bordered table-striped' id='table' border='2' >";
    
?> 
<thead>
           <tr style="background: black; color: white; text-align: center; font-weight: bold; " >
           <td colspan="10" ><h4 style="color: white;"> SITUATION DU DEBARQUEMENT <span style="color:yellow;">PAR PRODUIT</span> DU <span style="color: red; background: white;"><?php echo  $DateActuel[2]. '-' .$DateActuel[1].'-'.$DateActuel[0];?></span></h4></td></tr>
<?php 
         }  }
   ?>
          
  
 <tr  class="EnteteTableSituation"  >
      
      
      <td scope="col"  rowspan="2" id="colLibeles" >PRODUIT</td>
       <td scope="col"  rowspan="2" id="colLibeles" >CALES</td>
      <td scope="col" colspan="2" id="colManifeste" >MANIFESTE</td>
      <td scope="col" colspan="2" id="colDeb24H" >DEB 24H</td>
      <td scope="col" colspan="2" id="colDebTOTAL" > TOTAL DEB</td>
      <td scope="col" colspan="2" id="colROB" >ROB</td>
  </tr>
    <tr class="EnteteTableSituation" >
      
      <td scope="col" id="colManifeste">NBRE SACS</td>
      <td scope="col" id="colManifeste">POIDS</td>
        <td scope="col" id="colDeb24H">NBRE SACS</td>
      <td scope="col" id="colDeb24H">POIDS</td>
        <td scope="col" id="colDebTOTAL">NBRE SACS</td>
      <td scope="col"  id="colDebTOTAL">POIDS</td>
        <td scope="col" id="colROB">NBRE SACS</td>
      <td scope="col" id="colROB">POIDS</td>
        
     
     
 
         </tr>
         </thead> 

<?php 
        
       while($prod=$produit->fetch()){

       $prodT=$produitT->fetch();
       $avariesT=$fmpT->fetch();
       $avaries2=$fmp->fetch();
        
       
       $sum_sac=$prod['nombre_sac'] -$prodT['sum(rm.sac)']-$avariesT['sum(sac_flasque)']-$avariesT['sum(sac_mouille)'];

       $poids=$prod['nombre_sac']*$prod['conditionnement']/1000;
       $sum_poids=$poids-$prodT['sum(rm.poids)']-$avaries2['sum(poids_flasque)']-$avaries2['sum(poids_mouille)'];

       $sacs_24H=$prod['sum(rm.sac)']+$avaries2['sum(sac_flasque)']+$avaries2['sum(sac_mouille)'];

        $poids_24H=$prod['sum(rm.poids)']+$avaries2['sum(poids_flasque)']+$avaries2['poids_mouille'];

        $total_sac=$prodT['sum(rm.sac)']+$avariesT['sum(sac_flasque)']+$avariesT['sum(sac_mouille)'];
        $total_poids=$prodT['sum(rm.poids)']+$avariesT['sum(poids_flasque)']+$avariesT['sum(poids_mouille)'];

        ?>

        <tr class="EnteteTableSituation" style="text-align: center;">
          <?php if(!empty($prod['produit']) and !empty($prod['conditionnement']) and !empty($prod['cales']) and !empty($prod['id_dec'])) {?>
    
    <td scope="col" id="colLibeles" ><?php echo $prod['produit']; ?> <?php echo $prod['conditionnement']; ?> KGS</td>
    <td scope="col" id="colLibeles" ><?php echo $prod['cales']; ?></td>
    <td scope="col"  id="colManifeste"><?php echo number_format($prod['nombre_sac'], 0,',',' ');  ?></td>
    <td scope="col" id="colManifeste"  ><?php echo number_format($poids, 3,',',' '); ?></td>
      <td scope="col"  id="colDeb24H" ><?php echo number_format($sacs_24H, 0,',',' '); ?></td>
      <td scope="col" id="colDeb24H" ><?php echo number_format($poids_24H, 3,',',' '); ?></td>
      <td scope="col" id="colDebTOTAL" ><?php echo number_format($total_sac, 0,',',' '); ?></td>
      <td scope="col" id="colDebTOTAL" ><?php echo number_format($total_poids, 3,',',' '); ?></td>
     <td scope="col" id="colROB" ><?php echo number_format($sum_sac, 0,',',' '); ?></td>
      <td scope="col" id="colROB" ><?php echo number_format($sum_poids, 3,',',' '); ?></td>
     <?php } ?>

     <?php if(!empty($prod['produit']) and !empty($prod['conditionnement']) and empty($prod['cales']) and empty($prod['id_dec'])) {?>
    <td scope="col" colspan="2" id="sousTOTAL" >TOTAL <?php echo $prod['produit']; ?> <?php echo $prod['conditionnement']; ?> KGS </td>

    
    <td scope="col" id="sousTOTAL"  > <?php $total=$bdd->prepare("select sum(nombre_sac), sum(poids) from declaration_chargement where id_navire=? and conditionnement=? and id_produit=?");
       $total->bindParam(1,$a[0]);
       $total->bindParam(2,$prod['conditionnement']);
       $total->bindParam(3,$prod['id_produit']);
       $total->execute(); 
       while($t=$total->fetch()){ 
        echo number_format($t['sum(nombre_sac)'], 0,',',' ');?>
        </td>
    <td scope="col" id="sousTOTAL"  ><?php echo number_format($t['sum(poids)'], 3,',',' '); ?></td>
    
      <td scope="col" id="sousTOTAL"  ><?php echo number_format($sacs_24H, 0,',',' '); ?></td>
      <td scope="col" id="sousTOTAL"  ><?php echo number_format($poids_24H, 3,',',' '); ?></td>
      <td scope="col" id="sousTOTAL" ><?php echo number_format($total_sac, 0,',',' '); ?></td>
      <td scope="col" id="sousTOTAL"  ><?php echo number_format($total_poids, 3,',',' '); ?></td>
      <?php $rob_sac=$t['sum(nombre_sac)']-$total_sac;
            $rob_poids=$t['sum(poids)']-$total_poids;

       ?>
     <td scope="col" id="sousTOTAL"  ><?php echo number_format($rob_sac, 0,',',' '); ?></td>
      <td scope="col" id="sousTOTAL"><?php echo number_format($rob_poids, 3,',',' '); ?></td>
      <?php } ?>
     <?php } ?>


     <?php if(empty($prod['produit']) and empty($prod['conditionnement']) and empty($prod['cales']) and empty($prod['id_dec'])) {?>
    <td scope="col" colspan="2" id="TOTAL" >TOTAL </td>
    
    <td scope="col" id="TOTAL"  > <?php $total2=$bdd->prepare("select sum(nombre_sac), sum(poids) from declaration_chargement where id_navire=?  ");
       $total2->bindParam(1,$a[0]);
       
       $total2->execute(); 
       while($t=$total2->fetch()){ 
        echo number_format($t['sum(nombre_sac)'], 0,',',' ');?>
        </td>
    <td scope="col" id="TOTAL"  ><?php echo number_format($t['sum(poids)'], 3,',',' '); ?></td>
    
      <td scope="col" id="TOTAL"  ><?php echo number_format($sacs_24H, 0,',',' '); ?></td>
      <td scope="col" id="TOTAL"  ><?php echo number_format($poids_24H, 3,',',' '); ?></td>
      <td scope="col" id="TOTAL"  ><?php echo number_format($total_sac, 0,',',' '); ?></td>
      <td scope="col" id="TOTAL"  ><?php echo number_format($total_poids, 3,',',' '); ?></td>
            <?php $rob_sac2=$t['sum(nombre_sac)']-$total_sac;
            $rob_poids2=$t['sum(poids)']-$total_poids;

       ?>
     <td scope="col" id="TOTAL"  ><?php echo number_format($rob_sac2, 0,',',' ') ?></td>
      <td scope="col" id="TOTAL"  ><?php echo number_format($rob_poids2, 3,',',' '); ?></td>
     <?php } ?>
     <?php } ?>


 
      
    
   
     </tr>
     <?php }  ?>
    
 
      
     

 </table>
</div>
</div>
<br><br><br>


<?php if(!empty($trP['dates'])){
            $DateDebut=explode('-',$tr['dates']);
           if(!empty($tr2P['dates'])){
            $DateActuel=explode('-',$tr2P['dates']);?>

            <?php

 echo " <table class='table table-hover table-bordered table-striped' id='table' border='2' >";
    
?> 
<thead>
           <tr style="background: black; color: white; text-align: center; font-weight: bold; " >
           <td colspan="11" ><h4 style="color: white;"> SITUATION DU DEBARQUEMENT <span style="color:yellow;">PAR DESTINATION</span> DU <span style="color: red; background: white;"><?php echo  $DateActuel[2]. '-' .$DateActuel[1].'-'.$DateActuel[0];?></span></h4></td></tr>
<?php 
         }  }
   ?>
 
  
 <tr  style="background-color: rgba(50, 159, 218, 0.9); text-align: center;"  >
      
      
    
       <td scope="col"  rowspan="3" id="colLibeles" >DESTINATION</td>
        <td scope="col" rowspan="3" id="colLibeles" >PRODUIT</td>
        <td scope="col"  rowspan="3" id="colLibeles" >CLIENT</td>
       
      
     
  </tr>
    <tr style="background-color: rgba(50, 159, 218, 0.9); text-align: center;" >
      
      <td scope="col" colspan="2" id="colManifeste" >MANIFESTE</td>
      <td scope="col" colspan="2" id="colDeb24H">DEB 24H</td>
     
      <td scope="col" colspan="2" id="colDebTOTAL">TOTAL DEB</td>
      <td scope="col" colspan="2" id="colROB">ROB</td>
     
      </tr>
     
        

      <tr >
        <td scope="col" id="colManifeste" >NBRE SACS</td>
      <td scope="col" id="colManifeste" >POIDS</td>
        <td scope="col"  id="colDeb24H">NBRE SACS</td>
      <td scope="col" id="colDeb24H">POIDS</td>
        <td scope="col" id="colDebTOTAL"  >NBRE SACS</td>
      <td scope="col"  id="colDebTOTAL">POIDS</td>
       <td scope="col"  id="colROB">NBRE SACS</td>
      <td scope="col"  id="colROB">POIDS</td>
     
      
      
    
       </tr>
         </thead>
<tbody>

  <?php 
while ($fm0=$STDVRAC->fetch()) { 
  $avar=$TSTDVRAC->fetch();
  
  

  $cumul_sac=$avar['sum(rm.sac)'];
  $cumul_poids=$avar['sum(rm.poids)'];
  $rob_sac=$fm0['nombre_sac']-$cumul_sac;
  $rob_poids=$fm0['poids_t']-$cumul_poids;

  if (!empty($fm0['mangasin']) and !empty($fm0['produit']) and !empty($fm0['id_dis']) ){ ?>
       <tr style="text-align: center;">
        <td scope="col" id="colLibeles"><?php echo $fm0['mangasin']  ?></td>
            <td scope="col" id="colLibeles" ><?php echo $fm0['produit']; ?> <?php echo $fm0['poids_sac']; ?> KGS</td>
              <td scope="col" id="colLibeles" ><?php echo $fm0['client']; ?> </td>

     <td scope="col" id="colManifeste"  ><?php echo number_format($fm0['nombre_sac'], 0,',',' ');  ?></td>
       <td scope="col" id="colManifeste" ><?php echo number_format($fm0['poids_t'], 3,',',' '); ?></td>
    <td scope="col" id="colDeb24H" ><?php echo number_format($fm0['sum(rm.sac)'], 0,',',' ');  ?></td>
    <td scope="col" id="colDeb24H"  ><?php echo number_format($fm0['sum(rm.poids)'], 3,',',' '); ?></td>
      <td scope="col" id="colDebTOTAL" ><?php echo number_format($cumul_sac, 0,',',' '); ?></td>
      <td scope="col"  id="colDebTOTAL"  ><?php echo number_format($cumul_poids, 3,',',' '); ?></td>
       <td scope="col" id="colROB" ><?php echo number_format($rob_sac, 0,',',' '); ?></td>
      <td scope="col" id="colROB"  ><?php echo number_format($rob_poids, 3,',',' '); ?></td>
            
   
   
     </tr>
  
 <?php } 

 if (!empty($fm0['mangasin']) and empty($fm0['produit']) and empty($fm0['id_dis']) ){ ?>
       <tr >
        <td scope="col" colspan="3" id="sousTOTAL" > TOTAL <?php echo $fm0['mangasin']  ?></td>
            
   <td scope="col" id="sousTOTAL"  > <?php $total=$bdd->prepare("select sum(sac), sum(poids)  from register_manifeste
    where id_navire=?  and dates=? and id_destination=? ");
       $total->bindParam(1,$a[0]);
       
       $total->bindParam(2,$a[1]);
       $total->bindParam(3,$fm0['id_destination']);
      
       
       $total->execute(); 
        $totaldis=$bdd->prepare("select sum(nombre_sac),  sum(poids_t)  from dispatching 
    where id_navire=?   and id_mangasin=?   ");
       $totaldis->bindParam(1,$a[0]);
    
        $totaldis->bindParam(2,$fm0['id_destination']);
        $totaldis->execute();

       while($td=$totaldis->fetch()){
       while($t=$total->fetch()){ 
        echo number_format($td['sum(nombre_sac)'], 0,',',' ');?>
        </td>
    <td scope="col" id="sousTOTAL"><?php echo number_format($td['sum(poids_t)'], 3,',',' '); ?></td>
      <td scope="col" id="sousTOTAL"  ><?php $total2=$bdd->prepare("select sum(sac), sum(poids) from register_manifeste
    where id_navire=?  and dates<=? and id_destination=? ");
       $total2->bindParam(1,$a[0]);
       
       $total2->bindParam(2,$a[1]);
       $total2->bindParam(3,$fm0['id_destination']);
       $total2->execute();

       
       while($t2=$total2->fetch()){ 
        echo number_format($t['sum(sac)'], 0,',',' ');?>
        </td>
    <td scope="col" id="sousTOTAL"  ><?php echo number_format($t['sum(poids)'], 3,',',' '); ?></td>
      <td scope="col" id="sousTOTAL"  ><?php echo number_format($t2['sum(sac)'], 0,',',' '); ?></td>
         <td scope="col" id="sousTOTAL"  ><?php echo number_format($t2['sum(poids)'], 3,',',' '); ?></td> 
         <?php $cumul_sac=$td['sum(nombre_sac)']-$t2['sum(sac)']; ?>   
    <?php $cumul_poids=$td['sum(poids_t)']-$t2['sum(poids)']; ?>
      
       <td scope="col" id="sousTOTAL" ><?php echo number_format($cumul_sac, 0,',',' ');  ?></td>
      <<td scope="col" id="sousTOTAL" ><?php echo number_format($cumul_poids, 3,',',' '); ?></td>

    
    
   
     </tr>
  
 <?php } } } }
 if (empty($fm0['mangasin']) and empty($fm0['produit']) and empty($fm0['id_dis']) ){ ?>
       <tr id="TOTAL">
        <td scope="col" colspan="3" id="TOTAL"  > TOTAL<?php echo $fm0['mangasin']  ?></td>
       <?php $total3_24=$bdd->prepare("select sum(sac), sum(poids)  from register_manifeste
    where id_navire=?  and dates=?  ");
       $total3_24->bindParam(1,$a[0]);
       
       $total3_24->bindParam(2,$a[1]);
      
       $total3_24->execute(); 
               $totaldis=$bdd->prepare("select sum(nombre_sac),  sum(poids_t)  from dispatching 
    where id_navire=?     ");
       $totaldis->bindParam(1,$a[0]);
    
        
        $totaldis->execute();

       while($td=$totaldis->fetch()){
          while($t3_24=$total3_24->fetch()){ ?>     
     
    <td scope="col" id="TOTAL"  ><?php echo number_format($td['sum(nombre_sac)'], 0,',',' ');  ?></td>
    <td scope="col" id="TOTAL"  ><?php echo number_format($td['sum(poids_t)'], 3,',',' '); ?></td>
    <?php $total3_TOT=$bdd->prepare("select sum(sac), sum(poids)  from register_manifeste
    where id_navire=?  and dates<=?  ");
       $total3_TOT->bindParam(1,$a[0]);
       
       $total3_TOT->bindParam(2,$a[1]);
       
       $total3_TOT->execute(); 
             while($t3_TOT=$total3_TOT->fetch()) { ?>
      <td scope="col" id="TOTAL"  ><?php echo number_format(0, 0,',',' '); ?></td>
      <td scope="col" id="TOTAL" ><?php echo number_format($t3_24['sum(poids)'], 3,',',' '); ?></td>
       <td scope="col"  id="TOTAL"><?php echo number_format($t3_TOT['sum(sac)'], 0,',',' '); ?></td>
      <td scope="col" id="TOTAL"  ><?php echo number_format($t3_TOT['sum(poids)'], 3,',',' '); ?></td>
     <?php $cumul_sac=$td['sum(nombre_sac)']-$t3_TOT['sum(sac)']; ?>       
    <?php $cumul_poids=$td['sum(poids_t)']-$t3_TOT['sum(poids)']; ?>
       <td scope="col" id="TOTAL"  ><?php echo number_format($cumul_sac, 0,',',' ');  ?></td>
      <<td scope="col" id="TOTAL" ><?php echo number_format($cumul_poids, 3,',',' '); ?></td>

    
    
   
     </tr>
  <?php } } } } ?> 
 <?php } ?>



<?php if(!empty($trP['dates'])){
            $DateDebut=explode('-',$tr['dates']);
           if(!empty($tr2P['dates'])){
            $DateActuel=explode('-',$tr2P['dates']);?>

            <?php

 echo " <table class='table table-hover table-bordered table-striped' id='table' border='2' >";
    
?> 
<thead>
           <tr style="background: black; color: white; text-align: center; font-weight: bold; " >
           <td colspan="11" ><h4 style="color: white;"> SITUATION DU DEBARQUEMENT <span style="color:yellow;">PAR CLIENT</span> DU <span style="color: red; background: white;"><?php echo  $DateActuel[2]. '-' .$DateActuel[1].'-'.$DateActuel[0];?></span></h4></td></tr>
<?php 
         }  }
   ?>
 
  
 <tr    >
      
      
    
       <td scope="col"  rowspan="3"  id="colLibeles">CLIENT</td>
        <td scope="col"  rowspan="3" id="colLibeles">PRODUIT</td>
        <td scope="col"  rowspan="3"  id="colLibeles">DESTINATION</td>
       
      
     
  </tr>
    <tr style="background-color: rgba(50, 159, 218, 0.9); text-align: center;" >
      
      <td scope="col" colspan="2"  id="colManifeste">MANIFESTE</td>
      <td scope="col" colspan="2" id="colDeb24H" >DEB 24H</td>
     
      <td scope="col" colspan="2" id="colDebTOTAL" >TOTAL DEB</td>
      <td scope="col" colspan="2" id="colROB" >ROB</td>
     
      </tr>
     
        

      <tr >
        <td scope="col" id="colManifeste" >NBRE SACS</td>
      <td scope="col"  id="colManifeste" >POIDS</td>
        <td scope="col" id="colDeb24H" >NBRE SACS</td>
      <td scope="col" id="colDeb24H" >POIDS</td>
        <td scope="col" id="colDebTOTAL" >NBRE SACS</td>
      <td scope="col"  id="colDebTOTAL" >POIDS</td>
       <td scope="col" id="colROB" >NBRE SACS</td>
      <td scope="col" id="colROB">POIDS</td>
     
      
      
    
       </tr>
         </thead>
<tbody>

  <?php 
while ($fm0=$STCLIVRAC->fetch()) { 
  $avar=$TSTCLIVRAC->fetch();
  
  

  $cumul_sac=$avar['sum(rm.sac)'];
  $cumul_poids=$avar['sum(rm.poids)'];
  $rob_sac=$fm0['nombre_sac']-$cumul_sac;;
  $rob_poids=$fm0['poids_t']-$cumul_poids;

  if (!empty($fm0['client']) and !empty($fm0['produit']) and !empty($fm0['id_dis']) ){ ?>
       <tr >
        <td scope="col" id="colLibeles" ><?php echo $fm0['client']  ?></td>
            <td scope="col" id="colLibeles"  ><?php echo $fm0['produit']; ?> <?php echo $fm0['poids_sac']; ?> KGS</td>
              <td scope="col" id="colLibeles" ><?php echo $fm0['mangasin']; ?> </td>
     <td scope="col" id="colManifeste" ><?php echo number_format($fm0['nombre_sac'], 0,',',' ');  ?></td>
       <td scope="col" id="colManifeste" ><?php echo number_format($fm0['poids_t'], 3,',',' '); ?></td>
    <td scope="col"  id="colDeb24H" ><?php echo number_format($fm0['sum(rm.sac)'], 0,',',' ');  ?></td>
    <td scope="col" id="colDeb24H" ><?php echo number_format($fm0['sum(rm.poids)'], 3,',',' '); ?></td>
      <td scope="col" id="colDebTOTAL"  ><?php echo number_format($cumul_sac, 0,',',' '); ?></td>
      <td scope="col" id="colDebTOTAL" ><?php echo number_format($cumul_poids, 3,',',' '); ?></td>
       <td scope="col" id="colROB" ><?php echo number_format($rob_sac, 0,',',' '); ?></td>
      <td scope="col" id="colROB" ><?php echo number_format($rob_poids, 3,',',' '); ?></td>
            
   
       

    
    
   
     </tr>
  
 <?php } 

 if (!empty($fm0['client']) and empty($fm0['produit']) and empty($fm0['id_dis']) ){ ?>
       <tr style="text-align: center; ">
        <td scope="col" colspan="3" id="sousTOTAL"  > TOTAL <?php echo $fm0['client']  ?></td>
            
   <td scope="col" id="sousTOTAL"  > <?php $total=$bdd->prepare("select sum(sac), sum(poids)  from register_manifeste
    where id_navire=?  and dates=? and id_client=? ");
       $total->bindParam(1,$a[0]);
       
       $total->bindParam(2,$a[1]);
       $total->bindParam(3,$fm0['id_client']);
      
       
       $total->execute(); 
        $totaldis=$bdd->prepare("select sum(nombre_sac),  sum(poids_t)  from dispatching 
    where id_navire=?   and id_client=?   ");
       $totaldis->bindParam(1,$a[0]);
    
        $totaldis->bindParam(2,$fm0['id_client']);
        $totaldis->execute();

       while($td=$totaldis->fetch()){
       while($t=$total->fetch()){ 
        echo number_format($td['sum(nombre_sac)'], 0,',',' ');?>
        </td>
    <td scope="col" id="sousTOTAL"  ><?php echo number_format($td['sum(poids_t)'], 3,',',' '); ?></td>
      <td scope="col" id="sousTOTAL" ><?php $total2=$bdd->prepare("select sum(sac), sum(poids) from register_manifeste
    where id_navire=?  and dates<=? and id_client=? ");
       $total2->bindParam(1,$a[0]);
       
       $total2->bindParam(2,$a[1]);
       $total2->bindParam(3,$fm0['id_client']);
       $total2->execute();

       
       while($t2=$total2->fetch()){ 
        echo number_format($t['sum(sac)'], 0,',',' ');?>
        </td>
    <td scope="col" id="sousTOTAL"  ><?php echo number_format($t['sum(poids)'], 3,',',' '); ?></td>
      <td scope="col" id="sousTOTAL"  ><?php echo number_format($t2['sum(sac)'], 0,',',' '); ?></td>
         <td scope="col" id="sousTOTAL" ><?php echo number_format($t2['sum(poids)'], 3,',',' '); ?></td> 
          <?php $cumul_sac=$td['sum(nombre_sac)']-$t2['sum(sac)']; ?>   
    <?php $cumul_poids=$td['sum(poids_t)']-$t2['sum(poids)']; ?>
      
       <td scope="col" id="sousTOTAL" ><?php echo number_format($cumul_sac, 0,',',' ');  ?></td>
      <td scope="col" id="sousTOTAL" ><?php echo number_format($cumul_poids, 3,',',' '); ?></td>

    
    
   
     </tr>
  
 <?php } } } }
 if (empty($fm0['client']) and empty($fm0['produit']) and empty($fm0['id_dis']) ){ ?>
       <tr >
        <td scope="col" colspan="3"  id="TOTAL"> TOTAL<?php echo $fm0['client']  ?></td>
       <?php $total3_24=$bdd->prepare("select sum(sac), sum(poids)  from register_manifeste
    where id_navire=?  and dates=?  ");
       $total3_24->bindParam(1,$a[0]);
       
       $total3_24->bindParam(2,$a[1]);
      
       $total3_24->execute(); 
               $totaldis=$bdd->prepare("select sum(nombre_sac),  sum(poids_t)  from dispatching 
    where id_navire=?     ");
       $totaldis->bindParam(1,$a[0]);
    
        
        $totaldis->execute();

       while($td=$totaldis->fetch()){
          while($t3_24=$total3_24->fetch()){ ?>     
     
    <td scope="col"  id="TOTAL"><?php echo number_format($td['sum(nombre_sac)'], 0,',',' ');  ?></td>
    <td scope="col" id="TOTAL"><?php echo number_format($td['sum(poids_t)'], 3,',',' '); ?></td>
    <?php $total3_TOT=$bdd->prepare("select sum(sac), sum(poids)  from register_manifeste
    where id_navire=?  and dates<=?  ");
       $total3_TOT->bindParam(1,$a[0]);
       
       $total3_TOT->bindParam(2,$a[1]);
       
       $total3_TOT->execute(); 
             while($t3_TOT=$total3_TOT->fetch()) { ?>
      <td scope="col" id="TOTAL"><?php echo number_format($t3_24['sum(sac)'], 0,',',' '); ?></td>
      <td scope="col" id="TOTAL"><?php echo number_format($t3_24['sum(poids)'], 3,',',' '); ?></td>
       <td scope="col" id="TOTAL" > <?php echo number_format($t3_TOT['sum(sac)'], 0,',',' '); ?></td>
      <td scope="col" id="TOTAL" > <?php echo number_format($t3_TOT['sum(poids)'], 3,',',' '); ?></td>
      
    <?php $cumul_sac=$td['sum(nombre_sac)']-$t3_TOT['sum(sac)'];  ?>        
    <?php $cumul_poids=$td['sum(poids_t)']-$t3_TOT['sum(poids)']; ?>
       <td scope="col" id="TOTAL" ><?php echo number_format($cumul_sac, 0,',',' ');  ?></td>
      <<td scope="col" id="TOTAL" ><?php echo number_format($cumul_poids, 3,',',' '); ?></td>

    
    
   
     </tr>
  <?php } } } } ?> 
 <?php } ?>





<?php if(!empty($trP['dates'])){
            $DateDebut=explode('-',$tr['dates']);
           if(!empty($tr2P['dates'])){
            $DateActuel=explode('-',$tr2P['dates']);?>

            <?php

 echo " <table class='table table-hover table-bordered table-striped' id='table' border='2' >";
    
?> 
<thead>
           <tr style="background: black; color: white; text-align: center; font-weight: bold; " >
           <td colspan="12" ><h4 style="color: white;"> SITUATION DU DEBARQUEMENT DES AVARIES <span style="color:yellow;">PAR CALE</span> DU <span style="color: red; background: white;"><?php echo  $DateActuel[2]. '-' .$DateActuel[1].'-'.$DateActuel[0];?></span></h4></td></tr>
<?php 
         }  }
   ?>
 
  
 <tr   >
      
      
      <td scope="col"  rowspan="3" id="colLibeles">CALE</td>
       <td scope="col" rowspan="3" id="colLibeles">PRODUIT</td>
      <td scope="col" colspan="4"  style="color: white; font-weight: bold;" id="colFlasque">FLASQUES</td>
      <td scope="col" colspan="4" id="colMouille" >MOUILLES</td>
      <td scope="col" rowspan="2" colspan="2" id="colCumulGen"> CUMUL GENERAL</td>
     
  </tr>
    <tr style="background-color: rgba(50, 159, 218, 0.9); text-align: center;" >
      
      <td scope="col" colspan="2"  id="colFlasque">DEB 24H</td>
      <td scope="col" colspan="2" id="colFlasque" >DEB TOTAL</td>
      <td scope="col" colspan="2" id="colMouille">DEB 24H</td>
      <td scope="col" colspan="2" id="colMouille">DEB TOTAL</td>
      </tr>
      <tr >
        <td scope="col"  id="colFlasque">NBRE SACS</td>
      <td scope="col"  id="colFlasque">POIDS</td>
        <td scope="col"  id="colFlasque">NBRE SACS</td>
      <td scope="col"  id="colFlasque">POIDS</td>
        <td scope="col"  id="colMouille">NBRE SACS</td>
      <td scope="col"  id="colMouille">POIDS</td>
       <td scope="col" id="colMouille">NBRE SACS</td>
      <td scope="col" id="colMouille">POIDS</td>
      
      
       <td scope="col" id="colCumulGen">NBRE SACS</td>
      <td scope="col"  id="colCumulGen">POIDS</td>
        
       </tr>
         </thead> 
         <body>
<?php 
        
       while($fm0=$fmAC->fetch()){

       $avar=$fmTAC->fetch();

        
       
      /* $sum_sac=$avariesT['sum(av.sac_flasque)'] $fm0['sum(av.sac_flasque)']-$avariesT['sum(av.sac_flasque)']-$avariesT['sum(av.sac_mouille)'];

       $poids=$calAC['nombre_sac']*$calAC['conditionnement']/1000;
       $sum_poids=$poids-$calAC['sum(av.poids_flasque)']-$avaries2['sum(av.poids_flasque)']-$avaries2['sum(av.poids_mouille)'];*/

       $sacsf_T=$avar['sum(av.sac_flasque)'];
        $sacsm_T=$avar['sum(av.sac_mouille)'];
       $poidsf_T=$avar['sum(av.poids_flasque)'];
        $poidsm_T=$avar['sum(av.poids_mouille)'];
         
         $sum_sac=$sacsf_T+$sacsm_T;
         $sum_poids=$poidsf_T+$poidsm_T;
        

        /*$total_sac=$prodT['sum(rm.sac)']+$avariesT['sum(sac_flasque)']+$avariesT['sum(sac_mouille)'];
        $total_poids=$prodT['sum(rm.poids)']+$avariesT['sum(poids_flasque)']+$avariesT['sum(poids_mouille)'];*/

        ?>

        <tr style="text-align: center;">
          <?php if(!empty($fm0['produit']) and !empty($fm0['conditionnement']) and !empty($fm0['cales']) ) {?>
     <td scope="col"   id="colLibeles"><?php echo $fm0['cales']; ?></td>
    <td scope="col"   id="colLibeles"><?php echo $fm0['produit']; ?> <?php echo $fm0['conditionnement']; ?> KGS</td>
   
    <td scope="col"   id="colFlasque"><?php echo number_format($fm0['sum(av.sac_flasque)'], 0,',',' ');  ?></td>
    <td scope="col"   id="colFlasque"><?php echo number_format($fm0['sum(av.poids_flasque)'], 3,',',' '); ?></td>
      <td scope="col"   id="colFlasque"><?php echo number_format($sacsf_T, 0,',',' '); ?></td>
      <td scope="col"   id="colFlasque"><?php echo number_format($poidsf_T, 3,',',' '); ?></td>
            <td scope="col"   id="colMouille"><?php echo number_format($fm0['sum(av.sac_mouille)'], 0,',',' ');  ?></td>
    <td scope="col"   id="colMouille"><?php echo number_format($fm0['sum(av.poids_mouille)'], 3,',',' '); ?></td>
      <td scope="col"   id="colMouille"><?php echo number_format($sacsm_T, 0,',',' '); ?></td>
      <td scope="col"  id="colMouille"><?php echo number_format($poidsm_T, 3,',',' '); ?></td>

     <td scope="col"   id="colCumulGen"><?php echo number_format($sum_sac, 0,',',' '); ?></td>
      <td scope="col"  id="colCumulGen"><?php echo number_format($sum_poids, 3,',',' '); ?></td>
     <?php } ?>

     <?php if(empty($fm0['produit']) and empty($fm0['conditionnement']) and !empty($fm0['cales']) ) {?>
    <td scope="col" colspan="2" style="color: white; font-weight: bold; background: blue;">TOTAL <?php echo $fm0['cales']; ?>  </td>

    
    <td scope="col"   style="color: white; font-weight: bold; background: blue;"> <?php   echo number_format($fm0['sum(av.sac_flasque)'], 0,',',' ');?>
        </td>
    <td scope="col"   style="color: white; font-weight: bold; background: blue;"><?php echo number_format($fm0['sum(av.poids_flasque)'], 3,',',' '); ?></td>
    
      <td scope="col"   style="color: white; font-weight: bold; background: blue;"><?php echo number_format($sacsf_T, 0,',',' '); ?></td>
      <td scope="col"   style="color: white; font-weight: bold; background: blue;"><?php echo number_format($poidsf_T, 3,',',' '); ?></td>
      <td scope="col"   style="color: white; font-weight: bold; background: blue;"><?php echo number_format($fm0['sum(av.sac_mouille)'], 0,',',' '); ?></td>
      <td scope="col"   style="color: white; font-weight: bold; background: blue;"><?php echo number_format($fm0['sum(av.poids_mouille)'], 3,',',' '); ?></td>
            <td scope="col"   style="color: white; font-weight: bold; background: blue;"><?php echo number_format($sacsm_T, 0,',',' '); ?></td>
      <td scope="col"   style="color: white; font-weight: bold; background: blue;"><?php echo number_format($poidsm_T, 3,',',' '); ?></td>
      <td scope="col"   style="color: white; font-weight: bold; background: blue;"><?php echo number_format($sum_sac, 0,',',' '); ?></td>
      <td scope="col"   style="color: white; font-weight: bold; background: blue;"><?php echo number_format($sum_poids, 3,',',' '); ?></td>
     
    
     
     <?php } ?>


     <?php if(empty($fm0['produit']) and empty($fm0['conditionnement']) and empty($fm0['cales']) ) {?>
    <td scope="col" colspan="2"  style="color: white; font-weight: bold; background: black;">TOTAL </td>
    
    <td scope="col"   style="color: white; font-weight: bold; background: black;"> <?php  
        echo number_format($fm0['sum(av.sac_flasque)'], 0,',',' ');?>
        </td>
    <td scope="col"   style="color: white; font-weight: bold; background: black;"><?php echo number_format($fm0['sum(av.poids_flasque)'], 3,',',' '); ?></td>
    
      <td scope="col"   style="color: white; font-weight: bold; background: black;"><?php echo number_format($sacsf_T, 0,',',' '); ?></td>
      <td scope="col"   style="color: white; font-weight: bold; background: black;"><?php echo number_format($poidsf_T, 3,',',' '); ?></td>
      <td scope="col"   style="color: white; font-weight: bold; background: black;"><?php echo number_format($fm0['sum(av.sac_mouille)'], 0,',',' '); ?></td>
      <td scope="col"   style="color: white; font-weight: bold; background: black;"><?php echo number_format($fm0['sum(av.poids_mouille)'], 3,',',' '); ?></td>
            

       ?>
     <td scope="col"   style="color: white; font-weight: bold; background: black;"><?php echo number_format($sacsm_T, 0,',',' ') ?></td>
      <td scope="col"   style="color: white; font-weight: bold; background: black;"><?php echo number_format($poidsm_T, 3,',',' '); ?></td>
     <td scope="col"   style="color: white; font-weight: bold; background: black;"><?php echo number_format($sum_sac, 0,',',' ') ?></td>
      <td scope="col"   style="color: white; font-weight: bold; background: black;"><?php echo number_format($sum_poids, 3,',',' '); ?></td>
     <?php } ?>


 
      
    
   
     </tr>
     <?php }  ?>
    
 
      
     
</body>
 </table>
</div>
</div>
<br><br><br>

<?php if(!empty($trP['dates'])){
            $DateDebut=explode('-',$tr['dates']);
           if(!empty($tr2P['dates'])){
            $DateActuel=explode('-',$tr2P['dates']);?>

            <?php

 echo " <table class='table table-hover table-bordered table-striped' id='table' border='2' >";
    
?> 
<thead>
           <tr style="background: black; color: white; text-align: center; font-weight: bold; " >
           <td colspan="12" ><h4 style="color: white;"> SITUATION DU DEBARQUEMENT DES AVARIES <span style="color:yellow;">PAR PRODUIT</span> DU <span style="color: red; background: white;"><?php echo  $DateActuel[2]. '-' .$DateActuel[1].'-'.$DateActuel[0];?></span></h4></td></tr>
<?php 
         }  }
   ?>
 
  
 <tr  style="background-color: rgba(50, 159, 218, 0.9); text-align: center;"  >
      
      
    
       <td scope="col"  rowspan="3"  id="colLibeles">PRODUIT</td>
        <td scope="col"  rowspan="3" id="colLibeles">CALE</td>
      <td scope="col" colspan="4"  id="colFlasque">FLASQUES</td>
      <td scope="col" colspan="4"  id="colMouille">MOUILLES</td>
      <td scope="col" rowspan="2" colspan="2" id="colCumulGen"> CUMUL GENERAL</td>
     
  </tr>
    <tr style="background-color: rgba(50, 159, 218, 0.9); text-align: center;" >
      
      <td scope="col" colspan="2"  id="colFlasque">DEB 24H</td>
      <td scope="col" colspan="2" id="colFlasque">DEB TOTAL</td>
      <td scope="col" colspan="2"  id="colMouille">DEB 24H</td>
      <td scope="col" colspan="2" id="colMouille">DEB TOTAL</td>
      </tr>
      <tr style="background-color: rgba(50, 159, 218, 0.9); text-align: center;">
        <td scope="col"  id="colFlasque">NBRE SACS</td>
      <td scope="col"  id="colFlasque">POIDS</td>
        <td scope="col"  id="colFlasque">NBRE SACS</td>
      <td scope="col"  id="colFlasque">POIDS</td>
        <td scope="col"  id="colMouille">NBRE SACS</td>
      <td scope="col"  id="colMouille">POIDS</td>
       <td scope="col"  id="colMouille">NBRE SACS</td>
      <td scope="col"  id="colMouille">POIDS</td>
      
      
       <td scope="col" id="colCumulGen">NBRE SACS</td>
      <td scope="col"  id="colCumulGen">POIDS</td>
        
       </tr>
         </thead>
<body>

<?php 
        
       while($fm0=$fmAP->fetch()){

       $avar=$fmTAP->fetch();

        
       
      /* $sum_sac=$avariesT['sum(av.sac_flasque)'] $fm0['sum(av.sac_flasque)']-$avariesT['sum(av.sac_flasque)']-$avariesT['sum(av.sac_mouille)'];

       $poids=$calAC['nombre_sac']*$calAC['conditionnement']/1000;
       $sum_poids=$poids-$calAC['sum(av.poids_flasque)']-$avaries2['sum(av.poids_flasque)']-$avaries2['sum(av.poids_mouille)'];*/

       $sacsf_T=$avar['sum(av.sac_flasque)'];
        $sacsm_T=$avar['sum(av.sac_mouille)'];
       $poidsf_T=$avar['sum(av.poids_flasque)'];
        $poidsm_T=$avar['sum(av.poids_mouille)'];
         
         $sum_sac=$sacsf_T+$sacsm_T;
         $sum_poids=$poidsf_T+$poidsm_T;
        

        /*$total_sac=$prodT['sum(rm.sac)']+$avariesT['sum(sac_flasque)']+$avariesT['sum(sac_mouille)'];
        $total_poids=$prodT['sum(rm.poids)']+$avariesT['sum(poids_flasque)']+$avariesT['sum(poids_mouille)'];*/

        ?>

        <tr style="text-align: center;">
          <?php if(!empty($fm0['produit']) and !empty($fm0['conditionnement']) and !empty($fm0['cales']) and !empty($fm0['id_dec'])  ) {?>
            <td scope="col"  id="colLibeles"><?php echo $fm0['produit']; ?> <?php echo $fm0['conditionnement']; ?> KGS</td>
     <td scope="col"   id="colLibeles"><?php echo $fm0['cales']; ?></td>
    <td scope="col"  id="colFlasque"><?php echo number_format($fm0['sac_flasque'], 0,',',' ');  ?></td>
    <td scope="col"   id="colFlasque"><?php echo number_format($fm0['poids_flasque'], 3,',',' '); ?></td>
      <td scope="col"   id="colFlasque"><?php echo number_format($sacsf_T, 0,',',' '); ?></td>
      <td scope="col"   id="colFlasque"><?php echo number_format($poidsf_T, 3,',',' '); ?></td>
            <td scope="col"  id="colMouille"><?php echo number_format($fm0['sac_mouille'], 0,',',' ');  ?></td>
    <td scope="col"   id="colMouille"><?php echo number_format($fm0['poids_mouille'], 3,',',' '); ?></td>
      <td scope="col"  id="colMouille"><?php echo number_format($sacsm_T, 0,',',' '); ?></td>
      <td scope="col"   id="colMouille"><?php echo number_format($poidsm_T, 3,',',' '); ?></td>

     <td scope="col"   id="colCumulGen"><?php echo number_format($sum_sac, 0,',',' '); ?></td>
      <td scope="col"   id="colCumulGen"><?php echo number_format($sum_poids, 3,',',' '); ?></td>
     <?php } ?>

     <?php if(!empty($fm0['produit']) and !empty($fm0['conditionnement']) and empty($fm0['cales']) and empty($fm0['id_dec']) ) {?>
    <td scope="col" colspan="2" style="color: white; font-weight: bold; background: blue;">TOTAL <?php echo $fm0['produit']; ?> <?php echo $fm0['conditionnement']; ?> KGS </td>

    
    <td scope="col"   style="color: white; font-weight: bold; background: blue;"> <?php   echo number_format($fm0['sum(av.sac_flasque)'], 0,',',' ');?>
        </td>
    <td scope="col"   style="color: white; font-weight: bold; background: blue;"><?php echo number_format($fm0['sum(av.poids_flasque)'], 3,',',' '); ?></td>
    
      <td scope="col"   style="color: white; font-weight: bold; background: blue;"><?php echo number_format($fm0['sum(av.sac_flasque)'], 0,',',' '); ?></td>
      <td scope="col"   style="color: white; font-weight: bold; background: blue;"><?php echo number_format($fm0['sum(av.poids_flasque)'], 3,',',' '); ?></td>
      <td scope="col"   style="color: white; font-weight: bold; background: blue;"><?php echo number_format($fm0['sum(av.sac_mouille)'], 0,',',' '); ?></td>
      <td scope="col"   style="color: white; font-weight: bold; background: blue;"><?php echo number_format($fm0['sum(av.poids_mouille)'], 3,',',' '); ?></td>
            <td scope="col"   style="color: white; font-weight: bold; background: blue;"><?php echo number_format($sacsm_T, 0,',',' '); ?></td>
      <td scope="col"   style="color: white; font-weight: bold; background: blue;"><?php echo number_format($sacsf_T, 3,',',' '); ?></td>
      <td scope="col"   style="color: white; font-weight: bold; background: blue;"><?php echo number_format($sum_sac, 0,',',' '); ?></td>
      <td scope="col"   style="color: white; font-weight: bold; background: blue;"><?php echo number_format($sum_poids, 3,',',' '); ?></td>
     
    
     
     <?php } ?>


     <?php if(empty($fm0['produit']) and empty($fm0['conditionnement']) and empty($fm0['cales'])  and empty($fm0['id_dec']) ) {?>
    <td scope="col" colspan="2"  style="color: white; font-weight: bold; background: black;">TOTAL </td>
    
    <td scope="col"   style="color: white; font-weight: bold; background: black;"> <?php  
        echo number_format($fm0['sac_flasque'], 0,',',' ');?>
        </td>
    <td scope="col"   style="color: white; font-weight: bold; background: black;"><?php echo number_format($fm0['poids_flasque'], 3,',',' '); ?></td>
    
      <td scope="col"   style="color: white; font-weight: bold; background: black;"><?php echo number_format($sacsf_T, 0,',',' '); ?></td>
      <td scope="col"   style="color: white; font-weight: bold; background: black;"><?php echo number_format($poidsf_T, 3,',',' '); ?></td>
      <td scope="col"   style="color: white; font-weight: bold; background: black;"><?php echo number_format($fm0['sac_mouille'], 0,',',' '); ?></td>
      <td scope="col"   style="color: white; font-weight: bold; background: black;"><?php echo number_format($fm0['poids_mouille'], 3,',',' '); ?></td>
            

       ?>
     <td scope="col"   style="color: white; font-weight: bold; background: black;"><?php echo number_format($sacsm_T, 0,',',' ') ?></td>
      <td scope="col"   style="color: white; font-weight: bold; background: black;"><?php echo number_format($poidsm_T, 3,',',' '); ?></td>
     <td scope="col"   style="color: white; font-weight: bold; background: black;"><?php echo number_format($sum_sac, 0,',',' ') ?></td>
      <td scope="col"   style="color: white; font-weight: bold; background: black;"><?php echo number_format($sum_poids, 3,',',' '); ?></td>
     <?php } ?>


 
      
    
   
     </tr>
     <?php }  ?>
 


</body>
 </table>

</div>

<?php if(!empty($trP['dates'])){
            $DateDebut=explode('-',$tr['dates']);
           if(!empty($tr2P['dates'])){
            $DateActuel=explode('-',$tr2P['dates']);?>

            <?php

 echo " <table class='table table-hover table-bordered table-striped' id='table' border='2' >";
    
?> 
<thead>
           <tr style="background: black; color: white; text-align: center; font-weight: bold; " >
           <td colspan="16" ><h4 style="color: white;"> SITUATION DU TRANSFERT DES AVARIES <span style="color:yellow;">PAR PRODUIT</span> DU <span style="color: red; background: white;"><?php echo  $DateActuel[2]. '-' .$DateActuel[1].'-'.$DateActuel[0];?></span></h4></td></tr>
<?php 
         }  }
   ?>
 
  
 <tr  style="background-color: rgba(50, 159, 218, 0.9); text-align: center;"  >
      
      
    
       <td scope="col"  rowspan="3"  id="colLibeles">PRODUIT</td>
       
      <td scope="col" colspan="4" id="colFlasque">FLASQUES </td>
      <td scope="col" colspan="4"  id="colMouille">MOUILLES</td>
      <td scope="col" colspan="4" colspan="2" id="colCumulGen"> CUMUL GENERAL</td>
     
  </tr>
    <tr style="background-color: rgba(50, 159, 218, 0.9); text-align: center;" >
      
      <td scope="col" colspan="2"  id="colFlasque">TRANSFERT 24H</td>
      <td scope="col" colspan="2" id="colFlasque">TRANSFERT TOTAL</td>
     
      <td scope="col" colspan="2"  id="colMouille">TRANSFERT 24H</td>
      <td scope="col" colspan="2" id="colMouille">TRANSFERT TOTAL</td>
     
      <td scope="col" colspan="2" id="colCumulGen">CUMUL TRANSFERT 24H</td>
      <td scope="col" colspan="2" id="colCumulGen">CUMUL TRANSFERT TOTAL</td>
      </tr>
     
        

      <tr style="background-color: rgba(50, 159, 218, 0.9); text-align: center;">
        
        <td scope="col"  id="colFlasque">NBRE SACS</td>
      <td scope="col"  id="colFlasque">POIDS</td>
       <td scope="col"  id="colFlasque">NBRE SACS</td>
      <td scope="col"  id="colFlasque">POIDS</td>
      
      
       <td scope="col" id="colMouille">NBRE SACS</td>
      <td scope="col"  id="colMouille">POIDS</td>
      <td scope="col"  id="colMouille">NBRE SACS</td>
      <td scope="col"  id="colMouille">POIDS</td> <td scope="col"  id="colCumulGen">NBRE SACS</td>
      <td scope="col"  id="colCumulGen">POIDS</td> 
       <td scope="col" id="colCumulGen">NBRE SACS</td>
      <td scope="col"  id="colCumulGen">POIDS</td>
 
       </tr>
         </thead>
<tbody>


<?php 
        
       while($fm0=$fmTRAVAP->fetch()){

       $avar=$fmTTRAVAP->fetch();
       $cumul=$fmCUMULAP->fetch();

        
       
      /* $sum_sac=$avariesT['sum(av.sac_flasque)'] $fm0['sum(av.sac_flasque)']-$avariesT['sum(av.sac_flasque)']-$avariesT['sum(av.sac_mouille)'];

       $poids=$calAC['nombre_sac']*$calAC['conditionnement']/1000;
       $sum_poids=$poids-$calAC['sum(av.poids_flasque)']-$avaries2['sum(av.poids_flasque)']-$avaries2['sum(av.poids_mouille)'];

      $sacsf_T=$avar['sum(av.sac_flasque)'];
        $sacsm_T=$avar['sum(av.sac_mouille)'];
       $poidsf_T=$avar['sum(av.poids_flasque)'];
        $poidsm_T=$avar['sum(av.poids_mouille)'];
         
         $sum_sac=$sacsf_T+$sacsm_T;
         $sum_poids=$poidsf_T+$poidsm_T;  
        

        /*$total_sac=$prodT['sum(rm.sac)']+$avariesT['sum(sac_flasque)']+$avariesT['sum(sac_mouille)'];
        $total_poids=$prodT['sum(rm.poids)']+$avariesT['sum(poids_flasque)']+$avariesT['sum(poids_mouille)'];*/
        $rob_sac_flasque=$cumul['sum(av.sac_flasque)']-$avar['sum(trav.sac_flasque_tr_av)'];
        $rob_poids_flasque=$cumul['sum(av.poids_flasque)']-$avar['sum(trav.poids_flasque_tr_av)'];
        $rob_sac_mouille=$cumul['sum(av.sac_mouille)']-$avar['sum(trav.sac_mouille_tr_av)'];
        $rob_poids_mouille=$cumul['sum(av.poids_mouille)']-$avar['sum(trav.poids_mouille_tr_av)'];
        $total_rob_sac=$rob_sac_flasque+$rob_sac_mouille;
        $total_rob_poids=$rob_poids_flasque+$rob_poids_mouille;
        $cumul_sac_24H=$fm0['sum(trav.sac_flasque_tr_av)'] +$fm0['sum(trav.sac_mouille_tr_av)'];
         $cumul_poids_24H=$fm0['sum(trav.poids_flasque_tr_av)'] +$fm0['sum(trav.poids_mouille_tr_av)'];

    $cumul_sac_TOTAL=$avar['sum(trav.sac_flasque_tr_av)'] +$avar['sum(trav.sac_mouille_tr_av)'];
    $cumul_poids_TOTAL=$avar['sum(trav.poids_flasque_tr_av)'] +$avar['sum(trav.poids_mouille_tr_av)'];

        ?>

        <tr style="text-align: center;">
        
            <td scope="col"  id="colLibeles"><?php echo $fm0['produit']; ?> <?php echo $fm0['poids_sac_tr_av']; ?> KGS</td>


    <td scope="col"   id="colFlasque"><?php echo number_format($fm0['sum(trav.sac_flasque_tr_av)'], 0,',',' ');  ?></td>
    <td scope="col"   id="colFlasque"><?php echo number_format($fm0['sum(trav.poids_flasque_tr_av)'], 3,',',' '); ?></td>



      <td scope="col"   id="colFlasque"><?php echo number_format($avar['sum(trav.sac_flasque_tr_av)'], 0,',',' '); ?></td>
      <td scope="col"   id="colFlasque"><?php echo number_format($avar['sum(trav.poids_flasque_tr_av)'], 3,',',' '); ?></td>


<td scope="col"  id="colMouille"><?php echo number_format($fm0['sum(trav.sac_mouille_tr_av)'], 0,',',' ');  ?></td>
    <td scope="col"   id="colMouille"><?php echo number_format($fm0['sum(trav.poids_mouille_tr_av)'], 3,',',' '); ?></td>



      <td scope="col"  id="colMouille"><?php echo number_format($avar['sum(trav.sac_mouille_tr_av)'], 0,',',' ');  ?></td>
      <<td scope="col"  id="colMouille"><?php echo number_format($avar['sum(trav.poids_mouille_tr_av)'], 3,',',' '); ?></td>




            <td scope="col"   id="colCumulGen"><?php echo number_format($cumul_sac_24H, 0,',',' ');  ?></td>
    <td scope="col"   id="colCumulGen"><?php echo number_format($cumul_poids_24H, 3,',',' '); ?></td>



    


     <td scope="col"  id="colCumulGen"><?php echo number_format($cumul_sac_TOTAL, 0,',',' ');  ?></td>
     <td scope="col"  id="colCumulGen"><?php echo number_format($cumul_poids_TOTAL, 3,',',' '); ?></td>
     
    
   
     </tr>
     <?php }  ?>
 


</body>
 </table>

</div>


<?php if(!empty($trP['dates'])){
            $DateDebut=explode('-',$tr['dates']);
           if(!empty($tr2P['dates'])){
            $DateActuel=explode('-',$tr2P['dates']);?>

            <?php

 echo " <table class='table table-hover table-bordered table-striped' id='table' border='2' >";
    
?> 
<thead>
           <tr style="background: black; color: white; text-align: center; font-weight: bold; " >
           <td colspan="16" ><h4 style="color: white;"> SITUATION DU TRANSFERT DES AVARIES <span style="color:yellow;">PAR DESTINATION</span> DU <span style="color: red; background: white;"><?php echo  $DateActuel[2]. '-' .$DateActuel[1].'-'.$DateActuel[0];?></span></h4></td></tr>
<?php 
         }  }
   ?>
 
  
 <tr  style="background-color: rgba(50, 159, 218, 0.9); text-align: center;"  >
      
      
    
       <td scope="col"  rowspan="3"  id="colLibeles">DESTINATION</td>
        <td scope="col"  rowspan="3"  id="colLibeles">PRODUIT</td>
      <td scope="col" colspan="4"  id="colFlasque">FLASQUE</td>
      <td scope="col" colspan="4" id="colMouille">MOUILLE</td>
      <td scope="col" rowspan="2" colspan="2" id="colCumulGen"> CUMUL GENERAL</td>
     
  </tr>
    <tr style="background-color: rgba(50, 159, 218, 0.9); text-align: center;" >
      
      <td scope="col" colspan="2"  id="colFlasque">DEB 24H</td>
      <td scope="col" colspan="2" id="colFlasque">DEB TOTAL</td>
      <td scope="col" colspan="2"  id="colMouille">DEB 24H</td>
      <td scope="col" colspan="2" id="colMouille">DEB TOTAL</td>
      </tr>
      <tr style="background-color: rgba(50, 159, 218, 0.9); text-align: center;">
        <td scope="col"  id="colFlasque">NBRE SACS</td>
      <td scope="col"  id="colFlasque">POIDS</td>
        <td scope="col"  id="colFlasque">NBRE SACS</td>
      <td scope="col"  id="colFlasque">POIDS</td>
        <td scope="col"  id="colMouille">NBRE SACS</td>
      <td scope="col"  id="colMouille">POIDS</td>
       <td scope="col"  id="colMouille">NBRE SACS</td>
      <td scope="col"  id="colMouille">POIDS</td>
      
      
       <td scope="col"  id="colCumulGen">NBRE SACS</td>
      <td scope="col" id="colCumulGen">POIDS</td>
        
       </tr>
         </thead>
<tbody>
<?php 
while ($fm0=$fmTRAVAD->fetch()) { 
  $avar=$fmTTRAVAD->fetch();
  
  

  $cumul_sac=$avar['sum(trav.sac_flasque_tr_av)'] + $avar['sum(trav.sac_mouille_tr_av)'];
  $cumul_poids=$avar['sum(trav.poids_flasque_tr_av)'] + $avar['sum(trav.poids_mouille_tr_av)'];

  if (!empty($fm0['mangasin']) and !empty($fm0['produit']) and !empty($fm0['id_dis']) ){ ?>
       <tr style="text-align: center;">
        <td scope="col"   id="colLibeles"><?php echo $fm0['mangasin']  ?></td>
            <td scope="col"   id="colLibeles"><?php echo $fm0['produit']; ?> <?php echo $fm0['poids_sac_tr_av']; ?> KGS</td>
     
    <td scope="col"   id="colFlasque"><?php echo number_format($fm0['sum(trav.sac_flasque_tr_av)'], 0,',',' ');  ?></td>
    <td scope="col"  id="colFlasque"><?php echo number_format($fm0['sum(trav.poids_flasque_tr_av)'], 3,',',' '); ?></td>
      <td scope="col"  id="colFlasque"><?php echo number_format($avar['sum(trav.sac_flasque_tr_av)'], 0,',',' '); ?></td>
      <td scope="col"  id="colFlasque"><?php echo number_format($avar['sum(trav.poids_flasque_tr_av)'], 3,',',' '); ?></td>
            
    <td scope="col"   id="colMouille"><?php echo number_format($fm0['sum(trav.sac_mouille_tr_av)'], 0,',',' ');  ?></td>
    <td scope="col"  id="colMouille"><?php echo number_format($fm0['sum(trav.poids_mouille_tr_av)'], 3,',',' '); ?></td>
      <td scope="col"  id="colMouille"><?php echo number_format($avar['sum(trav.sac_mouille_tr_av)'], 0,',',' ');  ?></td>
      <<td scope="col"  id="colMouille"><?php echo number_format($avar['sum(trav.poids_mouille_tr_av)'], 3,',',' '); ?></td>
       <td scope="col"  id="colCumulGen"><?php echo number_format($cumul_sac, 0,',',' ');  ?></td>
      <<td scope="col"  id="colCumulGen"><?php echo number_format($cumul_poids, 3,',',' '); ?></td>

    
    
   
     </tr>
  
 <?php } 

 if (!empty($fm0['mangasin']) and empty($fm0['produit']) and empty($fm0['id_dis']) ){ ?>
       <tr style="text-align: center; background: blue;">
        <td scope="col" colspan="2"   style="color: black; font-weight: bold;"> TOTAL <?php echo $fm0['mangasin']  ?></td>
            
   <td scope="col"   style="color: white; font-weight: bold; background: blue;"> <?php $total=$bdd->prepare("select sum(sac_flasque_tr_av), sum(poids_flasque_tr_av),sum(sac_mouille_tr_av),sum(poids_mouille_tr_av) from transfert_avaries where id_navire=? and poids_sac_tr_av=? and date_tr_avaries=? and id_destination_tr=?");
       $total->bindParam(1,$a[0]);
       $total->bindParam(2,$fm0['poids_sac_tr_av']);
       $total->bindParam(3,$a[1]);
       $total->bindParam(4,$fm0['id_destination_tr']);
       $total->execute(); 
       while($t=$total->fetch()){ 
        echo number_format($t['sum(sac_flasque_tr_av)'], 0,',',' ');?>
        </td>
    <td scope="col"   style="color: white; font-weight: bold; background: blue;"><?php echo number_format($t['sum(poids_flasque_tr_av)'], 3,',',' '); ?></td>
      <td scope="col"   style="color: black; font-weight: bold;"><?php $total2=$bdd->prepare("select sum(sac_flasque_tr_av), sum(poids_flasque_tr_av),sum(sac_mouille_tr_av),sum(poids_mouille_tr_av) from transfert_avaries where id_navire=? and poids_sac_tr_av=? and date_tr_avaries<=? and id_destination_tr=?");
       $total2->bindParam(1,$a[0]);
       $total2->bindParam(2,$fm0['poids_sac_tr_av']);
       $total2->bindParam(3,$a[1]);
       $total2->bindParam(4,$fm0['id_destination_tr']);
       $total2->execute(); 
       while($t2=$total2->fetch()){ 
        echo number_format($t2['sum(sac_flasque_tr_av)'], 0,',',' ');?>
        </td>
    <td scope="col"   style="color: white; font-weight: bold; background: blue;"><?php echo number_format($t2['sum(poids_flasque_tr_av)'], 3,',',' '); ?></td>
      <td scope="col"   style="color: black; font-weight: bold;"><?php echo number_format($t['sum(sac_mouille_tr_av)'], 0,',',' '); ?></td>
         <td scope="col"   style="color: black; font-weight: bold;"><?php echo number_format($t['sum(poids_mouille_tr_av)'], 3,',',' '); ?></td>    
    <td scope="col"   style="color: black; font-weight: bold;"><?php echo number_format($t2['sum(sac_mouille_tr_av)'], 0,',',' ');  ?></td>
    <td scope="col"   style="color: black; font-weight: bold;"><?php echo number_format($t2['sum(poids_mouille_tr_av)'], 3,',',' '); ?></td>
      
       <td scope="col"   style="color: black; font-weight: bold;"><?php echo number_format($cumul_sac, 0,',',' ');  ?></td>
      <<td scope="col"   style="color: black; font-weight: bold;"><?php echo number_format($cumul_poids, 3,',',' '); ?></td>

    
    
   
     </tr>
  
 <?php } } }
 if (empty($fm0['mangasin']) and empty($fm0['produit']) and empty($fm0['id_dis']) ){ ?>
       <tr style="text-align: center; background: red;">
        <td scope="col" colspan="2"  style="color: black; font-weight: bold;"> TOTAL<?php echo $fm0['mangasin']  ?></td>
       <?php $total3_24=$bdd->prepare("select sum(sac_flasque_tr_av), sum(poids_flasque_tr_av),sum(sac_mouille_tr_av),sum(poids_mouille_tr_av) from transfert_avaries where id_navire=?  and date_tr_avaries=? ");  
          $total3_24->bindParam(1,$a[0]);
      
       $total3_24->bindParam(2,$a[1]);
          $total3_24->execute(); 
          while($t3_24=$total3_24->fetch()){ ?>     
     
    <td scope="col"   style="color: black; font-weight: bold;"><?php echo number_format($t3_24['sum(sac_flasque_tr_av)'], 0,',',' ');  ?></td>
    <td scope="col"   style="color: black; font-weight: bold;"><?php echo number_format($t3_24['sum(poids_flasque_tr_av)'], 3,',',' '); ?></td>
    <?php $total3_TOT=$bdd->prepare("select sum(sac_flasque_tr_av), sum(poids_flasque_tr_av),sum(sac_mouille_tr_av),sum(poids_mouille_tr_av) from transfert_avaries where id_navire=?  and date_tr_avaries<=? ");  
          $total3_TOT->bindParam(1,$a[0]);
       
       $total3_TOT->bindParam(2,$a[1]);
             $total3_TOT->execute(); 
             while($t3_TOT=$total3_TOT->fetch()) { ?>
      <td scope="col"   style="color: black; font-weight: bold;"><?php echo number_format($t3_TOT['sum(sac_flasque_tr_av)'], 0,',',' '); ?></td>
      <td scope="col"   style="color: black; font-weight: bold;"><?php echo number_format($t3_TOT['sum(poids_flasque_tr_av)'], 3,',',' '); ?></td>
            
    <td scope="col"   style="color: black; font-weight: bold;"><?php echo number_format($t3_24['sum(sac_mouille_tr_av)'], 0,',',' ');  ?></td>
    <td scope="col"   style="color: black; font-weight: bold;"><?php echo number_format($t3_24['sum(poids_mouille_tr_av)'], 3,',',' '); ?></td>
      <td scope="col"   style="color: black; font-weight: bold;"><?php echo number_format($t3_TOT['sum(sac_mouille_tr_av)'], 0,',',' ');  ?></td>
      <<td scope="col"   style="color: black; font-weight: bold;"><?php echo number_format($t3_TOT['sum(poids_mouille_tr_av)'], 3,',',' '); ?></td>
       <td scope="col"   style="color: black; font-weight: bold;"><?php echo number_format($cumul_sac, 0,',',' ');  ?></td>
      <<td scope="col"   style="color: black; font-weight: bold;"><?php echo number_format($cumul_poids, 3,',',' '); ?></td>

    
    
   
     </tr>
  <?php } } } ?> 
 <?php } ?>



</tbody>
</div>


<?php if(!empty($trP['dates'])){
            $DateDebut=explode('-',$tr['dates']);
           if(!empty($tr2P['dates'])){
            $DateActuel=explode('-',$tr2P['dates']);?>

            <?php

 echo " <table class='table table-hover table-bordered table-striped' id='table' border='2' >";
    
?> 
<thead>
           <tr style="background: black; color: white; text-align: center; font-weight: bold; " >
           <td colspan="16" ><h4 style="color: white;"> SITUATION  DES AVARIES RESTANT PAR PRODUIT <span style="color:yellow;"></span> DU <span style="color: red; background: white;"><?php echo  $DateActuel[2]. '-' .$DateActuel[1].'-'.$DateActuel[0];?></span></h4></td></tr>
<?php 
         }  }
   ?>
 
  
 <tr  style="background-color: rgba(50, 159, 218, 0.9); text-align: center;"  >
      
      
    
       <td scope="col"  rowspan="2"  id="colLibeles">PRODUIT</td>
       
      <td scope="col" colspan="2"  id="colFlasque">FLASQUES RESTANTS</td>
      <td scope="col" colspan="2"  id="colMouille">MOUILLES RESTANTES</td>
      <td scope="col"  colspan="2" id="colCumulGen"> CUMUL RESTANT</td>
     
  </tr>
    
     
        

      <tr style="background-color: rgba(50, 159, 218, 0.9); text-align: center;">
        <td scope="col"  id="colFlasque">NBRE SACS</td>
      <td scope="col" id="colFlasque">POIDS</td>
        <td scope="col" id="colMouille">NBRE SACS</td>
      <td scope="col"  id="colMouille">POIDS</td>
        <td scope="col" id="colCumulGen">NBRE SACS</td>
      <td scope="col" id="colCumulGen">POIDS</td>
     
      
      
     
      
       </tr>
         </thead>
<tbody>


<?php 
        
       while($avar=$fmTTRAVAPRES->fetch()){

       $cumul=$fmCUMULAPRES->fetch();

        
       
      /* $sum_sac=$avariesT['sum(av.sac_flasque)'] $fm0['sum(av.sac_flasque)']-$avariesT['sum(av.sac_flasque)']-$avariesT['sum(av.sac_mouille)'];

       $poids=$calAC['nombre_sac']*$calAC['conditionnement']/1000;
       $sum_poids=$poids-$calAC['sum(av.poids_flasque)']-$avaries2['sum(av.poids_flasque)']-$avaries2['sum(av.poids_mouille)'];

      $sacsf_T=$avar['sum(av.sac_flasque)'];
        $sacsm_T=$avar['sum(av.sac_mouille)'];
       $poidsf_T=$avar['sum(av.poids_flasque)'];
        $poidsm_T=$avar['sum(av.poids_mouille)'];
         
         $sum_sac=$sacsf_T+$sacsm_T;
         $sum_poids=$poidsf_T+$poidsm_T;  
        

        /*$total_sac=$prodT['sum(rm.sac)']+$avariesT['sum(sac_flasque)']+$avariesT['sum(sac_mouille)'];
        $total_poids=$prodT['sum(rm.poids)']+$avariesT['sum(poids_flasque)']+$avariesT['sum(poids_mouille)'];*/
        $rob_sac_flasque=$cumul['sum(av.sac_flasque)']-$avar['sum(trav.sac_flasque_tr_av)'];
        $rob_poids_flasque=$cumul['sum(av.poids_flasque)']-$avar['sum(trav.poids_flasque_tr_av)'];
        $rob_sac_mouille=$cumul['sum(av.sac_mouille)']-$avar['sum(trav.sac_mouille_tr_av)'];
        $rob_poids_mouille=$cumul['sum(av.poids_mouille)']-$avar['sum(trav.poids_mouille_tr_av)'];
        $total_rob_sac=$rob_sac_flasque+$rob_sac_mouille;
        $total_rob_poids=$rob_poids_flasque+$rob_poids_mouille;

        ?>

        <tr style="text-align: center;">
        
            <td scope="col"   id="colLibeles"><?php echo $avar['produit']; ?> <?php echo $avar['poids_sac_tr_av']; ?> KGS</td>
     
    <td scope="col"  id="colFlasque"><?php echo number_format($rob_sac_flasque, 0,',',' ');  ?> </td>
    <td scope="col"  id="colFlasque"><?php echo number_format($rob_poids_flasque, 3,',',' '); ?> </td>
      <td scope="col"  id="colMouille"><?php echo number_format($rob_sac_mouille, 0,',',' '); ?></td>
      <td scope="col"  id="colMouille"><?php echo number_format($rob_poids_mouille, 3,',',' '); ?></td>
            <td scope="col" id="colCumulGen"><?php echo number_format($total_rob_sac, 0,',',' ');  ?></td>
    <td scope="col" id="colCumulGen"><?php echo number_format($total_rob_poids, 3,',',' '); ?></td>
    
   
     </tr>
     <?php }  ?>
 


</body>
 </table>

</div>



<?php if(!empty($trP['dates'])){
            $DateDebut=explode('-',$tr['dates']);
           if(!empty($tr2P['dates'])){
            $DateActuel=explode('-',$tr2P['dates']);?>

            <?php

 echo " <table class='table table-hover table-bordered table-striped' id='table' border='2' >";
    
?> 
<thead>
           <tr style="background: black; color: white; text-align: center; font-weight: bold; " >
           <td colspan="16" ><h4 style="color: white;"> TRANSFERT <span style="color:yellow;"></span> DU <span style="color: red; background: white;"><?php echo  $DateActuel[2]. '-' .$DateActuel[1].'-'.$DateActuel[0];?></span></h4></td></tr>
<?php 
         }  }
   ?>
 
  
 <tr  style="background-color: rgba(50, 159, 218, 0.9); text-align: center;"  >
      
      
    
       <td scope="col" colspan="4"    style="color: white; font-weight: bold; vertical-align: middle;">TRANSFERT</td>
       <td scope="col"  colspan="4"    style="color: white; font-weight: bold; vertical-align: middle;">LIVRAISON</td>
        </tr>


       <tr  style="background-color: rgba(50, 159, 218, 0.9); text-align: center;"  >
      <td scope="col" colspan="2"  style="color: white; font-weight: bold;">TRANSFERT EN 24H</td>
      <td scope="col" colspan="2"  style="color: white; font-weight: bold;">TOTAL TRANSFERT</td>
       <td scope="col" colspan="2"  style="color: white; font-weight: bold;">LIVRAISON EN 24H</td>
      <td scope="col" colspan="2"  style="color: white; font-weight: bold;">TOTAL LIVRAISON</td>
    </tr>
     
 
    
     
        

      <tr style="background-color: rgba(50, 159, 218, 0.9); text-align: center;">
        <td scope="col"  style="color: white; font-weight: bold;">NBRE SACS</td>
      <td scope="col"  style="color: white; font-weight: bold;">POIDS</td>
        <td scope="col"  style="color: white; font-weight: bold;">NBRE SACS</td>
      <td scope="col"  style="color: white; font-weight: bold;">POIDS</td>
        <td scope="col"  style="color: white; font-weight: bold;">NBRE SACS</td>
      <td scope="col"  style="color: white; font-weight: bold;">POIDS</td>
         <td scope="col"  style="color: white; font-weight: bold;">NBRE SACS</td>
      <td scope="col"  style="color: white; font-weight: bold;">POIDS</td>
     
      
      
     
      
       </tr>
         </thead>
<tbody>


<?php 
        
       while($avar=$TRANSF->fetch()){

       

        
       
      
        $sac_transf=$avar['sum(rm.sac)']+$avar['sum(tr.sac_flasque_tr_av)'];
       

        ?>

        <tr style="text-align: center;">
        
            <td scope="col"   style="color: black; font-weight: bold;"> <?php echo $avar['poids_sac_tr_av']; ?> KGS</td>
     
    <td scope="col"   style="color: black; font-weight: bold;"><?php echo number_format($sac_transf, 0,',',' ');  ?> </td>
    <td scope="col"   style="color: black; font-weight: bold;"><?php echo number_format($sac_transf, 3,',',' '); ?> </td>
      <td scope="col"   style="color: black; font-weight: bold;"><?php echo number_format($sac_transf, 0,',',' '); ?></td>
      <td scope="col"   style="color: black; font-weight: bold;"><?php echo number_format($sac_transf, 3,',',' '); ?></td>
            <td scope="col"   style="color: black; font-weight: bold;"><?php echo number_format($sac_transf, 0,',',' ');  ?></td>
    <td scope="col"   style="color: black; font-weight: bold;"><?php echo number_format($sac_transf, 3,',',' '); ?></td>
    
   
     </tr>
     <?php }  ?>
 


</body>
 </table>

</div>







<?php } ?>






<?php // 2eme PARTIE SI LE TYPE NAVIRE EST EN VRAC ?>



<?php    
           if($filtre_type['type']=="VRAQUIER"){ ?>


          <?php if(!empty($tr['dates'])){
            $DateDebut=explode('-',$tr['dates']);
           if(!empty($tr2['dates'])){
            $DateActuel=explode('-',$tr2['dates']);?>

            <h3 style="background: blue; color: white; text-align: center; font-weight: bold;"><caption >SITUATION DU DEBARQUEMENT <span style="color:yellow;">PAR CALE</span> DU <span style="color: red; background: white;"><?php echo  $DateActuel[2]. '-' .$DateActuel[1].'-'.$DateActuel[0];?></span></h3>
<?php 
         }  }
   ?>
          <div class="table-responsive" border=1>
<?php


 echo " <table class='table table-hover table-bordered table-striped' id='table' border='2' >";
    
?> 
<thead>

  
 <tr class="EnteteTableSituation"   >
      <style type="text/css">
        .manif1{

        }
      </style>
      <td scope="col"  rowspan="2" id="colLibeles" >CALES</td>
      <td scope="col"  rowspan="2" id="colLibeles" >produit</td>
      <td scope="col" colspan="2" id="colManifeste" >MANIFESTE</td>
      <td scope="col" colspan="2" id="colDeb24H">DEB 24H</td>
      <td scope="col" colspan="2" id="colDebTOTAL"> TOTAL DEB</td>
      <td scope="col" colspan="2" id="colROB">ROB</td>
  </tr>
    <tr class="EnteteTableSituation"  >
      
      <td scope="col" id="colManifeste">NBRE SACS</td>
      <td scope="col"  id="colManifeste">POIDS</td>
        <td scope="col" id="colDeb24H" >NBRE SACS</td>
      <td scope="col" id="colDeb24H" >POIDS</td>
        <td scope="col" id="colDebTOTAL" >NBRE SACS</td>
      <td scope="col" id="colDebTOTAL" >POIDS</td>
        <td scope="col" id="colROB">NBRE SACS</td>
      <td scope="col" id="colROB" >POIDS</td>
        
     
     
 
         </tr>
         </thead> 
         
       <?php 
        
       while($cal2=$caleVRAC->fetch()){

       $calTOT=$caleTVRAC->fetch();
      // $avariesT=$fmT->fetch();
      // $avaries2=$fm->fetch();
/*
       $sac_sain_24H=$cal2['sum(rm.sac)'];
       $sac_flasque_24H=$avaries2['sum(av.sac_flasque)'];
       $sac_mouille_24H=$avaries2['sum(av.sac_mouille)'];

       $poids_sain_24H=$cal2['sum(rm.poids)'];
       $poids_flasque_24H=$avaries2['sum(av.poids_flasque)'];
       $poids_mouille_24H=$avaries2['sum(av.poids_mouille)'];

       $sac_total_deb*/
        
       
       $sum_sac=$cal2['nombre_sac']-$calTOT['sum(rm.sac)'];

       $poids=$cal2['pd'];
       $sum_poids=$poids-$calTOT['sum(rm.poids)'];

      // $sacs_24H=$cal2['sum(rm.sac)']+$avaries2['sum(sac_flasque)']+$avaries2['sum(sac_mouille)'];
        $sacs_24H=$cal2['sum(rm.sac)'];
       // $poids_24H=$cal2['sum(rm.poids)']+$avaries2['sum(poids_flasque)']+$avaries2['poids_mouille'];
        $poids_24H=$cal2['sum(rm.poids)'];
        $total_sac=$calTOT['sum(rm.sac)'];
        $total_poids=$calTOT['sum(rm.poids)'];

        ?>

        
          <?php if(!empty($cal2['produit']) and !empty($cal2['id_dec']) and !empty($cal2['cales'])) {?>
            <tr class="CelluleTableSituation" >
    <td scope="col"  id="colLibeles" ><?php echo $cal2['cale']; ?></td>
    <td scope="col"  id="colLibeles" ><?php echo $cal2['produit']; ?></td>
    <td scope="col" id="colManifeste"  ><?php echo number_format($cal2['nombre_sac'], 0,',',' ');  ?></td>
    </td>
     <td scope="col" id="colManifeste"  ><?php echo number_format($poids, 3,',',' ');  ?></td>
    </td>
      <td scope="col" id="colDeb24H"><?php echo number_format($sacs_24H, 0,',',' '); ?></td>
      <td scope="col" id="colDeb24H" ><?php echo number_format($poids_24H, 3,',',' '); ?></td>
      <td scope="col" id="colDebTOTAL"><?php echo number_format($total_sac, 0,',',' '); ?></td>
      <td scope="col" id="colDebTOTAL"><?php echo number_format($total_poids, 3,',',' '); ?></td>
     <td scope="col" id="colROB"><?php echo number_format($sum_sac, 0,',',' '); ?></td>
      <td scope="col" id="colROB"  ><?php echo number_format($sum_poids, 3,',',' '); ?></td>
     </tr>
     <?php } ?>

     <?php if(empty($cal2['produit']) and empty($cal2['id_dec']) and !empty($cal2['cales'])) {?>
      <tr class="CelluleTotal1" style="color: white;" >
    <td id="sousTOTAL" colspan="2" >TOTAL <?php echo $cal2['cale']; ?></td>
    
    <td scope="col" id="sousTOTAL"> <?php $total=$bdd->prepare("select sum(nombre_sac), sum(poids) from declaration_chargement where id_navire=? and cales=?");
       $total->bindParam(1,$a[0]);
       $total->bindParam(2,$cal2['cales']);
       $total->execute(); 
       while($t=$total->fetch()){ 
        echo number_format($t['sum(nombre_sac)'], 0,',',' ');?>
        </td>
    <td  scope="col" id="sousTOTAL" ><?php echo number_format($t['sum(poids)'], 3,',',' '); ?></td>
    
      <td id="sousTOTAL" scope="col"  ><?php echo number_format($sacs_24H, 0,',',' '); ?></td>
      <td id="sousTOTAL" scope="col"  ><?php echo number_format($poids_24H, 3,',',' '); ?></td>
      <td id="sousTOTAL" scope="col"  ><?php echo number_format($total_sac, 0,',',' '); ?></td>
      <td id="sousTOTAL" scope="col"  ><?php echo number_format($total_poids, 3,',',' '); ?></td>
      <?php $rob_sac=$t['sum(nombre_sac)']-$total_sac;
            $rob_poids=$t['sum(poids)']-$total_poids;

       ?>
     <td id="sousTOTAL" scope="col" ><?php echo number_format($rob_sac, 0,',',' '); ?></td>
      <td id="sousTOTAL" scope="col" ><?php echo number_format($rob_poids, 3,',',' '); ?></td>

      <?php } ?>
      </tr>
     <?php } ?>



     <?php if(empty($cal2['produit']) and empty($cal2['id_dec']) and empty($cal2['cales'])) {?>
      <tr class="CelluleTotal2" >

    <td id="TOTAL" scope="col" colspan="2"  >TOTAL </td>
    
    <td id="TOTAL" scope="col"   > <?php $total2=$bdd->prepare("select sum(nombre_sac), sum(poids) from declaration_chargement where id_navire=?  ");
       $total2->bindParam(1,$a[0]);
       
       $total2->execute(); 
       while($t=$total2->fetch()){ 
        echo number_format($t['sum(nombre_sac)'], 0,',',' ');?>
        </td>
    <td id="TOTAL" scope="col"   ><?php echo number_format($t['sum(poids)'], 3,',',' '); ?></td>
    
      <td id="TOTAL" scope="col"   ><?php echo number_format($sacs_24H, 0,',',' '); ?></td>
      <td id="TOTAL" scope="col"   ><?php echo number_format($poids_24H, 3,',',' '); ?></td>
      <td id="TOTAL" scope="col"   ><?php echo number_format($total_sac, 0,',',' '); ?></td>
      <td id="TOTAL" scope="col"  ><?php echo number_format($total_poids, 3,',',' '); ?></td>
            <?php $rob_sac2=$t['sum(nombre_sac)']-$total_sac;
            $rob_poids2=$t['sum(poids)']-$total_poids;

       ?>
     <td id="TOTAL" scope="col" ><?php echo number_format($rob_sac2, 0,',',' ') ?></td>
      <td style="color: white;" scope="col"><?php echo number_format($rob_poids2, 3,',',' '); ?></td>
     <?php } ?>
   </tr>

     <?php } ?>


     <?php }  ?>
    
 
      
     

 </table>
</div>
</div>
<br><br><br><br><br>

<?php if(!empty($trP['dates'])){
            $DateDebut=explode('-',$tr['dates']);
           if(!empty($tr2P['dates'])){
            $DateActuel=explode('-',$tr2P['dates']);?>

            <h3 style="background: blue; color: white; text-align: center; font-weight: bold;"><caption >SITUATION DU DEBARQUEMENT <span style="color:yellow;">PAR PRODUIT</span> DU <span style="color:red; background: white;"><?php echo $DateDebut[2]. ' au '.$DateActuel[2]. '-'.$DateActuel[1].'-'.$DateActuel[0];?></span></caption></h3>
<?php 
         }  }
   ?>

  <div class="table-responsive" border=1>
<?php


 echo " <table class='table table-hover table-bordered table-striped' id='table' border='2' >";
    
?> 
<thead>

  
 <tr  style="background-color: rgba(50, 159, 218, 0.9); text-align: center;"  >
      
      
      <td scope="col"  rowspan="2"  id="colLibeles">produit</td>
       <td scope="col"  rowspan="2" id="colLibeles">cales</td>
      <td scope="col" colspan="2"  id="colManifeste">MANIFESTE</td>
      <td scope="col" colspan="2" id="colDeb24H">DEB 24H</td>
      <td scope="col" colspan="2" id="colDebTOTAL"> TOTAL DEB</td>
      <td scope="col" colspan="2" id="colROB">ROB</td>
  </tr>
    <tr style="background-color: rgba(50, 159, 218, 0.9); text-align: center;" >
      
      <td scope="col" id="colManifeste" >NBRE SACS</td>
      <td scope="col" id="colManifeste" >POIDS</td>
        <td scope="col" id="colDeb24H" >NBRE SACS</td>
      <td scope="col"  id="colDeb24H">POIDS</td>
        <td scope="col"  id="colDebTOTAL">NBRE SACS</td>
      <td scope="col"  id="colDebTOTAL">POIDS</td>
        <td scope="col" id="colROB" >NBRE SACS</td>
      <td scope="col" id="colROB">POIDS</td>
        
     
     
 
         </tr>
         </thead> 

<?php 
        
       while($prod=$produitVRAC->fetch()){

       $prodT=$produitTVRAC->fetch();
      // $avariesT=$fmpT->fetch();
      // $avaries2=$fmp->fetch();
        
       
       $sum_sac=$prod['nombre_sac'] -$prodT['sum(rm.sac)'];

       $poids=$prod['pd'];
       $sum_poids=$poids-$prodT['sum(rm.poids)'];

       $sacs_24H=$prod['sum(rm.sac)'];

        $poids_24H=$prod['sum(rm.poids)'];

        $total_sac=$prodT['sum(rm.sac)'];
        $total_poids=$prodT['sum(rm.poids)'];

        ?>

        <tr style="text-align: center;">
          <?php if(!empty($prod['produit']) and !empty($prod['qualite']) and !empty($prod['cales']) and !empty($prod['id_dec'])) {?>
    
    <td scope="col"   id="colLibeles"><?php echo $prod['produit']; ?> </td>
    <td scope="col"   id="colLibeles"><?php echo $prod['cales']; ?></td>
    <td scope="col"   id="colManifeste"><?php echo number_format($prod['nombre_sac'], 0,',',' ');  ?></td>
    <td scope="col"   id="colManifeste"><?php echo number_format($poids, 3,',',' '); ?></td>
      <td scope="col"   id="colDeb24H"><?php echo number_format($sacs_24H, 0,',',' '); ?></td>
      <td scope="col"   id="colDeb24H"><?php echo number_format($poids_24H, 3,',',' '); ?></td>
      <td scope="col"  id="colDebTOTAL"><?php echo number_format($total_sac, 0,',',' '); ?></td>
      <td scope="col"  id="colDebTOTAL"><?php echo number_format($total_poids, 3,',',' '); ?></td>
     <td scope="col"  id="colROB"><?php echo number_format($sum_sac, 0,',',' '); ?></td>
      <td scope="col"   id="colROB"><?php echo number_format($sum_poids, 3,',',' '); ?></td>
     <?php } ?>

     <?php if(!empty($prod['produit']) and !empty($prod['qualite']) and empty($prod['cales']) and empty($prod['id_dec'])) {?>
    <td scope="col" colspan="2" id="sousTOTAL">TOTAL  </td>

    
    <td scope="col"   id="sousTOTAL"> <?php $total=$bdd->prepare("select sum(nombre_sac), sum(poids) from declaration_chargement where id_navire=? and conditionnement=? and id_produit=?");
       $total->bindParam(1,$a[0]);
       $total->bindParam(2,$prod['conditionnement']);
       $total->bindParam(3,$prod['id_produit']);
       $total->execute(); 
       while($t=$total->fetch()){ 
        echo number_format($t['sum(nombre_sac)'], 0,',',' ');?>
        </td>
    <td scope="col"   id="sousTOTAL"><?php echo number_format($t['sum(poids)'], 3,',',' '); ?></td>
    
      <td scope="col"   id="sousTOTAL"><?php echo number_format($sacs_24H, 0,',',' '); ?></td>
      <td scope="col"   id="sousTOTAL"><?php echo number_format($poids_24H, 3,',',' '); ?></td>
      <td scope="col"   id="sousTOTAL"><?php echo number_format($total_sac, 0,',',' '); ?></td>
      <td scope="col"  id="sousTOTAL"><?php echo number_format($total_poids, 3,',',' '); ?></td>
      <?php $rob_sac=$t['sum(nombre_sac)']-$total_sac;
            $rob_poids=$t['sum(poids)']-$total_poids;

       ?>
     <td scope="col"  id="sousTOTAL"><?php echo number_format($rob_sac, 0,',',' '); ?></td>
      <td scope="col"   id="sousTOTAL"><?php echo number_format($rob_poids, 3,',',' '); ?></td>
      <?php } ?>
     <?php } ?>


     <?php if(empty($prod['produit']) and empty($prod['qualite']) and empty($prod['cales']) and empty($prod['id_dec'])) {?>
    <td scope="col" colspan="2"  id="TOTAL">TOTAL </td>
    
    <td scope="col"  id="TOTAL"> <?php $total2=$bdd->prepare("select sum(nombre_sac), sum(poids) from declaration_chargement where id_navire=?  ");
       $total2->bindParam(1,$a[0]);
       
       $total2->execute(); 
       while($t=$total2->fetch()){ 
        echo number_format($t['sum(nombre_sac)'], 0,',',' ');?>
        </td>
    <td scope="col"  id="TOTAL"><?php echo number_format($t['sum(poids)'], 3,',',' '); ?></td>
    
      <td scope="col"  id="TOTAL"><?php echo number_format($sacs_24H, 0,',',' '); ?></td>
      <td scope="col"   id="TOTAL"><?php echo number_format($poids_24H, 3,',',' '); ?></td>
      <td scope="col"   id="TOTAL"><?php echo number_format($total_sac, 0,',',' '); ?></td>
      <td scope="col"   id="TOTAL"><?php echo number_format($total_poids, 3,',',' '); ?></td>
            <?php $rob_sac2=$t['sum(nombre_sac)']-$total_sac;
            $rob_poids2=$t['sum(poids)']-$total_poids;

       ?>
     <td scope="col" id="TOTAL"><?php echo number_format($rob_sac2, 0,',',' ') ?></td>
      <td scope="col" id="TOTAL"><?php echo number_format($rob_poids2, 3,',',' '); ?></td>
     <?php } ?>
     <?php } ?>


 
      
    
   
     </tr>
     <?php }  ?>
    
 
      
     

 </table>
</div>
</div>
<br><br><br>







<?php if(!empty($trSD['dates'])){
            $DateDebut=explode('-',$tr['dates']);
           if(!empty($trSD['dates'])){
            $DateActuel=explode('-',$trSD['dates']);?>

            <h3 style="background: blue; color: white; text-align: center; font-weight: bold;"><caption >SITUATION DU DEBARQUEMENT  <span style="color:yellow;">PAR DESTINATION</span> DU <span style="color:red; background: white;"><?php echo $DateDebut[2]. ' au '.$DateActuel[2]. '-'.$DateActuel[1].'-'.$DateActuel[0];?></span></caption></h3>
<?php 
         }  }
   ?>

   <div class="table-responsive" border=1>
<?php


 echo " <table class='table table-hover table-bordered table-striped' id='table' border='2' >";
    
?> 
<thead>

  
 <tr  style="background-color: rgba(50, 159, 218, 0.9); text-align: center;"  >
      
      
    
       <td scope="col"  rowspan="3" id="colLibeles">DESTINATION</td>
        <td scope="col"  rowspan="3"  id="colLibeles">produit</td>
        <td scope="col"  rowspan="3"  id="colLibeles">CLIENT</td>
       
      
     
  </tr>
    <tr >
      
      <td scope="col" colspan="2"  id="colManifeste">MANIFESTE</td>
      <td scope="col" colspan="2" id="colDeb24H">DEB 24H</td>
     
      <td scope="col" colspan="2"  id="colDebTOTAL">TOTAL DEB</td>
      <td scope="col" colspan="2" id="colROB">ROB</td>
     
      </tr>
     
        

      <tr style="background-color: rgba(50, 159, 218, 0.9); text-align: center;">
        <td scope="col"  id="colManifeste">NBRE SACS</td>
      <td scope="col"  id="colManifeste">POIDS</td>
        <td scope="col"  id="colDeb24H">NBRE SACS</td>
      <td scope="col"  id="colDeb24H">POIDS</td>
        <td scope="col" id="colDebTOTAL">NBRE SACS</td>
      <td scope="col"  id="colDebTOTAL">POIDS</td>
       <td scope="col"  id="colROB">NBRE SACS</td>
      <td scope="col"  id="colROB">POIDS</td>
     
      
      
    
       </tr>
         </thead>
<tbody>

  <?php 
while ($fm0=$STDVRAC->fetch()) { 
  $avar=$TSTDVRAC->fetch();
  
  

  $cumul_sac=$avar['sum(rm.sac)'];
  $cumul_poids=$avar['sum(rm.poids)'];
  $rob_sac=0;
  $rob_poids=$fm0['poids_t']-$cumul_poids;

  if (!empty($fm0['mangasin']) and !empty($fm0['produit']) and !empty($fm0['id_dis']) ){ ?>
       <tr style="text-align: center;">
        <td scope="col"   id="colLibeles"><?php echo $fm0['mangasin']  ?></td>
            <td scope="col"   id="colLibeles"><?php echo $fm0['produit']; ?> <?php echo $fm0['poids_sac']; ?> KGS</td>
              <td scope="col" id="colLibeles"><?php echo $fm0['client']; ?> </td>
     <td scope="col"   id="colManifeste"><?php echo number_format($fm0['nombre_sac'], 0,',',' ');  ?></td>
       <td scope="col" id="colManifeste"><?php echo number_format($fm0['poids_t'], 3,',',' '); ?></td>
    <td scope="col"   id="colDeb24H"><?php echo number_format($fm0['sum(rm.sac)'], 0,',',' ');  ?></td>
    <td scope="col"   id="colDeb24H"><?php echo number_format($fm0['sum(rm.poids)'], 3,',',' '); ?></td>
      <td scope="col"   id="colDebTOTAL"><?php echo number_format($cumul_sac, 0,',',' '); ?></td>
      <td scope="col"   id="colDebTOTAL"><?php echo number_format($cumul_poids, 3,',',' '); ?></td>
       <td scope="col"   id="colROB"><?php echo number_format($rob_sac, 0,',',' '); ?></td>
      <td scope="col" id="colROB"><?php echo number_format($rob_poids, 3,',',' '); ?></td>
            
   
       

    
    
   
     </tr>
  
 <?php } 

 if (!empty($fm0['mangasin']) and empty($fm0['produit']) and empty($fm0['id_dis']) ){ ?>
       <tr style="text-align: center; background: blue;">
        <td scope="col" colspan="3" id="sousTOTAL"> TOTAL <?php echo $fm0['mangasin']  ?></td>
            
   <td scope="col"  id="sousTOTAL"> <?php $total=$bdd->prepare("select sum(sac), sum(poids)  from register_manifeste
    where id_navire=?  and dates=? and id_destination=? ");
       $total->bindParam(1,$a[0]);
       
       $total->bindParam(2,$a[1]);
       $total->bindParam(3,$fm0['id_destination']);
      
       
       $total->execute(); 
        $totaldis=$bdd->prepare("select  sum(poids_t)  from dispatching 
    where id_navire=?   and id_mangasin=?   ");
       $totaldis->bindParam(1,$a[0]);
    
        $totaldis->bindParam(2,$fm0['id_destination']);
        $totaldis->execute();

       while($td=$totaldis->fetch()){
       while($t=$total->fetch()){ 
        echo number_format(0, 0,',',' ');?>
        </td>
    <td scope="col"   id="sousTOTAL"><?php echo number_format($td['sum(poids_t)'], 3,',',' '); ?></td>
      <td scope="col"   id="sousTOTAL"><?php $total2=$bdd->prepare("select sum(sac), sum(poids) from register_manifeste
    where id_navire=?  and dates<=? and id_destination=? ");
       $total2->bindParam(1,$a[0]);
       
       $total2->bindParam(2,$a[1]);
       $total2->bindParam(3,$fm0['id_destination']);
       $total2->execute();

       
       while($t2=$total2->fetch()){ 
        echo number_format($t['sum(sac)'], 0,',',' ');?>
        </td>
    <td scope="col"   id="sousTOTAL"><?php echo number_format($t['sum(poids)'], 3,',',' '); ?></td>
      <td scope="col"  id="sousTOTAL"><?php echo number_format($t2['sum(sac)'], 0,',',' '); ?></td>
         <td scope="col"   id="sousTOTAL"><?php echo number_format($t2['sum(poids)'], 3,',',' '); ?></td>    
    <?php $cumul_poids=$td['sum(poids_t)']-$t2['sum(poids)']; ?>
      
       <td scope="col"   id="sousTOTAL"><?php echo number_format(0, 0,',',' ');  ?></td>
      <<td scope="col"   id="sousTOTAL"><?php echo number_format($cumul_poids, 3,',',' '); ?></td>

    
    
   
     </tr>
  
 <?php } } } }
 if (empty($fm0['mangasin']) and empty($fm0['produit']) and empty($fm0['id_dis']) ){ ?>
       <tr >
        <td scope="col" colspan="3" id="TOTAL"> TOTAL<?php echo $fm0['mangasin']  ?></td>
       <?php $total3_24=$bdd->prepare("select sum(sac), sum(poids)  from register_manifeste
    where id_navire=?  and dates=?  ");
       $total3_24->bindParam(1,$a[0]);
       
       $total3_24->bindParam(2,$a[1]);
      
       $total3_24->execute(); 
               $totaldis=$bdd->prepare("select sum(nombre_sac),  sum(poids_t)  from dispatching 
    where id_navire=?    ");
       $totaldis->bindParam(1,$a[0]);
    
        
        $totaldis->execute();

       while($td=$totaldis->fetch()){
          while($t3_24=$total3_24->fetch()){ ?>     
     
    <td scope="col"   id="TOTAL"><?php echo number_format(0, 0,',',' ');  ?></td>
    <td scope="col"   id="TOTAL"><?php echo number_format($td['sum(poids_t)'], 3,',',' '); ?></td>
    <?php $total3_TOT=$bdd->prepare("select sum(sac), sum(poids)  from register_manifeste
    where id_navire=?  and dates<=?  ");
       $total3_TOT->bindParam(1,$a[0]);
       
       $total3_TOT->bindParam(2,$a[1]);
       
       $total3_TOT->execute(); 
             while($t3_TOT=$total3_TOT->fetch()) { ?>
      <td scope="col"   id="TOTAL"><?php echo number_format($t3_24['sum(sac)'], 0,',',' '); ?></td>
      <td scope="col"   id="TOTAL"><?php echo number_format($t3_24['sum(poids)'], 3,',',' '); ?></td>
       <td scope="col"   id="TOTAL"><?php echo number_format($t3_TOT['sum(sac)'], 0,',',' '); ?></td>
      <td scope="col"  id="TOTAL"><?php echo number_format($t3_TOT['sum(poids)'], 3,',',' '); ?></td>
            
    <?php $cumul_poids=$td['sum(poids_t)']-$t3_TOT['sum(poids)']; ?>
       <td scope="col"   id="TOTAL"><?php echo number_format(0, 0,',',' ');  ?></td>
      <<td scope="col"   id="TOTAL"><?php echo number_format($cumul_poids, 3,',',' '); ?></td>

    
    
   
     </tr>
  <?php } } } } ?> 
 <?php } ?>


<?php //// SITIUATION PAR CLIENT ?>


<?php if(!empty($trSD['dates'])){
            $DateDebut=explode('-',$tr['dates']);
           if(!empty($trSD['dates'])){
            $DateActuel=explode('-',$trSD['dates']);?>

            <h3 style="background: blue; color: white; text-align: center; font-weight: bold;"><caption >SITUATION DU DEBARQUEMENT  <span style="color:yellow;">PAR CLIENT</span> DU <span style="color:red; background: white;"><?php echo $DateDebut[2]. ' au '.$DateActuel[2]. '-'.$DateActuel[1].'-'.$DateActuel[0];?></span></caption></h3>
<?php 
         }  }
   ?>

   <div class="table-responsive" border=1>
<?php


 echo " <table class='table table-hover table-bordered table-striped' id='table' border='2' >";
    
?> 
<thead>

  
 <tr  style="background-color: rgba(50, 159, 218, 0.9); text-align: center;"  >
      
      
    
       <td scope="col"  rowspan="3" id="colLibeles">CLIENT</td>
        <td scope="col"  rowspan="3" id="colLibeles">produit</td>
        <td scope="col"  rowspan="3" id="colLibeles">DESTINATION</td>
       
      
     
  </tr>
    <tr  >
      
      <td scope="col" colspan="2"  id="colManifeste">MANIFESTE</td>
      <td scope="col" colspan="2" id="colDeb24H">DEB 24H</td>
     
      <td scope="col" colspan="2" id="colDebTOTAL">TOTAL DEB</td>
      <td scope="col" colspan="2" id="colROB">ROB</td>
     
      </tr>
     
        

      <tr >
        <td scope="col"  id="colManifeste">NBRE SACS</td>
      <td scope="col"  id="colManifeste">POIDS</td>
        <td scope="col"  id="colDeb24H">NBRE SACS</td>
      <td scope="col" id="colDeb24H">POIDS</td>
        <td scope="col"  id="colDebTOTAL">NBRE SACS</td>
      <td scope="col"  id="colDebTOTAL">POIDS</td>
       <td scope="col"  id="colROB">NBRE SACS</td>
      <td scope="col"  id="colROB">POIDS</td>
     
      
      
    
       </tr>
         </thead>
<tbody>

  <?php 
while ($fm0=$STCLIVRAC->fetch()) { 
  $avar=$TSTCLIVRAC->fetch();
  
  

  $cumul_sac=$avar['sum(rm.sac)'];
  $cumul_poids=$avar['sum(rm.poids)'];
  $rob_sac=0;
  $rob_poids=$fm0['poids_t']-$cumul_poids;

  if (!empty($fm0['client']) and !empty($fm0['produit']) and !empty($fm0['id_dis']) ){ ?>
       <tr style="text-align: center;">
        <td scope="col"   id="colLibeles"><?php echo $fm0['client']  ?></td>
            <td scope="col"  id="colLibeles"><?php echo $fm0['produit']; ?> <?php echo $fm0['poids_sac']; ?> KGS</td>
              <td scope="col"   id="colLibeles"><?php echo $fm0['mangasin']; ?> </td>
     <td scope="col" id="colManifeste"><?php echo number_format($fm0['nombre_sac'], 0,',',' ');  ?></td>
       <td scope="col" id="colManifeste"><?php echo number_format($fm0['poids_t'], 3,',',' '); ?></td>
    <td scope="col"   id="colDeb24H"><?php echo number_format($fm0['sum(rm.sac)'], 0,',',' ');  ?></td>
    <td scope="col"   id="colDeb24H"><?php echo number_format($fm0['sum(rm.poids)'], 3,',',' '); ?></td>
      <td scope="col"   id="colDebTOTAL"><?php echo number_format($cumul_sac, 0,',',' '); ?></td>
      <td scope="col"   id="colDebTOTAL"><?php echo number_format($cumul_poids, 3,',',' '); ?></td>
       <td scope="col"   id="colROB"><?php echo number_format($rob_sac, 0,',',' '); ?></td>
      <td scope="col"   id="colROB"><?php echo number_format($rob_poids, 3,',',' '); ?></td>
            
   
       

    
    
   
     </tr>
  
 <?php } 

 if (!empty($fm0['client']) and empty($fm0['produit']) and empty($fm0['id_dis']) ){ ?>
       <tr >
        <td scope="col" colspan="3" id="sousTOTAL"> TOTAL <?php echo $fm0['client']  ?></td>
            
   <td scope="col" id="sousTOTAL"> <?php $total=$bdd->prepare("select sum(sac), sum(poids)  from register_manifeste
    where id_navire=?  and dates=? and id_client=? ");
       $total->bindParam(1,$a[0]);
       
       $total->bindParam(2,$a[1]);
       $total->bindParam(3,$fm0['id_client']);
      
       
       $total->execute(); 
        $totaldis=$bdd->prepare("select  sum(poids_t)  from dispatching 
    where id_navire=?   and id_client=?   ");
       $totaldis->bindParam(1,$a[0]);
    
        $totaldis->bindParam(2,$fm0['id_client']);
        $totaldis->execute();

       while($td=$totaldis->fetch()){
       while($t=$total->fetch()){ 
        echo number_format(0, 0,',',' ');?>
        </td>
    <td scope="col"  id="sousTOTAL"><?php echo number_format($td['sum(poids_t)'], 3,',',' '); ?></td>
      <td scope="col"  id="sousTOTAL"><?php $total2=$bdd->prepare("select sum(sac), sum(poids) from register_manifeste
    where id_navire=?  and dates<=? and id_client=? ");
       $total2->bindParam(1,$a[0]);
       
       $total2->bindParam(2,$a[1]);
       $total2->bindParam(3,$fm0['id_client']);
       $total2->execute();

       
       while($t2=$total2->fetch()){ 
        echo number_format($t['sum(sac)'], 0,',',' ');?>
        </td>
    <td scope="col"  id="sousTOTAL"><?php echo number_format($t['sum(poids)'], 3,',',' '); ?></td>
      <td scope="col"   id="sousTOTAL"><?php echo number_format($t2['sum(sac)'], 0,',',' '); ?></td>
         <td scope="col"  id="sousTOTAL"><?php echo number_format($t2['sum(poids)'], 3,',',' '); ?></td>    
    <?php $cumul_poids=$td['sum(poids_t)']-$t2['sum(poids)']; ?>
      
       <td scope="col"  id="sousTOTAL"><?php echo number_format($cumul_sac, 0,',',' ');  ?></td>
      <<td scope="col"  id="sousTOTAL"><?php echo number_format($cumul_poids, 3,',',' '); ?></td>

    
    
   
     </tr>
  
 <?php } } } }
 if (empty($fm0['client']) and empty($fm0['produit']) and empty($fm0['id_dis']) ){ ?>
       <tr >
        <td scope="col" colspan="3"  id="TOTAL"> TOTAL<?php echo $fm0['client']  ?></td>
       <?php $total3_24=$bdd->prepare("select sum(sac), sum(poids)  from register_manifeste
    where id_navire=?  and dates=?  ");
       $total3_24->bindParam(1,$a[0]);
       
       $total3_24->bindParam(2,$a[1]);
      
       $total3_24->execute(); 
               $totaldis=$bdd->prepare("select  sum(poids_t)  from dispatching 
    where id_navire=?     ");
       $totaldis->bindParam(1,$a[0]);
    
        
        $totaldis->execute();

       while($td=$totaldis->fetch()){
          while($t3_24=$total3_24->fetch()){ ?>     
     
    <td scope="col"   id="TOTAL"><?php echo number_format(0, 0,',',' ');  ?></td>
    <td scope="col"   id="TOTAL"><?php echo number_format($td['sum(poids_t)'], 3,',',' '); ?></td>
    <?php $total3_TOT=$bdd->prepare("select sum(sac), sum(poids)  from register_manifeste
    where id_navire=?  and dates<=?  ");
       $total3_TOT->bindParam(1,$a[0]);
       
       $total3_TOT->bindParam(2,$a[1]);
       
       $total3_TOT->execute(); 
             while($t3_TOT=$total3_TOT->fetch()) { ?>
      <td scope="col"  id="TOTAL"><?php echo number_format(0, 0,',',' '); ?></td>
      <td scope="col"   id="TOTAL"><?php echo number_format($t3_24['sum(poids)'], 3,',',' '); ?></td>
       <td scope="col" id="TOTAL"><?php echo number_format(0, 0,',',' '); ?></td>
      <td scope="col"   id="TOTAL"><?php echo number_format($t3_TOT['sum(poids)'], 3,',',' '); ?></td>
            
    <?php $cumul_poids=$td['sum(poids_t)']-$t3_TOT['sum(poids)']; ?>
       <td scope="col" id="TOTAL"><?php echo number_format(0, 0,',',' ');  ?></td>
      <<td scope="col"  id="TOTAL"><?php echo number_format($cumul_poids, 3,',',' '); ?></td>

    
    
   
     </tr>
  <?php } } } } ?> 
 <?php } ?>

<?php } ?>
<?php } ?>






	

