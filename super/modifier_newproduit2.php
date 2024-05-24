<?php require('../database.php');
if(isset($_POST['id'])){

	$id=$_POST['id'];
	$produit=$_POST['produit'];
	
	$qualite=$_POST['qualite'];
	
	$update=$bdd->prepare("UPDATE produit_deb set produit=?, qualite=? where id=? ");
	$update->bindParam(1,$produit);
	
	$update->bindParam(2,$qualite);
	$update->bindParam(3,$id);
	$update->execute();

	?>

<div  id="calnewproduits" class="col-md-12" >
  <?php $LesnewProduits=$bdd->query("select * from produit_deb "); ?>
  <div class="card">
    <div class="card-header">
      <center>
        <h1 style="color: white; background:  rgb(0,141,202);" >MES PRODUITS</h1>
         
          </div>
            <div class="card-body"> 
               <div class="table-responsive" border=1> 
                
                 <table class='table table-hover table-bordered table-striped'  border='5' style="border-color: black;" >
                   <thead> 
                     <tr style="color:white; font-weight: bold; background: rgb(0,141,202);  border-color: white; text-align: center;" border='5' >
                      <th style="border-color:white; vertical-align: middle;" scope="col" > </th>
                        <th style="border-color:white; vertical-align: middle;" scope="col" >PRODUIT</th>
                         
                        <th style="border-color:white; vertical-align: middle;" scope="col" >QUALITE</th>
                        

                        <th style="border-color:white; vertical-align: middle;" scope="col" > ACTIONS  </th>

                         
                                 </tr>
                                  </thead>
                                   <tbody style="font-weight: bold;">
                                    <?php 
                                    while($row = $LesnewProduits->fetch()){

                            $calculLigne=$bdd->prepare("select count(produit) from produit_deb where id<=?");
      $calculLigne->bindParam(1,$row['id']);
      $calculLigne->execute();
      $cal=$calculLigne->fetch();

      
                
                                     ?>
                          <tr  style="text-align:center;" border='5' id="<?php echo $row['id'] ?>">
                            <td ><span style="color: red; margin-left: 0px; " > <?php echo  $cal['count(produit)']; ?></span> </td>
       
                                 <td id="<?php echo $row['id'].'newproduit' ?>"  > <?php echo $row['produit']; ?> </td>
                                 <td id="<?php echo $row['id'].'qualite' ?>" > <?php echo $row['qualite']; ?> </td>
                                 
                                 
                                 <td  >
                            <button id="<?php echo $row['id'] ?>" name="deleteprod" type="submit"  class="fabtn1 " onclick="deleteProduit(<?php echo $row['id'] ?>)" > <i class="fa fa-trash  " ></i> </button>
                            <a class="fabtn" type="" name="modify" href="#" data-role="update_newproduit" data-id="<?php echo $row['id']; ?>"       id="btnbtn" > <i class="fa fa-edit " ></i></a></td>    
                              </tr>
                      <?php } ?>  
                    </tbody>
                 </table>
                 
             </div>
          </div>
     </div>
  </div>



<?php } ?>

 
