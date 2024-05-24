<?php 
//page modifier_donnees.php
require('../database.php');

$id = $_POST['id'];
$champ = $_POST['champ'];
$valeur = $_POST['valeur'];

// Mise à jour de la valeur dans la base de données
$stmt = $bdd->prepare('UPDATE register_manifeste SET ' . $champ . ' = :valeur WHERE id_register_manif = :id');
$stmt->execute(array(
  'valeur' => $valeur,
  'id' => $id
));


 ?>