<?php
namespace Pro\TechlogNewVersion;

class Crud {
    public static function insertion($bdd, $table, $colonnes, $valeurs) {
        // Préparer les champs et les marqueurs pour la requête SQL
        $champs = implode(', ', $colonnes);
        $placeholders = implode(', ', array_fill(0, count($valeurs), '?'));

        // Créer la requête SQL
        $sql = "INSERT INTO $table ($champs) VALUES ($placeholders)";

        // Préparer la requête
        $insert = $bdd->prepare($sql);

        // Exécuter la requête avec les valeurs fournies
        if ($insert->execute($valeurs)) { ?>

         <script type="text/javascript">
              Swal.fire({
        icon: 'success',
        title: 'Reussi',
        text: 'Donnees enregistrees avec succes.',
        confirmButtonText: 'OK'
    });
    </script>
      <?php       
           
        } 


        
         else {
            return false; // Échec de l'insertion
        }
    }
}