<?php 
require('../database.php');
if(isset($_POST['idDate_navire'])){
  $navi=$bdd->prepare("select * from navire_deb where YEAR(eta)=?");
  $navi->bindParam(1,$_POST['idDate_navire']);
  $navi->execute();

 
 $anneeclient=$bdd->query("SELECT YEAR(eta) as an
FROM navire_deb
GROUP BY YEAR(eta)");

?>
<center>
<div  id="" class="col-md-12">
	
  <div class="card">
    <div class="card-header">
      <center>
        <h1 style="background: linear-gradient(to bottom, blue, #1B2B65); background: linear-gradient(to left, blue, #1B2B65); background: linear-gradient(to top, blue, #1B2B65);" class="hnavire text-white" >MES NAVIRES</h1>
          </div>
            <div class="card-body"> 
              <form>
    <select name="datenavire" id="datenavire" style="margin-top: 10px;" onchange="func_date_navire()">
      <option selected="">ANNEE</option>
      <?php while($annee=$anneeclient->fetch()){ ?>
        <option value="<?php echo $annee['an'] ?>" ><?php echo $annee['an']  ?></option>
      <?php } ?>
    </select>


  </form> <br>
               <div class="table-responsive" border=1> 
                 <table class='table table-hover table-bordered table-striped'  border='5' style="  border-color: black;" >
                   <thead> 
                     <tr style=" background: linear-gradient(to bottom, blue, #1B2B65); background: linear-gradient(to left, blue, #1B2B65); background: linear-gradient(to top, blue, #1B2B65); color:white; font-weight: bold; font-family: montserrat; border-color: white; text-align: center;" border='5' >
                     	<th style="border-color:white;" scope="col" ></th>
                        <th style="border-color:white;" scope="col" >NAVIRE</th>
                       
                           <th style="border-color:white;" scope="col" >ACOSTAGE</th>
                            <th style="border-color:white;" scope="col" >MANIFESTE</th>
                             
                             <th style="border-color:white;" scope="col" >CLIENT</th>
                               
                               <th style="border-color:white;" scope="col" > ACTIONS  </th>
                                 </tr>
                               
                                  
                                  </thead>
                                   <tbody style="font-weight: bold;">
                                    <?php 
                                    while($row = $navi->fetch()){
      $calculLigne=$bdd->prepare("select count(navire) from navire_deb where id<=?");
      $calculLigne->bindParam(1,$row['id']);
      $calculLigne->execute();
      $cal=$calculLigne->fetch(); 

      $nav_produit = $bdd->prepare("select  n.*, p.* from navire_deb as n
inner join produit_manifest as p on n.id=p.id_navire where n.id=? ");
       $nav_produit->bindParam(1,$row['id']);
       $nav_produit->execute();
     // $navid= $nav_produit->fetch();              	
                                     ?>
                          <tr style="text-align:center;" border='5'>
                          	<td ><span style="color: red; margin-left: 0px; " >	<?php echo  $cal['count(navire)']; ?></span> </td>
                         <td > <?php echo  $row['navire']?></td>
                                
                              <td ><?php echo $row['eta']; ?> </td>
                             
                            <td  ><?php while($navid= $nav_produit->fetch()){ echo $navid['produit_navire']; ?>:<span style="color: red;"><?php echo $navid['poids_manifest']; ?>T</span><br>  <?php } ?> </td>
                            <td><?php echo $row['client_navire'] ?> </td> 
                          
                      <td >
    <div class="modal fade" id="vue_details_navire<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content" style="margin-left: 0px;">
          <div class="modal-header-detailsEntrepots" style="background: blue;">
           <button style="float: right; top: 0px;" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          <center>
                <h4 class="modal-title fs-10 text-white text-center" id="exampleModalLabel " style="text-align:center;   ">DETAILS NAVIRE: <?php echo $row['navire'] ?></h4></center>
                <center>
              <img class="logoo" src="../images/mylogo.ico" >
             
       </center>
          
        </div>
        <div class="modal-body" style="text-align: left;">
          
         <h6 style="margin-bottom: 1px;"  id="front_details_clients" ><span class="details">LOAD PORT:</span>  <span class="cel_clients" > <?php echo $row['load_port'];  ?></span></h6><br><br>
    <h6 style="margin-bottom: 1px;" id="front_details_clients" ><span class="details">DESTINATION:</span>  <span class="cel_clients" > <?php echo $row['destination'];  ?></span></h6><br><br>

    <h6 style="margin-bottom: 1px;" id="front_details_clients" ><span class="details">DESCRIPTION:</span>  <span class="cel_clients" > <?php echo $row['description'];  ?></span></h6><br><br>

    <h6 style="margin-bottom: 1px;" id="front_details_clients" ><span class="details">ETA:</span>  <span class="cel_clients" > <?php echo $row['eta'];  ?></span></h6><br><br>

      <h6 style="margin-bottom: 1px;" id="front_details_clients" ><span class="details">ETB:</span>  <span class="cel_clients" > <?php echo $row['etb'];  ?></span></h6><br><br>

      <h6 style="margin-bottom: 1px;" id="front_details_clients" ><span class="details">ETD:</span> <span class="cel_clients" > <?php echo $row['etd'];  ?></span></h6><br><br>

        
            
            
         
        </div>
        <div class="modal-footer">
         
        </div>
      </div>
    </div>
  </div>


                            <button  id="<?php echo $row['id'] ?>" name="deleteNavire" type="submit"  class="fabtn1 " onclick="deleteNavire(<?php echo $row['id'] ?>)" > <i class="fa fa-trash  " ></i> </button>
                            <a class="fabtn" type="" name="modify"  href="modifier_navire.php?id=<?php echo $row['id']; ?>"       id="btnbtn" > <i class="fa fa-edit " ></i></a>
                            <button  id="<?php echo $row['id'] ?>" name="details_nav" type="submit"  class="fabtn1 " data-bs-toggle="modal" data-bs-target="#vue_details_navire<?php echo $row['id'] ?>" onclick="setModalContent(<?php echo $row['id'] ?>)"> <i class="fas fa-info-circle  " ></i> </button></td>    
                        </tr>
                      <?php } ?>	
                    </tbody>
                 </table>
             </div>
          </div>
     </div>
  </div>
</center>
<?php } ?> 