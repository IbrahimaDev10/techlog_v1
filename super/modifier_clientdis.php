<?php 	
require('../database.php');

if (isset($_POST['id'])) {
    
      
      $client= $_POST['client'];
       $destination= $_POST['destination'];
        $produit= $_POST['produit'];
      $id=$_POST['id'];
      $n_bl=$_POST['n_bl'];
     
      $conditionnement=$_POST['cond'];
      $sac=$_POST['sac'];
      $navire=$_POST['navire'];
      $poids=$_POST['sac']*$conditionnement/1000;
      
      
try{
     $insertRecep1= $bdd->prepare("UPDATE dispatching set  nombre_sac=?, poids_t=?, poids_kg=?, id_client=?, id_mangasin=?,  id_produit=?, n_bl=?  where id_dis=? "); 
$insertRecep1->bindParam(1,$sac); 
$insertRecep1->bindParam(2,$poids);
$insertRecep1->bindParam(3,$conditionnement);
$insertRecep1->bindParam(4,$client);
$insertRecep1->bindParam(5,$destination);
$insertRecep1->bindParam(6,$produit);
$insertRecep1->bindParam(7,$n_bl);
$insertRecep1->bindParam(8,$id);


$insertRecep1->execute();




}
catch(PDOException $e){
    die('Erreur:' .$e->getMessage());   
}
?>
<div class="container-fluid" id="parclient" >


         
              <center>
              <h1 class="hdeclaration text-white" >DISPATCHING PAR CLIENT</h1>
              </center>

            <div class="table-responsive" border=1> 
             <table class='table table-responsive table-hover table-bordered table-striped' id="fetch_cargo_plan" border='5' style="border-color: black; " >
            
          <thead>   
 <tr style="color:white; font-weight: bold; color:white; font-weight: bold; background: linear-gradient(to bottom, #FFFFFF, rgb(0,141,202));  border-color: white; text-align: center; font-size: 14px;" border='5' >
                                <th  scope="col" >CLIENT</th>
                                <th  scope="col" >NUMERO BL</th>
                                <th  scope="col" >PRODUIT</th>

                                <th  scope="col" >QUANTITE</th>
                               <th  scope="col" >POIDS (T)</th> 
                               <th  scope="col" >DESTINATION</th>
                               <th scope="col" >ACTIONS</th>
                                
                                


                                
                              </tr>
                              </thead>
                               <tbody style="font-weight: bold;">
                                <?php  
                        $client = $bdd->prepare("SELECT   dis.*, p.*,cli.*,mang.*, sum(dis.nombre_sac), sum(dis.poids_t),cli.id as idcli, p.id as idp, mang.id as idmang from dispatching as dis
                         
                        inner join client as cli on dis.id_client=cli.id 
                         
                        inner join mangasin as mang on dis.id_mangasin=mang.id
                        inner join produit_deb as p  on dis.id_produit=p.id
                         
                      
                        where dis.id_navire=?  group by cli.client, mang.mangasin, dis.id_dis with rollup ");
        $client->bindParam(1,$navire);
       
        
        $client->execute();

        while($row2 = $client->fetch()){

            ?>
          
             <?php if(!empty($row2['mangasin']) and !empty($row2['client']) and !empty($row2['id_dis'])){ ?>
                <tr id="<?php echo $row2['id_dis'] ?>"  style="text-align:center; background: white; font-size: 14px;" border='5'>
             <td class="colcel" id="<?php echo $row2['id_dis'].'clientdis' ?>"  ><?php echo $row2['client']; ?></td> 
             <td class="colcel" id="<?php echo $row2['id_dis'].'n_bl_dis' ?>" ><?php echo $row2['n_bl']; ?></td>

<td class="colcel" ><?php echo $row2['produit']; ?> <br><?php echo $row2['qualite']; ?> <br><?php echo $row2['poids_kg']; ?> kgs</td>
<span style="display: none;" class="colcel" id="<?php echo $row2['id_dis'].'produitdis' ?>" ><?php echo $row2['produit']; ?> <?php echo $row2['qualite']; ?> </span>
<span style="display: none;" class="colcel" id="<?php echo $row2['id_dis'].'condidis' ?>" ><?php echo $row2['poids_kg']; ?>  </span>
<span style="display: none;" class="colcel" id="<?php echo $row2['id_dis'].'idproduitdis' ?>" ><?php echo $row2['idp']; ?>  </span>
<span style="display: none;" class="colcel" id="<?php echo $row2['id_dis'].'navdis' ?>" ><?php echo $row2['id_navire']; ?>  </span>
<span style="display: none;" class="colcel" id="<?php echo $row2['id_dis'].'idclientdiscol' ?>" ><?php echo $row2['idcli']; ?>  </span>

        <td class="colcel" id="<?php echo $row2['id_dis'].'sacsdis' ?>" ><?php echo number_format($row2['nombre_sac'], 0,',',' '); ?></>
         <td class="colcel"><?php echo number_format($row2['poids_t'], 3,',',' '); ?></td>
              <td class="colcel" id="<?php echo $row2['id_dis'].'destidis' ?>" ><?php echo $row2['mangasin']; ?></td>
             

            
            <td class="colcel" ><a  id="<?php echo $row2['id_dis'] ?>" name="deletedis" type="submit"  class="btn btn-text-danger" onclick="deleteDispatching(<?php echo $row2['id_dis'] ?>)" style="color:rgb(0,141,202); margin-left: 0px;"> <i class="fa fa-trash " ></i> </a>
     <a class="btn" type="button" name="modify"    style="border: none; margin-right: 1px; color:rgb(0,141,202);" data-role="update_disclient" data-id="<?php echo $row2['id_dis']; ?>"> <i class="fa fa-edit  "  ></i></a>
     <a class="fabtn1" href="insertion_fichier_mangasin.php?id=<?php echo $row2['id_dis'] ?>" style="float:right;"   name="modify"         id="btnbtn" >  <i class="fa fa-folder"  ></i></a>
    </td>
    <span style="display: none;" class="colcel" id="<?php echo $row2['id_dis'].'idclientdis' ?>" ><?php echo $row2['idcli']; ?></span>
    <span style="display: none;" class="colcel" id="<?php echo $row2['id_dis'].'iddestidis' ?>" ><?php echo $row2['idmang']; ?></span>
  </tr>
    <?php } ?>
                       <?php 
              if(empty($row2['mangasin']) and empty($row2['id_dis']) and !empty($row2['client'])){
                  
               ?>
               <tr style="text-align:center;  font-size: 16px;" border='5'>
              <td id="soustotal" colspan="3">TOTAL <?php echo $row2['client']; ?> </td>

<td id="soustotal" ><?php echo number_format($row2['sum(dis.nombre_sac)'], 0,',',' '); ?></td>
<td id="soustotal"><?php echo number_format($row2['sum(dis.poids_t)'], 3,',',' '); ?></td>
<td colspan="2" id="soustotal" > </td>
</tr>
<?php } ?>
                      



    <?php 
              if(empty($row2['mangasin']) and empty($row2['client']) and empty($row2['id_dis'])){

               ?>
               <tr style="text-align:center;  font-size: 16px;" border='5'>
              <td style="background-color:#1B2B65; color: red; border: none;">  </td>

<td id="total" colspan="2" >TOTAL </td>


<td id="total" ><?php echo number_format($row2['sum(dis.nombre_sac)'], 0,',',' '); ?></td>
<td id="total" ><?php echo number_format($row2['sum(dis.poids_t)'], 3,',',' '); ?></td>
<td id="total" colspan="2"> </td>
</tr>
<?php } ?>
            
       


<?php } ?>
     </tbody>
   </table>  
  </div>
  <style type="text/css">
  body{
    font-family:Times New Roman;
  }
  .colcel{

    vertical-align: middle;
  }
  #soustotal{
     background: linear-gradient(to bottom, blue, #1B2B65);
      background: linear-gradient(to left, blue, #1B2B65); background: linear-gradient(to top, blue, #1B2B65);
     color: white;
     vertical-align: middle;
     font-size: 16px; 
     text-align: center;
  }
  #total{
    background-color:#1B2B65;  color:white ; border: none; font-size: 16px; font-weight: bold; vertical-align: middle;
    text-align: center;
  }
  .hdeclaration{
  background-color: background: linear-gradient(to bottom, blue, #1B2B65);
   background: linear-gradient(to left, blue, #1B2B65);
    background: linear-gradient(to top, blue, #1B2B65);
  border: solid;
  
  border-top-right-radius: 50%;
  border-bottom-right-radius: 50%;
  font-weight: bold;
}
</style>

   <button style="margin:auto-right;" class="btn btn-primary" onClick="imprimerclient('parclient')">imprimer</button>
 </div>      
<br>
<?php  
}

 ?>
 