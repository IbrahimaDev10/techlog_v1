<?php require('../database.php');
      require("controller/bl_suivant.php");
$c=$_POST['id'];

 ?>

<div id="changer_select">

  <?php    $bl=bl_suivant($bdd,$c);
      $find_bl=$bl->fetch();
        echo $find_bl['max(s.bl_simar)'];
        echo $find_bl['max(m.bl_simar_mo)'];
        if($find_bl['max(s.bl_simar)']>$find_bl['max(m.bl_simar_mo)'] and $find_bl['max(s.bl_simar)']>$find_bl['max(b.id_bal)']){
          $val_bl=$find_bl['max(s.bl_simar)']+1;
        }
        if($find_bl['max(m.bl_simar_mo)']>$find_bl['max(s.bl_simar)'] and $find_bl['max(m.bl_simar_mo)']>$find_bl['max(b.id_bal)']){
          $val_bl=$find_bl['max(m.bl_simar_mo)']+1;
        }
        if($find_bl['max(b.id_bal)']>$find_bl['max(m.bl_simar_mo)'] and $find_bl['max(b.id_bal)']>$find_bl['max(s.bl_simar)']){
          $val_bl=$find_bl['max(b.id_bal)']+1;
        }
           if(empty($find_bl['max(b.id_bal)'])and empty($find_bl['max(m.bl_simar_mo)']) and empty($find_bl['max(s.bl_simar)'])){
          $val_bl=$row['id_dis'].'1';
        }
          ?>
      
      
       
         <?php  if(empty($find_bl['max(b.id_bal)'])and empty($find_bl['max(m.bl_simar_mo)']) and empty($find_bl['max(s.bl_simar)'])){ ?> 
          <label style="margin-top: 5px !important;">BL: <span style="color: red;"><?php echo $find_bl['id_dis_liv'].''.$val_bl; ?></span></label><br>
          <?php   } 
            if(!empty($find_bl['max(b.id_bal)']) or !empty($find_bl['max(m.bl_simar_mo)']) or !empty($find_bl['max(s.bl_simar)'])){  
          ?> <label style="margin-top: 5px !important;">BL: <span style="color: red;"><?php echo $val_bl; ?></span></label><br>
        <?php   } ?>


         <input style="display: none;" id="bl_simar" type="text" name="" value="<?php echo $val_bl; ?>">
 
  
        <?php $choose_dec=$bdd->prepare("SELECT dc.*, sum(liv_sain.poids_liv)  from declaration_liv as dc 
          left join livraison_sain as liv_sain on liv_sain.dec_liv=dc.id_decliv
    
         where dc.id_dis_decliv=? group by dc.id_decliv");
         $choose_dec->bindParam(1,$c);
         $choose_dec->execute();

         $choose_dec2=$bdd->prepare("SELECT dc.*, sum(liv_mouille.poids_mo)  from declaration_liv as dc 
          left join livraison_mouille as liv_mouille on liv_mouille.dec_mo=dc.id_decliv
    
         where dc.id_dis_decliv=? group by dc.id_decliv");
         $choose_dec2->bindParam(1,$c);
         $choose_dec2->execute(); ?>

        <select id="dec_liv">
          <option value="">Choisir une declaration</option>
          <?php while($lesdec=$choose_dec->fetch()){
            $lesdec2=$choose_dec2->fetch();

             $restant_declaration=$lesdec['poids_decliv'] - $lesdec['sum(liv_sain.poids_liv)']-$lesdec2['sum(liv_mouille.poids_mo)'];

              if($restant_declaration>0){
           ?>

           ?>
           <option value="<?php echo $lesdec['id_decliv'];  ?>"> <?php echo $lesdec['num_decliv'] ?><span style="color: red !important;"> restant=</span> <?php echo $restant_declaration;  ?> </option>
         <?php } } ?>
        </select>

         <?php $choose_rel=$bdd->prepare("SELECT rel.*, sum(liv_sain.poids_liv)  from relache as rel 
          left join livraison_sain as liv_sain on liv_sain.relache_liv=rel.id_rel
    
         where rel.id_dis_rel=? group by rel.id_rel");
         $choose_rel->bindParam(1,$c);
         $choose_rel->execute();

         $choose_rel2=$bdd->prepare("SELECT rel.*, sum(liv_mouille.poids_mo)  from relache as rel 
          left join livraison_mouille as liv_mouille on liv_mouille.relache_mo=rel.id_rel
    
         where rel.id_dis_rel=? group by rel.id_rel");
         $choose_rel2->bindParam(1,$c);
         $choose_rel2->execute(); ?>

        <select id="rel_liv">
          <option value="">Choisir une relache</option>
          <?php while($lesrel=$choose_rel->fetch()){
            $lesrel2=$choose_rel2->fetch();

            $restant_relache=$lesrel['poids_rel'] - $lesrel['sum(liv_sain.poids_liv)']-$lesrel2['sum(liv_mouille.poids_mo)'];
           if($restant_relache>0){
           ?>

           <option value="<?php echo $lesrel['id_rel'];  ?>"> <?php echo $lesrel['num_rel'] ?><span style="color: red !important;"> restant=</span> <?php echo $restant_relache;  ?>   </option>
         <?php } } ?>
        </select><br>

        <?php $choose_bon=$bdd->prepare("SELECT bon.*, sum(liv_sain.poids_liv)  from bon_enlevement as bon 
          left join livraison_sain as liv_sain on liv_sain.bl_fournisseur_liv=bon.id_enleve
    
         where bon.id_dis_enleve=? group by bon.id_enleve");
         $choose_bon->bindParam(1,$c);
         $choose_bon->execute();

         $choose_bon2=$bdd->prepare("SELECT bon.*, sum(liv_mouille.poids_mo)  from bon_enlevement as bon 
          left join livraison_mouille as liv_mouille on liv_mouille.bl_fournisseur_mo=bon.id_enleve
    
         where bon.id_dis_enleve=? group by bon.id_enleve");
         $choose_bon2->bindParam(1,$c);
         $choose_bon2->execute();


          ?>

        <select id="bl_fournisseur">
          <option value="">Choisir une bon d'enlevement</option>
          <?php while($lesbon=$choose_bon->fetch()){
            $lesbon2=$choose_bon2->fetch();

             $restant_bon=$lesbon['poids_enleve'] - $lesbon['sum(liv_sain.poids_liv)']-$lesbon2['sum(liv_mouille.poids_mo)'];
           if($restant_bon>0){

           ?>
           <option value="<?php echo $lesbon['id_enleve'];  ?>"> <?php echo $lesbon['num_enleve'] ?><span style="color: red !important;"> restant=</span> <?php echo $restant_bon;  ?> </option>
         <?php } } ?>
        </select><br>
        </div>