<?php require('../database.php');
      require("controller/bl_suivant.php");
      require("controller/control_choix_des_excedents.php");
      require("controller/control_excedent.php");


      $produit=$_POST['produit'];
      $poids_sac=$_POST['poids_sac'];
      $navire=$_POST['navire'];
      $destination=$_POST['destination'];

 ?>

<div id="changer_select">

  <?php   $bl_liv=bl_suivant_liv($bdd,$produit,$poids_sac,$navire,$destination);
          $bl_bal=bl_suivant_bal($bdd,$produit,$poids_sac,$navire,$destination);
          $bl_mo=bl_suivant_mo($bdd,$produit,$poids_sac,$navire,$destination);
          $number=number_of_livraison($bdd,$navire,$destination);
          // $find_bl=$bl->fetch();
          $bl_livs=$bl_liv->fetch();
          $bl_bals=$bl_bal->fetch();
          $bl_mos=$bl_mo->fetch();
          $numbers=$number->fetch();

          /*
        
       if($bl_livs['max(s.bl_simar)']> $bl_mos['max(m.bl_simar_mo)'] and $bl_livs['max(s.bl_simar)']>$bl_bals['max(b.bl_simar_bal)']){
          $val_bl=$destination.$numbers['nombre_de_lignes'].$bl_livs['max(s.bl_simar)']+1; 
          $vrai_valeur=$bl_livs['max(s.bl_simar)']+1;
        } 
      if( $bl_mos['max(m.bl_simar_mo)']>$bl_livs['max(s.bl_simar)'] and  $bl_mos['max(m.bl_simar_mo)']> $bl_bals['max(b.bl_simar_bal)']){
          $val_bl=$destination.$numbers['nombre_de_lignes'].$bl_mos['max(m.bl_simar_mo)']+1;
           $vrai_valeur=$bl_mos['max(s.bl_simar_mo)']+1;
       }
          
        if( $bl_bals['max(b.bl_simar_bal)']>$bl_mos['max(m.bl_simar_mo)'] and  $bl_bals['max(b.bl_simar_bal)']>$bl_livs['max(s.bl_simar)']){
          $val_bl= $destination.$numbers['nombre_de_lignes'].$bl_bals['max(b.bl_simar_bal)']+1;
           $vrai_valeur=$bl_bals['max(s.bl_simar_bal)']+1;
        }
           if(empty( $bl_bals['max(b.bl_simar_bal)']) and empty($find_bl['max(m.bl_simar_mo)']) and empty($bl_livs['max(s.bl_simar)'])){
          $val_bl=$destination.$numbers['nombre_de_lignes'].'1';
          $vrai_valeur=1; 
          ?>
          <label style="margin-top: 5px !important;">BL: <span style="color: red;"><?php echo $val_bl; ?></span></label><br>
        <?php   } ?>
      
      
       
        
          <?php   
            if(!empty($bl_bals['max(b.bl_simar_bal)']) or !empty($bl_mos['max(m.bl_simar_mo)']) or !empty($bl_livs['max(s.bl_simar)'])){  
          ?> <label style="margin-top: 5px !important;">BL: <span style="color: red;"><?php echo $val_bl; ?></span></label><br>
        <?php   }  */
 ?> 

       <!--  <input  id="bl_simar" type="text" name="" value="<?php //echo $vrai_valeur; ?>"> !-->
       <br>
          <input  id="bl_simar" type="text" name="" placeholder="BL SIMAR">
  
        <?php $choose_dec=declaration_livres_sain($bdd,$produit,$poids_sac,$navire,$destination);
            //  $choose_dec2=declaration_livres_mouille($bdd,$produit,$poids_sac,$navire,$destination);
             // $choose_dec3=declaration_livres_balayure($bdd,$produit,$poids_sac,$navire,$destination);

          ?>
          <br><br>

        <select id="dec_liv">
          <option value="">Choisir une declaration</option>
          <?php while($lesdec=$choose_dec->fetch()){
          //  $lesdec2=$choose_dec2->fetch();
           // $lesdec3=$choose_dec3->fetch();

             $restant_declaration=$lesdec['poids_decliv'] - $lesdec['sum(liv_sain.poids_liv)'];

             if($restant_declaration>0){
               
           ?>

           ?>
           <option value="<?php echo $lesdec['id_decliv'];  ?>"> <?php echo $lesdec['num_decliv'] ?><span style="color: red !important;"> restant=</span> <?php echo $restant_declaration;  ?> </option>
         <?php } } ?>
        </select>

         <?php  /* $choose_rel= relache_livres_sain($bdd,$produit,$poids_sac,$navire,$destination);
              $choose_rel2= relache_livres_mouille($bdd,$produit,$poids_sac,$navire,$destination);
               $choose_rel3= relache_livres_balayure($bdd,$produit,$poids_sac,$navire,$destination); */
               //$relache_simar=relache_simar($bdd); ?>

<?php /* $cherche_relache=relache_ou_non($bdd,$produit,$poids_sac,$navire,$destination);
          $ch=$cherche_relache->fetch();
          if(!empty($ch['banque'])){  ?>
            <br><br>
        <select id="rel_liv">
          <option value="">Choisir une relache</option>
          <?php while($lesrel=$choose_rel->fetch()){
         /*   $lesrel2=$choose_rel2->fetch();
            $lesrel3=$choose_rel3->fetch(); */
            

          /*     $restant_relache=$lesrel['quantite_relache_init'] - $lesrel['sum(liv.poids_liv)'];
        if($lesrel['status']==1){
              $qt_depasse=$lesrel['sum(liv_sain.poids_liv)']+$lesrel2['sum(liv_mouille.poids_mo)']+$lesrel3['sum(liv_balayure.poids_bal)'];
            } 
           if($restant_relache>0 ){
           ?>
             <?php //if($lesrel['status']==0){ ?>
           <option     value="<?php echo $lesrel['id_bon_relache'];  ?>"> <?php echo $lesrel['numero_relache'] ?>  <?php  echo 'restant '.$restant_relache;  ?> </option>
         <?php } }  ?>
           
  
        
        </select><br><br>
        <?php //}  //FERMETURE EMPTY RELACHE */ ?> 

        <?php
            // LES BONS D'ENLEVEMENTS

          $choose_bon=bon_livres_sain($bdd,$produit,$poids_sac,$navire,$destination);
             // $choose_bon2=bon_livres_mouille($bdd,$produit,$poids_sac,$navire,$destination);
            //  $choose_bon3=bon_livres_balayure($bdd,$produit,$poids_sac,$navire,$destination); 


          ?>

       <select id="bl_fournisseur">
          <option value="">Choisir un bon d'enlevement</option>
          <?php while($lesbon=$choose_bon->fetch()){
           // $lesbon2=$choose_bon2->fetch();
          //  $lesbon3=$choose_bon3->fetch();

             $restant_bon=$lesbon['quantite'] - $lesbon['sum(liv_sain.poids_liv)'];
           if($restant_bon>0){

           ?>
           <option value="<?php  echo $lesbon['id_bon'];  ?>"> <?php echo $lesbon['numero_bon'] ?><span style="color: red !important;"> restant=</span> <?php echo $restant_bon;  ?> </option>!-->
         <?php }
          } ?>
       </select>    <br><br> 
        </div>
