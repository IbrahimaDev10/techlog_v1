<?php 

function afficher_categories($bdd){

	$categories=$bdd->query("select * from categories ");
	return $categories;
}

function calculLigne($bdd,$id){

	 $calculLigne=$bdd->prepare("select count(nom_categories) from categories where id_categories<=?");
      $calculLigne->bindParam(1,$id);
      $calculLigne->execute();
      return $calculLigne;
  }

  function affichage_categories($bdd){
   $categories=	afficher_categories($bdd);
   while($categoriess=$categories->fetch()){
   	$id=$categoriess['id_categories'];

     $calculLigne=	calculLigne($bdd,$id);
     $calculLignes=$calculLigne->fetch(); ?>

 <tr  style="text-align:center;" border='5' id="<?php echo $categoriess['id_categories'].'delcategories' ?>">
                          	<td ><span style="color: red; margin-left: 0px; " >	<?php echo  $calculLignes['count(nom_categories)']; ?></span> </td>
       
                                 <td id="<?php echo $categoriess['id_categories'].'categorie' ?>" > <?php echo $categoriess['nom_categories']; ?> </td>
                                 
                                 
                                 <td id="<?php echo $categoriess['id_categories'].'taxe' ?>" ><span id="colRouge"><?php echo $categoriess['taxe_port']; ?> </span></td> 
                                 <td  >
                          	<button  id="<?php echo $row['id_categories'] ?>" name="deleteprod" type="submit"  class="fabtn1 " onclick="deleteProduit(<?php echo $categoriess['id_categories'] ?>)" > <i class="fa fa-trash  " ></i> </button>
                          	<a class="fabtn" type="" name="modify" href="#" data-role="update_categorie" data-id="<?php echo $categoriess['id_categories']; ?>"     id="btnbtn" > <i class="fa fa-edit " ></i></a></td>    
                              </tr>
     <?php  

   }
  }

 ?>

