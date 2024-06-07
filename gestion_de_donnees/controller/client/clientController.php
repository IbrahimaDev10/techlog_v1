<?php 

function afficher_client($bdd){

	$client=$bdd->query("select * from client ");
	return $client;
}

function calculLigne($bdd,$id){

	 $calculLigne=$bdd->prepare("select count(client) from client where id<=? ");
      $calculLigne->bindParam(1,$id);
      $calculLigne->execute();
      return $calculLigne;
  }

  function affichage_client($bdd){
   $client=	afficher_client($bdd);
   while($clients=$client->fetch()){
   	$id=$clients['id'];

     $calculLigne=	calculLigne($bdd,$id);
     $calculLignes=$calculLigne->fetch(); ?>

          <tr id="<?php echo $clients['id'].'delclient' ?>" style="text-align:center;" border='5' >
                            <td ><span style="color: red; margin-left: 0px; " > <?php echo  $calculLignes['count(client)']; ?></span> </td>
                            <td  id="<?php echo $clients['id'].'client' ?>"  style="vertical-align: middle;" data_target="clientp" >  <?php echo  $clients['client']; ?> </td>
                            
                             
                            
                            <td style=" vertical-align: middle;" >
                              <?php 
                             ?> 
                              <?php //while($cl=$cli->fetch()){  echo  $cl['nom_categories'];?> <br><br>  <?php //} ?> <span style="background: red;color: white;"><?php  
                              echo "TOTAL";
                           ?> </span>   </td>
                            
                            <td style=" vertical-align: middle;" id="colRouge"> <?php //while($clTonne=$calculTonne->fetch()){  echo number_format($clTonne['sum(dis.quantite_poids)'], 3,',',' '). ' T <br><br>'; } ?> 
                              <?php  //echo  number_format($total['sum(dis.quantite_poids)'], 3,',',' ');
                           ?>  T </td>
                <td id="<?php echo $clients['id'].'code' ?>" style="vertical-align: middle;">   <?php echo  $clients['code_ppm_client']; ?> </td>
                 <td id="<?php echo $clients['id'].'adresse' ?>" style="vertical-align: middle;">   <?php echo  $clients['adresse_client']; ?> </td>
                  <td id="<?php echo $clients['id'].'tel' ?>" style="vertical-align: middle;">  <?php echo  $clients['tel_client']; ?> </td>
                   <td id="<?php echo $clients['id'].'email' ?>" style="vertical-align: middle;">   <?php echo  $clients['email_client']; ?> </td>



                          <td>
                            <button  id="<?php echo $clients['id'] ?>" name="deletecli" type="submit"  class="fabtn1 " onclick="deleteClient(<?php echo $clients['id'] ?>)" > <i class="fa fa-trash  " ></i> </button>
                            <a class="fabtn" href="#" data-role="update_cli" data-id="<?php echo $clients['id']; ?>"       id="btnbtn" > <i class="fa fa-edit " ></i></a>
     </td>         
                              </tr>
     <?php  

   }
  }

 ?>

