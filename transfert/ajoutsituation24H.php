<?php 
//PAGE ajoutsituation24H.php    
require('../database.php');

if(isset($_POST['produit']) ){
    if(!empty($_POST['produit']) and !empty($_POST['poids']) and !empty($_POST['cond']) and !empty($_POST['cale']) and !empty($_POST['id_dis_dis']) and !empty($_POST['id_client_dis']) and !empty($_POST['id_mangasin_dis']) and !empty($_POST['id_poids_dis']) and !empty($_POST['id_produit_dis']) and !empty($_POST['id_navire_dis']) ){
        //$nav=$_POST['navire'];
       $formData = $_POST;

        $produit=$formData['produit'];
        $date=$_POST['date'];
        //$nombre_sac=$_POST['nombre_sac'];
        $poids=$formData['cond'];
        $navire=$_POST['navire'];
         $sacf=$formData['nombre_sacf'];
        $sacm=$formData['nombre_sacm'];
        $cale=$formData['cale'];
      //  $date=$formData['date'];
        $id_produit=$formData['id_produit'];
        $ref=0;
        
       $id_dis=$_POST['id_di'];

        
        
          $insertRecep1= $bdd->prepare("INSERT INTO avaries(date_avaries,cale_avaries,sac_flasque,poids_flasque,sac_mouille,poids_mouille,poids_sac_avaries,id_produit,id_navire,id_dis_av,ref) VALUES(?,?,?,?,?,?,?,?,?,?,?)"); 

           $insertRecep5= $bdd->prepare("INSERT INTO avaries(date_avaries,cale_avaries,sac_flasque,poids_flasque,sac_mouille,poids_mouille,poids_sac_avaries,id_produit,id_navire,id_dis_av,ref) VALUES(?,?,?,?,?,?,?,?,?,?,?)");      

  $produit1=$formData['produit1'];
        //$nombre_sac=$_POST['nombre_sac'];
        $poids1=$formData['cond1'];
        //$navire1=$_POST['navire1'];
        
        $cale1=$formData['cale1'];

        $date1="0000-00-00";
        $zero=0;
        $null="ref";
        $h="00:00:00";
        
          $insertRecep2= $bdd->prepare("INSERT INTO register_manifeste(dates,heure,cale,bl,id_dis_bl,camions,chauffeur,id_declaration,sac,poids,id_produit,poids_sac,id_client,id_destination,id_navire,destinataire) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");      

     $insertRecep3= $bdd->prepare("INSERT INTO register_manifeste(dates,heure,cale,bl,id_dis_bl,camions,chauffeur,id_declaration,sac,poids,id_produit,poids_sac,id_client,id_destination,id_navire,destinataire) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)"); 

     $insertRecep4= $bdd->prepare("INSERT INTO transfert_avaries(date_tr_avaries,heure_tr,cale_tr_avaries,bl_tr,id_cam,id_chauffeur_tr,sac_flasque_tr_av,poids_flasque_tr_av,sac_mouille_tr_av,poids_mouille_tr_av,id_dis_bl_tr,id_declaration_tr,poids_sac_tr_av,id_produit,id_client,id_destination_tr,id_navire,autre_destination_tr,destinataire_tr) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)"); 


     $produit3=$formData['id_produit_dis'];
     $nav3=$formData['id_navire_dis'];
     $client3=$formData['id_client_dis'];
     $mangasin3=$formData['id_mangasin_dis'];
     $poids3=$formData['id_poids_dis'];
     $id_dis3=$formData['id_dis_dis'];
     $statut="debarquement";

              try{
       $insertdate= $bdd->prepare("INSERT INTO date_situation(date_sit,id_navire_sit) VALUES(?,?)");
       $insertdate->bindParam(1,$date); 
       $insertdate->bindParam(2,$navire);
       $insertdate->execute(); 



    foreach ($produit as $key=>$prod) {
    
   // $nombre=$nombre_sac[$key];
    $ps=$poids[$key];
    $sf=$sacf[$key];
    $sm=$sacm[$key];
    $id_prod=$id_produit[$key];
    
    $cal=$cale[$key];

    $poidsf=$sf*$ps/1000;
     $poidsm=$sm*$ps/1000;
    

                    $insertRecep1->bindParam(1,$date); 
$insertRecep1->bindParam(2,$cal);

$insertRecep1->bindParam(3,$sf);
$insertRecep1->bindParam(4,$poidsf);
$insertRecep1->bindParam(5,$sm);
$insertRecep1->bindParam(6,$poidsm);
$insertRecep1->bindParam(7,$ps);
$insertRecep1->bindParam(8,$prod);
$insertRecep1->bindParam(9,$navire);
$insertRecep1->bindParam(10,$zero);
$insertRecep1->bindParam(11,$ref);

$insertRecep1->execute();
    
 
    }
    

foreach ($produit1 as $key=>$prod1) {
     $ps1=$poids1[$key];
    
    $cal1=$cale1[$key];   

    $insertRecep2->bindParam(1,$date); 
$insertRecep2->bindParam(2,$h);

$insertRecep2->bindParam(3,$cal1);
$insertRecep2->bindParam(4,$null);
$insertRecep2->bindParam(5,$zero);
$insertRecep2->bindParam(6,$null);
$insertRecep2->bindParam(7,$null);


$insertRecep2->bindParam(8,$zero);
$insertRecep2->bindParam(9,$zero);
$insertRecep2->bindParam(10,$zero);

$insertRecep2->bindParam(11,$prod1);
$insertRecep2->bindParam(12,$ps1);
$insertRecep2->bindParam(13,$zero);
$insertRecep2->bindParam(14,$zero);
$insertRecep2->bindParam(15,$navire);
$insertRecep2->bindParam(16,$null);


$insertRecep2->execute();
}

    

    


     foreach ($produit3 as $key=>$prod3) {
     $ps3=$poids3[$key];
     $cli=$client3[$key];
     $mang=$mangasin3[$key];
     $nav=$nav3[$key];
     $iddis=$id_dis3[$key];
     
      

    $insertRecep3->bindParam(1,$date); 
$insertRecep3->bindParam(2,$h);

$insertRecep3->bindParam(3,$null);
$insertRecep3->bindParam(4,$null);
$insertRecep3->bindParam(5,$iddis);
$insertRecep3->bindParam(6,$null);
$insertRecep3->bindParam(7,$null);


$insertRecep3->bindParam(8,$zero);
$insertRecep3->bindParam(9,$zero);
$insertRecep3->bindParam(10,$zero);

$insertRecep3->bindParam(11,$prod3);
$insertRecep3->bindParam(12,$ps3);
$insertRecep3->bindParam(13,$cli);
$insertRecep3->bindParam(14,$mang);
$insertRecep3->bindParam(15,$nav);
$insertRecep3->bindParam(16,$null);

$insertRecep3->execute();



$insertRecep4->bindParam(1,$date); 
$insertRecep4->bindParam(2,$h);

$insertRecep4->bindParam(3,$null);
$insertRecep4->bindParam(4,$null);

$insertRecep4->bindParam(5,$null);
$insertRecep4->bindParam(6,$null);
$insertRecep4->bindParam(7,$zero);
$insertRecep4->bindParam(8,$zero);
$insertRecep4->bindParam(9,$zero);

$insertRecep4->bindParam(10,$zero);
$insertRecep4->bindParam(11,$iddis);
$insertRecep4->bindParam(12,$zero);
$insertRecep4->bindParam(13,$ps3);
$insertRecep4->bindParam(14,$prod3); 
$insertRecep4->bindParam(15,$cli);
$insertRecep4->bindParam(16,$mang);
$insertRecep4->bindParam(17,$nav);
$insertRecep4->bindParam(18,$null);
$insertRecep4->bindParam(19,$null);
$insertRecep4->execute();



$insertRecep5->bindParam(1,$date); 
$insertRecep5->bindParam(2,$ref);

$insertRecep5->bindParam(3,$null);
$insertRecep5->bindParam(4,$null);

$insertRecep5->bindParam(5,$null);
$insertRecep5->bindParam(6,$null);
$insertRecep5->bindParam(7,$ps3);
$insertRecep5->bindParam(8,$prod3);
$insertRecep5->bindParam(9,$nav);

$insertRecep5->bindParam(10,$iddis);
$insertRecep5->bindParam(11,$ref);

$insertRecep5->execute();


}
}
    catch(Exception $e){

    }
 

      $message2="reussie";
   
    }

    else{
         $message2="Veuillez choisir un produit existant";
    }
    echo "duuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuu";

}

?>