<?php
//page get_formulaire_insert_dc()
//require('../database.php');
    function formulaire_insert_dc(){
        // Code de la fonctionecho '<div class="form-group position-relative has-icon-left mb-5">';

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

    $response = array('html' => formulaire_insert_dc());
    echo json_encode($response);

?>