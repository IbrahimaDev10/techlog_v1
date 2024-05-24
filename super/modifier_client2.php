<?php require('../database.php');
if(isset($_POST['id'])){

	$id=$_POST['id'];
	$client=$_POST['client'];
	$code=$_POST['code'];
	$adresse=$_POST['adresse'];
	$tel=$_POST['tel'];
	$email=$_POST['email'];
	$update=$bdd->prepare("UPDATE client set client=?, code_ppm_client=?, adresse_client=?, tel_client=?,email_client=? where id=? ");
	$update->bindParam(1,$client);
	$update->bindParam(2,$code);
	$update->bindParam(3,$adresse);
	$update->bindParam(4,$tel);
	$update->bindParam(5,$email);
	$update->bindParam(6,$id);
	$update->execute();

	?>

<div  id="calclient" class="col-md-12" >
<?php  $LesClients=$bdd->query("select * from client ");
  $anneeclient=$bdd->query("SELECT YEAR(eta) as an
FROM navire_deb
GROUP BY YEAR(eta)"); ?>
		
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
                     <tr id="colmedium" style="color:white; font-weight: bold; background: rgb(0,141,202); font-family: montserrat; border-color: white; text-align: center;" border='5' >
                     	 <th style="border-color:white;" scope="col" ></th>
                        
                        <th style="border-color:white;" scope="col" >RECEPTIONNAIRES</th>
                        <th style="border-color:white;" scope="col" >PRODUIT</th>
                       
                         <th style="border-color:white;" scope="col" >TOTAUX</th>
                         <th style="border-color:white;" scope="col" >CODE PPM</th>
                         <th style="border-color:white;" scope="col" >ADRESSE</th>
                         <th style="border-color:white;" scope="col" >TELEPHONE</th>
                         <th style="border-color:white;" scope="col" >EMAIL</th>
                          
                         	
                         
                     
                        <th style="border-color:white;" scope="col" >ACTIONS</th>

                         
                                 </tr>
                                  </thead>
                                   <tbody style="font-weight: bold;">
                                    <?php 
                                    while($row = $LesClients->fetch()){
                  $calculLigne=$bdd->prepare("select count(client) from client where id<=? ");
      $calculLigne->bindParam(1,$row['id']);
      $calculLigne->execute();
      $cal=$calculLigne->fetch();

             $cli=$bdd->prepare("select cli.*,dis.id_client,dis.id_produit, p.*,
                     c.* 
                        	from client as cli inner join dispatching as dis on  dis.id_client=cli.id
                        	inner join produit_deb as p on p.id=dis.id_produit
                        	inner join categories as c on c.id_categories=p.id_cat  
                        	where cli.id=? group by p.id_cat");
      $cli->bindParam(1,$row['id']);
      $cli->execute();

      $calculTonne=$bdd->prepare("select cli.*, sum(dis.poids_t),dis.id_client, p.* from client as cli
        inner join dispatching as dis on cli.id=dis.id_client
        inner join produit_deb as p on p.id=dis.id_produit 
       
                        	where cli.id=? group by p.id_cat ");
      $calculTonne->bindParam(1,$row['id']);
      $calculTonne->execute();


      $calculCat=$bdd->prepare("select cli.*, sum(dis.poids_t),dis.id_client, p.*,c.*,count(c.nom_categories), count(p.id_cat) as tot
       from client as cli 
        inner join dispatching as dis on cli.id=dis.id_client
        inner join produit_deb as p on p.id=dis.id_produit 
        inner join categories as c on c.id_categories=p.id_cat 
       
                        	where cli.id=?   ");
      $calculCat->bindParam(1,$row['id']);
      $calculCat->execute();
      //$cl=$cli->fetch();              	
       $total=$calculCat->fetch();                              ?>
                          <tr id="<?php echo $row['id'] ?>" style="text-align:center;" border='5' >
                          	<td ><span style="color: red; margin-left: 0px; " >	<?php echo  $cal['count(client)']; ?></span> </td>
                          	<td  id="<?php echo $row['id'].'client' ?>"  style="vertical-align: middle;" data_target="clientp" >	<?php echo  $row['client']; ?> </td>
                          	
                          	 
                          	
                          	<td style=" vertical-align: middle;" >
                          		<?php 
                          	 ?>	
                          		<?php while($cl=$cli->fetch()){  echo  $cl['nom_categories'];?> <br><br>  <?php } ?> <span style="background: red;color: white;"><?php  
                          		echo "TOTAL";
                           ?> </span>   </td>
                          	
                          	<td style=" vertical-align: middle;" id="colRouge">	<?php while($clTonne=$calculTonne->fetch()){  echo number_format($clTonne['sum(dis.poids_t)'], 3,',',' '). ' T <br><br>'; } ?> 
                          		<?php  echo  number_format($total['sum(dis.poids_t)'], 3,',',' ');
                           ?>  T </td>
                <td id="<?php echo $row['id'].'code' ?>" style="vertical-align: middle;"> 	<?php echo  $row['code_ppm_client']; ?> </td>
                 <td id="<?php echo $row['id'].'adresse' ?>" style="vertical-align: middle;"> 	<?php echo  $row['adresse_client']; ?> </td>
                  <td id="<?php echo $row['id'].'tel' ?>" style="vertical-align: middle;"> 	<?php echo  $row['tel_client']; ?> </td>
                   <td id="<?php echo $row['id'].'email' ?>" style="vertical-align: middle;"> 	<?php echo  $row['email_client']; ?> </td>§PM



                          <td>
                          	<button  id="<?php echo $row['id'] ?>" name="deletecli" type="submit"  class="fabtn1 " onclick="deleteClient(<?php echo $row['id'] ?>)" > <i class="fa fa-trash  " ></i> </button>
                          	<a class="fabtn" href="#" data-role="update_cli" data-id="<?php echo $row['id']; ?>"       id="btnbtn" > <i class="fa fa-edit " ></i></a>
     </td>         
                              </tr>
                      <?php } ?>	
                    </tbody>
                 </table>
                 </center>
             </div>
          </div>
     </div>
  </div>


<?php } ?>

 
