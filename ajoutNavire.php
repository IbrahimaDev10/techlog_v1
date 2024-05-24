<?php
if (isset($_POST['ajoutNavire'])) {
    if(!empty($_POST['navire']) and !empty($_POST['produit']) and !empty($_POST['poids'])){  
      $navire=$_POST['navire'];
      $produit=$_POST['produit'];
      $poids=$_POST['poids'];
$a=0;
$b="null";
$date=date('y-m-d');





   
try{
   
$insertNavire = $bdd->prepare("INSERT INTO navire(nom_navire,id_user) VALUES(?,?)");
$insertNavire->bindParam(1,$navire);
$insertNavire->bindParam(2,$_SESSION['id']);
$insertNavire->execute();
$insertNavire->closeCursor();

$selectNavire= $bdd->prepare("select * from navire where id=(select max(id) from navire)");
$selectNavire->execute();


while($fetch=$selectNavire->fetch()){
   $insertProduit= $bdd->prepare("INSERT INTO produit(nom_produit,poids_net,id_navire,id_user) VALUES(?,?,?,?)");
   $insertProduit->bindParam(1,$produit);
    $insertProduit->bindParam(2,$poids);
$insertProduit->bindParam(3,$fetch['id']);
$insertProduit->bindParam(4,$fetch['id_user']);

$selectNavire->closeCursor();
$insertProduit->execute();

$insertProduit->closeCursor();

$selectProd= $bdd->prepare("select * from produit where id=(select max(id) from produit)");
$selectProd->execute();
while($fetch2=$selectProd->fetch()){
   
   $insertRecep= $bdd->prepare("INSERT INTO reception(dates,chauffeur,bl,nbre_sac,poids,cumul_jour,poids_jour,cumul_general,poids_general,id_navire,id_produit,id_user) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)");
   $insertRecep->bindParam(1,$date);
    $insertRecep->bindParam(2,$b);
$insertRecep->bindParam(3,$b);
$insertRecep->bindParam(4,$a);
$insertRecep->bindParam(5,$a);
$insertRecep->bindParam(6,$a);
$insertRecep->bindParam(7,$a);
$insertRecep->bindParam(8,$a);
$insertRecep->bindParam(9,$a);




$insertRecep->bindParam(10,$fetch2['id_navire']);
$insertRecep->bindParam(11,$fetch2['id_produit']);
$insertRecep->bindParam(12,$fetch2['id_user']);

$selectProd->closeCursor();

$insertRecep->execute();
echo "insertion reussi";

   
}
 }
}


catch (Exception $e) {
   
}
}
else{
echo "veuillez remplir les champs";
}
}

?>                               
 
