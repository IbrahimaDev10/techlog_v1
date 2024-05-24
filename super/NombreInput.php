<?php

function formulaire_produit(){

   echo   '<div class="form-group position-relative has-icon-left mb-4" >
     <input type="text" class="" placeholder="produit" name="produit[]" style="width:45%; margin-right: 20px; ">
                           
                            <input type="text" class="" placeholder="poids manifest" name="poids_manifest[]" style="width:45%;  margin-right: 20px;">  
  
                       </div>';  
}

if(isset($_POST["idNombre"])){
    

if ($_POST["idNombre"]==1) {
    
formulaire_produit();
   
 } 
else if ($_POST["idNombre"]==2) {
   formulaire_produit();
   formulaire_produit();
 
   } 

else if ($_POST["idNombre"]==3) {
    
   formulaire_produit();
   formulaire_produit();
   formulaire_produit();
                           
         } 

else if ($_POST["idNombre"]==4) {
    formulaire_produit();
    formulaire_produit();
    formulaire_produit();
    formulaire_produit();
 
 } }?> 
