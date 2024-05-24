<?php require('../database.php');
if(isset($_POST['id'])){

	$id=$_POST['id'];
	$categorie=$_POST['categorie'];
  $taxe=$_POST['taxe'];
 

	
	$update=$bdd->prepare("UPDATE categories set nom_categories=?,taxe_port=? where id_categories=? ");
	$update->bindParam(1,$categorie);
  $update->bindParam(2,$taxe);
	$update->bindParam(3,$id);
	
	$update->execute();

	?>

<div  id="calproduits" class="col-md-12" >
  <?php
      $anneeProduit=$bdd->query("SELECT YEAR(eta) as an
FROM navire_deb
GROUP BY YEAR(eta)");
   $LesProduits=$bdd->query("select * from categories "); ?>
  <div class="card">
    <div class="card-header">
      <center>
        <h1 style="color: white; background:  rgb(0,141,202);" >MES PRODUITS</h1>
          <form>
    <select name="dateproduit" id="dateproduit"  onchange="func_date_produit()">
      <option selected="">ANNEE</option>
      <?php while($annee=$anneeProduit->fetch()){ ?>
        <option value="<?php echo $annee['an']; ?>" ><?php echo $annee['an'];  ?></option>
      <?php } ?>
    </select>
        </center>

  </form>
          </div>
            <div class="card-body"> 
               <div class="table-responsive" border=1> 
                
                 <table class='table table-hover table-bordered table-striped'  border='5' style="border-color: black;" >
                   <thead> 
                     <tr style="color:white; font-weight: bold; background: rgb(0,141,202);  border-color: white; text-align: center;" border='5' >
                      <th style="border-color:white; vertical-align: middle;" scope="col" > </th>
                        <th style="border-color:white; vertical-align: middle;" scope="col" >PRODUIT</th>
                         
                        <th style="border-color:white; vertical-align: middle;" scope="col" >POIDS</th>
                        <th style="border-color:white; vertical-align: middle;" scope="col" >TAXE DE PORT</th>

                        <th style="border-color:white; vertical-align: middle;" scope="col" > ACTIONS  </th>

                         
                                 </tr>
                                  </thead>
                                   <tbody style="font-weight: bold;">
                                    <?php 
                                    while($row = $LesProduits->fetch()){

                            $calculLigne=$bdd->prepare("select count(nom_categories) from categories where id_categories<=?");
      $calculLigne->bindParam(1,$row['id_categories']);
      $calculLigne->execute();
      $cal=$calculLigne->fetch();

      $calculTonne=$bdd->prepare("select  sum(dis.poids_t),dis.id_produit, p.*, cat.* from categories as cat
        left join produit_deb as p on p.id_cat=cat.id_categories
        left join dispatching as dis on p.id=dis.id_produit
        
       
                          where cat.id_categories=? group by cat.id_categories  ");
      $calculTonne->bindParam(1,$row['id_categories']);
      $calculTonne->execute();
       $calT=$calculTonne->fetch();
                
                                     ?>
                          <tr  style="text-align:center;" border='5' id="<?php echo $row['id_categories'] ?>">
                            <td ><span style="color: red; margin-left: 0px; " > <?php echo  $cal['count(nom_categories)']; ?></span> </td>
       
                                 <td id="<?php echo $row['id_categories'].'categorie' ?>" > <?php echo $row['nom_categories']; ?> </td>
                                 
                                 <td><span id="colRouge"><?php if(!empty($calT['sum(dis.poids_t)'])){ echo number_format($calT['sum(dis.poids_t)'], 3,',',' '). ' T'; } ?> </span></td> 
                                 <td id="<?php echo $row['id_categories'].'taxe' ?>" ><span id="colRouge"><?php echo $calT['taxe_port']; ?> </span></td> 
                                 <td  >
                            <button  id="<?php echo $row['id_categories'] ?>" name="deleteprod" type="submit"  class="fabtn1 " onclick="deleteProduit(<?php echo $row['id_categories'] ?>)" > <i class="fa fa-trash  " ></i> </button>
                            <a class="fabtn" type="" name="modify" href="#" data-role="update_categorie" data-id="<?php echo $row['id_categories']; ?>"     id="btnbtn" > <i class="fa fa-edit " ></i></a></td>    
                              </tr>
                      <?php } ?>  
                    </tbody>
                 </table>
                 
             </div>
          </div>
     </div>
  </div>



<?php } ?>

 
