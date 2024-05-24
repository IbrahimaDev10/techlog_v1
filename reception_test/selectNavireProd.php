<?php

require('../database.php');

?>

 <select id='mesprod' name='date' onchange='goProduit()'>
    <option  selected disabled='true'>Selectionner le produit</option >
    <?php  

    if(isset($_POST["idNavires"])){

     $b=$_POST["idNavires"];
     $c=explode('-', $b);

//$bdd=new PDO('mysql:host=localhost;dbname=publicite;charset=utf8;', 'root', '');


if($_SESSION['profil']=="Mangasinier"){

     
   
         /*       $res2 = $bdd->prepare("select dis.*, mg.*,nav.*, p.* from dispatching as dis 
                 inner join mangasin as mg on dis.id_mangasin=mg.id
                 
                 inner join navire_deb as nav on dis.id_navire=nav.id
                 inner join produit_deb as p on p.id=dis.id_produit
                 inner join simar_user as user on user.id_sim_user=mg.id_mangasinier
                 where mg.id_mangasinier=? and dis.id_navire=? group by dis.id_produit, dis.poids_kg");
      $res2->bindParam(1,$c[1]);
       $res2->bindParam(2,$c[0]);
      $res2->execute();           */

            $cherche_type=$bdd->prepare('SELECT type from navire_deb where id=?');
       $cherche_type->bindParam(1,$c[0]);
       $cherche_type->execute();

       $type=$cherche_type->fetch();

       if($type['type']=='SACHERIE'){

       $res2 = $bdd->prepare("SELECT dis.*, mg.*,d.num_declaration, mg.id as mg_id, nav.*, p.*,nc.*,rn.*, rn.id_destination as destination_rep from  reception_navire as rn
          inner join declaration as d on d.id_declaration=rn.id_declaration
          inner join dispats as dis on d.id_bl=dis.id_dis
                
                inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
                 inner join mangasin as mg on rn.id_destination=mg.id
                 
                 inner join navire_deb as nav on nc.id_navire=nav.id
                 inner join produit_deb as p on p.id=nc.id_produit
                 inner join simar_user as user on user.id_sim_user=mg.id_mangasinier
                  where mg.id_mangasinier=? and nc.id_navire=? 
                 GROUP BY nc.id_produit,nc.poids_kg,destination_rep");
      $res2->bindParam(1,$c[1]);
       $res2->bindParam(2,$c[0]);
      $res2->execute();  



       $aucun_produit = $bdd->prepare("SELECT dis.*, mg.*,d.num_declaration, mg.id as mg_id, nav.*, p.*,nc.*,rn.*, rn.id_destination as destination_rep from  reception_navire as rn
          inner join declaration as d on d.id_declaration=rn.id_declaration
          inner join dispats as dis on d.id_bl=dis.id_dis
                
                inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
                 inner join mangasin as mg on rn.id_destination=mg.id
                 
                 inner join navire_deb as nav on nc.id_navire=nav.id
                 inner join produit_deb as p on p.id=nc.id_produit
                 inner join simar_user as user on user.id_sim_user=mg.id_mangasinier
                  where mg.id_mangasinier=? and nc.id_navire=? 
                 GROUP BY nc.id_produit,nc.poids_kg,destination_rep");
      $aucun_produit->bindParam(1,$c[1]);
       $aucun_produit->bindParam(2,$c[0]);
      $aucun_produit->execute();
      $aucun_prod=$aucun_produit->fetch();
       
         }

        if($type['type']=='VRAQUIER'){

       $res2 = $bdd->prepare("SELECT dis.*, mg.*,d.num_declaration, mg.id as mg_id, nav.*, p.*,nc.*,rn.*, rn.id_destination as destination_rep from  reception_navire as rn
          inner join declaration as d on d.id_declaration=rn.id_declaration
          inner join dispats as dis on d.id_bl=dis.id_dis
                
                inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
                 inner join mangasin as mg on rn.id_destination=mg.id
                 
                 inner join navire_deb as nav on nc.id_navire=nav.id
                 inner join produit_deb as p on p.id=dis.id_produits
                 inner join simar_user as user on user.id_sim_user=mg.id_mangasinier
                  where mg.id_mangasinier=? and nc.id_navire=? 
                 GROUP BY dis.id_produits,dis.poids_kgs,destination_rep");
      $res2->bindParam(1,$c[1]);
       $res2->bindParam(2,$c[0]);
      $res2->execute();  

   

       $aucun_produit = $bdd->prepare("SELECT dis.*, mg.*,d.num_declaration, mg.id as mg_id, nav.*, p.*,nc.*,rn.*, rn.id_destination as destination_rep from  reception_navire as rn
          inner join declaration as d on d.id_declaration=rn.id_declaration
          inner join dispats as dis on d.id_bl=dis.id_dis
                
                inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
                 inner join mangasin as mg on rn.id_destination=mg.id
                 
                 inner join navire_deb as nav on nc.id_navire=nav.id
                 inner join produit_deb as p on p.id=dis.id_produits
                 inner join simar_user as user on user.id_sim_user=mg.id_mangasinier
                  where mg.id_mangasinier=? and nc.id_navire=? 
                 GROUP BY dis.id_produits,dis.poids_kgs,destination_rep");
      $aucun_produit->bindParam(1,$c[1]);
       $aucun_produit->bindParam(2,$c[0]);
      $aucun_produit->execute();
      $aucun_prod=$aucun_produit->fetch();
       
         }        
        
        while($row2 = $res2->fetch()){

            if($type['type']=='VRAQUIER'){
          
            ?>
             
              <option   value=<?php echo $row2['id_produits'].'-'.$row2['poids_kgs'].'-'.$row2['id_navire'].'-'.$row2['destination_rep']; ?> > <?php echo $row2['produit'].' '.$row2['poids_kgs'].' KGS';  ?><?php echo ' / '.$row2['mangasin']; ?> </option>
           

               <?php }


               if($type['type']=='SACHERIE'){ ?>

                 <option   value=<?php echo $row2['id_produit'].'-'.$row2['poids_kg'].'-'.$row2['id_navire'].'-'.$row2['destination_rep']; ?> > <?php echo $row2['produit'].' '.$row2['poids_kg'].' KGS';  ?><?php echo ' / '.$row2['mangasin']; ?> </option>
               <?php } ?>




             <?php if(!$aucun_prod){ ?>
                <option disabled="true">AUCUN PRODUIT RECEPTIONNER</option>
                  <?php } } ?>

            </select>
          <?php } ?>

 <?php  

if($_SESSION['profil']=="superviseur"){

     
   
                $res2 = $bdd->prepare("select dis.*, mg.*,nav.*, p.* from dispatching as dis 
                 inner join mangasin as mg on dis.id_mangasin=mg.id
                 
                 inner join navire_deb as nav on dis.id_navire=nav.id
                 inner join produit_deb as p on p.id=dis.id_produit
                 
                 where  dis.id_navire=? group by dis.id_dis");
      
       $res2->bindParam(1,$c[0]);
      $res2->execute();
       
        
        
        while($row2 = $res2->fetch()){
          
            ?>
             
              <option   value=<?php echo $row2['id_dis']; ?> > <?php echo $row2['produit'].' '.$row2['qualite'].' '.$row2['poids_kg'].' KGS';  ?> </option>
               <?php } ?>

             

            </select>
          <?php } ?>
<?php

  }  
    ?>
             




