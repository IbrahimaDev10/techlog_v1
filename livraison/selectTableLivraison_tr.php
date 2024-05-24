<?php
require('../database.php');
require("controller/bl_suivant.php");
require('controller/control_choix_des_excedents.php');
require('../reception_test/controller/stock_depart.php');
require('controller/afficher_les_livraisons.php');
?>


          <?php if (isset($_POST['idProduit'])) {

             $b=$_POST["idProduit"];
             $e=explode('-', $b);
             $c=$e[0];

      $produit=$e[0];
      $poids_sac=$e[1];
      $navire=$e[2];
      $destination=$e[3];
      echo  $produit;
      echo $poids_sac;

             include("requete.php");


     function entrepot($bdd,$produit,$poids_sac,$navire,$destination){
    $res4= $bdd->prepare(" SELECT dis.id_dis, tr.id_transfert,dt.id_transfertD, mg.mangasin,nav.navire,nc.num_connaissement, nc.id_navire from dispat_transfert as dt 
                 inner JOIN dispat as dis on dt.id_dis_transfertD=dis.id_dis
                 inner join numero_connaissement as nc on nc.id_connaissement=dis.id_con_dis
                 INNER join mangasin as mg on mg.id=dt.id_nouvelle_destinationD
                 
                 inner join navire_deb as nav on nav.id=nc.id_navire
                 
                 
                 LEFT join transfert as tr on tr.id_dis_transfert=dt.id_transfertD
                 inner join simar_user as user on user.id_sim_user=mg.id_mangasinier
                 where mg.id_mangasinier=?  group by nav.id ");             
           $res4->bindParam(1,$_SESSION['id']);
              
              $res4->execute();
        $res4->execute();
        return $res4;
      }          


           ?>


         <div class="container-fluid LesOperations" >
        <div class="row">
       <?php $res4=entrepot($bdd,$produit,$poids_sac,$navire,$destination);
                  if($row=$res4->fetch()){ ?>
              <span style="background: blue !important; display: flex; justify-content: center;">  <h1 style="color: white !important;"> ENTREPOT :</h1> <h1 style="color: yellow !important;"> <?php echo $row['mangasin']; ?></h1></span> <?php } ?>

       
            <div class=" col col-md-6 col-lg-2">
              <center>
                <div  class="dropdown">
                    <a style="font-size: 12px;" class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        LIVRAISONS
                    </a>
                    
                    <ul id="drop_debarquement" class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="background: white;"> 
                      <center>  
                        
                        <li><a style="color: black !important;" class="dropdown-item" id="btnSain"  onclick="visibleSain()"> SAINS</a></li>
                        <br>  
                        <li><a style="color: black !important;" class="dropdown-item" id="btnSain"  onclick="visibleMouille()"> AVARIES</a></li><br>
                        <li><a style="color: black !important;" class="dropdown-item" id="btnSain"  onclick="visibleBalayure()"> BALAYURES</a></li>
                        </center>
                        
                        
                    </ul>
                  
                </div>
            </div>
       <!-- 
        <div class="col col-md-6 col-lg-3">
                <div  class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        DOCUMENTS DE LIVRAISON
                    </button>
                    
                    <ul id="drop_debarquement" class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                      <center>  
                        <li> <a style="color: white !important;" class="dropdown-item" id="btnAvariesRep" onclick="visibleDeclaration()">DECLARATION</a></li>
                        <br>  
                        <li><a style="color: white !important;" class="dropdown-item" id="btnAvariesRep" onclick="visibleRelache()">RELACHE</a></li>
                        <br>
                        <li><a style="color: white !important;" class="dropdown-item" id="btnAvariesRep" onclick="visibleEnleve()">BON D'ENLEVEMENT</a></li>
                        </center>
                        
                    </ul>
                  
                </div>
                </center>
            </div> !-->

            <div class="col col-md-6 col-lg-2">
                
                    <a style="font-size: 12px;" class="btn btn-primary " onclick="visibleAvaries()" >
                        AVARIES DE LIVRAISONS
                    </a>
                    
                    
                </center>
            </div>

                     <div class="col col-md-6 col-lg-2">
                
                    <a style="font-size: 12px;" class="btn btn-primary " onclick="visibleRecond()" >
                        RECONDITIONNEMENT
                    </a>
                    
                    
                </center>
            </div>
         <div class="col col-md-6 col-lg-2">
                <center>
                  <?php  $res4=res4($bdd,$produit,$poids_sac,$navire,$destination);
                  if($row=$res4->fetch()){ ?>

                    <a style="font-size: 12px;" class="btn btn-primary " data-roles="afficher_pv_recond" data-id="<?php echo $c; ?>" data-produit="<?php echo $row['id_produit']; ?>" data-poids_sac="<?php echo $row['poids_kg']; ?>" data-destination="<?php echo $row['id_mangasin']; ?>" data-navire="<?php echo $row['id_navire']; ?>" >
                        PV DE RECONDITIONNEMENT
                    </a>
                  <?php } ?>
                    
                    
                </center>
            </div>   
        <div class="col col-md-6 col-lg-2">
                <center>
                    <a style="font-size: 12px;" class="btn btn-primary " data-roles="afficher_pv" data-id="<?php echo $c; ?>" >
                        PV FINAL DE LIVRAISON
                    </a>
                    
                    
                </center>
            </div>        

        <div class="col col-md-6 col-lg-2" >
                <div  class="dropdown">
                    <a style="font-size: 12px;" class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                       SITUATIONS
                    </a>
                    
                    <ul id="drop_debarquement" class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                      <center>  
                        <?php  $res4=entrepot($bdd,$produit,$poids_sac,$navire,$destination);
                  if($row=$res4->fetch()){ ?>
                        <li> <a style="color: white !important;" class="dropdown-item" id="btnAvariesRep" onclick="visibleBon()" data-roles="situation_bon" data-id="<?php echo $c; ?>" data-produit="<?php echo $row['id_produit']; ?>" data-poids_sac="<?php echo $row['poids_kg']; ?>" data-destination="<?php echo $row['id_mangasin']; ?>" data-navire="<?php echo $row['id_navire']; ?>">BON D'ENLEVEMENT</a></li>
                      <?php  } ?>
                        <br>  
                          <?php  $res4=res4($bdd,$produit,$poids_sac,$navire,$destination);
                  if($row=$res4->fetch()){ ?>
                        <li><a style="color: white !important;" class="dropdown-item" id="btnAvariesRep" onclick="visibleRelaches()" data-roles="situation_relache" data-id="<?php echo $c; ?>" data-produit="<?php echo $row['id_produit']; ?>" data-poids_sac="<?php echo $row['poids_kg']; ?>" data-destination="<?php echo $row['id_mangasin']; ?>" data-navire="<?php echo $row['id_navire']; ?>">RELACHE</a></li>
                      <?php } ?>
                        <br>
                          <?php  $res4=res4($bdd,$produit,$poids_sac,$navire,$destination);
                  if($row=$res4->fetch()){ ?>
                        <li><a style="color: white !important;" class="dropdown-item" id="btnAvariesRep" onclick="visibleTransit()" data-roles="situation_transit" data-id="<?php echo $c; ?>" data-produit="<?php echo $row['id_produit']; ?>" data-poids_sac="<?php echo $row['poids_kg']; ?>" data-destination="<?php echo $row['id_mangasin']; ?>" data-navire="<?php echo $row['id_navire']; ?>">TRANSIT</a></li>
                      <?php } ?>
                        </center>
                        
                    </ul>
                  
                </div>    
            </div>
           
    </div>
 </div>
 <?php } ?>