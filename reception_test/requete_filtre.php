<?php      function filtrer_date($bdd,$produit,$poids_sac,$navire,$destination){
     $filtrer_date = $bdd->prepare(' SELECT rts.dates from reception_navire as rts  
            inner join declaration as d on d.id_declaration=rts.id_declaration
              
            inner join dispats as dis on dis.id_dis=d.id_bl
            inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
           inner join produit_deb as p on p.id=rts.id_produit
           inner join mangasin as mang on mang.id=rts.id_destination
           
           inner join navire_deb as nav on nav.id=rts.id_navire
              

                    WHERE nc.id_produit=? and nc.poids_kg=? and nc.id_navire=? and rts.id_destination=?   group by rts.dates,  ');
        
        
        $filtrer_date->bindParam(1,$produit);
        $filtrer_date->bindParam(2,$poids_sac);
        $filtrer_date->bindParam(3,$navire);
         $filtrer_date->bindParam(4,$destination);
          
        $filtrer_date->execute();
        return $filtrer_date;
    }

    ?> 