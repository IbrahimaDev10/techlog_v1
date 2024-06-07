<?php 

function afficher_camion($bdd){

$camion=$bdd->query('SELECT c.*, tr.* 
FROM camions as c 
LEFT JOIN transporteur as tr ON c.id_trans = tr.id 
 
ORDER BY c.num_camions ');
	return $camion;
}

function calculLigne($bdd,$id){

	  $calculLigne=$bdd->prepare("select count(num_camions) from camions where num_camions<=? order by num_camions asc");
      $calculLigne->bindParam(1,$id);
      $calculLigne->execute();
      return $calculLigne;
  }

  function affichage_camion($bdd){
   $camion=	afficher_camion($bdd);
   while($camions=$camion->fetch()){
   	$id=$camions['id_camions'];

     $calculLigne=	calculLigne($bdd,$id);
     $calculLignes=$calculLigne->fetch(); ?>

  <tr style="text-align:center;" border='5' id="<?php echo $camions['id_camions'].'delcamion' ?>">
                            <td  ><span style="color: red; margin-left: 0px; " > <?php echo  $calculLignes['count(num_camions)']; ?> </span> </td>
                                 <td id="<?php echo $camions['id_camions'].'camions' ?>"><?php echo $camions['num_camions']; ?></td>
                               
                              <td id="<?php echo $camions['id_camions'].'trnom' ?>"><?php echo $camions['nom'] ?></td><span style="display: none;" id="<?php echo $camions['id_camions'].'trcamion' ?>"><?php echo $camions['id'] ?></span>
                           
                          
                          <td  >
  <a id="<?php echo $camions['id_camions'] ?>" name="deletecam"   class="fabtn1 " onclick="deleteCamion(<?php echo $camions['id_camions'] ?>)" > <i class="fa fa-trash  " ></i> </a>
                            <a class="fabtn"   name="modify"   data-role="update_camion"   data-id="<?php echo $camions['id_camions']; ?>"    id="btnbtn" > <i class="fa fa-edit " ></i></a></td>
                        </tr>
     <?php  

   }
  }

 ?>

