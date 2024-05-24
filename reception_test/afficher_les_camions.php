<?php 
require("../database.php");
require("controller/acces_reception.php");

$a=$_SESSION['id'];

 ?>

    <div class="main" id="pole" style="">
 <div class="row">
   <?php $total_camions_en_attentes=total_camions_en_attentes($bdd,$a); ?>  
   <div class="col-md-6 col-lg-6">
      <span style="display:flex; justify-content: center; float:left;"><h6>NBRE CAMIONS EN ATTENTES: <?php if($total_camions=$total_camions_en_attentes->fetch()) ?> <span style="color:red; background: white;"><?php echo $total_camions['count(trd.id_register_manif)']; ?></span> </h6>   </span>  
      </div>
<div class="col-md-6 col-lg-6">
      <span style="display:flex; justify-content: center; float:right;"><h6>RECHERCHE </h6>  <input   type="search" id="valeur_filtre_bl_camion" oninput='cherche_par_bl_camion()' > </span>  
      </div> 


<div class="col-md-12 col-lg-12">


  <div class="table-responsive" border=1>

  
 
  <br>

 
  
 <table class='table table-hover table-bordered table-striped' id='table_camion' border='2' >
    

 <thead >
       
     <td colspan="12" class="titre" style="background: linear-gradient(-45deg, #004362, #0183d0) !important; color: orange;"><i class="fas fa-truck" style="background: linear-gradient(-45deg, #004362, #0183d0) !important; color: orange;" ></i> CAMION EN ATTENTES <a  class="agrandir_table" data-role="agrandir_table" ><i class="fa fa-eye"></i></a> </td>
    <tr class="tr_attente_avaries" style="background: linear-gradient(-45deg, #004362, #0183d0) !important; color: white;" > </tr>
      
      <tr style="background: linear-gradient(-45deg, #004362, #0183d0) !important; color: white;">
      
       <td scope="col"    >DATES</td> 
       <td scope="col"    >HEURE</td> 
           <td   >NAVIRE</td>
           <td   >ENTREPOT</td>
    <td class="produit_hide" >PRODUIT</td>    
                 <td class="bl_hide" scope="col"  >BL</td>
               <td class="camion_hide" scope="col"   >CAMIONS</td> 
               <td class="chauffeur_hide" scope="col"   >CHAUFFEUR</td>       
  <td scope="col" >SACS</td>
      <td scope="col"  >POIDS</td>
      <td scope="col"  >STATUT</td>
      <td scope="col"  >ACTIONS</td>
      
     
  </tr>


      
    
     </thead>


<tbody>
<?php afficher_camions_en_attentes_avaries($bdd); ?>
</tbody>
</table>
</div>
 </div> 

</div>

         
     </div>