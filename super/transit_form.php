<?php
require('../database.php');


//$b=$_POST["idP1"];
function formulaire_insert_dc(){
  
  echo '<div class="form-group position-relative has-icon-left mb-5">';

                                   echo      ' <select id="" name="bl[]" class=" " style="width:45%; margin-right:20px; margin-bottom:10px;" onchange="getpoids()">';

                        echo    '<option value="">choisir bl </option>';
                        require('../database.php');
                            $p=$bdd->prepare("select dis.id_dis, dis.n_bl, mg.mangasin from dispatching as dis
                            inner join mangasin as mg on dis.id_mangasin=mg.id where id_navire=?");
                            $p->bindParam(1,$_GET['m']);
                            $p->execute();
                            
                            while ($a1=$p->fetch()) {
                                                            
                           echo '<option value='; echo   $a1["id_dis"]; echo '>'; echo 'bl: ' .$a1["n_bl"]. ' destination: ' .$a1["mangasin"]; echo'</option>';
                                } 
                                echo '</select>';
                                 echo    '  
                            <input type="text" class="" placeholder="numero manifeste" name="manifeste[]" style="width:45%; margin-right:20px ">';

                                 echo      ' <select id="prod1" name="des_douaniere[]" class=" " style="width:45%; margin-right:20px; margin-bottom:10px;" onchange="getpoids()">';

                        echo    '<option value="">choisir destination_douaniere </option>
                                 <option value="declaration">declaration </option>
                                 <option value="transfert">transfert </option> 
                                 <option value="APE">APE</option>
                                 <option value="Autres">Autres </option>        ';
             
                                
                                echo '</select>';

                       echo    '  
                            <input type="text" class="" placeholder="numero declaration ou transfert" name="numero[]" style="width:45%; margin-right:20px ">
                             


                            <select name="statut_douanier[]" class=" " style="width:45%; margin-right:20px; margin-bottom:10px;">
                              <option selected>Statut douanier</option>
                            <option value="AES">AES</option>
                            <option value=AMEF">AMEF</option>
                            <option value="AUTRES">AUTRES</option>   
                            </select>
                             <input type="text" class="" placeholder="poids declares" name="poids[]" style="width:45%; margin-right:20px ">
                       </div>  
                                   
                                                                          
                            
';
}



if(isset($_POST['idP1'])){
  if ($_POST['idP1']==1) {
formulaire_insert_dc();

  echo   '<button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="valider_transit">validers</button> ';

   }  
                        
else if ($_POST['idP1']==2) {
  formulaire_insert_dc();
  formulaire_insert_dc();
  echo   '<button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="valider_transit">valider</button> ';
   }  


                       
                        
else if ($_POST['idP1']==3) {
  formulaire_insert_dc();
  formulaire_insert_dc();
  formulaire_insert_dc();
  echo   '<button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="valider_transit">valider</button> ';
 }  

else if ($_POST['idP1']==4) {
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
formulaire_insert_dc();
echo   '<button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="valider_transit">valider</button> </div>';
}  

}



  ?>
