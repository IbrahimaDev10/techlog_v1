<?php

require('../database.php');

   echo " <select id='date' name='date' onchange='goDateSit()'>
    <option  selected>Selectionner le produit</option>";

    if(isset($_POST["idNavires"])){

     $b=$_POST["idNavires"];
     $c=explode('-', $b);

//$bdd=new PDO('mysql:host=localhost;dbname=publicite;charset=utf8;', 'root', '');




     
   
                $res2 = $bdd->prepare("select dis.*, mg.*,nav.*, p.* from dispatching as dis 
                 inner join mangasin as mg on dis.id_mangasin=mg.id
                 
                 inner join navire_deb as nav on dis.id_navire=nav.id
                 inner join produit_deb as p on p.id=dis.id_produit
                 inner join simar_user as user on user.id_sim_user=mg.id_mangasinier
                 where mg.id_mangasinier=? and dis.id_navire=? group by dis.id_dis");
      $res2->bindParam(1,$c[1]);
       $res2->bindParam(2,$c[0]);
      $res2->execute();
       
        
        
        while($row2 = $res2->fetch()){
          
            ?>
             
              <option   value=<?php echo $row2['id_dis']; ?> > <?php echo $row2['produit'].' '.$row2['qualite'].' '.$row2['poids_kg'].' KGS';  ?> </option>
               <?php } ?>

             

            </select>
<?php  }  
    ?>
             



