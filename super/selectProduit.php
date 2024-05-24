<?php
require('../database.php');
    echo " <select id='produit' name='produit' >";
    if(isset($_POST["idNavire"])){

     
//$bdd=new PDO('mysql:host=localhost;dbname=publicite;charset=utf8;', 'root', '');


$b=$_POST["idNavire"];

     
   
                $res2 = $bdd->prepare("SELECT * FROM produit_deb 
            WHERE id_navire=? ");
        $res2->bindParam(1,$b);
       
        
        $res2->execute();
        ?>
        <option selected>selectionner un produit</option>
      <?php    while($row2 = $res2->fetch()){
            ?>
            
              <option value=<?php echo $row2['id']; ?>><?php echo $row2['produit']; ?> <pre><?php echo $row2['qualite']; ?> <?php echo $row2['poids']; ?>KGS</pre></option>
               <?php } ?>

             

            </select>
<?php } ?>
             




