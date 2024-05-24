<?php
require('../database.php');
?>
<?php include("tr_link.php"); ?>
<style type="text/css">
 *{
  font-family: Times New Roman;
 } 
 .fabtn{
  border: none;
   margin-right: 1px;
  color:rgb(0,141,202);

 }
  .fabtn1{
  border: none;
   margin-right: 3px;
  color:rgb(0,141,202);

 }
 .btn1{
  background: linear-gradient(to bottom, blue, #1B2B65); background: linear-gradient(to left, blue, #1B2B65); background: linear-gradient(to top, blue, #1B2B65);
 }
  .modal-header{
      
     /* background-image: url("images/simar2.jpg");
      background-repeat: no-repeat;
      background-size: 100%;
      background: #1B2B65;*/
       background: linear-gradient(to bottom, blue, #1B2B65);
       background: linear-gradient(to top, blue, #1B2B65);
       background: linear-gradient(to left, blue, #1B2B65);
      
      border-bottom-left-radius: 35%;
      border-bottom-right-radius: 35%;
      border: solid;
      border-color: rgb(145,145,255);
      border-width: 8px;
    }
    
  .modal-header{
      
     /* background-image: url("images/simar2.jpg");
      background-repeat: no-repeat;
      background-size: 100%;
      background: #1B2B65;*/
       background: linear-gradient(to bottom, blue, #1B2B65);
       background: linear-gradient(to top, blue, #1B2B65);
       background: linear-gradient(to left, blue, #1B2B65);
      
      border-bottom-left-radius: 35%;
      border-bottom-right-radius: 35%;
      border: solid;
      border-color: rgb(145,145,255);
      border-width: 8px;
    }
    
 .logoo{
      border-radius: 50px;
       height: 200px;
        width: 200px;
        margin-left: 40%;
        z-index: 2;
        text-align: center;

    }

    .mytd{
      font-size:14px;
    }
    .ligne{
      font-size: 12px;
    }
    @media (max-width: 900px) {
  .ligne {
    font-size: 8px !important;
  }
}
  @media (max-width: 900px) {
  .colaffiche {
    font-size: 8px !important;
  }
}

</style>

<body>

 <div class="main " id="main" > 
<div class="container-fluid-great"  >
        <div class="row">

</div>

</div>
<?php $verific=$bdd->query("SELECT count(rm.bl), rm.bl, nav.id,nav.navire from register_manifeste as rm
      inner join navire_deb as nav on nav.id=rm.id_navire and rm.bl!='ref'
       group by rm.bl 

      "); 
$calculerreur=$bdd->query("SELECT count(sub.total_count) AS total_sum
FROM (
    SELECT COUNT(rm.bl) AS total_count
    FROM register_manifeste AS rm
    INNER JOIN navire_deb AS nav ON nav.id = rm.id_navire AND rm.bl != 'ref'
    GROUP BY rm.bl
    HAVING COUNT(rm.bl)>1
) AS sub;");
      ?>

<div class="topbar transition">
  
    <div class="menu">
      <ul>
        <li class="nav-item dropdown dropdown-list-toggle">
          <a class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
             ALERTE DOUBLE EMPLOI<i class="fa fa-bell size-icon-1"></i><span class="badge bg-danger notif"><?php while ($cal=$calculerreur->fetch()) {
               echo $cal['total_sum'];
             } ?></span>
          </a>         
          <div class="dropdown-menu dropdown-list">
            <div class="dropdown-header">Notifications</div>
            <div class="dropdown-list-content dropdown-list-icons">
              <div class="custome-list-notif"> 
              

                
             <?php while ($v=$verific->fetch()) {
               if($v['count(rm.bl)']>1){
              ?>
                <a href="#" class="dropdown-item">
                <div class="dropdown-item-icon bg-danger text-white">
                  <i class="fas fa-check"></i>
                </div>
                <div class="dropdown-item-desc">
                  <?php echo 'Double emploi du bl '.$v['bl'].' du navire '.$v['navire'];  ?>
                  <div class="time">20 Hours Ago</div>
                </div>
                </a>
              <?php } } ?>

              
                <a href="#" class="dropdown-item">
                <div class="dropdown-item-icon bg-info text-white">
                  <i class="fas fa-bell"></i>
                </div>
                <div class="dropdown-item-desc">
                    Welcome to Atrana Template, I hope you enjoy using this template!
                  <div class="time">Yesterday</div>
                </div>
                </a>
 
              </div>
            </div>

            <div class="dropdown-footer text-center">
              <a href="#">View All</a>
            </div>

            
          </li>
       
         
      </ul>
    </div>
  </div>



  <div class="topbar transition">
  
    <div class="menu" >
      <ul>
        <li class="nav-item dropdown dropdown-list-toggle">
          <a class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
             ALERTE DECLARATION<i class="fa fa-bell size-icon-1"></i><span class="badge bg-danger notif">0
          </a>         
          <div class="dropdown-menu dropdown-list">
            <div class="dropdown-header">Notifications</div>
            <div class="dropdown-list-content dropdown-list-icons">
              <div class="custome-list-notif"> 
              

                
             
                <a href="#" class="dropdown-item">
                <div class="dropdown-item-icon bg-danger text-white">
                  <i class="fas fa-check"></i>
                </div>
                <div class="dropdown-item-desc">
                  POUR LES DECLARATIONS
                  <div class="time">20 Hours Ago</div>
                </div>
                </a>
             

              
                <a href="#" class="dropdown-item">
                <div class="dropdown-item-icon bg-info text-white">
                  <i class="fas fa-bell"></i>
                </div>
                <div class="dropdown-item-desc">
                    Welcome to Atrana Template, I hope you enjoy using this template!
                  <div class="time">Yesterday</div>
                </div>
                </a>
 
              </div>
            </div>

            <div class="dropdown-footer text-center">
              <a href="#">View All</a>
            </div>

            
          </li>
       
         
      </ul>
    </div>
  </div>



 
 
<br>

  


<?php 



  if(isset($_POST["idProduit"])){
 

$c=$_POST["idProduit"];
$_SESSION['c']=$c;

 


       $res4= $bdd->prepare("SELECT  p.produit,p.qualite,nav.navire,cli.client,mang.mangasin, nav.id, nav.type, dis.*   FROM dispatching as dis 
                
                inner join  produit_deb as p on dis.id_produit=p.id 

                inner join navire_deb as nav on dis.id_navire=nav.id 
                
                inner join client as cli on dis.id_client=cli.id
                inner join mangasin as mang on dis.id_mangasin=mang.id
                 

                   WHERE dis.id_dis=? ");
        $res4->bindParam(1,$_SESSION['c']);
        $res4->execute();


         $res4n= $bdd->prepare("SELECT  p.produit,p.qualite,nav.navire,cli.client,mang.mangasin, nav.id, nav.type, dis.*   FROM dispatching as dis 
                
                inner join  produit_deb as p on dis.id_produit=p.id 

                inner join navire_deb as nav on dis.id_navire=nav.id 
                
                inner join client as cli on dis.id_client=cli.id
                inner join mangasin as mang on dis.id_mangasin=mang.id
                 

                   WHERE dis.id_dis=?  ");
        $res4n->bindParam(1,$c);
        $res4n->execute();

       $resdes= $bdd->prepare("SELECT trans.*, dis.*   FROM dispatching as dis 
                inner join transit as trans on dis.id_dis=trans.id_bl

                   WHERE dis.id_dis=? 
                   ");
        $resdes->bindParam(1,$c);
        $resdes->execute();

        $resdesModif= $bdd->prepare("SELECT trans.*, dis.*   FROM dispatching as dis 
                inner join transit as trans on dis.id_dis=trans.id_bl

                   WHERE dis.id_dis=? 
                   ");
        $resdesModif->bindParam(1,$c);
        $resdesModif->execute();

          $resdes2= $bdd->prepare("SELECT trans.*, dis.*   FROM dispatching as dis 
                inner join transit as trans on dis.id_dis=trans.id_bl

                   WHERE dis.id_dis=? 
                   ");
        $resdes2->bindParam(1,$c);
        $resdes2->execute();
        

          $rescale= $bdd->prepare("SELECT  *   FROM dispatching 
               

                   WHERE id_dis=? 
                   ");
        $rescale->bindParam(1,$c);
        $rescale->execute();

         $rescaleModif= $bdd->prepare("SELECT  *   FROM dispatching 
               

                   WHERE id_dis=? 
                   ");
        $rescaleModif->bindParam(1,$c);
        $rescaleModif->execute();

        $rescale1= $bdd->prepare("SELECT * FROM dispatching 

                   WHERE id_dis=? 
                   ");
        $rescale1->bindParam(1,$c);
        $rescale1->execute();


                $res3 = $bdd->prepare("SELECT  p.produit,p.qualite,nav.navire,cli.client,mang.mangasin, nav.id, nav.type, dis.*   FROM dispatching as dis 
                
                inner join  produit_deb as p on dis.id_produit=p.id 

                inner join navire_deb as nav on dis.id_navire=nav.id 
                
                inner join client as cli on dis.id_client=cli.id
                inner join mangasin as mang on dis.id_mangasin=mang.id
                

                   WHERE dis.id_dis=? ");
        
        $res3->bindParam(1,$c);
        
        
        $res3->execute();



$resfiltre = $bdd->prepare("SELECT p.produit,p.qualite,nav.navire,cli.client,mang.mangasin, nav.id, nav.type, dis.*   FROM dispatching as dis 
                
                inner join produit_deb as p on dis.id_produit=p.id 

                inner join navire_deb as nav on dis.id_navire=nav.id 
                
                inner join client as cli on dis.id_client=cli.id
                inner join mangasin as mang on dis.id_mangasin=mang.id
                

                   WHERE dis.id_dis=?  ");
        
        $resfiltre->bindParam(1,$c);
        
       
      
        
        $resfiltre->execute();



        $filtreColonne= $bdd->prepare("SELECT des_douane from dispatching 
                
                   WHERE id_dis=? ");
        $filtreColonne->bindParam(1,$c);
        $filtreColonne->execute();
       // $filtre2=$filtreColonne->fetch();


   
$transport=$bdd->query("select * from transporteur order by id desc");

          $resbl= $bdd->prepare("SELECT  dis.*, bl.*   FROM bl
          inner join dispatching as dis on bl.id_n_bl=dis.id_dis 
               

                   WHERE bl.id_n_bl=? 
                   ");
        $resbl->bindParam(1,$c);
        $resbl->execute();

         $rob=$bdd->prepare("select dis.*,  rm.*, sum(rm.sac),sum(rm.poids), n.type FROM dispatching as dis
         
          inner  join register_manifeste as rm on  dis.id_produit=rm.id_produit and dis.id_dis=rm.id_dis_bl
          and dis.id_mangasin=rm.id_destination

          and dis.poids_kg=rm.poids_sac and dis.id_navire=rm.id_navire
        inner join navire_deb as n on dis.id_navire=n.id
          
         where  dis.id_dis=?  ");
         $rob->bindParam(1,$c);
         $rob->execute();

         $rob_colone=$bdd->prepare("select n.type , dis.poids_kg, dis.* from dispatching as dis inner join navire_deb as n
         on n.id=dis.id_navire where dis.id_dis=?");
         $rob_colone->bindParam(1,$c);
         $rob_colone->execute();
         

         $rob_dec=$bdd->prepare("select trans.poids_declarer, trans.numero_declaration, sum(rm.sac), sum(rm.poids) from transit as trans inner join register_manifeste as rm on trans.id_trans=rm.id_declaration WHERE trans.id_bl=? group by trans.numero_declaration");
                   $rob_dec->bindParam(1,$c);
         $rob_dec->execute();

       

                $affiche = $bdd->prepare("SELECT p.produit,p.qualite,nav.navire,nav.type,cli.client,mang.mangasin,trp.*,trs.*,ch.*, manif.*, sum(manif.sac),sum(manif.poids),cam.*   FROM register_manifeste as manif 
                
                inner join  produit_deb as p on manif.id_produit=p.id 

                inner join navire_deb as nav on manif.id_navire=nav.id 
                
                inner join client as cli on manif.id_client=cli.id
                inner join mangasin as mang on manif.id_destination=mang.id
                
                left join chauffeur as ch on manif.chauffeur=ch.id_chauffeur 
                left join camions as cam on manif.camions=cam.id_camions
                left join transporteur as trp on cam.id_trans=trp.id
                inner join transit as trs on manif.id_declaration=trs.id_trans

                   WHERE manif.id_dis_bl=? group by manif.dates, manif.id_register_manif with rollup ");
        
        
        $affiche->bindParam(1,$c);
        $affiche->execute();

  $afficheT = $bdd->prepare("SELECT poids_t, nombre_sac from dispatching where id_dis=?");             
             $afficheT->bindParam(1,$c);
        $afficheT->execute();

              $afficheAvaries = $bdd->prepare("SELECT  p.produit,p.qualite,nav.navire,nav.type,cli.client,mang.mangasin,trp.*,trs.*,ch.*,trav.*,cam.*, sum(trav.sac_flasque_tr_av),sum(trav.poids_flasque_tr_av),sum(trav.poids_mouille_tr_av),sum(trav.sac_mouille_tr_av)   FROM transfert_avaries as trav 
                
                inner join  produit_deb as p on trav.id_produit=p.id 

                inner join navire_deb as nav on trav.id_navire=nav.id 
                
                inner join client as cli on trav.id_client=cli.id
                inner join mangasin as mang on trav.id_destination_tr=mang.id
                left join camions as cam on trav.id_cam=cam.id_camions
                left join transporteur as trp on cam.id_trans=trp.id
                left join chauffeur as ch on trav.id_chauffeur_tr=ch.id_chauffeur 
                inner join transit as trs on trav.id_declaration_tr=trs.id_trans

                   WHERE trav.id_dis_bl_tr=? group by trav.date_tr_avaries, trav.id_tr_avaries with rollup ");
        
        
        $afficheAvaries->bindParam(1,$c);
        $afficheAvaries->execute();



         $selcale = $bdd->prepare("select id_navire from dispatching where id_dis=?");
         $selcale->bindParam(1,$c);
         $selcale->execute();
         while ($roow=$selcale->fetch()) {
           $selcale2 = $bdd->prepare("select dc.*, p.* from declaration_chargement as dc
           inner join produit_deb as p on dc.id_produit=p.id
            where id_navire=?");
         $selcale2->bindParam(1,$roow['id_navire']);
         $selcale2->execute();
         }



           $avaries0 = $bdd->prepare("select id_navire from dispatching where id_dis=?");
         $avaries0->bindParam(1,$c);
        $avaries0->execute();
         while ($roow=$avaries0->fetch()) {
           $avaries = $bdd->prepare("select dc.*, p.* from declaration_chargement as dc
           inner join produit_deb as p on dc.id_produit=p.id
            where id_navire=?");
         $avaries->bindParam(1,$roow['id_navire']);
         $avaries->execute();
         }
         
        
          $cli_desti0 = $bdd->prepare("select id_navire from dispatching where id_dis=?");
         $cli_desti0->bindParam(1,$c);
        $cli_desti0->execute();
        while ( $roow=$cli_desti0->fetch()) {

         $cli_desti=$bdd->prepare("select * from dispatching where id_navire=?");
          $cli_desti->bindParam(1,$roow['id_navire']);
          $cli_desti->execute();
      }

         $camions= $bdd->query("SELECT c.*,tr.* FROM camions as c
          inner join transporteur as tr on c.id_trans=tr.id
                  group by c.num_camions ");
         $camions2= $bdd->query("SELECT  * FROM camions 
                  group by num_camions ");
         $camionsModif= $bdd->query("SELECT * FROM camions 
                  group by num_camions ");
          $chauffeurs= $bdd->query("SELECT * FROM chauffeur 
                  group by nom_chauffeur ");


   $avaries_deb=$bdd->prepare("SELECT p.produit,p.qualite, av.*, sum(av.sac_flasque),sum(av.sac_mouille) FROM avaries as av inner join produit_deb as p on av.id_produit=p.id WHERE av.id_dis_av=? GROUP BY av.date_avaries, av.id_avaries WITH ROLLUP");
 $avaries_deb->bindParam(1,$c);
 $avaries_deb->execute();

        ?>





        <div class="entete_image" style="background-image: url('../images/bg_page.jpg'); background-repeat: no-repeat; background-size: 100%; background-color: blue;  ">
        <center> 
              
        <div   class="table-responsive" border=1>
          
  
 <table  class='table table-hover table-bordered table-striped'  border='2' style="width: 50%; " id='tabledec1'>
         
            <tr id="entete_table_declaration"  >
              <td  scope="col" style="color: white;">N° DECLARATION</td>
              <td  scope="col" style="color: white;">RESTANT SUR DECLARATION</td>
            </tr>
          
     
       <?php 
while($row=$rob_dec->fetch()){

$rob_poids=$row['poids_declarer']-$row['sum(rm.poids)'];
   ?>
   <tr id="data_table_declaration">
     
 
  <td>       
 <span class="th4" ><?php  
        echo  $row['numero_declaration']
    ?></span></td>
  <td>
            
 <span class="th4" ><?php  
        echo  number_format($rob_poids, 3,',',' ');
    ?></span>
  </td>
    </tr>
    
  <?php  } $rob_dec->closeCursor(); ?>
   </table>
      </div>
       </center>
      <br> 
  
        <div  class="table-responsive" border=1 >
          <center>
 <table  class='table table-hover table-bordered table-striped'  border='2' style="width: 50%; " id='tabledec2' >

   
         
            <tr id="entete_table_declaration2" >
              <td colspan="2" scope="col" style="color: white;  ">TOTAL DEB</td>
              <td  colspan="2" style="color: white;">ROB</td>
            </tr>
            <tr id="entete_table_declaration2"> 
            <?php while  ($rcolone=$rob_colone->fetch()){ 
             if($rcolone['type']=="SACHERIE"){ ?> 
            <td style="color: white;"> SACS </td> 
            <td style="color: white;">  POIDS</td>
          <?php }   
                     if($rcolone['type']=="VRAQUIER" and $rcolone['poids_kg']!=0 ){ ?> 
            <td style="color: white;"> SACS </td> 
            <td style="color: white;">  POIDS</td>
          <?php } 
                               if($rcolone['type']=="VRAQUIER" and $rcolone['poids_kg']==0 ){ ?> 
            
            <td colspan="2" style="color: white;">  POIDS</td>
          <?php } 
            

            if($rcolone['type']=="SACHERIE"){ ?>
             <td style="color: white;" id="entete_table_declaration2"> SACS </td> 
            <td style="color: white;" id="entete_table_declaration2">  POIDS</td>
          <?php } ?>
          <?php if($rcolone['type']=="VRAQUIER"){ ?>
             
            <td colspan="2" style="color: white;">  POIDS</td>
          <?php } ?>
        <?php } $rob_colone->closeCursor(); ?>
            </tr>
 <?php 
while($row=$rob->fetch()){
$rob_sac=$row['nombre_sac']-$row['sum(rm.sac)'];
$rob_poids=$row['poids_t']-$row['sum(rm.poids)'];
   ?>
   
   <tr id="data_table_declaration2"> <?php  if($row['type']=='SACHERIE'){ ?>
    <td>  
 <span class="th4" >
          <?php   echo number_format($row['sum(rm.sac)'], 0,',',' '); ?></span></td>
        <td>     
 <span class="th4" ><?php  
        echo $row['sum(rm.poids)'];
    ?></span></td>
  <?php } ?>
       <?php    if($row['type']=='VRAQUIER' and $row['poids_kg']!=0){ ?>
         <td>  <span class="th4" >
        <?php  
        echo number_format($row['sum(rm.sac)'], 0,',',' '); ?>
          

         </span></td>
        <td>     
 <span class="th4" ><?php  
        echo $row['sum(rm.poids)'];
    ?></span></td>
      
   <?php } 
     ?>

      <?php    if($row['type']=='VRAQUIER' and $row['poids_kg']==0){ ?>
        <td colspan="2"> 
                 
 <span class="th4" ><?php  
        echo $row['sum(rm.poids)'];
    ?></span></td>
      
   <?php } 
     ?>
 
         
 <?php   if($row['type']=='SACHERIE'){?>
 <td> <span class="th4" ><?php   
        echo  number_format($rob_sac, 0,',',' ');  ?>
  </span></td>
          
 <td> <span class="th4" ><?php  
        echo  number_format($rob_poids, 3,',',' ');
    ?></span></td>
  <?php } ?>

  <?php   if($row['type']=='VRAQUIER'){?>
 <
          
 <td colspan="2"> <span class="th4" ><?php  
        echo  number_format($rob_poids, 3,',',' ');
    ?></span></td>
  <?php } ?>
   </tr>

  <?php } $rob->closeCursor(); ?>

          </table>
          </center>
        </div>

  <div  class="table-responsive" >
  <table  class='table table-hover   table-responsive'  style="background: white; ">     
 <?php while($row3=$res3->fetch()) {?>
  
   <br>

    <tr style="text-align: center;">
       <td> 
 <span class="th3" > NAVIRE:</span>        
    <span class="th4"><?php echo $row3['navire'];?></span>
    </td>
     <td><span class="th3" > PRODUIT:</span><span class="th4"> <?php echo $row3['produit'];?> <span class="thmedium" > <?php  echo $row3['qualite'];?></span> <?php if($row3['poids_kg']!=0){ echo $row3['poids_kg'];?>KGS <?php } ?></span> </td>
      <td>
      <span class="th3 " > POIDS:</span>        
        <span class="th4" ><?php  
        echo number_format($row3['poids_t'], 3,',',' ');
    ?></span></td>
    </tr>
    <tr style="text-align: center;">
      <td>
  <span class="th3" > DESTINATION DOUANIERE:</span>
 <span class="th4" ><?php  
        echo $row3['des_douane'];
    ?></span></td>  

 
<td>
    <span class="th3 " > RECEPTIONNAIRE:</span>        
        <span class="th4" ><?php  
        echo $row3['client'];
    ?></span></td> 
    
   <td>
   <span class="th3 " > DESTINATION:</span>        
        <span class="th4" ><?php  
        echo $row3['mangasin'];
    ?></span> </td> 
  </tr>
 
  


   <?php } $res3->closeCursor();?>
     </table>
</div>

  </div>
<br>

<?php $bouton=$bdd->prepare("SELECT nav.type, dis.id_navire from dispatching as dis inner join navire_deb as nav on nav.id=dis.id_navire where dis.id_dis=? ");
      $bouton->bindParam(1,$c);
      $bouton->execute();
      $btn=$bouton->fetch(); ?>

<div class="container-fluid">
  <div class="row">
    <?php if($btn['type']=="SACHERIE"){ ?>
      <div class="col col-sm-12 col-md-12 col-lg-12">
        <center>
        <button  class="btn btn-primary" id="btnSain"  onclick="visibleSain()">TRANSFERT SAINS</button>
      
           
        <button  class="btn btn-primary" id="btnAvariesDeb" onclick="visibleAvariesTrans()"> TRANSFERT DES AVARIES </button>
     
            
        <button  class="btn btn-primary" id="btnAvariesRep" onclick="visibleAvariesDeb()">AVARIES DE DEBARQUEMENT</button>
        </center>
      </div>
    <?php } ?>

    <?php if($btn['type']=="VRAQUIER"){ ?>
      <center>
      <div class="col col-md-12 col-lg-12">
        
        <button class="btn btn-primary" id="btnSain"  onclick="visibleSain()">TRANSFERT SAINS</button>
       
      </div>
          </center> 

    <?php } ?>
  </div>
</div>



<div class="container-fluid" id="TableSain" style="display: none;">
  <div class="col-md-12 col-lg-12">      
<button type="submit" class="btn1" data-bs-toggle="modal" data-bs-target="#enregistrement" >Insertion </button>
<br><br>

</div>

<div class="table-responsive" border=1>
<?php


 echo " <table class='table table-hover table-bordered table-striped table-responsive' id='table_register' border='2' >";
    
?> 
 <thead style="background-color: rgba(50, 159, 218, 0.9);">
  <td  colspan="14" class="titreSAIN"  >TRANSFERT DES SACS SAINS</td>
       
    
    <tr id="entete_table_sain"   >
      <td  scope="col"   >FLOAT</td>
      <td  scope="col"   >DATES</td>
      <td  scope="col"   >HEURE</td>
      <td  scope="col"  >CALE</td>
      <td  scope="col"  > N° BL</td>
      <td  scope="col"  >CAMIONS</td>
      <td  scope="col"  >CHAUFFEUR</td>
      
          <td  scope="col"  >TRANSPORTEUR</td>
      <td  scope="col"  >N°DEC / TRANSFERT</td>
      <?php while ($resfil=$resfiltre->fetch()) {
        if($resfil['poids_kg']!=0){


      ?>
      <td  scope="col"  >NBRE SACS</td>
    <?php } } ?>
      <td   scope="col"  >POIDS</td>
      <?php 
      while($filtre=$filtreColonne->fetch()){
        if( $filtre["des_douane"]=="LIVRAISON"){
          ?>
          
          <td  scope="col"  >DESTINATAIRE</td>
          <?php  
        }

      } ?>
     
     <td  >OBSERVATION</td>
     <td  >ACTION</td>


   
     </tr>
      

      
     </thead>


<tbody>
  <?php while($aff=$affiche->fetch()){ 
   $date=explode('-', $aff['dates']);
   $heure=explode(':', $aff['heure']);
  
  // $diff=$aff['poids_declarer']-$aff['sum(manif.poids)'];
   $restant_declaration=$bdd->prepare("SELECT manif.*, sum(manif.poids), tr.poids_declarer  from register_manifeste as manif inner join transit as tr on tr.id_trans=manif.id_declaration where manif.id_declaration=? and manif.id_register_manif<=?");

   $restant_declaration->bindParam(1,$aff['id_declaration']);
   $restant_declaration->bindParam(2,$aff['id_register_manif']);

        $restant_declaration->execute();
       $rest=$restant_declaration->fetch(); 
        $diff=$rest['poids_declarer']-$rest['sum(manif.poids)'];

    $float = $bdd->prepare("SELECT count(bl) from register_manifeste

                   WHERE id_dis_bl=? and dates=? and id_register_manif<=?  ");
        
        
        $float->bindParam(1,$c);
        $float->bindParam(2,$aff['dates']);
        $float->bindParam(3,$aff['id_register_manif']);

        $float->execute();
        $f=$float->fetch();
     
    ?>
   
      <?php if(empty($aff['id_register_manif']) and !empty($aff['dates'])) {?>
         <tr class="ligne"   style="text-align: center; font-weight: bold; vertical-align: middle; font-size: 12px;" >

      <td class="mytd" colspan="9" class="colaffnull" style="background: linear-gradient(to bottom, #FFFFFF, rgb(82,82,226)); font-weight: bold; color:white;" >TOTAL  <?php echo $date[2].'-'.$date[1].'-'.$date[0] ?></td>
   
  
     
  
   <?php if ($aff['poids_sac']!=0) { ?>
    <td class="mytd" class="colaffnull" style="background: linear-gradient(to bottom, #FFFFFF, rgb(82,82,226)); color: white;"><?php echo number_format($aff['sum(manif.sac)'], 0,',',' ') ?></td>
  <?php } ?>
    <td class="mytd" class="colaffnull" style="background: linear-gradient(to bottom, #FFFFFF, rgb(82,82,226)); color: white;"><?php echo number_format($aff['sum(manif.poids)'], 3,',',' '); ?></td>
    <?php if($aff['destinataire']!='AUCUN' and $aff['destinataire']!=1){ ?>
      
    <td class="mytd" class="colaffnull" style="background: linear-gradient(to bottom, #FFFFFF, rgb(82,82,226));"></td>
<?php } ?>
<td  class="colaffnull" colspan="4" style="background: linear-gradient(to bottom, #FFFFFF, rgb(82,82,226)); font-weight: bold; color:white;" ></td>
</tr>
<?php } ?>

   
   <?php 



    if(!empty($aff['id_register_manif']) and !empty($aff['dates'])) {  

     ?>
     <tr class="ligne" id="<?php echo $aff['id_register_manif'].'colonnebl' ?>"  style="text-align: center;  vertical-align: middle; " >
    <td    ><?php echo  $f['count(bl)'] ?> </td>
    <td  id="<?php echo $aff['id_register_manif'].'date_rm' ?>"   ><?php echo  $date[2].'-'.$date[1].'-'.$date[0]; ?> </td>
    <td id="<?php echo $aff['id_register_manif'].'heure_rm' ?>"  ><?php echo $heure[0].':'.$heure[1] ?></td>
    <td id="<?php echo $aff['id_register_manif'].'cale_rm' ?>"   ><?php echo $aff['cale'] ?> </td>
    <td id="<?php echo $aff['id_register_manif'].'bl_rm' ?>"   data-champ="bl"  ><?php echo $aff['bl'] ?></td>
    <td id="<?php echo $aff['id_register_manif'].'camion_rm' ?>"  ><?php echo $aff['num_camions'] ?></td>
    <td ><?php echo $aff['nom_chauffeur'] ?></td>
    <span style="display: none;" id="<?php echo $aff['id_register_manif'].'id_chauffeur_rm' ?>"><?php echo $aff['chauffeur'] ?></span>
    <span style="display: none;" id="<?php echo $aff['id_register_manif'].'id_camion_rm' ?>"><?php echo $aff['camions'] ?></span>
    <span style="display: none;" id="<?php echo $aff['id_register_manif'].'chauffeur_rm' ?>"><?php echo $aff['nom_chauffeur'].' permis: '.$aff['n_permis']. ' Tel: '.$aff['num_telephone'] ?></span>

    <center>
    <td id="<?php echo $aff['id_register_manif'].'transporteur_rm' ?>" >
      <?php  echo $aff['nom']; ?></td>
    </center>
    <td id="<?php echo $aff['id_register_manif'].'declaration_rm' ?>" ><?php echo $aff['numero_declaration'] ?></td>
    <span style="display: none;" id="<?php echo $aff['id_register_manif'].'id_declaration_rm' ?>"><?php echo $aff['id_declaration'] ?></span>
    <span style="display: none;" id="<?php echo $aff['id_register_manif'].'dis_bl_rm' ?>"><?php echo $aff['id_dis_bl'] ?></span>
     <span style="display: none;" id="<?php echo $aff['id_register_manif'].'poids_sac_rm' ?>"><?php echo $aff['poids_sac'] ?></span>

<?php if($aff['sac']!=0){ ?>
    <td id="<?php echo $aff['id_register_manif'].'sac_rm' ?>" ><?php echo number_format($aff['sac'], 0,',',' '); ?></td>
  <?php } ?>
    <td id="<?php echo $aff['id_register_manif'].'poids_rm' ?>" ><?php echo $aff['poids'] ?> </td>
     
     <?php if($aff['destinataire']!='AUCUN' and $aff['destinataire']!=1){ ?>
     
    <td ><?php echo $aff['destinataire'] ?></td>
<?php }
if($diff>=0){ ?>
  <td  style="color: green;"><?php echo "RAS" ?></td>
<?php } ?>
<?php  
if($diff<0){ ?>
  <td  style="color: red;"><?php echo "EXCEDENT SUR DECLARATION / DESTINATION DE ".$diff.'T' ?></td>

<?php } ?>

<form>  
 <td  style="vertical-align: middle; " > <button  id="<?php echo $aff['id_register_manif'] ?>" name="delete" type="submit"  class="fabtn1 " onclick="deleteAjax(<?php echo $aff['id_register_manif'] ?>)" > <i class="fa fa-trash  " ></i> </button>

 <a class="fabtn" type="" name="modify" <?php if($aff['type']=="SACHERIE"){ echo  "data-role='update_register'";  } ?> <?php if($aff['type']=="VRAQUIER" and $aff['poids_sac']!=0){ echo  "data-role='update_register_vrac'";  } ?>  <?php if($aff['type']=="VRAQUIER" and $aff['poids_sac']==0){ echo  "data-role='update_register_vrac0'";  } ?>  data-id="<?php echo $aff['id_register_manif']  ?>"     > <i class="fa fa-edit " ></i></a>

<a type="" class="fabtn" href="archive.php?id=<?php echo $aff['id_register_manif']; ?>"  id="#archive" >
  <i class="fa fa-archive " ></i> 
</a>
<a type="" class="fabtn " href="visualisation_archive.php?id=<?php echo $aff['id_register_manif']; ?>"  id="archive"  >
  <i class="fa fa-eye " ></i> 
</a>

    
</td>
</form>
</tr>










 
  <?php } ?>

  <?php  if(empty($aff['id_register_manif']) and empty($aff['dates'])) { 
     $affT=$afficheT->fetch();
    $rob_sacT=$affT['nombre_sac']-$aff['sum(manif.sac)'];
     $rob_poidsT=$affT['poids_t']-$aff['sum(manif.poids)']; ?>
<tr style="font-weight: bold; font-size: 12px;">
  <td class="mytd" colspan="14" class="" style="background: black; color: white; font-weight: bold; text-align: center;" >SITUATION GENERALE  </td>
  </tr>
  <?php if($aff['type']=="SACHERIE") { ?>
 <tr   style="text-align: center; font-weight: bold; vertical-align: middle;" >
  <td class="mytd" class="" colspan="4" style="background: black; color: white; font-weight: bold; text-align: center;" >TOTAL SACS DEB = <span style="color:red;"> <?php echo number_format($aff['sum(manif.sac)'], 0,',',' '); ?></span>  </td>
  

  <td class="mytd" class="" colspan="3" style="background: black; color: white; font-weight: bold; text-align: center;"> TOTAL POIDS DEB = <span style="color:red;"><?php echo number_format($aff['sum(manif.poids)'], 3,',',' '); ?></span></td> 

   <td class="mytd" class="" colspan="3" style="background: black; color: white; font-weight: bold; text-align: center;" >ROB EN SACS= <span style="color:red;"><?php echo number_format($rob_sacT, 0,',',' '); ?></span>  </td>
   

   <td class="mytd" class="" colspan="4"  style="background: black; color: white; font-weight: bold; text-align: center;"> ROB EN POIDS = <span style="color:red;"><?php echo number_format($rob_poidsT, 3,',',' '); ?></span></td>
<?php } 
 if($aff['type']=="VRAQUIER" AND $aff['poids_sac']!=0) { ?>
?> 

  <td class="mytd" class="" colspan="4" style="background: black; color: white; font-weight: bold; text-align: center;" >TOTAL SACS DEBARQUES = <span style="color:red;"> <?php echo number_format($aff['sum(manif.sac)'], 0,',',' '); ?></span>  </td>
  

  <td class="mytd" class="" colspan="4"style="background: black; color: white; font-weight: bold; text-align: center;"> TOTAL POIDS DEBARQUES = <span style="color:red;"><?php echo number_format($aff['sum(manif.poids)'], 3,',',' '); ?></span></td> 

  
   

   <td class="mytd" class="" colspan="4"  style="background: black; color: white; font-weight: bold; text-align: center;"> ROB EN POIDS = <span style="color:red;"><?php echo number_format($rob_poidsT, 3,',',' '); ?></span></td>
<?php } ?>


<?php 
 if($aff['type']=="VRAQUIER" AND $aff['poids_sac']==0) { ?>

<td class="mytd" class="" colspan="6"style="background: black; color: white; font-weight: bold; text-align: center;"> TOTAL POIDS DEBARQUES = <span style="color:red;"><?php echo number_format($aff['sum(manif.poids)'], 3,',',' '); ?></span></td> 

  
    

   <td class="mytd" class="" colspan="6"  style="background: black; color: white; font-weight: bold; text-align: center;"> ROB EN POIDS = <span style="color:red;"><?php echo number_format($rob_poidsT, 3,',',' '); ?></span></td>
   


<?php  } ?>
 

  </tr> 
 
 

  <?php  } } ?>




</tbody>
             

            

</table>
</div>
</div>

<?php   $filtreavaries= $bdd->prepare("SELECT  nav.navire,nav.type, dis.id_dis   FROM dispatching as dis 
                
                 

                inner join navire_deb as nav on dis.id_navire=nav.id 
                
               
                 

                   WHERE dis.id_dis=?  ");
        $filtreavaries->bindParam(1,$c);
        $filtreavaries->execute();
        $cherche=$filtreavaries->fetch();
       if($cherche['type']=="SACHERIE"){  ?>

           

  
<div id="tr_avariess">
<div class="container-fluid" id="TableAvariesTrans" style="display: none;">

        <div class="col-md-12 col-lg-12">      
<button type="submit" class="btn1" data-bs-toggle="modal" data-bs-target="#enregistrement_transfert" >Insertion transfert avaries</button>
<br><br>


</span>
    </div>

 <div class="table-responsive" border=1>
<?php


 echo " <table class='table table-hover table-bordered table-striped' id='table' border='2' >";
    
?> 
 <thead >
    <td  colspan="15" class="titreTRANSAV"  >TRANSFERT DES AVARIES DE DEBARQUEMENT</td>    
    
    <tr id="entete_table_transfert_avaries"  >
      
      
      
       <td scope="col"  rowspan="3"  style="vertical-align: top;">DATES</td>
              <td scope="col"  rowspan="3" style="vertical-align: top;" >HEURE</td>
                     <td scope="col"  rowspan="3" style="vertical-align: top;" >CALE</td>
                      <td scope="col"  rowspan="3" style="vertical-align: top;" >BL</td>
               <td scope="col" rowspan="3" style="vertical-align: top;" >CAMIONS</td> 
               <td scope="col"  rowspan="3"  style="vertical-align: top;">CHAUFFEUR</td>
               <td scope="col"  rowspan="3" style="vertical-align: top;" >TRANSPORT</td>
               <td scope="col"  rowspan="3"style="vertical-align: top;" >N°DEC / TRANSFERT</td>            
      <td scope="col" colspan="2" >FLASQUES</td>
      <td scope="col" colspan="2" >MOUILLES</td>
      <td scope="col" colspan="2" >TOTAL AVARIES</td>
      <td scope="col" rowspan="2"  >ACTIONS</td>
      
     
  </tr>
    <tr id="entete_table_transfert_avaries" >
      
      <td scope="col"   >SACS</td>
      <td scope="col"  >POIDS</td>
      <td scope="col" >SACS</td>
      <td scope="col"  >POIDS</td>
      <td scope="col" >SACS</td>
      <td scope="col" >POIDS</td>
      </tr>
      

     
     
    


      
     </thead>


<tbody>
 <?php while($aff=$afficheAvaries->fetch()){ 
   $date=explode('-', $aff['date_tr_avaries']);
   $heure=explode(':', $aff['heure_tr']);
   $TotalSacAV=$aff['sum(trav.sac_flasque_tr_av)']+$aff['sum(trav.sac_mouille_tr_av)'];
   $TotalPoidsAV=$aff['sum(trav.poids_flasque_tr_av)']+$aff['sum(trav.poids_mouille_tr_av)'];
  
   //$diff=$aff['poids_declarer']-$aff['sum(manif.poids)'];
     
    ?>
    <tr style="text-align: center; font-weight: bold; " >
      <?php if(empty($aff['id_tr_avaries']) and !empty($aff['date_tr_avaries'])) {?>
      <td colspan="8" class="colaffnull" style="background:rgb(82,82,226); font-weight: bold; color:white;" >TOTAL <?php echo $date[2].'-'.$date[1].'-'.$date[0] ?></td>
   

    <td class="colaffnull" style="background:rgb(82,82,226); color: white;"><?php echo number_format($aff['sum(trav.sac_flasque_tr_av)'], 0,',',' ') ?></td>
    <td class="colaffnull" style="background:rgb(82,82,226); color: white;"><?php echo number_format($aff['sum(trav.poids_flasque_tr_av)'], 3,',',' '); ?></td>
    <td class="colaffnull" style="background:rgb(82,82,226); color: white;"><?php echo number_format($aff['sum(trav.sac_mouille_tr_av)'], 0,',',' ') ?></td>
     <td class="colaffnull" style="background:rgb(82,82,226); color: white;"><?php echo number_format($aff['sum(trav.poids_mouille_tr_av)'], 3,',',' '); ?></td>
         <td class="colaffnull" style="background:rgb(82,82,226); color: white;"><?php echo number_format($TotalSacAV, 0,',',' ') ?></td>
    <td class="colaffnull" style="background:rgb(82,82,226); color: white;"><?php echo number_format($TotalPoidsAV, 3,',',' ') ?></td>
             <td class="colaffnull" style="background:rgb(82,82,226); color: white;"></td>

    
    <?php if($aff['autre_destination_tr']!="AUCUNE"){ ?>
      <td class="colaffnull" style="background:rgb(82,82,226);"></td>
    <td class="colaffnull" style="background:rgb(82,82,226);"></td>
<?php } ?>


   
   <?php }



   else if(!empty($aff['id_tr_avaries']) and !empty($aff['date_tr_avaries'])) {?>

 <tr id="data_table_transfert_avaries">
    <td  id="<?php echo $aff['id_tr_avaries'].'date_av' ?>" ><?php echo  $date[2].'-'.$date[1].'-'.$date[0] ?></td>
    <td  id="<?php echo $aff['id_tr_avaries'].'heure_av' ?>" ><?php echo $heure[0].':'.$heure[1] ?></td>
    <td  id="<?php echo $aff['id_tr_avaries'].'cale_av' ?>" ><?php echo $aff['cale_tr_avaries'] ?></td>
    <td  id="<?php echo $aff['id_tr_avaries'].'bl_av' ?>" ><?php echo $aff['bl_tr'] ?></td>
    <td  id="<?php echo $aff['id_tr_avaries'].'camion_av' ?>" ><?php echo $aff['num_camions'] ?></td>
    <span style="display: none;" class="colaffiche" id="<?php echo $aff['id_tr_avaries'].'id_camion_av' ?>" ><?php echo $aff['id_cam'] ?></span>
    <td class="colaffiche" id="<?php echo $aff['id_tr_avaries'].'chauffeur_av' ?>" ><?php echo $aff['nom_chauffeur'] ?></td>
     <span style="display: none;" class="colaffiche" id="<?php echo $aff['id_tr_avaries'].'id_chauffeur_av' ?>" ><?php echo $aff['id_chauffeur_tr'] ?></span>
    
    <span id="<?php echo $aff['id_tr_avaries'].'disbl' ?>" style="display: none" class="colaffiche"><?php echo $aff['id_dis_bl_tr'] ?></span>
     <span id="<?php echo $aff['id_tr_avaries'].'dis_bl_av' ?>" style="display: none" class="colaffiche"><?php echo $aff['id_dis_bl_tr'] ?></span>
      <span id="<?php echo $aff['id_tr_avaries'].'poids_sac_av' ?>" style="display: none" class="colaffiche"><?php echo $aff['poids_sac_tr_av'] ?></span>
    <center>
    <td >
      <?php  echo $aff['nom']; ?></td>
    </center>
    <td  id="<?php echo $aff['id_tr_avaries'].'declaration_av' ?>" ><?php echo $aff['numero_declaration'] ?></td>
    <span id="<?php echo $aff['id_tr_avaries'].'id_declaration_av' ?>" style="display: none" class="colaffiche"><?php echo $aff['id_declaration_tr']; ?></span>


    <td id="<?php echo $aff['id_tr_avaries'].'sacf_av' ?>" class="colaffiche"><?php echo number_format($aff['sac_flasque_tr_av'], 0,',',' '); ?></td>
    <td  id="<?php echo $aff['id_tr_avaries'].'poidsf_av' ?>" ><?php echo $aff['poids_flasque_tr_av'] ?></td>
  <td  id="<?php echo $aff['id_tr_avaries'].'sacm_av' ?>" ><?php echo number_format($aff['sac_mouille_tr_av'], 0,',',' '); ?></td>
    <td class="colaffiche" id="<?php echo $aff['id_tr_avaries'].'poidsm_av' ?>" ><?php echo $aff['poids_mouille_tr_av'] ?></td>
    <td  style=""><?php echo number_format($TotalSacAV, 0,',',' ') ?></td>
    <td  style=""><?php echo number_format($TotalPoidsAV, 3,',',' ') ?></td>
    <td  style="vertical-align: middle; " > <button id="<?php echo $aff['id_tr_avaries'] ?>" type="submit"  class="fabtn1 "  onclick="deleteAvaries(<?php echo $aff['id_tr_avaries'] ?>)"  > <i class="fa fa-trash  " ></i> </button>

 <a class="fabtn"  data-role='update_register_avaries'   data-id="<?php echo $aff['id_tr_avaries'];  ?>"    ><i class="fa fa-edit " ></i></a> </td>
     
     <?php if($aff['autre_destination_tr']!="AUCUNE"){ ?>
      <td ><?php echo $aff['autre_destination_tr'] ?></td>
    <td ><?php echo $aff['destinataire_tr'] ?></td>
<?php } ?>
  
</tr>


  
  <?php } ?>

  <?php   if(empty($aff['id_tr_avaries']) and empty($aff['date_tr_avaries'])) { /*
     $affT=$afficheT->fetch();
    $rob_sacT=$affT['nombre_sac']-$aff['sum(manif.sac)'];
     $rob_poidsT=$affT['poids_t']-$aff['sum(manif.poids)'];*/ ?>
<tr style="font-weight: bold;">
  <td colspan="13" class="" style="background: black; color: white; font-weight: bold; text-align: center;" >  </td>
  </tr>
  
 

  <?php  }  ?>
<?php  }  ?>



</tbody>
             

  
</table> 
</div>  
</div>
</div>

<div class="container-fluid" id="avaries_debarquement" style="display: none;" >

  <div class="col-md-12 col-lg-12">      
<button style="background: orange;" type="submit" class="btn1" data-bs-toggle="modal" data-bs-target="#enregistremens" >Insertion </button>

</div>
<br>  

          <div class="table-responsive" border=1>
  
 <table class='table table-hover table-bordered table-striped table-responsive' id='table_register' border='2' >

 <thead style="background-color: rgba(50, 159, 218, 0.9);">
   <td  colspan="6" class="titreSAIN" style="background: orange;"  ><i class="fas fa-bell" style="float: left;"> </i> AVARIES DE DEBARQUEMENT</td>
       
    
    <tr  style="background: linear-gradient(to bottom, #FFFFFF, orange); text-align: center; color: white; font-weight: bold; font-size: 12px;"  >
      <td class="mytd" scope="col" rowspan="2"  >DATES</td>
      <td class="mytd" scope="col" rowspan="2"  >PRODUIT</td>
      <td class="mytd" scope="col" rowspan="2"  >CALE</td>
      <td class="mytd" scope="col" rowspan="2" >SAC FLASQUE</td>
      <td class="mytd" scope="col" rowspan="2" > SAC MOUILLE</td>
      <td class="mytd" scope="col" rowspan="2" >ACTION</td>
    </tr>
    </thead>
    <tbody>
     <?php while($avrs=$avaries_deb->fetch()){

      if(!empty($avrs['date_avaries']) and !empty($avrs['id_avaries'])){
              $date=explode('-', $avrs['date_avaries']);
             $dt=$date[2].'-'.$date[1].'-'.$date[0];
        ?>
          <tr style="text-align: center; vertical-align: middle; background: white;">
<td id="<?php echo $avrs['id_avaries'].'date_avaries_deb' ?>"><?php echo $dt; ?></td>
          <td><?php echo $avrs['produit'] ?> <?php echo $avrs['qualite'] ?> <?php echo $avrs['poids_sac_avaries'].' KGS'; ?></td>
          <td><?php echo $avrs['cale_avaries']; ?></td>
          <td id="<?php echo $avrs['id_avaries'].'flasque_avaries_deb' ?>"><?php echo $avrs['sac_flasque']; ?></td>
          <td id="<?php echo $avrs['id_avaries'].'mouille_avaries_deb' ?>" ><?php echo $avrs['sac_mouille']; ?></td>
          <span style="display: none;" id="<?php echo $avrs['id_avaries'].'id_navire_avaries_deb' ?>" ><?php echo $avrs['id_navire']; ?></span>
          <td>  <a  class="fabtn" type=""   data-role='update_avaries_deb'  data-id="<?php echo $avrs['id_avaries']  ?>" > <i class="fa fa-edit " style="color: orange;" ></i></a>
           <a class="fabtn" type=""   onclick="delete_avaries_deb(<?php echo $avrs['id_avaries'] ?>)"   > <i class="fa fa-trash " style="color: orange;" ></i></a></td>
          

        </tr>
      <?php } 

      if(!empty($avrs['date_avaries']) and empty($avrs['id_avaries'])){
              $date=explode('-', $avrs['date_avaries']);
             $dt=$date[2].'-'.$date[1].'-'.$date[0];
        ?>
          <tr style="text-align: center; vertical-align: middle; background: blue; color: white;">
<td colspan="3"> TOTAL <?php echo $dt; ?></td>
         
          <td ><?php echo $avrs['sum(av.sac_flasque)']; ?></td>
          <td  ><?php echo $avrs['sum(av.sac_mouille)']; ?></td>
          <td  ></td>
         
          

        </tr> 
      <?php } } ?>


    
    </tbody>
  </table>
</div>
</div>




<?php   } ?>

   
  <?php if($cherche['type']=="VRAQUIER"){  ?> 
 
<?php } ?>
       


 <?php 
while($rown=$res4->fetch()){

  ?>
<div class="modal fade" id="enregistrement" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog modal-dialog-centered" style="z-index: 1;">
    <div class="modal-content" style=" border: solid; border-color:rgb(0,141,202); " >
      <div class="modal-header bg-primary">
         <center>
        <h3 class="modal-title fs-10 text-white text-center" id="exampleModalLabel " style=" margin-left: 0px;   ">Enregistrement</h3></center>
        <center>
              <img class="logoo" src="../images/mylogo.ico" >
              </center>
       
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        
      
      <div class="modal-body"  >
              
        <form method="POST" >

   <div class="mb-3">
      
  <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="navire"  name="navire"  id="navire" hidden="true" value=<?php  
        echo $rown['id_navire'];
    ?> > 
    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="type"  name="type" hidden="true"  id="type"  value=<?php  
        echo $rown['type'];
    ?> > 

</div>

   <div class="mb-3">
     
  <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="produit" name="produit"  id="produit" hidden="true" value=<?php  
        echo $rown['id_produit'];
    ?> >
</div>

   <div class="mb-3">
     
  <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="id_dis" name="id_di"  id="produit" hidden="true" value=<?php  
        echo $rown['id_dis'];
    ?> >
</div>


   <div class="mb-3">
      
  <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="produit" name="poids"  id="poids" hidden="true" value=<?php  
        echo $rown['poids_kg'];
    ?> >
</div>

   <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">date</label>
  <input type="date" id="exampleFormControlInput1" class="form-control" id="exampleFormControlInput1"   name="date" id="dates">
</div>
  <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">heure</label>
  <input type="time" class="form-control" id="exampleFormControlInput1"  name="heure" id="heure">
</div>

   <div class="mb-3">
    <select name="declaration" id="exampleFormControlInput1" style="height: 30px;" id="declare">
    <option value="" > choisir une declaration</option>
    <?php while($dec=$resdes->fetch()){ ?> 
    <option value=<?php  echo $dec['id_trans']; ?> ><?php  echo $dec['numero_declaration']; ?></option>  
   <?php } ?>
    </select>
</div>



   <div class="mb-3">
  <select style="width: 50%; margin-bottom: 20px; height: 30px;" name="cale" >
    <option value="">Cale</option>

    <?php if($rown['type']=="SACHERIE"){ while($res=$rescale->fetch()){ 
            $rescale2= $bdd->prepare("SELECT cales   FROM declaration_chargement
               

                   WHERE id_navire=? and id_produit=? and conditionnement=? 
                  ");
        $rescale2->bindParam(1,$res['id_navire']);
        $rescale2->bindParam(2,$res['id_produit']);
        $rescale2->bindParam(3,$res['poids_kg']);
        $rescale2->execute(); } 
    while($rownn=$rescale2->fetch()){ ?>
      <option value=<?php echo $rownn['cales']; ?>><?php echo $rownn['cales']; ?></option>
    <?php } }?>
     <?php if($rown['type']=="VRAQUIER"){ while($res=$rescale->fetch()){ 
            $rescale2= $bdd->prepare("SELECT cales   FROM declaration_chargement
               

                   WHERE id_navire=? and id_produit=? 
                  ");
        $rescale2->bindParam(1,$res['id_navire']);
        $rescale2->bindParam(2,$res['id_produit']);
       
        $rescale2->execute(); } 
    while($rownn=$rescale2->fetch()){ ?>
      <option value=<?php echo $rownn['cales']; ?>><?php echo $rownn['cales']; ?></option>
    <?php } }?>
  </select>

</div>
<div style="background: blue">
   <div class="mb-3">
      <center>  
    <h3 style="background: white; color: blue;">TRANSPORT</h3>
   
 <h6 style="color: white;">CAMIONS  </h6>
  </center> 
<input type="text" id="myInput"  placeholder="SAISIR LE N° DE CAMION" style="width: 50%; " onkeyup="filtreca();" autocomplete="off">
<input type="text" id="myInputTransp" placeholder="transporteur" style="width: 50%; float: right;" disabled="true" >

<div id="camionList" style="background: white; display: none; " >
  </div>
 

<br>  





<input type="" name="input2" id="val_input2" hidden="true"  >
 <center> <br>  
<h6 style="color: white;">CHAUFFEUR  </h6> 
</center> 
<input type="text" id="myInputc"  placeholder="chauffeur" style="width: 100%;" onkeyup="filtreChau();" autocomplete="off">

<div id="camionListc" style="background: white; display: none;" >
  

</div>
<input type="" name="input2c" id="val_input2c" hidden="true" >
<div id="details" style="background: white; display: none;" >
  <?php  ?>
  </div>

  
</div>
 </div>



<div class="mb-3">

    <input type="text"  style=" margin-bottom: 20px; margin-top: 20px;" name="numero_bl" id="exampleFormControlInput1" id="numero_bl" placeholder="numero bl" >
   



</div>
   <div class="mb-3">
  <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" name="client"  id="poids" hidden="true"  value=<?php  
        echo $rown['id_client'];
    ?> >
     <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" name="destination" hidden="true" value=<?php  
        echo $rown['id_mangasin'];
    ?> >

</div>

<?php if($rown['des_douane']=="LIVRAISON"){ ?>


 <div class="mb-3">
 
  <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="destinataire" name="destinataire" >
</div>
<?php 
}
 if($rown['des_douane']=="TRANSFERT"){  ?>
  <div class="mb-3">
 
  <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="destinataire" name="destinataire" value="AUCUN" hidden="true" >
</div>


<?php  

} ?>

  
<?php if($rown['type']=="SACHERIE" and $rown['poids_kg']!=0){ ?>
  <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">nombre sac</label>
  <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="0" name="sac" id="sac">
  </div>
  <div class="mb-3" hidden="true">
      <label for="exampleFormControlInput1" class="form-label">poids</label>
  <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="poids" name="poids_s"  value="0" hidden="true">
</div> 

<?php } ?>

<?php  if($rown['type']=="VRAQUIER" and $rown['poids_kg']==0){ ?>
<div class="mb-3" hidden="true" >
      <label for="exampleFormControlInput1" class="form-label">nombre_sac</label>
  <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="0" value="0" name="sac" id="sac" hidden="true">
</div>
<div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">poids</label>
  <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="poids" name="poids_s" >

</div>

<?php } ?>
<?php  if($rown['type']=="VRAQUIER" and $rown['poids_kg']!=0){ ?>
<div class="mb-3" >
      <label for="exampleFormControlInput1" class="form-label">nombre_sac</label>
  <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="0"  name="sac"  >
</div>
<div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">poids</label>
  <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="poids" name="poids_s" >

</div>

<?php } ?>





   
      


  
   <div class="mb-3">


        

         <center>
        <button type="submit" class="btn btn-primary" style="text-align: center;" name="register" id="register" onclick="register()" >enregistrer</button></center>
</form> 
      </div>   
      <div class="modal-footer">
 
        
      </div>
    </div>
  </div>
</div>
</div>








 

 <div class="modal fade" id="enregistrement_transfert" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="z-index: 1;">
    <div class="modal-content" style=" border: solid; border-color:rgb(0,141,202);">
      <div class="modal-header bg-primary">
        <center>
              <img class="logoo" src="../images/mylogo.ico" >
              </center>
        <center>
        <h3 class="modal-title fs-10 text-white text-center" id="exampleModalLabel " style="text-align:center;   ">Connectez vous</h3></center>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" >
              
        <form method="POST">

   <div class="mb-3">
      
  <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="navire"  name="navire"  id="navire"  value="<?php  
        echo $rown['id_navire']; 
    ?>" hidden="true" > 
</div>

   <div class="mb-3">
     
  <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="produit" name="produit"  id="produit" hidden="true" value=<?php  
        echo $rown['id_produit'];
    ?> >
</div>

   <div class="mb-3">
     
  <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="id_dis" name="id_di"  id="produit" hidden="true" value=<?php  
        echo $rown['id_dis'];
    ?> >
</div>


   <div class="mb-3">
      
  <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="produit" name="poids"  id="poids" hidden="true" value=<?php  
        echo $rown['poids_kg'];
    ?> >
</div>

   <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">date</label>
  <input type="date" class="form-control" id="exampleFormControlInput1"  name="date" id="date">
</div>
  <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">heure</label>
  <input type="time" class="form-control" id="exampleFormControlInput1"  name="heure" id="heure">
</div>

   <div class="mb-3">
    <select name="declaration"  style="height: 30px;">
    <option selected > choisir une declaration</option>
    <?php while($dec=$resdes2->fetch()){ ?> 
    <option value=<?php  echo $dec['id_trans']; ?> ><?php  echo $dec['numero_declaration']; ?></option>  
   <?php } ?>
    </select>
</div>



   <div class="mb-3">
  <select style="width: 50%; margin-bottom: 20px; height: 30px;" name="cale" >
    <option selected>Cale</option>
    <?php while($res=$rescale1->fetch()){ 
            $rescale2= $bdd->prepare("SELECT cales   FROM declaration_chargement
               

                   WHERE id_navire=? and id_produit=? and conditionnement=? 
                  ");
        $rescale2->bindParam(1,$res['id_navire']);
        $rescale2->bindParam(2,$res['id_produit']);
        $rescale2->bindParam(3,$res['poids_kg']);
        $rescale2->execute(); } 
    while($rownn=$rescale2->fetch()){ ?>
      <option value=<?php echo $rownn['cales']; ?>><?php echo $rownn['cales']; ?></option>
    <?php } ?>
  </select>

</div>
<div style="background: blue">
   <div class="mb-3">
      <center>  
    <h3 style="background: white; color: blue;">TRANSPORT</h3>
   
 <h6 style="color: white;">CAMIONS  </h6>
  </center> 
<input type="search" id="myInput3"  placeholder="SAISIR LE N° DE CAMION" style="width: 50%; " onkeyup="filtreca3();">
<i class="fas fa-search" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%);"></i>
<input type="text" id="myInputTransp3" placeholder="transporteur" style="width: 50%; float: right; color: white !important;" disabled="true"  >

<div id="camionList3" style="background: white; display: none; " >
  </div>
 

<br><br>   





<input type="" name="input3" id="val_input3" hidden="true"  >
 <center> <br>  
<h6 style="color: white;">CHAUFFEUR  </h6> 
</center> 
<input type="text" id="myInputc3"  placeholder="chauffeur" style="width: 100%;" onkeyup="filtreChau3();" >

<div id="camionListc3" style="background: white; display: none;" >
  

</div>
<input type="" name="input3c" id="val_input3c" hidden="true" >
<div id="details" style="background: white; display: none;" >
  <?php  ?>
  </div>

  
</div>
 </div>

 



   <div class="mb-3">

    <input  style=" margin-bottom: 20px;margin-top: 20px;" name="numero_bl" id="numero_bl" placeholder="numero bl" >
   

</div>
   <div class="mb-3">
  <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" name="client"  id="poids" hidden="true"  value=<?php  
        echo $rown['id_client'];
    ?> >
     <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" name="destination" hidden="true" value=<?php  
        echo $rown['id_mangasin'];
    ?> >

</div>

<?php if($rown['des_douane']=="LIVRAISON"){ ?>
  <div class="mb-3">
 
  <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="destination" name="autre_destination" >
</div>

 <div class="mb-3">
 
  <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="destinataire" name="destinataire" >
</div>
<?php 
}
else { ?>
  <div class="mb-3">
 
  <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="destinataire" name="destinataire" value="AUCUN" hidden="true">
</div>

  <div class="mb-3">
 
  <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="destinataire" name="autre_destination" value="AUCUNE" hidden="true" >
</div>
<?php  

} ?>

   <div class="mb-3">
      
  <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="nbre sacs flasques" name="sac_flasque" >
</div>
  <div class="mb-3">
      
  <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="poids flasques" name="poids_flasque" >
</div>
  <div class="mb-3">
      
  <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="nbre sacs mouille" name="sac_mouille" >
</div>

  <div class="mb-3">
      
  <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="poids mouille" name="poids_mouille" >
</div>
   
      


  
   <div class="mb-3">


        

         <center>
        <button type="submit" class="btn btn-primary " style="text-align: center;" name="valider_tr_avaries" id="valider_tr_avaries" onclick="go4()">enregistrer</button></center>
</form> 
      </div>   
      <div class="modal-footer">
 
        
      </div>
    </div>
  </div>
</div>
</div>


<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true" >
  <div class="modal-dialog modal-dialog-centered" role="document" style="z-index: 1;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="imageModalLabel">Image</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <img id="imagePreview" src="" alt="Image">
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="fichier" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="z-index: 1;">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <center>
        <h2 class="modal-title fs-5 text-white text-center" id="exampleModalLabel " style="text-align:center; ">ARCHIVRAGE</h2></center>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" >
               <center>
            <img class="logo" src="assets/images/mylogo.ico" style="border-radius: 50px;">

        </center>
        <form method="POST" enctype="multipart/form-data">

   <div class="mb-3">
    <label for="image">Choisir une image :</label>
  <input type="file" name="image" id="image">
  <input type="text" name="ids" id="id_image">

   

    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="navire"  name="navire"  id="navire"  value=<?php  
        echo $rown['id_navire'];
    ?> >  
  <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="id_dis" name="id_di"  id="produit" hidden="true" value=<?php  
        echo $rown['id_dis'];
    ?> >
</div>
      
 
 <div class="mb-3">


        

         <center>
        <button type="submit" class="btn btn-primary " style="text-align: center;" name="archiver" id="deb" >enregistrer</button></center>
</form> 
      </div>  
       
      <div class="modal-footer">
 
        
      </div>
    </div>
  </div>
</div>



</div>







<div class="modal fade" id="Les_avaries" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <center>
        <h2 class="modal-title fs-5 text-white text-center" id="exampleModalLabel " style="text-align:center; ">Ajouter Avaries</h2></center>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" >
               <center>
            <img class="logo" src="assets/images/mylogo.ico" style="border-radius: 50px;">

        </center>
        <form method="POST">
          <?php if($rown['type']=='SACHERIE'){ ?>


   <div class="mb-3">
      
  <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="navire"  name="navire"  id="navire" hidden="true" value=<?php  
        echo $rown['id_navire'];
    ?> > 
    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="navire"  name="id_di" hidden="true" value=<?php  
        echo $rown['id_dis'];
    ?> > 
   
</div>
  <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">date</label>
  <input type="date" class="form-control" id="exampleFormControlInput1"  name="date" id="date">
</div>

 <table class='table table-hover table-bordered table-striped' id='table' border='2' >
  <thead>
    <tr style="text-align: center;">
      <td>cale</td><td>produit</td><td> nombre sacs flasques</td>
       <td> nombre sacs mouilles</td>
    </tr>
  </thead>
  <tbody>
    
  <?php while($roow=$avaries->fetch()) {?> 

      <tr>
         <input type="text" class="form-control" id="exampleFormControlInput1" placeholder=""  name="id_produit[]" hidden="true"  value=<?php  
        echo $roow['id_produit'];
    ?> >
        <td><?php echo $roow['cales'] ?> <input style="width: 30%" type="text" class="form-control" id="exampleFormControlInput1" placeholder="cale" hidden="true"  name="cale[]"  id="c" value=<?php  
        echo $roow['cales'];
    ?> > </td>
        <td><?php echo $roow['produit'] ?><input style="width: 30%" type="text" class="form-control" id="exampleFormControlInput1" placeholder="cale" hidden="true" name="produit[]"  id="c" value=<?php  
        echo $roow['id_produit'];
    ?> > <?php echo $roow['conditionnement'] ?> KGS<input style="width: 30%" type="text" class="form-control" id="exampleFormControlInput1" placeholder="cale" hidden="true" name="cond[]"  id="c" value=<?php  
        echo $roow['conditionnement'];
    ?> ></td>
        
    <td><label>SAC FLASQUE</label><input style="width: 100%" type="text" class="form-control" id="exampleFormControlInput1" placeholder="sac"  name="nombre_sacf[]" value=0 ></td>
    <td><label>SAC MOUILLE</label>
      <input style="width: 100%" type="text" class="form-control" id="exampleFormControlInput1" placeholder="sac"  name="nombre_sacm[]" value=0 ></td>

     <div class="mb-3"> 
           <input style="width: 30%" type="text" class="form-control" id="exampleFormControlInput1" placeholder="cale" hidden="true" name="poids[]"  id="c" value=<?php  
        echo $roow['poids'];
    ?> >
</div>

    </tr>  
<?php } ?>
</tbody>
</table>


<?php while($roow=$selcale2->fetch()) {?> 

<div style="display: none;">
     <div class="mb-3"> 
  <input style="width: 30%" type="text" class="form-control" id="exampleFormControlInput1" placeholder="cale" hidden="true"  name="cale1[]"  id="c" value=<?php  
        echo $roow['cales'];
    ?> > 
     <input style="width: 30%" type="text" class="form-control" id="exampleFormControlInput1" placeholder="cale" hidden="true" name="produit1[]"  id="c" value=<?php  
        echo $roow['id_produit'];
    ?> > 
     <input style="width: 30%" type="text" class="form-control" id="exampleFormControlInput1" placeholder="cale" hidden="true" name="cond1[]"  id="c" value=<?php  
        echo $roow['conditionnement'];
    ?> > 
        <input style="width: 30%" type="text" class="form-control" id="exampleFormControlInput1" placeholder="cale" hidden="true" name="nombre_sac1[]"  id="c" value=<?php  
        echo $roow['nombre_sac'];
    ?> >
           <input style="width: 30%" type="text" class="form-control" id="exampleFormControlInput1" placeholder="cale" hidden="true" name="poids1[]"  id="c" value=<?php  
        echo $roow['poids'];
    ?> >
</div>
</div>
<?php } ?>

<?php while($rooow=$cli_desti->fetch()){ ?>
  <div style="display: none;">
<div class="mb-3">
  <input type="text" name="id_dis_dis[]" value=<?php echo $rooow['id_dis'] ?>>
   <input type="text" name="id_client_dis[]" value=<?php echo $rooow['id_client'] ?>>
    <input type="text" name="id_mangasin_dis[]" value=<?php echo $rooow['id_mangasin'] ?>>
     <input type="text" name="id_poids_dis[]" value=<?php echo $rooow['poids_kg'] ?>>
      <input type="text" name="id_produit_dis[]" value=<?php echo $rooow['id_produit'] ?>>
       <input type="text" name="id_navire_dis[]" value=<?php echo $rooow['id_navire'] ?>>
</div>
</div>
<?php } ?>


  
   <div class="mb-3">


        

         <center>
        <button type="submit" class="btn btn-primary " style="text-align: center;" name="valider_Avaries" id="C24H" onclick="go4()">enregistrer</button></center>
        </div>
      <?php }  ?>

    <?php if($rown['type']=="VRAQUIER") { ?>
                <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">date</label>
  <input type="date" class="form-control" id="exampleFormControlInput1"  name="date" id="date">
</div>
<div class="mb-3">
      
  <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="navire"  name="navire"  id="navire" hidden="true" value=<?php  
        echo $rown['id_navire'];
    ?> > 
   
</div>
<div style="display: none;">
        <?php while($roow=$selcale2->fetch()) {?> 


     <div class="mb-3"> 
  <input style="width: 30%" type="text" class="form-control" id="exampleFormControlInput1" placeholder="cale"   name="cale1[]"  id="c" value=<?php  
        echo $roow['cales'];
    ?> > 
     <input style="width: 30%" type="text" class="form-control" id="exampleFormControlInput1" placeholder="cale"  name="produit1[]"  id="c" value=<?php  
        echo $roow['id_produit'];
    ?> > 
     <input style="width: 30%" type="text" class="form-control" id="exampleFormControlInput1" placeholder="cale" hidden="true" name="cond1[]"  id="c" value=<?php  
        echo $roow['conditionnement'];
    ?> > 
        <input style="width: 30%" type="text" class="form-control" id="exampleFormControlInput1" placeholder="cale" hidden="true" name="nombre_sac1[]"  id="c" value=<?php  
        echo $roow['nombre_sac'];
    ?> >
           <input style="width: 30%" type="text" class="form-control" id="exampleFormControlInput1" placeholder="cale" hidden="true" name="poids1[]"  id="c" value=<?php  
        echo $roow['poids'];
    ?> >
</div>
    <?php }  ?>

<?php while($rooow=$cli_desti->fetch()){ ?>
<div class="mb-3">
  <input type="text" name="id_dis_dis[]" value=<?php echo $rooow['id_dis'] ?>>
   <input type="text" name="id_client_dis[]" value=<?php echo $rooow['id_client'] ?>>
    <input type="text" name="id_mangasin_dis[]" value=<?php echo $rooow['id_mangasin'] ?>>
     <input type="text" name="id_poids_dis[]" value=<?php echo $rooow['poids_kg'] ?>>
      <input type="text" name="id_produit_dis[]" value=<?php echo $rooow['id_produit'] ?>>
       <input type="text" name="id_navire_dis[]" value=<?php echo $rooow['id_navire'] ?>>
</div>

<?php } ?>
</div>

     <div class="mb-3">
         <center>
        <button type="submit" class="btn btn-primary " style="text-align: center;" name="valider_Avaries2" id="C24H" onclick="go4()">enregistrer</button></center>
</div>
<?php }  ?>

</form> 
       
      <div class="modal-footer">
 
        
      </div>
    </div>
  </div>
</div>
</div>











<div class="modal fade" id="Les_avaries2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <center>
        <h2 class="modal-title fs-5 text-white text-center" id="exampleModalLabel " style="text-align:center; ">Ajouter Avaries</h2></center>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" >
               <center>
            <img class="logo" src="assets/images/mylogo.ico" style="border-radius: 50px;">

        </center>
        <form method="POST">
          <?php if($rown['type']=='SACHERIE'){ ?>


   <div class="mb-3">
    <label>SAC FLASQUE</label>
    <input type="text" class="form-control" id="exampleFormControlInput1"   name="sac_flasque"  id="navire"  value="0"
    ?> >
     <label>SAC MOUILLE</label>
    <input type="text" class="form-control" id="exampleFormControlInput1"   name="sac_mouille"  id="navire"  value="0"
    ?> >
      
  <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="navire"  name="navire"  id="navire" hidden="true" value=<?php  
        echo $rown['id_navire'];
    ?> > 
    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="navire"  name="id_di" hidden="true" value=<?php  
        echo $rown['id_dis'];
    ?> > 
   
</div>
  <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">date</label>
  <input type="date" class="form-control" id="exampleFormControlInput1"  name="date" id="date">
</div>

 <table class='table table-hover table-bordered table-striped' id='table' border='2' >
  <thead>
    <tr style="text-align: center;">
      <td>cale</td><td>produit</td><td> nombre sacs flasques</td>
       <td> nombre sacs mouilles</td>
    </tr>
  </thead>
  <tbody>
    
  <?php while($roow=$avaries->fetch()) {?> 

      <tr>
         <input type="text" class="form-control" id="exampleFormControlInput1" placeholder=""  name="id_produit[]" hidden="true"  value=<?php  
        echo $roow['id_produit'];
    ?> >
        <td><?php echo $roow['cales'] ?> <input style="width: 30%" type="text" class="form-control" id="exampleFormControlInput1" placeholder="cale" hidden="true"  name="cale[]"  id="c" value=<?php  
        echo $roow['cales'];
    ?> > </td>
        <td><?php echo $roow['produit'] ?><input style="width: 30%" type="text" class="form-control" id="exampleFormControlInput1" placeholder="cale" hidden="true" name="produit[]"  id="c" value=<?php  
        echo $roow['id_produit'];
    ?> > <?php echo $roow['conditionnement'] ?> KGS<input style="width: 30%" type="text" class="form-control" id="exampleFormControlInput1" placeholder="cale" hidden="true" name="cond[]"  id="c" value=<?php  
        echo $roow['conditionnement'];
    ?> ></td>
        
    <td><label>SAC FLASQUE</label><input style="width: 100%" type="text" class="form-control" id="exampleFormControlInput1" placeholder="sac"  name="nombre_sacf[]" value=0 ></td>
    <td><label>SAC MOUILLE</label>
      <input style="width: 100%" type="text" class="form-control" id="exampleFormControlInput1" placeholder="sac"  name="nombre_sacm[]" value=0 ></td>

     <div class="mb-3"> 
           <input style="width: 30%" type="text" class="form-control" id="exampleFormControlInput1" placeholder="cale" hidden="true" name="poids[]"  id="c" value=<?php  
        echo $roow['poids'];
    ?> >
</div>

    </tr>  
<?php } ?>
</tbody>
</table>


<?php while($roow=$selcale2->fetch()) {?> 

<div style="display: none;">
     <div class="mb-3"> 
  <input style="width: 30%" type="text" class="form-control" id="exampleFormControlInput1" placeholder="cale" hidden="true"  name="cale1[]"  id="c" value=<?php  
        echo $roow['cales'];
    ?> > 
     <input style="width: 30%" type="text" class="form-control" id="exampleFormControlInput1" placeholder="cale" hidden="true" name="produit1[]"  id="c" value=<?php  
        echo $roow['id_produit'];
    ?> > 
     <input style="width: 30%" type="text" class="form-control" id="exampleFormControlInput1" placeholder="cale" hidden="true" name="cond1[]"  id="c" value=<?php  
        echo $roow['conditionnement'];
    ?> > 
        <input style="width: 30%" type="text" class="form-control" id="exampleFormControlInput1" placeholder="cale" hidden="true" name="nombre_sac1[]"  id="c" value=<?php  
        echo $roow['nombre_sac'];
    ?> >
           <input style="width: 30%" type="text" class="form-control" id="exampleFormControlInput1" placeholder="cale" hidden="true" name="poids1[]"  id="c" value=<?php  
        echo $roow['poids'];
    ?> >
</div>
</div>
<?php } ?>

<?php while($rooow=$cli_desti->fetch()){ ?>
  <div style="display: none;">
<div class="mb-3">
  <input type="text" name="id_dis_dis[]" value=<?php echo $rooow['id_dis'] ?>>
   <input type="text" name="id_client_dis[]" value=<?php echo $rooow['id_client'] ?>>
    <input type="text" name="id_mangasin_dis[]" value=<?php echo $rooow['id_mangasin'] ?>>
     <input type="text" name="id_poids_dis[]" value=<?php echo $rooow['poids_kg'] ?>>
      <input type="text" name="id_produit_dis[]" value=<?php echo $rooow['id_produit'] ?>>
       <input type="text" name="id_navire_dis[]" value=<?php echo $rooow['id_navire'] ?>>
</div>
</div>
<?php } ?>


  
   <div class="mb-3">


        

         <center>
        <button type="submit" class="btn btn-primary " style="text-align: center;" name="valider_Avaries" id="C24H" onclick="go4()">enregistrer</button></center>
        </div>
      <?php }  ?>

    <?php if($rown['type']=="VRAQUIER") { ?>
                <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">date</label>
  <input type="date" class="form-control" id="exampleFormControlInput1"  name="date" id="date">
</div>
<div class="mb-3">
      
  <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="navire"  name="navire"  id="navire" hidden="true" value=<?php  
        echo $rown['id_navire'];
    ?> > 
   
</div>
<div style="display: none;">
        <?php while($roow=$selcale2->fetch()) {?> 


     <div class="mb-3"> 
  <input style="width: 30%" type="text" class="form-control" id="exampleFormControlInput1" placeholder="cale"   name="cale1[]"  id="c" value=<?php  
        echo $roow['cales'];
    ?> > 
     <input style="width: 30%" type="text" class="form-control" id="exampleFormControlInput1" placeholder="cale"  name="produit1[]"  id="c" value=<?php  
        echo $roow['id_produit'];
    ?> > 
     <input style="width: 30%" type="text" class="form-control" id="exampleFormControlInput1" placeholder="cale" hidden="true" name="cond1[]"  id="c" value=<?php  
        echo $roow['conditionnement'];
    ?> > 
        <input style="width: 30%" type="text" class="form-control" id="exampleFormControlInput1" placeholder="cale" hidden="true" name="nombre_sac1[]"  id="c" value=<?php  
        echo $roow['nombre_sac'];
    ?> >
           <input style="width: 30%" type="text" class="form-control" id="exampleFormControlInput1" placeholder="cale" hidden="true" name="poids1[]"  id="c" value=<?php  
        echo $roow['poids'];
    ?> >
</div>
    <?php }  ?>

<?php while($rooow=$cli_desti->fetch()){ ?>
<div class="mb-3">
  <input type="text" name="id_dis_dis[]" value=<?php echo $rooow['id_dis'] ?>>
   <input type="text" name="id_client_dis[]" value=<?php echo $rooow['id_client'] ?>>
    <input type="text" name="id_mangasin_dis[]" value=<?php echo $rooow['id_mangasin'] ?>>
     <input type="text" name="id_poids_dis[]" value=<?php echo $rooow['poids_kg'] ?>>
      <input type="text" name="id_produit_dis[]" value=<?php echo $rooow['id_produit'] ?>>
       <input type="text" name="id_navire_dis[]" value=<?php echo $rooow['id_navire'] ?>>
</div>

<?php } ?>
</div>

     <div class="mb-3">
         <center>
        <button type="submit" class="btn btn-primary " style="text-align: center;" name="valider_Avaries2" id="C24H" onclick="go4()">enregistrer</button></center>
</div>
<?php }  ?>

</form> 
       
      <div class="modal-footer">
 
        
      </div>
    </div>
  </div>
</div>
</div>





<?php } ?>

 
  

<?php } 

?>
</div>




 ?>



