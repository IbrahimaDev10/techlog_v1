<?php
require('../database.php');


//$b=$_POST["idP1"];
function formulaire_insert_dc(){
  
  echo '<div class="form-group position-relative has-icon-left mb-5">';

                                 echo      ' <select id="prod1" name="produit[]" class=" " style="width:45%; margin-right:20px; margin-bottom:10px;" onchange="getpoids()">';

                        echo    '<option value="">choisir produit </option>';
                        require('../database.php');
                            $p=$bdd->query("select * from produit_deb");
                            while ($a1=$p->fetch()) {
                                                            
                           echo '<option value='; echo   $a1["id"]; echo '>'; echo  $a1["produit"]; echo" "; echo'<pre>';  echo $a1["qualite"]; echo '</pre></option>';
                                } 
                                echo '</select>';

                       echo    '  
                            <input type="text" class="" placeholder="nombre_sac" name="nombre_sac[]" style="width:45%; margin-right:20px ">
                              <select name="poids_sac[]" class=" " style="width:45%; margin-right:20px; margin-bottom:10px;">
                            <option value="">choisir poids sac en KG</option>
                            <option value="5">20KG</option>
                            <option value="25">25KG</option>
                            <option value="45">45KG</option>
                            <option value="50">50KG</option>
                                
                            </select>
                       <input type="text" class="" placeholder="nom_chargeur" name="nom_chargeur[]" style="width:45%; margin-right:20px "> </div>                                                  
                            
';
}




if(isset($_POST['idP1'])){
  if ($_POST['idP1']==1) {
formulaire_insert_dc();

  echo   '<button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="valider_cargo_plan1">valider</button> ';

   }  
                        
else if ($_POST['idP1']==2) {
  formulaire_insert_dc();
  formulaire_insert_dc();
  echo   '<button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="valider_cargo_plan1">valider</button> ';
   }  


                       
                        
else if ($_POST['idP1']==3) {
  formulaire_insert_dc();
  formulaire_insert_dc();
  formulaire_insert_dc();
  echo   '<button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="valider_cargo_plan1">valider</button> ';
 }  

else if ($_POST['idP1']==4) {
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
echo   '<button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="valider_cargo_plan1">valider</button> </div>';
}  

}


if(isset($_POST['idP2'])){
  if ($_POST['idP2']==1) {
formulaire_insert_dc();

  echo   '<button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="valider_cargo_plan2">valider</button> ';

   }  
                        
else if ($_POST['idP2']==2) {
  formulaire_insert_dc();
  formulaire_insert_dc();
  echo   '<button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="valider_cargo_plan2">valider</button> ';
   }  


                       
                        
else if ($_POST['idP2']==3) {
  formulaire_insert_dc();
  formulaire_insert_dc();
  formulaire_insert_dc();
  echo   '<button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="valider_cargo_plan2">valider</button> ';
 }  

else if ($_POST['idP2']==4) {
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
echo   '<button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="valider_cargo_plan2">valider</button> </div>';
}  

}

if(isset($_POST['idP3'])){
  if ($_POST['idP3']==1) {
formulaire_insert_dc();

  echo   '<button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="valider_cargo_plan3">valider</button> ';

   }  
                        
else if ($_POST['idP3']==2) {
  formulaire_insert_dc();
  formulaire_insert_dc();
  echo   '<button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="valider_cargo_plan3">valider</button> ';
   }  


                       
                        
else if ($_POST['idP3']==3) {
  formulaire_insert_dc();
  formulaire_insert_dc();
  formulaire_insert_dc();
  echo   '<button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="valider_cargo_plan3">valider</button> ';
 }  

else if ($_POST['idP3']==4) {
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
echo   '<button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="valider_cargo_plan3">valider</button> </div>';
}  

}

if(isset($_POST['idP4'])){
  if ($_POST['idP4']==1) {
formulaire_insert_dc();

  echo   '<button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="valider_cargo_plan4">valider</button> ';

   }  
                        
else if ($_POST['idP4']==2) {
  formulaire_insert_dc();
  formulaire_insert_dc();
  echo   '<button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="valider_cargo_plan4">valider</button> ';
   }  


                       
                        
else if ($_POST['idP4']==3) {
  formulaire_insert_dc();
  formulaire_insert_dc();
  formulaire_insert_dc();
  echo   '<button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="valider_cargo_plan4">valider</button> ';
 }  

else if ($_POST['idP4']==4) {
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
echo   '<button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="valider_cargo_plan4">valider</button> </div>';
}  

}

if(isset($_POST['idP5'])){
  if ($_POST['idP5']==1) {
formulaire_insert_dc();

  echo   '<button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="valider_cargo_plan5">valider</button> ';

   }  
                        
else if ($_POST['idP5']==2) {
  formulaire_insert_dc();
  formulaire_insert_dc();
  echo   '<button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="valider_cargo_plan5">valider</button> ';
   }  


                       
                        
else if ($_POST['idP5']==3) {
  formulaire_insert_dc();
  formulaire_insert_dc();
  formulaire_insert_dc();
  echo   '<button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="valider_cargo_plan5">valider</button> ';
 }  

else if ($_POST['idP5']==4) {
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
echo   '<button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="valider_cargo_plan5">valider</button> </div>';
}  

}
  ?>