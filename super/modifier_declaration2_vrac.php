<?php 	
require('../database.php');

if (isset($_POST['ch'])) {
    
      
      $nom_chargeur= $_POST['ch'];
      $id=$_POST['id'];
      $cale=$_POST['cale'];
     
      $id_produit=$_POST['produitId'];
     
      $poids=$_POST['poids'];
      $navire=$_POST['navire'];
      
try{
     $insertRecep1= $bdd->prepare("UPDATE declaration_chargement set cales=?, nom_chargeur=?, id_produit=?,  poids=?   where id_dec=? "); 
$insertRecep1->bindParam(1,$cale); 
$insertRecep1->bindParam(2,$nom_chargeur);

$insertRecep1->bindParam(3,$id_produit);

$insertRecep1->bindParam(4,$poids);
$insertRecep1->bindParam(5,$id);

$insertRecep1->execute();




}
catch(PDOException $e){
    die('Erreur:' .$e->getMessage());   
}
?>
    <div class="container-fluid" id="parcale"  >

                       <center>
                      <h1 class="hdeclaration text-white" >CHARGEMENT PAR CALE</h1></center>
                      
  


                          <div class="card-body"> 
                   <div class="table-responsive" border=1> 
                  <table class='table table-hover table-bordered table-striped' id="fetch_cargo_plan" border='5' style="border-color: black;" >
                <thead> 

               <tr style="color:white; font-weight: bold; background: linear-gradient(to bottom, #FFFFFF, rgb(0,141,202));  border-color: white; text-align: center; font-size: 14px;" border='5' >
                
              <th  >CALES</th>
              <th  scope="col" >NOM CHARGEUR</th>
             <th  scope="col" >PRODUIT</th>
                   
          
          <th  scope="col" >POIDS (T)</th>
          <th  scope="col" class="hide-on-print">ACTIONS</th>
         
         </tr>
         
        </thead>
      <tbody style="font-weight: bold;">

                        <?php
               $res2 = $bdd->prepare("SELECT   p.*, dc.*, sum(dc.nombre_sac), sum(dc.poids) from produit_deb as p left join declaration_chargement as dc on p.id=dc.id_produit  where dc.id_navire=? group by dc.cales, p.produit, dc.id_dec  with rollup ");
            $res2->bindParam(1,$navire);
            $res2->execute();
             while($row2 = $res2->fetch()){
            ?>
      
              <?php 
              if(!empty($row2['produit']) and !empty($row2['id_dec']) and !empty($row2['cales'])){ ?>
          <tr id="<?php echo $row2['id_dec'] ?>" style="text-align:center; background: white; font-size: 14px; vertical-align: middle;" border='5'>

    <td id="colcel" data-target="cales_vrac" ><?php echo $row2['cales']; ?></td>
    <td id="colcel" data-target="nom_chargeur_vrac"><?php echo $row2['nom_chargeur']; ?></td>
   <td id="colcel"   data-target="produit_vrac"  >   <?php echo $row2['produit']; ?> <pre><?php echo $row2['qualite']; ?></pre></td><span id="<?php echo $row2['id_dec'].'produit-id-vrac'; ?>" style="display: none;"> <?php echo $row2['id_produit'] ?> </span>
   <td id="colcel" data-target="poids_vrac" ><?php echo number_format($row2['sum(dc.poids)'], 3,',',' '); ?></td>
   <td style="display: none;" id="colcel" data-target="navire_vrac" ><?php echo $row2['id_navire'] ?></td>

   <td id="colcel" class="hide-on-print"><a  id="<?php echo $row2['id_dec'] ?>" name="delete" type="submit"   onclick="deleteDec(<?php echo $row2['id_dec'] ?>)" style="color:rgb(0,141,202); margin-left: 0px;"> <i class="fa fa-trash " ></i> </a>
     <a class="btn" type="button" name="modify" href="#" data-role="update_vrac" data-id="<?php echo $row2['id_dec']; ?>"    id="btnbtn" style="border: none; margin-right: 1px; color:rgb(0,141,202);"> <i class="fa fa-edit fa-2x " ></i></a>
    </td>
  </tr>
         <?php } ?>

                <?php 
              if(empty($row2['produit']) and empty($row2['id_dec']) and !empty($row2['cales'])){ ?>
                <tr id="<?php echo $row2['id_dec'] ?>" style="text-align:center;  font-size: 16px; vertical-align: middle;" border='5'>
    <td id="soustotal" colspan="3" >TOTAL <?php echo $row2['cales']; ?></td>
   
          
          
    <td id="soustotal" ><?php echo number_format($row2['sum(dc.poids)'], 3,',',' '); ?></td>
    <td id="soustotal" class="hide-on-print"></td>
  </tr>
                 <?php } ?>

<?php 
              if(empty($row2['cales']) and empty($row2['produit']) and empty($row2['id_dec'])){

               ?>
            <tr id="<?php echo $row2['id_dec'] ?>" style="text-align:center;  font-size: 16px; vertical-align: middle;" border='5'>
               
             

<td id="total" colspan="3" >TOTAL </td>

<td id="total"><?php echo number_format($row2['sum(dc.poids)'], 3,',',' '); ?></td>
<td id="total" class="hide-on-print"> </td>
</tr>
<?php } ?>

    
               <?php } ?>
    </tbody>
   </table>  
  </div>
 </div>

 <style type="text/css">
  body{
    font-family:Times New Roman;
  }
  #colcel{

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
   <button  style="margin:auto-right;" class="btn btn-primary" onClick="imprimercale('parcale')">imprimer</button></div>
  </div>

</div>

<?php  
}

 ?>
 