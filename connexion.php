<?php
//page de connection
if (isset($_POST['connecter'])) {
    if(!empty($_POST['telephone1']) and !empty($_POST['password1'])){  
      $a=$_POST['telephone1'];
    $b=str_replace(" ", "", $a);

$query = $bdd->prepare("SELECT * FROM simar_user WHERE telephone =? ");

$query->bindParam(1, $b);
$query->execute();
 
$users = $query->fetch();
    
if ($users && password_verify($_POST['password1'], $users['mot_de_passe'])){
//if ($users && $_POST['pass']==$users['password'])
     $_SESSION['aut']=$users['id_sim_user'];
    $_SESSION['id']=$users['id_sim_user'];
   $_SESSION['telephone']=$users['telephone'];
   $_SESSION['prenom']=$users['prenom'];
   $_SESSION['nom']=$users['nom'];
   $_SESSION['profil']=$users['profil'];



            
    
      }
     
       else{
echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
                echo '<script type="text/javascript">';
                
               
echo 'setTimeout(function () { swal("Oops","Identifiant ou mot de passe incorrect","error");';
                echo '}, 100);</script>';
            }
          }
         else {

            
           
 echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
                echo '<script type="text/javascript">';
                
               
echo 'setTimeout(function () { swal("Oops","champs vides page!","error");';
                echo '}, 100);</script>';
        

}
}




?>                               
 
