<?php

require('../database.php');

   echo " <select id='produit_tr' name='' onchange='goProduit_tr()'>
    <option  selected>Selectionner le produit</option>";

    if(isset($_POST["idClient"])){

     $b=$_POST["idClient"];
     $c=explode('-', $b);
    

//$bdd=new PDO('mysql:host=localhost;dbname=publicite;charset=utf8;', 'root', '');

  /*   $res2 = $bdd->prepare("SELECT dis.* , p.* , nav.navire, mg.mangasin,nc.id_navire from dispat as dis 
                 
                 inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
                 inner join produit_deb as p on dis.id_produit=p.id
                 inner join navire_deb as nav on nav.id=nc.id_navire
                 inner join mangasin as mg on mg.id=dis.id_mangasin
               
                
                 where dis.id_client=? and nc.id_navire=? and mg.id_mangasinier=?  GROUP BY dis.id_produit,dis.poids_kg  ");
      $res2->bindParam(1,$c[0]);
       $res2->bindParam(2,$c[1]);
        $res2->bindParam(3,$_SESSION['id']); 
       
     
      $res2->execute(); */


$res2 = $bdd->prepare("SELECT dis.* , p.* , nav.navire, mg.mangasin,nc.id_navire,tr.id_nouvelle_destination,dt.id_mangasinier_transfert from dispat_transfert as dt 
                 inner join dispat as dis on dt.id_dis_transfertD=dis.id_dis
                 inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
                 inner join produit_deb as p on dis.id_produit=p.id
                 inner join navire_deb as nav on nav.id=nc.id_navire
                 inner join mangasin as mg on mg.id=dt.id_nouvelle_destinationD
                 
                 left join transfert as tr on tr.id_dis_transfert=dt.id_transfertD
                
                 where dis.id_client=? and nc.id_navire=? and mg.id_mangasinier=?  GROUP BY dis.id_produit,dis.poids_kg  ");
      $res2->bindParam(1,$c[0]);
       $res2->bindParam(2,$c[1]);
        $res2->bindParam(3,$_SESSION['id']);
      
     
      $res2->execute(); 


     
   /* ANCIENNE REQUETE AU CAS OU
                $res2 = $bdd->prepare("SELECT dis.* , p.* , nav.navire, mg.mangasin,nc.id_navire from dispat as dis 
                 
                 inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
                 inner join produit_deb as p on dis.id_produit=p.id
                 inner join navire_deb as nav on nav.id=nc.id_navire
                 inner join mangasin as mg on mg.id=dis.id_mangasin
                 
                
                 where dis.id_client=? and nc.id_navire=? and mg.id_mangasinier=? GROUP BY dis.id_produit,dis.poids_kg  ");
      $res2->bindParam(1,$c[0]);
       $res2->bindParam(2,$c[1]);
        $res2->bindParam(3,$_SESSION['id']);
     
      $res2->execute(); */
       
        
        
        while($row2 = $res2->fetch()){
          
            ?>
             
           <!--   <option  value=<?php //echo $row2['id_dis'].'-'.$row2['id_produit'].'-'.$row2['poids_kg'].'-'.$row2['id_navire'].'-'.$row2['id_client']; ?> > <?php //echo $row2['produit'].' '.$row2['qualite'].' '.$row2['poids_kg'].' KGS'?><span id="mangasinOption"> <?php//echo 'DESTINATION '.$row2['mangasin']; ?></span> </option> !-->
           <option  value=<?php echo $row2['id_produit'].'-'.$row2['poids_kg'].'-'.$row2['id_navire'].'-'.$row2['id_mangasin'].'-'.$row2['id_client']; ?> > <?php echo $row2['produit'].' '.$row2['qualite'].' '.$row2['poids_kg'].' KGS'?><span id="mangasinOption"> <?php echo 'DESTINATION '.$row2['mangasin']; ?></span> </option>
               <?php } ?>

             

            </select>
<?php  }  
    ?>
 