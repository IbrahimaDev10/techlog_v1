<?php require('../database.php'); 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
      require('controller/afficher_navire.php');

$navire=$_POST['id_navire'];


?>
 
<div class="container-fluid" id="tableau_modifier_relache" >
  <?php affichage_tableau_modifier_relache($bdd,$navire); ?>
</div>

 <div class="modal fade" id="modifier_simple_relache" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

   <div class="mb-3">
    
     <center>
   
  <label>DATE</label>
  <input type="date" class="form-control"  id="date_form" name="nombre_sac" ><br>  
  <label>NUMERO RELACHE</label>
  <input type="text" class="form-control"  id="num_relache_form" name="nombre_sac" ><br>
  <label>QUANTITE</label>
   <input type="text" class="form-control"  id="quantite_form"  name="nom_chargeur"  ><br>
   
   </select>
  </select><br>
   <label>id</label>
   <input type="text" class="form-control"  id="id_form"  name="nom_chargeur"  ><br>
      <label>navire</label>
   <input type="text" class="form-control"  id="navire_form"  name="nom_chargeur"  ><br>
   
    </center>
    
</div>


</center>



         <center>
        <a style="width: 50%;" id="save"    class="btn btn-primary btn-block btn-lg shadow-lg mt-5" data-role="btn_modifier_simple">valider</a>
</form> 
      </div>   
      <div class="modal-footer">
 
        
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="modifier_transfert_relache" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

   <div class="mb-3">
    
     <center>
   
  <label>DATE</label>
  <input type="date" class="form-control"  id="date_form2" name="nombre_sac" disabled="true" ><br>  
  <label>NUMERO RELACHE</label>
  <input type="text" class="form-control"  id="num_relache_form2" name="nombre_sac" disabled="true" ><br>
   <label>QUANTITE REELLE</label>
   <input type="text" class="form-control" id="quantite_reelle2"  name="nom_chargeur"  ><br>
  <label>QUANTITE DU RELACHE A TRANSFERER</label>
   <input type="text" class="form-control" id="quantite_transfert2"  name="nom_chargeur"  ><br>
   <label>CHOISIR DESTINATION</label>
  <select class="form-control" id='mangasin_form2'>
   <label>id</label>
   <input type="text" class="form-control"  id="id_form2"  name="nom_chargeur"  ><br>
      <label>navire</label>
   <input type="text" class="form-control"  id="navire_form2"  name="nom_chargeur"  ><br>
   <label>id_mangasin</label>
   <input type="text" class="form-control"  id="id_mangasin_form2"  name="nom_chargeur"  ><br>
   <label>id_produit</label>
   <input type="text" class="form-control"  id="id_produit_form2"  name="nom_chargeur"  ><br>
   <label>poids</label>
   <input type="text" class="form-control"  id="poids_kg_form2"  name="nom_chargeur"  ><br>
   <label>id_con_dis</label>
   <input type="text" class="form-control"  id="id_con_dis_form2"  name="nom_chargeur"  ><br>
   
    </center>
    
</div>


</center>



         <center>
        <a style="width: 50%;" id="save"    class="btn btn-primary btn-block btn-lg shadow-lg mt-5" data-role="btn_modifier_transfert">valider</a>
</form> 
      </div>   
      <div class="modal-footer">
 
        
      </div>
    </div>
  </div>
</div>

<div id='infos'></div>

</div>












