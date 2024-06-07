<?php 
require('../../../../database.php');
require('../../../controller/connaissement/tableau_connaissementController.php');
$b=$_POST["navire"];

$nav=navire_type($bdd,$b);

$types=$nav->fetch();

 ?>
            <div class="container-fluid" id='content'>
            	<div class="row">
          
             <div  id="tab_par_connaissement" class="table-responsive" > 
             <table id="tab_par_connaissement2" class='table table-responsive table-hover table-bordered '  border='2' style="border-color: black; " >
            
          <thead> 
          <tr id='entete_head' style="text-align: center;">  <td colspan="9">PAR CONNAISSEMENT <br>
          	NAVIRE: <?php echo $types['navire'] ?></td></tr>  
 <tr style="color:white; font-weight: bold; color:white; font-weight: bold; background: linear-gradient(to bottom, #FFFFFF, rgb(0,141,202));  border-color: white; text-align: center; font-size: 14px;" border='5' >
                               
                                <th  scope="col" >N° BL</th>
                                <th  scope="col" >RECEP<br>
                                TIONNAIRE</th>
                                <th  scope="col" >BANQUE</th>
                                
                                 <th  scope="col" >DESTINATION</th>
                                <th  scope="col" >PRODUIT</th>
                            <?php if($types['type']=="SACHERIE"){ ?>
                                <th  scope="col" >QUANTITE</th>
                              <?php } ?>
                               <th  scope="col" >POIDS (T)</th> 
                               <th  scope="col" >DECLARATION (T)</th> 
                              
                               <th scope="col" >ACTIONS</th>
                                
                                


                                
                              </tr>
                              </thead>
                               <tbody style="font-weight: bold;" id='body_connaissement'>
                          <?php affichage_par_connaissement($bdd,$b); ?>

                               </tbody>
                           </table>
                       </div>
                   </div>
               </div>



<div class="modal fade" id="modif_dis" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style=" border: solid; border-color:rgb(0,141,202); ">
            <div class="modal-header" style="">
              <center>
                <h3 class="modal-title fs-10 text-white text-center" id="exampleModalLabel " style="text-align:center;   ">MODIFICATION</h3></center>
                <center>
              <img class="logoo" src="../images/mylogo.ico" >
       </center>
        
      </div>
       <br> <br>
        <form  method="POST">


      
    
  
      ?>

<div id="info_politique_modif"> <span style="color:black;">NB:</span> <span style="color:red;"> Pour pus de securite certains champs ont ete desactives <a href="" style="text-decoration: underline;">en savoir plus</a></span></div>

   <div class="mb-3">
    <div id="type_decharge_dis_global">
    <label>Choisir le type de chargement</label><br>

 <select id="type_decharge_dis" data-role='type_chargement'>
  <option value=""></option>

   <option value="1">EN SACHETS</option>
    <option value="2">EN VRAC</option>
 </select><br><br>
 </div>

 <div id="visible_poids_sac_dis">
  <label>CHOISIR LE POIDS</label><br>
   <select id='poids_sac_dis' name="poids_sac" >
                              <option value="">CHOISIR LE POIDS (KG)</option>
                              <option value="25">25 KG</option>
                              <option value="40">40 KG</option>
                              <option value="45">45 KG</option>
                              <option value="50">50 KG</option>
                            </select> <br><br>
 </div>

 
<label>Choisir PRODUIT</label><br>

     <select id="produit_dis" style="width:50%;">
      <?php $produit_deb=$bdd->query("SELECT id, produit,qualite from produit_deb");

       while($prod=$produit_deb->fetch()){
           ?>
           <option value="<?php echo $prod['id'] ?>"><?php echo $prod['produit'] ?> <?php echo $prod['qualite'] ?></option>
         <?php } ?>
     </select>
  <br><br>

    <label>Choisir Destination</label><br>

     <select id="dec_dis" style="width:50%;">
      <?php $dispat=$bdd->query("SELECT id, mangasin from mangasin");

       while($con=$dispat->fetch()){
           ?>
           <option value="<?php echo $con['id'] ?>"><?php echo $con['mangasin'] ?></option>
         <?php } ?>
     </select>
  <br><br>
<label>Choisir Connaissement</label><br>
  <select id="id_con_dis" style="width:50%;">
      <?php $connais_dis=$bdd->prepare("SELECT id_connaissement, num_connaissement,poids_kg FROM numero_connaissements  


 where id_navire=?");
$connais_dis->bindParam(1,$b);
$connais_dis->execute(); 

       while($connais=$connais_dis->fetch()){
           ?>
           <option value="<?php echo $connais['id_connaissement']; ?>"> <?php echo $connais['num_connaissement'] ?> </option>
         <?php } ?>
     </select>
  <br><br>

  <div id="visible_sac"> 
  <label>NOMBRE SAC</label>
  <input type="text" class="form-control"  id="sac_dis" name="nombre_sac" ><br><br>
  </div>
    <div id="visible_poids"> 
  <label>POIDS</label>
  <input type="text" class="form-control"  id="poids_dis" name="nombre_sac" ><br><br>
  </div>

  
 <select id="des_douane">
   <option value="TRANSFERT">TRANSFERT</option>
    <option value="LIVRAISON">LIVRAISON</option>
 </select>
      
   <center>
   
<div style="display: none;">
  <label>NAVIRE</label>
    <input type="text" class="form-control"  id="navire_dis" name="nav" >

   <input type="text" class="form-control"  id="id_dis" name="dec"  ><br>
<input type="text" class="form-control"  id="type_nav" name="dec"  ><br>


     </div>


    </center>
    
    
</div>


</center>



        
        
 
       
      <div class="modal-footer">
    <a data-role="save_dis"   class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="modifier_declaration">valider</a>
     </div> 
        
      </div>
      </form>
    </div>
  </div>
</div>

