

<?php

require('../database.php');



function formulaire_insert_dc(){
  
  
  echo '<div class="form-group position-relative has-icon-left mb-5">';

                                 echo      ' <input type="text" class="" placeholder="numero bl" name="bl[]" style=" margin-right:20px";>
                                 
                                  <select id="prod1" name="client[]" class=" "  onchange="getpoids()" style=" margin-right:10px; margin-bottom:10px; width:30%;">';

                        echo    '<option value="">choisir un client </option>';
                        require('../database.php');
                            $c=$bdd->query("select * from client");
                             
                            while ($a1=$c->fetch()) {
                                                            
                           echo '<option value='; echo   $a1["id"]; echo '>'; echo  $a1["client"]; '</option>';
                                } 
                              echo  '</select>';

                                echo      ' <select id="prod1" name="produit[]" class=" "  onchange="getpoids()" style=" margin-right:10px;  width:30%;">';

                        echo    '<option value="">choisir produit </option>';
                        
                           $p=$bdd->query("select * from produit_deb");
                            while ($a2=$p->fetch()) {
                                                            
                           echo '<option value='; echo   $a2["id"]; echo '>'; echo  $a2["produit"]; echo ' ';  echo $a2["qualite"]; echo '</option>';
                                } 
                           echo '</select>';              

                       echo    '  
                            <select name="poids_sac[]" class=" " style=" margin-right:10px; margin-bottom:10px;  width:30%;">
                            <option value="">choisir poids sac en KG</option>
                            <option value="5">20KG</option>
                            <option value="25">25KG</option>
                            <option value="45">45KG</option>
                            <option value="50">50KG</option>
                                
                            </select>
                            <input type="text" class="" placeholder="nombre_sac" name="nombre_sac[]" style=" margin-right:10px; margin-bottom:10px;  width:30%;">

                            ';
                       

                         echo      ' <select id="des" name="destination[]" class=" "  onchange="getpoids()" style=" margin-right:20px; width:30%;">';

                        echo    '<option value="">choisir destination </option>';
                        
                           $p=$bdd->query("select * from mangasin");
                            while ($a2=$p->fetch()) {
                                                            
                           echo '<option value='; echo   $a2["id"]; echo '>'; echo  $a2["mangasin"]; '</option>';
                                } 
                           echo '</select>';
                              echo      ' <select id="" name="destination_douaniere[]" class=" "  " style=" margin-right:20px";>
                           <option value="TRANSFERT" >transfert</option>
                    <option value="LIVRAISON" >livraison</option></select>                           </div>' ;                                                
                            

}


if(isset($_POST['idP1'])){
  if ($_POST['idP1']==1) {


 
formulaire_insert_dc();

  echo   '<button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="valider_dispat">valider</button> ';

   }  
                        
else if ($_POST['idP1']==2) {
  formulaire_insert_dc();
  formulaire_insert_dc();
  echo   '<button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="valider_dispat">valider</button> ';
   }  


                       
                        
else if ($_POST['idP1']==3) {
  formulaire_insert_dc();
  formulaire_insert_dc();
  formulaire_insert_dc();
  echo   '<button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="valider_dispat">valider</button> ';
 }  

else if ($_POST['idP1']==4) {
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
echo   '<button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="valider_dispat">valider</button> </div>';
} 


}





  ?>