<?php require('../database.php');
if(isset($_POST['id'])){

	$id=$_POST['id'];
	$camion=$_POST['camion'];
  $noms=$_POST['noms'];

	

	$update=$bdd->prepare("UPDATE camions set num_camions=?, id_trans=? where id_camions=? ");
	$update->bindParam(1,$camion);
	$update->bindParam(2,$noms);
  $update->bindParam(3,$id);
	$update->execute();

	?>


  <?php $rowcamion=$bdd->query('select c.*,tr.* from camions as c left join transporteur as tr on c.id_trans=tr.id order by c.num_camions asc');   ?>

                                   <tbody style="font-weight: bold;" >
                                    <?php 
               while($row = $rowcamion->fetch()){

                       $calculLigne=$bdd->prepare("select count(num_camions) from camions where num_camions<=? order by num_camions asc");
      $calculLigne->bindParam(1,$row['num_camions']);
      $calculLigne->execute();
      $cal=$calculLigne->fetch();               
                                     ?>
                          <tr style="text-align:center;" border='5' id="<?php echo $row['id_camions'] ?>">
                            <td ><span style="color: red; margin-left: 0px; " > <?php echo  $cal['count(num_camions)']; ?></span> </td>
                                  <td id="<?php echo $row['id_camions'].'camions' ?>"> <?php echo $row['num_camions']; ?></td>
                               
                              <td id="<?php echo $row['id_camions'].'trnom' ?>"> <?php echo $row['nom'] ?> </td><span style="display: none;" id="<?php echo $row['id_camions'].'trcamion' ?>"><?php echo $row['id'] ?></span> </td>
                           
                          
                          <td  >
  <a id="<?php echo $row['id_camions'] ?>" name="deletecam"   class="fabtn1 " onclick="deleteChauffeur(<?php echo $row['id_camions'] ?>)" > <i class="fa fa-trash  " ></i> </a>
                            <a class="fabtn"  type="" name="modify"   data-role="update_camion"   data-id="<?php echo $row['id_camions']; ?>"       id="btnbtn" > <i class="fa fa-edit " ></i></a></td>
                        </tr>
                      <?php } ?>  
                    </tbody>



<?php } ?>

 
