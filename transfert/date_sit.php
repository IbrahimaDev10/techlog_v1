<?php

require('../database.php');

   echo " <select id='date' name='date' onchange='goDateSit()'>
    <option  selected>Selectionner la date</option>";

    if(isset($_POST["idNavires"])){

     $b=$_POST["idNavires"];

//$bdd=new PDO('mysql:host=localhost;dbname=publicite;charset=utf8;', 'root', '');




     
   
                $res2 = $bdd->prepare("SELECT dates, id_navire from transfert_debarquement where id_navire=? group by dates " );
        $res2->bindParam(1,$b);
       
        
        $res2->execute();
        while($row2 = $res2->fetch()){
           $date=explode('-', $row2['dates']);
            ?>
             
              <option  value=<?php echo $row2['id_navire']; ?>,<?php echo $row2['dates']; ?> > <?php echo $date['2'].'-' .$date[1]. '-'.$date[0];  ?> </option>
               <?php } ?>

             

            </select>
<?php  }  
    ?>
             




