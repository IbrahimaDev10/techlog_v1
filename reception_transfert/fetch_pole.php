<?php require('../database.php');
      require("controller/acces_reception.php"); ?>

<div class="main" id="pole" style="/*display: none;*/">

     

      

<div class="col-md-12 col-lg-12">

  <div class="table-responsive" border=1>

  
 
  <br>
  
 <table class='table table-hover table-bordered table-striped' id='table' border='2' >
    

 <thead >
       
     <td colspan="10" class="titre" style="background: linear-gradient(-45deg, #004362, #0183d0) !important; color: orange;"><i class="fas fa-truck" style="background: linear-gradient(-45deg, #004362, #0183d0) !important; color: orange;" ></i> CAMION EN ATTENTES <a  data-role="agrandir_table" class="agrandir_table" ><i class="fa fa-eye"></i></a></td>
    <tr class="tr_attente_avaries" style="background: linear-gradient(-45deg, #004362, #0183d0) !important; color: white;" > </tr>
      
      <tr  style="background: linear-gradient(-45deg, #004362, #0183d0) !important; color: white;">
      
       <td scope="col"    >DATES</td> 
           <td   >NAVIRE</td>
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
        
      


    <?php 
//111111111111111111111111111DEBUTPARTIE11111111111111111111111111111 
    //       PARTIE SITUATION DEBARQUEMENT
     ?>
     <div >
        
         

</div>
