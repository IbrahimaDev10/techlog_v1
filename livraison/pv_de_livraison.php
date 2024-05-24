<?php 

require("../database.php");
require("requete.php");

$c=$_POST['id'];
 ?>
 <div id="pdf">
<div style="background: white;">
 <div class="container-fluid">
  <div class="row">
   <div class=" col-md-3 col-lg-3"> 
  <img src="../img/logo_finaly2.PNG" style="height: 40px; width: 200px;">
  </div>

  </div>
</div>
 <div class="container-fluid">
  <div class="row">
  <div class=" col-md-12 col-lg-12" > <h6 style="font-weight: bolder; color: rgb(50, 159, 170); margin-bottom: 2px;">Societé des Industries Maritimes</h6>
  <h6 style=" color: rgba(50, 159, 218, 0.9); margin-bottom: 2px;">Shipping - Manutention - Transit</h6>
  <h6 style="float: left; color: rgba(50, 159, 218, 0.9); ">Logistique - Transport -Entreposage</h6>
</div>
 <div class=" col-md-3 col-lg-3">
    </div>
    <div class="col-md-9 col-lg-9" >
   
  <h6 style="float: right;">Dakar le ................................</h6>  
  </div>


 </div>
  </div>

  <div class="table-responsive" id="reception"  > 
    
<center> 
  <table style="width: 50%;" class='table table-hover table-bordered table-striped table-responsive' id='table' border='1'  >
    
 
<thead>
         
          



  


  
 <tr class="" style="border: 2px; border-color: white; background: blue; color:white; text-align: center; text-decoration: underline; font-weight: bold;"  >
     <th colspan="2"> RECEPTION</th>      
  </tr>
   <tr   style="text-align: center; vertical-align: middle; font-size: 12px;  "  > 
            <td  style="color: black;"  > NATURE DES SACS </td>
            <td id="colcol"  > NOMBRE DE SACS </td>
            
           </tr>

</thead>
<tbody>
	<?php
         
  $Sains_Recap=sain_reception($bdd,$c);
  $SomAvr_DEPART_Recap=avaries_reception($bdd,$c);
  $SomRa_DEPART_Recap=reception_avaries_reception($bdd,$c);
  $SomRa_DEPART_Recap->execute();




 while($sain=$Sains_Recap->fetch()){ 
 	$avr=$SomAvr_DEPART_Recap->fetch();

 	$ra=$SomRa_DEPART_Recap->fetch();

 	$sac_sains=$sain['sum(sac_recep)'] -($avr['sum(sac_flasque_avr)']+$avr['sum(sac_mouille_avr)']);
 	$cumul_sac=$sac_sains + $ra['sum(sac_mouille_ra)'] + $ra['sum(sac_flasque_ra)'];
   

	  ?>
<tr   style="text-align: center; vertical-align: middle; font-size: 12px;  "  > 
            <td  style="color: black;"  >SACS SAINS </td>
            <td id="colcol"  > <?php echo number_format($sain['sum(sac_recep)'],0,',',' '); ?> </td>
            
           </tr>
      <tr   style="text-align: center; vertical-align: middle; font-size: 12px;  "  > 
            <td  style="color: black;"  >FLASQUE RECEPTION </td>
            <td id="colcol"  > <?php echo number_format($avr['sum(sac_flasque_avr)'],0,',',' '); ?> </td>
            
           </tr>
       <tr   style="text-align: center; vertical-align: middle; font-size: 12px;  "  > 
            <td  style="color: black;"  >MOUILLES RECEPTION </td>
            <td id="colcol"  >  <?php echo number_format($avr['sum(sac_mouille_avr)'],0,',',' '); ?> </td>
            
           </tr>  
        <tr   style="text-align: center; vertical-align: middle; font-size: 12px;  "  > 
            <td  style="color: black;"  >FLASQUES DEBARQUEMENT </td>
            <td id="colcol"  > <?php echo number_format($ra['sum(sac_flasque_ra)'],0,',',' '); ?> </td>
            
           </tr>   
            <tr   style="text-align: center; vertical-align: middle; font-size: 12px;  "  > 
            <td  style="color: black;"  >MOUILLES DEBARQUEMENT </td>
            <td id="colcol"  > <?php echo number_format($ra['sum(sac_mouille_ra)'],0,',',' '); ?> </td>
            
           </tr> 

            <tr   style="text-align: center; vertical-align: middle; font-size: 12px; background: black; color: white;  "  > 
            <td  style="color: white;"  >CUMUL SACS RECEPTIONNES </td>
            <td id="colcol" style="color: white;" > <?php echo number_format($cumul_sac,0,',',' '); ?> </td>
            
           </tr>  
           <?php } ?> 	

</tbody>
</table>
</center>
</div>





   


</div>
