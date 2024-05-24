<?php

//require('../database.php');


function formulaire_insert_dc(){
  
  
  echo '<div class="form-group position-relative has-icon-left mb-5">';

                                 echo      ' <input type="text" class="" placeholder="numero bl" name="bl[]" style=" margin-right:20px; width:30%;"> 

                                 <select id="prod1" name="client[]" class=" "  onchange="getpoids()" style=" margin-right:10px; margin-bottom:10px;  width:30%;">';

                        echo    '<option value="">choisir un client </option>';
                       require('../database.php');
                            $c=$bdd->query("select * from client");
                             
                            while ($a1=$c->fetch()) {
                                                            
                           echo '<option value='; echo   $a1["id"]; echo '>'; echo  $a1["client"]; '</option>';
                                } 
                              echo  '</select>';

                                echo      ' <select id="prod1" name="produit[]" class=" "  onchange="getpoids()" style=" margin-right:10px; margin-bottom:10px;   width:30%;">';

                        echo    '<option value="">choisir produit </option>';

                        
                           $p=$bdd->query("select * from produit_deb");
                            while ($a2=$p->fetch()) {
                                                            
                           echo '<option value='; echo   $a2["id"]; echo '>'; echo  $a2["produit"]; echo ' ';  echo $a2["qualite"]; echo '</option>';
                                } 
                           echo '</select>'; 
                           echo      ' <select id="type_chargement" name="type[]" class=" "  onchange="get_type()" style=" margin-right:10px; margin-bottom:10px;   width:30%;">';

                        echo    '<option value="">choisir le type de déchargement </option>
                           <option value="1">EN SACHETS </option><option value="2">EN VRAC </option>
                           </select>
                           ';  
           

                       echo    ' 
                     
                       <div id="set_type[]"> 
                                 </div>
                           
                            <input type="text" class="" placeholder="tonnage" name="tonnage[]" style=" margin-right:10px; margin-bottom:10px;  width:30%;">'

                            ;
                                                      echo '                             
 <span id="set_type[]">
 <select name="poids_sac[]" class=" " style=" margin-right:10px; margin-bottom:10px;  width:30%;">
                            <option value="AUCUN">choisir poids sac en KG s\'il existe</option>
                            <option value="0">AUCUN</option>
                            <option value="5">20KG</option>
                            <option value="25">25KG</option>
                            <option value="45">45KG</option>
                            <option value="50">50KG</option>
                                
                            </select>
                            </span>';  
                       

                         echo      ' <select id="des" name="destination[]" class=" "  onchange="getpoids()" style=" margin-right:20px; width:30%;">';

                        echo    '<option value="">choisir destination </option>';
                        
                           $p=$bdd->query("select * from mangasin");
                            while ($a2=$p->fetch()) {
                                                            
                           echo '<option value='; echo   $a2["id"]; echo '>'; echo  $a2["mangasin"]; '</option>';
                                } 
                           echo '</select>'; 
                                 echo      ' <select id="" name="destination_douaniere[]" class=" "  " style=" margin-right:20px";>
                           <option value="TRANSFERT" >transfert</option>
                           <option value="LIVRAISON" >livraison</option> </select>                          </div>' ;                                                  
                            

}


 if(isset($_POST['idP1'])){
  if ($_POST['idP1']==1) {


 
formulaire_insert_dc();

  echo   '<button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="valider_dispat_vrac">valider</button> ';

   }  
                        
else if ($_POST['idP1']==2) {
  formulaire_insert_dc();
  formulaire_insert_dc();
  echo   '<button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="valider_dispat_vrac">valider</button> ';
   }  


                       
                        
else if ($_POST['idP1']==3) {
  formulaire_insert_dc();
  formulaire_insert_dc();
  formulaire_insert_dc();
  echo   '<button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="valider_dispat_vrac">valider</button> ';
 }  

else if ($_POST['idP1']==4) {
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
echo   '<button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="valider_dispat_vrac">valider</button> </div>';
} 
else if ($_POST['idP1']==5) {
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
echo   '<button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="valider_dispat_vrac">valider</button> </div>';
} 
else if ($_POST['idP1']==6) {
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
echo   '<button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="valider_dispat_vrac">valider</button> </div>';
} 
else if ($_POST['idP1']==7) {
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
echo   '<button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="valider_dispat_vrac">valider</button> </div>';
} 
else if ($_POST['idP1']==8) {
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
echo   '<button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="valider_dispat_vrac">valider</button> </div>';
} 
else if ($_POST['idP1']==9) {
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();

echo   '<button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="valider_dispat_vrac">valider</button> </div>';
} 
else if ($_POST['idP1']==10) {
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();


echo   '<button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="valider_dispat_vrac">valider</button> </div>';
} 

else if ($_POST['idP1']==11) {
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();

echo   '<button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="valider_dispat_vrac">valider</button> </div>';
} 
else if ($_POST['idP1']==12) {
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();

echo   '<button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="valider_dispat_vrac">valider</button> </div>';
} 
else if ($_POST['idP1']==13) {
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();

echo   '<button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="valider_dispat_vrac">valider</button> </div>';
} 
else if ($_POST['idP1']==14) {
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();

echo   '<button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="valider_dispat_vrac">valider</button> </div>';
} 
else if ($_POST['idP1']==15) {
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();

echo   '<button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="valider_dispat_vrac">valider</button> </div>';
} 


}


  ?>
 
<script type='text/javascript'>
 
            function getXhr(){
                                var xhr = null; 
                if(window.XMLHttpRequest) // Firefox et autres
                   xhr = new XMLHttpRequest(); 
                else if(window.ActiveXObject){ // Internet Explorer 
                   try {
                            xhr = new ActiveXObject("Msxml2.XMLHTTP");
                        } catch (e) {
                            xhr = new ActiveXObject("Microsoft.XMLHTTP");
                        }
                }
                else { // XMLHttpRequest non supporté par le navigateur 
                   alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest..."); 
                   xhr = false; 
                } 
                                return xhr;
            }
 
            /**
            * Méthode qui sera appelée sur le clic du bouton
            */
            function get_type(){
                var xhr = getXhr();
                // On définit ce qu'on va faire quand on aura la réponse
                xhr.onreadystatechange = function(){
                    // On ne fait quelque chose que si on a tout reçu et que le serveur est OK
                    if(xhr.readyState == 4 && xhr.status == 200){
                        leselect = xhr.responseText;
                        // On se sert de innerHTML pour rajouter les options à la liste
                        document.getElementById('set_type[]').innerHTML = leselect;

                    }
                }
 
                // Ici on va voir comment faire du post
                xhr.open("POST","select_type.php",true);
                // ne pas oublier ça pour le post
                xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
                // ne pas oublier de poster les arguments
                // ici, l'id de l'auteur
                sel = document.getElementById('type_chargementss');
                idtype = sel.options[sel.selectedIndex].value;
                xhr.send("idType="+idtype;
            }
        </script> 