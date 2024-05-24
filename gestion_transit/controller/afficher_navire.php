<?php 
function afficher_navire($bdd){
	$navire=$bdd->query("SELECT *from navire_deb");
	return $navire;
}

function afficher_navire2($bdd,$navire){
	$navire2=$bdd->prepare("SELECT navire from navire_deb where id=?");
	$navire2->bindParam(1,$navire);
	$navire2->execute();
	return $navire2;
}
function afficher_bl_entrant($bdd,$navire){
	$bl_entrant=$bdd->prepare("SELECT ex.*, re.*,cn.*, dis.*,mg.mangasin,dc.* from transit_extends as ex
		inner join dispat as dis on dis.id_dis=ex.id_bl_extends
		
      inner join numero_connaissement as cn on cn.id_connaissement=dis.id_con_dis
	inner join transit_reelle as re on re.id_trans_reelle=ex.id_trans_reelle
	
	inner join mangasin as mg on mg.id=dis.id_mangasin 
	 inner join declaration as dc on dc.id_declaration=ex.id_declaration_extends
	  where ex.id_trans_navire_extends=?");
	$bl_entrant->bindParam(1,$navire);
	$bl_entrant->execute();
	return $bl_entrant;
}


function afficher_declaration($bdd,$navire){

    $nombre_dec=$bdd->prepare("SELECT ex.*,re.*, dis.*, p.produit,p.qualite, mg.mangasin, cli.client, ds.*,cn.*,dc.*  from transit_extends as ex
      inner join transit_reelle as re on re.id_trans_reelle=ex.id_trans_reelle
      inner join dispat as dis on dis.id_dis=ex.id_bl_extends
     
      inner join numero_connaissement as cn on cn.id_connaissement=dis.id_con_dis
      inner join produit_deb as p on p.id=dis.id_produit
      inner join mangasin as mg on dis.id_mangasin=mg.id
      inner join client as cli on cli.id=dis.id_client
      inner join declaration as dc on dc.id_declaration=ex.id_declaration_extends
      left join declaration_sortie as ds on ds.id_dec_entrant=ex.id_trans_extends
      WHERE ex.id_trans_navire_extends=? order by  cn.num_connaissement,dc.id_declaration, ex.id_trans_extends, dis.id_mangasin ");
     $nombre_dec->bindParam(1,$navire);
     $nombre_dec->execute();
     $nomb=$nombre_dec->fetchAll(PDO::FETCH_ASSOC);
     //$nombre=$nombre_dec->fetch();

     
     ?>
              <center>
             
              </center>


            <div class="table-responsive" border=1> 
             <table class='table table-responsive table-hover table-bordered table-striped' id="fetch_cargo_plan" border='5' style="border-color: black; " >
            
          <thead>  
          	<?php $navire2=afficher_navire2($bdd,$navire); 
          	if($nav=$navire2->fetch()){
          	 ?>
          	
 <tbody>
   <td style="text-align: center; background: black; color:white;" colspan="14"> <h6 class="hdeclaration text-white" style="font-size: 14px;" >GESTION DU TRANSIT (ENTREE EN ENTREPOT) <br><?php echo $nav['navire']; ?></h6></td> <?php } ?> 
   <tr>
       

       
       </tr>
          
 <tr style="color:white; font-weight: bold; background: blue;  border-color: white; text-align: center; font-size: 12px; vertical-align: middle; " border='5' >                             
                                 <th rowspan="2"  scope="col" >N° BL </th>
                                <th rowspan="2" scope="col" >PRODUIT </th>
                                <th rowspan="2" scope="col" >MANIFESTE </th>
                                 <td  style="text-align: center; color:white; font-weight: bold; background: orange; font-size: 12px; " colspan="7"> <h6 class="hdeclaration text-white"  >DECLARATION ENTRANT <br></h6></td>
                                 <td colspan="4"  style="text-align: center; color:white; font-weight: bold; background: linear-gradient(to bottom, #FFFFFF, rgb(100,80,50));  font-size: 12px; " > <h6 class="hdeclaration text-white" >DECLARATION SORTANT <br></h6></td>
                                 </tr>
                                 <td style="background: orange; color: white !important; font-size: 12px;"  scope="col" >N° DECLARATION </td>
                             
 
                              
                             
                                
                                 <th  style="background: orange; color: white; font-size: 12px;"  scope="col" >DATE D'ECHEANCE </th>
                                <th style="background: orange; color: white; font-size: 12px;" scope="col" >ENTREPÔTS </th>
                                
                                <th style="background: orange; color: white; font-size: 12px;" scope="col" >QUANTITE DECLAREE </th>
                               <th style="background: orange; color: white; font-size: 12px;" scope="col" >CUMUL DECLARES </th>
                                 
                                 <th style="background: orange; color: white; font-size: 12px;" scope="col" >RESTE A DECLARER </th>

                                <th style="background: orange; color: white; font-size: 12px;" scope="col" >ACTIONS</th>
                                 <th  style="background: linear-gradient(to bottom, #FFFFFF, rgb(100,80,50)); color: white; font-size: 12px;"  scope="col" >N° DECLARATION</th>
                                 
                                  <th  style="background: linear-gradient(to bottom, #FFFFFF, rgb(100,80,50)); color: white; font-size: 12px;"  scope="col" >QUANTITE</th>
                                   <th  style="background: linear-gradient(to bottom, #FFFFFF, rgb(100,80,50)); color: white; font-size: 12px;"  scope="col" >CUMUL DECLARE</th>
                                   <th  style="background: linear-gradient(to bottom, #FFFFFF, rgb(100,80,50)); color: white; font-size: 12px;"  scope="col" >RESTE A DECLARER</th>
                                 


                             </tr>
                              </thead>
                               <tbody style="font-weight: bold; font-size: 12px;">
                                 
    <?php
            $num_dec='NULL';
            $rowspanDestination = 0;
            $produit='NULL';
            $poids=0;
            $rowspanProduit=0;
            $manifest='NULL';
            $num_con='NULL';
            $rowspanManifest=0;
            $num_dec2='NULL';
            $rowspanDestination2 = 0;
            $client='NULL';
            $rowspanClient=0;
            $bl='NULL';
            $rowspanBl=0;
            $num_dec3='NULL';
            $num_con3='NULL';
            $reste_declarer=0;
            $rowspanDestination3 = 0;
              $num_dec4='NULL';
              $num_mangasin4='NULL';
              $num_dec_mg4='NULL';

              $num_dec_action='NULL';
              $num_mang_action='NULL';
              $rowspanAction=0;
              $dec_action='NULL';
        
            $rowspanDestination4 = 0;
            $num_dec_sortie='NULL';
            $rowspanDestinationSortie = 0;
            $num_dec_sortie2='NULL';
            $mangasin2='NULL';
            $c2='NULL';
            $rowspanDestinationSortie2 = 0;
            $num_dec_sortie3='NULL';
            $c3='NULL';
            $rowspanDestinationSortie3 = 0;

            $num_dec_sortie4='NULL';
            $mangasin4='NULL';
            $c4='NULL';

            $rowspanDestinationSortie4 = 0;

            $num_dec_sortie5='NULL';
            $rowspanDestinationSortie5 = 0;
            $mangasin5='NULL';
            $c5='NULL';

            $num_dec_sortie6='NULL';
            $rowspanDestinationSortie6 = 0;
            $rowspanVides=0;
     foreach ($nomb as $row) { 
      
       $somme_dec=$bdd->prepare("SELECT ex.id_trans_reelle, sum(dis.quantite_poids), dis.id_con_dis, sum(ex.poids_declarer_extends)  from transit_extends as ex
     /* inner join transit_reelle as re on re.id_trans_reelle=ex.id_trans_reelle */
      inner join dispat as dis on dis.id_dis=ex.id_bl_extends 
          
     /* inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis 
      LEFT join declaration_sortie as ds on ds.id_dec_entrant=ex.id_trans_extends */

      WHERE ex.id_trans_navire_extends=? and dis.id_con_dis=? order by
      dis.id_con_dis");
     $somme_dec->bindParam(1,$navire);
      $somme_dec->bindParam(2,$row['id_con_dis']);
     $somme_dec->execute();
     $som=$somme_dec->fetch();

     $somme_manifest=$bdd->prepare('SELECT  sum(dis.quantite_poids), dis.id_con_dis,nc.*  from dispat as dis     
      left join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
      WHERE nc.id_navire=? and dis.id_con_dis=? order by nc.num_connaissement');
       $somme_manifest->bindParam(1,$row['id_navire']);
        $somme_manifest->bindParam(2,$row['id_con_dis']);
        $somme_manifest->execute();
        $som_manif=$somme_manifest->fetch();

     $reste_declarer=$som_manif['sum(dis.quantite_poids)']-$som['sum(ex.poids_declarer_extends)'];
    // $reste_declarer_sortie=$som_manif['sum(dis.quantite_poids)']-$som['sum(ds.poids_decliv)']; 

      ?>
     <tr style="background: white; vertical-align: middle; text-align: center;">
     <span style="display: none;" id="<?php echo $row['id_trans_extends'].'id_trans_reelle' ?>"><?php echo $row['id_trans_reelle']; ?></span> 
     <span style="display: none;" id="<?php echo $row['id_trans_extends'].'id_dis' ?>"><?php echo $row['id_dis']; ?></span>
        <span style="display: none;" id="<?php echo $row['id_trans_extends'].'id_dis_text' ?>"><?php echo $row['num_connaissement']; ?> DESTINATION <?php echo $row['mangasin']; ?> PRODUIT <?php echo $row['produit']; ?> <?php echo $row['qualite']; ?> <?php echo $row['poids_kg'].' KG'; ?></span>
     <span style="display: none;" id="<?php echo $row['id_trans_extends'].'id_declaration' ?>"><?php echo $row['id_declaration']; ?></span>
      <span style="display: none;" id="<?php echo $row['id_trans_extends'].'num_declaration' ?>"><?php echo $row['num_declaration']; ?></span>
     
     <span style="display: none;" id="<?php echo $row['id_trans_extends'].'id_navire' ?>"><?php echo $row['id_navire']; ?></span>
      
   
      <?php    
    // Colonne Destination
    if ($num_dec!= $row['num_connaissement'] )  {
        $rowspanDestination = 0; // Réinitialisation du rowspan pour la nouvelle destination
        $num_dec = $row['num_connaissement'];
        foreach ($nomb as $r) {
            if ($r['num_connaissement'] === $num_dec) {
              //ici on compte le nombre de destination
                $rowspanDestination++;
            }
        }
        // Colonne Destination
?>
        <td style="vertical-align: middle;" rowspan='<?php echo $rowspanDestination; ?>'><?php echo $row['num_connaissement']; ?> 
         </td>
         
         

      <?php   } ?>

        <?php    
    // Colonne Destination
    if ($produit!= $row['id_produit'] or $poids!=$row['poids_kg'] or $num_con!=$row['num_connaissement']  )  {
        $rowspanProduit = 0; // Réinitialisation du rowspan pour la nouvelle destination
        $produit = $row['id_produit'];
        $poids = $row['poids_kg'];
        $num_con=$row['num_connaissement'];
        foreach ($nomb as $r) {
            if ($r['id_produit'] === $produit and $r['poids_kg']===$poids and $r['num_connaissement']===$num_con ) {
              //ici on compte le nombre de destination
                $rowspanProduit++;
            }
        }
        // Colonne Destination
?>
     
         <td rowspan='<?php echo $rowspanProduit; ?>' > <?php  echo $row['produit'].' '.$row['qualite'].' '.$row['poids_kg'].' kg'; ?>  </td>
         

      <?php   } ?>


       <?php    
    // Colonne Destination
    if ($manifest!= $row['num_connaissement'] )  {
        $rowspanManifest = 0; // Réinitialisation du rowspan pour la nouvelle destination
        $manifest = $row['num_connaissement'];
       
        foreach ($nomb as $r) {
            if ($r['num_connaissement'] === $manifest ) {
              //ici on compte le nombre de destination
                $rowspanManifest++;
            }
        }
        // Colonne Destination
?>
     
         <td rowspan='<?php echo $rowspanManifest; ?>' > <?php echo $som_manif['sum(dis.quantite_poids)'] ; ?>  </td>
         

      <?php   } ?>

     
      


     <?php    
    // Colonne Destination
    if ($num_dec3!= $row['id_declaration_extends'] or $num_con3!= $row['num_connaissement']  )  {
        $rowspanDestination3 = 0; // Réinitialisation du rowspan pour la nouvelle destination
        $num_dec3 = $row['id_declaration_extends'];
        $num_con3= $row['num_connaissement']; 
        foreach ($nomb as $r) {
            if ($r['id_declaration_extends'] === $num_dec3 and !empty($row['id_declaration_extends']) and $r['num_connaissement']===$num_con3) {
              //ici on compte le nombre de destination
                $rowspanDestination3++;
            }
        }
        // Colonne Destination
?>

     
       <td rowspan="<?php echo $rowspanDestination3; ?>"  > <?php echo $row['num_declaration'];  ?><?php echo $rowspanDestination3; ?> </td>
       <td rowspan="<?php echo $rowspanDestination3; ?>" > <?php echo $row['date_echeance']; ?> </td>
      <?php   } ?>
         
          
           
            
              <?php    
    // Colonne Destination
    if ($num_dec4!= $row['num_connaissement'] or $num_mangasin4!=$row['mangasin'] or $num_dec_mg4!=$row['id_declaration_extends'] )  {
        $rowspanDestination4 = 0; // Réinitialisation du rowspan pour la nouvelle destination
        $num_dec4 = $row['num_connaissement'];
        $num_mangasin4=$row['mangasin'];
        $num_dec_mg4=$row['id_declaration_extends'];
        foreach ($nomb as $r) {
            if ($r['num_connaissement'] === $num_dec4  and $r['mangasin']===$num_mangasin4 and $r['id_declaration_extends']===$num_dec_mg4) {
              //ici on compte le nombre de destination
                $rowspanDestination4++;
            }
        }
        // Colonne Destination
?>

     
       <td rowspan="<?php echo $rowspanDestination4; ?>"  > <?php echo $row['mangasin']; ?> <?php echo $rowspanDestination4; ?> </td>
        <td id="<?php echo $row['id_trans_extends'].'poids' ?>" rowspan="<?php echo $rowspanDestination4; ?>" <?php if($row['reelle']=='true'){ ?> style="vertical-align: middle; background: green; color:white;" <?php  } ?> > <?php echo $row['poids_declarer_extends']; ?></td>
        <span  id="<?php echo $row['id_trans_extends'].'poidsS' ?>"><?php echo $row['poids_declarer_extends']; ?></span>
      <?php   } ?>
         
           
         
    <?php    
    // Colonne Destination
    if ($num_dec2!= $row['num_connaissement'] )  {
        $rowspanDestination2 = 0; // Réinitialisation du rowspan pour la nouvelle destination
        $num_dec2 = $row['num_connaissement'];
        foreach ($nomb as $r) {
            if ($r['num_connaissement'] === $num_dec2 ) {
              //ici on compte le nombre de destination
                $rowspanDestination2++;
            }
        }
        // Colonne Destination
?>
        <td style="vertical-align: middle;" rowspan='<?php echo $rowspanDestination2; ?>'><?php echo $som['sum(ex.poids_declarer_extends)']; ?></td>
         <td style="vertical-align: middle;" rowspan='<?php echo $rowspanDestination2; ?>'><?php echo $reste_declarer; ?></td>
        
      <?php   } ?>
     
              
<?php    
    // Colonne Destination
    if ($num_dec_action!= $row['num_connaissement'] or $num_mang_action!=$row['mangasin']  or $dec_action!=$row['id_declaration_extends'] )  {
        $rowspanAction = 0; // Réinitialisation du rowspan pour la nouvelle destination
        $num_dec_action = $row['num_connaissement'];
        $num_mang_action=$row['mangasin'];
        $dec_action=$row['id_declaration_extends'];
        foreach ($nomb as $r) {
            if ($r['num_connaissement'] === $num_dec_action  and $r['mangasin']===$num_mang_action and $r['id_declaration_extends']===$dec_action) {
              //ici on compte le nombre de destination
                $rowspanAction++;
            }
        }
        // Colonne Destination
?>
 
        <td rowspan="<?php echo $rowspanAction; ?>" >
        <div style="display: flex; align-items: center;">
        <?php if($row['reelle']==='true'){ ?>  <a style="color: blue;" target="blank" href="../super/ajout_transit_heritier.php?m=<?php echo $row['id_trans_navire'].'-'.$row['id_trans_reelle'].'-'.$row['id_connaissement'].'-'.$row['id_dis']; ?>"><span class="fa-stack fa-lg">
    <i class="fas fa-square fa-stack-2x" style="color: blue;"></i>
    <i class="fa fa-plus fa-stack-1x fa-inverse"></i>
  </span></a> <?php } ?>
        <a style="color: blue;" data-role='afficher_form_modif'  data-id=<?php echo $row['id_trans_extends']; ?> ><span class="fa-stack fa-lg">
    <i class="fas fa-square fa-stack-2x" style="color: blue;"></i>
    <i class="fa fa-edit fa-stack-1x fa-inverse"></i>
  </span></a> 
        <a style="color: blue;" ><span class="fa-stack fa-lg">
    <i class="fas fa-square fa-stack-2x" style="color: blue;"></i>
    <i class="fa fa-trash fa-stack-1x fa-inverse"></i>
  </span></i></a> </div></td>
      <?php   } ?>

         <?php    
    // ----------------------PARTIE SORTIE EN MANGASIN--------------------------------------

         
    if ($num_dec_sortie!= $row['num_decliv'] or $num_dec_sortie=== $row['num_decliv'] or $c3!=$row['num_connaissement'] or $mangasin3!=$row['id_mangasin']  )  {
        $rowspanDestinationSortie = 0; // Réinitialisation du rowspan pour la nouvelle destination
        $num_dec_sortie = $row['num_decliv'];
        $c3=$row['num_connaissement'];
         $mangasin3=$row['id_mangasin'];
        foreach ($nomb as $r) {
        
          
          
            if ($r['num_decliv'] === $num_dec_sortie and $r['num_connaissement']===$c3 and $r['id_mangasin']===$mangasin3) {
              //ici on compte le nombre de destination
                $rowspanDestinationSortie++;
            }
        }
         if(empty($row['num_decliv'])){
          ?>
           <td rowspan="<?php echo $rowspanDestinationSortie; ?>"  >  </td>

   <?php } 
        // Colonne Destination
    if(!empty($row['num_decliv'])){ ?>
?>

     
       <td rowspan="<?php echo $rowspanDestinationSortie; ?>"  > <?php echo $row['num_decliv']; ?>    </td>
      <?php   } } ?>

     


      <?php    
    // Colonne Destination
    if ($num_dec_sortie2!= $row['num_decliv'] or $num_dec_sortie2=== $row['num_decliv'] or $c2!=$row['num_connaissement'] or $mangasin2!=$row['id_mangasin'] )  {
        $rowspanDestinationSortie2 = 0; // Réinitialisation du rowspan pour la nouvelle destination
        $num_dec_sortie2 = $row['num_decliv'];
        $c2=$row['num_connaissement'];
        $mangasin2=$row['id_mangasin'];
        foreach ($nomb as $r) {
            if ($r['num_decliv'] === $num_dec_sortie2 and $r['num_connaissement']===$c2 and $r['id_mangasin']===$mangasin2 ) {
              //ici on compte le nombre de destination
                $rowspanDestinationSortie2++;
            }

        }
        if(empty($row['num_decliv'])){ ?>
           <td rowspan="<?php echo $rowspanDestinationSortie2; ?>" >   </td>

   <?php } 
        // Colonne Destination
 if(!empty($row['num_decliv'])){ ?>
?>

     
       <td rowspan="<?php echo $rowspanDestinationSortie2; ?>"  > <?php echo $row['poids_decliv']; ?>   </td>
      <?php   }  } ?>

        <?php    
    // Colonne Destination
    if ($num_dec_sortie4!= $row['num_decliv'] or $num_dec_sortie4=== $row['num_decliv'] or $c4!=$row['num_connaissement'] or $mangasin4!=$row['id_mangasin'] )  {
        $rowspanDestinationSortie4 = 0; // Réinitialisation du rowspan pour la nouvelle destination
        $num_dec_sortie4 = $row['num_decliv'];
        $c4=$row['num_connaissement'];
        $mangasin4=$row['id_mangasin'];
        foreach ($nomb as $r) {
            if ($r['num_decliv'] === $num_dec_sortie4 and $r['num_connaissement']===$c4 and $r['id_mangasin']===$mangasin4) {
              //ici on compte le nombre de destination
                $rowspanDestinationSortie4++;
            }
        }
         if(empty($row['num_decliv'])){ ?>
           <td  rowspan="<?php echo $rowspanDestinationSortie4; ?>" >   </td>

   <?php } 
        // Colonne Destination
   if(!empty($row['num_decliv'])){ ?>
?>
       
        
     
       <td rowspan="<?php echo $rowspanDestinationSortie4; ?>"  > <?php //echo $som['sum(ds.poids_decliv)']; ?>  </td>
      <?php   }  } ?>

       <?php    
    // Colonne Destination
    if ($num_dec_sortie5!= $row['num_decliv'] or $num_dec_sortie5=== $row['num_decliv'] or $c5!=$row['num_connaissement'] or $mangasin5!=$row['id_mangasin'] )  {
        $rowspanDestinationSortie5 = 0; // Réinitialisation du rowspan pour la nouvelle destination
        $num_dec_sortie5 = $row['num_decliv'];
        $c5=$row['num_connaissement'];
        $mangasin5=$row['id_mangasin'];
        foreach ($nomb as $r) {
            if ($r['num_decliv'] === $num_dec_sortie5 and $r['num_connaissement']===$c5 and $r['num_connaissement']===$c5 and $r['id_mangasin']===$mangasin5) {
              //ici on compte le nombre de destination
                $rowspanDestinationSortie5++;
            }
        }
        // Colonne Destination
   if(empty($row['num_decliv'])){ ?>
    <td rowspan="<?php echo $rowspanDestinationSortie5; ?>">  </td>
    <?php }

    if(!empty($row['num_decliv'])){ ?>

?>

     
       <td rowspan="<?php echo $rowspanDestinationSortie5; ?>"  > <?php // echo $reste_declarer_sortie; ?>  </td>
      <?php   }  } ?>

         

    

               </tr>
             <?php  } ?>



</tbody>
</table>
</div>


<?php  
}

 ?>