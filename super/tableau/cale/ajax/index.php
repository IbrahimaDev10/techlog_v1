<?php 
require('../../../../database.php');
require('../../../controller/cale/tableau_caleController.php');
$b=$_POST["navire"];

$nav=navire_type($bdd,$b);

$types=$nav->fetch();

 ?>
            <div class="container-fluid" id='content'>
            	<div class="row">
          
             <div  id="tab_par_connaissement" class="table-responsive" > 
             <table id="tab_par_connaissement2" class='table table-responsive table-hover table-bordered '  border='2' style="border-color: black; " >
            
          <thead> 
          <tr id='entete_head' style="text-align: center;">  <td colspan="9">PAR CALE <br>
          	NAVIRE: <?php echo $types['navire'] ?></td></tr>  
 <tr style="color:white; font-weight: bold; color:white; font-weight: bold; background: linear-gradient(to bottom, #FFFFFF, rgb(0,141,202));  border-color: white; text-align: center; font-size: 14px;" border='5' >
                               
                                <th  scope="col" >CALE </th>
                                <th  scope="col" >NOM CHARGEUR<br>
                                TIONNAIRE</th>
                                <th  scope="col" >PRODUIT</th>
                                
                                
                               <th  scope="col" >POIDS (T)</th> 
                             
                              
                               <th scope="col" >ACTIONS</th>
                                
                                


                                
                              </tr>
                              </thead>
                               <tbody style="font-weight: bold;" id='body_cale'>
                          <?php affichage_par_cale_vrac($bdd,$b); ?>

                               </tbody>
                           </table>
                       </div>
                   </div>
               </div>



<div class="modal fade" id="modif_dec" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

<center>
<div id="info_politique_modif_cale"> <span style="color:black;">NB:</span> <span style="color:red;"> Pour pus de securite certains champs ont ete desactives <a href="" style="text-decoration: underline;">en savoir plus</a></span></div> <br>
   <div class="mb-3">
    
     <center>
      <label>CATEGORIES PRODUIT</label><br> 
    <select id="id_produit" style="width: 50%;">
      <?php $prod=$bdd->query("select * from categories");
      while($p=$prod->fetch()){ ?>
        <option value="<?php echo $p['id_categories'];  ?>"  > <?php echo $p['nom_categories']   ?>  </option> <?php   } ?>
   
</select>

    </center><br>
    <div style="display: none;">
    <label>CONDITIONNEMENT</label>
    <select id="conditionnement">
      <option value=25>25 KG</option>
      <option value=40>40 KG</option>
      <option value=42>42 KG</option>
      <option value=43>43 KG</option>
      <option value=45>45 KG</option>
      <option value=50>50 KG</option>
    </select> 
    <br><br>
    <label>NOMBRE SAC</label>
  <input type="text"   class="form-control"  id="sac" name="nombre_sac" ><br>

    </div> 
   
   <div >
    <label>POIDS</label>
    <input  type="text" class="form-control"  id="poids_is_vrac" name="nav" >
  
</div>
 
  <label>NOM CHARGEUR</label>
   <input type="text" class="form-control"  id="chform"  name="nom_chargeur"  ><br>
   <label>CALE</label>
   <center>
    <select id="caleform"  name="cales"    style="width: 50%;" >
      
       <option value="C1">C1</option>
       <option value="C2">C2</option>
       <option value="C3">C3</option>
       <option value="C4">C4</option>
       <option value="C5">C5</option>
    </select>
    <input style="display: none;" type="text" class="form-control"  id="type"  name="nom_chargeur"  ><br>
    <input style="display: none;" type="text" class="form-control"  id="navire_dc" name="nav" >
    

     <input style="display: none;" type="text" class="form-control"  id="iddec" name="dec"  ><br>
    </center>
    
</div>


</center>



         <center>
        <a style="width: 50%;" id="save" data-role="saves"   class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="modifier_declaration">valider</a>
</form> 
      </div>   
      <div class="modal-footer">
 
        
      </div>
    </div>
  </div>
</div>


