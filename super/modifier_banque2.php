<?php require('../database.php');
if(isset($_POST['id'])){

	$id=$_POST['id'];
	$banque=$_POST['banque'];
	
	$adresse=$_POST['adresse'];
	$tel=$_POST['tel'];
	$email=$_POST['email'];
	$update=$bdd->prepare("UPDATE banque set banque=?, adresse_banque=?, tel_banque=?, email_banque=? where id=? ");
	$update->bindParam(1,$banque);
	
	$update->bindParam(2,$adresse);
	$update->bindParam(3,$tel);
	$update->bindParam(4,$email);
	$update->bindParam(5,$id);
	$update->execute();

	?>

<div  id="calBanque" class="col-md-12" >
  <?php $banque=$bdd->query('select * from banque '); ?>
  <div class="card">
    <div class="card-header">
      <center>
        <h1 style="background: linear-gradient(to bottom, blue, #1B2B65); background: linear-gradient(to left, blue, #1B2B65); background: linear-gradient(to top, blue, #1B2B65);" class="htransporteur text-white" >MES BANQUES</h1>
          </div>
          <center>
            <div class="card-body"> 
               <div class="table-responsive" border=1> 
                <center>
                 <table class='table table-hover table-bordered table-striped'  border='5' style="border-color: black; width: 500px;" >
                   <thead> 
                     <tr style="color:white; font-weight: bold; background: linear-gradient(to bottom, blue, #1B2B65); background: linear-gradient(to left, blue, #1B2B65); background: linear-gradient(to top, blue, #1B2B65); font-family: montserrat; border-color: white; text-align: center;" border='5'  >
                      <th style="border-color:white; " scope="col" ></th>
                        <th style="border-color:white;" scope="col" >BANQUE</th>
                        
                        <th style="border-color:white;" scope="col" >ADRESSE</th>
                        <th style="border-color:white;" scope="col" >TELEPHONE</th>
                        <th style="border-color:white;" scope="col" >EMAIL</th>
                        <th style="border-color:white;" scope="col" >ACTIONS</th>
                         
                                 </tr>
                                  </thead>
                                   <tbody style="font-weight: bold;">
                                    <?php 
                                    while($row = $banque->fetch()){
              $calculLigne=$bdd->prepare("select count(banque) from banque where id<=?");
      $calculLigne->bindParam(1,$row['id']);
      $calculLigne->execute();
      $cal=$calculLigne->fetch(); 

                
                                     ?>
                          <tr style="text-align:center;" border='5' id="<?php echo $row['id'] ?>">
                            <td style="vertical-align: middle;" ><span style="color: red; margin-left: 0px; " > <?php echo  $cal['count(banque)']; ?></span> </td>
                                 <td id="<?php echo $row['id'].'banque' ?>" style="vertical-align: middle;" ><?php echo $row['banque']; ?></td>
                                 
                                   <td id="<?php echo $row['id'].'adresse_banque' ?>" style="vertical-align: middle;" ><?php echo $row['adresse_banque']; ?></td>
                                    <td id="<?php echo $row['id'].'tel_banque' ?>" style="vertical-align: middle;" ><?php echo $row['tel_banque']; ?></td>
                                     <td id="<?php echo $row['id'].'email_banque' ?>" style="vertical-align: middle;" ><?php echo $row['email_banque']; ?></td>

                                        <td style="vertical-align: middle;"  >
              <div style="display: flex; justify-content: center;">                     
                            <a style="float:left;"  id="<?php echo $row['id'] ?>" name="deleteMg"  class="fabtn1 " onclick="deleteBanque(<?php echo $row['id'] ?>)" > <i class="fa fa-trash  " ></i> </a>
                            <a style="display: flex; justify-content: center; float:right;"  class="fabtn1" type=""   href="#" data-role="update_banque" data-id="<?php echo $row['id']; ?>"       id="btnbtn" > <i class="fa fa-edit " ></i></a>
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

 
