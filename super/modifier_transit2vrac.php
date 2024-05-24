<?php 	
require('../database.php');
if(isset($_POST['id'])){
	$num_dec=$_POST['num_dec'];
	$id=$_POST['id'];
	
	$poids_dec=$_POST['poids_dec'];
	$statut=$_POST['statut'];
	$des_douane=$_POST['des_douane'];
	$navire=$_POST['navire'];
  $bl=$_POST['bl'];

	$update= $bdd->prepare("UPDATE  transit SET destination_douaniere=?, numero_declaration=?, poids_declarer=? ,statut_douaniere=? , id_bl=? where id_trans=? ");
	$update->bindParam(1,$des_douane);
	$update->bindParam(2,$num_dec);
	$update->bindParam(3,$poids_dec);
	$update->bindParam(4,$statut);
  $update->bindParam(5,$bl);
	$update->bindParam(6,$id);
	$update->execute();

	?>

<div class="container-fluid" id="partransit" >

              <center>
              <h1 class="hdeclaration text-white" >GESTION DU TRANSIT</h1>
              </center>


            <div class="table-responsive" border=1> 
             <table class='table table-hover table-bordered table-striped' id="fetch_cargo_plan" border='5' style="border-color: black; " >
            
          <thead>  
  <?php 

  $manifest = $bdd->prepare("select tr.n_manifeste, dis.* from dispatching as dis
    inner join transit as tr on dis.id_dis=tr.id_bl
    where dis.id_navire=?  ");
        $manifest->bindParam(1,$navire);
       
        
        $manifest->execute();
        $manif=$manifest->fetch();
        if($manif){?>
          <h3>NUMERO MANIFESTE: <span style="color: red;"><?php echo $manif['n_manifeste'] ?></span></h3>


       <?php } ?> 
            
 <tr style="color:white; font-weight: bold; background: linear-gradient(to bottom, #FFFFFF, rgb(0,141,202));  border-color: white; text-align: center; font-size: 12px; " border='5' >
                                <th  scope="col" >NUMERO BL</th>
                                <th  scope="col" >PRODUIT</th>
                                <th  scope="col" >POIDS MANIFESTE</th>
                                 <th    scope="col" >STATUT DOUANIER</th>
                                <th   scope="col" >DESTINATION DOUANIERE</th>
                               
                                <th  scope="col" >N° DEC / TRANSFERT</th>
                               <th  scope="col" >POIDS DECLARES</th>
                                 
                                 <th  scope="col" >DESTINATION</th>
                               <th  scope="col" >CLIENT</th>
                                <th  scope="col" >ACTIONS</th>
                               
                           
                               
                               
 
                                
                                


                                
                             </tr>
                              </thead>
                               <tbody style="font-weight: bold;">
                                <?php 
    


                                 
                        $client = $bdd->prepare("SELECT tr.*, p.*, cli.*, mang.*,   dis.*  from dispatching as dis
                        inner join transit as tr on dis.id_dis=tr.id_bl 
                        inner join produit_deb as p on dis.id_produit=p.id
                        inner join client as cli on dis.id_client=cli.id
                        inner join mangasin as mang on dis.id_mangasin=mang.id
                       
                        
                        
                        where dis.id_navire=?   order by dis.n_bl ");
        $client->bindParam(1,$navire);
        $client->execute();

        

         $somme = $bdd->prepare("SELECT tr.*,dis.*, sum(dis.poids_t), sum(tr.poids_declarer)  from dispatching as dis
                        inner join transit as tr on dis.id_navire=tr.id_trans_navire and dis.id_dis=tr.id_bl 

                        where dis.id_navire=?  ");
        $somme->bindParam(1,$navire);
       
        
        $somme->execute();

        $client2 = $bdd->prepare("SELECT tr.id_trans, p.id, cli.id, mang.id, dis.id_navire, dis.id_dis, dis.n_bl, sum(tr.poids_declarer), dis.poids_t from dispatching as dis inner join transit as tr on dis.id_dis=tr.id_bl inner join produit_deb as p on dis.id_produit=p.id inner join client as cli on dis.id_client=cli.id inner join mangasin as mang on dis.id_mangasin=mang.id where dis.id_navire=? group by dis.id_dis  ");
        $client2->bindParam(1,$navire);
        $client2->execute();

        while($row2 = $client->fetch()){
           
          
      //$reste=$row2['poids_t']-$cal['sum(tr.poids_declarer)'];
            ?>
            <tr style="text-align:center; font-size:12px; background: white; " border='5' id=<?php echo $row2['id_trans'] ?>>
            
             <td id="<?php echo $row2['id_trans'].'bl_transitvrac' ?>" class="colcel"><?php echo $row2['n_bl']; ?></td> 
              <span style="display:none;" id="<?php echo $row2['id_trans'].'id_bl_transitvrac' ?>" class="colcel"><?php echo $row2['id_dis']; ?></span>
        <td id="<?php echo $row2['id_trans'].'produit_transitvrac' ?>" class="colcel"><?php echo $row2['produit']; ?> <?php echo $row2['qualite']; ?> <?php echo $row2['poids_kg'] ?> KGS</td>
        <span style="display:none;" id="<?php echo $row2['id_trans'].'id_produit_transitvrac' ?>" class="colcel"><?php echo $row2['id_produit']; ?></span>
         <span style="display:none;" id="<?php echo $row2['id_trans'].'navire_transvrac' ?>" class="colcel"><?php echo $row2['id_navire']; ?></span>
        <td class="colcel" style="color: red;"><?php echo number_format($row2['poids_t'], 3,',',' '); ?></td>
             <td class="colcel" id="<?php echo $row2['id_trans'].'statut_douanierevrac' ?>"  ><?php echo $row2['statut_douaniere']; ?> </td>

<td class="colcel" id="<?php echo $row2['id_trans'].'destination_douanierevrac' ?>"><?php echo $row2['destination_douaniere']; ?> </td>
               
            
                   
              <td class="colcel"  id="<?php echo $row2['id_trans'].'numero_declarationvrac' ?>" ><?php echo $row2['numero_declaration']; ?></td>
              <td id="<?php echo $row2['id_trans'].'poids_declarervrac' ?>" class="colcel"><?php echo number_format($row2['poids_declarer'], 3,',',' '); ?></td>
             
              <td  class="colcel"><?php echo $row2['mangasin']; ?></td>
              <td  class="colcel"><?php echo $row2['client']; ?></td>
              
        <td class="colcel" >
          <div style="display: flex; justify-content: center;">
          <a  id="<?php echo $row2['id_dis'] ?>" name="deletedis" type="submit"  class="btn btn-text-danger" onclick="deleteTransit(<?php echo $row2['id_trans'] ?>)" style="display: flex; justify-content: center; color:rgb(0,141,202);  display: flex; justify-content: center;"> <i class="fa fa-trash " ></i> </a>
     <a class="btn"   href="#" data-role="update_transitvrac" data-id="<?php echo  $row2['id_trans']; ?>"   id="btnbtn" style="border: none;  color:rgb(0,141,202); display: flex; justify-content: center;"> <i class="fa fa-edit" ></i></a>
     <a class="fabtn1" href="insertion_fichier_transit.php?id=<?php echo $row2['id_trans'] ?>" style="display: flex; justify-content: center; " target="blank"  name="modify"         id="btnbtn" >  <i class="fa fa-folder"  ></i></a>
    </td>    
                             

</tr>

<?php } ?>
<tr>
  <td colspan="10" style="text-align: center;">RESTE A DECLARER</td>
  </tr>
  <tr>
  <td colspan="5" style="text-align: center;">NUMERO BL</td>
  <td colspan="5" style="text-align: center;">RESTE A DECLARER</td>
</tr>
<?php while ($rest=$client2->fetch()) { 
$restant=$rest['poids_t']-$rest['sum(tr.poids_declarer)']; ?>
<tr>
<td style="text-align: center;"  class="colcel" colspan="5" class="colcel"><?php echo $rest['n_bl']; ?></td>
<td style="text-align: center;"  class="colcel" colspan="5" class="colcel"><?php echo  number_format($restant, 3,',',' '); ?></td>
</tr>
<?php } ?>



<?php while($total=$somme->fetch()){ 
  $restant=$total['sum(dis.poids_t)']-$total['sum(tr.poids_declarer)']  ?>

 <tr style="text-align:center; font-size: 12px;" border='5'>
  <td style=" font-size: 12px;" id="total" colspan="2"> TOTAL </td>
  <td style=" font-size: 12px;" id="total"><?php echo number_format($total['sum(dis.poids_t)'], 3,',',' '); ?> </td> 
  <td style=" font-size: 12px;" id="total" colspan="2">  </td> 
 <td style=" font-size: 12px;" id="total"><?php echo number_format($total['sum(tr.poids_declarer)'], 3,',',' '); ?> </td>
  <td style=" font-size: 12px;" id="total"><?php echo  number_format($restant, 3,',',' '); ?> </td>
  <td style=" font-size: 12px;" id="total" colspan="2">  </td>
  <td style=" font-size: 12px;" id="total" >  </td>

</tr>
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
   <button  style="margin:auto-right;" class="btn btn-primary" onClick="imprimertransit('partransit')">imprimer</button></div>
</div>



	<?php  

}

 ?>