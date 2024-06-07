<?php 

function afficher_produit($bdd){

$produit=$bdd->query("select * from produit_deb ");
	return $produit;
}

function calculLigne($bdd,$id){

	  $calculLigne=$bdd->prepare("select count(produit) from produit_deb where id<=?");
      $calculLigne->bindParam(1,$id);
      $calculLigne->execute();
      return $calculLigne;
  }

  function affichage_produit($bdd){
   $produit=	afficher_produit($bdd);
   while($produits=$produit->fetch()){
   	$id=$produits['id'];

     $calculLigne=	calculLigne($bdd,$id);
     $calculLignes=$calculLigne->fetch(); ?>

  <tr  class="cellule_variete" border='2' id="<?php echo $row['id'].'delproduit' ?>">
                            <td ><span style="color: red; margin-left: 0px; " > <?php echo  $calculLignes['count(produit)']; ?></span> </td>
       
                                 <td id="<?php echo $produits['id'].'newproduit' ?>"  > <?php echo $produits['produit']; ?> </td>
                                 <td id="<?php echo $produits['id'].'qualite' ?>" > <?php echo $produits['qualite']; ?> </td>
                                 
                                 
                                 <td  >
                            <button id="<?php echo $produits['id'] ?>" name="deleteprod" type="submit"  class="fabtn1 " onclick="deleteNewProduit(<?php echo $produits['id'] ?>)" > <i class="fa fa-trash  " ></i> </button>
                            <a class="fabtn" type="" name="modify" href="#" data-role="update_newproduit" data-id="<?php echo $produits['id']; ?>"       id="btnbtn" > <i class="fa fa-edit " ></i></a></td>    
                              </tr>
     <?php  

   }
  }

 ?>

