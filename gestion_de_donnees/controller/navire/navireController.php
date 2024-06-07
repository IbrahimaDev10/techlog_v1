<?php 	

function afficher_navire($bdd){
	$navire=$bdd->query('SELECT * from navire_deb');
	return $navire;
}


function calculLigne($bdd,$id){
	$calculLigne=$bdd->prepare("select count(navire) from navire_deb where id<=?");
      $calculLigne->bindParam(1,$id);
      $calculLigne->execute();
      return $calculLigne;
}

function produit_navire($bdd,$id){
	      $produit_navire = $bdd->prepare("SELECT  n.*, p.*,c.* from navire_deb as n
left join produit_manifest as p on n.id=p.id_navire
left join categories as c on c.id_categories=p.produit_navire where n.id=? ");
       $produit_navire->bindParam(1,$id);
       $produit_navire->execute();
       return $produit_navire;
}


function affichage_navire($bdd){
	$navire=afficher_navire($bdd);
	while($navires=$navire->fetch()){
		$id=$navires['id'];

		$calculLigne=calculLigne($bdd,$id);
		$calculLignes=$calculLigne->fetch();


		 ?>
		 <tr   id="<?php echo $row['id'] ?>" style='text-align: center; vertical-align: middle;'>
                          	<td ><span style="color: red; margin-left: 0px; " >	<?php echo  $calculLignes['count(navire)']; ?></span> </td>
                         <td id="<?php echo $navires['id'].'navire' ?>" > <?php echo  $navires['navire']?> </td>
                                
                              <td id="<?php echo $navires['id'].'etb' ?>" ><?php //echo $b[2].'-'.$b[1].'-'.$b[0]; ?> </td>
                             
                            <td  ><?php	$produit_navire=produit_navire($bdd,$id);
		                      $produit_navires=$produit_navire->fetch(); echo $produit_navires['nom_categories']; ?>: <span style="color: red;"> <?php echo number_format($produit_navires['poids_manifest'], 3,',',' ');  ?>T</span><br>  </td> 
                          
                         <td id="<?php echo $navires['id'].'affreteur_nav' ?>"> <?php echo $navires['chatered']; ?></td>
                      	 <td id="<?php echo $navires['id'].'client_nav' ?>"> <?php echo $navires['client_navire']; ?></td>
                      	 <td>
                          <div style="display: flex; justify-content: center;">
                           
                             <a data-role='afficher_form_poids_manifeste' data-id='<?php echo $navires['id']; ?>' title='AJOUTER POIDS MANIFESTE'><i class="fas fa-add"></i></a>
                              <a data-role='modifier_navire' data-id='<?php echo $navires['id']; ?>' ><i class="fas fa-edit"></i></a>
                          </div> 
                         </td>
                            </tr>



<?php 		
	}

}

 ?>