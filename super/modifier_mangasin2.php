<?php require('../database.php');
if(isset($_POST['id'])){

	$id=$_POST['id'];
	$mangasin=$_POST['mangasin'];
	$code=$_POST['code'];
	$adresse=$_POST['adresse'];
	$superficie=$_POST['superficie'];
	$agrement=$_POST['agrement'];
  $id_mangasinier=$_POST['mangasinier'];
  $sac=$_POST['sac'];
    $super=str_replace(' ', '', $superficie);
  $sacs=str_replace(' ', '', $sac);
  $poids=$sacs*50/1000;



	 $update=$bdd->prepare("UPDATE mangasin set mangasin=?, code=?, num_agrement=?, adresse=?, superficie=?, sac_stock=?, poids_stock=?, id_mangasinier=? where id=? ");
	$update->bindParam(1,$mangasin);
	$update->bindParam(2,$code);
	$update->bindParam(3,$agrement);
	$update->bindParam(4,$adresse);
	$update->bindParam(5,$super);
	$update->bindParam(6,$sacs);
  $update->bindParam(7,$poids);
  $update->bindParam(8,$id_mangasinier);
  $update->bindParam(9,$id);
	$update->execute(); 

  

	?>

<div  id="calEntrepots" class="col-md-12" >
  <?php $new_mang=$bdd->query('select mg.*,su.* from mangasin as mg left join simar_user as su on su.id_sim_user=mg.id_mangasinier order by mg.mangasin asc '); ?>
  <div class="card">
    <div class="card-header">
      <center>
        <h1  style="color: white; background:  rgb(0,141,202);" >MES ENTREPOTS</h1>
    </center>
          </div>
            <div class="card-body"> 
               <div class="table-responsive" border=1> 
                
                 <table class='table table-hover table-bordered table-striped'  border='5' style="border-color: black; width: 100%;" >
                   <thead> 
                     <tr style="color:white; font-weight: bold; background: rgb(0,141,202); font-family: montserrat; border-color: white; text-align: center; font-size: 12px;" border='5'  >
                      <th id="celAlign" rowspan="2" style="border-color:white;" scope="col" > </th>
                      <th id="celAlign" rowspan="2" style="border-color:white;" scope="col" >NOM ENTREPOT </th>
                      <th id="celAlign" rowspan="2" style="border-color:white; font-size: 10px;" scope="col" >CODE D'ENTREPOT</th>
                        <th id="celAlign" rowspan="2" style="border-color:white;" scope="col" style="font-size: 10px;" >N° AGREMENT</th>
                        <th id="celAlign" rowspan="2" style="border-color:white;" scope="col" >SUPERFICIE (m²)</th>
                        <th id="celAlign"  colspan="2" style="border-color:white;" scope="col" > CAPACITE DE STOCKAGE </th>
                        <th id="celAlign" colspan="2" style="border-color:white;" scope="col" > QUANTITE STOCKEE </th>
                        <th id="celAlign" colspan="2" style="border-color:white;" scope="col" > ESPACE A STOCKER </th>
                         <th id="celAlign" rowspan="2" style="border-color:white;" scope="col" > ACTIONS </th>
                               </tr>
                               <tr  style="color:white; font-weight: bold; background: rgb(0,141,202); font-family: montserrat; border-color: white; text-align: center; vertical-align: middle;" border='5'>
                                <th id="celAlign">SACS (50 KGS)</th>
                                <th id="celAlign">POIDS (T)</th>
                                <th id="celAlign">SACS (50 KGS)</th>
                                <th id="celAlign">POIDS (T)</th>
                                <th id="celAlign">SACS (50 KGS)</th>
                                <th id="celAlign">POIDS (T)</th>
                               </tr>
                                  </thead>
                    <tbody style="font-weight: bold;">
                                    <?php 
                                    while($row = $new_mang->fetch()){

                            $calculLigne=$bdd->prepare("select count(mangasin) from mangasin where mangasin<=?");
      $calculLigne->bindParam(1,$row['mangasin']);
      $calculLigne->execute();
      $cal=$calculLigne->fetch();

      $calculTonne=$bdd->prepare("select  sum(rm.poids),rm.id_destination, mg.* from register_manifeste as rm
        inner join mangasin as mg on rm.id_destination=mg.id
        
       
                          where mg.id=?  ");
      $calculTonne->bindParam(1,$row['id']);
      $calculTonne->execute();
       $calT=$calculTonne->fetch();

// ICI ON CALCUL LE STOCKAGE EN SAC MANGASINS
       $sac_stocker=$calT['sum(rm.poids)']*1000/50;

       // ICI ON CALCUL LES RESTANTS MANGASINS
       $poids_restant=$row['poids_stock']-$calT['sum(rm.poids)'];
       $sac_restant=$row['sac_stock']-$calT['sum(rm.poids)']*1000/50;

 /*$images=$bdd->prepare('select * from fichier_mangasin where id_fichier_dis=?');
      $images->bindParam(1,$row['id']);
      $images->execute();*/ 

                
                                     ?>
                          <tr  style="text-align:center; vertical-align: middle; font-size: 15px;" border='5' id="<?php echo $row['id'] ?>">
                            <td style="vertical-align: middle; font-size: 10px;" ><span style="color: red; margin-left: 0px; " >  <?php echo  $cal['count(mangasin)']; ?></span> </td>
          <td id="<?php echo $row['id'].'mangasin' ?>" style="vertical-align: middle; " > <?php echo $row['mangasin']   ; ?> </td>
          <td id="<?php echo $row['id'].'code_mangasin' ?>" style="vertical-align: middle;" > <?php echo $row['code']   ; ?> </td>
                         <td id="<?php echo $row['id'].'agrement' ?>" style="vertical-align: middle;" > <?php echo $row['num_agrement']   ; ?> </td>
        <td id="<?php echo $row['id'].'superficie' ?>" style="vertical-align: middle;" > <?php echo number_format($row['superficie'], 0,',',' ').' m²'; ?> </td>
         <td id="<?php echo $row['id'].'sac_mg' ?>" style="vertical-align: middle; white-space: nowrap;" > <?php echo number_format($row['sac_stock'], 0,',',' '). ' sacs' ?> </td>
       <td id="<?php echo $row['id'].'poids_mg' ?>" style="vertical-align: middle;  white-space: nowrap;" > <?php echo number_format($row['poids_stock'], 3,',',' '). ' T' ?> </td>
       <td style="vertical-align: middle; white-space: nowrap;"> <?php echo number_format($sac_stocker, 0,',',' '); ?></td> 
       <td style="vertical-align: middle; white-space: nowrap;"> <?php echo number_format($calT['sum(rm.poids)'], 3,',',' '). ' T'; ?></td> 
                                 
       <td style="vertical-align: middle; white-space: nowrap;"> <?php echo number_format($sac_restant, 0,',',' '); ?></td>
       <td  style="vertical-align: middle; white-space: nowrap;"> <?php echo number_format($poids_restant, 3,',',' '); ?></td> 


    <div  class="modal fade" id="vue_details_entrepots<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog" >
      <div class="modal-content" style="margin-left: 0px;   border: solid; border-color:rgb(0,141,202);">
        <div class="modal-header-detailsEntrepots" style="background: blue;">
           <button style="float: right; top: 0px;" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          <center>
                <h5 class="modal-title fs-10 text-white text-center" id="exampleModalLabel " style="text-align:center;   ">DETAILS ENTREPOT: <span ><?php echo $row['mangasin'] ?></span></h5></center>
                <center>
              <img class="logoo" src="../images/mylogo.ico" >
             
       </center>
          
        </div>
        <div class="modal-body" style="text-align: left;">
         

         <div style="display: flex; ">
    <h6 style="margin-bottom: 1px;" id="front_details_clients" ><span class="details">CODE:  </span>  <span class="cel_clients" > <?php echo $row['code'];  ?></span></h6>
    </div><br>

    <div style="display: flex; ">
    <h6 style="margin-bottom: 1px;" id="front_details_clients" ><span class="details">N AGREMENT:</span>  <span class="cel_clients" > <?php echo $row['num_agrement'];  ?></span></h6>
    </div><br>

    <div style="display: flex; ">
    <h6 style="margin-bottom: 1px;" id="front_details_clients" ><span class="details">SUPERFICIE:</span>  <span class="cel_clients" > <?php echo $row['superficie'];  ?></span></h6></div><br>
    
    <div style="display: flex; ">
      <h6 style="margin-bottom: 1px;" id="front_details_clients" ><span class="details">CAPACITE DE STOCKAGE EN SAC:</span>  <span class="cel_clients" > <?php echo number_format($row['sac_stock'], 0,',',' ');   ?></span></h6></div><br>

   <div style="display: flex; ">
      <h6 style="margin-bottom: 1px;" id="front_details_clients" ><span class="details">CAPACITE DE STOCKAGE EN POIDS:</span> <span class="cel_clients" > <?php echo number_format($row['poids_stock'], 3,',',' ');   ?></span></h6>
      </div><br>
       <div style="display: flex; ">
    <h6 style="margin-bottom: 1px;" id="front_details_clients" ><span class="details">N ADRESSE:</span>  <span class="cel_clients" id="<?php echo $row['id'].'adresse_mg' ?>" > <?php echo $row['adresse'];  ?></span></h6>
    </div><br>
        
        <div style="display: flex; ">
        <h6 style="margin-bottom: 1px;" id="front_details_clients" ><span class="details">MANGASINIER:</span>  <span class="cel_clients" id="<?php echo $row['id'].'mangasinier' ?>" > <?php echo $row['prenom'].' '.$row['nom']  ?></span>
          <span style="display: none;" class="cel_clients" id="<?php echo $row['id'].'id_user' ?>" > <?php echo $row['id_sim_user'];  ?></span></h6></div><br>

        <div style="display: flex; ">
        <h6 style="margin-bottom: 1px;" id="front_details_clients"><span class="details">EMAIL:</span>  <span class="cel_clients"> <?php echo $row['email'] ?></span></h6></div><br>

        <div style="display: flex; ">
        <h6 style="margin-bottom: 1px;" id="front_details_clients"><span class="details">TELEPHONE:</span> <span class="cel_clients" ><?php echo $row['telephone'] ?></span></h6></div>
         
            
            
         
        </div>
        <div class="modal-footer">
         
        </div>
      </div>
    </div>
  </div>

<center>
  <div style="z-index: 6666666; width:100%;" class="modal fade full-screen-modal" id="vue_details_images<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"  >

    <div class="modal-dialog">
      <div class="modal-content ">
        <div class="modal-header" style="background: blue;">
          <h5 class="modal-title" id="myModalLabel" style="color: white;">DETAILS EN IMAGES</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="text-align: left;">
          <?php
          /*
          $rown=$images->fetch();
            if($rown) { 
         readfile($rown['path_fichier_mg']); */?>
  
    

           
    
       
</div> 
        
         
        </div>
        <div class="modal-footer">
         
        </div>
      </div>
    </div>
  </div>
  </center> 
   
  
                                 
                                 <td style="vertical-align: middle;"  >
              <div style="display: flex; justify-content: center;">                     
                            <a style="float:left;"  id="<?php echo $row['id'] ?>" name="deleteMg"   class="fabtn1 " onclick="deleteMg(<?php echo $row['id'] ?>)" > <i class="fa fa-trash  " ></i> </a>
                            <a  style="display: flex; justify-content: center;"  class="fabtn1" type=""   href="#" data-role="update_mangasin" data-id="<?php echo $row['id']; ?>"       id="btnbtn" > <i class="fa fa-edit " ></i></a>
<a style="display: flex; justify-content: center;"  id="<?php echo $row['id'] ?>" name="details" type="submit"  class="fabtn1 " data-bs-toggle="modal" data-bs-target="#vue_details_entrepots<?php echo $row['id'] ?>" onclick="setModalContent(<?php echo $row['id'] ?>)"> <i class="fas fa-info-circle   " ></i> </a>
<a  style="display: flex; justify-content: center;"  href="insertion_fichier_mangasin.php?id=<?php echo $row['id'] ?>"   class="fabtn1 "  onclick="setModalContent(<?php echo $row['id'] ?>)"> <i class="fas fa-folder  " ></i> </a>

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

 
