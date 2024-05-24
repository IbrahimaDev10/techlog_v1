<?php

require('../database.php');

   echo " <select id='produit' name='' onchange='goProduit()'>
    <option  selected>Selectionner le produit</option>";

    if(isset($_POST["idClient"])){

     $b=$_POST["idClient"];
     $c=explode('-', $b);
    

//$bdd=new PDO('mysql:host=localhost;dbname=publicite;charset=utf8;', 'root', '');




     
   
                $res2 = $bdd->prepare("SELECT dis.* , p.* , nav.*,nc.num_connaissement,nc.id_navire from dispat as dis 
                 
                 
                 inner join produit_deb  as p on dis.id_produit=p.id
                 inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
                 inner join navire_deb as nav on nav.id=nc.id_navire
                 
                
                 where dis.id_client=? and nc.id_navire=? GROUP BY dis.id_produit  ");
      $res2->bindParam(1,$c[0]);
       $res2->bindParam(2,$c[1]);
     
      $res2->execute();
       
        
        
        while($row2 = $res2->fetch()){
          
            ?>
             
              <option  value=<?php echo $row2['id_dis'].'-'.$row2['id_produit'].'-'.$row2['poids_kg'].'-'.$row2['id_navire'].'-'.$row2['id_client']; ?> > <?php echo $row2['produit'].' '.$row2['qualite'].' '.$row2['poids_kg'].' KGS';  ?> </option>
               <?php } ?>

             

            </select>
<?php  }  
    ?>
 