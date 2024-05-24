<?php 
require('../database.php');
$anneeProduit=$bdd->query("SELECT YEAR(eta) as an
FROM navire_deb
GROUP BY YEAR(eta)");
?>
<div  id="calproduit" class="col-md-12" >
    
  <div class="card">
    <div class="card-header">

      <center>
        <h1 class="hclient text-white" style=" background:  rgb(0,141,202);"  >MES PRODUITS</h1>
              <form>
    <select name="dateproduit" id="dateproduit" style="margin-top: 10px;" onchange="func_date_produit()">
      <option selected="">ANNEE</option>
      <?php while($annee=$anneeProduit->fetch()){ ?>
        <option value="<?php echo $annee['an'] ?>" ><?php echo $annee['an']  ?></option>
      <?php } ?>
    </select>


  </form>
          </div>
            <div class="card-body"> 
               <div class="table-responsive" border=1> 
                <center>
                 <table class='table table-hover table-bordered table-striped'  border='5' style="border-color: black; " >
                   <thead> 
                     <tr style="color:white; font-weight: bold; background: rgb(0,141,202); font-family: montserrat; border-color: white; text-align: center;" border='5' >
                       <th style="border-color:white;" scope="col" ></th>
                        
                      <th style="border-color:white; vertical-align: middle;" scope="col" >PRODUIT </th>
                        <th style="border-color:white; vertical-align: middle;" scope="col" >POIDS</th>
                        <th style="border-color:white; vertical-align: middle;" scope="col" >TAXE DE PORT</th>
                        <th style="border-color:white; vertical-align: middle;" scope="col" >ACTIONS</th>

                         
                                 </tr>
                                  </thead>




<?php  
if(isset($_POST['idDate_produit'])){
$LesClients=$bdd->prepare("select cat.*, dis.id_produit, year(n.eta), p.* from categories as cat left join produit_deb as p on cat.id_categories=p.id_cat left join dispatching as dis on dis.id_produit=p.id left join navire_deb as n on n.id=dis.id_navire where year(n.eta)=? group by cat.id_categories;");
      $LesClients->bindParam(1,$_POST['idDate_produit']);
      $LesClients->execute(); 
 ?>

                                  <tbody style="font-weight: bold;">
                                    <?php 
                                    while($row = $LesClients->fetch()){
                  $calculLigne=$bdd->prepare("select count(nom_categories) from categories where id_categories<=? ");
      $calculLigne->bindParam(1,$row['id_categories']);
      $calculLigne->execute();
      $cal=$calculLigne->fetch();

             

      $calculTonne=$bdd->prepare("select cat.*,sum(dis.poids_t),dis.id_produit, p.id_cat  from categories as cat
        left join produit_deb as p on p.id_cat=cat.id_categories
        left join dispatching as dis on p.id=dis.id_produit
          where cat.id_categories=? group by cat.id_categories");
      $calculTonne->bindParam(1,$row['id_categories']);
      $calculTonne->execute();
      //$cl=$cli->fetch();                
                                     ?>
                          <tr style="text-align:center;" border='5' id="<?php echo $row['id'] ?>">
                            <td ><span style="color: red; margin-left: 0px; " > <?php echo  $cal['count(nom_categories)']; ?></span> </td>
                            <td > <?php echo  $row['nom_categories']; ?> </td>
             
                            <td id="colRouge">  <?php while($clTonne=$calculTonne->fetch()){  echo  number_format($clTonne['sum(dis.poids_t)'], 3,',',' '). ' T <br>'; } ?>    </td>
                            <td > <?php echo  $row['taxe_port']; ?> </td>

    

                          <td>
                            <button  id="<?php echo $row['id_categories'] ?>" name="deletecat" type="submit"  class="fabtn1 " onclick="deleteProduit(<?php echo $row['id_categories'] ?>)" > <i class="fa fa-trash  " ></i> </button>
                            <a class="fabtn" type="" name="modify"  href="modifier_produit.php?id=<?php echo $row['id_categories']; ?>"       id="btnbtn" > <i class="fa fa-edit " ></i></a>
                            </td>          
                                     
                              </tr>
                      <?php } ?>  
                    </tbody>




<?php } ?>
                 </table>
                 </center>
             </div>
          </div>
     </div>
  </div>