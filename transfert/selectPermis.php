<?php
require('../database.php');
 echo "<select id='permis' name='permis'>";
   

    if(isset($_POST["idCam"])){

     $b=$_POST["idCam"];
//$bdd=new PDO('mysql:host=localhost;dbname=publicite;charset=utf8;', 'root', '');




     
   
                $res2 = $bdd->prepare("select * from chauffeur 

            WHERE id_chauffeur=? " );
        $res2->bindParam(1,$b);
       
        
        $res2->execute();
        while($row2 = $res2->fetch()){
            ?>
            
             <option value=<?php echo $row2['id_chauffeur']; ?>> <?php echo $row2['n_permis']; ?> </option> 
               <?php } ?>

             

           
<?php  }  
    ?>
             




