<?php  
require('../database.php');
    echo " <select id='bl' name='bl' >
     <option selected>choisir le connaissement</option>";
    if(isset($_POST["idNavbl"])){

     
//$bdd=new PDO('mysql:host=localhost;dbname=publicite;charset=utf8;', 'root', '');


$b=$_POST["idNavbl"];

     
   
                $res2 = $bdd->prepare("SELECT id_dis, n_bl FROM dispatching 
            WHERE id_navire=? ");
        $res2->bindParam(1,$b);
        
        
        $res2->execute();
        while($row2 = $res2->fetch()){
            ?>
           
              <option value=<?php echo $row2['id_dis']; ?>><?php echo $row2['n_bl']; ?></option>
               <?php } ?>

             

            
<?php } ?>
             
</select>
