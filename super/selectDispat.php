<?php
require('../database.php');
   $navires=$bdd->query("select * from navire_deb order by id desc");
    if(isset($_POST["idNaviresta2"])){

     
//$bdd=new PDO('mysql:host=localhost;dbname=publicite;charset=utf8;', 'root', '');


$b=$_POST["idNaviresta2"];
$navire=$bdd->prepare("select * from navire_deb where id=?");
        $navire->bindParam(1,$b);
       
        
        $navire->execute();

?>


                <div id="fetch_dispat" class="col-md-12">
                    <div class="card" >
                        <div class="card-header" >
                           <center>
                            <h1 >DISPATCHING DU STOCKAGE</h1>
                            </center>
                         <button onClick="imprimer('fetch_dispat')">imprimer</button>
             <?php  while($rownav = $navire->fetch()){
            ?>
            <div class="row">
                     <div class="col-md-4 col-lg-4"><h4>NAVIRE: <span style="color:red;"><?php echo $rownav['navire'];?></span></h4></div>
                      <div class="col-md-4 col-lg-4"><h4>ETA: <span style="color:red;"><?php echo $rownav['dates'];?></span></h4></div>
                  <div class="col-md-4 col-lg-4"><h4>ETB: <span style="color:red;"><?php echo $rownav['dates'];?></span></h4></div>
                  </div>
                <?php } ?>
                            <select id="naviredispat" name="navire" class="form-control form-control-mb-4 " onchange='godispat()'>
                            <option value="">choix du navire</option>
                            <?php 
                            while ($chNav=$navires->fetch()) {
                                ?>
                            <option value="<?= $chNav['id']; ?>"><?php echo $chNav['navire']; ?> <pre><?php echo $chNav['dates']; ?></pre></option> 
                           <?php } ?> 
                       </select>

                        </div>

                        <div class="card-body"> 
<div class="table-responsive" border=1> 
                         <table class='table table-hover table-bordered table-striped'  border='2' style="border-color: black;" >
                            <thead>
                              <tr style="color:white; font-weight: bold; background: #1B2B65; font-family: montserrat;">
                                <th scope="col">CLIENT</th>
                                <th scope="col">NUMERO BL</th>
                                <th scope="col">PRODUIT</th>
                                <th scope="col">NOMBRE SAC</th>
                                <th scope="col">POIDS</th>
                                <th scope="col">DESTINATION</th>    


                                
                              </tr>
                            </thead>
                            <tbody >




<?php  
     
    $produit = $bdd->prepare("SELECT p.produit,p.qualite,p.poids,dis.*  from produit_deb as p left join dispatching as dis on p.id=dis.id_produit  where dis.id_navire=? order by dis.clients");
        $produit->bindParam(1,$b);
        $produit->execute();

         $res3=$bdd->prepare("SELECT sum(nombre_sac),sum(poids_kg) from dispatching where id_navire=?");
                $res3->bindParam(1,$b);
      
        $res3->execute();


       /* $total= $bdd->prepare("SELECT sum(nombre_sac),sum(poids) from declaration_chargement where id_navire=?");
        $total->bindParam(1,$b);
        $total->execute();*/

 
        ?>
       


    <?php     while($prod = $produit->fetch()){
            ?>
            <tr >
              <td border="1"><?php echo $prod['clients']; ?></td>
<td border="1"><?php echo $prod['n_bl']; ?></td>
<td ><?php echo $prod['produit']; ?> <pre><?php echo $prod['qualite']; ?> <?php echo $prod['poids']; ?>KGS</pre></td>
<td border="1"><?php echo $prod['nombre_sac']; ?></td>
<td border="1"><?php echo $prod['poids_kg']; ?></td>
<td border="1"><?php echo $prod['mangasin']; ?></td>


</tr>

 
<?php } ?>



<?php
  while($row3 = $res3->fetch()){
            ?>
            <tr  style="text-align:center; background-color: black; color: white; border-color: white;">
              <td  style="color: white;" >TOTAL</td>
<td ></td>
<td ></td>
<td  style="color: white;"><?php echo $row3['sum(nombre_sac)']; ?></td>
<td  style="color: white;"><?php echo $row3['sum(poids_kg)']; ?></td>
<td></td>


</tr>
               <?php } ?>


   </tbody>
</table>  

              </div>
            </div>
          </div>
        </div> 
       <button style="margin:auto-right;" class="btn btn-primary" onClick="imprimer('fetch_dispat')">imprimer</button>  
<?php } ?>
             




