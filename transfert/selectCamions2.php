<?php
require('../database.php');
 echo "  
 <select id='chauf2' name='chauffeur' onchange='chauffe()'>
    <option  selected>chauff</option>";
   

    if(isset($_POST["idCam"])){

     $b=$_POST["idCam"];
//$bdd=new PDO('mysql:host=localhost;dbname=publicite;charset=utf8;', 'root', '');

 
   
                $res2 = $bdd->prepare("select * from chauffeur 

            WHERE num_camions=? " );
        $res2->bindParam(1,$b);
       
        
        $res2->execute();
 
       


        while($row2 = $res2->fetch()){
            ?>
            
             <option value=<?php echo $row2['id_chauffeur'].",".$row2['id_transporteur']; ?>> <?php echo $row2['nom_chauffeur']; ?> </option> 
               <?php } ?>
            


           
<?php  }  
    ?>
    </select>

             




