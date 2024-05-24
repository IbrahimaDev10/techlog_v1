<?php
require('../database.php');
$navire=$bdd->query("select * from navire_deb order by id desc");

   echo " <div id='affiche_nav_prod'>";

    if(isset($_POST["idMode"])){

     $b=$_POST["idMode"];
     ?>

                            <select  id="navire" class="mysel" style="margin-right: 15%; height: 30px;   width: 40%; background: orange;" onchange='goNavire()'>
                            <option value="">selectionner une navire</option>
                            <?php 
                            while ($row=$navire->fetch()) {
                             ?>
                                <option  value=<?php echo $b.','.$row['id']; ?>><?php echo $row['navire']; ?></option>
                            <?php } ?>

                        </select>
                    <select id="produit" class="mysel" name="produit" style="margin-right: 2%; height: 30px;  width: 40%;" onchange='goProduit()'>
                            <option  selected>selectionner produit</option>
                        </select>
     <?php  
//$bdd=new PDO('mysql:host=localhost;dbname=publicite;charset=utf8;', 'root', '');
 }  
    ?>
</div>
             




