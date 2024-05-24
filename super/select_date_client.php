<?php 
require('../database.php');
$anneeclient=$bdd->query("SELECT YEAR(eta) as an
FROM navire_deb
GROUP BY YEAR(eta)");
?>
<div  id="calclient" class="col-md-12" >
    
  <div class="card">
    <div class="card-header">

      <center>
        <h1 class="hclient text-white" style=" background:  rgb(0,141,202);"  >MES CLIENTS</h1>
              <form>
    <select name="dateclient" id="dateclient" style="margin-top: 10px;" onchange="func_date_client()">
      <option selected="">ANNEE</option>
      <?php while($annee=$anneeclient->fetch()){ ?>
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
                        
                        <th style="border-color:white;" scope="col" >CLIENT</th>
                        <th style="border-color:white;" scope="col" >PRODUIT</th>
                         <th style="border-color:white;" scope="col" >TOTAUX</th>
                        <th style="border-color:white;" scope="col" >CODE PPM</th>
                         <th style="border-color:white;" scope="col" >ADRESSE</th>
                         <th style="border-color:white;" scope="col" >TELEPHONE</th>
                         <th style="border-color:white;" scope="col" >EMAIL</th>
                     
                        <th style="border-color:white;" scope="col" >ACTIONS</th>

                         
                                 </tr>
                                  </thead>




<?php  
if(isset($_POST['idDate_client'])){
$LesClients=$bdd->prepare("select cli.*, cli.id as idcl,dis.id_client,dis.id_produit, p.*, c.*, year(n.eta) from client as cli inner join dispatching as dis on dis.id_client=cli.id inner join produit_deb as p on p.id=dis.id_produit inner join categories as c on c.id_categories=p.id_cat inner join navire_deb as n on n.id=dis.id_navire where year(n.eta)=? group by p.id_cat;");
      $LesClients->bindParam(1,$_POST['idDate_client']);
      $LesClients->execute(); 
 ?>

                                  <tbody style="font-weight: bold;">
                                    <?php 
                                    while($row = $LesClients->fetch()){
                  $calculLigne=$bdd->prepare("select count(client) from client where id<=? ");
      $calculLigne->bindParam(1,$row['idcl']);
      $calculLigne->execute();
      $cal=$calculLigne->fetch();

             $cli=$bdd->prepare("select cli.*,dis.id_client,dis.id_produit, p.*,
                     c.* 
                          from client as cli inner join dispatching as dis on dis.id_client=cli.id
                          inner join produit_deb as p on p.id=dis.id_produit
                          inner join categories as c on c.id_categories=p.id_cat  
                          where cli.id=? group by p.id_cat");
      $cli->bindParam(1,$row['idcl']);
      $cli->execute();

      $calculTonne=$bdd->prepare("select cli.*,dis.id_client,sum(dis.poids_t),dis.id_produit, p.*, c.*, year(n.eta) from client as cli inner join dispatching as dis on dis.id_client=cli.id inner join produit_deb as p on p.id=dis.id_produit inner join categories as c on c.id_categories=p.id_cat inner join navire_deb as n on n.id=dis.id_navire where cli.id=? group by p.id_cat");
      $calculTonne->bindParam(1,$row['idcl']);
      $calculTonne->execute();
      //$cl=$cli->fetch();                
                                     ?>
                          <tr style="text-align:center;" border='5' id="<?php echo $row['id'] ?>">
                            <td ><span style="color: red; margin-left: 0px; " > <?php echo  $cal['count(client)']; ?></span> </td>
                            <td > <?php echo  $row['client']; ?> </td>
                            
                            
                            
                            <td > <?php while($cl=$cli->fetch()){  echo  $cl['nom_categories'];?> <br>  <?php } ?>  </td>
                            <td id="colRouge">  <?php while($clTonne=$calculTonne->fetch()){  echo  number_format($clTonne['sum(dis.poids_t)'], 3,',',' '). ' T <br>'; } ?>    </td>
                             <td style="vertical-align: middle;">   <?php echo  $row['code_ppm_client']; ?> </td>
                 <td style="vertical-align: middle;">   <?php echo  $row['adresse_client']; ?> </td>
                  <td style="vertical-align: middle;">  <?php echo  $row['tel_client']; ?> </td>
                   <td style="vertical-align: middle;">   <?php echo  $row['email_client']; ?> </td>

   
      
        </div>
        <div class="modal-footer">
         
        </div>
      </div>
    </div>
  </div>


                          <td>
                            <button  id="<?php echo $row['id'] ?>" name="deletecli" type="submit"  class="fabtn1 " onclick="deleteClient(<?php echo $row['id'] ?>)" > <i class="fa fa-trash  " ></i> </button>
                            <a class="fabtn" type="" name="modify"  href="modifier_client.php?id=<?php echo $row['id']; ?>"       id="btnbtn" > <i class="fa fa-edit " ></i></a>
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