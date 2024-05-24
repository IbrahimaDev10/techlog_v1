<?php require('../database.php');
if(isset($_POST['id'])){

	$id=$_POST['id'];
	$transporteur=$_POST['transporteur'];
	

	$update=$bdd->prepare("UPDATE transporteur set nom=? where id=? ");
	$update->bindParam(1,$transporteur);
	$update->bindParam(2,$id);
	$update->execute();

	?>

<div  id="caltransporteur" class="col-md-12" >
  <?php $LesTransporteurs=$bdd->query("select * from transporteur "); ?>
  <div class="card">
    <div class="card-header">
      <center>
        <h1 style="background: linear-gradient(to bottom, blue, #1B2B65); background: linear-gradient(to left, blue, #1B2B65); background: linear-gradient(to top, blue, #1B2B65);" class="htransporteur text-white" >MES TRANSPORTEURS</h1>
          </div>
          <center>
            <div class="card-body"> 
               <div class="table-responsive" border=1> 
                <center>
                 <table class='table table-hover table-bordered table-striped'  border='5' style="border-color: black; width: 500px;" >
                   <thead> 
                     <tr style="color:white; font-weight: bold; background: linear-gradient(to bottom, blue, #1B2B65); background: linear-gradient(to left, blue, #1B2B65); background: linear-gradient(to top, blue, #1B2B65); font-family: montserrat; border-color: white; text-align: center;" border='5'  >
                      <th style="border-color:white;" scope="col" ></th>
                        <th style="border-color:white;" scope="col" >TRANSPORTEUR</th>
                        <th style="border-color:white;" scope="col" >NOMBRE DE CAMIONS</th>
                        <th style="border-color:white;" scope="col" >ACTIONS</th>
                         
                                 </tr>
                                  </thead>
                                   <tbody style="font-weight: bold;">
                                    <?php 
                                    while($row = $LesTransporteurs->fetch()){
              $calculLigne=$bdd->prepare("select count(nom) from transporteur where id<=?");
      $calculLigne->bindParam(1,$row['id']);
      $calculLigne->execute();
      $cal=$calculLigne->fetch(); 

      $calculTRP=$bdd->prepare("select count(id_camions) from camions where id_trans=?");
      $calculTRP->bindParam(1,$row['id']);
      $calculTRP->execute();
      $calTRP=$calculTRP->fetch();              
                                     ?>
                          <tr style="text-align:center;" border='5' id="<?php echo $row['id'] ?>">
                            <td ><span style="color: red; margin-left: 0px; " > <?php echo  $cal['count(nom)']; ?></span> </td>
                                 <td id="<?php echo $row['id'].'transporteur' ?>" ><?php echo $row['nom']; ?></td>
                                  <td ><?php echo $calTRP['count(id_camions)']; ?></td>

                               <td  >
                            <a  id="<?php echo $row['id'] ?>" name="deleteNavi"  class="fabtn1 " onclick="deleteTransp(<?php echo $row['id']; ?>);" > <i class="fa fa-trash  " ></i> </a>
                            <a class="fabtn" type="" href="#" data-role="update_transporteur"   data-id="<?php echo $row['id']; ?>"    id="btnbtn" > <i class="fa fa-edit " ></i></a></td>          
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

 
