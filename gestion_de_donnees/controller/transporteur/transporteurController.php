<?php 

function afficher_transporteur($bdd){

$transporteur=$bdd->query("select * from transporteur ");
	return $transporteur;
}

function calculLigne($bdd,$id){

	$calculLigne=$bdd->prepare("select count(nom) from transporteur where id<=?");
      $calculLigne->bindParam(1,$id);
      $calculLigne->execute();
      return $calculLigne;
  }

  function calcul_camion($bdd,$id){
    $calcul_camion=$bdd->prepare("select count(id_camions) from camions where id_trans=?");
         $calcul_camion->bindParam(1,$id);
      $calcul_camion->execute();
      return $calcul_camion;

  }

  function affichage_transporteur($bdd){
   $transporteur=	afficher_transporteur($bdd);
   while($transporteurs=$transporteur->fetch()){
   	$id=$transporteurs['id'];

     $calculLigne=	calculLigne($bdd,$id);
     $calculLignes=$calculLigne->fetch();

          $calcul_camion= calcul_camion($bdd,$id);
     $calcul_camions=$calcul_camion->fetch(); ?>

                       <tr style="text-align:center;" border='5' id="<?php echo $transporteurs['id'].'deltransporteur' ?>">
                            <td ><span style="color: red; margin-left: 0px; " > <?php echo  $calculLignes['count(nom)']; ?></span> </td>
                                 <td id="<?php echo $transporteurs['id'].'transporteur' ?>" ><?php echo $transporteurs['nom']; ?></td>
                                  <td ><?php echo $calcul_camions['count(id_camions)']; ?></td>

                                     
                              </tr>
     <?php  

   }
  }

 ?>

