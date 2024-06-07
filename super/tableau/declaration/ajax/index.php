<?php 
require('../../../../database.php');
require('../../../controller/declaration/tableau_declarationController.php');
$b=$_POST["navire"];

$nav=navire_type($bdd,$b);

$types=$nav->fetch();

 ?>
            <div class="container-fluid" id='content'>
            	<div class="row">
          
             <div  id="tab_par_connaissement" class="table-responsive" > 
             <table id="tab_par_receptionnaire2" class='table table-responsive table-hover table-bordered '  border='2' style="border-color: black; " >
            
          <thead> 
          <tr id='entete_head' style="text-align: center;">  <td colspan="6">DECLARATIONS <br>
          	NAVIRE: <?php echo $types['navire'] ?></td></tr>  
 <tr style="color:white; font-weight: bold; color:white; font-weight: bold; background: linear-gradient(to bottom, #FFFFFF, rgb(0,141,202));  border-color: white; text-align: center; font-size: 14px;" border='5' >
                                 <th  scope="col" >DECLARATION</th>
                                 <th  scope="col" >BL<br>
                                <th  scope="col" >PRODUIT</th>
                                
                               
                                <th  scope="col" >DESTINATION</th>
                                
                                <th  scope="col" >POIDS</th>
                          
                               <th  scope="col" >DECLARATION (T)</th> 
                              
                            
                                
                                


                                
                              </tr>
                              </thead>
                               <tbody style="font-weight: bold;">
                          <?php affichage_declaration($bdd,$b); ?>

                               </tbody>
                           </table>
                       </div>
                   </div>
               </div>
