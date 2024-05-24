<?php

require('../database.php');

   echo " <select id='client_tr' name='client' onchange='goClient()'>
    <option  selected>Selectionner le client</option>";

    if(isset($_POST["idNavire"])){

     $b=$_POST["idNavire"];
    

//$bdd=new PDO('mysql:host=localhost;dbname=publicite;charset=utf8;', 'root', '');
     /*
$res2 = $bdd->prepare("SELECT dis.id_dis ,  dis.id_produit , dis.id_client, nc.id_navire, cli.client, mg.id_mangasinier,mg.mangasin from dispat as dis 
                 inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
                 inner join mangasin as mg on dis.id_mangasin=mg.id
                 inner join client as cli on dis.id_client=cli.id
                
                 
                
                 where nc.id_navire=? AND mg.id_mangasinier=?  group by dis.id_client ");
                 
  
      $res2->bindParam(1,$b);
       $res2->bindParam(2,$_SESSION['id']);
      
     
      $res2->execute(); */

   
            $res2 = $bdd->prepare("SELECT dis.id_dis ,  dis.id_produit , dis.id_client, nc.id_navire, cli.client, mg.id_mangasinier,mg.mangasin,tr.id_nouvelle_destination,dt.id_mangasinier_transfert from dispat_transfert as dt 
                 inner join dispat as dis on dt.id_dis_transfertD=dis.id_dis
                 inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
                 inner join mangasin as mg on dt.id_nouvelle_destinationD=mg.id
                 inner join transfert as tr on tr.id_dis_transfert=dt.id_transfertD
                 inner join client as cli on dis.id_client=cli.id
                 
                 
                 
                
                 where nc.id_navire=? and mg.id_mangasinier=?  group by dis.id_client ");
                 
  
      $res2->bindParam(1,$b);
       $res2->bindParam(2,$_SESSION['id']);
       
     
      $res2->execute(); 




/* L'ANCIEN REQUETE AU CAS OU YMGX 
       $res2 = $bdd->prepare("SELECT dis.* ,  dis.id_produit , dis.id_client, nc.id_navire, cli.*, mg.id_mangasinier from dispat as dis 
                 inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
                 inner join mangasin as mg on dis.id_mangasin=mg.id
                 inner join client as cli on dis.id_client=cli.id
                 
                 
                
                 where nc.id_navire=? and mg.id_mangasinier=?  group by dis.id_client");
      $res2->bindParam(1,$b);
       $res2->bindParam(2,$_SESSION['id']);
     
      $res2->execute(); */
       
        
        
        while($row2 = $res2->fetch()){
          
            ?>
             
              <option  value=<?php echo $row2['id_client'].'-'.$row2['id_navire']; ?> > <?php echo $row2['client'];  ?> </option>
               <?php } ?>

             

            </select>
<?php  }  
    ?>
             




