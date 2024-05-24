<?php require('../database.php');
if(isset($_POST['id'])){

	$id=$_POST['id'];
	$navire=$_POST['navire'];
	$affreteur=$_POST['affreteur'];
	$client=$_POST['client'];
	$eta=$_POST['eta'];
  $etb=$_POST['etb'];
  $etd=$_POST['etd'];
	$load_port=$_POST['load_port'];
  $destination=$_POST['destination'];

$a=explode('-', $eta);
$a1=$a[2].'-'.$a[1].'-'.$a[0];
$b=explode('-', $etb);
$b1=$b[2].'-'.$b[1].'-'.$b[0];
$d=explode('-', $etd);
$d1=$d[2].'-'.$d[1].'-'.$d[0];



	 $update=$bdd->prepare("UPDATE navire_deb set navire=?, chatered=?, client_navire=?, eta=?, etb=?, etd=?, load_port=?, destination=? where id=? ");
	$update->bindParam(1,$navire);
	$update->bindParam(2,$affreteur);
	$update->bindParam(3,$client);
	$update->bindParam(4,$a1);
	$update->bindParam(5,$b1);
	$update->bindParam(6,$d1);
  $update->bindParam(7,$load_port);
  $update->bindParam(8,$destination);
  $update->bindParam(9,$id);
	$update->execute(); 

  

	?>

<center>
<div  id="calnavire"    class="col-md-12">
  <?php $anneenavire=$bdd->query("SELECT YEAR(eta) as an
FROM navire_deb
GROUP BY YEAR(eta)"); 
$navi=$bdd->query("select * from navire_deb");   
 ?>
  <div class="card">
    <div class="card-header">
      <center>
        <h1 style="background: linear-gradient(to bottom, blue, #1B2B65); background: linear-gradient(to left, blue, #1B2B65); background: linear-gradient(to top, blue, #1B2B65);" class="hnavire text-white" >MES NAVIRES</h1>
          </div>
          <form>
    <select style="background: blue; color: white; width: 10%; text-align: center; font-size: 24px;" name="datenavire" id="datenavire" style="margin-top: 10px;" onchange="func_date_navire()">
      <option selected="">ANNEE</option>
      <?php while($annee=$anneenavire->fetch()){ ?>
        <option value="<?php echo $annee['an'] ?>" ><?php echo $annee['an']  ?></option>
      <?php } ?>
    </select>


  </form>
  <br>
            <div class="card-body"> 
               <div class="table-responsive" border=1> 
                 <table class='table table-hover table-bordered table-striped'  border='5' style="  border-color: black;" >
                   <thead> 
                     <tr style=" background: linear-gradient(to bottom, blue, #1B2B65); background: linear-gradient(to left, blue, #1B2B65); background: linear-gradient(to top, blue, #1B2B65); color:white; font-weight: bold; font-family: montserrat; border-color: white; text-align: center;" border='5' >
                      <th style="border-color:white;" scope="col" ></th>
                        <th style="border-color:white;" scope="col" >NAVIRES</th>
                       
                           <th style="border-color:white;" scope="col" >DATE D'ACOSTAGE</th>
                            <th style="border-color:white;" scope="col" >POIDS MANIFESTES</th>
                          <th style="border-color:white;" scope="col" >FOURNISSEUR</th>
                           <th style="border-color:white;" scope="col" >CLIENTS</th>

                            
                               
                               <th style="border-color:white;" scope="col" > ACTIONS  </th>
                                 </tr>
                               
                                  
                                  </thead>
                                   <tbody style="font-weight: bold;">
                                    <?php 
                                    while($row = $navi->fetch()){
            $a=explode('-', $row['eta']); $b=explode('-', $row['etb']); $d=explode('-', $row['etd']);                         
      $calculLigne=$bdd->prepare("select count(navire) from navire_deb where id<=?");
      $calculLigne->bindParam(1,$row['id']);
      $calculLigne->execute();
      $cal=$calculLigne->fetch(); 

      $nav_produit = $bdd->prepare("select  n.*, p.*,c.* from navire_deb as n
inner join produit_manifest as p on n.id=p.id_navire
inner join categories as c on c.id_categories=p.produit_navire where n.id=? ");
       $nav_produit->bindParam(1,$row['id']);
       $nav_produit->execute();
     // $navid= $nav_produit->fetch();                
                                     ?>
                          <tr style="text-align:center;" border='5' id="<?php echo $row['id'] ?>">
                            <td ><span style="color: red; margin-left: 0px; " > <?php echo  $cal['count(navire)']; ?></span> </td>
                         <td id="<?php echo $row['id'].'navire' ?>" > <?php echo  $row['navire']?></td>
                                
                              <td id="<?php echo $row['id'].'eta' ?>" ><?php echo $a[2].'-'.$a[1].'-'.$a[0]; ?> </td>
                             
                            <td  ><?php while($navid= $nav_produit->fetch()){ echo $navid['nom_categories']; ?>: <span style="color: red;"> <?php echo number_format($navid['poids_manifest'], 3,',',' ');  ?>T</span><br>  <?php } ?> </td> 
                          
                         <td id="<?php echo $row['id'].'affreteur_nav' ?>"> <?php echo $row['chatered']; ?></td>
                         <td id="<?php echo $row['id'].'client_nav' ?>"> <?php echo $row['client_navire']; ?></td>
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
          
         <h6 style="margin-bottom: 1px;"  id="front_details_clients" ><span class="details">LOAD PORT:</span>  <span class="cel_clients" id="<?php echo $row['id'].'load_port' ?>" > <?php echo $row['load_port'];  ?></span></h6><br><br>
    <h6 style="margin-bottom: 1px;" id="front_details_clients" ><span class="details">DESTINATION:</span>  <span class="cel_clients" id="<?php echo $row['id'].'destination' ?>" > <?php echo $row['destination'];  ?></span></h6><br><br>

    

    <h6 style="margin-bottom: 1px;" id="front_details_clients" ><span class="details">ETA:</span>  <span class="cel_clients" > <?php echo $a[2].'-'.$a[1].'-'.$a[0];  ?></span></h6><br><br>

      <h6 style="margin-bottom: 1px;" id="front_details_clients" ><span class="details">ETB:</span>  <span class="cel_clients" id="<?php echo $row['id'].'etb' ?>" > <?php echo $b[2].'-'.$b[1].'-'.$b[0];  ?></span></h6><br><br>

      <h6 style="margin-bottom: 1px;" id="front_details_clients" ><span class="details" >ETD:</span> <span class="cel_clients" id="<?php echo $row['id'].'etd' ?>"> <?php echo $d[2].'-'.$d[1].'-'.$d[0];  ?></span></h6><br><br>

        
            
            
         
        </div>
        <div class="modal-footer">
         
        </div>
      </div>
    </div>
  </div>


                            <button  id="<?php echo $row['id'] ?>" name="deleteNavire" type="submit"  class="fabtn1 " onclick="deleteNavire(<?php echo $row['id'] ?>)" > <i class="fa fa-trash  " ></i> </button>
                            <a class="fabtn" data-role="update_navire" data-id="<?php echo $row['id'] ?>"       id="btnbtn" > <i class="fa fa-edit " ></i></a>
                            <button id="<?php echo $row['id'] ?>" name="details_nav" type="submit"  class="fabtn1 " data-bs-toggle="modal" data-bs-target="#vue_details_navire<?php echo $row['id'] ?>" onclick="setModalContent(<?php echo $row['id'] ?>)"> <i class="fas fa-info-circle  " ></i> </button></td>    
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

 
