<?php 
include('database.php');


$req=$bdd->query('select * from simar_user');
$count=$req->rowCount();


if (isset($_POST['inscription'])) {
    if(!empty($_POST['prenom']) and !empty($_POST['nom'])  and !empty($_POST['email'])  and !empty($_POST['telephone'] ) and !empty($_POST['profil'])  and !empty($_POST['mot_passe']) and !empty($_POST['retaper_mot_passe']) ){ 

    $prenom=addslashes($_POST['prenom']);
    $nom=addslashes($_POST['nom']);
    $email=addslashes($_POST['email']);
    $telephone=addslashes($_POST['telephone']);
    $profil=addslashes($_POST['profil']);

$pass_compare1=$_POST['mot_passe']);
$pass_compare2=$_POST['retaper_mot_passe']);

    //$pass=htmlspecialchars($_POST['password']);
    $pass=addslashes(password_hash($_POST['mot_passe'], PASSWORD_DEFAULT));

    $select = $bdd->prepare("SELECT * FROM simar_user WHERE telephone =?");

$select->bindParam(1, $telephone);
$users=$select->execute();
$users = $select->fetch();
}
if(!$users)
{
$req1=$bdd->prepare('INSERT INTO simar_user(email,prenom,nom,telephone,profil,mot_de_passe) VALUES( ?,?,?,?,?,?)');
    $req1->bindParam(1, $email); 
    $req1->bindParam(2, $prenom);
    $req1->bindParam(3, $nom);
    $req1->bindParam(4, $telephone);
    $req1->bindParam(5, $profil);
    $req1->bindParam(6, $pass);   
    $req1->execute();
             echo "<div class='alert alert-danger alert-dismissible fade show text-center' role='alert'>
  <strong>l' ajout de l' utilisateur à réussi avec succés  !'</strong>'
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>"; 

    
}

else{
    echo "Votre numero de telephone à deja été utilisé";

    
    }   
    

    
}

}

 ?>
