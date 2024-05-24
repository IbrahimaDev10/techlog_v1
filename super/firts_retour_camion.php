<?php 	

require('../database.php');

	echo $_POST['id'];
  echo $_POST['id_inter'];
	$id=$_POST['id'];
  $id_inter=$_POST['id_inter'];
	

$rowcamion=$bdd->prepare('SELECT c.*, tr.* 
FROM camions as c 
LEFT JOIN transporteur as tr ON c.id_trans = tr.id 
 
where c.num_camions<? and c.num_camions>=?  ORDER BY c.num_camions ASC LIMIT 30');

$rowcamion->bindParam(1,$id);
$rowcamion->bindParam(2,$id_inter);

$rowcamion->execute();

$bouton_rowcamion=$bdd->prepare('SELECT num_camions FROM camions
where num_camions<? and num_camions>=?  
 
ORDER BY num_camions ASC LIMIT 30
 
');
$bouton_rowcamion->bindParam(1,$id);
$bouton_rowcamion->bindParam(2,$id_inter);

$bouton_rowcamion->execute();
	

 ?>




 <div id="calcam"  class="col-md-12" id="calchauffeur" >
  <div class="card"   >
    <div class="card-header">
    	<?php $compteur=0; 
    	while($bouton_next=$bouton_rowcamion->fetch()){
    		$compteur=$compteur+1;
    		
    	        if($compteur==30){ ?>
    	 <a class="fas fa-arrow-left" data-role="first_retour"  >RETOUR<span id="id_compteur2" style="display: none;"><?php echo $bouton_next['num_camions']; ?></span> </a>       	
    	<a class="fas fa-arrow-right" data-role="first_suivant"  >SUIVANT<span id="id_compteur" style="display: none;"><?php echo $bouton_next['num_camions']; ?></span> </a>

    <?php 	} } ?>

      <center>
        
          </div>
            <div class="card-body"> 
               <div class="table-responsive" border=1
               style=" width:100%;" 
               > 
                 <table class='table table-hover table-bordered table-striped'  border='5'  style="  border-color: black;" >
                   <thead> 
                   	<tr class="titrecamion">	
                   	<td colspan="4"  >MES CAMIONS</td>
                   	</tr>
                     <tr style=" background: linear-gradient(to bottom, blue, #1B2B65); background: linear-gradient(to left, blue, #1B2B65); background: linear-gradient(to top, blue, #1B2B65); color:white; font-weight: bold; font-family: montserrat; border-color: white; text-align: center;" border='5' >
                     	<th style="border-color:white;" scope="col"> </th>
                     	<th style="border-color:white;" scope="col" >N° CAMION</th>
                     	 <th style="border-color:white;" scope="col" >TRASPORTEURS</th>
                     	  <th style="border-color:white;" scope="col" >ACTIONS</th>
                       
                                                            </tr>
                                  </thead>
                                   <tbody style="font-weight: bold;">
                                    <?php 
               while($row = $rowcamion->fetch()){

                       $calculLigne=$bdd->prepare("select count(num_camions) from camions where num_camions<=? order by num_camions asc");
      $calculLigne->bindParam(1,$row['num_camions']);
      $calculLigne->execute();
      $cal=$calculLigne->fetch();              	
                                     ?>
                          <tr style="text-align:center;" border='5' id="<?php echo $row['id_camions'].'delcamion' ?>">
                          	<td ><span style="color: red; margin-left: 0px; " >	<?php echo  $cal['count(num_camions)']; ?> </span> </td>
                                 <td id="<?php echo $row['id_camions'].'camions' ?>"> <?php echo $row['num_camions']; ?></td>
                               
                              <td id="<?php echo $row['id_camions'].'trnom' ?>"> <?php echo $row['nom'] ?> </td><span style="display: none;" id="<?php echo $row['id_camions'].'trcamion' ?>"><?php echo $row['id'] ?></span>
                           
                          
                          <td  >
  <a id="<?php echo $row['id_camions'] ?>" name="deletecam"   class="fabtn1 " onclick="deleteCamion(<?php echo $row['id_camions'] ?>)" > <i class="fa fa-trash  " ></i> </a>
                          	<a class="fabtn"   name="modify"   data-role="update_camion"   data-id="<?php echo $row['id_camions']; ?>"    id="btnbtn" > <i class="fa fa-edit " ></i></a></td>
                        </tr>
                      <?php } ?>	
                    </tbody>
                 </table>
             </div>
          </div>
     </div>
  </div>
