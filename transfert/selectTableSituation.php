<?php
require('../database.php');
?>

        	<?php if (isset($_POST['idDate'])) {
        		 $b=$_POST["idDate"];
        		   $a=explode(",",$b);

 $type_navire = $bdd->prepare("SELECT type from navire_deb where id=? " );
        $type_navire->bindParam(1,$a[0]);
        $type_navire->execute();
        $filtre_type=$type_navire->fetch();
       

 $titre=$bdd->query("SELECT * from register_manifeste");
 $tr=$titre->fetch();
 
        		    $res2 = $bdd->prepare("SELECT dates from transfert_debarquement where id_navire=? and dates=? " );
        $res2->bindParam(1,$a[0]);
        $res2->bindParam(2,$a[1]);
       
        
        $res2->execute();
        $tr2=$res2->fetch();


$titreP=$bdd->query("SELECT * from transfert_debarquement");
 $trP=$titreP->fetch();
 
                $res2P = $bdd->prepare("SELECT dates from transfert_debarquement where id_navire=? and dates=? " );
        $res2P->bindParam(1,$a[0]);
        $res2P->bindParam(2,$a[1]);
       
        
        $res2P->execute();
        $tr2P=$res2P->fetch();

$titreAC=$bdd->query("SELECT * from transfert_debarquement");
 $trAC=$titre->fetch();
 
                $res2AC = $bdd->prepare("SELECT dates from transfert_debarquement where id_navire=? and dates=? " );
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
  // FONCTION--------visibilite

  function visibilite_after_select_date($id){
    if($id==0){
     return "style=display:none;";
    }
     else{
      return  "style=display:block;";
    }
    
  }     
        
       // $res2AP->execute();
        $tr2AP=$res2->fetch();       
        
//REQUETES TABLE SITUATION PAR CALE /////////////////

     /*           $cale=$bdd->prepare("SELECT dc.*,count(dc.cales), sum(dc.nombre_sac), sum(dc.poids), p.* FROM declaration_chargement as dc LEFT join produit_deb as p on dc.id_produit=p.id  where dc.id_navire=?  group by dc.cales,p.produit, dc.conditionnement with rollup  ");
        	$cale->bindParam(1,$a[0]); */

          if($filtre_type['type']=="SACHERIE"){
        
         $cale=$bdd->prepare("SELECT dc.*,count(dc.cales), sum(dc.nombre_sac), sum(dc.poids), p.* FROM declaration_chargement as dc LEFT join produit_deb as p on dc.id_produit=p.id
         where dc.id_navire=?   group by dc.cales,p.produit, dc.conditionnement with rollup  ");
          $cale->bindParam(1,$a[0]);  
          
        	$cale->execute();


            $cale_sain=$bdd->prepare("SELECT dc.*,count(dc.cales), sum(dc.nombre_sac), sum(dc.poids), p.* FROM declaration_chargement as dc LEFT join produit_deb as p on dc.id_produit=p.id
         where dc.id_navire=?   group by dc.cales,p.produit, dc.conditionnement with rollup  ");
          $cale_sain->bindParam(1,$a[0]);  
          
            $cale_sain->execute();
        }
        if($filtre_type['type']=="VRAQUIER"){
        
         $cale=$bdd->prepare("SELECT dc.*,count(dc.cales), sum(dc.nombre_sac), sum(dc.poids), p.* FROM declaration_chargement as dc LEFT join produit_deb as p on dc.id_produit=p.id
         where dc.id_navire=?   group by dc.cales,p.produit with rollup  ");
          $cale->bindParam(1,$a[0]);  
          
          $cale->execute();
        }
////////////FIN REQUETES TABLE SITUATION PAR CALE////////////////       


   $produitT=$bdd->prepare("SELECT dc.*, sum(dc.nombre_sac), sum(dc.poids), p.* FROM declaration_chargement as dc LEFT join produit_deb as p on dc.id_produit=p.id   

         where  dc.id_navire=?  group by p.produit,  dc.conditionnement,dc.cales,dc.id_dec  with rollup ");
                  $produitT->bindParam(1,$a[0]);
                 
          
          
          $produitT->execute();
        

        
 if($filtre_type['type']=="SACHERIE"){
   $produit=$bdd->prepare("SELECT dc.*, sum(dc.nombre_sac), sum(dc.poids), p.* FROM declaration_chargement as dc LEFT join produit_deb as p on dc.id_produit=p.id   

         where  dc.id_navire=?  group by p.produit,  dc.conditionnement,dc.cales  with rollup ");
                  $produit->bindParam(1,$a[0]);
                 
          
          
          $produit->execute();


          $produit_sain=$bdd->prepare("SELECT dc.*, sum(dc.nombre_sac), sum(dc.poids), p.* FROM declaration_chargement as dc LEFT join produit_deb as p on dc.id_produit=p.id   

         where  dc.id_navire=?  group by p.produit,  dc.conditionnement,dc.cales  with rollup ");
                  $produit_sain->bindParam(1,$a[0]);
                 
          
          
          $produit_sain->execute();
}

if($filtre_type['type']=="VRAQUIER"){
   $produit=$bdd->prepare("SELECT dc.*, sum(dc.nombre_sac), sum(dc.poids), p.* FROM declaration_chargement as dc LEFT join produit_deb as p on dc.id_produit=p.id   

         where  dc.id_navire=?  group by p.produit,dc.cales,dc.id_dec  with rollup ");
                  $produit->bindParam(1,$a[0]);
                 
          
          
          $produit->execute();
}

 $fmpT=$bdd->prepare("select dc.*,av.*, sum(sac_flasque),sum(poids_flasque),sum(sac_mouille),sum(poids_mouille), p.* from declaration_chargement as dc inner join produit_deb as p on dc.id_produit=p.id inner join avaries as av on dc.id_produit=av.id_produit and dc.cales=av.cale_avaries and dc.conditionnement=av.poids_sac_avaries and dc.id_navire=av.id_navire where dc.id_navire=? and av.date_avaries<=? group by p.produit,  dc.conditionnement,dc.cales, dc.id_dec with rollup");

                  $fmpT->bindParam(1,$a[0]);
                  $fmpT->bindParam(2,$a[1]);
          
          
          $fmpT->execute();


$fmp=$bdd->prepare("select dc.*,av.*, sum(sac_flasque),sum(poids_flasque),sum(sac_mouille),sum(poids_mouille), p.* from declaration_chargement as dc inner join produit_deb as p on dc.id_produit=p.id inner join avaries as av on dc.id_produit=av.id_produit and dc.cales=av.cale_avaries and dc.conditionnement=av.poids_sac_avaries and dc.id_navire=av.id_navire where dc.id_navire=? and av.date_avaries=? group by p.produit,  dc.conditionnement,dc.cales, dc.id_dec with rollup");

                  $fmp->bindParam(1,$a[0]);
                  $fmp->bindParam(2,$a[1]);
          
          
          $fmp->execute();          
         
$fmTAC=$bdd->prepare("select dc.*,av.*, sum(av.sac_flasque),sum(av.poids_flasque),sum(av.sac_mouille),sum(av.poids_mouille), p.produit from declaration_chargement as dc inner join produit_deb as p on dc.id_produit=p.id inner join avaries as av on dc.id_produit=av.id_produit and dc.cales=av.cale_avaries and dc.conditionnement=av.poids_sac_avaries and dc.id_navire=av.id_navire where dc.id_navire=? and av.date_avaries<=? group by dc.cales,p.produit, dc.conditionnement with rollup;");

                  $fmTAC->bindParam(1,$a[0]);
                  $fmTAC->bindParam(2,$a[1]);
          
          
          $fmTAC->execute();


$fmAC=$bdd->prepare("SELECT dc.*,count(dc.cales), sum(dc.nombre_sac), sum(dc.poids), p.* FROM declaration_chargement as dc LEFT join produit_deb as p on dc.id_produit=p.id  where dc.id_navire=? group by dc.cales,p.produit, dc.conditionnement with rollup");

                  $fmAC->bindParam(1,$a[0]);
                 
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


$fmTAP=$bdd->prepare("SELECT dc.*,count(dc.cales), sum(dc.nombre_sac), sum(dc.poids), p.* FROM declaration_chargement as dc LEFT join produit_deb as p on dc.id_produit=p.id  where dc.id_navire=? group by p.produit,  dc.conditionnement,dc.cales,dc.id_dec with rollup");

                  $fmTAP->bindParam(1,$a[0]);
                  
          
          
          $fmTAP->execute();


$fmAP=$bdd->prepare("SELECT dc.*,count(dc.cales), sum(dc.nombre_sac), sum(dc.poids), p.* FROM declaration_chargement as dc LEFT join produit_deb as p on dc.id_produit=p.id  where dc.id_navire=? group by p.produit,  dc.conditionnement,dc.cales,dc.id_dec with rollup");

                  $fmAP->bindParam(1,$a[0]);
                  
                  $fmAP->execute();

                  

   $fmTRAVAP=$bdd->prepare("SELECT dc.*,count(dc.cales), sum(dc.nombre_sac), sum(dc.poids), p.* FROM declaration_chargement as dc LEFT join produit_deb as p on dc.id_produit=p.id  where dc.id_navire=? group by p.produit,  dc.conditionnement, dc.id_navire with rollup ");

                  $fmTRAVAP->bindParam(1,$a[0]);
                  
                  $fmTRAVAP->execute();       

/*
$fmTTRAVAP=$bdd->prepare("select dis.*,trav.*, sum(trav.sac_flasque_tr_av),sum(trav.poids_flasque_tr_av),sum(trav.sac_mouille_tr_av),sum(trav.poids_mouille_tr_av), p.* from transfert_avaries as trav inner join produit_deb as p on trav.id_produit=p.id
     inner join dispatching as dis on trav.id_produit=dis.id_produit and trav.id_client=dis.id_client and trav.id_destination_tr=dis.id_mangasin and trav.id_dis_bl_tr=dis.id_dis 
     and trav.poids_sac_tr_av=dis.poids_kg  where trav.id_navire=? and trav.date_tr_avaries<=? group by p.produit, trav.poids_sac_tr_av");

                  $fmTTRAVAP->bindParam(1,$a[0]);
                  $fmTTRAVAP->bindParam(2,$a[1]);
                  $fmTTRAVAP->execute();  */    
  

$fmCUMULAP=$bdd->prepare("select dc.*,av.*, sum(av.sac_flasque),sum(av.poids_flasque),sum(av.sac_mouille),sum(av.poids_mouille), p.* from avaries as av inner join produit_deb as p on av.id_produit=p.id
     inner join declaration_chargement as dc on av.id_produit=dc.id_produit and av.poids_sac_avaries=dc.conditionnement   
     where av.id_navire=? and av.date_avaries<=? group by p.produit, dc.conditionnement");

                  $fmCUMULAP->bindParam(1,$a[0]);
                  $fmCUMULAP->bindParam(2,$a[1]);
                  $fmCUMULAP->execute();


if($filtre_type['type']=="SACHERIE"){
                   $dispatching=$bdd->prepare("SELECT dis.*, p.*,cli.*,mang.*,sum(dis.quantite_sac),sum(dis.quantite_poids),nc.*/*,d.id_declaration*/ from dispats as dis
   /* inner join declaration as d on d.id_bl=dis.id_dis*/               
inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
  inner join produit_deb as p on nc.id_produit=p.id
   inner join mangasin as mang on dis.id_mangasin=mang.id
    
    
     inner join client as cli on nc.id_client=cli.id
       where nc.id_navire=?   group by mang.mangasin,p.produit, nc.poids_kg with rollup ");

                 $dispatching->bindParam(1,$a[0]);
                 
                  $dispatching->execute();

   $dispatching_avaries=$bdd->prepare("SELECT dis.*, p.*,cli.*,mang.*,sum(dis.quantite_sac),sum(dis.quantite_poids),nc.*,d.id_declaration from dispats as dis
                  
inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
  inner join produit_deb as p on nc.id_produit=p.id
   inner join mangasin as mang on dis.id_mangasin=mang.id
    inner join declaration as d on d.id_bl=dis.id_dis 
    
     inner join client as cli on nc.id_client=cli.id
       where nc.id_navire=?   group by mang.mangasin,p.produit, nc.poids_kg with rollup ");

                 $dispatching_avaries->bindParam(1,$a[0]);
                 
                  $dispatching_avaries->execute(); 


   $dispatching_produit=$bdd->prepare("SELECT dis.*, p.*,cli.*,mang.*,sum(dis.quantite_sac),sum(dis.quantite_poids),nc.*/*,d.id_declaration*/ from dispats as dis
                  
inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
  inner join produit_deb as p on nc.id_produit=p.id
   inner join mangasin as mang on dis.id_mangasin=mang.id
   /* inner join declaration as d on d.id_bl=dis.id_dis */
    
     inner join client as cli on nc.id_client=cli.id
       where nc.id_navire=?   group by mang.mangasin,p.produit, nc.poids_kg with rollup ");

                 $dispatching_produit->bindParam(1,$a[0]);
                 
                  $dispatching_produit->execute(); 


          $dispatching_all=$bdd->prepare("SELECT dis.*, p.*,cli.*,mang.*,sum(dis.quantite_sac),sum(dis.quantite_poids),nc.*/*,d.id_declaration*/ from dispats as dis
                  
inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
  inner join produit_deb as p on nc.id_produit=p.id
   inner join mangasin as mang on dis.id_mangasin=mang.id
   /* inner join declaration as d on d.id_bl=dis.id_dis */
    
     inner join client as cli on nc.id_client=cli.id
       where nc.id_navire=?   group by mang.mangasin,p.produit, nc.poids_kg with rollup ");

                 $dispatching_all->bindParam(1,$a[0]);
                 
                  $dispatching_all->execute();


    $dispatching_produit_all=$bdd->prepare("SELECT dis.*, p.*,cli.*,mang.*,sum(dis.quantite_sac),sum(dis.quantite_poids),nc.*/*,d.id_declaration*/ from dispats as dis
                  
inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
  inner join produit_deb as p on nc.id_produit=p.id
   inner join mangasin as mang on dis.id_mangasin=mang.id
   /* inner join declaration as d on d.id_bl=dis.id_dis */
    
     inner join client as cli on nc.id_client=cli.id
       where nc.id_navire=?   group by mang.mangasin,p.produit, nc.poids_kg with rollup ");

                 $dispatching_produit_all->bindParam(1,$a[0]);
                 
                  $dispatching_produit_all->execute();               
                           


  $dispatching_avaries_client=$bdd->prepare("SELECT dis.*, p.*,cli.*,mang.*,sum(dis.quantite_sac),sum(dis.quantite_poids),nc.*,d.id_declaration from dispats as dis
                  
inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
  inner join produit_deb as p on nc.id_produit=p.id
   inner join mangasin as mang on dis.id_mangasin=mang.id
    inner join declaration as d on d.id_bl=dis.id_dis 
    
     inner join client as cli on nc.id_client=cli.id
       where nc.id_navire=?   group by nc.id_client,p.produit, nc.poids_kg with rollup ");

                  $dispatching_avaries_client->bindParam(1,$a[0]);
                 
                   $dispatching_avaries_client->execute();                                
}

if($filtre_type['type']=="VRAQUIER"){
                   $dispatching=$bdd->prepare("SELECT dis.*, p.*,cli.*,mang.*,sum(dis.quantite_sac),sum(dis.quantite_poids),nc.*, d.num_declaration,d.id_destination from dispats as dis
     inner join declaration as d on d.id_declaration=dis.declaration_id               
inner join numero_connaissements as nc on nc.id_connaissement=d.id_bl
  LEFT join produit_deb as p on nc.id_produit=p.id
     
     LEFT join mangasin as mang on d.id_destination=mang.id
     LEFT join client as cli on nc.id_client=cli.id
       where nc.id_navire=?  group by mang.mangasin,p.produit,dis.id_dis with rollup");

                 $dispatching->bindParam(1,$a[0]);
                 
                  $dispatching->execute(); 
}
/*

 $fmTRAVAD=$bdd->prepare("SELECT dis.*, p.*,cli.*,mang.*,sum(dis.nombre_sac),sum(dis.poids_t) from dispatching as dis LEFT join produit_deb as p on dis.id_produit=p.id
     
     LEFT join mangasin as mang on dis.id_mangasin=mang.id
     LEFT join client as cli on dis.id_client=cli.id
       where dis.id_navire=? group by mang.mangasin,p.produit, dis.id_dis with rollup");

                  $fmTRAVAD->bindParam(1,$a[0]);
                  
   
                  $fmTRAVAD->execute(); */ 

/*
  $fmTTRAVAD=$bdd->prepare("select dis.id_dis,trav.*,mang.*, sum(trav.sac_flasque_tr_av),sum(trav.poids_flasque_tr_av),sum(trav.sac_mouille_tr_av),sum(trav.poids_mouille_tr_av), p.* from transfert_avaries as trav inner join produit_deb as p on trav.id_produit=p.id
     inner join dispatching as dis on trav.id_produit=dis.id_produit and trav.id_client=dis.id_client and trav.id_destination_tr=dis.id_mangasin and trav.id_dis_bl_tr=dis.id_dis 
     and trav.poids_sac_tr_av=dis.poids_kg
     inner join mangasin as mang on trav.id_destination_tr=mang.id
       where trav.id_navire=? and trav.date_tr_avaries<=? group by mang.mangasin,p.produit, dis.id_dis with rollup");

                  $fmTTRAVAD->bindParam(1,$a[0]);
                  $fmTTRAVAD->bindParam(2,$a[1]);
                  $fmTTRAVAD->execute();  */

 /* $SD=$bdd->prepare("select dis.*,rm.*, sum(sac),sum(poids),p.* from register_manifeste as rm inner join produit_deb as p on rm.id_produit=p.id
     inner join dispatching as dis on rm.id_produit=dis.id_produit and rm.id_client=dis.id_client and rm.id_destination=dis.id_mangasin and rm.id_dis_bl=dis.id_dis 
     and rm.poids_sac=dis.poids_kg  where rm.id_navire=? and rm.dates=? group by p.produit, trav.poids_sac_tr_av");

                  $SD->bindParam(1,$a[0]);
                  $SD->bindParam(2,$a[1]);
                  $SD->execute();  */ 

  
//REQUETE SITUATION RESTANT DES AVARIES
  
      
/*
$fmTTRAVAPRES=$bdd->prepare("SELECT dis.*, p.*,cli.*,mang.*,sum(dis.nombre_sac),sum(dis.poids_t) from dispatching as dis LEFT join produit_deb as p on dis.id_produit=p.id
     
     LEFT join mangasin as mang on dis.id_mangasin=mang.id
     LEFT join client as cli on dis.id_client=cli.id
       where dis.id_navire=? group by p.produit, dis.poids_kg");

                  $fmTTRAVAPRES->bindParam(1,$a[0]);
                  
                  $fmTTRAVAPRES->execute(); */     
  
  /*                 
$fmCUMULAPRES=$bdd->prepare("SELECT av.*,dis.*, sum(av.sac_flasque),sum(av.poids_flasque),sum(av.sac_mouille),sum(av.poids_mouille), p.* from avaries as av inner join produit_deb as p on p.id=av.id_produit
inner join dispatching as dis on av.id_produit=dis.id_produit  and av.id_dis_av=dis.id_dis 
     and av.poids_sac_avaries=dis.poids_kg
 where av.id_navire=? and av.date_avaries<=? group by p.produit, av.poids_sac_avaries");

                  $fmCUMULAPRES->bindParam(1,$a[0]);
                  $fmCUMULAPRES->bindParam(2,$a[1]);
                  $fmCUMULAPRES->execute(); */
  //FIN REQUETE


  /////REQUETE TRANSFERT ET LIVRAISON

/*
  $TRANSF=$bdd->prepare("select rm.*,tr.*, dis.*, sum(rm.sac),sum(rm.poids),sum(tr.sac_flasque_tr_av),sum(tr.poids_flasque_tr_av),sum(tr.sac_mouille_tr_av),sum(tr.poids_mouille_tr_av) from register_manifeste as rm
    inner join dispatching as dis on dis.id_dis=rm.id_dis_bl
    inner join transfert_avaries as tr on rm.id_dis_bl=tr.id_dis_bl_tr
         where  rm.id_navire=? and rm.dates<=? and dis.des_douane='TRANSFERT'    ");
                   $TRANSF->bindParam(1,$a[0]);
                  $TRANSF->bindParam(2,$a[1]);
          
          
          $TRANSF->execute(); */

          /*

          $TRANSF24H=$bdd->prepare("select rm.*,dis.* ,sum(rm.sac),sum(rm.poids) from register_manifeste as rm
    
     inner join dispatching as dis on dis.id_navire=rm.id_navire
         where  rm.id_navire=? and rm.dates<=? and dis.des_douane='TRANSFERT'    ");
                   $TRANSF24H->bindParam(1,$a[0]);
                  $TRANSF24H->bindParam(2,$a[1]);
          
          
          $TRANSF24H->execute(); */

          /*  

                    $countbl=$bdd->prepare("SELECT count(n_bl) from dispatching where id_navire=? and des_douane='TRANSFERT' ");
                    $countbl->bindParam(1,$a[0]);
                    $countbl->execute(); */


////////PARTIE REQUETE SITUATION VRAC

                    /*

 $caleTVRAC=$bdd->prepare("select dc.*, dc.poids as pd,  p.*, rm.*, sum(rm.sac),sum(rm.poids)  FROM declaration_chargement as dc
          inner  join produit_deb as p on dc.id_produit=p.id
          inner  join register_manifeste as rm on  dc.id_produit=rm.id_produit and dc.cales=rm.cale
          
          
         where  dc.id_navire=? and rm.dates<=?    group by dc.cales,p.produit, dc.id_dec  with rollup ");
                 $caleTVRAC->bindParam(1,$a[0]);
                  $caleTVRAC->bindParam(2,$a[1]);
          
          
          $caleTVRAC->execute();

               $caleVRAC=$bdd->prepare("select dc.*,  dc.poids as pd, p.*, rm.*, sum(rm.sac),sum(rm.poids) FROM declaration_chargement as dc inner join produit_deb as p on dc.id_produit=p.id inner join register_manifeste as rm on dc.id_produit=rm.id_produit and dc.cales=rm.cale  where dc.id_navire=? and rm.dates=? group by dc.cales,p.produit, dc.id_dec with rollup; ");
         $caleVRAC->bindParam(1,$a[0]);
          $caleVRAC->bindParam(2,$a[1]);
          
          $caleVRAC->execute();

 $produitTVRAC=$bdd->prepare("select dc.*,  dc.poids as pd, sum(dc.nombre_sac), p.*, rm.*, sum(rm.sac),sum(rm.poids)  FROM declaration_chargement as dc
          inner  join produit_deb as p on dc.id_produit=p.id

          inner  join register_manifeste as rm on  dc.id_produit=rm.id_produit and dc.cales=rm.cale
           

         where  dc.id_navire=? and rm.dates<=?    group by p.produit,  p.qualite,dc.cales,dc.id_dec  with rollup ");
                  $produitTVRAC->bindParam(1,$a[0]);
                  $produitTVRAC->bindParam(2,$a[1]);
          
          
          $produitTVRAC->execute();


   $produitVRAC=$bdd->prepare("select dc.*, dc.poids as pd, sum(dc.nombre_sac), p.*, rm.*, sum(rm.sac),sum(rm.poids)  FROM declaration_chargement as dc
          inner  join produit_deb as p on dc.id_produit=p.id
          inner  join register_manifeste as rm on  dc.id_produit=rm.id_produit and dc.cales=rm.cale
          

         where  dc.id_navire=? and rm.dates=?    group by p.produit,  p.qualite,dc.cales, dc.id_dec   with rollup ");
                  $produitVRAC->bindParam(1,$a[0]);
                  $produitVRAC->bindParam(2,$a[1]);
          
          
          $produitVRAC->execute();




 

  $TSTDVRAC=$bdd->prepare("SELECT dis.*, p.*,cli.*,mang.*,sum(dis.nombre_sac),sum(dis.poids_t) from dispatching as dis LEFT join produit_deb as p on dis.id_produit=p.id
     
     LEFT join mangasin as mang on dis.id_mangasin=mang.id
     LEFT join client as cli on dis.id_client=cli.id
       where dis.id_navire=? group by mang.mangasin,p.produit, dis.id_dis with rollup");

                  $TSTDVRAC->bindParam(1,$a[0]);
                  
                  $TSTDVRAC->execute();  


*/

if($filtre_type['type']=="SACHERIE"){
$STCLIVRAC2=$bdd->prepare("SELECT dis.*, p.*,cli.*,mang.*,sum(dis.quantite_sac),sum(dis.quantite_poids),nc.*/*,d.num_declaration*/ from dispats as dis
   /* INNER join declaration as d on d.id_bl=dis.id_dis*/
left join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
  LEFT join produit_deb as p on nc.id_produit=p.id
     
     LEFT join mangasin as mang on dis.id_mangasin=mang.id
     LEFT join client as cli on nc.id_client=cli.id
       where nc.id_navire=?   group by cli.client,nc.id_produit, nc.poids_kg,dis.id_mangasin with rollup ");

                  $STCLIVRAC2->bindParam(1,$a[0]);
                  
  
                  $STCLIVRAC2->execute(); 

$STCLIVRAC2_all=$bdd->prepare("SELECT dis.*, p.*,cli.*,mang.*,sum(dis.quantite_sac),sum(dis.quantite_poids),nc.*/*,d.num_declaration*/ from dispats as dis
   /* INNER join declaration as d on d.id_bl=dis.id_dis */
left join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
  LEFT join produit_deb as p on nc.id_produit=p.id
     
     LEFT join mangasin as mang on dis.id_mangasin=mang.id
     LEFT join client as cli on nc.id_client=cli.id
       where nc.id_navire=?   group by cli.client,nc.id_produit, nc.poids_kg,dis.id_mangasin with rollup ");

                  $STCLIVRAC2_all->bindParam(1,$a[0]);
                  
  
                  $STCLIVRAC2_all->execute(); 

                }
      if($filtre_type['type']=="VRAQUIER"){
$STCLIVRAC2=$bdd->prepare("SELECT dis.*, p.*,cli.*,mang.*,sum(dis.quantite_sac),sum(dis.quantite_poids),nc.* from dispat as dis
left join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
  LEFT join produit_deb as p on dis.id_produit=p.id
     
     LEFT join mangasin as mang on dis.id_mangasin=mang.id
     LEFT join client as cli on dis.id_client=cli.id
       where nc.id_navire=?   group by cli.client,dis.id_produit, dis.id_dis,dis.id_mangasin with rollup ");

                  $STCLIVRAC2->bindParam(1,$a[0]);
                  
  
                  $STCLIVRAC2->execute();  
                }
/*
  $TSTCLIVRAC=$bdd->prepare("select dis.*,rm.*,mang.*, sum(rm.sac),sum(rm.poids), p.*,cli.* from register_manifeste as rm inner join produit_deb as p on rm.id_produit=p.id
     inner join dispatching as dis on rm.id_produit=dis.id_produit and rm.id_client=dis.id_client  and rm.id_dis_bl=dis.id_dis 
     and rm.poids_sac=dis.poids_kg
     inner join mangasin as mang on rm.id_destination=mang.id
     inner join client as cli on rm.id_client=cli.id
       where rm.id_navire=? and rm.dates<=? group by cli.client,p.produit, dis.id_dis with rollup");

                  $TSTCLIVRAC->bindParam(1,$a[0]);
                  $TSTCLIVRAC->bindParam(2,$a[1]);
                  $TSTCLIVRAC->execute();  

         */

                               

        	?>
<?php // FILTRER NAVIRE SI C'EST VRAC OU SAC
           // 1 EN SAC     
          // if($filtre_type['type']=="SACHERIE"){ 
              if($filtre_type['type']=='SACHERIE'){                                          ?>

                <style type="text/css">
                  @media(max-width: 1400px) {
                  *{
            font-size:12px !important;
   
}
}
                  
                </style>
            
<div id="btnafficher" style="background:white !important;"> 
   

    <div class="container " >
        <div class="row">

            <div class="col-lg-6">
              <center>
                <div  class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        SITUATION DE DEBARQUEMENT
                    </button>
                    
                    <ul id="drop_debarquement" class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li><a style=" display: flex; justify-content: center; color: blue; border:solid; border-color: blue; border-radius: 50px;  background: white;  "  id="deb_cale" class="dropdown-item" onclick="VisibleDebParCale();" > SAINS + AVARIES</a></li>
                        <li><a onclick="VisibleDebParProduit();"  id="deb_produit" class="dropdown-item" style="display:none;">PAR PRODUIT</a></li>
                       
                        <li><a onclick="VisibleDebParClient();" id="deb_client" class="dropdown-item" style="display:none;">PAR CLIENT</a></li>
                         <li><a style=" display: flex; justify-content: center; color: blue; border:solid; border-color: blue; border-radius: 50px;  background: white;  " id="deb_avaries_cale" class="dropdown-item" onclick="VisibleDebParSain();">SAINS </a></li>
                         <li><a style=" display: flex; justify-content: center; color: blue; border:solid; border-color: blue; border-radius: 50px;  background: white;  " id="deb_avaries_cale" class="dropdown-item" onclick="VisibleAvariesParCale();">AVARIES </a></li>
                         <li><a id="deb_avaries_produit" class="dropdown-item" onclick="VisibleAvariesParProduit();" style="display:none;">AVARIES PAR PRODUIT</a></li>
                          <li><a style=" display: flex; justify-content: center; color: blue; border:solid; border-color: blue; border-radius: 50px;  background: white;  " id="deb_avaries_produit" class="dropdown-item" id="deb_destination" onclick="VisibleGlobal();">GLOBAL</a></li>
                    </ul>
                  
                </div>
            </div>
        
        <div class="col-lg-6">
                <div  class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        SITUATION  DES ENLEVEMENTS
                    </button>
                    
                    <ul id="drop_debarquement" class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                         <li><a style=" display: flex; justify-content: center; color: blue; border:solid; border-color: blue; border-radius: 50px;  background: white;  " onclick="Visible_transfert_sain_avaries();" id="deb_destination" class="dropdown-item" >SAINS + AVARIES</a></li>
                          <li><a style=" display: flex; justify-content: center; color: blue; border:solid; border-color: blue; border-radius: 50px;  background: white;  " id="deb_produit" class="dropdown-item" onclick="Visible_transfert_sain();">SAINS</a></li>
                        <li><a style=" display: flex; justify-content: center; color: blue; border:solid; border-color: blue; border-radius: 50px;  background: white;  " id="deb_cale" class="dropdown-item" onclick="VisibleTransAvariesParProduit();">AVARIES</a></li>
                       
                     <!--   <li><a id="deb_produit" class="dropdown-item" onclick="VisibleRestantAvaries();">RESTANT DES AVARIES</a></li> !-->
                        
                    </ul>
                  
                </div>
                </center>
            </div>
           
    </div>
 </div>


 
<center>  

<button style="margin:auto-right; display: none; width: 30%;" class="btn btn-danger no_print" onclick="imprimer('situation_global')" id="all_imprime" >imprimer tous</button>
</center>
</div> 
<?php  
$id=$_POST['deb_cale']; ?>
 <div class="row"  id="situation_global">
 

 
<div class="col col-lg-12" id="deb_by_cale"   <?php if($id==0){

 ?> style="display: none;" <?php } ?>  <?php if($id==1){

 ?> style="display: block;" <?php } ?> >




<div class="table-responsive"  >
        	<?php if(!empty($tr['dates'])){
            $DateDebut=explode('-',$tr['dates']);
           if(!empty($tr2['dates'])){
            $DateActuel=explode('-',$tr2['dates']);?>

 <table class='table table-bordered ' id='table'  style="margin-bottom:0px !important;">
    

<thead>
           <tr style="background: linear-gradient(to bottom, blue, #1B2B65); background: linear-gradient(to left, blue, #1B2B65); background: linear-gradient(to top, blue, #1B2B65); color: white; text-align: center; font-weight: bold; vertical-align: middle; " >
           <td colspan="10" ><h5 style="color: white;">	SITUATION DU DEBARQUEMENT (SAINS + AVARIES) <span style="color:yellow;">PAR CALE</span> DU <span style="color: red; background: white;"><?php echo  $DateActuel[2]. '-' .$DateActuel[1].'-'.$DateActuel[0];?></span> <!-- <select id="situation_par_cale_filtre" style="float:left;" onchange="VisibleAvariesParCaleFiltre()"><option selected>GLOBALE</option>
            <option >SAINS</option>
            <option value="avaries" > AVARIES</option></select> !--> </h5></td> </tr>
<?php 
         }  }
	 ?>
        	



	
 <tr class="EnteteTableSituation" style="font-size: 12px;" >
      

      <td  class="colLibeles" scope="col"  rowspan="2"  >CALES</td>
      <td class="colLibeles" scope="col"  rowspan="2"  >PRODUIT</td>
      <td class="colManifeste" colspan="2" >MANIFESTE</td>
      <td scope="col" colspan="2" class="colDeb24H" >DEB 24H</td>
      <td scope="col" colspan="2" class="colDebTOTAL" > TOTAL DEB</td>
      <td scope="col" colspan="2" class="colROB">ROB</td>
  </tr>
  	<tr class="EnteteTableSituation"  >
      
      <td class="colManifeste">NBRE SACS</td>
      <td class="colManifeste">POIDS</td>
        <td scope="col" class="colDeb24H" >NBRE SACS</td>
      <td scope="col" class="colDeb24H" >POIDS</td>
        <td scope="col" class="colDebTOTAL" >NBRE SACS</td>
      <td scope="col" class="colDebTOTAL" >POIDS</td>
        <td scope="col" class="colROB">NBRE SACS</td>
      <td scope="col" class="colROB" >POIDS</td>
        
     
     
 
         </tr>
         </thead> 
         <tbody> 
         
       <?php 
        
       while($cal2=$cale->fetch()){

      //---REQUETE SAINS ET AVARIES DEBARQUES EN 24 PAR CALE ET PRODUIT

         $sain_24H=$bdd->prepare("SELECT dc.*,count(dc.cales), sum(dc.nombre_sac), sum(dc.poids), p.*,sum(rm.sac),sum(rm.poids),sum(det.sac_reconditionne),sum(det.poids_reconditionne) FROM declaration_chargement as dc LEFT join produit_deb as p on dc.id_produit=p.id
         inner join transfert_debarquement as rm on rm.cale=dc.id_dec
         left join detail_chargement as det on det.register_manif_id=rm.id_register_manif
           where dc.id_navire=? and rm.dates=? and dc.cales=? and dc.id_produit=?  and dc.conditionnement=? and rm.statut='sain'  group by dc.cales,p.produit, dc.conditionnement   ");
          $sain_24H->bindParam(1,$a[0]);  
          $sain_24H->bindParam(2,$a[1]);  
           $sain_24H->bindParam(3,$cal2['cales']); 
            $sain_24H->bindParam(4,$cal2['id_produit']); 
             $sain_24H->bindParam(5,$cal2['conditionnement']); 
          $sain_24H->execute();
          

            $sain_TOTAL=$bdd->prepare("SELECT dc.*,count(dc.cales), sum(dc.nombre_sac), sum(dc.poids), p.*,sum(rm.sac),sum(rm.poids),sum(det.sac_reconditionne),sum(det.poids_reconditionne) FROM declaration_chargement as dc LEFT join produit_deb as p on dc.id_produit=p.id
         inner join transfert_debarquement as rm on rm.cale=dc.id_dec
         left join detail_chargement as det on det.register_manif_id=rm.id_register_manif
           where dc.id_navire=? and rm.dates<=? and dc.cales=? and dc.id_produit=? and dc.conditionnement=?  and rm.statut='sain' group by dc.cales,p.produit, dc.conditionnement    ");
         $sain_TOTAL->bindParam(1,$a[0]);  
          $sain_TOTAL->bindParam(2,$a[1]);  
           $sain_TOTAL->bindParam(3,$cal2['cales']); 
            $sain_TOTAL->bindParam(4,$cal2['id_produit']); 
             $sain_TOTAL->bindParam(5,$cal2['conditionnement']); 
          $sain_TOTAL->execute();


   $avaries_24H=$bdd->prepare("SELECT dc.*,count(dc.cales), sum(dc.nombre_sac), sum(dc.poids), p.*,sum(av.sac_flasque),sum(av.poids_flasque),sum(av.sac_mouille),sum(av.poids_mouille) FROM declaration_chargement as dc LEFT join produit_deb as p on dc.id_produit=p.id
         inner join avaries as av on av.cale_avaries=dc.id_dec  where dc.id_navire=? and av.date_avaries=? and dc.cales=? and dc.id_produit=? and dc.conditionnement=?  group by dc.cales,p.produit, dc.conditionnement   ");
          $avaries_24H->bindParam(1,$a[0]);  
          $avaries_24H->bindParam(2,$a[1]);  
           $avaries_24H->bindParam(3,$cal2['cales']); 
            $avaries_24H->bindParam(4,$cal2['id_produit']); 
             $avaries_24H->bindParam(5,$cal2['conditionnement']); 
          $avaries_24H->execute();
          

            $avaries_TOTAL=$bdd->prepare("SELECT dc.*,count(dc.cales), sum(dc.nombre_sac), sum(dc.poids), p.*,sum(av.sac_flasque),sum(av.poids_flasque),sum(av.sac_mouille),sum(av.poids_mouille) FROM declaration_chargement as dc LEFT join produit_deb as p on dc.id_produit=p.id
         inner join avaries as av on av.cale_avaries=dc.id_dec  where dc.id_navire=? and av.date_avaries<=? and dc.cales=? and dc.id_produit=?  and dc.conditionnement=?  group by dc.cales,p.produit, dc.conditionnement   ");
          $avaries_TOTAL->bindParam(1,$a[0]);  
          $avaries_TOTAL->bindParam(2,$a[1]);  
           $avaries_TOTAL->bindParam(3,$cal2['cales']); 
            $avaries_TOTAL->bindParam(4,$cal2['id_produit']); 
             $avaries_TOTAL->bindParam(5,$cal2['conditionnement']); 
          $avaries_TOTAL->execute();



            $sain_ST24H=$bdd->prepare("SELECT dc.*,count(dc.cales), sum(dc.nombre_sac), sum(dc.poids), p.*,sum(rm.sac),sum(rm.poids),sum(det.sac_reconditionne),sum(det.poids_reconditionne) FROM declaration_chargement as dc LEFT join produit_deb as p on dc.id_produit=p.id
         inner join transfert_debarquement as rm on rm.cale=dc.id_dec
          left join detail_chargement as det on det.register_manif_id=rm.id_register_manif
          where dc.id_navire=? and rm.dates=? and dc.cales=? and rm.statut='sain'  group by dc.cales   ");
          $sain_ST24H->bindParam(1,$a[0]);  
          $sain_ST24H->bindParam(2,$a[1]);  
           $sain_ST24H->bindParam(3,$cal2['cales']); 

          $sain_ST24H->execute();

          

            $sain_STT=$bdd->prepare("SELECT dc.*,count(dc.cales), sum(dc.nombre_sac), sum(dc.poids), p.*,sum(rm.sac),sum(rm.poids),sum(det.sac_reconditionne),sum(det.poids_reconditionne) FROM declaration_chargement as dc LEFT join produit_deb as p on dc.id_produit=p.id
         inner join transfert_debarquement as rm on rm.cale=dc.id_dec
         left join detail_chargement as det on det.register_manif_id=rm.id_register_manif
           where dc.id_navire=? and rm.dates<=? and dc.cales=? and rm.statut='sain' group by dc.cales   ");
         $sain_STT->bindParam(1,$a[0]);  
         $sain_STT->bindParam(2,$a[1]);  
           $sain_STT->bindParam(3,$cal2['cales']); 
          $sain_STT->execute();

          $avaries_ST24H=$bdd->prepare("SELECT dc.*,count(dc.cales), sum(dc.nombre_sac), sum(dc.poids), p.*,sum(av.sac_flasque),sum(av.poids_flasque),sum(av.sac_mouille),sum(av.poids_mouille) FROM declaration_chargement as dc LEFT join produit_deb as p on dc.id_produit=p.id
         inner join avaries as av on av.cale_avaries=dc.id_dec  where dc.id_navire=?  and av.date_avaries=? and dc.cales=?  group by dc.cales ");
          $avaries_ST24H->bindParam(1,$a[0]);  
          $avaries_ST24H->bindParam(2,$a[1]);  
           $avaries_ST24H->bindParam(3,$cal2['cales']); 

          $avaries_ST24H->execute();
          

            $avaries_STT=$bdd->prepare("SELECT dc.*,count(dc.cales), sum(dc.nombre_sac), sum(dc.poids), p.*,sum(av.sac_flasque),sum(av.poids_flasque),sum(av.sac_mouille),sum(av.poids_mouille) FROM declaration_chargement as dc LEFT join produit_deb as p on dc.id_produit=p.id
         inner join avaries as av on av.cale_avaries=dc.id_dec  where dc.id_navire=? and av.date_avaries<=? and dc.cales=?  group by dc.cales  ");
          $avaries_STT->bindParam(1,$a[0]);  
          $avaries_STT->bindParam(2,$a[1]);  
           $avaries_STT->bindParam(3,$cal2['cales']); 

          $avaries_STT->execute();      

            $sain_G24H=$bdd->prepare("SELECT dc.*,count(dc.cales), sum(dc.nombre_sac), sum(dc.poids), p.*,sum(rm.sac),sum(rm.poids),sum(det.sac_reconditionne),sum(det.poids_reconditionne) FROM declaration_chargement as dc LEFT join produit_deb as p on dc.id_produit=p.id
         inner join transfert_debarquement as rm on rm.cale=dc.id_dec
         left join detail_chargement as det on det.register_manif_id=rm.id_register_manif
           where dc.id_navire=? and rm.dates=? and rm.statut='sain'   ");
          $sain_G24H->bindParam(1,$a[0]);  
          $sain_G24H->bindParam(2,$a[1]);  
            

         $sain_G24H->execute();

          

            $sain_GT=$bdd->prepare("SELECT dc.*,count(dc.cales), sum(dc.nombre_sac), sum(dc.poids), p.*,sum(rm.sac),sum(rm.poids),sum(det.sac_reconditionne),sum(det.poids_reconditionne) FROM declaration_chargement as dc LEFT join produit_deb as p on dc.id_produit=p.id
         inner join transfert_debarquement as rm on rm.cale=dc.id_dec 
         left join detail_chargement as det on det.register_manif_id=rm.id_register_manif
          where dc.id_navire=? and rm.dates<=? and rm.statut='sain' ");
         $sain_GT->bindParam(1,$a[0]);  
         $sain_GT->bindParam(2,$a[1]);  
           
          $sain_GT->execute(); 


                   $avaries_G24H=$bdd->prepare("SELECT dc.*,count(dc.cales), sum(dc.nombre_sac), sum(dc.poids), p.*,sum(av.sac_flasque),sum(av.poids_flasque),sum(av.sac_mouille),sum(av.poids_mouille) FROM declaration_chargement as dc LEFT join produit_deb as p on dc.id_produit=p.id
         inner join avaries as av on av.cale_avaries=dc.id_dec  where dc.id_navire=?  and av.date_avaries=?   ");
          $avaries_G24H->bindParam(1,$a[0]);  
          $avaries_G24H->bindParam(2,$a[1]);  
           

          $avaries_G24H->execute();
          

            $avaries_GT=$bdd->prepare("SELECT dc.*,count(dc.cales), sum(dc.nombre_sac), sum(dc.poids), p.*,sum(av.sac_flasque),sum(av.poids_flasque),sum(av.sac_mouille),sum(av.poids_mouille) FROM declaration_chargement as dc LEFT join produit_deb as p on dc.id_produit=p.id
         inner join avaries as av on av.cale_avaries=dc.id_dec  where dc.id_navire=? and av.date_avaries<=?  ");
          $avaries_GT->bindParam(1,$a[0]);  
          $avaries_GT->bindParam(2,$a[1]);  
           

          $avaries_GT->execute();  


        $s_G24H=$sain_G24H->fetch();
         $s_GT=$sain_GT->fetch();
         $s_ST24H=$sain_ST24H->fetch();
         $s_STT=$sain_STT->fetch();
          $s_24H=$sain_24H->fetch();
          $s_TOTAL=$sain_TOTAL->fetch();
          $av_24H=$avaries_24H->fetch();
          $av_TOTAL=$avaries_TOTAL->fetch();

          $av_ST24H=$avaries_ST24H->fetch();
          $av_STT=$avaries_STT->fetch();

          $av_G24H=$avaries_G24H->fetch();
          $av_GT=$avaries_GT->fetch();

          if(!empty($s_24H['sum(rm.sac)'])){
            $sac_sains_24H=$s_24H['sum(rm.sac)'];
            $poids_sains_24H=$s_24H['sum(rm.poids)'];
          }
          else{
            $sac_sains_24H=0;
            $poids_sains_24H=0;
          }
          if(!empty($s_24H['sum(det.sac_reconditionne)'])){
            $sac_sains_reconditionne_24H=$s_24H['sum(det.sac_reconditionne)'];
            $poids_sains_reconditionne_24H=$s_24H['sum(det.poids_reconditionne)'];
          }
          else{
            $sac_sains_reconditionne_24H=0;
            $poids_sains_reconditionne_24H=0;
          }

           if(!empty($s_TOTAL['sum(rm.sac)'])){
            $sac_sains_TOTAL=$s_TOTAL['sum(rm.sac)'];
            $poids_sains_TOTAL=$s_TOTAL['sum(rm.poids)'];
          }
          else{
            $sac_sains_TOTAL=0;
            $poids_sains_TOTAL=0;
          }

           if(!empty($s_ST24H['sum(rm.sac)'])){
            $sac_sains_ST24H=$s_ST24H['sum(rm.sac)'];
            $poids_sains_ST24H=$s_ST24H['sum(rm.poids)'];
          }
          else{
            $sac_sains_ST24H=0;
            $poids_sains_ST24H=0;
          }
          if(!empty($s_TOTAL['sum(det.sac_reconditionne)'])){
            $sac_sains_reconditionne_TOTAL=$s_TOTAL['sum(det.sac_reconditionne)'];
            $poids_sains_reconditionne_TOTAL=$s_TOTAL['sum(det.poids_reconditionne)'];
          }
          else{
            $sac_sains_reconditionne_TOTAL=0;
            $poids_sains_reconditionne_TOTAL=0;
          }

          if(!empty($s_ST24H['sum(det.sac_reconditionne)'])){
            $sac_sains_reconditionne_ST24H=$s_ST24H['sum(det.sac_reconditionne)'];
            $poids_sains_reconditionne_ST24H=$s_ST24H['sum(det.poids_reconditionne)'];
          }
          else{
            $sac_sains_reconditionne_ST24H=0;
            $poids_sains_reconditionne_ST24H=0;
          }

           if(!empty($s_STT['sum(rm.sac)'])){
            $sac_sains_STT=$s_STT['sum(rm.sac)'];
            $poids_sains_STT=$s_STT['sum(rm.poids)'];
          }
          else{
            $sac_sains_STT=0;
            $poids_sains_STT=0;
          }

          if(!empty($s_STT['sum(det.sac_reconditionne)'])){
            $sac_sains_reconditionne_STT=$s_STT['sum(det.sac_reconditionne)'];
            $poids_sains_reconditionne_STT=$s_STT['sum(det.poids_reconditionne)'];
          }
          else{
            $sac_sains_reconditionne_STT=0;
            $poids_sains_reconditionne_STT=0;
          }

            if(!empty($s_G24H['sum(rm.sac)'])){
            $sac_sains_G24H=$s_G24H['sum(rm.sac)'];
            $poids_sains_G24H=$s_G24H['sum(rm.poids)'];
          }
          else{
            $sac_sains_G24H=0;
            $poids_sains_G24H=0;
          }
            if(!empty($s_G24H['sum(det.sac_reconditionne)'])){
            $sac_sains_reconditionne_G24H=$s_G24H['sum(det.sac_reconditionne)'];
            $poids_sains_reconditionne_G24H=$s_G24H['sum(det.poids_reconditionne)'];
          }
          else{
            $sac_sains_reconditionne_G24H=0;
            $poids_sains_reconditionne_G24H=0;
          }

           if(!empty($s_GT['sum(rm.sac)'])){
            $sac_sains_GT=$s_GT['sum(rm.sac)'];
            $poids_sains_GT=$s_GT['sum(rm.poids)'];
          }
          else{
            $sac_sains_GT=0;
            $poids_sains_GT=0;
          }

          if(!empty($s_GT['sum(det.sac_reconditionne)'])){
            $sac_sains_reconditionne_GT=$s_GT['sum(det.sac_reconditionne)'];
            $poids_sains_reconditionne_GT=$s_GT['sum(det.poids_reconditionne)'];
          }
          else{
            $sac_sains_reconditionne_GT=0;
            $poids_sains_reconditionne_GT=0;
            
          }


        if(!empty($av_24H['sum(av.sac_flasque)']) and !empty($av_24H['sum(av.poids_flasque)'])){
            $sac_avf_24H=$av_24H['sum(av.sac_flasque)'];
            $poids_avf_24H=$av_24H['sum(av.poids_flasque)'];
          }
          else{
            $sac_avf_24H=0;
            $poids_avf_24H=0;
          }

       if(!empty($av_24H['sum(av.sac_mouille)']) and !empty($av_24H['sum(av.poids_mouille)'])){
            $sac_avm_24H=$av_24H['sum(av.sac_mouille)'];
            $poids_avm_24H=$av_24H['sum(av.poids_mouille)'];
          }
          else{
            $sac_avm_24H=0;
            $poids_avm_24H=0;
          }

          if(!empty($av_TOTAL['sum(av.sac_mouille)']) and !empty($av_TOTAL['sum(av.poids_mouille)'])){
            $sac_avm_TOTAL=$av_TOTAL['sum(av.sac_mouille)'];
            $poids_avm_TOTAL=$av_TOTAL['sum(av.poids_mouille)'];
          }
          else{
            $sac_avm_TOTAL=0;
            $poids_avm_TOTAL=0;
          }

          if(!empty($av_TOTAL['sum(av.sac_flasque)']) and !empty($av_TOTAL['sum(av.poids_flasque)'])){
            $sac_avf_TOTAL=$av_TOTAL['sum(av.sac_flasque)'];
            $poids_avf_TOTAL=$av_TOTAL['sum(av.poids_flasque)'];
          }
          else{
            $sac_avf_TOTAL=0;
            $poids_avf_TOTAL=0;
          }


          if(!empty($av_ST24H['sum(av.sac_flasque)']) and !empty($av_ST24H['sum(av.poids_flasque)'])){
            $sac_avf_ST24H=$av_ST24H['sum(av.sac_flasque)'];
            $poids_avf_ST24H=$av_ST24H['sum(av.poids_flasque)'];
          }
          else{
            $sac_avf_ST24H=0;
            $poids_avf_ST24H=0;
          }

       if(!empty($av_ST24H['sum(av.sac_mouille)']) and !empty($av_ST24H['sum(av.poids_mouille)'])){
            $sac_avm_ST24H=$av_ST24H['sum(av.sac_mouille)'];
            $poids_avm_ST24H=$av_ST24H['sum(av.poids_mouille)'];
          }
          else{
            $sac_avm_ST24H=0;
            $poids_avm_ST24H=0;
          }

          if(!empty($av_STT['sum(av.sac_mouille)']) and !empty($av_STT['sum(av.poids_mouille)'])){
            $sac_avm_STT=$av_STT['sum(av.sac_mouille)'];
            $poids_avm_STT=$av_STT['sum(av.poids_mouille)'];
          }
          else{
            $sac_avm_STT=0;
            $poids_avm_STT=0;
          }

          if(!empty($av_STT['sum(av.sac_flasque)']) and !empty($av_STT['sum(av.poids_flasque)'])){
            $sac_avf_STT=$av_STT['sum(av.sac_flasque)'];
            $poids_avf_STT=$av_STT['sum(av.poids_flasque)'];
          }
          else{
            $sac_avf_STT=0;
            $poids_avf_STT=0;
          }
  


          if(!empty($av_G24H['sum(av.sac_flasque)']) and !empty($av_G24H['sum(av.poids_flasque)'])){
            $sac_avf_G24H=$av_G24H['sum(av.sac_flasque)'];
            $poids_avf_G24H=$av_G24H['sum(av.poids_flasque)'];
          }
          else{
            $sac_avf_G24H=0;
            $poids_avf_G24H=0;
          }


       if(!empty($av_G24H['sum(av.sac_mouille)']) and !empty($av_G24H['sum(av.poids_mouille)'])){
            $sac_avm_G24H=$av_G24H['sum(av.sac_mouille)'];
            $poids_avm_G24H=$av_G24H['sum(av.poids_mouille)'];
          }
          else{
            $sac_avm_G24H=0;
            $poids_avm_G24H=0;
          }

          if(!empty($av_GT['sum(av.sac_mouille)']) and !empty($av_GT['sum(av.poids_mouille)'])){
            $sac_avm_GT=$av_GT['sum(av.sac_mouille)'];
            $poids_avm_GT=$av_GT['sum(av.poids_mouille)'];
          }
          else{
            $sac_avm_GT=0;
            $poids_avm_GT=0;
          }

          if(!empty($av_GT['sum(av.sac_flasque)']) and !empty($av_GT['sum(av.poids_flasque)'])){
            $sac_avf_GT=$av_GT['sum(av.sac_flasque)'];
            $poids_avf_GT=$av_GT['sum(av.poids_flasque)'];
          }
          else{
            $sac_avf_GT=0;
            $poids_avf_GT=0;
          }
  

        ?>

       	
          <?php if(!empty($cal2['produit']) and !empty($cal2['conditionnement']) and !empty($cal2['cales'])) {


            ?>

            <tr class="CelluleTableSituation" >
    <td class="colLibeles"   ><?php echo $cal2['cales']; ?> </td>
    <td class="colLibeles"     ><?php echo $cal2['produit']; ?> <?php echo $cal2['conditionnement']; ?> KGS</td>
    
    <td  scope="col" class="colManifeste"  ><?php echo number_format($cal2['sum(dc.nombre_sac)'], 0,',',' ');  ?></td>
    <td  scope="col" class="colManifeste" ><?php echo number_format($cal2['sum(dc.poids)'], 3,',',' '); ?></td>
    
     	<td class="colDeb24H" scope="col" ><?php echo number_format(/*$sac_avaries + $sac_sains +$sac_m */ $sac_sains_24H +$sac_avf_24H + $sac_avm_24H-$sac_sains_reconditionne_24H, 0,',',' '); ?></td>
     	<td class="colDeb24H" scope="col"  ><?php echo number_format(/*$poids_avaries + $poids_sains +$poids_m*/ $poids_sains_24H +$poids_avf_24H + $poids_avm_24H - $poids_sains_reconditionne_24H , 3,',',' '); ?></td>
     	<td scope="col" class="colDebTOTAL"><?php echo number_format(/*$sac_avariesT + $sac_sainsT +$sac_mT */ $sac_sains_TOTAL +$sac_avf_TOTAL + $sac_avm_TOTAL - $sac_sains_reconditionne_TOTAL, 0,',',' '); ?></td>
     	<td scope="col" class="colDebTOTAL"><?php echo number_format(/*$poids_avariesT + $poids_sainsT +$poids_mT */ $poids_sains_TOTAL +$poids_avf_TOTAL + $poids_avm_TOTAL - $poids_sains_reconditionne_TOTAL , 3,',',' '); ?></td>
     <td scope="col" class="colROB"><?php echo number_format($cal2['sum(dc.nombre_sac)']-($sac_sains_TOTAL +$sac_avf_TOTAL + $sac_avm_TOTAL- $sac_sains_reconditionne_TOTAL ), 0,',',' '); ?></td>
     	<td scope="col" class="colROB" ><?php echo number_format($cal2['sum(dc.poids)']-($poids_sains_TOTAL +$poids_avf_TOTAL + $poids_avm_TOTAL- $poids_sains_reconditionne_TOTAL ), 3,',',' '); ?></td>
     </tr>




     <?php } ?>

      <?php if(empty($cal2['produit']) and empty($cal2['conditionnement']) and !empty($cal2['cales'])) {?>

      <tr class="sousTOTAL"> 
      <td  colspan="2">  TOTAL <?php  echo $cal2['cales'];  ?></td>
      <td  scope="col" ><?php echo number_format($cal2['sum(dc.nombre_sac)'], 0,',',' '); ?></td>
       <td  scope="col" ><?php echo number_format($cal2['sum(dc.poids)'], 3,',',' '); ?></td>
        <td  scope="col"  ><?php echo number_format($sac_sains_ST24H +$sac_avf_ST24H +$sac_avm_ST24H- $sac_sains_reconditionne_ST24H , 0,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format($poids_sains_ST24H  +$poids_avf_ST24H +$poids_avm_ST24H - $poids_sains_reconditionne_ST24H, 3,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format($sac_sains_STT +$sac_avf_STT +$sac_avm_STT -$sac_sains_reconditionne_STT, 0,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format($poids_sains_STT +$poids_avf_STT +$poids_avm_STT - $poids_sains_reconditionne_STT, 3,',',' '); ?></td>
          <td scope="col"  ><?php echo number_format($cal2['sum(dc.nombre_sac)']- ($sac_sains_STT +$sac_avf_STT +$sac_avm_STT -$sac_sains_reconditionne_STT) , 0,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format($cal2['sum(dc.poids)']- ($poids_sains_STT +$poids_avf_STT +$poids_avm_STT -$poids_sains_reconditionne_STT) , 3,',',' '); ?></td>          

     </tr>
   <?php  } ?>

    <?php if(empty($cal2['produit']) and empty($cal2['conditionnement']) and empty($cal2['cales'])) {?>
      <tr class="TOTAL" >
       <td  colspan="2">  TOTAL <?php  echo $cal2['cales'];  ?></td>
      <td  scope="col" ><?php echo number_format($cal2['sum(dc.nombre_sac)'], 0,',',' '); ?></td>
       <td  scope="col" ><?php echo number_format($cal2['sum(dc.poids)'], 3,',',' '); ?></td>
        <td  scope="col"  ><?php echo number_format($sac_sains_G24H +$sac_avf_G24H +$sac_avm_G24H - $sac_sains_reconditionne_G24H  , 0,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format($poids_sains_G24H +$poids_avf_G24H +$poids_avm_G24H - $poids_sains_reconditionne_G24H , 3,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format($sac_sains_GT +$sac_avf_GT +$sac_avm_GT - $sac_sains_reconditionne_GT , 0,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format($poids_sains_GT +$poids_avf_GT +$poids_avm_GT - $poids_sains_reconditionne_GT  , 3,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format($cal2['sum(dc.nombre_sac)']- ($sac_sains_GT +$sac_avf_GT +$sac_avm_GT - $sac_sains_reconditionne_GT) , 0,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format($cal2['sum(dc.poids)']- ($poids_sains_GT +$poids_avf_GT +$poids_avm_GT - $poids_sains_reconditionne_GT) , 3,',',' '); ?></td> 
        </tr>
     
    

     <?php }

     }  ?>
    
 
      
	 </tbody>


 </table>
</div>

<?php if(!empty($trP['dates'])){
            $DateDebut=explode('-',$tr['dates']);
           if(!empty($tr2P['dates'])){
            $DateActuel=explode('-',$tr2P['dates']);?>

           

  <table class='table table-bordered ' id='table' border='2' style="margin-top:0px !important;" >
    

<thead>
           <tr style="background: blue; color: white; text-align: center; font-weight: bold; vertical-align: middle;" >
           <td colspan="10" ><h5 style="color: white;"> SITUATION DU DEBARQUEMENT (SAINS + AVARIES) <span style="color:yellow;">PAR PRODUIT</span> DU <span style="color: red; background: white;"><?php echo  $DateActuel[2]. '-' .$DateActuel[1].'-'.$DateActuel[0];?></span></h5></td></tr>
<?php 
         }  }
   ?>
          
  
 <tr  class="EnteteTableSituation"  style="font-size: 12px;">
      
      
      <td scope="col"  rowspan="2" class="colLibeles" >PRODUIT</td>
       <td scope="col"  rowspan="2" class="colLibeles" >CALES</td>
      <td scope="col" colspan="2" class="colManifeste" >MANIFESTE</td>
      <td scope="col" colspan="2" class="colDeb24H" >DEB 24H</td>
      <td scope="col" colspan="2" class="colDebTOTAL" > TOTAL DEB</td>
      <td scope="col" colspan="2" class="colROB" >ROB</td>
  </tr>
    <tr class="EnteteTableSituation" >
      
      <td scope="col" class="colManifeste">NBRE SACS</td>
      <td scope="col" class="colManifeste">POIDS</td>
        <td scope="col" class="colDeb24H">NBRE SACS</td>
      <td scope="col" class="colDeb24H">POIDS</td>
        <td scope="col" class="colDebTOTAL">NBRE SACS</td>
      <td scope="col"  class="colDebTOTAL">POIDS</td>
        <td scope="col" class="colROB">NBRE SACS</td>
      <td scope="col" class="colROB">POIDS</td>
        
     
     
 
         </tr>
         </thead> 

<?php 
        
       while($prod=$produit->fetch()){

        //---REQUETE SAINS ET AVARIES DEBARQUES EN 24 PAR CALE ET PRODUIT
   $avaries_deb24H=$bdd->prepare("SELECT av.* ,dc.*, sum(av.sac_flasque),sum(av.poids_flasque),sum(av.sac_mouille),sum(av.poids_mouille) from declaration_chargement as dc 
        inner join avaries as av  on dc.id_dec=av.cale_avaries  where dc.id_navire=? and av.date_avaries=? and dc.conditionnement=? and dc.id_produit=? AND dc.cales=?   ");
                  
                  $avaries_deb24H->bindParam(1,$a[0]);
                  $avaries_deb24H->bindParam(2,$a[1]);
                  $avaries_deb24H->bindParam(3,$prod['conditionnement']);
                  $avaries_deb24H->bindParam(4,$prod['id_produit']);
                  $avaries_deb24H->bindParam(5,$prod['cales']);
                
          $avaries_deb24H->execute();

       
          $sain_deb24H=$bdd->prepare("SELECT dc.*,count(dc.cales), sum(dc.nombre_sac), sum(dc.poids), p.*,sum(rm.sac),sum(rm.poids),sum(det.sac_reconditionne),sum(det.poids_reconditionne) FROM declaration_chargement as dc LEFT join produit_deb as p on dc.id_produit=p.id
         inner join transfert_debarquement as rm on rm.cale=dc.id_dec
         left join detail_chargement as det on det.register_manif_id=rm.id_register_manif
           where rm.id_navire=? and rm.dates=? and dc.conditionnement=? and dc.id_produit=?  and dc.cales=? and rm.statut='sain'  ");

                  $sain_deb24H->bindParam(1,$a[0]);
                  $sain_deb24H->bindParam(2,$a[1]);
                  $sain_deb24H->bindParam(3,$prod['conditionnement']);
                  $sain_deb24H->bindParam(4,$prod['id_produit']);
                  $sain_deb24H->bindParam(5,$prod['cales']);
                 
          $sain_deb24H->execute();

        //---REQUETE SAINS ET AVARIES DEBARQUES TOTAL PAR CALE ET PRODUIT
          $avaries_debT=$bdd->prepare("SELECT av.* ,dc.*, sum(av.sac_flasque),sum(av.poids_flasque),sum(av.sac_mouille),sum(av.poids_mouille) from declaration_chargement as dc 
        inner join avaries as av  on dc.id_dec=av.cale_avaries  where dc.id_navire=? and av.date_avaries<=? and dc.conditionnement=? and dc.id_produit=? AND dc.cales=?  ");
                  $avaries_debT->bindParam(1,$a[0]);
                  $avaries_debT->bindParam(2,$a[1]);
                  $avaries_debT->bindParam(3,$prod['conditionnement']);
                  $avaries_debT->bindParam(4,$prod['id_produit']);
                  $avaries_debT->bindParam(5,$prod['cales']);
                  
          $avaries_debT->execute();

          $sain_debT=$bdd->prepare("SELECT dc.*,count(dc.cales), sum(dc.nombre_sac), sum(dc.poids), p.*,sum(rm.sac),sum(rm.poids),sum(det.sac_reconditionne),sum(det.poids_reconditionne) FROM declaration_chargement as dc LEFT join produit_deb as p on dc.id_produit=p.id
         inner join transfert_debarquement as rm on rm.cale=dc.id_dec
         left join detail_chargement as det on det.register_manif_id=rm.id_register_manif
           where rm.id_navire=? and rm.dates<=? and dc.conditionnement=? and dc.id_produit=? and dc.cales=? and rm.statut='sain'  ");

                  $sain_debT->bindParam(1,$a[0]);
                  $sain_debT->bindParam(2,$a[1]);
                  $sain_debT->bindParam(3,$prod['conditionnement']);
                  $sain_debT->bindParam(4,$prod['id_produit']);
                  $sain_debT->bindParam(5,$prod['cales']);
                 
          $sain_debT->execute();



 //---REQUETE SOUS TOTAL  SAINS ET AVARIES TOTAL DEBARQUES EN 24 PAR CALE 
           $avaries_debST24H=$bdd->prepare("SELECT av.* ,dc.*, sum(av.sac_flasque),sum(av.poids_flasque),sum(av.sac_mouille),sum(av.poids_mouille) from declaration_chargement as dc 
        inner join avaries as av  on dc.id_dec=av.cale_avaries where dc.id_navire=? and av.date_avaries=? and dc.conditionnement=? and dc.id_produit=?    ");
                  $avaries_debST24H->bindParam(1,$a[0]);              
                  $avaries_debST24H->bindParam(2,$a[1]);
                  $avaries_debST24H->bindParam(3,$prod['conditionnement']);
                  $avaries_debST24H->bindParam(4,$prod['id_produit']);
                   
                 
          $avaries_debST24H->execute();

         $sain_debST24H=$bdd->prepare("SELECT dc.*,count(dc.cales), sum(dc.nombre_sac), sum(dc.poids), p.*,sum(rm.sac),sum(rm.poids),sum(det.sac_reconditionne),sum(det.poids_reconditionne) FROM declaration_chargement as dc LEFT join produit_deb as p on dc.id_produit=p.id
         inner join transfert_debarquement as rm on rm.cale=dc.id_dec
         left join detail_chargement as det on det.register_manif_id=rm.id_register_manif  where dc.id_navire=?
         
          and rm.dates=? and dc.conditionnement=? and dc.id_produit=?  and rm.statut='sain'   ");

                  $sain_debST24H->bindParam(1,$a[0]);
                  $sain_debST24H->bindParam(2,$a[1]);
                  $sain_debST24H->bindParam(3,$prod['conditionnement']);
                  $sain_debST24H->bindParam(4,$prod['id_produit']);
             
  
          $sain_debST24H->execute(); 

 //---REQUETE SOUS TOTAL SAINS ET AVARIES TOTAL DEBARQUES EN  PAR CALE DEPUIS LE DEBUT DU DEBARQUEMENT
          $avaries_debSTT=$bdd->prepare("SELECT av.* ,dc.*, sum(av.sac_flasque),sum(av.poids_flasque),sum(av.sac_mouille),sum(av.poids_mouille) from declaration_chargement as dc 
        inner join avaries as av  on dc.id_dec=av.cale_avaries

           where dc.id_navire=? and av.date_avaries<=? and dc.conditionnement=? and dc.id_produit=?   ");
                  $avaries_debSTT->bindParam(1,$a[0]);
                  $avaries_debSTT->bindParam(2,$a[1]);
                  $avaries_debSTT->bindParam(3,$prod['conditionnement']);
                  $avaries_debSTT->bindParam(4,$prod['id_produit']);                  
                  
                  
          $avaries_debSTT->execute();

         $sain_debSTT=$bdd->prepare("SELECT dc.*,count(dc.cales), sum(dc.nombre_sac), sum(dc.poids), p.*,sum(rm.sac),sum(rm.poids),sum(det.sac_reconditionne),sum(det.poids_reconditionne) FROM declaration_chargement as dc LEFT join produit_deb as p on dc.id_produit=p.id
         inner join transfert_debarquement as rm on rm.cale=dc.id_dec
         left join detail_chargement as det on det.register_manif_id=rm.id_register_manif
           where dc.id_navire=? and rm.dates<=? and dc.conditionnement=? and dc.id_produit=? and rm.statut='sain'  ");

                  $sain_debSTT->bindParam(1,$a[0]);
                  $sain_debSTT->bindParam(2,$a[1]);
                  $sain_debSTT->bindParam(3,$prod['conditionnement']);
                  $sain_debSTT->bindParam(4,$prod['id_produit']); 
                
      
          $sain_debSTT->execute(); 


    //---REQUETE  TOTAL GENERAL SAINS ET AVARIES TOTAL DEBARQUES DES CALES DEPUIS LE DEBUT DU DEBARQUEMENT 24H
          $avaries_debG24H=$bdd->prepare("SELECT av.* ,dc.*, sum(av.sac_flasque),sum(av.poids_flasque),sum(av.sac_mouille),sum(av.poids_mouille) from declaration_chargement as dc 
        inner join avaries as av  on dc.id_dec=av.cale_avaries  where dc.id_navire=? and av.date_avaries=?     ");
                  $avaries_debG24H->bindParam(1,$a[0]);
                  $avaries_debG24H->bindParam(2,$a[1]);
                  
                  
          $avaries_debG24H->execute();

         $sain_debG24H=$bdd->prepare("SELECT dc.*,count(dc.cales), sum(dc.nombre_sac), sum(dc.poids), p.*,sum(rm.sac),sum(rm.poids),sum(det.sac_reconditionne),sum(det.poids_reconditionne) FROM declaration_chargement as dc LEFT join produit_deb as p on dc.id_produit=p.id
         inner join transfert_debarquement as rm on rm.cale=dc.id_dec
         left join detail_chargement as det on det.register_manif_id=rm.id_register_manif  where rm.id_navire=? and rm.dates=? and rm.statut='sain'   ");

                  $sain_debG24H->bindParam(1,$a[0]);
                  $sain_debG24H->bindParam(2,$a[1]);
                  
      
          $sain_debG24H->execute(); 


     //---REQUETE  TOTAL GENERAL SAINS ET AVARIES TOTAL DEBARQUES DES CALES DEPUIS LE DEBUT DU DEBARQUEMENT TOTAL
          $avaries_debGT=$bdd->prepare("SELECT av.* ,dc.*, sum(av.sac_flasque),sum(av.poids_flasque),sum(av.sac_mouille),sum(av.poids_mouille) from declaration_chargement as dc 
        inner join avaries as av  on dc.id_dec=av.cale_avaries  where dc.id_navire=? and av.date_avaries<=?     ");
                  $avaries_debGT->bindParam(1,$a[0]);
                  $avaries_debGT->bindParam(2,$a[1]);
                  
                  
          $avaries_debGT->execute();

         $sain_debGT=$bdd->prepare("SELECT dc.*,count(dc.cales), sum(dc.nombre_sac), sum(dc.poids), p.*,sum(rm.sac),sum(rm.poids),sum(det.sac_reconditionne),sum(det.poids_reconditionne) FROM declaration_chargement as dc LEFT join produit_deb as p on dc.id_produit=p.id
         inner join transfert_debarquement as rm on rm.cale=dc.id_dec
         left join detail_chargement as det on det.register_manif_id=rm.id_register_manif
           where rm.id_navire=? and rm.dates<=?  and rm.statut='sain'   ");

                  $sain_debGT->bindParam(1,$a[0]);
                  $sain_debGT->bindParam(2,$a[1]);
                  
          $sain_debGT->execute();           




          



      $av_deb=$avaries_deb24H->fetch();
       $s_deb=$sain_deb24H->fetch();
      $av_debT=$avaries_debT->fetch();
       $s_debT=$sain_debT->fetch();
       //$avaries2=$fm->fetch();
       $av_debST=$avaries_debST24H->fetch();
       $s_debST=$sain_debST24H->fetch();

       $av_debSTT=$avaries_debSTT->fetch();
       $s_debSTT=$sain_debSTT->fetch();

       $av_debG=$avaries_debG24H->fetch();
       $s_debG=$sain_debG24H->fetch();

       $av_debGT=$avaries_debGT->fetch();
       $s_debGT=$sain_debGT->fetch();


      //VARIABLES AVARIES
      if(empty($av_deb['sum(av.sac_flasque)'])){
        $sac_avaries=0;
      }
      else{
        $sac_avaries= $av_deb['sum(av.sac_flasque)'];
      }
      if(empty($av_deb['sum(av.poids_flasque)'])){
        $poids_avaries=0;
      }
      else{
        $poids_avaries= $av_deb['sum(av.poids_flasque)'];
      }

      if(empty($av_deb['sum(av.sac_mouille)'])){
        $sac_m=0;
      }
      else{
        $sac_m= $av_deb['sum(av.sac_mouille)'];
      }
      if(empty($av_deb['sum(av.poids_mouille)'])){
        $poids_m=0;
      }
      else{
        $poids_m= $av_deb['sum(av.poids_mouille)'];
      }      

    if(empty($av_debT['sum(av.sac_flasque)'])){
        $sac_avariesT=0;
      }
      else{
        $sac_avariesT= $av_debT['sum(av.sac_flasque)'];
      }
      if(empty($av_debT['sum(av.poids_flasque)'])){
        $poids_avariesT=0;
      }
      else{
        $poids_avariesT= $av_debT['sum(av.poids_flasque)'];
      }

      if(empty($av_debT['sum(av.sac_mouille)'])){
        $sac_mT=0;
      }
      else{
        $sac_mT= $av_debT['sum(av.sac_mouille)'];
      }
      if(empty($av_debT['sum(av.poids_mouille)'])){
        $poids_mT=0;
      }
      else{
        $poids_mT= $av_debT['sum(av.poids_mouille)'];
      }

      if(empty($av_debST['sum(av.sac_flasque)'])){
        $sac_avariesST=0;
      }
      else{
        $sac_avariesST= $av_debST['sum(av.sac_flasque)'];
      }
      if(empty($av_debST['sum(av.poids_flasque)'])){
        $poids_avariesST=0;
      }
      else{
        $poids_avariesST= $av_debST['sum(av.poids_flasque)'];
      }

      if(empty($av_debST['sum(av.sac_mouille)'])){
        $sac_mST=0;
      }
      else{
        $sac_mST= $av_debST['sum(av.sac_mouille)'];
      }
      if(empty($av_debST['sum(av.poids_mouille)'])){
        $poids_mST=0;
      }
      else{
        $poids_mST= $av_debST['sum(av.poids_mouille)'];
      }


      if(empty($av_debSTT['sum(av.sac_flasque)'])){
        $sac_avariesSTT=0;
      }
      else{
        $sac_avariesSTT= $av_debSTT['sum(av.sac_flasque)'];
      }
      if(empty($av_debSTT['sum(av.poids_flasque)'])){
        $poids_avariesSTT=0;
      }
      else{
        $poids_avariesSTT= $av_debSTT['sum(av.poids_flasque)'];
      }


      if(empty($av_debSTT['sum(av.sac_mouille)'])){
        $sac_mSTT=0;
      }
      else{
        $sac_mSTT= $av_debSTT['sum(av.sac_mouille)'];
      }
      if(empty($av_debSTT['sum(av.poids_mouille)'])){
        $poids_mSTT=0;
      }
      else{
        $poids_mSTT= $av_debSTT['sum(av.poids_mouille)'];
      }


      if(empty($av_debG['sum(av.sac_flasque)'])){
        $sac_avariesG=0;
      }
      else{
        $sac_avariesG= $av_debG['sum(av.sac_flasque)'];
      }
      if(empty($av_debG['sum(av.poids_flasque)'])){
        $poids_avariesG=0;
      }
      else{
        $poids_avariesG= $av_debG['sum(av.poids_flasque)'];
      }

      if(empty($av_debG['sum(av.sac_mouille)'])){
        $sac_mG=0;
      }
      else{
        $sac_mG= $av_debG['sum(av.sac_mouille)'];
      }
      if(empty($av_debG['sum(av.poids_mouille)'])){
        $poids_mG=0;
      }
      else{
        $poids_mG= $av_debG['sum(av.poids_mouille)'];
      }


      if(empty($av_debGT['sum(av.sac_flasque)'])){
        $sac_avariesGT=0;
      }
      else{
        $sac_avariesGT= $av_debGT['sum(av.sac_flasque)'];
      }
      if(empty($av_debGT['sum(av.poids_flasque)'])){
        $poids_avariesGT=0;
      }
      else{
        $poids_avariesGT= $av_debGT['sum(av.poids_flasque)'];
      }


     if(empty($av_debGT['sum(av.sac_mouille)'])){
        $sac_mGT=0;
      }
      else{
        $sac_mGT= $av_debGT['sum(av.sac_mouille)'];
      }
      if(empty($av_debGT['sum(av.poids_mouille)'])){
        $poids_mGT=0;
      }
      else{
        $poids_mGT= $av_debGT['sum(av.poids_mouille)'];
      }


      //VARIABLES SAINS------------------------------------------

      if(empty($s_deb['sum(rm.sac)'])){
        $sac_sains=0;
      }
      else{
        $sac_sains= $s_deb['sum(rm.sac)'];
      }
      if(empty($s_deb['sum(rm.poids)'])){
        $poids_sains=0;
      }
      else{
        $poids_sains= $s_deb['sum(rm.poids)'];
      }

      if(empty($s_deb['sum(det.sac_reconditionne)'])){
        $sac_sains_reconditionne=0;
      }
      else{
        $sac_sains_reconditionne= $s_deb['sum(det.sac_reconditionne)'];
      }
      if(empty($s_deb['sum(det.poids_reconditionne)'])){
        $poids_sains_reconditionne=0;
      }
      else{
        $poids_sains_reconditionne= $s_deb['sum(det.poids_reconditionne)'];
      }


      if(empty($s_debT['sum(rm.sac)'])){
        $sac_sainsT=0;
      }
      else{
        $sac_sainsT= $s_debT['sum(rm.sac)'];
      }
      if(empty($s_debT['sum(rm.poids)'])){
        $poids_sainsT=0;
      }
      else{
        $poids_sainsT= $s_debT['sum(rm.poids)'];
      }

      if(empty($s_debT['sum(det.sac_reconditionne)'])){
        $sac_sains_reconditionneT=0;
      }
      else{
        $sac_sains_reconditionneT= $s_deb['sum(det.sac_reconditionne)'];
      }
      if(empty($s_debT['sum(det.poids_reconditionne)'])){
        $poids_sains_reconditionneT=0;
      }
      else{
        $poids_sains_reconditionneT= $s_deb['sum(det.poids_reconditionne)'];
      }

      if(empty($s_debST['sum(rm.sac)'])){
        $sac_sainsST=0;
      }
      else{
        $sac_sainsST= $s_debST['sum(rm.sac)'];
      }
      if(empty($s_debST['sum(rm.poids)'])){
        $poids_sainsST=0;
      }
      else{
        $poids_sainsST= $s_debST['sum(rm.poids)'];
      }

      if(empty($s_debST['sum(det.sac_reconditionne)'])){
        $sac_sains_reconditionneST=0;
      }
      else{
        $sac_sains_reconditionneST= $s_debST['sum(det.sac_reconditionne)'];
      }
      if(empty($s_debST['sum(det.poids_reconditionne)'])){
        $poids_sains_reconditionneST=0;
      }
      else{
        $poids_sains_reconditionneST= $s_debST['sum(det.poids_reconditionne)'];
      }

       if(empty($s_debSTT['sum(rm.sac)'])){
        $sac_sainsSTT=0;
      }
      else{
        $sac_sainsSTT= $s_debSTT['sum(rm.sac)'];
      }
      if(empty($s_debSTT['sum(rm.poids)'])){
        $poids_sainsSTT=0;
      }
      else{
        $poids_sainsSTT= $s_debSTT['sum(rm.poids)'];
      }

      if(empty($s_debSTT['sum(det.sac_reconditionne)'])){
        $sac_sains_reconditionneSTT=0;
      }
      else{
        $sac_sains_reconditionneSTT= $s_debSTT['sum(det.sac_reconditionne)'];
      }
      if(empty($s_debSTT['sum(det.poids_reconditionne)'])){
        $poids_sains_reconditionneSTT=0;
      }
      else{
        $poids_sains_reconditionneSTT= $s_debSTT['sum(det.poids_reconditionne)'];
      }

      if(empty($s_debG['sum(rm.sac)'])){
        $sac_sainsG=0;
      }
      else{
        $sac_sainsG= $s_debG['sum(rm.sac)'];
      }
      if(empty($s_debG['sum(rm.poids)'])){
        $poids_sainsG=0;
      }
      else{
        $poids_sainsG= $s_debG['sum(rm.poids)'];
      }

      if(empty($s_debG['sum(det.sac_reconditionne)'])){
        $sac_sains_reconditionneG=0;
      }
      else{
        $sac_sains_reconditionneG= $s_debG['sum(det.sac_reconditionne)'];
      }
      if(empty($s_debG['sum(det.poids_reconditionne)'])){
        $poids_sains_reconditionneG=0;
      }
      else{
        $poids_sains_reconditionneG= $s_debG['sum(det.poids_reconditionne)'];
      }

      if(empty($s_debGT['sum(rm.sac)'])){
        $sac_sainsGT=0;
      }
      else{
        $sac_sainsGT= $s_debGT['sum(rm.sac)'];
      }
      if(empty($s_debGT['sum(rm.poids)'])){
        $poids_sainsGT=0;
      }

      else{
        $poids_sainsGT= $s_debGT['sum(rm.poids)'];
      } 

      if(empty($s_debGT['sum(det.sac_reconditionne)'])){
        $sac_sains_reconditionneGT=0;
      }
      else{
        $sac_sains_reconditionneGT= $s_debGT['sum(det.sac_reconditionne)'];
      }
      if(empty($s_debGT['sum(det.poids_reconditionne)'])){
        $poids_sains_reconditionneGT=0;
      }
      else{
        $poids_sains_reconditionneGT= $s_debGT['sum(det.poids_reconditionne)'];
      } 

     /*  $prodT=$produitT->fetch();
       $avariesT=$fmpT->fetch();
       $avaries2=$fmp->fetch();
        
       
       $sum_sac=$prod['nombre_sac'] -$prodT['sum(rm.sac)']-$avariesT['sum(sac_flasque)']-$avariesT['sum(sac_mouille)'];

       $poids=$prod['nombre_sac']*$prod['conditionnement']/1000;
       $sum_poids=$poids-$prodT['sum(rm.poids)']-$avaries2['sum(poids_flasque)']-$avaries2['sum(poids_mouille)'];

       $sacs_24H=$prod['sum(rm.sac)']+$avaries2['sum(sac_flasque)']+$avaries2['sum(sac_mouille)'];

        $poids_24H=$prod['sum(rm.poids)']+$avaries2['sum(poids_flasque)']+$avaries2['poids_mouille'];

        $total_sac=$prodT['sum(rm.sac)']+$avariesT['sum(sac_flasque)']+$avariesT['sum(sac_mouille)'];
        $total_poids=$prodT['sum(rm.poids)']+$avariesT['sum(poids_flasque)']+$avariesT['sum(poids_mouille)']; */

        ?>

        <tr class="EnteteTableSituation" style="text-align: center;">
          <?php if(!empty($prod['produit']) and !empty($prod['conditionnement']) and !empty($prod['cales']) ) {?>
    
    <td scope="col" class="colLibeles" ><?php echo $prod['produit']; ?> <?php echo $prod['conditionnement']; ?> KGS</td>
    <td scope="col" class="colLibeles" ><?php echo $prod['cales']; ?></td>
    <td scope="col"  class="colManifeste"><?php echo number_format($prod['sum(dc.nombre_sac)'], 0,',',' ');  ?></td>
    <td scope="col" class="colManifeste"  ><?php echo number_format($prod['sum(dc.poids)'], 3,',',' '); ?></td>
        <td class="colDeb24H" scope="col" ><?php echo number_format($sac_avaries + $sac_sains +$sac_m -$sac_sains_reconditionne, 0,',',' '); ?></td>
      <td class="colDeb24H" scope="col"  ><?php echo number_format($poids_avaries + $poids_sains +$poids_m -$poids_sains_reconditionne , 3,',',' '); ?></td>
      <td scope="col" class="colDebTOTAL"><?php echo number_format($sac_avariesT + $sac_sainsT +$sac_mT -$sac_sains_reconditionneT, 0,',',' '); ?></td>
      <td scope="col" class="colDebTOTAL"><?php echo number_format($poids_avariesT + $poids_sainsT +$poids_mT -$poids_sains_reconditionneT , 3,',',' '); ?></td>
     <td scope="col" class="colROB"><?php echo number_format($prod['sum(dc.nombre_sac)']-($sac_avariesT + $sac_sainsT +$sac_mT -$sac_sains_reconditionneT), 0,',',' '); ?></td>
      <td scope="col" class="colROB" ><?php echo number_format($prod['sum(dc.poids)']-($poids_avariesT + $poids_sainsT +$poids_mT - $poids_sains_reconditionneT), 3,',',' '); ?></td>
     <?php } ?>

     <?php if(!empty($prod['produit']) and !empty($prod['conditionnement']) and empty($prod['cales']) ) {?>
     <tr class="sousTOTAL" > 
      <td  colspan="2">  TOTAL <?php  echo $prod['produit'];  ?>  <?php  echo $prod['conditionnement'].' KG';  ?></td>
      <td  scope="col" ><?php echo number_format($prod['sum(dc.nombre_sac)'], 0,',',' '); ?></td>
       <td scope="col" ><?php echo number_format($prod['sum(dc.poids)'], 3,',',' '); ?></td>
        <td  scope="col"  ><?php echo number_format($sac_avariesST + $sac_sainsST + $sac_mST -$sac_sains_reconditionneST , 0,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format($poids_avariesST + $poids_sainsST + $poids_mST -$poids_sains_reconditionneST , 3,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format($sac_avariesSTT + $sac_sainsSTT +$sac_mSTT  -$sac_sains_reconditionneSTT , 0,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format($poids_avariesSTT + $poids_sainsSTT + $poids_mSTT -$poids_sains_reconditionneSTT , 3,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format($prod['sum(dc.nombre_sac)']- ($sac_avariesSTT + $sac_sainsSTT + $sac_mSTT -$sac_sains_reconditionneSTT) , 0,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format($prod['sum(dc.poids)']- ($poids_avariesSTT + $poids_sainsSTT + $poids_mSTT -$poids_sains_reconditionneSTT) , 3,',',' '); ?></td>          

     </tr> <?php //} ?>
     <?php } ?>


     <?php if(empty($prod['produit']) and empty($prod['conditionnement']) and empty($prod['cales']) ) {?>
    <tr class="TOTAL" >
       <td  colspan="2">  TOTAL <?php  echo $prod['cales'];  ?></td>
      <td  scope="col" ><?php echo number_format($prod['sum(dc.nombre_sac)'], 0,',',' '); ?></td>
       <td  scope="col" ><?php echo number_format($prod['sum(dc.poids)'], 3,',',' '); ?></td>
        <td  scope="col"  ><?php echo number_format($sac_avariesG + $sac_sainsG + $sac_mG -$sac_sains_reconditionneG , 0,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format($poids_avariesG + $poids_sainsG + $poids_mG -$poids_sains_reconditionneG , 3,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format($sac_avariesGT + $sac_sainsGT + $sac_mGT -$sac_sains_reconditionneGT , 0,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format($poids_avariesGT + $poids_sainsGT + $poids_mGT -$poids_sains_reconditionneGT , 3,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format($prod['sum(dc.nombre_sac)']- ($sac_avariesGT + $sac_sainsGT + $sac_mGT -$sac_sains_reconditionneGT) , 0,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format($prod['sum(dc.poids)']- ($poids_avariesGT + $poids_sainsGT + $poids_mGT -$poids_sains_reconditionneGT) , 3,',',' '); ?></td> 
        </tr>
     <?php } ?>


     <?php }  ?>
    
 
      
     

 </table>






<a style="margin:auto-right;" class="btn btn-primary no_print" data-role="imprimer_par_cale">imprimer </a>



<!-- Ajoutez d'autres boutons avec des IDs de table différents si nécessaire -->

</div>


<?php $sain_visible=$_POST['deb_sain']; ?>

<div class="col col-lg-12" id="deb_by_sain"   <?php if($sain_visible==0){

 ?> style="display: none; " <?php } ?>  <?php if($sain_visible==1){

 ?> style="display: block;" <?php } ?> >




<div class="table-responsive"  >
            <?php if(!empty($tr['dates'])){
            $DateDebut=explode('-',$tr['dates']);
           if(!empty($tr2['dates'])){
            $DateActuel=explode('-',$tr2['dates']);?>

 <table class='table table-bordered ' id='table'  style="margin-bottom:0px !important;">
    

<thead>
           <tr style="background: linear-gradient(to bottom, blue, #1B2B65); background: linear-gradient(to left, blue, #1B2B65); background: linear-gradient(to top, blue, #1B2B65); color: white; text-align: center; font-weight: bold; vertical-align: middle; " >
           <td colspan="10" ><h5 style="color: white;"> SITUATION DU DEBARQUEMENT (SAINS) <span style="color:yellow;">PAR CALE </span> DU <span style="color: red; background: white;"><?php echo  $DateActuel[2]. '-' .$DateActuel[1].'-'.$DateActuel[0];?></span> <!-- <select id="situation_par_cale_filtre" style="float:left;" onchange="VisibleAvariesParCaleFiltre()"><option selected>GLOBALE</option>
            <option >SAINS</option>
            <option value="avaries" > AVARIES</option></select> !--> </h5></td> </tr>
<?php 
         }  }
     ?>
            



    
 <tr class="EnteteTableSituation" style="font-size: 12px;" >
      

      <td  class="colLibeles" scope="col"  rowspan="2"  >CALES</td>
      <td class="colLibeles" scope="col"  rowspan="2"  >PRODUIT</td>
      <td class="colManifeste" colspan="2" >MANIFESTE</td>
      <td scope="col" colspan="2" class="colDeb24H" >DEB 24H</td>
      <td scope="col" colspan="2" class="colDebTOTAL" > TOTAL DEB</td>
      <td scope="col" colspan="2" class="colROB">ROB</td>
  </tr>
    <tr class="EnteteTableSituation"  >
      
      <td class="colManifeste">NBRE SACS</td>
      <td class="colManifeste">POIDS</td>
        <td scope="col" class="colDeb24H" >NBRE SACS</td>
      <td scope="col" class="colDeb24H" >POIDS</td>
        <td scope="col" class="colDebTOTAL" >NBRE SACS</td>
      <td scope="col" class="colDebTOTAL" >POIDS</td>
        <td scope="col" class="colROB">NBRE SACS</td>
      <td scope="col" class="colROB" >POIDS</td>
        
     
     
 
         </tr>
         </thead> 
         <tbody> 
         
       <?php 
        
       while($cal2=$cale_sain->fetch()){

      //---REQUETE SAINS ET AVARIES DEBARQUES EN 24 PAR CALE ET PRODUIT

         $sain_24H=$bdd->prepare("SELECT dc.*,count(dc.cales), sum(dc.nombre_sac), sum(dc.poids), p.*,sum(rm.sac),sum(rm.poids),sum(det.sac_reconditionne),sum(det.poids_reconditionne) FROM declaration_chargement as dc LEFT join produit_deb as p on dc.id_produit=p.id
         inner join transfert_debarquement as rm on rm.cale=dc.id_dec
         left join detail_chargement as det on det.register_manif_id=rm.id_register_manif
           where dc.id_navire=? and rm.dates=? and dc.cales=? and dc.id_produit=?  and dc.conditionnement=? and rm.statut='sain'  group by dc.cales,p.produit, dc.conditionnement   ");
          $sain_24H->bindParam(1,$a[0]);  
          $sain_24H->bindParam(2,$a[1]);  
           $sain_24H->bindParam(3,$cal2['cales']); 
            $sain_24H->bindParam(4,$cal2['id_produit']); 
             $sain_24H->bindParam(5,$cal2['conditionnement']); 
          $sain_24H->execute();
          

            $sain_TOTAL=$bdd->prepare("SELECT dc.*,count(dc.cales), sum(dc.nombre_sac), sum(dc.poids), p.*,sum(rm.sac),sum(rm.poids),sum(det.sac_reconditionne),sum(det.poids_reconditionne) FROM declaration_chargement as dc LEFT join produit_deb as p on dc.id_produit=p.id
         inner join transfert_debarquement as rm on rm.cale=dc.id_dec
         left join detail_chargement as det on det.register_manif_id=rm.id_register_manif
           where dc.id_navire=? and rm.dates<=? and dc.cales=? and dc.id_produit=? and dc.conditionnement=?  and rm.statut='sain' group by dc.cales,p.produit, dc.conditionnement    ");
         $sain_TOTAL->bindParam(1,$a[0]);  
          $sain_TOTAL->bindParam(2,$a[1]);  
           $sain_TOTAL->bindParam(3,$cal2['cales']); 
            $sain_TOTAL->bindParam(4,$cal2['id_produit']); 
             $sain_TOTAL->bindParam(5,$cal2['conditionnement']); 
          $sain_TOTAL->execute();


   
          

         



            $sain_ST24H=$bdd->prepare("SELECT dc.*,count(dc.cales), sum(dc.nombre_sac), sum(dc.poids), p.*,sum(rm.sac),sum(rm.poids),sum(det.sac_reconditionne),sum(det.poids_reconditionne) FROM declaration_chargement as dc LEFT join produit_deb as p on dc.id_produit=p.id
         inner join transfert_debarquement as rm on rm.cale=dc.id_dec
          left join detail_chargement as det on det.register_manif_id=rm.id_register_manif
          where dc.id_navire=? and rm.dates=? and dc.cales=? and rm.statut='sain'  group by dc.cales   ");
          $sain_ST24H->bindParam(1,$a[0]);  
          $sain_ST24H->bindParam(2,$a[1]);  
           $sain_ST24H->bindParam(3,$cal2['cales']); 

          $sain_ST24H->execute();

          

            $sain_STT=$bdd->prepare("SELECT dc.*,count(dc.cales), sum(dc.nombre_sac), sum(dc.poids), p.*,sum(rm.sac),sum(rm.poids),sum(det.sac_reconditionne),sum(det.poids_reconditionne) FROM declaration_chargement as dc LEFT join produit_deb as p on dc.id_produit=p.id
         inner join transfert_debarquement as rm on rm.cale=dc.id_dec
         left join detail_chargement as det on det.register_manif_id=rm.id_register_manif
           where dc.id_navire=? and rm.dates<=? and dc.cales=? and rm.statut='sain' group by dc.cales   ");
         $sain_STT->bindParam(1,$a[0]);  
         $sain_STT->bindParam(2,$a[1]);  
           $sain_STT->bindParam(3,$cal2['cales']); 
          $sain_STT->execute();

            

            $sain_G24H=$bdd->prepare("SELECT dc.*,count(dc.cales), sum(dc.nombre_sac), sum(dc.poids), p.*,sum(rm.sac),sum(rm.poids),sum(det.sac_reconditionne),sum(det.poids_reconditionne) FROM declaration_chargement as dc LEFT join produit_deb as p on dc.id_produit=p.id
         inner join transfert_debarquement as rm on rm.cale=dc.id_dec
         left join detail_chargement as det on det.register_manif_id=rm.id_register_manif
           where dc.id_navire=? and rm.dates=? and rm.statut='sain'   ");
          $sain_G24H->bindParam(1,$a[0]);  
          $sain_G24H->bindParam(2,$a[1]);  
            

         $sain_G24H->execute();

          

            $sain_GT=$bdd->prepare("SELECT dc.*,count(dc.cales), sum(dc.nombre_sac), sum(dc.poids), p.*,sum(rm.sac),sum(rm.poids),sum(det.sac_reconditionne),sum(det.poids_reconditionne) FROM declaration_chargement as dc LEFT join produit_deb as p on dc.id_produit=p.id
         inner join transfert_debarquement as rm on rm.cale=dc.id_dec 
         left join detail_chargement as det on det.register_manif_id=rm.id_register_manif
          where dc.id_navire=? and rm.dates<=? and rm.statut='sain' ");
         $sain_GT->bindParam(1,$a[0]);  
         $sain_GT->bindParam(2,$a[1]);  
           
          $sain_GT->execute(); 


                  
          

           

        $s_G24H=$sain_G24H->fetch();
         $s_GT=$sain_GT->fetch();
         $s_ST24H=$sain_ST24H->fetch();
         $s_STT=$sain_STT->fetch();
          $s_24H=$sain_24H->fetch();
          $s_TOTAL=$sain_TOTAL->fetch();
          

          if(!empty($s_24H['sum(rm.sac)'])){
            $sac_sains_24H=$s_24H['sum(rm.sac)'];
            $poids_sains_24H=$s_24H['sum(rm.poids)'];
          }
          else{
            $sac_sains_24H=0;
            $poids_sains_24H=0;
          }
          if(!empty($s_24H['sum(det.sac_reconditionne)'])){
            $sac_sains_reconditionne_24H=$s_24H['sum(det.sac_reconditionne)'];
            $poids_sains_reconditionne_24H=$s_24H['sum(det.poids_reconditionne)'];
          }
          else{
            $sac_sains_reconditionne_24H=0;
            $poids_sains_reconditionne_24H=0;
          }

           if(!empty($s_TOTAL['sum(rm.sac)'])){
            $sac_sains_TOTAL=$s_TOTAL['sum(rm.sac)'];
            $poids_sains_TOTAL=$s_TOTAL['sum(rm.poids)'];
          }
          else{
            $sac_sains_TOTAL=0;
            $poids_sains_TOTAL=0;
          }

           if(!empty($s_ST24H['sum(rm.sac)'])){
            $sac_sains_ST24H=$s_ST24H['sum(rm.sac)'];
            $poids_sains_ST24H=$s_ST24H['sum(rm.poids)'];
          }
          else{
            $sac_sains_ST24H=0;
            $poids_sains_ST24H=0;
          }
          if(!empty($s_TOTAL['sum(det.sac_reconditionne)'])){
            $sac_sains_reconditionne_TOTAL=$s_TOTAL['sum(det.sac_reconditionne)'];
            $poids_sains_reconditionne_TOTAL=$s_TOTAL['sum(det.poids_reconditionne)'];
          }
          else{
            $sac_sains_reconditionne_TOTAL=0;
            $poids_sains_reconditionne_TOTAL=0;
          }

          if(!empty($s_ST24H['sum(det.sac_reconditionne)'])){
            $sac_sains_reconditionne_ST24H=$s_ST24H['sum(det.sac_reconditionne)'];
            $poids_sains_reconditionne_ST24H=$s_ST24H['sum(det.poids_reconditionne)'];
          }
          else{
            $sac_sains_reconditionne_ST24H=0;
            $poids_sains_reconditionne_ST24H=0;
          }

           if(!empty($s_STT['sum(rm.sac)'])){
            $sac_sains_STT=$s_STT['sum(rm.sac)'];
            $poids_sains_STT=$s_STT['sum(rm.poids)'];
          }
          else{
            $sac_sains_STT=0;
            $poids_sains_STT=0;
          }

          if(!empty($s_STT['sum(det.sac_reconditionne)'])){
            $sac_sains_reconditionne_STT=$s_STT['sum(det.sac_reconditionne)'];
            $poids_sains_reconditionne_STT=$s_STT['sum(det.poids_reconditionne)'];
          }
          else{
            $sac_sains_reconditionne_STT=0;
            $poids_sains_reconditionne_STT=0;
          }

            if(!empty($s_G24H['sum(rm.sac)'])){
            $sac_sains_G24H=$s_G24H['sum(rm.sac)'];
            $poids_sains_G24H=$s_G24H['sum(rm.poids)'];
          }
          else{
            $sac_sains_G24H=0;
            $poids_sains_G24H=0;
          }
            if(!empty($s_G24H['sum(det.sac_reconditionne)'])){
            $sac_sains_reconditionne_G24H=$s_G24H['sum(det.sac_reconditionne)'];
            $poids_sains_reconditionne_G24H=$s_G24H['sum(det.poids_reconditionne)'];
          }
          else{
            $sac_sains_reconditionne_G24H=0;
            $poids_sains_reconditionne_G24H=0;
          }

           if(!empty($s_GT['sum(rm.sac)'])){
            $sac_sains_GT=$s_GT['sum(rm.sac)'];
            $poids_sains_GT=$s_GT['sum(rm.poids)'];
          }
          else{
            $sac_sains_GT=0;
            $poids_sains_GT=0;
          }

          if(!empty($s_GT['sum(det.sac_reconditionne)'])){
            $sac_sains_reconditionne_GT=$s_GT['sum(det.sac_reconditionne)'];
            $poids_sains_reconditionne_GT=$s_GT['sum(det.poids_reconditionne)'];
          }
          else{
            $sac_sains_reconditionne_GT=0;
            $poids_sains_reconditionne_GT=0;
            
          }


     


          


      

        ?>

        
          <?php if(!empty($cal2['produit']) and !empty($cal2['conditionnement']) and !empty($cal2['cales'])) {


            ?>

            <tr class="CelluleTableSituation" >
    <td class="colLibeles"   ><?php echo $cal2['cales']; ?> </td>
    <td class="colLibeles"     ><?php echo $cal2['produit']; ?> <?php echo $cal2['conditionnement']; ?> KGS</td>
    
    <td  scope="col" class="colManifeste"  ><?php echo number_format($cal2['sum(dc.nombre_sac)'], 0,',',' ');  ?></td>
    <td  scope="col" class="colManifeste" ><?php echo number_format($cal2['sum(dc.poids)'], 3,',',' '); ?></td>
    
        <td class="colDeb24H" scope="col" ><?php echo number_format(/*$sac_avaries + $sac_sains +$sac_m */ $sac_sains_24H -$sac_sains_reconditionne_24H, 0,',',' '); ?></td>
        <td class="colDeb24H" scope="col"  ><?php echo number_format(/*$poids_avaries + $poids_sains +$poids_m*/ $poids_sains_24H  - $poids_sains_reconditionne_24H , 3,',',' '); ?></td>
        <td scope="col" class="colDebTOTAL"><?php echo number_format(/*$sac_avariesT + $sac_sainsT +$sac_mT */ $sac_sains_TOTAL  - $sac_sains_reconditionne_TOTAL, 0,',',' '); ?></td>
        <td scope="col" class="colDebTOTAL"><?php echo number_format(/*$poids_avariesT + $poids_sainsT +$poids_mT */ $poids_sains_TOTAL  - $poids_sains_reconditionne_TOTAL , 3,',',' '); ?></td>
     <td scope="col" class="colROB"><?php echo number_format($cal2['sum(dc.nombre_sac)']-($sac_sains_TOTAL - $sac_sains_reconditionne_TOTAL ), 0,',',' '); ?></td>
        <td scope="col" class="colROB" ><?php echo number_format($cal2['sum(dc.poids)']-($poids_sains_TOTAL - $poids_sains_reconditionne_TOTAL ), 3,',',' '); ?></td>
     </tr>




     <?php } ?>

      <?php if(empty($cal2['produit']) and empty($cal2['conditionnement']) and !empty($cal2['cales'])) {?>

      <tr class="sousTOTAL"> 
      <td  colspan="2">  TOTAL <?php  echo $cal2['cales'];  ?></td>
      <td  scope="col" ><?php echo number_format($cal2['sum(dc.nombre_sac)'], 0,',',' '); ?></td>
       <td  scope="col" ><?php echo number_format($cal2['sum(dc.poids)'], 3,',',' '); ?></td>
        <td  scope="col"  ><?php echo number_format($sac_sains_ST24H +$sac_avf_ST24H +$sac_avm_ST24H- $sac_sains_reconditionne_ST24H , 0,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format($poids_sains_ST24H  - $poids_sains_reconditionne_ST24H, 3,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format($sac_sains_STT +$sac_avf_STT +$sac_avm_STT -$sac_sains_reconditionne_STT, 0,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format($poids_sains_STT  - $poids_sains_reconditionne_STT, 3,',',' '); ?></td>
          <td scope="col"  ><?php echo number_format($cal2['sum(dc.nombre_sac)']- ($sac_sains_STT  -$sac_sains_reconditionne_STT) , 0,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format($cal2['sum(dc.poids)']- ($poids_sains_STT  -$poids_sains_reconditionne_STT) , 3,',',' '); ?></td>          

     </tr>
   <?php  } ?>

    <?php if(empty($cal2['produit']) and empty($cal2['conditionnement']) and empty($cal2['cales'])) {?>
      <tr class="TOTAL" >
       <td  colspan="2">  TOTAL <?php  echo $cal2['cales'];  ?></td>
      <td  scope="col" ><?php echo number_format($cal2['sum(dc.nombre_sac)'], 0,',',' '); ?></td>
       <td  scope="col" ><?php echo number_format($cal2['sum(dc.poids)'], 3,',',' '); ?></td>
        <td  scope="col"  ><?php echo number_format($sac_sains_G24H  - $sac_sains_reconditionne_G24H  , 0,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format($poids_sains_G24H  - $poids_sains_reconditionne_G24H , 3,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format($sac_sains_GT  - $sac_sains_reconditionne_GT , 0,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format($poids_sains_GT  - $poids_sains_reconditionne_GT  , 3,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format($cal2['sum(dc.nombre_sac)']- ($sac_sains_GT  - $sac_sains_reconditionne_GT) , 0,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format($cal2['sum(dc.poids)']- ($poids_sains_GT - $poids_sains_reconditionne_GT) , 3,',',' '); ?></td> 
        </tr>
     
    

     <?php }

     }  ?>
    
 
      
     </tbody>


 </table>


<?php if(!empty($trP['dates'])){
            $DateDebut=explode('-',$tr['dates']);
           if(!empty($tr2P['dates'])){
            $DateActuel=explode('-',$tr2P['dates']);?>

           

  <table class='table table-bordered ' id='table' border='2' style="margin-top:0px !important;" >
    

<thead>
           <tr style="background: blue; color: white; text-align: center; font-weight: bold; vertical-align: middle;" >
           <td colspan="10" ><h5 style="color: white;"> SITUATION DU DEBARQUEMENT (SAINS)  <span style="color:yellow;"> PAR PRODUIT</span> DU <span style="color: red; background: white;"><?php echo  $DateActuel[2]. '-' .$DateActuel[1].'-'.$DateActuel[0];?></span></h5></td></tr>
<?php 
         }  }
   ?>
          
  
 <tr  class="EnteteTableSituation"  >
      
      
      <td scope="col"  rowspan="2" class="colLibeles" >PRODUIT</td>
       <td scope="col"  rowspan="2" class="colLibeles" >CALES</td>
      <td scope="col" colspan="2" class="colManifeste" >MANIFESTE</td>
      <td scope="col" colspan="2" class="colDeb24H" >DEB 24H</td>
      <td scope="col" colspan="2" class="colDebTOTAL" > TOTAL DEB</td>
      <td scope="col" colspan="2" class="colROB" >ROB</td>
  </tr>
    <tr class="EnteteTableSituation" >
      
      <td scope="col" class="colManifeste">NBRE SACS</td>
      <td scope="col" class="colManifeste">POIDS</td>
        <td scope="col" class="colDeb24H">NBRE SACS</td>
      <td scope="col" class="colDeb24H">POIDS</td>
        <td scope="col" class="colDebTOTAL">NBRE SACS</td>
      <td scope="col"  class="colDebTOTAL">POIDS</td>
        <td scope="col" class="colROB">NBRE SACS</td>
      <td scope="col" class="colROB">POIDS</td>
        
     
     
 
         </tr>
         </thead> 

<?php 
        
       while($prod=$produit_sain->fetch()){

        //---REQUETE SAINS ET AVARIES DEBARQUES EN 24 PAR CALE ET PRODUIT
  

       
          $sain_deb24H=$bdd->prepare("SELECT dc.*,count(dc.cales), sum(dc.nombre_sac), sum(dc.poids), p.*,sum(rm.sac),sum(rm.poids),sum(det.sac_reconditionne),sum(det.poids_reconditionne) FROM declaration_chargement as dc LEFT join produit_deb as p on dc.id_produit=p.id
         inner join transfert_debarquement as rm on rm.cale=dc.id_dec
         left join detail_chargement as det on det.register_manif_id=rm.id_register_manif
           where rm.id_navire=? and rm.dates=? and dc.conditionnement=? and dc.id_produit=?  and dc.cales=? and rm.statut='sain'  ");

                  $sain_deb24H->bindParam(1,$a[0]);
                  $sain_deb24H->bindParam(2,$a[1]);
                  $sain_deb24H->bindParam(3,$prod['conditionnement']);
                  $sain_deb24H->bindParam(4,$prod['id_produit']);
                  $sain_deb24H->bindParam(5,$prod['cales']);
                 
          $sain_deb24H->execute();

        //---REQUETE SAINS ET AVARIES DEBARQUES TOTAL PAR CALE ET PRODUIT
         
          $sain_debT=$bdd->prepare("SELECT dc.*,count(dc.cales), sum(dc.nombre_sac), sum(dc.poids), p.*,sum(rm.sac),sum(rm.poids),sum(det.sac_reconditionne),sum(det.poids_reconditionne) FROM declaration_chargement as dc LEFT join produit_deb as p on dc.id_produit=p.id
         inner join transfert_debarquement as rm on rm.cale=dc.id_dec
         left join detail_chargement as det on det.register_manif_id=rm.id_register_manif
           where rm.id_navire=? and rm.dates<=? and dc.conditionnement=? and dc.id_produit=? and dc.cales=? and rm.statut='sain'  ");

                  $sain_debT->bindParam(1,$a[0]);
                  $sain_debT->bindParam(2,$a[1]);
                  $sain_debT->bindParam(3,$prod['conditionnement']);
                  $sain_debT->bindParam(4,$prod['id_produit']);
                  $sain_debT->bindParam(5,$prod['cales']);
                 
          $sain_debT->execute();



 //---REQUETE SOUS TOTAL  SAINS ET AVARIES TOTAL DEBARQUES EN 24 PAR CALE 
          

         $sain_debST24H=$bdd->prepare("SELECT dc.*,count(dc.cales), sum(dc.nombre_sac), sum(dc.poids), p.*,sum(rm.sac),sum(rm.poids),sum(det.sac_reconditionne),sum(det.poids_reconditionne) FROM declaration_chargement as dc LEFT join produit_deb as p on dc.id_produit=p.id
         inner join transfert_debarquement as rm on rm.cale=dc.id_dec
         left join detail_chargement as det on det.register_manif_id=rm.id_register_manif  where dc.id_navire=?
         
          and rm.dates=? and dc.conditionnement=? and dc.id_produit=?  and rm.statut='sain'   ");

                  $sain_debST24H->bindParam(1,$a[0]);
                  $sain_debST24H->bindParam(2,$a[1]);
                  $sain_debST24H->bindParam(3,$prod['conditionnement']);
                  $sain_debST24H->bindParam(4,$prod['id_produit']);
             
  
          $sain_debST24H->execute(); 

 //---REQUETE SOUS TOTAL SAINS ET AVARIES TOTAL DEBARQUES EN  PAR CALE DEPUIS LE DEBUT DU DEBARQUEMENT
         

         $sain_debSTT=$bdd->prepare("SELECT dc.*,count(dc.cales), sum(dc.nombre_sac), sum(dc.poids), p.*,sum(rm.sac),sum(rm.poids),sum(det.sac_reconditionne),sum(det.poids_reconditionne) FROM declaration_chargement as dc LEFT join produit_deb as p on dc.id_produit=p.id
         inner join transfert_debarquement as rm on rm.cale=dc.id_dec
         left join detail_chargement as det on det.register_manif_id=rm.id_register_manif
           where dc.id_navire=? and rm.dates<=? and dc.conditionnement=? and dc.id_produit=? and rm.statut='sain'  ");

                  $sain_debSTT->bindParam(1,$a[0]);
                  $sain_debSTT->bindParam(2,$a[1]);
                  $sain_debSTT->bindParam(3,$prod['conditionnement']);
                  $sain_debSTT->bindParam(4,$prod['id_produit']); 
                
      
          $sain_debSTT->execute(); 


    //---REQUETE  TOTAL GENERAL SAINS ET AVARIES TOTAL DEBARQUES DES CALES DEPUIS LE DEBUT DU DEBARQUEMENT 24H
         

         $sain_debG24H=$bdd->prepare("SELECT dc.*,count(dc.cales), sum(dc.nombre_sac), sum(dc.poids), p.*,sum(rm.sac),sum(rm.poids),sum(det.sac_reconditionne),sum(det.poids_reconditionne) FROM declaration_chargement as dc LEFT join produit_deb as p on dc.id_produit=p.id
         inner join transfert_debarquement as rm on rm.cale=dc.id_dec
         left join detail_chargement as det on det.register_manif_id=rm.id_register_manif  where rm.id_navire=? and rm.dates=? and rm.statut='sain'   ");

                  $sain_debG24H->bindParam(1,$a[0]);
                  $sain_debG24H->bindParam(2,$a[1]);
                  
      
          $sain_debG24H->execute(); 


     //---REQUETE  TOTAL GENERAL SAINS ET AVARIES TOTAL DEBARQUES DES CALES DEPUIS LE DEBUT DU DEBARQUEMENT TOTAL
         

         $sain_debGT=$bdd->prepare("SELECT dc.*,count(dc.cales), sum(dc.nombre_sac), sum(dc.poids), p.*,sum(rm.sac),sum(rm.poids),sum(det.sac_reconditionne),sum(det.poids_reconditionne) FROM declaration_chargement as dc LEFT join produit_deb as p on dc.id_produit=p.id
         inner join transfert_debarquement as rm on rm.cale=dc.id_dec
         left join detail_chargement as det on det.register_manif_id=rm.id_register_manif
           where rm.id_navire=? and rm.dates<=?  and rm.statut='sain'   ");

                  $sain_debGT->bindParam(1,$a[0]);
                  $sain_debGT->bindParam(2,$a[1]);
                  
          $sain_debGT->execute();           




          



      
       $s_deb=$sain_deb24H->fetch();
      
       $s_debT=$sain_debT->fetch();
       //$avaries2=$fm->fetch();
      
       $s_debST=$sain_debST24H->fetch();

      
       $s_debSTT=$sain_debSTT->fetch();

      
       $s_debG=$sain_debG24H->fetch();

      
       $s_debGT=$sain_debGT->fetch();


     

      //VARIABLES SAINS------------------------------------------

      if(empty($s_deb['sum(rm.sac)'])){
        $sac_sains=0;
      }
      else{
        $sac_sains= $s_deb['sum(rm.sac)'];
      }
      if(empty($s_deb['sum(rm.poids)'])){
        $poids_sains=0;
      }
      else{
        $poids_sains= $s_deb['sum(rm.poids)'];
      }

      if(empty($s_deb['sum(det.sac_reconditionne)'])){
        $sac_sains_reconditionne=0;
      }
      else{
        $sac_sains_reconditionne= $s_deb['sum(det.sac_reconditionne)'];
      }
      if(empty($s_deb['sum(det.poids_reconditionne)'])){
        $poids_sains_reconditionne=0;
      }
      else{
        $poids_sains_reconditionne= $s_deb['sum(det.poids_reconditionne)'];
      }


      if(empty($s_debT['sum(rm.sac)'])){
        $sac_sainsT=0;
      }
      else{
        $sac_sainsT= $s_debT['sum(rm.sac)'];
      }
      if(empty($s_debT['sum(rm.poids)'])){
        $poids_sainsT=0;
      }
      else{
        $poids_sainsT= $s_debT['sum(rm.poids)'];
      }

      if(empty($s_debT['sum(det.sac_reconditionne)'])){
        $sac_sains_reconditionneT=0;
      }
      else{
        $sac_sains_reconditionneT= $s_deb['sum(det.sac_reconditionne)'];
      }
      if(empty($s_debT['sum(det.poids_reconditionne)'])){
        $poids_sains_reconditionneT=0;
      }
      else{
        $poids_sains_reconditionneT= $s_deb['sum(det.poids_reconditionne)'];
      }

      if(empty($s_debST['sum(rm.sac)'])){
        $sac_sainsST=0;
      }
      else{
        $sac_sainsST= $s_debST['sum(rm.sac)'];
      }
      if(empty($s_debST['sum(rm.poids)'])){
        $poids_sainsST=0;
      }
      else{
        $poids_sainsST= $s_debST['sum(rm.poids)'];
      }

      if(empty($s_debST['sum(det.sac_reconditionne)'])){
        $sac_sains_reconditionneST=0;
      }
      else{
        $sac_sains_reconditionneST= $s_debST['sum(det.sac_reconditionne)'];
      }
      if(empty($s_debST['sum(det.poids_reconditionne)'])){
        $poids_sains_reconditionneST=0;
      }
      else{
        $poids_sains_reconditionneST= $s_debST['sum(det.poids_reconditionne)'];
      }

       if(empty($s_debSTT['sum(rm.sac)'])){
        $sac_sainsSTT=0;
      }
      else{
        $sac_sainsSTT= $s_debSTT['sum(rm.sac)'];
      }
      if(empty($s_debSTT['sum(rm.poids)'])){
        $poids_sainsSTT=0;
      }
      else{
        $poids_sainsSTT= $s_debSTT['sum(rm.poids)'];
      }

      if(empty($s_debSTT['sum(det.sac_reconditionne)'])){
        $sac_sains_reconditionneSTT=0;
      }
      else{
        $sac_sains_reconditionneSTT= $s_debSTT['sum(det.sac_reconditionne)'];
      }
      if(empty($s_debSTT['sum(det.poids_reconditionne)'])){
        $poids_sains_reconditionneSTT=0;
      }
      else{
        $poids_sains_reconditionneSTT= $s_debSTT['sum(det.poids_reconditionne)'];
      }

      if(empty($s_debG['sum(rm.sac)'])){
        $sac_sainsG=0;
      }
      else{
        $sac_sainsG= $s_debG['sum(rm.sac)'];
      }
      if(empty($s_debG['sum(rm.poids)'])){
        $poids_sainsG=0;
      }
      else{
        $poids_sainsG= $s_debG['sum(rm.poids)'];
      }

      if(empty($s_debG['sum(det.sac_reconditionne)'])){
        $sac_sains_reconditionneG=0;
      }
      else{
        $sac_sains_reconditionneG= $s_debG['sum(det.sac_reconditionne)'];
      }
      if(empty($s_debG['sum(det.poids_reconditionne)'])){
        $poids_sains_reconditionneG=0;
      }
      else{
        $poids_sains_reconditionneG= $s_debG['sum(det.poids_reconditionne)'];
      }

      if(empty($s_debGT['sum(rm.sac)'])){
        $sac_sainsGT=0;
      }
      else{
        $sac_sainsGT= $s_debGT['sum(rm.sac)'];
      }
      if(empty($s_debGT['sum(rm.poids)'])){
        $poids_sainsGT=0;
      }

      else{
        $poids_sainsGT= $s_debGT['sum(rm.poids)'];
      } 

      if(empty($s_debGT['sum(det.sac_reconditionne)'])){
        $sac_sains_reconditionneGT=0;
      }
      else{
        $sac_sains_reconditionneGT= $s_debGT['sum(det.sac_reconditionne)'];
      }
      if(empty($s_debGT['sum(det.poids_reconditionne)'])){
        $poids_sains_reconditionneGT=0;
      }
      else{
        $poids_sains_reconditionneGT= $s_debGT['sum(det.poids_reconditionne)'];
      } 

     /*  $prodT=$produitT->fetch();
       $avariesT=$fmpT->fetch();
       $avaries2=$fmp->fetch();
        
       
       $sum_sac=$prod['nombre_sac'] -$prodT['sum(rm.sac)']-$avariesT['sum(sac_flasque)']-$avariesT['sum(sac_mouille)'];

       $poids=$prod['nombre_sac']*$prod['conditionnement']/1000;
       $sum_poids=$poids-$prodT['sum(rm.poids)']-$avaries2['sum(poids_flasque)']-$avaries2['sum(poids_mouille)'];

       $sacs_24H=$prod['sum(rm.sac)']+$avaries2['sum(sac_flasque)']+$avaries2['sum(sac_mouille)'];

        $poids_24H=$prod['sum(rm.poids)']+$avaries2['sum(poids_flasque)']+$avaries2['poids_mouille'];

        $total_sac=$prodT['sum(rm.sac)']+$avariesT['sum(sac_flasque)']+$avariesT['sum(sac_mouille)'];
        $total_poids=$prodT['sum(rm.poids)']+$avariesT['sum(poids_flasque)']+$avariesT['sum(poids_mouille)']; */

        ?>

        <tr class="EnteteTableSituation" style="text-align: center;">
          <?php if(!empty($prod['produit']) and !empty($prod['conditionnement']) and !empty($prod['cales']) ) {?>
    
    <td scope="col" class="colLibeles" ><?php echo $prod['produit']; ?> <?php echo $prod['conditionnement']; ?> KGS</td>
    <td scope="col" class="colLibeles" ><?php echo $prod['cales']; ?></td>
    <td scope="col"  class="colManifeste"><?php echo number_format($prod['sum(dc.nombre_sac)'], 0,',',' ');  ?></td>
    <td scope="col" class="colManifeste"  ><?php echo number_format($prod['sum(dc.poids)'], 3,',',' '); ?></td>
        <td class="colDeb24H" scope="col" ><?php echo number_format( $sac_sains  -$sac_sains_reconditionne, 0,',',' '); ?></td>
      <td class="colDeb24H" scope="col"  ><?php echo number_format( $poids_sains  -$poids_sains_reconditionne , 3,',',' '); ?></td>
      <td scope="col" class="colDebTOTAL"><?php echo number_format( $sac_sainsT  -$sac_sains_reconditionneT, 0,',',' '); ?></td>
      <td scope="col" class="colDebTOTAL"><?php echo number_format( $poids_sainsT -$poids_sains_reconditionneT , 3,',',' '); ?></td>
     <td scope="col" class="colROB"><?php echo number_format($prod['sum(dc.nombre_sac)']-( $sac_sainsT  -$sac_sains_reconditionneT), 0,',',' '); ?></td>
      <td scope="col" class="colROB" ><?php echo number_format($prod['sum(dc.poids)']-( $poids_sainsT  - $poids_sains_reconditionneT), 3,',',' '); ?></td>
     <?php } ?>

     <?php if(!empty($prod['produit']) and !empty($prod['conditionnement']) and empty($prod['cales']) ) {?>
     <tr class="sousTOTAL" > 
      <td  colspan="2">  TOTAL <?php  echo $prod['produit'];  ?> <?php  echo $prod['qualite'];  ?> <?php  echo $prod['conditionnement'].' KG';  ?></td>
      <td  scope="col" ><?php echo number_format($prod['sum(dc.nombre_sac)'], 0,',',' '); ?></td>
       <td scope="col" ><?php echo number_format($prod['sum(dc.poids)'], 3,',',' '); ?></td>
        <td  scope="col"  ><?php echo number_format( $sac_sainsST -$sac_sains_reconditionneST , 0,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format($poids_sainsST  -$poids_sains_reconditionneST , 3,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format( $sac_sainsSTT   -$sac_sains_reconditionneSTT , 0,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format( $poids_sainsSTT  -$poids_sains_reconditionneSTT , 3,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format($prod['sum(dc.nombre_sac)']- ( $sac_sainsSTT  -$sac_sains_reconditionneSTT) , 0,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format($prod['sum(dc.poids)']- ( $poids_sainsSTT  -$poids_sains_reconditionneSTT) , 3,',',' '); ?></td>          

     </tr> <?php //} ?>
     <?php } ?>


     <?php if(empty($prod['produit']) and empty($prod['conditionnement']) and empty($prod['cales']) ) {?>
    <tr class="TOTAL" >
       <td  colspan="2">  TOTAL <?php  echo $prod['cales'];  ?></td>
      <td  scope="col" ><?php echo number_format($prod['sum(dc.nombre_sac)'], 0,',',' '); ?></td>
       <td  scope="col" ><?php echo number_format($prod['sum(dc.poids)'], 3,',',' '); ?></td>
        <td  scope="col"  ><?php echo number_format( $sac_sainsG  -$sac_sains_reconditionneG , 0,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format( $poids_sainsG  -$poids_sains_reconditionneG , 3,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format( $sac_sainsGT  -$sac_sains_reconditionneGT , 0,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format( $poids_sainsGT  -$poids_sains_reconditionneGT , 3,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format($prod['sum(dc.nombre_sac)']- ( $sac_sainsGT  -$sac_sains_reconditionneGT) , 0,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format($prod['sum(dc.poids)']- ( $poids_sainsGT  -$poids_sains_reconditionneGT) , 3,',',' '); ?></td> 
        </tr>
     <?php } ?>


     <?php }  ?>
    
 
      
     

 </table>



</div>
</div>





  
<?php $produit1=$_POST['deb_produit']; ?>

<div class="col col-lg-12" id="deb_by_produit" <?php if($produit1==0){

 ?> style="display: none;" <?php } ?>  <?php if($produit1==1){

 ?> style="display: block;" <?php } ?>>




<!-- <a style="margin:auto-right;" class="btn btn-primary no_print" data-role="imprimer_par_produit">imprimer2</a> !-->
</div>


<?php $destination1=$_POST['transfert_sain_avaries']; ?>

<div class="col col-lg-12" id="deb_by_destination"  <?php if($destination1==0){

 ?> style="display: none;" <?php } ?>  <?php if($destination1==1){

 ?> style="display: block;" <?php } ?>>




<?php if(!empty($trP['dates'])){
            $DateDebut=explode('-',$tr['dates']);
           if(!empty($tr2P['dates'])){
            $DateActuel=explode('-',$tr2P['dates']);?>

            
<div class="row"> 
  <div class="col-lg-12 col-md-12"> 
  <table class='table table-hover table-bordered ' id='table' border='2' >
    
 
<thead>
           <tr style="background: black; color: white; text-align: center; font-weight: bold; " >
           <td colspan="11" ><h4 style="color: white;"> SITUATION DES ENLEVEMENTS <span style="color:yellow;">PAR DESTINATION (SAINS + AVARIES)</span> DU <span style="color: red; background: white;"><?php echo  $DateActuel[2]. '-' .$DateActuel[1].'-'.$DateActuel[0];?> <?php echo $_POST['deb_destination']; ?></span></h4></td></tr>
<?php 
         }  }
   ?>
 
  
 <tr  style="background-color: rgba(50, 159, 218, 0.9); text-align: center;"  >
      
      
    
       <td scope="col"  rowspan="3" class="colLibeles" >DESTINATION</td>
        <td scope="col" rowspan="3" class="colLibeles" >PRODUIT</td>
        <td scope="col"  rowspan="3" class="colLibeles" >CLIENT</td>
       
      
     
  </tr>
    <tr style="background-color: rgba(50, 159, 218, 0.9); text-align: center;" >
      
      <td scope="col" colspan="2" class="colManifeste" >MANIFESTE</td>
      <td scope="col" colspan="2" class="colDeb24H">DEB 24H</td>
     
      <td scope="col" colspan="2" class="colDebTOTAL">TOTAL DEB</td>
      <td scope="col" colspan="2" class="colROB">ROB</td>
     
      </tr>
     
        

      <tr >
        <td scope="col" class="colManifeste" >NBRE SACS</td>
      <td scope="col" class="colManifeste" >POIDS</td>
        <td scope="col"  class="colDeb24H">NBRE SACS</td>
      <td scope="col" class="colDeb24H">POIDS</td>
        <td scope="col" class="colDebTOTAL"  >NBRE SACS</td>
      <td scope="col"  class="colDebTOTAL">POIDS</td>
       <td scope="col"  class="colROB">NBRE SACS</td>
      <td scope="col"  class="colROB">POIDS</td>
     
      
      
    
       </tr>
         </thead>
<tbody>

  <?php 
while ($fm0=$dispatching->fetch()) { 
 /* $avar=$TSTDVRAC->fetch();
  
  */

   //---REQUETE SAINS  DEBARQUES EN 24 PAR CALE ET PRODUIT

       
          $sain_deb24H=$bdd->prepare("SELECT rm.*, dis.* ,d.num_declaration, sum(rm.sac),sum(rm.poids),nc.*,p.*,mg.mangasin from transfert_debarquement as rm
         left join declaration as d  on d.id_declaration=rm.id_declaration

          inner join dispats as dis on dis.id_dis=d.id_bl
          inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
          inner join produit_deb as p on p.id=nc.id_produit
          inner join mangasin as mg on mg.id=dis.id_mangasin 
           where rm.id_navire=? and rm.dates=? and nc.poids_kg=? and nc.id_produit=?  and dis.id_mangasin=?      ");

                  $sain_deb24H->bindParam(1,$a[0]);
                  $sain_deb24H->bindParam(2,$a[1]);
                  $sain_deb24H->bindParam(3,$fm0['poids_kg']);
                  $sain_deb24H->bindParam(4,$fm0['id_produit']);
                  $sain_deb24H->bindParam(5,$fm0['id_mangasin']);
                 
          $sain_deb24H->execute();

        //---REQUETE SAINS ET AVARIES DEBARQUES TOTAL PAR CALE ET PRODUIT


          $sain_debT=$bdd->prepare("SELECT rm.*, dis.*, d.num_declaration , sum(rm.sac),sum(rm.poids), nc.*,p.produit,mg.mangasin from transfert_debarquement as rm
          left join declaration as d on d.id_declaration=rm.id_declaration

          inner join dispats as dis on dis.id_dis=d.id_bl
          inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
                    inner join produit_deb as p on p.id=nc.id_produit
          inner join mangasin as mg on mg.id=dis.id_mangasin
            where rm.id_navire=? and rm.dates<=? and nc.poids_kg=? and nc.id_produit=?  and dis.id_mangasin=?    ");

                  $sain_debT->bindParam(1,$a[0]);
                  $sain_debT->bindParam(2,$a[1]);
                  $sain_debT->bindParam(3,$fm0['poids_kg']);
                  $sain_debT->bindParam(4,$fm0['id_produit']);
                  $sain_debT->bindParam(5,$fm0['id_mangasin']);
                 
          $sain_debT->execute();



 //---REQUETE SOUS TOTAL  SAINS ET AVARIES TOTAL DEBARQUES EN 24 PAR CALE 


         $sain_debST24H=$bdd->prepare("SELECT rm.*, dis.*, d.id_declaration , sum(rm.sac),sum(rm.poids),nc.* from transfert_debarquement as rm
                     left join declaration as d on d.id_declaration=rm.id_declaration

          inner join dispats as dis on dis.id_dis=d.id_bl
           inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
         
            where rm.id_navire=? and rm.dates=? and  dis.id_mangasin=?    ");

                  $sain_debST24H->bindParam(1,$a[0]);
                  $sain_debST24H->bindParam(2,$a[1]);

                  $sain_debST24H->bindParam(3,$fm0['id_mangasin']);
                 
  
          $sain_debST24H->execute(); 

 //---REQUETE SOUS TOTAL SAINS ET AVARIES TOTAL DEBARQUES EN  PAR CALE DEPUIS LE DEBUT DU DEBARQUEMENT


         $sain_debSTT=$bdd->prepare("SELECT rm.*, dis.*, d.id_declaration , sum(rm.sac),sum(rm.poids),nc.* from transfert_debarquement as rm
                     left join declaration as d on d.id_declaration=rm.id_declaration

          inner join dispats as dis on dis.id_dis=d.id_bl
           inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
         
            where rm.id_navire=? and rm.dates<=? and  dis.id_mangasin=?    ");

                  $sain_debSTT->bindParam(1,$a[0]);
                  $sain_debSTT->bindParam(2,$a[1]);

                  $sain_debSTT->bindParam(3,$fm0['id_mangasin']);
                 
                 
      
          $sain_debSTT->execute(); 


    //---REQUETE  TOTAL GENERAL SAINS ET AVARIES TOTAL DEBARQUES DES CALES DEPUIS LE DEBUT DU DEBARQUEMENT 24H


         $sain_debG24H=$bdd->prepare("SELECT rm.*, dis.*, d.num_declaration , sum(rm.sac),sum(rm.poids),nc.*,p.produit,mg.mangasin from transfert_debarquement as rm
       left join declaration as d  on d.id_declaration=rm.id_declaration

          inner join dispats as dis on dis.id_dis=d.id_bl
           inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
              inner join produit_deb as p on p.id=nc.id_produit
          inner join mangasin as mg on mg.id=dis.id_mangasin
           where rm.id_navire=? and rm.dates=?    ");

                  $sain_debG24H->bindParam(1,$a[0]);
                  $sain_debG24H->bindParam(2,$a[1]);
                  
      
          $sain_debG24H->execute(); 


     //---REQUETE  TOTAL GENERAL SAINS ET AVARIES TOTAL DEBARQUES DES CALES DEPUIS LE DEBUT DU DEBARQUEMENT TOTAL


         $sain_debGT=$bdd->prepare("SELECT rm.*, dis.*, d.num_declaration, sum(rm.sac),sum(rm.poids),nc.*,p.produit,mg.mangasin from transfert_debarquement as rm
        left join declaration as d  on d.id_declaration=rm.id_declaration

         inner join dispats as dis on dis.id_dis=d.id_bl
          inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
                    inner join produit_deb as p on p.id=nc.id_produit
          inner join mangasin as mg on mg.id=dis.id_mangasin
           where rm.id_navire=? and rm.dates<=?   ");

                  $sain_debGT->bindParam(1,$a[0]);
                  $sain_debGT->bindParam(2,$a[1]);
                  
          $sain_debGT->execute();           



      
       $s_deb=$sain_deb24H->fetch();
     
       $s_debT=$sain_debT->fetch();
       //$avaries2=$fm->fetch();
      
       $s_debST=$sain_debST24H->fetch();

      
       $s_debSTT=$sain_debSTT->fetch();

       
       $s_debG=$sain_debG24H->fetch();

     
       $s_debGT=$sain_debGT->fetch();


     

      //VARIABLES SAINS
      if(empty($s_deb['sum(rm.sac)'])){
        $sac_sains=0;
      }
      else{
        $sac_sains= $s_deb['sum(rm.sac)'];
      }
      if(empty($s_deb['sum(rm.poids)'])){
        $poids_sains=0;
      }
      else{
        $poids_sains= $s_deb['sum(rm.poids)'];
      }

      if(empty($s_debT['sum(rm.sac)'])){
        $sac_sainsT=0;
      }
      else{
        $sac_sainsT= $s_debT['sum(rm.sac)'];
      }
      if(empty($s_debT['sum(rm.poids)'])){
        $poids_sainsT=0;
      }
      else{
        $poids_sainsT= $s_debT['sum(rm.poids)'];
      }

      if(empty($s_debST['sum(rm.sac)'])){
        $sac_sainsST=0;
      }
      else{
        $sac_sainsST= $s_debST['sum(rm.sac)'];
      }
      if(empty($s_debST['sum(rm.poids)'])){
        $poids_sainsST=0;
      }
      else{
        $poids_sainsST= $s_debST['sum(rm.poids)'];
      }

       if(empty($s_debSTT['sum(rm.sac)'])){
        $sac_sainsSTT=0;
      }
      else{
        $sac_sainsSTT= $s_debSTT['sum(rm.sac)'];
      }
      if(empty($s_debSTT['sum(rm.poids)'])){
        $poids_sainsSTT=0;
      }
      else{
        $poids_sainsSTT= $s_debSTT['sum(rm.poids)'];
      }

      if(empty($s_debG['sum(rm.sac)'])){
        $sac_sainsG=0;
      }
      else{
        $sac_sainsG= $s_debG['sum(rm.sac)'];
      }
      if(empty($s_debG['sum(rm.poids)'])){
        $poids_sainsG=0;
      }
      else{
        $poids_sainsG= $s_debG['sum(rm.poids)'];
      }

      if(empty($s_debGT['sum(rm.sac)'])){
        $sac_sainsGT=0;
      }
      else{
        $sac_sainsGT= $s_debGT['sum(rm.sac)'];
      }
      if(empty($s_debGT['sum(rm.poids)'])){
        $poids_sainsGT=0;
      }
      else{
        $poids_sainsGT= $s_debGT['sum(rm.poids)'];
      }      
      

  if (!empty($fm0['mangasin']) and !empty($fm0['produit'])  and !empty($fm0['poids_kg']) ){ ?>
       <tr style="text-align: center;">
        <td scope="col" class="colLibeles"><?php echo $fm0['mangasin']  ?></td>
            <td scope="col" class="colLibeles" ><?php echo $fm0['produit']; ?> <?php echo $fm0['poids_kg']; ?> KGS</td>
              <td scope="col" id="colLibeles" ><?php echo $fm0['client']; ?> </td>

     <td scope="col" class="colManifeste"  ><?php echo number_format($fm0['sum(dis.quantite_sac)'], 0,',',' ');  ?></td>
       <td scope="col" class="colManifeste" ><?php echo number_format($fm0['sum(dis.quantite_poids)'], 3,',',' '); ?></td>
    <td class="colDeb24H" scope="col" ><?php echo number_format( $sac_sains , 0,',',' '); ?></td>
      <td class="colDeb24H" scope="col"  ><?php echo number_format( $poids_sains  , 3,',',' '); ?></td>
      <td scope="col" class="colDebTOTAL"><?php echo number_format( $sac_sainsT , 0,',',' '); ?></td>
      <td scope="col" class="colDebTOTAL"><?php echo number_format( $poids_sainsT  , 3,',',' '); ?></td>
     <td scope="col" class="colROB"><?php echo number_format($fm0['sum(dis.quantite_sac)']- $sac_sainsT , 0,',',' '); ?></td>
      <td scope="col" class="colROB" ><?php echo number_format($fm0['sum(dis.quantite_poids)']- $poids_sainsT , 3,',',' '); ?></td>
     </tr>

  
 <?php } 

 if (!empty($fm0['mangasin']) and empty($fm0['produit'])  and empty($fm0['poids_kg']) ){ ?>
     <tr class="sousTOTAL"> 
      <td  colspan="3">  TOTAL <?php  echo $fm0['mangasin'];  ?></td>
      <td  scope="col" ><?php echo number_format($fm0['sum(dis.quantite_sac)'], 0,',',' '); ?></td>
       <td  scope="col" ><?php echo number_format($fm0['sum(dis.quantite_poids)'], 3,',',' '); ?></td>
        <td  scope="col"  ><?php echo number_format($sac_sainsST, 0,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format($poids_sainsST , 3,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format($sac_sainsSTT  , 0,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format($poids_sainsSTT , 3,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format($fm0['sum(dis.quantite_sac)']- $sac_sainsSTT , 0,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format($fm0['sum(dis.quantite_poids)']- $poids_sainsSTT , 3,',',' '); ?></td>          

     </tr>
 <?php 
  }
 if (empty($fm0['mangasin']) and empty($fm0['produit'])  and empty($fm0['poids_kg']) ){ ?>
       <tr class="TOTAL" >
       <td style="color:white;" colspan="3">  TOTAL <?php echo $fm0['num_connaissement'] ?> </td>
      <td  scope="col" ><?php echo number_format($fm0['sum(dis.quantite_sac)'], 0,',',' '); ?></td>
       <td  scope="col" ><?php echo number_format($fm0['sum(dis.quantite_poids)'], 3,',',' '); ?></td>
        <td  scope="col"  ><?php echo number_format( $sac_sainsG , 0,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format( $poids_sainsG , 3,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format($sac_sainsGT , 0,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format( $poids_sainsGT , 3,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format($fm0['sum(dis.quantite_sac)']-  $sac_sainsGT , 0,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format($fm0['sum(dis.quantite_poids)']-  $poids_sainsGT , 3,',',' '); ?></td> 
        </tr>
  <?php  
        } ?> 
 <?php } ?>
</tbody>
</table>
</div>
</div>


<?php if(!empty($trP['dates'])){
            $DateDebut=explode('-',$tr['dates']);
           if(!empty($tr2P['dates'])){
            $DateActuel=explode('-',$tr2P['dates']);?>

            

  <table class='table table-hover table-bordered ' id='table' border='2' >
    
 
<thead>
           <tr style="background: black; color: white; text-align: center; font-weight: bold; " >
           <td colspan="11" ><h4 style="color: white;"> SITUATION DES ENLEVEMENTS <span style="color:yellow;">PAR PRODUIT (SAINS + AVARIES)</span> DU <span style="color: red; background: white;"><?php echo  $DateActuel[2]. '-' .$DateActuel[1].'-'.$DateActuel[0];?> <?php echo $_POST['deb_destination']; ?></span></h4></td></tr>
<?php 
         }  }
   ?>
 
  
 <tr  style="background-color: rgba(50, 159, 218, 0.9); text-align: center;"  >
      
      
    
      
        <td scope="col" rowspan="3" class="colLibeles" >PRODUIT</td>
         <td scope="col"  rowspan="3" class="colLibeles" >DESTINATION</td>
        <td scope="col"  rowspan="3" class="colLibeles" >CLIENT</td>
       
      
     
  </tr>
    <tr style="background-color: rgba(50, 159, 218, 0.9); text-align: center;" >
      
      <td scope="col" colspan="2" class="colManifeste" >MANIFESTE</td>
      <td scope="col" colspan="2" class="colDeb24H">DEB 24H</td>
     
      <td scope="col" colspan="2" class="colDebTOTAL">TOTAL DEB</td>
      <td scope="col" colspan="2" class="colROB">ROB</td>
     
      </tr>
     
        

      <tr >
        <td scope="col" class="colManifeste" >NBRE SACS</td>
      <td scope="col" class="colManifeste" >POIDS</td>
        <td scope="col"  class="colDeb24H">NBRE SACS</td>
      <td scope="col" class="colDeb24H">POIDS</td>
        <td scope="col" class="colDebTOTAL"  >NBRE SACS</td>
      <td scope="col"  class="colDebTOTAL">POIDS</td>
       <td scope="col"  class="colROB">NBRE SACS</td>
      <td scope="col"  class="colROB">POIDS</td>
     
      
      
    
       </tr>
         </thead>
<tbody>

        <?php 
while ($fm0=$dispatching_produit->fetch()) { 
 /* $avar=$TSTDVRAC->fetch();
  
  */

   //---REQUETE SAINS  DEBARQUES EN 24 PAR CALE ET PRODUIT

       
          $flasque_deb24H=$bdd->prepare("SELECT manif.*, dis.* ,d.num_declaration, sum(manif.sac),sum(manif.poids),nc.*,p.*,mg.mangasin from transfert_debarquement as manif
         left join declaration as d  on d.id_declaration=manif.id_declaration

          inner join dispats as dis on dis.id_dis=d.id_bl
          inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
          inner join produit_deb as p on p.id=nc.id_produit
          inner join mangasin as mg on mg.id=dis.id_mangasin 
           where manif.id_navire=? and manif.dates=? and nc.poids_kg=? and nc.id_produit=?  and dis.id_mangasin=?      ");

                  $flasque_deb24H->bindParam(1,$a[0]);
                  $flasque_deb24H->bindParam(2,$a[1]);
                  $flasque_deb24H->bindParam(3,$fm0['poids_kg']);
                  $flasque_deb24H->bindParam(4,$fm0['id_produit']);
                  $flasque_deb24H->bindParam(5,$fm0['id_mangasin']);
                 
          $flasque_deb24H->execute(); 

  $flasque_debST24H=$bdd->prepare("SELECT manif.*, dis.* ,d.num_declaration, sum(manif.sac),sum(manif.poids),nc.*,p.*,mg.mangasin from transfert_debarquement as manif
         left join declaration as d  on d.id_declaration=manif.id_declaration

          inner join dispats as dis on dis.id_dis=d.id_bl
          inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
          inner join produit_deb as p on p.id=nc.id_produit
          inner join mangasin as mg on mg.id=dis.id_mangasin 
           where manif.id_navire=? and manif.dates=?   and dis.id_mangasin=?      ");

                  $flasque_debST24H->bindParam(1,$a[0]);
                  $flasque_debST24H->bindParam(2,$a[1]);

                  $flasque_debST24H->bindParam(3,$fm0['id_mangasin']);
                 
          $flasque_debST24H->execute();

   $flasque_debSTT=$bdd->prepare("SELECT manif.*, dis.* ,d.num_declaration, sum(manif.sac),sum(manif.poids),nc.*,p.*,mg.mangasin from transfert_debarquement as manif
         left join declaration as d  on d.id_declaration=manif.id_declaration

          inner join dispats as dis on dis.id_dis=d.id_bl
          inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
          inner join produit_deb as p on p.id=nc.id_produit
          inner join mangasin as mg on mg.id=dis.id_mangasin 
           where manif.id_navire=? and manif.dates<=?  and dis.id_mangasin=?     ");

                   $flasque_debSTT->bindParam(1,$a[0]);
                   $flasque_debSTT->bindParam(2,$a[1]);

                   $flasque_debSTT->bindParam(3,$fm0['id_mangasin']);
                 
           $flasque_debSTT->execute();                    

            $flasque_debT24H=$bdd->prepare("SELECT manif.*, dis.* ,d.num_declaration, sum(manif.sac),sum(manif.poids),nc.*,p.*,mg.mangasin from transfert_debarquement as manif
         left join declaration as d  on d.id_declaration=manif.id_declaration

          inner join dispats as dis on dis.id_dis=d.id_bl
          inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
          inner join produit_deb as p on p.id=nc.id_produit
          inner join mangasin as mg on mg.id=dis.id_mangasin 
           where manif.id_navire=? and manif.dates<=? and nc.poids_kg=? and nc.id_produit=?  and dis.id_mangasin=?    ");

                  $flasque_debT24H->bindParam(1,$a[0]);
                  $flasque_debT24H->bindParam(2,$a[1]);
                  $flasque_debT24H->bindParam(3,$fm0['poids_kg']);
                  $flasque_debT24H->bindParam(4,$fm0['id_produit']);
                  $flasque_debT24H->bindParam(5,$fm0['id_mangasin']);
                 
          $flasque_debT24H->execute();


     $flasque_debG24H=$bdd->prepare("SELECT manif.*, dis.* ,d.num_declaration, sum(manif.sac),sum(manif.poids),nc.*,p.*,mg.mangasin from transfert_debarquement as manif
         left join declaration as d  on d.id_declaration=manif.id_declaration

          inner join dispats as dis on dis.id_dis=d.id_bl
          inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
          inner join produit_deb as p on p.id=nc.id_produit
          inner join mangasin as mg on mg.id=dis.id_mangasin 
           where manif.id_navire=? and manif.dates=?     ");

                  $flasque_debG24H->bindParam(1,$a[0]);
                  $flasque_debG24H->bindParam(2,$a[1]);

                  
                 
          $flasque_debG24H->execute();   

    $flasque_debGT=$bdd->prepare("SELECT manif.*, dis.* ,d.num_declaration, sum(manif.sac),sum(manif.poids),nc.*,p.*,mg.mangasin from transfert_debarquement as manif
         left join declaration as d  on d.id_declaration=manif.id_declaration

          inner join dispats as dis on dis.id_dis=d.id_bl
          inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
          inner join produit_deb as p on p.id=nc.id_produit
          inner join mangasin as mg on mg.id=dis.id_mangasin 
           where manif.id_navire=? and manif.dates<=?      ");

                  $flasque_debGT->bindParam(1,$a[0]);
                  $flasque_debGT->bindParam(2,$a[1]);

                  
                 
          $flasque_debGT->execute();                


   


  $av_deb24H_flasque=$flasque_deb24H->fetch();


    $av_debST24H_flasque=$flasque_debST24H->fetch();
 

    $av_debSTT_flasque=$flasque_debSTT->fetch();

  $av_debT24H_flasque=$flasque_debT24H->fetch();
 

  $av_debG24H_flasque=$flasque_debG24H->fetch();



  $av_debGT_flasque=$flasque_debGT->fetch();


// variable en 24H ET TOTAL DEBARQUEMENT FLASQUES ET MOUILLES
      if(empty($av_deb24H_flasque['sum(manif.sac)'])){
        $sac_flasque_24h=0;
      }
      else{
        $sac_flasque_24h= $av_deb24H_flasque['sum(manif.sac)'];
      }
      if(empty($av_deb24H_flasque['sum(manif.poids)'])){
        $poids_flasque_24h=0;
      }
      else{
       $poids_flasque_24h= $av_deb24H_flasque['sum(manif.poids)'];
      }


      if(empty($av_debT24H_flasque['sum(manif.sac)'])){
        $sac_flasque_T24h=0;
      }
      else{
        $sac_flasque_T24h= $av_debT24H_flasque['sum(manif.sac)'];
      }
      if(empty($av_debT24H_flasque['sum(manif.poids)'])){
        $poids_flasque_T24h=0;
      }
      else{
       $poids_flasque_T24h= $av_debT24H_flasque['sum(manif.poids)'];
      } 


      


     

   // variable en SOUS TOTAL DEBARQUEMENT FLASQUES ET MOUILLES
      if(empty($av_debST24H_flasque['sum(manif.sac)'])){
        $sac_flasque_ST24h=0;
      }
      else{
        $sac_flasque_ST24h= $av_debST24H_flasque['sum(manif.sac)'];
      }
      if(empty($av_debST24H_flasque['sum(manif.poids)'])){
        $poids_flasque_ST24h=0;
      }
      else{
       $poids_flasque_ST24h= $av_debST24H_flasque['sum(manif.poids)'];
      } 


      if(empty($av_debSTT_flasque['sum(manif.sac)'])){
        $sac_flasque_STT=0;
      }
      else{
        $sac_flasque_STT= $av_debSTT_flasque['sum(manif.sac)'];
      }
      if(empty($av_debSTT_flasque['sum(manif.poids)'])){
        $poids_flasque_STT=0;
      }
      else{
       $poids_flasque_STT= $av_debSTT_flasque['sum(manif.poids)'];
      } 




// variable en  TOTAL GENERAL DEBARQUEMENT FLASQUES ET MOUILLES
      if(empty($av_debG24H_flasque['sum(manif.sac)'])){
        $sac_flasque_G24h=0;
      }
      else{
        $sac_flasque_G24h= $av_debG24H_flasque['sum(manif.sac)'];
      }
      if(empty($av_debG24H_flasque['sum(manif.poids)'])){
        $poids_flasque_G24h=0;
      }
      else{
       $poids_flasque_G24h= $av_debG24H_flasque['sum(manif.poids)'];
      } 


      if(empty($av_debGT_flasque['sum(manif.sac)'])){
        $sac_flasque_GT=0;
      }
      else{
        $sac_flasque_GT= $av_debGT_flasque['sum(manif.sac)'];
      }
      if(empty($av_debGT_flasque['sum(manif.poids)'])){
        $poids_flasque_GT=0;
      }
      else{
       $poids_flasque_GT= $av_debGT_flasque['sum(manif.poids)'];
      } 


     



               

          if (!empty($fm0['mangasin']) and !empty($fm0['produit'])  and !empty($fm0['poids_kg']) ){ ?>
       <tr style="text-align: center;">
         <td scope="col" class="colLibeles" ><?php echo $fm0['produit']; ?> <?php echo $fm0['poids_kg']; ?> KGS</td>
        <td scope="col" class="colLibeles"><?php echo $fm0['mangasin']  ?></td>
        <td scope="col" class="colLibeles"><?php echo $fm0['client']  ?></td>
       <td scope="col" class="colLibeles"><?php  echo number_format( $fm0['sum(dis.quantite_sac)'] , 0,',',' ')  ?></td> 
       <td scope="col" class="colLibeles"><?php  echo number_format( $fm0['sum(dis.quantite_poids)'] , 3,',',' ')  ?></td> 
           
              <td scope="col" id="colLibeles" ><?php echo number_format( $sac_flasque_24h , 0,',',' '); ?> </td>
     <td scope="col" class="colManifeste"  ><?php echo number_format( $poids_flasque_24h  , 3,',',' '); ?></td>

       <td scope="col" class="colManifeste" ><?php echo number_format( $sac_flasque_T24h , 0,',',' '); ?></td>
    <td class="colDeb24H" scope="col" ><?php echo number_format( $poids_flasque_T24h , 3,',',' '); ?></td>

     

           <td scope="col" class="colDebTOTAL"><?php echo number_format($fm0['sum(dis.quantite_sac)'] - $sac_flasque_T24h , 0,',',' '); ?></td>
     <td scope="col" class="colROB"><?php echo number_format($fm0['sum(dis.quantite_poids)'] - $poids_flasque_T24h  , 3,',',' '); ?></td>



    
     </tr>

  
 <?php } 

 if (!empty($fm0['mangasin']) and empty($fm0['produit'])  and empty($fm0['poids_kg']) ){ ?>
     <tr class="sousTOTAL"> 
      <td  colspan="3">  TOTAL <?php  echo $fm0['mangasin'];  ?></td>
     <td  scope="col" > <?php  echo number_format( $fm0['sum(dis.quantite_sac)'] , 0,',',' ')  ?></td>
     <td  scope="col" > <?php  echo number_format( $fm0['sum(dis.quantite_poids)'] , 3,',',' ')  ?></td>

      <td  scope="col" ><?php echo number_format($sac_flasque_ST24h, 0,',',' '); ?></td>
       <td  scope="col" ><?php echo number_format($poids_flasque_ST24h, 3,',',' '); ?></td>
        <td  scope="col"  ><?php echo number_format($sac_flasque_STT, 0,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format($poids_flasque_STT , 3,',',' '); ?></td>
  
    <td  scope="col" ><?php echo number_format($sac_flasque_ST24h , 0,',',' '); ?></td>
     <td  scope="col" ><?php echo number_format($poids_flasque_ST24h , 3,',',' '); ?></td>   




     </tr>
 <?php 
  }
 if (empty($fm0['mangasin']) and empty($fm0['produit'])  and empty($fm0['poids_kg']) ){ ?>
       <tr class="TOTAL" >
       <td style="color:white;" colspan="3">  TOTAL  </td>
     <td  scope="col" > <?php  echo number_format( $fm0['sum(dis.quantite_sac)'] , 0,',',' ')  ?></td>
     <td  scope="col" > <?php  echo number_format( $fm0['sum(dis.quantite_poids)'] , 3,',',' ')  ?></td>
      <td  scope="col" ><?php echo number_format($sac_flasque_G24h, 0,',',' '); ?></td>
       <td  scope="col" ><?php echo number_format($poids_flasque_G24h, 3,',',' '); ?></td>
        <td  scope="col"  ><?php echo number_format( $sac_flasque_GT , 0,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format( $poids_flasque_GT , 3,',',' '); ?></td>



    <td  scope="col"  ><?php echo number_format($fm0['sum(dis.quantite_sac)'] - $sac_flasque_GT  , 0,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format($fm0['sum(dis.quantite_poids)'] - $poids_flasque_GT  , 3,',',' '); ?></td> 
        </tr>
  <?php  
        } ?> 
 <?php } ?>


</tbody>


</table>    




<?php if(!empty($trP['dates'])){
            $DateDebut=explode('-',$tr['dates']);
           if(!empty($tr2P['dates'])){
            $DateActuel=explode('-',$tr2P['dates']);?>

  <table class='table table-hover table-bordered table-striped' id='tableST' border='2' >
    

<thead>
           <tr style="background: black; color: white; text-align: center; font-weight: bold; " >
           <td colspan="11" ><h4 style="color: white;"> SITUATION DES ENLEVEMENTS <span style="color:yellow;">PAR CLIENT (SAINS + AVARIES)</span> DU <span style="color: red; background: white;"><?php echo  $DateActuel[2]. '-' .$DateActuel[1].'-'.$DateActuel[0];?></span></h4></td></tr>
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
while ($fm0=$STCLIVRAC2->fetch()) { 
  /*$avar=$TSTCLIVRAC->fetch();
  
   

  $cumul_sac=$avar['sum(rm.sac)'];
  $cumul_poids=$avar['sum(rm.poids)'];
  $rob_sac=$fm0['nombre_sac']-$cumul_sac;;
  $rob_poids=$fm0['poids_t']-$cumul_poids; */

           $sain_deb24H=$bdd->prepare("SELECT rm.*, dis.*, d.num_declaration , sum(rm.sac),sum(rm.poids),nc.* from transfert_debarquement as rm
       inner join declaration as d  on d.id_declaration=rm.id_declaration

          inner join dispats as dis on dis.id_dis=d.id_bl
          inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis   where rm.id_navire=? and rm.dates=? and nc.poids_kg=? and nc.id_produit=?  and dis.id_mangasin=?    ");

                  $sain_deb24H->bindParam(1,$a[0]);
                  $sain_deb24H->bindParam(2,$a[1]);
                  $sain_deb24H->bindParam(3,$fm0['poids_kg']);
                  $sain_deb24H->bindParam(4,$fm0['id_produit']);
                  $sain_deb24H->bindParam(5,$fm0['id_mangasin']);
                 
                 
          $sain_deb24H->execute();

        //---REQUETE SAINS ET AVARIES DEBARQUES TOTAL PAR CALE ET PRODUIT


          $sain_debT=$bdd->prepare("SELECT rm.*, dis.*, d.num_declaration , sum(rm.sac),sum(rm.poids),nc.* from transfert_debarquement as rm
        inner join declaration as d  on d.id_declaration=rm.id_declaration

          inner join dispats as dis on dis.id_dis=d.id_bl
          inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis  where rm.id_navire=? and dates<=? and nc.poids_kg=? and nc.id_produit=?  and dis.id_mangasin=?   ");

                  $sain_debT->bindParam(1,$a[0]);
                  $sain_debT->bindParam(2,$a[1]);
                  $sain_debT->bindParam(3,$fm0['poids_kg']);
                  $sain_debT->bindParam(4,$fm0['id_produit']);
                  $sain_debT->bindParam(5,$fm0['id_mangasin']);
                 
          $sain_debT->execute();



 //---REQUETE SOUS TOTAL  SAINS ET AVARIES TOTAL DEBARQUES EN 24 PAR CALE 


         $sain_debST24H=$bdd->prepare("SELECT rm.*, dis.*, d.num_declaration , sum(rm.sac),sum(rm.poids),nc.* from transfert_debarquement as rm
        inner join declaration as d  on d.id_declaration=rm.id_declaration

          inner join dispats as dis on dis.id_dis=d.id_bl
          inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis  where rm.id_navire=? and rm.dates=?   and nc.id_client=?   ");

                  $sain_debST24H->bindParam(1,$a[0]);
                  $sain_debST24H->bindParam(2,$a[1]);

                  $sain_debST24H->bindParam(3,$fm0['id_client']);
                 
  
          $sain_debST24H->execute(); 

 //---REQUETE SOUS TOTAL SAINS ET AVARIES TOTAL DEBARQUES EN  PAR CALE DEPUIS LE DEBUT DU DEBARQUEMENT


         $sain_debSTT=$bdd->prepare("SELECT rm.*, dis.*, d.num_declaration , sum(rm.sac),sum(rm.poids),nc.* from transfert_debarquement as rm
        inner join declaration as d  on d.id_declaration=rm.id_declaration

          inner join dispats as dis on dis.id_dis=d.id_bl
          inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis  where rm.id_navire=? and rm.dates<=?   and nc.id_client=?     ");

                  $sain_debSTT->bindParam(1,$a[0]);
                  $sain_debSTT->bindParam(2,$a[1]);

                  $sain_debSTT->bindParam(3,$fm0['id_client']);
                 
                 
      
          $sain_debSTT->execute(); 


    //---REQUETE  TOTAL GENERAL SAINS ET AVARIES TOTAL DEBARQUES DES CALES DEPUIS LE DEBUT DU DEBARQUEMENT 24H


         $sain_debG24H=$bdd->prepare("SELECT rm.*, dis.*, d.num_declaration , sum(rm.sac),sum(rm.poids),nc.* from transfert_debarquement as rm
        inner join declaration as d  on d.id_declaration=rm.id_declaration

          inner join dispats as dis on dis.id_dis=d.id_bl
          inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis  where rm.id_navire=? and dates=?     ");

                  $sain_debG24H->bindParam(1,$a[0]);
                  $sain_debG24H->bindParam(2,$a[1]);
                  
      
          $sain_debG24H->execute(); 


     //---REQUETE  TOTAL GENERAL SAINS ET AVARIES TOTAL DEBARQUES DES CALES DEPUIS LE DEBUT DU DEBARQUEMENT TOTAL


         $sain_debGT=$bdd->prepare("SELECT rm.*, dis.*, d.num_declaration , sum(rm.sac),sum(rm.poids),nc.* from transfert_debarquement as rm
        inner join declaration as d  on d.id_declaration=rm.id_declaration

          inner join dispats as dis on dis.id_dis=d.id_bl
          inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis  where rm.id_navire=? and dates<=?     ");

                  $sain_debGT->bindParam(1,$a[0]);
                  $sain_debGT->bindParam(2,$a[1]);
                  
          $sain_debGT->execute();           




          



      
       $s_deb=$sain_deb24H->fetch();
     
       $s_debT=$sain_debT->fetch();
       //$avaries2=$fm->fetch();
      
       $s_debST=$sain_debST24H->fetch();

      
       $s_debSTT=$sain_debSTT->fetch();

       
       $s_debG=$sain_debG24H->fetch();

     
       $s_debGT=$sain_debGT->fetch();


     

      //VARIABLES SAINS
      if(empty($s_deb['sum(rm.sac)'])){
        $sac_sains=0;
      }
      else{
        $sac_sains= $s_deb['sum(rm.sac)'];
      }
      if(empty($s_deb['sum(rm.poids)'])){
        $poids_sains=0;
      }
      else{
        $poids_sains= $s_deb['sum(rm.poids)'];
      }

      if(empty($s_debT['sum(rm.sac)'])){
        $sac_sainsT=0;
      }
      else{
        $sac_sainsT= $s_debT['sum(rm.sac)'];
      }
      if(empty($s_debT['sum(rm.poids)'])){
        $poids_sainsT=0;
      }
      else{
        $poids_sainsT= $s_debT['sum(rm.poids)'];
      }

      if(empty($s_debST['sum(rm.sac)'])){
        $sac_sainsST=0;
      }
      else{
        $sac_sainsST= $s_debST['sum(rm.sac)'];
      }
      if(empty($s_debST['sum(rm.poids)'])){
        $poids_sainsST=0;
      }
      else{
        $poids_sainsST= $s_debST['sum(rm.poids)'];
      }

       if(empty($s_debSTT['sum(rm.sac)'])){
        $sac_sainsSTT=0;
      }
      else{
        $sac_sainsSTT= $s_debSTT['sum(rm.sac)'];
      }
      if(empty($s_debSTT['sum(rm.poids)'])){
        $poids_sainsSTT=0;
      }
      else{
        $poids_sainsSTT= $s_debSTT['sum(rm.poids)'];
      }

      if(empty($s_debG['sum(rm.sac)'])){
        $sac_sainsG=0;
      }
      else{
        $sac_sainsG= $s_debG['sum(rm.sac)'];
      }
      if(empty($s_debG['sum(rm.poids)'])){
        $poids_sainsG=0;
      }
      else{
        $poids_sainsG= $s_debG['sum(rm.poids)'];
      }

      if(empty($s_debGT['sum(rm.sac)'])){
        $sac_sainsGT=0;
      }
      else{
        $sac_sainsGT= $s_debGT['sum(rm.sac)'];
      }
      if(empty($s_debGT['sum(rm.poids)'])){
        $poids_sainsGT=0;
      }
      else{
        $poids_sainsGT= $s_debGT['sum(rm.poids)'];
      }      
  

  if (!empty($fm0['client']) and !empty($fm0['id_produit']) and !empty($fm0['poids_kg']) and !empty($fm0['id_mangasin']) ){ ?>
       <tr >
        <td scope="col" id="colLibeles" ><?php echo $fm0['client']  ?></td>
            <td scope="col" id="colLibeles"  ><?php echo $fm0['produit']; ?> <?php echo $fm0['poids_kg']; ?> KGS</td>
              <td scope="col" id="colLibeles" ><?php echo $fm0['mangasin']; ?> </td>
    <td scope="col" id="colManifeste"  ><?php echo number_format($fm0['sum(dis.quantite_sac)'], 0,',',' ');  ?></td>
       <td scope="col" id="colManifeste" ><?php echo number_format($fm0['sum(dis.quantite_poids)'], 3,',',' '); ?></td>
    <td id="colDeb24H" scope="col" ><?php echo number_format( $sac_sains , 0,',',' '); ?></td>
      <td id="colDeb24H" scope="col"  ><?php echo number_format( $poids_sains  , 3,',',' '); ?></td>
      <td scope="col" id="colDebTOTAL"><?php echo number_format( $sac_sainsT , 0,',',' '); ?></td>
      <td scope="col" id="colDebTOTAL"><?php echo number_format( $poids_sainsT  , 3,',',' '); ?></td>
     <td scope="col" id="colROB"><?php echo number_format($fm0['sum(dis.quantite_sac)']- $sac_sainsT , 0,',',' '); ?></td>
      <td scope="col" id="colROB" ><?php echo number_format($fm0['sum(dis.quantite_poids)']- $poids_sainsT , 3,',',' '); ?></td>
     </tr>

  
 <?php } 

 if (!empty($fm0['client']) and empty($fm0['id_produit']) and empty($fm0['poids_kg']) and empty($fm0['id_mangasin']) ){ ?>
       <tr > 
      <td id="sousTOTAL" colspan="3">  TOTAL <?php  echo $fm0['client'];  ?> <?php  echo $fm0['id_produit']; ?> <?php  echo $fm0['id_mangasin']; ?> <?php  echo $fm0['poids_kg']; ?></td>
      <td id="sousTOTAL" scope="col" ><?php echo number_format($fm0['sum(dis.quantite_sac)'], 0,',',' '); ?></td>
       <td id="sousTOTAL" scope="col" ><?php echo number_format($fm0['sum(dis.quantite_poids)'], 3,',',' '); ?></td>
        <td id="sousTOTAL" scope="col"  ><?php echo number_format($sac_sainsST, 0,',',' '); ?></td>
          <td id="sousTOTAL" scope="col"  ><?php echo number_format($poids_sainsST , 3,',',' '); ?></td>
          <td id="sousTOTAL" scope="col"  ><?php echo number_format($sac_sainsSTT  , 0,',',' '); ?></td>
          <td id="sousTOTAL" scope="col"  ><?php echo number_format($poids_sainsSTT , 3,',',' '); ?></td>
          <td id="sousTOTAL" scope="col"  ><?php echo number_format($fm0['sum(dis.quantite_sac)']- $sac_sainsSTT , 0,',',' '); ?></td>
          <td id="sousTOTAL" scope="col"  ><?php echo number_format($fm0['sum(dis.quantite_poids)']- $poids_sainsSTT , 3,',',' '); ?></td>          

     </tr>
  
 <?php //} } } 
}
 if (empty($fm0['client']) and empty($fm0['id_produit']) and empty($fm0['poids_kg']) and empty($fm0['id_mangasin']) ){ ?>
       <tr class="CelluleTotal2" >
       <td id="TOTAL" colspan="3">  TOTAL </td>
      <td id="TOTAL" scope="col" ><?php echo number_format($fm0['sum(dis.quantite_sac)'], 0,',',' '); ?></td>
       <td id="TOTAL" scope="col" ><?php echo number_format($fm0['sum(dis.quantite_poids)'], 3,',',' '); ?></td>
        <td id="TOTAL" scope="col"  ><?php echo number_format( $sac_sainsG , 0,',',' '); ?></td>
          <td id="TOTAL" scope="col"  ><?php echo number_format( $poids_sainsG , 3,',',' '); ?></td>
          <td id="TOTAL" scope="col"  ><?php echo number_format($sac_sainsGT , 0,',',' '); ?></td>
          <td id="TOTAL" scope="col"  ><?php echo number_format( $poids_sainsGT , 3,',',' '); ?></td>
          <td id="TOTAL" scope="col"  ><?php echo number_format($fm0['sum(dis.quantite_sac)']-  $sac_sainsGT , 0,',',' '); ?></td>
          <td id="TOTAL" scope="col"  ><?php echo number_format($fm0['sum(dis.quantite_poids)']-  $poids_sainsGT , 3,',',' '); ?></td> 
        </tr>
  <?php //} } }
   } ?> 
 <?php } ?>

</tbody>
</table>



<a style="margin:auto-right;" class="btn btn-primary no_print" data-role="imprimer_par_destination">imprimer</a>
</div>







<?php $destination1=$_POST['transfert_sain_deb']; ?>

<div class="col col-lg-12" id="deb_by_destination_all"  <?php if($destination1==0){

 ?> style="display: none;" <?php } ?>  <?php if($destination1==1){

 ?> style="display: block;" <?php } ?>>




<?php if(!empty($trP['dates'])){
            $DateDebut=explode('-',$tr['dates']);
           if(!empty($tr2P['dates'])){
            $DateActuel=explode('-',$tr2P['dates']);?>

            

  <table class='table table-hover table-bordered ' id='table' border='2' >
    
 
<thead>
           <tr style="background: black; color: white; text-align: center; font-weight: bold; " >
           <td colspan="11" ><h4 style="color: white;"> SITUATION DES ENLEVEMENTS <span style="color:yellow;">PAR DESTINATION (SAINS )</span> DU <span style="color: red; background: white;"><?php echo  $DateActuel[2]. '-' .$DateActuel[1].'-'.$DateActuel[0];?> <?php echo $_POST['deb_destination']; ?></span></h4></td></tr>
<?php 
         }  }
   ?>
 
  
 <tr  style="background-color: rgba(50, 159, 218, 0.9); text-align: center;"  >
      
      
    
       <td scope="col"  rowspan="3" class="colLibeles" >DESTINATION</td>
        <td scope="col" rowspan="3" class="colLibeles" >PRODUIT</td>
        <td scope="col"  rowspan="3" class="colLibeles" >CLIENT</td>
       
      
     
  </tr>
    <tr style="background-color: rgba(50, 159, 218, 0.9); text-align: center;" >
      
      <td scope="col" colspan="2" class="colManifeste" >MANIFESTE</td>
      <td scope="col" colspan="2" class="colDeb24H">DEB 24H</td>
     
      <td scope="col" colspan="2" class="colDebTOTAL">TOTAL DEB</td>
      <td scope="col" colspan="2" class="colROB">ROB</td>
     
      </tr>
     
        

      <tr >
        <td scope="col" class="colManifeste" >NBRE SACS</td>
      <td scope="col" class="colManifeste" >POIDS</td>
        <td scope="col"  class="colDeb24H">NBRE SACS</td>
      <td scope="col" class="colDeb24H">POIDS</td>
        <td scope="col" class="colDebTOTAL"  >NBRE SACS</td>
      <td scope="col"  class="colDebTOTAL">POIDS</td>
       <td scope="col"  class="colROB">NBRE SACS</td>
      <td scope="col"  class="colROB">POIDS</td>
     
      
      
    
       </tr>
         </thead>
<tbody>

  <?php 
while ($fm0=$dispatching_all->fetch()) { 
 /* $avar=$TSTDVRAC->fetch();
  
  */

   //---REQUETE SAINS  DEBARQUES EN 24 PAR CALE ET PRODUIT

       
          $sain_deb24H=$bdd->prepare("SELECT rm.*, dis.* ,d.num_declaration, sum(rm.sac),sum(rm.poids),nc.*,p.*,mg.mangasin from transfert_debarquement as rm
         left join declaration as d  on d.id_declaration=rm.id_declaration

          inner join dispats as dis on dis.id_dis=d.id_bl
          inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
          inner join produit_deb as p on p.id=nc.id_produit
          inner join mangasin as mg on mg.id=dis.id_mangasin 
           where rm.id_navire=? and rm.dates=? and nc.poids_kg=? and nc.id_produit=?  and dis.id_mangasin=?  and rm.statut='sain'    ");

                  $sain_deb24H->bindParam(1,$a[0]);
                  $sain_deb24H->bindParam(2,$a[1]);
                  $sain_deb24H->bindParam(3,$fm0['poids_kg']);
                  $sain_deb24H->bindParam(4,$fm0['id_produit']);
                  $sain_deb24H->bindParam(5,$fm0['id_mangasin']);
                 
          $sain_deb24H->execute();

        //---REQUETE SAINS ET AVARIES DEBARQUES TOTAL PAR CALE ET PRODUIT


          $sain_debT=$bdd->prepare("SELECT rm.*, dis.*, d.num_declaration , sum(rm.sac),sum(rm.poids), nc.*,p.produit,mg.mangasin from transfert_debarquement as rm
          left join declaration as d on d.id_declaration=rm.id_declaration

          inner join dispats as dis on dis.id_dis=d.id_bl
          inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
                    inner join produit_deb as p on p.id=nc.id_produit
          inner join mangasin as mg on mg.id=dis.id_mangasin
            where rm.id_navire=? and rm.dates<=? and nc.poids_kg=? and nc.id_produit=?  and dis.id_mangasin=? and rm.statut='sain'   ");

                  $sain_debT->bindParam(1,$a[0]);
                  $sain_debT->bindParam(2,$a[1]);
                  $sain_debT->bindParam(3,$fm0['poids_kg']);
                  $sain_debT->bindParam(4,$fm0['id_produit']);
                  $sain_debT->bindParam(5,$fm0['id_mangasin']);
                 
          $sain_debT->execute();



 //---REQUETE SOUS TOTAL  SAINS ET AVARIES TOTAL DEBARQUES EN 24 PAR CALE 


         $sain_debST24H=$bdd->prepare("SELECT rm.*, dis.*, d.id_declaration , sum(rm.sac),sum(rm.poids),nc.* from transfert_debarquement as rm
                     left join declaration as d on d.id_declaration=rm.id_declaration

          inner join dispats as dis on dis.id_dis=d.id_bl
           inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
         
            where rm.id_navire=? and rm.dates=? and  dis.id_mangasin=? and rm.statut='sain'   ");

                  $sain_debST24H->bindParam(1,$a[0]);
                  $sain_debST24H->bindParam(2,$a[1]);

                  $sain_debST24H->bindParam(3,$fm0['id_mangasin']);
                 
  
          $sain_debST24H->execute(); 

 //---REQUETE SOUS TOTAL SAINS ET AVARIES TOTAL DEBARQUES EN  PAR CALE DEPUIS LE DEBUT DU DEBARQUEMENT


         $sain_debSTT=$bdd->prepare("SELECT rm.*, dis.*, d.id_declaration , sum(rm.sac),sum(rm.poids),nc.* from transfert_debarquement as rm
                     left join declaration as d on d.id_declaration=rm.id_declaration

          inner join dispats as dis on dis.id_dis=d.id_bl
           inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
         
            where rm.id_navire=? and rm.dates<=? and  dis.id_mangasin=? and rm.statut='sain'   ");

                  $sain_debSTT->bindParam(1,$a[0]);
                  $sain_debSTT->bindParam(2,$a[1]);

                  $sain_debSTT->bindParam(3,$fm0['id_mangasin']);
                 
                 
      
          $sain_debSTT->execute(); 


    //---REQUETE  TOTAL GENERAL SAINS ET AVARIES TOTAL DEBARQUES DES CALES DEPUIS LE DEBUT DU DEBARQUEMENT 24H


         $sain_debG24H=$bdd->prepare("SELECT rm.*, dis.*, d.num_declaration , sum(rm.sac),sum(rm.poids),nc.*,p.produit,mg.mangasin from transfert_debarquement as rm
       left join declaration as d  on d.id_declaration=rm.id_declaration

          inner join dispats as dis on dis.id_dis=d.id_bl
           inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
              inner join produit_deb as p on p.id=nc.id_produit
          inner join mangasin as mg on mg.id=dis.id_mangasin
           where rm.id_navire=? and rm.dates=? and rm.statut='sain'   ");

                  $sain_debG24H->bindParam(1,$a[0]);
                  $sain_debG24H->bindParam(2,$a[1]);
                  
      
          $sain_debG24H->execute(); 


     //---REQUETE  TOTAL GENERAL SAINS ET AVARIES TOTAL DEBARQUES DES CALES DEPUIS LE DEBUT DU DEBARQUEMENT TOTAL


         $sain_debGT=$bdd->prepare("SELECT rm.*, dis.*, d.num_declaration, sum(rm.sac),sum(rm.poids),nc.*,p.produit,mg.mangasin from transfert_debarquement as rm
        left join declaration as d  on d.id_declaration=rm.id_declaration

         inner join dispats as dis on dis.id_dis=d.id_bl
          inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
                    inner join produit_deb as p on p.id=nc.id_produit
          inner join mangasin as mg on mg.id=dis.id_mangasin
           where rm.id_navire=? and rm.dates<=? and rm.statut='sain'  ");

                  $sain_debGT->bindParam(1,$a[0]);
                  $sain_debGT->bindParam(2,$a[1]);
                  
          $sain_debGT->execute();           



      
       $s_deb=$sain_deb24H->fetch();
     
       $s_debT=$sain_debT->fetch();
       //$avaries2=$fm->fetch();
      
       $s_debST=$sain_debST24H->fetch();

      
       $s_debSTT=$sain_debSTT->fetch();

       
       $s_debG=$sain_debG24H->fetch();

     
       $s_debGT=$sain_debGT->fetch();


     

      //VARIABLES SAINS
      if(empty($s_deb['sum(rm.sac)'])){
        $sac_sains=0;
      }
      else{
        $sac_sains= $s_deb['sum(rm.sac)'];
      }
      if(empty($s_deb['sum(rm.poids)'])){
        $poids_sains=0;
      }
      else{
        $poids_sains= $s_deb['sum(rm.poids)'];
      }

      if(empty($s_debT['sum(rm.sac)'])){
        $sac_sainsT=0;
      }
      else{
        $sac_sainsT= $s_debT['sum(rm.sac)'];
      }
      if(empty($s_debT['sum(rm.poids)'])){
        $poids_sainsT=0;
      }
      else{
        $poids_sainsT= $s_debT['sum(rm.poids)'];
      }

      if(empty($s_debST['sum(rm.sac)'])){
        $sac_sainsST=0;
      }
      else{
        $sac_sainsST= $s_debST['sum(rm.sac)'];
      }
      if(empty($s_debST['sum(rm.poids)'])){
        $poids_sainsST=0;
      }
      else{
        $poids_sainsST= $s_debST['sum(rm.poids)'];
      }

       if(empty($s_debSTT['sum(rm.sac)'])){
        $sac_sainsSTT=0;
      }
      else{
        $sac_sainsSTT= $s_debSTT['sum(rm.sac)'];
      }
      if(empty($s_debSTT['sum(rm.poids)'])){
        $poids_sainsSTT=0;
      }
      else{
        $poids_sainsSTT= $s_debSTT['sum(rm.poids)'];
      }

      if(empty($s_debG['sum(rm.sac)'])){
        $sac_sainsG=0;
      }
      else{
        $sac_sainsG= $s_debG['sum(rm.sac)'];
      }
      if(empty($s_debG['sum(rm.poids)'])){
        $poids_sainsG=0;
      }
      else{
        $poids_sainsG= $s_debG['sum(rm.poids)'];
      }

      if(empty($s_debGT['sum(rm.sac)'])){
        $sac_sainsGT=0;
      }
      else{
        $sac_sainsGT= $s_debGT['sum(rm.sac)'];
      }
      if(empty($s_debGT['sum(rm.poids)'])){
        $poids_sainsGT=0;
      }
      else{
        $poids_sainsGT= $s_debGT['sum(rm.poids)'];
      }      
      

  if (!empty($fm0['mangasin']) and !empty($fm0['produit'])  and !empty($fm0['poids_kg']) ){ ?>
       <tr style="text-align: center;">
        <td scope="col" class="colLibeles"><?php echo $fm0['mangasin']  ?></td>
            <td scope="col" class="colLibeles" ><?php echo $fm0['produit']; ?> <?php echo $fm0['poids_kg']; ?> KGS</td>
              <td scope="col" id="colLibeles" ><?php echo $fm0['client']; ?> </td>

     <td scope="col" class="colManifeste"  ><?php echo number_format($fm0['sum(dis.quantite_sac)'], 0,',',' ');  ?></td>
       <td scope="col" class="colManifeste" ><?php echo number_format($fm0['sum(dis.quantite_poids)'], 3,',',' '); ?></td>
    <td class="colDeb24H" scope="col" ><?php echo number_format( $sac_sains , 0,',',' '); ?></td>
      <td class="colDeb24H" scope="col"  ><?php echo number_format( $poids_sains  , 3,',',' '); ?></td>
      <td scope="col" class="colDebTOTAL"><?php echo number_format( $sac_sainsT , 0,',',' '); ?></td>
      <td scope="col" class="colDebTOTAL"><?php echo number_format( $poids_sainsT  , 3,',',' '); ?></td>
     <td scope="col" class="colROB"><?php echo number_format($fm0['sum(dis.quantite_sac)']- $sac_sainsT , 0,',',' '); ?></td>
      <td scope="col" class="colROB" ><?php echo number_format($fm0['sum(dis.quantite_poids)']- $poids_sainsT , 3,',',' '); ?></td>
     </tr>

  
 <?php } 

 if (!empty($fm0['mangasin']) and empty($fm0['produit'])  and empty($fm0['poids_kg']) ){ ?>
     <tr class="sousTOTAL"> 
      <td  colspan="3">  TOTAL <?php  echo $fm0['mangasin'];  ?></td>
      <td  scope="col" ><?php echo number_format($fm0['sum(dis.quantite_sac)'], 0,',',' '); ?></td>
       <td  scope="col" ><?php echo number_format($fm0['sum(dis.quantite_poids)'], 3,',',' '); ?></td>
        <td  scope="col"  ><?php echo number_format($sac_sainsST, 0,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format($poids_sainsST , 3,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format($sac_sainsSTT  , 0,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format($poids_sainsSTT , 3,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format($fm0['sum(dis.quantite_sac)']- $sac_sainsSTT , 0,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format($fm0['sum(dis.quantite_poids)']- $poids_sainsSTT , 3,',',' '); ?></td>          

     </tr>
 <?php 
  }
 if (empty($fm0['mangasin']) and empty($fm0['produit'])  and empty($fm0['poids_kg']) ){ ?>
       <tr class="TOTAL" >
       <td style="color:white;" colspan="3">  TOTAL <?php echo $fm0['num_connaissement'] ?> </td>
      <td  scope="col" ><?php echo number_format($fm0['sum(dis.quantite_sac)'], 0,',',' '); ?></td>
       <td  scope="col" ><?php echo number_format($fm0['sum(dis.quantite_poids)'], 3,',',' '); ?></td>
        <td  scope="col"  ><?php echo number_format( $sac_sainsG , 0,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format( $poids_sainsG , 3,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format($sac_sainsGT , 0,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format( $poids_sainsGT , 3,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format($fm0['sum(dis.quantite_sac)']-  $sac_sainsGT , 0,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format($fm0['sum(dis.quantite_poids)']-  $poids_sainsGT , 3,',',' '); ?></td> 
        </tr>
  <?php  
        } ?> 
 <?php } ?>
</tbody>
</table>

<?php if(!empty($trP['dates'])){
            $DateDebut=explode('-',$tr['dates']);
           if(!empty($tr2P['dates'])){
            $DateActuel=explode('-',$tr2P['dates']);?>

            

  <table class='table table-hover table-bordered ' id='table' border='2' >
    
 
<thead>
           <tr style="background: black; color: white; text-align: center; font-weight: bold; " >
           <td colspan="11" ><h4 style="color: white;"> SITUATION DES ENLEVEMENTS <span style="color:yellow;">PAR PRODUIT (SAINS )</span> DU <span style="color: red; background: white;"><?php echo  $DateActuel[2]. '-' .$DateActuel[1].'-'.$DateActuel[0];?> <?php echo $_POST['deb_destination']; ?></span></h4></td></tr>
<?php 
         }  }
   ?>
 
  
 <tr  style="background-color: rgba(50, 159, 218, 0.9); text-align: center;"  >
      
      
    
      
        <td scope="col" rowspan="3" class="colLibeles" >PRODUIT</td>
         <td scope="col"  rowspan="3" class="colLibeles" >DESTINATION</td>
        <td scope="col"  rowspan="3" class="colLibeles" >CLIENT</td>
       
      
     
  </tr>
    <tr style="background-color: rgba(50, 159, 218, 0.9); text-align: center;" >
      
      <td scope="col" colspan="2" class="colManifeste" >MANIFESTE</td>
      <td scope="col" colspan="2" class="colDeb24H">DEB 24H</td>
     
      <td scope="col" colspan="2" class="colDebTOTAL">TOTAL DEB</td>
      <td scope="col" colspan="2" class="colROB">ROB</td>
     
      </tr>
     
        

      <tr >
        <td scope="col" class="colManifeste" >NBRE SACS</td>
      <td scope="col" class="colManifeste" >POIDS</td>
        <td scope="col"  class="colDeb24H">NBRE SACS</td>
      <td scope="col" class="colDeb24H">POIDS</td>
        <td scope="col" class="colDebTOTAL"  >NBRE SACS</td>
      <td scope="col"  class="colDebTOTAL">POIDS</td>
       <td scope="col"  class="colROB">NBRE SACS</td>
      <td scope="col"  class="colROB">POIDS</td>
     
      
      
    
       </tr>
         </thead>
<tbody>

        <?php 
while ($fm0=$dispatching_produit_all->fetch()) { 
 /* $avar=$TSTDVRAC->fetch();
  
  */

   //---REQUETE SAINS  DEBARQUES EN 24 PAR CALE ET PRODUIT

       
          $flasque_deb24H=$bdd->prepare("SELECT manif.*, dis.* ,d.num_declaration, sum(manif.sac),sum(manif.poids),nc.*,p.*,mg.mangasin from transfert_debarquement as manif
         left join declaration as d  on d.id_declaration=manif.id_declaration

          inner join dispats as dis on dis.id_dis=d.id_bl
          inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
          inner join produit_deb as p on p.id=nc.id_produit
          inner join mangasin as mg on mg.id=dis.id_mangasin 
           where manif.id_navire=? and manif.dates=? and nc.poids_kg=? and nc.id_produit=?  and dis.id_mangasin=? and manif.statut='sain'     ");

                  $flasque_deb24H->bindParam(1,$a[0]);
                  $flasque_deb24H->bindParam(2,$a[1]);
                  $flasque_deb24H->bindParam(3,$fm0['poids_kg']);
                  $flasque_deb24H->bindParam(4,$fm0['id_produit']);
                  $flasque_deb24H->bindParam(5,$fm0['id_mangasin']);
                 
          $flasque_deb24H->execute(); 

  $flasque_debST24H=$bdd->prepare("SELECT manif.*, dis.* ,d.num_declaration, sum(manif.sac),sum(manif.poids),nc.*,p.*,mg.mangasin from transfert_debarquement as manif
         left join declaration as d  on d.id_declaration=manif.id_declaration

          inner join dispats as dis on dis.id_dis=d.id_bl
          inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
          inner join produit_deb as p on p.id=nc.id_produit
          inner join mangasin as mg on mg.id=dis.id_mangasin 
           where manif.id_navire=? and manif.dates=?   and dis.id_mangasin=?   and manif.statut='sain'   ");

                  $flasque_debST24H->bindParam(1,$a[0]);
                  $flasque_debST24H->bindParam(2,$a[1]);

                  $flasque_debST24H->bindParam(3,$fm0['id_mangasin']);
                 
          $flasque_debST24H->execute();

   $flasque_debSTT=$bdd->prepare("SELECT manif.*, dis.* ,d.num_declaration, sum(manif.sac),sum(manif.poids),nc.*,p.*,mg.mangasin from transfert_debarquement as manif
         left join declaration as d  on d.id_declaration=manif.id_declaration

          inner join dispats as dis on dis.id_dis=d.id_bl
          inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
          inner join produit_deb as p on p.id=nc.id_produit
          inner join mangasin as mg on mg.id=dis.id_mangasin 
           where manif.id_navire=? and manif.dates<=?  and dis.id_mangasin=?  and manif.statut='sain'   ");

                   $flasque_debSTT->bindParam(1,$a[0]);
                   $flasque_debSTT->bindParam(2,$a[1]);

                   $flasque_debSTT->bindParam(3,$fm0['id_mangasin']);
                 
           $flasque_debSTT->execute();                    

            $flasque_debT24H=$bdd->prepare("SELECT manif.*, dis.* ,d.num_declaration, sum(manif.sac),sum(manif.poids),nc.*,p.*,mg.mangasin from transfert_debarquement as manif
         left join declaration as d  on d.id_declaration=manif.id_declaration

          inner join dispats as dis on dis.id_dis=d.id_bl
          inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
          inner join produit_deb as p on p.id=nc.id_produit
          inner join mangasin as mg on mg.id=dis.id_mangasin 
           where manif.id_navire=? and manif.dates<=? and nc.poids_kg=? and nc.id_produit=?  and dis.id_mangasin=?  and manif.statut='sain'  ");

                  $flasque_debT24H->bindParam(1,$a[0]);
                  $flasque_debT24H->bindParam(2,$a[1]);
                  $flasque_debT24H->bindParam(3,$fm0['poids_kg']);
                  $flasque_debT24H->bindParam(4,$fm0['id_produit']);
                  $flasque_debT24H->bindParam(5,$fm0['id_mangasin']);
                 
          $flasque_debT24H->execute();


     $flasque_debG24H=$bdd->prepare("SELECT manif.*, dis.* ,d.num_declaration, sum(manif.sac),sum(manif.poids),nc.*,p.*,mg.mangasin from transfert_debarquement as manif
         left join declaration as d  on d.id_declaration=manif.id_declaration

          inner join dispats as dis on dis.id_dis=d.id_bl
          inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
          inner join produit_deb as p on p.id=nc.id_produit
          inner join mangasin as mg on mg.id=dis.id_mangasin 
           where manif.id_navire=? and manif.dates=?  and manif.statut='sain'    ");

                  $flasque_debG24H->bindParam(1,$a[0]);
                  $flasque_debG24H->bindParam(2,$a[1]);

                  
                 
          $flasque_debG24H->execute();   

    $flasque_debGT=$bdd->prepare("SELECT manif.*, dis.* ,d.num_declaration, sum(manif.sac),sum(manif.poids),nc.*,p.*,mg.mangasin from transfert_debarquement as manif
         left join declaration as d  on d.id_declaration=manif.id_declaration

          inner join dispats as dis on dis.id_dis=d.id_bl
          inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
          inner join produit_deb as p on p.id=nc.id_produit
          inner join mangasin as mg on mg.id=dis.id_mangasin 
           where manif.id_navire=? and manif.dates<=? and manif.statut='sain'     ");

                  $flasque_debGT->bindParam(1,$a[0]);
                  $flasque_debGT->bindParam(2,$a[1]);

                  
                 
          $flasque_debGT->execute();                


   


  $av_deb24H_flasque=$flasque_deb24H->fetch();


    $av_debST24H_flasque=$flasque_debST24H->fetch();
 

    $av_debSTT_flasque=$flasque_debSTT->fetch();

  $av_debT24H_flasque=$flasque_debT24H->fetch();
 

  $av_debG24H_flasque=$flasque_debG24H->fetch();



  $av_debGT_flasque=$flasque_debGT->fetch();


// variable en 24H ET TOTAL DEBARQUEMENT FLASQUES ET MOUILLES
      if(empty($av_deb24H_flasque['sum(manif.sac)'])){
        $sac_flasque_24h=0;
      }
      else{
        $sac_flasque_24h= $av_deb24H_flasque['sum(manif.sac)'];
      }
      if(empty($av_deb24H_flasque['sum(manif.poids)'])){
        $poids_flasque_24h=0;
      }
      else{
       $poids_flasque_24h= $av_deb24H_flasque['sum(manif.poids)'];
      }


      if(empty($av_debT24H_flasque['sum(manif.sac)'])){
        $sac_flasque_T24h=0;
      }
      else{
        $sac_flasque_T24h= $av_debT24H_flasque['sum(manif.sac)'];
      }
      if(empty($av_debT24H_flasque['sum(manif.poids)'])){
        $poids_flasque_T24h=0;
      }
      else{
       $poids_flasque_T24h= $av_debT24H_flasque['sum(manif.poids)'];
      } 


      


     

   // variable en SOUS TOTAL DEBARQUEMENT FLASQUES ET MOUILLES
      if(empty($av_debST24H_flasque['sum(manif.sac)'])){
        $sac_flasque_ST24h=0;
      }
      else{
        $sac_flasque_ST24h= $av_debST24H_flasque['sum(manif.sac)'];
      }
      if(empty($av_debST24H_flasque['sum(manif.poids)'])){
        $poids_flasque_ST24h=0;
      }
      else{
       $poids_flasque_ST24h= $av_debST24H_flasque['sum(manif.poids)'];
      } 


      if(empty($av_debSTT_flasque['sum(manif.sac)'])){
        $sac_flasque_STT=0;
      }
      else{
        $sac_flasque_STT= $av_debSTT_flasque['sum(manif.sac)'];
      }
      if(empty($av_debSTT_flasque['sum(manif.poids)'])){
        $poids_flasque_STT=0;
      }
      else{
       $poids_flasque_STT= $av_debSTT_flasque['sum(manif.poids)'];
      } 




// variable en  TOTAL GENERAL DEBARQUEMENT FLASQUES ET MOUILLES
      if(empty($av_debG24H_flasque['sum(manif.sac)'])){
        $sac_flasque_G24h=0;
      }
      else{
        $sac_flasque_G24h= $av_debG24H_flasque['sum(manif.sac)'];
      }
      if(empty($av_debG24H_flasque['sum(manif.poids)'])){
        $poids_flasque_G24h=0;
      }
      else{
       $poids_flasque_G24h= $av_debG24H_flasque['sum(manif.poids)'];
      } 


      if(empty($av_debGT_flasque['sum(manif.sac)'])){
        $sac_flasque_GT=0;
      }
      else{
        $sac_flasque_GT= $av_debGT_flasque['sum(manif.sac)'];
      }
      if(empty($av_debGT_flasque['sum(manif.poids)'])){
        $poids_flasque_GT=0;
      }
      else{
       $poids_flasque_GT= $av_debGT_flasque['sum(manif.poids)'];
      } 


     



               

          if (!empty($fm0['mangasin']) and !empty($fm0['produit'])  and !empty($fm0['poids_kg']) ){ ?>
       <tr style="text-align: center;">
         <td scope="col" class="colLibeles" ><?php echo $fm0['produit']; ?> <?php echo $fm0['poids_kg']; ?> KGS</td>
        <td scope="col" class="colLibeles"><?php echo $fm0['mangasin']  ?></td>
        <td scope="col" class="colLibeles"><?php echo $fm0['client']  ?></td>
       <td scope="col" class="colLibeles"><?php  echo number_format( $fm0['sum(dis.quantite_sac)'] , 0,',',' ')  ?></td> 
       <td scope="col" class="colLibeles"><?php  echo number_format( $fm0['sum(dis.quantite_poids)'] , 3,',',' ')  ?></td> 
           
              <td scope="col" id="colLibeles" ><?php echo number_format( $sac_flasque_24h , 0,',',' '); ?> </td>
     <td scope="col" class="colManifeste"  ><?php echo number_format( $poids_flasque_24h  , 3,',',' '); ?></td>

       <td scope="col" class="colManifeste" ><?php echo number_format( $sac_flasque_T24h , 0,',',' '); ?></td>
    <td class="colDeb24H" scope="col" ><?php echo number_format( $poids_flasque_T24h , 3,',',' '); ?></td>

     

           <td scope="col" class="colDebTOTAL"><?php echo number_format($fm0['sum(dis.quantite_sac)'] - $sac_flasque_T24h , 0,',',' '); ?></td>
     <td scope="col" class="colROB"><?php echo number_format($fm0['sum(dis.quantite_poids)'] - $poids_flasque_T24h  , 3,',',' '); ?></td>



    
     </tr>

  
 <?php } 

 if (!empty($fm0['mangasin']) and empty($fm0['produit'])  and empty($fm0['poids_kg']) ){ ?>
     <tr class="sousTOTAL"> 
      <td  colspan="3">  TOTAL <?php  echo $fm0['mangasin'];  ?></td>
     <td  scope="col" > <?php  echo number_format( $fm0['sum(dis.quantite_sac)'] , 0,',',' ')  ?></td>
     <td  scope="col" > <?php  echo number_format( $fm0['sum(dis.quantite_poids)'] , 3,',',' ')  ?></td>

      <td  scope="col" ><?php echo number_format($sac_flasque_ST24h, 0,',',' '); ?></td>
       <td  scope="col" ><?php echo number_format($poids_flasque_ST24h, 3,',',' '); ?></td>
        <td  scope="col"  ><?php echo number_format($sac_flasque_STT, 0,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format($poids_flasque_STT , 3,',',' '); ?></td>
  
    <td  scope="col" ><?php echo number_format($sac_flasque_ST24h , 0,',',' '); ?></td>
     <td  scope="col" ><?php echo number_format($poids_flasque_ST24h , 3,',',' '); ?></td>   




     </tr>
 <?php 
  }
 if (empty($fm0['mangasin']) and empty($fm0['produit'])  and empty($fm0['poids_kg']) ){ ?>
       <tr class="TOTAL" >
       <td style="color:white;" colspan="3">  TOTAL  </td>
     <td  scope="col" > <?php  echo number_format( $fm0['sum(dis.quantite_sac)'] , 0,',',' ')  ?></td>
     <td  scope="col" > <?php  echo number_format( $fm0['sum(dis.quantite_poids)'] , 3,',',' ')  ?></td>
      <td  scope="col" ><?php echo number_format($sac_flasque_G24h, 0,',',' '); ?></td>
       <td  scope="col" ><?php echo number_format($poids_flasque_G24h, 3,',',' '); ?></td>
        <td  scope="col"  ><?php echo number_format( $sac_flasque_GT , 0,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format( $poids_flasque_GT , 3,',',' '); ?></td>



    <td  scope="col"  ><?php echo number_format($fm0['sum(dis.quantite_sac)'] - $sac_flasque_GT  , 0,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format($fm0['sum(dis.quantite_poids)'] - $poids_flasque_GT  , 3,',',' '); ?></td> 
        </tr>
  <?php  
        } ?> 
 <?php } ?>


</tbody>


</table>    




<?php if(!empty($trP['dates'])){
            $DateDebut=explode('-',$tr['dates']);
           if(!empty($tr2P['dates'])){
            $DateActuel=explode('-',$tr2P['dates']);?>

  <table class='table table-hover table-bordered table-striped' id='tableST' border='2' >
    

<thead>
           <tr style="background: black; color: white; text-align: center; font-weight: bold; " >
           <td colspan="11" ><h4 style="color: white;"> SITUATION DES ENLEVEMENTS <span style="color:yellow;">PAR CLIENT (SAINS )</span> DU <span style="color: red; background: white;"><?php echo  $DateActuel[2]. '-' .$DateActuel[1].'-'.$DateActuel[0];?></span></h4></td></tr>
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
while ($fm0=$STCLIVRAC2_all->fetch()) { 
  /*$avar=$TSTCLIVRAC->fetch();
  
   

  $cumul_sac=$avar['sum(rm.sac)'];
  $cumul_poids=$avar['sum(rm.poids)'];
  $rob_sac=$fm0['nombre_sac']-$cumul_sac;;
  $rob_poids=$fm0['poids_t']-$cumul_poids; */

           $sain_deb24H=$bdd->prepare("SELECT rm.*, dis.*, d.num_declaration , sum(rm.sac),sum(rm.poids),nc.* from transfert_debarquement as rm
       inner join declaration as d  on d.id_declaration=rm.id_declaration

          inner join dispats as dis on dis.id_dis=d.id_bl
          inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis   where rm.id_navire=? and rm.dates=? and nc.poids_kg=? and nc.id_produit=?  and dis.id_mangasin=?  and rm.statut='sain'  ");

                  $sain_deb24H->bindParam(1,$a[0]);
                  $sain_deb24H->bindParam(2,$a[1]);
                  $sain_deb24H->bindParam(3,$fm0['poids_kg']);
                  $sain_deb24H->bindParam(4,$fm0['id_produit']);
                  $sain_deb24H->bindParam(5,$fm0['id_mangasin']);
                 
                 
          $sain_deb24H->execute();

        //---REQUETE SAINS ET AVARIES DEBARQUES TOTAL PAR CALE ET PRODUIT


          $sain_debT=$bdd->prepare("SELECT rm.*, dis.*, d.num_declaration , sum(rm.sac),sum(rm.poids),nc.* from transfert_debarquement as rm
        inner join declaration as d  on d.id_declaration=rm.id_declaration

          inner join dispats as dis on dis.id_dis=d.id_bl
          inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis  where rm.id_navire=? and dates<=? and nc.poids_kg=? and nc.id_produit=?  and dis.id_mangasin=? and rm.statut='sain'   ");

                  $sain_debT->bindParam(1,$a[0]);
                  $sain_debT->bindParam(2,$a[1]);
                  $sain_debT->bindParam(3,$fm0['poids_kg']);
                  $sain_debT->bindParam(4,$fm0['id_produit']);
                  $sain_debT->bindParam(5,$fm0['id_mangasin']);
                 
          $sain_debT->execute();



 //---REQUETE SOUS TOTAL  SAINS ET AVARIES TOTAL DEBARQUES EN 24 PAR CALE 


         $sain_debST24H=$bdd->prepare("SELECT rm.*, dis.*, d.num_declaration , sum(rm.sac),sum(rm.poids),nc.* from transfert_debarquement as rm
        inner join declaration as d  on d.id_declaration=rm.id_declaration

          inner join dispats as dis on dis.id_dis=d.id_bl
          inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis  where rm.id_navire=? and rm.dates=?   and nc.id_client=?  and rm.statut='sain'  ");

                  $sain_debST24H->bindParam(1,$a[0]);
                  $sain_debST24H->bindParam(2,$a[1]);

                  $sain_debST24H->bindParam(3,$fm0['id_client']);
                 
  
          $sain_debST24H->execute(); 

 //---REQUETE SOUS TOTAL SAINS ET AVARIES TOTAL DEBARQUES EN  PAR CALE DEPUIS LE DEBUT DU DEBARQUEMENT


         $sain_debSTT=$bdd->prepare("SELECT rm.*, dis.*, d.num_declaration , sum(rm.sac),sum(rm.poids),nc.* from transfert_debarquement as rm
        inner join declaration as d  on d.id_declaration=rm.id_declaration

          inner join dispats as dis on dis.id_dis=d.id_bl
          inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis  where rm.id_navire=? and rm.dates<=?   and nc.id_client=?  and rm.statut='sain'   ");

                  $sain_debSTT->bindParam(1,$a[0]);
                  $sain_debSTT->bindParam(2,$a[1]);

                  $sain_debSTT->bindParam(3,$fm0['id_client']);
                 
                 
      
          $sain_debSTT->execute(); 


    //---REQUETE  TOTAL GENERAL SAINS ET AVARIES TOTAL DEBARQUES DES CALES DEPUIS LE DEBUT DU DEBARQUEMENT 24H


         $sain_debG24H=$bdd->prepare("SELECT rm.*, dis.*, d.num_declaration , sum(rm.sac),sum(rm.poids),nc.* from transfert_debarquement as rm
        inner join declaration as d  on d.id_declaration=rm.id_declaration

          inner join dispats as dis on dis.id_dis=d.id_bl
          inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis  where rm.id_navire=? and dates=?   and rm.statut='sain'   ");

                  $sain_debG24H->bindParam(1,$a[0]);
                  $sain_debG24H->bindParam(2,$a[1]);
                  
      
          $sain_debG24H->execute(); 


     //---REQUETE  TOTAL GENERAL SAINS ET AVARIES TOTAL DEBARQUES DES CALES DEPUIS LE DEBUT DU DEBARQUEMENT TOTAL


         $sain_debGT=$bdd->prepare("SELECT rm.*, dis.*, d.num_declaration , sum(rm.sac),sum(rm.poids),nc.* from transfert_debarquement as rm
        inner join declaration as d  on d.id_declaration=rm.id_declaration

          inner join dispats as dis on dis.id_dis=d.id_bl
          inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis  where rm.id_navire=? and dates<=?  and rm.statut='sain'   ");

                  $sain_debGT->bindParam(1,$a[0]);
                  $sain_debGT->bindParam(2,$a[1]);
                  
          $sain_debGT->execute();           




          



      
       $s_deb=$sain_deb24H->fetch();
     
       $s_debT=$sain_debT->fetch();
       //$avaries2=$fm->fetch();
      
       $s_debST=$sain_debST24H->fetch();

      
       $s_debSTT=$sain_debSTT->fetch();

       
       $s_debG=$sain_debG24H->fetch();

     
       $s_debGT=$sain_debGT->fetch();


     

      //VARIABLES SAINS
      if(empty($s_deb['sum(rm.sac)'])){
        $sac_sains=0;
      }
      else{
        $sac_sains= $s_deb['sum(rm.sac)'];
      }
      if(empty($s_deb['sum(rm.poids)'])){
        $poids_sains=0;
      }
      else{
        $poids_sains= $s_deb['sum(rm.poids)'];
      }

      if(empty($s_debT['sum(rm.sac)'])){
        $sac_sainsT=0;
      }
      else{
        $sac_sainsT= $s_debT['sum(rm.sac)'];
      }
      if(empty($s_debT['sum(rm.poids)'])){
        $poids_sainsT=0;
      }
      else{
        $poids_sainsT= $s_debT['sum(rm.poids)'];
      }

      if(empty($s_debST['sum(rm.sac)'])){
        $sac_sainsST=0;
      }
      else{
        $sac_sainsST= $s_debST['sum(rm.sac)'];
      }
      if(empty($s_debST['sum(rm.poids)'])){
        $poids_sainsST=0;
      }
      else{
        $poids_sainsST= $s_debST['sum(rm.poids)'];
      }

       if(empty($s_debSTT['sum(rm.sac)'])){
        $sac_sainsSTT=0;
      }
      else{
        $sac_sainsSTT= $s_debSTT['sum(rm.sac)'];
      }
      if(empty($s_debSTT['sum(rm.poids)'])){
        $poids_sainsSTT=0;
      }
      else{
        $poids_sainsSTT= $s_debSTT['sum(rm.poids)'];
      }

      if(empty($s_debG['sum(rm.sac)'])){
        $sac_sainsG=0;
      }
      else{
        $sac_sainsG= $s_debG['sum(rm.sac)'];
      }
      if(empty($s_debG['sum(rm.poids)'])){
        $poids_sainsG=0;
      }
      else{
        $poids_sainsG= $s_debG['sum(rm.poids)'];
      }

      if(empty($s_debGT['sum(rm.sac)'])){
        $sac_sainsGT=0;
      }
      else{
        $sac_sainsGT= $s_debGT['sum(rm.sac)'];
      }
      if(empty($s_debGT['sum(rm.poids)'])){
        $poids_sainsGT=0;
      }
      else{
        $poids_sainsGT= $s_debGT['sum(rm.poids)'];
      }      
  

  if (!empty($fm0['client']) and !empty($fm0['id_produit']) and !empty($fm0['poids_kg']) and !empty($fm0['id_mangasin']) ){ ?>
       <tr >
        <td scope="col" id="colLibeles" ><?php echo $fm0['client']  ?></td>
            <td scope="col" id="colLibeles"  ><?php echo $fm0['produit']; ?> <?php echo $fm0['poids_kg']; ?> KGS</td>
              <td scope="col" id="colLibeles" ><?php echo $fm0['mangasin']; ?> </td>
    <td scope="col" id="colManifeste"  ><?php echo number_format($fm0['sum(dis.quantite_sac)'], 0,',',' ');  ?></td>
       <td scope="col" id="colManifeste" ><?php echo number_format($fm0['sum(dis.quantite_poids)'], 3,',',' '); ?></td>
    <td id="colDeb24H" scope="col" ><?php echo number_format( $sac_sains , 0,',',' '); ?></td>
      <td id="colDeb24H" scope="col"  ><?php echo number_format( $poids_sains  , 3,',',' '); ?></td>
      <td scope="col" id="colDebTOTAL"><?php echo number_format( $sac_sainsT , 0,',',' '); ?></td>
      <td scope="col" id="colDebTOTAL"><?php echo number_format( $poids_sainsT  , 3,',',' '); ?></td>
     <td scope="col" id="colROB"><?php echo number_format($fm0['sum(dis.quantite_sac)']- $sac_sainsT , 0,',',' '); ?></td>
      <td scope="col" id="colROB" ><?php echo number_format($fm0['sum(dis.quantite_poids)']- $poids_sainsT , 3,',',' '); ?></td>
     </tr>

  
 <?php } 

 if (!empty($fm0['client']) and empty($fm0['id_produit']) and empty($fm0['poids_kg']) and empty($fm0['id_mangasin']) ){ ?>
       <tr > 
      <td id="sousTOTAL" colspan="3">  TOTAL <?php  echo $fm0['client'];  ?> <?php  echo $fm0['id_produit']; ?> <?php  echo $fm0['id_mangasin']; ?> <?php  echo $fm0['poids_kg']; ?></td>
      <td id="sousTOTAL" scope="col" ><?php echo number_format($fm0['sum(dis.quantite_sac)'], 0,',',' '); ?></td>
       <td id="sousTOTAL" scope="col" ><?php echo number_format($fm0['sum(dis.quantite_poids)'], 3,',',' '); ?></td>
        <td id="sousTOTAL" scope="col"  ><?php echo number_format($sac_sainsST, 0,',',' '); ?></td>
          <td id="sousTOTAL" scope="col"  ><?php echo number_format($poids_sainsST , 3,',',' '); ?></td>
          <td id="sousTOTAL" scope="col"  ><?php echo number_format($sac_sainsSTT  , 0,',',' '); ?></td>
          <td id="sousTOTAL" scope="col"  ><?php echo number_format($poids_sainsSTT , 3,',',' '); ?></td>
          <td id="sousTOTAL" scope="col"  ><?php echo number_format($fm0['sum(dis.quantite_sac)']- $sac_sainsSTT , 0,',',' '); ?></td>
          <td id="sousTOTAL" scope="col"  ><?php echo number_format($fm0['sum(dis.quantite_poids)']- $poids_sainsSTT , 3,',',' '); ?></td>          

     </tr>
  
 <?php //} } } 
}
 if (empty($fm0['client']) and empty($fm0['id_produit']) and empty($fm0['poids_kg']) and empty($fm0['id_mangasin']) ){ ?>
       <tr class="CelluleTotal2" >
       <td id="TOTAL" colspan="3">  TOTAL </td>
      <td id="TOTAL" scope="col" ><?php echo number_format($fm0['sum(dis.quantite_sac)'], 0,',',' '); ?></td>
       <td id="TOTAL" scope="col" ><?php echo number_format($fm0['sum(dis.quantite_poids)'], 3,',',' '); ?></td>
        <td id="TOTAL" scope="col"  ><?php echo number_format( $sac_sainsG , 0,',',' '); ?></td>
          <td id="TOTAL" scope="col"  ><?php echo number_format( $poids_sainsG , 3,',',' '); ?></td>
          <td id="TOTAL" scope="col"  ><?php echo number_format($sac_sainsGT , 0,',',' '); ?></td>
          <td id="TOTAL" scope="col"  ><?php echo number_format( $poids_sainsGT , 3,',',' '); ?></td>
          <td id="TOTAL" scope="col"  ><?php echo number_format($fm0['sum(dis.quantite_sac)']-  $sac_sainsGT , 0,',',' '); ?></td>
          <td id="TOTAL" scope="col"  ><?php echo number_format($fm0['sum(dis.quantite_poids)']-  $poids_sainsGT , 3,',',' '); ?></td> 
        </tr>
  <?php //} } }
   } ?> 
 <?php } ?>

</tbody>
</table>



<a style="margin:auto-right;" class="btn btn-primary no_print" data-role="imprimer_par_destination">imprimer</a>
</div>





<?php $client1=$_POST['deb_client']; ?>

<div class="col col-lg-12" id="deb_by_client"   <?php if($client1==0){

 ?> style="display: none;" <?php } ?>  <?php if($client1==1){

 ?> style="display: block;" <?php } ?>>



<?php if(!empty($trP['dates'])){
            $DateDebut=explode('-',$tr['dates']);
           if(!empty($tr2P['dates'])){
            $DateActuel=explode('-',$tr2P['dates']);?>

  <table class='table table-hover table-bordered table-striped' id='table' border='2' >
    

<thead>
           <tr style="background: black; color: white; text-align: center; font-weight: bold; " >
           <td colspan="11" ><h4 style="color: white;"> SITUATION DES ENLEVEMENTS <span style="color:yellow;">PAR CLIENT</span> DU <span style="color: red; background: white;"><?php echo  $DateActuel[2]. '-' .$DateActuel[1].'-'.$DateActuel[0];?></span></h4></td></tr>
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
while ($fm0=$STCLIVRAC2->fetch()) { 
  /*$avar=$TSTCLIVRAC->fetch();
  
   

  $cumul_sac=$avar['sum(rm.sac)'];
  $cumul_poids=$avar['sum(rm.poids)'];
  $rob_sac=$fm0['nombre_sac']-$cumul_sac;;
  $rob_poids=$fm0['poids_t']-$cumul_poids; */

           $sain_deb24H=$bdd->prepare("SELECT rm.*, dis.*, d.num_declaration , sum(rm.sac),sum(rm.poids),nc.* from transfert_debarquement as rm
       inner join declaration as d  on d.id_declaration=rm.id_declaration

          inner join dispats as dis on dis.id_dis=d.id_bl
          inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis   where rm.id_navire=? and rm.dates=? and nc.poids_kg=? and nc.id_produit=?  and dis.id_mangasin=?  and rm.statut='sain'  ");

                  $sain_deb24H->bindParam(1,$a[0]);
                  $sain_deb24H->bindParam(2,$a[1]);
                  $sain_deb24H->bindParam(3,$fm0['poids_kg']);
                  $sain_deb24H->bindParam(4,$fm0['id_produit']);
                  $sain_deb24H->bindParam(5,$fm0['id_mangasin']);
                 
                 
          $sain_deb24H->execute();

        //---REQUETE SAINS ET AVARIES DEBARQUES TOTAL PAR CALE ET PRODUIT


          $sain_debT=$bdd->prepare("SELECT rm.*, dis.*, d.num_declaration , sum(rm.sac),sum(rm.poids),nc.* from transfert_debarquement as rm
        inner join declaration as d  on d.id_declaration=rm.id_declaration

          inner join dispats as dis on dis.id_dis=d.id_bl
          inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis  where rm.id_navire=? and dates<=? and nc.poids_kg=? and nc.id_produit=?  and dis.id_mangasin=? and rm.statut='sain'   ");

                  $sain_debT->bindParam(1,$a[0]);
                  $sain_debT->bindParam(2,$a[1]);
                  $sain_debT->bindParam(3,$fm0['poids_kg']);
                  $sain_debT->bindParam(4,$fm0['id_produit']);
                  $sain_debT->bindParam(5,$fm0['id_mangasin']);
                 
          $sain_debT->execute();



 //---REQUETE SOUS TOTAL  SAINS ET AVARIES TOTAL DEBARQUES EN 24 PAR CALE 


         $sain_debST24H=$bdd->prepare("SELECT rm.*, dis.*, d.num_declaration , sum(rm.sac),sum(rm.poids),nc.* from transfert_debarquement as rm
        inner join declaration as d  on d.id_declaration=rm.id_declaration

          inner join dispats as dis on dis.id_dis=d.id_bl
          inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis  where rm.id_navire=? and rm.dates=?   and nc.id_client=?  and rm.statut='sain'  ");

                  $sain_debST24H->bindParam(1,$a[0]);
                  $sain_debST24H->bindParam(2,$a[1]);

                  $sain_debST24H->bindParam(3,$fm0['id_client']);
                 
  
          $sain_debST24H->execute(); 

 //---REQUETE SOUS TOTAL SAINS ET AVARIES TOTAL DEBARQUES EN  PAR CALE DEPUIS LE DEBUT DU DEBARQUEMENT


         $sain_debSTT=$bdd->prepare("SELECT rm.*, dis.*, d.num_declaration , sum(rm.sac),sum(rm.poids),nc.* from transfert_debarquement as rm
        inner join declaration as d  on d.id_declaration=rm.id_declaration

          inner join dispats as dis on dis.id_dis=d.id_bl
          inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis  where rm.id_navire=? and rm.dates<=?   and nc.id_client=?  and rm.statut='sain'   ");

                  $sain_debSTT->bindParam(1,$a[0]);
                  $sain_debSTT->bindParam(2,$a[1]);

                  $sain_debSTT->bindParam(3,$fm0['id_client']);
                 
                 
      
          $sain_debSTT->execute(); 


    //---REQUETE  TOTAL GENERAL SAINS ET AVARIES TOTAL DEBARQUES DES CALES DEPUIS LE DEBUT DU DEBARQUEMENT 24H


         $sain_debG24H=$bdd->prepare("SELECT rm.*, dis.*, d.num_declaration , sum(rm.sac),sum(rm.poids),nc.* from transfert_debarquement as rm
        inner join declaration as d  on d.id_declaration=rm.id_declaration

          inner join dispats as dis on dis.id_dis=d.id_bl
          inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis  where rm.id_navire=? and dates=?   and rm.statut='sain'   ");

                  $sain_debG24H->bindParam(1,$a[0]);
                  $sain_debG24H->bindParam(2,$a[1]);
                  
      
          $sain_debG24H->execute(); 


     //---REQUETE  TOTAL GENERAL SAINS ET AVARIES TOTAL DEBARQUES DES CALES DEPUIS LE DEBUT DU DEBARQUEMENT TOTAL


         $sain_debGT=$bdd->prepare("SELECT rm.*, dis.*, d.num_declaration , sum(rm.sac),sum(rm.poids),nc.* from transfert_debarquement as rm
        inner join declaration as d  on d.id_declaration=rm.id_declaration

          inner join dispats as dis on dis.id_dis=d.id_bl
          inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis  where rm.id_navire=? and dates<=?  and rm.statut='sain'   ");

                  $sain_debGT->bindParam(1,$a[0]);
                  $sain_debGT->bindParam(2,$a[1]);
                  
          $sain_debGT->execute();           




          



      
       $s_deb=$sain_deb24H->fetch();
     
       $s_debT=$sain_debT->fetch();
       //$avaries2=$fm->fetch();
      
       $s_debST=$sain_debST24H->fetch();

      
       $s_debSTT=$sain_debSTT->fetch();

       
       $s_debG=$sain_debG24H->fetch();

     
       $s_debGT=$sain_debGT->fetch();


     

      //VARIABLES SAINS
      if(empty($s_deb['sum(rm.sac)'])){
        $sac_sains=0;
      }
      else{
        $sac_sains= $s_deb['sum(rm.sac)'];
      }
      if(empty($s_deb['sum(rm.poids)'])){
        $poids_sains=0;
      }
      else{
        $poids_sains= $s_deb['sum(rm.poids)'];
      }

      if(empty($s_debT['sum(rm.sac)'])){
        $sac_sainsT=0;
      }
      else{
        $sac_sainsT= $s_debT['sum(rm.sac)'];
      }
      if(empty($s_debT['sum(rm.poids)'])){
        $poids_sainsT=0;
      }
      else{
        $poids_sainsT= $s_debT['sum(rm.poids)'];
      }

      if(empty($s_debST['sum(rm.sac)'])){
        $sac_sainsST=0;
      }
      else{
        $sac_sainsST= $s_debST['sum(rm.sac)'];
      }
      if(empty($s_debST['sum(rm.poids)'])){
        $poids_sainsST=0;
      }
      else{
        $poids_sainsST= $s_debST['sum(rm.poids)'];
      }

       if(empty($s_debSTT['sum(rm.sac)'])){
        $sac_sainsSTT=0;
      }
      else{
        $sac_sainsSTT= $s_debSTT['sum(rm.sac)'];
      }
      if(empty($s_debSTT['sum(rm.poids)'])){
        $poids_sainsSTT=0;
      }
      else{
        $poids_sainsSTT= $s_debSTT['sum(rm.poids)'];
      }

      if(empty($s_debG['sum(rm.sac)'])){
        $sac_sainsG=0;
      }
      else{
        $sac_sainsG= $s_debG['sum(rm.sac)'];
      }
      if(empty($s_debG['sum(rm.poids)'])){
        $poids_sainsG=0;
      }
      else{
        $poids_sainsG= $s_debG['sum(rm.poids)'];
      }

      if(empty($s_debGT['sum(rm.sac)'])){
        $sac_sainsGT=0;
      }
      else{
        $sac_sainsGT= $s_debGT['sum(rm.sac)'];
      }
      if(empty($s_debGT['sum(rm.poids)'])){
        $poids_sainsGT=0;
      }
      else{
        $poids_sainsGT= $s_debGT['sum(rm.poids)'];
      }      
  

  if (!empty($fm0['client']) and !empty($fm0['id_produit']) and !empty($fm0['poids_kg']) and !empty($fm0['id_mangasin']) ){ ?>
       <tr >
        <td scope="col" id="colLibeles" ><?php echo $fm0['client']  ?></td>
            <td scope="col" id="colLibeles"  ><?php echo $fm0['produit']; ?> <?php echo $fm0['poids_kg']; ?> KGS</td>
              <td scope="col" id="colLibeles" ><?php echo $fm0['mangasin']; ?> </td>
    <td scope="col" id="colManifeste"  ><?php echo number_format($fm0['sum(dis.quantite_sac)'], 0,',',' ');  ?></td>
       <td scope="col" id="colManifeste" ><?php echo number_format($fm0['sum(dis.quantite_poids)'], 3,',',' '); ?></td>
    <td id="colDeb24H" scope="col" ><?php echo number_format( $sac_sains , 0,',',' '); ?></td>
      <td id="colDeb24H" scope="col"  ><?php echo number_format( $poids_sains  , 3,',',' '); ?></td>
      <td scope="col" id="colDebTOTAL"><?php echo number_format( $sac_sainsT , 0,',',' '); ?></td>
      <td scope="col" id="colDebTOTAL"><?php echo number_format( $poids_sainsT  , 3,',',' '); ?></td>
     <td scope="col" id="colROB"><?php echo number_format($fm0['sum(dis.quantite_sac)']- $sac_sainsT , 0,',',' '); ?></td>
      <td scope="col" id="colROB" ><?php echo number_format($fm0['sum(dis.quantite_poids)']- $poids_sainsT , 3,',',' '); ?></td>
     </tr>

  
 <?php } 

 if (!empty($fm0['client']) and empty($fm0['id_produit']) and empty($fm0['poids_kg']) and empty($fm0['id_mangasin']) ){ ?>
       <tr > 
      <td id="sousTOTAL" colspan="3">  TOTAL <?php  echo $fm0['client'];  ?> <?php  echo $fm0['id_produit']; ?> <?php  echo $fm0['id_mangasin']; ?> <?php  echo $fm0['poids_kg']; ?></td>
      <td id="sousTOTAL" scope="col" ><?php echo number_format($fm0['sum(dis.quantite_sac)'], 0,',',' '); ?></td>
       <td id="sousTOTAL" scope="col" ><?php echo number_format($fm0['sum(dis.quantite_poids)'], 3,',',' '); ?></td>
        <td id="sousTOTAL" scope="col"  ><?php echo number_format($sac_sainsST, 0,',',' '); ?></td>
          <td id="sousTOTAL" scope="col"  ><?php echo number_format($poids_sainsST , 3,',',' '); ?></td>
          <td id="sousTOTAL" scope="col"  ><?php echo number_format($sac_sainsSTT  , 0,',',' '); ?></td>
          <td id="sousTOTAL" scope="col"  ><?php echo number_format($poids_sainsSTT , 3,',',' '); ?></td>
          <td id="sousTOTAL" scope="col"  ><?php echo number_format($fm0['sum(dis.quantite_sac)']- $sac_sainsSTT , 0,',',' '); ?></td>
          <td id="sousTOTAL" scope="col"  ><?php echo number_format($fm0['sum(dis.quantite_poids)']- $poids_sainsSTT , 3,',',' '); ?></td>          

     </tr>
  
 <?php //} } } 
}
 if (empty($fm0['client']) and empty($fm0['id_produit']) and empty($fm0['poids_kg']) and empty($fm0['id_mangasin']) ){ ?>
       <tr class="CelluleTotal2" >
       <td id="TOTAL" colspan="3">  TOTAL </td>
      <td id="TOTAL" scope="col" ><?php echo number_format($fm0['sum(dis.quantite_sac)'], 0,',',' '); ?></td>
       <td id="TOTAL" scope="col" ><?php echo number_format($fm0['sum(dis.quantite_poids)'], 3,',',' '); ?></td>
        <td id="TOTAL" scope="col"  ><?php echo number_format( $sac_sainsG , 0,',',' '); ?></td>
          <td id="TOTAL" scope="col"  ><?php echo number_format( $poids_sainsG , 3,',',' '); ?></td>
          <td id="TOTAL" scope="col"  ><?php echo number_format($sac_sainsGT , 0,',',' '); ?></td>
          <td id="TOTAL" scope="col"  ><?php echo number_format( $poids_sainsGT , 3,',',' '); ?></td>
          <td id="TOTAL" scope="col"  ><?php echo number_format($fm0['sum(dis.quantite_sac)']-  $sac_sainsGT , 0,',',' '); ?></td>
          <td id="TOTAL" scope="col"  ><?php echo number_format($fm0['sum(dis.quantite_poids)']-  $poids_sainsGT , 3,',',' '); ?></td> 
        </tr>
  <?php //} } }
   } ?> 
 <?php } ?>

</tbody>
</table>

<a style="margin:auto-right;" class="btn btn-primary no_print" data-role="imprimer_par_client">imprimer</a>
</div>

<?php   $deb_av_cale=$_POST['deb_av_cale']; ?>

<div class="col col-lg-12" id="deb_by_avaries_cale" <?php if($deb_av_cale==0){

 ?> style="display: none;" <?php } ?>  <?php if($deb_av_cale==1){

 ?> style="display: block;" <?php } ?>>
  
<?php if(!empty($trP['dates'])){
            $DateDebut=explode('-',$tr['dates']);
           if(!empty($tr2P['dates'])){
            $DateActuel=explode('-',$tr2P['dates']);?>

           

<table class='table table-hover table-bordered table-striped' id='table' border='2' style="margin-bottom:0px;">
    

<thead>
           <tr style="background: black; color: white; text-align: center; font-weight: bold; " >
           <td colspan="12" ><h5 style="color: white;"> SITUATION DU DEBARQUEMENT DES AVARIES <span style="color:yellow;">PAR CALE</span> DU <span style="color: red; background: white;"><?php echo  $DateActuel[2]. '-' .$DateActuel[1].'-'.$DateActuel[0];?></span> <!-- <select id="situation_par_cale_filtre2" style="float:left;" onchange="VisibleAvariesParCaleFiltre2()"><option selected>AVARIES</option>
            <option >GLOBALE</option>
            <option value="sains" > SAINS</option></select> !--></h5></td></tr>
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

      // $avar=$fmTAC->fetch();

         $avaries_deb24H=$bdd->prepare("SELECT av.* ,dc.*, sum(av.sac_flasque),sum(av.poids_flasque),sum(av.sac_mouille),sum(av.poids_mouille) from avaries as av
        left join declaration_chargement as dc on dc.id_dec=av.cale_avaries  where dc.id_navire=? and av.date_avaries=? and dc.conditionnement=? and dc.id_produit=? and dc.cales=?  ");
                  $avaries_deb24H->bindParam(1,$a[0]);
                 
                  $avaries_deb24H->bindParam(2,$a[1]);
                  $avaries_deb24H->bindParam(3,$fm0['conditionnement']);
                  $avaries_deb24H->bindParam(4,$fm0['id_produit']);
                  $avaries_deb24H->bindParam(5,$fm0['cales']);
          $avaries_deb24H->execute();

       
          

        //---REQUETE SAINS ET AVARIES DEBARQUES TOTAL PAR CALE ET PRODUIT
          $avaries_debT=$bdd->prepare("SELECT av.* ,dc.*, sum(av.sac_flasque),sum(av.poids_flasque),sum(av.sac_mouille),sum(av.poids_mouille) from avaries as av
        left join declaration_chargement as dc on dc.id_dec=av.cale_avaries  where dc.id_navire=? and av.date_avaries<=? and dc.conditionnement=? and dc.id_produit=? and dc.cales=?   ");
                   $avaries_debT->bindParam(1,$a[0]);
                  $avaries_debT->bindParam(2,$a[1]);
                  $avaries_debT->bindParam(3,$fm0['conditionnement']);
                  $avaries_debT->bindParam(4,$fm0['id_produit']);
                  $avaries_debT->bindParam(5,$fm0['cales']);
          $avaries_debT->execute();

          


 //---REQUETE SOUS TOTAL  SAINS ET AVARIES TOTAL DEBARQUES EN 24 PAR CALE 
           $avaries_debST24H=$bdd->prepare("SELECT av.* ,dc.*, sum(av.sac_flasque),sum(av.poids_flasque),sum(av.sac_mouille),sum(av.poids_mouille) from avaries as av
        left join declaration_chargement as dc on dc.id_dec=av.cale_avaries  where dc.id_navire=? and av.date_avaries=? and  dc.cales=?   ");
       
                  $avaries_debST24H->bindParam(1,$a[0]);
                  $avaries_debST24H->bindParam(2,$a[1]);
                   $avaries_debST24H->bindParam(3,$fm0['cales']);
                 
          $avaries_debST24H->execute();

         

 //---REQUETE SOUS TOTAL SAINS ET AVARIES TOTAL DEBARQUES EN  PAR CALE DEPUIS LE DEBUT DU DEBARQUEMENT
          $avaries_debSTT=$bdd->prepare("SELECT av.* ,dc.*, sum(av.sac_flasque),sum(av.poids_flasque),sum(av.sac_mouille),sum(av.poids_mouille) from avaries as av
        left join declaration_chargement as dc on dc.id_dec=av.cale_avaries  where dc.id_navire=? and av.date_avaries<=? and  dc.cales=?  ");

                  $avaries_debSTT->bindParam(1,$a[0]);
                  $avaries_debSTT->bindParam(2,$a[1]);
                  $avaries_debSTT->bindParam(3,$fm0['cales']);
                  
          $avaries_debSTT->execute();

         


    //---REQUETE  TOTAL GENERAL SAINS ET AVARIES TOTAL DEBARQUES DES CALES DEPUIS LE DEBUT DU DEBARQUEMENT 24H
          $avaries_debG24H=$bdd->prepare("SELECT av.* ,dc.*, sum(av.sac_flasque),sum(av.poids_flasque),sum(av.sac_mouille),sum(av.poids_mouille) from avaries as av
        left join declaration_chargement as dc on dc.id_dec=av.cale_avaries  where dc.id_navire=? and av.date_avaries=?     ");

                  $avaries_debG24H->bindParam(1,$a[0]);
                  $avaries_debG24H->bindParam(2,$a[1]);
                  
                  
          $avaries_debG24H->execute();

        


     //---REQUETE  TOTAL GENERAL SAINS ET AVARIES TOTAL DEBARQUES DES CALES DEPUIS LE DEBUT DU DEBARQUEMENT TOTAL
          $avaries_debGT=$bdd->prepare("SELECT av.* ,dc.*, sum(av.sac_flasque),sum(av.poids_flasque),sum(av.sac_mouille),sum(av.poids_mouille) from avaries as av
        left join declaration_chargement as dc on dc.id_dec=av.cale_avaries  where dc.id_navire=? and av.date_avaries<=?     ");

                  $avaries_debGT->bindParam(1,$a[0]);
                  $avaries_debGT->bindParam(2,$a[1]);
                  
                  
          $avaries_debGT->execute();

                   




          



      $av_deb=$avaries_deb24H->fetch();
       
      $av_debT=$avaries_debT->fetch();
      
       //$avaries2=$fm->fetch();
       $av_debST=$avaries_debST24H->fetch();
       

       $av_debSTT=$avaries_debSTT->fetch();
       

       $av_debG=$avaries_debG24H->fetch();
      

       $av_debGT=$avaries_debGT->fetch();
     


      //VARIABLES AVARIES
      if(empty($av_deb['sum(av.sac_flasque)'])){
        $sac_avaries=0;
      }
      else{
        $sac_avaries= $av_deb['sum(av.sac_flasque)'];
      }
      if(empty($av_deb['sum(av.poids_flasque)'])){
        $poids_avaries=0;
      }
      else{
        $poids_avaries= $av_deb['sum(av.poids_flasque)'];
      }

      if(empty($av_deb['sum(av.sac_mouille)'])){
        $sac_m=0;
      }
      else{
        $sac_m= $av_deb['sum(av.sac_mouille)'];
      }
      if(empty($av_deb['sum(av.poids_mouille)'])){
        $poids_m=0;
      }
      else{
        $poids_m= $av_deb['sum(av.poids_mouille)'];
      }      

    if(empty($av_debT['sum(av.sac_flasque)'])){
        $sac_avariesT=0;
      }
      else{
        $sac_avariesT= $av_debT['sum(av.sac_flasque)'];
      }
      if(empty($av_debT['sum(av.poids_flasque)'])){
        $poids_avariesT=0;
      }
      else{
        $poids_avariesT= $av_debT['sum(av.poids_flasque)'];
      }

      if(empty($av_debT['sum(av.sac_mouille)'])){
        $sac_mT=0;
      }
      else{
        $sac_mT= $av_debT['sum(av.sac_mouille)'];
      }
      if(empty($av_debT['sum(av.poids_mouille)'])){
        $poids_mT=0;
      }
      else{
        $poids_mT= $av_debT['sum(av.poids_mouille)'];
      }

      if(empty($av_debST['sum(av.sac_flasque)'])){
        $sac_avariesST=0;
      }
      else{
        $sac_avariesST= $av_debST['sum(av.sac_flasque)'];
      }
      if(empty($av_debST['sum(av.poids_flasque)'])){
        $poids_avariesST=0;
      }
      else{
        $poids_avariesST= $av_debST['sum(av.poids_flasque)'];
      }

      if(empty($av_debST['sum(av.sac_mouille)'])){
        $sac_mST=0;
      }
      else{
        $sac_mST= $av_debST['sum(av.sac_mouille)'];
      }
      if(empty($av_debST['sum(av.poids_mouille)'])){
        $poids_mST=0;
      }
      else{
        $poids_mST= $av_debST['sum(av.poids_mouille)'];
      }


      if(empty($av_debSTT['sum(av.sac_flasque)'])){
        $sac_avariesSTT=0;
      }
      else{
        $sac_avariesSTT= $av_debSTT['sum(av.sac_flasque)'];
      }
      if(empty($av_debSTT['sum(av.poids_flasque)'])){
        $poids_avariesSTT=0;
      }
      else{
        $poids_avariesSTT= $av_debSTT['sum(av.poids_flasque)'];
      }


      if(empty($av_debSTT['sum(av.sac_mouille)'])){
        $sac_mSTT=0;
      }
      else{
        $sac_mSTT= $av_debSTT['sum(av.sac_mouille)'];
      }
      if(empty($av_debSTT['sum(av.poids_mouille)'])){
        $poids_mSTT=0;
      }
      else{
        $poids_mSTT= $av_debSTT['sum(av.poids_mouille)'];
      }


      if(empty($av_debG['sum(av.sac_flasque)'])){
        $sac_avariesG=0;
      }
      else{
        $sac_avariesG= $av_debG['sum(av.sac_flasque)'];
      }
      if(empty($av_debG['sum(av.poids_flasque)'])){
        $poids_avariesG=0;
      }
      else{
        $poids_avariesG= $av_debG['sum(av.poids_flasque)'];
      }

      if(empty($av_debG['sum(av.sac_mouille)'])){
        $sac_mG=0;
      }
      else{
        $sac_mG= $av_debG['sum(av.sac_mouille)'];
      }
      if(empty($av_debG['sum(av.poids_mouille)'])){
        $poids_mG=0;
      }
      else{
        $poids_mG= $av_debG['sum(av.poids_mouille)'];
      }


      if(empty($av_debGT['sum(av.sac_flasque)'])){
        $sac_avariesGT=0;
      }
      else{
        $sac_avariesGT= $av_debGT['sum(av.sac_flasque)'];
      }
      if(empty($av_debGT['sum(av.poids_flasque)'])){
        $poids_avariesGT=0;
      }
      else{
        $poids_avariesGT= $av_debGT['sum(av.poids_flasque)'];
      }


     if(empty($av_debGT['sum(av.sac_mouille)'])){
        $sac_mGT=0;
      }
      else{
        $sac_mGT= $av_debGT['sum(av.sac_mouille)'];
      }
      if(empty($av_debGT['sum(av.poids_mouille)'])){
        $poids_mGT=0;
      }
      else{
        $poids_mGT= $av_debGT['sum(av.poids_mouille)'];
      }


     

        
       
      
        


        ?>

        <tr style="text-align: center;">
          <?php if(!empty($fm0['produit']) and !empty($fm0['conditionnement']) and !empty($fm0['cales']) ) {?>
     <td scope="col"   id="colLibeles"><?php echo $fm0['cales']; ?></td>
    <td scope="col"   id="colLibeles"><?php echo $fm0['produit']; ?> <?php echo $fm0['conditionnement']; ?> KGS</td>
   
    <td id="colDeb24H" scope="col" ><?php echo number_format($sac_avaries , 0,',',' '); ?> </td>
      <td id="colDeb24H" scope="col"  ><?php echo number_format($poids_avaries  , 3,',',' '); ?></td>
      <td scope="col" id="colDebTOTAL"><?php echo number_format($sac_avariesT, 0,',',' '); ?></td>
      <td scope="col" id="colDebTOTAL"><?php echo number_format($poids_avariesT  , 3,',',' '); ?></td>
      <td id="colDeb24H" scope="col" ><?php echo number_format($sac_m , 0,',',' '); ?></td>
      <td id="colDeb24H" scope="col"  ><?php echo number_format($poids_m  , 3,',',' '); ?></td>

      <td scope="col" id="colDebTOTAL"><?php echo number_format($sac_mT, 0,',',' '); ?></td>
      <td scope="col" id="colDebTOTAL"><?php echo number_format($poids_mT  , 3,',',' '); ?></td>
       
      <td scope="col" id="colDebTOTAL"><?php echo number_format($sac_avariesT + $sac_mT, 0,',',' '); ?></td>
      <td scope="col" id="colDebTOTAL"><?php echo number_format($poids_avariesT + $poids_mT  , 3,',',' '); ?></td>
    
     </tr>

    
     
     <?php } ?>

     <?php if(empty($fm0['produit']) and empty($fm0['conditionnement']) and !empty($fm0['cales'])) {?>

      <tr > 
      <td id="sousTOTAL" colspan="2">  TOTAL <?php  echo $fm0['cales'];  ?></td>
      
        <td id="sousTOTAL" scope="col"  ><?php echo number_format($sac_avariesST  , 0,',',' '); ?></td>
          <td id="sousTOTAL" scope="col"  ><?php echo number_format($poids_avariesST , 3,',',' '); ?></td>
          <td id="sousTOTAL" scope="col"  ><?php echo number_format($sac_avariesSTT  , 0,',',' '); ?></td>
          <td id="sousTOTAL" scope="col"  ><?php echo number_format($poids_avariesSTT , 3,',',' '); ?></td>
          <td id="sousTOTAL" scope="col"  ><?php echo number_format($sac_mST , 0,',',' '); ?></td>
          <td id="sousTOTAL" scope="col"  ><?php echo number_format( $poids_mST , 3,',',' '); ?></td>
          <td id="sousTOTAL" scope="col"  ><?php echo number_format($sac_mSTT , 0,',',' '); ?></td>
          <td id="sousTOTAL" scope="col"  ><?php echo number_format( $poids_mSTT , 3,',',' '); ?></td>
          <td id="sousTOTAL" scope="col"  ><?php echo number_format($sac_mSTT + $sac_avariesSTT , 0,',',' '); ?></td>
          <td id="sousTOTAL" scope="col"  ><?php echo number_format( $poids_mSTT + $poids_avariesSTT , 3,',',' '); ?></td>
         

     </tr>
   <?php  } ?>



     <?php if(empty($fm0['produit']) and empty($fm0['conditionnement']) and empty($fm0['cales']) ) {?>
     <tr class="CelluleTotal2" >
       <td id="TOTAL" colspan="2">  TOTAL </td>
     
        <td id="TOTAL" scope="col"  ><?php echo number_format($sac_avariesG  , 0,',',' '); ?></td>
          <td id="TOTAL" scope="col"  ><?php echo number_format($poids_avariesG  , 3,',',' '); ?></td>

           <td id="TOTAL" scope="col"  ><?php echo number_format($sac_avariesGT  , 0,',',' '); ?></td>
          <td id="TOTAL" scope="col"  ><?php echo number_format($poids_avariesGT  , 3,',',' '); ?></td>

           <td id="TOTAL" scope="col"  ><?php echo number_format($sac_mG  , 0,',',' '); ?></td>
          <td id="TOTAL" scope="col"  ><?php echo number_format($poids_mG  , 3,',',' '); ?></td>

           <td id="TOTAL" scope="col"  ><?php echo number_format($sac_mGT  , 0,',',' '); ?></td>
          <td id="TOTAL" scope="col"  ><?php echo number_format($poids_mGT  , 3,',',' '); ?></td>

          <td id="TOTAL" scope="col"  ><?php echo number_format($sac_avariesGT  + $sac_mGT , 0,',',' '); ?></td>
          <td id="TOTAL" scope="col"  ><?php echo number_format($poids_avariesGT  + $poids_mGT , 3,',',' '); ?></td>
           
        </tr>
     <?php }  
           }
       ?>
    
 
      
     
</body>
 </table>


<?php if(!empty($trP['dates'])){
            $DateDebut=explode('-',$tr['dates']);
           if(!empty($tr2P['dates'])){
            $DateActuel=explode('-',$tr2P['dates']);?>
<table class='table table-hover table-bordered table-striped' id='tablerr' border='2' style="margin-top:0px;">"
    

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

      // $avar=$fmTAP->fetch();

        
       
            $avaries_deb24H=$bdd->prepare("SELECT av.* ,dc.*, sum(av.sac_flasque),sum(av.poids_flasque),sum(av.sac_mouille),sum(av.poids_mouille) from avaries as av
        left join declaration_chargement as dc on dc.id_dec=av.cale_avaries  where dc.id_navire=? and av.date_avaries=? and dc.conditionnement=? and dc.id_produit=? and dc.cales=?   ");

                  $avaries_deb24H->bindParam(1,$a[0]);
                  $avaries_deb24H->bindParam(2,$a[1]);
                  $avaries_deb24H->bindParam(3,$fm0['conditionnement']);
                  $avaries_deb24H->bindParam(4,$fm0['id_produit']);
                   $avaries_deb24H->bindParam(5,$fm0['cales']);
                 
          $avaries_deb24H->execute();

       
          

        //---REQUETE SAINS ET AVARIES DEBARQUES TOTAL PAR CALE ET PRODUIT
          $avaries_debT=$bdd->prepare("SELECT av.* ,dc.*, sum(av.sac_flasque),sum(av.poids_flasque),sum(av.sac_mouille),sum(av.poids_mouille) from avaries as av
        left join declaration_chargement as dc on dc.id_dec=av.cale_avaries  where dc.id_navire=? and av.date_avaries<=? and dc.conditionnement=? and dc.id_produit=? and dc.cales=?    ");

                  $avaries_debT->bindParam(1,$a[0]);
                  $avaries_debT->bindParam(2,$a[1]);
                  $avaries_debT->bindParam(3,$fm0['conditionnement']);
                  $avaries_debT->bindParam(4,$fm0['id_produit']);
                  $avaries_debT->bindParam(5,$fm0['cales']);
                  
          $avaries_debT->execute();

          


 //---REQUETE SOUS TOTAL  SAINS ET AVARIES TOTAL DEBARQUES EN 24 PAR CALE 
           $avaries_debST24H=$bdd->prepare("SELECT av.* ,dc.*, sum(av.sac_flasque),sum(av.poids_flasque),sum(av.sac_mouille),sum(av.poids_mouille) from avaries as av
        left join declaration_chargement as dc on dc.id_dec=av.cale_avaries  where dc.id_navire=? and av.date_avaries=? and dc.conditionnement=? and dc.id_produit=?    ");
       
                  $avaries_debST24H->bindParam(1,$a[0]);
                  $avaries_debST24H->bindParam(2,$a[1]);
                  $avaries_debST24H->bindParam(3,$fm0['conditionnement']);
                  $avaries_debST24H->bindParam(4,$fm0['id_produit']);
                 
          $avaries_debST24H->execute();

         

 //---REQUETE SOUS TOTAL SAINS ET AVARIES TOTAL DEBARQUES EN  PAR CALE DEPUIS LE DEBUT DU DEBARQUEMENT
          $avaries_debSTT=$bdd->prepare("SELECT av.* ,dc.*, sum(av.sac_flasque),sum(av.poids_flasque),sum(av.sac_mouille),sum(av.poids_mouille) from avaries as av
        left join declaration_chargement as dc on dc.id_dec=av.cale_avaries  where dc.id_navire=? and av.date_avaries<=? and dc.conditionnement=? and dc.id_produit=?    ");

                  $avaries_debSTT->bindParam(1,$a[0]);
                  $avaries_debSTT->bindParam(2,$a[1]);
                  $avaries_debSTT->bindParam(3,$fm0['conditionnement']);
                  $avaries_debSTT->bindParam(4,$fm0['id_produit']);
                 
                  
          $avaries_debSTT->execute();

         


    //---REQUETE  TOTAL GENERAL SAINS ET AVARIES TOTAL DEBARQUES DES CALES DEPUIS LE DEBUT DU DEBARQUEMENT 24H
          $avaries_debG24H=$bdd->prepare("SELECT av.* ,dc.*, sum(av.sac_flasque),sum(av.poids_flasque),sum(av.sac_mouille),sum(av.poids_mouille) from avaries as av
        left join declaration_chargement as dc on dc.id_dec=av.cale_avaries  where dc.id_navire=? and av.date_avaries=?     ");

                  $avaries_debG24H->bindParam(1,$a[0]);
                  $avaries_debG24H->bindParam(2,$a[1]);
                  
                  
          $avaries_debG24H->execute();

        


     //---REQUETE  TOTAL GENERAL SAINS ET AVARIES TOTAL DEBARQUES DES CALES DEPUIS LE DEBUT DU DEBARQUEMENT TOTAL
          $avaries_debGT=$bdd->prepare("SELECT av.* ,dc.*, sum(av.sac_flasque),sum(av.poids_flasque),sum(av.sac_mouille),sum(av.poids_mouille) from avaries as av
        left join declaration_chargement as dc on dc.id_dec=av.cale_avaries  where dc.id_navire=? and av.date_avaries<=?      ");

                  $avaries_debGT->bindParam(1,$a[0]);
                  $avaries_debGT->bindParam(2,$a[1]);
                  
                  
          $avaries_debGT->execute();

                   




          



      $av_deb=$avaries_deb24H->fetch();
       
      $av_debT=$avaries_debT->fetch();
      
       //$avaries2=$fm->fetch();
       $av_debST=$avaries_debST24H->fetch();
       

       $av_debSTT=$avaries_debSTT->fetch();
       

       $av_debG=$avaries_debG24H->fetch();
      

       $av_debGT=$avaries_debGT->fetch();
     


      //VARIABLES AVARIES
      if(empty($av_deb['sum(av.sac_flasque)'])){
        $sac_avaries=0;
      }
      else{
        $sac_avaries= $av_deb['sum(av.sac_flasque)'];
      }
      if(empty($av_deb['sum(av.poids_flasque)'])){
        $poids_avaries=0;
      }
      else{
        $poids_avaries= $av_deb['sum(av.poids_flasque)'];
      }

      if(empty($av_deb['sum(av.sac_mouille)'])){
        $sac_m=0;
      }
      else{
        $sac_m= $av_deb['sum(av.sac_mouille)'];
      }
      if(empty($av_deb['sum(av.poids_mouille)'])){
        $poids_m=0;
      }
      else{
        $poids_m= $av_deb['sum(av.poids_mouille)'];
      }      

    if(empty($av_debT['sum(av.sac_flasque)'])){
        $sac_avariesT=0;
      }
      else{
        $sac_avariesT= $av_debT['sum(av.sac_flasque)'];
      }
      if(empty($av_debT['sum(av.poids_flasque)'])){
        $poids_avariesT=0;
      }
      else{
        $poids_avariesT= $av_debT['sum(av.poids_flasque)'];
      }

      if(empty($av_debT['sum(av.sac_mouille)'])){
        $sac_mT=0;
      }
      else{
        $sac_mT= $av_debT['sum(av.sac_mouille)'];
      }
      if(empty($av_debT['sum(av.poids_mouille)'])){
        $poids_mT=0;
      }
      else{
        $poids_mT= $av_debT['sum(av.poids_mouille)'];
      }

      if(empty($av_debST['sum(av.sac_flasque)'])){
        $sac_avariesST=0;
      }
      else{
        $sac_avariesST= $av_debST['sum(av.sac_flasque)'];
      }
      if(empty($av_debST['sum(av.poids_flasque)'])){
        $poids_avariesST=0;
      }
      else{
        $poids_avariesST= $av_debST['sum(av.poids_flasque)'];
      }

      if(empty($av_debST['sum(av.sac_mouille)'])){
        $sac_mST=0;
      }
      else{
        $sac_mST= $av_debST['sum(av.sac_mouille)'];
      }
      if(empty($av_debST['sum(av.poids_mouille)'])){
        $poids_mST=0;
      }
      else{
        $poids_mST= $av_debST['sum(av.poids_mouille)'];
      }


      if(empty($av_debSTT['sum(av.sac_flasque)'])){
        $sac_avariesSTT=0;
      }
      else{
        $sac_avariesSTT= $av_debSTT['sum(av.sac_flasque)'];
      }
      if(empty($av_debSTT['sum(av.poids_flasque)'])){
        $poids_avariesSTT=0;
      }
      else{
        $poids_avariesSTT= $av_debSTT['sum(av.poids_flasque)'];
      }


      if(empty($av_debSTT['sum(av.sac_mouille)'])){
        $sac_mSTT=0;
      }
      else{
        $sac_mSTT= $av_debSTT['sum(av.sac_mouille)'];
      }
      if(empty($av_debSTT['sum(av.poids_mouille)'])){
        $poids_mSTT=0;
      }
      else{
        $poids_mSTT= $av_debSTT['sum(av.poids_mouille)'];
      }


      if(empty($av_debG['sum(av.sac_flasque)'])){
        $sac_avariesG=0;
      }
      else{
        $sac_avariesG= $av_debG['sum(av.sac_flasque)'];
      }
      if(empty($av_debG['sum(av.poids_flasque)'])){
        $poids_avariesG=0;
      }
      else{
        $poids_avariesG= $av_debG['sum(av.poids_flasque)'];
      }

      if(empty($av_debG['sum(av.sac_mouille)'])){
        $sac_mG=0;
      }
      else{
        $sac_mG= $av_debG['sum(av.sac_mouille)'];
      }
      if(empty($av_debG['sum(av.poids_mouille)'])){
        $poids_mG=0;
      }
      else{
        $poids_mG= $av_debG['sum(av.poids_mouille)'];
      }


      if(empty($av_debGT['sum(av.sac_flasque)'])){
        $sac_avariesGT=0;
      }
      else{
        $sac_avariesGT= $av_debGT['sum(av.sac_flasque)'];
      }
      if(empty($av_debGT['sum(av.poids_flasque)'])){
        $poids_avariesGT=0;
      }
      else{
        $poids_avariesGT= $av_debGT['sum(av.poids_flasque)'];
      }


     if(empty($av_debGT['sum(av.sac_mouille)'])){
        $sac_mGT=0;
      }
      else{
        $sac_mGT= $av_debGT['sum(av.sac_mouille)'];
      }
      if(empty($av_debGT['sum(av.poids_mouille)'])){
        $poids_mGT=0;
      }
      else{
        $poids_mGT= $av_debGT['sum(av.poids_mouille)'];
      }

        

        /*$total_sac=$prodT['sum(rm.sac)']+$avariesT['sum(sac_flasque)']+$avariesT['sum(sac_mouille)'];
        $total_poids=$prodT['sum(rm.poids)']+$avariesT['sum(poids_flasque)']+$avariesT['sum(poids_mouille)'];*/

        ?>

        <tr style="text-align: center; ">
          <?php if(!empty($fm0['produit']) and !empty($fm0['conditionnement']) and !empty($fm0['cales']) and !empty($fm0['id_dec'])  ) {?>
            <td scope="col"  id="colLibeles"><?php echo $fm0['produit']; ?> <?php echo $fm0['conditionnement']; ?> KGS</td>
     <td scope="col"   id="colLibeles"><?php echo $fm0['cales']; ?></td>
    <td id="colDeb24H" scope="col" ><?php echo number_format($sac_avaries , 0,',',' '); ?></td>
      <td id="colDeb24H" scope="col"  ><?php echo number_format($poids_avaries  , 3,',',' '); ?></td>
      <td scope="col" id="colDebTOTAL"><?php echo number_format($sac_avariesT, 0,',',' '); ?></td>
      <td scope="col" id="colDebTOTAL"><?php echo number_format($poids_avariesT  , 3,',',' '); ?></td>
      <td id="colDeb24H" scope="col" ><?php echo number_format($sac_m , 0,',',' '); ?></td>
      <td id="colDeb24H" scope="col"  ><?php echo number_format($poids_m  , 3,',',' '); ?></td>

      <td scope="col" id="colDebTOTAL"><?php echo number_format($sac_mT, 0,',',' '); ?></td>
      <td scope="col" id="colDebTOTAL"><?php echo number_format($poids_mT  , 3,',',' '); ?></td>
       
      <td scope="col" id="colDebTOTAL"><?php echo number_format($sac_avariesT + $sac_mT, 0,',',' '); ?></td>
      <td scope="col" id="colDebTOTAL"><?php echo number_format($poids_avariesT + $poids_mT  , 3,',',' '); ?></td>
    
     </tr>

    
     
     <?php } ?>

      <?php if(!empty($fm0['produit']) and !empty($fm0['conditionnement']) and empty($fm0['cales']) and empty($fm0['id_dec']) ) {?>

      <tr > 
      <td id="sousTOTAL" colspan="2">  TOTAL <?php  echo $fm0['produit'];  ?></td>
      
        <td id="sousTOTAL" scope="col"  ><?php echo number_format($sac_avariesST  , 0,',',' '); ?></td>
          <td id="sousTOTAL" scope="col"  ><?php echo number_format($poids_avariesST , 3,',',' '); ?></td>
          <td id="sousTOTAL" scope="col"  ><?php echo number_format($sac_avariesSTT  , 0,',',' '); ?></td>
          <td id="sousTOTAL" scope="col"  ><?php echo number_format($poids_avariesSTT , 3,',',' '); ?></td>
          <td id="sousTOTAL" scope="col"  ><?php echo number_format($sac_mST , 0,',',' '); ?></td>
          <td id="sousTOTAL" scope="col"  ><?php echo number_format( $poids_mST , 3,',',' '); ?></td>
          <td id="sousTOTAL" scope="col"  ><?php echo number_format($sac_mSTT , 0,',',' '); ?></td>
          <td id="sousTOTAL" scope="col"  ><?php echo number_format( $poids_mSTT , 3,',',' '); ?></td>
          <td id="sousTOTAL" scope="col"  ><?php echo number_format($sac_mSTT + $sac_avariesSTT , 0,',',' '); ?></td>
          <td id="sousTOTAL" scope="col"  ><?php echo number_format( $poids_mSTT + $poids_avariesSTT , 3,',',' '); ?></td>
         

     </tr>
   <?php  } ?>



     <?php if(empty($fm0['produit']) and empty($fm0['conditionnement']) and empty($fm0['cales'])  and empty($fm0['id_dec']) ) {?>
    <tr class="CelluleTotal2" >
       <td id="TOTAL" colspan="2">  TOTAL </td>
     
        <td id="TOTAL" scope="col"  ><?php echo number_format($sac_avariesG  , 0,',',' '); ?></td>
          <td id="TOTAL" scope="col"  ><?php echo number_format($poids_avariesG  , 3,',',' '); ?></td>

           <td id="TOTAL" scope="col"  ><?php echo number_format($sac_avariesGT  , 0,',',' '); ?></td>
          <td id="TOTAL" scope="col"  ><?php echo number_format($poids_avariesGT  , 3,',',' '); ?></td>

           <td id="TOTAL" scope="col"  ><?php echo number_format($sac_mG  , 0,',',' '); ?></td>
          <td id="TOTAL" scope="col"  ><?php echo number_format($poids_mG  , 3,',',' '); ?></td>

           <td id="TOTAL" scope="col"  ><?php echo number_format($sac_mGT  , 0,',',' '); ?></td>
          <td id="TOTAL" scope="col"  ><?php echo number_format($poids_mGT  , 3,',',' '); ?></td>

          <td id="TOTAL" scope="col"  ><?php echo number_format($sac_avariesGT  + $sac_mGT , 0,',',' '); ?></td>
          <td id="TOTAL" scope="col"  ><?php echo number_format($poids_avariesGT  + $poids_mGT , 3,',',' '); ?></td>
           
        </tr>
     <?php } ?>

     <?php }  ?>
 


</body>
 </table>





<a style="margin:auto-right;" class="btn btn-primary no_print" data-role="imprimer_par_avaries_cale">imprimer</a>
</div>


<?php $deb_av_produit=$_POST['deb_av_produit']; ?>

<div class="col col-lg-12" id="deb_by_avaries_produit" <?php if($deb_av_produit==0){

 ?> style="display: none;" <?php } ?>  <?php if($deb_av_produit==1){

 ?> style="display: block;" <?php } ?>>


  
<?php if(!empty($trP['dates'])){
            $DateDebut=explode('-',$tr['dates']);
           if(!empty($tr2P['dates'])){
            $DateActuel=explode('-',$tr2P['dates']);?>
<table class='table table-hover table-bordered table-striped' id='table' border='2' >"
    

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

      // $avar=$fmTAP->fetch();

        
       
            $avaries_deb24H=$bdd->prepare("SELECT av.* ,dc.*, sum(av.sac_flasque),sum(av.poids_flasque),sum(av.sac_mouille),sum(av.poids_mouille) from avaries as av
        left join declaration_chargement as dc on dc.id_dec=av.cale_avaries  where dc.id_navire=? and av.date_avaries=? and dc.conditionnement=? and dc.id_produit=? and dc.cales=?   ");

                  $avaries_deb24H->bindParam(1,$a[0]);
                  $avaries_deb24H->bindParam(2,$a[1]);
                  $avaries_deb24H->bindParam(3,$fm0['conditionnement']);
                  $avaries_deb24H->bindParam(4,$fm0['id_produit']);
                   $avaries_deb24H->bindParam(5,$fm0['cales']);
                 
          $avaries_deb24H->execute();

       
          

        //---REQUETE SAINS ET AVARIES DEBARQUES TOTAL PAR CALE ET PRODUIT
          $avaries_debT=$bdd->prepare("SELECT av.* ,dc.*, sum(av.sac_flasque),sum(av.poids_flasque),sum(av.sac_mouille),sum(av.poids_mouille) from avaries as av
        left join declaration_chargement as dc on dc.id_dec=av.cale_avaries  where dc.id_navire=? and av.date_avaries<=? and dc.conditionnement=? and dc.id_produit=? and dc.cales=?    ");

                  $avaries_debT->bindParam(1,$a[0]);
                  $avaries_debT->bindParam(2,$a[1]);
                  $avaries_debT->bindParam(3,$fm0['conditionnement']);
                  $avaries_debT->bindParam(4,$fm0['id_produit']);
                  $avaries_debT->bindParam(5,$fm0['cales']);
                  
          $avaries_debT->execute();

          


 //---REQUETE SOUS TOTAL  SAINS ET AVARIES TOTAL DEBARQUES EN 24 PAR CALE 
           $avaries_debST24H=$bdd->prepare("SELECT av.* ,dc.*, sum(av.sac_flasque),sum(av.poids_flasque),sum(av.sac_mouille),sum(av.poids_mouille) from avaries as av
        left join declaration_chargement as dc on dc.id_dec=av.cale_avaries  where dc.id_navire=? and av.date_avaries=? and dc.conditionnement=? and dc.id_produit=?    ");
       
                  $avaries_debST24H->bindParam(1,$a[0]);
                  $avaries_debST24H->bindParam(2,$a[1]);
                  $avaries_debST24H->bindParam(3,$fm0['conditionnement']);
                  $avaries_debST24H->bindParam(4,$fm0['id_produit']);
                 
          $avaries_debST24H->execute();

         

 //---REQUETE SOUS TOTAL SAINS ET AVARIES TOTAL DEBARQUES EN  PAR CALE DEPUIS LE DEBUT DU DEBARQUEMENT
          $avaries_debSTT=$bdd->prepare("SELECT av.* ,dc.*, sum(av.sac_flasque),sum(av.poids_flasque),sum(av.sac_mouille),sum(av.poids_mouille) from avaries as av
        left join declaration_chargement as dc on dc.id_dec=av.cale_avaries  where dc.id_navire=? and av.date_avaries<=? and dc.conditionnement=? and dc.id_produit=?    ");

                  $avaries_debSTT->bindParam(1,$a[0]);
                  $avaries_debSTT->bindParam(2,$a[1]);
                  $avaries_debSTT->bindParam(3,$fm0['conditionnement']);
                  $avaries_debSTT->bindParam(4,$fm0['id_produit']);
                 
                  
          $avaries_debSTT->execute();

         


    //---REQUETE  TOTAL GENERAL SAINS ET AVARIES TOTAL DEBARQUES DES CALES DEPUIS LE DEBUT DU DEBARQUEMENT 24H
          $avaries_debG24H=$bdd->prepare("SELECT av.* ,dc.*, sum(av.sac_flasque),sum(av.poids_flasque),sum(av.sac_mouille),sum(av.poids_mouille) from avaries as av
        left join declaration_chargement as dc on dc.id_dec=av.cale_avaries  where dc.id_navire=? and av.date_avaries=?     ");

                  $avaries_debG24H->bindParam(1,$a[0]);
                  $avaries_debG24H->bindParam(2,$a[1]);
                  
                  
          $avaries_debG24H->execute();

        


     //---REQUETE  TOTAL GENERAL SAINS ET AVARIES TOTAL DEBARQUES DES CALES DEPUIS LE DEBUT DU DEBARQUEMENT TOTAL
          $avaries_debGT=$bdd->prepare("SELECT av.* ,dc.*, sum(av.sac_flasque),sum(av.poids_flasque),sum(av.sac_mouille),sum(av.poids_mouille) from avaries as av
        left join declaration_chargement as dc on dc.id_dec=av.cale_avaries  where dc.id_navire=? and av.date_avaries<=?      ");

                  $avaries_debGT->bindParam(1,$a[0]);
                  $avaries_debGT->bindParam(2,$a[1]);
                  
                  
          $avaries_debGT->execute();

                   




          



      $av_deb=$avaries_deb24H->fetch();
       
      $av_debT=$avaries_debT->fetch();
      
       //$avaries2=$fm->fetch();
       $av_debST=$avaries_debST24H->fetch();
       

       $av_debSTT=$avaries_debSTT->fetch();
       

       $av_debG=$avaries_debG24H->fetch();
      

       $av_debGT=$avaries_debGT->fetch();
     


      //VARIABLES AVARIES
      if(empty($av_deb['sum(av.sac_flasque)'])){
        $sac_avaries=0;
      }
      else{
        $sac_avaries= $av_deb['sum(av.sac_flasque)'];
      }
      if(empty($av_deb['sum(av.poids_flasque)'])){
        $poids_avaries=0;
      }
      else{
        $poids_avaries= $av_deb['sum(av.poids_flasque)'];
      }

      if(empty($av_deb['sum(av.sac_mouille)'])){
        $sac_m=0;
      }
      else{
        $sac_m= $av_deb['sum(av.sac_mouille)'];
      }
      if(empty($av_deb['sum(av.poids_mouille)'])){
        $poids_m=0;
      }
      else{
        $poids_m= $av_deb['sum(av.poids_mouille)'];
      }      

    if(empty($av_debT['sum(av.sac_flasque)'])){
        $sac_avariesT=0;
      }
      else{
        $sac_avariesT= $av_debT['sum(av.sac_flasque)'];
      }
      if(empty($av_debT['sum(av.poids_flasque)'])){
        $poids_avariesT=0;
      }
      else{
        $poids_avariesT= $av_debT['sum(av.poids_flasque)'];
      }

      if(empty($av_debT['sum(av.sac_mouille)'])){
        $sac_mT=0;
      }
      else{
        $sac_mT= $av_debT['sum(av.sac_mouille)'];
      }
      if(empty($av_debT['sum(av.poids_mouille)'])){
        $poids_mT=0;
      }
      else{
        $poids_mT= $av_debT['sum(av.poids_mouille)'];
      }

      if(empty($av_debST['sum(av.sac_flasque)'])){
        $sac_avariesST=0;
      }
      else{
        $sac_avariesST= $av_debST['sum(av.sac_flasque)'];
      }
      if(empty($av_debST['sum(av.poids_flasque)'])){
        $poids_avariesST=0;
      }
      else{
        $poids_avariesST= $av_debST['sum(av.poids_flasque)'];
      }

      if(empty($av_debST['sum(av.sac_mouille)'])){
        $sac_mST=0;
      }
      else{
        $sac_mST= $av_debST['sum(av.sac_mouille)'];
      }
      if(empty($av_debST['sum(av.poids_mouille)'])){
        $poids_mST=0;
      }
      else{
        $poids_mST= $av_debST['sum(av.poids_mouille)'];
      }


      if(empty($av_debSTT['sum(av.sac_flasque)'])){
        $sac_avariesSTT=0;
      }
      else{
        $sac_avariesSTT= $av_debSTT['sum(av.sac_flasque)'];
      }
      if(empty($av_debSTT['sum(av.poids_flasque)'])){
        $poids_avariesSTT=0;
      }
      else{
        $poids_avariesSTT= $av_debSTT['sum(av.poids_flasque)'];
      }


      if(empty($av_debSTT['sum(av.sac_mouille)'])){
        $sac_mSTT=0;
      }
      else{
        $sac_mSTT= $av_debSTT['sum(av.sac_mouille)'];
      }
      if(empty($av_debSTT['sum(av.poids_mouille)'])){
        $poids_mSTT=0;
      }
      else{
        $poids_mSTT= $av_debSTT['sum(av.poids_mouille)'];
      }


      if(empty($av_debG['sum(av.sac_flasque)'])){
        $sac_avariesG=0;
      }
      else{
        $sac_avariesG= $av_debG['sum(av.sac_flasque)'];
      }
      if(empty($av_debG['sum(av.poids_flasque)'])){
        $poids_avariesG=0;
      }
      else{
        $poids_avariesG= $av_debG['sum(av.poids_flasque)'];
      }

      if(empty($av_debG['sum(av.sac_mouille)'])){
        $sac_mG=0;
      }
      else{
        $sac_mG= $av_debG['sum(av.sac_mouille)'];
      }
      if(empty($av_debG['sum(av.poids_mouille)'])){
        $poids_mG=0;
      }
      else{
        $poids_mG= $av_debG['sum(av.poids_mouille)'];
      }


      if(empty($av_debGT['sum(av.sac_flasque)'])){
        $sac_avariesGT=0;
      }
      else{
        $sac_avariesGT= $av_debGT['sum(av.sac_flasque)'];
      }
      if(empty($av_debGT['sum(av.poids_flasque)'])){
        $poids_avariesGT=0;
      }
      else{
        $poids_avariesGT= $av_debGT['sum(av.poids_flasque)'];
      }


     if(empty($av_debGT['sum(av.sac_mouille)'])){
        $sac_mGT=0;
      }
      else{
        $sac_mGT= $av_debGT['sum(av.sac_mouille)'];
      }
      if(empty($av_debGT['sum(av.poids_mouille)'])){
        $poids_mGT=0;
      }
      else{
        $poids_mGT= $av_debGT['sum(av.poids_mouille)'];
      }

        

        /*$total_sac=$prodT['sum(rm.sac)']+$avariesT['sum(sac_flasque)']+$avariesT['sum(sac_mouille)'];
        $total_poids=$prodT['sum(rm.poids)']+$avariesT['sum(poids_flasque)']+$avariesT['sum(poids_mouille)'];*/

        ?>

        <tr style="text-align: center; ">
          <?php if(!empty($fm0['produit']) and !empty($fm0['conditionnement']) and !empty($fm0['cales']) and !empty($fm0['id_dec'])  ) {?>
            <td scope="col"  id="colLibeles"><?php echo $fm0['produit']; ?> <?php echo $fm0['conditionnement']; ?> KGS</td>
     <td scope="col"   id="colLibeles"><?php echo $fm0['cales']; ?></td>
    <td id="colDeb24H" scope="col" ><?php echo number_format($sac_avaries , 0,',',' '); ?></td>
      <td id="colDeb24H" scope="col"  ><?php echo number_format($poids_avaries  , 3,',',' '); ?></td>
      <td scope="col" id="colDebTOTAL"><?php echo number_format($sac_avariesT, 0,',',' '); ?></td>
      <td scope="col" id="colDebTOTAL"><?php echo number_format($poids_avariesT  , 3,',',' '); ?></td>
      <td id="colDeb24H" scope="col" ><?php echo number_format($sac_m , 0,',',' '); ?></td>
      <td id="colDeb24H" scope="col"  ><?php echo number_format($poids_m  , 3,',',' '); ?></td>

      <td scope="col" id="colDebTOTAL"><?php echo number_format($sac_mT, 0,',',' '); ?></td>
      <td scope="col" id="colDebTOTAL"><?php echo number_format($poids_mT  , 3,',',' '); ?></td>
       
      <td scope="col" id="colDebTOTAL"><?php echo number_format($sac_avariesT + $sac_mT, 0,',',' '); ?></td>
      <td scope="col" id="colDebTOTAL"><?php echo number_format($poids_avariesT + $poids_mT  , 3,',',' '); ?></td>
    
     </tr>

    
     
     <?php } ?>

      <?php if(!empty($fm0['produit']) and !empty($fm0['conditionnement']) and empty($fm0['cales']) and empty($fm0['id_dec']) ) {?>

      <tr > 
      <td id="sousTOTAL" colspan="2">  TOTAL <?php  echo $fm0['produit'];  ?></td>
      
        <td id="sousTOTAL" scope="col"  ><?php echo number_format($sac_avariesST  , 0,',',' '); ?></td>
          <td id="sousTOTAL" scope="col"  ><?php echo number_format($poids_avariesST , 3,',',' '); ?></td>
          <td id="sousTOTAL" scope="col"  ><?php echo number_format($sac_avariesSTT  , 0,',',' '); ?></td>
          <td id="sousTOTAL" scope="col"  ><?php echo number_format($poids_avariesSTT , 3,',',' '); ?></td>
          <td id="sousTOTAL" scope="col"  ><?php echo number_format($sac_mST , 0,',',' '); ?></td>
          <td id="sousTOTAL" scope="col"  ><?php echo number_format( $poids_mST , 3,',',' '); ?></td>
          <td id="sousTOTAL" scope="col"  ><?php echo number_format($sac_mSTT , 0,',',' '); ?></td>
          <td id="sousTOTAL" scope="col"  ><?php echo number_format( $poids_mSTT , 3,',',' '); ?></td>
          <td id="sousTOTAL" scope="col"  ><?php echo number_format($sac_mSTT + $sac_avariesSTT , 0,',',' '); ?></td>
          <td id="sousTOTAL" scope="col"  ><?php echo number_format( $poids_mSTT + $poids_avariesSTT , 3,',',' '); ?></td>
         

     </tr>
   <?php  } ?>



     <?php if(empty($fm0['produit']) and empty($fm0['conditionnement']) and empty($fm0['cales'])  and empty($fm0['id_dec']) ) {?>
    <tr class="CelluleTotal2" >
       <td id="TOTAL" colspan="2">  TOTAL </td>
     
        <td id="TOTAL" scope="col"  ><?php echo number_format($sac_avariesG  , 0,',',' '); ?></td>
          <td id="TOTAL" scope="col"  ><?php echo number_format($poids_avariesG  , 3,',',' '); ?></td>

           <td id="TOTAL" scope="col"  ><?php echo number_format($sac_avariesGT  , 0,',',' '); ?></td>
          <td id="TOTAL" scope="col"  ><?php echo number_format($poids_avariesGT  , 3,',',' '); ?></td>

           <td id="TOTAL" scope="col"  ><?php echo number_format($sac_mG  , 0,',',' '); ?></td>
          <td id="TOTAL" scope="col"  ><?php echo number_format($poids_mG  , 3,',',' '); ?></td>

           <td id="TOTAL" scope="col"  ><?php echo number_format($sac_mGT  , 0,',',' '); ?></td>
          <td id="TOTAL" scope="col"  ><?php echo number_format($poids_mGT  , 3,',',' '); ?></td>

          <td id="TOTAL" scope="col"  ><?php echo number_format($sac_avariesGT  + $sac_mGT , 0,',',' '); ?></td>
          <td id="TOTAL" scope="col"  ><?php echo number_format($poids_avariesGT  + $poids_mGT , 3,',',' '); ?></td>
           
        </tr>
     <?php } ?>

     <?php }  ?>
 


</body>
 </table>

<a style="margin:auto-right;" class="btn btn-primary no_print" data-role="imprimer_par_avaries_produit">imprimer</a>

</div>



<?php $avaries=$_POST['transfert_avaries'] ?>
<div class="col col-lg-12" id="transf_by_avaries_produit" <?php if($avaries==0){ ?>  style="display: none;" <?php } ?>  <?php if($avaries==1){ ?>  style="display:block;" <?php } ?> >
<style type="text/css">

    body{
    font-family:Times New Roman;
    font-weight: bold;
  }
      .hidden {
    display: none;
}

    .enteteTable{
     background: linear-gradient(to bottom, blue, #1B2B65); background: linear-gradient(to left, blue, #1B2B65); background: linear-gradient(to top, blue, #1B2B65); color: white; text-align: center; font-weight: bold;
     vertical-align: middle; 
      border: 5px;
      border-color: black;
      font-size: 12px;

    }
         #table{
          border: 5px; 
     }
    #colLibeles{
      background: rgba(83,104,253,0.9); color: white;
      vertical-align: middle;
      text-align: center;
      font-size: 12px;

    } 
    #colManifeste{
      background: rgb(72,94,179); color:white;
      vertical-align: middle;
       text-align: center;
       font-size: 12px;
    }
    #colDeb24H{
      background-color: rgb(124, 158, 191); color:white;
      vertical-align: middle;
       text-align: center;
       font-size: 12px;
    }
    #colDebTOTAL{
      background-color: rgb(34, 155, 176); color:white;
      vertical-align: middle;
       text-align: center;
       font-size: 12px;
    }
    #colROB{
      background-color: rgb(28, 118, 51); color:white;
      vertical-align: middle;
       text-align: center;
       font-size: 12px;
    }
    #sousTOTAL{
       background-color:rgb(94,44,101);  color:white;
       font-weight: bold;
       text-align: center;
       vertical-align: middle;
       font-size: 12px;

    }
    #TOTAL{
      background: black;
      color: red;
      font-weight: bold;
      vertical-align: middle;
       text-align: center;
       font-size: 12px;
    }
    #colFlasque{
      background-color: rgb(193, 150, 0); color:white;
      vertical-align: middle;
       text-align: center; 
       font-size: 12px;
    }

    #colMouille{
      background-color: rgb(158, 106, 35); color:white;
      vertical-align: middle;
       text-align: center; 
       font-size: 12px;
    }
    #colCumulGen{
    background-color: rgb(200, 106, 90); color:white;
      vertical-align: middle;
      text-align: center;  
      font-size: 12px;
    }
    
@media print {
  .no_print {
    display: none;
  }
     #transf_by_avaries_produit {
    page-break-before: always;
  }
}
 </style>

<?php if(!empty($trP['dates'])){
            $DateDebut=explode('-',$tr['dates']);
           if(!empty($tr2P['dates'])){
            $DateActuel=explode('-',$tr2P['dates']);?>

            <?php

 echo " <table class='table  table-bordered ' id='table' border='2' >";
    
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

     $avaries_deb24H_flasque=$bdd->prepare("SELECT  sum(manif.sac),sum(manif.poids) from transfert_debarquement as manif 
        inner join declaration as d on d.id_declaration=manif.id_declaration
        inner join dispats as dis on dis.id_dis=d.id_bl
        inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
         where nc.id_navire=? and manif.dates=? and nc.poids_kg=? and nc.id_produit=? and statut='flasque'  ");

                  $avaries_deb24H_flasque->bindParam(1,$a[0]);
                  $avaries_deb24H_flasque->bindParam(2,$a[1]);
                  $avaries_deb24H_flasque->bindParam(3,$fm0['conditionnement']);
                  $avaries_deb24H_flasque->bindParam(4,$fm0['id_produit']);
                 
          $avaries_deb24H_flasque->execute();


               $avaries_debST24H_flasque=$bdd->prepare("SELECT  sum(manif.sac),sum(manif.poids) from transfert_debarquement as manif 
        inner join declaration as d on d.id_declaration=manif.id_declaration
        inner join dispats as dis on dis.id_dis=d.id_bl
        inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
         where nc.id_navire=? and manif.dates=? and nc.poids_kg=? and nc.id_produit=? and statut='flasque'  ");

                  $avaries_debST24H_flasque->bindParam(1,$a[0]);
                  $avaries_debST24H_flasque->bindParam(2,$a[1]);
                  $avaries_debST24H_flasque->bindParam(3,$fm0['conditionnement']);
                  $avaries_debST24H_flasque->bindParam(4,$fm0['id_produit']);
                 
          $avaries_debST24H_flasque->execute();

                 $avaries_debSTT_flasque=$bdd->prepare("SELECT  sum(manif.sac),sum(manif.poids) from transfert_debarquement as manif 
        inner join declaration as d on d.id_declaration=manif.id_declaration
        inner join dispats as dis on dis.id_dis=d.id_bl
        inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
         where nc.id_navire=? and manif.dates<=? and nc.poids_kg=? and nc.id_produit=? and statut='flasque'  ");

                  $avaries_debSTT_flasque->bindParam(1,$a[0]);
                  $avaries_debSTT_flasque->bindParam(2,$a[1]);
                  $avaries_debSTT_flasque->bindParam(3,$fm0['conditionnement']);
                  $avaries_debSTT_flasque->bindParam(4,$fm0['id_produit']);
                 
          $avaries_debSTT_flasque->execute(); 


      $avaries_debG24H_flasque=$bdd->prepare("SELECT  sum(manif.sac),sum(manif.poids) from transfert_debarquement as manif 
        inner join declaration as d on d.id_declaration=manif.id_declaration
        inner join dispats as dis on dis.id_dis=d.id_bl
        inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
         where nc.id_navire=? and manif.dates=?  and statut='flasque'  ");

                  $avaries_debG24H_flasque->bindParam(1,$a[0]);
                  $avaries_debG24H_flasque->bindParam(2,$a[1]);

                 
          $avaries_debG24H_flasque->execute(); 

        $avaries_debGT_flasque=$bdd->prepare("SELECT  sum(manif.sac),sum(manif.poids) from transfert_debarquement as manif 
        inner join declaration as d on d.id_declaration=manif.id_declaration
        inner join dispats as dis on dis.id_dis=d.id_bl
        inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
         where nc.id_navire=? and manif.dates<=?  and statut='flasque'  ");

                  $avaries_debGT_flasque->bindParam(1,$a[0]);
                  $avaries_debGT_flasque->bindParam(2,$a[1]);

                 
          $avaries_debGT_flasque->execute();                


     $avaries_deb24H_mouille=$bdd->prepare("SELECT  sum(manif.sac),sum(manif.poids) from transfert_debarquement as manif 
        inner join declaration as d on d.id_declaration=manif.id_declaration
        inner join dispats as dis on dis.id_dis=d.id_bl
        inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
         where nc.id_navire=? and manif.dates=? and nc.poids_kg=? and nc.id_produit=? and statut='mouille'  ");

                  $avaries_deb24H_mouille->bindParam(1,$a[0]);
                 $avaries_deb24H_mouille->bindParam(2,$a[1]);
                 $avaries_deb24H_mouille->bindParam(3,$fm0['conditionnement']);
                  $avaries_deb24H_mouille->bindParam(4,$fm0['id_produit']);
                 
          $avaries_deb24H_mouille->execute();

       
          

        //---REQUETE SAINS ET AVARIES DEBARQUES TOTAL PAR CALE ET PRODUIT
          $avaries_debT_flasque=$bdd->prepare("SELECT  sum(manif.sac),sum(manif.poids) from transfert_debarquement as manif
        inner join declaration as d on d.id_declaration=manif.id_declaration
        inner join dispats as dis on dis.id_dis=d.id_bl
        inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
         where nc.id_navire=? and manif.dates<=? and nc.poids_kg=? and nc.id_produit=? and statut='flasque'     ");

                  $avaries_debT_flasque->bindParam(1,$a[0]);
                  $avaries_debT_flasque->bindParam(2,$a[1]);
                  $avaries_debT_flasque->bindParam(3,$fm0['conditionnement']);
                  $avaries_debT_flasque->bindParam(4,$fm0['id_produit']);

                  
          $avaries_debT_flasque->execute();


          $avaries_debT_mouille=$bdd->prepare("SELECT  sum(manif.sac),sum(manif.poids) from transfert_debarquement as manif
        inner join declaration as d on d.id_declaration=manif.id_declaration
        inner join dispats as dis on dis.id_dis=d.id_bl
        inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
         where nc.id_navire=? and manif.dates<=? and nc.poids_kg=? and nc.id_produit=? and statut='mouille'     ");

                  $avaries_debT_mouille->bindParam(1,$a[0]);
                  $avaries_debT_mouille->bindParam(2,$a[1]);
                  $avaries_debT_mouille->bindParam(3,$fm0['conditionnement']);
                  $avaries_debT_mouille->bindParam(4,$fm0['id_produit']);

                  
          $avaries_debT_mouille->execute();          

    
     $avaries_debST24H_mouille=$bdd->prepare("SELECT  sum(manif.sac),sum(manif.poids) from transfert_debarquement as manif 
        inner join declaration as d on d.id_declaration=manif.id_declaration
        inner join dispats as dis on dis.id_dis=d.id_bl
        inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
         where nc.id_navire=? and manif.dates=? and nc.poids_kg=? and nc.id_produit=? and statut='mouille'  ");

                  $avaries_debST24H_mouille->bindParam(1,$a[0]);
                  $avaries_debST24H_mouille->bindParam(2,$a[1]);
                 $avaries_debST24H_mouille->bindParam(3,$fm0['conditionnement']);
                  $avaries_debST24H_mouille->bindParam(4,$fm0['id_produit']);
                 
          $avaries_debST24H_mouille->execute();     

    $avaries_debSTT_mouille=$bdd->prepare("SELECT  sum(manif.sac),sum(manif.poids) from transfert_debarquement as manif 
        inner join declaration as d on d.id_declaration=manif.id_declaration
        inner join dispats as dis on dis.id_dis=d.id_bl
        inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
         where nc.id_navire=? and manif.dates<=? and nc.poids_kg=? and nc.id_produit=? and statut='mouille'  ");

                  $avaries_debSTT_mouille->bindParam(1,$a[0]);
                  $avaries_debSTT_mouille->bindParam(2,$a[1]);
                 $avaries_debSTT_mouille->bindParam(3,$fm0['conditionnement']);
                  $avaries_debSTT_mouille->bindParam(4,$fm0['id_produit']);
                 
          $avaries_debSTT_mouille->execute();      

       $avaries_debG24H_mouille=$bdd->prepare("SELECT  sum(manif.sac),sum(manif.poids) from transfert_debarquement as manif 
        inner join declaration as d on d.id_declaration=manif.id_declaration
        inner join dispats as dis on dis.id_dis=d.id_bl
        inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
         where nc.id_navire=? and manif.dates=?  and statut='mouille'  ");

                  $avaries_debG24H_mouille->bindParam(1,$a[0]);
                  $avaries_debG24H_mouille->bindParam(2,$a[1]);

                 
          $avaries_debG24H_mouille->execute(); 

        $avaries_debGT_mouille=$bdd->prepare("SELECT  sum(manif.sac),sum(manif.poids) from transfert_debarquement as manif 
        inner join declaration as d on d.id_declaration=manif.id_declaration
        inner join dispats as dis on dis.id_dis=d.id_bl
        inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
         where nc.id_navire=? and manif.dates<=?  and statut='mouille'  ");

                  $avaries_debGT_mouille->bindParam(1,$a[0]);
                  $avaries_debGT_mouille->bindParam(2,$a[1]);

                 
          $avaries_debGT_mouille->execute();
                   




          



      $av_deb_flasque=$avaries_deb24H_flasque->fetch();
      $av_deb_mouille=$avaries_deb24H_mouille->fetch();

      $av_debST24H_flasque=$avaries_debST24H_flasque->fetch();
      $av_debST24H_mouille=$avaries_debST24H_mouille->fetch();

      $av_debSTT_flasque=$avaries_debSTT_flasque->fetch();
      $av_debSTT_mouille=$avaries_debSTT_mouille->fetch();
       
      $av_debT_flasque=$avaries_debT_flasque->fetch();
      $av_debT_mouille=$avaries_debT_mouille->fetch();

      $av_debG24H_flasque=$avaries_debG24H_flasque->fetch();
      $av_debG24H_mouille=$avaries_debG24H_mouille->fetch();

      $av_debGT_flasque=$avaries_debGT_flasque->fetch();
      $av_debGT_mouille=$avaries_debGT_mouille->fetch();
      
       //$avaries2=$fm->fetch();
       
     


      //VARIABLES AVARIES
      if(empty($av_deb_flasque['sum(manif.sac)'])){
        $sac_flasque_24h=0;
      }
      else{
        $sac_flasque_24h= $av_deb_flasque['sum(manif.sac)'];
      }
      if(empty($av_deb_flasque['sum(manif.poids)'])){
        $poids_flasque_24h=0;
      }
      else{
       $poids_flasque_24h= $av_deb_flasque['sum(manif.poids)'];
      }

      if(empty($av_deb_mouille['sum(manif.sac)'])){
        $sac_mouille_24h=0;
      }
      else{
        $sac_mouille_24h= $av_deb_mouille['sum(manif.sac)'];
      }
      if(empty($av_deb_mouille['sum(manif.poids)'])){
        $poids_mouille_24h=0;
      }
      else{
       $poids_mouille_24h= $av_deb_mouille['sum(manif.poids)'];
      }

     
      

    if(empty($av_debT_flasque['sum(manif.sac)'])){
        $sac_flasqueT=0;
      }
      else{
        $sac_flasqueT= $av_debT_flasque['sum(manif.sac)'];
      }
      if(empty($av_debT_flasque['sum(manif.poids)'])){
         $poids_flasqueT=0;
      }
      else{
         $poids_flasqueT= $av_debT_flasque['sum(manif.poids)'];
      }


         if(empty($av_debT_mouille['sum(manif.sac)'])){
        $sac_mouilleT=0;
      }
      else{
        $sac_mouilleT= $av_debT_mouille['sum(manif.sac)'];
      }
      if(empty($av_debT_mouille['sum(manif.poids)'])){
         $poids_mouilleT=0;
      }
      else{
         $poids_mouilleT= $av_debT_mouille['sum(manif.poids)'];
      } 


      if(empty($av_debST24H_flasque['sum(manif.sac)'])){
        $sac_flasque_ST24H=0;
      }
      else{
        $sac_flasque_ST24H= $av_debST24H_flasque['sum(manif.sac)'];
      }
      if(empty($av_debST24H_flasque['sum(manif.poids)'])){
        $poids_flasque_ST24H=0;
      }
      else{
       $poids_flasque_ST24H= $av_debST24H_flasque['sum(manif.poids)'];
      }

      if(empty($av_debSTT_flasque['sum(manif.sac)'])){
        $sac_flasque_STT=0;
      }
      else{
        $sac_flasque_STT= $av_debSTT_flasque['sum(manif.sac)'];
      }
      if(empty($av_debSTT_flasque['sum(manif.poids)'])){
        $poids_flasque_STT=0;
      }
      else{
       $poids_flasque_STT= $av_debSTT_flasque['sum(manif.poids)'];
      }

      if(empty($av_debST24H_mouille['sum(manif.sac)'])){
        $sac_mouille_ST24H=0;
      }
      else{
        $sac_mouille_ST24H= $av_debST24H_mouille['sum(manif.sac)'];
      }
      if(empty($av_debST24H_mouille['sum(manif.poids)'])){
        $poids_mouille_ST24H=0;
      }
      else{
       $poids_mouille_ST24H= $av_debST24H_mouille['sum(manif.poids)'];
      }

      if(empty($av_debSTT_mouille['sum(manif.sac)'])){
        $sac_mouille_STT=0;
      }
      else{
        $sac_mouille_STT= $av_debSTT_mouille['sum(manif.sac)'];
      }
      if(empty($av_debSTT_mouille['sum(manif.poids)'])){
        $poids_mouille_STT=0;
      }
      else{
       $poids_mouille_STT= $av_debSTT_mouille['sum(manif.poids)'];
      } 

    if(empty($av_debG24H_flasque['sum(manif.sac)'])){
        $sac_flasque_G24h=0;
      }
      else{
        $sac_flasque_G24h= $av_debG24H_flasque['sum(manif.sac)'];
      }
      if(empty($av_debG24H_flasque['sum(manif.poids)'])){
        $poids_flasque_G24h=0;
      }
      else{
       $poids_flasque_G24h= $av_debG24H_flasque['sum(manif.poids)'];
      } 

      if(empty($av_debGT_flasque['sum(manif.sac)'])){
        $sac_flasque_GT=0;
      }
      else{
        $sac_flasque_GT= $av_debGT_flasque['sum(manif.sac)'];
      }
      if(empty($av_debGT_flasque['sum(manif.poids)'])){
        $poids_flasque_GT=0;
      }
      else{
       $poids_flasque_GT= $av_debGT_flasque['sum(manif.poids)'];
      }



      if(empty($av_debG24H_mouille['sum(manif.sac)'])){
        $sac_mouille_G24h=0;
      }
      else{
        $sac_mouille_G24h= $av_debG24H_mouille['sum(manif.sac)'];
      }
      if(empty($av_debG24H_mouille['sum(manif.poids)'])){
        $poids_mouille_G24h=0;
      }
      else{
       $poids_mouille_G24h= $av_debG24H_mouille['sum(manif.poids)'];
      } 

      if(empty($av_debGT_mouille['sum(manif.sac)'])){
        $sac_mouille_GT=0;
      }
      else{
        $sac_mouille_GT= $av_debGT_mouille['sum(manif.sac)'];
      }
      if(empty($av_debGT_mouille['sum(manif.poids)'])){
        $poids_mouille_GT=0;
      }
      else{
       $poids_mouille_GT= $av_debGT_mouille['sum(manif.poids)'];
      }      
      
        
        ?>
        <?php   if(!empty($fm0['produit']) and !empty($fm0['conditionnement']) and !empty($fm0['id_navire']) ){ ?>

        <tr style="text-align: center;">

        
            <td scope="col"  id="colLibeles"><?php echo $fm0['produit']; ?> <?php echo $fm0['conditionnement']; ?> KGS  </td>


     
    <td id="colDeb24H" scope="col" ><?php echo number_format($sac_flasque_24h , 0,',',' '); ?></td>
      <td id="colDeb24H" scope="col"  ><?php echo number_format($poids_flasque_24h  , 3,',',' '); ?></td>
      <td scope="col" id="colDebTOTAL"><?php echo number_format($sac_flasqueT, 0,',',' '); ?></td>
      <td scope="col" id="colDebTOTAL"><?php echo number_format($poids_flasqueT  , 3,',',' '); ?></td>
      <td id="colDeb24H" scope="col" ><?php echo number_format($sac_mouille_24h , 0,',',' '); ?></td>
      <td id="colDeb24H" scope="col"  ><?php echo number_format($poids_mouille_24h  , 3,',',' '); ?></td>

      <td scope="col" id="colDebTOTAL"><?php echo number_format($sac_mouilleT, 0,',',' '); ?></td>
      <td scope="col" id="colDebTOTAL"><?php echo number_format($poids_mouilleT  , 3,',',' '); ?></td>
       
      <td scope="col" id="colDebTOTAL"><?php echo number_format($sac_flasque_24h + $sac_mouille_24h, 0,',',' '); ?></td>
      <td scope="col" id="colDebTOTAL"><?php echo number_format($poids_flasque_24h + $poids_mouille_24h  , 3,',',' '); ?></td>
       <td scope="col" id="colDebTOTAL"><?php echo number_format($sac_flasqueT + $sac_mouilleT, 0,',',' '); ?></td>
      <td scope="col" id="colDebTOTAL"><?php echo number_format($poids_flasqueT + $poids_mouilleT  , 3,',',' '); ?></td>

    
     </tr>


     
     <?php } 

             ?>

               <?php   if(!empty($fm0['produit']) and !empty($fm0['conditionnement']) and empty($fm0['id_navire']) ){ ?>

        <tr style="text-align: center; background:black; color: white; font-size:12px;">

        
            <td scope="col"  >TOTAL <?php echo $fm0['produit']; ?> <?php echo $fm0['conditionnement']; ?> KGS  </td>


     
    <td  scope="col" ><?php echo number_format($sac_flasque_ST24H , 0,',',' '); ?></td>
      <td  scope="col"  ><?php echo number_format($poids_flasque_ST24H  , 3,',',' '); ?></td>
      <td scope="col" ><?php echo number_format($sac_flasque_STT, 0,',',' '); ?></td>
      <td scope="col" ><?php echo number_format($poids_flasque_STT  , 3,',',' '); ?></td>
      <td  scope="col" ><?php echo number_format($sac_mouille_ST24H , 0,',',' '); ?></td>
      <td  scope="col"  ><?php echo number_format($poids_mouille_ST24H  , 3,',',' '); ?></td>

      <td scope="col" ><?php echo number_format( $sac_mouille_STT, 0,',',' '); ?></td>
      <td scope="col" ><?php echo number_format( $poids_mouille_STT  , 3,',',' '); ?></td>
       
      <td scope="col" ><?php echo number_format($sac_flasque_ST24H + $sac_mouille_ST24H, 0,',',' '); ?></td>
      <td scope="col" ><?php echo number_format($poids_flasque_ST24H  + $poids_mouille_ST24H  , 3,',',' '); ?></td>
       <td scope="col" ><?php echo number_format($sac_flasque_STT + $sac_mouille_STT, 0,',',' '); ?></td>
      <td scope="col" ><?php echo number_format($poids_flasque_STT + $poids_mouille_STT  , 3,',',' '); ?></td>

    
     </tr>


     
     <?php } 
             ?>

           <?php   if(empty($fm0['produit']) and empty($fm0['conditionnement']) and empty($fm0['id_navire']) ){ ?>

        <tr style="text-align: center; background:black; color: white; font-size:12px;">

        
            <td scope="col"  >TOTAL   </td>


     
    <td  scope="col" ><?php echo number_format($sac_flasque_G24h , 0,',',' '); ?></td>
      <td  scope="col"  ><?php echo number_format($poids_flasque_G24h  , 3,',',' '); ?></td>
      <td scope="col" ><?php echo number_format($sac_flasque_GT, 0,',',' '); ?></td>
      <td scope="col" ><?php echo number_format($poids_flasque_GT  , 3,',',' '); ?></td>
      <td  scope="col" ><?php echo number_format($sac_mouille_G24h , 0,',',' '); ?></td>
      <td  scope="col"  ><?php echo number_format($poids_mouille_G24h  , 3,',',' '); ?></td>

      <td scope="col" ><?php echo number_format( $sac_mouille_GT, 0,',',' '); ?></td>
      <td scope="col" ><?php echo number_format( $poids_mouille_GT  , 3,',',' '); ?></td>
       
      <td scope="col" ><?php echo number_format($sac_flasque_G24h + $sac_mouille_G24h, 0,',',' '); ?></td>
      <td scope="col" ><?php echo number_format($poids_flasque_G24h  + $poids_mouille_G24h  , 3,',',' '); ?></td>
       <td scope="col" ><?php echo number_format($sac_flasque_GT + $sac_mouille_GT, 0,',',' '); ?></td>
      <td scope="col" ><?php echo number_format($poids_flasque_GT + $poids_mouille_GT  , 3,',',' '); ?></td>

    
     </tr>


     
     <?php }      

            } ?>


    

</body>
 </table>


 <?php if(!empty($trP['dates'])){
            $DateDebut=explode('-',$tr['dates']);
           if(!empty($tr2P['dates'])){
            $DateActuel=explode('-',$tr2P['dates']);?>

         

 <table class='table  table-bordered ' id='tablee' border='2' >
    

<thead>
           <tr style="background: black; color: white; text-align: center; font-weight: bold; " >
           <td colspan="16" ><h4 style="color: white;"> SITUATION DU TRANSFERT DES AVARIES <span style="color:yellow;">PAR DESTINATION</span> DU <span style="color: red; background: white;"><?php echo  $DateActuel[2]. '-' .$DateActuel[1].'-'.$DateActuel[0];?></span></h4></td></tr>
<?php 
         }  }
   ?>
 
  
 <tr  style="background-color: rgba(50, 159, 218, 0.9); text-align: center;"  >
      
      
       <td scope="col"  rowspan="3"  id="colLibeles">DESTINATION</td>
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
while ($fm0=$dispatching_avaries->fetch()) { 
 /* $avar=$TSTDVRAC->fetch();
  
  */

   //---REQUETE SAINS  DEBARQUES EN 24 PAR CALE ET PRODUIT

       
          $flasque_deb24H=$bdd->prepare("SELECT manif.*, dis.* ,d.num_declaration, sum(manif.sac),sum(manif.poids),nc.*,p.*,mg.mangasin from transfert_debarquement as manif
         left join declaration as d  on d.id_declaration=manif.id_declaration

          inner join dispats as dis on dis.id_dis=d.id_bl
          inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
          inner join produit_deb as p on p.id=nc.id_produit
          inner join mangasin as mg on mg.id=dis.id_mangasin 
           where manif.id_navire=? and manif.dates=? and nc.poids_kg=? and nc.id_produit=?  and dis.id_mangasin=?  and manif.statut='flasque'    ");

                  $flasque_deb24H->bindParam(1,$a[0]);
                  $flasque_deb24H->bindParam(2,$a[1]);
                  $flasque_deb24H->bindParam(3,$fm0['poids_kg']);
                  $flasque_deb24H->bindParam(4,$fm0['id_produit']);
                  $flasque_deb24H->bindParam(5,$fm0['id_mangasin']);
                 
          $flasque_deb24H->execute(); 

  $flasque_debST24H=$bdd->prepare("SELECT manif.*, dis.* ,d.num_declaration, sum(manif.sac),sum(manif.poids),nc.*,p.*,mg.mangasin from transfert_debarquement as manif
         left join declaration as d  on d.id_declaration=manif.id_declaration

          inner join dispats as dis on dis.id_dis=d.id_bl
          inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
          inner join produit_deb as p on p.id=nc.id_produit
          inner join mangasin as mg on mg.id=dis.id_mangasin 
           where manif.id_navire=? and manif.dates=?   and dis.id_mangasin=?  and manif.statut='flasque'    ");

                  $flasque_debST24H->bindParam(1,$a[0]);
                  $flasque_debST24H->bindParam(2,$a[1]);

                  $flasque_debST24H->bindParam(3,$fm0['id_mangasin']);
                 
          $flasque_debST24H->execute();

   $flasque_debSTT=$bdd->prepare("SELECT manif.*, dis.* ,d.num_declaration, sum(manif.sac),sum(manif.poids),nc.*,p.*,mg.mangasin from transfert_debarquement as manif
         left join declaration as d  on d.id_declaration=manif.id_declaration

          inner join dispats as dis on dis.id_dis=d.id_bl
          inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
          inner join produit_deb as p on p.id=nc.id_produit
          inner join mangasin as mg on mg.id=dis.id_mangasin 
           where manif.id_navire=? and manif.dates<=?   and dis.id_mangasin=?  and manif.statut='flasque'    ");

                   $flasque_debSTT->bindParam(1,$a[0]);
                   $flasque_debSTT->bindParam(2,$a[1]);

                   $flasque_debSTT->bindParam(3,$fm0['id_mangasin']);
                 
           $flasque_debSTT->execute();                    

            $flasque_debT24H=$bdd->prepare("SELECT manif.*, dis.* ,d.num_declaration, sum(manif.sac),sum(manif.poids),nc.*,p.*,mg.mangasin from transfert_debarquement as manif
         left join declaration as d  on d.id_declaration=manif.id_declaration

          inner join dispats as dis on dis.id_dis=d.id_bl
          inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
          inner join produit_deb as p on p.id=nc.id_produit
          inner join mangasin as mg on mg.id=dis.id_mangasin 
           where manif.id_navire=? and manif.dates<=? and nc.poids_kg=? and nc.id_produit=?  and dis.id_mangasin=?  and manif.statut='flasque'    ");

                  $flasque_debT24H->bindParam(1,$a[0]);
                  $flasque_debT24H->bindParam(2,$a[1]);
                  $flasque_debT24H->bindParam(3,$fm0['poids_kg']);
                  $flasque_debT24H->bindParam(4,$fm0['id_produit']);
                  $flasque_debT24H->bindParam(5,$fm0['id_mangasin']);
                 
          $flasque_debT24H->execute();


     $flasque_debG24H=$bdd->prepare("SELECT manif.*, dis.* ,d.num_declaration, sum(manif.sac),sum(manif.poids),nc.*,p.*,mg.mangasin from transfert_debarquement as manif
         left join declaration as d  on d.id_declaration=manif.id_declaration

          inner join dispats as dis on dis.id_dis=d.id_bl
          inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
          inner join produit_deb as p on p.id=nc.id_produit
          inner join mangasin as mg on mg.id=dis.id_mangasin 
           where manif.id_navire=? and manif.dates=?   and manif.statut='flasque'    ");

                  $flasque_debG24H->bindParam(1,$a[0]);
                  $flasque_debG24H->bindParam(2,$a[1]);

                  
                 
          $flasque_debG24H->execute();   

    $flasque_debGT=$bdd->prepare("SELECT manif.*, dis.* ,d.num_declaration, sum(manif.sac),sum(manif.poids),nc.*,p.*,mg.mangasin from transfert_debarquement as manif
         left join declaration as d  on d.id_declaration=manif.id_declaration

          inner join dispats as dis on dis.id_dis=d.id_bl
          inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
          inner join produit_deb as p on p.id=nc.id_produit
          inner join mangasin as mg on mg.id=dis.id_mangasin 
           where manif.id_navire=? and manif.dates<=?   and manif.statut='flasque'    ");

                  $flasque_debGT->bindParam(1,$a[0]);
                  $flasque_debGT->bindParam(2,$a[1]);

                  
                 
          $flasque_debGT->execute();                


           $mouille_deb24H=$bdd->prepare("SELECT manif.*, dis.* ,d.num_declaration, sum(manif.sac),sum(manif.poids),nc.*,p.*,mg.mangasin from transfert_debarquement as manif
         left join declaration as d  on d.id_declaration=manif.id_declaration

          inner join dispats as dis on dis.id_dis=d.id_bl
          inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
          inner join produit_deb as p on p.id=nc.id_produit
          inner join mangasin as mg on mg.id=dis.id_mangasin 
           where manif.id_navire=? and manif.dates=? and nc.poids_kg=? and nc.id_produit=?  and dis.id_mangasin=?  and manif.statut='mouille'    ");

                  $mouille_deb24H->bindParam(1,$a[0]);
                  $mouille_deb24H->bindParam(2,$a[1]);
                 $mouille_deb24H->bindParam(3,$fm0['poids_kg']);
                  $mouille_deb24H->bindParam(4,$fm0['id_produit']);
                  $mouille_deb24H->bindParam(5,$fm0['id_mangasin']);
                 
          $mouille_deb24H->execute(); 

            $mouille_debT24H=$bdd->prepare("SELECT manif.*, dis.* ,d.num_declaration, sum(manif.sac),sum(manif.poids),nc.*,p.*,mg.mangasin from transfert_debarquement as manif
         left join declaration as d  on d.id_declaration=manif.id_declaration

          inner join dispats as dis on dis.id_dis=d.id_bl
          inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
          inner join produit_deb as p on p.id=nc.id_produit
          inner join mangasin as mg on mg.id=dis.id_mangasin 
           where manif.id_navire=? and manif.dates<=? and nc.poids_kg=? and nc.id_produit=?  and dis.id_mangasin=?  and manif.statut='mouille'    ");

                  $mouille_debT24H->bindParam(1,$a[0]);
                  $mouille_debT24H->bindParam(2,$a[1]);
                  $mouille_debT24H->bindParam(3,$fm0['poids_kg']);
                  $mouille_debT24H->bindParam(4,$fm0['id_produit']);
                  $mouille_debT24H->bindParam(5,$fm0['id_mangasin']);
                 
          $mouille_debT24H->execute(); 


       $mouille_debST24H=$bdd->prepare("SELECT manif.*, dis.* ,d.num_declaration, sum(manif.sac),sum(manif.poids),nc.*,p.*,mg.mangasin from transfert_debarquement as manif
         left join declaration as d  on d.id_declaration=manif.id_declaration

          inner join dispats as dis on dis.id_dis=d.id_bl
          inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
          inner join produit_deb as p on p.id=nc.id_produit
          inner join mangasin as mg on mg.id=dis.id_mangasin 
           where manif.id_navire=? and manif.dates=?   and dis.id_mangasin=?  and manif.statut='mouille'    ");

                  $mouille_debST24H->bindParam(1,$a[0]);
                  $mouille_debST24H->bindParam(2,$a[1]);

                  $mouille_debST24H->bindParam(3,$fm0['id_mangasin']);
                 
         $mouille_debST24H->execute();

   $mouille_debSTT=$bdd->prepare("SELECT manif.*, dis.* ,d.num_declaration, sum(manif.sac),sum(manif.poids),nc.*,p.*,mg.mangasin from transfert_debarquement as manif
         left join declaration as d  on d.id_declaration=manif.id_declaration

          inner join dispats as dis on dis.id_dis=d.id_bl
          inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
          inner join produit_deb as p on p.id=nc.id_produit
          inner join mangasin as mg on mg.id=dis.id_mangasin 
           where manif.id_navire=? and manif.dates<=?   and dis.id_mangasin=?  and manif.statut='mouille'    ");

                   $mouille_debSTT->bindParam(1,$a[0]);
                   $mouille_debSTT->bindParam(2,$a[1]);

                   $mouille_debSTT->bindParam(3,$fm0['id_mangasin']);
                 
           $mouille_debSTT->execute(); 


 $mouille_debG24H=$bdd->prepare("SELECT manif.*, dis.* ,d.num_declaration, sum(manif.sac),sum(manif.poids),nc.*,p.*,mg.mangasin from transfert_debarquement as manif
         left join declaration as d  on d.id_declaration=manif.id_declaration

          inner join dispats as dis on dis.id_dis=d.id_bl
          inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
          inner join produit_deb as p on p.id=nc.id_produit
          inner join mangasin as mg on mg.id=dis.id_mangasin 
           where manif.id_navire=? and manif.dates=?   and manif.statut='mouille'    ");

                  $mouille_debG24H->bindParam(1,$a[0]);
                  $mouille_debG24H->bindParam(2,$a[1]);

                  
                 
          $mouille_debG24H->execute();   

    $mouille_debGT=$bdd->prepare("SELECT manif.*, dis.* ,d.num_declaration, sum(manif.sac),sum(manif.poids),nc.*,p.*,mg.mangasin from transfert_debarquement as manif
         left join declaration as d  on d.id_declaration=manif.id_declaration

          inner join dispats as dis on dis.id_dis=d.id_bl
          inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
          inner join produit_deb as p on p.id=nc.id_produit
          inner join mangasin as mg on mg.id=dis.id_mangasin 
           where manif.id_navire=? and manif.dates<=?   and manif.statut='mouille'    ");

                  $mouille_debGT->bindParam(1,$a[0]);
                  $mouille_debGT->bindParam(2,$a[1]);

                  
                 
          $mouille_debGT->execute();                



  $av_deb24H_flasque=$flasque_deb24H->fetch();
  $av_deb24H_mouille=$mouille_deb24H->fetch();

    $av_debST24H_flasque=$flasque_debST24H->fetch();
    $av_debST24H_mouille=$mouille_debST24H->fetch();

    $av_debSTT_flasque=$flasque_debSTT->fetch();
    $av_debSTT_mouille=$mouille_debSTT->fetch();

  $av_debT24H_flasque=$flasque_debT24H->fetch();
  $av_debT24H_mouille=$mouille_debT24H->fetch();

  $av_debG24H_flasque=$flasque_debG24H->fetch();
  $av_debG24H_mouille=$mouille_debG24H->fetch();


  $av_debGT_flasque=$flasque_debGT->fetch();
   $av_debGT_mouille=$mouille_debGT->fetch();

// variable en 24H ET TOTAL DEBARQUEMENT FLASQUES ET MOUILLES
      if(empty($av_deb24H_flasque['sum(manif.sac)'])){
        $sac_flasque_24h=0;
      }
      else{
        $sac_flasque_24h= $av_deb24H_flasque['sum(manif.sac)'];
      }
      if(empty($av_deb24H_flasque['sum(manif.poids)'])){
        $poids_flasque_24h=0;
      }
      else{
       $poids_flasque_24h= $av_deb24H_flasque['sum(manif.poids)'];
      }


      if(empty($av_debT24H_flasque['sum(manif.sac)'])){
        $sac_flasque_T24h=0;
      }
      else{
        $sac_flasque_T24h= $av_debT24H_flasque['sum(manif.sac)'];
      }
      if(empty($av_debT24H_flasque['sum(manif.poids)'])){
        $poids_flasque_T24h=0;
      }
      else{
       $poids_flasque_T24h= $av_debT24H_flasque['sum(manif.poids)'];
      } 


      if(empty($av_deb24H_mouille['sum(manif.sac)'])){
        $sac_mouille_24h=0;
      }
      else{
        $sac_mouille_24h= $av_deb24H_mouille['sum(manif.sac)'];
      }
      if(empty($av_deb24H_mouille['sum(manif.poids)'])){
        $poids_mouille_24h=0;
      }
      else{
       $poids_mouille_24h= $av_deb24H_mouille['sum(manif.poids)'];
      }


      if(empty($av_debT24H_mouille['sum(manif.sac)'])){
        $sac_mouille_T24h=0;
      }
      else{
        $sac_mouille_T24h= $av_debT24H_mouille['sum(manif.sac)'];
      }
      if(empty($av_debT24H_mouille['sum(manif.poids)'])){
        $poids_mouille_T24h=0;
      }
      else{
       $poids_mouille_T24h= $av_debT24H_mouille['sum(manif.poids)'];
      } 

   // variable en SOUS TOTAL DEBARQUEMENT FLASQUES ET MOUILLES
      if(empty($av_debST24H_flasque['sum(manif.sac)'])){
        $sac_flasque_ST24h=0;
      }
      else{
        $sac_flasque_ST24h= $av_debST24H_flasque['sum(manif.sac)'];
      }
      if(empty($av_debST24H_flasque['sum(manif.poids)'])){
        $poids_flasque_ST24h=0;
      }
      else{
       $poids_flasque_ST24h= $av_debST24H_flasque['sum(manif.poids)'];
      } 


      if(empty($av_debSTT_flasque['sum(manif.sac)'])){
        $sac_flasque_STT=0;
      }
      else{
        $sac_flasque_STT= $av_debSTT_flasque['sum(manif.sac)'];
      }
      if(empty($av_debSTT_flasque['sum(manif.poids)'])){
        $poids_flasque_STT=0;
      }
      else{
       $poids_flasque_STT= $av_debSTT_flasque['sum(manif.poids)'];
      } 


      if(empty($av_debST24H_mouille['sum(manif.sac)'])){
        $sac_mouille_ST24h=0;
      }
      else{
        $sac_mouille_ST24h= $av_debST24H_mouille['sum(manif.sac)'];
      }
      if(empty($av_debST24H_mouille['sum(manif.poids)'])){
        $poids_mouille_ST24h=0;
      }
      else{
       $poids_mouille_ST24h= $av_debST24H_mouille['sum(manif.poids)'];
      } 


      if(empty($av_debSTT_mouille['sum(manif.sac)'])){
        $sac_mouille_STT=0;
      }
      else{
        $sac_mouille_STT= $av_debSTT_mouille['sum(manif.sac)'];
      }
      if(empty($av_debSTT_mouille['sum(manif.poids)'])){
        $poids_mouille_STT=0;
      }
      else{
       $poids_mouille_STT= $av_debSTT_mouille['sum(manif.poids)'];
      } 

// variable en  TOTAL GENERAL DEBARQUEMENT FLASQUES ET MOUILLES
      if(empty($av_debG24H_flasque['sum(manif.sac)'])){
        $sac_flasque_G24h=0;
      }
      else{
        $sac_flasque_G24h= $av_debG24H_flasque['sum(manif.sac)'];
      }
      if(empty($av_debG24H_flasque['sum(manif.poids)'])){
        $poids_flasque_G24h=0;
      }
      else{
       $poids_flasque_G24h= $av_debG24H_flasque['sum(manif.poids)'];
      } 


      if(empty($av_debGT_flasque['sum(manif.sac)'])){
        $sac_flasque_GT=0;
      }
      else{
        $sac_flasque_GT= $av_debGT_flasque['sum(manif.sac)'];
      }
      if(empty($av_debGT_flasque['sum(manif.poids)'])){
        $poids_flasque_GT=0;
      }
      else{
       $poids_flasque_GT= $av_debGT_flasque['sum(manif.poids)'];
      } 


     if(empty($av_debG24H_mouille['sum(manif.sac)'])){
        $sac_mouille_G24h=0;
      }
      else{
        $sac_mouille_G24h= $av_debG24H_mouille['sum(manif.sac)'];
      }
      if(empty($av_debG24H_mouille['sum(manif.poids)'])){
        $poids_mouille_G24h=0;
      }
      else{
       $poids_mouille_G24h= $av_debG24H_mouille['sum(manif.poids)'];
      } 


      if(empty($av_debGT_mouille['sum(manif.sac)'])){
        $sac_mouille_GT=0;
      }
      else{
        $sac_mouille_GT= $av_debGT_mouille['sum(manif.sac)'];
      }
      if(empty($av_debGT_mouille['sum(manif.poids)'])){
        $poids_mouille_GT=0;
      }
      else{
       $poids_mouille_GT= $av_debGT_mouille['sum(manif.poids)'];
      }     



               

          if (!empty($fm0['mangasin']) and !empty($fm0['produit'])  and !empty($fm0['poids_kg']) ){ ?>
       <tr style="text-align: center;">
        <td scope="col" class="colLibeles"><?php echo $fm0['mangasin']  ?></td>
            <td scope="col" class="colLibeles" ><?php echo $fm0['produit']; ?> <?php echo $fm0['poids_kg']; ?> KGS</td>
              <td scope="col" id="colLibeles" ><?php echo number_format( $sac_flasque_24h , 0,',',' '); ?> </td>
     <td scope="col" class="colManifeste"  ><?php echo number_format( $poids_flasque_24h  , 3,',',' '); ?></td>

       <td scope="col" class="colManifeste" ><?php echo number_format( $sac_flasque_T24h , 0,',',' '); ?></td>
    <td class="colDeb24H" scope="col" ><?php echo number_format( $poids_flasque_T24h , 3,',',' '); ?></td>

      <td class="colDeb24H" scope="col"  ><?php echo number_format( $sac_mouille_24h  , 0,',',' '); ?></td>
      <td scope="col" class="colDebTOTAL"><?php echo number_format($poids_mouille_24h, 3,',',' '); ?></td>

      <td scope="col" class="colDebTOTAL"><?php echo number_format( $sac_mouille_T24h  , 0,',',' '); ?></td>
     <td scope="col" class="colROB"><?php echo number_format($poids_mouille_T24h , 3,',',' '); ?></td>

           <td scope="col" class="colDebTOTAL"><?php echo number_format($sac_flasque_24h + $sac_mouille_24h , 0,',',' '); ?></td>
     <td scope="col" class="colROB"><?php echo number_format($poids_flasque_24h + $poids_mouille_24h , 3,',',' '); ?></td>

 <td scope="col" class="colDebTOTAL"><?php echo number_format($sac_flasque_T24h + $sac_mouille_T24h , 0,',',' '); ?></td>
     <td scope="col" class="colROB"><?php echo number_format($poids_flasque_T24h + $poids_mouille_T24h , 3,',',' '); ?></td>

    
     </tr>

  
 <?php } 

 if (!empty($fm0['mangasin']) and empty($fm0['produit'])  and empty($fm0['poids_kg']) ){ ?>
     <tr class="sousTOTAL"> 
      <td  colspan="2">  TOTAL <?php  echo $fm0['mangasin'];  ?></td>
      <td  scope="col" ><?php echo number_format($sac_flasque_ST24h, 0,',',' '); ?></td>
       <td  scope="col" ><?php echo number_format($poids_flasque_ST24h, 3,',',' '); ?></td>
        <td  scope="col"  ><?php echo number_format($sac_flasque_STT, 0,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format($poids_flasque_STT , 3,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format($sac_mouille_ST24h  , 0,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format($poids_mouille_ST24h , 3,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format($sac_mouille_STT , 0,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format($poids_mouille_STT, 3,',',' '); ?></td>  
    <td  scope="col" ><?php echo number_format($sac_flasque_ST24h + $sac_mouille_ST24h, 0,',',' '); ?></td>
     <td  scope="col" ><?php echo number_format($poids_flasque_ST24h + $poids_mouille_ST24h, 3,',',' '); ?></td>   
 <td  scope="col" ><?php echo number_format($sac_flasque_STT + $sac_mouille_STT, 0,',',' '); ?></td>
     <td  scope="col" ><?php echo number_format($poids_flasque_STT + $poids_mouille_STT, 3,',',' '); ?></td> 



     </tr>
 <?php 
  }
 if (empty($fm0['mangasin']) and empty($fm0['produit'])  and empty($fm0['poids_kg']) ){ ?>
       <tr class="TOTAL" >
       <td style="color:white;" colspan="2">  TOTAL  </td>
      <td  scope="col" ><?php echo number_format($sac_flasque_G24h, 0,',',' '); ?></td>
       <td  scope="col" ><?php echo number_format($poids_flasque_G24h, 3,',',' '); ?></td>
        <td  scope="col"  ><?php echo number_format( $sac_flasque_GT , 0,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format( $poids_flasque_GT , 3,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format($sac_mouille_G24h , 0,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format( $poids_mouille_G24h , 3,',',' '); ?></td>
                    <td  scope="col"  ><?php echo number_format($sac_mouille_GT , 0,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format( $poids_mouille_GT , 3,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format($sac_flasque_G24h + $sac_mouille_G24h , 0,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format($poids_flasque_G24h + $poids_mouille_G24h , 3,',',' '); ?></td> 

    <td  scope="col"  ><?php echo number_format($sac_flasque_GT + $sac_mouille_GT , 0,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format($poids_flasque_GT + $poids_mouille_GT , 3,',',' '); ?></td> 
        </tr>
  <?php  
        } ?> 
 <?php } ?>


</tbody>
</table>


<?php if(!empty($trP['dates'])){
            $DateDebut=explode('-',$tr['dates']);
           if(!empty($tr2P['dates'])){
            $DateActuel=explode('-',$tr2P['dates']);?>

         

 <table class='table  table-bordered ' id='tablee' border='2' >
    

<thead>
           <tr style="background: black; color: white; text-align: center; font-weight: bold; " >
           <td colspan="16" ><h4 style="color: white;"> SITUATION DU TRANSFERT DES AVARIES <span style="color:yellow;">PAR CLIENT</span> DU <span style="color: red; background: white;"><?php echo  $DateActuel[2]. '-' .$DateActuel[1].'-'.$DateActuel[0];?></span></h4></td></tr>
<?php 
         }  }
   ?>
 
  
 <tr  style="background-color: rgba(50, 159, 218, 0.9); text-align: center;"  >
      
      
       <td scope="col"  rowspan="3"  id="colLibeles">CLIENT</td>
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
while ($fm0=$dispatching_avaries_client->fetch()) { 
 /* $avar=$TSTDVRAC->fetch();
  
  */

   //---REQUETE SAINS  DEBARQUES EN 24 PAR CALE ET PRODUIT

       
          $flasque_deb24H=$bdd->prepare("SELECT manif.*, dis.* ,d.num_declaration, sum(manif.sac),sum(manif.poids),nc.*,p.*,mg.mangasin from transfert_debarquement as manif
         left join declaration as d  on d.id_declaration=manif.id_declaration

          inner join dispats as dis on dis.id_dis=d.id_bl
          inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
          inner join produit_deb as p on p.id=nc.id_produit
          inner join mangasin as mg on mg.id=dis.id_mangasin 
           where manif.id_navire=? and manif.dates=? and nc.poids_kg=? and nc.id_produit=?  and dis.id_mangasin=?  and manif.statut='flasque'    ");

                  $flasque_deb24H->bindParam(1,$a[0]);
                  $flasque_deb24H->bindParam(2,$a[1]);
                  $flasque_deb24H->bindParam(3,$fm0['poids_kg']);
                  $flasque_deb24H->bindParam(4,$fm0['id_produit']);
                  $flasque_deb24H->bindParam(5,$fm0['id_mangasin']);
                 
          $flasque_deb24H->execute(); 

  $flasque_debST24H=$bdd->prepare("SELECT manif.*, dis.* ,d.num_declaration, sum(manif.sac),sum(manif.poids),nc.*,p.*,mg.mangasin from transfert_debarquement as manif
         left join declaration as d  on d.id_declaration=manif.id_declaration

          inner join dispats as dis on dis.id_dis=d.id_bl
          inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
          inner join produit_deb as p on p.id=nc.id_produit
          inner join mangasin as mg on mg.id=dis.id_mangasin 
           where manif.id_navire=? and manif.dates=?   and dis.id_mangasin=?  and manif.statut='flasque'    ");

                  $flasque_debST24H->bindParam(1,$a[0]);
                  $flasque_debST24H->bindParam(2,$a[1]);

                  $flasque_debST24H->bindParam(3,$fm0['id_mangasin']);
                 
          $flasque_debST24H->execute();

   $flasque_debSTT=$bdd->prepare("SELECT manif.*, dis.* ,d.num_declaration, sum(manif.sac),sum(manif.poids),nc.*,p.*,mg.mangasin from transfert_debarquement as manif
         left join declaration as d  on d.id_declaration=manif.id_declaration

          inner join dispats as dis on dis.id_dis=d.id_bl
          inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
          inner join produit_deb as p on p.id=nc.id_produit
          inner join mangasin as mg on mg.id=dis.id_mangasin 
           where manif.id_navire=? and manif.dates<=?   and dis.id_mangasin=?  and manif.statut='flasque'    ");

                   $flasque_debSTT->bindParam(1,$a[0]);
                   $flasque_debSTT->bindParam(2,$a[1]);

                   $flasque_debSTT->bindParam(3,$fm0['id_mangasin']);
                 
           $flasque_debSTT->execute();                    

            $flasque_debT24H=$bdd->prepare("SELECT manif.*, dis.* ,d.num_declaration, sum(manif.sac),sum(manif.poids),nc.*,p.*,mg.mangasin from transfert_debarquement as manif
         left join declaration as d  on d.id_declaration=manif.id_declaration

          inner join dispats as dis on dis.id_dis=d.id_bl
          inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
          inner join produit_deb as p on p.id=nc.id_produit
          inner join mangasin as mg on mg.id=dis.id_mangasin 
           where manif.id_navire=? and manif.dates<=? and nc.poids_kg=? and nc.id_produit=?  and dis.id_mangasin=?  and manif.statut='flasque'   ");

                  $flasque_debT24H->bindParam(1,$a[0]);
                  $flasque_debT24H->bindParam(2,$a[1]);
                  $flasque_debT24H->bindParam(3,$fm0['poids_kg']);
                  $flasque_debT24H->bindParam(4,$fm0['id_produit']);
                  $flasque_debT24H->bindParam(5,$fm0['id_mangasin']);
                 
          $flasque_debT24H->execute();


     $flasque_debG24H=$bdd->prepare("SELECT manif.*, dis.* ,d.num_declaration, sum(manif.sac),sum(manif.poids),nc.*,p.*,mg.mangasin from transfert_debarquement as manif
         left join declaration as d  on d.id_declaration=manif.id_declaration

          inner join dispats as dis on dis.id_dis=d.id_bl
          inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
          inner join produit_deb as p on p.id=nc.id_produit
          inner join mangasin as mg on mg.id=dis.id_mangasin 
           where manif.id_navire=? and manif.dates=?   and manif.statut='flasque'    ");

                  $flasque_debG24H->bindParam(1,$a[0]);
                  $flasque_debG24H->bindParam(2,$a[1]);

                  
                 
          $flasque_debG24H->execute();   

    $flasque_debGT=$bdd->prepare("SELECT manif.*, dis.* ,d.num_declaration, sum(manif.sac),sum(manif.poids),nc.*,p.*,mg.mangasin from transfert_debarquement as manif
         left join declaration as d  on d.id_declaration=manif.id_declaration

          inner join dispats as dis on dis.id_dis=d.id_bl
          inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
          inner join produit_deb as p on p.id=nc.id_produit
          inner join mangasin as mg on mg.id=dis.id_mangasin 
           where manif.id_navire=? and manif.dates<=?   and manif.statut='flasque'    ");

                  $flasque_debGT->bindParam(1,$a[0]);
                  $flasque_debGT->bindParam(2,$a[1]);

                  
                 
          $flasque_debGT->execute();                


           $mouille_deb24H=$bdd->prepare("SELECT manif.*, dis.* ,d.num_declaration, sum(manif.sac),sum(manif.poids),nc.*,p.*,mg.mangasin from transfert_debarquement as manif
         left join declaration as d  on d.id_declaration=manif.id_declaration

          inner join dispats as dis on dis.id_dis=d.id_bl
          inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
          inner join produit_deb as p on p.id=nc.id_produit
          inner join mangasin as mg on mg.id=dis.id_mangasin 
           where manif.id_navire=? and manif.dates=? and nc.poids_kg=? and nc.id_produit=?  and dis.id_mangasin=?  and manif.statut='mouille'    ");

                  $mouille_deb24H->bindParam(1,$a[0]);
                  $mouille_deb24H->bindParam(2,$a[1]);
                 $mouille_deb24H->bindParam(3,$fm0['poids_kg']);
                  $mouille_deb24H->bindParam(4,$fm0['id_produit']);
                  $mouille_deb24H->bindParam(5,$fm0['id_mangasin']);
                 
          $mouille_deb24H->execute(); 

            $mouille_debT24H=$bdd->prepare("SELECT manif.*, dis.* ,d.num_declaration, sum(manif.sac),sum(manif.poids),nc.*,p.*,mg.mangasin from transfert_debarquement as manif
         left join declaration as d  on d.id_declaration=manif.id_declaration

          inner join dispats as dis on dis.id_dis=d.id_bl
          inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
          inner join produit_deb as p on p.id=nc.id_produit
          inner join mangasin as mg on mg.id=dis.id_mangasin 
           where manif.id_navire=? and manif.dates<=? and nc.poids_kg=? and nc.id_produit=?  and dis.id_mangasin=?  and manif.statut='mouille'    ");

                  $mouille_debT24H->bindParam(1,$a[0]);
                  $mouille_debT24H->bindParam(2,$a[1]);
                  $mouille_debT24H->bindParam(3,$fm0['poids_kg']);
                  $mouille_debT24H->bindParam(4,$fm0['id_produit']);
                  $mouille_debT24H->bindParam(5,$fm0['id_mangasin']);
                 
          $mouille_debT24H->execute(); 


       $mouille_debST24H=$bdd->prepare("SELECT manif.*, dis.* ,d.num_declaration, sum(manif.sac),sum(manif.poids),nc.*,p.*,mg.mangasin from transfert_debarquement as manif
         left join declaration as d  on d.id_declaration=manif.id_declaration

          inner join dispats as dis on dis.id_dis=d.id_bl
          inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
          inner join produit_deb as p on p.id=nc.id_produit
          inner join mangasin as mg on mg.id=dis.id_mangasin 
           where manif.id_navire=? and manif.dates=?   and dis.id_mangasin=?  and manif.statut='mouille'    ");

                  $mouille_debST24H->bindParam(1,$a[0]);
                  $mouille_debST24H->bindParam(2,$a[1]);

                  $mouille_debST24H->bindParam(3,$fm0['id_mangasin']);
                 
         $mouille_debST24H->execute();

   $mouille_debSTT=$bdd->prepare("SELECT manif.*, dis.* ,d.num_declaration, sum(manif.sac),sum(manif.poids),nc.*,p.*,mg.mangasin from transfert_debarquement as manif
         left join declaration as d  on d.id_declaration=manif.id_declaration

          inner join dispats as dis on dis.id_dis=d.id_bl
          inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
          inner join produit_deb as p on p.id=nc.id_produit
          inner join mangasin as mg on mg.id=dis.id_mangasin 
           where manif.id_navire=? and manif.dates<=?   and dis.id_mangasin=?  and manif.statut='mouille'    ");

                   $mouille_debSTT->bindParam(1,$a[0]);
                   $mouille_debSTT->bindParam(2,$a[1]);

                   $mouille_debSTT->bindParam(3,$fm0['id_mangasin']);
                 
           $mouille_debSTT->execute(); 


 $mouille_debG24H=$bdd->prepare("SELECT manif.*, dis.* ,d.num_declaration, sum(manif.sac),sum(manif.poids),nc.*,p.*,mg.mangasin from transfert_debarquement as manif
         left join declaration as d  on d.id_declaration=manif.id_declaration

          inner join dispats as dis on dis.id_dis=d.id_bl
          inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
          inner join produit_deb as p on p.id=nc.id_produit
          inner join mangasin as mg on mg.id=dis.id_mangasin 
           where manif.id_navire=? and manif.dates=?   and manif.statut='mouille'    ");

                  $mouille_debG24H->bindParam(1,$a[0]);
                  $mouille_debG24H->bindParam(2,$a[1]);

                  
                 
          $mouille_debG24H->execute();   

    $mouille_debGT=$bdd->prepare("SELECT manif.*, dis.* ,d.num_declaration, sum(manif.sac),sum(manif.poids),nc.*,p.*,mg.mangasin from transfert_debarquement as manif
         left join declaration as d  on d.id_declaration=manif.id_declaration

          inner join dispats as dis on dis.id_dis=d.id_bl
          inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
          inner join produit_deb as p on p.id=nc.id_produit
          inner join mangasin as mg on mg.id=dis.id_mangasin 
           where manif.id_navire=? and manif.dates<=?   and manif.statut='mouille'    ");

                  $mouille_debGT->bindParam(1,$a[0]);
                  $mouille_debGT->bindParam(2,$a[1]);

                  
                 
          $mouille_debGT->execute();                



  $av_deb24H_flasque=$flasque_deb24H->fetch();
  $av_deb24H_mouille=$mouille_deb24H->fetch();

    $av_debST24H_flasque=$flasque_debST24H->fetch();
    $av_debST24H_mouille=$mouille_debST24H->fetch();

    $av_debSTT_flasque=$flasque_debSTT->fetch();
    $av_debSTT_mouille=$mouille_debSTT->fetch();

  $av_debT24H_flasque=$flasque_debT24H->fetch();
  $av_debT24H_mouille=$mouille_debT24H->fetch();

  $av_debG24H_flasque=$flasque_debG24H->fetch();
  $av_debG24H_mouille=$mouille_debG24H->fetch();


  $av_debGT_flasque=$flasque_debGT->fetch();
   $av_debGT_mouille=$mouille_debGT->fetch();

// variable en 24H ET TOTAL DEBARQUEMENT FLASQUES ET MOUILLES
      if(empty($av_deb24H_flasque['sum(manif.sac)'])){
        $sac_flasque_24h=0;
      }
      else{
        $sac_flasque_24h= $av_deb24H_flasque['sum(manif.sac)'];
      }
      if(empty($av_deb24H_flasque['sum(manif.poids)'])){
        $poids_flasque_24h=0;
      }
      else{
       $poids_flasque_24h= $av_deb24H_flasque['sum(manif.poids)'];
      }


      if(empty($av_debT24H_flasque['sum(manif.sac)'])){
        $sac_flasque_T24h=0;
      }
      else{
        $sac_flasque_T24h= $av_debT24H_flasque['sum(manif.sac)'];
      }
      if(empty($av_debT24H_flasque['sum(manif.poids)'])){
        $poids_flasque_T24h=0;
      }
      else{
       $poids_flasque_T24h= $av_debT24H_flasque['sum(manif.poids)'];
      } 


      if(empty($av_deb24H_mouille['sum(manif.sac)'])){
        $sac_mouille_24h=0;
      }
      else{
        $sac_mouille_24h= $av_deb24H_mouille['sum(manif.sac)'];
      }
      if(empty($av_deb24H_mouille['sum(manif.poids)'])){
        $poids_mouille_24h=0;
      }
      else{
       $poids_mouille_24h= $av_deb24H_mouille['sum(manif.poids)'];
      }


      if(empty($av_debT24H_mouille['sum(manif.sac)'])){
        $sac_mouille_T24h=0;
      }
      else{
        $sac_mouille_T24h= $av_debT24H_mouille['sum(manif.sac)'];
      }
      if(empty($av_debT24H_mouille['sum(manif.poids)'])){
        $poids_mouille_T24h=0;
      }
      else{
       $poids_mouille_T24h= $av_debT24H_mouille['sum(manif.poids)'];
      } 

   // variable en SOUS TOTAL DEBARQUEMENT FLASQUES ET MOUILLES
      if(empty($av_debST24H_flasque['sum(manif.sac)'])){
        $sac_flasque_ST24h=0;
      }
      else{
        $sac_flasque_ST24h= $av_debST24H_flasque['sum(manif.sac)'];
      }
      if(empty($av_debST24H_flasque['sum(manif.poids)'])){
        $poids_flasque_ST24h=0;
      }
      else{
       $poids_flasque_ST24h= $av_debST24H_flasque['sum(manif.poids)'];
      } 


      if(empty($av_debSTT_flasque['sum(manif.sac)'])){
        $sac_flasque_STT=0;
      }
      else{
        $sac_flasque_STT= $av_debSTT_flasque['sum(manif.sac)'];
      }
      if(empty($av_debSTT_flasque['sum(manif.poids)'])){
        $poids_flasque_STT=0;
      }
      else{
       $poids_flasque_STT= $av_debSTT_flasque['sum(manif.poids)'];
      } 


      if(empty($av_debST24H_mouille['sum(manif.sac)'])){
        $sac_mouille_ST24h=0;
      }
      else{
        $sac_mouille_ST24h= $av_debST24H_mouille['sum(manif.sac)'];
      }
      if(empty($av_debST24H_mouille['sum(manif.poids)'])){
        $poids_mouille_ST24h=0;
      }
      else{
       $poids_mouille_ST24h= $av_debST24H_mouille['sum(manif.poids)'];
      } 


      if(empty($av_debSTT_mouille['sum(manif.sac)'])){
        $sac_mouille_STT=0;
      }
      else{
        $sac_mouille_STT= $av_debSTT_mouille['sum(manif.sac)'];
      }
      if(empty($av_debSTT_mouille['sum(manif.poids)'])){
        $poids_mouille_STT=0;
      }
      else{
       $poids_mouille_STT= $av_debSTT_mouille['sum(manif.poids)'];
      } 

// variable en  TOTAL GENERAL DEBARQUEMENT FLASQUES ET MOUILLES
      if(empty($av_debG24H_flasque['sum(manif.sac)'])){
        $sac_flasque_G24h=0;
      }
      else{
        $sac_flasque_G24h= $av_debG24H_flasque['sum(manif.sac)'];
      }
      if(empty($av_debG24H_flasque['sum(manif.poids)'])){
        $poids_flasque_G24h=0;
      }
      else{
       $poids_flasque_G24h= $av_debG24H_flasque['sum(manif.poids)'];
      } 


      if(empty($av_debGT_flasque['sum(manif.sac)'])){
        $sac_flasque_GT=0;
      }
      else{
        $sac_flasque_GT= $av_debGT_flasque['sum(manif.sac)'];
      }
      if(empty($av_debGT_flasque['sum(manif.poids)'])){
        $poids_flasque_GT=0;
      }
      else{
       $poids_flasque_GT= $av_debGT_flasque['sum(manif.poids)'];
      } 


     if(empty($av_debG24H_mouille['sum(manif.sac)'])){
        $sac_mouille_G24h=0;
      }
      else{
        $sac_mouille_G24h= $av_debG24H_mouille['sum(manif.sac)'];
      }
      if(empty($av_debG24H_mouille['sum(manif.poids)'])){
        $poids_mouille_G24h=0;
      }
      else{
       $poids_mouille_G24h= $av_debG24H_mouille['sum(manif.poids)'];
      } 


      if(empty($av_debGT_mouille['sum(manif.sac)'])){
        $sac_mouille_GT=0;
      }
      else{
        $sac_mouille_GT= $av_debGT_mouille['sum(manif.sac)'];
      }
      if(empty($av_debGT_mouille['sum(manif.poids)'])){
        $poids_mouille_GT=0;
      }
      else{
       $poids_mouille_GT= $av_debGT_mouille['sum(manif.poids)'];
      }     



               

          if (!empty($fm0['id_client']) and !empty($fm0['produit'])  and !empty($fm0['poids_kg']) ){ ?>
       <tr style="text-align: center;">
        <td scope="col" class="colLibeles"><?php echo $fm0['client']  ?></td>
            <td scope="col" class="colLibeles" ><?php echo $fm0['produit']; ?> <?php echo $fm0['poids_kg']; ?> KGS</td>
              <td scope="col" id="colLibeles" ><?php echo number_format( $sac_flasque_24h , 0,',',' '); ?> </td>
     <td scope="col" class="colManifeste"  ><?php echo number_format( $poids_flasque_24h  , 3,',',' '); ?></td>

       <td scope="col" class="colManifeste" ><?php echo number_format( $sac_flasque_T24h , 0,',',' '); ?></td>
    <td class="colDeb24H" scope="col" ><?php echo number_format( $poids_flasque_T24h , 3,',',' '); ?></td>

      <td class="colDeb24H" scope="col"  ><?php echo number_format( $sac_mouille_24h  , 0,',',' '); ?></td>
      <td scope="col" class="colDebTOTAL"><?php echo number_format($poids_mouille_24h, 3,',',' '); ?></td>

      <td scope="col" class="colDebTOTAL"><?php echo number_format( $sac_mouille_T24h  , 0,',',' '); ?></td>
     <td scope="col" class="colROB"><?php echo number_format($poids_mouille_T24h , 3,',',' '); ?></td>

           <td scope="col" class="colDebTOTAL"><?php echo number_format($sac_flasque_24h + $sac_mouille_24h , 0,',',' '); ?></td>
     <td scope="col" class="colROB"><?php echo number_format($poids_flasque_24h + $poids_mouille_24h , 3,',',' '); ?></td>

 <td scope="col" class="colDebTOTAL"><?php echo number_format($sac_flasque_T24h + $sac_mouille_T24h , 0,',',' '); ?></td>
     <td scope="col" class="colROB"><?php echo number_format($poids_flasque_T24h + $poids_mouille_T24h , 3,',',' '); ?></td>

    
     </tr>

  
 <?php } 

 if (!empty($fm0['id_client']) and empty($fm0['produit'])  and empty($fm0['poids_kg']) ){ ?>
     <tr class="sousTOTAL"> 
      <td  colspan="2">  TOTAL <?php  echo $fm0['client'];  ?></td>
      <td  scope="col" ><?php echo number_format($sac_flasque_ST24h, 0,',',' '); ?></td>
       <td  scope="col" ><?php echo number_format($poids_flasque_ST24h, 3,',',' '); ?></td>
        <td  scope="col"  ><?php echo number_format($sac_flasque_STT, 0,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format($poids_flasque_STT , 3,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format($sac_mouille_ST24h  , 0,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format($poids_mouille_ST24h , 3,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format($sac_mouille_STT , 0,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format($poids_mouille_STT, 3,',',' '); ?></td>  
    <td  scope="col" ><?php echo number_format($sac_flasque_ST24h + $sac_mouille_ST24h, 0,',',' '); ?></td>
     <td  scope="col" ><?php echo number_format($poids_flasque_ST24h + $poids_mouille_ST24h, 3,',',' '); ?></td>   
 <td  scope="col" ><?php echo number_format($sac_flasque_STT + $sac_mouille_STT, 0,',',' '); ?></td>
     <td  scope="col" ><?php echo number_format($poids_flasque_STT + $poids_mouille_STT, 3,',',' '); ?></td> 



     </tr>
 <?php 
  }
 if (empty($fm0['id_client']) and empty($fm0['produit'])  and empty($fm0['poids_kg']) ){ ?>
       <tr class="TOTAL" >
       <td style="color:white;" colspan="2">  TOTAL  </td>
      <td  scope="col" ><?php echo number_format($sac_flasque_G24h, 0,',',' '); ?></td>
       <td  scope="col" ><?php echo number_format($poids_flasque_G24h, 3,',',' '); ?></td>
        <td  scope="col"  ><?php echo number_format( $sac_flasque_GT , 0,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format( $poids_flasque_GT , 3,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format($sac_mouille_G24h , 0,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format( $poids_mouille_G24h , 3,',',' '); ?></td>
                    <td  scope="col"  ><?php echo number_format($sac_mouille_GT , 0,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format( $poids_mouille_GT , 3,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format($sac_flasque_G24h + $sac_mouille_G24h , 0,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format($poids_flasque_G24h + $poids_mouille_G24h , 3,',',' '); ?></td> 

    <td  scope="col"  ><?php echo number_format($sac_flasque_GT + $sac_mouille_GT , 0,',',' '); ?></td>
          <td  scope="col"  ><?php echo number_format($poids_flasque_GT + $poids_mouille_GT , 3,',',' '); ?></td> 
        </tr>
  <?php  
        } ?> 
 <?php } ?>


</tbody>
</table>







<style type="text/css">
  @media print {
  .no_print {
    display: none;
  }
    #transf_by_avaries_produit {
    page-break-before: always !important;
  }
  }
</style>

 <button style="margin:auto-right;" class="btn btn-primary no_print" onClick="imprimer('transf_by_avaries_produit')">imprimer</button>

</div>


<div class="col col-lg-12" id="transf_by_avaries_destination"  style="display: none;">
  <style type="text/css">
 
@media print {
  .no_print {
    display: none;
  }
     #transf_by_avaries_destination {
    page-break-before: always;
  }
}
 </style>
<?php if(!empty($trP['dates'])){
            $DateDebut=explode('-',$tr['dates']);
           if(!empty($tr2P['dates'])){
            $DateActuel=explode('-',$tr2P['dates']);?>

 <table class='table table-hover table-bordered table-striped' id='table' border='2' >
    
 
<thead>
           <tr style="background: black; color: white; text-align: center; font-weight: bold; " >
           <td colspan="16" ><h4 style="color: white;"> SITUATION DU TRANSFERT DES AVARIES <span style="color:yellow;">PAR DESTINATION</span> DU <span style="color: red; background: white;"><?php echo  $DateActuel[2]. '-' .$DateActuel[1].'-'.$DateActuel[0];?></span></h4></td></tr>
<?php 
         }  }
   ?>
 
  
<tr  style="background-color: rgba(50, 159, 218, 0.9); text-align: center;"  >
      
      
       <td scope="col"  rowspan="3"  id="colLibeles">DESTINATION</td>
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
 
       </tr>        </thead>
<tbody>
<?php 
while ($fm0=$fmTRAVAD->fetch()) { 
  //$avar=$fmTTRAVAD->fetch();

  $avaries_deb24H=$bdd->prepare("SELECT trav.* , sum(trav.sac_flasque_tr_av),sum(trav.poids_flasque_tr_av),sum(trav.sac_mouille_tr_av),sum(trav.poids_mouille_tr_av) from transfert_avaries as trav
        inner join dispatching as dis on dis.id_dis=trav.id_dis_bl_tr  where dis.id_navire=? and trav.date_tr_avaries=? and dis.poids_kg=? and dis.id_produit=? and dis.id_mangasin=?   ");

                  $avaries_deb24H->bindParam(1,$a[0]);
                  $avaries_deb24H->bindParam(2,$a[1]);
                  $avaries_deb24H->bindParam(3,$fm0['poids_kg']);
                  $avaries_deb24H->bindParam(4,$fm0['id_produit']);
                  $avaries_deb24H->bindParam(5,$fm0['id_mangasin']);
                 
                  $avaries_deb24H->execute();

       
          

        //---REQUETE SAINS ET AVARIES DEBARQUES TOTAL PAR CALE ET PRODUIT
          $avaries_debT=$bdd->prepare("SELECT trav.* , sum(trav.sac_flasque_tr_av),sum(trav.poids_flasque_tr_av),sum(trav.sac_mouille_tr_av),sum(trav.poids_mouille_tr_av) from transfert_avaries as trav
        inner join dispatching as dis on dis.id_dis=trav.id_dis_bl_tr  where dis.id_navire=? and trav.date_tr_avaries<=? and dis.poids_kg=? and dis.id_produit=? and dis.id_mangasin=?    ");

                  $avaries_debT->bindParam(1,$a[0]);
                  $avaries_debT->bindParam(2,$a[1]);
                  $avaries_debT->bindParam(3,$fm0['poids_kg']);
                  $avaries_debT->bindParam(4,$fm0['id_produit']);
                   $avaries_debT->bindParam(5,$fm0['id_mangasin']);
                   $avaries_debT->execute();

    $avaries_debST24H=$bdd->prepare("SELECT trav.* , sum(trav.sac_flasque_tr_av),sum(trav.poids_flasque_tr_av),sum(trav.sac_mouille_tr_av),sum(trav.poids_mouille_tr_av) from transfert_avaries as trav
        inner join dispatching as dis on dis.id_dis=trav.id_dis_bl_tr  where dis.id_navire=? and trav.date_tr_avaries=? and dis.poids_kg=? and dis.id_produit=? and dis.id_mangasin=?   ");

                  $avaries_debST24H->bindParam(1,$a[0]);
                  $avaries_debST24H->bindParam(2,$a[1]);
                  $avaries_debST24H->bindParam(3,$fm0['poids_kg']);
                  $avaries_debST24H->bindParam(4,$fm0['id_produit']);
                   $avaries_debST24H->bindParam(5,$fm0['id_mangasin']);
                 
         $avaries_debST24H->execute();

       
          

        //---REQUETE SAINS ET AVARIES DEBARQUES TOTAL PAR CALE ET PRODUIT
          $avaries_debSTT=$bdd->prepare("SELECT trav.* , sum(trav.sac_flasque_tr_av),sum(trav.poids_flasque_tr_av),sum(trav.sac_mouille_tr_av),sum(trav.poids_mouille_tr_av) from transfert_avaries as trav
        inner join dispatching as dis on dis.id_dis=trav.id_dis_bl_tr  where dis.id_navire=? and trav.date_tr_avaries<=? and dis.poids_kg=? and dis.id_produit=? and dis.id_mangasin=?  ");

                  $avaries_debSTT->bindParam(1,$a[0]);
                  $avaries_debSTT->bindParam(2,$a[1]);
                  $avaries_debSTT->bindParam(3,$fm0['poids_kg']);
                  $avaries_debSTT->bindParam(4,$fm0['id_produit']);
                   $avaries_debSTT->bindParam(5,$fm0['id_mangasin']);
                   $avaries_debSTT->execute();                


  $avaries_debG24H=$bdd->prepare("SELECT trav.* , sum(trav.sac_flasque_tr_av),sum(trav.poids_flasque_tr_av),sum(trav.sac_mouille_tr_av),sum(trav.poids_mouille_tr_av) from transfert_avaries as trav
        inner join dispatching as dis on dis.id_dis=trav.id_dis_bl_tr  where dis.id_navire=? and trav.date_tr_avaries=?    ");

                  $avaries_debG24H->bindParam(1,$a[0]);
                  $avaries_debG24H->bindParam(2,$a[1]);
                  
                  
          $avaries_debG24H->execute();

        


     //---REQUETE  TOTAL GENERAL SAINS ET AVARIES TOTAL DEBARQUES DES CALES DEPUIS LE DEBUT DU DEBARQUEMENT TOTAL
          $avaries_debGT=$bdd->prepare("SELECT trav.* , sum(trav.sac_flasque_tr_av),sum(trav.poids_flasque_tr_av),sum(trav.sac_mouille_tr_av),sum(trav.poids_mouille_tr_av) from transfert_avaries as trav
        inner join dispatching as dis on dis.id_dis=trav.id_dis_bl_tr  where dis.id_navire=? and trav.date_tr_avaries<=?  ");

                  $avaries_debGT->bindParam(1,$a[0]);
                  $avaries_debGT->bindParam(2,$a[1]);
                  
                  
          $avaries_debGT->execute();





  


                  
         



      $av_deb=$avaries_deb24H->fetch();
       
      $av_debT=$avaries_debT->fetch();

      $av_debG=$avaries_debG24H->fetch();
      
      $av_debGT=$avaries_debGT->fetch();
      
      $av_debST=$avaries_debST24H->fetch();
      $av_debSTT=$avaries_debSTT->fetch();
      
       //$avaries2=$fm->fetch();
       
     


      //VARIABLES AVARIES
      if(empty($av_deb['sum(trav.sac_flasque_tr_av)'])){
        $sac_avaries=0;
      }
      else{
        $sac_avaries= $av_deb['sum(trav.sac_flasque_tr_av)'];
      }
      if(empty($av_deb['sum(trav.poids_flasque_tr_av)'])){
        $poids_avaries=0;
      }
      else{
        $poids_avaries= $av_deb['sum(trav.poids_flasque_tr_av)'];
      }

      if(empty($av_deb['sum(trav.sac_mouille_tr_av)'])){
        $sac_m=0;
      }
      else{
        $sac_m= $av_deb['sum(trav.sac_mouille_tr_av)'];
      }
      if(empty($av_deb['sum(trav.poids_mouille_tr_av)'])){
        $poids_m=0;
      }
      else{
        $poids_m= $av_deb['sum(trav.poids_mouille_tr_av)'];
      }      

    if(empty($av_debT['sum(trav.sac_flasque_tr_av)'])){
        $sac_avariesT=0;
      }
      else{
        $sac_avariesT= $av_debT['sum(trav.sac_flasque_tr_av)'];
      }
      if(empty($av_debT['sum(trav.poids_flasque_tr_av)'])){
        $poids_avariesT=0;
      }
      else{
        $poids_avariesT= $av_debT['sum(trav.poids_flasque_tr_av)'];
      }

      if(empty($av_debT['sum(trav.sac_mouille_tr_av)'])){
        $sac_mT=0;
      }
      else{
        $sac_mT= $av_debT['sum(trav.sac_mouille_tr_av)'];
      }
      if(empty($av_debT['sum(trav.poids_mouille_tr_av)'])){
        $poids_mT=0;
      }
      else{
        $poids_mT= $av_debT['sum(trav.poids_mouille_tr_av)'];
      }

      if(empty($av_debST['sum(trav.sac_flasque_tr_av)'])){
        $sac_avariesST=0;
      }
      else{
        $sac_avariesST= $av_debST['sum(trav.sac_flasque_tr_av)'];
      }
      if(empty($av_debST['sum(trav.poids_flasque_tr_av)'])){
        $poids_avariesST=0;
      }
      else{
        $poids_avariesST= $av_debST['sum(trav.poids_flasque_tr_av)'];
      }

      if(empty($av_debST['sum(trav.sac_mouille_tr_av)'])){
        $sac_mST=0;
      }
      else{
        $sac_mST= $av_debST['sum(trav.sac_mouille_tr_av)'];
      }
      if(empty($av_debST['sum(trav.poids_mouille_tr_av)'])){
        $poids_mST=0;
      }
      else{
        $poids_mST= $av_debST['sum(trav.poids_mouille_tr_av)'];
      }


      if(empty($av_debSTT['sum(trav.sac_flasque_tr_av)'])){
        $sac_avariesSTT=0;
      }
      else{
        $sac_avariesSTT= $av_debSTT['sum(trav.sac_flasque_tr_av)'];
      }
      if(empty($av_debSTT['sum(trav.poids_flasque_tr_av)'])){
        $poids_avariesSTT=0;
      }
      else{
        $poids_avariesSTT= $av_debSTT['sum(trav.poids_flasque_tr_av)'];
      }


      if(empty($av_debSTT['sum(trav.sac_mouille_tr_av)'])){
        $sac_mSTT=0;
      }
      else{
        $sac_mSTT= $av_debSTT['sum(trav.sac_mouille_tr_av)'];
      }
      if(empty($av_debSTT['sum(trav.poids_mouille_tr_av)'])){
        $poids_mSTT=0;
      }
      else{
        $poids_mSTT= $av_debSTT['sum(trav.poids_mouille_tr_av)'];
      }




      if(empty($av_debG['sum(trav.sac_flasque_tr_av)'])){
        $sac_avariesG=0;
      }
      else{
        $sac_avariesG= $av_debG['sum(trav.sac_flasque_tr_av)'];
      }
      if(empty($av_debG['sum(trav.poids_flasque_tr_av)'])){
        $poids_avariesG=0;
      }
      else{
        $poids_avariesG= $av_debG['sum(trav.poids_flasque_tr_av)'];
      }

      if(empty($av_debG['sum(trav.sac_mouille_tr_av)'])){
        $sac_mG=0;
      }
      else{
        $sac_mG= $av_debG['sum(trav.sac_mouille_tr_av)'];
      }
      if(empty($av_debG['sum(trav.poids_mouille_tr_av)'])){
        $poids_mG=0;
      }
      else{
        $poids_mG= $av_debG['sum(trav.poids_mouille_tr_av)'];
      }




      if(empty($av_debGT['sum(trav.sac_flasque_tr_av)'])){
        $sac_avariesGT=0;
      }
      else{
        $sac_avariesGT= $av_debGT['sum(trav.sac_flasque_tr_av)'];
      }
      if(empty($av_debGT['sum(trav.poids_flasque_tr_av)'])){
        $poids_avariesGT=0;
      }
      else{
        $poids_avariesGT= $av_debGT['sum(trav.poids_flasque_tr_av)'];
      }


     if(empty($av_debGT['sum(trav.sac_mouille_tr_av)'])){
        $sac_mGT=0;
      }
      else{
        $sac_mGT= $av_debGT['sum(trav.sac_mouille_tr_av)'];
      }
      if(empty($av_debGT['sum(trav.poids_mouille_tr_av)'])){
        $poids_mGT=0;
      }
      else{
        $poids_mGT= $av_debGT['sum(trav.poids_mouille_tr_av)'];
      }
      
  
  

 

  if (!empty($fm0['mangasin']) and !empty($fm0['produit']) and !empty($fm0['id_dis']) ){ ?>
       <tr style="text-align: center;">
        <td scope="col"   id="colLibeles"><?php echo $fm0['mangasin']  ?></td>
            <td scope="col"   id="colLibeles"><?php echo $fm0['produit']; ?> <?php echo $fm0['poids_kg']; ?> KGS</td>
     
     <td id="colDeb24H" scope="col" ><?php echo number_format($sac_avaries , 0,',',' '); ?></td>
      <td id="colDeb24H" scope="col"  ><?php echo number_format($poids_avaries  , 3,',',' '); ?></td>
      <td scope="col" id="colDebTOTAL"><?php echo number_format($sac_avariesT, 0,',',' '); ?></td>
      <td scope="col" id="colDebTOTAL"><?php echo number_format($poids_avariesT  , 3,',',' '); ?></td>
      <td id="colDeb24H" scope="col" ><?php echo number_format($sac_m , 0,',',' '); ?></td>
      <td id="colDeb24H" scope="col"  ><?php echo number_format($poids_m  , 3,',',' '); ?></td>

      <td scope="col" id="colDebTOTAL"><?php echo number_format($sac_mT, 0,',',' '); ?></td>
      <td scope="col" id="colDebTOTAL"><?php echo number_format($poids_mT  , 3,',',' '); ?></td>
       
      <td scope="col" id="colDebTOTAL"><?php echo number_format($sac_avaries + $sac_m, 0,',',' '); ?></td>
      <td scope="col" id="colDebTOTAL"><?php echo number_format($poids_avaries + $poids_m  , 3,',',' '); ?></td>
       <td scope="col" id="colDebTOTAL"><?php echo number_format($sac_avariesT + $sac_mT, 0,',',' '); ?></td>
      <td scope="col" id="colDebTOTAL"><?php echo number_format($poids_avariesT + $poids_mT  , 3,',',' '); ?></td>

    
     </tr>

  
 <?php } 

 if (!empty($fm0['mangasin']) and empty($fm0['produit']) and empty($fm0['id_dis']) ){ ?>
       <tr style="text-align: center; background: blue;">
        <td scope="col" colspan="2"   style="color: black; font-weight: bold;"> TOTAL <?php echo $fm0['mangasin']  ?></td>
            
    <td id="colDeb24H" scope="col" ><?php echo number_format($sac_avariesST , 0,',',' '); ?></td>
      <td id="colDeb24H" scope="col"  ><?php echo number_format($poids_avariesST  , 3,',',' '); ?></td>
      <td scope="col" id="colDebTOTAL"><?php echo number_format($sac_avariesSTT, 0,',',' '); ?></td>
      <td scope="col" id="colDebTOTAL"><?php echo number_format($poids_avariesSTT  , 3,',',' '); ?></td>
      <td id="colDeb24H" scope="col" ><?php echo number_format($sac_mST , 0,',',' '); ?></td>
      <td id="colDeb24H" scope="col"  ><?php echo number_format($poids_mST  , 3,',',' '); ?></td>

      <td scope="col" id="colDebTOTAL"><?php echo number_format($sac_mSTT, 0,',',' '); ?></td>
      <td scope="col" id="colDebTOTAL"><?php echo number_format($poids_mSTT  , 3,',',' '); ?></td>
       
      <td scope="col" id="colDebTOTAL"><?php echo number_format($sac_avariesST + $sac_mST, 0,',',' '); ?></td>
      <td scope="col" id="colDebTOTAL"><?php echo number_format($poids_avariesST + $poids_mST  , 3,',',' '); ?></td>
       <td scope="col" id="colDebTOTAL"><?php echo number_format($sac_avariesSTT + $sac_mSTT, 0,',',' '); ?></td>
      <td scope="col" id="colDebTOTAL"><?php echo number_format($poids_avariesSTT + $poids_mSTT  , 3,',',' '); ?></td>

    
     </tr>

  
 <?php } 
 if (empty($fm0['mangasin']) and empty($fm0['produit']) and empty($fm0['id_dis']) ){ ?>
       <tr style="text-align: center; background: red; color: white;">
        <td scope="col" colspan="2"  style=" font-weight: bold;"> TOTAL<?php echo $fm0['mangasin']  ?></td>
        <td  scope="col" ><?php echo number_format($sac_avariesG , 0,',',' '); ?></td>
      <td  scope="col"  ><?php echo number_format($poids_avariesG  , 3,',',' '); ?></td>
      <td scope="col" ><?php echo number_format($sac_avariesGT, 0,',',' '); ?></td>
      <td scope="col" ><?php echo number_format($poids_avariesGT  , 3,',',' '); ?></td>
      <td  scope="col" ><?php echo number_format($sac_mG , 0,',',' '); ?></td>
      <td  scope="col"  ><?php echo number_format($poids_mG  , 3,',',' '); ?></td>

      <td scope="col" ><?php echo number_format($sac_mGT, 0,',',' '); ?></td>
      <td scope="col" ><?php echo number_format($poids_mGT  , 3,',',' '); ?></td>
       
      <td scope="col" ><?php echo number_format($sac_avariesG + $sac_mG, 0,',',' '); ?></td>
      <td scope="col" ><?php echo number_format($poids_avariesG + $poids_mG  , 3,',',' '); ?></td>
       <td scope="col" ><?php echo number_format($sac_avariesGT + $sac_mGT, 0,',',' '); ?></td>
      <td scope="col" ><?php echo number_format($poids_avariesGT + $poids_mGT  , 3,',',' '); ?></td>

    
     </tr>

  <?php }  ?> 
 <?php } ?>



</tbody>
</table>
<button style="margin:auto-right;" class="btn btn-primary no_print" onClick="imprimer('transf_by_avaries_destination')">imprimer</button>
</div>


<div class="col col-lg-12" id="avaries_restant_by_produit"  style="display: none;">
  <style type="text/css">

   
    
@media print {
  .no_print {
    display: none;
  }
     #avaries_restant_by_produit {
    page-break-before: always;
  }
}
 </style>
<?php if(!empty($trP['dates'])){
            $DateDebut=explode('-',$tr['dates']);
           if(!empty($tr2P['dates'])){
            $DateActuel=explode('-',$tr2P['dates']);?>

 <table class='table table-hover table-bordered table-striped' id='table' border='2' >
    

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
        
       while($fm0=$fmTTRAVAPRES->fetch()){

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
      /*  $rob_sac_flasque=$cumul['sum(av.sac_flasque)']-$avar['sum(trav.sac_flasque_tr_av)'];
        $rob_poids_flasque=$cumul['sum(av.poids_flasque)']-$avar['sum(trav.poids_flasque_tr_av)'];
        $rob_sac_mouille=$cumul['sum(av.sac_mouille)']-$avar['sum(trav.sac_mouille_tr_av)'];
        $rob_poids_mouille=$cumul['sum(av.poids_mouille)']-$avar['sum(trav.poids_mouille_tr_av)'];
        $total_rob_sac=$rob_sac_flasque+$rob_sac_mouille;
        $total_rob_poids=$rob_poids_flasque+$rob_poids_mouille; */

         $avaries_debT=$bdd->prepare("SELECT trav.* , sum(trav.sac_flasque_tr_av),sum(trav.poids_flasque_tr_av),sum(trav.sac_mouille_tr_av),sum(trav.poids_mouille_tr_av) from transfert_avaries as trav
        inner join dispatching as dis on dis.id_dis=trav.id_dis_bl_tr  where dis.id_navire=? and trav.date_tr_avaries<=? and dis.poids_kg=? and dis.id_produit=?     ");

                  $avaries_debT->bindParam(1,$a[0]);
                  $avaries_debT->bindParam(2,$a[1]);
                  $avaries_debT->bindParam(3,$fm0['poids_kg']);
                  $avaries_debT->bindParam(4,$fm0['id_produit']);
                   
                   $avaries_debT->execute();

    $avaries_deb24H=$bdd->prepare("SELECT av.* , sum(av.sac_flasque),sum(av.poids_flasque),sum(av.sac_mouille),sum(av.poids_mouille) from avaries as av
        inner join dispatching as dis on dis.id_dis=av.id_dis_av  where dis.id_navire=? and av.date_avaries=? and dis.poids_kg=? and dis.id_produit=?    ");

                  $avaries_deb24H->bindParam(1,$a[0]);
                  $avaries_deb24H->bindParam(2,$a[1]);
                  $avaries_deb24H->bindParam(3,$fm0['poids_kg']);
                  $avaries_deb24H->bindParam(4,$fm0['id_produit']);
                 
                 
         $avaries_deb24H->execute();

         $av_deb=$avaries_deb24H->fetch();
         $av_debT=$avaries_debT->fetch();



 


         if(empty($av_deb['sum(av.sac_flasque)'])){
        $sac_avaries=0;
      }
      else{
        $sac_avaries= $av_deb['sum(av.sac_flasque)'];
      }
      if(empty($av_deb['sum(av.poids_flasque)'])){
        $poids_avaries=0;
      }
      else{
        $poids_avaries= $av_deb['sum(av.poids_flasque)'];
      }

      if(empty($av_deb['sum(av.sac_mouille)'])){
        $sac_m=0;
      }
      else{
        $sac_m= $av_deb['sum(av.sac_mouille)'];
      }
      if(empty($av_deb['sum(av.poids_mouille)'])){
        $poids_m=0;
      }
      else{
        $poids_m= $av_deb['sum(av.poids_mouille)'];
      }      

    if(empty($av_debT['sum(trav.sac_flasque_tr_av)'])){
        $sac_avariesT=0;
      }
      else{
        $sac_avariesT= $av_debT['sum(trav.sac_flasque_tr_av)'];
      }
      if(empty($av_debT['sum(trav.poids_flasque_tr_av)'])){
        $poids_avariesT=0;
      }
      else{
        $poids_avariesT= $av_debT['sum(trav.poids_flasque_tr_av)'];
      }

      if(empty($av_debT['sum(trav.sac_mouille_tr_av)'])){
        $sac_mT=0;
      }
      else{
        $sac_mT= $av_debT['sum(trav.sac_mouille_tr_av)'];
      }
      if(empty($av_debT['sum(trav.poids_mouille_tr_av)'])){
        $poids_mT=0;
      }
      else{
        $poids_mT= $av_debT['sum(trav.poids_mouille_tr_av)'];
      }

      
      
  



        ?>

        <tr style="text-align: center;">
        
            <td scope="col"   id="colLibeles"><?php echo $fm0['produit']; ?> <?php echo $fm0['poids_kg']; ?> KGS</td>
     
    <td scope="col"  id="colFlasque"><?php echo number_format($sac_avaries - $sac_avariesT, 0,',',' ');  ?> </td>
    <td scope="col"  id="colFlasque"><?php echo number_format($poids_avaries - $poids_avariesT, 3,',',' '); ?> </td>
      <td scope="col"  id="colMouille"><?php echo number_format($sac_m - $sac_mT, 0,',',' '); ?></td>
      <td scope="col"  id="colMouille"><?php echo number_format($poids_m - $poids_mT, 3,',',' '); ?></td>
            <td scope="col" id="colCumulGen"><?php echo number_format($sac_avaries + $sac_m -($sac_avariesT + $sac_mT), 0,',',' ');  ?></td>
    <td scope="col" id="colCumulGen"><?php echo number_format($poids_avaries + $poids_m -($poids_avariesT + $poids_mT), 3,',',' '); ?></td>
    
   
     </tr>
     <?php }  ?>

     <?php  $avaries_debGT=$bdd->prepare("SELECT trav.* , sum(trav.sac_flasque_tr_av),sum(trav.poids_flasque_tr_av),sum(trav.sac_mouille_tr_av),sum(trav.poids_mouille_tr_av) from transfert_avaries as trav
        inner join dispatching as dis on dis.id_dis=trav.id_dis_bl_tr  where dis.id_navire=? and trav.date_tr_avaries<=?     ");

                  $avaries_debGT->bindParam(1,$a[0]);
                  $avaries_debGT->bindParam(2,$a[1]);

                   
                   $avaries_debGT->execute();

    $avaries_debG24H=$bdd->prepare("SELECT av.* , sum(av.sac_flasque),sum(av.poids_flasque),sum(av.sac_mouille),sum(av.poids_mouille) from avaries as av
        inner join dispatching as dis on dis.id_dis=av.id_dis_av  where dis.id_navire=? and av.date_avaries=?    ");

                  $avaries_debG24H->bindParam(1,$a[0]);
                  $avaries_debG24H->bindParam(2,$a[1]);       
          $avaries_debG24H->execute();
          while($av_debG=$avaries_debG24H->fetch()){ 
            $av_debGT=$avaries_debGT->fetch(); 

            if(empty($av_debG['sum(trav.sac_flasque_tr_av)'])){
        $sac_avariesG=0;
      }
      else{
        $sac_avariesG= $av_debG['sum(trav.sac_flasque_tr_av)'];
      }
      if(empty($av_debG['sum(trav.poids_flasque_tr_av)'])){
        $poids_avariesG=0;
      }
      else{
        $poids_avariesG= $av_debG['sum(trav.poids_flasque_tr_av)'];
      }

      if(empty($av_debG['sum(trav.sac_mouille_tr_av)'])){
        $sac_mG=0;
      }
      else{
        $sac_mG= $av_debG['sum(trav.sac_mouille_tr_av)'];
      }
      if(empty($av_debG['sum(trav.poids_mouille_tr_av)'])){
        $poids_mG=0;
      }
      else{
        $poids_mG= $av_debG['sum(trav.poids_mouille_tr_av)'];
      }




      if(empty($av_debGT['sum(trav.sac_flasque_tr_av)'])){
        $sac_avariesGT=0;
      }
      else{
        $sac_avariesGT= $av_debGT['sum(trav.sac_flasque_tr_av)'];
      }
      if(empty($av_debGT['sum(trav.poids_flasque_tr_av)'])){
        $poids_avariesGT=0;
      }
      else{
        $poids_avariesGT= $av_debGT['sum(trav.poids_flasque_tr_av)'];
      }


     if(empty($av_debGT['sum(trav.sac_mouille_tr_av)'])){
        $sac_mGT=0;
      }
      else{
        $sac_mGT= $av_debGT['sum(trav.sac_mouille_tr_av)'];
      }
      if(empty($av_debGT['sum(trav.poids_mouille_tr_av)'])){
        $poids_mGT=0;
      }
      else{
        $poids_mGT= $av_debGT['sum(trav.poids_mouille_tr_av)'];
      }


            ?>

     <tr style="text-align: center; color:white; background: black; vertical-align: center;">
        
            <td scope="col"   >TOTAL RESTANT</td>
     
    <td scope="col" ><?php echo number_format($sac_avariesGT - $sac_avariesG, 0,',',' ');  ?> </td>
    <td scope="col"  ><?php echo number_format($poids_avariesGT - $poids_avariesG, 3,',',' '); ?> </td>
      <td scope="col" ><?php echo number_format($sac_mGT - $sac_mG, 0,',',' '); ?></td>
      <td scope="col" ><?php echo number_format($poids_mGT - $poids_mG, 3,',',' '); ?></td>
            <td scope="col" ><?php echo number_format($sac_avariesGT + $sac_mGT -($sac_avariesG + $sac_mG), 0,',',' ');  ?></td>
    <td scope="col" ><?php echo number_format($poids_avariesGT + $poids_mGT -($poids_avariesG + $poids_mG), 3,',',' '); ?></td>
    
   
     </tr>
     <?php }  ?>
        
 


</body>
 </table>

<button style="margin:auto-right;" class="btn btn-primary no_print" onClick="imprimer('avaries_restant_by_produit')">imprimer</button>
</div>


</div>


<div id="nnnn"  style="display: none;">
  <style type="text/css">

   body{
    font-family:Times New Roman;
    font-weight: bold;
  }
      .hidden {
    display: none;
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
    
@media print {
  .no_print {
    display: none;
  }
}
 </style>
<?php if(!empty($trP['dates'])){
            $DateDebut=explode('-',$tr['dates']);
           if(!empty($tr2P['dates'])){
            $DateActuel=explode('-',$tr2P['dates']);?>

 <table class='table table-hover table-bordered table-striped' id='table' border='2' >
    
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
        
       while($avar=$TRANSF24H->fetch()){

       
     $count=$countbl->fetch();
        
       
      
        $sac_transf=$avar['sum(rm.sac)']/$count['count'];

      
      // $sac_transf2=$av2['sum(rm.sac)']+$av2['sum(tr.sac_flasque_tr_av)'];

        ?>

        <tr style="text-align: center;">
        
            <td scope="col"   style="color: black; font-weight: bold;"> <?php // echo $avar['poids_sac_tr_av']; ?> KGS</td>
     
    <td scope="col"   style="color: black; font-weight: bold;"><?php echo number_format($count['count(n_bl)'], 0,',',' ');  ?> </td>
    <td scope="col"   style="color: black; font-weight: bold;"><?php // echo number_format($sac_transf, 3,',',' '); ?> </td>
      <td scope="col"   style="color: black; font-weight: bold;"><?php // echo number_format($sac_transf, 0,',',' '); ?></td>
      <td scope="col"   style="color: black; font-weight: bold;"><?php // echo number_format($sac_transf, 3,',',' '); ?></td>
            <td scope="col"   style="color: black; font-weight: bold;"><?php // echo number_format($sac_transf, 0,',',' ');  ?></td>
    <td scope="col"   style="color: black; font-weight: bold;"><?php // echo number_format($sac_transf, 3,',',' '); ?></td>
    
   
     </tr>
     <?php }  ?>
 


</body>
 </table>
 <button style="margin:auto-right;" class="btn btn-primary no_print" onClick="imprimer('situation_glob')">imprimer</button>

</div>









<?php } ?>



<?php // 2eme PARTIE SI LE TYPE NAVIRE EST EN VRAC ?>



<?php    
           if($filtre_type['type']=="VRAQUIER"){ ?>

<div id="btnafficher"> 
            <div class="container">
        <div class="row">

            <div class="col-lg-12">
              <center>
                <div  class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        SITUATION DE DEBARQUEMENT
                    </button>
                    
                    <ul id="drop_debarquement" class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li><a  id="deb_cale" class="dropdown-item" onclick="VisibleDebParCale();" >PAR CALE</a></li>
                        <li><a onclick="VisibleDebParProduit();"  id="deb_produit" class="dropdown-item" >PAR PRODUIT</a></li>
                        <li><a onclick="VisibleDebParDes();" id="deb_avaries" class="dropdown-item" >PAR DESTINATION</a></li>
                        <li><a onclick="VisibleDebParClient();" id="deb_avaries" class="dropdown-item" >PAR CLIENT</a></li>
                         <li><a  class="dropdown-item" id="deb_destination" onclick="VisibleGlobal2();">GLOBAL</a></li> 
                         
                    </ul>
                  
                </div>
            </div>
        
           
        </div>
    </div>

<center>  

<button style="margin:auto-right; display: none; width: 30%;" class="btn btn-danger no_print" onclick="imprimer('situation_global')" id="all_imprime" >imprimer tous</button>
</center>
</div>
<div class="row" id="situation_global"> 

<?php $deb_cale2=$_POST['deb_cale']; ?>
<div class="col col-lg-12" id="deb_by_cale"  <?php if($deb_cale2==0){

 ?> style="display: none;" <?php } ?>  <?php if($deb_cale2==1){

 ?> style="display: block;" <?php } ?>>




<div class="table-responsive"  >
          <?php if(!empty($tr['dates'])){
            $DateDebut=explode('-',$tr['dates']);
           if(!empty($tr2['dates'])){
            $DateActuel=explode('-',$tr2['dates']);?>

 <table class='table table-hover table-bordered table-striped' id='table' >";
    

<thead>
           <tr style="background: linear-gradient(to bottom, blue, #1B2B65); background: linear-gradient(to left, blue, #1B2B65); background: linear-gradient(to top, blue, #1B2B65); color: white; text-align: center; font-weight: bold; " >
           <td colspan="10" ><h4 style="color: white;"> SITUATION DU DEBARQUEMENT <span style="color:yellow;">PAR CALE</span> DU <span style="color: red; background: white;"><?php echo  $DateActuel[2]. '-' .$DateActuel[1].'-'.$DateActuel[0];?></span></h4></td></tr>
<?php 
         }  }
   ?>
          



  
 <tr class="EnteteTableSituation" style="font-size: 12px;" >
      

      <td id="colLibeles" scope="col"  rowspan="2"  >CALES</td>
      <td id="colLibeles" scope="col"  rowspan="2"  >PRODUIT</td>
      <td id="colManifeste"  >MANIFESTE</td>
      <td scope="col"  id="colDeb24H" >DEB 24H</td>
      <td scope="col"  id="colDebTOTAL" > TOTAL DEB</td>
      <td scope="col"  id="colROB">ROB</td>
  </tr>
    <tr class="EnteteTableSituation"  >
      
     
      <td id="colManifeste">POIDS</td>
       
      <td scope="col" id="colDeb24H" >POIDS</td>
        
      <td scope="col" id="colDebTOTAL" >POIDS</td>
       
      <td scope="col" id="colROB" >POIDS</td>
        
     
     
 
         </tr>
         </thead> 
         <tbody> 
         
       <?php 
        
       while($cal2=$cale->fetch()){

      //---REQUETE SAINS ET AVARIES DEBARQUES EN 24 PAR CALE ET PRODUIT

         $sain_24H=$bdd->prepare("SELECT dc.*,count(dc.cales), sum(dc.nombre_sac), sum(dc.poids), p.*,sum(rm.sac),sum(rm.poids) FROM declaration_chargement as dc LEFT join produit_deb as p on dc.id_produit=p.id
         inner join transfert_debarquement as rm on rm.cale=dc.id_dec  where dc.id_navire=? and rm.dates=? and dc.cales=? and dc.id_produit=?  group by dc.cales,p.produit   ");
          $sain_24H->bindParam(1,$a[0]);  
          $sain_24H->bindParam(2,$a[1]);  
           $sain_24H->bindParam(3,$cal2['cales']); 
            $sain_24H->bindParam(4,$cal2['id_produit']); 
            
          $sain_24H->execute();
          

            $sain_TOTAL=$bdd->prepare("SELECT dc.*,count(dc.cales), sum(dc.nombre_sac), sum(dc.poids), p.*,sum(rm.sac),sum(rm.poids) FROM declaration_chargement as dc LEFT join produit_deb as p on dc.id_produit=p.id
         inner join transfert_debarquement as rm on rm.cale=dc.id_dec  where dc.id_navire=? and rm.dates<=? and dc.cales=? and dc.id_produit=?   group by dc.cales,p.produit    ");
         $sain_TOTAL->bindParam(1,$a[0]);  
          $sain_TOTAL->bindParam(2,$a[1]);  
           $sain_TOTAL->bindParam(3,$cal2['cales']); 
            $sain_TOTAL->bindParam(4,$cal2['id_produit']); 
           
          $sain_TOTAL->execute();


   
          

        


            $sain_ST24H=$bdd->prepare("SELECT dc.*,count(dc.cales), sum(dc.nombre_sac), sum(dc.poids), p.*,sum(rm.sac),sum(rm.poids) FROM declaration_chargement as dc LEFT join produit_deb as p on dc.id_produit=p.id
         inner join transfert_debarquement as rm on rm.cale=dc.id_dec  where dc.id_navire=? and rm.dates=? and dc.cales=?   group by dc.cales   ");
          $sain_ST24H->bindParam(1,$a[0]);  
          $sain_ST24H->bindParam(2,$a[1]);  
           $sain_ST24H->bindParam(3,$cal2['cales']); 

          $sain_ST24H->execute();

          

            $sain_STT=$bdd->prepare("SELECT dc.*,count(dc.cales), sum(dc.nombre_sac), sum(dc.poids), p.*,sum(rm.sac),sum(rm.poids) FROM declaration_chargement as dc LEFT join produit_deb as p on dc.id_produit=p.id
         inner join transfert_debarquement as rm on rm.cale=dc.id_dec  where dc.id_navire=? and rm.dates<=? and dc.cales=?  group by dc.cales   ");
         $sain_STT->bindParam(1,$a[0]);  
         $sain_STT->bindParam(2,$a[1]);  
           $sain_STT->bindParam(3,$cal2['cales']); 
          $sain_STT->execute();

         
          

                

            $sain_G24H=$bdd->prepare("SELECT dc.*,count(dc.cales), sum(dc.nombre_sac), sum(dc.poids), p.*,sum(rm.sac),sum(rm.poids) FROM declaration_chargement as dc LEFT join produit_deb as p on dc.id_produit=p.id
         inner join transfert_debarquement as rm on rm.cale=dc.id_dec  where dc.id_navire=? and rm.dates=?    ");
          $sain_G24H->bindParam(1,$a[0]);  
          $sain_G24H->bindParam(2,$a[1]);  
            

         $sain_G24H->execute();

          

            $sain_GT=$bdd->prepare("SELECT dc.*,count(dc.cales), sum(dc.nombre_sac), sum(dc.poids), p.*,sum(rm.sac),sum(rm.poids) FROM declaration_chargement as dc LEFT join produit_deb as p on dc.id_produit=p.id
         inner join transfert_debarquement as rm on rm.cale=dc.id_dec  where dc.id_navire=? and rm.dates<=?     ");
         $sain_GT->bindParam(1,$a[0]);  
         $sain_GT->bindParam(2,$a[1]);  
           
          $sain_GT->execute(); 


                  
          

            


        $s_G24H=$sain_G24H->fetch();
         $s_GT=$sain_GT->fetch();
         $s_ST24H=$sain_ST24H->fetch();
         $s_STT=$sain_STT->fetch();
          $s_24H=$sain_24H->fetch();
          $s_TOTAL=$sain_TOTAL->fetch();
         

          if(!empty($s_24H['sum(rm.sac)'])){
            $sac_sains_24H=$s_24H['sum(rm.sac)'];
            $poids_sains_24H=$s_24H['sum(rm.poids)'];
          }
          else{
            $sac_sains_24H=0;
            $poids_sains_24H=0;
          }
           if(!empty($s_TOTAL['sum(rm.sac)'])){
            $sac_sains_TOTAL=$s_TOTAL['sum(rm.sac)'];
            $poids_sains_TOTAL=$s_TOTAL['sum(rm.poids)'];
          }
          else{
            $sac_sains_TOTAL=0;
            $poids_sains_TOTAL=0;
          }

           if(!empty($s_ST24H['sum(rm.sac)'])){
            $sac_sains_ST24H=$s_ST24H['sum(rm.sac)'];
            $poids_sains_ST24H=$s_ST24H['sum(rm.poids)'];
          }
          else{
            $sac_sains_ST24H=0;
            $poids_sains_ST24H=0;
          }
           if(!empty($s_STT['sum(rm.sac)'])){
            $sac_sains_STT=$s_STT['sum(rm.sac)'];
            $poids_sains_STT=$s_STT['sum(rm.poids)'];
          }
          else{
            $sac_sains_STT=0;
            $poids_sains_STT=0;
          }

                   if(!empty($s_G24H['sum(rm.sac)'])){
            $sac_sains_G24H=$s_G24H['sum(rm.sac)'];
            $poids_sains_G24H=$s_G24H['sum(rm.poids)'];
          }
          else{
            $sac_sains_G24H=0;
            $poids_sains_G24H=0;
          }
           if(!empty($s_GT['sum(rm.sac)'])){
            $sac_sains_GT=$s_GT['sum(rm.sac)'];
            $poids_sains_GT=$s_GT['sum(rm.poids)'];
          }
          else{
            $sac_sains_GT=0;
            $poids_sains_GT=0;
          }


       

        ?>

        
          <?php if(!empty($cal2['cales']) and !empty($cal2['produit']) ) {


            ?>

            <tr class="CelluleTableSituation" >
    <td id="colLibeles" scope="col"  ><?php echo $cal2['cales']; ?></td>
    <td id="colLibeles"  scope="col"   ><?php echo $cal2['produit']; ?> </td>
    
    
    <td  scope="col" id="colManifeste" ><?php echo number_format($cal2['poids'], 3,',',' '); ?></td>
    
      
      <td id="colDeb24H" scope="col"  ><?php echo number_format( $poids_sains_24H , 3,',',' '); ?></td>
    
      <td scope="col" id="colDebTOTAL"><?php echo number_format( $poids_sains_TOTAL , 3,',',' '); ?></td>
     
      <td scope="col" id="colROB" ><?php echo number_format($cal2['poids'] - $poids_sains_TOTAL, 3,',',' '); ?></td>
     </tr>




     <?php } ?>

      <?php if(!empty($cal2['cales']) and empty($cal2['produit']) ) {?>

      <tr style="text-align: center; vertical-align: middle; background: blue; color:white;" > 
      <td id="sousTOTAL" colspan="2">  TOTAL <?php  echo $cal2['cales'];  ?></td>
     
       <td id="sousTOTAL" scope="col" ><?php echo number_format($cal2['sum(dc.poids)'], 3,',',' '); ?></td>
       
          <td id="sousTOTAL" scope="col"  ><?php echo number_format( $poids_sains_ST24H , 3,',',' '); ?></td>
          
          <td id="sousTOTAL" scope="col"  ><?php echo number_format( $poids_sains_STT , 3,',',' '); ?></td>
         
          <td id="sousTOTAL" scope="col"  ><?php echo number_format($cal2['sum(dc.poids)']- $poids_sains_STT , 3,',',' '); ?></td>          

     </tr>
   <?php  } ?>

    <?php if(empty($cal2['produit'])  and empty($cal2['cales'])) {?>
      <tr style="text-align: center; vertical-align: middle; color: white; background: green;" >
       <td id="TOTAL" colspan="2">  TOTAL <?php  echo $cal2['cales'];  ?></td>
    
       <td id="TOTAL" scope="col" ><?php echo number_format($cal2['sum(dc.poids)'], 3,',',' '); ?></td>
     
          <td id="TOTAL" scope="col"  ><?php echo number_format($poids_sains_G24H , 3,',',' '); ?></td>
      
          <td id="TOTAL" scope="col"  ><?php echo number_format( $poids_sains_GT, 3,',',' '); ?></td>
     
          <td id="TOTAL" scope="col"  ><?php echo number_format($cal2['sum(dc.poids)']- $poids_sains_GT, 3,',',' '); ?></td> 
        </tr>
     
    

     <?php }

     }  ?>
    
 
      
   </tbody>


 </table>
</div>

<style type="text/css">
  @media print {
  .no_print {
    display: none;
  }
   
  #btnafficher, #cacherimprimer, #situation, .footer {
    display: none;
  
  }
   
  }
</style>


<button style="margin:auto-right;" class="btn btn-primary no_print" onClick="imprimer('deb_by_cale')">imprimer</button>
</div>
<br>  

<?php $deb_produit2=$_POST['deb_produit']; ?>
<div class="col col-lg-12" id="deb_by_produit"  <?php if($deb_produit2==0){

 ?> style="display: none;" <?php } ?>  <?php if($deb_produit2==1){

 ?> style="display: block;" <?php } ?>>



<?php if(!empty($trP['dates'])){
            $DateDebut=explode('-',$tr['dates']);
           if(!empty($tr2P['dates'])){
            $DateActuel=explode('-',$tr2P['dates']);?>

           

  <table class='table table-hover table-bordered table-striped' id='table' border='2' >
    

<thead>
           <tr style="background: black; color: white; text-align: center; font-weight: bold; " >
           <td colspan="10" ><h4 style="color: white;"> SITUATION DU DEBARQUEMENT <span style="color:yellow;">PAR PRODUIT</span> DU <span style="color: red; background: white;"><?php echo  $DateActuel[2]. '-' .$DateActuel[1].'-'.$DateActuel[0];?></span></h4></td></tr>
<?php 
         }  }
   ?>
          
  
 <tr  class="EnteteTableSituation"  >
      
      
      <td scope="col"  rowspan="2" id="colLibeles" >PRODUIT</td>
       <td scope="col"  rowspan="2" id="colLibeles" >CALES</td>
      <td scope="col"  id="colManifeste" >MANIFESTE</td>
      <td scope="col"  id="colDeb24H" >DEB 24H</td>
      <td scope="col"  id="colDebTOTAL" > TOTAL DEB</td>
      <td scope="col"  id="colROB" >ROB</td>
  </tr>
    <tr class="EnteteTableSituation" >
      
      <
      <td scope="col" id="colManifeste">POIDS</td>
        
      <td scope="col" id="colDeb24H">POIDS</td>
      
      <td scope="col"  id="colDebTOTAL">POIDS</td>
       
      <td scope="col" id="colROB">POIDS</td>
        
     
     
 
         </tr>
         </thead> 

<?php 
        
       while($prod=$produit->fetch()){

        //---REQUETE SAINS ET AVARIES DEBARQUES EN 24 PAR CALE ET PRODUIT
   
       
          $sain_deb24H=$bdd->prepare("SELECT dc.*,count(dc.cales), sum(dc.nombre_sac), sum(dc.poids), p.*,sum(rm.sac),sum(rm.poids) FROM declaration_chargement as dc LEFT join produit_deb as p on dc.id_produit=p.id
         inner join transfert_debarquement as rm on rm.cale=dc.id_dec
           where rm.id_navire=? and rm.dates=?  and dc.id_produit=? and dc.cales=?   ");

                  $sain_deb24H->bindParam(1,$a[0]);
                  $sain_deb24H->bindParam(2,$a[1]);
                  $sain_deb24H->bindParam(3,$prod['id_produit']);
                  $sain_deb24H->bindParam(4,$prod['cales']);
                 
          $sain_deb24H->execute();

        //---REQUETE SAINS ET AVARIES DEBARQUES TOTAL PAR CALE ET PRODUIT
         

          $sain_debT=$bdd->prepare("SELECT dc.*,count(dc.cales), sum(dc.nombre_sac), sum(dc.poids), p.*,sum(rm.sac),sum(rm.poids) FROM declaration_chargement as dc LEFT join produit_deb as p on dc.id_produit=p.id
         inner join transfert_debarquement as rm on rm.cale=dc.id_dec
           where rm.id_navire=? and rm.dates<=?  and dc.id_produit=? and dc.cales=?  ");

                  $sain_debT->bindParam(1,$a[0]);
                  $sain_debT->bindParam(2,$a[1]);
                  $sain_debT->bindParam(3,$prod['id_produit']);
                  $sain_debT->bindParam(4,$prod['cales']);
                 
          $sain_debT->execute();



 

         $sain_debST24H=$bdd->prepare("SELECT dc.*,count(dc.cales), sum(dc.nombre_sac), sum(dc.poids), p.*,sum(rm.sac),sum(rm.poids) FROM declaration_chargement as dc LEFT join produit_deb as p on dc.id_produit=p.id
         inner join transfert_debarquement as rm on rm.cale=dc.id_dec  where dc.id_navire=? and rm.dates=?  and dc.id_produit=?    ");

                  $sain_debST24H->bindParam(1,$a[0]);
                  $sain_debST24H->bindParam(2,$a[1]); 
                  $sain_debST24H->bindParam(3,$prod['id_produit']);
             
  
          $sain_debST24H->execute(); 

 

         $sain_debSTT=$bdd->prepare("SELECT dc.*,count(dc.cales), sum(dc.nombre_sac), sum(dc.poids), p.*,sum(rm.sac),sum(rm.poids) FROM declaration_chargement as dc LEFT join produit_deb as p on dc.id_produit=p.id
         inner join transfert_debarquement as rm on rm.cale=dc.id_dec  where dc.id_navire=? and rm.dates<=?  and dc.id_produit=?  ");

                  $sain_debSTT->bindParam(1,$a[0]);
                  $sain_debSTT->bindParam(2,$a[1]);
                  $sain_debSTT->bindParam(3,$prod['id_produit']); 
                
      
          $sain_debSTT->execute(); 


    

         $sain_debG24H=$bdd->prepare("SELECT dc.*,count(dc.cales), sum(dc.nombre_sac), sum(dc.poids), p.*,sum(rm.sac),sum(rm.poids) FROM declaration_chargement as dc LEFT join produit_deb as p on dc.id_produit=p.id
         inner join transfert_debarquement as rm on rm.cale=dc.id_dec  where rm.id_navire=? and rm.dates=?   ");

                  $sain_debG24H->bindParam(1,$a[0]);
                  $sain_debG24H->bindParam(2,$a[1]);
                  
      
          $sain_debG24H->execute(); 


    

         $sain_debGT=$bdd->prepare("SELECT dc.*,count(dc.cales), sum(dc.nombre_sac), sum(dc.poids), p.*,sum(rm.sac),sum(rm.poids) FROM declaration_chargement as dc LEFT join produit_deb as p on dc.id_produit=p.id
         inner join transfert_debarquement as rm on rm.cale=dc.id_dec  where rm.id_navire=? and rm.dates<=?    ");

                  $sain_debGT->bindParam(1,$a[0]);
                  $sain_debGT->bindParam(2,$a[1]);
                  
          $sain_debGT->execute();           




          



     
       $s_deb=$sain_deb24H->fetch();
      
       $s_debT=$sain_debT->fetch();
       //$avaries2=$fm->fetch();
       
       $s_debST=$sain_debST24H->fetch();

       
       $s_debSTT=$sain_debSTT->fetch();

       
       $s_debG=$sain_debG24H->fetch();

       
       $s_debGT=$sain_debGT->fetch();


      //VARIABLES AVARIES
     

      

      //VARIABLES SAINS
      if(empty($s_deb['sum(rm.sac)'])){
        $sac_sains=0;
      }
      else{
        $sac_sains= $s_deb['sum(rm.sac)'];
      }
      if(empty($s_deb['sum(rm.poids)'])){
        $poids_sains=0;
      }
      else{
        $poids_sains= $s_deb['sum(rm.poids)'];
      }

      if(empty($s_debT['sum(rm.sac)'])){
        $sac_sainsT=0;
      }
      else{
        $sac_sainsT= $s_debT['sum(rm.sac)'];
      }
      if(empty($s_debT['sum(rm.poids)'])){
        $poids_sainsT=0;
      }
      else{
        $poids_sainsT= $s_debT['sum(rm.poids)'];
      }

      if(empty($s_debST['sum(rm.sac)'])){
        $sac_sainsST=0;
      }
      else{
        $sac_sainsST= $s_debST['sum(rm.sac)'];
      }
      if(empty($s_debST['sum(rm.poids)'])){
        $poids_sainsST=0;
      }
      else{
        $poids_sainsST= $s_debST['sum(rm.poids)'];
      }

       if(empty($s_debSTT['sum(rm.sac)'])){
        $sac_sainsSTT=0;
      }
      else{
        $sac_sainsSTT= $s_debSTT['sum(rm.sac)'];
      }
      if(empty($s_debSTT['sum(rm.poids)'])){
        $poids_sainsSTT=0;
      }
      else{
        $poids_sainsSTT= $s_debSTT['sum(rm.poids)'];
      }

      if(empty($s_debG['sum(rm.sac)'])){
        $sac_sainsG=0;
      }
      else{
        $sac_sainsG= $s_debG['sum(rm.sac)'];
      }
      if(empty($s_debG['sum(rm.poids)'])){
        $poids_sainsG=0;
      }
      else{
        $poids_sainsG= $s_debG['sum(rm.poids)'];
      }

      if(empty($s_debGT['sum(rm.sac)'])){
        $sac_sainsGT=0;
      }
      else{
        $sac_sainsGT= $s_debGT['sum(rm.sac)'];
      }
      if(empty($s_debGT['sum(rm.poids)'])){
        $poids_sainsGT=0;
      }
      else{
        $poids_sainsGT= $s_debGT['sum(rm.poids)'];
      }  

     

        ?>

        <tr class="EnteteTableSituation" style="text-align: center;">
          <?php if(!empty($prod['produit'])  and !empty($prod['cales']) and !empty($prod['id_dec'])) {?>
    
    <td scope="col" id="colLibeles" ><?php echo $prod['produit']; ?> </td>
    <td scope="col" id="colLibeles" ><?php echo $prod['cales']; ?></td>
   
    <td scope="col" id="colManifeste"  ><?php echo number_format($prod['poids'], 3,',',' '); ?></td>
       
      <td id="colDeb24H" scope="col"  ><?php echo number_format( $poids_sains  , 3,',',' '); ?></td>
      
      <td scope="col" id="colDebTOTAL"><?php echo number_format( $poids_sainsT , 3,',',' '); ?></td>
    
      <td scope="col" id="colROB" ><?php echo number_format($prod['poids']- $poids_sainsT, 3,',',' '); ?></td>
     <?php } ?>

     <?php if(!empty($prod['produit'])  and empty($prod['cales']) and empty($prod['id_dec'])) {?>
     <tr > 
      <td id="sousTOTAL" colspan="2">  TOTAL <?php  echo $prod['cales'];  ?></td>
      
       <td id="sousTOTAL" scope="col" ><?php echo number_format($prod['sum(dc.poids)'], 3,',',' '); ?></td>
       
          <td id="sousTOTAL" scope="col"  ><?php echo number_format($poids_sainsST , 3,',',' '); ?></td>
 
          <td id="sousTOTAL" scope="col"  ><?php echo number_format( $poids_sainsSTT, 3,',',' '); ?></td>

          <td id="sousTOTAL" scope="col"  ><?php echo number_format($prod['sum(dc.poids)']- $poids_sainsSTT, 3,',',' '); ?></td>          

     </tr> <?php //} ?>
     <?php } ?>


     <?php if(empty($prod['produit'])  and empty($prod['cales']) and empty($prod['id_dec'])) {?>
    <tr class="CelluleTotal2" >
       <td id="TOTAL" colspan="2">  TOTAL <?php  echo $prod['cales'];  ?></td>
      
       <td id="TOTAL" scope="col" ><?php echo number_format($prod['sum(dc.poids)'], 3,',',' '); ?></td>
   
          <td id="TOTAL" scope="col"  ><?php echo number_format( $poids_sainsG , 3,',',' '); ?></td>
      
          <td id="TOTAL" scope="col"  ><?php echo number_format($poids_sainsGT, 3,',',' '); ?></td>
  
          <td id="TOTAL" scope="col"  ><?php echo number_format($prod['sum(dc.poids)']-  $poids_sainsGT, 3,',',' '); ?></td> 
        </tr>
     <?php } ?>


     <?php }  ?>
    
 
      
     

 </table>
<style type="text/css">
  @media print {
  .no_print {
    display: none;
  }
   
  #btnafficher, #cacherimprimer, #situation, .footer {
    display: none;
  
  }
   
  }
</style>


 <button style="margin:auto-right;" class="btn btn-primary no_print" onClick="imprimer('deb_by_produit')">imprimer</button>
</div>

<?php $deb_destination2=$_POST['deb_destination']; ?>
<div class="col col-lg-12" id="deb_by_destination_new"  <?php if($deb_destination2==0){

 ?> style="display: none;" <?php } ?>  <?php if($deb_destination2==1){

 ?> style="display: block;" <?php } ?>>




<?php if(!empty($trP['dates'])){
            $DateDebut=explode('-',$tr['dates']);
           if(!empty($tr2P['dates'])){
            $DateActuel=explode('-',$tr2P['dates']);?>

            

  <table class='table table-hover table-bordered table-striped' id='table' border='2' >
    
 
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
      
      <td scope="col"  id="colManifeste" >MANIFESTE</td>
      <td scope="col" colspan="2" id="colDeb24H">DEB 24H</td>
     
      <td scope="col" colspan="2" id="colDebTOTAL">TOTAL DEB</td>
      <td scope="col"  id="colROB">ROB</td>
     
      </tr>
     
        

      <tr >
       
      <td scope="col" id="colManifeste" >POIDS</td>
        <td scope="col"  id="colDeb24H">NBRE SACS</td>
      <td scope="col" id="colDeb24H">POIDS</td>
        <td scope="col" id="colDebTOTAL"  >NBRE SACS</td>
      <td scope="col"  id="colDebTOTAL">POIDS</td>
       
      <td scope="col"  id="colROB">POIDS</td>
     
      
      
    
       </tr>
         </thead>
<tbody>

   <?php 
while ($fm0=$dispatching->fetch()) { 
 /* $avar=$TSTDVRAC->fetch();
  
   */

   //---REQUETE SAINS  DEBARQUES EN 24 PAR CALE ET PRODUIT

       
          $sain_deb24H=$bdd->prepare("SELECT rm.*, dis.* ,ex.id_trans_extends, sum(rm.sac),sum(rm.poids),nc.* from transfert_debarquement as rm
         inner join transit_extends as ex on ex.id_trans_extends=rm.id_declaration

          inner join dispat as dis on dis.id_dis=ex.id_bl_extends
          inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis  where rm.id_navire=? and rm.dates=? and dis.poids_kg=? and dis.id_produit=?  and dis.id_mangasin=?    ");

                  $sain_deb24H->bindParam(1,$a[0]);
                  $sain_deb24H->bindParam(2,$a[1]);
                  $sain_deb24H->bindParam(3,$fm0['poids_kg']);
                  $sain_deb24H->bindParam(4,$fm0['id_produit']);
                  $sain_deb24H->bindParam(5,$fm0['id_mangasin']);
                 
          $sain_deb24H->execute();

        //---REQUETE SAINS ET AVARIES DEBARQUES TOTAL PAR CALE ET PRODUIT


          $sain_debT=$bdd->prepare("SELECT rm.*, dis.*, ex.id_trans_extends , sum(rm.sac),sum(rm.poids), nc.* from transfert_debarquement as rm
            inner join transit_extends as ex on ex.id_trans_extends=rm.id_declaration

          inner join dispat as dis on dis.id_dis=ex.id_bl_extends
          inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis  where rm.id_navire=? and rm.dates<=? and dis.poids_kg=? and dis.id_produit=?  and dis.id_mangasin=?   ");

                  $sain_debT->bindParam(1,$a[0]);
                  $sain_debT->bindParam(2,$a[1]);
                  $sain_debT->bindParam(3,$fm0['poids_kg']);
                  $sain_debT->bindParam(4,$fm0['id_produit']);
                  $sain_debT->bindParam(5,$fm0['id_mangasin']);
                 
          $sain_debT->execute();



 //---REQUETE SOUS TOTAL  SAINS ET AVARIES TOTAL DEBARQUES EN 24 PAR CALE 


         $sain_debST24H=$bdd->prepare("SELECT rm.*, dis.*, ex.id_trans_extends , sum(rm.sac),sum(rm.poids) from transfert_debarquement as rm
            inner join transit_extends as ex on ex.id_trans_extends=rm.id_declaration

          inner join dispat as dis on dis.id_dis=ex.id_bl_extends
            where rm.id_navire=? and rm.dates=? and  dis.id_mangasin=?   ");

                  $sain_debST24H->bindParam(1,$a[0]);
                  $sain_debST24H->bindParam(2,$a[1]);

                  $sain_debST24H->bindParam(3,$fm0['id_mangasin']);
                 
  
          $sain_debST24H->execute(); 

 //---REQUETE SOUS TOTAL SAINS ET AVARIES TOTAL DEBARQUES EN  PAR CALE DEPUIS LE DEBUT DU DEBARQUEMENT


         $sain_debSTT=$bdd->prepare("SELECT rm.*, dis.*, ex.id_trans_extends , sum(rm.sac),sum(rm.poids) from transfert_debarquement as rm
            inner join transit_extends as ex on ex.id_trans_extends=rm.id_declaration

          inner join dispat as dis on dis.id_dis=ex.id_bl_extends 
        
           where rm.id_navire=? and rm.dates<=? and  dis.id_mangasin=?    ");

                  $sain_debSTT->bindParam(1,$a[0]);
                  $sain_debSTT->bindParam(2,$a[1]);

                  $sain_debSTT->bindParam(3,$fm0['id_mangasin']);
                 
                 
      
          $sain_debSTT->execute(); 


    //---REQUETE  TOTAL GENERAL SAINS ET AVARIES TOTAL DEBARQUES DES CALES DEPUIS LE DEBUT DU DEBARQUEMENT 24H


         $sain_debG24H=$bdd->prepare("SELECT rm.*, dis.*, ex.id_trans_extends , sum(rm.sac),sum(rm.poids), nc.* from transfert_debarquement as rm
            inner join transit_extends as ex on ex.id_trans_extends=rm.id_declaration

          inner join dispat as dis on dis.id_dis=ex.id_bl_extends
          inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis  where rm.id_navire=? and rm.dates=?   ");

                  $sain_debG24H->bindParam(1,$a[0]);
                  $sain_debG24H->bindParam(2,$a[1]);
                  
      
          $sain_debG24H->execute(); 


     //---REQUETE  TOTAL GENERAL SAINS ET AVARIES TOTAL DEBARQUES DES CALES DEPUIS LE DEBUT DU DEBARQUEMENT TOTAL


         $sain_debGT=$bdd->prepare("SELECT rm.*, dis.*, ex.id_trans_extends , sum(rm.sac),sum(rm.poids),nc.* from transfert_debarquement as rm
            inner join transit_extends as ex on ex.id_trans_extends=rm.id_declaration

          inner join dispat as dis on dis.id_dis=ex.id_bl_extends 
          inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis where rm.id_navire=? and rm.dates<=?  ");

                  $sain_debGT->bindParam(1,$a[0]);
                  $sain_debGT->bindParam(2,$a[1]);
                  
          $sain_debGT->execute();           



      
       $s_deb=$sain_deb24H->fetch();
     
       $s_debT=$sain_debT->fetch();
       //$avaries2=$fm->fetch();
      
       $s_debST=$sain_debST24H->fetch();

      
       $s_debSTT=$sain_debSTT->fetch();

       
       $s_debG=$sain_debG24H->fetch();

     
       $s_debGT=$sain_debGT->fetch();


     

      //VARIABLES SAINS
      if(empty($s_deb['sum(rm.sac)'])){
        $sac_sains=0;
      }
      else{
        $sac_sains= $s_deb['sum(rm.sac)'];
      }
      if(empty($s_deb['sum(rm.poids)'])){
        $poids_sains=0;
      }
      else{
        $poids_sains= $s_deb['sum(rm.poids)'];
      }

      if(empty($s_debT['sum(rm.sac)'])){
        $sac_sainsT=0;
      }
      else{
        $sac_sainsT= $s_debT['sum(rm.sac)'];
      }
      if(empty($s_debT['sum(rm.poids)'])){
        $poids_sainsT=0;
      }
      else{
        $poids_sainsT= $s_debT['sum(rm.poids)'];
      }

      if(empty($s_debST['sum(rm.sac)'])){
        $sac_sainsST=0;
      }
      else{
        $sac_sainsST= $s_debST['sum(rm.sac)'];
      }
      if(empty($s_debST['sum(rm.poids)'])){
        $poids_sainsST=0;
      }
      else{
        $poids_sainsST= $s_debST['sum(rm.poids)'];
      }

       if(empty($s_debSTT['sum(rm.sac)'])){
        $sac_sainsSTT=0;
      }
      else{
        $sac_sainsSTT= $s_debSTT['sum(rm.sac)'];
      }
      if(empty($s_debSTT['sum(rm.poids)'])){
        $poids_sainsSTT=0;
      }
      else{
        $poids_sainsSTT= $s_debSTT['sum(rm.poids)'];
      }

      if(empty($s_debG['sum(rm.sac)'])){
        $sac_sainsG=0;
      }
      else{
        $sac_sainsG= $s_debG['sum(rm.sac)'];
      }
      if(empty($s_debG['sum(rm.poids)'])){
        $poids_sainsG=0;
      }
      else{
        $poids_sainsG= $s_debG['sum(rm.poids)'];
      }

      if(empty($s_debGT['sum(rm.sac)'])){
        $sac_sainsGT=0;
      }
      else{
        $sac_sainsGT= $s_debGT['sum(rm.sac)'];
      }
      if(empty($s_debGT['sum(rm.poids)'])){
        $poids_sainsGT=0;
      }
      else{
        $poids_sainsGT= $s_debGT['sum(rm.poids)'];
      }       
      

  if (!empty($fm0['mangasin']) and !empty($fm0['produit']) and !empty($fm0['id_dis'])  ){ ?>
       <tr style="text-align: center;">
        <td scope="col" id="colLibeles"><?php echo $fm0['mangasin']  ?></td>
            <td scope="col" id="colLibeles" ><?php echo $fm0['produit']; ?> <?php echo $fm0['poids_kg']; ?> KGS</td>
              <td scope="col" id="colLibeles" ><?php echo $fm0['client']; ?> </td>

    
       <td scope="col" id="colManifeste" ><?php echo number_format($fm0['quantite_poids'], 3,',',' '); ?></td>
    <td id="colDeb24H" scope="col" ><?php echo number_format( $sac_sains , 0,',',' '); ?></td>
      <td id="colDeb24H" scope="col"  ><?php echo number_format( $poids_sains  , 3,',',' '); ?></td>
      <td scope="col" id="colDebTOTAL"><?php echo number_format( $sac_sainsT , 0,',',' '); ?></td>
      <td scope="col" id="colDebTOTAL"><?php echo number_format( $poids_sainsT  , 3,',',' '); ?></td>
   
      <td scope="col" id="colROB" ><?php echo number_format($fm0['quantite_poids']- $poids_sainsT , 3,',',' '); ?></td>
     </tr>

  
 <?php } 

 if (!empty($fm0['mangasin']) and empty($fm0['produit'])  and empty($fm0['id_dis']) ){ ?>
     <tr > 
      <td id="sousTOTAL" colspan="3">  TOTAL <?php  echo $fm0['mangasin'];  ?> <?php  echo $fm0['id_produit']; ?> <?php  echo $fm0['id_mangasin']; ?> <?php  echo $fm0['poids_kg']; ?></td>
      
       <td id="sousTOTAL" scope="col" ><?php echo number_format($fm0['sum(dis.quantite_poids)'], 3,',',' '); ?></td>
        <td id="sousTOTAL" scope="col"  ><?php echo number_format($sac_sainsST, 0,',',' '); ?></td>
          <td id="sousTOTAL" scope="col"  ><?php echo number_format($poids_sainsST , 3,',',' '); ?></td>
          <td id="sousTOTAL" scope="col"  ><?php echo number_format($sac_sainsSTT  , 0,',',' '); ?></td>
          <td id="sousTOTAL" scope="col"  ><?php echo number_format($poids_sainsSTT , 3,',',' '); ?></td>
       
          <td id="sousTOTAL" scope="col"  ><?php echo number_format($fm0['sum(dis.quantite_poids)']- $poids_sainsSTT , 3,',',' '); ?></td>          

     </tr>
 <?php 
  }
 if (empty($fm0['mangasin']) and empty($fm0['produit']) and empty($fm0['id_dis'])  ){ ?>
       <tr class="CelluleTotal2" >
       <td id="TOTAL" colspan="3">  TOTAL </td>
  
       <td id="TOTAL" scope="col" ><?php echo number_format($fm0['sum(dis.quantite_poids)'], 3,',',' '); ?></td>
        <td id="TOTAL" scope="col"  ><?php echo number_format( $sac_sainsG , 0,',',' '); ?></td>
          <td id="TOTAL" scope="col"  ><?php echo number_format( $poids_sainsG , 3,',',' '); ?></td>
          <td id="TOTAL" scope="col"  ><?php echo number_format($sac_sainsGT , 0,',',' '); ?></td>
          <td id="TOTAL" scope="col"  ><?php echo number_format( $poids_sainsGT , 3,',',' '); ?></td>
   
          <td id="TOTAL" scope="col"  ><?php echo number_format($fm0['sum(dis.quantite_poids)']-  $poids_sainsGT , 3,',',' '); ?></td> 
        </tr>
  <?php  
        } ?> 
 <?php } ?>
</tbody>
</table>

<style type="text/css">
  @media print {
  .no_print {
    display: none;
  }
   
  #btnafficher, #cacherimprimer, #situation, .footer {
    display: none;
  
  }
   
  }
</style>

 <button style="margin:auto-right;" class="btn btn-primary no_print" onClick="imprimer('deb_by_destination')">imprimer</button>
</div>






<?php $client2=$_POST['deb_client']; ?>
<div class="col col-lg-12" id="deb_by_client" <?php if($client2==0){

 ?> style="display: none;" <?php } ?>  <?php if($client2==1){

 ?> style="display: block;" <?php } ?> >



<?php if(!empty($trP['dates'])){
            $DateDebut=explode('-',$tr['dates']);
           if(!empty($tr2P['dates'])){
            $DateActuel=explode('-',$tr2P['dates']);?>

  <table class='table table-hover table-bordered table-striped' id='table' border='2' >
    

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
      
      <td scope="col"   id="colManifeste">MANIFESTE</td>
      <td scope="col" colspan="2" id="colDeb24H" >DEB 24H</td>
     
      <td scope="col" colspan="2" id="colDebTOTAL" >TOTAL DEB</td>
      <td scope="col"  id="colROB" >ROB</td>
     
      </tr>
     
        

      <tr >
        
      <td scope="col"  id="colManifeste" >POIDS</td>
        <td scope="col" id="colDeb24H" >NBRE SACS</td>
      <td scope="col" id="colDeb24H" >POIDS</td>
        <td scope="col" id="colDebTOTAL" >NBRE SACS</td>
      <td scope="col"  id="colDebTOTAL" >POIDS</td>
     
      <td scope="col" id="colROB">POIDS</td>
    <?php //echo $_POST['client']; ?>
      
      
    
       </tr>
         </thead>
<tbody>

  <?php 
while ($fm0=$STCLIVRAC2->fetch()) { 
  /*$avar=$TSTCLIVRAC->fetch();
  
   

  $cumul_sac=$avar['sum(rm.sac)'];
  $cumul_poids=$avar['sum(rm.poids)'];
  $rob_sac=$fm0['nombre_sac']-$cumul_sac;;
  $rob_poids=$fm0['poids_t']-$cumul_poids; */

           $sain_deb24H=$bdd->prepare("SELECT rm.*, dis.*, ex.id_trans_extends , sum(rm.sac),sum(rm.poids),nc.* from transfert_debarquement as rm
            inner join transit_extends as ex on ex.id_trans_extends=rm.id_declaration  
          inner join dispat as dis on dis.id_dis=ex.id_bl_extends
          inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis   where rm.id_navire=? and rm.dates=? and dis.poids_kg=? and dis.id_produit=?  and dis.id_mangasin=?   ");

                  $sain_deb24H->bindParam(1,$a[0]);
                  $sain_deb24H->bindParam(2,$a[1]);
                  $sain_deb24H->bindParam(3,$fm0['poids_kg']);
                  $sain_deb24H->bindParam(4,$fm0['id_produit']);
                  $sain_deb24H->bindParam(5,$fm0['id_mangasin']);
                 
                 
          $sain_deb24H->execute();

        //---REQUETE SAINS ET AVARIES DEBARQUES TOTAL PAR CALE ET PRODUIT


          $sain_debT=$bdd->prepare("SELECT rm.*, dis.*, ex.id_trans_extends , sum(rm.sac),sum(rm.poids),nc.* from transfert_debarquement as rm
            inner join transit_extends as ex on ex.id_trans_extends=rm.id_declaration

          inner join dispat as dis on dis.id_dis=ex.id_bl_extends
          inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis   where rm.id_navire=? and dates<=? and dis.poids_kg=? and dis.id_produit=?  and dis.id_mangasin=?   ");

                  $sain_debT->bindParam(1,$a[0]);
                  $sain_debT->bindParam(2,$a[1]);
                  $sain_debT->bindParam(3,$fm0['poids_kg']);
                  $sain_debT->bindParam(4,$fm0['id_produit']);
                  $sain_debT->bindParam(5,$fm0['id_mangasin']);
                 
          $sain_debT->execute();



 //---REQUETE SOUS TOTAL  SAINS ET AVARIES TOTAL DEBARQUES EN 24 PAR CALE 


         $sain_debST24H=$bdd->prepare("SELECT rm.*, dis.*, ex.id_trans_extends , sum(rm.sac),sum(rm.poids),nc.* from transfert_debarquement as rm
            inner join transit_extends as ex on ex.id_trans_extends=rm.id_declaration

          inner join dispat as dis on dis.id_dis=ex.id_bl_extends
          inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis   where rm.id_navire=? and rm.dates=?   and dis.id_client=?   ");

                  $sain_debST24H->bindParam(1,$a[0]);
                  $sain_debST24H->bindParam(2,$a[1]);

                  $sain_debST24H->bindParam(3,$fm0['id_client']);
                 
  
          $sain_debST24H->execute(); 

 //---REQUETE SOUS TOTAL SAINS ET AVARIES TOTAL DEBARQUES EN  PAR CALE DEPUIS LE DEBUT DU DEBARQUEMENT


         $sain_debSTT=$bdd->prepare("SELECT rm.*, dis.*, ex.id_trans_extends , sum(rm.sac),sum(rm.poids),nc.* from transfert_debarquement as rm
            inner join transit_extends as ex on ex.id_trans_extends=rm.id_declaration

          inner join dispat as dis on dis.id_dis=ex.id_bl_extends
          inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis   where rm.id_navire=? and rm.dates<=?   and dis.id_client=?    ");

                  $sain_debSTT->bindParam(1,$a[0]);
                  $sain_debSTT->bindParam(2,$a[1]);

                  $sain_debSTT->bindParam(3,$fm0['id_client']);
                 
                 
      
          $sain_debSTT->execute(); 


    //---REQUETE  TOTAL GENERAL SAINS ET AVARIES TOTAL DEBARQUES DES CALES DEPUIS LE DEBUT DU DEBARQUEMENT 24H


         $sain_debG24H=$bdd->prepare("SELECT rm.*, dis.*, ex.id_trans_extends , sum(rm.sac),sum(rm.poids),nc.* from transfert_debarquement as rm
            inner join transit_extends as ex on ex.id_trans_extends=rm.id_declaration

          inner join dispat as dis on dis.id_dis=ex.id_bl_extends 
          inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis  where rm.id_navire=? and dates=?     ");

                  $sain_debG24H->bindParam(1,$a[0]);
                  $sain_debG24H->bindParam(2,$a[1]);
                  
      
          $sain_debG24H->execute(); 


     //---REQUETE  TOTAL GENERAL SAINS ET AVARIES TOTAL DEBARQUES DES CALES DEPUIS LE DEBUT DU DEBARQUEMENT TOTAL


         $sain_debGT=$bdd->prepare("SELECT rm.*, dis.*, ex.id_trans_extends , sum(rm.sac),sum(rm.poids),nc.* from transfert_debarquement as rm
            inner join transit_extends as ex on ex.id_trans_extends=rm.id_declaration

          inner join dispat as dis on dis.id_dis=ex.id_bl_extends
          inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis   where rm.id_navire=? and dates<=?    ");

                  $sain_debGT->bindParam(1,$a[0]);
                  $sain_debGT->bindParam(2,$a[1]);
                  
          $sain_debGT->execute();           




          



      
       $s_deb=$sain_deb24H->fetch();
     
       $s_debT=$sain_debT->fetch();
       //$avaries2=$fm->fetch();
      
       $s_debST=$sain_debST24H->fetch();

      
       $s_debSTT=$sain_debSTT->fetch();

       
       $s_debG=$sain_debG24H->fetch();

     
       $s_debGT=$sain_debGT->fetch();


     

      //VARIABLES SAINS
      if(empty($s_deb['sum(rm.sac)'])){
        $sac_sains=0;
      }
      else{
        $sac_sains= $s_deb['sum(rm.sac)'];
      }
      if(empty($s_deb['sum(rm.poids)'])){
        $poids_sains=0;
      }
      else{
        $poids_sains= $s_deb['sum(rm.poids)'];
      }

      if(empty($s_debT['sum(rm.sac)'])){
        $sac_sainsT=0;
      }
      else{
        $sac_sainsT= $s_debT['sum(rm.sac)'];
      }
      if(empty($s_debT['sum(rm.poids)'])){
        $poids_sainsT=0;
      }
      else{
        $poids_sainsT= $s_debT['sum(rm.poids)'];
      }

      if(empty($s_debST['sum(rm.sac)'])){
        $sac_sainsST=0;
      }
      else{
        $sac_sainsST= $s_debST['sum(rm.sac)'];
      }
      if(empty($s_debST['sum(rm.poids)'])){
        $poids_sainsST=0;
      }
      else{
        $poids_sainsST= $s_debST['sum(rm.poids)'];
      }

       if(empty($s_debSTT['sum(rm.sac)'])){
        $sac_sainsSTT=0;
      }
      else{
        $sac_sainsSTT= $s_debSTT['sum(rm.sac)'];
      }
      if(empty($s_debSTT['sum(rm.poids)'])){
        $poids_sainsSTT=0;
      }
      else{
        $poids_sainsSTT= $s_debSTT['sum(rm.poids)'];
      }

      if(empty($s_debG['sum(rm.sac)'])){
        $sac_sainsG=0;
      }
      else{
        $sac_sainsG= $s_debG['sum(rm.sac)'];
      }
      if(empty($s_debG['sum(rm.poids)'])){
        $poids_sainsG=0;
      }
      else{
        $poids_sainsG= $s_debG['sum(rm.poids)'];
      }

      if(empty($s_debGT['sum(rm.sac)'])){
        $sac_sainsGT=0;
      }
      else{
        $sac_sainsGT= $s_debGT['sum(rm.sac)'];
      }
      if(empty($s_debGT['sum(rm.poids)'])){
        $poids_sainsGT=0;
      }
      else{
        $poids_sainsGT= $s_debGT['sum(rm.poids)'];
      }       
  

  if (!empty($fm0['client']) and !empty($fm0['id_produit']) and !empty($fm0['id_dis']) and !empty($fm0['id_mangasin']) ){ ?>
       <tr >
        <td scope="col" id="colLibeles" ><?php echo $fm0['client']  ?> </td>
            <td scope="col" id="colLibeles"  ><?php echo $fm0['produit']; ?> <?php echo $fm0['poids_kg']; ?> KGS</td>
              <td scope="col" id="colLibeles" ><?php echo $fm0['mangasin']; ?> </td>
 
       <td scope="col" id="colManifeste" ><?php echo number_format($fm0['sum(dis.quantite_poids)'], 3,',',' '); ?></td>
    <td id="colDeb24H" scope="col" ><?php echo number_format( $sac_sains , 0,',',' '); ?></td>
      <td id="colDeb24H" scope="col"  ><?php echo number_format( $poids_sains  , 3,',',' '); ?></td>
      <td scope="col" id="colDebTOTAL"><?php echo number_format( $sac_sainsT , 0,',',' '); ?></td>
      <td scope="col" id="colDebTOTAL"><?php echo number_format( $poids_sainsT  , 3,',',' '); ?></td>

      <td scope="col" id="colROB" ><?php echo number_format($fm0['sum(dis.quantite_poids)']- $poids_sainsT , 3,',',' '); ?></td>
     </tr>

  
 <?php } 

 if (!empty($fm0['client']) and empty($fm0['id_produit']) and empty($fm0['id_dis']) and empty($fm0['id_mangasin']) ){ ?>
       <tr > 
      <td id="sousTOTAL" colspan="3">  TOTAL <?php  echo $fm0['client'];  ?> <?php  echo $fm0['id_produit']; ?> <?php  echo $fm0['id_mangasin']; ?> <?php  echo $fm0['poids_kg']; ?></td>
 
       <td id="sousTOTAL" scope="col" ><?php echo number_format($fm0['sum(dis.quantite_poids)'], 3,',',' '); ?></td>
        <td id="sousTOTAL" scope="col"  ><?php echo number_format($sac_sainsST, 0,',',' '); ?></td>
          <td id="sousTOTAL" scope="col"  ><?php echo number_format($poids_sainsST , 3,',',' '); ?></td>
          <td id="sousTOTAL" scope="col"  ><?php echo number_format($sac_sainsSTT  , 0,',',' '); ?></td>
          <td id="sousTOTAL" scope="col"  ><?php echo number_format($poids_sainsSTT , 3,',',' '); ?></td>
 
          <td id="sousTOTAL" scope="col"  ><?php echo number_format($fm0['sum(dis.quantite_poids)']- $poids_sainsSTT , 3,',',' '); ?></td>          

     </tr>
  
 <?php //} } } 
}
 if (empty($fm0['client']) and empty($fm0['id_produit']) and empty($fm0['id_dis']) and empty($fm0['id_mangasin']) ){ ?>
       <tr class="CelluleTotal2" >
       <td id="TOTAL" colspan="3">  TOTAL </td>
 
       <td id="TOTAL" scope="col" ><?php echo number_format($fm0['sum(dis.quantite_poids)'], 3,',',' '); ?></td>
        <td id="TOTAL" scope="col"  ><?php echo number_format( $sac_sainsG , 0,',',' '); ?></td>
          <td id="TOTAL" scope="col"  ><?php echo number_format( $poids_sainsG , 3,',',' '); ?></td>
          <td id="TOTAL" scope="col"  ><?php echo number_format($sac_sainsGT , 0,',',' '); ?></td>
          <td id="TOTAL" scope="col"  ><?php echo number_format( $poids_sainsGT , 3,',',' '); ?></td>
 
          <td id="TOTAL" scope="col"  ><?php echo number_format($fm0['sum(dis.quantite_poids)']-  $poids_sainsGT , 3,',',' '); ?></td> 
        </tr>
  <?php //} } }
   } ?> 
 <?php } ?>

</tbody>
</table>

<style type="text/css">
  @media print {
  .no_print {
    display: none;
  }
   
  #btnafficher, #cacherimprimer, #situation, .footer {
    display: none;
  
  }
   
  }
</style>

 <button style="margin:auto-right;" class="btn btn-primary no_print" onClick="imprimer('deb_by_client')">imprimer</button>
</div>





</div>


<?php 



} ?>



<?php } ?>






	

