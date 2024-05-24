<?php require('../database.php');
if(isset($_POST['id'])){

	$id=$_POST['id'];
	$affreteur=$_POST['affreteur'];
	
	$adresse=$_POST['adresse'];
	$tel=$_POST['tel'];
	$email=$_POST['email'];
	$update=$bdd->prepare("UPDATE affreteur set affreteur=?, adresse_affreteur=?, tel_affreteur=?, email_affreteur=? where id=? ");
	$update->bindParam(1,$affreteur);
	
	$update->bindParam(2,$adresse);
	$update->bindParam(3,$tel);
	$update->bindParam(4,$email);
	$update->bindParam(5,$id);
	$update->execute();

	?>

<div  id="calAffreteur" class="col-md-12" >
  <?php $affreteur=$bdd->query('select * from affreteur '); ?>
  <div class="card">
    <div class="card-header">
      <center>
        <h1 style="background: linear-gradient(to bottom, blue, #1B2B65); background: linear-gradient(to left, blue, #1B2B65); background: linear-gradient(to top, blue, #1B2B65);" class="htransporteur text-white" >MES FOURNISSEURS</h1>
          </div>
          <center>
            <div class="card-body"> 
               <div class="table-responsive" border=1> 
                <center>
                 <table class='table table-hover table-bordered table-striped'  border='5' style="border-color: black; width: 500px;" >
                   <thead> 
                     <tr style="color:white; font-weight: bold; background: linear-gradient(to bottom, blue, #1B2B65); background: linear-gradient(to left, blue, #1B2B65); background: linear-gradient(to top, blue, #1B2B65); font-family: montserrat; border-color: white; text-align: center;" border='5'  >
                      <th style="border-color:white;" scope="col" ></th>
                        <th style="border-color:white;" scope="col" >FOURNISSEURS</th>
                        
                        <th style="border-color:white;" scope="col" >ADRESSES</th>
                        <th style="border-color:white;" scope="col" >TELEPHONES</th>
                        <th style="border-color:white;" scope="col" >EMAIL</th>
                        <th style="border-color:white;" scope="col" >ACTIONS</th>
                         
                                 </tr>
                                  </thead>
                                   <tbody style="font-weight: bold;">
                                    <?php 
                                    while($row = $affreteur->fetch()){
              $calculLigne=$bdd->prepare("select count(affreteur) from affreteur where id<=?");
      $calculLigne->bindParam(1,$row['id']);
      $calculLigne->execute();
      $cal=$calculLigne->fetch(); 

                
                                     ?>
                          <tr style="text-align:center;" border='5' id="<?php echo $row['id'] ?>">
                            <td style="vertical-align: middle;" ><span style="color: red; margin-left: 0px; " > <?php echo  $cal['count(affreteur)']; ?></span> </td>
                                 <td id="<?php echo $row['id'].'affreteur' ?>" style="vertical-align: middle;" ><?php echo $row['affreteur']; ?></td>
                                 
                                   <td id="<?php echo $row['id'].'adresse_aff' ?>" style="vertical-align: middle;" ><?php echo $row['adresse_affreteur']; ?></td>
                                    <td id="<?php echo $row['id'].'tel_aff' ?>" style="vertical-align: middle;" ><?php echo $row['tel_affreteur']; ?></td>
                                     <td id="<?php echo $row['id'].'email_aff' ?>" style="vertical-align: middle;" ><?php echo $row['email_affreteur']; ?></td>

                                        <td style="vertical-align: middle;"  >
              <div style="display: flex; justify-content: center;">                     
                            <a style="float:left;"  id="<?php echo $row['id'] ?>" name="deleteMg"   class="fabtn1 " onclick="deleteAffreteur(<?php echo $row['id'] ?>)" > <i class="fa fa-trash  " ></i> </a>
                            <a style="display: flex; justify-content: center; float:right;"  class="fabtn1" type=""  href="#" data-role="update_affreteur" data-id="<?php echo $row['id']; ?>"       id="btnbtn" > <i class="fa fa-edit " ></i></a>
 </a>

</td>           
                              </tr>
                      <?php } ?>  
                    </tbody>
                 </table>
                 </center>
             </div>
          </div>
          </center>
     </div>

  </div>


<?php } ?>

 
