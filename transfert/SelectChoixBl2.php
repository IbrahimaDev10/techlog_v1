<?php  
require('../database.php');
    echo " <select id='numero_bl' name='numero_bl' >
     <option selected>choisir le connaissement</option>";
    if(isset($_POST["idRef_bl"])){

     
//$bdd=new PDO('mysql:host=localhost;dbname=publicite;charset=utf8;', 'root', '');


$b=$_POST["idRef_bl"];

     
   
                $res2 = $bdd->prepare("SELECT  numero_bl FROM bl
            WHERE id_n_bl=? ");
        $res2->bindParam(1,$b);
        
        
        $res2->execute();
        while($row2 = $res2->fetch()){
            ?>
           
              <option value=<?php echo $row2['numero_bl']; ?>><?php echo $row2['numero_bl']; ?></option>
               <?php } ?>

             

            
<?php } ?>
             
</select>
