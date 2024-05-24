
  <div class=" col col-md-6 col-lg-6">      
<button id="insertion_sain" type="submit" class="btn1" onclick="heure_automatique()"  >Insertion </button>

    <span  class="btn" style="color: white; background: blue;" id="scrollDownBtn" onclick="scrollDown()" title="Défiler vers le bas"> Cliquer ici pour défiler vers le bas
   <i class="fa-solid fa-arrow-down"></i><!-- Utilisez la classe de votre icône -->
</span>

<?php if($type_navire_deb['type']=='VRAQUIER'){

 ?>
 <a style="margin-left: 20px; " class="btn1" data-bs-target="#form_tare_sac" data-bs-toggle="modal"  >Ajouter tare sac</a>
<?php  } ?><span id='info_tare'> </span>
 </div>
 
 <div class="col col-md-6 col-lg-6"> 
 <span style="display:flex; justify-content: center; float:right;"><h6>RECHERCHE </h6>  <input   type="search" id="valeur_filtre_bl" oninput='cherche_par_bl()' > </span>
</div> 

</div>



<div class="col col-md-12 col-lg-12" >
  <div class="table-responsive" id="tableau_sain" >

 

<table  class='table table-hover table-bordered table-striped table-responsive'  border='1'   >
    
 
 <thead style="background: linear-gradient(-45deg, #004362, #0183d0) !important; ">
  <td  colspan="14" class="titreSAIN"  >RECAPITULATI DES BONS DE <?php $element_entete=entete_des_tableaux($bdd,$produit,$poids_sac,$navire,$destination);
if($rown=$element_entete->fetch()){
       echo $rown['des_douane'].' ';
      
       // if($transfert_sain==1){ echo strtoupper($statut); }
       echo strtoupper($statut); ?></td>
  <?php   
           ?>
            <tr>  
            <td  colspan="14" style="background: linear-gradient(-45deg, #004362, #0183d0) !important; color: white;" > <?php echo $rown['produit'].' '.$rown['qualite']; ?> <span style="color:yellow;"> <?php echo $rown['poids_kg'].' KG '.$rown['mangasin']; ?> </span><br> POIDS MANIFEST: <span style="color:yellow;"> <?php  echo $rown['sum(dis.quantite_poids)'].' T'; ?> </span> </td>
            </tr>
          <?php   } ?>

  

       
    
    <tr id="entete_table_sain" style="vertical-align: middle; "   >
      <td  scope="col" style="width: 1%;"  >ROTA <br> TION</td>
      <td  scope="col"   >DATES <?php  if($type_navire_deb['type']=='SACHERIE'){ $filtre_date=filtreur_par_date($bdd,$produit,$poids_sac,$navire,$destination,$statut); 
          }
          if($type_navire_deb['type']=='VRAQUIER'){ $filtre_date=filtreur_par_date_vrac($bdd,$produit,$poids_sac,$navire,$destination,$statut,$client); 
          }
       ?>

        <select id='valeur_filtre_date' style="width: 15px;" data-role='filtrer_par_date'>
        <option value=''>Tous</option>
         <?php while($f_date=$filtre_date->fetch()){ 
            $dateObj = date_create_from_format('Y-m-d', $f_date['dates']);
                $date_converti = $dateObj->format('d-m-Y');
          ?>

          <option value="<?php echo $f_date['dates']; ?>"><?php echo $date_converti; ?></option>
        <?php } ?>
       </select></td>
      <td  scope="col"   >HEURE</td>
      <td  scope="col"  >CALE <?php if($type_navire_deb['type']=='SACHERIE'){ $filtre_cale=filtreur_par_cale($bdd,$produit,$poids_sac,$navire,$destination,$statut); } 
        if($type_navire_deb['type']=='VRAQUIER'){ $filtre_cale=filtreur_par_cale_vrac($bdd,$produit,$poids_sac,$navire,$destination,$statut,$client); }
       ?>

        <select id='valeur_filtre_cale' style="width: 15px;" data-role='filtrer_par_cale' >
        <option value=''>Tous</option>
         <?php while($f_dec=$filtre_cale->fetch()){ ?>
          <option value="<?php echo $f_dec['id_dec'] ?>"><?php echo $f_dec['cales'] ?></option>
        <?php } ?>
       </select> </td>
      <td  scope="col"  > N° BL </td>
      <td  scope="col"  >CAMIONS</td>
      <td  scope="col"  >CHAUFFEUR</td>
      
          <td  scope="col"  >TELEPHONE</td>
      <td  scope="col"  >N°DEC / TRANSFERT <?php if($type_navire_deb['type']=='SACHERIE'){ $filtre_declaration=filtreur_par_declaration($bdd,$produit,$poids_sac,$navire,$destination,$statut); }
      if($type_navire_deb['type']=='VRAQUIER'){ $filtre_declaration=filtreur_par_declaration_vrac($bdd,$produit,$poids_sac,$navire,$destination,$statut,$client); }
       ?>

        <select id='valeur_filtre_declaration' style="width: 15px;"   data-role='filtrer_par_declaration' >
        <option></option>
         <?php while($f_dec=$filtre_declaration->fetch()){ ?>
          <option value="<?php echo $f_dec['id_declaration'] ?>"><?php echo $f_dec['num_declaration'] ?></option>
        <?php } ?>
       </select></td>
      <?php if ($resfil=$resfiltre->fetch()) {
        if(($resfil['poids_kgs']!=0 and !empty($resfil['poids_kgs']) and $type_navire_deb['type']=='VRAQUIER') OR ($type_navire_deb['type']=='SACHERIE')  ){


      ?>
      <td  scope="col"  >NBRE SACS</td>
    <?php } } ?>
    <?php if(!$resfil){ ?>
       <td  scope="col"  >NBRE SACS</td>
     <?php } ?>
     <?php if($type_navire_deb['type']=='SACHERIE'){

 ?>
      <td   scope="col"  >POIDS </td>
    <?php } ?>
      <td   scope="col"  >TICKET PONT</td>
      <td   scope="col"  >NET MARCHAND </td>
      <?php 
      while($filtre=$filtreColonne->fetch()){
        if( $filtre["des_douane"]=="LIVRAISON"){
          ?>
          
          <td  scope="col"  >DESTINATAIRE <?php $filtre_destinataire=filtreur_par_destinataire($bdd,$produit,$poids_sac,$navire,$destination,$statut); 
       ?>

        <select id='valeur_filtre_destinataire' style="width: 15px;" onchange="cherche_par_destinataire()" >
        <option></option>
         <?php while($f_dec=$filtre_destinataire->fetch()){ ?>
          <option value="<?php echo $f_dec['destinataire'] ?>"><?php echo $f_dec['destinataire'] ?></option>
        <?php } ?>
       </select></td>
          <?php  
        }

      } ?>
     
     <td  >OBSERVATION</td>
     <td  id="cacher_cellule" >ACTION</td>


   
     </tr>
      

      
     </thead>
