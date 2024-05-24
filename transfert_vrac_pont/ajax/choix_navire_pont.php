<?php 
require('../../database.php');
    $navire=$_POST['navire'];

    function produit_du_navire($bdd,$navire){	
         $produit_nav = $bdd->prepare("SELECT dis.*,mang.mangasin, p.produit,p.qualite,nc.*,nav.type,cli.client, nav.id as nav_id, d.* FROM dispats as dis
               LEFT join declaration as d on d.id_bl=dis.id_dis
               inner join numero_connaissements as nc on nc.id_connaissement=dis.id_con_dis
               inner join navire_deb as nav on nav.id=nc.id_navire
                inner join produit_deb as p on dis.id_produits=p.id
                inner join client as cli on cli.id=nc.id_client
                
                 inner join mangasin as mang on dis.id_mangasin=mang.id
                

            WHERE nc.id_navire=? group by dis.id_produits, dis.poids_kgs,nc.id_client, dis.id_mangasin " );
        $produit_nav->bindParam(1,$navire);
       
        
        $produit_nav->execute();
        return $produit_nav;

        } 

 $produit_nav=produit_du_navire($bdd,$navire); ?>
                        <select id="produit_pont_bascule" class="mysel" name="produit" style=" height: 30px;  width: 40%; float: right;" data-role='goProduit_pont' >
                            <option value=""   >selectionner produit</option>
                            <?php  while($prod=$produit_nav->fetch()){ ?>
                               <option   value=<?php echo $prod['id_produits'].'-'.$prod['poids_kgs'].'-'.$prod['nav_id'].'-'.$prod['id_mangasin'].'-'.$prod['id_dis'].'-'.$prod['type'].'-'.$prod['id_client']; ?> > <span class="produit"> <?php echo $prod['produit']; ?></span>  <span class="poids"><?php echo $prod['poids_kgs']; ?> KGS</span> <?php echo $prod['client']; ?> /<?php echo $prod['mangasin']; ?> </option>
                             <?php  } ?>

  
                        </select>