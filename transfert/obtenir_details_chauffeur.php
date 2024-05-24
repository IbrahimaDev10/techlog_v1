<?php
// Récupérer l'ID du chauffeur
require("../database.php");
$chauffeurId = $_GET['id'];

// Effectuer une requête SQL pour obtenir les détails du chauffeur en fonction de l'ID
$ch=$bdd->prepare("select n_permis,num_telephone from chauffeur where id_chauffeur=?");
$ch->bindParam(1$chauffeurId);
$ch->execute();

// ...
$find=$ch->fetch();

// Construire la réponse JSON
if ($find) {
	# code...
	$permis=$find['n_permis']:
	$tel=$find['num_telephone'];

$response = array(
  'success' => true,
  'details' => array(
    'permis' => $permis,
    'telephone' => $tel
  )
);

// Renvoyer la réponse JSON

}
else {
  // Le chauffeur n'existe pas
  $response = array(
    'success' => false,
    'message' => 'Chauffeur introuvable.'
  );
}
header('Content-Type: application/json');
echo json_encode($response);
?>
