<?php

require('../database.php');

   echo " <select id='client' name='client' onchange='goClient()'>
    <option  selected>Selectionner le client</option>";

    if(isset($_POST["idNavires"])){

     $b=$_POST["idNavires"];
    

//$bdd=new PDO('mysql:host=localhost;dbname=publicite;charset=utf8;', 'root', '');




     
   
                $res2 = $bdd->prepare("SELECT dis.* , dis.id_produit , dis.id_client, cli.*,nc.id_navire from dispat as dis 
                 
                 
                 inner join client as cli on dis.id_client=cli.id
                 inner join numero_connaissement as nc on dis.id_con_dis=nc.id_connaissement
                 
                
                 where nc.id_navire=?  group by dis.id_client");
      $res2->bindParam(1,$b);
     
      $res2->execute();
       
        
        
        while($row2 = $res2->fetch()){
          
            ?>
             
              <option  value=<?php echo $row2['id_client'].'-'.$row2['id_navire']; ?> > <?php echo $row2['client'];  ?> </option>
               <?php } ?>

             

            </select>
<?php  }  
    ?>
             




