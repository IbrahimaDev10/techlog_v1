<?php require('../database.php');
if(isset($_POST['id'])){

	$id=$_POST['id'];
	$chauffeur=$_POST['chauffeur'];
  $permis=$_POST['permis'];
  $tel=$_POST['tel'];
	

	$update=$bdd->prepare("UPDATE chauffeur set nom_chauffeur=?, n_permis=?, num_telephone=? where id_chauffeur=? ");
	$update->bindParam(1,$chauffeur);
	$update->bindParam(2,$permis);
  $update->bindParam(3,$tel);
  $update->bindParam(4,$id);
	$update->execute();

	?>

<div   class="col-md-12" id="calchauffeur" >
  <?php $rowchauffeur=$bdd->query("select * from chauffeur "); ?>
  <div class="card"   >
    <div class="card-header">
      <center>
        <h1 style="background: linear-gradient(to bottom, blue, #1B2B65); background: linear-gradient(to left, blue, #1B2B65); background: linear-gradient(to top, blue, #1B2B65);" class="hnavire text-white" >MES CHAUFFEURS</h1>
          </div>
            <div class="card-body"> 
               <div class="table-responsive" border=1
               style=" width:100%;" 
               > 
                 <table class='table table-hover table-bordered table-striped'  border='5'  style="  border-color: black;" >
                   <thead> 
                     <tr style=" background: linear-gradient(to bottom, blue, #1B2B65); background: linear-gradient(to left, blue, #1B2B65); background: linear-gradient(to top, blue, #1B2B65); color:white; font-weight: bold; font-family: montserrat; border-color: white; text-align: center;" border='5' >
                      <th style="border-color:white;" scope="col" >N°</th>
                       <th style="border-color:white;" scope="col" >CHAUFFEURS</th>
                       
                           <th style="border-color:white;" scope="col" > N° PERMIS</th>
                             <th style="border-color:white;" scope="col" >N° TELEPHONE</th>
                          
                               <th style="border-color:white;" scope="col" > ACTIONS  </th>
                                 </tr>
                                  </thead>
                                   <tbody style="font-weight: bold;">
                                    <?php 
               while($row = $rowchauffeur->fetch()){
$chauffeur=str_replace("_", " ",$row['nom_chauffeur']);

$permis=str_replace("_", " ",$row['n_permis']);
$tel=str_replace("_", " ",$row['num_telephone']);


                       $calculLigne=$bdd->prepare("select count(id_chauffeur) from chauffeur where id_chauffeur<=?");
      $calculLigne->bindParam(1,$row['id_chauffeur']);
      $calculLigne->execute();
      $cal=$calculLigne->fetch();               
                                     ?>
                          <tr style="text-align:center;" border='5' id="<?php echo $row['id_chauffeur'] ?>">
                            <td ><span style="color: red; margin-left: 0px; " > <?php echo  $cal['count(id_chauffeur)']; ?></span> </td>
                                 <td id="<?php echo $row['id_chauffeur'].'chauffeur' ?>" ><?php echo $chauffeur; ?></td>
                               
                              <td id="<?php echo $row['id_chauffeur'].'permis' ?>" ><?php echo $permis; ?> </td>
                            <td id="<?php echo $row['id_chauffeur'].'tel_chauffeur' ?>" ><?php echo $tel ?> </td>
                          
                          <td  >
  <button id="<?php echo $row['id_chauffeur'] ?>" name="deletechauf" type="submit"  class="fabtn1 " onclick="deleteChauffeur(<?php echo $row['id_chauffeur'] ?>)" > <i class="fa fa-trash  " ></i> </button>
                            <a class="fabtn"  type="" name="modify"   data-role="update_chauffeur"   data-id="<?php echo $row['id_chauffeur']; ?>"       id="btnbtn" s> <i class="fa fa-edit " ></i></a></td>
                        </tr>
                      <?php } ?>  
                    </tbody>
                 </table>
             </div>
          </div>
     </div>
  </div>


<?php } ?>

 
