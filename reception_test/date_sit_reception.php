<?php

require('../database.php');

   echo " <select id='date' name='date' onchange='goDateSit()'>
    <option  selected>Selectionner la date</option>";

    if(isset($_POST["idNavires"])){

     $b=$_POST["idNavires"];

//$bdd=new PDO('mysql:host=localhost;dbname=publicite;charset=utf8;', 'root', '');




     
   
                $res2 = $bdd->prepare("SELECT * from date_situation_reception where id_dis_sit_avr=? group by date_sit_avr " );
        $res2->bindParam(1,$b);
       
        
        $res2->execute();
        while($row2 = $res2->fetch()){
           $date=explode('-', $row2['date_sit_avr']);
            ?>
             
              <option   value=<?php echo $row2['id_dis_sit_avr']; ?>,<?php echo $row2['date_sit_avr']; ?> > <?php echo $date['2'].'-' .$date[1]. '-'.$date[0];  ?> <option>
               <?php } ?>

             

            </select>
<?php  }  
    ?>
             




