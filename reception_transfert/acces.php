<?php    


    
    $a=$_SESSION['id'];
    echo $a;
    echo $a;
  function camions_en_attentes_sains($bdd,$_SESSION['id']){
   $select=$bdd->prepare("select pre.*,rm.*,cam.*,ch.*,p.produit,p.qualite, nav.navire, mang.id_mangasinier from register_manifeste as rm
            inner join pre_register_reception as pre on pre.id_pre_register_manif=rm.id_register_manif
            inner join camions as cam on cam.id_camions=rm.camions
            inner join chauffeur as ch on ch.id_chauffeur=rm.chauffeur
            inner join mangasin as mang on mang.id=rm.id_destination
            inner join produit_deb as p on p.id=rm.id_produit
            inner join navire_deb as nav on nav.id=rm.id_navire

            where mang.id_mangasinier=?");
             $select->bindParam(1,$_SESSION['id']);
               $select->execute(); 
             }



    
   
    

  ?>
