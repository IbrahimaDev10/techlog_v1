 <?php
require('../database.php');
?>

    <select id='produit' name='produit' data-role='goProduit'>
    

<?php    
   if(isset($_POST["idNavire"])){

     $b=$_POST["idNavire"];
$b=$_POST["idNavire"];
$_SESSION['produit']=$b;
                   
//$bdd=new PDO('mysql:host=localhost;dbname=publicite;charset=utf8;', 'root', '');


         echo  "<option  selected>Selectionner produit</option>";

     
   
             /*  $resP = $bdd->prepare("SELECT dis.*,mang.mangasin, p.produit,p.qualite FROM dispatching as dis
                inner join produit_deb as p on dis.id_produit=p.id
                 inner join mangasin as mang on dis.id_mangasin=mang.id
                

            WHERE dis.id_navire=? group by dis.id_produit, dis.poids_kg, dis.id_mangasin " );
        $resP->bindParam(1,$b);
       
        
        $resP->execute(); */

       $cherche_type=$bdd->prepare('SELECT type from navire_deb where id=?');
       $cherche_type->bindParam(1,$b);
       $cherche_type->execute();

       $type=$cherche_type->fetch();


if($type['type']=='SACHERIE'){

         $resP = $bdd->prepare("SELECT dis.*,mang.mangasin, p.produit,p.qualite,nc.*,nav.type, nav.id as nav_id, d.* FROM dispats as dis
               LEFT join declaration as d on d.id_bl=dis.id_dis
               inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
               inner join navire_deb as nav on nav.id=nc.id_navire
                inner join produit_deb as p on nc.id_produit=p.id
                
                 inner join mangasin as mang on dis.id_mangasin=mang.id
                

            WHERE nc.id_navire=? group by nc.id_produit, nc.poids_kg, dis.id_mangasin " );
        $resP->bindParam(1,$b);
       
        
        $resP->execute();
       }

       if($type['type']=='VRAQUIER'){

         $resP = $bdd->prepare("SELECT dis.*,mang.mangasin, p.produit,p.qualite,nc.*,nav.type,cli.client, nav.id as nav_id, d.* FROM dispats as dis
               LEFT join declaration as d on d.id_bl=dis.id_dis
               inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
               inner join navire_deb as nav on nav.id=nc.id_navire
                inner join produit_deb as p on dis.id_produits=p.id
                inner join client as cli on cli.id=nc.id_client
                
                 inner join mangasin as mang on dis.id_mangasin=mang.id
                

            WHERE nc.id_navire=? group by dis.id_produits, dis.poids_kgs,nc.id_client, dis.id_mangasin " );
        $resP->bindParam(1,$b);
       
        
        $resP->execute();
       }

        while($row2 = $resP->fetch()){

          if($type['type']=='SACHERIE'){
            
            ?>

            
              <option   value=<?php echo $row2['id_produit'].'-'.$row2['poids_kg'].'-'.$row2['nav_id'].'-'.$row2['id_mangasin'].'-'.$row2['id_dis'].'-'.$row2['type'].'-'.$row2['id_client']; ?> > <span class="produit"> <?php echo $row2['produit']; ?></span>  <span class="poids"><?php echo $row2['poids_kg']; ?> KGS</span>  / <?php echo $row2['mangasin']; ?>  </option>
               <?php  } 


              ?>
   
   <?php  

       if($type['type']=='VRAQUIER'){
            
            ?>

            
              <option   value=<?php echo $row2['id_produits'].'-'.$row2['poids_kgs'].'-'.$row2['nav_id'].'-'.$row2['id_mangasin'].'-'.$row2['id_dis'].'-'.$row2['type'].'-'.$row2['id_client']; ?> > <span class="produit"> <?php echo $row2['produit']; ?></span>  <span class="poids"><?php echo $row2['poids_kgs']; ?> KGS</span> <?php echo $row2['client']; ?> /<?php echo $row2['mangasin']; ?> <?php echo $row2['id_dis']; ?></option>
               <?php  } 


             } ?>
             

            </select>
<?php 



}  
    ?>
             




