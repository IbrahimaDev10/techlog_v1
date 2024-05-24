<?php
require('../database.php');

if (isset($_POST['query'])) {
    $id = $_POST['query'];



   
        // Traitez les données du formulaire ici
        $client = $_POST['client'];
        $code = $_POST['code_ppm_client'];
        $adresse = $_POST['adresse_client'];
        $tel = $_POST['tel_client'];

        try {
            $updateQuery = $bdd->prepare("UPDATE client SET client = ?, code_ppm_client = ?, adresse_client = ?, tel_client = ? WHERE id = ?");
            $updateQuery->bindParam(1, $client);
            $updateQuery->bindParam(2, $code);
            $updateQuery->bindParam(3, $adresse);
            $updateQuery->bindParam(4, $tel);
            $updateQuery->bindParam(5, $id);
            $updateQuery->execute();

            echo "MODIFICATION RÉUSSIE";

          
          
        } catch(PDOException $e) {
            die('Erreur: ' . $e->getMessage());
        }
    } else {
        echo "Aucun enregistrement trouvé pour l'ID : $id";
    }

?>
