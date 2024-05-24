<?php 
     $res4= $bdd->prepare("SELECT  p.produit,p.qualite,nav.navire,cli.client,mang.mangasin, dis.*   FROM dispatching as dis 
                
                inner join  produit_deb as p on dis.id_produit=p.id 

                inner join navire_deb as nav on dis.id_navire=nav.id 
                
                inner join client as cli on dis.id_client=cli.id
                inner join mangasin as mang on dis.id_mangasin=mang.id
                

                   WHERE dis.id_dis=?  ");
        $res4->bindParam(1,$c);
        $res4->execute();

       $resdes= $bdd->prepare("SELECT trans.*, dis.*   FROM dispatching as dis 
                inner join transit as trans on dis.id_dis=trans.id_bl

                   WHERE dis.id_dis=? 
                   ");
        $resdes->bindParam(1,$c);
        $resdes->execute();

          $rescale= $bdd->prepare("SELECT  *   FROM dispatching 
               

                   WHERE id_dis=? 
                   ");
        $rescale->bindParam(1,$c);
        $rescale->execute();



     
   
                $res3 = $bdd->prepare("SELECT  p.produit,p.qualite,nav.navire,cli.client,mang.mangasin, dis.*   FROM dispatching as dis 
                
                inner join  produit_deb as p on dis.id_produit=p.id 

                inner join navire_deb as nav on dis.id_navire=nav.id 
                
                inner join client as cli on dis.id_client=cli.id
                inner join mangasin as mang on dis.id_mangasin=mang.id

                   WHERE dis.id_dis=?  ");
        
        $res3->bindParam(1,$c);
        
       
      
        
        $res3->execute();
   
$transport=$bdd->query("select * from transporteur order by id desc");

          $resbl= $bdd->prepare("SELECT  dis.*, bl.*   FROM bl
          inner join dispatching as dis on bl.id_n_bl=dis.id_dis 
               

                   WHERE bl.id_n_bl=? 
                   ");
        $resbl->bindParam(1,$c);
        $resbl->execute();

         $rob=$bdd->prepare("select dis.*,  rm.*, sum(rm.sac),sum(rm.poids) FROM dispatching as dis
         
          inner  join register_manifeste as rm on  dis.id_produit=rm.id_produit and dis.id_dis=rm.id_dis_bl
          and dis.id_mangasin=rm.id_destination
          and dis.poids_kg=rm.poids_sac and dis.id_navire=rm.id_navire
        
          
         where  dis.id_dis=?  ");
         $rob->bindParam(1,$c);
         $rob->execute();

         $rob_dec=$bdd->prepare("select trans.poids_declarer, trans.numero_declaration, sum(rm.sac), sum(rm.poids) from transit as trans inner join register_manifeste as rm on trans.id_trans=rm.id_declaration WHERE trans.id_bl=? group by trans.numero_declaration");
                   $rob_dec->bindParam(1,$c);
         $rob_dec->execute();

                $affiche = $bdd->prepare("SELECT  p.produit,p.qualite,nav.navire,cli.client,mang.mangasin,trp.*,trs.*,ch.*, manif.*, sum(manif.sac),sum(manif.poids)   FROM register_manifeste as manif 
                
                inner join  produit_deb as p on manif.id_produit=p.id 

                inner join navire_deb as nav on manif.id_navire=nav.id 
                
                inner join client as cli on manif.id_client=cli.id
                inner join mangasin as mang on manif.id_destination=mang.id
                inner join transporteur as trp on manif.id_transporteur=trp.id
                inner join chauffeur as ch on manif.camions=ch.id_chauffeur 
                inner join transit as trs on manif.id_declaration=trs.id_trans

                   WHERE manif.id_dis_bl=? group by manif.dates, manif.id_register_manif with rollup ");
        
        
        $affiche->bindParam(1,$c);
        $affiche->execute();

  $afficheT = $bdd->prepare("SELECT   poids_t, nombre_sac from dispatching where id_dis=?");             
             $afficheT->bindParam(1,$c);
        $afficheT->execute();


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

         $camions= $bdd->query("SELECT  *   FROM chauffeur 
                  group by camions ");

   

 ?>