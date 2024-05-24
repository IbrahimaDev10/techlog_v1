<?php
require('../database.php');

   echo " <select id='nom_bl' name='nom_bl' onchange='goBL()'>
    <option  selected> choisir le connaissement</option>";

    if(isset($_POST["idProduit"])){

     $b=$_POST["idProduit"];
//$bdd=new PDO('mysql:host=localhost;dbname=publicite;charset=utf8;', 'root', '');




     
   
                $res2 = $bdd->prepare("SELECT * FROM dispatching 

            WHERE id_dis=?  " );
        $res2->bindParam(1,$b);
        $res2->execute();

        

        while($row2=$res2->fetch() ){
           $res0 = $bdd->prepare("SELECT id_dis, n_bl, id_produit, poids_kg FROM dispatching 

            WHERE  id_produit=? and poids_kg=? and id_navire=?  " );
        
         $res0->bindParam(1,$row2['id_produit']);
          $res0->bindParam(2,$row2['poids_kg']);
           $res0->bindParam(3,$row2['id_navire']);
        $res0->execute();
         }   ?>
<?php  
            while($row0=$res0->fetch() ){ ?>
              <option   value=<?php echo $row0['id_dis']; ?> > <?php echo $row0['id_dis']; ?> <?php echo $row0['n_bl']; ?></option>
               <?php } ?>

             

            </select>
<?php  }  
    ?>
             




