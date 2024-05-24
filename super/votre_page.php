<?php  	
require('../database.php');
if (isset($_GET['id'])) {
  $buttonId = $_GET['id'];



  // Préparation de la requête SQL
  $query = $bdd->prepare('SELECT client, code_ppm_client FROM client WHERE id = ?');
  $query->execute([$buttonId]);

  // Récupération des données
  $data = $query->fetchAll(PDO::FETCH_ASSOC);
}

  // Conversion en JSON et envoi
?>