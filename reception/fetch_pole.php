<?php require('../database.php');
      require("controller/acces_reception.php"); ?>

<div class="main" id="pole" style="/*display: none;*/">

     

         <div class="col-md-12 col-lg-12">
    <h3 class="operation" >POLE DE RECEPTION</h3>
</div>
<br>
<div class="col-md-12 col-lg-12">
      <div  class="table-responsive" border=1 >
        
           
          
        
 <table  class='table table-hover table-bordered table-striped'  border='2'   id='tabledec2' >
   <td colspan="9" style=" background: linear-gradient(-45deg, #004362, #0183d0) !important; color: white; " class="titre"><i class="fas fa-truck" ></i>   CAMIONS EN ATTENTES (SAINS)</td>
  
  <tr class="tr_attente_sain" style=" background: linear-gradient(-45deg, #004362, #0183d0) !important;">
     <th >DATE</th>
    <th >NAVIRE</th>
    <th >PRODUIT</th>
  <th >BL</th>
  <th >CAMION</th>
  <th >TRANSPORTEUR</th>
  <th >SAC</th>
  <th >POIDS</th>
  <th >ACTIONS</th></tr>
  <tbody>
    <?php afficher_camions_en_attentes_sain($bdd); ?>

     </tbody>
    </table>
  
</div>
</div>



<div class="col-md-12 col-lg-12">

  <div class="table-responsive" border=1>

  
 
  <br>
  
 <table class='table table-hover table-bordered table-striped' id='table' border='2' >
    

 <thead >
       
     <td colspan="12" class="titre" style="background: linear-gradient(-45deg, #004362, #0183d0) !important; color: orange;"><i class="fas fa-truck" style="background: linear-gradient(-45deg, #004362, #0183d0) !important; color: orange;" ></i> CAMIONS EN ATTENTES (AVARIES)</td>
    <tr class="tr_attente_avaries" style="background: linear-gradient(-45deg, #004362, #0183d0) !important; color: white;" >
      
      
      
       <td scope="col"  rowspan="3"  >DATES</td> 
           <td  rowspan="3" >NAVIRE</td>
    <th  rowspan="3">PRODUIT</th>    
                 <td scope="col"  rowspan="3"  >BL</td>
               <td scope="col" rowspan="3"  >CAMIONS</td> 
               <td scope="col"  rowspan="3"  >CHAUFFEUR</td>       
      <td scope="col" colspan="2"  >FLASQUES</td>
      <td scope="col" colspan="2"  >MOUILLES</td>
      <td scope="col" rowspan="2" >ACTIONS</td>
      
     
  </tr>
    <tr class="tr_attente_avaries" style="background: linear-gradient(-45deg, #004362, #0183d0) !important; color: white;" >
      
      <td scope="col" >SACS</td>
      <td scope="col"  >POIDS</td>
      <td scope="col"  >SACS</td>
      <td scope="col" >POIDS</td>
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
