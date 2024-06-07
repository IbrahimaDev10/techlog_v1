<?php 
require('../../../database.php');
require('../../controller/navire/navireController.php');
require '../../../vendor/autoload.php';
use Pro\TechlogNewVersion\Crud;

$produit=$_POST['produit'];
$poids=$_POST['poids'];
$id=$_POST['id'];

     $table='produit_manifest';
$colonnes=['produit_navire', 'poids_manifest', 'id_navire'];
$valeurs=[$produit, $poids, $id];



     Crud::insertion($bdd, $table, $colonnes, $valeurs); 
 ?>

<div class="container-fluid" id='content'>
    <div class="row">
        
        <div class="col-lg-3">
        
        </div>
        <div class="col-lg-12" style="background: white;"> 
        <div class="table-responsive" id='navire_ajax'>
            <table class="table table-responsive table-bordered" >

            <thead>
                <tr>
                    <th colspan="7" ><a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#form_ajout_navire"   >Ajouter</a> <center><h3>LISTE DES NAVIRES</h3> </center>  </th>
                </tr>
                
                <tr style="text-align: center; vertical-align: middle; background: blue; color: white;">
                    <th></th>
            <th>navire</th> 
            <th>ETA</th>
            <th>POIDS MANIFEST</th>
            <th>FOURNISSEUR </th>
            <th>RECEPTION <br> NAIRES</th>
            <th>ACTIONS</th>
            </tr>
                        
        </thead>
        <div id='body_naviress'>
        <tbody >
            <?php affichage_navire($bdd); ?>
            
        </tbody>    
        </div>

            
            </table>
            
        </div>
    </div>  
        
    </div>
</div>


<div class="modal fade" id="form_ajout_navire" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-largeur">
        <div class="modal-content" style="border: solid; border-color: rgb(0,141,202);">
            <div class="modal-header">
                <h3 class="modal-title fs-10 text-white text-center" id="exampleModalLabel">AJOUT NAVIRE</h3>
                <img class="logoo" src="../images/mylogo.ico">
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    <div class="form-group position-relative has-icon-left mb-5">
                        <div class="row">
                            <div class="col-lg-4">
                                <input type="text" placeholder="navire" name="navire" id="navire_add_nav">
                            </div>
                            <div class="col-lg-4">
                                <select name="proprietaire" class="mb-3" id="proprietaire_add_nav">
                                    <option value="" disabled selected>QUANTITE MANUTENTION</option>
                                    <option value="PARTIELLE">PARTIELLE</option>
                                    <option value="GLOBALE">GLOBALE</option>
                                </select>
                            </div>
                            <div class="col-lg-4">
                                <select name="type_navire" id="type_navire_add_nav">
                                    <option value="">type de chargement</option>
                                    <option value="SACHERIE">EN SACS</option>
                                    <option value="VRAQUIER">EN VRAC</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4">
                                <input type="text" placeholder="LOAD PORT" name="load_port" id="load_port_add_nav">
                            </div>
                            <div class="col-lg-4">
                                <input type="text" placeholder="DESTINATION" name="destination" id="destination_add_nav">
                            </div>
                            <div class="col-lg-4">
                                <input type="text" placeholder="NUMERO MANIFESTE" name="num_manifeste" id="num_manifeste_add_nav">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4">
                                <label for="eta_add_nav">ETA</label>
                                <input type="date" name="eta" id="eta_add_nav">
                            </div>
                            <div class="col-lg-4">
                                <label for="etb_add_nav">ETB</label>
                                <input type="date" name="etb" id="etb_add_nav">
                            </div>
                            <div class="col-lg-4">
                                <label for="etd_add_nav">ETD</label>
                                <input type="date" name="etd" id="etd_add_nav">
                            </div>
                        </div>

                        <fieldset style="background: black; color: yellow;">
                            <legend>FOURNISSEUR</legend>
                            <div class="row">
                                <?php
                                $affreteur = $bdd->query('SELECT * from affreteur');
                                while ($aff = $affreteur->fetch()) {
                                ?>
                                    <div class="col-lg-4">
                                        <?php echo $aff['affreteur']; ?>
                                        <input type="checkbox" style="height: 15px; margin-right: 10px;" id="affreteur_add_nav" name="affreteur_add_nav[]" value="<?php echo $aff['affreteur']; ?>">
                                    </div>
                                <?php } ?>
                            </div>
                        </fieldset>

                        <fieldset style="background: black; color: white;">
                            <legend>RECEPTIONNAIRE</legend>
                            <div class="row">
                                <?php
                                $MesClients = $bdd->query('SELECT * from client');
                                while ($clients = $MesClients->fetch()) {
                                ?>
                                    <div class="col-lg-4">
                                        <?php echo $clients['client']; ?>
                                        <input type="checkbox" style="height: 15px; margin-right: 10px;" id="client_add_nav" name="client_add_nav[]" value="<?php echo $clients['client']; ?>">
                                    </div>
                                <?php } ?>
                            </div>
                        </fieldset>

                        <center>
                            <a class="btn btn-primary" name="valider_navire" data-role='ajouter_navire'>valider</a>
                        </center>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="form_ajout_manifeste" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-largeur">
        <div class="modal-content" style="border: solid; border-color: rgb(0,141,202);">
            <div class="modal-header">
                <h3 class="modal-title fs-10  text-center" id="exampleModalLabel">AJOUT POIDS MANIFESTE</h3>
                <img class="logoo" src="../images/mylogo.ico">
            </div>
            <div class="modal-body" id='body_manifest'>
                
                <form action="" method="POST">
                    <div class="form-group position-relative has-icon-left mb-5">
                        <div class="row">
                            <?php $categories=$bdd->query('SELECT id_categories, nom_categories from categories'); ?>
                           
                            <div class="col-lg-6">
                                <select id="produit_manifeste">
                                    <option value="" disabled="false" selected>Choisir Categories de produit</option>
                                    <?php while($cat=$categories->fetch()){ ?>
                                        <option value='<?php echo $cat['id_categories']; ?>'><?php echo $cat['nom_categories'] ?></option>
                                    <?php } ?>
                                </select>
                               


                            </div>
                                 <div class="col-lg-6">
                                <input type="text" placeholder="poids" name="poids_manifeste" id="poids_manifeste">
                                <input type="number" placeholder="id" name="id_manifeste" id="id_manifeste">
                            </div>
                            
                        </div>

                      

                     
                        <center>
                            <a class="btn btn-primary" name="valider_navire" data-role='ajouter_manifeste'>valider</a>
                        </center>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">
     $(document).ready(function() {
  $('#navire_ajax table').DataTable({
    // Options de DataTables, si vous en avez besoin
    
  });
});
</script>




