<?php 
function afficher_navire($bdd){
	$navire=$bdd->query("SELECT * from navire_deb");
	return $navire;
}

function connaissement($bdd,$id_navire){
	$connaissement=$bdd->prepare('SELECT nc.*,dis.*,b.*,p.*,mg.mangasin from numero_connaissement as nc
	inner join dispat as dis on dis.id_con_dis=nc.id_connaissement
	inner join produit_deb as p on p.id=dis.id_produit
	inner join banque as b on b.id=nc.id_banque
	inner join mangasin as mg on mg.id=dis.id_mangasin
	 where nc.id_navire=?  order by nc.num_connaissement ');
               $connaissement->bindParam(1,$id_navire);
               $connaissement->execute();
               return $connaissement;
}

function connaissement_pour_destination($bdd,$id_navire,$id_client){
  $connaissement=$bdd->prepare('SELECT nc.*,dis.*,p.*,mg.mangasin from dispat as dis
  inner join numero_connaissement as nc on dis.id_con_dis=nc.id_connaissement
  inner join produit_deb as p on p.id=dis.id_produit
 
  inner join mangasin as mg on mg.id=dis.id_mangasin
   where nc.id_navire=? and dis.id_client=?  order by nc.num_connaissement ');
               $connaissement->bindParam(1,$id_navire);
               $connaissement->bindParam(2,$id_client);
               $connaissement->execute();
               return $connaissement;
}

function client($bdd,$id_navire){
  $client=$bdd->prepare('SELECT nc.id_navire,dis.id_client,cli.* from dispat as dis 
  inner join numero_connaissement as nc on dis.id_con_dis=nc.id_connaissement
  inner join client as cli on cli.id=dis.id_client
 
   where nc.id_navire=?  group by cli.id ');
               $client->bindParam(1,$id_navire);
               $client->execute();
               return $client;
}

function banque($bdd,$id_navire){
  $banque=$bdd->prepare('SELECT nc.id_navire,nc.id_banque,b.* from dispat as dis 
  inner join numero_connaissement as nc on dis.id_con_dis=nc.id_connaissement
 
  inner join banque as b on b.id=nc.id_banque
 
   where nc.id_navire=?  group by b.id ');
               $banque->bindParam(1,$id_navire);
               $banque->execute();
               return $banque;
}

function connaissement_pour_bon($bdd,$id_navire){
	$connaissement=$bdd->prepare('SELECT nc.*,dis.*,b.*,p.*,mg.mangasin from numero_connaissement as nc
	inner join dispat as dis on dis.id_con_dis=nc.id_connaissement
	inner join produit_deb as p on P.id=dis.id_produit
	inner join banque as b on b.id=nc.id_banque
	inner join mangasin as mg on mg.id=dis.id_mangasin
	 where nc.id_navire=?  order by nc.num_connaissement ');
               $connaissement->bindParam(1,$id_navire);
               $connaissement->execute();
               return $connaissement;
}

function produit($bdd,$id_navire,$id_banque){
	$produit=$bdd->prepare('SELECT nc.*,dis.*,p.* from dispat as dis
	inner join numero_connaissement as nc on dis.id_con_dis=nc.id_connaissement
	inner join produit_deb as p on p.id=dis.id_produit
	left join banque as b on b.id=nc.id_banque
	 where nc.id_navire=? and nc.id_banque=? group by dis.id_produit,dis.poids_kg');
               $produit->bindParam(1,$id_navire);
               $produit->bindParam(2,$id_banque);
              $produit->execute();
               return $produit;
}


function numero_relache($bdd,$id_navire){
	$connaissement=$bdd->prepare('SELECT r.*,b.* from relaches as r
  inner join banque as b on b.id=r.banque_id
   where r.navire_id=? ');
               $connaissement->bindParam(1,$id_navire);
               $connaissement->execute();
               return $connaissement;
}

function destination($bdd,$id_navire,$id_connaissement){
	$destination=$bdd->prepare('SELECT nc.*,dis.*,p.*,mg.mangasin from dispat as dis
	inner join numero_connaissement as nc on dis.id_con_dis=nc.id_connaissement
	inner join produit_deb as p on p.id=dis.id_produit
	left join banque as b on b.id=nc.id_banque
	inner join mangasin as mg on mg.id=dis.id_mangasin
	 where nc.id_navire=? and dis.id_con_dis=? group by dis.id_mangasin');
               $destination->bindParam(1,$id_navire);
               $destination->bindParam(2,$id_connaissement);
              $destination->execute();
               return $destination;
}

function afficher_navire2($bdd,$navire){
	$navire2=$bdd->prepare("SELECT navire from navire_deb where id=?");
	$navire2->bindParam(1,$navire);
	$navire2->execute();
	return $navire2;
}

function relache($bdd,$id_navire){
	$relache=$bdd->prepare('SELECT nr.*, nc.*,dis.*,b.*,p.* from numero_relache as nr 
	inner join dispat as dis on dis.id_con_dis=nr.id_connaissement
	inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
	inner join produit_deb as p on p.id=dis.id_produit
	inner join banque as b on b.id=dis.id_banque
	 where nc.id_navire=? and nr.status=1 order by b.banque');
               $relache->bindParam(1,$id_navire);
               $relache->execute();
               return $relache;
}

function numero_dispat_relache($bdd,$id_navire){
	$connaissemen=$bdd->prepare('SELECT nc.*,dis.*,b.*,p.*,nr.*,disr.*,mg.mangasin from numero_relache as nr
		inner join numero_connaissement as nc on nc.id_connaissement=nr.id_connaissement
	inner join dispat as dis on dis.id_con_dis=nr.id_connaissement
	inner join dispatching_relache as disr on disr.id_mangasin=dis.id_mangasin
	inner join produit_deb as p on p.id=dis.id_produit
	inner join banque as b on b.id=dis.id_banque
	inner join mangasin as mg on mg.id=dis.id_mangasin
	 where nc.id_navire=? and nr.status=1 group by nr.id_relache ');
               $connaissemen->bindParam(1,$id_navire);
               $connaissemen->execute();
               return $connaissemen;
}

function numero_relache_pour_bon($bdd,$id_navire,$id_banque,$id_produit,$poids_sac){
	$connaissemen=$bdd->prepare('SELECT nc.*,dis.*,b.*,p.*,bd.*,mg.mangasin,bn.* from bon_dispat as bd
    inner join bon as bn on bn.id_bon=bd.id_bon
    inner join dispat as dis on dis.id_dis=bd.id_dis
		inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
	inner join banque as b on b.id=nc.id_banque
	
	inner join produit_deb as p on p.id=dis.id_produit
	
	inner join mangasin as mg on mg.id=dis.id_mangasin
	 where nc.id_navire=? and nc.id_banque=? and dis.id_produit=? AND dis.poids_kg=?  ');
               $connaissemen->bindParam(1,$id_navire);
               $connaissemen->bindParam(2,$id_banque);
               $connaissemen->bindParam(3,$id_produit);
               $connaissemen->bindParam(4,$poids_sac);
               $connaissemen->execute();
               return $connaissemen;
}

function tableau_modifier_relache($bdd,$navire){
	$mes_relaches=$bdd->prepare("SELECT  dis.*, p.produit,p.qualite, mg.mangasin, cli.client,nc.*,nr.*,nr.id_relache as idrel,nav.navire,b.* /* , sum(s.poids_liv), sum(mo.poids_mo), sum(bal.poids_bal) */   from dispat as dis
     
     
      inner join numero_relache as nr on dis.id_dis=nr.id_dis_relache  
    /*  left join livraison_sain as s on s.relache_liv=nr.id_relache
      left join livraison_mouille as mo on mo.relache_mo=nr.id_relache
      left join livraison_balayure as bal on bal.relache_bal=nr.id_relache */
    
      
      inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis

      inner join produit_deb as p on p.id=dis.id_produit 
       LEFT join mangasin as mg on dis.id_mangasin=mg.id
      
      inner join client as cli on cli.id=dis.id_client
      inner join navire_deb as nav on nav.id=nc.id_navire
      inner join banque as b on b.id=nc.id_banque

    
    
      WHERE nc.id_navire=?   group by mg.mangasin,nc.id_connaissement,nr.id_relache");
      $mes_relaches->bindParam(1,$navire);
      
      $mes_relaches->execute();

      return $mes_relaches;
     

    
}

function choix_du_bon($bdd,$id_navire){
  $bon=$bdd->prepare('SELECT *  from bon
 
   where navire_id=? ');
               $bon->bindParam(1,$id_navire);
               
              $bon->execute();
               return $bon;
}

function affichage_tableau_modifier_relache($bdd,$navire){

 ?>

 <?php 

     $mes_relaches=tableau_modifier_relache($bdd,$navire);
    $nomb= $mes_relaches->fetchAll(PDO::FETCH_ASSOC);
    
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
          	
 
   <td style="text-align: center; background-image: linear-gradient(-45deg, #004362, #0183d0); !important color:white;" colspan="13"> <h6 class="hdeclaration text-white" style="font-size: 14px;" > RELACHES ( <br><?php echo $nav['navire']; ?> )</h6></td> <?php } ?> 
  
          
 <tr style="color:white; font-weight: bold; background-image: linear-gradient(-45deg, #004362, #0183d0); !important  border-color: white; text-align: center; font-size: 12px; vertical-align: middle; font-size: 12px;" border='5' >                              <th   scope="col" >ENTREPOT </th>
                                 <th   scope="col" >BL N° </th>
                                <th  scope="col" >PRODUIT </th>
                                <th  scope="col" >N° & DATE RELACHE </th>
                               
                                 <th  scope="col" >QUANTITE </th>
                                 <th  scope="col" >ACTIONS </th>
                                
                             


                               <!--   <th  scope="col" >LIVRAISON</th>

                                   <th   scope="col" >RESTE A LIVREV SUR RELACHE</th>
                                   <th    scope="col" >DISPONIBILITE</th> !-->
                                 


                             </tr>
                              </thead>
                               <tbody style="font-weight: bold; font-size: 12px;">
                                 
    <?php
            $mangasin='NULL';
            $rowspanMangasin = 0;

            $num_connaissement='NULL';
            $mangasin_du_connaissement='NULL';
            $rowspanConnaissement=0;

            $produit='NULL';
            $poids='NULL';
            $mangasin_du_produit='NULL';
            $rowspanProduit=0;

         
     foreach ($nomb as $row) { 
           
     	?>
<tr style="text-align: center; vertical-align: middle;">
<?php if($mangasin!=$row['mangasin']){ 
   $mangasin=$row['mangasin'];
   $rowspanMangasin=0;
   foreach ($nomb as $r) {
    if($r['mangasin']===$mangasin){
      $rowspanMangasin++;
     # code...
    }
  }
  
  ?>
<td rowspan="<?php echo $rowspanMangasin ?>"><?php echo $row['mangasin'] ?></td>

<?php } ?>

  <?php if($mangasin_du_connaissement!=$row['mangasin'] or $num_connaissement!=$row['num_connaissement']){ 
   $mangasin_du_connaissement=$row['mangasin'];
   $num_connaissement=$row['num_connaissement'];
   $rowspanConnaissement=0;
   foreach ($nomb as $r) {
    if($r['mangasin']===$mangasin_du_connaissement and $r['num_connaissement']===$num_connaissement){
      $rowspanConnaissement++;
     # code...
    }
  }
  
  ?>
<td rowspan="<?php echo $rowspanConnaissement ?>"><?php echo $row['num_connaissement'] ?></td>

<?php } ?>

<?php if($mangasin_du_produit!=$row['mangasin'] or $produit!=$row['id_produit'] or $poids!=$row['poids_kg']){ 
   $mangasin_du_produit=$row['mangasin'];
   $produit=$row['id_produit'];
    $poids=$row['poids_kg'];
   $rowspanProduit=0;
   foreach ($nomb as $r) {
    if($r['mangasin']===$mangasin_du_produit and $r['id_produit']===$produit and $r['poids_kg']===$poids){
      $rowspanProduit++;
     # code...
    }
  }
  
  ?>
<td rowspan="<?php echo $rowspanProduit ?>"><?php echo $row['produit'] ?> <?php echo $row['qualite'] ?> <?php echo $row['poids_kg'].' KG' ?></td>

<?php } ?>

   <?php $date= date("d/m/y", strtotime($row['date_relache'])); ?>
    <span id="<?php echo $row['id_relache'].'num_relache'; ?>"><?php echo $row['num_relache'] ?></span>
    	 <span id="<?php echo $row['id_relache'].'navire'; ?>"><?php echo $row['id_navire'] ?></span>
    	  <span id="<?php echo $row['id_relache'].'id_con_dis'; ?>"><?php echo $row['id_con_dis'] ?></span>
    	  <span id="<?php echo $row['id_relache'].'id_mangasin'; ?>"><?php echo $row['id_mangasin'] ?></span>
    	  <span id="<?php echo $row['id_relache'].'id_produit'; ?>"><?php echo $row['id_produit'] ?></span>
    	  <span id="<?php echo $row['id_relache'].'poids_kg'; ?>"><?php echo $row['poids_kg'] ?></span>
   <td ><?php echo $row['num_relache'].' DU ' ?><?php echo $date; ?></td>
   <span id="<?php echo $row['id_relache'].'dates'; ?>"><?php echo $date; ?></span>
   <td id="<?php echo $row['id_relache'].'quantite'; ?>" ><?php echo  number_format($row['quantite'], 3,',',' '); ?></td>
   <td>
   <div style="display: flex; justify-content: center; ">
   	<?php  
   	$nbre_mangasin=$bdd->prepare('SELECT count(id_dis),id_produit,poids_kg from dispat 
		where id_produit=? AND poids_kg=? and id_con_dis=?');
		$nbre_mangasin->bindParam(1,$row['id_produit']);
		$nbre_mangasin->bindParam(2,$row['poids_kg']);
		$nbre_mangasin->bindParam(3,$row['id_con_dis']);
		$nbre_mangasin->execute();
		$nbre_mg=$nbre_mangasin->fetch(); 
	if($nbre_mg['count(id_dis)']>1 AND $row['status']===0){  ?>	
   <a data-role='modifier_avec_transfert' data-id="<?php echo $row['id_relache']; ?>" ><i class="fas fa-arrow-right"></i> </a>
<?php } ?>

   <a data-role='modifier_simple' data-id="<?php echo $row['id_relache'] ?>"  ><i class="fas fa-edit"></i> </a>
   <a ><i class="fas fa-trash"></i> </a>
   </div>
   </td>

    
        
               </tr>
             <?php } ?>

</tbody>
</table>
</div>
<?php } //FERMER ?>

<?php 


 ?>

