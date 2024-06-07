<?php 
function insertion($bdd, $table, $colonnes, $valeurs) {
    // Préparer les champs et les marqueurs pour la requête SQL
    $champs = implode(', ', $colonnes);
    $nombre_valeurs = implode(', ', array_fill(0, count($valeurs), '?'));
    
    // Créer la requête SQL
    $sql = "INSERT INTO $table ($champs) VALUES ($nombre_valeurs)";
    
    // Préparer la requête
    $insert = $bdd->prepare($sql);

    // Lier les paramètres
    $insert = $bdd->prepare($sql);

    // Exécuter la requête avec les valeurs fournies
    if ($insert->execute($valeurs)) {
         // Insertion réussie
        ?>
          <script type="text/javascript">
              Swal.fire({
        icon: 'success',
        title: 'Reussi',
        text: 'Donnees enregistrees avec successssssssssssss.',
        confirmButtonText: 'OK'
    });
    </script>

    <?php  
    } else {
        return false;// Échec de l'insertion
        ?> 

        <?php  
    } 

}

 ?>	