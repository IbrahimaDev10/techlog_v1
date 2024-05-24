<?php 	
require('../database.php');

if (isset($_POST['id'])) {
    
      
      $bl= $_POST['bl'];
      $id=$_POST['id'];
     
      $conditionnement=$_POST['cond'];
      $poids=$_POST['poids'];
      $navire=$_POST['navire'];
      $produit=$_POST['produit'];
      $client=$_POST['client'];
      $destination=$_POST['destination'];
      $banque=$_POST['banquedis'];
     
      
      
try{
     $insertRecep1= $bdd->prepare("UPDATE dispatching set n_bl=?, poids_t=?, poids_kg=?, id_client=?, id_produit=?, id_mangasin=?, banque=?  where id_dis=? "); 
$insertRecep1->bindParam(1,$bl); 

$insertRecep1->bindParam(2,$poids);
$insertRecep1->bindParam(3,$conditionnement);
$insertRecep1->bindParam(4,$client);
$insertRecep1->bindParam(5,$produit);
$insertRecep1->bindParam(6,$destination);
$insertRecep1->bindParam(7,$banque);
$insertRecep1->bindParam(8,$id);


$insertRecep1->execute();




}
catch(PDOException $e){
    die('Erreur:' .$e->getMessage());   
}
?>
<div class="container-fluid" id="parbl" >
              <center>
              <h1 class="hdeclaration text-white" >CONNAISSEMENT</h1>
              </center>

            <div class="table-responsive" border=1> 
             <table class='table table-responsive table-hover table-bordered table-striped' id="fetch_cargo_plan" border='5' style="border-color: black; " >
            
          <thead>   
 <tr style="color:white; font-weight: bold; color:white; font-weight: bold; background: linear-gradient(to bottom, #FFFFFF, rgb(0,141,202));  border-color: white; text-align: center; font-size: 14px;" border='5' >
                                <th  scope="col" >BL</th>
                                <th  scope="col" >BANQUE</th>
                                <th  scope="col" >RECEPTIONNAIRE</th>
                                <th  scope="col" >PRODUIT</th>
                               <th  scope="col" >POIDS (T)</th> 
                               <th  scope="col" >DESTINATION</th>
                               <th scope="col" class="hide-on-print">ACTIONS</th>
                                
                                


                                
                              </tr>
                              </thead>
                               <tbody style="font-weight: bold;">
                                <?php  
                        $client = $bdd->prepare("SELECT   dis.*, p.*,cli.*,mang.*, sum(dis.nombre_sac), sum(dis.poids_t) from dispatching as dis
                         
                        inner join client as cli on dis.id_client=cli.id 
                         
                        inner join mangasin as mang on dis.id_mangasin=mang.id
                        inner join produit_deb as p  on dis.id_produit=p.id
                         
                      
                        where dis.id_navire=?  group by dis.n_bl, mang.mangasin, dis.id_dis with rollup ");
        $client->bindParam(1,$navire);
       
        
        $client->execute();

        while($row2 = $client->fetch()){

            ?>
          
             <?php if(!empty($row2['mangasin']) and !empty($row2['n_bl']) and !empty($row2['id_dis'])){ ?>
                <tr id="<?php echo $row2['id_dis'] ?>"  style="text-align:center; background: white; font-size: 14px;" border='5'>
             <td class="colcel" id="<?php echo $row2['id_dis'].'bl_disvrac' ?>" ><?php echo $row2['n_bl']; ?></td>
             <td class="colcel" id="<?php echo $row2['id_dis'].'banque_disvrac' ?>" ><?php echo $row2['banque']; ?></td> 
             <td class="colcel" id="<?php echo $row2['id_dis'].'cli_disvrac' ?>" ><?php echo $row2['client']; ?></td>
             <span style="display: none;" class="colcel" id="<?php echo $row2['id_dis'].'id_client_disvrac' ?>" ><?php  echo $row2['id_client']; ?></span>


<td class="colcel" id="<?php echo $row2['id_dis'].'prod_disvrac' ?>" ><?php echo $row2['produit']; ?> <br><?php echo $row2['qualite']; ?> <br><?php echo $row2['poids_kg']; ?> kgs</td>
<span style="display: none;" class="colcel" id="<?php echo $row2['id_dis'].'id_prod_disvrac' ?>" ><?php echo $row2['id_produit']; ?> </span>
        
         <td class="colcel" id="<?php echo $row2['id_dis'].'poids_disvrac' ?>" ><?php echo number_format($row2['poids_t'], 3,',',' '); ?></td>
              <td class="colcel" id="<?php echo $row2['id_dis'].'mg_disvrac' ?>" ><?php echo $row2['mangasin']; ?></td>
               <span style="display: none;" class="colcel" id="<?php echo $row2['id_dis'].'id_mg_disvrac' ?>" ><?php echo $row2['id_mangasin']; ?></span>
              <td class="colcel"  style="display: none;"><?php echo $row2['id_navire'] ?></td>
               <td class="colcel" data-target="affreteur_dis" style="display: none;"><?php echo $row2['affreteur'] ?></td>
                <td class="colcel" data-target="banque_dis" style="display: none;"><?php echo $row2['banque'] ?></td>
            
            <td class="colcel" >
               <div style="display: flex; justify-content: center;"> 
              <a name="deletedis" type="submit"  class="btn btn-text-danger" onclick="deleteDispatching(<?php echo $row2['id_dis'] ?>)" style="color:rgb(0,141,202); margin-left: 0px;"> <i class="fa fa-trash " ></i> </a>
     <a class="btn"  name="modifys"  data-role="update_disvrac" data-id="<?php echo $row2['id_dis']; ?>"    style="border: none; margin-right: 1px; color:rgb(0,141,202);"> <i class="fa fa-edit  " ></i></a>
     <a class="fabtn1" href="insertion_fichier_mangasin.php?id=<?php echo $row2['id_dis'] ?>" style="float:right;" target="blank" name="modify"         id="btnbtn" >  <i class="fa fa-folder"  ></i></a>
   </div>
    </td>
    <span style="display: none;" id="<?php echo $row2['id_dis'].'conditionnementvrac' ?>"><?php echo $row2['poids_kg']; ?></span>
    <span style="display: none;" id="<?php echo $row2['id_dis'].'id_clientvrac' ?>"><?php echo $row2['poids_kg']; ?></span>
     <span style="display: none;" id="<?php echo $row2['id_dis'].'id_navirevrac' ?>"><?php echo $row2['id_navire']; ?></span>
    
  </tr>
    <?php } ?>
                       <?php 
              if(empty($row2['mangasin']) and empty($row2['id_dis']) and !empty($row2['n_bl'])){
                  
               ?>
               <tr style="text-align:center;  font-size: 16px;" border='5'>
              <td id="soustotal" colspan="4">TOTAL <?php echo $row2['n_bl']; ?> </td>


<td  id="soustotal"><?php echo number_format($row2['sum(dis.poids_t)'], 3,',',' '); ?></td>
<td colspan="2" id="soustotal" > </td>
</tr>
<?php } ?>
                      



    <?php 
              if(empty($row2['mangasin']) and empty($row2['n_bl']) and empty($row2['id_dis'])){

               ?>
               <tr style="text-align:center;  font-size: 16px;" border='5'>
              <td style="background-color:#1B2B65; color: red; border: none;">  </td>

<td id="total" colspan="3" >TOTAL </td>



<td id="total" ><?php echo number_format($row2['sum(dis.poids_t)'], 3,',',' '); ?></td>
<td id="total" > </td>
<td  id="total" class="hide-on-print"> </td>


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
@media print {
  .hide-on-print {
    display: none !important;
  }
}

</style>
<div class="hide-on-print">
   <button  style="margin:auto-right;" class="btn btn-primary" onClick="imprimerbl('parbl')">imprimer</button></div>
 </div>
<br>
<?php  
}

 ?>
 